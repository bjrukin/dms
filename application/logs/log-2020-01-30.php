<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-30 10:01:14 --> Query error: ERROR:  invalid input syntax for type date: ""
LINE 3: WHERE "pi_generated_date_time" >= ''
                                          ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE "pi_generated_date_time" >= ''
AND "pi_generated_date_time" <= ''
AND "dealer_id" IS NULL
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-30 10:18:28 --> Severity: Parsing Error --> syntax error, unexpected '=', expecting ')' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3367
ERROR - 2020-01-30 10:18:37 --> Severity: Parsing Error --> syntax error, unexpected '=', expecting ')' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3367
ERROR - 2020-01-30 10:18:56 --> Severity: Parsing Error --> syntax error, unexpected '$rows' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3370
ERROR - 2020-01-30 10:19:32 --> Query error: ERROR:  column "dispatched_quantity" of relation "spareparts_picklist" does not exist
LINE 1: ...cklist" ("dealer_id", "order_no", "sparepart_id", "dispatche...
                                                             ^ - Invalid query: INSERT INTO "spareparts_picklist" ("dealer_id", "order_no", "sparepart_id", "dispatched_quantity", "order_id", "picker_name", "generated_date", "order_type", "pick_count", "is_billed", "picker_id", "picklist_format", "picklist_no", "ordered_spareparts", "picklist_group", "dispatched_date", "dispatched_date_nep", "created_by", "updated_by", "created_at", "updated_at") VALUES ('83', 75, 63881, '1', 171287, 'Ashok', '2020-01-30', 'ACCIDENTAL', 1, 0, '4', 'PICKLST-01985', 1985, 63881, 1, '2020-01-30', '2076-10-16', 1, 1, '2020-01-30 10:19:32', '2020-01-30 10:19:32')
ERROR - 2020-01-30 10:20:33 --> Query error: ERROR:  column "dispatche_quantity" of relation "spareparts_picklist" does not exist
LINE 1: ...cklist" ("dealer_id", "order_no", "sparepart_id", "dispatche...
                                                             ^ - Invalid query: INSERT INTO "spareparts_picklist" ("dealer_id", "order_no", "sparepart_id", "dispatche_quantity", "order_id", "picker_name", "generated_date", "order_type", "pick_count", "is_billed", "picker_id", "picklist_format", "picklist_no", "ordered_spareparts", "picklist_group", "dispatched_date", "dispatched_date_nep", "created_by", "updated_by", "created_at", "updated_at") VALUES ('83', 75, 63881, '1', 171287, 'Ashok', '2020-01-30', 'ACCIDENTAL', 1, 0, '4', 'PICKLST-01985', 1985, 63881, 1, '2020-01-30', '2076-10-16', 1, 1, '2020-01-30 10:20:33', '2020-01-30 10:20:33')
ERROR - 2020-01-30 10:20:48 --> Query error: ERROR:  column "generated_date" of relation "spareparts_picklist" does not exist
LINE 1: ..., "dispatch_quantity", "order_id", "picker_name", "generated...
                                                             ^ - Invalid query: INSERT INTO "spareparts_picklist" ("dealer_id", "order_no", "sparepart_id", "dispatch_quantity", "order_id", "picker_name", "generated_date", "order_type", "pick_count", "is_billed", "picker_id", "picklist_format", "picklist_no", "ordered_spareparts", "picklist_group", "dispatched_date", "dispatched_date_nep", "created_by", "updated_by", "created_at", "updated_at") VALUES ('83', 75, 63881, '1', 171287, 'Ashok', '2020-01-30', 'ACCIDENTAL', 1, 0, '4', 'PICKLST-01985', 1985, 63881, 1, '2020-01-30', '2076-10-16', 1, 1, '2020-01-30 10:20:48', '2020-01-30 10:20:48')
ERROR - 2020-01-30 10:23:59 --> Severity: Notice --> Undefined variable: value D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-30 10:26:25 --> Severity: Notice --> Undefined variable: value D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-30 10:28:21 --> Severity: Notice --> Undefined variable: value D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-30 10:30:59 --> Severity: Notice --> Undefined variable: value D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-30 10:30:59 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3375
ERROR - 2020-01-30 10:31:01 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:31:01 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:31:01 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:31:01 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:31:28 --> Severity: Notice --> Undefined variable: value D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-30 10:31:29 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3375
ERROR - 2020-01-30 10:31:29 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:31:29 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:31:29 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:31:29 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:32:08 --> Severity: Notice --> Undefined variable: value D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-30 10:32:09 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3374
ERROR - 2020-01-30 10:32:09 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3375
ERROR - 2020-01-30 10:32:09 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:32:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:32:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:32:09 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:32:12 --> Severity: Notice --> Undefined variable: value D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-30 10:32:13 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3374
ERROR - 2020-01-30 10:32:13 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3375
ERROR - 2020-01-30 10:32:13 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:32:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:32:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:32:13 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:32:55 --> Severity: Notice --> Undefined variable: value D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-30 10:32:55 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3375
ERROR - 2020-01-30 10:32:56 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:32:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:32:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:32:56 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:33:38 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3375
ERROR - 2020-01-30 10:33:38 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:33:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:33:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:33:38 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:37:52 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3375
ERROR - 2020-01-30 10:37:52 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:37:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:37:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 64
ERROR - 2020-01-30 10:37:52 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 85
ERROR - 2020-01-30 10:38:12 --> Query error: ERROR:  invalid input syntax for type date: ""
LINE 3: WHERE "pi_generated_date_time" >= ''
                                          ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE "pi_generated_date_time" >= ''
