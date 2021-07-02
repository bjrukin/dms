/*
Navicat PGSQL Data Transfer

Source Server         : cg_serverdatabase
Source Server Version : 90410
Source Host           : localhost:5432
Source Database       : cgdms
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 90410
File Encoding         : 65001

Date: 2021-06-28 11:14:18
*/


-- ----------------------------
-- Sequence structure for aauth_assitant_dealers_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."aauth_assitant_dealers_id_seq";
CREATE SEQUENCE "public"."aauth_assitant_dealers_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 2
 CACHE 1;
SELECT setval('"public"."aauth_assitant_dealers_id_seq"', 2, true);

-- ----------------------------
-- Sequence structure for aauth_groups_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."aauth_groups_id_seq";
CREATE SEQUENCE "public"."aauth_groups_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1000
 CACHE 1;
SELECT setval('"public"."aauth_groups_id_seq"', 1000, true);

-- ----------------------------
-- Sequence structure for aauth_login_attempts_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."aauth_login_attempts_id_seq";
CREATE SEQUENCE "public"."aauth_login_attempts_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 306695
 CACHE 1;
SELECT setval('"public"."aauth_login_attempts_id_seq"', 306695, true);

-- ----------------------------
-- Sequence structure for aauth_permissions_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."aauth_permissions_id_seq";
CREATE SEQUENCE "public"."aauth_permissions_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 242
 CACHE 1;
SELECT setval('"public"."aauth_permissions_id_seq"', 242, true);

-- ----------------------------
-- Sequence structure for aauth_pms_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."aauth_pms_id_seq";
CREATE SEQUENCE "public"."aauth_pms_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for aauth_user_variables_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."aauth_user_variables_id_seq";
CREATE SEQUENCE "public"."aauth_user_variables_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for aauth_users_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."aauth_users_id_seq";
CREATE SEQUENCE "public"."aauth_users_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 843
 CACHE 1;
SELECT setval('"public"."aauth_users_id_seq"', 843, true);

-- ----------------------------
-- Sequence structure for ccd_2nd_smr_days_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ccd_2nd_smr_days_id_seq";
CREATE SEQUENCE "public"."ccd_2nd_smr_days_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9999999999999999
 START 143347
 CACHE 1;
SELECT setval('"public"."ccd_2nd_smr_days_id_seq"', 143347, true);

-- ----------------------------
-- Sequence structure for ccd_general_smr_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ccd_general_smr_id_seq";
CREATE SEQUENCE "public"."ccd_general_smr_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 999999999999999999
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for ccd_inquiry_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ccd_inquiry_id_seq";
CREATE SEQUENCE "public"."ccd_inquiry_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 145148
 CACHE 1;
SELECT setval('"public"."ccd_inquiry_id_seq"', 145148, true);

-- ----------------------------
-- Sequence structure for ccd_lostcase_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ccd_lostcase_id_seq";
CREATE SEQUENCE "public"."ccd_lostcase_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 43778
 CACHE 1;
SELECT setval('"public"."ccd_lostcase_id_seq"', 43778, true);

-- ----------------------------
-- Sequence structure for ccd_lostcase_reason_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ccd_lostcase_reason_id_seq";
CREATE SEQUENCE "public"."ccd_lostcase_reason_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for ccd_lostcase_vehicles_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ccd_lostcase_vehicles_id_seq";
CREATE SEQUENCE "public"."ccd_lostcase_vehicles_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for ccd_post_service_followup_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ccd_post_service_followup_id_seq";
CREATE SEQUENCE "public"."ccd_post_service_followup_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9999999999999
 START 58321
 CACHE 1;
SELECT setval('"public"."ccd_post_service_followup_id_seq"', 58321, true);

-- ----------------------------
-- Sequence structure for ccd_sixtyday_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ccd_sixtyday_id_seq";
CREATE SEQUENCE "public"."ccd_sixtyday_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 16707
 CACHE 1;
SELECT setval('"public"."ccd_sixtyday_id_seq"', 16707, true);

-- ----------------------------
-- Sequence structure for ccd_smr_twentyone_days_id_sql
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ccd_smr_twentyone_days_id_sql";
CREATE SEQUENCE "public"."ccd_smr_twentyone_days_id_sql"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 999999999999999
 START 4893
 CACHE 1;
SELECT setval('"public"."ccd_smr_twentyone_days_id_sql"', 4893, true);

-- ----------------------------
-- Sequence structure for ccd_thirtyday_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ccd_thirtyday_id_seq";
CREATE SEQUENCE "public"."ccd_thirtyday_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 16707
 CACHE 1;
SELECT setval('"public"."ccd_thirtyday_id_seq"', 16707, true);

-- ----------------------------
-- Sequence structure for ccd_threeday_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ccd_threeday_id_seq";
CREATE SEQUENCE "public"."ccd_threeday_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 16707
 CACHE 1;
SELECT setval('"public"."ccd_threeday_id_seq"', 16707, true);

-- ----------------------------
-- Sequence structure for crm_vehicle_edit_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."crm_vehicle_edit_id_seq";
CREATE SEQUENCE "public"."crm_vehicle_edit_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 2143
 CACHE 1;
SELECT setval('"public"."crm_vehicle_edit_id_seq"', 2143, true);

-- ----------------------------
-- Sequence structure for d2d_billing_detail_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."d2d_billing_detail_id_seq";
CREATE SEQUENCE "public"."d2d_billing_detail_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1097
 CACHE 1;
SELECT setval('"public"."d2d_billing_detail_id_seq"', 1097, true);

-- ----------------------------
-- Sequence structure for d2d_billing_list_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."d2d_billing_list_id_seq";
CREATE SEQUENCE "public"."d2d_billing_list_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 6203
 CACHE 1;
SELECT setval('"public"."d2d_billing_list_id_seq"', 6203, true);

-- ----------------------------
-- Sequence structure for dms_customer_followups_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dms_customer_followups_id_seq";
CREATE SEQUENCE "public"."dms_customer_followups_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 340941
 CACHE 1;
SELECT setval('"public"."dms_customer_followups_id_seq"', 340941, true);

-- ----------------------------
-- Sequence structure for dms_customer_statuses_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dms_customer_statuses_id_seq";
CREATE SEQUENCE "public"."dms_customer_statuses_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 344076
 CACHE 1;
SELECT setval('"public"."dms_customer_statuses_id_seq"', 344076, true);

-- ----------------------------
-- Sequence structure for dms_customer_test_drives_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dms_customer_test_drives_id_seq";
CREATE SEQUENCE "public"."dms_customer_test_drives_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 23469
 CACHE 1;
SELECT setval('"public"."dms_customer_test_drives_id_seq"', 23469, true);

-- ----------------------------
-- Sequence structure for dms_customers_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dms_customers_id_seq";
CREATE SEQUENCE "public"."dms_customers_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 159008
 CACHE 1;
SELECT setval('"public"."dms_customers_id_seq"', 159008, true);

-- ----------------------------
-- Sequence structure for dms_dealers_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dms_dealers_id_seq";
CREATE SEQUENCE "public"."dms_dealers_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 131
 CACHE 1;
SELECT setval('"public"."dms_dealers_id_seq"', 131, true);

-- ----------------------------
-- Sequence structure for dms_discount_old_schemes_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dms_discount_old_schemes_id_seq";
CREATE SEQUENCE "public"."dms_discount_old_schemes_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 123212212334454
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for dms_easyappointment_bookings_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dms_easyappointment_bookings_id_seq";
CREATE SEQUENCE "public"."dms_easyappointment_bookings_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 99999999999999999
 START 16
 CACHE 1;
SELECT setval('"public"."dms_easyappointment_bookings_id_seq"', 16, true);

-- ----------------------------
-- Sequence structure for dms_employee_contacts_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dms_employee_contacts_id_seq";
CREATE SEQUENCE "public"."dms_employee_contacts_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for dms_employees_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dms_employees_id_seq";
CREATE SEQUENCE "public"."dms_employees_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 961
 CACHE 1;
SELECT setval('"public"."dms_employees_id_seq"', 961, true);

-- ----------------------------
-- Sequence structure for dms_events_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dms_events_id_seq";
CREATE SEQUENCE "public"."dms_events_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 279
 CACHE 1;
SELECT setval('"public"."dms_events_id_seq"', 279, true);

-- ----------------------------
-- Sequence structure for dms_msil_scanned_order_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dms_msil_scanned_order_id_seq";
CREATE SEQUENCE "public"."dms_msil_scanned_order_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for dms_quotations_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dms_quotations_id_seq";
CREATE SEQUENCE "public"."dms_quotations_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 153919
 CACHE 1;
SELECT setval('"public"."dms_quotations_id_seq"', 153919, true);

-- ----------------------------
-- Sequence structure for dms_sms_history_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dms_sms_history_id_seq";
CREATE SEQUENCE "public"."dms_sms_history_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for dms_vehicles_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dms_vehicles_id_seq";
CREATE SEQUENCE "public"."dms_vehicles_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 5575
 CACHE 1;
SELECT setval('"public"."dms_vehicles_id_seq"', 5575, true);

-- ----------------------------
-- Sequence structure for driver_details_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."driver_details_id_seq";
CREATE SEQUENCE "public"."driver_details_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 15158
 CACHE 1;
SELECT setval('"public"."driver_details_id_seq"', 15158, true);

-- ----------------------------
-- Sequence structure for inquiry_name_edit_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."inquiry_name_edit_id_seq";
CREATE SEQUENCE "public"."inquiry_name_edit_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1217
 CACHE 1;
SELECT setval('"public"."inquiry_name_edit_id_seq"', 1217, true);

-- ----------------------------
-- Sequence structure for log_damage_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."log_damage_id_seq";
CREATE SEQUENCE "public"."log_damage_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 733
 CACHE 1;
SELECT setval('"public"."log_damage_id_seq"', 733, true);

-- ----------------------------
-- Sequence structure for log_dealer_incharge_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."log_dealer_incharge_id_seq";
CREATE SEQUENCE "public"."log_dealer_incharge_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for log_dealer_order_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."log_dealer_order_id_seq";
CREATE SEQUENCE "public"."log_dealer_order_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 28952
 CACHE 1;
SELECT setval('"public"."log_dealer_order_id_seq"', 28952, true);

-- ----------------------------
-- Sequence structure for log_dispatch_dealer_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."log_dispatch_dealer_id_seq";
CREATE SEQUENCE "public"."log_dispatch_dealer_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 20826
 CACHE 1;
SELECT setval('"public"."log_dispatch_dealer_id_seq"', 20826, true);

-- ----------------------------
-- Sequence structure for log_fuel_kms_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."log_fuel_kms_id_seq";
CREATE SEQUENCE "public"."log_fuel_kms_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 17225
 CACHE 1;
SELECT setval('"public"."log_fuel_kms_id_seq"', 17225, true);

-- ----------------------------
-- Sequence structure for log_repair_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."log_repair_id_seq";
CREATE SEQUENCE "public"."log_repair_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for log_stock_damage_records_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."log_stock_damage_records_id_seq";
CREATE SEQUENCE "public"."log_stock_damage_records_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 773
 CACHE 1;
SELECT setval('"public"."log_stock_damage_records_id_seq"', 773, true);

-- ----------------------------
-- Sequence structure for log_stock_records_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."log_stock_records_id_seq";
CREATE SEQUENCE "public"."log_stock_records_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 19718
 CACHE 1;
SELECT setval('"public"."log_stock_records_id_seq"', 19718, true);

-- ----------------------------
-- Sequence structure for msil_dispatch_records_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."msil_dispatch_records_id_seq";
CREATE SEQUENCE "public"."msil_dispatch_records_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 20825
 CACHE 1;
SELECT setval('"public"."msil_dispatch_records_id_seq"', 20825, true);

-- ----------------------------
-- Sequence structure for msil_monthly_plannings_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."msil_monthly_plannings_id_seq";
CREATE SEQUENCE "public"."msil_monthly_plannings_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 9
 CACHE 1;
SELECT setval('"public"."msil_monthly_plannings_id_seq"', 9, true);

-- ----------------------------
-- Sequence structure for msil_order_mismatch_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."msil_order_mismatch_id_seq";
CREATE SEQUENCE "public"."msil_order_mismatch_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 435
 CACHE 1;
SELECT setval('"public"."msil_order_mismatch_id_seq"', 435, true);

-- ----------------------------
-- Sequence structure for msil_orders_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."msil_orders_id_seq";
CREATE SEQUENCE "public"."msil_orders_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1936
 CACHE 1;
SELECT setval('"public"."msil_orders_id_seq"', 1936, true);

-- ----------------------------
-- Sequence structure for mst_accessories_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_accessories_id_seq";
CREATE SEQUENCE "public"."mst_accessories_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 22
 CACHE 1;
SELECT setval('"public"."mst_accessories_id_seq"', 22, true);

-- ----------------------------
-- Sequence structure for mst_banks_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_banks_id_seq";
CREATE SEQUENCE "public"."mst_banks_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 101203
 CACHE 1;
SELECT setval('"public"."mst_banks_id_seq"', 101203, true);

-- ----------------------------
-- Sequence structure for mst_city_places_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_city_places_id_seq";
CREATE SEQUENCE "public"."mst_city_places_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 50
 CACHE 1;
SELECT setval('"public"."mst_city_places_id_seq"', 50, true);

-- ----------------------------
-- Sequence structure for mst_colors_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_colors_id_seq";
CREATE SEQUENCE "public"."mst_colors_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 93
 CACHE 1;
SELECT setval('"public"."mst_colors_id_seq"', 93, true);

-- ----------------------------
-- Sequence structure for mst_customer_types_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_customer_types_id_seq";
CREATE SEQUENCE "public"."mst_customer_types_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 5
 CACHE 1;
SELECT setval('"public"."mst_customer_types_id_seq"', 5, true);

-- ----------------------------
-- Sequence structure for mst_designations_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_designations_id_seq";
CREATE SEQUENCE "public"."mst_designations_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 26
 CACHE 1;
SELECT setval('"public"."mst_designations_id_seq"', 26, true);

-- ----------------------------
-- Sequence structure for mst_district_mvs_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_district_mvs_id_seq";
CREATE SEQUENCE "public"."mst_district_mvs_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 3857
 CACHE 1;
SELECT setval('"public"."mst_district_mvs_id_seq"', 3857, true);

-- ----------------------------
-- Sequence structure for mst_educations_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_educations_id_seq";
CREATE SEQUENCE "public"."mst_educations_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 7
 CACHE 1;
SELECT setval('"public"."mst_educations_id_seq"', 7, true);

-- ----------------------------
-- Sequence structure for mst_firms_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_firms_id_seq";
CREATE SEQUENCE "public"."mst_firms_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 6
 CACHE 1;
SELECT setval('"public"."mst_firms_id_seq"', 6, true);

-- ----------------------------
-- Sequence structure for mst_fiscal_years_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_fiscal_years_id_seq";
CREATE SEQUENCE "public"."mst_fiscal_years_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 5
 CACHE 1;
SELECT setval('"public"."mst_fiscal_years_id_seq"', 5, true);

-- ----------------------------
-- Sequence structure for mst_foc_accessoreis_partcode_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_foc_accessoreis_partcode_id_seq";
CREATE SEQUENCE "public"."mst_foc_accessoreis_partcode_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 158
 CACHE 1;
SELECT setval('"public"."mst_foc_accessoreis_partcode_id_seq"', 158, true);

-- ----------------------------
-- Sequence structure for mst_foc_accessories_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_foc_accessories_id_seq";
CREATE SEQUENCE "public"."mst_foc_accessories_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for mst_inquiry_statuses_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_inquiry_statuses_id_seq";
CREATE SEQUENCE "public"."mst_inquiry_statuses_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 20
 CACHE 1;
SELECT setval('"public"."mst_inquiry_statuses_id_seq"', 20, true);

-- ----------------------------
-- Sequence structure for mst_institutions_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_institutions_id_seq";
CREATE SEQUENCE "public"."mst_institutions_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 9
 CACHE 1;
SELECT setval('"public"."mst_institutions_id_seq"', 9, true);

-- ----------------------------
-- Sequence structure for mst_minimum_quantity_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_minimum_quantity_id_seq";
CREATE SEQUENCE "public"."mst_minimum_quantity_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for mst_occupations_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_occupations_id_seq";
CREATE SEQUENCE "public"."mst_occupations_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 5
 CACHE 1;
SELECT setval('"public"."mst_occupations_id_seq"', 5, true);

-- ----------------------------
-- Sequence structure for mst_payment_modes_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_payment_modes_id_seq";
CREATE SEQUENCE "public"."mst_payment_modes_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 2
 CACHE 1;
SELECT setval('"public"."mst_payment_modes_id_seq"', 2, true);

-- ----------------------------
-- Sequence structure for mst_reasons_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_reasons_id_seq";
CREATE SEQUENCE "public"."mst_reasons_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 18
 CACHE 1;
SELECT setval('"public"."mst_reasons_id_seq"', 18, true);

-- ----------------------------
-- Sequence structure for mst_relations_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_relations_id_seq";
CREATE SEQUENCE "public"."mst_relations_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 11
 CACHE 1;
SELECT setval('"public"."mst_relations_id_seq"', 11, true);

-- ----------------------------
-- Sequence structure for mst_scan_device_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_scan_device_id_seq";
CREATE SEQUENCE "public"."mst_scan_device_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for mst_scan_person_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_scan_person_id_seq";
CREATE SEQUENCE "public"."mst_scan_person_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for mst_service_job_description_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_service_job_description_id_seq";
CREATE SEQUENCE "public"."mst_service_job_description_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 11088
 CACHE 1;
SELECT setval('"public"."mst_service_job_description_id_seq"', 11088, true);

-- ----------------------------
-- Sequence structure for mst_service_jobs_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_service_jobs_id_seq";
CREATE SEQUENCE "public"."mst_service_jobs_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1759
 CACHE 1;
SELECT setval('"public"."mst_service_jobs_id_seq"', 1759, true);

-- ----------------------------
-- Sequence structure for mst_service_policy_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_service_policy_id_seq";
CREATE SEQUENCE "public"."mst_service_policy_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 2
 CACHE 1;
SELECT setval('"public"."mst_service_policy_id_seq"', 2, true);

-- ----------------------------
-- Sequence structure for mst_service_types_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_service_types_id_seq";
CREATE SEQUENCE "public"."mst_service_types_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 16
 CACHE 1;
SELECT setval('"public"."mst_service_types_id_seq"', 16, true);

-- ----------------------------
-- Sequence structure for mst_service_warranty_policy_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_service_warranty_policy_id_seq";
CREATE SEQUENCE "public"."mst_service_warranty_policy_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for mst_sms_template_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_sms_template_id_seq";
CREATE SEQUENCE "public"."mst_sms_template_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for mst_source_type_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_source_type_id_seq";
CREATE SEQUENCE "public"."mst_source_type_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for mst_sources_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_sources_id_seq";
CREATE SEQUENCE "public"."mst_sources_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 5
 CACHE 1;
SELECT setval('"public"."mst_sources_id_seq"', 5, true);

-- ----------------------------
-- Sequence structure for mst_spareparts_category_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_spareparts_category_id_seq";
CREATE SEQUENCE "public"."mst_spareparts_category_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 7
 CACHE 1;
SELECT setval('"public"."mst_spareparts_category_id_seq"', 7, true);

-- ----------------------------
-- Sequence structure for mst_spareparts_dealer_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_spareparts_dealer_id_seq";
CREATE SEQUENCE "public"."mst_spareparts_dealer_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 43
 CACHE 1;
SELECT setval('"public"."mst_spareparts_dealer_id_seq"', 43, true);

-- ----------------------------
-- Sequence structure for mst_spareparts_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_spareparts_id_seq";
CREATE SEQUENCE "public"."mst_spareparts_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 125336
 CACHE 1;
SELECT setval('"public"."mst_spareparts_id_seq"', 125336, true);

-- ----------------------------
-- Sequence structure for mst_stock_yards_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_stock_yards_id_seq";
CREATE SEQUENCE "public"."mst_stock_yards_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 13
 CACHE 1;
SELECT setval('"public"."mst_stock_yards_id_seq"', 13, true);

-- ----------------------------
-- Sequence structure for mst_sub_source_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_sub_source_id_seq";
CREATE SEQUENCE "public"."mst_sub_source_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 41
 CACHE 1;
SELECT setval('"public"."mst_sub_source_id_seq"', 41, true);

-- ----------------------------
-- Sequence structure for mst_titles_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_titles_id_seq";
CREATE SEQUENCE "public"."mst_titles_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for mst_user_ledger_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_user_ledger_id_seq";
CREATE SEQUENCE "public"."mst_user_ledger_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 36724
 CACHE 1;
SELECT setval('"public"."mst_user_ledger_id_seq"', 36724, true);

-- ----------------------------
-- Sequence structure for mst_variants_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_variants_id_seq";
CREATE SEQUENCE "public"."mst_variants_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 49
 CACHE 1;
SELECT setval('"public"."mst_variants_id_seq"', 49, true);

-- ----------------------------
-- Sequence structure for mst_vehicles_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_vehicles_id_seq";
CREATE SEQUENCE "public"."mst_vehicles_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 52
 CACHE 1;
SELECT setval('"public"."mst_vehicles_id_seq"', 52, true);

-- ----------------------------
-- Sequence structure for mst_walkin_sources_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_walkin_sources_id_seq";
CREATE SEQUENCE "public"."mst_walkin_sources_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 11
 CACHE 1;
SELECT setval('"public"."mst_walkin_sources_id_seq"', 11, true);

-- ----------------------------
-- Sequence structure for mst_workshop_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mst_workshop_id_seq";
CREATE SEQUENCE "public"."mst_workshop_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for project_activity_logs_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."project_activity_logs_id_seq";
CREATE SEQUENCE "public"."project_activity_logs_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 9634830
 CACHE 1;
SELECT setval('"public"."project_activity_logs_id_seq"', 9634830, true);

