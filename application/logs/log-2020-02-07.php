<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-07 09:56:37 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\dealer_order.php 42
ERROR - 2020-02-07 09:56:37 --> Could not find the language line "sparepart_id"
ERROR - 2020-02-07 09:56:37 --> Could not find the language line "sparepart_id"
ERROR - 2020-02-07 10:25:59 --> Query error: ERROR:  syntax error at or near "cancle_quantity"
LINE 3: WHERE order_quantity > received_quantity cancle_quantity
                                                 ^ - Invalid query: SELECT *
FROM "spareparts_sparepart_order"
WHERE order_quantity > received_quantity cancle_quantity
AND "order_quantity" > "received_quantity"
AND "dealer_id" = '120'
AND "sparepart_id" = '17935'
AND "pi_generated" = 1
AND "picklist" = 1
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "id" ASC
 LIMIT 1
ERROR - 2020-02-07 10:31:19 --> Severity: Notice --> Undefined variable: discount_percentage D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2381
ERROR - 2020-02-07 10:31:19 --> Severity: Notice --> Undefined variable: discount_percentage D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2382
ERROR - 2020-02-07 10:31:22 --> Severity: Notice --> Undefined variable: discount_percentage D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2381
ERROR - 2020-02-07 10:31:22 --> Severity: Notice --> Undefined variable: discount_percentage D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2382
ERROR - 2020-02-07 13:01:50 --> Could not find the language line "latest_part_code"
ERROR - 2020-02-07 13:01:50 --> Could not find the language line "stock_value"
ERROR - 2020-02-07 13:04:40 --> Severity: Notice --> Undefined variable: discount_percentage D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2381
ERROR - 2020-02-07 13:04:40 --> Severity: Notice --> Undefined variable: discount_percentage D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2382
