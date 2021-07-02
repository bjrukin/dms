<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-10 11:51:21 --> 404 Page Not Found: ../../modules/spareparts/controllers/Spareparts/cat_list_json
ERROR - 2020-01-10 11:52:36 --> Severity: Notice --> Undefined variable: data D:\xampp\htdocs\cgdms\modules\spareparts\controllers\Spareparts.php 463
ERROR - 2020-01-10 11:52:37 --> Severity: Warning --> file_get_contents(D:\xampp\htdocs\cgdms/uploads/spareparts_update/): failed to open stream: No such file or directory D:\xampp\htdocs\cgdms\application\third_party\PHPExcel\Shared\OLERead.php 85
ERROR - 2020-01-10 11:52:37 --> Severity: Warning --> fopen(D:\xampp\htdocs\cgdms/uploads/spareparts_update/): failed to open stream: No such file or directory D:\xampp\htdocs\cgdms\application\third_party\PHPExcel\Reader\Abstract.php 203
ERROR - 2020-01-10 11:52:37 --> Severity: error --> Exception: Could not open file D:\xampp\htdocs\cgdms/uploads/spareparts_update/ for reading. D:\xampp\htdocs\cgdms\application\third_party\PHPExcel\Reader\Abstract.php 205
ERROR - 2020-01-10 12:09:32 --> 404 Page Not Found: ../../modules/spareparts/controllers/Spareparts/cat_list_json
ERROR - 2020-01-10 12:09:46 --> Could not find the language line "latest_part_code"
ERROR - 2020-01-10 12:09:46 --> Could not find the language line "stock_value"
ERROR - 2020-01-10 12:10:18 --> Severity: Notice --> Undefined variable: data D:\xampp\htdocs\cgdms\modules\sparepart_stocks\controllers\Sparepart_stocks.php 240
ERROR - 2020-01-10 12:10:18 --> Severity: Warning --> file_get_contents(D:\xampp\htdocs\cgdms/uploads/spareparts_newstock/): failed to open stream: No such file or directory D:\xampp\htdocs\cgdms\application\third_party\PHPExcel\Shared\OLERead.php 85
ERROR - 2020-01-10 12:10:18 --> Severity: Warning --> fopen(D:\xampp\htdocs\cgdms/uploads/spareparts_newstock/): failed to open stream: No such file or directory D:\xampp\htdocs\cgdms\application\third_party\PHPExcel\Reader\Abstract.php 203
ERROR - 2020-01-10 12:10:18 --> Severity: error --> Exception: Could not open file D:\xampp\htdocs\cgdms/uploads/spareparts_newstock/ for reading. D:\xampp\htdocs\cgdms\application\third_party\PHPExcel\Reader\Abstract.php 205
ERROR - 2020-01-10 12:12:14 --> Could not find the language line "latest_part_code"
ERROR - 2020-01-10 12:12:14 --> Could not find the language line "stock_value"
ERROR - 2020-01-10 12:12:47 --> Could not find the language line "latest_part_code"
ERROR - 2020-01-10 12:12:47 --> Could not find the language line "stock_value"
ERROR - 2020-01-10 12:13:28 --> Severity: Error --> Maximum execution time of 30 seconds exceeded D:\xampp\htdocs\cgdms\system\database\drivers\pdo\pdo_driver.php 181
ERROR - 2020-01-10 12:13:34 --> Could not find the language line "latest_part_code"
ERROR - 2020-01-10 12:13:34 --> Could not find the language line "stock_value"
ERROR - 2020-01-10 12:58:17 --> Could not find the language line "latest_part_code"
ERROR - 2020-01-10 12:58:17 --> Could not find the language line "stock_value"
ERROR - 2020-01-10 13:00:02 --> Could not find the language line "latest_part_code"
ERROR - 2020-01-10 13:00:02 --> Could not find the language line "stock_value"
ERROR - 2020-01-10 14:09:06 --> Could not find the language line "latest_part_code"
ERROR - 2020-01-10 14:09:06 --> Could not find the language line "stock_value"
ERROR - 2020-01-10 14:09:07 --> Could not find the language line "latest_part_code"
ERROR - 2020-01-10 14:09:07 --> Could not find the language line "stock_value"
ERROR - 2020-01-10 14:24:20 --> Severity: Notice --> Undefined property: stdClass::$ordered_location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 93
ERROR - 2020-01-10 14:24:20 --> Severity: Notice --> Undefined property: stdClass::$ordered_location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 94
ERROR - 2020-01-10 14:24:20 --> Severity: Notice --> Undefined property: stdClass::$ordered_location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 93
ERROR - 2020-01-10 14:24:20 --> Severity: Notice --> Undefined property: stdClass::$ordered_location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 93
ERROR - 2020-01-10 14:24:20 --> Severity: Notice --> Undefined property: stdClass::$ordered_location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 93
ERROR - 2020-01-10 14:24:20 --> Severity: Notice --> Undefined property: stdClass::$ordered_location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 93
ERROR - 2020-01-10 14:31:59 --> Query error: ERROR:  column "dispatched_date" does not exist
LINE 1: SELECT "dispatched_date", "picklist"
               ^ - Invalid query: SELECT "dispatched_date", "picklist"
