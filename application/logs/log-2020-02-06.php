<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-06 10:09:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\dealer_order.php 42
ERROR - 2020-02-06 10:09:42 --> Could not find the language line "sparepart_id"
ERROR - 2020-02-06 10:09:42 --> Could not find the language line "sparepart_id"
ERROR - 2020-02-06 10:12:17 --> Could not find the language line "latest_part_code"
ERROR - 2020-02-06 10:12:17 --> Could not find the language line "stock_value"
ERROR - 2020-02-06 10:36:03 --> Query error: ERROR:  column "order_concat" does not exist
LINE 5: ORDER BY "order_concat" DESC
                 ^ - Invalid query: SELECT *
FROM "view_sparepart_dispatch_by_billing"
WHERE 1=1 AND dispatched_date >= '2019-06-17'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "order_concat" DESC
 LIMIT 100
ERROR - 2020-02-06 11:03:13 --> Query error: ERROR:  column "total_dispatched_quantity" does not exist
LINE 5: ORDER BY "total_dispatched_quantity" ASC
                 ^ - Invalid query: SELECT *
FROM "view_sparepart_dispatch_by_billing"
WHERE 1=1 AND dispatched_date >= '2019-06-17'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "total_dispatched_quantity" ASC
 LIMIT 100
ERROR - 2020-02-06 15:27:11 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 3: WHERE "order_quantity" > "received_quantity +" "cancle_quant...
                                                       ^ - Invalid query: SELECT *
FROM "spareparts_sparepart_order"
WHERE "order_quantity" > "received_quantity +" "cancle_quantity"
AND "dealer_id" = '120'
AND "sparepart_id" = '6842'
AND "pi_generated" = 1
AND "picklist" = 1
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "id" ASC
 LIMIT 1
ERROR - 2020-02-06 15:36:05 --> Severity: Notice --> Undefined property: stdClass::$alterna_part_code D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2576
ERROR - 2020-02-06 15:39:17 --> Severity: Notice --> Array to string conversion D:\xampp\htdocs\cgdms\system\database\DB_query_builder.php 669
ERROR - 2020-02-06 15:39:17 --> Query error: ERROR:  column "Array" does not exist
LINE 3: WHERE 0 = "Array"
                  ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE 0 = "Array"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-02-06 15:39:39 --> Query error: ERROR:  syntax error at or near ">"
LINE 3: ...atest_part_code" = '09471M12216' OR "part_code" = > '09471M1...
                                                             ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE ("alternate_part_code" = '09471M12216' OR "latest_part_code" = '09471M12216' OR "part_code" = > '09471M12210' OR 'part_code = > '09471M12211')
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-02-06 15:40:02 --> Query error: ERROR:  syntax error at or near "09471"
LINE 3: ...' OR "part_code" = '09471M12210' OR 'part_code = '09471M1221...
                                                             ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE ("alternate_part_code" = '09471M12216' OR "latest_part_code" = '09471M12216' OR "part_code" = '09471M12210' OR 'part_code = '09471M12211')
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-02-06 15:41:00 --> Query error: ERROR:  syntax error at or near "M12211"
LINE 3: ...R "part_code" = '09471M12210' OR "part_code" = 09471M12211')
                                                               ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE ("alternate_part_code" = '09471M12216' OR "latest_part_code" = '09471M12216' OR "part_code" = '09471M12210' OR "part_code" = 09471M12211')
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-02-06 18:06:53 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\dealer_order.php 42
ERROR - 2020-02-06 18:06:53 --> Could not find the language line "sparepart_id"
ERROR - 2020-02-06 18:06:53 --> Could not find the language line "sparepart_id"
