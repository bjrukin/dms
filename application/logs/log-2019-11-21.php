<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-21 09:55:05 --> Could not find the language line "part_code"
ERROR - 2019-11-21 09:55:05 --> Could not find the language line "part_name"
ERROR - 2019-11-21 09:55:05 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 09:55:05 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 09:57:53 --> Could not find the language line "part_code"
ERROR - 2019-11-21 09:57:53 --> Could not find the language line "part_name"
ERROR - 2019-11-21 09:57:53 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 09:57:53 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 09:59:30 --> Could not find the language line "part_code"
ERROR - 2019-11-21 09:59:30 --> Could not find the language line "part_name"
ERROR - 2019-11-21 09:59:30 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 09:59:30 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 09:59:47 --> Could not find the language line "part_code"
ERROR - 2019-11-21 09:59:47 --> Could not find the language line "part_name"
ERROR - 2019-11-21 09:59:47 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 09:59:47 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 10:43:39 --> Severity: Parsing Error --> syntax error, unexpected ',' D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 69
ERROR - 2019-11-21 10:43:50 --> Severity: Parsing Error --> syntax error, unexpected ';', expecting ')' D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 73
ERROR - 2019-11-21 10:44:09 --> Severity: Notice --> Undefined index: part_code D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 67
ERROR - 2019-11-21 10:44:09 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 67
ERROR - 2019-11-21 10:44:09 --> Severity: Notice --> Undefined variable: item_data D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 82
ERROR - 2019-11-21 10:44:41 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 67
ERROR - 2019-11-21 10:44:41 --> Severity: Notice --> Undefined variable: item_data D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 82
ERROR - 2019-11-21 10:46:15 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 68
ERROR - 2019-11-21 10:46:45 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 69
ERROR - 2019-11-21 10:48:11 --> Could not find the language line "part_code"
ERROR - 2019-11-21 10:48:11 --> Could not find the language line "part_name"
ERROR - 2019-11-21 10:48:11 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 10:48:11 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 10:54:15 --> Could not find the language line "part_code"
ERROR - 2019-11-21 10:54:15 --> Could not find the language line "part_name"
ERROR - 2019-11-21 10:54:15 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 10:54:15 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 10:56:44 --> Could not find the language line "part_code"
ERROR - 2019-11-21 10:56:44 --> Could not find the language line "part_name"
ERROR - 2019-11-21 10:56:44 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 10:56:44 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 10:57:05 --> Query error: ERROR:  column "total" of relation "d2d_billing_detail" does not exist
LINE 1: ...d_date_np", "billed_to", "billed_time", "status", "total", "...
                                                             ^ - Invalid query: INSERT INTO "d2d_billing_detail" ("dealer_id", "bill_no", "billed_date", "billed_date_np", "billed_to", "billed_time", "status", "total", "created_by", "updated_by", "created_at", "updated_at") VALUES (0, '1', '2019-11-21', '2076-08-05', '83', '10:57:05', 'PENDING', 294, 1, 1, '2019-11-21 10:57:05', '2019-11-21 10:57:05')
