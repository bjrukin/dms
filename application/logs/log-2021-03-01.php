<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-03-01 10:14:38 --> Could not find the language line "latest_part_code"
ERROR - 2021-03-01 10:14:38 --> Could not find the language line "stock_value"
ERROR - 2021-03-01 10:15:29 --> Query error: ERROR:  invalid input syntax for integer: ""
LINE 1: ...ck_adjustment" SET "id" = '503', "sparepart_id" = '', "old_s...
                                                             ^ - Invalid query: UPDATE "spareparts_stock_adjustment" SET "id" = '503', "sparepart_id" = '', "old_stock" = '', "new_stock" = '1', "remarks" = '', "requested_by" = 1, "requested_date" = '2021-03-01', "requested_date_np" = '2077-11-17', "updated_by" = 1, "updated_at" = '2021-03-01 10:15:29'
WHERE "id" = '503'
ERROR - 2021-03-01 10:25:11 --> Query error: ERROR:  relation "view_spareparts_damage_stock" does not exist
LINE 2: FROM "view_spareparts_damage_stock"
             ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "view_spareparts_damage_stock"
WHERE ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2021-03-01 13:22:53 --> Could not find the language line "error"
ERROR - 2021-03-01 14:08:16 --> Could not find the language line "error"
ERROR - 2021-03-01 14:08:47 --> Could not find the language line "error"
ERROR - 2021-03-01 14:09:10 --> Could not find the language line "error"
ERROR - 2021-03-01 14:10:18 --> Could not find the language line "groups"
ERROR - 2021-03-01 14:10:18 --> Could not find the language line "permission_users"
ERROR - 2021-03-01 14:10:24 --> Could not find the language line "permission_users"
ERROR - 2021-03-01 14:11:45 --> Could not find the language line "groups"
ERROR - 2021-03-01 14:11:45 --> Could not find the language line "permission_users"
ERROR - 2021-03-01 14:12:27 --> Severity: Warning --> fsockopen(): php_network_getaddresses: getaddrinfo failed: No such host is known.  D:\xampp\htdocs\cgdms\system\libraries\Email.php 1990
ERROR - 2021-03-01 14:12:27 --> Severity: Warning --> fsockopen(): unable to connect to mail.cg.holding:465 (php_network_getaddresses: getaddrinfo failed: No such host is known. ) D:\xampp\htdocs\cgdms\system\libraries\Email.php 1990
ERROR - 2021-03-01 14:13:17 --> Could not find the language line "error"
ERROR - 2021-03-01 14:13:35 --> Could not find the language line "error"