FROM "view_spareparts_order_pickcount"
WHERE "order_no" = '3'
AND "pi_number" = 'SHEPI-3154'
AND "pi_generated" = 1
AND "pi_confirmed" = 1
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "pick_count" DESC
ERROR - 2020-01-10 14:32:19 --> Query error: ERROR:  column "dispatched_date" does not exist
LINE 1: SELECT "dispatched_date", "picklist"
               ^ - Invalid query: SELECT "dispatched_date", "picklist"
FROM "view_spareparts_order_pickcount"
WHERE "order_no" = '3'
AND "pi_number" = 'SHEPI-3154'
AND "pi_generated" = 1
AND "pi_confirmed" = 1
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "pick_count" DESC
ERROR - 2020-01-10 14:35:22 --> Query error: ERROR:  column "location" does not exist
LINE 9: ORDER BY "location", "part_code"
                 ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "pi_generated" = 1
AND "pi_confirmed" = 1
AND "proforma_invoice_id" = '3242'
AND "dealer_id" = '120'
AND "order_quantity" > "received_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "location", "part_code"
ERROR - 2020-01-10 15:38:52 --> Severity: Error --> Cannot use object of type stdClass as array D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 967
ERROR - 2020-01-10 15:42:20 --> Severity: Parsing Error --> syntax error, unexpected 'foreach' (T_FOREACH), expecting ',' or ';' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 971
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 974
ERROR - 2020-01-10 16:13:36 --> Severity: Warning --> usort(): Array was modified by the user comparison function D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 975
ERROR - 2020-01-10 16:13:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 979
ERROR - 2020-01-10 16:13:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 979
ERROR - 2020-01-10 16:13:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 979
ERROR - 2020-01-10 16:13:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 979
ERROR - 2020-01-10 16:13:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 979
ERROR - 2020-01-10 16:13:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 979
ERROR - 2020-01-10 16:13:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 979
ERROR - 2020-01-10 16:13:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 979
ERROR - 2020-01-10 16:13:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 979
ERROR - 2020-01-10 16:14:01 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 980
ERROR - 2020-01-10 16:14:01 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 980
ERROR - 2020-01-10 16:14:01 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 980
ERROR - 2020-01-10 16:14:01 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 980
ERROR - 2020-01-10 16:14:01 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 980
ERROR - 2020-01-10 16:14:01 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 980
ERROR - 2020-01-10 16:14:01 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 980
ERROR - 2020-01-10 16:14:01 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 980
ERROR - 2020-01-10 16:14:01 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 980
