<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-17 12:26:58 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 7: AND "order_quantity" > "received_quantity -" "cancle_quantit...
                                                     ^ - Invalid query: SELECT *
FROM "view_spareparts_order"
WHERE "pi_generated" = 1
AND "pi_confirmed" = 1
AND "proforma_invoice_id" = '3173'
AND "dealer_id" = '120'
AND "order_quantity" > "received_quantity -" "cancle_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "part_code"
ERROR - 2020-02-17 16:23:11 --> Could not find the language line "latest_part_code"
ERROR - 2020-02-17 16:23:11 --> Could not find the language line "stock_value"
ERROR - 2020-02-17 16:55:54 --> Severity: Error --> Call to undefined function prnt_r() D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2060
ERROR - 2020-02-17 17:03:08 --> Severity: Notice --> Undefined variable: vakye D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2109
ERROR - 2020-02-17 17:03:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2109
ERROR - 2020-02-17 17:03:08 --> Severity: Notice --> Undefined variable: vakye D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2109
ERROR - 2020-02-17 17:03:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2109
ERROR - 2020-02-17 17:03:08 --> Severity: Notice --> Undefined variable: vakye D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2109
ERROR - 2020-02-17 17:03:08 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2109
ERROR - 2020-02-17 17:03:29 --> Severity: Notice --> Undefined variable: cabcle_qty D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2119
ERROR - 2020-02-17 17:03:53 --> Severity: Notice --> Undefined variable: print_r D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2121
ERROR - 2020-02-17 17:03:53 --> Severity: Error --> Function name must be a string D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2121
ERROR - 2020-02-17 17:10:10 --> Severity: Parsing Error --> syntax error, unexpected ')' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2050
ERROR - 2020-02-17 17:10:22 --> Query error: ERROR:  syntax error at or near "FROM"
LINE 2: FROM "spareparts_sparepart_order"
        ^ - Invalid query: SELECT SUM(order_quantity - receive_qty - cancle_quantity
FROM "spareparts_sparepart_order"
WHERE order_quantity > received_quantity + cancle_quantity
AND "dealer_id" = 120
AND "sparepart_id" = 47727
AND "pi_generated" = 1
AND "picklist" = 1
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-02-17 17:10:55 --> Query error: ERROR:  column "receive_qty" does not exist
LINE 1: SELECT SUM(order_quantity - receive_qty - cancle_quantity)
                                    ^ - Invalid query: SELECT SUM(order_quantity - receive_qty - cancle_quantity)
FROM "spareparts_sparepart_order"
WHERE order_quantity > received_quantity + cancle_quantity
AND "dealer_id" = 120
AND "sparepart_id" = 47727
AND "pi_generated" = 1
AND "picklist" = 1
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-02-17 17:11:06 --> Severity: Notice --> Undefined property: stdClass::$order_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2059
ERROR - 2020-02-17 17:11:06 --> Severity: Notice --> Undefined property: stdClass::$received_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2060
ERROR - 2020-02-17 17:11:06 --> Severity: Notice --> Undefined property: stdClass::$cancle_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2061
ERROR - 2020-02-17 17:11:36 --> Severity: Notice --> Undefined property: stdClass::$order_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2059
ERROR - 2020-02-17 17:11:36 --> Severity: Notice --> Undefined property: stdClass::$received_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2060
ERROR - 2020-02-17 17:11:36 --> Severity: Notice --> Undefined property: stdClass::$cancle_quantity D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2061
ERROR - 2020-02-17 17:18:24 --> Severity: Error --> Cannot use object of type stdClass as array D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2058
ERROR - 2020-02-17 17:20:17 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2115
ERROR - 2020-02-17 17:31:46 --> Query error: ERROR:  column "pi_generated" does not exist
LINE 5: AND "pi_generated" = 1
            ^ - Invalid query: SELECT *
FROM "spareparts_dispatch_list"
WHERE ("sparepart_id" = '47725' OR "sparepart_id" = '47727' OR "sparepart_id" = '45696')
AND "dealer_id" = 120
AND "pi_generated" = 1
AND "picklist" = 1
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
 LIMIT 1
ERROR - 2020-02-17 17:41:34 --> Severity: Parsing Error --> syntax error, unexpected 'print_r' (T_STRING) D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2130
ERROR - 2020-02-17 17:45:19 --> Severity: Parsing Error --> syntax error, unexpected ';' D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2127
ERROR - 2020-02-17 18:02:20 --> Severity: Error --> Call to undefined method MY_DB_pdo_pgsql_driver::where_id() D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2131
ERROR - 2020-02-17 18:02:39 --> Severity: Notice --> Undefined variable: parts_ids D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2131
ERROR - 2020-02-17 18:11:31 --> Severity: Notice --> Undefined index: sum D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2145
ERROR - 2020-02-17 18:11:50 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2145
ERROR - 2020-02-17 18:12:17 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2143
ERROR - 2020-02-17 18:12:42 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2143
