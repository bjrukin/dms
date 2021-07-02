<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-02-17 12:01:00 --> Could not find the language line "dealer"
ERROR - 2021-02-17 12:18:30 --> Could not find the language line "dealer"
ERROR - 2021-02-17 12:18:50 --> Could not find the language line "dealer"
ERROR - 2021-02-17 12:29:41 --> 404 Page Not Found: /index
ERROR - 2021-02-17 12:46:42 --> 404 Page Not Found: /index
ERROR - 2021-02-17 12:46:51 --> 404 Page Not Found: /index
ERROR - 2021-02-17 12:47:26 --> 404 Page Not Found: /index
ERROR - 2021-02-17 12:47:54 --> Severity: Warning --> Missing argument 1 for Daily_credits::get_daily_credit_summary() D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 213
ERROR - 2021-02-17 12:47:54 --> Severity: Notice --> Undefined variable: date D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 215
ERROR - 2021-02-17 12:48:21 --> Severity: Notice --> Undefined variable: date D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 215
ERROR - 2021-02-17 13:04:07 --> Severity: Parsing Error --> syntax error, unexpected '$last_date' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 217
ERROR - 2021-02-17 13:04:20 --> Severity: Notice --> Undefined variable: where D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 216
ERROR - 2021-02-17 14:29:10 --> Severity: Parsing Error --> syntax error, unexpected '=', expecting ')' D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 226
ERROR - 2021-02-17 14:29:26 --> Severity: Parsing Error --> syntax error, unexpected 'echo' (T_ECHO) D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 232
ERROR - 2021-02-17 14:29:36 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 4: AND "quantity" > "received_quantity +" "cancle_quantity"
                                               ^ - Invalid query: SELECT "dealer_name", SUM(quantity - received_quantity - cancle_quantity) as total_quantity, SUM((quantity - received_quantity - cancle_quantity) * dealer_price) as total_amount
FROM "view_spareparts_dealer_order"
WHERE "pi_confirmed" = 1
AND "quantity" > "received_quantity +" "cancle_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "dealer_name"
ERROR - 2021-02-17 14:31:10 --> Query error: ERROR:  syntax error at or near ""`cancle_quantity`""
LINE 4: AND "`quantity`" > "`received_quantity` +" "`cancle_quantity...
                                                   ^ - Invalid query: SELECT "dealer_name", SUM(quantity - received_quantity - cancle_quantity) as total_quantity, SUM((quantity - received_quantity - cancle_quantity) * dealer_price) as total_amount
FROM "view_spareparts_dealer_order"
WHERE "pi_confirmed" = 1
AND "`quantity`" > "`received_quantity` +" "`cancle_quantity`"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "dealer_name"
ERROR - 2021-02-17 14:32:30 --> Query error: ERROR:  syntax error at or near ""`cancle_quantity`""
LINE 4: AND "`quantity`" > "`received_quantity` +" "`cancle_quantity...
                                                   ^ - Invalid query: SELECT "dealer_name", SUM(quantity - received_quantity - cancle_quantity) as total_quantity, SUM((quantity - received_quantity - cancle_quantity) * dealer_price) as total_amount
FROM "view_spareparts_dealer_order"
WHERE "pi_confirmed" = 1
AND "`quantity`" > "`received_quantity` +" "`cancle_quantity`"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "dealer_name"
ERROR - 2021-02-17 14:33:43 --> Query error: ERROR:  syntax error at or near ""cancle_quantity""
LINE 4: AND "quantity" > "received_quantity +" "cancle_quantity"
                                               ^ - Invalid query: SELECT "dealer_name", SUM(quantity - received_quantity - cancle_quantity) as total_quantity, SUM((quantity - received_quantity - cancle_quantity) * dealer_price) as total_amount
FROM "view_spareparts_dealer_order"
WHERE "pi_confirmed" = 1
AND "quantity" > "received_quantity +" "cancle_quantity"
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "dealer_name"
ERROR - 2021-02-17 14:34:41 --> Query error: ERROR:  column "view_spareparts_dealer_order.dealer_name" must appear in the GROUP BY clause or be used in an aggregate function
LINE 1: SELECT "dealer_name", SUM(quantity - received_quantity - can...
               ^ - Invalid query: SELECT "dealer_name", SUM(quantity - received_quantity - cancle_quantity) as total_quantity, SUM((quantity - received_quantity - cancle_quantity) * dealer_price) as total_amount
FROM "view_spareparts_dealer_order"
WHERE "pi_confirmed" = 1
AND "quantity" > (received_quantity + cancle_quantity)
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ORDER BY "dealer_name"
ERROR - 2021-02-17 15:11:40 --> Could not find the language line "latest_part_code"
ERROR - 2021-02-17 15:11:40 --> Could not find the language line "stock_value"
ERROR - 2021-02-17 15:27:39 --> Severity: Parsing Error --> syntax error, unexpected '$this' (T_VARIABLE) D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 276
ERROR - 2021-02-17 15:27:53 --> Severity: Error --> Call to undefined method CI_DB_pdo_result::reuslt() D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 271
ERROR - 2021-02-17 15:28:10 --> Severity: Notice --> Undefined variable: dealers D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 287
ERROR - 2021-02-17 15:35:52 --> Severity: Parsing Error --> syntax error, unexpected '=>' (T_DOUBLE_ARROW) D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:06 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$dealer_id D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 278
ERROR - 2021-02-17 15:36:07 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 282
ERROR - 2021-02-17 15:37:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 286
ERROR - 2021-02-17 15:37:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 286
ERROR - 2021-02-17 15:37:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 286
ERROR - 2021-02-17 15:37:12 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\daily_credits\controllers\Daily_credits.php 286
