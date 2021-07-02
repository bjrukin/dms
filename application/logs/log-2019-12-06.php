<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-06 11:24:32 --> Severity: Error --> Call to undefined function is_aro() D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 1131
ERROR - 2019-12-06 11:24:40 --> Query error: ERROR:  relation "view_billing_details" does not exist
LINE 2: FROM "view_billing_details"
             ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "view_billing_details"
WHERE "dealer_id" =0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