-- ----------------------------
-- Sequence structure for project_audit_logs_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."project_audit_logs_id_seq";
CREATE SEQUENCE "public"."project_audit_logs_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 11335264
 CACHE 1;
SELECT setval('"public"."project_audit_logs_id_seq"', 11335264, true);

-- ----------------------------
-- Sequence structure for project_settings_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."project_settings_id_seq";
CREATE SEQUENCE "public"."project_settings_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
SELECT setval('"public"."project_settings_id_seq"', 1, true);

-- ----------------------------
-- Sequence structure for sales_booking_cancel_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sales_booking_cancel_id_seq";
CREATE SEQUENCE "public"."sales_booking_cancel_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 4432
 CACHE 1;
SELECT setval('"public"."sales_booking_cancel_id_seq"', 4432, true);

-- ----------------------------
-- Sequence structure for sales_credit_control_decision_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sales_credit_control_decision_id_seq";
CREATE SEQUENCE "public"."sales_credit_control_decision_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 29202
 CACHE 1;
SELECT setval('"public"."sales_credit_control_decision_id_seq"', 29202, true);

-- ----------------------------
-- Sequence structure for sales_discount_limit_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sales_discount_limit_id_seq";
CREATE SEQUENCE "public"."sales_discount_limit_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 422
 CACHE 1;
SELECT setval('"public"."sales_discount_limit_id_seq"', 422, true);

-- ----------------------------
-- Sequence structure for sales_discount_schemes_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sales_discount_schemes_id_seq";
CREATE SEQUENCE "public"."sales_discount_schemes_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 823
 CACHE 1;
SELECT setval('"public"."sales_discount_schemes_id_seq"', 823, true);

-- ----------------------------
-- Sequence structure for sales_foc_document_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sales_foc_document_id_seq";
CREATE SEQUENCE "public"."sales_foc_document_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 2814
 CACHE 1;
SELECT setval('"public"."sales_foc_document_id_seq"', 2814, true);

-- ----------------------------
-- Sequence structure for sales_foc_request_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sales_foc_request_id_seq";
CREATE SEQUENCE "public"."sales_foc_request_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 3052
 CACHE 1;
SELECT setval('"public"."sales_foc_request_id_seq"', 3052, true);

-- ----------------------------
-- Sequence structure for sales_partial_payment_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sales_partial_payment_id_seq";
CREATE SEQUENCE "public"."sales_partial_payment_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 3266
 CACHE 1;
SELECT setval('"public"."sales_partial_payment_id_seq"', 3266, true);

-- ----------------------------
-- Sequence structure for sales_pdi_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sales_pdi_id_seq";
CREATE SEQUENCE "public"."sales_pdi_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for sales_target_records_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sales_target_records_id_seq";
CREATE SEQUENCE "public"."sales_target_records_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 94308
 CACHE 1;
SELECT setval('"public"."sales_target_records_id_seq"', 94308, true);

-- ----------------------------
-- Sequence structure for sales_vehicle_process_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sales_vehicle_process_id_seq";
CREATE SEQUENCE "public"."sales_vehicle_process_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 25897
 CACHE 1;
SELECT setval('"public"."sales_vehicle_process_id_seq"', 25897, true);

-- ----------------------------
-- Sequence structure for sales_vehicle_return_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sales_vehicle_return_id_seq";
CREATE SEQUENCE "public"."sales_vehicle_return_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1212
 CACHE 1;
SELECT setval('"public"."sales_vehicle_return_id_seq"', 1212, true);

-- ----------------------------
-- Sequence structure for ser_billed_jobs_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_billed_jobs_id_seq";
CREATE SEQUENCE "public"."ser_billed_jobs_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 281051
 CACHE 1;
SELECT setval('"public"."ser_billed_jobs_id_seq"', 281051, true);

-- ----------------------------
-- Sequence structure for ser_billed_outsidework_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_billed_outsidework_id_seq";
CREATE SEQUENCE "public"."ser_billed_outsidework_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1109
 CACHE 1;
SELECT setval('"public"."ser_billed_outsidework_id_seq"', 1109, true);

-- ----------------------------
-- Sequence structure for ser_billed_parts_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_billed_parts_id_seq";
CREATE SEQUENCE "public"."ser_billed_parts_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 366499
 CACHE 1;
SELECT setval('"public"."ser_billed_parts_id_seq"', 366499, true);

-- ----------------------------
-- Sequence structure for ser_billing_record_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_billing_record_id_seq";
CREATE SEQUENCE "public"."ser_billing_record_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 98215
 CACHE 1;
SELECT setval('"public"."ser_billing_record_id_seq"', 98215, true);

-- ----------------------------
-- Sequence structure for ser_counter_sales_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_counter_sales_id_seq";
CREATE SEQUENCE "public"."ser_counter_sales_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 7895
 CACHE 1;
SELECT setval('"public"."ser_counter_sales_id_seq"', 7895, true);

-- ----------------------------
-- Sequence structure for ser_counter_sales_request_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_counter_sales_request_id_seq";
CREATE SEQUENCE "public"."ser_counter_sales_request_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 44697
 CACHE 1;
SELECT setval('"public"."ser_counter_sales_request_id_seq"', 44697, true);

-- ----------------------------
-- Sequence structure for ser_estimate_details_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_estimate_details_id_seq";
CREATE SEQUENCE "public"."ser_estimate_details_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1093
 CACHE 1;
SELECT setval('"public"."ser_estimate_details_id_seq"', 1093, true);

-- ----------------------------
-- Sequence structure for ser_estimate_jobs_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_estimate_jobs_id_seq";
CREATE SEQUENCE "public"."ser_estimate_jobs_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 8398
 CACHE 1;
SELECT setval('"public"."ser_estimate_jobs_id_seq"', 8398, true);

-- ----------------------------
-- Sequence structure for ser_estimate_parts_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_estimate_parts_id_seq";
CREATE SEQUENCE "public"."ser_estimate_parts_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 16410
 CACHE 1;
SELECT setval('"public"."ser_estimate_parts_id_seq"', 16410, true);

-- ----------------------------
-- Sequence structure for ser_floor_supervisor_advice_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_floor_supervisor_advice_seq";
CREATE SEQUENCE "public"."ser_floor_supervisor_advice_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 456657
 CACHE 1;
SELECT setval('"public"."ser_floor_supervisor_advice_seq"', 456657, true);

-- ----------------------------
-- Sequence structure for ser_gatepass_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_gatepass_id_seq";
CREATE SEQUENCE "public"."ser_gatepass_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 34798
 CACHE 1;
SELECT setval('"public"."ser_gatepass_id_seq"', 34798, true);

-- ----------------------------
-- Sequence structure for ser_job_cards_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_job_cards_id_seq";
CREATE SEQUENCE "public"."ser_job_cards_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 308633
 CACHE 1;
SELECT setval('"public"."ser_job_cards_id_seq"', 308633, true);

-- ----------------------------
-- Sequence structure for ser_jobcard_status_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_jobcard_status_id_seq";
CREATE SEQUENCE "public"."ser_jobcard_status_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 104418
 CACHE 1;
SELECT setval('"public"."ser_jobcard_status_id_seq"', 104418, true);

-- ----------------------------
-- Sequence structure for ser_material_scan_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_material_scan_id_seq";
CREATE SEQUENCE "public"."ser_material_scan_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 377260
 CACHE 1;
SELECT setval('"public"."ser_material_scan_id_seq"', 377260, true);

-- ----------------------------
-- Sequence structure for ser_outside_work_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_outside_work_id_seq";
CREATE SEQUENCE "public"."ser_outside_work_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1608
 CACHE 1;
SELECT setval('"public"."ser_outside_work_id_seq"', 1608, true);

-- ----------------------------
-- Sequence structure for ser_outsidework_ledgers_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_outsidework_ledgers_id_seq";
CREATE SEQUENCE "public"."ser_outsidework_ledgers_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 70
 CACHE 1;
SELECT setval('"public"."ser_outsidework_ledgers_id_seq"', 70, true);

-- ----------------------------
-- Sequence structure for ser_parts_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_parts_id_seq";
CREATE SEQUENCE "public"."ser_parts_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 61
 CACHE 1;
SELECT setval('"public"."ser_parts_id_seq"', 61, true);

-- ----------------------------
-- Sequence structure for ser_purchase_based_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_purchase_based_id_seq";
CREATE SEQUENCE "public"."ser_purchase_based_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for ser_purchase_invoices_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_purchase_invoices_id_seq";
CREATE SEQUENCE "public"."ser_purchase_invoices_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for ser_purchase_method_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_purchase_method_id_seq";
CREATE SEQUENCE "public"."ser_purchase_method_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for ser_purchase_order_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_purchase_order_id_seq";
CREATE SEQUENCE "public"."ser_purchase_order_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for ser_sale_return_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_sale_return_id_seq";
CREATE SEQUENCE "public"."ser_sale_return_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 139
 CACHE 1;
SELECT setval('"public"."ser_sale_return_id_seq"', 139, true);

-- ----------------------------
-- Sequence structure for ser_service_policy_detail_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_service_policy_detail_id_seq";
CREATE SEQUENCE "public"."ser_service_policy_detail_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for ser_service_policy_vehicles_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_service_policy_vehicles_id_seq";
CREATE SEQUENCE "public"."ser_service_policy_vehicles_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for ser_warranty_claim_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_warranty_claim_id_seq";
CREATE SEQUENCE "public"."ser_warranty_claim_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for ser_warranty_claim_list_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_warranty_claim_list_id_seq";
CREATE SEQUENCE "public"."ser_warranty_claim_list_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for ser_workshop_job_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_workshop_job_id_seq";
CREATE SEQUENCE "public"."ser_workshop_job_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for ser_workshop_users_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ser_workshop_users_id_seq";
CREATE SEQUENCE "public"."ser_workshop_users_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 349
 CACHE 1;
SELECT setval('"public"."ser_workshop_users_id_seq"', 349, true);

-- ----------------------------
-- Sequence structure for spareparts_closing_stock_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_closing_stock_id_seq";
CREATE SEQUENCE "public"."spareparts_closing_stock_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 6222
 CACHE 1;
SELECT setval('"public"."spareparts_closing_stock_id_seq"', 6222, true);

-- ----------------------------
-- Sequence structure for spareparts_daily_credits_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_daily_credits_id_seq";
CREATE SEQUENCE "public"."spareparts_daily_credits_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 84
 CACHE 1;
SELECT setval('"public"."spareparts_daily_credits_id_seq"', 84, true);

-- ----------------------------
-- Sequence structure for spareparts_damage_stock_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_damage_stock_id_seq";
CREATE SEQUENCE "public"."spareparts_damage_stock_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for spareparts_dealer_claim_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_dealer_claim_id_seq";
CREATE SEQUENCE "public"."spareparts_dealer_claim_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 6707
 CACHE 1;
SELECT setval('"public"."spareparts_dealer_claim_id_seq"', 6707, true);

-- ----------------------------
-- Sequence structure for spareparts_dealer_credit_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_dealer_credit_id_seq";
CREATE SEQUENCE "public"."spareparts_dealer_credit_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 13838
 CACHE 1;
SELECT setval('"public"."spareparts_dealer_credit_id_seq"', 13838, true);

-- ----------------------------
-- Sequence structure for spareparts_dealer_opening_credit_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_dealer_opening_credit_id_seq";
CREATE SEQUENCE "public"."spareparts_dealer_opening_credit_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 52
 CACHE 1;
SELECT setval('"public"."spareparts_dealer_opening_credit_id_seq"', 52, true);

-- ----------------------------
-- Sequence structure for spareparts_dealer_sales_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_dealer_sales_id_seq";
CREATE SEQUENCE "public"."spareparts_dealer_sales_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 220
 CACHE 1;
SELECT setval('"public"."spareparts_dealer_sales_id_seq"', 220, true);

-- ----------------------------
-- Sequence structure for spareparts_dealer_stock_adjustment_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_dealer_stock_adjustment_id_seq";
CREATE SEQUENCE "public"."spareparts_dealer_stock_adjustment_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1448
 CACHE 1;
SELECT setval('"public"."spareparts_dealer_stock_adjustment_id_seq"', 1448, true);

-- ----------------------------
-- Sequence structure for spareparts_dealer_stock_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_dealer_stock_id_seq";
CREATE SEQUENCE "public"."spareparts_dealer_stock_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 293776
 CACHE 1;
SELECT setval('"public"."spareparts_dealer_stock_id_seq"', 293776, true);

-- ----------------------------
-- Sequence structure for spareparts_dealer_yearly_target_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_dealer_yearly_target_id_seq";
CREATE SEQUENCE "public"."spareparts_dealer_yearly_target_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for spareparts_dealersales_list_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_dealersales_list_id_seq";
CREATE SEQUENCE "public"."spareparts_dealersales_list_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 406
 CACHE 1;
SELECT setval('"public"."spareparts_dealersales_list_id_seq"', 406, true);

-- ----------------------------
-- Sequence structure for spareparts_dispatch_list_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_dispatch_list_id_seq";
CREATE SEQUENCE "public"."spareparts_dispatch_list_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 150633
 CACHE 1;
SELECT setval('"public"."spareparts_dispatch_list_id_seq"', 150633, true);

-- ----------------------------
-- Sequence structure for spareparts_dispatch_spareparts_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_dispatch_spareparts_id_seq";
CREATE SEQUENCE "public"."spareparts_dispatch_spareparts_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 358065
 CACHE 1;
SELECT setval('"public"."spareparts_dispatch_spareparts_id_seq"', 358065, true);

-- ----------------------------
-- Sequence structure for spareparts_gatepass_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_gatepass_id_seq";
CREATE SEQUENCE "public"."spareparts_gatepass_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 335
 CACHE 1;
SELECT setval('"public"."spareparts_gatepass_id_seq"', 335, true);

-- ----------------------------
-- Sequence structure for spareparts_goods_return_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_goods_return_id_seq";
CREATE SEQUENCE "public"."spareparts_goods_return_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for spareparts_landed_cost_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_landed_cost_id_seq";
CREATE SEQUENCE "public"."spareparts_landed_cost_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for spareparts_local_purchase_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_local_purchase_id_seq";
CREATE SEQUENCE "public"."spareparts_local_purchase_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 4503
 CACHE 1;
SELECT setval('"public"."spareparts_local_purchase_id_seq"', 4503, true);

-- ----------------------------
-- Sequence structure for spareparts_local_purchase_list_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_local_purchase_list_id_seq";
CREATE SEQUENCE "public"."spareparts_local_purchase_list_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 7894
 CACHE 1;
SELECT setval('"public"."spareparts_local_purchase_list_id_seq"', 7894, true);

-- ----------------------------
-- Sequence structure for spareparts_msil_order_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_msil_order_id_seq";
CREATE SEQUENCE "public"."spareparts_msil_order_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 102143
 CACHE 1;
SELECT setval('"public"."spareparts_msil_order_id_seq"', 102143, true);

-- ----------------------------
-- Sequence structure for spareparts_order_generate_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_order_generate_id_seq";
CREATE SEQUENCE "public"."spareparts_order_generate_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 39210
 CACHE 1;
SELECT setval('"public"."spareparts_order_generate_id_seq"', 39210, true);

-- ----------------------------
-- Sequence structure for spareparts_order_unavailable_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_order_unavailable_id_seq";
CREATE SEQUENCE "public"."spareparts_order_unavailable_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 3503
 CACHE 1;
SELECT setval('"public"."spareparts_order_unavailable_id_seq"', 3503, true);

-- ----------------------------
-- Sequence structure for spareparts_pi_import_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_pi_import_id_seq";
CREATE SEQUENCE "public"."spareparts_pi_import_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 385
 CACHE 1;
SELECT setval('"public"."spareparts_pi_import_id_seq"', 385, true);

-- ----------------------------
-- Sequence structure for spareparts_picklist_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_picklist_id_seq";
CREATE SEQUENCE "public"."spareparts_picklist_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 386199
 CACHE 1;
SELECT setval('"public"."spareparts_picklist_id_seq"', 386199, true);

-- ----------------------------
-- Sequence structure for spareparts_sparepart_order_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_sparepart_order_id_seq";
CREATE SEQUENCE "public"."spareparts_sparepart_order_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 274835
 CACHE 1;
SELECT setval('"public"."spareparts_sparepart_order_id_seq"', 274835, true);

-- ----------------------------
-- Sequence structure for spareparts_sparepart_stock_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_sparepart_stock_id_seq";
CREATE SEQUENCE "public"."spareparts_sparepart_stock_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 30258
 CACHE 1;
SELECT setval('"public"."spareparts_sparepart_stock_id_seq"', 30258, true);

-- ----------------------------
-- Sequence structure for spareparts_stock_adjustment_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_stock_adjustment_id_seq";
CREATE SEQUENCE "public"."spareparts_stock_adjustment_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 517
 CACHE 1;
SELECT setval('"public"."spareparts_stock_adjustment_id_seq"', 517, true);

-- ----------------------------
-- Sequence structure for spareparts_stock_transfer_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_stock_transfer_id_seq";
CREATE SEQUENCE "public"."spareparts_stock_transfer_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
SELECT setval('"public"."spareparts_stock_transfer_id_seq"', 1, true);

-- ----------------------------
-- Sequence structure for spareparts_stock_transfer_lists_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_stock_transfer_lists_id_seq";
CREATE SEQUENCE "public"."spareparts_stock_transfer_lists_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for spareparts_stock_transfer_log_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_stock_transfer_log_id_seq";
CREATE SEQUENCE "public"."spareparts_stock_transfer_log_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for spareparts_stock_transfers_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_stock_transfers_id_seq";
CREATE SEQUENCE "public"."spareparts_stock_transfers_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for spareparts_stockyard_countersale_parts_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_stockyard_countersale_parts_id_seq";
CREATE SEQUENCE "public"."spareparts_stockyard_countersale_parts_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for spareparts_stockyard_countersales_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_stockyard_countersales_id_seq";
CREATE SEQUENCE "public"."spareparts_stockyard_countersales_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for spareparts_stockyards_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."spareparts_stockyards_id_seq";
CREATE SEQUENCE "public"."spareparts_stockyards_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for table_unknown_parts_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."table_unknown_parts_id_seq";
CREATE SEQUENCE "public"."table_unknown_parts_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 3270
 CACHE 1;
SELECT setval('"public"."table_unknown_parts_id_seq"', 3270, true);

-- ----------------------------
-- Sequence structure for tbl_customer_registration_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_customer_registration_id_seq";
CREATE SEQUENCE "public"."tbl_customer_registration_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
SELECT setval('"public"."tbl_customer_registration_id_seq"', 1, true);

-- ----------------------------
-- Sequence structure for tbl_dublicate_number_log_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_dublicate_number_log_id_seq";
CREATE SEQUENCE "public"."tbl_dublicate_number_log_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 654444444444444444
 START 8559
 CACHE 1;
SELECT setval('"public"."tbl_dublicate_number_log_id_seq"', 8559, true);

-- ----------------------------
-- Sequence structure for tbl_inquiry_uploaded_document_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_inquiry_uploaded_document_id_seq";
CREATE SEQUENCE "public"."tbl_inquiry_uploaded_document_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 4545656545646545
 START 17459
 CACHE 1;
SELECT setval('"public"."tbl_inquiry_uploaded_document_id_seq"', 17459, true);

-- ----------------------------
-- Sequence structure for temp_vehicle_service_history_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."temp_vehicle_service_history_id_seq";
CREATE SEQUENCE "public"."temp_vehicle_service_history_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 76407
 CACHE 1;
SELECT setval('"public"."temp_vehicle_service_history_id_seq"', 76407, true);

