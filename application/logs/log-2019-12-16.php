<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-16 09:32:24 --> Query error: ERROR:  relation "view_billing_details" does not exist
LINE 2: FROM "view_billing_details"
             ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "view_billing_details"
WHERE "dealer_id" =0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2019-12-16 09:36:52 --> Could not find the language line "part"
ERROR - 2019-12-16 09:38:14 --> Query error: ERROR:  relation "view_billing_details" does not exist
LINE 2: FROM "view_billing_details"
             ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "view_billing_details"
WHERE "dealer_id" =0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2019-12-16 09:40:18 --> Query error: ERROR:  relation "view_billing_details" does not exist
LINE 2: FROM "view_billing_details"
             ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "view_billing_details"
WHERE "dealer_id" =0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2019-12-16 09:45:59 --> Query error: ERROR:  relation "view_billing_details" does not exist
LINE 2: FROM "view_billing_details"
             ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "view_billing_details"
WHERE "dealer_id" =0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2019-12-16 09:46:06 --> Query error: ERROR:  relation "view_billing_details" does not exist
LINE 2: FROM "view_billing_details"
             ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "view_billing_details"
WHERE "dealer_id" =0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2019-12-16 10:01:29 --> Severity: Warning --> fsockopen(): php_network_getaddresses: getaddrinfo failed: No such host is known.  D:\xampp\htdocs\cgdms\system\libraries\Email.php 1990
ERROR - 2019-12-16 10:01:29 --> Severity: Warning --> fsockopen(): unable to connect to mail.cg.holding:465 (php_network_getaddresses: getaddrinfo failed: No such host is known. ) D:\xampp\htdocs\cgdms\system\libraries\Email.php 1990
ERROR - 2019-12-16 11:02:28 --> Severity: Parsing Error --> syntax error, unexpected '}' D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 376
ERROR - 2019-12-16 11:04:01 --> 404 Page Not Found: /index
ERROR - 2019-12-16 12:07:52 --> Severity: Error --> Call to undefined function is_ccd_incharge() D:\xampp\htdocs\cgdms\modules\service_reports\views\admin\billing_summary.php 36
ERROR - 2019-12-16 12:08:09 --> Could not find the language line "part"
ERROR - 2019-12-16 12:10:35 --> Could not find the language line "part"
ERROR - 2019-12-16 12:10:45 --> Could not find the language line "part"
ERROR - 2019-12-16 12:14:29 --> Could not find the language line "sparepart_id"
ERROR - 2019-12-16 12:15:00 --> Severity: Error --> Maximum execution time of 30 seconds exceeded D:\xampp\htdocs\cgdms\application\core\MY_Model.php 291
ERROR - 2019-12-16 12:15:10 --> Could not find the language line "sparepart_id"
ERROR - 2019-12-16 12:15:40 --> Severity: Error --> Maximum execution time of 30 seconds exceeded D:\xampp\htdocs\cgdms\application\core\MY_Model.php 291
ERROR - 2019-12-16 12:42:40 --> Severity: Notice --> Undefined property: CI::$fiscalyear D:\xampp\htdocs\cgdms\application\libraries\MX\Controller.php 60
ERROR - 2019-12-16 13:05:55 --> Severity: Notice --> Undefined variable: data D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 382
ERROR - 2019-12-16 13:05:55 --> Query error: ERROR:  column "vat_percentage" of relation "ser_billing_record" does not exist
LINE 1: ...group", "bill_type", "issue_date", "total_parts", "vat_perce...
                                                             ^ - Invalid query: INSERT INTO "ser_billing_record" ("invoice_no", "jobcard_group", "bill_type", "issue_date", "total_parts", "vat_percentage", "net_total", "dealer_id", "fiscal_year_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('2019-12-16', 0, 'dealer_to_dealer', '2019-12-16', '213.00', 13, 240.69, 81, 4, 632, 632, '2019-12-16 13:05:55', '2019-12-16 13:05:55')
ERROR - 2019-12-16 13:08:48 --> Severity: Parsing Error --> syntax error, unexpected '$data' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 390
ERROR - 2019-12-16 13:09:15 --> Query error: ERROR:  column "vat_percentage" of relation "ser_billing_record" does not exist
LINE 1: ...group", "bill_type", "issue_date", "total_parts", "vat_perce...
                                                             ^ - Invalid query: INSERT INTO "ser_billing_record" ("invoice_no", "jobcard_group", "bill_type", "issue_date", "total_parts", "vat_percentage", "net_total", "dealer_id", "fiscal_year_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('2019-12-16', 0, 'dealer_to_dealer', '2019-12-16', '213.00', 13, 240.69, 81, 4, 632, 632, '2019-12-16 13:09:15', '2019-12-16 13:09:15')
ERROR - 2019-12-16 14:54:05 --> Severity: Error --> Call to undefined method Billing_details::get_current_year() D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 382
ERROR - 2019-12-16 14:54:17 --> Severity: Error --> Call to undefined method Billing_details::get_currentyear() D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 382
ERROR - 2019-12-16 15:40:07 --> Query error: ERROR:  syntax error at end of input
LINE 8:             GROUP BY
                            ^ - Invalid query: SELECT dealer_name, CASE WHEN nepali_edit_month_id IS NOT NULL THEN nepali_edit_month_id ELSE retail_month_id :: INTEGER END AS retail_month_id, COUNT (retail_month_id) view_retail_report WHERE vehicle_delivery_date >= '.2019-07-17.'
            AND vehicle_delivery_date <= '2020-07-15'
            AND (
                (retail_month_id = '8' AND nepali_edit_month_id IS NULL)
                OR
                (nepali_edited_month_retail = '8')
            )
            GROUP BY
ERROR - 2019-12-16 15:41:29 --> Query error: ERROR:  column "dealer_name" does not exist
LINE 1: SELECT dealer_name, CASE WHEN nepali_edit_month_id IS NOT NU...
               ^ - Invalid query: SELECT dealer_name, CASE WHEN nepali_edit_month_id IS NOT NULL THEN nepali_edit_month_id ELSE retail_month_id :: INTEGER END AS retail_month_id, COUNT (retail_month_id) view_retail_report WHERE vehicle_delivery_date >= '.2019-07-17.'
            AND vehicle_delivery_date <= '2020-07-15'
            AND (
                (retail_month_id = '8' AND nepali_edit_month_id IS NULL)
                OR
                (nepali_edited_month_retail = '8')
            )
            GROUP BY 1,2
ERROR - 2019-12-16 15:44:30 --> Query error: ERROR:  invalid input syntax for type date: ".2019-07-17."
LINE 1: ...view_retail_report WHERE vehicle_delivery_date >= '.2019-07-...
                                                             ^ - Invalid query: SELECT dealer_name, CASE WHEN nepali_edit_month_id IS NOT NULL THEN nepali_edit_month_id ELSE retail_month_id :: INTEGER END AS retail_month_id, COUNT (retail_month_id) FROM view_retail_report WHERE vehicle_delivery_date >= '.2019-07-17.'
            AND vehicle_delivery_date <= '2020-07-15'
            AND (
                (retail_month_id = '8' AND nepali_edit_month_id IS NULL)
                OR
                (nepali_edited_month_retail = '8')
            )
            GROUP BY 1,2
ERROR - 2019-12-16 15:55:56 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:56 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:56 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:56 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:56 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:57 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:58 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:55:59 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:16 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:16 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:16 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:16 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:16 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:16 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:16 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:16 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:17 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:18 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1494
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:56:19 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:35 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:36 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 15:58:37 --> Severity: Notice --> Undefined index: retail_tilldate D:\xampp\htdocs\cgdms\modules\stock_records\controllers\Stock_records.php 1504
ERROR - 2019-12-16 16:09:46 --> Query error: ERROR:  syntax error at or near "("
LINE 1: SELECT "dealer_name" COUNT (retail_month_id) as retail FROM ...
                                   ^ - Invalid query: SELECT "dealer_name" COUNT (retail_month_id) as retail FROM "view_retail_report" WHERE vehicle_delivery_date = '2019-12-16' GROUP BY 1,2
ERROR - 2019-12-16 16:25:55 --> Severity: Error --> Call to undefined method Billing_details::currentyear() D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 382
ERROR - 2019-12-16 16:26:42 --> Severity: Parsing Error --> syntax error, unexpected ';' D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 382
ERROR - 2019-12-16 16:27:20 --> Query error: ERROR:  column "vat_percentage" of relation "ser_billing_record" does not exist
LINE 1: ...group", "bill_type", "issue_date", "total_parts", "vat_perce...
                                                             ^ - Invalid query: INSERT INTO "ser_billing_record" ("invoice_no", "jobcard_group", "bill_type", "issue_date", "total_parts", "vat_percentage", "net_total", "dealer_id", "fiscal_year_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('2019-12-16', 0, 'dealer_to_dealer', '2019-12-16', '213.00', 13, 240.69, 81, 4, 632, 632, '2019-12-16 16:27:20', '2019-12-16 16:27:20')
ERROR - 2019-12-16 16:33:15 --> Query error: ERROR:  invalid input syntax for integer: "2019-12-16"
LINE 1: ..."updated_by", "created_at", "updated_at") VALUES ('2019-12-1...
                                                             ^ - Invalid query: INSERT INTO "ser_billing_record" ("invoice_no", "jobcard_group", "bill_type", "issue_date", "total_parts", "vat_percent", "net_total", "dealer_id", "fiscal_year_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('2019-12-16', 0, 'dealer_to_dealer', '2019-12-16', '213.00', 13, 240.69, 81, 4, 632, 632, '2019-12-16 16:33:15', '2019-12-16 16:33:15')
ERROR - 2019-12-16 16:34:08 --> Query error: ERROR:  column "bill_id" of relation "ser_billing_record" does not exist
LINE 1: UPDATE "ser_billing_record" SET "id" = '1', "bill_id" = '130...
                                                    ^ - Invalid query: UPDATE "ser_billing_record" SET "id" = '1', "bill_id" = '13082', "bill_no" = 21, "is_billed" = 1, "updated_by" = 632, "updated_at" = '2019-12-16 16:34:08'
WHERE "id" = '1'
ERROR - 2019-12-16 16:35:16 --> Query error: ERROR:  relation "d2d_billing_details" does not exist
LINE 2: FROM "d2d_billing_details"
             ^ - Invalid query: SELECT *
FROM "d2d_billing_details"
WHERE ("deleted_at" > NOW() OR "deleted_at" IS NULL)
AND "id" = '1'
 LIMIT 1
ERROR - 2019-12-16 16:44:25 --> Could not find the language line "part"
ERROR - 2019-12-16 17:19:29 --> Severity: Parsing Error --> syntax error, unexpected 'search_params' (T_STRING) D:\xampp\htdocs\cgdms\modules\billing_details\controllers\Billing_details.php 249
ERROR - 2019-12-16 17:20:32 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\billing_details\views\admin\bill.php 101
ERROR - 2019-12-16 17:20:32 --> Severity: Notice --> Undefined property: stdClass::$part_name D:\xampp\htdocs\cgdms\modules\billing_details\views\admin\bill.php 102
ERROR - 2019-12-16 17:20:32 --> Severity: Notice --> Undefined property: stdClass::$price D:\xampp\htdocs\cgdms\modules\billing_details\views\admin\bill.php 103
ERROR - 2019-12-16 17:20:32 --> Severity: Notice --> Undefined property: stdClass::$quantity D:\xampp\htdocs\cgdms\modules\billing_details\views\admin\bill.php 104
ERROR - 2019-12-16 17:20:32 --> Severity: Notice --> Undefined property: stdClass::$total_price D:\xampp\htdocs\cgdms\modules\billing_details\views\admin\bill.php 105
ERROR - 2019-12-16 17:23:27 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\billing_details\views\admin\bill.php 120
ERROR - 2019-12-16 17:23:27 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\billing_details\views\admin\bill.php 126
ERROR - 2019-12-16 17:23:49 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\billing_details\views\admin\bill.php 120
ERROR - 2019-12-16 17:23:49 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\billing_details\views\admin\bill.php 126
ERROR - 2019-12-16 17:23:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\billing_details\views\admin\bill.php 120
ERROR - 2019-12-16 17:23:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\billing_details\views\admin\bill.php 126
