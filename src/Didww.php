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
     * This method will ...
     *
     * @param string $country_iso Country ISO Code
     * @param string $city_prefix City Prefix
     * @param string $city_id City ID
     * @return mixed
     *
     * @see https://www.didww.com/api/
     */
    public function getCoverage($country_iso = null, $city_prefix = null, $city_id = null)
    {
        return $this->_handleQuery('getcoverage', compact(['country_iso','city_prefix','city_id']));
    }

    /**
     * This method will return list of regions from DIDWW coverage list.
     *
     * @param string $country_iso Country ISO Code
     * @param string $city_prefix City Prefix
     * @param string $last_request_gmt Date in UNIXTIME GMT format. Get list of updated regions starting from date of the last request
     * @return mixed
     *
     * @see https://www.didww.com/api/#get_didww_regions
     */
    public function getDidwwRegions($country_iso = null, $city_prefix = null, $last_request_gmt = null)
    {
        return $this->_handleQuery('getdidwwregions', compact(['country_iso','city_prefix','last_request_gmt']));
    }

    /**
     * This method will return list of available countries from DIDWW coverage list.
     *
     * @param string $country_iso Country ISO Code
     * @return mixed
     *
     * @see https://www.didww.com/api/#get_countries
     */
    public function getDidwwCountries($country_iso = null)
    {
        return $this->_handleQuery('getdidwwcountries', compact(['country_iso']));
    }

    /**
     * This method will return list of cities from DIDWW coverage list.
     *
     * @param string $country_iso Country ISO Code
     * @param string $city_id City ID
     * @param int $active 1 - returns cities with available DID numbers, 0 - all cities will be returned
     * @return mixed
     *
     * @see https://www.didww.com/api/#get_cities
     */
    public function getDidwwCities($country_iso = null, $city_id = null, $active = null)
    {
        return $this->_handleQuery('getdidwwcities', compact(['country_iso','city_id','active']));
    }


    /**
     * This method will return list of supported PSTN prefixes from DIDWW.
     *
     * @param string $country_iso Country ISO Code
     * @param string $pstn_prefix PSTN Prefix
     * @param string $last_request_gmt Date in UNIXTIME GMT format. Get list of updated PSTN Rates starting from date of the last request
     * @return mixed
     *
     * @see https://www.didww.com/api/#get_didww_pstn
     */
    public function getDidwwPstnRates($country_iso = null, $pstn_prefix = null, $last_request_gmt = null)
    {
        return $this->_handleQuery('getdidwwpstnrates', compact(['country_iso','pstn_prefix','last_request_gmt']));
    }


    /**
     * This method will change PSTN tariffs for resellers through their Staff panel.
     *
     * @param array $rates Rate List
     * @return mixed
     *
     * @see https://www.didww.com/api/#update_pstn
     */
    public function updatePstnRates($rates)
    {
        return $this->_handleQuery('updatepstnrates', compact(['rates']));
    }


    /**
     * This method will return PSTN traffic.
     *
     * @param string $from_date
     * @param string $to_date
     * @return mixed
     *
     * @see https://www.didww.com/api/
     */
    public function pstnTraffic($from_date, $to_date)
    {
        return $this->_handleQuery('pstn_traffic', compact(['from_date','to_date']));
    }


    /**
     * This method will validate a PSTN Number.
     *
     * @param string $pstn_number PSTN number
     * @return mixed
     *
     * @see https://www.didww.com/api/#check_pstn
     */
    public function checkPstnNumber($pstn_number)
    {
        return $this->_handleQuery('checkpstnnumber', compact(['pstn_number']));
    }


    /**
     * This method will purchase new service.
     *
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
    public function orderCreate($customer_id, $country_iso, $city_prefix, $period, $map_data, $prepaid_funds, $uniq_hash, $city_id, $autorenew_enable = null)
    {
        return $this->_handleQuery('ordercreate', compact(['customer_id','country_iso','city_prefix','period','map_data','prepaid_funds','uniq_hash','city_id','autorenew_enable']));
    }


    /**
     * This method will cancel order and remove purchased services.
     *
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $did_number DID number to cancel
     * @return mixed
     *
     * @see https://www.didww.com/api/#order_cancel
     */
    public function orderCancel($customer_id, $did_number)
    {
        return $this->_handleQuery('ordercancel', compact(['customer_id','did_number']));
    }


    /**
     * This method will renew active service for specific period.
     *
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $did_number DID Number to renew
     * @param string $period Month(s) to renew for
     * @param string $uniq_hash Unique md5 hash (minimum 32 characters length)
     * @return mixed
     *
     * @see https://www.didww.com/api/#order_autorenew
     */
    public function orderAutorenew($customer_id, $did_number, $period, $uniq_hash)
    {
        return $this->_handleQuery('orderautorenew', compact(['customer_id','did_number','period','uniq_hash']));
    }


    /**
     * This method will ...
     *
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $did_number DID Number
     * @param int $status ...
     * @return mixed
     *
     * @see https://www.didww.com/api/
     */
    public function orderAutorenewStatus($customer_id, $did_number, $status)
    {
        return $this->_handleQuery('order_autorenew_status', compact(['customer_id','did_number','status']));
    }


    /**
     * This method will change/update forwarding data for DID Number.
     *
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $did_number DID Number
     * @param array $map_data Forwarding data
     * @return mixed
     *
     * @see https://www.didww.com/api/#update_mapping
     */
    public function updateMapping($customer_id, $did_number, $map_data)
    {
        return $this->_handleQuery('updatemapping', compact(['customer_id','did_number','map_data']));
    }


    /**
     * This method will return array of balances of all customers.
     *
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @return mixed
     *
     * @see https://www.didww.com/api/#prepaid_balance
     */
    public function getPrepaidBalanceList($customer_id)
    {
        return $this->_handleQuery('getprepaidbalancelist', compact(['customer_id']));
    }


    /**
     * This method will return current Prepaid Balance of customer.
     *
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @return mixed
     *
     * @see https://www.didww.com/api/#get_prepaid
     */
    public function getPrepaidBalance($customer_id)
    {
        return $this->_handleQuery('getprepaidbalance', compact(['customer_id']));
    }


    /**
     * This method will update customer's Prepaid Balance. Add/Remove points.
     *
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $prepaid_funds Amount in points
     * @param int $operation_type 1 - Add funds (positive amount), 2 - Remove funds (negative amount)
     * @param string $uniq_hash Unique md5 hash (Minimum 32 characters length)
     * @return mixed
     *
     * @see https://www.didww.com/api/#update_prepaid
     */
    public function updatePrepaidBalance($customer_id, $prepaid_funds, $operation_type, $uniq_hash)
    {
        return $this->_handleQuery('updateprepaidbalance', compact(['customer_id','prepaid_funds','operation_type','uniq_hash']));
    }


    /**
     * This method will restore canceled and expired DID number within aging period.
     *
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $did_number DID Number to be restored
     * @param int $period Period (months)
     * @param string $uniq_hash Unique md5 hash (Minimum 32 characters length)
     * @param int $isrenew If set to 1 - specified order will be renewed, if set to 0 - no.
     * @return mixed
     *
     * @see https://www.didww.com/api/#number_restore
     */
    public function didRestore($customer_id, $did_number, $period, $uniq_hash, $isrenew = null)
    {
        return $this->_handleQuery('didrestore', compact(['customer_id','did_number','period','uniq_hash','isrenew']));
    }


    /**
     * This method will return configuration settings for reseller.
     *
     * @return mixed
     *
     * @see https://www.didww.com/api/#get_api_details
     */
    public function getDidwwApiDetails()
    {
        return $this->_handleQuery('getdidwwapidetails');
    }


    /**
     * This method will return list of orders for given customer.
     *
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @return mixed
     *
     * @see https://www.didww.com/api/#get_service_list
     */
    public function getServiceList($customer_id)
    {
        return $this->_handleQuery('getservicelist', compact(['customer_id']));
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
    public function getCdrLog($customer_id = null, $did_number = null, $from_date = null, $to_date = null, $limit = null, $offset = null, $order = null, $order_Dir = null)
    {
        return $this->_handleQuery('getcdrlog', compact(['customer_id','did_number','from_date','to_date','limit','offset','order','order_Dir']));
    }


    /**
     * This method will return call data records for specified User, DID number, or date period.
     *
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $from_date Start date from which call records will be retrieved
     * @param string $to_date End date date to which call records will be retrieved
     * @param string $destination ...
     * @param string $source ...
     * @param int $success ...
     * @param string $limit Maximum number of call log records to return
     * @param string $offset The offset of the position
     * @param string $order Order records by a specific field
     * @param string $order_Dir Sort rows in ascending or descending order
     * @return mixed
     *
     * @see https://www.didww.com/api/
     */
    public function getSMSLog($customer_id = null, $from_date = null, $to_date = null, $destination = null, $source = null, $success = null, $limit = null, $offset = null, $order = null, $order_Dir = null)
    {
        return $this->_handleQuery('getsmslog', compact(['customer_id','from_date','to_date','destination','source','success','limit','offset','order','order_Dir']));
    }


    /**
     * This method will return data for invoice generation based on CDR.
     *
     * @param string $customer_id Customer ID (from your local database, any digit)
     * @param string $from_date Start date from which call records will be retrieved
     * @param string $to_date End date date to which call records will be retrieved
     * @return mixed
     *
     * @see https://www.didww.com/api/#history_invoices
     */
    public function callHistoryInvoices($customer_id = null, $from_date = null, $to_date = null)
    {
        return $this->_handleQuery('callhistory_invoices', compact(['customer_id','from_date','to_date']));
    }


    /**
     * This method will ...
     *
     * @param int $month
     * @param int $year
     * @return mixed
     *
     * @see https://www.didww.com/api/
     */
    public function getInvoiceDetails($month = null, $year = null)
    {
        return $this->_handleQuery('getinvoicedetails', compact(['month','year']));
    }

}