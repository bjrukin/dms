<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-29 10:35:05 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 6: AND "received_quantity"" -" "cancle_quantity" < "order_quant...
                                    ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-29'
AND "dealer_id" = ''
AND "received_quantity"" -" "cancle_quantity" < "order_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-29 10:37:06 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 6: AND "received_quantity"" -" "cancle_quantity" < "order_quant...
                                    ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-29'
AND "dealer_id" = ''
AND "received_quantity"" -" "cancle_quantity" < "order_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-29 11:35:50 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 6: AND "received_quantity"" -" "cancle_quantity" < "order_quant...
                                    ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-29'
AND "dealer_id" = '83'
AND "received_quantity"" -" "cancle_quantity" < "order_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-29 12:07:10 --> Query error: ERROR:  syntax error at or near ""order_quantity""
LINE 6: AND "received_quantity" < "cancle_quantity"" +" "order_quant...
                                                        ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-29'
AND "dealer_id" = '83'
AND "received_quantity" < "cancle_quantity"" +" "order_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-29 12:18:43 --> Query error: ERROR:  syntax error at or near ""order_quantity""
LINE 3: WHERE "received_quantity" < "cancle_quantity"" +" "order_qua...
                                                          ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "received_quantity" < "cancle_quantity"" +" "order_quantity"
AND "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-29'
AND "dealer_id" = '83'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-29 12:21:35 --> Query error: ERROR:  syntax error at or near ")"
LINE 3: ...LESCE((so.received_quantity)::bigint, (0)::bigint)) - COALES...
                                                             ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "received_quantity" - COALESCE((so.received_quantity)::bigint, (0)::bigint)) - COALESCE(so.cancle_quantity, 0) < 0
AND "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-29'
AND "dealer_id" = '83'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-29 12:29:39 --> Query error: ERROR:  syntax error at or near ")"
LINE 3: ...LESCE((so.received_quantity)::bigint, (0)::bigint)) - COALES...
                                                             ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "received_quantity" - COALESCE((so.received_quantity)::bigint, (0)::bigint)) - COALESCE(so.cancle_quantity, 0) > 0
AND "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-29'
AND "dealer_id" = '83'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-29 12:30:28 --> Query error: ERROR:  missing FROM-clause entry for table "so"
LINE 3: WHERE "order_quantity" - COALESCE((so.received_quantity)::bi...
                                           ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "order_quantity" - COALESCE((so.received_quantity)::bigint, (0)::bigint) - COALESCE(so.cancle_quantity, 0) > 0
AND "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-29'
AND "dealer_id" = '83'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-29 12:44:22 --> Query error: ERROR:  column "backorder" does not exist
LINE 6: AND "backorder" >0
            ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-29'
AND "dealer_id" = '83'
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-29 12:44:51 --> Query error: ERROR:  column "proforma_invoice_id" does not exist
LINE 8: ORDER BY "proforma_invoice_id"
                 ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-29'
AND "dealer_id" = '83'
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-29 12:44:54 --> Query error: ERROR:  column "proforma_invoice_id" does not exist
LINE 8: ORDER BY "proforma_invoice_id"
                 ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-29'
AND "dealer_id" = '83'
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-29 15:21:20 --> Severity: Parsing Error --> syntax error, unexpected ',' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3293
ERROR - 2020-01-29 15:23:26 --> Query error: ERROR:  invalid input syntax for type date: ""
LINE 3: WHERE "pi_generated_date_time" >= ''
                                          ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE "pi_generated_date_time" >= ''
AND "pi_generated_date_time" <= ''
AND "dealer_id" IS NULL
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-29 15:24:17 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php:3276) D:\xampp\htdocs\cgdms\system\core\Common.php 573
ERROR - 2020-01-29 15:24:17 --> Severity: Error --> Call to undefined method Sparepart_orders::get_picker() D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3278
ERROR - 2020-01-29 15:28:23 --> Severity: Parsing Error --> syntax error, unexpected '=>' (T_DOUBLE_ARROW) D:\xampp\htdocs\cgdms\application\core\Project_Controller.php 947
ERROR - 2020-01-29 15:28:50 --> Severity: Notice --> Undefined variable: picker_id D:\xampp\htdocs\cgdms\application\core\Project_Controller.php 946
ERROR - 2020-01-29 15:39:19 --> Query error: ERROR:  column "picklist_group" does not exist
LINE 4: ORDER BY "picklist_group"
                 ^ - Invalid query: SELECT *
FROM "spareparts_picklist"
WHERE ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "picklist_group"
 LIMIT 1
ERROR - 2020-01-29 15:43:10 --> Severity: Error --> Call to undefined method Sparepart_orders::get_stocks() D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3284
ERROR - 2020-01-29 15:44:50 --> Severity: Parsing Error --> syntax error, unexpected '$picklist' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3287
ERROR - 2020-01-29 15:46:45 --> Severity: Parsing Error --> syntax error, unexpected '$picklist' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3287
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:06 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:10 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Undefined variable: sparepart_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3285
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:14 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3324
ERROR - 2020-01-29 16:55:15 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:15 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:15 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:15 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:58 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:55:59 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 16:56:00 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:56:00 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3296
ERROR - 2020-01-29 16:56:00 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:32 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:32 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:32 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:32 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:32 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:32 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:32 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:32 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:32 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:32 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:32 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:32 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:32 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:32 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:33 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:35 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:36 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Undefined property: stdClass::$name D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3294
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:43 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:45 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:46 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:46 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:46 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:46 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:46 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:46 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:46 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:46 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:46 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 16:56:46 --> Severity: Notice --> Undefined variable: picklist_no D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:46 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3298
ERROR - 2020-01-29 16:56:46 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:24:11 --> Severity: Parsing Error --> syntax error, unexpected '}', expecting variable (T_VARIABLE) or '$' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:38 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:38 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:38 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:38 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:38 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:39 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:40 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:41 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:43 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:43 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:43 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:43 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:43 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:43 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:43 --> Severity: Notice --> Undefined property: stdClass::$deaker_id D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3334
ERROR - 2020-01-29 17:32:43 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:51 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:51 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:51 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:51 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:51 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:51 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:51 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:51 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:52 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:53 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:53 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:53 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:53 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:53 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:53 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:53 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:53 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:53 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:53 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:54 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:32:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3300
ERROR - 2020-01-29 17:40:50 --> Severity: Parsing Error --> syntax error, unexpected ';', expecting ')' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3293
ERROR - 2020-01-29 17:41:07 --> Severity: Parsing Error --> syntax error, unexpected ';', expecting ')' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3299
ERROR - 2020-01-29 17:41:20 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 17:41:20 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 17:41:21 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 17:47:07 --> Severity: Parsing Error --> syntax error, unexpected '.' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3301
ERROR - 2020-01-29 17:47:24 --> Severity: Parsing Error --> syntax error, unexpected '=', expecting ')' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3305
ERROR - 2020-01-29 17:47:35 --> Severity: Parsing Error --> syntax error, unexpected ';', expecting ')' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3305
ERROR - 2020-01-29 17:47:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 17:47:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 17:47:46 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 18:06:51 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 18:06:51 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
ERROR - 2020-01-29 18:06:53 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3292
