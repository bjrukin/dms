<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| APP CONFIG
|--------------------------------------------------------------------------
*/
$config['site_name'] = 'CG DMS';

$config['site_name_short'] = 'CG DMS';

// Public Template
$config['template_public'] = "public/";

// Admin Template
$config['template_admin'] = "admin/";

// Default Login
$config['default_login_action'] = 'dashboard';

// Admin Login Actin
$config['admin_login_action'] = 'admin';

// Default Logout Action
$config['default_logout_action'] = '';


/*
|--------------------------------------------------------------------------
| APP CONSTANTS
|--------------------------------------------------------------------------
*/
defined('DEFAULT_PASSWORD') 					OR define('DEFAULT_PASSWORD', 'password');

defined('CACHE_PATH') 							OR define('CACHE_PATH', APPPATH .'cache'. DIRECTORY_SEPARATOR);

defined('ADMIN_GROUP') 							OR define('ADMIN_GROUP', '100');

defined('MANAGER_GROUP') 						OR define('MANAGER_GROUP', '200');
defined('MANAGER_STAFF_GROUP') 						OR define('MANAGER_STAFF_GROUP', '2005');

defined('RETAIL_FINANCE_GROUP') 				OR define('RETAIL_FINANCE_GROUP', '300');

defined('DEALER_INCHARGE_GROUP') 				OR define('DEALER_INCHARGE_GROUP', '400');

defined('SHOWROOM_INCHARGE_GROUP') 				OR define('SHOWROOM_INCHARGE_GROUP', '500');

defined('SALES_EXECUTIVE_GROUP') 				OR define('SALES_EXECUTIVE_GROUP', '600');

defined('CREDIT_CONTROL_GROUP') 				OR define('CREDIT_CONTROL_GROUP', '1100');

defined('SALES_HEAD_GROUP') 					OR define('SALES_HEAD_GROUP', '900');

defined('SPAREPART_INCHARGE_GROUP') 			OR define('SPAREPART_INCHARGE_GROUP', '700');

defined('SPAREPART_DEALER_GROUP') 				OR define('SPAREPART_DEALER_GROUP', '702');

defined('SPAREPART_DEALER_INCHARGE_GROUP') 		OR define('SPAREPART_DEALER_INCHARGE_GROUP', '701');

defined('SPAREPART_VENDOR_GROUP') 				OR define('SPAREPART_VENDOR_GROUP', '1100');

defined('LOGISTIC_GROUP') 						OR define('LOGISTIC_GROUP', '1200');

defined('LOGISTIC_USER') 						OR define('LOGISTIC_USER', '7');

defined('WORKSHOP_MANAGER') 					OR define('WORKSHOP_MANAGER', '807');


defined('REASON_OTHER_BANK')					OR define('REASON_OTHER_BANK', 'Other Bank');

defined('REASON_RETAIL') 						OR define('REASON_RETAIL', 'Retail');

defined('REASON_LOST') 							OR define('REASON_LOST', 'Lost');

defined('REASON_CANCEL') 						OR define('REASON_CANCEL', 'Cancel');

defined('REASON_CLOSED')						OR define('REASON_CLOSED', 'Closed');

defined('REASON_REJECT_1')						OR define('REASON_REJECT_1', 'Reject Before');

defined('REASON_REJECT_2')						OR define('REASON_REJECT_2', 'Reject After');

defined('REASON_DELIVERY')						OR define('REASON_DELIVERY', 'Delivery');

defined('FOLLOWUP_STATUS_OPEN')					OR define('FOLLOWUP_STATUS_OPEN', 'Open');

defined('FOLLOWUP_STATUS_COMPLETED')			OR define('FOLLOWUP_STATUS_COMPLETED', 'Completed');

defined('STATUS_PENDING') 						OR define('STATUS_PENDING', 1);

defined('STATUS_CONFIRMED') 					OR define('STATUS_CONFIRMED', 2);

defined('STATUS_BOOKED') 						OR define('STATUS_BOOKED', 3);

defined('STATUS_QUOTATION_ISSUED') 				OR define('STATUS_QUOTATION_ISSUED', 4);

defined('STATUS_REJECT_BEFORE') 				OR define('STATUS_REJECT_BEFORE', 5);