-- ----------------------------
-- Table structure for aauth_assitant_dealers
-- ----------------------------
DROP TABLE IF EXISTS "public"."aauth_assitant_dealers";
CREATE TABLE "public"."aauth_assitant_dealers" (
"id" int4 DEFAULT nextval('aauth_assitant_dealers_id_seq'::regclass) NOT NULL,
"dealer_incharge_id" int4,
"assistant_dealer_incharge_id" int4,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for aauth_group_permissions
-- ----------------------------
DROP TABLE IF EXISTS "public"."aauth_group_permissions";
CREATE TABLE "public"."aauth_group_permissions" (
"perm_id" int4 NOT NULL,
"group_id" int4 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for aauth_groups
-- ----------------------------
DROP TABLE IF EXISTS "public"."aauth_groups";
CREATE TABLE "public"."aauth_groups" (
"id" int4 DEFAULT nextval('aauth_groups_id_seq'::regclass) NOT NULL,
"name" varchar(100) COLLATE "default",
"definition" text COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for aauth_login_attempts
-- ----------------------------
DROP TABLE IF EXISTS "public"."aauth_login_attempts";
CREATE TABLE "public"."aauth_login_attempts" (
"id" int4 DEFAULT nextval('aauth_login_attempts_id_seq'::regclass) NOT NULL,
"ip_address" varchar(40) COLLATE "default" DEFAULT 0 NOT NULL,
"timestamp" timestamp(6),
"login_attempts" int4 DEFAULT 0 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for aauth_permissions
-- ----------------------------
DROP TABLE IF EXISTS "public"."aauth_permissions";
CREATE TABLE "public"."aauth_permissions" (
"id" int4 DEFAULT nextval('aauth_permissions_id_seq'::regclass) NOT NULL,
"name" varchar(100) COLLATE "default",
"definition" text COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for aauth_pms
-- ----------------------------
DROP TABLE IF EXISTS "public"."aauth_pms";
CREATE TABLE "public"."aauth_pms" (
"id" int4 DEFAULT nextval('aauth_pms_id_seq'::regclass) NOT NULL,
"sender_id" int4 NOT NULL,
"receiver_id" int4 NOT NULL,
"title" varchar(255) COLLATE "default" NOT NULL,
"message" text COLLATE "default",
"date_sent" timestamp(6),
"date_read" timestamp(6),
"pm_deleted_sender" int4 DEFAULT 0 NOT NULL,
"pm_deleted_receiver" int4 DEFAULT 0 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for aauth_sub_groups
-- ----------------------------
DROP TABLE IF EXISTS "public"."aauth_sub_groups";
CREATE TABLE "public"."aauth_sub_groups" (
"group_id" int4 NOT NULL,
"subgroup_id" int4 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for aauth_user_groups
-- ----------------------------
DROP TABLE IF EXISTS "public"."aauth_user_groups";
CREATE TABLE "public"."aauth_user_groups" (
"user_id" int4 NOT NULL,
"group_id" int4 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for aauth_user_permissions
-- ----------------------------
DROP TABLE IF EXISTS "public"."aauth_user_permissions";
CREATE TABLE "public"."aauth_user_permissions" (
"perm_id" int4 NOT NULL,
"user_id" int4 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for aauth_user_variables
-- ----------------------------
DROP TABLE IF EXISTS "public"."aauth_user_variables";
CREATE TABLE "public"."aauth_user_variables" (
"id" int4 DEFAULT nextval('aauth_user_variables_id_seq'::regclass) NOT NULL,
"user_id" int4 NOT NULL,
"data_key" varchar(100) COLLATE "default" NOT NULL,
"value" text COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for aauth_users
-- ----------------------------
DROP TABLE IF EXISTS "public"."aauth_users";
CREATE TABLE "public"."aauth_users" (
"id" int4 DEFAULT nextval('aauth_users_id_seq'::regclass) NOT NULL,
"email" varchar(100) COLLATE "default" NOT NULL,
"pass" varchar(255) COLLATE "default" NOT NULL,
"username" varchar(100) COLLATE "default",
"fullname" varchar(255) COLLATE "default",
"banned" int4 DEFAULT 0 NOT NULL,
"last_login" timestamp(6),
"last_activity" timestamp(6),
"date_created" timestamp(6),
"forgot_exp" text COLLATE "default",
"remember_time" timestamp(6),
"remember_exp" text COLLATE "default",
"verification_code" text COLLATE "default",
"totp_secret" varchar(16) COLLATE "default" DEFAULT NULL::character varying,
"ip_address" varchar(40) COLLATE "default",
"password_change_date" date,
"password_change_status" bool,
"token" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ccd_2nd_smr_days
-- ----------------------------
DROP TABLE IF EXISTS "public"."ccd_2nd_smr_days";
CREATE TABLE "public"."ccd_2nd_smr_days" (
"id" int4 DEFAULT nextval('ccd_2nd_smr_days_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"customer_id" int4,
"call_status" varchar(255) COLLATE "default",
"date_of_call" date,
"date_of_call_np" varchar(255) COLLATE "default",
"appointment_taken" varchar(255) COLLATE "default",
"remark" varchar(255) COLLATE "default",
"created_at" date,
"updated_at" date,
"deleted_at" date,
"schedule_date" date,
"call_type" varchar(255) COLLATE "default",
"false_reason" varchar(255) COLLATE "default",
"call_count" varchar(255) COLLATE "default",
"appointment_date" timestamp(6)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ccd_general_smr
-- ----------------------------
DROP TABLE IF EXISTS "public"."ccd_general_smr";
CREATE TABLE "public"."ccd_general_smr" (
"id" int4 DEFAULT nextval('ccd_2nd_smr_days_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"customer_id" int4,
"call_status" varchar(255) COLLATE "default",
"date_of_call" date,
"date_of_call_np" varchar(255) COLLATE "default",
"appointment_taken" varchar(255) COLLATE "default",
"appointment_date" date,
"remark" varchar(255) COLLATE "default",
"created_at" date,
"updated_at" date,
"deleted_at" date,
"schedule_date" date,
"call_type" varchar(255) COLLATE "default",
"false_reason" varchar(255) COLLATE "default",
"call_count" varchar(255) COLLATE "default",
"first_name" varchar(255) COLLATE "default",
"middle_name" varchar(255) COLLATE "default",
"last_name" varchar(255) COLLATE "default",
"vehicle_no" varchar COLLATE "default",
"chassis_no" varchar COLLATE "default",
"engine_no" varchar COLLATE "default",
"vehicle_id" int4,
"variant_id" int4,
"color_id" int4,
"closed_date" date,
"jobcard_group" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ccd_inquiry
-- ----------------------------
DROP TABLE IF EXISTS "public"."ccd_inquiry";
CREATE TABLE "public"."ccd_inquiry" (
"id" int4 DEFAULT nextval('ccd_inquiry_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"date_of_call" date,
"date_of_call_np" varchar(255) COLLATE "default",
"sales_experience" varchar(255) COLLATE "default",
"dse_attitude" varchar(255) COLLATE "default",
"dse_knowledge" varchar(255) COLLATE "default",
"scheme_information" varchar(255) COLLATE "default",
"retail_finanace" varchar(255) COLLATE "default",
"offered_test_drive" varchar(255) COLLATE "default",
"warrenty_policy" varchar(255) COLLATE "default",
"service_policy" varchar(255) COLLATE "default",
"remarks" varchar(255) COLLATE "default",
"voc" varchar(255) COLLATE "default",
"call_status" varchar(255) COLLATE "default",
"call_count" int4 DEFAULT 0,
"competition" varchar(255) COLLATE "default",
"false_enquiries" varchar(255) COLLATE "default",
"yes_competition" varchar(255) COLLATE "default",
"existing" varchar(255) COLLATE "default",
"yes_existing" varchar(255) COLLATE "default",
"dissatisfied" varchar(255) COLLATE "default",
"call_connect_inquiry_type" varchar(255) COLLATE "default",
"priority" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ccd_lostcase
-- ----------------------------
DROP TABLE IF EXISTS "public"."ccd_lostcase";
CREATE TABLE "public"."ccd_lostcase" (
"id" int4 DEFAULT nextval('ccd_lostcase_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"call_status" varchar(255) COLLATE "default",
"date_of_call" date,
"date_of_call_np" varchar(255) COLLATE "default",
"voc" varchar(255) COLLATE "default",
"sales_experience" varchar(255) COLLATE "default",
"dse_attitude" varchar(255) COLLATE "default",
"dse_knowledge" varchar(255) COLLATE "default",
"scheme_information" varchar(255) COLLATE "default",
"retail_finanace" varchar(255) COLLATE "default",
"offered_test_drive" varchar(255) COLLATE "default",
"warrenty_policy" varchar(255) COLLATE "default",
"service_policy" varchar(255) COLLATE "default",
"remarks" varchar(255) COLLATE "default",
"call_count" int4 DEFAULT 0,
"false_enquiry" varchar(255) COLLATE "default",
"cold_enquiry" varchar(255) COLLATE "default",
"personal_problem" varchar(255) COLLATE "default",
"financial_problem" varchar(255) COLLATE "default",
"still_under_consideration" varchar(255) COLLATE "default",
"already_purchased_vehicle" varchar(255) COLLATE "default",
"already_puchased_co_dealer" varchar(255) COLLATE "default",
"pre_owner_vehicle" varchar(255) COLLATE "default",
"competitors_model" varchar(255) COLLATE "default",
"call_connect_inquiry_type" varchar(255) COLLATE "default",
"competitor_m_product" varchar(255) COLLATE "default",
"competitor_m_discount" varchar(255) COLLATE "default",
"competitor_m_service" varchar(255) COLLATE "default",
"competitor_m_stock" varchar(255) COLLATE "default",
"closed_date" timestamp(0) DEFAULT NULL::timestamp without time zone,
"brand" varchar(255) COLLATE "default",
"model" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ccd_lostcase_reason
-- ----------------------------
DROP TABLE IF EXISTS "public"."ccd_lostcase_reason";
CREATE TABLE "public"."ccd_lostcase_reason" (
"id" int4 DEFAULT nextval('ccd_lostcase_reason_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"parent_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ccd_lostcase_vehicles
-- ----------------------------
DROP TABLE IF EXISTS "public"."ccd_lostcase_vehicles";
CREATE TABLE "public"."ccd_lostcase_vehicles" (
"id" int4 DEFAULT nextval('ccd_lostcase_vehicles_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ccd_post_service_followup
-- ----------------------------
DROP TABLE IF EXISTS "public"."ccd_post_service_followup";
CREATE TABLE "public"."ccd_post_service_followup" (
"id" int4 DEFAULT nextval('ccd_post_service_followup_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"jobcard_group" int4,
"date_of_call" date,
"date_of_call_np" varchar(255) COLLATE "default",
"vehicle_performance_now" varchar(255) COLLATE "default",
"repair_request_by" varchar(255) COLLATE "default",
"fixed_in_first_visit" varchar(255) COLLATE "default",
"on_promised_time" varchar(255) COLLATE "default",
"charge_same" varchar(255) COLLATE "default",
"ratting" varchar(255) COLLATE "default",
"vehicle_clean_on_delivery" varchar(255) COLLATE "default",
"hygine_standard" varchar(255) COLLATE "default",
"satisfaction" varchar(255) COLLATE "default",
"dissatisfied_reason" varchar(255) COLLATE "default",
"call_status" varchar(255) COLLATE "default",
"call_connect_type" varchar(255) COLLATE "default",
"false_enquiries" varchar(255) COLLATE "default",
"remark" varchar(255) COLLATE "default",
"voc" text COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ccd_sixtyday
-- ----------------------------
DROP TABLE IF EXISTS "public"."ccd_sixtyday";
CREATE TABLE "public"."ccd_sixtyday" (
"id" int4 DEFAULT nextval('ccd_sixtyday_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"call_status" varchar(255) COLLATE "default",
"date_of_call" date,
"date_of_call_np" varchar(255) COLLATE "default",
"ownership_transfer" varchar(255) COLLATE "default",
"performance" varchar(255) COLLATE "default",
"smr_effectiveness" varchar(255) COLLATE "default",
"voc" varchar(255) COLLATE "default",
"call_count" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ccd_smr_twentyone_days
-- ----------------------------
DROP TABLE IF EXISTS "public"."ccd_smr_twentyone_days";
CREATE TABLE "public"."ccd_smr_twentyone_days" (
"id" int4 DEFAULT nextval('ccd_smr_twentyone_days_id_sql'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"customer_id" int4,
"call_status" varchar(255) COLLATE "default",
"date_of_call" date,
"date_of_call_np" varchar(255) COLLATE "default",
"appointment_taken" varchar(255) COLLATE "default",
"appointment_date" timestamp(0),
"remark" varchar(255) COLLATE "default",
"created_at" date,
"updated_at" date,
"deleted_at" date,
"schedule_date" date,
"call_type" varchar(255) COLLATE "default",
"false_reason" varchar(255) COLLATE "default",
"call_count" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ccd_thirtyday
-- ----------------------------
DROP TABLE IF EXISTS "public"."ccd_thirtyday";
CREATE TABLE "public"."ccd_thirtyday" (
"id" int4 DEFAULT nextval('ccd_thirtyday_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"call_status" varchar(255) COLLATE "default",
"date_of_call" date,
"date_of_call_np" varchar(255) COLLATE "default",
"product_feedback" varchar(255) COLLATE "default",
"bluebook_copy" varchar(255) COLLATE "default",
"green_sticker" varchar(255) COLLATE "default",
"payment_receipts" varchar(255) COLLATE "default",
"recommend_name1" varchar(255) COLLATE "default",
"recommend_contact1" varchar(255) COLLATE "default",
"recommend_name2" varchar(255) COLLATE "default",
"recommend_contact2" varchar(255) COLLATE "default",
"recommend_name3" varchar(255) COLLATE "default",
"recommend_contact3" varchar(255) COLLATE "default",
"remarks" varchar(255) COLLATE "default",
"voc" varchar(255) COLLATE "default",
"call_count" int4 DEFAULT 0,
"registration_number" varchar(255) COLLATE "default",
"call_for_service" varchar(255) COLLATE "default",
"total_score" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ccd_threeday
-- ----------------------------
DROP TABLE IF EXISTS "public"."ccd_threeday";
CREATE TABLE "public"."ccd_threeday" (
"id" int4 DEFAULT nextval('ccd_threeday_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"call_status" varchar(255) COLLATE "default",
"date_of_call" date,
"date_of_call_np" varchar(255) COLLATE "default",
"delivered_on_time" varchar(255) COLLATE "default",
"cleanliness_of_car" varchar(255) COLLATE "default",
"basic_features" varchar(255) COLLATE "default",
"owner_manual" varchar(255) COLLATE "default",
"service_coupon" varchar(255) COLLATE "default",
"warrenty_card" varchar(255) COLLATE "default",
"delivery_sheet" varchar(255) COLLATE "default",
"ccd_details" varchar(255) COLLATE "default",
"remarks" varchar(255) COLLATE "default",
"voc" varchar(255) COLLATE "default",
"call_count" int4 DEFAULT 0,
"fit_and_finish" varchar(255) COLLATE "default",
"payment_receipt" varchar(255) COLLATE "default",
"tool_set" varchar(255) COLLATE "default",
"recommend_name1" varchar(255) COLLATE "default",
"recommend_contact1" varchar(255) COLLATE "default",
"recommend_name2" varchar(255) COLLATE "default",
"recommend_contact2" varchar(255) COLLATE "default",
"pss_score" varchar(255) COLLATE "default",
"sss_score" varchar(255) COLLATE "default",
"total_score" varchar(255) COLLATE "default",
"unsatisfied" varchar(255) COLLATE "default",
"un_prority" varchar(255) COLLATE "default",
"false_retail" varchar(255) COLLATE "default",
"call_connect_retail_type" varchar(255) COLLATE "default",
"buying_experience" varchar(255) COLLATE "default",
"same_dse" varchar(255) COLLATE "default",
"un_priority" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for crm_vehicle_edit
-- ----------------------------
DROP TABLE IF EXISTS "public"."crm_vehicle_edit";
CREATE TABLE "public"."crm_vehicle_edit" (
"id" int4 DEFAULT nextval('crm_vehicle_edit_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"prev_vehicle" int4,
"prev_variant" int4,
"prev_color" int4,
"new_vehicle" int4,
"new_variant" int4,
"new_color" int4,
"date" date NOT NULL,
"date_np" varchar(255) COLLATE "default",
"status_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for d2d_billing_detail
-- ----------------------------
DROP TABLE IF EXISTS "public"."d2d_billing_detail";
CREATE TABLE "public"."d2d_billing_detail" (
"id" int4 DEFAULT nextval('d2d_billing_detail_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"bill_no" varchar(255) COLLATE "default",
"billed_date" date,
"billed_date_np" varchar(255) COLLATE "default",
"billed_to" int4,
"billed_time" varchar(255) COLLATE "default",
"status" varchar(255) COLLATE "default",
"approved_date" date,
"approved_date_np" varchar(255) COLLATE "default",
"approved_time" varchar(255) COLLATE "default",
"total_amt" numeric(10,2),
"is_billed" int4,
"bill_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for d2d_billing_list
-- ----------------------------
DROP TABLE IF EXISTS "public"."d2d_billing_list";
CREATE TABLE "public"."d2d_billing_list" (
"id" int4 DEFAULT nextval('d2d_billing_list_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"bill_id" int4,
"sparepart_id" int4,
"price" numeric(10,2),
"quantity" int4,
"total_price" numeric(10,2)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dms_customer_followups
-- ----------------------------
DROP TABLE IF EXISTS "public"."dms_customer_followups";
CREATE TABLE "public"."dms_customer_followups" (
"id" int4 DEFAULT nextval('dms_customer_followups_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"executive_id" int4,
"followup_date_en" date,
"followup_date_np" varchar(255) COLLATE "default",
"followup_mode" varchar(255) COLLATE "default",
"followup_status" varchar(255) COLLATE "default",
"followup_notes" text COLLATE "default",
"next_followup" bool,
"next_followup_date_en" date,
"next_followup_date_np" varchar(255) COLLATE "default",
"status" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dms_customer_statuses
-- ----------------------------
DROP TABLE IF EXISTS "public"."dms_customer_statuses";
CREATE TABLE "public"."dms_customer_statuses" (
"id" int4 DEFAULT nextval('dms_customer_statuses_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"status_id" int4,
"reason_id" int4,
"duration" int4,
"notes" varchar(255) COLLATE "default",
"sub_status_id" int4,
"tentative_retail_date" varchar COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dms_customer_test_drives
-- ----------------------------
DROP TABLE IF EXISTS "public"."dms_customer_test_drives";
CREATE TABLE "public"."dms_customer_test_drives" (
"id" int4 DEFAULT nextval('dms_customer_test_drives_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"td_date_en" date,
"td_date_np" varchar(255) COLLATE "default",
"td_time" time(6),
"executive_id" int4,
"vehicle_id" int4,
"variant_id" int4,
"mileage_start" varchar(255) COLLATE "default",
"mileage_end" varchar(255) COLLATE "default",
"duration" varchar(255) COLLATE "default",
"td_location" varchar(255) COLLATE "default",
"document" varchar(255) COLLATE "default",
"opening_kms" varchar(255) COLLATE "default",
"closing_kms" varchar(255) COLLATE "default",
"reported_by" varchar(255) COLLATE "default",
"fuel_location" varchar(255) COLLATE "default",
"month" varchar(255) COLLATE "default",
"kms" varchar(255) COLLATE "default",
"fuel" varchar(255) COLLATE "default",
"chassis_no_test" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dms_customers
-- ----------------------------
DROP TABLE IF EXISTS "public"."dms_customers";
CREATE TABLE "public"."dms_customers" (
"id" int4 DEFAULT nextval('dms_customers_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"inquiry_no" varchar(32) COLLATE "default" DEFAULT NULL::character varying,
"inquiry_kind" varchar(32) COLLATE "default" DEFAULT NULL::character varying,
"fiscal_year_id" int4,
"inquiry_date_en" date,
"inquiry_date_np" varchar(255) COLLATE "default",
"customer_type_id" int4,
"first_name" varchar(255) COLLATE "default",
"middle_name" varchar(255) COLLATE "default",
"last_name" varchar(255) COLLATE "default",
"gender" varchar(255) COLLATE "default",
"marital_status" varchar(255) COLLATE "default",
"family_size" varchar(255) COLLATE "default",
"dob_en" date,
"dob_np" varchar(255) COLLATE "default",
"anniversary_en" date,
"anniversary_np" varchar(255) COLLATE "default",
"district_id" int4,
"mun_vdc_id" int4,
"address_1" varchar(255) COLLATE "default",
"address_2" varchar(255) COLLATE "default",
"email" varchar(255) COLLATE "default",
"home_1" varchar(255) COLLATE "default",
"home_2" varchar(255) COLLATE "default",
"work_1" varchar(255) COLLATE "default",
"work_2" varchar(255) COLLATE "default",
"mobile_1" varchar(255) COLLATE "default",
"mobile_2" varchar(255) COLLATE "default",
"pref_communication" varchar(255) COLLATE "default",
"occupation_id" int4,
"education_id" int4,
"dealer_id" int4,
"executive_id" int4,
"payment_mode_id" int4,
"source_id" int4,
"status_id" int4,
"contact_1_name" varchar(255) COLLATE "default",
"contact_1_mobile" varchar(255) COLLATE "default",
"contact_1_relation_id" int4,
"contact_2_name" varchar(255) COLLATE "default",
"contact_2_mobile" varchar(255) COLLATE "default",
"contact_2_relation_id" int4,
"remarks" text COLLATE "default",
"vehicle_id" int4,
"variant_id" int4,
"color_id" int4,
"walkin_source_id" int4,
"event_id" int4,
"institution_id" int4,
"exchange_car_make" varchar(255) COLLATE "default",
"exchange_car_model" varchar(255) COLLATE "default",
"exchange_car_year" varchar(255) COLLATE "default",
"exchange_car_kms" int4,
"exchange_car_value" int4,
"exchange_car_bonus" int4,
"exchange_total_offer" int4,
"bank_id" int4,
"bank_branch" varchar(255) COLLATE "default",
"bank_staff" varchar(255) COLLATE "default",
"bank_contact" varchar(255) COLLATE "default",
"booking_canceled" int4,
"discount_amount" int4,
"rank" int4,
"is_edited" int8 DEFAULT 0,
"vehicle_make_year" int2,
"exchange_car_variant" varchar(255) COLLATE "default",
"document" varchar(255) COLLATE "default",
"longitude" varchar(255) COLLATE "default",
"latitude" varchar(255) COLLATE "default",
"customer_image" varchar(255) COLLATE "default",
"is_nada" varchar(255) COLLATE "default",
"special_discount_amount" int4,
"image" varchar(255) COLLATE "default",
"online_source" varchar(255) COLLATE "default",
"sub_source_id" int4,
"source_type_id" int4,
"exchange_bike_value" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dms_dealers
-- ----------------------------
DROP TABLE IF EXISTS "public"."dms_dealers";
CREATE TABLE "public"."dms_dealers" (
"id" int4 DEFAULT nextval('dms_dealers_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"incharge_id" int4,
"district_id" int4,
"mun_vdc_id" int4,
"city_place_id" int4,
"address_1" varchar(255) COLLATE "default",
"address_2" varchar(255) COLLATE "default",
"phone_1" varchar(255) COLLATE "default",
"phone_2" varchar(255) COLLATE "default",
"email" varchar(255) COLLATE "default",
"fax" varchar(255) COLLATE "default",
"latitude" varchar(255) COLLATE "default" DEFAULT NULL::character varying,
"longitude" varchar(255) COLLATE "default" DEFAULT NULL::character varying,
"remarks" text COLLATE "default",
"dealer_type" int4,
"dealer_location" varchar(255) COLLATE "default",
"rank" int4,
"credit_policy" int4,
"prefix" varchar(255) COLLATE "default",
"parent_id" int4,
"spares_incharge_id" int4,
"service_incharge_id" int4,
"assistant_incharge_id" int4,
"show_website" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dms_discount_old_schemes
-- ----------------------------
DROP TABLE IF EXISTS "public"."dms_discount_old_schemes";
CREATE TABLE "public"."dms_discount_old_schemes" (
"id" int4 DEFAULT nextval('dms_discount_old_schemes_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"variant_id" int4,
"staff_limit" int4,
"incharge_limit" int4,
"manager_limit" int4,
"sales_head_limit" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dms_easyappointment_bookings
-- ----------------------------
DROP TABLE IF EXISTS "public"."dms_easyappointment_bookings";
CREATE TABLE "public"."dms_easyappointment_bookings" (
"id" int4 DEFAULT nextval('dms_easyappointment_bookings_id_seq'::regclass) NOT NULL,
"service_name" varchar(255) COLLATE "default",
"provider" varchar(255) COLLATE "default",
"appointmant_date" varchar(255) COLLATE "default",
"first_name" varchar(255) COLLATE "default",
"last_name" varchar(255) COLLATE "default",
"address" varchar(255) COLLATE "default",
"city" varchar(255) COLLATE "default",
"email" varchar(255) COLLATE "default",
"notes" text COLLATE "default",
"mobile" varchar(255) COLLATE "default",
"vehicle_reg_no" varchar COLLATE "default",
"model_year" varchar(255) COLLATE "default",
"model" varchar(255) COLLATE "default",
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dms_employee_contacts
-- ----------------------------
DROP TABLE IF EXISTS "public"."dms_employee_contacts";
CREATE TABLE "public"."dms_employee_contacts" (
"id" int4 DEFAULT nextval('dms_employee_contacts_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"employee_id" int4,
"name" varchar(255) COLLATE "default",
"relation_id" int4,
"home" varchar(255) COLLATE "default",
"work" varchar(255) COLLATE "default",
"mobile" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dms_employees
-- ----------------------------
DROP TABLE IF EXISTS "public"."dms_employees";
CREATE TABLE "public"."dms_employees" (
"id" int4 DEFAULT nextval('dms_employees_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"has_login" bool DEFAULT false,
"user_id" int4,
"first_name" varchar(255) COLLATE "default",
"middle_name" varchar(255) COLLATE "default",
"last_name" varchar(255) COLLATE "default",
"dob_en" date,
"dob_np" varchar(255) COLLATE "default",
"gender" int2,
"marital_status" int2,
"permanent_district_id" int4,
"permanent_mun_vdc_id" int4,
"permanent_ward" varchar(255) COLLATE "default",
"permanent_address_1" varchar(255) COLLATE "default",
"permanent_address_2" varchar(255) COLLATE "default",
"temporary_district_id" int4,
"temporary_mun_vdc_id" int4,
"temporary_ward" varchar(255) COLLATE "default",
"temporary_address_1" varchar(255) COLLATE "default",
"temporary_address_2" varchar(255) COLLATE "default",
"home" varchar(255) COLLATE "default",
"work" varchar(255) COLLATE "default",
"mobile" varchar(255) COLLATE "default",
"work_email" varchar(255) COLLATE "default",
"personal_email" varchar(255) COLLATE "default",
"photo" varchar(255) COLLATE "default",
"nationality" varchar(255) COLLATE "default",
"citizenship_no" varchar(255) COLLATE "default",
"citizenship_issued_on" varchar(255) COLLATE "default",
"citizenship_issued_by" varchar(255) COLLATE "default",
"license" bool,
"license_type" varchar(255) COLLATE "default",
"license_no" varchar(255) COLLATE "default",
"license_issued_on" varchar(255) COLLATE "default",
"license_issued_by" varchar(255) COLLATE "default",
"license_expiry" varchar(255) COLLATE "default",
"passport" bool,
"passport_type" varchar(255) COLLATE "default",
"passport_no" varchar(255) COLLATE "default",
"passport_issued_on" varchar(255) COLLATE "default",
"passport_issued_by" varchar(255) COLLATE "default",
"passport_expiry" varchar(255) COLLATE "default",
"education_id" int4,
"designation_id" int4,
"interview_date_en" date,
"interview_date_np" varchar(255) COLLATE "default",
"probation_period" varchar(255) COLLATE "default",
"joining_date_en" date,
"joining_date_np" varchar(255) COLLATE "default",
"confirmation_date_en" date,
"confirmation_date_np" varchar(255) COLLATE "default",
"leaving_date_en" date,
"leaving_date_np" varchar(255) COLLATE "default",
"leaving_reason" varchar(255) COLLATE "default",
"employee_type" int4,
"mechanic_leader" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dms_events
-- ----------------------------
DROP TABLE IF EXISTS "public"."dms_events";
CREATE TABLE "public"."dms_events" (
"id" int4 DEFAULT nextval('dms_events_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"name" varchar(255) COLLATE "default",
"start_date_en" date,
"start_date_np" varchar(255) COLLATE "default",
"end_date_en" date,
"end_date_np" varchar(255) COLLATE "default",
"active" bool,
"description" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dms_msil_scanned_order
-- ----------------------------
DROP TABLE IF EXISTS "public"."dms_msil_scanned_order";
CREATE TABLE "public"."dms_msil_scanned_order" (
"id" int4 DEFAULT nextval('dms_msil_scanned_order_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"part_name" varchar(255) COLLATE "default",
"quantity" int4,
"order_no" varchar(255) COLLATE "default",
"part_code" varchar(255) COLLATE "default",
"location" varchar(255) COLLATE "default",
"invoice_no" varchar(255) COLLATE "default",
"binning_date_en" date,
"binning_date_np" date,
"box_quantity" int4,
"scanner_device_id" int4,
"scanner_name_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dms_quotations
-- ----------------------------
DROP TABLE IF EXISTS "public"."dms_quotations";
CREATE TABLE "public"."dms_quotations" (
"id" int4 DEFAULT nextval('dms_quotations_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"quotation_date_en" date,
"quotation_date_np" varchar(255) COLLATE "default",
"quote_price" int4,
"quote_unit" int4,
"quote_mrp" int4,
"quote_discount" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dms_sms_history
-- ----------------------------
DROP TABLE IF EXISTS "public"."dms_sms_history";
CREATE TABLE "public"."dms_sms_history" (
"id" int4 DEFAULT nextval('dms_sms_history_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"date" date,
"message" text COLLATE "default",
"reciever_no" float4,
"sms_template_id" int4,
"sent" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dms_vehicles
-- ----------------------------
DROP TABLE IF EXISTS "public"."dms_vehicles";
CREATE TABLE "public"."dms_vehicles" (
"id" int4 DEFAULT nextval('dms_vehicles_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"variant_id" int4,
"color_id" int4,
"price" int4,
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for driver_details
-- ----------------------------
DROP TABLE IF EXISTS "public"."driver_details";
CREATE TABLE "public"."driver_details" (
"id" int4 DEFAULT nextval('driver_details_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"driver_name" varchar(256) COLLATE "default",
"driver_number" varchar(256) COLLATE "default",
"driver_address" varchar(256) COLLATE "default",
"source" varchar(256) COLLATE "default",
"destination" varchar(256) COLLATE "default",
"photo" varchar(256) COLLATE "default",
"license_no" varchar(256) COLLATE "default",
"challan_date" date
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for inquiry_name_edit
-- ----------------------------
DROP TABLE IF EXISTS "public"."inquiry_name_edit";
CREATE TABLE "public"."inquiry_name_edit" (
"id" int4 DEFAULT nextval('inquiry_name_edit_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"old_name" varchar(255) COLLATE "default",
"new_name" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for log_damage
-- ----------------------------
DROP TABLE IF EXISTS "public"."log_damage";
CREATE TABLE "public"."log_damage" (
"id" int4 DEFAULT nextval('log_damage_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"damage_id" int4,
"part" varchar(255) COLLATE "default",
"report_time" timestamp(6),
"chass_no" varchar(255) COLLATE "default",
"description" text COLLATE "default",
"vehicle_id" int4,
"repair_by" varchar(255) COLLATE "default",
"repaired_at" timestamp(6),
"image" varchar(255) COLLATE "default",
"service_center" varchar(255) COLLATE "default",
"amount" int4,
"estimated_date_of_repair" date,
"category" varchar(255) COLLATE "default",
"dispatch_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for log_dealer_incharge
-- ----------------------------
DROP TABLE IF EXISTS "public"."log_dealer_incharge";
CREATE TABLE "public"."log_dealer_incharge" (
"id" int4 DEFAULT nextval('log_dealer_incharge_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"order_id" int4,
"dealer_id" int4,
"nearest_stockyard" varchar(255) COLLATE "default",
"dispatch_date" date,
"dispatch_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for log_dealer_order
-- ----------------------------
DROP TABLE IF EXISTS "public"."log_dealer_order";
CREATE TABLE "public"."log_dealer_order" (
"id" int4 DEFAULT nextval('log_dealer_order_id_seq'::regclass) NOT NULL,
"date_of_order" date,
"date_of_delivery" date,
"delivery_lead_time" varchar(255) COLLATE "default",
"pdi_status" int4,
"date_of_retail" date,
"retail_lead_time" varchar(255) COLLATE "default",
"created_by" varchar(255) COLLATE "default",
"updated_by" varchar(255) COLLATE "default",
"created_at" date,
"updated_at" date,
"payment_status" int2 DEFAULT 0,
"vehicle_id" int4,
"variant_id" int4,
"color_id" int4,
"received_date" date,
"challan_return_image" char(255) COLLATE "default",
"vehicle_main_id" int4,
"order_id" int4,
"quantity" int4,
"payment_method" varchar(255) COLLATE "default",
"associated_value_payment" varchar(255) COLLATE "default",
"dealer_id" int4,
"year" int4,
"date_of_retail_np" varchar(30) COLLATE "default",
"date_of_retail_np_month" varchar(30) COLLATE "default",
"date_of_retail_np_year" varchar(30) COLLATE "default",
"cancel_quantity" int4 DEFAULT 0,
"cancel_date" date,
"cancel_date_np" varchar(255) COLLATE "default",
"credit_control_approval" int4 DEFAULT 0,
"credit_approve_date" date,
"credit_approve_date_np" varchar(255) COLLATE "default",
"remarks" varchar(255) COLLATE "default",
"grn_received_date" date,
"grn_received_date_np" varchar(255) COLLATE "default",
"order_month_id" int4,
"payment_edit" int4 DEFAULT 0,
"payment_edit_date" date,
"deleted_at" date,
"deleted_by" int4,
"in_stock_remarks" int4,
"delivery_date" date,
"stock_arrived_date" date,
"stock_arrived_date_np" varchar(255) COLLATE "default",
"stock_in_ktm" int4,
"delivery_day" int4,
"grn_allow_status" int4 DEFAULT 0,
"cancel_order_status" int4 DEFAULT 0,
"grn_file" varchar(255) COLLATE "default",
"is_ktm_dealer" int4,
"color_change_date" date,
"color_change_date_np" varchar(255) COLLATE "default",
"logistic_confirmation_date" date,
"logistic_confirmation_date_np" varchar(255) COLLATE "default",
"on_hold_remarks" text COLLATE "default",
"challan_status" varchar(255) COLLATE "default",
"location" varchar(255) COLLATE "default",
"order_type" varchar(255) COLLATE "default",
"credit_hold_date" date,
"credit_hold_date_np" varchar COLLATE "default",
"dispatch_user_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for log_dispatch_dealer
-- ----------------------------
DROP TABLE IF EXISTS "public"."log_dispatch_dealer";
CREATE TABLE "public"."log_dispatch_dealer" (
"id" int4 DEFAULT nextval('log_dispatch_dealer_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"stock_yard_id" int4,
"driver_name" varchar(255) COLLATE "default",
"driver_address" varchar(255) COLLATE "default",
"driver_contact" varchar(255) COLLATE "default",
"driver_liscense_no" varchar(255) COLLATE "default",
"dealer_id" int4,
"received_status" int4,
"image_name" varchar(255) COLLATE "default",
"dispatched_date" date,
"dealer_order_id" int4,
"vehicle_return" int4 DEFAULT 0,
"vehicle_return_date" timestamp(6),
"vehicle_return_date_nep" varchar(255) COLLATE "default",
"vehicle_return_reason" varchar(255) COLLATE "default",
"dispatched_date_np" varchar(30) COLLATE "default",
"dispatched_date_np_month" varchar(30) COLLATE "default",
"dispatched_date_np_year" varchar(30) COLLATE "default",
"received_date" date,
"received_date_nep" varchar(255) COLLATE "default",
"challan_return_image" varchar(255) COLLATE "default",
"remarks" varchar(255) COLLATE "default",
"image" varchar(255) COLLATE "default",
"remarks_delay" varchar(255) COLLATE "default",
"edit_month_np" int4,
"fiscal_year" varchar(255) COLLATE "default",
"accessories" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for log_fuel_kms
-- ----------------------------
DROP TABLE IF EXISTS "public"."log_fuel_kms";
CREATE TABLE "public"."log_fuel_kms" (
"id" int4 DEFAULT nextval('log_fuel_kms_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"fuel" varchar(255) COLLATE "default",
"kms" varchar(255) COLLATE "default",
"date" date NOT NULL,
"date_np" varchar(255) COLLATE "default",
"location" varchar(255) COLLATE "default",
"fuel_remarks" varchar(255) COLLATE "default",
"opening_kms" varchar(255) COLLATE "default",
"closing_kms" varchar(255) COLLATE "default",
"reported_by" varchar(255) COLLATE "default",
"customer_name" varchar(255) COLLATE "default",
"mobile_number" varchar(255) COLLATE "default",
"month" varchar(255) COLLATE "default",
"executive_name" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for log_repair
-- ----------------------------
DROP TABLE IF EXISTS "public"."log_repair";
CREATE TABLE "public"."log_repair" (
"id" int4 DEFAULT nextval('log_repair_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_name" varchar(255) COLLATE "default",
"vehicle_id" int4,
"color_name" varchar(255) COLLATE "default",
"variant_name" varchar(255) COLLATE "default",
"description" text COLLATE "default",
"image" varchar(255) COLLATE "default",
"chass_no" int4,
"engine_no" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for log_stock_damage_records
-- ----------------------------
DROP TABLE IF EXISTS "public"."log_stock_damage_records";
CREATE TABLE "public"."log_stock_damage_records" (
"id" int4 DEFAULT nextval('log_stock_damage_records_id_seq'::regclass) NOT NULL,
"created_by" int2,
"updated_by" int2,
"deleted_by" int2,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"stock_record_id" int4,
"damage_date" date,
"damage_date_nep" varchar(255) COLLATE "default",
"repair_commitment_date" date,
"repair_date" date,
"repair_date_nep" varchar(255) COLLATE "default",
"remarks" text COLLATE "default",
"current_location" varchar(255) COLLATE "default",
"accident_type" varchar(255) COLLATE "default",
"challan_status" varchar(255) COLLATE "default",
"location" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for log_stock_records
-- ----------------------------
DROP TABLE IF EXISTS "public"."log_stock_records";
CREATE TABLE "public"."log_stock_records" (
"id" int4 DEFAULT nextval('log_stock_records_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"stock_yard_id" int4,
"dispatched_date" date,
"reached_date" date,
"reached_date_nep" varchar(255) COLLATE "default",
"dispatched_date_nep" varchar(255) COLLATE "default",
"damage_date" date,
"damage_date_nep" varchar(255) COLLATE "default",
"repair_commitment_date" date,
"repair_date" date,
"repair_date_nep" varchar(255) COLLATE "default",
"is_damage" int4 DEFAULT 0,
"remarks" varchar COLLATE "default",
"dealer_reject" int4 DEFAULT 0,
"dispatched_date_np" varchar(30) COLLATE "default",
"dispatched_date_np_month" varchar(30) COLLATE "default",
"dispatched_date_np_year" varchar(30) COLLATE "default",
"current_location" varchar(255) COLLATE "default",
"is_dispatched" int4,
"return_stockyard_id" int4,
"return_dealer_id" int4,
"return_date" date,
"return_date_nep" varchar(255) COLLATE "default",
"dispatch_id" int4,
"driver_id" int4,
"present_location" varchar(255) COLLATE "default",
"stock_transfer_date" date,
"pdi_date" date,
"pdi_date_np" varchar(255) COLLATE "default",
"transfer_from" varchar(255) COLLATE "default",
"retail_fiscal_year" varchar(255) COLLATE "default",
"retail_edit_month" int4,
"accident_type" varchar(255) COLLATE "default",
"challan_status" varchar(255) COLLATE "default",
"location" varchar(255) COLLATE "default",
"log_retail_date" date,
"challan_confirmation_date" date,
"pdi_to_yard_date" date,
"yard_location" varchar(255) COLLATE "default",
"pdi_status" varchar(255) COLLATE "default",
"pdi_job_card_open_date" date,
"pdi_job_card_no" varchar(255) COLLATE "default",
"pdi_bill_no" varchar(255) COLLATE "default",
"pdi_bill_date" date,
"pdi_bill_date_np" varchar(255) COLLATE "default",
"stock_out_date" date,
"stock_out_date_np" varchar(255) COLLATE "default",
"dealers_return_date" date,
"dealers_return_date_np" varchar(255) COLLATE "default",
"allocation_date" date,
"allocation_date_np" varchar(255) COLLATE "default",
"allocation_type" varchar(255) COLLATE "default",
"received_confirmation_via_challan" varchar(255) COLLATE "default",
"insurance_email_date" date,
"pdi_remarks" text COLLATE "default",
"pdi_to_yard_date_np" varchar(255) COLLATE "default",
"pdi_job_card_open_date_np" varchar(255) COLLATE "default",
"insurance_email_date_np" varchar(255) COLLATE "default",
"pdi_bill_month" varchar(255) COLLATE "default",
"hold_remark" text COLLATE "default",
"log_retail_date_np" varchar COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for msil_dispatch_records
-- ----------------------------
DROP TABLE IF EXISTS "public"."msil_dispatch_records";
CREATE TABLE "public"."msil_dispatch_records" (
"id" int4 DEFAULT nextval('msil_dispatch_records_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"variant_id" int4,
"color_id" int4,
"engine_no" varchar(255) COLLATE "default",
"chass_no" varchar(255) COLLATE "default",
"dispatch_date" date,
"month" int4,
"year" int4,
"order_no" varchar(255) COLLATE "default",
"ait_reference_no" varchar(255) COLLATE "default",
"invoice_no" varchar(255) COLLATE "default",
"invoice_date" date,
"transit" int4,
"indian_stock_yard" date,
"indian_custom" date,
"nepal_custom" date,
"border" date,
"barcode" varchar(255) COLLATE "default",
"custom_name" varchar(255) COLLATE "default",
"vehicle_register_no" varchar(255) COLLATE "default",
"vehicle_register_date" date,
"dispatched_date_np" varchar(30) COLLATE "default",
"dispatched_date_np_month" varchar(30) COLLATE "default",
"dispatched_date_np_year" varchar(30) COLLATE "default",
"in_display" int4,
"remarks" varchar(255) COLLATE "default",
"current_location" varchar(255) COLLATE "default",
"current_status" varchar(255) COLLATE "default",
"indian_stock_yard_np" varchar(255) COLLATE "default",
"indian_stock_yard_np_month" varchar(255) COLLATE "default",
"indian_stock_yard_np_year" varchar(255) COLLATE "default",
"indian_custom_np" varchar(255) COLLATE "default",
"indian_custom_np_month" varchar(255) COLLATE "default",
"indian_custom_np_year" varchar(255) COLLATE "default",
"nepal_custom_np" varchar(255) COLLATE "default",
"nepal_custom_np_month" varchar(255) COLLATE "default",
"nepal_custom_np_year" varchar(255) COLLATE "default",
"pragyapan_no" varchar(255) COLLATE "default",
"pragyapan_date" date,
"pragyapan_date_np" varchar(255) COLLATE "default",
"key_no" varchar(255) COLLATE "default",
"company_name" varchar(255) COLLATE "default",
"display_location" varchar(255) COLLATE "default",
"india_custom_movement_date" date,
"india_custom_movement_date_np" varchar(255) COLLATE "default",
"nepal_custom_movement_date" date,
"nepal_custom_movement_date_np" varchar(255) COLLATE "default",
"lc_number" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for msil_monthly_plannings
-- ----------------------------
DROP TABLE IF EXISTS "public"."msil_monthly_plannings";
CREATE TABLE "public"."msil_monthly_plannings" (
"id" int4 DEFAULT nextval('msil_monthly_plannings_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"variant_id" int4,
"color_id" int4,
"month" int4,
"year" int4,
"dealer_id" int4,
"quantity" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for msil_order_mismatch
-- ----------------------------
DROP TABLE IF EXISTS "public"."msil_order_mismatch";
CREATE TABLE "public"."msil_order_mismatch" (
"id" int4 DEFAULT nextval('msil_order_mismatch_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_name" varchar(255) COLLATE "default",
"variant_name" varchar(255) COLLATE "default",
"color" varchar(255) COLLATE "default",
"month" int4,
"year" int4,
"quantity" int4,
"company" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for msil_orders
-- ----------------------------
DROP TABLE IF EXISTS "public"."msil_orders";
CREATE TABLE "public"."msil_orders" (
"id" int4 DEFAULT nextval('msil_orders_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"variant_id" int4,
"color_id" int4,
"month" int4,
"year" int4,
"order_id" int4,
"quantity" int4,
"firm_id" int4,
"received_quantity" int4 DEFAULT 0,
"vehicle_received_status" int2 DEFAULT 0,
"cancel_quantity" int4 DEFAULT 0,
"reason" varchar(255) COLLATE "default",
"unplanned_order" int2 DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_accessories
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_accessories";
CREATE TABLE "public"."mst_accessories" (
"id" int4 DEFAULT nextval('mst_accessories_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_banks
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_banks";
CREATE TABLE "public"."mst_banks" (
"id" int4 DEFAULT nextval('mst_banks_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"code" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_city_places
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_city_places";
CREATE TABLE "public"."mst_city_places" (
"id" int4 DEFAULT nextval('mst_city_places_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"district_id" int4,
"mun_vdc_id" int4,
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_colors
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_colors";
CREATE TABLE "public"."mst_colors" (
"id" int4 DEFAULT nextval('mst_colors_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"code" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_customer_types
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_customer_types";
CREATE TABLE "public"."mst_customer_types" (
"id" int4 DEFAULT nextval('mst_customer_types_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_designations
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_designations";
CREATE TABLE "public"."mst_designations" (
"id" int4 DEFAULT nextval('mst_designations_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_district_mvs
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_district_mvs";
CREATE TABLE "public"."mst_district_mvs" (
"id" int4 DEFAULT nextval('mst_district_mvs_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"code" varchar(10) COLLATE "default",
"name" varchar(255) COLLATE "default",
"parent_id" int4,
"type" varchar(25) COLLATE "default" DEFAULT NULL::character varying,
"boundary_coordinates" text COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_educations
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_educations";
CREATE TABLE "public"."mst_educations" (
"id" int4 DEFAULT nextval('mst_educations_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_firms
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_firms";
CREATE TABLE "public"."mst_firms" (
"id" int4 DEFAULT nextval('mst_firms_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4,
"prefix" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_fiscal_years
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_fiscal_years";
CREATE TABLE "public"."mst_fiscal_years" (
"id" int4 DEFAULT nextval('mst_fiscal_years_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"nepali_start_date" varchar(255) COLLATE "default",
"nepali_end_date" varchar(255) COLLATE "default",
"english_start_date" date,
"english_end_date" date,
"active" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_foc_accessoreis_partcode
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_foc_accessoreis_partcode";
CREATE TABLE "public"."mst_foc_accessoreis_partcode" (
"id" int4 DEFAULT nextval('mst_foc_accessoreis_partcode_id_seq'::regclass) NOT NULL,
"created_by" int2,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"deleted_at" timestamp(6),
"updated_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"part_code" varchar(255) COLLATE "default",
"vehicle_id" int4,
"approval" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_foc_accessories
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_foc_accessories";
CREATE TABLE "public"."mst_foc_accessories" (
"id" int4 DEFAULT nextval('mst_foc_accessories_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_inquiry_statuses
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_inquiry_statuses";
CREATE TABLE "public"."mst_inquiry_statuses" (
"id" int4 DEFAULT nextval('mst_inquiry_statuses_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4,
"sub_status_group" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_institutions
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_institutions";
CREATE TABLE "public"."mst_institutions" (
"id" int4 DEFAULT nextval('mst_institutions_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_minimum_quantity
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_minimum_quantity";
CREATE TABLE "public"."mst_minimum_quantity" (
"id" int4 DEFAULT nextval('mst_minimum_quantity_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"variant_id" int4,
"color_id" int4,
"quantity" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_nepali_month
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_nepali_month";
CREATE TABLE "public"."mst_nepali_month" (
"id" int4 NOT NULL,
"created_by" int2,
"updated_by" int2,
"deleted_by" int2,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int2,
"quater" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_occupations
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_occupations";
CREATE TABLE "public"."mst_occupations" (
"id" int4 DEFAULT nextval('mst_occupations_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_payment_modes
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_payment_modes";
CREATE TABLE "public"."mst_payment_modes" (
"id" int4 DEFAULT nextval('mst_payment_modes_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_reasons
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_reasons";
CREATE TABLE "public"."mst_reasons" (
"id" int4 DEFAULT nextval('mst_reasons_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"type" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_relations
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_relations";
CREATE TABLE "public"."mst_relations" (
"id" int4 DEFAULT nextval('mst_relations_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_scan_device
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_scan_device";
CREATE TABLE "public"."mst_scan_device" (
"id" int4 DEFAULT nextval('mst_scan_device_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"device_name" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_scan_person
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_scan_person";
CREATE TABLE "public"."mst_scan_person" (
"id" int4 DEFAULT nextval('mst_scan_person_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_service_job_description
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_service_job_description";
CREATE TABLE "public"."mst_service_job_description" (
"id" int2 DEFAULT nextval('mst_service_job_description_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"variant_id" int4,
"status" int2,
"price" float4,
"duration_hours" int4,
"duration_minutes" int4,
"service_job_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_service_jobs
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_service_jobs";
CREATE TABLE "public"."mst_service_jobs" (
"id" int4 DEFAULT nextval('mst_service_jobs_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"rank" int4,
"job_code" varchar(255) COLLATE "default",
"description" varchar(255) COLLATE "default",
"group_id" int4,
"apply_tax" int4,
"outsidework_margin" float4,
"number_vehicles" int4,
"mechanic_incentive" int2,
"top_complaints" int2,
"under_warranty" int2
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_service_policy
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_service_policy";
CREATE TABLE "public"."mst_service_policy" (
"id" int4 DEFAULT nextval('mst_service_policy_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"policy_name" varchar(256) COLLATE "default" NOT NULL,
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_service_types
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_service_types";
CREATE TABLE "public"."mst_service_types" (
"id" int4 DEFAULT nextval('mst_service_types_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4,
"type" varchar COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_service_warranty_policy
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_service_warranty_policy";
CREATE TABLE "public"."mst_service_warranty_policy" (
"id" int4 DEFAULT nextval('mst_service_warranty_policy_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"service_policy_no" int4,
"service_count" int4,
"km_min" int4,
"km_max" int4,
"period" int4,
"oil_change" bool,
"service_type_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_sms_template
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_sms_template";
CREATE TABLE "public"."mst_sms_template" (
"id" int4 DEFAULT nextval('mst_sms_template_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"type" varchar COLLATE "default",
"variables" varchar COLLATE "default",
"message" text COLLATE "default",
"skeleton" text COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_source_type
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_source_type";
CREATE TABLE "public"."mst_source_type" (
"id" int4 DEFAULT nextval('mst_source_type_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_sources
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_sources";
CREATE TABLE "public"."mst_sources" (
"id" int4 DEFAULT nextval('mst_sources_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4,
"source_type_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_spareparts
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_spareparts";
CREATE TABLE "public"."mst_spareparts" (
"id" int4 DEFAULT nextval('mst_spareparts_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"part_code" varchar(255) COLLATE "default",
"alternate_part_code" varchar(255) COLLATE "default",
"name" varchar(255) COLLATE "default",
"moq" int4,
"category_id" int4,
"model" varchar(255) COLLATE "default",
"price" numeric,
"latest_part_code" varchar(255) COLLATE "default",
"dealer_price" numeric,
"uom" varchar(255) COLLATE "default",
"is_local" int4,
"temp" numeric
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_spareparts_category
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_spareparts_category";
CREATE TABLE "public"."mst_spareparts_category" (
"id" int4 DEFAULT nextval('mst_spareparts_category_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_spareparts_dealer
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_spareparts_dealer";
CREATE TABLE "public"."mst_spareparts_dealer" (
"id" int4 DEFAULT nextval('mst_spareparts_dealer_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"incharge_id" int4,
"district_id" int4,
"mun_vdc_id" int4,
"city_place_id" int4,
"address_1" varchar(255) COLLATE "default",
"address_2" varchar(255) COLLATE "default",
"phone_1" varchar(255) COLLATE "default",
"phone_2" varchar(255) COLLATE "default",
"email" varchar(255) COLLATE "default",
"fax" varchar(255) COLLATE "default",
"latitude" varchar(255) COLLATE "default" DEFAULT NULL::character varying,
"longitude" varchar(255) COLLATE "default" DEFAULT NULL::character varying,
"remarks" text COLLATE "default",
"credit_policy" int4,
"parent_id" int4,
"prefix" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_stock_yards
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_stock_yards";
CREATE TABLE "public"."mst_stock_yards" (
"id" int4 DEFAULT nextval('mst_stock_yards_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"latitude" varchar(255) COLLATE "default",
"longitude" varchar(255) COLLATE "default",
"rank" int4,
"type" int4,
"incharge_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_sub_source
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_sub_source";
CREATE TABLE "public"."mst_sub_source" (
"id" int4 DEFAULT nextval('mst_sub_source_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4,
"source_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_titles
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_titles";
CREATE TABLE "public"."mst_titles" (
"id" int4 DEFAULT nextval('mst_titles_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_user_ledger
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_user_ledger";
CREATE TABLE "public"."mst_user_ledger" (
"id" int4 DEFAULT nextval('mst_user_ledger_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"title" varchar(255) COLLATE "default",
"short_name" varchar(255) COLLATE "default",
"full_name" varchar(255) COLLATE "default",
"address1" varchar(255) COLLATE "default",
"address2" varchar(255) COLLATE "default",
"address3" varchar(255) COLLATE "default",
"city" varchar(255) COLLATE "default",
"area" varchar(255) COLLATE "default",
"district_id" int4,
"zone_id" int4,
"pin_code" int4,
"std_code" varchar(50) COLLATE "default",
"mobile" varchar COLLATE "default",
"phone_no" varchar COLLATE "default",
"email" varchar(255) COLLATE "default",
"dob" date,
"dealer_id" int4,
"pan_no" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_variants
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_variants";
CREATE TABLE "public"."mst_variants" (
"id" int4 DEFAULT nextval('mst_variants_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_vehicles
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_vehicles";
CREATE TABLE "public"."mst_vehicles" (
"id" int4 DEFAULT nextval('mst_vehicles_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"firm_id" int4,
"name" varchar(255) COLLATE "default",
"rank" int4,
"service_policy_id" int4,
"for_sales" int2
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_walkin_sources
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_walkin_sources";
CREATE TABLE "public"."mst_walkin_sources" (
"id" int4 DEFAULT nextval('mst_walkin_sources_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"rank" int4,
"sub_source_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for mst_workshop
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_workshop";
CREATE TABLE "public"."mst_workshop" (
"id" int4 DEFAULT nextval('mst_workshop_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"address1" varchar(255) COLLATE "default",
"address2" varchar(255) COLLATE "default",
"address3" varchar(255) COLLATE "default",
"phone1" int4,
"phone2" int4,
"office_address" varchar(255) COLLATE "default",
"office_phone" int4,
"dealer_id" int4,
"incharge_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for project_activity_logs
-- ----------------------------
DROP TABLE IF EXISTS "public"."project_activity_logs";
CREATE TABLE "public"."project_activity_logs" (
"id" int4 DEFAULT nextval('project_activity_logs_id_seq'::regclass) NOT NULL,
"user_id" int4 NOT NULL,
"table_name" varchar(255) COLLATE "default",
"table_pk" int4 NOT NULL,
"action" varchar(255) COLLATE "default",
"action_dttime" timestamp(6)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for project_audit_logs
-- ----------------------------
DROP TABLE IF EXISTS "public"."project_audit_logs";
CREATE TABLE "public"."project_audit_logs" (
"id" int4 DEFAULT nextval('project_audit_logs_id_seq'::regclass) NOT NULL,
"user_id" int4 NOT NULL,
"table_name" varchar(255) COLLATE "default",
"table_pk" int4 NOT NULL,
"column_name" varchar(255) COLLATE "default",
"old_value" varchar(1000) COLLATE "default",
"new_value" varchar(1000) COLLATE "default",
"action_dttime" timestamp(6)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for project_migrations
-- ----------------------------
DROP TABLE IF EXISTS "public"."project_migrations";
CREATE TABLE "public"."project_migrations" (
"version" int8 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for project_sessions
-- ----------------------------
DROP TABLE IF EXISTS "public"."project_sessions";
CREATE TABLE "public"."project_sessions" (
"id" varchar(40) COLLATE "default" NOT NULL,
"ip_address" varchar(45) COLLATE "default" NOT NULL,
"timestamp" int4 NOT NULL,
"data" text COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for project_settings
-- ----------------------------
DROP TABLE IF EXISTS "public"."project_settings";
CREATE TABLE "public"."project_settings" (
"id" int4 DEFAULT nextval('project_settings_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"code" varchar(255) COLLATE "default",
"key" varchar(255) COLLATE "default",
"value" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for sales_booking_cancel
-- ----------------------------
DROP TABLE IF EXISTS "public"."sales_booking_cancel";
CREATE TABLE "public"."sales_booking_cancel" (
"id" int4 DEFAULT nextval('sales_booking_cancel_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"notes" varchar COLLATE "default",
"cancel_amount" int4,
"cancel_reason" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for sales_credit_control_decision
-- ----------------------------
DROP TABLE IF EXISTS "public"."sales_credit_control_decision";
CREATE TABLE "public"."sales_credit_control_decision" (
"id" int4 DEFAULT nextval('sales_credit_control_decision_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"order_id" int4,
"status" int4,
"dealer_id" int4,
"remarks" varchar(255) COLLATE "default",
"date" date NOT NULL,
"date_np" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for sales_discount_limit
-- ----------------------------
DROP TABLE IF EXISTS "public"."sales_discount_limit";
CREATE TABLE "public"."sales_discount_limit" (
"id" int4 DEFAULT nextval('sales_discount_limit_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4 NOT NULL,
"variant_id" int4 NOT NULL,
"staff_limit" int4,
"incharge_limit" int4,
"manager_limit" int4,
"sales_head_limit" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for sales_discount_schemes
-- ----------------------------
DROP TABLE IF EXISTS "public"."sales_discount_schemes";
CREATE TABLE "public"."sales_discount_schemes" (
"id" int4 DEFAULT nextval('sales_discount_schemes_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"actual_price" int4 NOT NULL,
"discount_request" int4 NOT NULL,
"vehicle_id" int4 NOT NULL,
"variant_id" int4 NOT NULL,
"color_id" int4 NOT NULL,
"approval" int4,
"approved_by" varchar(255) COLLATE "default",
"approved_date" date,
"customer_id" int4 NOT NULL,
"remarks" varchar(255) COLLATE "default",
"designation" varchar(255) COLLATE "default",
"showroom_incharge_id" int4,
"dealer_incharge_id" int4,
"management_incharge_id" int4,
"admin" int4,
"reduced_discount" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for sales_foc_document
-- ----------------------------
DROP TABLE IF EXISTS "public"."sales_foc_document";
CREATE TABLE "public"."sales_foc_document" (
"id" int4 DEFAULT nextval('sales_foc_document_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"accessories_id" varchar(255) COLLATE "default",
"free_servicing" varchar(255) COLLATE "default",
"name_transfer" int2,
"fuel" int4,
"road_tax" int4 DEFAULT 0,
"billed" int2 DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for sales_foc_request
-- ----------------------------
DROP TABLE IF EXISTS "public"."sales_foc_request";
CREATE TABLE "public"."sales_foc_request" (
"id" int4 DEFAULT nextval('sales_foc_request_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"foc_request_part" varchar(255) COLLATE "default",
"foc_approved_part" varchar(255) COLLATE "default",
"request_date" date,
"request_date_nep" varchar(255) COLLATE "default",
"approved_date" date,
"approved_date_nep" varchar(255) COLLATE "default",
"foc_id" int4,
"approval_type" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for sales_partial_payment
-- ----------------------------
DROP TABLE IF EXISTS "public"."sales_partial_payment";
CREATE TABLE "public"."sales_partial_payment" (
"id" int4 DEFAULT nextval('sales_partial_payment_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_process_id" int4,
"receipt_no" varchar(255) COLLATE "default",
"amount" int4,
"receipt_image" varchar(255) COLLATE "default",
"payment_date" date NOT NULL,
"payment_date_nep" varchar(255) COLLATE "default",
"customer_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for sales_pdi
-- ----------------------------
DROP TABLE IF EXISTS "public"."sales_pdi";
CREATE TABLE "public"."sales_pdi" (
"id" int4 DEFAULT nextval('sales_pdi_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"vehicle_status" int4 DEFAULT 0,
"remarks" varchar(255) COLLATE "default",
"complete_date" date,
"complete_date_np" varchar(255) COLLATE "default",
"damage_date" date,
"damage_date_np" varchar(255) COLLATE "default",
"damage_description" varchar(255) COLLATE "default",
"repair_date" date,
"repair_date_np" varchar(255) COLLATE "default",
"dispatch_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for sales_target_records
-- ----------------------------
DROP TABLE IF EXISTS "public"."sales_target_records";
CREATE TABLE "public"."sales_target_records" (
"id" int4 DEFAULT nextval('sales_target_records_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4 NOT NULL,
"vehicle_classification" int4 DEFAULT 0,
"dealer_id" int4 NOT NULL,
"target_year" varchar(255) COLLATE "default" NOT NULL,
"month" int4,
"quantity" int4,
"revision" int4 DEFAULT 0 NOT NULL,
"inquiry_target" int4,
"retail_quantity" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for sales_vehicle_process
-- ----------------------------
DROP TABLE IF EXISTS "public"."sales_vehicle_process";
CREATE TABLE "public"."sales_vehicle_process" (
"id" int4 DEFAULT nextval('sales_vehicle_process_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"booked_date" date,
"booking_receipt_no" varchar(255) COLLATE "default",
"booking_receipt_image" varchar(255) COLLATE "default",
"quotation_issue_date" date,
"quotation_image" varchar(255) COLLATE "default",
"vehicle_details_image" varchar(255) COLLATE "default",
"do_received_date" date,
"do_image" varchar(255) COLLATE "default",
"downpayment_date" date,
"downpayment_receipt_no" varchar(255) COLLATE "default",
"downpayment_receipt_image" varchar(255) COLLATE "default",
"fullpayment_date" date,
"fullpayment_receipt_no" varchar(255) COLLATE "default",
"fullpayment_receipt_image" varchar(255) COLLATE "default",
"vehicle_delivery_date" date,
"deliverysheet_image" varchar(255) COLLATE "default",
"creditnote_image" varchar(255) COLLATE "default",
"bluebook_received_date" date,
"bluebook_image" varchar(255) COLLATE "default",
"insurance_no" varchar(255) COLLATE "default",
"insurance_date" date,
"vat_bill_no" int4,
"vat_bill_created_date" date,
"vat_bill_image" varchar(255) COLLATE "default",
"msil_dispatch_id" int4,
"booking_amount" numeric,
"downpayment_amount" numeric,
"fullpayment_amount" numeric,
"booking_canceled" int4,
"discount_amount" int4,
"insurance_image" varchar(255) COLLATE "default",
"insurance_received_date" date,
"vehicle_delivery_date_np" varchar COLLATE "default",
"booked_date_np" varchar(30) COLLATE "default",
"booked_date_np_month" varchar(30) COLLATE "default",
"booked_date_np_year" varchar(30) COLLATE "default",
"is_delivery_sheet_generate" int2,
"stock_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for sales_vehicle_return
-- ----------------------------
DROP TABLE IF EXISTS "public"."sales_vehicle_return";
CREATE TABLE "public"."sales_vehicle_return" (
"id" int4 DEFAULT nextval('sales_vehicle_return_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"dealer_id" int4,
"remarks" varchar(255) COLLATE "default",
"date" date NOT NULL,
"date_np" varchar(255) COLLATE "default",
"stock_id" int4,
"return_stockyard_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_billed_jobs
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_billed_jobs";
CREATE TABLE "public"."ser_billed_jobs" (
"id" int4 DEFAULT nextval('ser_billed_jobs_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"billing_id" int4,
"job_id" int4,
"price" float8,
"discount_amount" float8,
"discount_percentage" float8,
"final_amount" float8,
"status" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_billed_outsidework
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_billed_outsidework";
CREATE TABLE "public"."ser_billed_outsidework" (
"id" int4 DEFAULT nextval('ser_billed_outsidework_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"billing_id" int4,
"job_id" int4,
"price" float8,
"discount_amount" float8,
"discount_percentage" float8,
"final_amount" float8,
"status" varchar(255) COLLATE "default",
"margin_percentage" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_billed_parts
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_billed_parts";
CREATE TABLE "public"."ser_billed_parts" (
"id" int4 DEFAULT nextval('ser_billed_parts_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"billing_id" int4,
"part_id" int4,
"price" float8,
"quantity" int4,
"discount_percentage" float8,
"final_amount" float8,
"warranty" varchar(255) COLLATE "default",
"lube_quantity" numeric(32,4)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_billing_record
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_billing_record";
CREATE TABLE "public"."ser_billing_record" (
"id" int4 DEFAULT nextval('ser_billing_record_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"jobcard_group" int4 DEFAULT 0,
"bill_type" varchar COLLATE "default",
"payment_type" varchar COLLATE "default",
"issue_date" timestamp(0),
"cash_account" varchar(255) COLLATE "default",
"credit_account" int4,
"card_account" varchar(255) COLLATE "default",
"invoice_prefix" varchar(255) COLLATE "default",
"invoice_no" int4,
"total_parts" float4,
"total_jobs" float4,
"cash_discount_percent" float4,
"cash_discount_amt" float4,
"vat_percent" float4,
"vat_parts" float4,
"vat_job" float4,
"net_total" float4,
"dealer_id" int4,
"counter_sales_id" int4,
"fiscal_year_id" int4,
"dealer_price" float8,
"dealer_total_for_parts" float8,
"vro" float8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_counter_sales
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_counter_sales";
CREATE TABLE "public"."ser_counter_sales" (
"id" int4 DEFAULT nextval('ser_counter_sales_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"counter_sales_id" int4,
"vehicle_no" varchar COLLATE "default",
"chasis_no" varchar COLLATE "default",
"engine_no" varchar COLLATE "default",
"vehicle_id" int4,
"variant_id" int4,
"color_id" int4,
"party_id" int4,
"date_time" timestamp(0),
"billing_record_id" int4,
"dealer_id" int4,
"is_request_complete" int4,
"is_countersale_billed" int4,
"is_countersale_closed" int4,
"price_option" varchar(255) COLLATE "default",
"vor" float8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_counter_sales_request
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_counter_sales_request";
CREATE TABLE "public"."ser_counter_sales_request" (
"id" int4 DEFAULT nextval('ser_counter_sales_request_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"counter_sales_id" int4,
"dealer_id" int4,
"part_id" int4,
"part_name" varchar(255) COLLATE "default",
"part_code" varchar(255) COLLATE "default",
"quantity" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_estimate_details
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_estimate_details";
CREATE TABLE "public"."ser_estimate_details" (
"id" int4 DEFAULT nextval('ser_estimate_details_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"estimate_doc_no" int4,
"jobcard_group" int4,
"vehicle_register_no" varchar COLLATE "default",
"chassis_no" varchar COLLATE "default",
"engine_no" varchar COLLATE "default",
"model_no" int4,
"variant" int4,
"color" int4,
"ledger_id" int4,
"total_jobs" float4,
"total_parts" float4,
"cash_percent" float4,
"vat_percent" float4,
"net_total" float4,
"dealer_id" int4,
"issued_date" date
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_estimate_jobs
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_estimate_jobs";
CREATE TABLE "public"."ser_estimate_jobs" (
"id" int4 DEFAULT nextval('ser_estimate_jobs_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"estimate_id" int4,
"job_id" int4,
"price" float4,
"discount" float8,
"total_amount" float8,
"customer_voice" text COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_estimate_parts
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_estimate_parts";
CREATE TABLE "public"."ser_estimate_parts" (
"id" int4 DEFAULT nextval('ser_estimate_parts_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"estimate_id" int4,
"part_id" int4,
"price" float4,
"quantity" int4,
"discount_percentage" float8,
"final_amount" float8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_floor_supervisor_advice
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_floor_supervisor_advice";
CREATE TABLE "public"."ser_floor_supervisor_advice" (
"id" int4 DEFAULT nextval('ser_floor_supervisor_advice_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"jobcard_group" int4,
"part_name" varchar COLLATE "default",
"quantity" int4,
"received_quantity" int4 DEFAULT 0,
"received_status" int4 DEFAULT 0,
"return_quantity" int4 DEFAULT 0,
"dispatched_quantity" int4 DEFAULT 0,
"return_remarks" varchar COLLATE "default",
"part_code" varchar(255) COLLATE "default",
"issue_date" date,
"warranty" varchar COLLATE "default",
"material_scan_id" int4,
"returned_status" int2,
"total_dispatched" int4,
"lube_dispatched_qty" numeric(32,4)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_gatepass
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_gatepass";
CREATE TABLE "public"."ser_gatepass" (
"id" int4 DEFAULT nextval('ser_gatepass_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"jobcard_id" int4,
"date" date,
"counter_sales_id" int4,
"gatepass_no" int4,
"dealer_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_job_cards
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_job_cards";
CREATE TABLE "public"."ser_job_cards" (
"id" int4 DEFAULT nextval('ser_job_cards_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"job_id" int4 NOT NULL,
"jobcard_group" int4,
"description" text COLLATE "default",
"before_image" varchar(255) COLLATE "default",
"after_image" varchar(255) COLLATE "default",
"material_required" int4,
"floor_supervisor_id" int4,
"mechanics_id" int4,
"gear_box_no" int4,
"service_type" int4,
"kms" float4,
"fuel" int4,
"party_id" int4,
"key_no" int4,
"delivery_date" int4,
"complete" int4,
"cost" float4,
"paid" int4,
"accessories" varchar(255) COLLATE "default",
"discount_amount" float4,
"discount_percentage" float4,
"sell_dealer" varchar(255) COLLATE "default",
"final_amount" float4,
"status" varchar(255) COLLATE "default" DEFAULT 'PENDING'::character varying,
"cleaner_id" int4,
"bill_id" int4,
"closed_status" int4 DEFAULT 0,
"customer_voice" varchar(255) COLLATE "default",
"estimate_id" int4,
"vehicle_no" varchar COLLATE "default",
"chassis_no" varchar COLLATE "default",
"engine_no" varchar COLLATE "default",
"variant_id" int4,
"color_id" int4,
"vehicle_sold_on" date,
"issue_date" timestamp(6),
"issue_date_nepali" varchar COLLATE "default",
"service_count" int2,
"coupon" varchar(255) COLLATE "default",
"mechanic_list" int4,
"year" varchar COLLATE "default",
"remarks" varchar COLLATE "default",
"pdi_kms" float4,
"advisor_voice" varchar COLLATE "default",
"reciever_name" varchar COLLATE "default",
"dealer_id" int4,
"jobcard_serial" int4,
"service_adviser_id" int4,
"floor_supervisor_voice" varchar COLLATE "default",
"fiscal_year_id" int4,
"tire_make" date,
"battery_no" varchar(255) COLLATE "default",
"closed_date" date
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_jobcard_status
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_jobcard_status";
CREATE TABLE "public"."ser_jobcard_status" (
"id" int4 DEFAULT nextval('ser_jobcard_status_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"jobcard_group" int4 NOT NULL,
"status" int4,
"reason" varchar(256) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_material_scan
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_material_scan";
CREATE TABLE "public"."ser_material_scan" (
"id" int4 DEFAULT nextval('ser_material_scan_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"part_code" varchar COLLATE "default",
"warranty" varchar COLLATE "default",
"issue_date" date,
"jobcard_group" int4,
"dealer_id" int4,
"floorparts_advice_id" int4,
"quantity" int4,
"is_consumable" int4,
"material_issue_no" int4,
"countersales_id" int4,
"part_id" int4,
"consumable_price" numeric,
"lube_quantity" numeric(32,4)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_outside_work
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_outside_work";
CREATE TABLE "public"."ser_outside_work" (
"id" int4 DEFAULT nextval('ser_outside_work_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"jobcard_group" int4 NOT NULL,
"workshop_id" int4 NOT NULL,
"amount" float4,
"taxes" float4,
"discount" float4,
"remarks" varchar(255) COLLATE "default",
"splr_invoice_no" int4,
"send_date" date,
"arrived_date" date,
"mechanics_id" int4,
"splr_invoice_date" date,
"prefix" varchar(255) COLLATE "default",
"workshop_job_id" int4,
"gross_total" int4,
"round_off" int4,
"net_amount" int4,
"total_amount" int4,
"billing_amount" float4,
"billing_discount_percent" float4,
"billing_final_amount" float4,
"margin_percentage" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_outsidework_ledgers
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_outsidework_ledgers";
CREATE TABLE "public"."ser_outsidework_ledgers" (
"id" int4 DEFAULT nextval('ser_outsidework_ledgers_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default" NOT NULL,
"address1" varchar(255) COLLATE "default",
"email" varchar(255) COLLATE "default",
"phone_no" int4,
"city" varchar(255) COLLATE "default",
"area" varchar(255) COLLATE "default",
"district_id" int4,
"zone_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_parts
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_parts";
CREATE TABLE "public"."ser_parts" (
"id" int4 DEFAULT nextval('ser_parts_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"jobcard_group" int4,
"part_id" int4,
"price" int4,
"quantity" int4,
"used" int4,
"discount_percentage" int4,
"labour" int4,
"cash_discount" float4,
"bill_id" int4,
"status" varchar(255) COLLATE "default",
"request_status" int4,
"recived_status" int4,
"narration" varchar(255) COLLATE "default",
"issue_date" date,
"warranty" varchar(255) COLLATE "default",
"final_amount" float4,
"estimate_id" int4,
"counter_request" int4,
"accepted_quantity" int4 DEFAULT 0,
"quantity_to_bill" int4 DEFAULT 0,
"issue_quantity" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_purchase_based
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_purchase_based";
CREATE TABLE "public"."ser_purchase_based" (
"id" int2 DEFAULT nextval('ser_purchase_based_id_seq'::regclass) NOT NULL,
"part_no" int4,
"description" varchar(255) COLLATE "default",
"rol" int4,
"po_qty" int4,
"ord_qty" int4,
"sold_qty" int4,
"stck_qty" int4,
"tran_stk" varchar(32) COLLATE "default",
"sugg_qty" int4,
"price" int4,
"amount" int4,
"order_id" int4,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_purchase_challan
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_purchase_challan";
CREATE TABLE "public"."ser_purchase_challan" (
"id" int4 DEFAULT nextval('ser_purchase_order_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"challan_date" date,
"challan_no" int4,
"supplier_challan_no" int4,
"supplier_challan_date" date,
"supplier_id" int4,
"challan_status" varchar(255) COLLATE "default",
"order_no" int4,
"remarks" text COLLATE "default",
"total_item" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_purchase_challan_items
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_purchase_challan_items";
CREATE TABLE "public"."ser_purchase_challan_items" (
"id" int4 DEFAULT nextval('ser_purchase_order_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"challan_id" int4,
"part_id" int4,
"quantity" int4,
"order_pre" varchar(255) COLLATE "default",
"order_no" varchar COLLATE "default",
"bin_no" varchar COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_purchase_invoices
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_purchase_invoices";
CREATE TABLE "public"."ser_purchase_invoices" (
"id" int4 DEFAULT nextval('ser_purchase_invoices_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"splr_date" date,
"ledger" int4,
"tax_method" varchar(255) COLLATE "default",
"discount" varchar(256) COLLATE "default",
"remark" text COLLATE "default",
"currency" varchar(256) COLLATE "default",
"exchange_price" float8,
"excise_duty" float8,
"others" float8,
"vat" float8,
"pinv_no" int4,
"splr_inv_no" int4,
"date" date,
"total_item" varchar(255) COLLATE "default",
"challan_no" int4,
"ord_no" int4,
"get_mrp_asPrice" int2,
"gross_total" float4,
"net_amount" float4,
"vatamount" float4,
"type" varchar(255) COLLATE "default",
"dealer_id" int4,
"purchase_invoice_serial" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_purchase_method
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_purchase_method";
CREATE TABLE "public"."ser_purchase_method" (
"id" int4 DEFAULT nextval('ser_purchase_method_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"type" varchar(255) COLLATE "default",
"part_id" varchar(255) COLLATE "default",
"qty" int4,
"price" int4,
"disc" float8,
"amount" int4,
"bin" varchar(256) COLLATE "default",
"vat" float8,
"ord_no" int4,
"purchase_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_purchase_order
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_purchase_order";
CREATE TABLE "public"."ser_purchase_order" (
"id" int4 DEFAULT nextval('ser_purchase_order_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"order_date" date,
"order_no" int4,
"ledger" varchar(255) COLLATE "default",
"parts_group" varchar(255) COLLATE "default",
"order_type" varchar(255) COLLATE "default",
"dispatch_mode" varchar(256) COLLATE "default",
"multiples_of_moq" varchar(256) COLLATE "default",
"exclude_nonzero_rol" varchar(255) COLLATE "default",
"include_nonzero_rol" varchar(255) COLLATE "default",
"sale_dateto" date,
"sale_dateform" date,
"stock_required_day" int4,
"total_items" int4,
"suggestive_amount" int4,
"order_amount" int4,
"remark" text COLLATE "default",
"job_no" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_sale_return
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_sale_return";
CREATE TABLE "public"."ser_sale_return" (
"id" int4 DEFAULT nextval('ser_sale_return_id_seq'::regclass) NOT NULL,
"jobcard_group" int4,
"billing_id" int4,
"part_id" int4,
"price" float4,
"quantity" int4,
"final_amount" float4,
"remarks" varchar(255) COLLATE "default",
"part_name" varchar(255) COLLATE "default",
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"counter_sales_id" int4,
"type" varchar COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_service_policy_detail
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_service_policy_detail";
CREATE TABLE "public"."ser_service_policy_detail" (
"id" int4 DEFAULT nextval('ser_service_policy_detail_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"policy_id" int4 NOT NULL,
"min_distance" int4,
"max_distance" int4,
"duration" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_service_policy_vehicles
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_service_policy_vehicles";
CREATE TABLE "public"."ser_service_policy_vehicles" (
"id" int4 DEFAULT nextval('ser_service_policy_vehicles_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"policy_id" int4 NOT NULL,
"vehicle_id" int4,
"varient_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_warranty_claim
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_warranty_claim";
CREATE TABLE "public"."ser_warranty_claim" (
"id" int4 DEFAULT nextval('ser_warranty_claim_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"date" date,
"claim_number" int4,
"claim_on" varchar(255) COLLATE "default",
"job_no" int4,
"job_date" date,
"manufacturer_id" int4,
"remarks" varchar(255) COLLATE "default",
"dealer_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_warranty_claim_list
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_warranty_claim_list";
CREATE TABLE "public"."ser_warranty_claim_list" (
"id" int4 DEFAULT nextval('ser_warranty_claim_list_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"part_id" int4,
"quantity" varchar(255) COLLATE "default",
"remarks" varchar(32) COLLATE "default",
"warranty_claim_id" int4,
"selected" varchar(6) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_workshop_job
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_workshop_job";
CREATE TABLE "public"."ser_workshop_job" (
"id" int4 DEFAULT nextval('ser_workshop_job_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"description" text COLLATE "default",
"min_price" int4,
"parent_id" int4,
"free_service" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ser_workshop_users
-- ----------------------------
DROP TABLE IF EXISTS "public"."ser_workshop_users";
CREATE TABLE "public"."ser_workshop_users" (
"id" int4 DEFAULT nextval('ser_workshop_users_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"first_name" varchar COLLATE "default",
"middle_name" varchar COLLATE "default",
"last_name" varchar COLLATE "default",
"phone_no" varchar COLLATE "default",
"Address" varchar COLLATE "default",
"designation_id" int4,
"parent_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_daily_credits
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_daily_credits";
CREATE TABLE "public"."spareparts_daily_credits" (
"id" int4 DEFAULT nextval('spareparts_daily_credits_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"date_en" date,
"date_np" varchar(50) COLLATE "default",
"credit_amount" numeric(10,2)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_damage_stock
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_damage_stock";
CREATE TABLE "public"."spareparts_damage_stock" (
"id" int4 DEFAULT nextval('spareparts_damage_stock_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"sparepart_id" int4,
"quantity" int4,
"damage_date" date,
"damage_date_np" varchar(255) COLLATE "default",
"repair_date" date,
"repair_date_np" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_dealer_claim
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_dealer_claim";
CREATE TABLE "public"."spareparts_dealer_claim" (
"id" int4 DEFAULT nextval('spareparts_dealer_claim_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"sparepart_id" int4,
"requested_by" int4,
"requested_date" date,
"requested_date_np" varchar(255) COLLATE "default",
"defecit_quantity" int4,
"status" int2 DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_dealer_credit
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_dealer_credit";
CREATE TABLE "public"."spareparts_dealer_credit" (
"id" int4 DEFAULT nextval('spareparts_dealer_credit_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"order_no" int4,
"cr_dr" varchar COLLATE "default",
"amount" numeric,
"date" date,
"date_nepali" varchar COLLATE "default",
"receipt_no" int4,
"image_name" varchar COLLATE "default",
"particular" varchar(255) COLLATE "default",
"bill_no" int4,
"cash_card" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_dealer_opening_credit
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_dealer_opening_credit";
CREATE TABLE "public"."spareparts_dealer_opening_credit" (
"id" int4 DEFAULT nextval('spareparts_dealer_opening_credit_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"opening_credit" numeric,
"date" timestamp(6),
"credit_limit" numeric
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_dealer_sales
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_dealer_sales";
CREATE TABLE "public"."spareparts_dealer_sales" (
"id" int4 DEFAULT nextval('spareparts_dealer_sales_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"total_amount" float8,
"date" date NOT NULL,
"nep_date" varchar(255) COLLATE "default" NOT NULL,
"discount" float8,
"party_id" int4,
"bill_no" varchar(255) COLLATE "default",
"taxable_total" float8,
"vat_amount" float8,
"dealer_id" int4,
"bill" varchar(255) COLLATE "default",
"vat_bill_no" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_dealer_stock
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_dealer_stock";
CREATE TABLE "public"."spareparts_dealer_stock" (
"id" int4 DEFAULT nextval('spareparts_dealer_stock_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"sparepart_id" int4,
"dealer_id" int4,
"quantity" int4,
"price" int4,
"location" varchar(255) COLLATE "default",
"order_no" int4,
"lube_qty" numeric(32,4)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_dealer_stock_adjustment
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_dealer_stock_adjustment";
CREATE TABLE "public"."spareparts_dealer_stock_adjustment" (
"id" int4 DEFAULT nextval('spareparts_dealer_stock_adjustment_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"sparepart_id" int4,
"old_stock" int4,
"new_stock" int4,
"remarks" varchar(255) COLLATE "default",
"requested_by" int4,
"requested_date" date,
"requested_date_np" varchar(255) COLLATE "default",
"approved_by" int4,
"approved_date" date,
"approved_date_np" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_dealer_yearly_target
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_dealer_yearly_target";
CREATE TABLE "public"."spareparts_dealer_yearly_target" (
"id" int4 DEFAULT nextval('spareparts_dealer_yearly_target_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"year" varchar(255) COLLATE "default",
"target" float8,
"month" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_dealersales_list
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_dealersales_list";
CREATE TABLE "public"."spareparts_dealersales_list" (
"id" int4 DEFAULT nextval('spareparts_dealersales_list_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"sparepart_id" int4,
"quantity" int4,
"price" float8 NOT NULL,
"dealer_sales_id" int4,
"dispatch_date_nep" varchar(255) COLLATE "default",
"discount_percentage" float8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_dispatch_list
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_dispatch_list";
CREATE TABLE "public"."spareparts_dispatch_list" (
"id" int4 DEFAULT nextval('spareparts_dispatch_list_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"order_no" int4,
"part_code" varchar(255) COLLATE "default",
"dispatch_quantity" int4,
"sparepart_id" int4,
"is_billed" int4 DEFAULT 0,
"picklist_no" int4,
"order_id" int4,
"picklist_id" int4,
"ledger_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_dispatch_spareparts
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_dispatch_spareparts";
CREATE TABLE "public"."spareparts_dispatch_spareparts" (
"id" int4 DEFAULT nextval('spareparts_dispatch_spareparts_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"order_no" int4,
"dispatched_quantity" int4,
"dispatched_date" date,
"dispatched_date_nepali" varchar(255) COLLATE "default",
"proforma_invoice_id" int4,
"pick_count" int4,
"foc" int2 DEFAULT 0,
"stock_id" int2 NOT NULL,
"billed" int2 DEFAULT 0,
"foc_document_id" int4,
"order_id" int4,
"year_np" varchar(255) COLLATE "default",
"month_np" varchar(255) COLLATE "default",
"bill_no" int4,
"dispatch_mode" varchar(255) COLLATE "default",
"grn_received_date" date,
"grn_received_date_np" varchar(255) COLLATE "default",
"grn_no" int4,
"proforma_invoice_no" int4,
"remarks" varchar(255) COLLATE "default",
"dealer_id" int4,
"discount_percentage" float8,
"vor_percentage" float8,
"ledger_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_dispatch_spareparts_copy
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_dispatch_spareparts_copy";
CREATE TABLE "public"."spareparts_dispatch_spareparts_copy" (
"id" int4 DEFAULT nextval('spareparts_dispatch_spareparts_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"order_no" int4,
"dispatched_quantity" int4,
"dispatched_date" date,
"dispatched_date_nepali" date,
"proforma_invoice_id" int4,
"pick_count" int4,
"foc" int2 DEFAULT 0,
"stock_id" int2 NOT NULL,
"billed" int2 DEFAULT 0,
"foc_document_id" int4,
"order_id" int4,
"year_np" varchar(255) COLLATE "default",
"month_np" varchar(255) COLLATE "default",
"bill_no" int4,
"dispatch_mode" varchar(255) COLLATE "default",
"grn_received_date" date,
"grn_received_date_np" varchar(255) COLLATE "default",
"grn_no" int4,
"proforma_invoice_no" int4,
"remarks" varchar(255) COLLATE "default",
"dealer_id" int4,
"discount_percentage" float8,
"vor_percentage" float8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_document_count
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_document_count";
CREATE TABLE "public"."spareparts_document_count" (
"id" int4 NOT NULL,
"proforma_invoice" int4,
"billing_invoice" int4,
"updated_by" int2,
"updated_at" timestamp(6),
"msil_order_count" varchar(255) COLLATE "default" DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_gatepass
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_gatepass";
CREATE TABLE "public"."spareparts_gatepass" (
"id" int4 DEFAULT nextval('spareparts_gatepass_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"gatepass_no" int4,
"bill_no" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_goods_return
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_goods_return";
CREATE TABLE "public"."spareparts_goods_return" (
"id" int4 DEFAULT nextval('spareparts_goods_return_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"sparepart_id" int4,
"dealer_id" int4,
"quantity" int4,
"reason" varchar(255) COLLATE "default",
"requeted_by" int4,
"request_date" date NOT NULL,
"request_date_np" varchar(255) COLLATE "default",
"accepted_by" int4,
"accepted_date" date,
"accepted_date_np" varchar(255) COLLATE "default",
"is_damage" int2
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_landed_cost
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_landed_cost";
CREATE TABLE "public"."spareparts_landed_cost" (
"id" int4 DEFAULT nextval('spareparts_landed_cost_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"invoice_no" varchar(255) COLLATE "default",
"custom" float8,
"custom_other" float8,
"lc_comm" float8,
"unload" float8,
"freight" float8,
"insurance" float8,
"bank_charge" float8,
"insert_date" date NOT NULL,
"insert_date_nep" varchar(255) COLLATE "default",
"vat" float8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_local_purchase
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_local_purchase";
CREATE TABLE "public"."spareparts_local_purchase" (
"id" int4 DEFAULT nextval('spareparts_local_purchase_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"invoice_no" varchar(255) COLLATE "default",
"dealer_id" int4,
"party_name" varchar(255) COLLATE "default",
"purchased_date" date,
"purchased_date_np" varchar(50) COLLATE "default",
"total_amount" float8,
"challan_no" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_local_purchase_list
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_local_purchase_list";
CREATE TABLE "public"."spareparts_local_purchase_list" (
"id" int4 DEFAULT nextval('spareparts_local_purchase_list_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"local_purchase_id" int4,
"sparepart_id" int4,
"quantity" int4,
"price" float8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_msil_order
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_msil_order";
CREATE TABLE "public"."spareparts_msil_order" (
"id" int4 DEFAULT nextval('spareparts_msil_order_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"part_code" varchar(255) COLLATE "default",
"part_name" varchar(255) COLLATE "default",
"quantity" int4,
"mst_part_id" int4,
"reached_date_nepali" varchar(255) COLLATE "default",
"in_stock" int4 DEFAULT 0,
"order_no" varchar COLLATE "default",
"msil_part_price" numeric(10,2),
"box_no" varchar(255) COLLATE "default",
"unit_rate" int4,
"amount" int4,
"invoice_no" varchar COLLATE "default",
"msil_invoice_date" date,
"msil_dispatch_date" date,
"reached_date" date,
"dispatched_quantity" int4 DEFAULT 0,
"year_np" varchar(255) COLLATE "default",
"month_np" varchar(255) COLLATE "default",
"msil_invoice_date_np" varchar(255) COLLATE "default",
"binning_status" int2,
"dealer_name" varchar(255) COLLATE "default",
"binning_date_np" date,
"binning_date_en" date
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_opening_stock
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_opening_stock";
CREATE TABLE "public"."spareparts_opening_stock" (
"id" int4 DEFAULT nextval('spareparts_closing_stock_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"sparepart_id" int4,
"opening_stock_date" date,
"year_np" varchar(255) COLLATE "default",
"month_np" varchar(255) COLLATE "default",
"quantity" int4,
"dealer_id" int4,
"opening_stock_date_np" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_order_generate
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_order_generate";
CREATE TABLE "public"."spareparts_order_generate" (
"id" int4 DEFAULT nextval('spareparts_order_generate_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"sparepart_id" int4,
"order_no" varchar(255) COLLATE "default" NOT NULL,
"quantity" int4,
"date" date NOT NULL,
"nep_date" varchar(255) COLLATE "default" NOT NULL,
"order_type" varchar(255) COLLATE "default",
"final_order_no" varchar(255) COLLATE "default",
"pi_number" varchar(255) COLLATE "default",
"pi_received_date" date,
"pi_received_date_np" varchar(255) COLLATE "default",
"pi_received_date_np_year" varchar(255) COLLATE "default",
"pi_received_date_np_month" varchar(255) COLLATE "default",
"pi_confirmed_date" date,
"pi_confirmed_date_np" varchar(255) COLLATE "default",
"pi_confirmed_date_np_year" varchar(255) COLLATE "default",
"pi_confirmed_date_np_month" varchar(255) COLLATE "default",
"nep_date_year" varchar(255) COLLATE "default",
"nep_date_month" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_order_unavailable
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_order_unavailable";
CREATE TABLE "public"."spareparts_order_unavailable" (
"id" int4 DEFAULT nextval('spareparts_order_unavailable_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"order_no" int4 DEFAULT 0,
"unavailable_parts" text COLLATE "default",
"dealer_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_pi_import
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_pi_import";
CREATE TABLE "public"."spareparts_pi_import" (
"id" int4 DEFAULT nextval('spareparts_pi_import_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"order_no" varchar(255) COLLATE "default",
"part_code" varchar(255) COLLATE "default",
"quantity" int4,
"price" int4,
"sparepart_id" int4,
"pi_number" varchar(255) COLLATE "default",
"reached_date" date,
"reached_date_np" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_picklist
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_picklist";
CREATE TABLE "public"."spareparts_picklist" (
"id" int4 DEFAULT nextval('spareparts_picklist_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"order_no" int4,
"sparepart_id" int4,
"dispatch_quantity" int4,
"dispatched_date_nep" varchar(255) COLLATE "default",
"dispatched_date" date,
"order_id" int4,
"picker_name" varchar(255) COLLATE "default",
"generate_date" date,
"order_type" varchar(255) COLLATE "default",
"pick_count" int4,
"is_billed" int4 DEFAULT 0,
"picker_id" int4,
"picklist_format" varchar(100) COLLATE "default",
"picklist_no" int4,
"picked_quantity" int4,
"ordered_spareparts" int4,
"picklist_group" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_picklist_copy
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_picklist_copy";
CREATE TABLE "public"."spareparts_picklist_copy" (
"id" int4 DEFAULT nextval('spareparts_picklist_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"order_no" int4,
"sparepart_id" int4,
"dispatch_quantity" int4,
"dispatched_date_nep" date,
"dispatched_date" date,
"order_id" int4,
"picker_name" varchar(255) COLLATE "default",
"generate_date" date,
"order_type" varchar(255) COLLATE "default",
"pick_count" int4,
"is_billed" int4 DEFAULT 0,
"picker_id" int4,
"picklist_format" varchar(100) COLLATE "default",
"picklist_no" int4,
"picked_quantity" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_sparepart_order
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_sparepart_order";
CREATE TABLE "public"."spareparts_sparepart_order" (
"id" int4 DEFAULT nextval('spareparts_sparepart_order_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"sparepart_id" int4,
"dealer_id" int4,
"proforma_invoice_id" int4 DEFAULT 0,
"order_quantity" int4,
"pi_generated" int4 DEFAULT 0,
"pi_confirmed" int4 DEFAULT 0,
"order_no" int4,
"order_cancel" int4 DEFAULT 0,
"picklist" int4 DEFAULT 0,
"confirmed_type" varchar(255) COLLATE "default",
"dealer_confirmed" int4 DEFAULT 0,
"pi_generated_date_time" date,
"request_date" date,
"request_date_np" varchar(255) COLLATE "default",
"request_date_np_year" varchar(255) COLLATE "default",
"request_date_np_month" varchar(255) COLLATE "default",
"order_type" varchar(255) COLLATE "default",
"dispatch_mode" varchar(255) COLLATE "default",
"order_date" date,
"order_date_np" varchar(255) COLLATE "default",
"pi_number" varchar(255) COLLATE "default",
"remarks" text COLLATE "default" DEFAULT ''::text,
"received_quantity" int4 DEFAULT 0,
"pi_cost" numeric(10,2),
"cancle_quantity" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_sparepart_stock
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_sparepart_stock";
CREATE TABLE "public"."spareparts_sparepart_stock" (
"id" int4 DEFAULT nextval('spareparts_sparepart_stock_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"sparepart_id" int4,
"location" varchar(255) COLLATE "default",
"quantity" int4 DEFAULT 0,
"stockyard_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_stock_adjustment
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_stock_adjustment";
CREATE TABLE "public"."spareparts_stock_adjustment" (
"id" int4 DEFAULT nextval('spareparts_stock_adjustment_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"sparepart_id" int4,
"old_stock" int4,
"new_stock" int4,
"remarks" varchar(255) COLLATE "default",
"approved_by" int4,
"approved_date" date,
"approved_date_np" varchar(255) COLLATE "default",
"requested_by" int4,
"requested_date" date,
"requested_date_np" varchar(255) COLLATE "default",
"status" varchar(255) COLLATE "default" DEFAULT 'PENDING'::character varying
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_stock_transfer
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_stock_transfer";
CREATE TABLE "public"."spareparts_stock_transfer" (
"id" int4 DEFAULT nextval('spareparts_stock_transfer_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"dealer_id" int4,
"sparepart_id" int4,
"request_quantity" int4,
"request_date" date,
"request_date_nepali" varchar(255) COLLATE "default",
"is_accepted" int2
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_stock_transfer_lists
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_stock_transfer_lists";
CREATE TABLE "public"."spareparts_stock_transfer_lists" (
"id" int4 DEFAULT nextval('spareparts_stock_transfer_lists_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"transfer_id" int4,
"sparepart_id" int4,
"quantity" int4,
"accepted_quantity" int4,
"return_request_qty" int4,
"return_qty" int4,
"return_date_en" date,
"return_date_np" varchar(265) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_stock_transfer_log
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_stock_transfer_log";
CREATE TABLE "public"."spareparts_stock_transfer_log" (
"id" int4 DEFAULT nextval('spareparts_stock_transfer_log_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"stock_transfer_id" int4,
"dealer_from" int4,
"dealer_to" int4,
"sparepart_id" int4,
"transfer_quantity" int4,
"transfer_date" date,
"current_stock" int4,
"transfer_date_nep" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_stock_transfers
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_stock_transfers";
CREATE TABLE "public"."spareparts_stock_transfers" (
"id" int4 DEFAULT nextval('spareparts_stock_transfers_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"stock_from" int4,
"stock_to" int4,
"dispatch_date_en" date,
"dispatch_date_np" varchar(265) COLLATE "default",
"accepted_date_en" date,
"accepted_date_np" varchar(265) COLLATE "default",
"status" varchar(265) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_stockyard_countersale_parts
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_stockyard_countersale_parts";
CREATE TABLE "public"."spareparts_stockyard_countersale_parts" (
"id" int4 DEFAULT nextval('spareparts_stockyard_countersale_parts_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"sparepart_id" int4,
"quantity" int4,
"total" numeric(10,2),
"dealer_price" numeric(10,2),
"dealer_price_total" numeric(10,2),
"countersale_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_stockyard_countersales
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_stockyard_countersales";
CREATE TABLE "public"."spareparts_stockyard_countersales" (
"id" int4 DEFAULT nextval('spareparts_stockyard_countersales_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"issue_date" date,
"credit_account" numeric(10,2),
"price_option" varchar(255) COLLATE "default",
"vor" numeric(10,2),
"countersale_no" int4,
"counter_sales_id" int4,
"total_for_parts" numeric(10,2),
"dealer_total_for_parts" numeric(10,2),
"cash_discount_percent" numeric(10,2),
"cash_discount_amt" numeric(10,2),
"vat" numeric(10,2),
"vat_parts" numeric(10,2),
"net_total" numeric(10,2),
"stockyard_id" int4,
"is_billed" int4,
"invoice_no" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for spareparts_stockyards
-- ----------------------------
DROP TABLE IF EXISTS "public"."spareparts_stockyards";
CREATE TABLE "public"."spareparts_stockyards" (
"id" int4 DEFAULT nextval('spareparts_stockyards_id_seq'::regclass) NOT NULL,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"name" varchar(255) COLLATE "default",
"latitude" varchar(255) COLLATE "default",
"longitude" varchar(255) COLLATE "default",
"rank" int4,
"type" int4,
"incharge_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for table_unknown_parts
-- ----------------------------
DROP TABLE IF EXISTS "public"."table_unknown_parts";
CREATE TABLE "public"."table_unknown_parts" (
"part_code" varchar(255) COLLATE "default",
"dealer_name" varchar(255) COLLATE "default",
"quantity" int4,
"created_at" timestamp(6),
"id" int4 DEFAULT nextval('table_unknown_parts_id_seq'::regclass) NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for tbl_customer_registration
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_customer_registration";
CREATE TABLE "public"."tbl_customer_registration" (
"id" int4 DEFAULT nextval('tbl_customer_registration_id_seq'::regclass) NOT NULL,
"customer_name" varchar(255) COLLATE "default",
"address" varchar(255) COLLATE "default",
"email" varchar(255) COLLATE "default",
"mobile" varchar(255) COLLATE "default",
"chasis_no" varchar(255) COLLATE "default",
"engine_no" varchar(255) COLLATE "default",
"register_no" varchar(255) COLLATE "default" DEFAULT nextval('tbl_customer_registration_id_seq'::regclass),
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"customer_id" int4,
"user_code" int8,
"token" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for tbl_dublicate_number_log
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_dublicate_number_log";
CREATE TABLE "public"."tbl_dublicate_number_log" (
"id" int4 DEFAULT nextval('tbl_dublicate_number_log_id_seq'::regclass) NOT NULL,
"customer_name" varchar(255) COLLATE "default",
"dealer_id" int4,
"dublication_status" int4,
"created_by" int4,
"updated_by" int4,
"deleted_by" int4,
"created_at" timestamp(6),
"updated_at" timestamp(6),
"deleted_at" timestamp(6),
"vehicle_id" int4,
"variant_id" int4,
"color_id" int4,
"mobile" varchar(255) COLLATE "default",
"previous_dealer" int4,
"inquiry_no" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for tbl_inquiry_uploaded_document
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_inquiry_uploaded_document";
CREATE TABLE "public"."tbl_inquiry_uploaded_document" (
"id" int4 DEFAULT nextval('tbl_inquiry_uploaded_document_id_seq'::regclass) NOT NULL,
"customer_id" int4,
"uploadeddocument" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for tbl_inquiry_uploaded_document_copy
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_inquiry_uploaded_document_copy";
CREATE TABLE "public"."tbl_inquiry_uploaded_document_copy" (
"id" int4 DEFAULT nextval('tbl_inquiry_uploaded_document_id_seq'::regclass) NOT NULL,
"customer_id" int4,
"uploadeddocument" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for temp_verhicle_service_history
-- ----------------------------
DROP TABLE IF EXISTS "public"."temp_verhicle_service_history";
CREATE TABLE "public"."temp_verhicle_service_history" (
"id" int4 DEFAULT nextval('temp_vehicle_service_history_id_seq'::regclass) NOT NULL,
"title" varchar(255) COLLATE "default",
"customer_name" varchar(255) COLLATE "default",
"address_1" varchar(255) COLLATE "default",
"address_2" varchar(255) COLLATE "default",
"address_3" varchar(255) COLLATE "default",
"address_4" varchar(255) COLLATE "default",
"city" varchar(255) COLLATE "default",
"district" varchar(255) COLLATE "default",
"state" varchar(255) COLLATE "default",
"mobile" varchar(255) COLLATE "default",
"phone" varchar(255) COLLATE "default",
"email" varchar(255) COLLATE "default",
"date_of_birth" date,
"date_of_anniversary" date,
"vehicle_id" varchar(255) COLLATE "default",
"color_id" varchar(255) COLLATE "default",
"vehicle_no" varchar COLLATE "default",
"chassis_no" varchar COLLATE "default",
"engine_no" varchar COLLATE "default",
"gear_box_no" varchar(32) COLLATE "default",
"coupon_no" varchar(255) COLLATE "default",
"selling_dealer" varchar(255) COLLATE "default",
"sales_date" varchar(255) COLLATE "default",
"variant_id" int4,
"model" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;


-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------
ALTER SEQUENCE "public"."aauth_groups_id_seq" OWNED BY "aauth_groups"."id";
ALTER SEQUENCE "public"."aauth_login_attempts_id_seq" OWNED BY "aauth_login_attempts"."id";
ALTER SEQUENCE "public"."aauth_permissions_id_seq" OWNED BY "aauth_permissions"."id";
ALTER SEQUENCE "public"."aauth_pms_id_seq" OWNED BY "aauth_pms"."id";
ALTER SEQUENCE "public"."aauth_user_variables_id_seq" OWNED BY "aauth_user_variables"."id";
ALTER SEQUENCE "public"."aauth_users_id_seq" OWNED BY "aauth_users"."id";
ALTER SEQUENCE "public"."ccd_lostcase_reason_id_seq" OWNED BY "ccd_lostcase_reason"."id";
ALTER SEQUENCE "public"."ccd_lostcase_vehicles_id_seq" OWNED BY "ccd_lostcase_vehicles"."id";
ALTER SEQUENCE "public"."crm_vehicle_edit_id_seq" OWNED BY "crm_vehicle_edit"."id";
ALTER SEQUENCE "public"."d2d_billing_detail_id_seq" OWNED BY "d2d_billing_detail"."id";
ALTER SEQUENCE "public"."d2d_billing_list_id_seq" OWNED BY "d2d_billing_list"."id";
ALTER SEQUENCE "public"."dms_customer_followups_id_seq" OWNED BY "dms_customer_followups"."id";
ALTER SEQUENCE "public"."dms_customer_statuses_id_seq" OWNED BY "dms_customer_statuses"."id";
ALTER SEQUENCE "public"."dms_customer_test_drives_id_seq" OWNED BY "dms_customer_test_drives"."id";
ALTER SEQUENCE "public"."dms_customers_id_seq" OWNED BY "dms_customers"."id";
ALTER SEQUENCE "public"."dms_dealers_id_seq" OWNED BY "dms_dealers"."id";
ALTER SEQUENCE "public"."dms_employee_contacts_id_seq" OWNED BY "dms_employee_contacts"."id";
ALTER SEQUENCE "public"."dms_employees_id_seq" OWNED BY "dms_employees"."id";
ALTER SEQUENCE "public"."dms_events_id_seq" OWNED BY "dms_events"."id";
ALTER SEQUENCE "public"."dms_msil_scanned_order_id_seq" OWNED BY "dms_msil_scanned_order"."id";
ALTER SEQUENCE "public"."dms_quotations_id_seq" OWNED BY "dms_quotations"."id";
ALTER SEQUENCE "public"."dms_vehicles_id_seq" OWNED BY "dms_vehicles"."id";
ALTER SEQUENCE "public"."log_damage_id_seq" OWNED BY "log_damage"."id";
ALTER SEQUENCE "public"."log_dealer_incharge_id_seq" OWNED BY "log_dealer_incharge"."id";
ALTER SEQUENCE "public"."log_dealer_order_id_seq" OWNED BY "log_dealer_order"."id";
ALTER SEQUENCE "public"."log_dispatch_dealer_id_seq" OWNED BY "log_dispatch_dealer"."id";
ALTER SEQUENCE "public"."log_fuel_kms_id_seq" OWNED BY "log_fuel_kms"."id";
ALTER SEQUENCE "public"."log_repair_id_seq" OWNED BY "log_repair"."id";
ALTER SEQUENCE "public"."log_stock_damage_records_id_seq" OWNED BY "log_stock_damage_records"."id";
ALTER SEQUENCE "public"."log_stock_records_id_seq" OWNED BY "log_stock_records"."id";
ALTER SEQUENCE "public"."msil_dispatch_records_id_seq" OWNED BY "msil_dispatch_records"."id";
ALTER SEQUENCE "public"."msil_monthly_plannings_id_seq" OWNED BY "msil_monthly_plannings"."id";
ALTER SEQUENCE "public"."msil_order_mismatch_id_seq" OWNED BY "msil_order_mismatch"."id";
ALTER SEQUENCE "public"."mst_accessories_id_seq" OWNED BY "mst_accessories"."id";
ALTER SEQUENCE "public"."mst_banks_id_seq" OWNED BY "mst_banks"."id";
ALTER SEQUENCE "public"."mst_city_places_id_seq" OWNED BY "mst_city_places"."id";
ALTER SEQUENCE "public"."mst_colors_id_seq" OWNED BY "mst_colors"."id";
ALTER SEQUENCE "public"."mst_customer_types_id_seq" OWNED BY "mst_customer_types"."id";
ALTER SEQUENCE "public"."mst_designations_id_seq" OWNED BY "mst_designations"."id";
ALTER SEQUENCE "public"."mst_district_mvs_id_seq" OWNED BY "mst_district_mvs"."id";
ALTER SEQUENCE "public"."mst_educations_id_seq" OWNED BY "mst_educations"."id";
ALTER SEQUENCE "public"."mst_firms_id_seq" OWNED BY "mst_firms"."id";
ALTER SEQUENCE "public"."mst_fiscal_years_id_seq" OWNED BY "mst_fiscal_years"."id";
ALTER SEQUENCE "public"."mst_foc_accessories_id_seq" OWNED BY "mst_foc_accessories"."id";
ALTER SEQUENCE "public"."mst_inquiry_statuses_id_seq" OWNED BY "mst_inquiry_statuses"."id";
ALTER SEQUENCE "public"."mst_institutions_id_seq" OWNED BY "mst_institutions"."id";
ALTER SEQUENCE "public"."mst_occupations_id_seq" OWNED BY "mst_occupations"."id";
ALTER SEQUENCE "public"."mst_payment_modes_id_seq" OWNED BY "mst_payment_modes"."id";
ALTER SEQUENCE "public"."mst_reasons_id_seq" OWNED BY "mst_reasons"."id";
ALTER SEQUENCE "public"."mst_relations_id_seq" OWNED BY "mst_relations"."id";
ALTER SEQUENCE "public"."mst_scan_device_id_seq" OWNED BY "mst_scan_device"."id";
ALTER SEQUENCE "public"."mst_scan_person_id_seq" OWNED BY "mst_scan_person"."id";
ALTER SEQUENCE "public"."mst_service_policy_id_seq" OWNED BY "mst_service_policy"."id";
ALTER SEQUENCE "public"."mst_service_types_id_seq" OWNED BY "mst_service_types"."id";
ALTER SEQUENCE "public"."mst_sources_id_seq" OWNED BY "mst_sources"."id";
ALTER SEQUENCE "public"."mst_spareparts_dealer_id_seq" OWNED BY "mst_spareparts_dealer"."id";
ALTER SEQUENCE "public"."mst_stock_yards_id_seq" OWNED BY "mst_stock_yards"."id";
ALTER SEQUENCE "public"."mst_titles_id_seq" OWNED BY "mst_titles"."id";
ALTER SEQUENCE "public"."mst_variants_id_seq" OWNED BY "mst_variants"."id";
ALTER SEQUENCE "public"."mst_vehicles_id_seq" OWNED BY "mst_vehicles"."id";
ALTER SEQUENCE "public"."mst_walkin_sources_id_seq" OWNED BY "mst_walkin_sources"."id";
ALTER SEQUENCE "public"."project_activity_logs_id_seq" OWNED BY "project_activity_logs"."id";
ALTER SEQUENCE "public"."project_audit_logs_id_seq" OWNED BY "project_audit_logs"."id";
ALTER SEQUENCE "public"."project_settings_id_seq" OWNED BY "project_settings"."id";
ALTER SEQUENCE "public"."sales_booking_cancel_id_seq" OWNED BY "sales_booking_cancel"."id";
ALTER SEQUENCE "public"."sales_discount_limit_id_seq" OWNED BY "sales_discount_limit"."id";
ALTER SEQUENCE "public"."sales_vehicle_process_id_seq" OWNED BY "sales_vehicle_process"."id";
ALTER SEQUENCE "public"."ser_outsidework_ledgers_id_seq" OWNED BY "ser_outsidework_ledgers"."id";
ALTER SEQUENCE "public"."ser_service_policy_detail_id_seq" OWNED BY "ser_service_policy_detail"."id";
ALTER SEQUENCE "public"."ser_service_policy_vehicles_id_seq" OWNED BY "ser_service_policy_vehicles"."id";
ALTER SEQUENCE "public"."ser_workshop_job_id_seq" OWNED BY "ser_workshop_job"."id";
ALTER SEQUENCE "public"."spareparts_daily_credits_id_seq" OWNED BY "spareparts_daily_credits"."id";
ALTER SEQUENCE "public"."spareparts_stock_transfer_lists_id_seq" OWNED BY "spareparts_stock_transfer_lists"."id";
ALTER SEQUENCE "public"."spareparts_stock_transfers_id_seq" OWNED BY "spareparts_stock_transfers"."id";
ALTER SEQUENCE "public"."spareparts_stockyard_countersale_parts_id_seq" OWNED BY "spareparts_stockyard_countersale_parts"."id";
ALTER SEQUENCE "public"."spareparts_stockyard_countersales_id_seq" OWNED BY "spareparts_stockyard_countersales"."id";
ALTER SEQUENCE "public"."spareparts_stockyards_id_seq" OWNED BY "spareparts_stockyards"."id";
ALTER SEQUENCE "public"."table_unknown_parts_id_seq" OWNED BY "table_unknown_parts"."part_code";
ALTER SEQUENCE "public"."tbl_inquiry_uploaded_document_id_seq" OWNED BY "tbl_inquiry_uploaded_document"."id";

-- ----------------------------
-- Primary Key structure for table aauth_assitant_dealers
-- ----------------------------
ALTER TABLE "public"."aauth_assitant_dealers" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table aauth_group_permissions
-- ----------------------------
ALTER TABLE "public"."aauth_group_permissions" ADD PRIMARY KEY ("perm_id", "group_id");

-- ----------------------------
-- Primary Key structure for table aauth_groups
-- ----------------------------
ALTER TABLE "public"."aauth_groups" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table aauth_login_attempts
-- ----------------------------
CREATE INDEX "aauth_login_attempts_id" ON "public"."aauth_login_attempts" USING btree ("id");

-- ----------------------------
-- Primary Key structure for table aauth_login_attempts
-- ----------------------------
ALTER TABLE "public"."aauth_login_attempts" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table aauth_permissions
-- ----------------------------
ALTER TABLE "public"."aauth_permissions" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table aauth_pms
-- ----------------------------
CREATE INDEX "aauth_pms_id_sender_id_receiver_id_date_read" ON "public"."aauth_pms" USING btree ("id", "sender_id", "receiver_id", "date_read");

-- ----------------------------
-- Primary Key structure for table aauth_pms
-- ----------------------------
ALTER TABLE "public"."aauth_pms" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table aauth_sub_groups
-- ----------------------------
ALTER TABLE "public"."aauth_sub_groups" ADD PRIMARY KEY ("group_id", "subgroup_id");

-- ----------------------------
-- Primary Key structure for table aauth_user_groups
-- ----------------------------
ALTER TABLE "public"."aauth_user_groups" ADD PRIMARY KEY ("user_id", "group_id");

-- ----------------------------
-- Primary Key structure for table aauth_user_permissions
-- ----------------------------
ALTER TABLE "public"."aauth_user_permissions" ADD PRIMARY KEY ("perm_id", "user_id");

-- ----------------------------
-- Indexes structure for table aauth_user_variables
-- ----------------------------
CREATE INDEX "aauth_user_variables_user_id" ON "public"."aauth_user_variables" USING btree ("user_id");

-- ----------------------------
-- Primary Key structure for table aauth_user_variables
-- ----------------------------
ALTER TABLE "public"."aauth_user_variables" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table aauth_users
-- ----------------------------
ALTER TABLE "public"."aauth_users" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ccd_2nd_smr_days
-- ----------------------------
ALTER TABLE "public"."ccd_2nd_smr_days" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ccd_general_smr
-- ----------------------------
ALTER TABLE "public"."ccd_general_smr" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ccd_inquiry
-- ----------------------------
ALTER TABLE "public"."ccd_inquiry" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ccd_lostcase
-- ----------------------------
ALTER TABLE "public"."ccd_lostcase" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ccd_lostcase_reason
-- ----------------------------
ALTER TABLE "public"."ccd_lostcase_reason" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ccd_lostcase_vehicles
-- ----------------------------
ALTER TABLE "public"."ccd_lostcase_vehicles" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ccd_post_service_followup
-- ----------------------------
ALTER TABLE "public"."ccd_post_service_followup" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ccd_sixtyday
-- ----------------------------
ALTER TABLE "public"."ccd_sixtyday" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ccd_smr_twentyone_days
-- ----------------------------
ALTER TABLE "public"."ccd_smr_twentyone_days" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ccd_thirtyday
-- ----------------------------
ALTER TABLE "public"."ccd_thirtyday" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ccd_threeday
-- ----------------------------
ALTER TABLE "public"."ccd_threeday" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table crm_vehicle_edit
-- ----------------------------
ALTER TABLE "public"."crm_vehicle_edit" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table d2d_billing_detail
-- ----------------------------
ALTER TABLE "public"."d2d_billing_detail" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table d2d_billing_list
-- ----------------------------
ALTER TABLE "public"."d2d_billing_list" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table dms_customer_followups
-- ----------------------------
ALTER TABLE "public"."dms_customer_followups" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table dms_customer_statuses
-- ----------------------------
CREATE INDEX "view" ON "public"."dms_customer_statuses" USING btree ("customer_id", "status_id", "sub_status_id");

-- ----------------------------
-- Primary Key structure for table dms_customer_statuses
-- ----------------------------
ALTER TABLE "public"."dms_customer_statuses" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table dms_customer_test_drives
-- ----------------------------
ALTER TABLE "public"."dms_customer_test_drives" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table dms_customers
-- ----------------------------
ALTER TABLE "public"."dms_customers" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table dms_dealers
-- ----------------------------
ALTER TABLE "public"."dms_dealers" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table dms_discount_old_schemes
-- ----------------------------
ALTER TABLE "public"."dms_discount_old_schemes" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table dms_easyappointment_bookings
-- ----------------------------
ALTER TABLE "public"."dms_easyappointment_bookings" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table dms_employee_contacts
-- ----------------------------
ALTER TABLE "public"."dms_employee_contacts" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table dms_employees
-- ----------------------------
ALTER TABLE "public"."dms_employees" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table dms_events
-- ----------------------------
ALTER TABLE "public"."dms_events" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table dms_msil_scanned_order
-- ----------------------------
ALTER TABLE "public"."dms_msil_scanned_order" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table dms_quotations
-- ----------------------------
ALTER TABLE "public"."dms_quotations" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table dms_sms_history
-- ----------------------------
ALTER TABLE "public"."dms_sms_history" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table dms_vehicles
-- ----------------------------
CREATE INDEX "vehicle_index" ON "public"."dms_vehicles" USING btree ("vehicle_id", "variant_id", "color_id", "price");

-- ----------------------------
-- Primary Key structure for table dms_vehicles
-- ----------------------------
ALTER TABLE "public"."dms_vehicles" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table driver_details
-- ----------------------------
ALTER TABLE "public"."driver_details" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table inquiry_name_edit
-- ----------------------------
ALTER TABLE "public"."inquiry_name_edit" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table log_damage
-- ----------------------------
ALTER TABLE "public"."log_damage" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table log_dealer_incharge
-- ----------------------------
ALTER TABLE "public"."log_dealer_incharge" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table log_dealer_order
-- ----------------------------
ALTER TABLE "public"."log_dealer_order" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table log_dispatch_dealer
-- ----------------------------
ALTER TABLE "public"."log_dispatch_dealer" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table log_fuel_kms
-- ----------------------------
ALTER TABLE "public"."log_fuel_kms" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table log_repair
-- ----------------------------
ALTER TABLE "public"."log_repair" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table log_stock_damage_records
-- ----------------------------
ALTER TABLE "public"."log_stock_damage_records" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table log_stock_records
-- ----------------------------
CREATE INDEX "view_index" ON "public"."log_stock_records" USING btree ("vehicle_id", "retail_edit_month");

-- ----------------------------
-- Primary Key structure for table log_stock_records
-- ----------------------------
ALTER TABLE "public"."log_stock_records" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table msil_dispatch_records
-- ----------------------------
ALTER TABLE "public"."msil_dispatch_records" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table msil_monthly_plannings
-- ----------------------------
ALTER TABLE "public"."msil_monthly_plannings" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table msil_order_mismatch
-- ----------------------------
ALTER TABLE "public"."msil_order_mismatch" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table msil_orders
-- ----------------------------
ALTER TABLE "public"."msil_orders" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_accessories
-- ----------------------------
ALTER TABLE "public"."mst_accessories" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_banks
-- ----------------------------
ALTER TABLE "public"."mst_banks" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_city_places
-- ----------------------------
ALTER TABLE "public"."mst_city_places" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_colors
-- ----------------------------
ALTER TABLE "public"."mst_colors" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_customer_types
-- ----------------------------
ALTER TABLE "public"."mst_customer_types" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_designations
-- ----------------------------
ALTER TABLE "public"."mst_designations" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_district_mvs
-- ----------------------------
ALTER TABLE "public"."mst_district_mvs" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_educations
-- ----------------------------
ALTER TABLE "public"."mst_educations" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_firms
-- ----------------------------
ALTER TABLE "public"."mst_firms" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_fiscal_years
-- ----------------------------
ALTER TABLE "public"."mst_fiscal_years" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_foc_accessoreis_partcode
-- ----------------------------
ALTER TABLE "public"."mst_foc_accessoreis_partcode" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_foc_accessories
-- ----------------------------
ALTER TABLE "public"."mst_foc_accessories" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table mst_inquiry_statuses
-- ----------------------------
CREATE INDEX "rank" ON "public"."mst_inquiry_statuses" USING btree ("rank");

-- ----------------------------
-- Primary Key structure for table mst_inquiry_statuses
-- ----------------------------
ALTER TABLE "public"."mst_inquiry_statuses" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_institutions
-- ----------------------------
ALTER TABLE "public"."mst_institutions" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_minimum_quantity
-- ----------------------------
ALTER TABLE "public"."mst_minimum_quantity" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_nepali_month
-- ----------------------------
ALTER TABLE "public"."mst_nepali_month" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_occupations
-- ----------------------------
ALTER TABLE "public"."mst_occupations" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_payment_modes
-- ----------------------------
ALTER TABLE "public"."mst_payment_modes" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_reasons
-- ----------------------------
ALTER TABLE "public"."mst_reasons" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_relations
-- ----------------------------
ALTER TABLE "public"."mst_relations" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_scan_device
-- ----------------------------
ALTER TABLE "public"."mst_scan_device" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_scan_person
-- ----------------------------
ALTER TABLE "public"."mst_scan_person" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_service_job_description
-- ----------------------------
ALTER TABLE "public"."mst_service_job_description" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_service_jobs
-- ----------------------------
ALTER TABLE "public"."mst_service_jobs" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_service_policy
-- ----------------------------
ALTER TABLE "public"."mst_service_policy" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_service_types
-- ----------------------------
ALTER TABLE "public"."mst_service_types" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_service_warranty_policy
-- ----------------------------
ALTER TABLE "public"."mst_service_warranty_policy" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_sms_template
-- ----------------------------
ALTER TABLE "public"."mst_sms_template" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_source_type
-- ----------------------------
ALTER TABLE "public"."mst_source_type" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_sources
-- ----------------------------
ALTER TABLE "public"."mst_sources" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_spareparts
-- ----------------------------
ALTER TABLE "public"."mst_spareparts" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_spareparts_category
-- ----------------------------
ALTER TABLE "public"."mst_spareparts_category" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_spareparts_dealer
-- ----------------------------
ALTER TABLE "public"."mst_spareparts_dealer" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_stock_yards
-- ----------------------------
ALTER TABLE "public"."mst_stock_yards" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_sub_source
-- ----------------------------
ALTER TABLE "public"."mst_sub_source" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_titles
-- ----------------------------
ALTER TABLE "public"."mst_titles" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_user_ledger
-- ----------------------------
ALTER TABLE "public"."mst_user_ledger" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_variants
-- ----------------------------
ALTER TABLE "public"."mst_variants" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_vehicles
-- ----------------------------
ALTER TABLE "public"."mst_vehicles" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_walkin_sources
-- ----------------------------
ALTER TABLE "public"."mst_walkin_sources" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table mst_workshop
-- ----------------------------
ALTER TABLE "public"."mst_workshop" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table project_activity_logs
-- ----------------------------
ALTER TABLE "public"."project_activity_logs" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table project_audit_logs
-- ----------------------------
ALTER TABLE "public"."project_audit_logs" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table project_sessions
-- ----------------------------
ALTER TABLE "public"."project_sessions" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table project_settings
-- ----------------------------
ALTER TABLE "public"."project_settings" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sales_booking_cancel
-- ----------------------------
ALTER TABLE "public"."sales_booking_cancel" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sales_credit_control_decision
-- ----------------------------
ALTER TABLE "public"."sales_credit_control_decision" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sales_discount_limit
-- ----------------------------
ALTER TABLE "public"."sales_discount_limit" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sales_discount_schemes
-- ----------------------------
ALTER TABLE "public"."sales_discount_schemes" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sales_foc_document
-- ----------------------------
ALTER TABLE "public"."sales_foc_document" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sales_foc_request
-- ----------------------------
ALTER TABLE "public"."sales_foc_request" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sales_partial_payment
-- ----------------------------
ALTER TABLE "public"."sales_partial_payment" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sales_pdi
-- ----------------------------
ALTER TABLE "public"."sales_pdi" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sales_target_records
-- ----------------------------
ALTER TABLE "public"."sales_target_records" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table sales_vehicle_process
-- ----------------------------
CREATE INDEX "sales_vehicle_process_index" ON "public"."sales_vehicle_process" USING btree ("customer_id", "msil_dispatch_id");

-- ----------------------------
-- Primary Key structure for table sales_vehicle_process
-- ----------------------------
ALTER TABLE "public"."sales_vehicle_process" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sales_vehicle_return
-- ----------------------------
ALTER TABLE "public"."sales_vehicle_return" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_billed_jobs
-- ----------------------------
ALTER TABLE "public"."ser_billed_jobs" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_billed_outsidework
-- ----------------------------
ALTER TABLE "public"."ser_billed_outsidework" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_billed_parts
-- ----------------------------
ALTER TABLE "public"."ser_billed_parts" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_billing_record
-- ----------------------------
ALTER TABLE "public"."ser_billing_record" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_counter_sales
-- ----------------------------
ALTER TABLE "public"."ser_counter_sales" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_counter_sales_request
-- ----------------------------
ALTER TABLE "public"."ser_counter_sales_request" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_estimate_details
-- ----------------------------
ALTER TABLE "public"."ser_estimate_details" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_estimate_jobs
-- ----------------------------
ALTER TABLE "public"."ser_estimate_jobs" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_estimate_parts
-- ----------------------------
ALTER TABLE "public"."ser_estimate_parts" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_floor_supervisor_advice
-- ----------------------------
ALTER TABLE "public"."ser_floor_supervisor_advice" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_gatepass
-- ----------------------------
ALTER TABLE "public"."ser_gatepass" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table ser_job_cards
-- ----------------------------
CREATE INDEX "ser_job_cards-dealer_id" ON "public"."ser_job_cards" USING btree ("dealer_id");

-- ----------------------------
-- Primary Key structure for table ser_job_cards
-- ----------------------------
ALTER TABLE "public"."ser_job_cards" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_jobcard_status
-- ----------------------------
ALTER TABLE "public"."ser_jobcard_status" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_material_scan
-- ----------------------------
ALTER TABLE "public"."ser_material_scan" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_outside_work
-- ----------------------------
ALTER TABLE "public"."ser_outside_work" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_outsidework_ledgers
-- ----------------------------
ALTER TABLE "public"."ser_outsidework_ledgers" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_parts
-- ----------------------------
ALTER TABLE "public"."ser_parts" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_purchase_based
-- ----------------------------
ALTER TABLE "public"."ser_purchase_based" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_purchase_challan
-- ----------------------------
ALTER TABLE "public"."ser_purchase_challan" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_purchase_challan_items
-- ----------------------------
ALTER TABLE "public"."ser_purchase_challan_items" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_purchase_invoices
-- ----------------------------
ALTER TABLE "public"."ser_purchase_invoices" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_purchase_method
-- ----------------------------
ALTER TABLE "public"."ser_purchase_method" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_purchase_order
-- ----------------------------
ALTER TABLE "public"."ser_purchase_order" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_sale_return
-- ----------------------------
ALTER TABLE "public"."ser_sale_return" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_service_policy_detail
-- ----------------------------
ALTER TABLE "public"."ser_service_policy_detail" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_service_policy_vehicles
-- ----------------------------
ALTER TABLE "public"."ser_service_policy_vehicles" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_warranty_claim
-- ----------------------------
ALTER TABLE "public"."ser_warranty_claim" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_warranty_claim_list
-- ----------------------------
ALTER TABLE "public"."ser_warranty_claim_list" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_workshop_job
-- ----------------------------
ALTER TABLE "public"."ser_workshop_job" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ser_workshop_users
-- ----------------------------
ALTER TABLE "public"."ser_workshop_users" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_daily_credits
-- ----------------------------
ALTER TABLE "public"."spareparts_daily_credits" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_damage_stock
-- ----------------------------
ALTER TABLE "public"."spareparts_damage_stock" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_dealer_claim
-- ----------------------------
ALTER TABLE "public"."spareparts_dealer_claim" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_dealer_credit
-- ----------------------------
ALTER TABLE "public"."spareparts_dealer_credit" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_dealer_opening_credit
-- ----------------------------
ALTER TABLE "public"."spareparts_dealer_opening_credit" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_dealer_sales
-- ----------------------------
ALTER TABLE "public"."spareparts_dealer_sales" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_dealer_stock
-- ----------------------------
ALTER TABLE "public"."spareparts_dealer_stock" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_dealer_stock_adjustment
-- ----------------------------
ALTER TABLE "public"."spareparts_dealer_stock_adjustment" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_dealer_yearly_target
-- ----------------------------
ALTER TABLE "public"."spareparts_dealer_yearly_target" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_dealersales_list
-- ----------------------------
ALTER TABLE "public"."spareparts_dealersales_list" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_dispatch_list
-- ----------------------------
ALTER TABLE "public"."spareparts_dispatch_list" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_dispatch_spareparts
-- ----------------------------
ALTER TABLE "public"."spareparts_dispatch_spareparts" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_dispatch_spareparts_copy
-- ----------------------------
ALTER TABLE "public"."spareparts_dispatch_spareparts_copy" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_document_count
-- ----------------------------
ALTER TABLE "public"."spareparts_document_count" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_gatepass
-- ----------------------------
ALTER TABLE "public"."spareparts_gatepass" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_goods_return
-- ----------------------------
ALTER TABLE "public"."spareparts_goods_return" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_landed_cost
-- ----------------------------
ALTER TABLE "public"."spareparts_landed_cost" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_local_purchase
-- ----------------------------
ALTER TABLE "public"."spareparts_local_purchase" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_local_purchase_list
-- ----------------------------
ALTER TABLE "public"."spareparts_local_purchase_list" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_msil_order
-- ----------------------------
ALTER TABLE "public"."spareparts_msil_order" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_opening_stock
-- ----------------------------
ALTER TABLE "public"."spareparts_opening_stock" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_order_generate
-- ----------------------------
ALTER TABLE "public"."spareparts_order_generate" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_order_unavailable
-- ----------------------------
ALTER TABLE "public"."spareparts_order_unavailable" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_pi_import
-- ----------------------------
ALTER TABLE "public"."spareparts_pi_import" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_picklist
-- ----------------------------
ALTER TABLE "public"."spareparts_picklist" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_picklist_copy
-- ----------------------------
ALTER TABLE "public"."spareparts_picklist_copy" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_sparepart_order
-- ----------------------------
ALTER TABLE "public"."spareparts_sparepart_order" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_sparepart_stock
-- ----------------------------
ALTER TABLE "public"."spareparts_sparepart_stock" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_stock_adjustment
-- ----------------------------
ALTER TABLE "public"."spareparts_stock_adjustment" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_stock_transfer
-- ----------------------------
ALTER TABLE "public"."spareparts_stock_transfer" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_stock_transfer_lists
-- ----------------------------
ALTER TABLE "public"."spareparts_stock_transfer_lists" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_stock_transfer_log
-- ----------------------------
ALTER TABLE "public"."spareparts_stock_transfer_log" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_stock_transfers
-- ----------------------------
ALTER TABLE "public"."spareparts_stock_transfers" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_stockyard_countersale_parts
-- ----------------------------
ALTER TABLE "public"."spareparts_stockyard_countersale_parts" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_stockyard_countersales
-- ----------------------------
ALTER TABLE "public"."spareparts_stockyard_countersales" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table spareparts_stockyards
-- ----------------------------
ALTER TABLE "public"."spareparts_stockyards" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table table_unknown_parts
-- ----------------------------
ALTER TABLE "public"."table_unknown_parts" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tbl_dublicate_number_log
-- ----------------------------
ALTER TABLE "public"."tbl_dublicate_number_log" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tbl_inquiry_uploaded_document
-- ----------------------------
ALTER TABLE "public"."tbl_inquiry_uploaded_document" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tbl_inquiry_uploaded_document_copy
-- ----------------------------
ALTER TABLE "public"."tbl_inquiry_uploaded_document_copy" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table temp_verhicle_service_history
-- ----------------------------
ALTER TABLE "public"."temp_verhicle_service_history" ADD PRIMARY KEY ("id");
