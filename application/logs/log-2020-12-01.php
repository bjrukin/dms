<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-12-01 10:16:25 --> Could not find the language line "latest_part_code"
ERROR - 2020-12-01 10:16:25 --> Could not find the language line "stock_value"
ERROR - 2020-12-01 10:17:42 --> Could not find the language line "part"
ERROR - 2020-12-01 10:25:28 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\counter_sales\controllers\Counter_sales.php 1299
ERROR - 2020-12-01 10:25:28 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\counter_sales\controllers\Counter_sales.php 1300
ERROR - 2020-12-01 10:25:28 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\cgdms\modules\counter_sales\controllers\Counter_sales.php 1337
ERROR - 2020-12-01 10:25:28 --> Query error: ERROR:  null value in column "table_pk" violates not-null constraint
DETAIL:  Failing row contains (4162285, 502, spareparts_dealer_stock, null, quantity, null, -1, 2020-12-01 10:25:28). - Invalid query: INSERT INTO "project_audit_logs" ("action_dttime", "column_name", "new_value", "old_value", "table_name", "table_pk", "user_id") VALUES ('2020-12-01 10:25:28','quantity',-1,NULL,'spareparts_dealer_stock',NULL,502)
ERROR - 2020-12-01 12:24:55 --> Query error: ERROR:  syntax error at or near ","
LINE 10:  "creadit_account" float(10,2) NULL,
                                    ^ - Invalid query: CREATE TABLE "spareparts_countersales" (
	"id" SERIAL NOT NULL,
	"created_by" INT NULL,
	"updated_by" INT NULL,
	"deleted_by" INT NULL,
	"created_at" timestamp DEFAULT NULL NULL,
	"updated_at" timestamp DEFAULT NULL NULL,
	"deleted_at" timestamp DEFAULT NULL NULL,
	"issue_date" date NULL,
	"creadit_account" float(10,2) NULL,
	"price_option" varchar(255) NULL,
	"vro" float(10,2) NULL,
	"countersale_no" int NULL,
	"issueCountersaeIssueNo" int NULL,
	"total_for_parts" float(11) NULL,
	"dealer_total_for_parts" float(10,2) NULL,
	"cash_discount_percent" float(10,2) NULL,
	"cash_discount_amt" float(10,2) NULL,
	"vat" float(10,2) NULL,
	"vat_parts" float(10,2) NULL,
	"net_total" float(10,2) NULL,
	CONSTRAINT "pk_spareparts_countersales" PRIMARY KEY("id")
)
ERROR - 2020-12-01 12:29:46 --> Query error: ERROR:  syntax error at or near ","
LINE 10:  "creadit_account" float(10,2) NOT NULL,
                                    ^ - Invalid query: CREATE TABLE "spareparts_countersales" (
	"id" SERIAL NOT NULL,
	"created_by" INT NULL,
	"updated_by" INT NULL,
	"deleted_by" INT NULL,
	"created_at" timestamp DEFAULT NULL NULL,
	"updated_at" timestamp DEFAULT NULL NULL,
	"deleted_at" timestamp DEFAULT NULL NULL,
	"issue_date" date NULL,
	"creadit_account" float(10,2) NOT NULL,
	"price_option" varchar(255) NULL,
	"vro" float(10,2) NOT NULL,
	"countersale_no" int NULL,
	"issueCountersaeIssueNo" int NULL,
	"total_for_parts" float(10,2) NOT NULL,
	"dealer_total_for_parts" float(10,2) NOT NULL,
	"cash_discount_percent" float(10,2) NOT NULL,
	"cash_discount_amt" float(10,2) NOT NULL,
	"vat" float(10,2) NOT NULL,
	"vat_parts" float(10,2) NOT NULL,
	"net_total" float(10,2) NOT NULL,
	CONSTRAINT "pk_spareparts_countersales" PRIMARY KEY("id")
)
ERROR - 2020-12-01 12:32:16 --> Query error: ERROR:  syntax error at or near ","
LINE 11:  "total" float(10,2) NULL,
                          ^ - Invalid query: CREATE TABLE "spareparts_countersale_parts" (
	"id" SERIAL NOT NULL,
	"created_by" INT NULL,
	"updated_by" INT NULL,
	"deleted_by" INT NULL,
	"created_at" timestamp DEFAULT NULL NULL,
	"updated_at" timestamp DEFAULT NULL NULL,
	"deleted_at" timestamp DEFAULT NULL NULL,
	"sparepart_id" date NULL,
	"quantity" int NULL,
	"total" float(10,2) NULL,
	"dealer_price" float(10,2) NULL,
	"dealer_price_total" float(10,2) NULL,
	CONSTRAINT "pk_spareparts_countersale_parts" PRIMARY KEY("id")
)
ERROR - 2020-12-01 12:34:11 --> Could not find the language line "backendpro_tools"
ERROR - 2020-12-01 12:34:11 --> Could not find the language line "backendpro_module_generator"
ERROR - 2020-12-01 12:37:40 --> Could not find the language line "backendpro_tools"
ERROR - 2020-12-01 12:37:40 --> Could not find the language line "backendpro_module_generator"
ERROR - 2020-12-01 13:06:07 --> Could not find the language line "part"
ERROR - 2020-12-01 13:06:13 --> Could not find the language line "part"
ERROR - 2020-12-01 13:06:21 --> Could not find the language line "part"
ERROR - 2020-12-01 13:07:11 --> Could not find the language line "part"
ERROR - 2020-12-01 13:07:56 --> Could not find the language line "part"
ERROR - 2020-12-01 13:08:13 --> Could not find the language line "groups"
ERROR - 2020-12-01 13:08:13 --> Could not find the language line "permission_users"
ERROR - 2020-12-01 13:09:07 --> Could not find the language line "part"
ERROR - 2020-12-01 13:09:11 --> Could not find the language line "part"
ERROR - 2020-12-01 13:09:30 --> Could not find the language line "part"
ERROR - 2020-12-01 13:09:36 --> 404 Page Not Found: /index
ERROR - 2020-12-01 13:10:31 --> Could not find the language line "part"
ERROR - 2020-12-01 13:10:36 --> Could not find the language line "part"
ERROR - 2020-12-01 13:10:42 --> Query error: ERROR:  operator does not exist: character varying = boolean
LINE 3: WHERE "name" = FALSE
                     ^