AND "pi_generated_date_time" <= ''
AND "dealer_id" IS NULL
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-30 10:39:01 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3375
ERROR - 2020-01-30 10:39:02 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:39:02 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:39:02 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 64
ERROR - 2020-01-30 10:39:02 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 85
ERROR - 2020-01-30 10:41:35 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3377
ERROR - 2020-01-30 10:41:36 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:41:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:41:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:41:36 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:42:05 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3377
ERROR - 2020-01-30 10:42:06 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:42:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:42:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:42:06 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:43:15 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3377
ERROR - 2020-01-30 10:43:16 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:43:16 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:43:16 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:43:16 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:43:54 --> Query error: ERROR:  invalid input syntax for type date: ""
LINE 3: WHERE "pi_generated_date_time" >= ''
                                          ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE "pi_generated_date_time" >= ''
AND "pi_generated_date_time" <= ''
AND "dealer_id" IS NULL
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-30 10:44:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:44:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:44:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:44:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:44:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:44:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:44:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:44:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:44:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:44:44 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3378
ERROR - 2020-01-30 10:44:45 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:44:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:44:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:44:45 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:46:39 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:46:39 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:46:39 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:46:39 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:46:40 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:46:40 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:46:40 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:46:40 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:46:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:46:41 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3378
ERROR - 2020-01-30 10:46:41 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:46:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:46:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:46:42 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:47:29 --> Severity: Error --> Call to undefined method MY_DB_pdo_pgsql_driver::lasst_query() D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3347
ERROR - 2020-01-30 10:47:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:47:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:47:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:47:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:47:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:47:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:47:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:47:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:47:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3295
ERROR - 2020-01-30 10:47:44 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3379
ERROR - 2020-01-30 10:47:44 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:47:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:47:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:47:44 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:48:26 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3379
ERROR - 2020-01-30 10:48:26 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:48:26 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:48:26 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:48:26 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:49:13 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3378
ERROR - 2020-01-30 10:49:14 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:49:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:49:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:49:14 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:52:29 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3378
ERROR - 2020-01-30 10:52:30 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:52:30 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:52:30 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:52:30 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:53:28 --> Query error: ERROR:  invalid input syntax for type date: ""
LINE 3: WHERE "pi_generated_date_time" >= ''
                                          ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE "pi_generated_date_time" >= ''
AND "pi_generated_date_time" <= ''
AND "dealer_id" IS NULL
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-30 10:53:46 --> Query error: ERROR:  invalid input syntax for type date: ""
LINE 3: WHERE "pi_generated_date_time" >= ''
                                          ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE "pi_generated_date_time" >= ''
AND "pi_generated_date_time" <= ''
AND "dealer_id" IS NULL
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-30 10:54:04 --> Query error: ERROR:  invalid input syntax for type date: ""
LINE 3: WHERE "pi_generated_date_time" >= ''
                                          ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE "pi_generated_date_time" >= ''
AND "pi_generated_date_time" <= ''
AND "dealer_id" IS NULL
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-30 10:54:19 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3378
ERROR - 2020-01-30 10:54:19 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:54:19 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:54:19 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:54:19 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:55:00 --> Severity: Notice --> Undefined variable: rows D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3378
ERROR - 2020-01-30 10:55:01 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:55:01 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:55:01 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 63
ERROR - 2020-01-30 10:55:01 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 84
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 10:56:59 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 10:57:00 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 10:57:01 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 10:57:01 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 10:57:01 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 10:57:01 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:55 --> Severity: Notice --> Undefined property: stdClass::$dispatch_mode D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3377
ERROR - 2020-01-30 11:00:55 --> Severity: Notice --> Undefined property: stdClass::$picklist_number D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3379
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:56 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:00:57 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:09 --> Severity: Notice --> Undefined property: stdClass::$picklist_number D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3379
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:10 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:11 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined variable: dealer D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 62
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:43 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:01:44 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:01:45 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:01:45 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:01:45 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:04:34 --> Severity: Error --> Cannot use object of type stdClass as array D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3383
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:05:03 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 87
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$ordered_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 88
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 89
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$location D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 91
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:05:04 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:07:10 --> Query error: ERROR:  column "picklist_group" does not exist
LINE 3: WHERE "picklist_group" = 5
              ^ - Invalid query: SELECT *
