<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-26 10:24:27 --> Query error: ERROR:  column "sparepart_id" does not exist
LINE 3: WHERE "sparepart_id" = 14991
              ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE "sparepart_id" = 14991
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
 LIMIT 1
ERROR - 2020-01-26 10:26:46 --> Query error: ERROR:  invalid input syntax for integer: "part_code = '14141M84400' OR "part_code" = ''"
LINE 3: WHERE 0 = 'part_code = ''14141M84400'' OR "part_code" = ''''...
                  ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE 0 = 'part_code = ''14141M84400'' OR "part_code" = '''''
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 10:28:46 --> Query error: ERROR:  invalid input syntax for integer: "part_code = '14141M84400' OR "part_code" = ''"
LINE 3: WHERE 0 = 'part_code = ''14141M84400'' OR "part_code" = ''''...
                  ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE 0 = 'part_code = ''14141M84400'' OR "part_code" = '''''
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 10:28:56 --> Query error: ERROR:  invalid input syntax for integer: "part_code = '14141M84400' OR "part_code" = ''"
LINE 3: WHERE 0 = 'part_code = ''14141M84400'' OR "part_code" = ''''...
                  ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE 0 = 'part_code = ''14141M84400'' OR "part_code" = '''''
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 10:29:29 --> Severity: Notice --> Undefined index: received_quantity < order_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 1970
ERROR - 2020-01-26 10:29:29 --> Query error: ERROR:  syntax error at or near ">"
LINE 3: WHERE ("sparepart_id" = > '14989' OR "sparepart_id" = > '108...
                                ^ - Invalid query: SELECT *
FROM "spareparts_sparepart_order"
WHERE ("sparepart_id" = > '14989' OR "sparepart_id" = > '108881')
AND "dealer_id" = 80
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 10:30:50 --> Severity: Notice --> Undefined index: received_quantity < order_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 1970
ERROR - 2020-01-26 10:30:50 --> Query error: ERROR:  syntax error at or near ">"
LINE 3: WHERE ("sparepart_id" = > '14989' OR "sparepart_id" = > '108...
                                ^ - Invalid query: SELECT *
FROM "spareparts_sparepart_order"
WHERE ("sparepart_id" = > '14989' OR "sparepart_id" = > '108881')
AND "dealer_id" = 80
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 10:32:40 --> Severity: Notice --> Undefined index: received_quantity < order_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 1971
ERROR - 2020-01-26 10:32:40 --> Query error: ERROR:  syntax error at or near ">"
LINE 3: WHERE ("sparepart_id" = > '14989' OR "sparepart_id" = > '108...
                                ^ - Invalid query: SELECT *
FROM "spareparts_sparepart_order"
WHERE ("sparepart_id" = > '14989' OR "sparepart_id" = > '108881')
AND "dealer_id" = 80
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 10:32:55 --> Severity: Notice --> Undefined index: received_quantity < order_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 1971
ERROR - 2020-01-26 10:32:55 --> Query error: ERROR:  syntax error at or near ">"
LINE 3: WHERE ("sparepart_id" = > '14989' OR "sparepart_id" = > '108...
                                ^ - Invalid query: SELECT *
FROM "spareparts_sparepart_order"
WHERE ("sparepart_id" = > '14989' OR "sparepart_id" = > '108881')
AND "dealer_id" = 80
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 10:33:12 --> Severity: Notice --> Undefined index: received_quantity < order_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 1971
ERROR - 2020-01-26 10:33:12 --> Query error: ERROR:  syntax error at or near ">"
LINE 3: WHERE ("sparepart_id" = > '14989' OR "sparepart_id" = > '108...
                                ^ - Invalid query: SELECT *
FROM "spareparts_sparepart_order"
WHERE ("sparepart_id" = > '14989' OR "sparepart_id" = > '108881')
AND "dealer_id" = 80
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 10:34:21 --> Severity: Notice --> Undefined index: received_quantity < order_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 1971
ERROR - 2020-01-26 10:40:02 --> Severity: Warning --> implode(): Invalid arguments passed D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 1966
ERROR - 2020-01-26 10:40:02 --> Query error: ERROR:  syntax error at or near "NULL"
LINE 3: WHERE  IS NULL
                  ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE  IS NULL
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 11:33:55 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 6: AND "received_quantity"" -" "cancle_quantity" < "order_quant...
                                    ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-26'
AND "dealer_id" = '80'
AND "received_quantity"" -" "cancle_quantity" < "order_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 11:34:11 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 6: AND "received_quantity"" -" "cancle_quantity" < "order_quant...
                                    ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-26'
AND "dealer_id" = '80'
AND "received_quantity"" -" "cancle_quantity" < "order_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 11:53:01 --> Query error: ERROR:  syntax error at or near "NULL"
LINE 3: WHERE  IS NULL
                  ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE  IS NULL
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 11:53:13 --> Query error: ERROR:  syntax error at or near "NULL"
LINE 3: WHERE  IS NULL
                  ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE  IS NULL
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 11:53:51 --> Query error: ERROR:  syntax error at or near "NULL"
LINE 3: WHERE  IS NULL
                  ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE  IS NULL
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 11:54:01 --> Query error: ERROR:  syntax error at or near "NULL"
LINE 3: WHERE  IS NULL
                  ^ - Invalid query: SELECT *
FROM "mst_spareparts"
WHERE  IS NULL
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 12:06:25 --> Severity: Parsing Error --> syntax error, unexpected ',' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 3140
ERROR - 2020-01-26 12:06:37 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 3: WHERE "received_quantity"" -" "cancle_quantity" < "order_qua...
                                      ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "received_quantity"" -" "cancle_quantity" < "order_quantity" "FALSE"
AND "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-26'
AND "dealer_id" = '80'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 12:07:39 --> Query error: ERROR:  syntax error at or near ""FALSE""
LINE 3: ...ved_quantity""-""cancle_quantity" < "order_quantity" "FALSE"
                                                                ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "received_quantity""-""cancle_quantity" < "order_quantity" "FALSE"
AND "pi_generated_date_time" >= '2019-11-01'
AND "pi_generated_date_time" <= '2020-01-26'
AND "dealer_id" = '80'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 12:48:35 --> Query error: ERROR:  column "year_np" does not exist
LINE 4: AND "year_np" = '2076'
            ^ - Invalid query: SELECT *
FROM "view_dispatch_spareparts"
WHERE "bill_no" = '7608'
AND "year_np" = '2076'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-26 13:09:23 --> Query error: ERROR:  invalid input syntax for integer: ""
LINE 6: AND "dealer_id" = ''
                          ^ - Invalid query: SELECT "proforma_invoice_id", "pi_number"
FROM "view_spareparts_order"
WHERE "received_quantity"-"cancle_quantity" < "order_quantity"
AND "pi_generated_date_time" >= '2019-07-01'
AND "pi_generated_date_time" <= '2020-01-26'
AND "dealer_id" = ''
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
GROUP BY "proforma_invoice_id", "pi_number"
ERROR - 2020-01-26 13:58:34 --> Query error: ERROR:  column "received_quantity" does not exist
LINE 3: WHERE "received_quantity"-"cancle_quantity" < "order_quantit...
              ^
HINT:  Perhaps you meant to reference the column "view_back_log_spareparts.required_quantity". - Invalid query: SELECT "proforma_invoice_id", "pi_number"
FROM "view_back_log_spareparts"
WHERE "received_quantity"-"cancle_quantity" < "order_quantity"
AND "pi_generated_date_time" >= '2018-02-04'
AND "pi_generated_date_time" <= '2020-01-26'
AND "dealer_id" = '120'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
GROUP BY "proforma_invoice_id", "pi_number"
