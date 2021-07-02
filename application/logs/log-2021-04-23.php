<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-04-23 14:48:54 --> Could not find the language line "latest_part_code"
ERROR - 2021-04-23 14:48:54 --> Could not find the language line "stock_value"
ERROR - 2021-04-23 14:49:25 --> Could not find the language line "binning_confirm"
ERROR - 2021-04-23 14:49:25 --> Could not find the language line "binning_confirm"
ERROR - 2021-04-23 14:49:25 --> Could not find the language line "msil_orders_spareparts"
ERROR - 2021-04-23 14:53:21 --> Query error: ERROR:  column "for_sales" does not exist
LINE 4: AND "for_sales" = 1
            ^ - Invalid query: SELECT COUNT(DISTINCT engine_no) AS count
FROM "view_log_stock_record_working"
WHERE ("current_status" = 'Stock' OR "current_status" = 'repaired stock')
AND "for_sales" = 1
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
