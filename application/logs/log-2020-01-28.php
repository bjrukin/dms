<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-28 09:31:21 --> Query error: ERROR:  invalid input syntax for integer: ""
LINE 5: AND "dealer_id" = ''
                          ^ - Invalid query: SELECT "proforma_invoice_id", "pi_number"
FROM "view_back_log_spareparts"
WHERE "pi_generated_date_time" >= '2020-01-28'
AND "pi_generated_date_time" <= '2020-01-28'
AND "dealer_id" = ''
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
GROUP BY "proforma_invoice_id", "pi_number"
ERROR - 2020-01-28 13:49:07 --> Could not find the language line "latest_part_code"
ERROR - 2020-01-28 13:49:07 --> Could not find the language line "stock_value"
ERROR - 2020-01-28 13:55:17 --> Severity: Notice --> Undefined variable: discount_percentage D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2365
ERROR - 2020-01-28 13:55:17 --> Severity: Notice --> Undefined variable: discount_percentage D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2366
ERROR - 2020-01-28 14:18:11 --> Could not find the language line "latest_part_code"
ERROR - 2020-01-28 14:18:11 --> Could not find the language line "stock_value"
ERROR - 2020-01-28 14:57:20 --> Query error: ERROR:  syntax error at or near "order"
LINE 4: AND  order  ILIKE '%316%' ESCAPE '!' 
             ^ - Invalid query: SELECT count(DISTINCT order_no) as total
FROM "view_sparepart_picklist"
WHERE  dealer_name  ILIKE '%dhob%' ESCAPE '!' 
AND  order  ILIKE '%316%' ESCAPE '!' 
AND "pi_number" IS NOT NULL
GROUP BY "order", "dealer_name", "pick_count"
ERROR - 2020-01-28 15:07:40 --> Query error: ERROR:  column "pi_generated" does not exist
LINE 4: AND "pi_generated" = 1
            ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE "part_code" = '990J0M999H2-250'
AND "pi_generated" = 1
AND "picklist" = 1
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-28 15:17:47 --> Query error: ERROR:  column "pi_generated" does not exist
LINE 4: AND "pi_generated" = 1
            ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE "part_code" = '990J0M999H2-250'
AND "pi_generated" = 1
AND "picklist" = 1
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-28 15:20:28 --> Query error: ERROR:  column "pi_generated" does not exist
LINE 4: AND "pi_generated" = 1
            ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE "part_code" = '990J0M999H2-250'
AND "pi_generated" = 1
AND "picklist" = 1
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-28 17:26:53 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 6: AND "received_quantity"" -" "cancle_quantity" < "order_quant...
                                    ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "pi_generated_date_time" >= ''
AND "pi_generated_date_time" <= ''
AND "dealer_id" IS NULL
AND "received_quantity"" -" "cancle_quantity" < "order_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-28 17:47:51 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 6: AND "received_quantity"" -" "cancle_quantity" < "order_quant...
                                    ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-28'
AND "dealer_id" = ''
AND "received_quantity"" -" "cancle_quantity" < "order_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
