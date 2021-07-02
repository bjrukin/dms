<?php
header('Content-type: application/javascript');


$cache_json_files   = array();
$cache_json_files['districts'] = "districts.json";
$cache_json_files['colors'] = "mst_colors.json";
$cache_json_files['customer_types'] = "mst_customer_types.json";
$cache_json_files['designations'] = "mst_designations.json";
$cache_json_files['educations'] = "mst_educations.json";
$cache_json_files['inquiry_statuses'] = "mst_inquiry_statuses.json";
$cache_json_files['institutions'] = "mst_institutions.json";
$cache_json_files['occupations'] = "mst_occupations.json";
$cache_json_files['payment_modes'] = "mst_payment_modes.json";
$cache_json_files['reasons'] = "mst_reasons.json";
$cache_json_files['relations'] = "mst_relations.json";
$cache_json_files['sources'] = "mst_sources.json";
$cache_json_files['titles'] = "mst_titles.json";
$cache_json_files['vehicles'] = "mst_vehicles.json";
$cache_json_files['walkin_sources'] = "mst_walkin_sources.json";


defined('REASON_OTHER_BANK')		OR define('REASON_OTHER_BANK', 'Other Bank');

defined('REASON_RETAIL') 			OR define('REASON_RETAIL', 'Retail');

defined('REASON_LOST') 				OR define('REASON_LOST', 'Lost');

defined('REASON_CANCEL') 			OR define('REASON_CANCEL', 'Cancel');

defined('REASON_CLOSED')			OR define('REASON_CLOSED', 'Closed');

defined('REASON_REJECT_1')			OR define('REASON_REJECT_1', 'Reject Before');

defined('REASON_REJECT_2')			OR define('REASON_REJECT_2', 'Reject After');

defined('REASON_DELIVERY')			OR define('REASON_DELIVERY', 'Delivery');

$js_var = '';

foreach ($cache_json_files as $key =>$filename) {
	$file = '../../application/cache/' . $filename;
	if (file_exists($file)) {
		$js_var[] = "array_{$key} = " . file_get_contents($file) ;
    }
}

$js_var[] = sprintf("array_types = ['%s','%s', '%s', '%s', '%s', '%s', '%s', '%s']", REASON_OTHER_BANK, REASON_RETAIL, REASON_LOST, REASON_CANCEL, REASON_CLOSED, REASON_REJECT_1, REASON_REJECT_2, REASON_DELIVERY);
$js_var[] = "array_gender = ['Not Specified','Male','Female', 'Others']";
$js_var[] = "array_marital_status = ['Not Specified','Single','Marrried', 'Others']";
$js_var[] = "array_family_size = ['Not Specified','Nuclear','Joint']";
$js_var[] = "array_decisions = ['Select option','Yes','No']";
$js_var[] = "array_satisfaction = ['Select option','Excellent','Good','Average','Bad','Poor']";
$js_var[] = "array_ccd_remarks = ['Select option','Satisfied','Unsatisfied']";
$js_var[] = "array_ccd_call_status = ['Connected','Didn’t answer','Switched off','Number busy','Invalid Number','Not Reachable']";
$js_var[] = "array_accident_type = ['Select option','MINOR','MEDIUM','MAJOR']";

echo "var ";
echo implode(",\r\n", $js_var);
echo ";";