HINT:  No operator matches the given name and argument type(s). You might need to add explicit type casts. - Invalid query: SELECT *
FROM "aauth_permissions"
WHERE "name" = FALSE
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "counter_sales"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "counter_sales"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "part_name"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "date_time"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "counter_sales_id"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "party_name"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "is_request_complete"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "add_parts"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "part"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "part_name"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "part_code"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "price"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "dealer_price"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "total"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "total"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "part_name"
ERROR - 2020-12-01 13:13:41 --> Could not find the language line "part_code"
ERROR - 2020-12-01 13:13:42 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:13:42 --> Could not find the language line "part_name"
ERROR - 2020-12-01 13:13:42 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:13:42 --> Could not find the language line "part_name"
ERROR - 2020-12-01 13:13:42 --> Could not find the language line "part_code"
ERROR - 2020-12-01 13:13:42 --> Could not find the language line "issued_qty"
ERROR - 2020-12-01 13:13:42 --> Could not find the language line "price"
ERROR - 2020-12-01 13:13:42 --> Could not find the language line "discount"
ERROR - 2020-12-01 13:13:42 --> Could not find the language line "quantity_to_bill"
ERROR - 2020-12-01 13:13:42 --> Could not find the language line "total"
ERROR - 2020-12-01 13:31:04 --> Could not find the language line "backendpro_tools"
ERROR - 2020-12-01 13:31:04 --> Could not find the language line "backendpro_module_generator"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "counter_sales"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "counter_sales"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "part_name"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "date_time"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "counter_sales_id"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "party_name"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "is_request_complete"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "part"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "part_name"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "part_code"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "price"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "dealer_price"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "total"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "total"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "part_name"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "part_code"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "part_name"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "part_name"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "part_code"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "issued_qty"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "price"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "discount"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "quantity_to_bill"
ERROR - 2020-12-01 13:40:42 --> Could not find the language line "total"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "counter_sales"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "counter_sales"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "date_time"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "counter_sales_id"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "party_name"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "is_request_complete"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "part"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "total"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "total"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "issued_qty"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "discount"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "quantity_to_bill"
ERROR - 2020-12-01 13:42:30 --> Could not find the language line "total"
ERROR - 2020-12-01 13:43:23 --> Could not find the language line "counter_sales"
ERROR - 2020-12-01 13:43:23 --> Could not find the language line "counter_sales"
ERROR - 2020-12-01 13:43:23 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:43:23 --> Could not find the language line "date_time"
ERROR - 2020-12-01 13:43:23 --> Could not find the language line "counter_sales_id"
ERROR - 2020-12-01 13:43:23 --> Could not find the language line "party_name"
ERROR - 2020-12-01 13:43:23 --> Could not find the language line "is_request_complete"
ERROR - 2020-12-01 13:43:23 --> Could not find the language line "part"
ERROR - 2020-12-01 13:43:23 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:43:23 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:43:23 --> Could not find the language line "quantity"
ERROR - 2020-12-01 13:43:23 --> Could not find the language line "issued_qty"
ERROR - 2020-12-01 13:43:23 --> Could not find the language line "discount"
ERROR - 2020-12-01 13:43:23 --> Could not find the language line "quantity_to_bill"
ERROR - 2020-12-01 14:16:04 --> 404 Page Not Found: /index
ERROR - 2020-12-01 14:16:04 --> 404 Page Not Found: /index
ERROR - 2020-12-01 14:18:05 --> Could not find the language line "counter_sales_id"
ERROR - 2020-12-01 14:18:05 --> Could not find the language line "party_name"
ERROR - 2020-12-01 14:18:05 --> Could not find the language line "part"
ERROR - 2020-12-01 14:19:31 --> Could not find the language line "counter_sales_id"
ERROR - 2020-12-01 14:19:31 --> Could not find the language line "part"
ERROR - 2020-12-01 14:19:55 --> Could not find the language line "counter_sales_id"
ERROR - 2020-12-01 14:19:55 --> Could not find the language line "part"
ERROR - 2020-12-01 14:20:00 --> Could not find the language line "part"
ERROR - 2020-12-01 14:20:32 --> Could not find the language line "part"
ERROR - 2020-12-01 14:20:37 --> Could not find the language line "part"
ERROR - 2020-12-01 14:20:55 --> Could not find the language line "part"
ERROR - 2020-12-01 14:22:42 --> 404 Page Not Found: /index
ERROR - 2020-12-01 14:24:55 --> Could not find the language line "part"
ERROR - 2020-12-01 14:25:10 --> 404 Page Not Found: /index
ERROR - 2020-12-01 14:25:14 --> 404 Page Not Found: /index
ERROR - 2020-12-01 14:25:39 --> Could not find the language line "part"
ERROR - 2020-12-01 14:25:47 --> 404 Page Not Found: /index
ERROR - 2020-12-01 14:25:50 --> Severity: Notice --> Undefined property: CI::$counter_sale_model D:\xampp\htdocs\cgdms\application\libraries\MX\Controller.php 60
ERROR - 2020-12-01 14:25:50 --> Severity: Notice --> Indirect modification of overloaded property Stockyard_countersales::$counter_sale_model has no effect D:\xampp\htdocs\cgdms\modules\stockyard_countersales\controllers\Stockyard_countersales.php 118
ERROR - 2020-12-01 14:25:50 --> Severity: Warning --> Creating default object from empty value D:\xampp\htdocs\cgdms\modules\stockyard_countersales\controllers\Stockyard_countersales.php 118
ERROR - 2020-12-01 14:25:50 --> Severity: Notice --> Undefined property: CI::$counter_sale_model D:\xampp\htdocs\cgdms\application\libraries\MX\Controller.php 60
ERROR - 2020-12-01 14:25:50 --> Severity: Error --> Call to a member function find() on null D:\xampp\htdocs\cgdms\modules\stockyard_countersales\controllers\Stockyard_countersales.php 124
ERROR - 2020-12-01 14:26:33 --> Could not find the language line "part"
ERROR - 2020-12-01 14:26:45 --> 404 Page Not Found: /index
ERROR - 2020-12-01 14:26:50 --> Severity: Error --> Cannot access protected property Stockyard_countersale_model::$_table D:\xampp\htdocs\cgdms\modules\stockyard_countersales\controllers\Stockyard_countersales.php 118
ERROR - 2020-12-01 14:27:20 --> 404 Page Not Found: /index
ERROR - 2020-12-01 14:27:40 --> 404 Page Not Found: /index
ERROR - 2020-12-01 14:31:48 --> Could not find the language line "part"
ERROR - 2020-12-01 14:39:24 --> Could not find the language line "part"
ERROR - 2020-12-01 14:45:20 --> Could not find the language line "part"
ERROR - 2020-12-01 15:35:30 --> Severity: Parsing Error --> syntax error, unexpected '=>' (T_DOUBLE_ARROW) D:\xampp\htdocs\cgdms\modules\stockyard_countersales\controllers\Stockyard_countersales.php 172
ERROR - 2020-12-01 15:35:41 --> Query error: ERROR:  column "vro" of relation "spareparts_stockyard_countersales" does not exist
LINE 1: ..., "issue_date", "credit_account", "price_option", "vro", "co...
                                                             ^ - Invalid query: INSERT INTO "spareparts_stockyard_countersales" ("counter_sales_id", "issue_date", "credit_account", "price_option", "vro", "countersale_no", "total_for_parts", "dealer_total_for_parts", "cash_discount_percent", "cash_discount_amt", "vat", "vat_parts", "net_total", "stockyrad_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('', '2020-12-01 14:45:28', '', 'price', '0', '', '8', '11', '', '0', '13', '1.04', '9.04', 2, 502, 502, '2020-12-01 15:35:41', '2020-12-01 15:35:41')
ERROR - 2020-12-01 15:36:06 --> Query error: ERROR:  column "stockyrad_id" of relation "spareparts_stockyard_countersales" does not exist
LINE 1: ...h_discount_amt", "vat", "vat_parts", "net_total", "stockyrad...
                                                             ^ - Invalid query: INSERT INTO "spareparts_stockyard_countersales" ("counter_sales_id", "issue_date", "credit_account", "price_option", "vor", "countersale_no", "total_for_parts", "dealer_total_for_parts", "cash_discount_percent", "cash_discount_amt", "vat", "vat_parts", "net_total", "stockyrad_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('', '2020-12-01 14:45:28', '', 'price', '0', '', '8', '11', '', '0', '13', '1.04', '9.04', 2, 502, 502, '2020-12-01 15:36:06', '2020-12-01 15:36:06')
ERROR - 2020-12-01 15:38:17 --> Query error: ERROR:  invalid input syntax for integer: ""
LINE 1: ..."updated_by", "created_at", "updated_at") VALUES ('', '2020-...
                                                             ^ - Invalid query: INSERT INTO "spareparts_stockyard_countersales" ("counter_sales_id", "issue_date", "credit_account", "price_option", "vor", "countersale_no", "total_for_parts", "dealer_total_for_parts", "cash_discount_percent", "cash_discount_amt", "vat", "vat_parts", "net_total", "stockyard_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('', '2020-12-01 14:45:28', '', 'price', '0', '', '8', '11', '', '0', '13', '1.04', '9.04', 2, 502, 502, '2020-12-01 15:38:17', '2020-12-01 15:38:17')
ERROR - 2020-12-01 15:40:20 --> Query error: ERROR:  invalid input syntax for integer: ""
LINE 1: ..."updated_by", "created_at", "updated_at") VALUES ('', '2020-...
                                                             ^ - Invalid query: INSERT INTO "spareparts_stockyard_countersales" ("counter_sales_id", "issue_date", "credit_account", "price_option", "vor", "countersale_no", "total_for_parts", "dealer_total_for_parts", "cash_discount_percent", "cash_discount_amt", "vat", "vat_parts", "net_total", "stockyard_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('', '2020-12-01 14:45:28', '', 'price', '0', '', '8', '11', '', '0', '13', '1.04', '9.04', 2, 502, 502, '2020-12-01 15:40:20', '2020-12-01 15:40:20')
ERROR - 2020-12-01 15:41:30 --> Query error: ERROR:  invalid input syntax for integer: ""
LINE 1: ..."updated_by", "created_at", "updated_at") VALUES ('', '2020-...
                                                             ^ - Invalid query: INSERT INTO "spareparts_stockyard_countersales" ("counter_sales_id", "issue_date", "credit_account", "price_option", "vor", "countersale_no", "total_for_parts", "dealer_total_for_parts", "cash_discount_percent", "cash_discount_amt", "vat", "vat_parts", "net_total", "stockyard_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('', '2020-12-01 14:45:28', '', 'price', '0', '', '8', '11', '', '0', '13', '1.04', '9.04', 2, 502, 502, '2020-12-01 15:41:30', '2020-12-01 15:41:30')
ERROR - 2020-12-01 15:43:56 --> Query error: ERROR:  invalid input syntax for integer: ""
LINE 1: ..."updated_by", "created_at", "updated_at") VALUES ('', '2020-...
                                                             ^ - Invalid query: INSERT INTO "spareparts_stockyard_countersales" ("counter_sales_id", "issue_date", "credit_account", "price_option", "vor", "countersale_no", "total_for_parts", "dealer_total_for_parts", "cash_discount_percent", "cash_discount_amt", "vat", "vat_parts", "net_total", "stockyard_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('', '2020-12-01 14:45:28', '', 'price', '0', '', '8', '11', '', '0', '13', '1.04', '9.04', 2, 502, 502, '2020-12-01 15:43:56', '2020-12-01 15:43:56')
ERROR - 2020-12-01 15:45:22 --> Query error: ERROR:  invalid input syntax for type numeric: ""
LINE 1: ...at", "updated_at") VALUES ('2020-12-01 14:45:28', '', 'price...
                                                             ^ - Invalid query: INSERT INTO "spareparts_stockyard_countersales" ("issue_date", "credit_account", "price_option", "vor", "countersale_no", "total_for_parts", "dealer_total_for_parts", "cash_discount_percent", "cash_discount_amt", "vat", "vat_parts", "net_total", "stockyard_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('2020-12-01 14:45:28', '', 'price', '0', '', '8', '11', '', '0', '13', '1.04', '9.04', 2, 502, 502, '2020-12-01 15:45:22', '2020-12-01 15:45:22')
ERROR - 2020-12-01 15:46:16 --> Could not find the language line "part"
ERROR - 2020-12-01 15:46:57 --> Query error: ERROR:  invalid input syntax for integer: ""
LINE 1: ...ALUES ('2020-12-01 15:46:19', '48', 'price', '0', '', '8', '...
                                                             ^ - Invalid query: INSERT INTO "spareparts_stockyard_countersales" ("issue_date", "credit_account", "price_option", "vor", "countersale_no", "total_for_parts", "dealer_total_for_parts", "cash_discount_percent", "cash_discount_amt", "vat", "vat_parts", "net_total", "stockyard_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('2020-12-01 15:46:19', '48', 'price', '0', '', '8', '11', '', '0', '13', '1.04', '9.04', 2, 502, 502, '2020-12-01 15:46:57', '2020-12-01 15:46:57')
ERROR - 2020-12-01 15:56:01 --> Severity: Parsing Error --> syntax error, unexpected '=>' (T_DOUBLE_ARROW) D:\xampp\htdocs\cgdms\modules\stockyard_countersales\controllers\Stockyard_countersales.php 226
ERROR - 2020-12-01 15:56:17 --> Query error: ERROR:  invalid input syntax for type numeric: ""
LINE 1: ...2-01 15:46:19', '48', 'price', '0', 1, '8', '11', '', '0', '...
                                                             ^ - Invalid query: INSERT INTO "spareparts_stockyard_countersales" ("issue_date", "credit_account", "price_option", "vor", "countersale_no", "total_for_parts", "dealer_total_for_parts", "cash_discount_percent", "cash_discount_amt", "vat", "vat_parts", "net_total", "stockyard_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('2020-12-01 15:46:19', '48', 'price', '0', 1, '8', '11', '', '0', '13', '1.04', '9.04', 2, 502, 502, '2020-12-01 15:56:17', '2020-12-01 15:56:17')
ERROR - 2020-12-01 15:57:31 --> Severity: Notice --> Undefined index: id D:\xampp\htdocs\cgdms\modules\stockyard_countersales\controllers\Stockyard_countersales.php 196
ERROR - 2020-12-01 16:09:54 --> Could not find the language line "part"
ERROR - 2020-12-01 16:10:57 --> Severity: Notice --> Undefined index: id D:\xampp\htdocs\cgdms\modules\stockyard_countersales\controllers\Stockyard_countersales.php 196
ERROR - 2020-12-01 16:16:34 --> Could not find the language line "part"
ERROR - 2020-12-01 16:16:34 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 16:26:39 --> Could not find the language line "part"
ERROR - 2020-12-01 16:26:39 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 16:30:44 --> Could not find the language line "part"
ERROR - 2020-12-01 16:30:44 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 16:35:34 --> Could not find the language line "part"
ERROR - 2020-12-01 16:35:34 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 16:36:12 --> Could not find the language line "part"
ERROR - 2020-12-01 16:36:12 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 16:37:23 --> Could not find the language line "part"
ERROR - 2020-12-01 16:37:23 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 16:39:01 --> Could not find the language line "part"
ERROR - 2020-12-01 16:39:02 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 17:03:05 --> Query error: ERROR:  invalid input syntax for type numeric: ""
LINE 1: ...at", "updated_at") VALUES ('2020-12-01 16:39:05', '', 'price...
                                                             ^ - Invalid query: INSERT INTO "spareparts_stockyard_countersales" ("issue_date", "credit_account", "price_option", "vor", "countersale_no", "total_for_parts", "dealer_total_for_parts", "cash_discount_percent", "cash_discount_amt", "vat", "vat_parts", "net_total", "stockyard_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('2020-12-01 16:39:05', '', 'price', '0', 1, '8', '11', 0, '0', '13', '1.04', '9.04', 2, 502, 502, '2020-12-01 17:03:05', '2020-12-01 17:03:05')
ERROR - 2020-12-01 17:04:00 --> Could not find the language line "part"
ERROR - 2020-12-01 17:04:00 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 17:04:33 --> Query error: ERROR:  invalid input syntax for type numeric: ""
LINE 1: ...at", "updated_at") VALUES ('2020-12-01 17:04:03', '', 'price...
                                                             ^ - Invalid query: INSERT INTO "spareparts_stockyard_countersales" ("issue_date", "credit_account", "price_option", "vor", "countersale_no", "total_for_parts", "dealer_total_for_parts", "cash_discount_percent", "cash_discount_amt", "vat", "vat_parts", "net_total", "stockyard_id", "created_by", "updated_by", "created_at", "updated_at") VALUES ('2020-12-01 17:04:03', '', 'price', '0', 1, '8', '11', 0, '0', '13', '1.04', '9.04', 2, 502, 502, '2020-12-01 17:04:33', '2020-12-01 17:04:33')
ERROR - 2020-12-01 17:04:52 --> Could not find the language line "part"
ERROR - 2020-12-01 17:04:52 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 17:05:18 --> Query error: ERROR:  invalid input syntax for type date: "113"
LINE 1: ..."updated_by", "created_at", "updated_at") VALUES ('113', '1'...
                                                             ^ - Invalid query: INSERT INTO "spareparts_stockyard_countersale_parts" ("sparepart_id", "quantity", "dealer_price", "dealer_price_total", "total", "created_by", "updated_by", "created_at", "updated_at") VALUES ('113', '1', '11', '11', '8', 502, 502, '2020-12-01 17:05:18', '2020-12-01 17:05:18')
ERROR - 2020-12-01 17:06:41 --> Query error: ERROR:  invalid input syntax for type date: "113"
LINE 1: ..."updated_by", "created_at", "updated_at") VALUES ('113', '1'...
                                                             ^ - Invalid query: INSERT INTO "spareparts_stockyard_countersale_parts" ("sparepart_id", "quantity", "dealer_price", "dealer_price_total", "total", "created_by", "updated_by", "created_at", "updated_at") VALUES ('113', '1', '11', '11', '8', 502, 502, '2020-12-01 17:06:41', '2020-12-01 17:06:41')
ERROR - 2020-12-01 17:07:13 --> Query error: ERROR:  column "sparepart_id" is of type date but expression is of type integer
LINE 1: ..."updated_by", "created_at", "updated_at") VALUES (113, '1', ...
                                                             ^
HINT:  You will need to rewrite or cast the expression. - Invalid query: INSERT INTO "spareparts_stockyard_countersale_parts" ("sparepart_id", "quantity", "dealer_price", "dealer_price_total", "total", "created_by", "updated_by", "created_at", "updated_at") VALUES (113, '1', '11', '11', '8', 502, 502, '2020-12-01 17:07:13', '2020-12-01 17:07:13')
ERROR - 2020-12-01 17:10:58 --> Could not find the language line "part"
ERROR - 2020-12-01 17:10:58 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 17:14:09 --> Could not find the language line "part"
ERROR - 2020-12-01 17:14:09 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 17:15:12 --> Could not find the language line "part"
ERROR - 2020-12-01 17:15:12 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 17:16:17 --> Could not find the language line "part"
ERROR - 2020-12-01 17:16:17 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 17:16:25 --> Could not find the language line "part"
ERROR - 2020-12-01 17:16:25 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 17:17:59 --> Could not find the language line "part"
ERROR - 2020-12-01 17:17:59 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 17:18:58 --> Could not find the language line "part"
ERROR - 2020-12-01 17:18:58 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 17:48:52 --> Could not find the language line "latest_part_code"
ERROR - 2020-12-01 17:48:52 --> Could not find the language line "stock_value"
ERROR - 2020-12-01 17:48:57 --> Severity: Error --> Call to undefined function remove_stock() D:\xampp\htdocs\cgdms\modules\stockyard_countersales\controllers\Stockyard_countersales.php 204
ERROR - 2020-12-01 17:49:21 --> Could not find the language line "part"
ERROR - 2020-12-01 17:49:21 --> Could not find the language line "sparepart_id"
ERROR - 2020-12-01 17:55:24 --> Severity: Parsing Error --> syntax error, unexpected '=', expecting ')' D:\xampp\htdocs\cgdms\modules\stockyard_countersales\controllers\Stockyard_countersales.php 203
