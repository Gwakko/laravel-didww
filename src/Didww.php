<?php

namespace Didww;

class Didww extends Core
{
    /**
     * Instantiate a new instance
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This method will return list of regions from DIDWW coverage list.
     *
     * @param string $auth_string User Token for authorization
     * @param string $country_iso Country ISO Code
     * @param string $city_prefix City Prefix
     * @param string $last_request_gmt Date in UNIXTIME GMT format. Get list of updated regions starting from date of the last request
     * @return mixed
     *
     * @see https://www.didww.com/api/#get_didww_regions
     */
    public function getDidwwRegions($auth_string, $country_iso = null, $city_prefix = null, $last_request_gmt = null)
    {
        return $this->_handleQuery('getdidwwregions', compact(['auth_string','country_iso','city_prefix','last_request_gmt']));
    }


    /**
     * This method will return list of supported PSTN prefixes from DIDWW.
     *
     * @param string $auth_string User Token for authorization
     * @param string $country_iso Country ISO Code
     * @param string $pstn_prefix PSTN Prefix
     * @param string $last_request_gmt Date in UNIXTIME GMT format. Get list of updated PSTN Rates starting from date of the last request
     * @return mixed
     *
     * @see https://www.didww.com/api/#get_didww_pstn
     */
    public function getDidwwPstnRates($auth_string, $country_iso = null, $pstn_prefix = null, $last_request_gmt = null)
    {
        return $this->_handleQuery('getdidwwpstnrates', compact(['auth_string','country_iso','pstn_prefix','last_request_gmt']));
    }


    /**
     * This method will change PSTN tariffs for resellers through their Staff panel.
     *
     * @param string $auth_string User Token for authorization
     * @param array $rates Rate List
     * @return mixed
     *
     * @see https://www.didww.com/api/#update_pstn
     */
    public function updatePstnRates($auth_string, $rates)
    {
        return $this->_handleQuery('updatepstnrates', compact(['auth_string','rates']));
    }


    /**
     * This method will validate a PSTN Number.
     *
     * @param string $auth_string User Token for authorization
     * @param string $pstn_number PSTN number
     * @return mixed
     *
     * @see https://www.didww.com/api/#check_pstn
     */
    public function checkPstnNumber($auth_string, $pstn_number)
    {
        return $this->_handleQuery('checkpstnnumber', compact(['auth_string','pstn_number']));
    }


    /**
     * This method will purchase new service.
     *
     * @param string $auth_string User Token for authorization
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $country_iso Country ISO Code
     * @param string $city_prefix City Prefix
     * @param int $period Period (months)
     * @param array $map_data Forwarding data
     * @param string $prepaid_funds Amount in points
     * @param string $uniq_hash Unique md5 hash (Minimum 32 characters length). If unique hash has already been processed, method returns the information about DID number that was previously created with the same unique hash.
     * @param string $city_id City ID
     * @param string $autorenew_enable Enable automatic renewal
     * @return mixed
     *
     * @see https://www.didww.com/api/#order_create
     */
    public function orderCreate($auth_string, $customer_id, $country_iso, $city_prefix, $period, $map_data, $prepaid_funds, $uniq_hash, $city_id, $autorenew_enable = null)
    {
        return $this->_handleQuery('ordercreate', compact(['auth_string','customer_id','country_iso','city_prefix','period','map_data','prepaid_funds','uniq_hash','city_id','autorenew_enable']));
    }


    /**
     * This method will cancel order and remove purchased services.
     *
     * @param string $auth_string User Token for authorization
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $did_number DID number to cancel
     * @return mixed
     *
     * @see https://www.didww.com/api/#order_cancel
     */
    public function orderCancel($auth_string, $customer_id, $did_number)
    {
        return $this->_handleQuery('ordercancel', compact(['auth_string','customer_id','did_number']));
    }


    /**
     * This method will renew active service for specific period.
     *
     * @param string $auth_string User Token for authorization
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $did_number DID Number to renew
     * @param string $period Month(s) to renew for
     * @param string $uniq_hash Unique md5 hash (minimum 32 characters length)
     * @return mixed
     *
     * @see https://www.didww.com/api/#order_autorenew
     */
    public function orderAutorenew($auth_string, $customer_id, $did_number, $period, $uniq_hash)
    {
        return $this->_handleQuery('orderautorenew', compact(['auth_string','customer_id','did_number','period','uniq_hash']));
    }


