<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-09 16:41:56 --> Severity: Warning --> fsockopen(): php_network_getaddresses: getaddrinfo failed: No such host is known.  D:\xampp\htdocs\cgdms\system\libraries\Email.php 1990
ERROR - 2020-02-09 16:41:56 --> Severity: Warning --> fsockopen(): unable to connect to mail.cg.holding:465 (php_network_getaddresses: getaddrinfo failed: No such host is known. ) D:\xampp\htdocs\cgdms\system\libraries\Email.php 1990
ERROR - 2020-02-09 16:44:45 --> Severity: Error --> Maximum execution time of 30 seconds exceeded D:\xampp\htdocs\cgdms\system\database\drivers\pdo\pdo_driver.php 181
ERROR - 2020-02-09 16:46:12 --> Severity: Error --> Maximum execution time of 30 seconds exceeded D:\xampp\htdocs\cgdms\system\database\drivers\pdo\pdo_driver.php 181
ERROR - 2020-02-09 16:47:14 --> Severity: Error --> Maximum execution time of 30 seconds exceeded D:\xampp\htdocs\cgdms\system\database\drivers\pdo\pdo_driver.php 181
ERROR - 2020-02-09 16:48:31 --> Severity: Error --> Maximum execution time of 30 seconds exceeded D:\xampp\htdocs\cgdms\system\database\drivers\pdo\pdo_driver.php 181
ERROR - 2020-02-09 17:09:03 --> Could not find the language line "latest_part_code"
ERROR - 2020-02-09 17:09:03 --> Could not find the language line "stock_value"
ERROR - 2020-02-09 17:12:26 --> Query error: ERROR:  invalid input syntax for integer: "undefined"
LINE 3: WHERE "picklist_group" = 'undefined'
                                 ^ - Invalid query: SELECT "picker_name"
FROM "view_sparepart_picklist"
WHERE "picklist_group" = 'undefined'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
 LIMIT 1
ERROR - 2020-02-09 17:15:27 --> Query error: ERROR:  invalid input syntax for integer: "undefined"
LINE 3: WHERE "picklist_group" = 'undefined'
                                 ^ - Invalid query: SELECT "picker_name"
FROM "view_sparepart_picklist"
WHERE "picklist_group" = 'undefined'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
 LIMIT 1
ERROR - 2020-02-09 17:16:47 --> Query error: ERROR:  column "total_amount" does not exist
LINE 3: WHERE "total_amount" = '3429'
              ^ - Invalid query: SELECT "dealer_name", "dealer_id", "order_no", "order_concat", "order_type", "order_cancel", "spares_incharge_id", "order_date", "order_date_np", "dispatch_mode", "pi_status", "pi_confirmed", "dealer_confirmed", SUM(order_quantity) as order_qty, count(DISTINCT id) as total_line_qty, SUM(order_quantity * dealer_price) as total_amount, COALESCE(SUM(dispatched_quantity), 0) as total_dispatched_quantity, COALESCE(SUM(dispatched_quantity * dispatch_dealer_price), 0) as total_dispatched_amount, "pi_generated_date_time", "pi_generated"
FROM "view_spareparts_order"
WHERE "total_amount" = '3429'
AND 1 = 1
AND "order_cancel" =0
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
GROUP BY "dealer_name", "dealer_id", "order_no", "order_concat", "order_type", "order_cancel", "spares_incharge_id", "order_date", "order_date_np", "dispatch_mode", "pi_status", "pi_confirmed", "dealer_confirmed", "pi_generated_date_time", "pi_generated"
ERROR - 2020-02-09 17:19:13 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 63
ERROR - 2020-02-09 17:19:13 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 63