defined('STATUS_DOCUMENT_COMPLETE') 			OR define('STATUS_DOCUMENT_COMPLETE', 6);

defined('STATUS_REJECT_AFTER') 					OR define('STATUS_REJECT_AFTER', 7);

defined('STATUS_DO_APPROVAL') 					OR define('STATUS_DO_APPROVAL', 8);

defined('STATUS_VEHICLE_DELIVER_WITH_DO')		OR define('STATUS_VEHICLE_DELIVER_WITH_DO', 9);

defined('STATUS_VEHICLE_DELIVER_WITHOUT_DO')	OR define('STATUS_VEHICLE_DELIVER_WITHOUT_DO', 10);

defined('STATUS_WAITING_FOR_DO') 				OR define('STATUS_WAITING_FOR_DO', 11);

defined('STATUS_OWNERSHIP_TRANSFER') 			OR define('STATUS_OWNERSHIP_TRANSFER', 12);

defined('STATUS_SEND_FOR_PAYMENT') 				OR define('STATUS_SEND_FOR_PAYMENT', 13);

defined('STATUS_PAYMENT_RECEIVED') 				OR define('STATUS_PAYMENT_RECEIVED', 14);

defined('STATUS_RETAIL') 						OR define('STATUS_RETAIL', 15);

defined('STATUS_LOST') 							OR define('STATUS_LOST', 16);

defined('STATUS_CANCEL') 						OR define('STATUS_CANCEL', 17);

defined('STATUS_CLOSED') 						OR define('STATUS_CLOSED', 18);

defined('STATUS_BOOKING_CANCEL') 				OR define('STATUS_BOOKING_CANCEL', 19);

defined('CUSTOMER_TYPE_FIRST')					OR define('CUSTOMER_TYPE_FIRST', 1);

defined('CUSTOMER_TYPE_ADDITIONAL')				OR define('CUSTOMER_TYPE_ADDITIONAL', 2);

defined('CUSTOMER_TYPE_XCHG_SUZUKI')			OR define('CUSTOMER_TYPE_XCHG_SUZUKI', 3);

defined('CUSTOMER_TYPE_XCHG_OTHERS')			OR define('CUSTOMER_TYPE_XCHG_OTHERS', 4);


defined('CUSTOMER_TYPE_XCHG_BIKE')				OR define('CUSTOMER_TYPE_XCHG_BIKE', 5);

defined('SOURCE_WALKIN')						OR define('SOURCE_WALKIN', 1);

defined('PAYMENT_MODE_CASH')					OR define('PAYMENT_MODE_CASH', 1);

defined('PAYMENT_MODE_FINANCE')					OR define('PAYMENT_MODE_FINANCE', 2);

defined('PAYMENT_MODE_XCHG')					OR define('PAYMENT_MODE_XCHG', 3);

defined('OTHER_BANK_ID')						OR define('OTHER_BANK_ID', 99999);

defined('DEALER_EMPLOYEE')						OR define('DEALER_EMPLOYEE',0);

defined('WORKSHOP_EMPLOYEE')					OR define('WORKSHOP_EMPLOYEE',1);

defined('DISCOUNT_APPROVED')					OR define('DISCOUNT_APPROVED',1);
defined('DISCOUNT_REJECTED')					OR define('DISCOUNT_REJECTED',2);
defined('DISCOUNT_REDUCED')						OR define('DISCOUNT_REDUCED',3);
defined('DISCOUNT_FORWARD')						OR define('DISCOUNT_FORWARD',4);

defined('VAT_PERCENTAGE')						OR define('VAT_PERCENTAGE', 13);


defined('SERVICE_HEAD_GROUP')					OR define('SERVICE_HEAD_GROUP', 800);
defined('FLOOR_SUPERVISOR_GROUP')				OR define('FLOOR_SUPERVISOR_GROUP', 801);
defined('SERVICE_ADVISOR_GROUP')				OR define('SERVICE_ADVISOR_GROUP', 804);
defined('SERVICE_ACCOUNTANT_GROUP')				OR define('SERVICE_ACCOUNTANT_GROUP', 805);
defined('SERVICE_DEALER_INCHARGE')				OR define('SERVICE_DEALER_INCHARGE', 809);
defined('MATERIAL_ISSUE_GROUP')					OR define('MATERIAL_ISSUE_GROUP', 810);
defined('NATIONAL_SERVICE_MANAGER')				OR define('NATIONAL_SERVICE_MANAGER', 1400);
defined('SERVICE_FINANCE')						OR define('SERVICE_FINANCE', 1700);
defined('SERVICE_MANAGEMENT')					OR define('SERVICE_MANAGEMENT', 1702);

