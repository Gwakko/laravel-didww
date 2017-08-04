<?php 

namespace Didww\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed getDidwwRegions($auth_string, $country_iso = null, $city_prefix = null, $last_request_gmt = null)
 * @method static mixed getDidwwPstnRates($auth_string, $country_iso = null, $pstn_prefix = null, $last_request_gmt = null)
 * @method static mixed updatePstnRates($auth_string, $rates)
 * @method static mixed checkPstnNumber($auth_string, $pstn_number)
 * @method static mixed orderCreate($auth_string, $customer_id, $country_iso, $city_prefix, $period, $map_data, $prepaid_funds, $uniq_hash, $city_id, $autorenew_enable = null)
 * @method static mixed orderCancel($auth_string, $customer_id, $did_number)
 * @method static mixed orderAutorenew($auth_string, $customer_id, $did_number, $period, $uniq_hash)
 * @method static mixed updateMapping($auth_string, $customer_id, $did_number, $map_data)
 * @method static mixed getPrepaidBalance($auth_string, $customer_id)
 * @method static mixed updatePrepaidBalance($auth_string, $customer_id, $prepaid_funds, $operation_type, $uniq_hash)
 * @method static mixed didRestore($auth_string, $customer_id, $did_number, $period, $uniq_hash, $isrenew = null)
 * @method static mixed getDidwwApiDetails($auth_string)
 * @method static mixed getServiceDetails($customer_id, $api_order_id, $did_number = null)
 * @method static mixed getCdrLog($auth_string, $customer_id = null, $did_number = null, $from_date = null, $to_date = null, $limit = null, $offset = null, $order = null, $order_Dir = null)
 * @method static mixed callHistoryInvoices($auth_string, $customer_id = null, $from_date = null, $to_date = null)
 *
 * @see \Didww\Core
 * @see \Didww\Didww
 * @see \Didww\Facades\Didww
 */
class Didww extends Facade {

	/**
	 * Get the registered name of the component
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'didww'; }
}