<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-19 10:37:24 --> Query error: ERROR:  syntax error at or near "order"
LINE 3: WHERE  order  ILIKE '%423%' ESCAPE '!' 
               ^ - Invalid query: SELECT count(DISTINCT order_no) as total
FROM "view_sparepart_picklist"
WHERE  order  ILIKE '%423%' ESCAPE '!' 
AND "pi_number" IS NOT NULL
GROUP BY "order", "dealer_name", "pick_count", "picklist_no", "billed_status"
ERROR - 2020-02-19 10:37:33 --> Query error: ERROR:  syntax error at or near "order"
LINE 3: WHERE  order  ILIKE '%42%' ESCAPE '!' 
               ^ - Invalid query: SELECT count(DISTINCT order_no) as total
FROM "view_sparepart_picklist"
WHERE  order  ILIKE '%42%' ESCAPE '!' 
AND "pi_number" IS NOT NULL
GROUP BY "order", "dealer_name", "pick_count", "picklist_no", "billed_status"
ERROR - 2020-02-19 10:43:45 --> Could not find the language line "error"
ERROR - 2020-02-19 12:31:57 --> Query error: ERROR:  syntax error at or near "order"
LINE 3: WHERE  order  ILIKE '%423%' ESCAPE '!' 
               ^ - Invalid query: SELECT count(DISTINCT order_no) as total
FROM "view_sparepart_picklist"
WHERE  order  ILIKE '%423%' ESCAPE '!' 
AND "pi_number" IS NOT NULL
GROUP BY "order", "dealer_name", "pick_count", "picklist_no", "billed_status"
ERROR - 2020-02-19 12:33:46 --> Query error: ERROR:  syntax error at or near "order"
LINE 3: WHERE  order  ILIKE '%423%' ESCAPE '!' 
               ^ - Invalid query: SELECT count(DISTINCT order_no) as total
FROM "view_sparepart_picklist"
WHERE  order  ILIKE '%423%' ESCAPE '!' 
AND "pi_number" IS NOT NULL
GROUP BY "order", "dealer_name", "pick_count", "picklist_no", "billed_status"
ERROR - 2020-02-19 12:41:13 --> Query error: ERROR:  operator does not exist: integer ~~* text
LINE 3: WHERE  order_no  ILIKE '%12%' ESCAPE '!' 
                         ^
HINT:  No operator matches the given name and argument type(s). You might need to add explicit type casts. - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "view_report_spareparts_backorder"
WHERE  order_no  ILIKE '%12%' ESCAPE '!' 
AND "backorder" >0
AND "pi_number" IS NOT NULL
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-02-19 15:08:48 --> Severity: Notice --> Undefined property: stdClass::$picklist_format D:\xampp\htdocs\cgdms\modules\sparepart_orders\views\admin\new_picklist.php 63
ERROR - 2020-02-19 15:09:26 --> Severity: Notice --> Undefined variable: dispatched_date_nepali D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2512
ERROR - 2020-02-19 15:09:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2426
ERROR - 2020-02-19 15:10:34 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2427
ERROR - 2020-02-19 15:35:02 --> Could not find the language line "error"