defined('JOB_CLOSE')							OR define('JOB_CLOSE', 1);
defined('JOB_REOPEN')							OR define('JOB_REOPEN', 0);

defined('MECHANIC_LEADER')						OR define('MECHANIC_LEADER', 11);
defined('MECHANICS')							OR define('MECHANICS', 12);
defined('CLEANERS')								OR define('CLEANERS', 16);
defined('WASHING')								OR define('WASHING', 16);
defined('PAINTER')								OR define('PAINTER', 17);
defined('DENTER')								OR define('DENTER', 18);
defined('LOCAL_PARTS') 							OR define('LOCAL_PARTS', 4);

/*SMS TEMPLATES*/
defined('SMS_JOB_CLOSE')						OR define('SMS_JOB_CLOSE', 1);
/*SMS TEMPLATES ENDS*/

defined('LOGISTIC_GROUP') 						OR define('LOGISTIC_GROUP', '7');
defined('LOGISTIC_EXECUTIVE_GROUP') 			OR define('LOGISTIC_EXECUTIVE_GROUP', '14');
defined('SPAREPART_INCHARGE_GROUP') 			OR define('SPAREPART_INCHARGE_GROUP', '700');

defined('SPAREPART_DEALER_GROUP') 				OR define('SPAREPART_DEALER_GROUP', '1000');
defined('SPAREPART_DEALER_INCHARGE') 				OR define('SPAREPART_DEALER_INCHARGE', '1100');
defined('PICKER_GROUP') 						OR define('PICKER_GROUP', '21');

defined('CCD_INQUIRY_GENERATED') 				OR define('CCD_INQUIRY_GENERATED', '25');

defined('CCD_INQUIRY_WALK_REFERRAL') 			OR define('CCD_INQUIRY_WALK_REFERRAL', '26');

defined('PDI_INSPECTOR') 						OR define('PDI_INSPECTOR', '9');

defined('ENABLE_SERVICE_TESTING') 				OR define('ENABLE_SERVICE_TESTING', 0);
defined('TAXI_SALE') 							OR define('TAXI_SALE', 75);
defined('AIT_PULCHOWK') 						OR define('AIT_PULCHOWK', 2);
defined('AIT_THAPATHALI') 						OR define('AIT_THAPATHALI', 1);
defined('SPAREPART_EXECUTIVE') 					OR define('SPAREPART_EXECUTIVE', 703);
defined('YATAYAT_GROUP') 						OR define('YATAYAT_GROUP', 1605);
defined('WARRANTY_USER') 						OR define('WARRANTY_USER', 1701);
defined('ARO') 									OR define('ARO', 704);
defined('CCD_INCHARGE') 						OR define('CCD_INCHARGE', 1600);
defined('CCD_EXECUTIVE') 						OR define('CCD_EXECUTIVE', 1601);
defined('CG_SPAREPART_OUTLET') 					OR define('CG_SPAREPART_OUTLET', 705);


defined('DALLU_DEALER') 						OR define('DALLU_DEALER', 120);
defined('ULTRA_SYNTHETIC') 						OR define('ULTRA_SYNTHETIC', 110747);
defined('SYNTHETIC') 							OR define('SYNTHETIC', 110747);
defined('NORMAL') 								OR define('NORMAL', 110746);
defined('EXECUTIVE_DIRECTOR') 								OR define('EXECUTIVE_DIRECTOR', 112);
// defined('EXECUTIVE_DIRECTOR') 					OR define('EXECUTIVE_DIRECTOR', 583);

defined('PENDING') 								OR define('PENDING', 'PENDING');
defined('APPROVE') 								OR define('APPROVE', 'APPROVE');
defined('REJECT') 								OR define('REJECT', 'REJECT');