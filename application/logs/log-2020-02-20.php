<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-20 09:38:28 --> Could not find the language line "error"
ERROR - 2020-02-20 09:49:25 --> Could not find the language line "error"
ERROR - 2020-02-20 09:52:00 --> Severity: Notice --> Undefined variable: firm_name D:\xampp\htdocs\cgdms\modules\customers\views\admin\order_confirmation.php 42
ERROR - 2020-02-20 09:52:00 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\customers\views\admin\order_confirmation.php 140
ERROR - 2020-02-20 09:52:00 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\customers\views\admin\order_confirmation.php 140
ERROR - 2020-02-20 10:02:37 --> Could not find the language line "crm_reports"
ERROR - 2020-02-20 10:02:37 --> Could not find the language line "crm_reports"
ERROR - 2020-02-20 10:02:43 --> Could not find the language line "crm_reports"
ERROR - 2020-02-20 10:03:29 --> Could not find the language line "crm_reports"
ERROR - 2020-02-20 10:36:43 --> 404 Page Not Found: ../../modules/sparepart_orders/controllers/Sparepart_orders/export_backlog
ERROR - 2020-02-20 10:39:45 --> Severity: Notice --> Undefined variable: print_r D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3585
ERROR - 2020-02-20 10:39:46 --> Severity: Error --> Function name must be a string D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3585
ERROR - 2020-02-20 12:31:20 --> Severity: Notice --> Undefined variable: fields D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3618
ERROR - 2020-02-20 12:34:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\dealer_order.php 42
ERROR - 2020-02-20 12:34:44 --> Could not find the language line "sparepart_id"
ERROR - 2020-02-20 12:34:44 --> Could not find the language line "sparepart_id"
ERROR - 2020-02-20 12:36:17 --> Query error: ERROR:  column "dealer_name" does not exist
LINE 1: SELECT "dealer_name", "part_code", "part_name" as "name", "b...
               ^ - Invalid query: SELECT "dealer_name", "part_code", "part_name" as "name", "backorder" AS "total_backorder", "pi_number", "order_no_concat" as "order_no", "id", "order_type", "dispatch_mode"
FROM "spareparts_sparepart_order"
WHERE "dealer_id" = '81'
AND "backorder" >0
AND "pi_number" IS NOT NULL
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-02-20 12:38:43 --> Severity: Error --> Maximum execution time of 30 seconds exceeded D:\xampp\htdocs\cgdms\application\core\MY_Model.php 291
ERROR - 2020-02-20 12:39:23 --> Severity: Error --> Maximum execution time of 30 seconds exceeded D:\xampp\htdocs\cgdms\application\core\MY_Model.php 291
ERROR - 2020-02-20 12:54:37 --> Severity: Parsing Error --> syntax error, unexpected ';' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3642
ERROR - 2020-02-20 12:54:39 --> Severity: Parsing Error --> syntax error, unexpected ';' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3642
ERROR - 2020-02-20 12:54:42 --> Severity: Parsing Error --> syntax error, unexpected ';' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3642
ERROR - 2020-02-20 13:07:46 --> Severity: Parsing Error --> syntax error, unexpected ';' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3642
ERROR - 2020-02-20 13:08:10 --> Severity: Parsing Error --> syntax error, unexpected ';' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3654
ERROR - 2020-02-20 13:08:24 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php:3605) D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3667
ERROR - 2020-02-20 13:08:24 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php:3605) D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3668
ERROR - 2020-02-20 13:08:24 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php:3605) D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3669
ERROR - 2020-02-20 13:08:24 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php:3605) D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3670
ERROR - 2020-02-20 14:19:41 --> Severity: Error --> Maximum execution time of 30 seconds exceeded D:\xampp\htdocs\cgdms\application\core\MY_Model.php 291
ERROR - 2020-02-20 14:20:17 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\dealer_order.php 42
ERROR - 2020-02-20 14:20:17 --> Could not find the language line "sparepart_id"
ERROR - 2020-02-20 14:20:17 --> Could not find the language line "sparepart_id"