FROM "view_sparepart_picklist"
WHERE "picklist_group" = 5
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-30 11:12:17 --> Severity: Notice --> Undefined property: stdClass::$picker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3383
ERROR - 2020-01-30 11:12:18 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:18 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:18 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:18 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:18 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:18 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:18 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:18 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:18 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:18 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:18 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:18 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:18 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:19 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:37 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:12:38 --> Severity: Notice --> Undefined property: stdClass::$stock_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\picklist.php 92
ERROR - 2020-01-30 11:13:55 --> Could not find the language line "latest_part_code"
ERROR - 2020-01-30 11:13:55 --> Could not find the language line "stock_value"
ERROR - 2020-01-30 11:19:17 --> Severity: Notice --> Undefined variable: dealer_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3401
ERROR - 2020-01-30 11:19:17 --> Severity: Notice --> Undefined variable: order_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3402
ERROR - 2020-01-30 11:19:17 --> Severity: Notice --> Array to string conversion D:\xampp\htdocs\cgdms\system\database\DB_query_builder.php 669
ERROR - 2020-01-30 11:19:17 --> Query error: ERROR:  column "Array" does not exist
LINE 3: WHERE 0 = "Array"
                  ^ - Invalid query: SELECT "picker_name"
FROM "view_sparepart_picklist"
WHERE 0 = "Array"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
 LIMIT 1
ERROR - 2020-01-30 11:19:53 --> Severity: Notice --> Undefined variable: order_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3401
ERROR - 2020-01-30 11:19:53 --> Severity: Notice --> Array to string conversion D:\xampp\htdocs\cgdms\system\database\DB_query_builder.php 669
ERROR - 2020-01-30 11:19:53 --> Query error: ERROR:  column "Array" does not exist
LINE 3: WHERE 0 = "Array"
                  ^ - Invalid query: SELECT "picker_name"
FROM "view_sparepart_picklist"
WHERE 0 = "Array"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
 LIMIT 1
ERROR - 2020-01-30 11:20:17 --> Severity: Notice --> Array to string conversion D:\xampp\htdocs\cgdms\system\database\DB_query_builder.php 669
ERROR - 2020-01-30 11:20:17 --> Query error: ERROR:  column "Array" does not exist
LINE 3: WHERE 0 = "Array"
                  ^ - Invalid query: SELECT "picker_name"
FROM "view_sparepart_picklist"
WHERE 0 = "Array"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
 LIMIT 1
ERROR - 2020-01-30 14:49:45 --> Query error: ERROR:  invalid input syntax for type date: ""
LINE 3: WHERE "pi_generated_date_time" >= ''
                                          ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE "pi_generated_date_time" >= ''
AND "pi_generated_date_time" <= ''
AND "dealer_id" IS NULL
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-30 14:50:04 --> Could not find the language line "latest_part_code"
ERROR - 2020-01-30 14:50:04 --> Could not find the language line "stock_value"
ERROR - 2020-01-30 15:11:55 --> Query error: ERROR:  invalid input syntax for type date: ""
LINE 3: WHERE "pi_generated_date_time" >= ''
                                          ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE "pi_generated_date_time" >= ''
AND "pi_generated_date_time" <= ''
AND "dealer_id" IS NULL
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-30 15:15:41 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3389
ERROR - 2020-01-30 15:15:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3389
ERROR - 2020-01-30 15:15:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 62
ERROR - 2020-01-30 15:15:42 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 63
ERROR - 2020-01-30 15:15:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 63
ERROR - 2020-01-30 15:16:39 --> Severity: 4096 --> Object of class stdClass could not be converted to string D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-30 15:56:55 --> Query error: ERROR:  invalid input syntax for type date: ""
LINE 3: WHERE "pi_generated_date_time" >= ''
                                          ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE "pi_generated_date_time" >= ''
AND "pi_generated_date_time" <= ''
AND "dealer_id" IS NULL
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-30 15:57:35 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3390
ERROR - 2020-01-30 15:57:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3390
ERROR - 2020-01-30 15:57:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 62
ERROR - 2020-01-30 15:57:35 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 63
ERROR - 2020-01-30 15:57:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 63
ERROR - 2020-01-30 15:58:06 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3390
ERROR - 2020-01-30 15:58:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3390
ERROR - 2020-01-30 15:58:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 62
ERROR - 2020-01-30 15:58:07 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 63
ERROR - 2020-01-30 15:58:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 63
ERROR - 2020-01-30 17:26:06 --> Query error: ERROR:  invalid input syntax for type date: ""
LINE 3: WHERE "pi_generated_date_time" >= ''
                                          ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE "pi_generated_date_time" >= ''
AND "pi_generated_date_time" <= ''
AND "dealer_id" IS NULL
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
