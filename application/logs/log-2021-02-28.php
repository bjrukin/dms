<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-02-28 09:42:56 --> Could not find the language line "groups"
ERROR - 2021-02-28 09:42:56 --> Could not find the language line "permission_users"
ERROR - 2021-02-28 09:44:17 --> Query error: ERROR:  operator does not exist: character varying = boolean
LINE 3: WHERE "name" = FALSE
                     ^
HINT:  No operator matches the given name and argument type(s). You might need to add explicit type casts. - Invalid query: SELECT *
FROM "aauth_permissions"
WHERE "name" = FALSE
ERROR - 2021-02-28 09:44:40 --> Could not find the language line "binning_confirm"
ERROR - 2021-02-28 09:44:41 --> Could not find the language line "binning_confirm"
ERROR - 2021-02-28 09:44:41 --> Could not find the language line "msil_orders_spareparts"
ERROR - 2021-02-28 09:44:55 --> Query error: ERROR:  operator does not exist: character varying = boolean
LINE 3: WHERE "name" = FALSE
                     ^
HINT:  No operator matches the given name and argument type(s). You might need to add explicit type casts. - Invalid query: SELECT *
FROM "aauth_permissions"
WHERE "name" = FALSE
ERROR - 2021-02-28 09:44:59 --> Query error: ERROR:  operator does not exist: character varying = boolean
LINE 3: WHERE "name" = FALSE
                     ^
HINT:  No operator matches the given name and argument type(s). You might need to add explicit type casts. - Invalid query: SELECT *
FROM "aauth_permissions"
WHERE "name" = FALSE
ERROR - 2021-02-28 10:04:39 --> Severity: Warning --> fsockopen(): php_network_getaddresses: getaddrinfo failed: No such host is known.  D:\xampp\htdocs\cgdms\system\libraries\Email.php 1990
ERROR - 2021-02-28 10:04:39 --> Severity: Warning --> fsockopen(): unable to connect to mail.cg.holding:465 (php_network_getaddresses: getaddrinfo failed: No such host is known. ) D:\xampp\htdocs\cgdms\system\libraries\Email.php 1990
ERROR - 2021-02-28 10:05:01 --> Could not find the language line "binning_confirm"
ERROR - 2021-02-28 10:05:01 --> Could not find the language line "binning_confirm"
ERROR - 2021-02-28 10:05:01 --> Could not find the language line "msil_orders_spareparts"
ERROR - 2021-02-28 10:05:25 --> Severity: Notice --> Undefined variable: order_no D:\xampp\htdocs\cgdms\modules\msil_orders_spareparts\views\admin\binning_list.php 70
ERROR - 2021-02-28 10:05:37 --> Severity: Notice --> Undefined variable: order_no D:\xampp\htdocs\cgdms\modules\msil_orders_spareparts\views\admin\binning_list.php 70
ERROR - 2021-02-28 10:05:50 --> Severity: Notice --> Undefined variable: order_no D:\xampp\htdocs\cgdms\modules\msil_orders_spareparts\views\admin\binning_list.php 70
ERROR - 2021-02-28 10:05:57 --> Severity: Notice --> Undefined variable: order_no D:\xampp\htdocs\cgdms\modules\msil_orders_spareparts\views\admin\binning_list.php 70
ERROR - 2021-02-28 10:06:05 --> Severity: Notice --> Undefined variable: order_no D:\xampp\htdocs\cgdms\modules\msil_orders_spareparts\views\admin\binning_list.php 70
ERROR - 2021-02-28 10:06:15 --> Query error: ERROR:  invalid input syntax for integer: "not"
LINE 3: WHERE "binning_status" = 'not'
                                 ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "view_spareparts_msil_dispatch_list"
WHERE "binning_status" = 'not'
AND ("deleted_at" > NOW() OR "deleted_at" IS NULL)
ERROR - 2021-02-28 10:06:54 --> Severity: Notice --> Undefined variable: order_no D:\xampp\htdocs\cgdms\modules\msil_orders_spareparts\views\admin\binning_list.php 70
