<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-31 09:23:06 --> Query error: ERROR:  invalid input syntax for type date: ""
LINE 3: WHERE "pi_generated_date_time" >= ''
                                          ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE "pi_generated_date_time" >= ''
AND "pi_generated_date_time" <= ''
AND "dealer_id" IS NULL
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-31 09:41:05 --> Query error: ERROR:  invalid input syntax for integer: ""
LINE 5: AND "dealer_id" = ''
                          ^ - Invalid query: SELECT "proforma_invoice_id", "pi_number"
FROM "view_back_log_spareparts"
WHERE "pi_generated_date_time" >= '2019-10-01'
AND "pi_generated_date_time" <= '2020-01-31'
AND "dealer_id" = ''
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
GROUP BY "proforma_invoice_id", "pi_number"
ERROR - 2020-01-31 09:41:19 --> Query error: ERROR:  invalid input syntax for integer: ""
LINE 5: AND "dealer_id" = ''
                          ^ - Invalid query: SELECT "proforma_invoice_id", "pi_number"
FROM "view_back_log_spareparts"
WHERE "pi_generated_date_time" >= '2019-10-01'
AND "pi_generated_date_time" <= '2020-01-31'
AND "dealer_id" = ''
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
GROUP BY "proforma_invoice_id", "pi_number"
ERROR - 2020-01-31 10:13:33 --> Severity: Parsing Error --> syntax error, unexpected '$this' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3268
ERROR - 2020-01-31 10:13:42 --> Severity: Parsing Error --> syntax error, unexpected '$this' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3268
ERROR - 2020-01-31 10:13:53 --> Severity: Parsing Error --> syntax error, unexpected '$where' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3279
ERROR - 2020-01-31 10:14:13 --> Severity: Warning --> implode(): Invalid arguments passed D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3278
ERROR - 2020-01-31 10:14:13 --> Query error: ERROR:  syntax error at or near ")"
LINE 3: WHERE proforma_invoice_id IN ()
                                      ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE proforma_invoice_id IN ()
AND "order_quantity" - COALESCE((received_quantity)::bigint, (0)::bigint) - COALESCE(cancle_quantity, 0) > 0
AND "dealer_id" = '120'
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-31 10:15:17 --> Severity: Warning --> implode(): Invalid arguments passed D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3278
ERROR - 2020-01-31 10:15:17 --> Query error: ERROR:  syntax error at or near ")"
LINE 3: WHERE proforma_invoice_id IN ()
                                      ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE proforma_invoice_id IN ()
AND "order_quantity" - COALESCE((received_quantity)::bigint, (0)::bigint) - COALESCE(cancle_quantity, 0) > 0
AND "dealer_id" = '120'
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-31 10:15:36 --> Severity: Warning --> implode(): Invalid arguments passed D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3278
ERROR - 2020-01-31 10:15:36 --> Query error: ERROR:  syntax error at or near ")"
LINE 3: WHERE proforma_invoice_id IN ()
                                      ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE proforma_invoice_id IN ()
AND "order_quantity" - COALESCE((received_quantity)::bigint, (0)::bigint) - COALESCE(cancle_quantity, 0) > 0
AND "dealer_id" = '120'
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-31 10:15:59 --> Query error: ERROR:  column "received_quantity" does not exist
LINE 4: AND "order_quantity" - COALESCE((received_quantity)::bigint,...
                                         ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE proforma_invoice_id IN (3154,3173)
AND "order_quantity" - COALESCE((received_quantity)::bigint, (0)::bigint) - COALESCE(cancle_quantity, 0) > 0
AND "dealer_id" = '120'
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-31 10:16:37 --> Query error: ERROR:  column "received_quantity" does not exist
LINE 4: AND "order_quantity" - COALESCE((received_quantity)::bigint,...
                                         ^ - Invalid query: SELECT *
FROM "view_report_spareparts_backorder"
WHERE proforma_invoice_id IN (3154,3173)
AND "order_quantity" - COALESCE((received_quantity)::bigint, (0)::bigint) - COALESCE(cancle_quantity, 0) > 0
AND "dealer_id" = '120'
AND "backorder" >0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "proforma_invoice_id"
ERROR - 2020-01-31 10:54:20 --> Severity: Error --> Maximum execution time of 30 seconds exceeded D:\xampp\htdocs\cgdms\system\database\drivers\pdo\pdo_driver.php 181
