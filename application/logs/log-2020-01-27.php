<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-01-27 10:40:45 --> Query error: ERROR:  syntax error at or near "order"
LINE 3: WHERE  order  ILIKE '%423%' ESCAPE '!' 
               ^ - Invalid query: SELECT count(DISTINCT order_no) as total
FROM "view_sparepart_picklist"
WHERE  order  ILIKE '%423%' ESCAPE '!' 
AND "pi_number" IS NOT NULL
GROUP BY "order", "dealer_name", "pick_count"
ERROR - 2020-01-27 10:41:35 --> Query error: ERROR:  operator does not exist: integer ~~* text
LINE 3: WHERE  order_no  ILIKE '%423%' ESCAPE '!' 
                         ^
HINT:  No operator matches the given name and argument type(s). You might need to add explicit type casts. - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "view_report_spareparts_backorder"
WHERE  order_no  ILIKE '%423%' ESCAPE '!' 
AND "backorder" >0
AND "pi_number" IS NOT NULL
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-27 12:14:24 --> Query error: ERROR:  column "year_np" does not exist
LINE 4: AND "year_np" = '2076'
            ^ - Invalid query: SELECT *
FROM "view_dispatch_spareparts"
WHERE "bill_no" = '7609'
AND "year_np" = '2076'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-27 12:17:02 --> Query error: ERROR:  column "year_np" does not exist
LINE 4: AND "year_np" = '2076'
            ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "view_dispatch_spareparts"
WHERE "bill_no" = '7609'
AND "year_np" = '2076'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2020-01-27 12:20:23 --> Severity: Notice --> Undefined variable: discount_percentage D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2361
ERROR - 2020-01-27 12:20:23 --> Severity: Notice --> Undefined variable: discount_percentage D:\xampp\htdocs\cgdms\modules\sparepart_orders\controllers\Sparepart_orders.php 2362
ERROR - 2020-01-27 15:46:53 --> Could not find the language line "latest_part_code"
ERROR - 2020-01-27 15:46:53 --> Could not find the language line "stock_value"