ERROR - 2019-11-21 10:58:16 --> Could not find the language line "part_code"
ERROR - 2019-11-21 10:58:16 --> Could not find the language line "part_name"
ERROR - 2019-11-21 10:58:16 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 10:58:16 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 10:58:31 --> Severity: Notice --> Undefined index: total D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 80
ERROR - 2019-11-21 10:58:31 --> Query error: ERROR:  null value in column "id" violates not-null constraint
DETAIL:  Failing row contains (null, 1, 1, null, 2019-11-21 10:58:31, 2019-11-21 10:58:31, null, 0, 1, 2019-11-21, 2076-08-05, 83, 10:58:31, PENDING, null, null, null, 0.00). - Invalid query: INSERT INTO "d2d_billing_detail" ("dealer_id", "bill_no", "billed_date", "billed_date_np", "billed_to", "billed_time", "status", "total_amt", "created_by", "updated_by", "created_at", "updated_at") VALUES (0, '1', '2019-11-21', '2076-08-05', '83', '10:58:31', 'PENDING', 0, 1, 1, '2019-11-21 10:58:31', '2019-11-21 10:58:31')
ERROR - 2019-11-21 11:17:41 --> Severity: Notice --> Undefined index: total D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 80
ERROR - 2019-11-21 11:17:41 --> Query error: ERROR:  column "part_code" of relation "d2d_billing_list" does not exist
LINE 1: INSERT INTO "d2d_billing_list" ("part_code", "sparepart_id",...
                                        ^ - Invalid query: INSERT INTO "d2d_billing_list" ("part_code", "sparepart_id", "price", "quantity", "total_price", "bill_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('24431M78460', '23288', '294', '1', 294, '1', 1, 1, '2019-11-21 11:17:41', '2019-11-21 11:17:41')
ERROR - 2019-11-21 11:18:46 --> Severity: Notice --> Undefined index: total D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 79
ERROR - 2019-11-21 11:18:46 --> Query error: ERROR:  null value in column "id" violates not-null constraint
DETAIL:  Failing row contains (null, 1, 1, null, 2019-11-21 11:18:46, 2019-11-21 11:18:46, null, 2, 23288, 294.00, 1, 294.00). - Invalid query: INSERT INTO "d2d_billing_list" ("sparepart_id", "price", "quantity", "total_price", "bill_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('23288', '294', '1', 294, '2', 1, 1, '2019-11-21 11:18:46', '2019-11-21 11:18:46')
ERROR - 2019-11-21 11:20:19 --> Severity: Notice --> Undefined index: total D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 79
ERROR - 2019-11-21 11:21:09 --> Could not find the language line "part_code"
ERROR - 2019-11-21 11:21:09 --> Could not find the language line "part_name"
ERROR - 2019-11-21 11:21:09 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 11:21:09 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 11:58:21 --> Severity: Notice --> Undefined property: CI::$dealer_id D:\xampp\htdocs\cgdms\application\libraries\MX\Loader.php 305
ERROR - 2019-11-21 11:58:21 --> Could not find the language line "part_code"
ERROR - 2019-11-21 11:58:21 --> Could not find the language line "part_name"
ERROR - 2019-11-21 11:58:21 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 11:58:21 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 12:01:17 --> Could not find the language line "part_code"
ERROR - 2019-11-21 12:01:17 --> Could not find the language line "part_name"
ERROR - 2019-11-21 12:01:17 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 12:01:17 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 12:08:42 --> Could not find the language line "part_code"
ERROR - 2019-11-21 12:08:42 --> Could not find the language line "part_name"
ERROR - 2019-11-21 12:08:42 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 12:08:42 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 12:09:23 --> Could not find the language line "part_code"
ERROR - 2019-11-21 12:09:23 --> Could not find the language line "part_name"
ERROR - 2019-11-21 12:09:23 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 12:09:23 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 12:09:27 --> Severity: Notice --> Undefined variable: total D:\xampp\htdocs\cgdms\modules\billing_lists\controllers\Billing_lists.php 63
ERROR - 2019-11-21 12:11:47 --> Could not find the language line "part_code"
ERROR - 2019-11-21 12:11:47 --> Could not find the language line "part_name"
ERROR - 2019-11-21 12:11:47 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 12:11:47 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 12:40:29 --> Severity: Parsing Error --> syntax error, unexpected '$where' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\billing_lists\controllers\Billing_lists.php 61
ERROR - 2019-11-21 12:40:45 --> Severity: Notice --> Undefined property: CI::$billing_lists_model D:\xampp\htdocs\cgdms\application\libraries\MX\Controller.php 60
ERROR - 2019-11-21 12:40:45 --> Severity: Notice --> Indirect modification of overloaded property Billing_lists::$billing_lists_model has no effect D:\xampp\htdocs\cgdms\modules\billing_lists\controllers\Billing_lists.php 60
ERROR - 2019-11-21 12:40:45 --> Severity: Warning --> Creating default object from empty value D:\xampp\htdocs\cgdms\modules\billing_lists\controllers\Billing_lists.php 60
ERROR - 2019-11-21 12:41:38 --> Could not find the language line "part_code"
ERROR - 2019-11-21 12:41:38 --> Could not find the language line "part_name"
ERROR - 2019-11-21 12:41:38 --> Could not find the language line "dealer_price"
ERROR - 2019-11-21 12:41:38 --> Could not find the language line "dispatch_quantity"
ERROR - 2019-11-21 12:45:24 --> Could not find the language line "part_code"
ERROR - 2019-11-21 12:45:24 --> Could not find the language line "part_name"
ERROR - 2019-11-21 12:45:24 --> Could not find the language line "price"
ERROR - 2019-11-21 12:45:24 --> Could not find the language line "quantity"
ERROR - 2019-11-21 12:45:42 --> Could not find the language line "part_code"
ERROR - 2019-11-21 12:45:42 --> Could not find the language line "part_name"
ERROR - 2019-11-21 12:45:42 --> Could not find the language line "price"
ERROR - 2019-11-21 12:45:42 --> Could not find the language line "quantity"
ERROR - 2019-11-21 12:56:35 --> Could not find the language line "part_code"
ERROR - 2019-11-21 12:56:35 --> Could not find the language line "part_name"
ERROR - 2019-11-21 12:56:35 --> Could not find the language line "price"
ERROR - 2019-11-21 12:56:35 --> Could not find the language line "quantity"
ERROR - 2019-11-21 12:58:05 --> Could not find the language line "part_code"
ERROR - 2019-11-21 12:58:05 --> Could not find the language line "part_name"
ERROR - 2019-11-21 12:58:05 --> Could not find the language line "price"
ERROR - 2019-11-21 12:58:05 --> Could not find the language line "quantity"
ERROR - 2019-11-21 14:50:38 --> Could not find the language line "part_code"
ERROR - 2019-11-21 14:50:38 --> Could not find the language line "part_name"
ERROR - 2019-11-21 14:50:38 --> Could not find the language line "price"
ERROR - 2019-11-21 14:50:38 --> Could not find the language line "quantity"
ERROR - 2019-11-21 14:51:07 --> Severity: Notice --> Array to string conversion D:\xampp\htdocs\cgdms\system\database\DB_query_builder.php 669
ERROR - 2019-11-21 14:51:07 --> Query error: ERROR:  column "Array" does not exist
LINE 4: AND "id" = "Array"
                   ^ - Invalid query: SELECT *
FROM "d2d_billing_detail"
WHERE ("deleted_at" > NOW() OR "deleted_at" IS NULL)
AND "id" = "Array"
 LIMIT 1
ERROR - 2019-11-21 15:37:02 --> Could not find the language line "error"
ERROR - 2019-11-21 16:50:55 --> Query error: ERROR:  invalid input syntax for integer: ""
LINE 1: ...process" SET "id" = '15241', "msil_dispatch_id" = '', "vehic...
                                                             ^ - Invalid query: UPDATE "sales_vehicle_process" SET "id" = '15241', "msil_dispatch_id" = '', "vehicle_delivery_date" = '2019-11-21', "vehicle_delivery_date_np" = '2076-08-05', "updated_by" = 1, "updated_at" = '2019-11-21 16:50:55'
WHERE "id" = '15241'
ERROR - 2019-11-21 16:54:34 --> Could not find the language line "error"
ERROR - 2019-11-21 16:55:10 --> Could not find the language line "error"
ERROR - 2019-11-21 16:55:11 --> 404 Page Not Found: /index
ERROR - 2019-11-21 16:55:11 --> 404 Page Not Found: /index
ERROR - 2019-11-21 16:55:11 --> 404 Page Not Found: /index
ERROR - 2019-11-21 16:57:04 --> Query error: ERROR:  invalid input syntax for integer: "7890-="
LINE 1: ..., "created_at", "updated_at") VALUES ('97379', 1, '7890-=', ...
                                                             ^ - Invalid query: INSERT INTO "sales_foc_document" ("customer_id", "name_transfer", "road_tax", "created_by", "updated_by", "created_at", "updated_at") VALUES ('97379', 1, '7890-=', 1, 1, '2019-11-21 16:57:04', '2019-11-21 16:57:04')
ERROR - 2019-11-21 17:02:17 --> Could not find the language line "error"
ERROR - 2019-11-21 17:02:17 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:02:17 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:02:17 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:02:32 --> Could not find the language line "error"
ERROR - 2019-11-21 17:02:32 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:02:32 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:02:32 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:02:42 --> Could not find the language line "error"
ERROR - 2019-11-21 17:02:42 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:02:42 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:02:42 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:02:52 --> Could not find the language line "error"
ERROR - 2019-11-21 17:02:52 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:02:52 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:02:52 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:20:23 --> Could not find the language line "groups"
ERROR - 2019-11-21 17:20:23 --> Could not find the language line "permission_users"
ERROR - 2019-11-21 17:25:51 --> Query error: ERROR:  column "booked_date" does not exist
LINE 1: ...Date EN", "inquiry_date_np" AS "Inquiry Date NP", "booked_da...
                                                             ^ - Invalid query: SELECT TO_CHAR(DATE(inquiry_date_en), 'YYYY-MM') AS "Month (AD)", TO_CHAR(DATE(inquiry_date_en), 'YYYY') AS "Year (AD)", "inquiry_date_en" AS "Inquiry Date EN", "inquiry_date_np" AS "Inquiry Date NP", "booked_date" AS "Booked Date", "booking_ageing" AS "Booking Age", TO_CHAR(DATE(vehicle_delivery_date), 'YYYY-MM') AS "Retail Month (AD)", "vehicle_delivery_date" AS "Retail Date EN", SUBSTRING(inquiry_date_np FROM 1 FOR 7) AS "Month (BS)", SUBSTRING(inquiry_date_np FROM 1 FOR 4) AS "Year (BS)", "status_name" AS "Inquiry Status", "sub_status_name" AS "Inquiry Sub Status", "status_date" AS "Status Date", "executive_name" AS "Executive", "dealer_name" AS "Dealer", "vehicle_name" AS "Model", "variant_name" AS "Variant", "color_name" AS "Color", "source_name" AS "Inquiry Source", "inquiry_kind" AS "Inquiry Kind", "inquiry_type" AS "Inquiry Type", "payment_mode_name" AS "Payment Mode", "customer_type_name" AS "Customer Type", CASE WHEN bank_name IS NULL THEN 'No Data' ELSE bank_name END AS "Bank Name", CASE WHEN bank_branch IS NULL THEN 'No Data' ELSE bank_branch END AS "Branch Name", CASE WHEN bank_staff IS NULL THEN 'No Data' ELSE bank_staff END AS "Bank Staff", "full_name" AS "Customer Name", "mobile_1" AS "Mobile No", "address_1" AS "Address_1", CASE WHEN event_name IS NULL OR event_name = 'N/A' THEN ' No Event '  ELSE event_name END AS "Event"
FROM "view_inquiry_pending"
WHERE ("inquiry_date_en" >= '2019-11-01' AND "inquiry_date_en" <= '2019-11-21') AND  ("deleted_at" IS NULL)
ERROR - 2019-11-21 17:38:00 --> Query error: ERROR:  invalid input syntax for type numeric: ""
LINE 1: ...lpayment_receipt_no" = '', "fullpayment_amount" = '', "fullp...
                                                             ^ - Invalid query: UPDATE "sales_vehicle_process" SET "id" = '15241', "fullpayment_receipt_no" = '', "fullpayment_amount" = '', "fullpayment_receipt_image" = '', "fullpayment_date" = '2019-11-21', "updated_by" = 1, "updated_at" = '2019-11-21 17:38:00'
WHERE "id" = '15241'
ERROR - 2019-11-21 17:40:14 --> Could not find the language line "success_message"
ERROR - 2019-11-21 17:40:46 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\customers\views\admin\quotation.php 234
ERROR - 2019-11-21 17:40:46 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\customers\views\admin\quotation.php 234
ERROR - 2019-11-21 17:40:46 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:40:46 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:41:14 --> Could not find the language line "followup_mode"
ERROR - 2019-11-21 17:41:14 --> Could not find the language line "followup_status"
ERROR - 2019-11-21 17:41:14 --> Could not find the language line "followup_notes"
ERROR - 2019-11-21 17:41:14 --> Could not find the language line "next_followup"
ERROR - 2019-11-21 17:41:14 --> Could not find the language line "remarks"
ERROR - 2019-11-21 17:41:14 --> Could not find the language line "new_discount"
ERROR - 2019-11-21 17:41:14 --> Could not find the language line "new_discount"
ERROR - 2019-11-21 17:41:14 --> Could not find the language line "customer_followups"
ERROR - 2019-11-21 17:41:14 --> Could not find the language line "customer_followups"
ERROR - 2019-11-21 17:45:43 --> 404 Page Not Found: /index
ERROR - 2019-11-21 17:48:51 --> Severity: Warning --> unlink(D:/xampp/htdocs/uploads/customer/97379/0-02-03-1c1e9b079d6989609f00248b504d743be30ea07856774c8d57a467ba9f8f3cef_b517a6f2.jpg): No such file or directory D:\xampp\htdocs\cgdms\modules\customers\controllers\Customers.php 1061
ERROR - 2019-11-21 20:07:09 --> Severity: Parsing Error --> syntax error, unexpected '$data' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 135
ERROR - 2019-11-21 20:57:45 --> Severity: Parsing Error --> syntax error, unexpected '$data' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 135
ERROR - 2019-11-21 23:24:04 --> Severity: Parsing Error --> syntax error, unexpected '$data' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 135
ERROR - 2019-11-21 23:29:00 --> Severity: Parsing Error --> syntax error, unexpected '$data' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 135