    /**
     * This method will change/update forwarding data for DID Number.
     *
     * @param string $auth_string User Token for authorization
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $did_number DID Number
     * @param array $map_data Forwarding data
     * @return mixed
     *
     * @see https://www.didww.com/api/#update_mapping
     */
    public function updateMapping($auth_string, $customer_id, $did_number, $map_data)
    {
        return $this->_handleQuery('updatemapping', compact(['auth_string','customer_id','did_number','map_data']));
    }


    /**
     * This method will return current Prepaid Balance of customer.
     *
     * @param string $auth_string User Token for authorization
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @return mixed
     *
     * @see https://www.didww.com/api/#get_prepaid
     */
    public function getPrepaidBalance($auth_string, $customer_id)
    {
        return $this->_handleQuery('getprepaidbalance', compact(['auth_string','customer_id']));
    }


    /**
     * This method will update customer's Prepaid Balance. Add/Remove points.
     *
     * @param string $auth_string User Token for authorization
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $prepaid_funds Amount in points
     * @param int $operation_type 1 - Add funds (positive amount), 2 - Remove funds (negative amount)
     * @param string $uniq_hash Unique md5 hash (Minimum 32 characters length)
     * @return mixed
     *
     * @see https://www.didww.com/api/#update_prepaid
     */
    public function updatePrepaidBalance($auth_string, $customer_id, $prepaid_funds, $operation_type, $uniq_hash)
    {
        return $this->_handleQuery('updateprepaidbalance', compact(['auth_string','customer_id','prepaid_funds','operation_type','uniq_hash']));
    }


    /**
     * This method will restore canceled and expired DID number within aging period.
     *
     * @param string $auth_string User Token for authorization
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $did_number DID Number to be restored
     * @param int $period Period (months)
     * @param string $uniq_hash Unique md5 hash (Minimum 32 characters length)
     * @param int $isrenew If set to 1 - specified order will be renewed, if set to 0 - no.
     * @return mixed
     *
     * @see https://www.didww.com/api/#number_restore
     */
    public function didRestore($auth_string, $customer_id, $did_number, $period, $uniq_hash, $isrenew = null)
    {
        return $this->_handleQuery('didrestore', compact(['auth_string','customer_id','did_number','period','uniq_hash','isrenew']));
    }


    /**
     * This method will return configuration settings for reseller.
     *
     * @param string $auth_string User Token for authorization
     * @return mixed
     *
     * @see https://www.didww.com/api/#get_api_details
     */
    public function getDidwwApiDetails($auth_string)
    {
        return $this->_handleQuery('getdidwwapidetails', compact(['auth_string']));
    }


    /**
     * This method will return order details on the API for the component synchronization.
     *
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $api_order_id Order ID on API
     * @param string $did_number DID Number
     * @return mixed
     *
     * @see https://www.didww.com/api/#get_service_details
     */
    public function getServiceDetails($customer_id, $api_order_id, $did_number = null)
    {
        return $this->_handleQuery('getservicedetails', compact(['customer_id','api_order_id','did_number']));
    }


    /**
     * This method will return call data records for specified User, DID number, or date period.
     *
     * @param string $auth_string User Token for authorization
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $did_number DID Number
     * @param string $from_date Start date from which call records will be retrieved
     * @param string $to_date End date date to which call records will be retrieved
     * @param string $limit Maximum number of call log records to return
     * @param string $offset The offset of the position
     * @param string $order Order records by a specific field
     * @param string $order_Dir Sort rows in ascending or descending order
     * @return mixed
     *
     * @see https://www.didww.com/api/#get_cdr
     */
    public function getCdrLog($auth_string, $customer_id = null, $did_number = null, $from_date = null, $to_date = null, $limit = null, $offset = null, $order = null, $order_Dir = null)
    {
        return $this->_handleQuery('getcdrlog', compact(['auth_string','customer_id','did_number','from_date','to_date','limit','offset','order','order_Dir']));
    }


    /**
     * This method will return data for invoice generation based on CDR.
     *
     * @param string $auth_string User Token for authorization
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $from_date Start date from which call records will be retrieved
     * @param string $to_date End date date to which call records will be retrieved
     * @return mixed
     *
     * @see https://www.didww.com/api/#history_invoices
     */
    public function callHistoryInvoices($auth_string, $customer_id = null, $from_date = null, $to_date = null)
    {
        return $this->_handleQuery('callhistory_invoices', compact(['auth_string','customer_id','from_date','to_date']));
    }

}