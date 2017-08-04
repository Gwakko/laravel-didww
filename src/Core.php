<?php

namespace Didww;

class Core {
        
    /**
     * @var \SoapClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $wsdl_url;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var
     */
    protected $isTest = false;

    public $_errorCodes = [
        '100' => 'Access denied',
        '150' => 'Server error when validating an API client request',
        '151' => 'Array has invalid data',
        '200' => 'Server error when processing an API client request',
        '300' => 'Type not valid',
        '301' => 'Protocol not valid',
        '302' => 'Unsupported format for this type',
        '303' => 'PSTN prefix not supported',
        '400' => 'API Order ID not found or invalid',
        '401' => 'API Order ID not in valid status',
        '405' => 'Transaction refused',
        '410' => 'Transaction out of balance',
        '411' => 'Account balance is disabled/suspened/has not enough amount for purchases',
        '430' => 'Customer: Prepaid Balance disabled or not exist',
        '500' => 'Region(s) not found or invalid',
        '501' => 'City not found',
        '505' => 'DIDs not available for this region',
        '600' => 'DID Number not found or invalid',
        '601' => 'DID Number not found in Reserved Pool',
        '602' => 'DID Number expired. Please renew'
    ];

    /**
     * @var \SoapFault
     */
    private $_errorString;
    private $_errorCode;
    private $_authstr;
    private $_callback;

    /**
     * Instantiate a new instance
     */
    public function __construct()
    {
        $this->wsdl_url = config('didww.url');
        $this->username = config('didww.username');
        $this->key      = config('didww.key');
        $this->isTest   = config('didww.test');

        $this->client = new \SoapClient($this->wsdl_url);
        $this->_authstr = sha1($this->username . $this->key  .  ($this->isTest ? 'sandbox'  :''));
    }

    public function setCallback($callback)
    {
        if (!is_string($callback) && !is_array($callback)) {
            return false;
        }

        $this->_callback = $callback;
        return true;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getErrorCode()
    {
        return $this->_errorCode;
    }

    public function getErrorString()
    {
        return $this->_errorString;
    }

    public function getError()
    {
        if ($this->_errorString) {
            return sprintf('Error: (code: %s, message: %s)', $this->_errorCode, $this->_errorString);
        }
        return null;
    }

    public function getAvailableMethods()
    {
        if (!isset($this->client)) {
            return null;
        }

        $soapFunctions = $this->client->__getFunctions();
        for ($i = 0, $count = count($soapFunctions); $i < $count; ++$i) {
            preg_match("/[\s\S]*?(didww_[\s\S]*?)\([\s\S]*?/", $soapFunctions[$i], $match);
            $soapFunctions[$i] = $match[1];
        }

        return $soapFunctions;
    }

    public function _handleQuery($method, $params = [])
    {
        if (!isset($this->client)) {
            return null; // client undefined if missed internet connection
        }

        $params = $this->filterParams($params);
        $params = array_merge(['auth_string' => $this->_authstr], $params);
        $timeStart = microtime(true);

        try
        {
            $this->_errorCode = null;
            $this->_errorString = null;
            $method = sprintf('didww_%s', $method);
            //time measure
            $result = $this->client->__soapCall($method, $params);

            if (is_null($result)) {
                throw new \Exception('Undefined API result');
            }
        }
        catch(\SoapFault $e)
        {
            $this->_errorCode = $e->getCode();
            $this->_errorString = $e->getMessage();
            $result = null;
        }
        catch(\Exception $e)
        {
            $this->_errorCode = $e->getCode();
            $this->_errorString = $e->getMessage();
            $result = null;
        }

        $timeFinish = microtime(true);
        // If result contains error field trying to resolve error text by error code
        if (isset($result->error) && (int)$result->error > 0) {
            $result->error = isset($this->_errorCodes[$result->error])
                ? $this->_errorCodes[$result->error]
                : 'Unknown error with code : ' . $result->error;
        }

        if ($this->_callback) {
            call_user_func_array($this->_callback, [
                'result' => $result,
                'method' => $method,
                'params' => $params,
                'error' => $this->_errorString,
                'code' => $this->_errorCode,
                'seconds' => $timeFinish - $timeStart
            ]);
        }

        return $result;
    }

    /**
     * @param array $params
     * @return array
     */
    public function filterParams($params = [])
    {
        return array_filter($params, function($value){return !is_null($value);});
    }

}