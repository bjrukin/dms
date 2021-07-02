<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-24 17:39:38 --> Severity: Parsing Error --> syntax error, unexpected '=', expecting ')' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3062
ERROR - 2020-01-24 17:40:04 --> Severity: Parsing Error --> syntax error, unexpected '$order' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3067
ERROR - 2020-01-24 17:41:55 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 6: AND "received_quantity -" "cancle_quantity" < "order_quantit...
                                  ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "requested_date" >= ''
AND "requested_date" <= ''
AND "dealer_id" = '83'
AND "received_quantity -" "cancle_quantity" < "order_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-24 17:42:35 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 6: AND "received_quantity"" -" "cancle_quantity" < "order_quant...
                                    ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "requested_date" >= ''
AND "requested_date" <= ''
AND "dealer_id" = '83'
AND "received_quantity"" -" "cancle_quantity" < "order_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-24 17:46:28 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 6: AND "received_quantity"" -" "cancle_quantity" < "order_quant...
                                    ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "requested_date" >= '2020-01-24'
AND "requested_date" <= '2020-01-24'
AND "dealer_id" = '83'
AND "received_quantity"" -" "cancle_quantity" < "order_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
