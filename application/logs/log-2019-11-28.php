<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-28 10:59:15 --> Severity: Error --> Call to undefined function is_aro() D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 190
ERROR - 2019-11-28 11:01:12 --> Query error: ERROR:  invalid input syntax for integer: ""
LINE 3: WHERE "dealer_id" = ''
                            ^ - Invalid query: SELECT *
FROM "view_spareparts_dealer_order"
WHERE "dealer_id" = ''
AND ("sparepart_id" = 23288 OR "alternate_part_code" = '24431M78460' OR "latest_part_code" = '24431M78460')
AND "received_quantity" < "order_quantity"
AND "picklist" = 1
AND ("is_billed" =0 OR "is_billed" IS NULL)
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "id"
 LIMIT 1
ERROR - 2019-11-28 11:01:41 --> Severity: Error --> Call to undefined function is_aro() D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 190
