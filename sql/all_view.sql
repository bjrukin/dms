CREATE OR REPLACE VIEW "public"."view_aauth_users" AS 
 SELECT u.id,
    u.email,
    u.pass,
    u.username,
    u.fullname,
    u.banned,
    u.last_login,
    u.last_activity,
    u.date_created,
    u.forgot_exp,
    u.remember_time,
    u.remember_exp,
    u.verification_code,
    u.totp_secret,
    u.ip_address,
    de.dealer_id,
    dd.name AS dealer_name
   FROM ((aauth_users u
     LEFT JOIN dms_employees de ON ((u.id = de.user_id)))
     LEFT JOIN dms_dealers dd ON ((de.dealer_id = dd.id)));


CREATE OR REPLACE VIEW "public"."view_all_msil_orders" AS 
 SELECT mv.name AS vehicle_name,
    mva.name AS variant_name,
    mc.name AS color_name,
    md.firm_id,
    mf.name AS firm_name,
    md.order_id,
    md.year,
    md.month,
    md.color_id,
    md.variant_id,
    md.vehicle_id,
    md.deleted_at,
    md.quantity,
    md.id,
    md.cancel_quantity,
    md.reason,
    md.unplanned_order,
        CASE
            WHEN (md.unplanned_order = 1) THEN 'Unplanned'::text
            ELSE 'Planned'::text
        END AS order_type,
    md.received_quantity
   FROM ((((msil_orders md
     LEFT JOIN mst_vehicles mv ON ((md.vehicle_id = mv.id)))
     LEFT JOIN mst_variants mva ON ((md.variant_id = mva.id)))
     LEFT JOIN mst_colors mc ON ((md.color_id = mc.id)))
     LEFT JOIN mst_firms mf ON ((md.firm_id = mf.id)));

CREATE OR REPLACE VIEW "public"."view_assistant_dealers" AS 
 SELECT aauth_assitant_dealers.id,
    aauth_assitant_dealers.dealer_incharge_id,
    aauth_assitant_dealers.assistant_dealer_incharge_id,
    aauth_users.fullname,
    aauth_users.username,
    aauth_users.email,
    aauth_assitant_dealers.created_by,
    aauth_assitant_dealers.updated_by,
    aauth_assitant_dealers.deleted_by,
    aauth_assitant_dealers.created_at,
    aauth_assitant_dealers.updated_at,
    aauth_assitant_dealers.deleted_at
   FROM (aauth_assitant_dealers
     JOIN aauth_users ON ((aauth_assitant_dealers.assistant_dealer_incharge_id = aauth_users.id)));


CREATE OR REPLACE VIEW "public"."view_billed_grouped_outsidework" AS 
 SELECT bo.billing_id,
    sum(bo.final_amount) AS billied_outside_work
   FROM ser_billed_outsidework bo
  WHERE (bo.deleted_at IS NULL)
  GROUP BY bo.billing_id;

-- ----------------------------
-- View structure for view_billed_job_all
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_billed_job_all" AS 
 SELECT ser_billed_jobs.billing_id,
    ser_billed_jobs.price,
    ser_billed_jobs.final_amount,
    ser_billed_jobs.discount_amount,
    ser_billed_jobs.status,
    0 AS outsidework,
    ser_billed_jobs.job_id
   FROM ser_billed_jobs
UNION
 SELECT ser_billed_outsidework.billing_id,
    ser_billed_outsidework.price,
    ser_billed_outsidework.final_amount,
    ser_billed_outsidework.discount_amount,
    ser_billed_outsidework.status,
    1 AS outsidework,
    ser_billed_outsidework.job_id
   FROM ser_billed_outsidework;

-- ----------------------------
-- View structure for view_billing_details
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_billing_details" AS 
 SELECT dealer.name AS dealer_name,
    b.id,
    b.created_by,
    b.updated_by,
    b.deleted_by,
    b.created_at,
    b.updated_at,
    b.deleted_at,
    b.dealer_id,
    b.bill_no,
    b.billed_date,
    b.billed_date_np,
    b.billed_to,
    b.billed_time,
    b.status,
    b.approved_date,
    b.approved_date_np,
    b.approved_time,
    b.total_amt,
    d.name AS billed_to_person
   FROM ((d2d_billing_detail b
     LEFT JOIN dms_dealers dealer ON ((b.dealer_id = dealer.id)))
     LEFT JOIN dms_dealers d ON ((b.billed_to = d.id)));

-- ----------------------------
-- View structure for view_billing_jobcard
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_billing_jobcard" AS 
 SELECT ser_job_cards.jobcard_group,
    ser_job_cards.vehicle_id,
    ser_job_cards.variant_id,
    ser_job_cards.service_type,
    ser_job_cards.vehicle_no,
    ser_job_cards.closed_status,
    ser_billing_record.issue_date,
    ser_job_cards.deleted_at,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_service_types.name AS service_type_name,
    ser_job_cards.issue_date AS job_card_issue_date,
    mst_user_ledger.full_name AS customer_name,
    mst_vehicles.firm_id,
    mst_firms.name AS firm_name,
    ser_job_cards.service_count,
    ser_job_cards.chassis_no,
    ser_job_cards.engine_no,
    ser_job_cards.kms,
    ser_job_cards.mechanics_id,
    ser_job_cards.year,
    ser_job_cards.reciever_name,
    ser_job_cards.remarks,
    ser_job_cards.dealer_id,
    ser_job_cards.jobcard_serial,
    ser_job_cards.color_id,
    mst_colors.name AS color_name,
    ser_job_cards.floor_supervisor_id,
    mst_vehicles.rank AS vehicle_rank,
    mst_variants.rank AS variant_rank,
    ser_job_cards.pdi_kms,
    mst_vehicles.service_policy_id,
    ser_job_cards.vehicle_sold_on,
    mst_user_ledger.address1,
    mst_user_ledger.address2,
    dms_dealers.name AS dealer_name,
    ser_job_cards.service_adviser_id,
    (((dms_employees.first_name)::text || ' '::text) || (dms_employees.last_name)::text) AS service_advisor_name,
    ser_job_cards.fiscal_year_id,
    ser_billing_record.bill_type,
    ser_billing_record.payment_type,
    ser_billing_record.cash_account,
    ser_billing_record.credit_account,
    ser_billing_record.card_account,
    ser_billing_record.invoice_prefix,
    ser_billing_record.invoice_no,
    ser_billing_record.total_parts,
    ser_billing_record.total_jobs,
    ser_billing_record.cash_discount_percent,
    ser_billing_record.cash_discount_amt,
    ser_billing_record.vat_percent,
    ser_billing_record.vat_parts,
    ser_billing_record.vat_job,
    ser_billing_record.net_total
   FROM (((((((((ser_job_cards
     JOIN mst_service_types ON ((ser_job_cards.service_type = mst_service_types.id)))
     LEFT JOIN ser_billing_record ON ((ser_job_cards.jobcard_group = ser_billing_record.jobcard_group)))
     LEFT JOIN mst_variants ON ((ser_job_cards.variant_id = mst_variants.id)))
     JOIN mst_vehicles ON ((ser_job_cards.vehicle_id = mst_vehicles.id)))
     LEFT JOIN mst_user_ledger ON ((ser_job_cards.party_id = mst_user_ledger.id)))
     LEFT JOIN mst_firms ON ((mst_vehicles.firm_id = mst_firms.id)))
     LEFT JOIN mst_colors ON ((ser_job_cards.color_id = mst_colors.id)))
     LEFT JOIN dms_dealers ON ((ser_job_cards.dealer_id = dms_dealers.id)))
     LEFT JOIN dms_employees ON ((dms_employees.user_id = ser_job_cards.service_adviser_id)))
  GROUP BY ser_job_cards.vehicle_no, ser_job_cards.variant_id, ser_job_cards.service_type, ser_job_cards.vehicle_id, mst_service_types.name, ser_job_cards.jobcard_group, ser_job_cards.closed_status, ser_billing_record.issue_date, ser_job_cards.deleted_at, mst_variants.name, mst_vehicles.name, ser_job_cards.issue_date, mst_user_ledger.full_name, mst_vehicles.firm_id, mst_firms.name, ser_job_cards.service_count, ser_job_cards.chassis_no, ser_job_cards.engine_no, ser_job_cards.kms, ser_job_cards.mechanics_id, ser_job_cards.year, ser_job_cards.reciever_name, ser_job_cards.remarks, ser_job_cards.dealer_id, ser_job_cards.jobcard_serial, ser_job_cards.color_id, mst_colors.name, ser_job_cards.floor_supervisor_id, mst_vehicles.rank, mst_variants.rank, ser_job_cards.pdi_kms, mst_vehicles.service_policy_id, ser_job_cards.vehicle_sold_on, mst_user_ledger.address1, mst_user_ledger.address2, dms_dealers.name, ser_job_cards.service_adviser_id, dms_employees.first_name, dms_employees.last_name, ser_job_cards.fiscal_year_id, ser_billing_record.bill_type, ser_billing_record.payment_type, ser_billing_record.cash_account, ser_billing_record.credit_account, ser_billing_record.card_account, ser_billing_record.invoice_prefix, ser_billing_record.invoice_no, ser_billing_record.total_parts, ser_billing_record.total_jobs, ser_billing_record.cash_discount_percent, ser_billing_record.cash_discount_amt, ser_billing_record.vat_percent, ser_billing_record.vat_parts, ser_billing_record.vat_job, ser_billing_record.net_total;


CREATE OR REPLACE VIEW "public"."view_billing_part_breakdown" AS 
 WITH tmp AS (
         SELECT br.id,
                CASE
                    WHEN ((sc.name)::text = 'Spareparts'::text) THEN sum(bp.final_amount)
                    ELSE (0)::double precision
                END AS tpartprice,
                CASE
                    WHEN ((sc.name)::text = 'Accessories'::text) THEN sum(bp.final_amount)
                    ELSE (0)::double precision
                END AS taccessprice,
                CASE
                    WHEN ((sc.name)::text = 'Oil'::text) THEN sum(bp.final_amount)
                    ELSE (0)::double precision
                END AS toilprice,
                CASE
                    WHEN ((sc.name)::text = 'Local'::text) THEN sum(bp.final_amount)
                    ELSE (0)::double precision
                END AS tlocalprice,
                CASE
                    WHEN (((((sc.name)::text <> 'Oil'::text) AND ((sc.name)::text <> 'Local'::text)) AND ((sc.name)::text <> 'Accessories'::text)) AND ((sc.name)::text <> 'Spareparts'::text)) THEN sum(bp.final_amount)
                    ELSE (0)::double precision
                END AS tother,
            ( SELECT sum(bp.final_amount) AS null_value
                  WHERE (s.category_id IS NULL)) AS null_val
           FROM (((ser_billing_record br
             LEFT JOIN ser_billed_parts bp ON ((br.id = bp.billing_id)))
             LEFT JOIN mst_spareparts s ON ((bp.part_id = s.id)))
             LEFT JOIN mst_spareparts_category sc ON ((s.category_id = sc.id)))
          GROUP BY br.id, sc.name, s.category_id
        )
 SELECT tmp.id,
    sum(tmp.tpartprice) AS partprice,
    sum(tmp.taccessprice) AS accessprice,
    sum(tmp.toilprice) AS oilprice,
    (COALESCE(sum(tmp.tother), (0)::double precision) + COALESCE(sum(tmp.null_val), (0)::double precision)) AS other,
    sum(tmp.tlocalprice) AS localprice
   FROM tmp
  GROUP BY tmp.id;

-- ----------------------------
-- View structure for view_billing_part_breakdown_backup
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_billing_part_breakdown_backup" AS 
 SELECT br.id,
        CASE
            WHEN ((sc.name)::text = 'Spareparts'::text) THEN sum(bp.final_amount)
            ELSE (0)::double precision
        END AS partprice,
        CASE
            WHEN ((sc.name)::text = 'Accessories'::text) THEN sum(bp.final_amount)
            ELSE (0)::double precision
        END AS accessprice,
        CASE
            WHEN ((sc.name)::text = 'Oil'::text) THEN sum(bp.final_amount)
            ELSE (0)::double precision
        END AS oilprice,
        CASE
            WHEN (((((sc.name)::text <> 'Oil'::text) AND ((sc.name)::text <> 'Accessories'::text)) AND ((sc.name)::text <> 'Spareparts'::text)) AND (s.category_id IS NULL)) THEN sum(bp.final_amount)
            ELSE (0)::double precision
        END AS other
   FROM (((ser_billing_record br
     LEFT JOIN ser_billed_parts bp ON ((br.id = bp.billing_id)))
     LEFT JOIN mst_spareparts s ON ((bp.part_id = s.id)))
     LEFT JOIN mst_spareparts_category sc ON ((s.category_id = sc.id)))
  GROUP BY br.id, sc.name, s.category_id;

-- ----------------------------
-- View structure for view_cc_2nd_smr
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_cc_2nd_smr" AS 
 SELECT ccd.id,
    ccd.created_by,
    ccd.updated_by,
    ccd.deleted_by,
    ccd.customer_id,
    ccd.call_status,
    ccd.date_of_call,
    ccd.date_of_call_np,
    ccd.appointment_taken,
    ccd.remark,
    ccd.created_at,
    ccd.updated_at,
    ccd.deleted_at,
    ccd.schedule_date,
    ccd.call_type,
    ccd.false_reason,
    ccd.call_count,
    ccd.appointment_date,
    c.inquiry_no,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
    c.mobile_1,
    m1.name AS customer_type_name,
    d.name AS dealer_name,
        CASE
            WHEN ((m8.middle_name)::text <> ''::text) THEN (((((m8.first_name)::text || ' '::text) || (m8.middle_name)::text) || ' '::text) || (m8.last_name)::text)
            ELSE (((m8.first_name)::text || ' '::text) || (m8.last_name)::text)
        END AS executive_name,
    m9.name AS payment_mode_name,
    v.name AS vehicle_name,
    co.name AS color_name,
    va.name AS variant_name,
    svp.vehicle_delivery_date,
    msil_dispatch_records.engine_no,
    msil_dispatch_records.chass_no,
    (('now'::text)::date - ccd.schedule_date) AS age,
    c.dealer_id,
    (ccd.schedule_date + '7 days'::interval day) AS shdule_date
   FROM ((((((((((ccd_2nd_smr_days ccd
     LEFT JOIN dms_customers c ON ((ccd.customer_id = c.id)))
     LEFT JOIN mst_customer_types m1 ON ((c.customer_type_id = m1.id)))
     LEFT JOIN dms_dealers d ON ((c.dealer_id = d.id)))
     LEFT JOIN dms_employees m8 ON ((c.executive_id = m8.id)))
     LEFT JOIN mst_payment_modes m9 ON ((c.payment_mode_id = m9.id)))
     LEFT JOIN mst_vehicles v ON ((c.vehicle_id = v.id)))
     LEFT JOIN mst_colors co ON ((c.color_id = co.id)))
     LEFT JOIN mst_variants va ON ((c.variant_id = va.id)))
     LEFT JOIN sales_vehicle_process svp ON ((ccd.customer_id = svp.customer_id)))
     LEFT JOIN msil_dispatch_records ON ((svp.msil_dispatch_id = msil_dispatch_records.id)));

CREATE OR REPLACE VIEW "public"."view_ccd_inquiry" AS 
 SELECT ccd_inq.id,
    ccd_inq.created_by,
    ccd_inq.updated_by,
    ccd_inq.deleted_by,
    ccd_inq.created_at,
    ccd_inq.updated_at,
    ccd_inq.deleted_at,
    ccd_inq.customer_id,
    ccd_inq.date_of_call,
    ccd_inq.date_of_call_np,
    ccd_inq.sales_experience,
    ccd_inq.dse_attitude,
    ccd_inq.dse_knowledge,
    ccd_inq.scheme_information,
    ccd_inq.retail_finanace,
    ccd_inq.offered_test_drive,
    ccd_inq.warrenty_policy,
    ccd_inq.service_policy,
    ccd_inq.remarks,
    ccd_inq.voc,
    ccd_inq.call_status,
    ccd_inq.call_count,
    ccd_inq.competition,
    ccd_inq.false_enquiries,
    ccd_inq.yes_competition,
    ccd_inq.existing,
    ccd_inq.yes_existing,
    ccd_inq.dissatisfied,
    ccd_inq.call_connect_inquiry_type,
    ccd_inq.priority,
    c.inquiry_no,
    c.inquiry_date_en,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
    c.mobile_1,
    v.name AS vehicle_name,
    va.name AS variant_name,
    pm.name AS payment_mode_name,
    ct.name AS customer_type_name,
    so.name AS source_name,
    c.walkin_source_id,
    d.name AS dealer_name,
        CASE
            WHEN ((m8.middle_name)::text <> ''::text) THEN (((((m8.first_name)::text || ' '::text) || (m8.middle_name)::text) || ' '::text) || (m8.last_name)::text)
            ELSE (((m8.first_name)::text || ' '::text) || (m8.last_name)::text)
        END AS executive_name,
    concat(v.name, ' ', va.name) AS model,
    (('now'::text)::date - c.inquiry_date_en) AS inquiry_age,
        CASE
            WHEN ((('now'::text)::date - c.inquiry_date_en) > 3) THEN 'Late'::text
            ELSE 'Normal'::text
        END AS inquiry_date_status,
    c.source_id
   FROM ((((((((ccd_inquiry ccd_inq
     LEFT JOIN dms_customers c ON ((ccd_inq.customer_id = c.id)))
     LEFT JOIN mst_vehicles v ON ((c.vehicle_id = v.id)))
     LEFT JOIN mst_variants va ON ((c.variant_id = va.id)))
     LEFT JOIN mst_payment_modes pm ON ((c.payment_mode_id = pm.id)))
     LEFT JOIN mst_customer_types ct ON ((c.customer_type_id = ct.id)))
     LEFT JOIN mst_sources so ON ((c.source_id = so.id)))
     LEFT JOIN dms_dealers d ON ((c.dealer_id = d.id)))
     LEFT JOIN dms_employees m8 ON ((c.executive_id = m8.id)));

-- ----------------------------
-- View structure for view_ccd_inquiry_followup
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_ccd_inquiry_followup" AS 
 SELECT c.dealer_id,
    (ci.date_of_call - c.inquiry_date_en) AS followup_age,
    c.inquiry_date_en,
    ci.updated_at,
    dms_dealers.name AS dealer_name,
    ci.priority,
    ci.call_connect_inquiry_type,
    ci.dissatisfied,
    ci.yes_existing,
    ci.existing,
    ci.yes_competition,
    ci.false_enquiries,
    ci.competition,
    ci.call_count,
    ci.call_status,
    ci.voc,
    ci.remarks,
    ci.service_policy,
    ci.offered_test_drive,
    ci.warrenty_policy,
    ci.retail_finanace,
    ci.scheme_information,
    ci.dse_knowledge,
    ci.dse_attitude,
    ci.sales_experience,
    ci.deleted_at,
    ci.deleted_by
   FROM ((ccd_inquiry ci
     LEFT JOIN dms_customers c ON ((ci.customer_id = c.id)))
     LEFT JOIN dms_dealers ON ((c.dealer_id = dms_dealers.id)));


CREATE OR REPLACE VIEW "public"."view_ccd_smr_twentyone_days" AS 
 SELECT ccd.id,
    ccd.created_by,
    ccd.updated_by,
    ccd.deleted_by,
    ccd.customer_id,
    ccd.call_status,
    ccd.date_of_call,
    ccd.date_of_call_np,
    ccd.appointment_taken,
    ccd.appointment_date,
    ccd.remark,
    ccd.created_at,
    ccd.updated_at,
    ccd.deleted_at,
    ccd.schedule_date,
    ccd.call_type,
    ccd.false_reason,
    ccd.call_count,
    c.inquiry_no,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
    c.mobile_1,
    m1.name AS customer_type_name,
    d.name AS dealer_name,
        CASE
            WHEN ((m8.middle_name)::text <> ''::text) THEN (((((m8.first_name)::text || ' '::text) || (m8.middle_name)::text) || ' '::text) || (m8.last_name)::text)
            ELSE (((m8.first_name)::text || ' '::text) || (m8.last_name)::text)
        END AS executive_name,
    m9.name AS payment_mode_name,
    v.name AS vehicle_name,
    co.name AS color_name,
    va.name AS variant_name,
    svp.vehicle_delivery_date,
    msil_dispatch_records.engine_no,
    msil_dispatch_records.chass_no,
    (('now'::text)::date - ccd.schedule_date) AS age,
    c.dealer_id,
    (ccd.schedule_date + '9 days'::interval day) AS shdule_date
   FROM ((((((((((ccd_smr_twentyone_days ccd
     LEFT JOIN dms_customers c ON ((ccd.customer_id = c.id)))
     LEFT JOIN mst_customer_types m1 ON ((c.customer_type_id = m1.id)))
     LEFT JOIN dms_dealers d ON ((c.dealer_id = d.id)))
     LEFT JOIN dms_employees m8 ON ((c.executive_id = m8.id)))
     LEFT JOIN mst_payment_modes m9 ON ((c.payment_mode_id = m9.id)))
     LEFT JOIN mst_vehicles v ON ((c.vehicle_id = v.id)))
     LEFT JOIN mst_colors co ON ((c.color_id = co.id)))
     LEFT JOIN mst_variants va ON ((c.variant_id = va.id)))
     LEFT JOIN sales_vehicle_process svp ON ((ccd.customer_id = svp.customer_id)))
     LEFT JOIN msil_dispatch_records ON ((svp.msil_dispatch_id = msil_dispatch_records.id)));


CREATE OR REPLACE VIEW "public"."view_city_places" AS 
 SELECT c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    c.name,
    c.district_id,
    c.mun_vdc_id,
    d.name AS district_name,
    mv.name AS mun_vdc_name
   FROM ((mst_city_places c
     JOIN mst_district_mvs d ON ((c.district_id = d.id)))
     JOIN mst_district_mvs mv ON ((c.mun_vdc_id = mv.id)));

-- ----------------------------
-- View structure for view_counter_billing
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_counter_billing" AS 
 SELECT ser_counter_sales.id,
    ser_counter_sales.created_by,
    ser_counter_sales.updated_by,
    ser_counter_sales.deleted_by,
    ser_counter_sales.created_at,
    ser_counter_sales.updated_at,
    ser_counter_sales.deleted_at,
    ser_counter_sales.counter_sales_id,
    ser_counter_sales.vehicle_no,
    ser_counter_sales.chasis_no,
    ser_counter_sales.engine_no,
    ser_counter_sales.vehicle_id,
    ser_counter_sales.variant_id,
    ser_counter_sales.color_id,
    ser_counter_sales.party_id,
    ser_counter_sales.date_time,
    ser_counter_sales.billing_record_id,
    ser_billing_record.bill_type,
    ser_billing_record.payment_type,
    ser_billing_record.issue_date,
    ser_billing_record.cash_account,
    ser_billing_record.credit_account,
    ser_billing_record.card_account,
    ser_billing_record.invoice_prefix,
    ser_billing_record.invoice_no,
    ser_billing_record.total_parts,
    ser_billing_record.total_jobs,
    ser_billing_record.cash_discount_percent,
    ser_billing_record.cash_discount_amt,
    ser_billing_record.vat_percent,
    ser_billing_record.vat_parts,
    ser_billing_record.vat_job,
    ser_billing_record.net_total,
    ser_parts.part_id,
    ser_parts.price,
    ser_parts.quantity,
    ser_parts.discount_percentage,
    ser_parts.issue_date AS part_issue_date,
    ser_parts.warranty,
    ser_parts.final_amount,
    mst_user_ledger.title,
    mst_user_ledger.short_name,
    mst_user_ledger.full_name,
    mst_user_ledger.address1,
    mst_user_ledger.address2,
    mst_user_ledger.city,
    mst_user_ledger.area,
    mst_user_ledger.district_id,
    mst_user_ledger.zone_id,
    mst_user_ledger.pin_code,
    mst_user_ledger.std_code,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    ser_parts.id AS ser_parts_id,
    mst_spareparts.name AS part_name,
    mst_spareparts.part_code,
    mst_spareparts.category_id,
    mst_spareparts.model,
    mst_colors.name AS color_name,
    ser_counter_sales.dealer_id,
    ser_parts.counter_request,
    ser_parts.accepted_quantity,
    ser_counter_sales.is_request_complete,
    ser_parts.quantity_to_bill,
    ser_counter_sales.is_countersale_billed
   FROM (((((((ser_counter_sales
     LEFT JOIN ser_billing_record ON ((ser_counter_sales.billing_record_id = ser_billing_record.id)))
     LEFT JOIN ser_parts ON ((ser_parts.bill_id = ser_counter_sales.id)))
     LEFT JOIN mst_user_ledger ON ((ser_counter_sales.party_id = mst_user_ledger.id)))
     LEFT JOIN mst_vehicles ON ((ser_counter_sales.vehicle_id = mst_vehicles.id)))
     LEFT JOIN mst_variants ON ((ser_counter_sales.variant_id = mst_variants.id)))
     LEFT JOIN mst_spareparts ON ((ser_parts.part_id = mst_spareparts.id)))
     LEFT JOIN mst_colors ON ((ser_counter_sales.color_id = mst_colors.id)));

-- ----------------------------
-- View structure for view_counter_sales
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_counter_sales" AS 
 SELECT ser_counter_sales.id,
    ser_counter_sales.created_by,
    ser_counter_sales.updated_by,
    ser_counter_sales.deleted_by,
    ser_counter_sales.created_at,
    ser_counter_sales.updated_at,
    ser_counter_sales.deleted_at,
    ser_counter_sales.counter_sales_id,
    ser_counter_sales.vehicle_no,
    ser_counter_sales.chasis_no,
    ser_counter_sales.engine_no,
    ser_counter_sales.vehicle_id,
    ser_counter_sales.variant_id,
    ser_counter_sales.color_id,
    ser_counter_sales.party_id,
    ser_counter_sales.date_time,
    ser_counter_sales.billing_record_id,
    ser_counter_sales.dealer_id,
    ser_counter_sales.is_request_complete,
    ser_counter_sales.is_countersale_billed,
    ser_counter_sales.is_countersale_closed,
    ser_counter_sales_request.part_id,
    ser_counter_sales_request.part_name,
    ser_counter_sales_request.part_code,
    ser_counter_sales_request.quantity,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name,
    mst_user_ledger.full_name,
    mst_user_ledger.address1,
    mst_user_ledger.address2,
    mst_user_ledger.address3,
    mst_user_ledger.city,
    ser_counter_sales_request.id AS countersale_request_id,
    ser_billing_record.invoice_no,
    ser_billing_record.payment_type,
    ser_counter_sales.price_option,
    ser_billing_record.vro,
    ser_counter_sales_request.deleted_by AS deleted_by_request,
    ser_counter_sales_request.deleted_at AS deleted_at_request
   FROM ((((((ser_counter_sales
     JOIN ser_counter_sales_request ON ((ser_counter_sales_request.counter_sales_id = ser_counter_sales.id)))
     LEFT JOIN mst_vehicles ON ((ser_counter_sales.vehicle_id = mst_vehicles.id)))
     LEFT JOIN mst_variants ON ((ser_counter_sales.variant_id = mst_variants.id)))
     LEFT JOIN mst_colors ON ((ser_counter_sales.color_id = mst_colors.id)))
     LEFT JOIN mst_user_ledger ON ((ser_counter_sales.party_id = mst_user_ledger.id)))
     LEFT JOIN ser_billing_record ON ((ser_counter_sales.billing_record_id = ser_billing_record.id)));

-- ----------------------------
-- View structure for view_countersales_bills
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_countersales_bills" AS 
 SELECT ser_counter_sales.id,
    ser_counter_sales.created_by,
    ser_counter_sales.updated_by,
    ser_counter_sales.deleted_by,
    ser_counter_sales.created_at,
    ser_counter_sales.updated_at,
    ser_counter_sales.deleted_at,
    ser_counter_sales.counter_sales_id,
    ser_counter_sales.vehicle_no,
    ser_counter_sales.chasis_no,
    ser_counter_sales.engine_no,
    ser_counter_sales.vehicle_id,
    ser_counter_sales.variant_id,
    ser_counter_sales.color_id,
    ser_counter_sales.party_id,
    ser_counter_sales.date_time,
    ser_counter_sales.billing_record_id,
    ser_counter_sales.dealer_id,
    ser_counter_sales.is_request_complete,
    ser_counter_sales.is_countersale_billed,
    ser_counter_sales.is_countersale_closed,
    ser_billing_record.bill_type,
    ser_billing_record.payment_type,
    ser_billing_record.issue_date,
    ser_billing_record.cash_account,
    ser_billing_record.credit_account,
    ser_billing_record.card_account,
    ser_billing_record.invoice_prefix,
    ser_billing_record.invoice_no,
    ser_billing_record.total_parts,
    ser_billing_record.cash_discount_percent,
    ser_billing_record.cash_discount_amt,
    ser_billing_record.vat_percent,
    ser_billing_record.vat_parts,
    ser_billing_record.net_total,
    ser_billed_parts.part_id,
    ser_billed_parts.price,
    ser_billed_parts.quantity,
    ser_billed_parts.discount_percentage,
    ser_billed_parts.final_amount AS total,
    ser_billed_parts.warranty,
    mst_spareparts.name AS part_name,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name,
    mst_spareparts.part_code,
    mst_user_ledger.full_name
   FROM (((((((ser_counter_sales
     JOIN ser_billing_record ON (((ser_counter_sales.counter_sales_id = ser_billing_record.counter_sales_id) AND (ser_counter_sales.dealer_id = ser_billing_record.dealer_id))))
     JOIN ser_billed_parts ON ((ser_billed_parts.billing_id = ser_billing_record.id)))
     JOIN mst_spareparts ON ((ser_billed_parts.part_id = mst_spareparts.id)))
     LEFT JOIN mst_vehicles ON ((ser_counter_sales.vehicle_id = mst_vehicles.id)))
     LEFT JOIN mst_variants ON ((mst_variants.id = ser_counter_sales.variant_id)))
     LEFT JOIN mst_colors ON ((ser_counter_sales.color_id = mst_colors.id)))
     LEFT JOIN mst_user_ledger ON ((ser_counter_sales.party_id = mst_user_ledger.id)));

-- ----------------------------
-- View structure for view_countersales_material_issue
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_countersales_material_issue" AS 
 SELECT ser_material_scan.id,
    ser_material_scan.created_by,
    ser_material_scan.updated_by,
    ser_material_scan.deleted_by,
    ser_material_scan.created_at,
    ser_material_scan.updated_at,
    ser_material_scan.deleted_at,
    ser_material_scan.part_code,
    ser_material_scan.warranty,
    ser_material_scan.issue_date,
    ser_material_scan.jobcard_group,
    ser_material_scan.dealer_id,
    ser_material_scan.floorparts_advice_id,
    ser_material_scan.quantity,
    ser_material_scan.is_consumable,
    ser_material_scan.material_issue_no,
    ser_material_scan.countersales_id,
    ser_material_scan.part_id,
    ser_counter_sales.id AS countersale_id,
    mst_spareparts.name AS part_name,
    mst_spareparts.price,
    ((ser_material_scan.quantity)::numeric * mst_spareparts.price) AS total
   FROM ((ser_material_scan
     LEFT JOIN ser_counter_sales ON (((ser_material_scan.dealer_id = ser_counter_sales.dealer_id) AND (ser_material_scan.countersales_id = ser_counter_sales.counter_sales_id))))
     LEFT JOIN mst_spareparts ON ((ser_material_scan.part_id = mst_spareparts.id)));

-- ----------------------------
-- View structure for view_credit_policy
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_credit_policy" AS 
 SELECT s.id,
    s.created_by,
    s.updated_by,
    s.deleted_by,
    s.created_at,
    s.updated_at,
    s.deleted_at,
    s.dealer_id,
    s.order_no AS proforma_invoice_id,
    s.cr_dr,
    s.amount,
    s.date,
    s.date_nepali,
    s.receipt_no,
    s.image_name,
    msd.credit_policy
   FROM (spareparts_dealer_credit s
     LEFT JOIN dms_dealers msd ON ((s.dealer_id = msd.id)));

-- ----------------------------
-- View structure for view_customer_cancellation_report
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_customer_cancellation_report" AS 
 SELECT dms_cs0.status_id,
    (dms_cs0.created_at)::date AS status_date,
    dms_cs0.notes,
    dms_cs0.sub_status_id,
    dms_cs0.created_by,
    ((((COALESCE(dms_customers.first_name, ''::character varying))::text || ' '::text) || (COALESCE(dms_customers.middle_name, ''::character varying))::text) || (COALESCE(dms_customers.last_name, ''::character varying))::text) AS customer_name,
    mis.name,
    mis.rank,
    mst_inquiry_statuses.name AS sub_status_name,
    aauth_users.fullname,
    aauth_users.username,
    dms_dealers.name AS dealer_name,
    dms_cs0.deleted_by,
    dms_cs0.deleted_at,
    dms_dealers.id AS dealer_id,
    dms_customers.inquiry_no,
    dms_dealers.incharge_id
   FROM ((((((dms_customer_statuses dms_cs0
     JOIN dms_customers ON ((dms_cs0.customer_id = dms_customers.id)))
     JOIN mst_inquiry_statuses mis ON ((dms_cs0.status_id = mis.id)))
     JOIN mst_reasons r ON ((dms_cs0.reason_id = r.id)))
     JOIN mst_inquiry_statuses ON ((dms_cs0.sub_status_id = mst_inquiry_statuses.id)))
     JOIN aauth_users ON ((dms_cs0.created_by = aauth_users.id)))
     JOIN dms_dealers ON ((dms_customers.dealer_id = dms_dealers.id)))
  WHERE (dms_cs0.sub_status_id = 17)
  GROUP BY dms_cs0.status_id, (dms_cs0.created_at)::date, dms_cs0.notes, dms_cs0.sub_status_id, dms_cs0.created_by, ((((COALESCE(dms_customers.first_name, ''::character varying))::text || ' '::text) || (COALESCE(dms_customers.middle_name, ''::character varying))::text) || (COALESCE(dms_customers.last_name, ''::character varying))::text), mis.name, mis.rank, mst_inquiry_statuses.name, aauth_users.fullname, aauth_users.username, dms_dealers.name, dms_cs0.deleted_by, dms_cs0.deleted_at, dms_dealers.id, dms_customers.inquiry_no;


CREATE OR REPLACE VIEW "public"."view_customer_followups" AS 
 SELECT lf.id,
    lf.created_by,
    lf.updated_by,
    lf.deleted_by,
    lf.created_at,
    lf.updated_at,
    lf.deleted_at,
    lf.customer_id,
    lf.executive_id,
    lf.followup_date_en,
    lf.followup_date_np,
    lf.followup_mode,
    lf.followup_status,
    lf.followup_notes,
    lf.next_followup,
    lf.next_followup_date_en,
    lf.next_followup_date_np,
        CASE
            WHEN ((e.middle_name)::text <> ''::text) THEN (((((e.first_name)::text || ' '::text) || (e.middle_name)::text) || ' '::text) || (e.last_name)::text)
            ELSE (((e.first_name)::text || ' '::text) || (e.last_name)::text)
        END AS executive_name
   FROM (dms_customer_followups lf
     JOIN dms_employees e ON ((lf.executive_id = e.id)));


CREATE OR REPLACE VIEW "public"."view_customer_latest_followups" AS 
 SELECT dcf.id,
    dcf.created_by,
    dcf.updated_by,
    dcf.deleted_by,
    dcf.created_at,
    dcf.updated_at,
    dcf.deleted_at,
    dcf.customer_id,
    dcf.executive_id,
    dcf.followup_date_en,
    dcf.followup_date_np,
    dcf.followup_mode,
    dcf.followup_status,
    dcf.followup_notes,
    dcf.next_followup,
    dcf.next_followup_date_en,
    dcf.next_followup_date_np,
    dcf.status
   FROM (dms_customer_followups dcf
     JOIN ( SELECT dcf1.customer_id,
            max(dcf1.created_at) AS latest_date
           FROM dms_customer_followups dcf1
          GROUP BY dcf1.customer_id) dmfc ON (((dcf.customer_id = dmfc.customer_id) AND (dcf.created_at = dmfc.latest_date))));

-- ----------------------------
-- View structure for view_customer_latest_stat
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_customer_latest_stat" AS 
 SELECT DISTINCT ON (c.customer_id) c.customer_id,
    c.id,
    c.status_id,
    c.sub_status_id,
    c.created_at
   FROM dms_customer_statuses c
  ORDER BY c.customer_id, c.created_at DESC;


CREATE OR REPLACE VIEW "public"."view_customer_name_edit" AS 
 SELECT ie.id,
    ie.created_by,
    ie.updated_by,
    ie.deleted_by,
    ie.created_at,
    ie.updated_at,
    ie.deleted_at,
    ie.customer_id,
    ie.old_name,
    ie.new_name,
    c.inquiry_no,
    d.name AS dealer_name,
    c.executive_id,
    d.incharge_id,
    c.dealer_id
   FROM ((inquiry_name_edit ie
     JOIN dms_customers c ON ((ie.customer_id = c.id)))
     JOIN dms_dealers d ON ((c.dealer_id = d.id)));

-- ----------------------------
-- View structure for view_customer_payment_details
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_customer_payment_details" AS 
 SELECT dc.id,
    dc.inquiry_no,
    dc.deleted_at,
    dc.inquiry_date_np,
    dc.inquiry_date_en,
    dc.fiscal_year_id,
    dc.dealer_id,
    dc.executive_id,
    svp.booked_date,
    svp.downpayment_date,
    svp.fullpayment_date,
    svp.fullpayment_receipt_no,
    svp.downpayment_receipt_no,
    svp.booking_receipt_no,
    COALESCE(svp.booking_amount, (0)::numeric) AS booking_amount,
    COALESCE(svp.fullpayment_amount, (0)::numeric) AS fullpayment_amount,
    COALESCE(svp.downpayment_amount, (0)::numeric) AS downpayment_amount,
    COALESCE(vpp.total_partial_payment, (0)::bigint) AS total_partial_payment,
    dd.name AS dealer_name,
    concat(dme.first_name, ' ', dme.middle_name, ' ', dme.last_name) AS executive_name,
    svp.id AS svp_id,
    COALESCE(dv.price, 0) AS vehicle_price,
    ((((COALESCE(dv.price, 0))::numeric - COALESCE(svp.booking_amount, (0)::numeric)) - COALESCE(svp.fullpayment_amount, (0)::numeric)) - (COALESCE(vpp.total_partial_payment, (0)::bigint))::numeric) AS outstanding_amount,
    mst_colors.name AS color_name,
    mst_variants.name AS variant_name,
    mst_vehicles.name AS vehicle_name
   FROM ((((((((dms_customers dc
     LEFT JOIN sales_vehicle_process svp ON ((dc.id = svp.customer_id)))
     LEFT JOIN ( SELECT sum(sales_partial_payment.amount) AS total_partial_payment,
            sales_partial_payment.vehicle_process_id
           FROM sales_partial_payment
          GROUP BY sales_partial_payment.vehicle_process_id) vpp ON ((vpp.vehicle_process_id = svp.id)))
     LEFT JOIN dms_dealers dd ON ((dc.dealer_id = dd.id)))
     LEFT JOIN dms_employees dme ON ((dc.executive_id = dme.id)))
     JOIN dms_vehicles dv ON ((((dc.vehicle_id = dv.vehicle_id) AND (dc.variant_id = dv.variant_id)) AND (dc.color_id = dv.color_id))))
     JOIN mst_colors ON ((dv.color_id = mst_colors.id)))
     JOIN mst_variants ON ((dv.variant_id = mst_variants.id)))
     JOIN mst_vehicles ON ((dv.vehicle_id = mst_vehicles.id)));

CREATE OR REPLACE VIEW "public"."view_customer_report_view" AS 
 SELECT dc.deleted_at,
    dc.dealer_id,
    dc.vehicle_id,
    mv.name AS vehicle_name,
    dms_dealers.name,
    dc.deleted_by,
    count(dc.id) AS inquiry_count
   FROM ((((dms_customers dc
     LEFT JOIN mst_vehicles mv ON ((dc.vehicle_id = mv.id)))
     LEFT JOIN mst_variants mva ON ((dc.variant_id = mva.id)))
     LEFT JOIN mst_colors mc ON ((dc.color_id = mc.id)))
     LEFT JOIN dms_dealers ON ((dc.dealer_id = dms_dealers.id)))
  GROUP BY dms_dealers.name, mv.name, dc.deleted_by, dc.deleted_at, dc.dealer_id, dc.vehicle_id;


CREATE OR REPLACE VIEW "public"."view_customer_status_dates" AS 
 SELECT temp_table.customer_id,
    temp_table.status_1,
    temp_table.status_2,
    temp_table.status_3,
    temp_table.status_4,
    temp_table.status_5,
    temp_table.status_6,
    temp_table.status_7,
    temp_table.status_8,
    temp_table.status_9,
    temp_table.status_10,
    temp_table.status_11,
    temp_table.status_12,
    temp_table.status_13,
    temp_table.status_14,
    temp_table.status_15,
    temp_table.status_16,
    temp_table.status_17,
    temp_table.status_18
   FROM crosstab(' SELECT customer_id, status_id, MAX(created_at::DATE) AS status_date FROM view_customer_statuses GROUP BY 1,2 ORDER BY 1,2 '::text, ' SELECT DISTINCT id FROM mst_inquiry_statuses order by 1 '::text) temp_table(customer_id integer, status_1 text, status_2 text, status_3 text, status_4 text, status_5 text, status_6 text, status_7 text, status_8 text, status_9 text, status_10 text, status_11 text, status_12 text, status_13 text, status_14 text, status_15 text, status_16 text, status_17 text, status_18 text);


CREATE OR REPLACE VIEW "public"."view_customer_status_latest" AS 
 SELECT dms_cs0.customer_id,
    dms_cs0.status_id,
    (dms_cs0.created_at)::date AS status_date,
    mis.name,
    mis.rank,
        CASE
            WHEN ((dms_cs0.reason_id < 1) OR (dms_cs0.reason_id IS NULL)) THEN 'N/A'::character varying
            ELSE r.name
        END AS reason_name,
    dms_cs0.notes,
    dms_cs0.sub_status_id,
    mst_inquiry_statuses.sub_status_group,
    mst_inquiry_statuses.name AS sub_status_name,
    (dms_cs0.created_at)::time without time zone AS status_time,
    dms_cs0.tentative_retail_date
   FROM ((((dms_customer_statuses dms_cs0
     JOIN ( SELECT dms_cs1.customer_id,
            max(dms_cs1.created_at) AS latest_date
           FROM dms_customer_statuses dms_cs1
          GROUP BY dms_cs1.customer_id) tbl ON (((tbl.customer_id = dms_cs0.customer_id) AND (tbl.latest_date = dms_cs0.created_at))))
     LEFT JOIN mst_inquiry_statuses mis ON ((dms_cs0.status_id = mis.id)))
     LEFT JOIN mst_reasons r ON ((dms_cs0.reason_id = r.id)))
     LEFT JOIN mst_inquiry_statuses ON ((dms_cs0.sub_status_id = mst_inquiry_statuses.id)))
  GROUP BY dms_cs0.customer_id, dms_cs0.status_id, (dms_cs0.created_at)::date, mis.name, mis.rank, (dms_cs0.created_at)::time without time zone,
        CASE
            WHEN ((dms_cs0.reason_id < 1) OR (dms_cs0.reason_id IS NULL)) THEN 'N/A'::character varying
            ELSE r.name
        END, dms_cs0.notes, dms_cs0.sub_status_id, mst_inquiry_statuses.sub_status_group, mst_inquiry_statuses.name, dms_cs0.tentative_retail_date;


CREATE OR REPLACE VIEW "public"."view_customer_status_latest_niroj" AS 
 SELECT s.name AS status_name,
    ss.name AS sub_status_name,
    ssss.customer_id,
    ssss.id,
    ssss.status_id,
    ssss.sub_status_id,
    c.executive_id,
    c.dealer_id,
    c.fiscal_year_id,
    (ssss.created_at)::date AS status_date
   FROM (((view_customer_latest_stat ssss
     LEFT JOIN mst_inquiry_statuses s ON ((ssss.status_id = s.id)))
     LEFT JOIN mst_inquiry_statuses ss ON ((ssss.sub_status_id = ss.id)))
     JOIN dms_customers c ON ((ssss.customer_id = c.id)));


CREATE OR REPLACE VIEW "public"."view_customer_statuses" AS 
 SELECT ls.id,
    ls.created_by,
    ls.updated_by,
    ls.deleted_by,
    ls.created_at,
    ls.updated_at,
    ls.deleted_at,
    ls.customer_id,
    ls.status_id,
    ls.reason_id,
    ls.duration,
    ls.notes,
    s.name AS status_name,
    r.name AS reason_name,
    ls.sub_status_id,
    mst_inquiry_statuses.name AS sub_status_name,
    mst_inquiry_statuses.sub_status_group,
    ls.tentative_retail_date
   FROM (((dms_customer_statuses ls
     LEFT JOIN mst_inquiry_statuses s ON ((ls.status_id = s.id)))
     LEFT JOIN mst_reasons r ON ((ls.reason_id = r.id)))
     LEFT JOIN mst_inquiry_statuses ON ((ls.sub_status_id = mst_inquiry_statuses.id)));


CREATE OR REPLACE VIEW "public"."view_customer_test_drive_refined" AS 
 SELECT td.id,
    td.created_by,
    td.updated_by,
    td.deleted_by,
    td.created_at,
    td.updated_at,
    td.deleted_at,
    td.customer_id,
    td.td_date_en,
    td.td_date_np,
    td.td_time,
    td.executive_id,
    td.vehicle_id,
    td.variant_id,
    td.mileage_start,
    td.mileage_end,
    td.duration,
    td.td_location,
    va.name AS variant_name,
    ve.name AS vehicle_name,
        CASE
            WHEN ((e.middle_name)::text <> ''::text) THEN (((((e.first_name)::text || ' '::text) || (e.middle_name)::text) || ' '::text) || (e.last_name)::text)
            ELSE (((e.first_name)::text || ' '::text) || (e.last_name)::text)
        END AS executive_name
   FROM (((dms_customer_test_drives td
     LEFT JOIN mst_vehicles ve ON ((td.vehicle_id = ve.id)))
     LEFT JOIN mst_variants va ON ((td.variant_id = va.id)))
     LEFT JOIN dms_employees e ON ((td.executive_id = e.id)));

-- ----------------------------
-- View structure for view_customer_test_drives
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_customer_test_drives" AS 
 SELECT td.id,
    td.created_by,
    td.updated_by,
    td.deleted_by,
    td.created_at,
    td.updated_at,
    td.deleted_at,
    td.td_date_en,
    td.td_date_np,
    td.td_time,
    td.customer_id,
    td.executive_id,
    td.vehicle_id,
    td.variant_id,
    td.mileage_start,
    td.mileage_end,
    td.duration,
    td.td_location,
    va.name AS variant_name,
    ve.name AS vehicle_name,
        CASE
            WHEN ((e.middle_name)::text <> ''::text) THEN (((((e.first_name)::text || ' '::text) || (e.middle_name)::text) || ' '::text) || (e.last_name)::text)
            ELSE (((e.first_name)::text || ' '::text) || (e.last_name)::text)
        END AS executive_name,
    td.document AS test_drive_document,
    td.opening_kms,
    td.closing_kms,
    td.reported_by,
    td.fuel_location,
    td.month,
    td.kms,
    td.fuel,
    td.chassis_no_test
   FROM (((dms_customer_test_drives td
     LEFT JOIN mst_variants va ON ((td.variant_id = va.id)))
     LEFT JOIN mst_vehicles ve ON ((td.vehicle_id = ve.id)))
     LEFT JOIN dms_employees e ON ((td.executive_id = e.id)));

-- ----------------------------
-- View structure for view_customer_test_drives_latest
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_customer_test_drives_latest" AS 
 SELECT td.id,
    td.created_by,
    td.updated_by,
    td.deleted_by,
    td.created_at,
    td.updated_at,
    td.deleted_at,
    td.td_date_en,
    td.td_date_np,
    td.td_time,
    td.customer_id,
    td.executive_id,
    td.vehicle_id,
    td.variant_id,
    td.mileage_start,
    td.mileage_end,
    td.duration,
    td.td_location,
    va.name AS variant_name,
    ve.name AS vehicle_name,
        CASE
            WHEN ((e.middle_name)::text <> ''::text) THEN (((((e.first_name)::text || ' '::text) || (e.middle_name)::text) || ' '::text) || (e.last_name)::text)
            ELSE (((e.first_name)::text || ' '::text) || (e.last_name)::text)
        END AS executive_name
   FROM ((((dms_customer_test_drives td
     JOIN ( SELECT td1.customer_id,
            max(td1.created_at) AS latest_date
           FROM dms_customer_test_drives td1
          GROUP BY td1.customer_id) tbl ON (((tbl.customer_id = td.customer_id) AND (tbl.latest_date = td.created_at))))
     LEFT JOIN mst_variants va ON ((td.variant_id = va.id)))
     LEFT JOIN mst_vehicles ve ON ((td.vehicle_id = ve.id)))
     LEFT JOIN dms_employees e ON ((td.executive_id = e.id)));

-- ----------------------------
-- View structure for view_customer_testdrive_refined
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_customer_testdrive_refined" AS 
 SELECT view_customer_test_drives.customer_id
   FROM view_customer_test_drives
  GROUP BY view_customer_test_drives.customer_id;

-- ----------------------------
-- View structure for view_customer_vehicle
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_customer_vehicle" AS 
 SELECT c.id AS cid,
    c.inquiry_date_en,
    c.inquiry_no,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    prev.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    prev.customer_id,
    prev.prev_vehicle,
    prev.prev_variant,
    prev.prev_color,
    prev.new_vehicle,
    prev.new_variant,
    prev.new_color,
    prev.date,
    prev.date_np,
    prev.status_id,
    c.dealer_id,
    c.first_name,
    c.middle_name,
    c.last_name,
    c.inquiry_date_np,
    c.source_id,
    c.executive_id,
    c.mobile_1
   FROM (dms_customers c
     JOIN ( SELECT t1.id,
            t1.created_by,
            t1.updated_by,
            t1.deleted_by,
            t1.created_at,
            t1.updated_at,
            t1.deleted_at,
            t1.customer_id,
            t1.prev_vehicle,
            t1.prev_variant,
            t1.prev_color,
            t1.new_vehicle,
            t1.new_variant,
            t1.new_color,
            t1.date,
            t1.date_np,
            t1.status_id
           FROM (crm_vehicle_edit t1
             JOIN ( SELECT min(crm_vehicle_edit.id) AS id
                   FROM crm_vehicle_edit
                  GROUP BY crm_vehicle_edit.customer_id) t ON ((t1.id = t.id)))) prev ON ((prev.customer_id = c.id)));



CREATE OR REPLACE VIEW "public"."view_d2d_billing_detail" AS 
 SELECT d2d_billing_detail.id,
    d2d_billing_detail.created_by,
    d2d_billing_detail.updated_by,
    d2d_billing_detail.deleted_by,
    d2d_billing_detail.created_at,
    d2d_billing_detail.updated_at,
    d2d_billing_detail.deleted_at,
    d2d_billing_detail.dealer_id,
    d2d_billing_detail.bill_no,
    d2d_billing_detail.billed_date,
    d2d_billing_detail.billed_date_np,
    d2d_billing_detail.billed_to,
    d2d_billing_detail.billed_time,
    d2d_billing_detail.status,
    d2d_billing_detail.approved_date,
    d2d_billing_detail.approved_date_np,
    d2d_billing_detail.approved_time,
    d2d_billing_detail.total_amt,
        CASE
            WHEN (d2d_billing_detail.billed_to = 0) THEN 'SHREE HIMALAYAN ENTERPRISES (PVT.) LTD.'::character varying(255)
            ELSE billed_to_dealer.name
        END AS billed_to_dealer,
    dms_dealers.name AS dealer_name,
    d2d_billing_detail.is_billed,
    d2d_billing_detail.bill_id
   FROM ((d2d_billing_detail
     LEFT JOIN dms_dealers billed_to_dealer ON ((d2d_billing_detail.billed_to = billed_to_dealer.id)))
     LEFT JOIN dms_dealers ON ((d2d_billing_detail.dealer_id = dms_dealers.id)));

-- ----------------------------
-- View structure for view_d2d_billing_list
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_d2d_billing_list" AS 
 SELECT d2d_billing_list.id,
    d2d_billing_list.created_by,
    d2d_billing_list.updated_by,
    d2d_billing_list.deleted_by,
    d2d_billing_list.created_at,
    d2d_billing_list.updated_at,
    d2d_billing_list.deleted_at,
    d2d_billing_list.bill_id,
    d2d_billing_list.sparepart_id,
    d2d_billing_list.price,
    d2d_billing_list.quantity,
    d2d_billing_list.total_price,
    mst_spareparts.part_code,
    mst_spareparts.name AS part_name
   FROM (d2d_billing_list
     JOIN mst_spareparts ON ((d2d_billing_list.sparepart_id = mst_spareparts.id)));

-- ----------------------------
-- View structure for view_daily_credits
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_daily_credits" AS 
 SELECT sdc.id,
    sdc.created_at,
    sdc.created_by,
    sdc.updated_at,
    sdc.updated_by,
    sdc.deleted_at,
    sdc.deleted_by,
    sdc.dealer_id,
    sdc.date_en,
    sdc.date_np,
    sdc.credit_amount,
    dd.name AS dealer_name
   FROM ((spareparts_daily_credits sdc
     JOIN ( SELECT max(spareparts_daily_credits.created_at) AS latest_created,
            spareparts_daily_credits.date_en,
            spareparts_daily_credits.dealer_id
           FROM spareparts_daily_credits
          GROUP BY spareparts_daily_credits.dealer_id, spareparts_daily_credits.date_en) sdcl ON ((((sdc.dealer_id = sdcl.dealer_id) AND (sdc.date_en = sdcl.date_en)) AND (sdcl.latest_created = sdc.created_at))))
     JOIN dms_dealers dd ON ((sdc.dealer_id = dd.id)));


CREATE OR REPLACE VIEW "public"."view_dashboard_ageing" AS 
 SELECT mdr.id,
    mdr.deleted_at,
    mdr.vehicle_id,
    mdr.variant_id,
    mdr.color_id,
    mdr.engine_no,
    mdr.chass_no,
    mdr.current_location,
    mdr.current_status,
    mdr.year,
    (date_part('epoch'::text, age((('now'::text)::date)::timestamp with time zone, (mdr.nepal_custom)::timestamp with time zone)) / (86400)::double precision) AS ageing,
        CASE
            WHEN ((date_part('epoch'::text, age((('now'::text)::date)::timestamp with time zone, (mdr.nepal_custom)::timestamp with time zone)) / (86400)::double precision) >= (120)::double precision) THEN 'Above 120days'::text
            ELSE 'Below 120 Days'::text
        END AS stock_status,
    mv.service_policy_id
   FROM (msil_dispatch_records mdr
     LEFT JOIN mst_vehicles mv ON ((mdr.vehicle_id = mv.id)))
  WHERE (((((mdr.current_status)::text = 'Stock'::text) OR ((mdr.current_status)::text = 'repaired stock'::text)) OR ((mdr.current_status)::text = 'damage'::text)) OR ((mdr.current_status)::text = 'Display'::text));


CREATE OR REPLACE VIEW "public"."view_dashboard_ageing_stock" AS 
 SELECT view_dashboard_ageing.deleted_at,
    view_dashboard_ageing.stock_status,
    count(view_dashboard_ageing.stock_status) AS total_stock,
    view_dashboard_ageing.service_policy_id,
        CASE
            WHEN (view_dashboard_ageing.service_policy_id = 1) THEN 'Passenger'::text
            WHEN (view_dashboard_ageing.service_policy_id = 2) THEN 'Van'::text
            WHEN (view_dashboard_ageing.service_policy_id = 3) THEN 'Utility'::text
            WHEN (view_dashboard_ageing.service_policy_id = 5) THEN 'Hybrid'::text
            ELSE 'Commercial'::text
        END AS service_type
   FROM view_dashboard_ageing
  GROUP BY view_dashboard_ageing.stock_status, view_dashboard_ageing.deleted_at, view_dashboard_ageing.service_policy_id;


CREATE OR REPLACE VIEW "public"."view_dashboard_dealerwise_inquiry" AS 
 SELECT c.dealer_id,
    "substring"((c.inquiry_date_np)::text, 6, 2) AS nepali_month,
    count(c.id) AS total_inquiry,
    concat("substring"((mfy.nepali_start_date)::text, 1, 4), '-', "substring"((mfy.nepali_end_date)::text, 3, 2)) AS fiscal_year,
    c.deleted_at
   FROM (dms_customers c
     JOIN mst_fiscal_years mfy ON ((c.fiscal_year_id = mfy.id)))
  GROUP BY c.dealer_id, "substring"((c.inquiry_date_np)::text, 6, 2), concat("substring"((mfy.nepali_start_date)::text, 1, 4), '-', "substring"((mfy.nepali_end_date)::text, 3, 2)), c.deleted_at;


CREATE OR REPLACE VIEW "public"."view_dashboard_inquiry_source_count" AS 
 SELECT v.id,
    v.dealer_id,
    v.executive_id,
    so.name AS source_name,
    v.inquiry_date_en,
    v.inquiry_date_np
   FROM (dms_customers v
     LEFT JOIN mst_sources so ON ((v.source_id = so.id)));


CREATE OR REPLACE VIEW "public"."view_dashboard_inquiry_type_count" AS 
 SELECT v.id,
    v.inquiry_date_np,
    v.inquiry_date_en,
    v.dealer_id,
    v.executive_id,
    mst_customer_types.name AS customer_type_name
   FROM (dms_customers v
     LEFT JOIN mst_customer_types ON ((v.customer_type_id = mst_customer_types.id)));

-- ----------------------------
-- View structure for view_dashboard_latest_customer_status
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dashboard_latest_customer_status" AS 
 WITH tmp AS (
         SELECT dms_cs0.customer_id,
            dms_cs0.status_id
           FROM (dms_customer_statuses dms_cs0
             JOIN ( SELECT dms_cs1.customer_id,
                    max(dms_cs1.created_at) AS latest_date
                   FROM dms_customer_statuses dms_cs1
                  GROUP BY dms_cs1.customer_id) tbl ON (((tbl.customer_id = dms_cs0.customer_id) AND (tbl.latest_date = dms_cs0.created_at))))
        )
 SELECT tmp.customer_id,
    tmp.status_id
   FROM tmp
  GROUP BY tmp.customer_id, tmp.status_id;

-- ----------------------------
-- View structure for view_dashboard_modelwise_inquiry
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dashboard_modelwise_inquiry" AS 
 SELECT c.vehicle_id,
    "substring"((c.inquiry_date_np)::text, 6, 2) AS nepali_month,
    count(c.id) AS total_inquiry,
    concat("substring"((mfy.nepali_start_date)::text, 1, 4), '-', "substring"((mfy.nepali_end_date)::text, 3, 2)) AS fiscal_year,
    c.deleted_at
   FROM (dms_customers c
     JOIN mst_fiscal_years mfy ON ((c.fiscal_year_id = mfy.id)))
  GROUP BY c.vehicle_id, "substring"((c.inquiry_date_np)::text, 6, 2), concat("substring"((mfy.nepali_start_date)::text, 1, 4), '-', "substring"((mfy.nepali_end_date)::text, 3, 2)), c.deleted_at;


CREATE OR REPLACE VIEW "public"."view_dashboard_monthly_retail_dealerwise" AS 
 SELECT mnm.name AS month_name,
    ldd.dealer_id,
    dd.name AS "dealer_Name",
    lsr.retail_fiscal_year,
    lsr.dispatched_date_np_month,
    count(lsr.id) AS total_retail,
    mnm.rank AS month_rank
   FROM (((log_stock_records lsr
     JOIN mst_nepali_month mnm ON (((lsr.dispatched_date_np_month)::integer = mnm.id)))
     LEFT JOIN log_dispatch_dealer ldd ON ((lsr.dispatch_id = ldd.id)))
     LEFT JOIN dms_dealers dd ON ((ldd.dealer_id = dd.id)))
  WHERE (lsr.dispatched_date_np_month IS NOT NULL)
  GROUP BY mnm.name, ldd.dealer_id, dd.name, lsr.retail_fiscal_year, lsr.dispatched_date_np_month, mnm.rank
  ORDER BY mnm.rank;

-- ----------------------------
-- View structure for view_dashboard_monthly_sales
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dashboard_monthly_sales" AS 
 SELECT ldd.fiscal_year,
    ldd.edit_month_np,
    ldd.dealer_id,
    count(ldd.id) AS total_bill,
    mst_nepali_month.name AS nepali_month_name,
    dms_dealers.name AS dealer_name,
    mst_nepali_month.rank AS month_rank,
    ldd.deleted_at
   FROM ((log_dispatch_dealer ldd
     JOIN dms_dealers ON ((ldd.dealer_id = dms_dealers.id)))
     JOIN mst_nepali_month ON ((ldd.edit_month_np = mst_nepali_month.id)))
  GROUP BY ldd.dealer_id, ldd.edit_month_np, ldd.fiscal_year, dms_dealers.name, mst_nepali_month.rank, mst_nepali_month.name, ldd.deleted_at
  ORDER BY ldd.edit_month_np;

-- ----------------------------
-- View structure for view_dashboard_monthlysales_modelwise
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dashboard_monthlysales_modelwise" AS 
 SELECT ldd.fiscal_year,
    ldd.edit_month_np,
    count(ldd.id) AS total_bill,
    ldd.deleted_at,
    msil_dispatch_records.vehicle_id,
    mst_vehicles.service_policy_id
   FROM ((log_dispatch_dealer ldd
     LEFT JOIN msil_dispatch_records ON ((ldd.vehicle_id = msil_dispatch_records.id)))
     LEFT JOIN mst_vehicles ON ((msil_dispatch_records.vehicle_id = mst_vehicles.id)))
  GROUP BY ldd.edit_month_np, ldd.fiscal_year, ldd.deleted_at, msil_dispatch_records.vehicle_id, mst_vehicles.service_policy_id
  ORDER BY msil_dispatch_records.vehicle_id;

-- ----------------------------
-- View structure for view_dashboard_regionwise_bill
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dashboard_regionwise_bill" AS 
 SELECT region.name AS region_name,
    log_dispatch_dealer.fiscal_year,
    log_dispatch_dealer.dispatched_date_np,
    log_dispatch_dealer.deleted_at,
    region.id AS region_id
   FROM ((((log_dispatch_dealer
     JOIN dms_dealers ON ((log_dispatch_dealer.dealer_id = dms_dealers.id)))
     JOIN mst_district_mvs dis ON ((dms_dealers.district_id = dis.id)))
     JOIN mst_district_mvs zone ON ((dis.parent_id = zone.id)))
     JOIN mst_district_mvs region ON ((zone.parent_id = region.id)));


CREATE OR REPLACE VIEW "public"."view_dashboard_regionwise_retail" AS 
 SELECT view_dashboard_latest_customer_status.status_id AS actual_status_id,
    region.name AS region_name,
    sales_vehicle_process.vehicle_delivery_date,
    sales_vehicle_process.vehicle_delivery_date_np,
    region.id AS region_id
   FROM ((((((dms_customers
     JOIN view_dashboard_latest_customer_status ON ((dms_customers.id = view_dashboard_latest_customer_status.customer_id)))
     LEFT JOIN dms_dealers ON ((dms_customers.dealer_id = dms_dealers.id)))
     LEFT JOIN mst_district_mvs dist ON ((dms_dealers.district_id = dist.id)))
     LEFT JOIN mst_district_mvs zone ON ((dist.parent_id = zone.id)))
     LEFT JOIN mst_district_mvs region ON ((zone.parent_id = region.id)))
     JOIN sales_vehicle_process ON ((dms_customers.id = sales_vehicle_process.customer_id)))
  WHERE (view_dashboard_latest_customer_status.status_id = 15);

-- ---

CREATE OR REPLACE VIEW "public"."view_dashboard_retail_actual" AS 
 SELECT lsr.retail_fiscal_year,
        CASE
            WHEN (nn.id IS NOT NULL) THEN lsr.retail_edit_month
            ELSE (lsr.dispatched_date_np_month)::integer
        END AS dispatched_date_np_month,
    count(lsr.id) AS total_retail,
    mst_vehicles.name AS vehicle_name,
    mst_vehicles.rank AS vehicle_rank,
    mst_vehicles.service_policy_id
   FROM (((log_stock_records lsr
     LEFT JOIN mst_nepali_month nn ON ((lsr.retail_edit_month = nn.id)))
     LEFT JOIN msil_dispatch_records ON ((lsr.vehicle_id = msil_dispatch_records.id)))
     LEFT JOIN mst_vehicles ON ((msil_dispatch_records.vehicle_id = mst_vehicles.id)))
  WHERE ((lsr.dispatched_date_np_month IS NOT NULL) AND ((lsr.retail_fiscal_year)::text = '2077-78'::text))
  GROUP BY lsr.retail_fiscal_year, lsr.dispatched_date_np_month, mst_vehicles.name, mst_vehicles.rank, mst_vehicles.service_policy_id, nn.id, lsr.retail_edit_month;

-- ----------------------------
-- View structure for view_dashboard_retail_modelwise
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dashboard_retail_modelwise" AS 
 SELECT mnm.name AS month_name,
    lsr.retail_fiscal_year,
    lsr.dispatched_date_np_month,
    count(lsr.id) AS total_retail,
    mnm.rank AS month_rank,
    mst_vehicles.name AS vehicle_name,
    mst_vehicles.rank AS vehicle_rank,
    mst_vehicles.service_policy_id
   FROM (((log_stock_records lsr
     JOIN mst_nepali_month mnm ON (((lsr.dispatched_date_np_month)::integer = mnm.id)))
     LEFT JOIN msil_dispatch_records ON ((lsr.vehicle_id = msil_dispatch_records.id)))
     LEFT JOIN mst_vehicles ON ((msil_dispatch_records.vehicle_id = mst_vehicles.id)))
  WHERE (lsr.dispatched_date_np_month IS NOT NULL)
  GROUP BY mnm.name, lsr.retail_fiscal_year, lsr.dispatched_date_np_month, mnm.rank, mst_vehicles.name, mst_vehicles.rank, mst_vehicles.service_policy_id
  ORDER BY mnm.rank;

-- ----------------------------
-- View structure for view_dashboard_segmentwise_stock
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dashboard_segmentwise_stock" AS 
 SELECT mdr.deleted_at,
        CASE
            WHEN (mv.service_policy_id = 1) THEN 'Passenger'::text
            WHEN (mv.service_policy_id = 2) THEN 'Van'::text
            WHEN (mv.service_policy_id = 3) THEN 'Utility'::text
            WHEN (mv.service_policy_id = 4) THEN 'Commercial'::text
            WHEN (mv.service_policy_id = 5) THEN 'Hybrid'::text
            ELSE 'Uncatagorized'::text
        END AS segment_name,
    count(mdr.id) AS total_stock
   FROM (msil_dispatch_records mdr
     JOIN mst_vehicles mv ON ((mdr.vehicle_id = mv.id)))
  WHERE (((((mdr.current_status)::text = 'Stock'::text) OR ((mdr.current_status)::text = 'repaired stock'::text)) OR ((mdr.current_status)::text = 'damage'::text)) OR ((mdr.current_status)::text = 'Display'::text))
  GROUP BY mdr.deleted_at, mv.service_policy_id;


  CREATE OR REPLACE VIEW "public"."view_dashboard_status_customer" AS 
 SELECT view_customer_status_latest.name AS status_name,
    view_customer_status_latest.sub_status_name,
    dms_customers.dealer_id,
    dms_customers.executive_id,
    dms_customers.id,
    view_customer_status_latest.status_id,
    dms_customers.fiscal_year_id
   FROM (view_customer_status_latest
     JOIN dms_customers ON ((view_customer_status_latest.customer_id = dms_customers.id)));


CREATE OR REPLACE VIEW "public"."view_dealer_credit_list" AS 
 SELECT dms_dealers.name AS dealer_name,
    spareparts_dealer_credit.id,
    spareparts_dealer_credit.created_by,
    spareparts_dealer_credit.updated_by,
    spareparts_dealer_credit.deleted_by,
    spareparts_dealer_credit.created_at,
    spareparts_dealer_credit.updated_at,
    spareparts_dealer_credit.deleted_at,
    spareparts_dealer_credit.dealer_id,
    spareparts_dealer_credit.order_no,
    spareparts_dealer_credit.cr_dr,
    spareparts_dealer_credit.amount,
    spareparts_dealer_credit.date,
    spareparts_dealer_credit.date_nepali,
    spareparts_dealer_credit.receipt_no,
    dms_dealers.parent_id
   FROM (spareparts_dealer_credit
     JOIN dms_dealers ON ((spareparts_dealer_credit.dealer_id = dms_dealers.id)));


CREATE OR REPLACE VIEW "public"."view_dealer_sales_records" AS 
 SELECT ser_billed_parts.part_id,
    ser_billed_parts.quantity,
    ser_billed_parts.price,
    ser_billed_parts.discount_percentage,
    ser_billed_parts.final_amount,
    ser_billing_record.invoice_no,
    ser_billing_record.issue_date,
    ser_billing_record.dealer_id,
    mst_spareparts.category_id,
    mst_spareparts_category.name AS category_name,
    dms_dealers.name AS dealer_name,
    ((0.13)::double precision * ser_billed_parts.final_amount) AS vat_amount,
    (ser_billed_parts.final_amount + ((0.13)::double precision * ser_billed_parts.final_amount)) AS net_total,
    dms_dealers.incharge_id,
    mst_spareparts.part_code,
    mst_spareparts.name AS part_name,
    dms_dealers.spares_incharge_id
   FROM ((((ser_billed_parts
     LEFT JOIN ser_billing_record ON ((ser_billed_parts.billing_id = ser_billing_record.id)))
     JOIN mst_spareparts ON ((ser_billed_parts.part_id = mst_spareparts.id)))
     JOIN mst_spareparts_category ON ((mst_spareparts.category_id = mst_spareparts_category.id)))
     JOIN dms_dealers ON ((ser_billing_record.dealer_id = dms_dealers.id)))
  ORDER BY ser_billed_parts.part_id;


  CREATE OR REPLACE VIEW "public"."view_dealer_spareparts_relation" AS 
 SELECT sparepart_dealer.id,
    sparepart_dealer.created_by,
    sparepart_dealer.updated_by,
    sparepart_dealer.deleted_by,
    sparepart_dealer.created_at,
    sparepart_dealer.updated_at,
    sparepart_dealer.deleted_at,
    sparepart_dealer.name AS dealer_name,
    sparepart_dealer.incharge_id,
    sparepart_dealer.district_id,
    sparepart_dealer.mun_vdc_id,
    sparepart_dealer.city_place_id,
    sparepart_dealer.address_1,
    sparepart_dealer.address_2,
    sparepart_dealer.phone_1,
    sparepart_dealer.phone_2,
    sparepart_dealer.email,
    sparepart_dealer.fax,
    sparepart_dealer.latitude,
    sparepart_dealer.longitude,
    sparepart_dealer.remarks,
    sparepart_dealer.credit_policy,
    sparepart_dealer.parent_id,
    sparepart_dealer.prefix,
    spareparts_dealer_stock.sparepart_id,
    spareparts_dealer_stock.quantity,
    spareparts_dealer_stock.price,
    mst_spareparts.part_code,
    mst_spareparts.name AS part_name,
    mst_spareparts.latest_part_code,
    (((sparepart_dealer.name)::text || ' - '::text) || spareparts_dealer_stock.quantity) AS dealer_quantity,
    spareparts_dealer_stock.id AS dealer_stock_id
   FROM ((dms_dealers sparepart_dealer
     LEFT JOIN spareparts_dealer_stock ON ((spareparts_dealer_stock.dealer_id = sparepart_dealer.id)))
     JOIN mst_spareparts ON ((spareparts_dealer_stock.sparepart_id = mst_spareparts.id)));


CREATE OR REPLACE VIEW "public"."view_dispatch_list_spareparts" AS 
 SELECT spareparts_sparepart_order.id,
    spareparts_dispatch_list.created_by,
    spareparts_dispatch_list.updated_by,
    spareparts_dispatch_list.deleted_by,
    spareparts_dispatch_list.created_at,
    spareparts_dispatch_list.updated_at,
    spareparts_dispatch_list.deleted_at,
    spareparts_dispatch_list.dealer_id,
    spareparts_dispatch_list.order_no,
    spareparts_dispatch_list.part_code,
    spareparts_dispatch_list.dispatch_quantity,
    spareparts_dispatch_list.sparepart_id,
    mst_spareparts.name,
    mst_spareparts.price,
    spareparts_sparepart_order.order_quantity,
    (spareparts_sparepart_order.order_quantity - spareparts_dispatch_list.dispatch_quantity) AS remaining_quantity,
    spareparts_dispatch_list.id AS dispatch_list_id,
    spareparts_dispatch_list.is_billed,
    spareparts_dispatch_spareparts.billed,
    mst_spareparts.dealer_price,
    dms_dealers.name AS dealer_name,
    dms_dealers.parent_id,
    spareparts_sparepart_order.order_type
   FROM ((((spareparts_dispatch_list
     JOIN mst_spareparts ON ((spareparts_dispatch_list.sparepart_id = mst_spareparts.id)))
     JOIN spareparts_sparepart_order ON ((((spareparts_dispatch_list.sparepart_id = spareparts_sparepart_order.sparepart_id) AND (spareparts_dispatch_list.order_no = spareparts_sparepart_order.order_no)) AND (spareparts_dispatch_list.dealer_id = spareparts_sparepart_order.dealer_id))))
     LEFT JOIN spareparts_dispatch_spareparts ON (((spareparts_sparepart_order.order_no = spareparts_dispatch_spareparts.order_no) AND (spareparts_sparepart_order.id = spareparts_dispatch_spareparts.order_id))))
     JOIN dms_dealers ON ((spareparts_sparepart_order.dealer_id = dms_dealers.id)));


CREATE OR REPLACE VIEW "public"."view_back_log_spareparts" AS 
 SELECT so.order_no,
    so.order_quantity,
    so.sparepart_id,
    so.dealer_id,
    so.proforma_invoice_id,
    so.pi_generated,
    so.pi_confirmed,
    so.order_cancel,
    vdls.dispatch_quantity,
        CASE
            WHEN (((so.order_quantity - COALESCE(so.received_quantity)) - so.cancle_quantity) > 0) THEN ((so.order_quantity - COALESCE(so.received_quantity)) - so.cancle_quantity)
            WHEN (((so.order_quantity - COALESCE(so.received_quantity)) - so.cancle_quantity) = 0) THEN ((so.order_quantity - COALESCE(so.received_quantity)) - so.cancle_quantity)
            ELSE 0
        END AS required_quantity,
    so.deleted_at,
    mst_spareparts.name,
    mst_spareparts.part_code,
    mst_spareparts.price,
    dms_dealers.parent_id,
    so.dealer_confirmed,
    so.pi_number,
    so.pi_generated_date_time
   FROM (((spareparts_sparepart_order so
     LEFT JOIN view_dispatch_list_spareparts vdls ON (((so.order_no = vdls.order_no) AND (so.sparepart_id = vdls.sparepart_id))))
     JOIN mst_spareparts ON ((so.sparepart_id = mst_spareparts.id)))
     JOIN dms_dealers ON ((so.dealer_id = dms_dealers.id)));


CREATE OR REPLACE VIEW "public"."view_dealer_stock_report" AS 
 SELECT s.id,
    s.dealer_id,
    s.sparepart_id,
    s.quantity,
    s.location,
    s.lube_qty,
    d.incharge_id,
    d.name AS dealer_name,
    d.spares_incharge_id,
    d.service_incharge_id,
    ms.part_code,
    ms.name,
    ms.price AS mrp_price,
    ms.dealer_price,
        CASE
            WHEN (s.lube_qty IS NOT NULL) THEN s.lube_qty
            ELSE (s.quantity)::numeric
        END AS display_quantity,
    s.deleted_at
   FROM ((spareparts_dealer_stock s
     LEFT JOIN dms_dealers d ON ((s.dealer_id = d.id)))
     LEFT JOIN mst_spareparts ms ON ((s.sparepart_id = ms.id)));

-- ----------------------------
-- View structure for view_dealer_total_backorder
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dealer_total_backorder" AS 
 SELECT vbl.sparepart_id,
    vbl.dealer_id,
    vbl.deleted_at,
    vbl.name,
    vbl.part_code,
    vbl.price,
    vbl.parent_id,
    COALESCE(sum(vbl.dispatch_quantity), (0)::bigint) AS total_dispatched,
    sum(vbl.order_quantity) AS total_order,
        CASE
            WHEN ((sum(vbl.order_quantity) - sum(vbl.dispatch_quantity)) IS NULL) THEN sum(vbl.order_quantity)
            ELSE (sum(vbl.order_quantity) - sum(vbl.dispatch_quantity))
        END AS total_backorder,
    dms_dealers.name AS dealer_name,
    dms_dealers.spares_incharge_id
   FROM (view_back_log_spareparts vbl
     JOIN dms_dealers ON ((vbl.dealer_id = dms_dealers.id)))
  WHERE ((((vbl.dealer_confirmed <> 0) AND (vbl.order_cancel = 0)) AND (vbl.pi_generated = 1)) AND (vbl.pi_confirmed = 1))
  GROUP BY vbl.sparepart_id, vbl.dealer_id, vbl.deleted_at, vbl.name, vbl.part_code, vbl.price, vbl.parent_id, dms_dealers.name, dms_dealers.spares_incharge_id;

-- ----------------------------
-- View structure for view_dealers
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dealers" AS 
 SELECT d.id,
    d.created_by,
    d.updated_by,
    d.deleted_by,
    d.created_at,
    d.updated_at,
    d.deleted_at,
    d.name,
    d.incharge_id,
    d.district_id,
    d.mun_vdc_id,
    d.city_place_id,
    d.address_1,
    d.address_2,
    d.phone_1,
    d.phone_2,
    d.email,
    d.fax,
    d.latitude,
    d.longitude,
    d.remarks,
    c.district_name,
    c.mun_vdc_name,
    c.name AS city_name,
    u.username AS incharge_name,
    d.rank,
    d.spares_incharge_id,
    d.service_incharge_id,
    spares.username AS spares_incharge,
    service.username AS service_incharge,
    d.assistant_incharge_id,
    d.dealer_type,
    d.show_website
   FROM ((((dms_dealers d
     LEFT JOIN view_city_places c ON ((c.id = d.city_place_id)))
     LEFT JOIN aauth_users u ON ((d.incharge_id = u.id)))
     LEFT JOIN aauth_users spares ON ((d.spares_incharge_id = spares.id)))
     LEFT JOIN aauth_users service ON ((d.service_incharge_id = service.id)));


CREATE OR REPLACE VIEW "public"."view_detail_credit_debit" AS 
 SELECT sdc.id,
    sdc.deleted_at,
    sdc.dealer_id,
    sdc.order_no,
    sdc.amount,
    sdc.date,
    sdc.date_nepali,
    sdc.receipt_no,
        CASE
            WHEN ((sdc.cr_dr)::text = 'CREDIT'::text) THEN sdc.amount
            ELSE NULL::numeric
        END AS credit,
        CASE
            WHEN ((sdc.cr_dr)::text = 'DEBIT'::text) THEN sdc.amount
            ELSE NULL::numeric
        END AS debit,
    sdc.created_by,
    sdc.updated_by,
    sdc.created_at,
    sdc.updated_at,
    sdc.deleted_by,
    sdc.cr_dr,
    sdc.particular,
    sdc.bill_no,
    sdc.cash_card
   FROM spareparts_dealer_credit sdc;


CREATE OR REPLACE VIEW "public"."view_dispatch_dealers" AS 
 SELECT c.id AS dispatch_id,
    c.created_by AS dispatch_created_by,
    c.created_at AS dispatch_created_at,
    c.vehicle_id AS dispatch_vehicle_id,
    c.stock_yard_id,
    c.driver_name,
    c.driver_address,
    c.driver_contact,
    c.driver_liscense_no,
    c.dealer_id,
    c.received_status,
    c.image_name,
    c.dispatched_date,
    c.dealer_order_id,
    d.id,
    d.date_of_order,
    d.date_of_delivery,
    d.delivery_lead_time,
    d.pdi_status,
    d.date_of_retail,
    d.retail_lead_time,
    d.created_by,
    d.updated_by,
    d.created_at,
    d.updated_at,
    d.payment_status,
    d.vehicle_id,
    d.variant_id,
    d.color_id,
    d.received_date,
    d.challan_return_image,
    c.deleted_at,
    v.name AS vehicle_name,
    v1.name AS variant_name,
    c1.name AS color_name,
    c.image,
    c.remarks,
    c.accessories,
    au.fullname AS dispatched_by
   FROM (((((log_dispatch_dealer c
     RIGHT JOIN log_dealer_order d ON ((c.dealer_order_id = d.id)))
     RIGHT JOIN mst_vehicles v ON ((d.vehicle_id = v.id)))
     RIGHT JOIN mst_variants v1 ON ((d.variant_id = v1.id)))
     RIGHT JOIN mst_colors c1 ON ((d.color_id = c1.id)))
     RIGHT JOIN aauth_users au ON ((c.created_by = au.id)));

-- ----------------------------
-- View structure for view_dispatch_detail_report
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dispatch_detail_report" AS 
 SELECT sds.grn_received_date,
    sds.dispatched_quantity,
    sds.dispatched_date,
    sds.dispatched_date_nepali,
    sso.order_type,
    sds.bill_no,
    sds.dealer_id,
    sds.month_np,
    sds.deleted_at
   FROM (spareparts_dispatch_spareparts sds
     JOIN spareparts_sparepart_order sso ON ((sds.order_id = sso.id)));

-- ----------------------------
-- View structure for view_dispatch_list_spareparts
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dispatch_list_spareparts" AS 
 SELECT spareparts_sparepart_order.id,
    spareparts_dispatch_list.created_by,
    spareparts_dispatch_list.updated_by,
    spareparts_dispatch_list.deleted_by,
    spareparts_dispatch_list.created_at,
    spareparts_dispatch_list.updated_at,
    spareparts_dispatch_list.deleted_at,
    spareparts_dispatch_list.dealer_id,
    spareparts_dispatch_list.order_no,
    spareparts_dispatch_list.part_code,
    spareparts_dispatch_list.dispatch_quantity,
    spareparts_dispatch_list.sparepart_id,
    mst_spareparts.name,
    mst_spareparts.price,
    spareparts_sparepart_order.order_quantity,
    (spareparts_sparepart_order.order_quantity - spareparts_dispatch_list.dispatch_quantity) AS remaining_quantity,
    spareparts_dispatch_list.id AS dispatch_list_id,
    spareparts_dispatch_list.is_billed,
    spareparts_dispatch_spareparts.billed,
    mst_spareparts.dealer_price,
    dms_dealers.name AS dealer_name,
    dms_dealers.parent_id,
    spareparts_sparepart_order.order_type
   FROM ((((spareparts_dispatch_list
     JOIN mst_spareparts ON ((spareparts_dispatch_list.sparepart_id = mst_spareparts.id)))
     JOIN spareparts_sparepart_order ON ((((spareparts_dispatch_list.sparepart_id = spareparts_sparepart_order.sparepart_id) AND (spareparts_dispatch_list.order_no = spareparts_sparepart_order.order_no)) AND (spareparts_dispatch_list.dealer_id = spareparts_sparepart_order.dealer_id))))
     LEFT JOIN spareparts_dispatch_spareparts ON (((spareparts_sparepart_order.order_no = spareparts_dispatch_spareparts.order_no) AND (spareparts_sparepart_order.id = spareparts_dispatch_spareparts.order_id))))
     JOIN dms_dealers ON ((spareparts_sparepart_order.dealer_id = dms_dealers.id)));

-- ----------------------------
-- View structure for view_dispatch_spareparts
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dispatch_spareparts" AS 
 SELECT ds.id,
    ds.created_at,
    ds.updated_at,
    ds.deleted_at,
    ds.order_no AS order_id,
    ds.dispatched_quantity,
    ds.dispatched_date,
    ds.dispatched_date_nepali,
    ds.proforma_invoice_id,
    ds.pick_count,
    so.id AS sparepart_order_id,
    so.order_quantity,
    ds.foc,
    ds.billed,
    ds.stock_id AS dis_stock_id,
    ds.bill_no,
    ds.grn_received_date,
    dms_dealers.name AS dealer_name,
    dms_dealers.spares_incharge_id,
    dms_dealers.service_incharge_id,
    mst_spareparts.part_code,
    mst_spareparts.name,
    mst_spareparts.price,
    mst_spareparts.dealer_price,
    spareparts_sparepart_stock.quantity AS stock_quantity,
    ds.dealer_id,
    mst_spareparts.id AS sparepart_id,
    ds.vor_percentage,
    ds.discount_percentage,
    so.pi_number,
    ((ds.dispatched_quantity)::numeric * mst_spareparts.dealer_price) AS total_amount,
    ds.year_np,
    ds.month_np,
    ds.created_by,
    aauth_users.username
   FROM (((((spareparts_dispatch_spareparts ds
     LEFT JOIN spareparts_sparepart_order so ON ((ds.order_id = so.id)))
     LEFT JOIN dms_dealers ON ((ds.dealer_id = dms_dealers.id)))
     LEFT JOIN spareparts_sparepart_stock ON ((ds.stock_id = spareparts_sparepart_stock.id)))
     LEFT JOIN mst_spareparts ON ((spareparts_sparepart_stock.sparepart_id = mst_spareparts.id)))
     JOIN aauth_users ON ((ds.created_by = aauth_users.id)));

-- ----------------------------
-- View structure for view_distinct_msil_order
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_distinct_msil_order" AS 
 SELECT spareparts_msil_order.order_no AS msil_order_no,
    spareparts_msil_order.deleted_at,
    spareparts_msil_order.in_stock
   FROM spareparts_msil_order
  GROUP BY spareparts_msil_order.in_stock, spareparts_msil_order.order_no, spareparts_msil_order.deleted_at;

-- ----------------------------
-- View structure for view_district_mvs
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_district_mvs" AS 
 SELECT t1.id,
    t1.created_by,
    t1.updated_by,
    t1.deleted_by,
    t1.created_at,
    t1.updated_at,
    t1.deleted_at,
    t1.code,
    t1.name,
    t1.parent_id,
    t2.code AS parent_code,
    t2.name AS parent_name,
    t1.type
   FROM (mst_district_mvs t1
     JOIN mst_district_mvs t2 ON ((t1.parent_id = t2.id)));

-- ----------------------------
-- View structure for view_dms_events
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dms_events" AS 
 SELECT e.id,
    e.created_by,
    e.updated_by,
    e.deleted_by,
    e.created_at,
    e.updated_at,
    e.deleted_at,
    e.dealer_id,
    e.name,
    e.start_date_en,
    e.start_date_np,
    e.end_date_en,
    e.end_date_np,
    e.active,
    d.name AS dealer_name,
    e.description
   FROM (dms_events e
     LEFT JOIN dms_dealers d ON ((d.id = e.dealer_id)));

-- ----------------------------
-- View structure for view_dms_vehicles
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dms_vehicles" AS 
 SELECT dv.id,
    dv.created_by,
    dv.updated_by,
    dv.deleted_by,
    dv.created_at,
    dv.updated_at,
    dv.deleted_at,
    dv.vehicle_id,
    dv.variant_id,
    dv.color_id,
    ve.name AS vehicle_name,
    va.name AS variant_name,
    ((((co.name)::text || ' ('::text) || (co.code)::text) || ')'::text) AS color_name,
    dv.price,
    co.name AS color_name_only,
    co.code AS color_code,
    ve.rank,
    ve.for_sales,
    dv.rank AS sequence
   FROM ((((dms_vehicles dv
     JOIN ( SELECT max(dms_vehicles.created_at) AS latest_created,
            dms_vehicles.vehicle_id,
            dms_vehicles.variant_id,
            dms_vehicles.color_id
           FROM dms_vehicles
          GROUP BY dms_vehicles.vehicle_id, dms_vehicles.variant_id, dms_vehicles.color_id) dv1 ON (((((dv1.vehicle_id = dv.vehicle_id) AND (dv1.variant_id = dv.variant_id)) AND (dv1.color_id = dv.color_id)) AND (dv1.latest_created = dv.created_at))))
     LEFT JOIN mst_vehicles ve ON ((dv.vehicle_id = ve.id)))
     LEFT JOIN mst_variants va ON ((dv.variant_id = va.id)))
     LEFT JOIN mst_colors co ON ((dv.color_id = co.id)));

-- ----------------------------
-- View structure for view_dms_vehicles_service
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dms_vehicles_service" AS 
 SELECT dv.id,
    dv.created_by,
    dv.updated_by,
    dv.deleted_by,
    dv.created_at,
    dv.updated_at,
    dv.deleted_at,
    dv.vehicle_id,
    dv.variant_id,
    dv.color_id,
    ve.name AS vehicle_name,
    va.name AS variant_name,
    ((((co.name)::text || ' ('::text) || (co.code)::text) || ')'::text) AS color_name,
    dv.price,
    co.name AS color_name_only,
    co.code AS color_code,
    ve.rank,
    ve.for_sales,
    dv.rank AS sequence
   FROM ((((dms_vehicles dv
     LEFT JOIN ( SELECT max(dms_vehicles.created_at) AS latest_created,
            dms_vehicles.vehicle_id,
            dms_vehicles.variant_id,
            dms_vehicles.color_id
           FROM dms_vehicles
          GROUP BY dms_vehicles.vehicle_id, dms_vehicles.variant_id, dms_vehicles.color_id) dv1 ON (((((dv1.vehicle_id = dv.vehicle_id) AND (dv1.variant_id = dv.variant_id)) AND (dv1.color_id = dv.color_id)) AND (dv1.latest_created = dv.created_at))))
     LEFT JOIN mst_vehicles ve ON ((dv.vehicle_id = ve.id)))
     LEFT JOIN mst_variants va ON ((dv.variant_id = va.id)))
     LEFT JOIN mst_colors co ON ((dv.color_id = co.id)));


CREATE OR REPLACE VIEW "public"."view_employee_contacts" AS 
 SELECT ec.id,
    ec.created_by,
    ec.updated_by,
    ec.deleted_by,
    ec.created_at,
    ec.updated_at,
    ec.deleted_at,
    ec.employee_id,
    ec.name,
    ec.relation_id,
    ec.home,
    ec.work,
    ec.mobile,
    r.name AS relation_name
   FROM (dms_employee_contacts ec
     JOIN mst_relations r ON ((ec.relation_id = r.id)));


CREATE OR REPLACE VIEW "public"."view_employee_to_workshop" AS 
 SELECT dms_employees.id,
    dms_employees.deleted_at,
    dms_employees.deleted_by,
    dms_employees.user_id,
    dms_employees.first_name,
    dms_employees.dealer_id,
    dms_employees.employee_type,
    mst_workshop.id AS workshop_id,
    mst_workshop.name,
    mst_workshop.address1,
    mst_workshop.address2,
    mst_workshop.address3,
    mst_workshop.phone1,
    mst_workshop.phone2,
    mst_workshop.office_address,
    mst_workshop.office_phone
   FROM (dms_employees
     LEFT JOIN mst_workshop ON ((dms_employees.dealer_id = mst_workshop.id)))
  WHERE (dms_employees.employee_type = 2);


CREATE OR REPLACE VIEW "public"."view_floor_supervisor_adviced" AS 
 SELECT ser_floor_supervisor_advice.jobcard_group,
    ser_floor_supervisor_advice.dealer_id
   FROM ser_floor_supervisor_advice
  GROUP BY ser_floor_supervisor_advice.dealer_id, ser_floor_supervisor_advice.jobcard_group;


CREATE OR REPLACE VIEW "public"."view_fms_calculation" AS 
 SELECT ss.sparepart_id,
    ss.quantity,
    ss.location,
    ss.stockyard_id,
    ss.deleted_at,
    sum(COALESCE(sds.dispatched_quantity, 0)) AS total,
    mst_spareparts.part_code,
    mst_spareparts.alternate_part_code,
    mst_spareparts.name AS part_name,
    mst_spareparts.latest_part_code,
    mst_spareparts.model,
    mst_spareparts.moq,
    mst_spareparts.category_id,
    mst_spareparts.price,
    ss.id AS stock_id
   FROM ((spareparts_sparepart_stock ss
     LEFT JOIN spareparts_dispatch_spareparts sds ON ((ss.id = sds.stock_id)))
     JOIN mst_spareparts ON ((ss.sparepart_id = mst_spareparts.id)))
  GROUP BY ss.deleted_at, ss.sparepart_id, ss.location, ss.quantity, ss.stockyard_id, mst_spareparts.part_code, mst_spareparts.alternate_part_code, mst_spareparts.name, mst_spareparts.moq, mst_spareparts.category_id, mst_spareparts.model, mst_spareparts.price, mst_spareparts.latest_part_code, sds.stock_id, ss.id;

-- ----------------------------
-- View structure for view_foc_details
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_foc_details" AS 
 SELECT sales_foc_document.id,
    sales_foc_document.created_by,
    sales_foc_document.updated_by,
    sales_foc_document.deleted_by,
    sales_foc_document.created_at,
    sales_foc_document.updated_at,
    sales_foc_document.deleted_at,
    sales_foc_document.customer_id,
    sales_foc_document.accessories_id,
    sales_foc_document.free_servicing,
    sales_foc_document.name_transfer,
    sales_foc_document.fuel,
    sales_foc_document.road_tax,
    dms_customers.first_name,
    dms_customers.middle_name,
    dms_customers.last_name,
    dms_customers.vehicle_id,
    dms_customers.variant_id,
    dms_customers.color_id,
    sales_vehicle_process.msil_dispatch_id,
    msil_dispatch_records.engine_no,
    msil_dispatch_records.chass_no,
    mst_colors.name AS color_name,
    mst_colors.code,
    mst_variants.name AS variant_name,
    mst_vehicles.name AS vehicle_name,
    sales_foc_request.foc_approved_part,
    sales_foc_request.approved_date,
    sales_foc_request.approved_date_nep,
    sales_foc_request.request_date_nep,
    sales_foc_request.request_date,
    sales_foc_request.foc_request_part,
    mst_vehicles.firm_id,
    msil_dispatch_records.company_name AS firm_name,
    sales_foc_request.id AS foc_request_id
   FROM ((((((((sales_foc_document
     LEFT JOIN dms_customers ON ((sales_foc_document.customer_id = dms_customers.id)))
     LEFT JOIN sales_vehicle_process ON ((sales_vehicle_process.customer_id = dms_customers.id)))
     LEFT JOIN msil_dispatch_records ON ((sales_vehicle_process.msil_dispatch_id = msil_dispatch_records.id)))
     JOIN mst_colors ON ((dms_customers.color_id = mst_colors.id)))
     JOIN mst_vehicles ON ((dms_customers.vehicle_id = mst_vehicles.id)))
     JOIN mst_variants ON ((dms_customers.variant_id = mst_variants.id)))
     JOIN sales_foc_request ON ((sales_foc_document.customer_id = sales_foc_request.customer_id)))
     JOIN mst_firms ON ((mst_vehicles.firm_id = mst_firms.id)));

-- ----------------------------
-- View structure for view_foc_dropdown
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_foc_dropdown" AS 
 SELECT foc.customer_id,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
    foc.id,
    foc.deleted_at,
    foc.billed
   FROM (dms_customers c
     JOIN sales_foc_document foc ON ((foc.customer_id = c.id)));

-- ----------------------------
-- View structure for view_foc_request
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_foc_request" AS 
 SELECT dc.vehicle_id,
    dc.variant_id,
    mve.name AS vehicle_name,
    mva.name AS variant_name,
    sfr.id,
    sfr.created_by,
    sfr.updated_by,
    sfr.deleted_by,
    sfr.created_at,
    sfr.updated_at,
    sfr.deleted_at,
    sfr.customer_id,
    sfr.foc_request_part,
    sfr.foc_approved_part,
    sfr.request_date,
    sfr.request_date_nep,
    sfr.approved_date,
    sfr.approved_date_nep,
    sfr.foc_id,
    dc.first_name,
    dc.last_name,
    concat(dc.first_name, ' ', dc.last_name) AS full_name,
    dc.dealer_id,
    dms_dealers.name AS dealer_name,
    sfr.approval_type
   FROM ((((sales_foc_request sfr
     JOIN dms_customers dc ON ((sfr.customer_id = dc.id)))
     JOIN mst_variants mva ON ((dc.variant_id = mva.id)))
     JOIN mst_vehicles mve ON ((dc.vehicle_id = mve.id)))
     JOIN dms_dealers ON ((dc.dealer_id = dms_dealers.id)));

-- ----------------------------
-- View structure for view_follow_up_report_view
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_follow_up_report_view" AS 
 SELECT dms_customer_followups.id,
    dms_customer_followups.created_by,
    dms_customer_followups.updated_by,
    dms_customer_followups.deleted_by,
    dms_customer_followups.created_at,
    dms_customer_followups.updated_at,
    dms_customer_followups.deleted_at,
    dms_customer_followups.customer_id,
    dms_customer_followups.executive_id,
    dms_customer_followups.followup_date_en,
    dms_customer_followups.followup_date_np,
    dms_customer_followups.followup_mode,
    dms_customer_followups.followup_status,
    dms_customer_followups.followup_notes,
    dms_customer_followups.next_followup,
    dms_customer_followups.next_followup_date_en,
    dms_customer_followups.next_followup_date_np,
    dms_customers.dealer_id,
    dms_customers.vehicle_id,
    dms_customers.variant_id,
    dms_customers.color_id,
    dms_customers.inquiry_date_en,
    dms_customers.inquiry_date_np,
    mst_variants.name AS variant_name,
    dms_dealers.name AS dealer_name,
    mst_colors.name AS color_name,
    mst_vehicles.name AS vehicle_name,
    dms_customer_followups.status
   FROM (((((dms_customer_followups
     LEFT JOIN dms_customers ON ((dms_customer_followups.customer_id = dms_customers.id)))
     LEFT JOIN mst_colors ON ((dms_customers.color_id = mst_colors.id)))
     LEFT JOIN mst_variants ON ((dms_customers.variant_id = mst_variants.id)))
     JOIN dms_dealers ON ((dms_customers.dealer_id = dms_dealers.id)))
     JOIN mst_vehicles ON ((dms_customers.vehicle_id = mst_vehicles.id)));


CREATE OR REPLACE VIEW "public"."view_followup_schedule_app" AS 
 SELECT cf.id,
    cf.created_by,
    cf.updated_by,
    cf.deleted_by,
    cf.created_at,
    cf.updated_at,
    cf.deleted_at,
    cf.customer_id,
    cf.executive_id,
    cf.followup_date_en,
    cf.followup_date_np,
    cf.followup_mode,
    cf.followup_status,
    cf.followup_notes,
    cf.next_followup,
    cf.next_followup_date_en,
    cf.next_followup_date_np,
    cf.status,
    v.name AS vehicle_name,
    va.name AS variant_name,
    c.variant_id,
    c.vehicle_id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.dealer_id,
    dms_dealers.name AS dealer_name,
        CASE
            WHEN ((e.middle_name)::text <> ''::text) THEN (((((e.first_name)::text || ' '::text) || (e.middle_name)::text) || ' '::text) || (e.last_name)::text)
            ELSE (((e.first_name)::text || ' '::text) || (e.last_name)::text)
        END AS executive_name,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS customer_name,
    c.inquiry_no,
    (
        CASE
            WHEN (m11.status_id = 4) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 5) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 6) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 7) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 8) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 9) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 10) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 11) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 12) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 13) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 14) THEN 'Retail Finance'::character varying
            ELSE m11.name
        END)::text AS status_name
   FROM ((((((dms_customer_followups cf
     LEFT JOIN dms_customers c ON ((cf.customer_id = c.id)))
     LEFT JOIN mst_vehicles v ON ((c.vehicle_id = v.id)))
     LEFT JOIN mst_variants va ON ((c.variant_id = va.id)))
     LEFT JOIN dms_employees e ON ((c.executive_id = e.id)))
     LEFT JOIN dms_dealers ON ((c.dealer_id = dms_dealers.id)))
     LEFT JOIN view_customer_status_latest m11 ON ((c.id = m11.customer_id)));


CREATE OR REPLACE VIEW "public"."view_gatepass" AS 
 SELECT ser_gatepass.id,
    ser_gatepass.created_by,
    ser_gatepass.updated_by,
    ser_gatepass.deleted_by,
    ser_gatepass.created_at,
    ser_gatepass.updated_at,
    ser_gatepass.deleted_at,
    ser_gatepass.jobcard_id,
    ser_gatepass.date,
    ser_gatepass.counter_sales_id,
    ser_gatepass.gatepass_no,
    ser_gatepass.dealer_id,
    ser_billing_record.invoice_no
   FROM (ser_gatepass
     JOIN ser_billing_record ON (((ser_gatepass.jobcard_id = ser_billing_record.jobcard_group) AND (ser_gatepass.dealer_id = ser_billing_record.dealer_id))));

-- ----------------------------
-- View structure for view_gatepass_countersales
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_gatepass_countersales" AS 
 SELECT ser_gatepass.id,
    ser_gatepass.created_by,
    ser_gatepass.updated_by,
    ser_gatepass.deleted_by,
    ser_gatepass.created_at,
    ser_gatepass.updated_at,
    ser_gatepass.deleted_at,
    ser_gatepass.jobcard_id,
    ser_gatepass.date,
    ser_gatepass.counter_sales_id,
    ser_gatepass.gatepass_no,
    ser_gatepass.dealer_id,
    ser_billing_record.invoice_no
   FROM (ser_gatepass
     JOIN ser_billing_record ON (((ser_gatepass.counter_sales_id = ser_billing_record.counter_sales_id) AND (ser_gatepass.dealer_id = ser_billing_record.dealer_id))));

-- ----------------------------
-- View structure for view_group_billing_part
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_group_billing_part" AS 
 SELECT bp.billing_id,
    sum(bp.final_amount) AS total
   FROM ser_billed_parts bp
  GROUP BY bp.billing_id;

-- ----------------------------
-- View structure for view_group_permissions
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_group_permissions" AS 
 SELECT gp.group_id,
    gp.perm_id,
    perm.name AS permission,
    grp.name AS "group"
   FROM ((aauth_group_permissions gp
     JOIN aauth_groups grp ON ((grp.id = gp.group_id)))
     JOIN aauth_permissions perm ON ((perm.id = gp.perm_id)));

-- ----------------------------
-- View structure for view_grouped_ccd_jobcards
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_grouped_ccd_jobcards" AS 
 SELECT jc.vehicle_id,
    jc.jobcard_group,
    jc.vehicle_no,
    jc.chassis_no,
    jc.engine_no,
    jc.party_id,
    jc.dealer_id,
    (jc.created_at)::date AS created_at
   FROM ser_job_cards jc
  GROUP BY jc.vehicle_id, jc.jobcard_group, jc.party_id, jc.vehicle_no, jc.chassis_no, jc.engine_no, jc.dealer_id, (jc.created_at)::date;

-- ----------------------------
-- View structure for view_grouped_msil_order
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_grouped_msil_order" AS 
 SELECT mf.name AS firm_name,
    md.order_id,
    md.deleted_at,
    md.firm_id,
    mf.prefix,
    concat(mf.prefix, '-', md.order_id) AS order_no
   FROM ((((msil_orders md
     JOIN mst_vehicles mv ON ((md.vehicle_id = mv.id)))
     JOIN mst_variants mva ON ((md.variant_id = mva.id)))
     JOIN mst_colors mc ON ((md.color_id = mc.id)))
     JOIN mst_firms mf ON ((md.firm_id = mf.id)))
  GROUP BY md.deleted_at, md.order_id, mf.name, md.firm_id, mf.prefix;

-- ----------------------------
-- View structure for view_grouped_outside_works
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_grouped_outside_works" AS 
 SELECT so.jobcard_group,
    sum(so.amount) AS final_outside_work
   FROM ser_outside_work so
  WHERE (so.deleted_at IS NULL)
  GROUP BY so.jobcard_group;

-- ----------------------------
-- View structure for view_grouped_ow_margin
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_grouped_ow_margin" AS 
 SELECT bj.billing_id,
    sum(sj.outsidework_margin) AS ow_margin
   FROM (ser_billed_jobs bj
     LEFT JOIN mst_service_jobs sj ON ((bj.job_id = sj.id)))
  GROUP BY bj.billing_id;

-- ----------------------------
-- View structure for view_grouped_ow_work
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_grouped_ow_work" AS 
 SELECT ow.jobcard_group,
    sum(ow.total_amount) AS total_amount
   FROM ser_outside_work ow
  WHERE (ow.deleted_at IS NULL)
  GROUP BY ow.jobcard_group;

-- ----------------------------
-- View structure for view_grouped_spareparts_order
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_grouped_spareparts_order" AS 
 SELECT DISTINCT so.order_no,
    so.dealer_id,
    mst.name AS dealer_name,
    so.deleted_at,
    so.order_cancel,
    mst.prefix,
    concat(mst.prefix, '-', so.order_no) AS order_concat,
    so.pi_generated,
    so.dealer_confirmed,
    so.pi_confirmed,
    so.order_date,
    so.order_date_np,
    mst.incharge_id,
    mst.spares_incharge_id,
    so.dispatch_mode,
    so.order_type,
        CASE
            WHEN (so.pi_generated = 1) THEN 'YES'::text
            ELSE 'NO'::text
        END AS pi_status
   FROM (spareparts_sparepart_order so
     LEFT JOIN dms_dealers mst ON ((so.dealer_id = mst.id)))
  GROUP BY so.order_cancel, so.order_no, so.dealer_id, mst.name, so.deleted_at, mst.prefix, so.pi_generated, so.dealer_confirmed, so.pi_confirmed, so.order_date, so.order_date_np, mst.incharge_id, mst.spares_incharge_id, so.dispatch_mode, so.order_type;


CREATE OR REPLACE VIEW "public"."view_job_description" AS 
 SELECT string_agg((mst_service_jobs.description)::text, ', '::text) AS job_desc,
    ser_billed_jobs.billing_id
   FROM (ser_billed_jobs
     LEFT JOIN mst_service_jobs ON ((ser_billed_jobs.job_id = mst_service_jobs.id)))
  GROUP BY ser_billed_jobs.billing_id;


CREATE OR REPLACE VIEW "public"."view_jobcard_desc" AS 
 SELECT string_agg((mst_service_jobs.description)::text, ', '::text) AS job_desc,
    ser_job_cards.jobcard_group
   FROM (ser_job_cards
     LEFT JOIN mst_service_jobs ON ((ser_job_cards.job_id = mst_service_jobs.id)))
  GROUP BY ser_job_cards.jobcard_group;


CREATE OR REPLACE VIEW "public"."view_jobcard_material_scan_group" AS 
 SELECT ser_material_scan.jobcard_group,
    (now())::date AS issue_date
   FROM ser_material_scan
  GROUP BY ser_material_scan.jobcard_group;


CREATE OR REPLACE VIEW "public"."view_left_spareparts" AS 
 SELECT sum(d.dispatched_quantity) AS total,
    d.order_id,
    spo.order_quantity,
    (spo.order_quantity - sum(d.dispatched_quantity)) AS remaining,
    d.proforma_invoice_id,
    d.part_code,
    d.name,
    d.price,
    d.deleted_at
   FROM (view_dispatch_spareparts d
     LEFT JOIN spareparts_sparepart_order spo ON ((spo.id = d.order_id)))
  GROUP BY d.order_id, spo.order_quantity, d.proforma_invoice_id, d.part_code, d.name, d.price, d.deleted_at;


CREATE OR REPLACE VIEW "public"."view_log_damage_latest" AS 
 SELECT dms_cs0.dispatch_id,
    dms_cs0.id,
    dms_cs0.chass_no
   FROM (log_damage dms_cs0
     JOIN ( SELECT dms_cs1.dispatch_id,
            max(dms_cs1.created_at) AS latest_date
           FROM log_damage dms_cs1
          GROUP BY dms_cs1.dispatch_id) tbl ON (((tbl.dispatch_id = dms_cs0.dispatch_id) AND (tbl.latest_date = dms_cs0.created_at))));

-- ----------------------------
-- View structure for view_log_dealer_dispatch
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_log_dealer_dispatch" AS 
 SELECT ldd.id,
    ldd.created_by,
    ldd.updated_by,
    ldd.deleted_by,
    ldd.created_at,
    ldd.updated_at,
    ldd.deleted_at,
    ldd.vehicle_id,
    ldd.dealer_id,
    ldd.received_status,
    ldd.dispatched_date,
    ldd.dealer_order_id,
    ldd.dispatched_date_np,
    ldd.dispatched_date_np_month,
    ldd.dispatched_date_np_year,
    ldd.received_date,
    ldd.received_date_nep,
    ldd.edit_month_np,
    dd.name AS dealer_name
   FROM (log_dispatch_dealer ldd
     JOIN dms_dealers dd ON ((ldd.dealer_id = dd.id)));

-- ----------------------------
-- View structure for view_log_dealer_order
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_log_dealer_order" AS 
 SELECT ldo.date_of_order,
    ldo.vehicle_id,
    ldo.variant_id,
    ldo.color_id,
    ldo.payment_method,
    ldo.associated_value_payment,
    ldo.quantity,
    ldo.order_id,
    ldo.dealer_id,
    ldo.year,
    ldo.payment_status,
    mve.name AS vehicle_name,
    mva.name AS variant_name,
    mc.name AS color_name,
    ldo.created_by,
    COALESCE(d.total_dispatched, (0)::bigint) AS total_dispatched,
    dms_dealers.incharge_id,
    ldo.credit_control_approval,
        CASE
            WHEN (ldo.credit_control_approval = 0) THEN 'Not Approved'::text
            ELSE 'Approved'::text
        END AS credit_approval,
    concat(ldo.payment_method, '-', ldo.associated_value_payment) AS payment_detail,
    dms_dealers.name AS dealer_name,
    COALESCE(log_d.total_received, (0)::bigint) AS total_received,
    COALESCE(count(ldo.cancel_date), (0)::bigint) AS total_cancel,
    (ldo.quantity - COALESCE(count(ldo.cancel_date), (0)::bigint)) AS remaining_quantity,
    ldo.cancel_date_np,
    (('now'::text)::date - ldo.credit_approve_date) AS logistic_age,
    (('now'::text)::date - ldo.date_of_order) AS credit_control_age,
    ldo.order_month_id,
    mst_nepali_month.name AS nepali_month
   FROM (((((((log_dealer_order ldo
     JOIN mst_vehicles mve ON ((ldo.vehicle_id = mve.id)))
     JOIN mst_variants mva ON ((ldo.variant_id = mva.id)))
     JOIN mst_colors mc ON ((ldo.color_id = mc.id)))
     LEFT JOIN ( SELECT lo.order_id,
            count(ldd.dealer_order_id) AS total_dispatched
           FROM (log_dispatch_dealer ldd
             JOIN log_dealer_order lo ON ((ldd.dealer_order_id = lo.id)))
          GROUP BY lo.order_id) d ON ((d.order_id = ldo.order_id)))
     JOIN dms_dealers ON ((ldo.dealer_id = dms_dealers.id)))
     LEFT JOIN ( SELECT log_do.order_id,
            count(log_dd.received_date) AS total_received
           FROM (log_dispatch_dealer log_dd
             JOIN log_dealer_order log_do ON ((log_dd.dealer_order_id = log_do.id)))
          WHERE (log_dd.received_date IS NOT NULL)
          GROUP BY log_do.order_id) log_d ON ((log_d.order_id = ldo.order_id)))
     LEFT JOIN mst_nepali_month ON ((ldo.order_month_id = mst_nepali_month.id)))
  GROUP BY ldo.date_of_order, ldo.created_by, ldo.vehicle_id, ldo.variant_id, ldo.color_id, ldo.payment_method, ldo.associated_value_payment, ldo.quantity, ldo.order_id, ldo.dealer_id, ldo.year, ldo.payment_status, mve.name, mva.name, mc.name, d.total_dispatched, dms_dealers.incharge_id, ldo.credit_control_approval, dms_dealers.name, log_d.total_received, ldo.cancel_date_np, ldo.credit_approve_date, mst_nepali_month.name, ldo.order_month_id;

-- ----------------------------
-- View structure for view_log_dealer_report
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_log_dealer_report" AS 
 SELECT ldo.id,
    ldo.date_of_order,
    ldo.pdi_status,
    ldo.created_by,
    ldo.updated_by,
    ldo.created_at,
    ldo.updated_at,
    ldo.payment_status,
    ldo.vehicle_id,
    ldo.variant_id,
    ldo.color_id,
    ldo.received_date,
    ldo.challan_return_image,
    ldo.vehicle_main_id,
    ldo.order_id,
    ldo.quantity,
    ldo.payment_method,
    ldo.associated_value_payment,
    ldo.dealer_id,
    ldo.year,
    ldo.date_of_retail_np,
    ldo.date_of_retail_np_month,
    ldo.date_of_retail_np_year,
    ldo.cancel_quantity,
    ldo.cancel_date,
    ldo.cancel_date_np,
    ldo.credit_control_approval,
    ldo.credit_approve_date,
    ldo.credit_approve_date_np,
    ldo.order_month_id,
    ldo.deleted_at,
    ldo.deleted_by,
    ldo.cancel_order_status,
    cs.remarks,
    cs.date,
    cs.date_np,
    ldo.is_ktm_dealer,
    mv.name AS vehicle_name,
    mva.name AS variant_name,
    mc.name AS color_name,
    mc.code AS color_code,
    mnm.name AS order_month,
    dd.name AS dealer_name,
    dd.rank AS dealer_rank
   FROM ((((((log_dealer_order ldo
     LEFT JOIN sales_credit_control_decision cs ON ((ldo.id = cs.order_id)))
     JOIN mst_vehicles mv ON ((ldo.vehicle_id = mv.id)))
     JOIN mst_variants mva ON ((ldo.variant_id = mva.id)))
     JOIN mst_colors mc ON ((ldo.color_id = mc.id)))
     LEFT JOIN mst_nepali_month mnm ON ((ldo.order_month_id = mnm.id)))
     JOIN dms_dealers dd ON ((ldo.dealer_id = dd.id)));

-- ----------------------------
-- View structure for view_log_dispatch_report
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_log_dispatch_report" AS 
 SELECT mdr.id,
    mdr.created_at,
    mdr.deleted_at,
    mdr.vehicle_id,
    mdr.variant_id,
    mdr.color_id,
    mdr.dispatch_date,
    mdr.month,
    mdr.year,
    mdr.invoice_no,
    mdr.transit,
    mdr.border,
    mdr.engine_no,
    mdr.chass_no,
    mdr.indian_stock_yard,
    mdr.indian_custom,
    mdr.nepal_custom,
    lsr.stock_yard_id,
    mst_stock_yards.name,
    lsr.reached_date,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name
   FROM (((((msil_dispatch_records mdr
     LEFT JOIN log_stock_records lsr ON ((mdr.id = lsr.vehicle_id)))
     LEFT JOIN mst_stock_yards ON ((lsr.stock_yard_id = mst_stock_yards.id)))
     JOIN mst_colors ON ((mdr.color_id = mst_colors.id)))
     JOIN mst_variants ON ((mdr.variant_id = mst_variants.id)))
     JOIN mst_vehicles ON ((mdr.vehicle_id = mst_vehicles.id)));

-- ----------------------------
-- View structure for view_log_dublicate_numbers
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_log_dublicate_numbers" AS 
 SELECT tbl_dublicate_number_log.id,
    tbl_dublicate_number_log.customer_name,
    tbl_dublicate_number_log.dealer_id,
    tbl_dublicate_number_log.dublication_status,
    tbl_dublicate_number_log.created_by,
    tbl_dublicate_number_log.updated_by,
    tbl_dublicate_number_log.deleted_by,
    tbl_dublicate_number_log.created_at,
    tbl_dublicate_number_log.updated_at,
    tbl_dublicate_number_log.deleted_at,
    tbl_dublicate_number_log.vehicle_id,
    tbl_dublicate_number_log.variant_id,
    tbl_dublicate_number_log.color_id,
    tbl_dublicate_number_log.mobile,
    dms_dealers.name AS dealer_name,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name,
    tbl_dublicate_number_log.inquiry_no,
    dms_customers.inquiry_date_en,
    dms_customers.inquiry_date_np
   FROM (((((tbl_dublicate_number_log
     JOIN dms_dealers ON ((tbl_dublicate_number_log.dealer_id = dms_dealers.id)))
     JOIN mst_vehicles ON ((tbl_dublicate_number_log.vehicle_id = mst_vehicles.id)))
     JOIN mst_variants ON ((tbl_dublicate_number_log.variant_id = mst_variants.id)))
     JOIN mst_colors ON ((tbl_dublicate_number_log.color_id = mst_colors.id)))
     JOIN dms_customers ON (((tbl_dublicate_number_log.inquiry_no)::text = (dms_customers.inquiry_no)::text)));

-- ----------------------------
-- View structure for view_log_fuel_record
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_log_fuel_record" AS 
 SELECT log_fuel_kms.id,
    log_fuel_kms.created_by,
    log_fuel_kms.updated_by,
    log_fuel_kms.deleted_by,
    log_fuel_kms.created_at,
    log_fuel_kms.updated_at,
    log_fuel_kms.deleted_at,
    log_fuel_kms.vehicle_id,
    log_fuel_kms.fuel,
    log_fuel_kms.kms,
    log_fuel_kms.date,
    log_fuel_kms.date_np,
    log_fuel_kms.location,
    log_fuel_kms.fuel_remarks,
    msil_dispatch_records.engine_no,
    msil_dispatch_records.chass_no,
    msil_dispatch_records.vehicle_register_no,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name,
    log_fuel_kms.opening_kms,
    log_fuel_kms.closing_kms,
    log_fuel_kms.reported_by,
    log_fuel_kms.customer_name,
    log_fuel_kms.mobile_number,
    log_fuel_kms.month,
    log_fuel_kms.executive_name
   FROM ((((log_fuel_kms
     LEFT JOIN msil_dispatch_records ON ((log_fuel_kms.vehicle_id = msil_dispatch_records.id)))
     LEFT JOIN mst_vehicles ON ((msil_dispatch_records.vehicle_id = mst_vehicles.id)))
     LEFT JOIN mst_variants ON ((msil_dispatch_records.variant_id = mst_variants.id)))
     JOIN mst_colors ON ((msil_dispatch_records.color_id = mst_colors.id)));

CREATE OR REPLACE VIEW "public"."view_log_stock_record_working" AS 
 SELECT mdr.id,
    mdr.deleted_at,
    mdr.vehicle_id,
    mdr.variant_id,
    mdr.color_id,
    mdr.dispatch_date AS msil_dispatch_date,
    mdr.month,
    mdr.year,
    mdr.engine_no,
    mdr.chass_no,
    mdr.current_location,
    mdr.current_status,
    ve.name AS vehicle_name,
    va.name AS variant_name,
    co.name AS color_name,
    co.code AS color_code,
    ldd.dispatched_date AS dealer_dispatch_date,
    ldd.received_date AS dealer_received_date,
    ldd.dispatched_date_np AS dealer_dispatch_date_nep,
    ldd.received_date_nep AS dealer_received_date_nep,
    lsr.dispatched_date AS dealer_retail_date,
    lsr.dispatched_date_nep AS dealer_retail_date_nep,
    lsr.id AS stock_id,
    lsr.dealer_reject,
    lsr.damage_date,
    lsr.is_damage,
    lsr.repair_date,
    (('now'::text)::date - mdr.nepal_custom) AS age,
    lsr.repair_commitment_date,
    lsr.remarks,
    ldd.dealer_id,
    lsr.dispatch_id,
    mdr.transit,
    ldd.vehicle_return_date,
    concat(ldo.payment_method, '-', ldo.associated_value_payment) AS payment_value,
        CASE
            WHEN (mdr.company_name IS NOT NULL) THEN mdr.company_name
            ELSE mst_firms.name
        END AS firm_name,
    log_dealer_order.id AS order_id,
    lsr.dispatched_date_np,
    lsr.present_location,
    lsr.stock_transfer_date,
    lsr.pdi_date,
    lsr.pdi_date_np,
    lsr.transfer_from,
    lsr.driver_id,
    lsr.accident_type,
    lsr.challan_status,
    dd.driver_name,
    dd.driver_number,
    lsr.location AS challan_hold_location,
    log_dealer_order.logistic_confirmation_date,
    log_dealer_order.logistic_confirmation_date_np,
    log_dealer_order.credit_approve_date,
    log_dealer_order.credit_approve_date_np,
    lsr.challan_confirmation_date,
    mdr.custom_name,
    lsr.pdi_to_yard_date,
    lsr.yard_location,
    lsr.pdi_status,
    lsr.pdi_job_card_open_date,
    lsr.pdi_job_card_no,
    lsr.pdi_bill_no,
    lsr.pdi_bill_date,
    lsr.pdi_bill_date_np,
    lsr.stock_out_date_np,
    lsr.stock_out_date,
    lsr.dealers_return_date,
    lsr.dealers_return_date_np,
    lsr.allocation_date,
    lsr.allocation_date_np,
    lsr.allocation_type,
    lsr.received_confirmation_via_challan,
    lsr.insurance_email_date,
    lsr.pdi_remarks,
    lsr.pdi_to_yard_date_np,
    lsr.pdi_job_card_open_date_np,
    lsr.insurance_email_date_np,
    (('now'::text)::date - lsr.allocation_date) AS allocation_age,
    lsr.pdi_bill_month,
    mdr.vehicle_register_no,
    mdr.vehicle_register_date,
    lsr.hold_remark,
    ve.for_sales
   FROM (((((((((msil_dispatch_records mdr
     JOIN mst_vehicles ve ON ((mdr.vehicle_id = ve.id)))
     JOIN mst_variants va ON ((mdr.variant_id = va.id)))
     JOIN mst_colors co ON ((mdr.color_id = co.id)))
     LEFT JOIN log_dispatch_dealer ldd ON (((mdr.id = ldd.vehicle_id) AND (ldd.deleted_at IS NULL))))
     LEFT JOIN log_stock_records lsr ON ((mdr.id = lsr.vehicle_id)))
     LEFT JOIN log_dealer_order ldo ON ((ldo.id = ldd.dealer_order_id)))
     LEFT JOIN mst_firms ON ((ve.firm_id = mst_firms.id)))
     LEFT JOIN driver_details dd ON ((dd.id = lsr.driver_id)))
     LEFT JOIN log_dealer_order ON ((ldd.dealer_order_id = log_dealer_order.id)));

-- ----------------------------
-- View structure for view_log_stock_records
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_log_stock_records" AS 
 SELECT l.id,
    l.created_by,
    l.updated_by,
    l.created_at,
    l.updated_at,
    l.vehicle_id,
    l.stock_yard_id,
    l.reached_date,
    l.dispatched_date AS dispatch_date_to_customer,
    l.vehicle_id AS stock_vehicle_id,
    v.name AS vehicle_name,
    v1.name AS variant_name,
    c.name AS color_name,
    c.code AS color_code,
    m.engine_no,
    m.chass_no,
    s.name AS stock_yard,
    m.barcode,
    s.longitude,
    s.latitude,
    s.id AS stock_id,
    m.vehicle_id AS mst_vehicle_id,
    m.color_id AS mst_color_id,
    m.year,
    m.dispatch_date AS msil_dispatch_date,
    (date_part('epoch'::text, age((('now'::text)::date)::timestamp with time zone, (m.dispatch_date)::timestamp with time zone)) / (86400)::double precision) AS diff_date,
    l.is_damage,
    l.damage_date,
    l.repair_date,
    ldd.dealer_id,
    vd.name AS dealer_name,
        CASE
            WHEN (vd.name IS NULL) THEN s.name
            WHEN ((vd.name IS NOT NULL) AND (ldd.vehicle_return = 1)) THEN s.name
            ELSE vd.name
        END AS location,
        CASE
            WHEN (l.is_damage = 1) THEN 'Damage'::text
            WHEN (l.is_damage = 2) THEN 'Repaired'::text
            ELSE 'OK!!!'::text
        END AS damage_status,
    l.repair_commitment_date,
    l.repair_date_nep,
    l.damage_date_nep,
    l.remarks,
    l.dealer_reject,
    ldd.id AS dispatch_id,
    ldd.deleted_by,
    ldd.deleted_at,
    ldd.vehicle_return,
    ldd.vehicle_return_date,
    ldd.vehicle_return_date_nep,
    ldd.vehicle_return_reason,
    ldd.dispatched_date AS dispatch_to_dealer_date,
    l.current_location AS damage_location,
        CASE
            WHEN ((l.return_dealer_id IS NOT NULL) AND (ldd.dispatched_date IS NULL)) THEN dd.name
            WHEN ((l.return_stockyard_id IS NOT NULL) AND (ldd.dispatched_date IS NULL)) THEN msy.name
            WHEN (l.current_location IS NOT NULL) THEN l.current_location
            WHEN ((vd.name IS NOT NULL) AND (ldd.vehicle_return = 1)) THEN s.name
            WHEN (ldd.dealer_id IS NOT NULL) THEN vd.name
            ELSE s.name
        END AS actual_location,
    l.return_dealer_id,
    l.return_stockyard_id,
    l.return_date,
    l.return_date_nep,
    msy.name AS ret_stockyard_name,
    m.variant_id,
    m.variant_id AS mst_variant_id,
    mst_stock_yards.name AS stock_yard_name,
    m.current_location,
    m.current_status,
    ldd.received_date,
    ldd.received_date_nep,
    dd.name AS ret_dealer_name,
    m.company_name AS firm_name,
    l.stock_transfer_date
   FROM (((((((((((log_stock_records l
     LEFT JOIN msil_dispatch_records m ON ((l.vehicle_id = m.id)))
     LEFT JOIN mst_vehicles v ON ((m.vehicle_id = v.id)))
     LEFT JOIN mst_variants v1 ON ((m.variant_id = v1.id)))
     LEFT JOIN mst_colors c ON ((m.color_id = c.id)))
     LEFT JOIN mst_stock_yards s ON ((l.stock_yard_id = s.id)))
     LEFT JOIN log_dispatch_dealer ldd ON ((ldd.vehicle_id = l.vehicle_id)))
     LEFT JOIN view_dealers vd ON ((ldd.dealer_id = vd.id)))
     LEFT JOIN mst_stock_yards msy ON ((l.return_stockyard_id = msy.id)))
     LEFT JOIN mst_stock_yards ON ((l.stock_yard_id = mst_stock_yards.id)))
     LEFT JOIN dms_dealers dd ON ((l.return_dealer_id = dd.id)))
     LEFT JOIN mst_firms mf ON ((v.firm_id = mf.id)));


CREATE OR REPLACE VIEW "public"."view_master_log_stock_record" AS 
 SELECT mdr.vehicle_id,
    mdr.variant_id,
    mdr.color_id,
    lsr.id,
    mdr.engine_no,
    mdr.chass_no,
    mdr.current_status,
    lsr.deleted_at
   FROM (log_stock_records lsr
     JOIN msil_dispatch_records mdr ON ((lsr.vehicle_id = mdr.id)));


CREATE OR REPLACE VIEW "public"."view_minimum_ktm_stock" AS 
 SELECT mmq.id,
    mmq.created_by,
    mmq.updated_by,
    mmq.deleted_by,
    mmq.created_at,
    mmq.updated_at,
    mmq.deleted_at,
    mmq.vehicle_id,
    mmq.variant_id,
    mmq.color_id,
    mmq.quantity,
    ve.name AS vehicle_name,
    va.name AS variant_name,
    co.name AS color_name
   FROM (((mst_minimum_quantity mmq
     JOIN mst_vehicles ve ON ((mmq.vehicle_id = ve.id)))
     JOIN mst_variants va ON ((mmq.variant_id = va.id)))
     JOIN mst_colors co ON ((mmq.color_id = co.id)));


CREATE OR REPLACE VIEW "public"."view_msil_cg_stock" AS 
 SELECT mdr.id,
    mdr.created_by,
    mdr.updated_by,
    mdr.deleted_by,
    mdr.created_at,
    mdr.updated_at,
    mdr.deleted_at,
    mdr.vehicle_id,
    mdr.variant_id,
    mdr.color_id,
    mdr.dispatch_date,
    mdr.month,
    mdr.year,
    mdr.ait_reference_no,
    mdr.invoice_no,
    mdr.invoice_date,
    mdr.transit,
    mdr.border,
    mdr.barcode,
    mdr.engine_no,
    mdr.chass_no,
    mdr.order_no,
    mdr.indian_stock_yard,
    mdr.indian_custom,
    mdr.nepal_custom,
    mdr.vehicle_register_no,
    mdr.vehicle_register_date,
    mdr.custom_name,
    mdr.dispatched_date_np,
    mdr.dispatched_date_np_month,
    mdr.dispatched_date_np_year,
    mdr.indian_stock_yard_np,
    mdr.indian_stock_yard_np_month,
    mdr.indian_stock_yard_np_year,
    mdr.in_display,
    mdr.remarks,
    mdr.current_location,
    mdr.current_status,
    mdr.pragyapan_no,
    mdr.pragyapan_date,
    mdr.key_no,
    mdr.pragyapan_date_np,
    ve.name AS vehicle_name,
    va.name AS variant_name,
    co.name AS color_name,
    co.code AS color_code,
    mdr.company_name AS firm_name,
    log_dispatch_dealer.received_date,
    log_dispatch_dealer.received_date_nep,
    (('now'::text)::date - mdr.nepal_custom) AS age,
    log_stock_records.challan_status,
    log_stock_records.location,
    driver_details.driver_number,
    driver_details.driver_address,
    driver_details.driver_name,
    log_stock_records.dispatched_date AS retailed_date,
    log_dispatch_dealer.dispatched_date AS billing_date,
    mdr.india_custom_movement_date,
    mdr.india_custom_movement_date_np,
    mdr.nepal_custom_movement_date,
    mdr.nepal_custom_movement_date_np
   FROM (((((((msil_dispatch_records mdr
     JOIN mst_vehicles ve ON ((mdr.vehicle_id = ve.id)))
     JOIN mst_variants va ON ((mdr.variant_id = va.id)))
     JOIN mst_colors co ON ((mdr.color_id = co.id)))
     JOIN mst_firms mf ON ((ve.firm_id = mf.id)))
     LEFT JOIN log_dispatch_dealer ON ((mdr.id = log_dispatch_dealer.vehicle_id)))
     LEFT JOIN log_stock_records ON ((mdr.id = log_stock_records.vehicle_id)))
     LEFT JOIN driver_details ON ((log_stock_records.driver_id = driver_details.id)));

-- ----------------------------
-- View structure for view_msil_dispatch_records
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_msil_dispatch_records" AS 
 SELECT m.id,
    m.created_by,
    m.updated_by,
    m.deleted_by,
    m.created_at,
    m.updated_at,
    m.deleted_at,
    m.vehicle_id,
    m.variant_id,
    m.color_id,
    m.engine_no,
    m.chass_no,
    m.dispatch_date,
    m.month,
    m.year,
    m.order_no,
    m.ait_reference_no,
    m.invoice_no,
    m.invoice_date,
    m.transit,
        CASE
            WHEN (m.transit = 1) THEN 'Transit Complete'::text
            ELSE 'In Transit'::text
        END AS transit_status,
    m.indian_stock_yard,
    m.indian_custom,
    m.nepal_custom,
    m.border,
    m.barcode,
    v.name AS vehicle_name,
    v1.name AS variant_name,
    c.name AS color_name,
    c.code AS color_code,
    l.reached_date AS stock_yard_reached_date,
    l.dispatched_date AS stock_yard_dispatched_date,
    ms.name AS stockyard_name,
    m.custom_name,
    m.vehicle_register_no,
    m.current_status,
    m.current_location,
    m.pragyapan_date_np,
    m.key_no,
    m.pragyapan_date,
    m.pragyapan_no,
    v.firm_id,
        CASE
            WHEN (m.company_name IS NOT NULL) THEN m.company_name
            ELSE mst_firms.name
        END AS firm_name,
    ldd.dealer_id,
    l.stock_transfer_date,
    ldd.dispatched_date,
    l.transfer_from AS stock_transfer_from,
    m.india_custom_movement_date,
    m.india_custom_movement_date_np,
    m.nepal_custom_movement_date,
    m.nepal_custom_movement_date_np,
    m.vehicle_register_date,
    m.lc_number,
    svp.vehicle_delivery_date_np,
    svp.vehicle_delivery_date
   FROM ((((((((msil_dispatch_records m
     LEFT JOIN mst_vehicles v ON ((m.vehicle_id = v.id)))
     LEFT JOIN mst_variants v1 ON ((m.variant_id = v1.id)))
     LEFT JOIN mst_colors c ON ((m.color_id = c.id)))
     LEFT JOIN log_stock_records l ON ((m.id = l.vehicle_id)))
     LEFT JOIN mst_stock_yards ms ON ((l.stock_yard_id = ms.id)))
     JOIN mst_firms ON ((v.firm_id = mst_firms.id)))
     LEFT JOIN log_dispatch_dealer ldd ON ((ldd.id = l.dispatch_id)))
     LEFT JOIN sales_vehicle_process svp ON (((m.id = svp.msil_dispatch_id) AND (svp.vehicle_delivery_date IS NOT NULL))))
  WHERE (m.deleted_at IS NULL);

-- ----------------------------
-- View structure for view_msil_dispatch_vehicles
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_msil_dispatch_vehicles" AS 
 SELECT mve.name AS vehicle_name,
    mva.name AS variant_name,
    mc.name AS color_name,
    mo.color_id,
    mo.variant_id,
    mo.vehicle_id,
    mo.order_id,
    mo.vehicle_received_status,
    mo.received_quantity,
    mo.quantity,
    mo.month,
    mo.year,
    mo.firm_id,
    mo.id,
    mf.name AS firm_name,
    mo.deleted_at,
    (((mo.received_quantity)::double precision / ((mo.quantity - mo.cancel_quantity))::double precision) * (100)::double precision) AS received_percentage,
    ((mo.quantity - mo.cancel_quantity) - mo.received_quantity) AS total_remaining,
    mo.cancel_quantity,
    mo.reason,
    mo.unplanned_order,
        CASE
            WHEN (mo.unplanned_order = 1) THEN 'Unplanned'::text
            ELSE 'Planned'::text
        END AS order_type
   FROM ((((msil_orders mo
     JOIN mst_vehicles mve ON ((mo.vehicle_id = mve.id)))
     JOIN mst_variants mva ON ((mo.variant_id = mva.id)))
     JOIN mst_colors mc ON ((mo.color_id = mc.id)))
     JOIN mst_firms mf ON ((mo.firm_id = mf.id)));

-- ----------------------------
-- View structure for view_msil_grouped_pending_report
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_msil_grouped_pending_report" AS 
 SELECT msil_orders.order_id,
    msil_orders.vehicle_id,
    msil_orders.variant_id,
    sum(((msil_orders.quantity - msil_orders.received_quantity) - msil_orders.cancel_quantity)) AS sum,
    mst_variants.name AS varient_name,
    mst_vehicles.name AS vehicle_name,
    mst_firms.name AS firm_name,
    msil_orders.deleted_at,
    msil_orders.deleted_by,
    mst_colors.name AS color_name,
    msil_orders.month,
    msil_orders.year,
    mst_colors.code,
    msil_orders.color_id
   FROM ((((msil_orders
     JOIN mst_variants ON ((msil_orders.variant_id = mst_variants.id)))
     JOIN mst_vehicles ON ((msil_orders.vehicle_id = mst_vehicles.id)))
     JOIN mst_firms ON ((msil_orders.firm_id = mst_firms.id)))
     JOIN mst_colors ON ((msil_orders.color_id = mst_colors.id)))
  GROUP BY msil_orders.order_id, msil_orders.vehicle_id, msil_orders.variant_id, mst_variants.name, mst_vehicles.name, mst_firms.name, msil_orders.deleted_by, msil_orders.deleted_at, mst_colors.name, msil_orders.month, msil_orders.year, mst_colors.code, msil_orders.color_id;

-- ----------------------------
-- View structure for view_msil_monthly_orders
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_msil_monthly_orders" AS 
 SELECT v.vehicle_id,
    v.variant_id,
    v.color_id,
    sum(v.quantity) AS total,
    v.year,
    v.month,
    v.deleted_at,
    v1.name AS vehicle_name,
    v2.name AS variant_name,
    c.name AS color_name,
    c.code AS color_code
   FROM (((msil_monthly_plannings v
     LEFT JOIN mst_vehicles v1 ON ((v.vehicle_id = v1.id)))
     LEFT JOIN mst_colors c ON ((v.color_id = c.id)))
     LEFT JOIN mst_variants v2 ON ((v.variant_id = v2.id)))
  GROUP BY v.vehicle_id, v.variant_id, v.color_id, v.year, v.month, v.deleted_at, v1.name, v2.name, c.name, c.code
  ORDER BY v1.name;

-- ----------------------------
-- View structure for view_msil_monthly_plannings
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_msil_monthly_plannings" AS 
 SELECT v.id,
    v.created_by,
    v.updated_by,
    v.deleted_by,
    v.created_at,
    v.updated_at,
    v.deleted_at,
    v.vehicle_id,
    v.variant_id,
    v.color_id,
    v.dealer_id,
    v.quantity,
    v.year,
    v.month,
    v1.name AS vehicle_name,
    v2.name AS variant_name,
    c.name AS color_name,
    c.code AS color_code,
    d.name AS dealer_name
   FROM ((((msil_monthly_plannings v
     LEFT JOIN mst_vehicles v1 ON ((v.vehicle_id = v1.id)))
     LEFT JOIN mst_colors c ON ((v.color_id = c.id)))
     LEFT JOIN mst_variants v2 ON ((v.variant_id = v2.id)))
     LEFT JOIN dms_dealers d ON ((v.dealer_id = d.id)));

-- ----------------------------
-- View structure for view_msil_order_new
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_msil_order_new" AS 
 SELECT msil_orders.id,
    msil_orders.created_by,
    msil_orders.updated_by,
    msil_orders.deleted_by,
    msil_orders.created_at,
    msil_orders.updated_at,
    msil_orders.deleted_at,
    msil_orders.vehicle_id,
    msil_orders.variant_id,
    msil_orders.color_id,
    msil_orders.month,
    msil_orders.year,
    msil_orders.order_id,
    msil_orders.quantity,
    msil_orders.firm_id,
    msil_orders.received_quantity,
    msil_orders.vehicle_received_status,
    msil_orders.cancel_quantity,
    msil_orders.reason,
    msil_orders.unplanned_order,
    mst_firms.name AS firm_name,
    mst_firms.prefix
   FROM (msil_orders
     LEFT JOIN mst_firms ON ((msil_orders.firm_id = mst_firms.id)));

-- ----------------------------
-- View structure for view_msil_order_pending
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_msil_order_pending" AS 
 SELECT mo.deleted_at,
    mo.vehicle_id,
    mo.variant_id,
    ((mo.quantity - mo.received_quantity) - mo.cancel_quantity) AS pending,
    mo.year,
    mo.month
   FROM msil_orders mo;

-- ----------------------------
-- View structure for view_msil_orders
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_msil_orders" AS 
 SELECT v.vehicle_id,
    v.variant_id,
    v.color_id,
    sum(v.quantity) AS total,
    v.year,
    v.month,
    v.deleted_at,
    v1.name AS vehicle_name,
    v2.name AS variant_name,
    c.name AS color_name,
    c.code AS color_code,
    sum(v.received_quantity) AS total_received,
    v.cancel_quantity
   FROM (((msil_orders v
     LEFT JOIN mst_vehicles v1 ON ((v.vehicle_id = v1.id)))
     LEFT JOIN mst_colors c ON ((v.color_id = c.id)))
     LEFT JOIN mst_variants v2 ON ((v.variant_id = v2.id)))
  GROUP BY v.vehicle_id, v.variant_id, v.color_id, v.year, v.month, v.deleted_at, v1.name, v2.name, c.name, c.code, v.cancel_quantity
  ORDER BY v1.name;

-- ----------------------------
-- View structure for view_msil_received_order
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_msil_received_order" AS 
 SELECT msil.id,
    msil.deleted_at,
    msil.part_name,
    msil.quantity,
    msil.order_no,
    msil.msil_part_price,
    msil.unit_rate,
    msil.amount,
    msil.reached_date_nepali,
    msil.reached_date,
    msil.box_no,
    msil.part_code,
    msil.in_stock,
    msil.created_by,
    msil.updated_by,
    msil.deleted_by,
    msil.created_at,
    msil.updated_at,
    spareparts_sparepart_stock.location,
    msil.invoice_no,
    msil.mst_part_id,
    msil.dealer_name,
    msil.binning_date_en,
    msil.binning_date_np,
    msil.binning_status
   FROM (spareparts_msil_order msil
     LEFT JOIN spareparts_sparepart_stock ON (((msil.mst_part_id = spareparts_sparepart_stock.sparepart_id) AND (spareparts_sparepart_stock.deleted_at IS NULL))));

-- ----------------------------
-- View structure for view_msil_remaining_quantity
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_msil_remaining_quantity" AS 
 SELECT sog.sparepart_id,
    sog.order_no,
    sog.quantity,
    smo.part_name,
    sum(smo.quantity) AS total_quantity,
    smo.unit_rate,
    sog.deleted_at,
    sog.final_order_no,
    ms.latest_part_code,
    ms.name AS sp_partname,
    ms.part_code AS sp_partcode,
    sog.order_type,
    sog.date,
    sog.pi_number,
    sog.pi_confirmed_date,
    sog.nep_date,
    ms.alternate_part_code
   FROM ((spareparts_order_generate sog
     LEFT JOIN spareparts_msil_order smo ON ((((sog.final_order_no)::text = (smo.order_no)::text) AND (sog.sparepart_id = smo.mst_part_id))))
     JOIN mst_spareparts ms ON ((sog.sparepart_id = ms.id)))
  GROUP BY sog.sparepart_id, sog.order_no, sog.quantity, smo.part_code, smo.part_name, smo.unit_rate, sog.deleted_at, sog.final_order_no, ms.latest_part_code, ms.name, ms.part_code, sog.order_type, sog.date, sog.nep_date, sog.pi_confirmed_date, sog.pi_number, ms.alternate_part_code;

-- ----------------------------
-- View structure for view_mst_foc_accessories
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_mst_foc_accessories" AS 
 SELECT mst_foc_accessoreis_partcode.id,
    mst_foc_accessoreis_partcode.created_by,
    mst_foc_accessoreis_partcode.updated_by AS modified_by,
    mst_foc_accessoreis_partcode.deleted_by,
    mst_foc_accessoreis_partcode.created_at,
    mst_foc_accessoreis_partcode.deleted_at,
    mst_foc_accessoreis_partcode.updated_at AS modified_at,
    mst_foc_accessoreis_partcode.name,
    mst_foc_accessoreis_partcode.part_code,
    mst_foc_accessoreis_partcode.vehicle_id,
    mst_vehicles.name AS vehicle_name
   FROM (mst_foc_accessoreis_partcode
     JOIN mst_vehicles ON ((mst_foc_accessoreis_partcode.vehicle_id = mst_vehicles.id)));

-- ----------------------------
-- View structure for view_mst_sources
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_mst_sources" AS 
 SELECT mst_sources.id,
    mst_sources.created_by,
    mst_sources.updated_by,
    mst_sources.deleted_by,
    mst_sources.created_at,
    mst_sources.updated_at,
    mst_sources.deleted_at,
    mst_sources.name,
    mst_sources.rank,
    mst_sources.source_type_id,
    mst_source_type.name AS source_type_name
   FROM (mst_sources
     LEFT JOIN mst_source_type ON ((mst_sources.source_type_id = mst_source_type.id)));

-- ----------------------------
-- View structure for view_mst_sub_source
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_mst_sub_source" AS 
 SELECT mst_sources.name AS source_name,
    mst_sub_source.id,
    mst_sub_source.created_by,
    mst_sub_source.updated_by,
    mst_sub_source.deleted_by,
    mst_sub_source.created_at,
    mst_sub_source.updated_at,
    mst_sub_source.deleted_at,
    mst_sub_source.name,
    mst_sub_source.rank,
    mst_sub_source.source_id
   FROM (mst_sources
     JOIN mst_sub_source ON ((mst_sub_source.source_id = mst_sources.id)));

-- ----------------------------
-- View structure for view_mst_vehicles
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_mst_vehicles" AS 
 SELECT v.id,
    v.created_by,
    v.updated_by,
    v.deleted_by,
    v.created_at,
    v.updated_at,
    v.deleted_at,
    v.firm_id,
    v.name,
    v.rank,
    f.name AS firm_name
   FROM (mst_vehicles v
     JOIN mst_firms f ON ((v.firm_id = f.id)));

-- ----------------------------
-- View structure for view_mst_walkin_sources
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_mst_walkin_sources" AS 
 SELECT mst_walkin_sources.id,
    mst_walkin_sources.created_by,
    mst_walkin_sources.updated_by,
    mst_walkin_sources.deleted_by,
    mst_walkin_sources.created_at,
    mst_walkin_sources.updated_at,
    mst_walkin_sources.deleted_at,
    mst_walkin_sources.name,
    mst_walkin_sources.rank,
    mst_walkin_sources.sub_source_id,
    mst_sub_source.name AS sub_source_name
   FROM (mst_walkin_sources
     LEFT JOIN mst_sub_source ON ((mst_walkin_sources.sub_source_id = mst_sub_source.id)));

-- ----------------------------
-- View structure for view_orders_dispatch
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_orders_dispatch" AS 
 SELECT c.id,
    c.date_of_order,
    c.date_of_delivery,
    c.delivery_lead_time,
    c.pdi_status,
    c.date_of_retail,
    c.retail_lead_time,
    c.created_by,
    c.updated_by,
    c.created_at,
    c.updated_at,
    c.payment_status,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    c.order_id,
    c.quantity,
    v1.name AS vehicle_name,
    v2.name AS variant_name,
    v3.name AS color_name,
    s.id AS stock_id,
    s.stock_yard_id AS stock_stockyard_id,
    s.created_by AS stock_created_by,
    s.vehicle_id AS stock_vehicle_id,
    s.reached_date,
    ms.name,
    di.id AS dispatch_id,
    di.driver_name,
    di.driver_address,
    di.driver_contact,
    di.driver_liscense_no,
    di.image_name,
    di.vehicle_id AS dispatched_vehicle_id,
    md.engine_no,
    md.chass_no,
    di.dealer_order_id,
    di.deleted_at,
    di.deleted_by,
    md.year,
    c.year AS order_year,
    c.dealer_id,
    view_dealers.name AS dealer_name,
    di.received_date,
    di.received_date_nep,
    di.challan_return_image,
    di.dispatched_date AS stock_dispatch_date,
    c.cancel_quantity,
    c.cancel_date,
    c.cancel_date_np,
    c.credit_control_approval,
    v3.code AS color_code,
    c.credit_approve_date,
    di.vehicle_return_date,
    concat(c.payment_method, '-', c.associated_value_payment) AS payment_value,
    c.grn_received_date,
    c.grn_received_date_np,
    to_char((c.date_of_order)::timestamp with time zone, 'DD'::text) AS day_date
   FROM ((((((((log_dealer_order c
     JOIN mst_vehicles v1 ON ((c.vehicle_id = v1.id)))
     JOIN mst_variants v2 ON ((c.variant_id = v2.id)))
     JOIN mst_colors v3 ON ((c.color_id = v3.id)))
     LEFT JOIN log_stock_records s ON ((c.vehicle_main_id = s.vehicle_id)))
     LEFT JOIN mst_stock_yards ms ON ((s.stock_yard_id = ms.id)))
     LEFT JOIN log_dispatch_dealer di ON ((s.dispatch_id = di.id)))
     LEFT JOIN msil_dispatch_records md ON ((s.vehicle_id = md.id)))
     JOIN view_dealers ON ((c.dealer_id = view_dealers.id)));

-- ----------------------------
-- View structure for view_outside_work_grouped
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_outside_work_grouped" AS 
 SELECT ser_outside_work.jobcard_group,
    ser_outside_work.splr_invoice_no,
    ser_outside_work.splr_invoice_date,
    ser_outside_work.total_amount,
    ser_outside_work.net_amount
   FROM ser_outside_work
  GROUP BY ser_outside_work.jobcard_group, ser_outside_work.splr_invoice_no, ser_outside_work.splr_invoice_date, ser_outside_work.net_amount, ser_outside_work.total_amount;


CREATE OR REPLACE VIEW "public"."view_part_pending" AS 
 SELECT ms.jobcard_group,
    string_agg((sp.name)::text, ', '::text) AS part_consume
   FROM (ser_material_scan ms
     LEFT JOIN mst_spareparts sp ON ((ms.part_id = sp.id)))
  GROUP BY ms.jobcard_group;

-- ----------------------------
-- View structure for view_partial_sale_report
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_partial_sale_report" AS 
 SELECT pp.customer_id,
    sum(pp.amount) AS total_partial_payment,
    max(pp.payment_date) AS payment_date
   FROM sales_partial_payment pp
  GROUP BY pp.customer_id;

-- ----------------------------
-- View structure for view_parts_details
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_parts_details" AS 
 SELECT b.billing_id,
    string_agg((s.name)::text, ', '::text) AS part_name
   FROM (ser_billed_parts b
     LEFT JOIN mst_spareparts s ON ((b.part_id = s.id)))
  GROUP BY b.billing_id;

-- ----------------------------
-- View structure for view_partwise_billing_detail
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_partwise_billing_detail" AS 
 SELECT bp.id,
    bp.created_by,
    bp.updated_by,
    bp.deleted_by,
    bp.created_at,
    bp.updated_at,
    bp.deleted_at,
    bp.billing_id,
    bp.part_id,
    bp.price,
    bp.quantity,
    bp.discount_percentage,
    bp.final_amount,
    bp.warranty,
    bp.lube_quantity,
    br.jobcard_group,
    br.issue_date,
    br.invoice_no,
    br.dealer_id,
    ms.part_code,
    ms.name AS part_name,
    dd.name AS dealer_name,
        CASE
            WHEN (bp.lube_quantity IS NULL) THEN (bp.quantity)::numeric
            ELSE bp.lube_quantity
        END AS display_quantity
   FROM (((ser_billed_parts bp
     LEFT JOIN ser_billing_record br ON ((bp.billing_id = br.id)))
     LEFT JOIN mst_spareparts ms ON ((bp.part_id = ms.id)))
     LEFT JOIN dms_dealers dd ON ((br.dealer_id = dd.id)));

CREATE OR REPLACE VIEW "public"."view_pending_jobs" AS 
 SELECT s.jobcard_group,
    string_agg((sss.description)::text, ', '::text) AS job_desc
   FROM (ser_job_cards s
     LEFT JOIN mst_service_jobs sss ON ((s.job_id = sss.id)))
  GROUP BY s.jobcard_group;


CREATE OR REPLACE VIEW "public"."view_quotation_reports" AS 
 SELECT q.id,
    q.created_by,
    q.updated_by,
    q.deleted_by,
    q.created_at,
    q.updated_at,
    q.deleted_at,
    q.customer_id,
    q.quotation_date_en,
    q.quotation_date_np,
    q.quote_price,
    q.quote_unit,
    q.quote_mrp,
    q.quote_discount,
    c.inquiry_no,
    c.mobile_1,
    c.email,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
        CASE
            WHEN ((m8.middle_name)::text <> ''::text) THEN (((((m8.first_name)::text || ' '::text) || (m8.middle_name)::text) || ' '::text) || (m8.last_name)::text)
            ELSE (((m8.first_name)::text || ' '::text) || (m8.last_name)::text)
        END AS executive_name,
    d.name AS dealer_name,
    co.name AS color_name,
    va.name AS variant_name,
    mst_vehicles.name AS vehicle_name,
    c.dealer_id,
    c.executive_id
   FROM ((((((dms_quotations q
     LEFT JOIN dms_customers c ON ((q.customer_id = c.id)))
     LEFT JOIN dms_employees m8 ON ((c.executive_id = m8.id)))
     LEFT JOIN dms_dealers d ON ((c.dealer_id = d.id)))
     LEFT JOIN mst_colors co ON ((c.color_id = co.id)))
     LEFT JOIN mst_variants va ON ((c.variant_id = va.id)))
     LEFT JOIN mst_vehicles ON ((c.vehicle_id = mst_vehicles.id)));

CREATE OR REPLACE VIEW "public"."view_report_achievement_dealer" AS 
 SELECT lsr.dispatched_date_np,
    lsr.dispatched_date,
    dd.dealer_id,
    date_part('month'::text, to_date((lsr.dispatched_date_np)::text, 'YYYY/MM/DD'::text)) AS month
   FROM ((msil_dispatch_records msil
     JOIN log_stock_records lsr ON ((msil.id = lsr.vehicle_id)))
     JOIN log_dispatch_dealer dd ON ((msil.id = dd.vehicle_id)))
  WHERE ((lsr.dispatched_date IS NOT NULL) AND (lsr.dispatched_date_np IS NOT NULL));


CREATE OR REPLACE VIEW "public"."view_report_avg_sales" AS 
 SELECT mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    round((((count(mst_vehicles.name) / 3))::numeric * 1.5)) AS avg_sales,
    mst_vehicles.deleted_at
   FROM (((log_dispatch_dealer
     JOIN msil_dispatch_records ON ((log_dispatch_dealer.vehicle_id = msil_dispatch_records.id)))
     JOIN mst_vehicles ON ((msil_dispatch_records.vehicle_id = mst_vehicles.id)))
     JOIN mst_variants ON ((msil_dispatch_records.variant_id = mst_variants.id)))
  WHERE (log_dispatch_dealer.dispatched_date > (('now'::text)::date - '3 mons'::interval))
  GROUP BY mst_vehicles.name, mst_variants.name, mst_vehicles.deleted_at;


CREATE OR REPLACE VIEW "public"."view_report_cs_general" AS 
 SELECT br.id,
    br.bill_type,
    br.payment_type,
    br.invoice_no,
    br.total_parts,
    br.vat_parts,
    br.net_total,
    br.dealer_id,
    br.counter_sales_id,
    bp.part_name,
    br.cash_discount_percent,
    br.cash_discount_amt,
    sl.vehicle_no,
    sl.chasis_no,
    sl.engine_no,
    ul.full_name,
    br.deleted_at,
    d.name AS dealer_name,
    br.issue_date AS billing_issue_date
   FROM ((((ser_billing_record br
     LEFT JOIN view_parts_details bp ON ((br.id = bp.billing_id)))
     LEFT JOIN ser_counter_sales sl ON ((br.id = sl.billing_record_id)))
     LEFT JOIN mst_user_ledger ul ON ((sl.party_id = ul.id)))
     LEFT JOIN dms_dealers d ON ((br.dealer_id = d.id)))
  WHERE ((br.bill_type)::text = 'counter'::text);


CREATE OR REPLACE VIEW "public"."view_report_customer_inquiry" AS 
 SELECT c.id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.deleted_at,
    c.deleted_by,
    c.inquiry_no,
    dms_dealers.name AS dealer_name,
    mst_variants.name AS variant_name,
    mst_vehicles.name AS vehicle_name,
    mst_colors.name AS color_name,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
    view_customer_status_latest.status_id,
    view_customer_status_latest.name AS status_name
   FROM (((((dms_customers c
     LEFT JOIN dms_dealers ON ((c.dealer_id = dms_dealers.id)))
     LEFT JOIN mst_variants ON ((c.variant_id = mst_variants.id)))
     LEFT JOIN mst_vehicles ON ((c.vehicle_id = mst_vehicles.id)))
     LEFT JOIN mst_colors ON ((c.color_id = mst_colors.id)))
     JOIN view_customer_status_latest ON ((c.id = view_customer_status_latest.customer_id)));

-- ----------------------------
-- View structure for view_report_customer_payment
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_customer_payment" AS 
 SELECT c.inquiry_no,
    c.inquiry_kind,
    c.inquiry_date_np,
    c.inquiry_date_en,
    svp.booked_date,
    svp.booking_receipt_no,
    svp.booking_amount,
    svp.downpayment_amount,
    svp.fullpayment_amount,
    svp.booked_date_np,
    pp.total_partial_payment,
    pp.payment_date,
    d.name AS dealer_name,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
        CASE
            WHEN ((e.middle_name)::text <> ''::text) THEN (((((e.first_name)::text || ' '::text) || (e.middle_name)::text) || ' '::text) || (e.last_name)::text)
            ELSE (((e.first_name)::text || ' '::text) || (e.last_name)::text)
        END AS executive_name,
    c.deleted_at,
    c.deleted_by,
    cs.status_name,
    cs.sub_status_name
   FROM (((((dms_customers c
     LEFT JOIN sales_vehicle_process svp ON ((c.id = svp.customer_id)))
     LEFT JOIN view_partial_sale_report pp ON ((c.id = pp.customer_id)))
     LEFT JOIN dms_dealers d ON ((c.dealer_id = d.id)))
     LEFT JOIN dms_employees e ON ((c.executive_id = e.id)))
     LEFT JOIN view_customer_status_latest_niroj cs ON ((c.id = cs.customer_id)));

CREATE OR REPLACE VIEW "public"."view_report_dealer_achievement" AS 
 SELECT lsr.dispatched_date_np,
    lsr.dispatched_date,
    mv.name AS vehicle_name,
    dd.dealer_id,
    date_part('month'::text, to_date((lsr.dispatched_date_np)::text, 'YYYY/MM/DD'::text)) AS month,
    msil.vehicle_id
   FROM (((msil_dispatch_records msil
     JOIN log_stock_records lsr ON ((msil.id = lsr.vehicle_id)))
     JOIN mst_vehicles mv ON ((msil.vehicle_id = mv.id)))
     JOIN log_dispatch_dealer dd ON ((msil.id = dd.vehicle_id)))
  WHERE ((lsr.dispatched_date IS NOT NULL) AND (lsr.dispatched_date_np IS NOT NULL));

-- ----------------------------
-- View structure for view_report_dealer_bill
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_dealer_bill" AS 
 SELECT ldd.id,
    ldd.vehicle_id AS msil_vehicle_id,
    ldd.dealer_id,
    ldd.dispatched_date AS dealer_dispatch_date,
    ldd.received_date AS dealer_received_date,
    ldd.received_date_nep AS dealer_received_date_np,
    ldd.dispatched_date_np AS dealer_dispatch_date_np,
    mdr.vehicle_id,
    mdr.variant_id,
    mdr.color_id,
    dms_dealers.name AS dealer_name,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name
   FROM (((((log_dispatch_dealer ldd
     JOIN msil_dispatch_records mdr ON ((ldd.vehicle_id = mdr.id)))
     JOIN dms_dealers ON ((ldd.dealer_id = dms_dealers.id)))
     JOIN mst_vehicles ON ((mdr.vehicle_id = mst_vehicles.id)))
     JOIN mst_variants ON ((mdr.variant_id = mst_variants.id)))
     JOIN mst_colors ON ((mdr.color_id = mst_colors.id)));

-- ----------------------------
-- View structure for view_report_dealer_billing
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_dealer_billing" AS 
 SELECT msil.vehicle_id,
    msil.variant_id,
    msil.color_id,
    vdm.vehicle_name,
    vdm.variant_name,
    vdm.color_name,
    lsr.stock_yard_id,
    msr.name AS stockyard_name,
    msil.custom_name,
        CASE
            WHEN (msil.custom_name IS NULL) THEN msr.name
            WHEN (msr.name IS NULL) THEN msil.custom_name
            ELSE 'transit'::character varying
        END AS vehicle_location,
    msil.dispatch_date,
    date_part('month'::text, msil.dispatch_date) AS month,
        CASE
            WHEN (date_part('month'::text, msil.dispatch_date) = (1)::double precision) THEN 'JAN'::text
            WHEN (date_part('month'::text, msil.dispatch_date) = (2)::double precision) THEN 'FEB'::text
            WHEN (date_part('month'::text, msil.dispatch_date) = (3)::double precision) THEN 'MAR'::text
            WHEN (date_part('month'::text, msil.dispatch_date) = (4)::double precision) THEN 'APR'::text
            WHEN (date_part('month'::text, msil.dispatch_date) = (5)::double precision) THEN 'MAY'::text
            WHEN (date_part('month'::text, msil.dispatch_date) = (6)::double precision) THEN 'JUN'::text
            WHEN (date_part('month'::text, msil.dispatch_date) = (7)::double precision) THEN 'JUL'::text
            WHEN (date_part('month'::text, msil.dispatch_date) = (8)::double precision) THEN 'AUG'::text
            WHEN (date_part('month'::text, msil.dispatch_date) = (9)::double precision) THEN 'SEP'::text
            WHEN (date_part('month'::text, msil.dispatch_date) = (10)::double precision) THEN 'OCT'::text
            WHEN (date_part('month'::text, msil.dispatch_date) = (11)::double precision) THEN 'NOV'::text
            WHEN (date_part('month'::text, msil.dispatch_date) = (12)::double precision) THEN 'DEC'::text
            ELSE NULL::text
        END AS month_name
   FROM (((msil_dispatch_records msil
     LEFT JOIN log_stock_records lsr ON ((msil.id = lsr.vehicle_id)))
     LEFT JOIN view_dms_vehicles vdm ON ((((msil.vehicle_id = vdm.vehicle_id) AND (msil.variant_id = vdm.variant_id)) AND (msil.color_id = vdm.color_id))))
     LEFT JOIN mst_stock_yards msr ON ((lsr.stock_yard_id = msr.id)));

-- ----------------------------
-- View structure for view_report_dealer_billing_list
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_dealer_billing_list" AS 
 SELECT view_d2d_billing_list.id,
    view_d2d_billing_list.created_by,
    view_d2d_billing_list.updated_by,
    view_d2d_billing_list.deleted_by,
    view_d2d_billing_list.created_at,
    view_d2d_billing_list.updated_at,
    view_d2d_billing_list.deleted_at,
    view_d2d_billing_list.bill_id,
    view_d2d_billing_list.sparepart_id,
    view_d2d_billing_list.price,
    view_d2d_billing_list.quantity,
    view_d2d_billing_list.total_price,
    view_d2d_billing_list.part_code,
    view_d2d_billing_list.part_name,
    view_d2d_billing_detail.billed_date,
    view_d2d_billing_detail.billed_to,
    view_d2d_billing_detail.billed_time,
    view_d2d_billing_detail.billed_to_dealer,
    view_d2d_billing_detail.dealer_id,
    view_d2d_billing_detail.dealer_name,
    view_d2d_billing_detail.bill_no
   FROM (view_d2d_billing_detail
     JOIN view_d2d_billing_list ON ((view_d2d_billing_list.bill_id = view_d2d_billing_detail.id)));

-- ----------------------------
-- View structure for view_report_dealer_dispatch
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_dealer_dispatch" AS 
 SELECT mdr.vehicle_id,
    mdr.variant_id,
    mdr.color_id,
    mdr.id,
    ldd.deleted_at,
    ldd.dealer_id,
    ldd.dispatched_date,
    ldd.vehicle_return_date,
    ldd.dispatched_date_np,
    ldd.dispatched_date_np_month,
    ldd.received_date,
    ldd.received_date_nep,
    mdr.engine_no,
    mdr.chass_no,
    dd.name AS dealer_name,
    mc.name AS color_name,
    mva.name AS variant_name,
    mve.name AS vehicle_name,
    mst_nepali_month.name AS month_name,
    ldd.dispatched_date_np_year,
    ldd.edit_month_np,
    mc.code AS color_code,
    mdr.year,
    mdr.company_name AS firm_name,
    mdr.nepal_custom,
    region.name AS region_name,
    zone.name AS zone_name,
    ldd.id AS log_dealer_dispatch_id,
    log_dealer_order.challan_status,
    log_dealer_order.location,
    ldd.driver_contact,
    ldd.driver_name,
    mdr.vehicle_register_no,
    mdr.invoice_no,
    mdr.invoice_date,
    ldd.fiscal_year,
    log_dealer_order.on_hold_remarks
   FROM (((((((((((log_dispatch_dealer ldd
     JOIN msil_dispatch_records mdr ON ((ldd.vehicle_id = mdr.id)))
     LEFT JOIN dms_dealers dd ON ((ldd.dealer_id = dd.id)))
     LEFT JOIN mst_colors mc ON ((mdr.color_id = mc.id)))
     LEFT JOIN mst_variants mva ON ((mdr.variant_id = mva.id)))
     LEFT JOIN mst_vehicles mve ON ((mdr.vehicle_id = mve.id)))
     LEFT JOIN mst_nepali_month ON ((ldd.edit_month_np = mst_nepali_month.id)))
     LEFT JOIN mst_firms mf ON ((mf.id = mve.firm_id)))
     JOIN mst_district_mvs district ON ((dd.district_id = district.id)))
     JOIN mst_district_mvs zone ON ((district.parent_id = zone.id)))
     JOIN mst_district_mvs region ON ((zone.parent_id = region.id)))
     JOIN log_dealer_order ON (((ldd.dealer_order_id = log_dealer_order.id) AND (log_dealer_order.credit_control_approval <> 4))));


CREATE OR REPLACE VIEW "public"."view_report_dealer_sales" AS 
 SELECT ldd.id,
    ldd.created_by,
    ldd.vehicle_id AS msil_vehicle_id,
    ldd.stock_yard_id,
    ldd.dealer_id,
    mdr.vehicle_id,
    mdr.variant_id,
    mdr.color_id,
    ldd.received_status,
    mv.name,
    mstv.name AS vehicle_name,
    mc.name AS color_name,
    mc.code AS color_code,
    vds.name AS dealer_name,
    vds.incharge_id,
    vds.incharge_name,
    vdm.parent_name,
    vdm.parent_id,
    vds.district_id,
    vds.district_name,
    ldd.dispatched_date AS dealer_dispatch_date,
    mdr.updated_by
   FROM ((((((log_dispatch_dealer ldd
     JOIN msil_dispatch_records mdr ON ((ldd.vehicle_id = mdr.id)))
     JOIN mst_variants mv ON ((mdr.variant_id = mv.id)))
     JOIN mst_vehicles mstv ON ((mdr.vehicle_id = mstv.id)))
     JOIN mst_colors mc ON ((mdr.color_id = mc.id)))
     JOIN view_dealers vds ON ((ldd.dealer_id = vds.id)))
     LEFT JOIN view_district_mvs vdm ON ((vds.district_id = vdm.id)));

CREATE OR REPLACE VIEW "public"."view_report_dealer_sales_total" AS 
 SELECT vra.dealer_id,
    vra.month,
    count(*) AS total_sales
   FROM view_report_achievement_dealer vra
  GROUP BY vra.dealer_id, vra.month
 HAVING (count(*) >= 1);

 CREATE OR REPLACE VIEW "public"."view_report_grouped_jobcard" AS 
 SELECT ser_job_cards.jobcard_group,
    ser_job_cards.vehicle_id,
    ser_job_cards.variant_id,
    ser_job_cards.service_type,
    ser_job_cards.vehicle_no,
    ser_job_cards.closed_status,
    ser_billing_record.issue_date,
    ser_job_cards.deleted_at,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_service_types.name AS service_type_name,
    ser_job_cards.issue_date AS job_card_issue_date,
    mst_user_ledger.full_name AS customer_name,
    mst_vehicles.firm_id,
    mst_firms.name AS firm_name,
    ser_job_cards.service_count,
    ser_job_cards.chassis_no,
    ser_job_cards.engine_no,
    ser_job_cards.kms,
    ser_job_cards.mechanics_id,
    ser_job_cards.year,
    ser_job_cards.reciever_name,
    ser_job_cards.remarks,
    ser_job_cards.dealer_id,
    ser_job_cards.jobcard_serial,
    ser_job_cards.color_id,
    mst_colors.name AS color_name,
    ser_job_cards.floor_supervisor_id,
    mst_vehicles.rank AS vehicle_rank,
    mst_variants.rank AS variant_rank,
    ser_job_cards.pdi_kms,
    mst_vehicles.service_policy_id,
    ser_job_cards.vehicle_sold_on,
    mst_user_ledger.address1,
    mst_user_ledger.address2,
    dms_dealers.name AS dealer_name,
    ser_job_cards.service_adviser_id,
    (((dms_employees.first_name)::text || ' '::text) || (dms_employees.last_name)::text) AS service_advisor_name,
    ser_job_cards.fiscal_year_id,
    (((flr.first_name)::text || ' '::text) || (flr.last_name)::text) AS floor_supervisor_name,
        CASE
            WHEN (sfs.jobcard_group IS NOT NULL) THEN 1
            ELSE 0
        END AS material_issued_status,
    ser_job_cards.coupon,
    mst_user_ledger.mobile,
    mst_user_ledger.pan_no,
    split_part((ser_job_cards.issue_date)::text, ' '::text, 1) AS inquiry_date_en,
    ser_billing_record.invoice_no,
    ser_job_cards.tire_make,
    ser_job_cards.battery_no,
    view_jobcard_material_scan_group.issue_date AS material_issued_date,
    ser_billing_record.net_total,
    ser_billing_record.issue_date AS billed_date,
    ser_job_cards.closed_date,
        CASE
            WHEN (ser_billing_record.issue_date IS NOT NULL) THEN 1
            ELSE 0
        END AS billed,
    ((('now'::text)::date)::timestamp without time zone - ser_job_cards.issue_date) AS age
   FROM ((((((((((((ser_job_cards
     JOIN mst_service_types ON ((ser_job_cards.service_type = mst_service_types.id)))
     LEFT JOIN ser_billing_record ON ((ser_job_cards.jobcard_group = ser_billing_record.jobcard_group)))
     LEFT JOIN mst_variants ON ((ser_job_cards.variant_id = mst_variants.id)))
     JOIN mst_vehicles ON ((ser_job_cards.vehicle_id = mst_vehicles.id)))
     LEFT JOIN mst_user_ledger ON ((ser_job_cards.party_id = mst_user_ledger.id)))
     LEFT JOIN mst_firms ON ((mst_vehicles.firm_id = mst_firms.id)))
     LEFT JOIN mst_colors ON ((ser_job_cards.color_id = mst_colors.id)))
     LEFT JOIN dms_dealers ON ((ser_job_cards.dealer_id = dms_dealers.id)))
     LEFT JOIN dms_employees ON ((dms_employees.user_id = ser_job_cards.service_adviser_id)))
     LEFT JOIN dms_employees flr ON ((ser_job_cards.floor_supervisor_id = flr.user_id)))
     LEFT JOIN view_floor_supervisor_adviced sfs ON (((sfs.jobcard_group = ser_job_cards.jobcard_group) AND (ser_job_cards.dealer_id = sfs.dealer_id))))
     LEFT JOIN view_jobcard_material_scan_group ON ((ser_job_cards.jobcard_group = view_jobcard_material_scan_group.jobcard_group)))
  WHERE ((ser_job_cards.deleted_at > now()) OR (ser_job_cards.deleted_at IS NULL))
  GROUP BY ser_job_cards.vehicle_no, ser_job_cards.variant_id, ser_job_cards.service_type, ser_job_cards.vehicle_id, mst_service_types.name, ser_job_cards.jobcard_group, ser_job_cards.closed_status, ser_billing_record.issue_date, ser_job_cards.deleted_at, mst_variants.name, mst_vehicles.name, ser_job_cards.issue_date, mst_user_ledger.full_name, mst_vehicles.firm_id, mst_firms.name, ser_job_cards.service_count, ser_job_cards.chassis_no, ser_job_cards.engine_no, ser_job_cards.kms, ser_job_cards.mechanics_id, ser_job_cards.year, ser_job_cards.reciever_name, ser_job_cards.remarks, ser_job_cards.dealer_id, ser_job_cards.jobcard_serial, ser_job_cards.color_id, mst_colors.name, ser_job_cards.floor_supervisor_id, mst_vehicles.rank, mst_variants.rank, ser_job_cards.pdi_kms, mst_vehicles.service_policy_id, ser_job_cards.vehicle_sold_on, mst_user_ledger.address1, mst_user_ledger.address2, dms_dealers.name, ser_job_cards.service_adviser_id, dms_employees.first_name, dms_employees.last_name, ser_job_cards.fiscal_year_id, flr.first_name, flr.last_name, sfs.jobcard_group, ser_job_cards.coupon, mst_user_ledger.mobile, mst_user_ledger.pan_no, ser_billing_record.invoice_no, ser_job_cards.tire_make, ser_job_cards.battery_no, view_jobcard_material_scan_group.issue_date, ser_billing_record.net_total, ser_job_cards.closed_date;


CREATE OR REPLACE VIEW "public"."view_report_grouped_outsidework" AS 
 SELECT ow.send_date,
    ow.workshop_id,
    ow.jobcard_group,
    ow.splr_invoice_no,
    ow.splr_invoice_date,
    ow.gross_total,
    ow.round_off,
    ow.net_amount,
    ow.billing_amount,
    ow.billing_discount_percent,
    ow.billing_final_amount,
    ow.remarks
   FROM ser_outside_work ow
  GROUP BY ow.jobcard_group, ow.workshop_id, ow.splr_invoice_no, ow.send_date, ow.splr_invoice_date, ow.gross_total, ow.round_off, ow.net_amount, ow.billing_amount, ow.billing_discount_percent, ow.billing_final_amount, ow.remarks;

-- ----------------------------
-- View structure for view_report_inquiry_history
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_inquiry_history" AS 
 SELECT crm_vehicle_edit.prev_vehicle,
    crm_vehicle_edit.prev_variant,
    crm_vehicle_edit.prev_color,
    crm_vehicle_edit.new_vehicle,
    crm_vehicle_edit.new_variant,
    crm_vehicle_edit.new_color,
    crm_vehicle_edit.status_id,
    mst_inquiry_statuses.name AS status_name_new,
    v1.name AS prev_color_name,
    v2.name AS new_color_name,
    v3.name AS prev_variant_name,
    v4.name AS new_variant_name,
    v5.name AS prev_vehicle_name,
    v6.name AS new_vehicle_name,
    crm_vehicle_edit.date_np,
    crm_vehicle_edit.date,
    crm_vehicle_edit.customer_id,
    crm_vehicle_edit.id,
    crm_vehicle_edit.deleted_by,
    crm_vehicle_edit.deleted_at
   FROM (((((((crm_vehicle_edit
     LEFT JOIN mst_inquiry_statuses ON ((crm_vehicle_edit.status_id = mst_inquiry_statuses.id)))
     LEFT JOIN mst_colors v1 ON ((crm_vehicle_edit.prev_color = v1.id)))
     LEFT JOIN mst_colors v2 ON ((crm_vehicle_edit.new_color = v2.id)))
     LEFT JOIN mst_variants v3 ON ((crm_vehicle_edit.prev_variant = v3.id)))
     LEFT JOIN mst_variants v4 ON ((crm_vehicle_edit.new_variant = v4.id)))
     LEFT JOIN mst_vehicles v5 ON ((crm_vehicle_edit.prev_vehicle = v5.id)))
     LEFT JOIN mst_vehicles v6 ON ((crm_vehicle_edit.new_vehicle = v6.id)));


CREATE OR REPLACE VIEW "public"."view_report_log_credit_control_delay" AS 
 SELECT ldo.order_id,
    ldo.dealer_id,
    ldo.vehicle_id,
    ldo.variant_id,
    ldo.color_id,
    ldo.quantity,
    ldo.date_of_order,
    ldo.credit_approve_date,
    ldo.remarks,
    ldo.payment_method,
    ldo.associated_value_payment,
    (('now'::text)::date - ldo.credit_approve_date) AS credit_control_age,
    concat(ldo.payment_method, '-', ldo.associated_value_payment) AS payment_value,
    mst_vehicles.name AS vehicle_name,
    mst_vehicles.rank,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name,
    dms_dealers.name AS dealer_name,
    dms_dealers.incharge_id
   FROM ((((log_dealer_order ldo
     JOIN mst_vehicles ON ((ldo.vehicle_id = mst_vehicles.id)))
     JOIN mst_variants ON ((ldo.variant_id = mst_variants.id)))
     JOIN mst_colors ON ((ldo.color_id = mst_colors.id)))
     JOIN dms_dealers ON ((ldo.dealer_id = dms_dealers.id)))
  WHERE (((ldo.credit_approve_date IS NOT NULL) AND ((('now'::text)::date - ldo.credit_approve_date) >= 1)) AND (ldo.cancel_date IS NULL))
  ORDER BY ldo.order_id;

-- ----------------------------
-- View structure for view_report_log_dealer_order_summary
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_log_dealer_order_summary" AS 
 SELECT ldo.vehicle_id,
    ldo.variant_id,
    ldo.color_id,
    ldo.date_of_order,
    ldo.dealer_id,
    ldd.id,
    dd.name AS dealer_name,
    mc.name AS color_name,
    mva.name AS variant_name,
    mve.name AS vehicle_name,
    mc.code AS color_code,
    ldo.credit_control_approval,
    ldo.credit_approve_date,
    mst_nepali_month.name AS nepali_month,
    ldo.cancel_date,
        CASE
            WHEN (ldo.in_stock_remarks = 1) THEN 'In Stock'::text
            WHEN (ldo.in_stock_remarks = 0) THEN 'No Stock'::text
            WHEN (ldo.in_stock_remarks = 2) THEN 'In Transit'::text
            WHEN (ldo.in_stock_remarks = 3) THEN 'Outside Ktm'::text
            ELSE 'No Stock'::text
        END AS stock_status
   FROM ((((((log_dealer_order ldo
     LEFT JOIN log_dispatch_dealer ldd ON ((ldd.dealer_order_id = ldo.id)))
     JOIN dms_dealers dd ON ((ldo.dealer_id = dd.id)))
     JOIN mst_colors mc ON ((ldo.color_id = mc.id)))
     JOIN mst_variants mva ON ((ldo.variant_id = mva.id)))
     JOIN mst_vehicles mve ON ((ldo.vehicle_id = mve.id)))
     LEFT JOIN mst_nepali_month ON ((ldo.order_month_id = mst_nepali_month.id)));

-- ----------------------------
-- View structure for view_report_log_logistic_delay
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_log_logistic_delay" AS 
 SELECT ldo.vehicle_id,
    ldo.variant_id,
    ldo.color_id,
    ldo.credit_approve_date,
    ldd.remarks_delay,
    ldo.dealer_id,
    ldo.order_id,
    mst_vehicles.name AS vehicle_name,
    mst_vehicles.rank,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name,
    mst_colors.code AS color_code,
    dms_dealers.name AS dealer_name,
    dms_dealers.incharge_id,
    (('now'::text)::date - ldo.credit_approve_date) AS logistic_delay,
    ldo.date_of_order
   FROM (((((log_dealer_order ldo
     JOIN log_dispatch_dealer ldd ON ((ldd.dealer_order_id = ldo.id)))
     JOIN mst_vehicles ON ((ldo.vehicle_id = mst_vehicles.id)))
     JOIN mst_variants ON ((ldo.variant_id = mst_variants.id)))
     JOIN mst_colors ON ((ldo.color_id = mst_colors.id)))
     JOIN dms_dealers ON ((ldo.dealer_id = dms_dealers.id)))
  WHERE (ldo.cancel_date IS NULL);


CREATE OR REPLACE VIEW "public"."view_report_monthwise_dispatch" AS 
 SELECT ldd.dispatched_date,
    msil.vehicle_id,
    msil.variant_id,
    mve.id,
    mve.name AS vehicle_name,
    mva.name AS variant_name,
    date_part('month'::text, ldd.dispatched_date) AS month,
    date_part('year'::text, ldd.dispatched_date) AS year,
        CASE
            WHEN (date_part('month'::text, ldd.dispatched_date) = (1)::double precision) THEN 'JAN'::text
            WHEN (date_part('month'::text, ldd.dispatched_date) = (2)::double precision) THEN 'FEB'::text
            WHEN (date_part('month'::text, ldd.dispatched_date) = (3)::double precision) THEN 'MAR'::text
            WHEN (date_part('month'::text, ldd.dispatched_date) = (4)::double precision) THEN 'APR'::text
            WHEN (date_part('month'::text, ldd.dispatched_date) = (5)::double precision) THEN 'MAY'::text
            WHEN (date_part('month'::text, ldd.dispatched_date) = (6)::double precision) THEN 'JUN'::text
            WHEN (date_part('month'::text, ldd.dispatched_date) = (7)::double precision) THEN 'JUL'::text
            WHEN (date_part('month'::text, ldd.dispatched_date) = (8)::double precision) THEN 'AUG'::text
            WHEN (date_part('month'::text, ldd.dispatched_date) = (9)::double precision) THEN 'SEP'::text
            WHEN (date_part('month'::text, ldd.dispatched_date) = (10)::double precision) THEN 'OCT'::text
            WHEN (date_part('month'::text, ldd.dispatched_date) = (11)::double precision) THEN 'NOV'::text
            WHEN (date_part('month'::text, ldd.dispatched_date) = (12)::double precision) THEN 'DEC'::text
            ELSE NULL::text
        END AS month_name,
    ldd.vehicle_return_date,
    msil.color_id,
    ldd.dealer_id,
    dms_dealers.name AS dealer_name,
    dms_dealers.incharge_id
   FROM ((((msil_dispatch_records msil
     JOIN log_dispatch_dealer ldd ON ((msil.id = ldd.vehicle_id)))
     JOIN mst_vehicles mve ON ((msil.vehicle_id = mve.id)))
     JOIN mst_variants mva ON ((msil.variant_id = mva.id)))
     JOIN dms_dealers ON ((ldd.dealer_id = dms_dealers.id)))
  ORDER BY date_part('month'::text, ldd.dispatched_date);

-- ----------------------------
-- View structure for view_report_msil_dispatch
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_msil_dispatch" AS 
 SELECT msil_dispatch_records.id,
    msil_dispatch_records.deleted_at,
    msil_dispatch_records.vehicle_id,
    msil_dispatch_records.variant_id,
    msil_dispatch_records.color_id,
    msil_dispatch_records.dispatch_date,
    msil_dispatch_records.year,
    msil_dispatch_records.invoice_no,
    msil_dispatch_records.engine_no,
    msil_dispatch_records.chass_no,
    msil_dispatch_records.current_status,
    msil_dispatch_records.current_location,
    msil_dispatch_records.pragyapan_no,
    msil_dispatch_records.key_no,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name,
    msil_dispatch_records.indian_custom,
    msil_dispatch_records.nepal_custom
   FROM (((msil_dispatch_records
     JOIN mst_vehicles ON ((msil_dispatch_records.vehicle_id = mst_vehicles.id)))
     JOIN mst_variants ON ((msil_dispatch_records.variant_id = mst_variants.id)))
     JOIN mst_colors ON ((msil_dispatch_records.color_id = mst_colors.id)));


CREATE OR REPLACE VIEW "public"."view_report_msil_order" AS 
 SELECT vmdl.vehicle_name,
    vmdl.variant_name,
    vmdl.color_name,
    vmdl.color_id,
    vmdl.variant_id,
    vmdl.vehicle_id,
    vmdl.order_type,
    sum(vmdl.quantity) AS total_order_quantity,
    sum(vmdl.received_quantity) AS total_received_quantity,
    sum(vmdl.cancel_quantity) AS total_cancel_quantity,
    vmdl.month,
    vmdl.year,
    vmdl.deleted_at
   FROM view_msil_dispatch_vehicles vmdl
  GROUP BY vmdl.vehicle_name, vmdl.variant_name, vmdl.color_name, vmdl.color_id, vmdl.variant_id, vmdl.vehicle_id, vmdl.order_type, vmdl.month, vmdl.year, vmdl.deleted_at;


CREATE OR REPLACE VIEW "public"."view_report_revenue" AS 
 SELECT rg.jobcard_group,
    rg.vehicle_id,
    rg.variant_id,
    rg.service_type,
    rg.vehicle_no,
    rg.closed_status,
    rg.issue_date,
    rg.deleted_at,
    rg.vehicle_name,
    rg.variant_name,
    rg.service_type_name,
    rg.job_card_issue_date,
    rg.customer_name,
    rg.firm_id,
    rg.firm_name,
    rg.service_count,
    rg.chassis_no,
    rg.engine_no,
    rg.kms,
    rg.mechanics_id,
    rg.year,
    rg.reciever_name,
    rg.remarks,
    rg.dealer_id,
    rg.jobcard_serial,
    rg.color_id,
    rg.color_name,
    rg.floor_supervisor_id,
    rg.vehicle_rank,
    rg.variant_rank,
    rg.pdi_kms,
    rg.service_policy_id,
    rg.vehicle_sold_on,
    rg.address1,
    rg.address2,
    rg.dealer_name,
    rg.service_adviser_id,
    rg.service_advisor_name,
    rg.fiscal_year_id,
    spc.name,
    bp.price,
    br.id AS billing_id,
    ser_billed_jobs.price AS labourprice,
    br.issue_date AS billing_issue_date
   FROM (((((view_report_grouped_jobcard rg
     LEFT JOIN ser_billing_record br ON ((rg.jobcard_group = br.jobcard_group)))
     LEFT JOIN ser_billed_parts bp ON ((br.id = bp.billing_id)))
     LEFT JOIN mst_spareparts sp ON ((bp.part_id = sp.id)))
     LEFT JOIN mst_spareparts_category spc ON ((sp.category_id = spc.id)))
     JOIN ser_billed_jobs ON ((br.id = ser_billed_jobs.billing_id)));


CREATE OR REPLACE VIEW "public"."view_report_service_counter_sales" AS 
 SELECT bp.price,
    bp.quantity,
    bp.final_amount,
    br.invoice_no,
    ((bp.price * (bp.quantity)::double precision) - bp.final_amount) AS discount,
    sp.name AS part_name,
    sp.part_code,
    cs.id,
    cs.updated_by,
    cs.deleted_by,
    cs.created_at,
    cs.updated_at,
    cs.deleted_at,
    cs.counter_sales_id,
    cs.vehicle_no,
    cs.chasis_no,
    cs.engine_no,
    cs.vehicle_id,
    cs.variant_id,
    cs.color_id,
    cs.party_id,
    cs.date_time,
    cs.billing_record_id,
    cs.dealer_id,
    cs.is_request_complete,
    cs.is_countersale_billed,
    cs.is_countersale_closed,
    cs.created_by,
    ((bp.final_amount * br.vat_percent) / (100)::double precision) AS vat_amount,
    br.vat_percent,
    dms_dealers.name AS dealer_name,
    ((bp.final_amount - ((bp.price * (bp.quantity)::double precision) - bp.final_amount)) + ((bp.final_amount * br.vat_percent) / (100)::double precision)) AS net_total,
    br.bill_type,
    br.payment_type,
    br.issue_date AS billing_issue_date,
    br.cash_discount_amt,
    mst_user_ledger.full_name
   FROM (((((ser_counter_sales cs
     JOIN ser_billing_record br ON ((cs.billing_record_id = br.id)))
     LEFT JOIN ser_billed_parts bp ON ((br.id = bp.billing_id)))
     LEFT JOIN mst_spareparts sp ON ((bp.part_id = sp.id)))
     JOIN dms_dealers ON ((cs.dealer_id = dms_dealers.id)))
     LEFT JOIN mst_user_ledger ON ((cs.party_id = mst_user_ledger.id)));

-- ----------------------------
-- View structure for view_report_service_mechanic_consume_helper
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_service_mechanic_consume_helper" AS 
 SELECT sbp.price AS part_price,
    sbp.part_id,
    ms.part_code,
    ser_billing_record.jobcard_group,
    ser_workshop_users.first_name,
    ser_workshop_users.middle_name,
    ser_workshop_users.last_name,
    ser_billing_record.vat_percent,
    ser_billing_record.total_parts,
    ser_billing_record.vat_parts,
    ser_billing_record.net_total,
    ser_billing_record.dealer_id,
    ser_billing_record.counter_sales_id,
    view_report_grouped_jobcard.vehicle_name,
    view_report_grouped_jobcard.variant_name,
    view_report_grouped_jobcard.service_type_name,
    view_report_grouped_jobcard.job_card_issue_date,
    view_report_grouped_jobcard.chassis_no,
    view_report_grouped_jobcard.engine_no,
    view_report_grouped_jobcard.kms,
    view_report_grouped_jobcard.dealer_name,
    ser_billing_record.issue_date,
    sbp.final_amount,
    ms.name AS part_name
   FROM ((((ser_billed_parts sbp
     LEFT JOIN mst_spareparts ms ON ((sbp.part_id = ms.id)))
     LEFT JOIN ser_billing_record ON ((sbp.billing_id = ser_billing_record.id)))
     LEFT JOIN view_report_grouped_jobcard ON ((ser_billing_record.jobcard_group = view_report_grouped_jobcard.jobcard_group)))
     LEFT JOIN ser_workshop_users ON ((view_report_grouped_jobcard.mechanics_id = ser_workshop_users.id)));

-- ----------------------------
-- View structure for view_report_spareparts_backorder
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_spareparts_backorder" AS 
 SELECT so.id,
    so.deleted_at,
    so.sparepart_id,
    so.dealer_id,
    so.order_quantity,
    so.order_no,
    COALESCE(sum(sd.dispatched_quantity), (0)::bigint) AS dispatched_quantity,
    msd.name AS dealer_name,
    msd.incharge_id,
    msd.prefix,
    so.order_type,
    concat(msd.prefix, '-', so.order_no) AS order_no_concat,
    ms.name AS part_name,
    ms.latest_part_code,
    ms.part_code,
    ((so.order_quantity - COALESCE((so.received_quantity)::bigint, (0)::bigint)) - so.cancle_quantity) AS backorder,
    to_char(so.created_at, 'YYYY-MM-DD'::text) AS created_date,
    so.pi_number,
    so.proforma_invoice_id,
    msd.service_incharge_id,
    msd.spares_incharge_id,
    so.pi_generated_date_time,
    so.dispatch_mode,
    ms.dealer_price,
    so.order_date,
    so.order_date_np,
    spareparts_sparepart_stock.quantity AS current_stock,
    spareparts_sparepart_stock.location
   FROM ((((spareparts_sparepart_order so
     LEFT JOIN spareparts_dispatch_spareparts sd ON ((so.id = sd.order_id)))
     JOIN dms_dealers msd ON ((so.dealer_id = msd.id)))
     JOIN mst_spareparts ms ON ((so.sparepart_id = ms.id)))
     LEFT JOIN spareparts_sparepart_stock ON ((sd.stock_id = spareparts_sparepart_stock.id)))
  GROUP BY so.sparepart_id, so.dealer_id, so.order_quantity, so.order_no, so.id, msd.name, msd.incharge_id, so.order_type, msd.prefix, ms.part_code, ms.name, ms.latest_part_code, msd.spares_incharge_id, msd.service_incharge_id, ms.dealer_price, spareparts_sparepart_stock.quantity, spareparts_sparepart_stock.location;

-- ----------------------------
-- View structure for view_report_spareparts_dealer_aging
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_spareparts_dealer_aging" AS 
 SELECT smo.id,
    smo.part_code,
    smo.name AS part_name,
    ((smo.order_quantity - smo.received_quantity) - smo.cancle_quantity) AS remaining_quantity,
    ((((smo.order_quantity - smo.received_quantity) - smo.cancle_quantity))::numeric * smo.dealer_price) AS total_amount,
    smo.pi_generated_date_time,
    smo.sparepart_id,
    (('now'::text)::date - smo.pi_generated_date_time) AS age,
    smo.dealer_price AS price,
    smo.spares_incharge_id,
    smo.dealer_id,
    smo.dealer_name
   FROM ( SELECT so.dealer_id,
            so.id,
            so.pi_generated_date_time,
            so.cancle_quantity,
            so.order_quantity,
            so.received_quantity,
            msd.spares_incharge_id,
            ms.dealer_price,
            ms.part_code,
            ms.name,
            msd.name AS dealer_name,
            so.sparepart_id
           FROM ((spareparts_sparepart_order so
             JOIN mst_spareparts ms ON ((so.sparepart_id = ms.id)))
             JOIN dms_dealers msd ON ((so.dealer_id = msd.id)))) smo;

-- ----------------------------
-- View structure for view_report_spareparts_dealer_sales
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_spareparts_dealer_sales" AS 
 SELECT spareparts_dealersales_list.id,
    spareparts_dealersales_list.created_by,
    spareparts_dealersales_list.updated_by,
    spareparts_dealersales_list.deleted_by,
    spareparts_dealersales_list.created_at,
    spareparts_dealersales_list.updated_at,
    spareparts_dealersales_list.deleted_at,
    spareparts_dealersales_list.sparepart_id,
    spareparts_dealersales_list.quantity,
    spareparts_dealersales_list.price,
    spareparts_dealersales_list.dealer_sales_id,
    spareparts_dealersales_list.dispatch_date_nep,
    spareparts_dealersales_list.discount_percentage,
    mst_spareparts.part_code,
    mst_spareparts.alternate_part_code,
    mst_spareparts.name AS part_name,
    spareparts_dealer_sales.taxable_total,
    spareparts_dealer_sales.vat_amount,
    spareparts_dealer_sales.discount AS discount_amount,
    dms_dealers.name AS dealer_name,
    spareparts_dealer_sales.total_amount,
    mst_spareparts.latest_part_code,
    spareparts_dealer_sales.date,
    spareparts_dealer_sales.nep_date,
    mst_spareparts_category.name AS category_name,
    mst_spareparts.category_id,
    dms_dealers.incharge_id,
    spareparts_dealer_sales.dealer_id
   FROM ((((spareparts_dealersales_list
     LEFT JOIN spareparts_dealer_sales ON ((spareparts_dealersales_list.dealer_sales_id = spareparts_dealer_sales.id)))
     LEFT JOIN mst_spareparts ON ((spareparts_dealersales_list.sparepart_id = mst_spareparts.id)))
     LEFT JOIN dms_dealers ON ((spareparts_dealer_sales.dealer_id = dms_dealers.id)))
     LEFT JOIN mst_spareparts_category ON ((mst_spareparts.category_id = mst_spareparts_category.id)));

-- ----------------------------
-- View structure for view_report_spareparts_grouped_order_generate
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_spareparts_grouped_order_generate" AS 
 SELECT sog.final_order_no,
    sog.order_no,
    sog.nep_date,
    sog.date,
    sum(sog.quantity) AS total_quantity,
    sum(((sog.quantity)::numeric * ms.price)) AS total_amount,
    sog.pi_number,
    sog.pi_received_date,
    sog.pi_received_date_np,
    sog.pi_received_date_np_year,
    sog.pi_received_date_np_month,
    sog.pi_confirmed_date,
    sog.pi_confirmed_date_np,
    sog.pi_confirmed_date_np_year,
    sog.pi_confirmed_date_np_month,
    sog.nep_date_year,
    sog.nep_date_month,
    mst_nepali_month.name
   FROM ((spareparts_order_generate sog
     JOIN mst_spareparts ms ON ((sog.sparepart_id = ms.id)))
     JOIN mst_nepali_month ON (((sog.nep_date_month)::integer = mst_nepali_month.id)))
  GROUP BY sog.order_no, sog.date, sog.nep_date, sog.final_order_no, sog.pi_number, sog.pi_received_date, sog.pi_received_date_np, sog.pi_received_date_np_year, sog.pi_received_date_np_month, sog.pi_confirmed_date, sog.pi_confirmed_date_np, sog.pi_confirmed_date_np_year, sog.pi_confirmed_date_np_month, sog.nep_date_year, sog.nep_date_month, mst_nepali_month.name;

-- ----------------------------
-- View structure for view_report_spareparts_msil_purchase_consignment
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_spareparts_msil_purchase_consignment" AS 
 SELECT msorder.invoice_no,
    msorder.mst_part_id,
    msorder.part_code,
    msorder.part_name,
    msorder.quantity,
    ((msorder.unit_rate)::numeric * 1.6) AS unit_rate,
    ((((msorder.quantity)::double precision * (msorder.unit_rate)::double precision))::numeric * 1.6) AS base_total,
    sum_total.net_total,
    ((((lcost.custom / (sum_total.net_total)::double precision) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision) AS custom_cost,
    ((((lcost.custom_other / (sum_total.net_total)::double precision) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision) AS custom_other_cost,
    ((((lcost.lc_comm / (sum_total.net_total)::double precision) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision) AS lc_comm_cost,
    ((((lcost.unload / (sum_total.net_total)::double precision) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision) AS unload_cost,
    ((((lcost.freight / (sum_total.net_total)::double precision) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision) AS freight_cost,
    ((((lcost.insurance / (sum_total.net_total)::double precision) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision) AS insurance_cost,
    ((((lcost.bank_charge / (sum_total.net_total)::double precision) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision) AS bank_charge_cost,
    ((((lcost.vat / (sum_total.net_total)::double precision) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision) AS vat_cost,
    (((((((((COALESCE((lcost.custom / (sum_total.net_total)::double precision), (0)::double precision) + COALESCE((lcost.custom_other / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.lc_comm / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.unload / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.freight / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.insurance / (sum_total.net_total)::double precision), (0)::double precision)) + (((COALESCE((lcost.bank_charge / (sum_total.net_total)::double precision), (0)::double precision) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision)) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision) AS total_addnl,
    ((((((((((COALESCE((lcost.custom / (sum_total.net_total)::double precision), (0)::double precision) + COALESCE((lcost.custom_other / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.lc_comm / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.unload / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.freight / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.insurance / (sum_total.net_total)::double precision), (0)::double precision)) + (((COALESCE((lcost.bank_charge / (sum_total.net_total)::double precision), (0)::double precision) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision)) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision) + (((((msorder.quantity)::double precision * (msorder.unit_rate)::double precision))::numeric * 1.6))::double precision) AS net_amount,
    (((((((((((COALESCE((lcost.custom / (sum_total.net_total)::double precision), (0)::double precision) + COALESCE((lcost.custom_other / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.lc_comm / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.unload / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.freight / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.insurance / (sum_total.net_total)::double precision), (0)::double precision)) + (((COALESCE((lcost.bank_charge / (sum_total.net_total)::double precision), (0)::double precision) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision)) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision) + (((((msorder.quantity)::double precision * (msorder.unit_rate)::double precision))::numeric * 1.6))::double precision) - (((((((((COALESCE((lcost.custom / (sum_total.net_total)::double precision), (0)::double precision) + COALESCE((lcost.custom_other / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.lc_comm / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.unload / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.freight / (sum_total.net_total)::double precision), (0)::double precision)) + COALESCE((lcost.insurance / (sum_total.net_total)::double precision), (0)::double precision)) + (((COALESCE((lcost.bank_charge / (sum_total.net_total)::double precision), (0)::double precision) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision)) * (msorder.quantity)::double precision) * (msorder.unit_rate)::double precision) * (1.6)::double precision)) AS cost_rate,
    msorder.created_at AS request_date
   FROM ((spareparts_msil_order msorder
     LEFT JOIN ( SELECT msorder_1.invoice_no,
            sum((((msorder_1.unit_rate)::numeric * 1.6) * (msorder_1.quantity)::numeric)) AS net_total
           FROM spareparts_msil_order msorder_1
          GROUP BY msorder_1.invoice_no) sum_total ON (((sum_total.invoice_no)::text = (msorder.invoice_no)::text)))
     LEFT JOIN spareparts_landed_cost lcost ON (((msorder.invoice_no)::text = (lcost.invoice_no)::text)))
  GROUP BY msorder.invoice_no, msorder.mst_part_id, msorder.part_code, msorder.part_name, msorder.quantity, msorder.unit_rate, sum_total.net_total, lcost.custom, lcost.custom_other, lcost.lc_comm, lcost.unload, lcost.freight, lcost.insurance, lcost.bank_charge, lcost.vat, msorder.created_at
  ORDER BY msorder.invoice_no;

-- ----------------------------
-- View structure for view_report_spareparts_msil_service_level
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_spareparts_msil_service_level" AS 
 SELECT spi.order_no,
    count(spi.id) AS total_order_count,
    msil_dispatch.total_dispatch_count,
    ((msil_dispatch.total_dispatch_count * 100) / count(spi.order_no)) AS line_percentage,
    sum(spi.quantity) AS total_order_quantity,
    msil_dispatch.total_dispatch_quantity,
    ((msil_dispatch.total_dispatch_quantity * 100) / sum(spi.quantity)) AS quantity_percentage,
    spi.reached_date,
    msil_dispatch.total_dispatched_amount
   FROM (spareparts_pi_import spi
     LEFT JOIN ( SELECT smo.order_no,
            count(smo.order_no) AS total_dispatch_count,
            sum(smo.quantity) AS total_dispatch_quantity,
            sum(smo.unit_rate) AS total_dispatched_amount
           FROM spareparts_msil_order smo
          GROUP BY smo.order_no) msil_dispatch ON (((spi.order_no)::text = (msil_dispatch.order_no)::text)))
  GROUP BY spi.order_no, msil_dispatch.total_dispatch_count, msil_dispatch.total_dispatch_quantity, spi.reached_date, msil_dispatch.total_dispatched_amount;

-- ----------------------------
-- View structure for view_report_spareparts_order_vs_dispatch
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_spareparts_order_vs_dispatch" AS 
 SELECT sso.id,
    sso.deleted_at,
    sso.sparepart_id,
    sso.dealer_id,
    sso.proforma_invoice_id,
    sso.order_quantity,
    msd.name AS dealer_name,
    msd.parent_id,
    gd.total_dispatch,
    (sso.order_quantity - gd.total_dispatch) AS remaining_order,
    ((gd.total_dispatch / sso.order_quantity) * 100) AS service_level,
    sso.request_date,
    sso.request_date_np,
    gd.dispatched_date,
    gd.dispatched_date_nepali,
    sso.request_date_np_year,
    sso.request_date_np_month
   FROM ((spareparts_sparepart_order sso
     JOIN dms_dealers msd ON ((sso.dealer_id = msd.id)))
     LEFT JOIN ( SELECT sum(sds.dispatched_quantity) AS total_dispatch,
            sds.order_id,
            sds.dispatched_date,
            sds.dispatched_date_nepali
           FROM spareparts_dispatch_spareparts sds
          GROUP BY sds.order_id, sds.dispatched_date, sds.dispatched_date_nepali) gd ON ((gd.order_id = sso.id)))
  WHERE (sso.order_cancel = 0);

-- ----------------------------
-- View structure for view_report_spareparts_product_in_out
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_spareparts_product_in_out" AS 
 SELECT ms.latest_part_code,
    ms.name AS part_name,
    sos.id,
    sos.sparepart_id,
    sos.opening_stock_date,
    sos.year_np,
    sos.month_np,
    sos.opening_stock_date_np,
    sos.quantity AS opening_stock,
    COALESCE(vds.total_dispatched, (0)::bigint) AS total_dispatched,
    COALESCE(vmd.total_msil_dispatch, (0)::bigint) AS total_msil_dispatched,
    ((sos.quantity + COALESCE(vmd.total_msil_dispatch, (0)::bigint)) - COALESCE(vds.total_dispatched, (0)::bigint)) AS closing_stock,
    sos.dealer_id,
    ms.price,
    ((sos.quantity)::numeric * ms.price) AS opening_stock_value,
    ((COALESCE(vds.total_dispatched, (0)::bigint))::numeric * ms.price) AS total_sales_value,
    ((COALESCE(vmd.total_msil_dispatch, (0)::bigint))::numeric * ms.price) AS total_purchase_value,
    ((((sos.quantity + COALESCE(vmd.total_msil_dispatch, (0)::bigint)))::numeric - (COALESCE(vds.total_dispatched, (0)::bigint))::numeric) * ms.price) AS closing_stock_value
   FROM (((spareparts_opening_stock sos
     LEFT JOIN mst_spareparts ms ON ((sos.sparepart_id = ms.id)))
     LEFT JOIN ( SELECT sso.sparepart_id,
            sds.year_np,
            sds.month_np,
            sum(sds.dispatched_quantity) AS total_dispatched
           FROM (spareparts_dispatch_spareparts sds
             JOIN spareparts_sparepart_order sso ON ((sds.order_id = sso.id)))
          GROUP BY sso.sparepart_id, sds.year_np, sds.month_np) vds ON ((((vds.sparepart_id = sos.sparepart_id) AND ((vds.year_np)::text = (sos.year_np)::text)) AND ((vds.month_np)::text = (sos.month_np)::text))))
     LEFT JOIN ( SELECT smo.mst_part_id,
            smo.year_np,
            smo.month_np,
            sum(smo.quantity) AS total_msil_dispatch
           FROM spareparts_msil_order smo
          GROUP BY smo.mst_part_id, smo.year_np, smo.month_np) vmd ON ((((vmd.mst_part_id = sos.sparepart_id) AND ((vmd.year_np)::text = (sos.year_np)::text)) AND ((vmd.month_np)::text = (sos.month_np)::text))));


CREATE OR REPLACE VIEW "public"."view_report_spareparts_requirements_vs_results" AS 
 SELECT rso.id,
    rso.request_date,
    rso.request_date_np,
    rso.dealer_id,
    rso.dealer_name,
    rso.proforma_invoice_id AS pi_num,
    rso.sparepart_id AS part_number,
    sp.name AS part_name,
    rso.order_quantity AS req_quantity,
    sp.price AS unit_price,
    ((rso.order_quantity)::numeric * sp.price) AS req_price,
    rso.remaining_order AS pending_qty,
    NULL::unknown AS invoice_no,
    rso.dispatched_date,
    rso.dispatched_date_nepali,
    rso.total_dispatch AS dispatch_qty,
    ((rso.total_dispatch)::numeric * sp.price) AS dispatch_price,
    (((rso.order_quantity)::numeric * sp.price) * 0.13) AS vat,
    ((((rso.order_quantity)::numeric * sp.price) * 0.13) + (rso.total_dispatch)::numeric) AS net_amount,
    ((rso.total_dispatch / rso.order_quantity) * 100) AS service_level,
    rso.request_date_np_year,
    rso.request_date_np_month,
    sp.latest_part_code,
    sp.part_code
   FROM (view_report_spareparts_order_vs_dispatch rso
     LEFT JOIN mst_spareparts sp ON ((rso.sparepart_id = sp.id)))
  ORDER BY rso.dealer_name, rso.proforma_invoice_id DESC;


CREATE OR REPLACE VIEW "public"."view_report_spareparts_sales" AS 
 SELECT spareparts_dispatch_spareparts.deleted_at,
    spareparts_dispatch_spareparts.dispatched_quantity,
    spareparts_dispatch_spareparts.dispatched_date,
    dms_dealers.name AS dealer_name,
    dms_dealers.spares_incharge_id,
    dms_dealers.service_incharge_id,
    spareparts_dispatch_spareparts.dealer_id,
    mst_spareparts.part_code,
    mst_spareparts.alternate_part_code,
    mst_spareparts.name AS part_name,
    mst_spareparts.latest_part_code,
    mst_spareparts.dealer_price
   FROM (((spareparts_dispatch_spareparts
     JOIN spareparts_sparepart_stock ON ((spareparts_dispatch_spareparts.stock_id = spareparts_sparepart_stock.id)))
     JOIN dms_dealers ON ((spareparts_dispatch_spareparts.dealer_id = dms_dealers.id)))
     JOIN mst_spareparts ON ((spareparts_sparepart_stock.sparepart_id = mst_spareparts.id)));

-- ----------------------------
-- View structure for view_report_spareparts_service_level_dealer
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_spareparts_service_level_dealer" AS 
 SELECT sds.order_no,
    sds.dispatched_date,
    sds.dispatched_date_nepali,
    sum(sds.dispatched_quantity) AS total_dispatched,
    vsdo.total_order_quantity,
    sso.dealer_id,
    msd.name AS dealer_name,
    msd.prefix,
    concat(msd.prefix, '-', sds.order_no) AS final_order_no,
    rank() OVER (PARTITION BY sds.order_no ORDER BY sds.dispatched_date) AS pickcount,
    concat(rank() OVER (PARTITION BY sds.order_no ORDER BY sds.dispatched_date), '-Pick') AS final_pickcount,
    round(((((sum(sds.dispatched_quantity))::double precision * (100)::double precision) / (vsdo.total_order_quantity)::double precision))::numeric, 2) AS service_level_percentage,
    vdsd.total_dispatch_quantity,
    round(((((vdsd.total_dispatch_quantity)::double precision * (100)::double precision) / (vsdo.total_order_quantity)::double precision))::numeric, 2) AS total_service_level_percentage
   FROM ((((spareparts_dispatch_spareparts sds
     JOIN spareparts_sparepart_order sso ON ((sds.order_id = sso.id)))
     JOIN dms_dealers msd ON ((sso.dealer_id = msd.id)))
     LEFT JOIN ( SELECT sum((spareparts_sparepart_order.order_quantity - spareparts_sparepart_order.order_cancel)) AS total_order_quantity,
            spareparts_sparepart_order.order_no
           FROM spareparts_sparepart_order
          GROUP BY spareparts_sparepart_order.order_no) vsdo ON ((vsdo.order_no = sds.order_no)))
     LEFT JOIN ( SELECT sum(spareparts_dispatch_spareparts.dispatched_quantity) AS total_dispatch_quantity,
            spareparts_dispatch_spareparts.order_no
           FROM spareparts_dispatch_spareparts
          GROUP BY spareparts_dispatch_spareparts.order_no) vdsd ON ((vdsd.order_no = sds.order_no)))
  GROUP BY sds.order_no, sds.dispatched_date, sds.dispatched_date_nepali, sso.dealer_id, msd.prefix, msd.name, vsdo.total_order_quantity, vdsd.total_dispatch_quantity;


CREATE OR REPLACE VIEW "public"."view_report_stock_record" AS 
 SELECT lsr.id,
    lsr.created_by,
    lsr.updated_by,
    lsr.deleted_by,
    lsr.created_at,
    lsr.updated_at,
    lsr.deleted_at,
    lsr.vehicle_id AS vehicle_main_id,
    lsr.stock_yard_id,
    lsr.reached_date,
    lsr.dispatched_date_np,
    mdr.vehicle_id,
    mdr.variant_id,
    mdr.color_id,
    mdr.dispatch_date,
    mdr.month,
    mdr.year,
    mdr.invoice_no,
    mdr.engine_no,
    mdr.chass_no,
    mdr.key_no,
    mdr.pragyapan_date,
    mdr.pragyapan_no,
    mdr.current_location,
    mdr.current_status,
    lsr.dispatch_id,
    lsr.dispatched_date_np_month,
    lsr.reached_date_nep,
    ve.name AS vehicle_name,
    va.name AS variant_name,
    co.name AS color_name,
    mnm.name AS month_name
   FROM (((((log_stock_records lsr
     LEFT JOIN msil_dispatch_records mdr ON ((lsr.vehicle_id = mdr.id)))
     JOIN mst_vehicles ve ON ((mdr.vehicle_id = ve.id)))
     JOIN mst_variants va ON ((mdr.variant_id = va.id)))
     JOIN mst_colors co ON ((mdr.color_id = co.id)))
     LEFT JOIN mst_nepali_month mnm ON (((lsr.dispatched_date_np_month)::text = (mnm.id)::text)));

-- ----------------------------
-- View structure for view_report_stock_records
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_stock_records" AS 
 SELECT vdv.vehicle_id,
    vdv.variant_id,
    vdv.vehicle_name,
    vdv.variant_name,
    vdv.rank,
    COALESCE(stk.stock_count, (0)::bigint) AS stock_count
   FROM (view_dms_vehicles vdv
     LEFT JOIN ( SELECT ve.name AS vehicle_name,
            ve.rank AS vehicle_rank,
            va.name AS variant_name,
            mdr.vehicle_id,
            mdr.variant_id,
            count(mdr.chass_no) AS stock_count
           FROM ((msil_dispatch_records mdr
             JOIN mst_vehicles ve ON ((mdr.vehicle_id = ve.id)))
             JOIN mst_variants va ON ((mdr.variant_id = va.id)))
          WHERE ((((mdr.current_status)::text = 'Stock'::text) OR ((mdr.current_status)::text = 'repaired stock'::text)) OR ((mdr.current_status)::text = 'Display'::text))
          GROUP BY ve.name, ve.rank, va.name, mdr.vehicle_id, mdr.variant_id) stk ON (((stk.vehicle_id = vdv.vehicle_id) AND (stk.variant_id = vdv.variant_id))))
  WHERE ((vdv.deleted_at IS NULL) AND (vdv.for_sales = 1))
  GROUP BY vdv.vehicle_id, vdv.variant_id, vdv.vehicle_name, vdv.variant_name, vdv.rank, COALESCE(stk.stock_count, (0)::bigint)
  ORDER BY vdv.rank;


CREATE OR REPLACE VIEW "public"."view_report_target_revision_group" AS 
 SELECT str.vehicle_id,
    str.dealer_id,
    str.target_year,
    str.month,
    max(str.revision) AS revision
   FROM sales_target_records str
  GROUP BY str.target_year, str.month, str.vehicle_id, str.dealer_id;


CREATE OR REPLACE VIEW "public"."view_report_vehicle_inquiry_status" AS 
 SELECT cv.vehicle_id,
    v1.name AS vehicle_name,
    cv.variant_id,
    v2.name AS variant_name,
    v3.name AS color_name,
    cv.inquiry_no,
    cv.inquiry_date_en,
    cv.cid AS id,
    cv.deleted_by,
    cv.deleted_at,
    cv.prev_color,
    v4.name AS inquired_color,
    cv.prev_variant,
    v5.name AS inquired_variant,
    cv.prev_vehicle,
    v6.name AS inquired_vehicle,
    cv.date,
    cv.date_np,
    cv.status_id,
    mst_inquiry_statuses.name AS inquired_status,
    view_customer_status_latest.name AS current_status_name,
        CASE
            WHEN ((cv.middle_name)::text <> ''::text) THEN (((((cv.first_name)::text || ' '::text) || (cv.middle_name)::text) || ' '::text) || (cv.last_name)::text)
            ELSE (((cv.first_name)::text || ' '::text) || (cv.last_name)::text)
        END AS full_name,
    dms_dealers.name AS dealer_name,
    cv.source_id,
    cv.inquiry_date_np,
    mst_sources.name AS source_name,
    view_mst_sources.source_type_name,
    cv.mobile_1,
    cv.executive_id,
        CASE
            WHEN ((m8.middle_name)::text <> ''::text) THEN (((((m8.first_name)::text || ' '::text) || (m8.middle_name)::text) || ' '::text) || (m8.last_name)::text)
            ELSE (((m8.first_name)::text || ' '::text) || (m8.last_name)::text)
        END AS executive_name,
    sales_vehicle_process.booked_date,
    sales_vehicle_process.booked_date_np,
    sales_vehicle_process.booked_date_np_month,
    sales_vehicle_process.booked_date_np_year,
    sales_vehicle_process.vehicle_delivery_date_np
   FROM (((((((((((((view_customer_vehicle cv
     LEFT JOIN mst_vehicles v1 ON ((cv.vehicle_id = v1.id)))
     LEFT JOIN mst_variants v2 ON ((cv.variant_id = v2.id)))
     LEFT JOIN mst_colors v3 ON ((cv.color_id = v3.id)))
     LEFT JOIN mst_colors v4 ON ((cv.prev_color = v4.id)))
     LEFT JOIN mst_variants v5 ON ((cv.prev_variant = v5.id)))
     LEFT JOIN mst_vehicles v6 ON ((cv.prev_vehicle = v6.id)))
     LEFT JOIN mst_inquiry_statuses ON ((cv.status_id = mst_inquiry_statuses.id)))
     LEFT JOIN view_customer_status_latest ON ((cv.cid = view_customer_status_latest.customer_id)))
     LEFT JOIN dms_dealers ON ((cv.dealer_id = dms_dealers.id)))
     LEFT JOIN mst_sources ON ((cv.source_id = mst_sources.id)))
     LEFT JOIN view_mst_sources ON ((cv.source_id = view_mst_sources.id)))
     LEFT JOIN dms_employees m8 ON ((cv.executive_id = m8.id)))
     LEFT JOIN sales_vehicle_process ON ((sales_vehicle_process.customer_id = cv.id)));


CREATE OR REPLACE VIEW "public"."view_retail_report" AS 
 SELECT lsr.id,
    mdr.engine_no,
    mdr.color_id,
    mdr.variant_id,
    mdr.chass_no,
    mdr.vehicle_id,
    mdr.year,
    svp.vehicle_delivery_date,
    svp.booked_date,
    c.inquiry_kind,
    c.dealer_id,
    c.executive_id,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name,
    mst_colors.code AS color_code,
    lsr.dispatched_date_np_year AS retail_year,
    mst_nepali_month.name AS nepali_month,
    lsr.dispatched_date_np_month AS retail_month_id,
    mdr.company_name AS firm_name,
    dms_dealers.name AS dealer_name,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
        CASE
            WHEN ((m8.middle_name)::text <> ''::text) THEN (((((m8.first_name)::text || ' '::text) || (m8.middle_name)::text) || ' '::text) || (m8.last_name)::text)
            ELSE (((m8.first_name)::text || ' '::text) || (m8.last_name)::text)
        END AS executive_name,
    mst_nepali_month.rank AS nepali_month_rank,
    zone.name AS zone_name,
    region.name AS region_name,
    log_dispatch_dealer.dispatched_date AS billing_date,
    lsr.retail_edit_month AS nepali_edit_month_id,
    nm.name AS nepali_edited_month_retail,
    lsr.deleted_by,
    lsr.deleted_at,
    pmn.name,
    c.mobile_1 AS mobile,
    mdr.vehicle_register_no,
    mdr.invoice_no,
    mdr.invoice_date,
    lsr.retail_fiscal_year,
    mst_vehicles.rank AS vehicle_rank,
    mst_vehicles.service_policy_id,
    svp.vehicle_delivery_date_np,
    mdr.id AS msil_dispatch_id,
    lsr.hold_remark,
    lsr.log_retail_date_np,
    lsr.log_retail_date,
    lsr.dispatched_date AS retail_date,
    lsr.dispatched_date_np AS retail_date_np,
    c.inquiry_no
   FROM ((((((((((((((((log_stock_records lsr
     LEFT JOIN sales_vehicle_process svp ON ((lsr.vehicle_id = svp.msil_dispatch_id)))
     LEFT JOIN msil_dispatch_records mdr ON ((lsr.vehicle_id = mdr.id)))
     LEFT JOIN dms_customers c ON ((svp.customer_id = c.id)))
     LEFT JOIN mst_vehicles ON ((mdr.vehicle_id = mst_vehicles.id)))
     LEFT JOIN mst_variants ON ((mdr.variant_id = mst_variants.id)))
     LEFT JOIN mst_colors ON ((mdr.color_id = mst_colors.id)))
     LEFT JOIN mst_nepali_month ON (((lsr.dispatched_date_np_month)::integer = mst_nepali_month.id)))
     LEFT JOIN mst_firms ON ((mst_vehicles.firm_id = mst_firms.id)))
     LEFT JOIN dms_dealers ON ((c.dealer_id = dms_dealers.id)))
     LEFT JOIN dms_employees m8 ON ((c.executive_id = m8.id)))
     LEFT JOIN mst_district_mvs district ON ((dms_dealers.district_id = district.id)))
     LEFT JOIN mst_district_mvs zone ON ((district.parent_id = zone.id)))
     LEFT JOIN mst_district_mvs region ON ((zone.parent_id = region.id)))
     LEFT JOIN log_dispatch_dealer ON (((mdr.id = log_dispatch_dealer.vehicle_id) AND (log_dispatch_dealer.dispatched_date IS NOT NULL))))
     LEFT JOIN mst_nepali_month nm ON ((lsr.retail_edit_month = nm.id)))
     LEFT JOIN mst_payment_modes pmn ON ((c.payment_mode_id = pmn.id)))
  WHERE ((lsr.dispatched_date IS NOT NULL) AND (log_dispatch_dealer.deleted_at IS NULL))
  ORDER BY mst_nepali_month.rank;

  CREATE OR REPLACE VIEW "public"."view_sales_booking_cancel_refined" AS 
 SELECT sales_booking_cancel.customer_id,
    sales_booking_cancel.cancel_reason,
    sales_booking_cancel.notes
   FROM sales_booking_cancel
  GROUP BY sales_booking_cancel.customer_id, sales_booking_cancel.cancel_reason, sales_booking_cancel.notes;

-- ----------------------------
-- View structure for view_sales_credit_control_decision
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sales_credit_control_decision" AS 
 SELECT sccd.id,
    sccd.order_id,
    sccd.status,
    sccd.dealer_id,
    sccd.remarks,
    sccd.date,
    sccd.date_np,
    sccd.deleted_at,
    ldo.vehicle_id,
    ldo.variant_id,
    ldo.color_id,
    ve.name AS vehicle_name,
    va.name AS variant_name,
    co.name AS color_name,
    co.code AS color_code,
    dd.name AS dealer_name,
    ve.firm_id,
    mf.name AS firm_name,
    concat(ldo.payment_method, '-', ldo.associated_value_payment) AS payment_value,
    ldo.payment_status,
        CASE
            WHEN (sccd.status = 1) THEN 'Approved'::text
            ELSE 'Rejected'::text
        END AS credit_status,
    dd.incharge_id,
    dd.assistant_incharge_id
   FROM ((((((sales_credit_control_decision sccd
     JOIN log_dealer_order ldo ON ((sccd.order_id = ldo.order_id)))
     JOIN mst_vehicles ve ON ((ldo.vehicle_id = ve.id)))
     JOIN mst_variants va ON ((ldo.variant_id = va.id)))
     JOIN mst_colors co ON ((ldo.color_id = co.id)))
     JOIN dms_dealers dd ON ((sccd.dealer_id = dd.id)))
     LEFT JOIN mst_firms mf ON ((ve.firm_id = mf.id)))
  WHERE (sccd.deleted_at IS NULL)
  GROUP BY sccd.id, sccd.order_id, sccd.status, sccd.dealer_id, sccd.remarks, sccd.date, sccd.date_np, sccd.deleted_at, ldo.vehicle_id, ldo.variant_id, ldo.color_id, ve.name, va.name, co.name, co.code, dd.name, ve.firm_id, mf.name, concat(ldo.payment_method, '-', ldo.associated_value_payment), ldo.payment_status, dd.incharge_id, dd.assistant_incharge_id;

-- ----------------------------
-- View structure for view_sales_discount_limit
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sales_discount_limit" AS 
 SELECT sales_discount_limit.id,
    sales_discount_limit.created_by,
    sales_discount_limit.updated_by,
    sales_discount_limit.deleted_by,
    sales_discount_limit.created_at,
    sales_discount_limit.updated_at,
    sales_discount_limit.deleted_at,
    sales_discount_limit.vehicle_id,
    sales_discount_limit.variant_id,
    sales_discount_limit.staff_limit,
    sales_discount_limit.incharge_limit,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    sales_discount_limit.sales_head_limit
   FROM ((sales_discount_limit
     JOIN mst_vehicles ON ((sales_discount_limit.vehicle_id = mst_vehicles.id)))
     JOIN mst_variants ON ((sales_discount_limit.variant_id = mst_variants.id)));


CREATE OR REPLACE VIEW "public"."view_sales_discount_schemes" AS 
 SELECT discount.id,
    discount.created_by,
    discount.updated_by,
    discount.deleted_by,
    discount.created_at,
    discount.updated_at,
    discount.deleted_at,
    discount.actual_price,
    discount.discount_request,
    discount.vehicle_id,
    discount.variant_id,
    discount.color_id,
    discount.approval,
    discount.approved_by,
    discount.approved_date,
    discount.customer_id,
    customers.first_name,
    customers.middle_name,
    customers.last_name,
    customers.gender,
    customers.district_id,
    variant.name AS variant_name,
    color.name AS color_name,
    vehicle.name AS vehicle_name,
        CASE
            WHEN (discount.approval = 1) THEN 'APPROVED'::text
            WHEN (discount.approval = 2) THEN 'REJECTED'::text
            WHEN (discount.approval = 3) THEN 'REDUCED'::text
            WHEN (discount.approval = 4) THEN 'FORWARDED'::text
            ELSE 'Not Specified'::text
        END AS approve_status,
    discount.remarks,
    discount.designation,
    aauth_users.fullname,
    dms_dealers.incharge_id,
    discount.showroom_incharge_id AS group_id,
    discount.admin,
    discount.reduced_discount,
    discount.dealer_incharge_id,
    discount.management_incharge_id,
    view_sales_discount_limit.sales_head_limit,
    view_sales_discount_limit.staff_limit,
    view_sales_discount_limit.incharge_limit,
    discount.showroom_incharge_id,
    customers.inquiry_no,
    users.fullname AS user_name,
    dms_dealers.name AS dealer_name,
    dms_dealers.id AS dealer_id,
        CASE
            WHEN ((customers.middle_name)::text <> ''::text) THEN (((((customers.first_name)::text || ' '::text) || (customers.middle_name)::text) || ' '::text) || (customers.last_name)::text)
            ELSE (((customers.first_name)::text || ' '::text) || (customers.last_name)::text)
        END AS full_name
   FROM ((((((((sales_discount_schemes discount
     LEFT JOIN dms_customers customers ON ((customers.id = discount.customer_id)))
     LEFT JOIN mst_variants variant ON ((discount.variant_id = variant.id)))
     LEFT JOIN mst_colors color ON ((discount.color_id = color.id)))
     LEFT JOIN mst_vehicles vehicle ON ((discount.vehicle_id = vehicle.id)))
     LEFT JOIN aauth_users ON ((aauth_users.id = discount.created_by)))
     JOIN dms_dealers ON ((customers.dealer_id = dms_dealers.id)))
     LEFT JOIN view_sales_discount_limit ON (((discount.vehicle_id = view_sales_discount_limit.vehicle_id) AND (view_sales_discount_limit.variant_id = discount.variant_id))))
     LEFT JOIN aauth_users users ON (((discount.approved_by)::integer = users.id)));


CREATE OR REPLACE VIEW "public"."view_sales_target_records" AS 
 SELECT str.id,
    str.created_by,
    str.updated_by,
    str.deleted_by,
    str.created_at,
    str.updated_at,
    str.deleted_at,
    str.vehicle_id,
    str.vehicle_classification,
    str.dealer_id,
    str.target_year,
    str.month,
    str.quantity,
    str.revision,
    mstv.name AS vehicle_name,
    mst_nepali_month.name AS target_month,
    dms_dealers.name AS dealer_name,
    str.retail_quantity,
    str.inquiry_target
   FROM ((((sales_target_records str
     JOIN ( SELECT target.dealer_id,
            target.month,
            target.target_year,
            target.vehicle_id,
            max(target.revision) AS latest_revision
           FROM sales_target_records target
          GROUP BY target.dealer_id, target.month, target.target_year, target.vehicle_id) tar ON ((((((str.dealer_id = tar.dealer_id) AND (str.vehicle_id = tar.vehicle_id)) AND (str.revision = tar.latest_revision)) AND (str.month = tar.month)) AND ((str.target_year)::text = (tar.target_year)::text))))
     JOIN mst_vehicles mstv ON ((str.vehicle_id = mstv.id)))
     JOIN mst_nepali_month ON ((str.month = mst_nepali_month.id)))
     JOIN dms_dealers ON ((str.dealer_id = dms_dealers.id)));

-- ----------------------------
-- View structure for view_ser_workshop_user_satungal
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_ser_workshop_user_satungal" AS 
 SELECT swu.id,
    swu.created_by,
    swu.updated_by,
    swu.deleted_by,
    swu.created_at,
    swu.updated_at,
    swu.deleted_at,
    swu.dealer_id,
    swu.first_name,
    swu.middle_name,
    swu.last_name,
    swu.phone_no,
    swu."Address",
    swu.designation_id,
    md.name AS designation_name,
    swu.parent_id,
    concat(swu.first_name, ' ', swu.last_name) AS full_name,
    'SHREE HIMALAYAN ENTERPRISES PVT.LTD.' AS dealer_name
   FROM (ser_workshop_users swu
     JOIN mst_designations md ON ((swu.designation_id = md.id)));

-- ----------------------------
-- View structure for view_ser_workshop_users
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_ser_workshop_users" AS 
 SELECT swu.id,
    swu.created_by,
    swu.updated_by,
    swu.deleted_by,
    swu.created_at,
    swu.updated_at,
    swu.deleted_at,
    swu.dealer_id,
    swu.first_name,
    swu.middle_name,
    swu.last_name,
    swu.phone_no,
    swu."Address",
    swu.designation_id,
    msd.name AS dealer_name,
    md.name AS designation_name,
    swu.parent_id,
    concat(swu.first_name, ' ', swu.last_name) AS full_name
   FROM ((ser_workshop_users swu
     JOIN dms_dealers msd ON ((swu.dealer_id = msd.id)))
     JOIN mst_designations md ON ((swu.designation_id = md.id)));

-- ----------------------------
-- View structure for view_service_billing_jobs
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_service_billing_jobs" AS 
 SELECT ser_billing_record.created_by,
    ser_billing_record.updated_by,
    ser_billing_record.deleted_by,
    ser_billing_record.created_at,
    ser_billing_record.updated_at,
    ser_billing_record.deleted_at,
    ser_billing_record.jobcard_group,
    ser_billing_record.bill_type,
    ser_billing_record.payment_type,
    ser_billing_record.issue_date,
    ser_billing_record.cash_account,
    ser_billing_record.credit_account,
    ser_billing_record.card_account,
    ser_billing_record.invoice_prefix,
    ser_billing_record.invoice_no,
    ser_billing_record.total_parts,
    ser_billing_record.total_jobs,
    ser_billing_record.cash_discount_percent,
    ser_billing_record.cash_discount_amt,
    ser_billing_record.vat_percent,
    ser_billing_record.vat_parts,
    ser_billing_record.vat_job,
    ser_billing_record.net_total,
    ser_billing_record.dealer_id,
    ser_billing_record.counter_sales_id,
    ser_billed_jobs.job_id,
    ser_billed_jobs.price,
    ser_billed_jobs.discount_amount,
    ser_billed_jobs.discount_percentage,
    ser_billed_jobs.final_amount,
    ser_billed_jobs.status,
    mst_service_jobs.job_code AS job,
    mst_service_jobs.description AS job_description,
    ser_billed_jobs.billing_id,
    ser_billed_jobs.id
   FROM ((ser_billing_record
     JOIN ser_billed_jobs ON ((ser_billing_record.id = ser_billed_jobs.billing_id)))
     JOIN mst_service_jobs ON ((ser_billed_jobs.job_id = mst_service_jobs.id)));

-- ----------------------------
-- View structure for view_service_billing_outsideworks
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_service_billing_outsideworks" AS 
 SELECT ser_billing_record.created_by,
    ser_billing_record.updated_by,
    ser_billing_record.deleted_by,
    ser_billing_record.created_at,
    ser_billing_record.updated_at,
    ser_billing_record.deleted_at,
    ser_billing_record.jobcard_group,
    ser_billing_record.bill_type,
    ser_billing_record.payment_type,
    ser_billing_record.issue_date,
    ser_billing_record.cash_account,
    ser_billing_record.credit_account,
    ser_billing_record.card_account,
    ser_billing_record.invoice_prefix,
    ser_billing_record.invoice_no,
    ser_billing_record.total_parts,
    ser_billing_record.total_jobs,
    ser_billing_record.cash_discount_percent,
    ser_billing_record.cash_discount_amt,
    ser_billing_record.vat_percent,
    ser_billing_record.vat_parts,
    ser_billing_record.vat_job,
    ser_billing_record.net_total,
    ser_billing_record.dealer_id,
    ser_billing_record.counter_sales_id,
    ser_billed_outsidework.id,
    ser_billed_outsidework.job_id,
    ser_billed_outsidework.price,
    ser_billed_outsidework.discount_amount,
    ser_billed_outsidework.discount_percentage,
    ser_billed_outsidework.final_amount,
    ser_billed_outsidework.status,
    mst_service_jobs.job_code AS job,
    mst_service_jobs.description AS job_description,
    ser_billed_outsidework.margin_percentage
   FROM ((ser_billing_record
     JOIN ser_billed_outsidework ON ((ser_billing_record.id = ser_billed_outsidework.billing_id)))
     JOIN mst_service_jobs ON ((ser_billed_outsidework.job_id = mst_service_jobs.id)));

-- ----------------------------
-- View structure for view_service_billing_parts
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_service_billing_parts" AS 
 SELECT ser_billing_record.created_by,
    ser_billing_record.updated_by,
    ser_billing_record.deleted_by,
    ser_billing_record.created_at,
    ser_billing_record.updated_at,
    ser_billing_record.deleted_at,
    ser_billing_record.jobcard_group,
    ser_billing_record.bill_type,
    ser_billing_record.payment_type,
    ser_billing_record.issue_date,
    ser_billing_record.cash_account,
    ser_billing_record.credit_account,
    ser_billing_record.card_account,
    ser_billing_record.invoice_prefix,
    ser_billing_record.invoice_no,
    ser_billing_record.total_parts,
    ser_billing_record.total_jobs,
    ser_billing_record.cash_discount_percent,
    ser_billing_record.cash_discount_amt,
    ser_billing_record.vat_percent,
    ser_billing_record.vat_parts,
    ser_billing_record.vat_job,
    ser_billing_record.net_total,
    ser_billing_record.dealer_id,
    ser_billing_record.counter_sales_id,
    ser_billed_parts.billing_id,
    ser_billed_parts.part_id,
    ser_billed_parts.price,
    ser_billed_parts.quantity,
    ser_billed_parts.discount_percentage,
    ser_billed_parts.final_amount,
    ser_billed_parts.warranty,
    mst_spareparts.part_code,
    mst_spareparts.name AS part_name,
    mst_spareparts.category_id,
    ser_billed_parts.lube_quantity,
        CASE
            WHEN (ser_billed_parts.lube_quantity > (0)::numeric) THEN ser_billed_parts.lube_quantity
            ELSE (ser_billed_parts.quantity)::numeric
        END AS display_quantity
   FROM ((ser_billing_record
     JOIN ser_billed_parts ON ((ser_billing_record.id = ser_billed_parts.billing_id)))
     JOIN mst_spareparts ON ((ser_billed_parts.part_id = mst_spareparts.id)));

-- ----------------------------
-- View structure for view_service_billing_record
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_service_billing_record" AS 
 SELECT ser_billing_record.id,
    ser_billing_record.created_by,
    ser_billing_record.updated_by,
    ser_billing_record.deleted_by,
    ser_billing_record.created_at,
    ser_billing_record.updated_at,
    ser_billing_record.deleted_at,
    ser_billing_record.jobcard_group,
    ser_billing_record.bill_type,
    ser_billing_record.payment_type,
    ser_billing_record.issue_date,
    ser_billing_record.cash_account,
    ser_billing_record.credit_account,
    ser_billing_record.card_account,
    ser_billing_record.invoice_prefix,
    ser_billing_record.invoice_no,
    ser_billing_record.total_parts,
    ser_billing_record.total_jobs,
    ser_billing_record.cash_discount_percent,
    ser_billing_record.cash_discount_amt,
    ser_billing_record.vat_percent,
    ser_billing_record.vat_parts,
    ser_billing_record.vat_job,
    ser_billing_record.net_total,
    ser_billing_record.dealer_id,
    ser_billing_record.counter_sales_id,
    view_report_grouped_jobcard.vehicle_id,
    view_report_grouped_jobcard.variant_id,
    view_report_grouped_jobcard.service_type,
    view_report_grouped_jobcard.vehicle_no,
    view_report_grouped_jobcard.closed_status,
    view_report_grouped_jobcard.vehicle_name,
    view_report_grouped_jobcard.variant_name,
    view_report_grouped_jobcard.service_type_name,
    view_report_grouped_jobcard.job_card_issue_date,
    view_report_grouped_jobcard.customer_name,
    view_report_grouped_jobcard.firm_id,
    view_report_grouped_jobcard.firm_name,
    view_report_grouped_jobcard.service_count,
    view_report_grouped_jobcard.chassis_no,
    view_report_grouped_jobcard.engine_no,
    view_report_grouped_jobcard.kms,
    view_report_grouped_jobcard.mechanics_id,
    view_report_grouped_jobcard.year,
    view_report_grouped_jobcard.reciever_name,
    view_report_grouped_jobcard.remarks,
    view_report_grouped_jobcard.jobcard_serial,
    view_report_grouped_jobcard.color_id,
    view_report_grouped_jobcard.color_name,
    view_report_grouped_jobcard.floor_supervisor_id,
    view_report_grouped_jobcard.vehicle_rank,
    view_report_grouped_jobcard.variant_rank,
    view_report_grouped_jobcard.pdi_kms,
    view_report_grouped_jobcard.service_policy_id,
    view_report_grouped_jobcard.vehicle_sold_on,
    view_report_grouped_jobcard.address1,
    view_report_grouped_jobcard.address2,
    view_report_grouped_jobcard.dealer_name,
    view_report_grouped_jobcard.coupon,
    split_part((ser_billing_record.issue_date)::text, ' '::text, 1) AS issues_date,
    view_report_grouped_jobcard.pan_no,
    view_report_grouped_jobcard.mobile
   FROM (ser_billing_record
     LEFT JOIN view_report_grouped_jobcard ON ((ser_billing_record.jobcard_group = view_report_grouped_jobcard.jobcard_group)));

-- ----------------------------
-- View structure for view_service_by_jobs
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_service_by_jobs" AS 
 SELECT ser_job_cards.description,
    ser_job_cards.final_amount,
    ser_job_cards.customer_voice,
    ser_job_cards.engine_no,
    ser_job_cards.variant_id,
    ser_job_cards.chassis_no,
    ser_job_cards.vehicle_no,
    ser_job_cards.advisor_voice,
    ser_job_cards.reciever_name,
    ser_job_cards.dealer_id,
    ser_job_cards.floor_supervisor_voice,
    ser_floor_supervisor_advice.part_name,
    ser_floor_supervisor_advice.quantity,
    ser_floor_supervisor_advice.received_quantity,
    ser_floor_supervisor_advice.received_status,
    ser_floor_supervisor_advice.return_quantity,
    ser_floor_supervisor_advice.dispatched_quantity,
    ser_floor_supervisor_advice.return_remarks,
    ser_floor_supervisor_advice.part_code,
    ser_floor_supervisor_advice.issue_date,
    ser_floor_supervisor_advice.warranty,
    ser_floor_supervisor_advice.material_scan_id,
    ser_floor_supervisor_advice.returned_status,
    ser_floor_supervisor_advice.total_dispatched
   FROM (ser_job_cards
     JOIN ser_floor_supervisor_advice ON ((ser_job_cards.jobcard_group = ser_floor_supervisor_advice.jobcard_group)));

-- ----------------------------
-- View structure for view_service_estimate_jobs
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_service_estimate_jobs" AS 
 SELECT ser_estimate_jobs.id,
    ser_estimate_jobs.created_by,
    ser_estimate_jobs.updated_by,
    ser_estimate_jobs.deleted_by,
    ser_estimate_jobs.created_at,
    ser_estimate_jobs.updated_at,
    ser_estimate_jobs.deleted_at,
    ser_estimate_jobs.estimate_id,
    ser_estimate_jobs.job_id,
    ser_estimate_jobs.price,
    ser_estimate_jobs.discount,
    ser_estimate_jobs.total_amount,
    ser_estimate_jobs.customer_voice,
    mst_service_jobs.job_code,
    mst_service_jobs.description
   FROM ((ser_estimate_jobs
     JOIN ser_estimate_details ON ((ser_estimate_jobs.estimate_id = ser_estimate_details.id)))
     JOIN mst_service_jobs ON ((ser_estimate_jobs.job_id = mst_service_jobs.id)));

-- ----------------------------
-- View structure for view_service_estimate_parts
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_service_estimate_parts" AS 
 SELECT ser_estimate_parts.id,
    ser_estimate_parts.created_by,
    ser_estimate_parts.updated_by,
    ser_estimate_parts.deleted_by,
    ser_estimate_parts.created_at,
    ser_estimate_parts.updated_at,
    ser_estimate_parts.deleted_at,
    ser_estimate_parts.estimate_id,
    ser_estimate_parts.part_id,
    ser_estimate_parts.price,
    ser_estimate_parts.quantity,
    ser_estimate_parts.discount_percentage,
    ser_estimate_parts.final_amount,
    mst_spareparts.name AS part_name,
    mst_spareparts.part_code
   FROM (ser_estimate_parts
     JOIN mst_spareparts ON ((ser_estimate_parts.part_id = mst_spareparts.id)));

-- ----------------------------
-- View structure for view_service_estimate_records
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_service_estimate_records" AS 
 SELECT ser_estimate_details.id,
    ser_estimate_details.created_by,
    ser_estimate_details.updated_by,
    ser_estimate_details.deleted_by,
    ser_estimate_details.created_at,
    ser_estimate_details.updated_at,
    ser_estimate_details.deleted_at,
    ser_estimate_details.estimate_doc_no,
    ser_estimate_details.jobcard_group,
    ser_estimate_details.vehicle_register_no AS vehicle_no,
    ser_estimate_details.chassis_no,
    ser_estimate_details.engine_no,
    ser_estimate_details.model_no AS vehicle_id,
    ser_estimate_details.variant AS variant_id,
    ser_estimate_details.color AS color_id,
    ser_estimate_details.ledger_id,
    ser_estimate_details.total_jobs,
    ser_estimate_details.total_parts,
    ser_estimate_details.cash_percent,
    ser_estimate_details.vat_percent,
    ser_estimate_details.net_total,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name,
    mst_user_ledger.title,
    mst_user_ledger.short_name,
    mst_user_ledger.full_name,
    mst_user_ledger.address1,
    mst_user_ledger.address2,
    mst_user_ledger.address3,
    mst_user_ledger.city,
    mst_user_ledger.area,
    mst_user_ledger.district_id,
    mst_user_ledger.zone_id,
    mst_user_ledger.pin_code,
    mst_user_ledger.std_code,
    mst_user_ledger.mobile,
    mst_user_ledger.phone_no,
    mst_user_ledger.email,
    mst_user_ledger.dob,
    ser_estimate_details.dealer_id,
    ser_estimate_details.issued_date
   FROM ((((ser_estimate_details
     LEFT JOIN mst_vehicles ON ((ser_estimate_details.model_no = mst_vehicles.id)))
     LEFT JOIN mst_variants ON ((ser_estimate_details.variant = mst_variants.id)))
     LEFT JOIN mst_colors ON ((ser_estimate_details.color = mst_colors.id)))
     LEFT JOIN mst_user_ledger ON ((ser_estimate_details.ledger_id = mst_user_ledger.id)));


CREATE OR REPLACE VIEW "public"."view_service_history_job_card" AS 
 SELECT view_billed_job_all.billing_id,
    view_billed_job_all.price,
    view_billed_job_all.final_amount,
    view_billed_job_all.discount_amount,
    view_billed_job_all.status,
    view_billed_job_all.outsidework,
    view_billed_job_all.job_id,
    ser_job_cards.jobcard_group,
    ser_job_cards.id,
    ser_job_cards.created_by,
    ser_job_cards.updated_by,
    ser_job_cards.deleted_by,
    ser_job_cards.created_at,
    ser_job_cards.updated_at,
    ser_job_cards.deleted_at,
    ser_job_cards.customer_voice,
    ser_job_cards.advisor_voice,
    ser_job_cards.floor_supervisor_voice,
    ser_billing_record.issue_date,
    mst_service_jobs.job_code AS job
   FROM (((ser_job_cards
     LEFT JOIN ser_billing_record ON ((ser_job_cards.jobcard_group = ser_billing_record.jobcard_group)))
     LEFT JOIN view_billed_job_all ON ((ser_billing_record.id = view_billed_job_all.billing_id)))
     JOIN mst_service_jobs ON ((ser_job_cards.job_id = mst_service_jobs.id)))
  WHERE ((view_billed_job_all.status)::text = 'Complete'::text);


CREATE OR REPLACE VIEW "public"."view_service_job_card" AS 
 SELECT j.id,
    j.created_by,
    j.updated_by,
    j.deleted_by,
    j.created_at,
    j.updated_at,
    j.deleted_at,
    j.job_id,
    j.jobcard_group,
    j.description,
    j.before_image,
    j.after_image,
    j.material_required,
    j.floor_supervisor_id,
    j.mechanics_id,
    j.gear_box_no,
    j.service_type,
    j.kms,
    j.fuel,
    j.party_id,
    j.key_no,
    j.delivery_date,
    j.complete,
    j.cost,
    j.paid,
    j.discount_amount,
    j.discount_percentage,
    j.final_amount,
    j.status,
    j.cleaner_id,
    j.bill_id,
    j.accessories,
    j.sell_dealer,
    j.closed_status,
    j.customer_voice,
    mst_service_jobs.job_code AS job,
    mst_service_jobs.description AS job_description,
    j.estimate_id,
    mst_service_types.name AS service_type_name,
    j.vehicle_id,
    j.vehicle_no,
    j.chassis_no,
    j.engine_no,
    j.variant_id,
    j.color_id,
    j.vehicle_sold_on,
    mst_user_ledger.title,
    mst_user_ledger.short_name,
    mst_user_ledger.full_name,
    mst_user_ledger.address1,
    mst_user_ledger.address2,
    mst_user_ledger.address3,
    mst_user_ledger.city,
    mst_user_ledger.area,
    mst_user_ledger.district_id,
    mst_user_ledger.zone_id,
    mst_user_ledger.pin_code,
    mst_user_ledger.std_code,
    mst_user_ledger.mobile,
    mst_user_ledger.phone_no,
    mst_user_ledger.email,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name,
    mst_vehicles.service_policy_id,
    j.issue_date AS jobcard_issue_date,
    j.coupon,
    j.cost AS customer_price,
    j.service_count,
    j.year,
    j.reciever_name,
    j.remarks,
    j.dealer_id,
    j.jobcard_serial,
    j.pdi_kms,
    j.advisor_voice,
    j.mechanic_list,
    j.service_adviser_id,
    mst_user_ledger.dob,
    j.floor_supervisor_voice,
    (((dms_employees.first_name)::text || ' '::text) || (dms_employees.last_name)::text) AS floor_supervisor_name,
    (((ser_workshop_users.first_name)::text || ' '::text) || (ser_workshop_users.last_name)::text) AS mechanic_name,
    (((service.first_name)::text || ' '::text) || (service.last_name)::text) AS service_advisor_name,
    dms_dealers.name AS dealer_name,
    j.tire_make,
    j.battery_no
   FROM ((((((((((ser_job_cards j
     LEFT JOIN mst_service_types ON ((j.service_type = mst_service_types.id)))
     LEFT JOIN mst_service_jobs ON ((j.job_id = mst_service_jobs.id)))
     LEFT JOIN mst_user_ledger ON ((j.party_id = mst_user_ledger.id)))
     JOIN mst_vehicles ON ((j.vehicle_id = mst_vehicles.id)))
     LEFT JOIN mst_variants ON ((j.variant_id = mst_variants.id)))
     LEFT JOIN mst_colors ON ((j.color_id = mst_colors.id)))
     LEFT JOIN dms_employees ON ((j.floor_supervisor_id = dms_employees.user_id)))
     LEFT JOIN ser_workshop_users ON ((j.mechanics_id = ser_workshop_users.id)))
     LEFT JOIN dms_employees service ON ((j.service_adviser_id = service.user_id)))
     LEFT JOIN dms_dealers ON ((dms_dealers.id = j.dealer_id)));

-- ----------------------------
-- View structure for view_service_job_description
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_service_job_description" AS 
 SELECT mst_service_job_description.id,
    mst_service_job_description.created_by,
    mst_service_job_description.updated_by,
    mst_service_job_description.deleted_by,
    mst_service_job_description.created_at,
    mst_service_job_description.updated_at,
    mst_service_job_description.deleted_at,
    mst_service_job_description.vehicle_id,
    mst_service_job_description.variant_id,
    mst_service_job_description.status,
    mst_service_job_description.price,
    mst_service_job_description.duration_hours,
    mst_service_job_description.duration_minutes,
    mst_service_job_description.service_job_id,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name
   FROM ((mst_service_job_description
     JOIN mst_vehicles ON ((mst_service_job_description.vehicle_id = mst_vehicles.id)))
     JOIN mst_variants ON ((mst_service_job_description.variant_id = mst_variants.id)));

-- ----------------------------
-- View structure for view_service_job_statuses
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_service_job_statuses" AS 
 SELECT jobcard.jobcard_group,
    material_issue.jobcard_group AS material_issue,
    outsidework.jobcard_group AS outsidework,
    jobcard.closed_status,
    jobcard.deleted_at,
        CASE
            WHEN (jobcard.jobcard_group IS NULL) THEN 'FALSE'::text
            ELSE 'TRUE'::text
        END AS jobcard,
        CASE
            WHEN (material_issue.jobcard_group IS NULL) THEN 'FALSE'::text
            ELSE 'TRUE'::text
        END AS material,
        CASE
            WHEN (outsidework.jobcard_group IS NULL) THEN 'FALSE'::text
            ELSE 'TRUE'::text
        END AS outside_work,
        CASE
            WHEN (jobcard.closed_status = 0) THEN 'FALSE'::text
            ELSE 'TRUE'::text
        END AS closedstatus,
    bill_invoice.jobcard_group AS bill_invoice,
        CASE
            WHEN (bill_invoice.jobcard_group IS NULL) THEN 'FALSE'::text
            ELSE 'TRUE'::text
        END AS billinvoice
   FROM (((ser_job_cards jobcard
     LEFT JOIN ser_parts material_issue ON ((material_issue.jobcard_group = jobcard.jobcard_group)))
     LEFT JOIN ser_outside_work outsidework ON ((jobcard.jobcard_group = outsidework.jobcard_group)))
     LEFT JOIN ser_billing_record bill_invoice ON ((jobcard.jobcard_group = bill_invoice.jobcard_group)))
  GROUP BY jobcard.jobcard_group, material_issue.jobcard_group, outsidework.jobcard_group, jobcard.closed_status, jobcard.deleted_at, bill_invoice.jobcard_group
  ORDER BY jobcard.jobcard_group;

-- ----------------------------
-- View structure for view_service_jobs
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_service_jobs" AS 
 SELECT mst_service_jobs.id,
    mst_service_jobs.created_by,
    mst_service_jobs.updated_by,
    mst_service_jobs.deleted_by,
    mst_service_jobs.created_at,
    mst_service_jobs.updated_at,
    mst_service_jobs.deleted_at,
    mst_service_jobs.rank,
    mst_service_jobs.job_code,
    mst_service_jobs.description,
    mst_service_jobs.group_id,
    mst_service_jobs.apply_tax,
    mst_service_jobs.outsidework_margin,
    mst_service_jobs.number_vehicles,
    mst_service_jobs.mechanic_incentive,
    mst_service_jobs.top_complaints,
    mst_service_job_description.id AS job_id,
    mst_service_job_description.vehicle_id,
    mst_service_job_description.variant_id,
    mst_service_job_description.status,
    mst_service_job_description.price,
    mst_service_job_description.duration_hours,
    mst_service_job_description.duration_minutes,
    mst_service_job_description.service_job_id,
    (((mst_service_jobs.job_code)::text || ' | '::text) || (mst_service_jobs.description)::text) AS job_description
   FROM (mst_service_jobs
     LEFT JOIN mst_service_job_description ON ((mst_service_job_description.service_job_id = mst_service_jobs.id)))
  ORDER BY mst_service_jobs.job_code;

-- ----------------------------
-- View structure for view_service_msil_records
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_service_msil_records" AS 
 SELECT msil_dispatch_records.id,
    msil_dispatch_records.created_by,
    msil_dispatch_records.updated_by,
    msil_dispatch_records.deleted_by,
    msil_dispatch_records.created_at,
    msil_dispatch_records.updated_at,
    msil_dispatch_records.deleted_at,
    msil_dispatch_records.vehicle_id,
    msil_dispatch_records.variant_id,
    msil_dispatch_records.color_id,
    msil_dispatch_records.engine_no,
    "substring"((msil_dispatch_records.chass_no)::text, '(\S.*\S)'::text) AS chassis_no,
    msil_dispatch_records.year,
    msil_dispatch_records.key_no,
    sales_vehicle_process.customer_id,
    sales_vehicle_process.vehicle_delivery_date,
    sales_foc_document.free_servicing AS coupon,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name,
    dms_customers.dealer_id AS sell_dealer,
    sales_vehicle_process.vehicle_delivery_date AS vehicle_sold_on
   FROM ((((((msil_dispatch_records
     JOIN sales_vehicle_process ON ((sales_vehicle_process.msil_dispatch_id = msil_dispatch_records.id)))
     LEFT JOIN sales_foc_document ON ((sales_foc_document.customer_id = sales_vehicle_process.customer_id)))
     JOIN mst_vehicles ON ((msil_dispatch_records.vehicle_id = mst_vehicles.id)))
     LEFT JOIN mst_variants ON ((msil_dispatch_records.variant_id = mst_variants.id)))
     LEFT JOIN mst_colors ON ((msil_dispatch_records.color_id = mst_colors.id)))
     LEFT JOIN dms_customers ON ((sales_vehicle_process.customer_id = dms_customers.id)));


CREATE OR REPLACE VIEW "public"."view_service_parts" AS 
 SELECT s.id,
    s.created_by,
    s.updated_by,
    s.deleted_by,
    s.created_at,
    s.updated_at,
    s.deleted_at,
    s.part_id,
    s.price,
    s.quantity,
    s.used,
    s.jobcard_group,
    p.part_code,
    p.model,
    p.category_id,
    p.name AS part_name,
    s.discount_percentage,
        CASE
            WHEN ((s.discount_percentage)::double precision = (0)::double precision) THEN ((s.price * s.quantity))::double precision
            WHEN ((s.discount_percentage)::double precision <> (0)::double precision) THEN (((s.price)::double precision - (((s.price)::double precision * (s.discount_percentage)::double precision) / (100)::double precision)) * (s.quantity)::double precision)
            ELSE ((s.price * s.quantity))::double precision
        END AS final_price,
    s.labour,
        CASE
            WHEN ((s.discount_percentage)::double precision = (0)::double precision) THEN (s.labour)::double precision
            WHEN ((s.discount_percentage)::double precision <> (0)::double precision) THEN ((s.labour)::double precision - (((s.labour)::double precision * (s.discount_percentage)::double precision) / (100)::double precision))
            ELSE (s.labour)::double precision
        END AS final_labour,
        CASE
            WHEN ((s.discount_percentage)::double precision = (0)::double precision) THEN (0)::double precision
            WHEN ((((s.discount_percentage)::double precision <> (0)::double precision) AND (s.labour = 0)) AND (s.price <> 0)) THEN ((((s.price)::double precision * (s.discount_percentage)::double precision) / (100)::double precision) * (s.quantity)::double precision)
            WHEN ((s.discount_percentage)::double precision <> (0)::double precision) THEN (((((s.price)::double precision * (s.discount_percentage)::double precision) / (100)::double precision) * (s.quantity)::double precision) + (((s.labour)::double precision * (s.discount_percentage)::double precision) / (100)::double precision))
            ELSE (0)::double precision
        END AS discount_amount,
    s.cash_discount,
    s.bill_id,
    s.status,
    s.request_status,
    s.recived_status,
    s.narration,
    s.issue_date,
    s.warranty,
    s.final_amount,
    s.estimate_id,
    view_service_job_card.floor_supervisor_id,
    view_service_job_card.mechanics_id,
    view_service_job_card.gear_box_no,
    view_service_job_card.service_type,
    view_service_job_card.kms,
    view_service_job_card.fuel,
    view_service_job_card.party_id,
    view_service_job_card.key_no,
    view_service_job_card.delivery_date,
    view_service_job_card.cleaner_id,
    view_service_job_card.service_type_name,
    view_service_job_card.vehicle_id,
    view_service_job_card.vehicle_no,
    view_service_job_card.chassis_no,
    view_service_job_card.engine_no,
    view_service_job_card.variant_id,
    view_service_job_card.color_id,
    view_service_job_card.vehicle_sold_on,
    view_service_job_card.title,
    view_service_job_card.full_name,
    view_service_job_card.vehicle_name,
    view_service_job_card.variant_name,
    view_service_job_card.color_name,
    view_service_job_card.year,
    view_service_job_card.dealer_id,
    view_service_job_card.jobcard_serial
   FROM ((ser_parts s
     JOIN mst_spareparts p ON ((s.part_id = p.id)))
     LEFT JOIN view_service_job_card ON ((s.jobcard_group = view_service_job_card.jobcard_group)))
  GROUP BY s.id, s.created_by, s.updated_by, s.deleted_by, s.created_at, s.updated_at, s.deleted_at, s.part_id, s.price, s.quantity, s.used, s.jobcard_group, p.part_code, p.model, p.category_id, p.name, s.discount_percentage, s.labour, s.cash_discount, s.bill_id, s.status, s.request_status, s.recived_status, s.narration, s.issue_date, s.warranty, s.final_amount, s.estimate_id, view_service_job_card.floor_supervisor_id, view_service_job_card.mechanics_id, view_service_job_card.gear_box_no, view_service_job_card.service_type, view_service_job_card.kms, view_service_job_card.fuel, view_service_job_card.party_id, view_service_job_card.key_no, view_service_job_card.delivery_date, view_service_job_card.cleaner_id, view_service_job_card.service_type_name, view_service_job_card.vehicle_id, view_service_job_card.vehicle_no, view_service_job_card.chassis_no, view_service_job_card.engine_no, view_service_job_card.variant_id, view_service_job_card.color_id, view_service_job_card.vehicle_sold_on, view_service_job_card.title, view_service_job_card.full_name, view_service_job_card.vehicle_name, view_service_job_card.variant_name, view_service_job_card.color_name, view_service_job_card.year, view_service_job_card.dealer_id, view_service_job_card.jobcard_serial;

CREATE OR REPLACE VIEW "public"."view_service_user_group" AS 
 SELECT ug.user_id,
    ug.group_id,
    g.name AS "group",
    u.username,
    u.email,
    u.fullname,
    dms_employees.dealer_id
   FROM (((aauth_user_groups ug
     JOIN aauth_users u ON ((u.id = ug.user_id)))
     JOIN aauth_groups g ON ((g.id = ug.group_id)))
     LEFT JOIN dms_employees ON ((ug.user_id = dms_employees.user_id)));

-- ----------------------------
-- View structure for view_service_warranty_claim_list
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_service_warranty_claim_list" AS 
 SELECT ser_warranty_claim_list.id,
    ser_warranty_claim_list.created_by,
    ser_warranty_claim_list.updated_by,
    ser_warranty_claim_list.deleted_by,
    ser_warranty_claim_list.created_at,
    ser_warranty_claim_list.updated_at,
    ser_warranty_claim_list.deleted_at,
    ser_warranty_claim_list.part_id,
    ser_warranty_claim_list.quantity,
    ser_warranty_claim_list.remarks,
    ser_warranty_claim_list.warranty_claim_id,
    ser_warranty_claim_list.selected,
    mst_spareparts.name AS part_name,
    mst_spareparts.alternate_part_code,
    mst_spareparts.part_code
   FROM (ser_warranty_claim_list
     LEFT JOIN mst_spareparts ON ((ser_warranty_claim_list.part_id = mst_spareparts.id)));

-- ----------------------------
-- View structure for view_service_warranty_policy
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_service_warranty_policy" AS 
 SELECT mst_service_warranty_policy.id,
    mst_service_warranty_policy.created_by,
    mst_service_warranty_policy.updated_by,
    mst_service_warranty_policy.deleted_by,
    mst_service_warranty_policy.created_at,
    mst_service_warranty_policy.updated_at,
    mst_service_warranty_policy.deleted_at,
    mst_service_warranty_policy.service_policy_no,
    mst_service_warranty_policy.service_count,
    mst_service_warranty_policy.km_min,
    mst_service_warranty_policy.km_max,
    mst_service_warranty_policy.period,
    mst_service_warranty_policy.oil_change,
    mst_service_warranty_policy.service_type_id,
    mst_service_policy.policy_name,
    mst_service_types.name AS service_type_name
   FROM ((mst_service_warranty_policy
     JOIN mst_service_policy ON ((mst_service_warranty_policy.service_policy_no = mst_service_policy.id)))
     JOIN mst_service_types ON ((mst_service_warranty_policy.service_type_id = mst_service_types.id)));


CREATE OR REPLACE VIEW "public"."view_sp_msil_remaining_quantity" AS 
 SELECT vmr.order_no,
    vmr.quantity,
    vmr.part_name,
    COALESCE(vmr.total_quantity, (0)::bigint) AS total_quantity,
    vmr.unit_rate,
    vmr.deleted_at,
    (vmr.quantity - COALESCE(vmr.total_quantity, (0)::bigint)) AS remaining_quantity,
    vmr.final_order_no,
    vmr.latest_part_code,
    vmr.sp_partname,
    vmr.sp_partcode,
    vmr.sparepart_id,
    vmr.order_type,
    vmr.date,
    vmr.pi_number,
    vmr.pi_confirmed_date,
    vmr.nep_date,
    vmr.alternate_part_code
   FROM view_msil_remaining_quantity vmr;

-- ----------------------------
-- View structure for view_sparepart_calculation_stock_dealer
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sparepart_calculation_stock_dealer" AS 
 SELECT sd.id,
    sd.order_no,
    sd.dispatched_quantity,
    sd.order_id,
    sd.proforma_invoice_id,
    so.dealer_id,
    so.order_quantity,
    so.pi_generated,
    so.pi_confirmed,
    so.sparepart_id,
    ms.part_code,
    ms.name,
    ms.price,
    ms.latest_part_code,
    ms.moq,
    ms.alternate_part_code,
    sd.deleted_at,
    ms.model,
    ms.category_id,
    dms_dealers.incharge_id
   FROM (((spareparts_dispatch_spareparts sd
     LEFT JOIN spareparts_sparepart_order so ON ((so.id = sd.order_id)))
     LEFT JOIN mst_spareparts ms ON ((ms.id = so.sparepart_id)))
     JOIN dms_dealers ON ((so.dealer_id = dms_dealers.id)));

-- ----------------------------
-- View structure for view_sparepart_dealer_credit
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sparepart_dealer_credit" AS 
 SELECT actual_credit.dealer_id,
    actual_credit.deleted_at,
    sum(actual_credit.gross) AS gross,
    sum(actual_credit.net) AS net,
    (sum(actual_credit.gross) - sum(actual_credit.net)) AS actual_credit
   FROM ( SELECT spareparts_dealer_credit.dealer_id,
            spareparts_dealer_credit.deleted_at,
            sum(spareparts_dealer_credit.amount) AS gross,
            0 AS net
           FROM spareparts_dealer_credit
          WHERE ((spareparts_dealer_credit.cr_dr)::text = 'CREDIT'::text)
          GROUP BY spareparts_dealer_credit.dealer_id, spareparts_dealer_credit.deleted_at
        UNION ALL
         SELECT spareparts_dealer_credit.dealer_id,
            spareparts_dealer_credit.deleted_at,
            0 AS gross,
            sum(spareparts_dealer_credit.amount) AS net
           FROM spareparts_dealer_credit
          WHERE ((spareparts_dealer_credit.cr_dr)::text = 'DEBIT'::text)
          GROUP BY spareparts_dealer_credit.dealer_id, spareparts_dealer_credit.deleted_at) actual_credit
  GROUP BY actual_credit.dealer_id, actual_credit.deleted_at;

-- ----------------------------
-- View structure for view_sparepart_dealer_demo_group_billing
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sparepart_dealer_demo_group_billing" AS 
 SELECT sds.bill_no,
    sds.proforma_invoice_id,
    sds.dispatched_date,
    sds.deleted_at,
    sds.grn_received_date,
    sds.grn_received_date_np,
    sso.pi_number,
    concat('SSB-', sds.bill_no) AS bill_concat,
    sum((mst_spareparts.dealer_price * (sds.dispatched_quantity)::numeric)) AS total_dispatched_amount,
    sum(sds.dispatched_quantity) AS total_dispatched_quantity,
    dd.name AS dealer_name,
    dd.spares_incharge_id,
    dd.service_incharge_id,
    sds.dealer_id
   FROM ((((spareparts_dispatch_spareparts sds
     LEFT JOIN spareparts_sparepart_order sso ON ((sds.order_id = sso.id)))
     LEFT JOIN spareparts_sparepart_stock ON ((sds.stock_id = spareparts_sparepart_stock.id)))
     LEFT JOIN mst_spareparts ON ((spareparts_sparepart_stock.sparepart_id = mst_spareparts.id)))
     LEFT JOIN dms_dealers dd ON ((sds.dealer_id = dd.id)))
  GROUP BY sds.dispatched_date, sds.proforma_invoice_id, sds.bill_no, sds.dealer_id, sds.deleted_at, sds.grn_received_date, sds.grn_received_date_np, sso.pi_number, dd.name, dd.spares_incharge_id, dd.service_incharge_id, dd.prefix;

-- ----------------------------
-- View structure for view_sparepart_dealer_order_summary
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sparepart_dealer_order_summary" AS 
 SELECT s.deleted_at,
    s.dealer_confirmed,
    s.dealer_id,
    s.dispatch_mode,
    s.order_cancel,
    s.order_date,
    s.order_date_np,
    s.order_no,
    s.order_quantity,
    s.order_type,
    s.pi_confirmed,
    s.pi_generated,
    s.pi_number,
    sum(sds.dispatched_quantity) AS dispatched_quantity,
        CASE
            WHEN (s.pi_generated = 0) THEN 'Not Generated'::text
            ELSE (s.pi_number)::text
        END AS pi_status,
    sp.name AS dealer_name,
    sp.spares_incharge_id,
    concat(sp.prefix, '-', s.order_no) AS order_concat,
    ms.price,
    ms.dealer_price,
    ms.dealer_price AS dispatch_dealer_price,
    s.id
   FROM (((spareparts_sparepart_order s
     LEFT JOIN spareparts_dispatch_spareparts sds ON ((sds.order_id = s.id)))
     LEFT JOIN mst_spareparts ms ON ((s.sparepart_id = ms.id)))
     JOIN dms_dealers sp ON ((s.dealer_id = sp.id)))
  GROUP BY s.id, s.deleted_at, s.dealer_confirmed, s.dealer_id, s.dispatch_mode, s.order_cancel, s.order_date, s.order_date_np, s.order_no, s.order_quantity, s.order_type, s.pi_confirmed, s.pi_generated, s.pi_number, sp.name, sp.spares_incharge_id, sp.prefix, ms.price, ms.dealer_price;

-- ----------------------------
-- View structure for view_sparepart_dealers
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sparepart_dealers" AS 
 SELECT d.id,
    d.created_by,
    d.updated_by,
    d.deleted_by,
    d.created_at,
    d.updated_at,
    d.deleted_at,
    d.name,
    d.incharge_id,
    d.district_id,
    d.mun_vdc_id,
    d.city_place_id,
    d.address_1,
    d.address_2,
    d.phone_1,
    d.phone_2,
    d.email,
    d.fax,
    d.latitude,
    d.longitude,
    d.remarks,
    d.credit_policy,
    c.district_name,
    c.mun_vdc_name,
    c.name AS city_name,
    u.username AS incharge_name,
    d.parent_id
   FROM ((mst_spareparts_dealer d
     LEFT JOIN view_city_places c ON ((c.id = d.city_place_id)))
     LEFT JOIN aauth_users u ON ((d.incharge_id = u.id)));

-- ----------------------------
-- View structure for view_sparepart_detail
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sparepart_detail" AS 
 SELECT ds.id,
    ds.created_by,
    ds.updated_by,
    ds.deleted_by,
    ds.created_at,
    ds.updated_at,
    ds.deleted_at,
    ds.order_no AS order_id,
    ds.dispatched_quantity,
    ds.dispatched_date,
    ds.dispatched_date_nepali,
    ds.proforma_invoice_id,
    ds.pick_count,
    ds.foc,
    ds.stock_id,
    ds.billed,
    mst.part_code,
    mst.name,
    mst.price,
    mst.model,
    mst.moq,
    mst.category_id,
    mst.alternate_part_code,
    mst.id AS sparepart_id,
    ss.quantity AS stock_quantity
   FROM ((spareparts_dispatch_spareparts ds
     LEFT JOIN spareparts_sparepart_stock ss ON ((ds.stock_id = ss.id)))
     LEFT JOIN mst_spareparts mst ON ((ss.sparepart_id = mst.id)));

-- ----------------------------
-- View structure for view_sparepart_dispatch_by_billing
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sparepart_dispatch_by_billing" AS 
 SELECT sds.bill_no,
    sds.deleted_at,
    concat('SSB-', sds.bill_no) AS bill_concat,
    sum((mst_spareparts.dealer_price * (sds.dispatched_quantity)::numeric)) AS total_dispatched_amount,
        CASE
            WHEN (sds.ledger_id IS NULL) THEN dd.name
            ELSE ul.full_name
        END AS dealer_name,
    dd.spares_incharge_id,
    dd.service_incharge_id,
    sds.dispatched_date,
    sds.dealer_id,
    sds.grn_received_date,
    sso.order_no,
    sso.pi_number,
        CASE
            WHEN ((dd.prefix IS NOT NULL) AND (sso.order_no IS NOT NULL)) THEN concat(dd.prefix, '-', sso.order_no)
            ELSE (sso.order_no)::text
        END AS order_no_concat
   FROM (((((spareparts_dispatch_spareparts sds
     LEFT JOIN spareparts_sparepart_order sso ON ((sds.order_id = sso.id)))
     LEFT JOIN spareparts_sparepart_stock ON ((sds.stock_id = spareparts_sparepart_stock.id)))
     LEFT JOIN mst_spareparts ON ((spareparts_sparepart_stock.sparepart_id = mst_spareparts.id)))
     LEFT JOIN dms_dealers dd ON ((sds.dealer_id = dd.id)))
     LEFT JOIN mst_user_ledger ul ON ((sds.ledger_id = ul.id)))
  GROUP BY dd.prefix, sds.deleted_at, sds.bill_no, dd.service_incharge_id, dd.spares_incharge_id, dd.name, sds.dispatched_date, sds.dealer_id, sds.grn_received_date, sds.ledger_id, ul.full_name, sso.order_no, sso.pi_number;


CREATE OR REPLACE VIEW "public"."view_sparepart_picklist" AS 
 SELECT sp.sparepart_id,
    ms.part_code,
    ms.name,
    ms.latest_part_code,
    sp.order_no,
    sp.dealer_id,
    sp.deleted_at,
    sp.dispatch_quantity,
    ms.price,
    sp.is_billed,
    ms.dealer_price,
    dd.name AS dealer_name,
    concat(dd.prefix, '-', sp.order_no) AS "order",
    sp.pick_count,
    sps.location,
    concat(swu.first_name, ' ', swu.last_name) AS picker_name,
    sp.picklist_no,
    sp.picklist_format,
        CASE
            WHEN (sp.is_billed = 1) THEN 'YES'::text
            ELSE 'NO'::text
        END AS billed_status,
    swu.first_name,
    swu.middle_name,
    swu.last_name,
    spareparts_sparepart_order.order_type,
    sp.order_id,
    spareparts_sparepart_order.proforma_invoice_id,
    sp.id AS picklist_id,
    spareparts_sparepart_order.pi_number,
    opc.part_code AS ordered_part_code,
    opcsps.location AS ordered_location,
    sp.picklist_group,
    sp.picker_id,
    concat(dd.prefix, '-', sp.order_no) AS order_text
   FROM (((((((spareparts_picklist sp
     LEFT JOIN mst_spareparts ms ON ((sp.sparepart_id = ms.id)))
     LEFT JOIN dms_dealers dd ON ((sp.dealer_id = dd.id)))
     LEFT JOIN spareparts_sparepart_stock sps ON ((ms.id = sps.sparepart_id)))
     LEFT JOIN ser_workshop_users swu ON ((swu.id = sp.picker_id)))
     LEFT JOIN spareparts_sparepart_order ON (((sp.order_id = spareparts_sparepart_order.id) AND ((spareparts_sparepart_order.deleted_at > now()) OR (spareparts_sparepart_order.deleted_at IS NULL)))))
     LEFT JOIN mst_spareparts opc ON ((sp.ordered_spareparts = opc.id)))
     LEFT JOIN spareparts_sparepart_stock opcsps ON ((opc.id = opcsps.sparepart_id)));

-- ----------------------------
-- View structure for view_sparepart_real_stock
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sparepart_real_stock" AS 
 SELECT ss.id,
    ss.created_by,
    ss.updated_by,
    ss.deleted_by,
    ss.created_at,
    ss.updated_at,
    ss.deleted_at,
    ss.sparepart_id,
    ss.quantity AS stock_quantity,
    ss.location,
    mst.part_code,
    mst.alternate_part_code,
    mst.name,
    mst.moq,
    mst.category_id,
    mst.model,
    mst.dealer_price AS price,
    mst.latest_part_code,
    ss.stockyard_id,
    mst_spareparts_category.name AS category_name,
    (COALESCE(mst.dealer_price, (0)::numeric) * (ss.quantity)::numeric) AS stock_value,
    spareparts_stockyards.name AS stockyard_name,
    spareparts_stockyards.latitude,
    spareparts_stockyards.longitude,
    ss.quantity
   FROM (((spareparts_sparepart_stock ss
     LEFT JOIN mst_spareparts mst ON ((ss.sparepart_id = mst.id)))
     LEFT JOIN mst_spareparts_category ON ((mst.category_id = mst_spareparts_category.id)))
     LEFT JOIN spareparts_stockyards ON ((ss.stockyard_id = spareparts_stockyards.id)));

-- ----------------------------
-- View structure for view_sparepart_stock
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sparepart_stock" AS 
 SELECT ms.id,
    ms.created_by,
    ms.updated_by,
    ms.deleted_by,
    ms.created_at,
    ms.updated_at,
    ms.deleted_at,
    ms.part_code,
    ms.part_name,
    ms.quantity,
    ms.mst_part_id,
    ms.reached_date_nepali,
    ms.in_stock,
    sp.location,
    ms.reached_date,
    ms.order_no
   FROM (spareparts_msil_order ms
     LEFT JOIN spareparts_sparepart_stock sp ON ((sp.sparepart_id = ms.mst_part_id)));

-- ----------------------------
-- View structure for view_sparepart_stock_dealer
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sparepart_stock_dealer" AS 
 SELECT vds.deleted_at,
    vds.order_id,
    vds.proforma_invoice_id,
    vds.sparepart_id,
    vds.dealer_id,
    vds.name,
    vds.part_code,
    vds.alternate_part_code,
    vds.model,
    vds.category_id,
    vds.price,
    vds.moq,
    sum(vds.dispatched_quantity) AS total,
    vds.incharge_id,
    dms_dealers.name AS dealer_name
   FROM (view_sparepart_calculation_stock_dealer vds
     JOIN dms_dealers ON ((vds.dealer_id = dms_dealers.id)))
  GROUP BY vds.deleted_at, vds.order_id, vds.proforma_invoice_id, vds.sparepart_id, vds.dealer_id, vds.name, vds.part_code, vds.alternate_part_code, vds.model, vds.category_id, vds.price, vds.moq, vds.incharge_id, dms_dealers.name;

-- ----------------------------
-- View structure for view_sparepart_stock_transfers
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sparepart_stock_transfers" AS 
 SELECT stock.id,
    stock.created_by,
    stock.updated_by,
    stock.deleted_by,
    stock.created_at,
    stock.updated_at,
    stock.deleted_at,
    stock.dealer_id,
    stock.sparepart_id,
    stock.request_quantity,
    stock.request_date,
    stock.request_date_nepali,
    d.name AS dealer_name,
    d.dealer_type,
    d.dealer_location,
    s.latest_part_code,
    s.name AS part_name,
    s.category_id AS part_category_id,
    s.price AS part_price,
    log.dealer_from,
    log.transfer_quantity,
    log.transfer_date,
    log.current_stock,
    logsum.total_stock_transfered,
    (stock.request_quantity - logsum.total_stock_transfered) AS remaining_stock
   FROM ((((spareparts_stock_transfer stock
     JOIN dms_dealers d ON ((stock.dealer_id = d.id)))
     JOIN mst_spareparts s ON ((stock.sparepart_id = s.id)))
     LEFT JOIN spareparts_stock_transfer_log log ON ((stock.id = log.stock_transfer_id)))
     LEFT JOIN ( SELECT spareparts_stock_transfer_log.stock_transfer_id,
            sum(spareparts_stock_transfer_log.transfer_quantity) AS total_stock_transfered
           FROM spareparts_stock_transfer_log
          GROUP BY spareparts_stock_transfer_log.stock_transfer_id) logsum ON ((logsum.stock_transfer_id = stock.id)));

-- ----------------------------
-- View structure for view_spareparts
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts" AS 
 SELECT mst_spareparts.id,
    mst_spareparts.created_by,
    mst_spareparts.updated_by,
    mst_spareparts.deleted_by,
    mst_spareparts.created_at,
    mst_spareparts.updated_at,
    mst_spareparts.deleted_at,
    mst_spareparts.name,
    mst_spareparts.alternate_part_code,
    mst_spareparts.part_code,
    mst_spareparts.uom,
    mst_spareparts.category_id,
    mst_spareparts.model,
    mst_spareparts.price,
    mst_spareparts.moq,
    mst_spareparts.latest_part_code,
    mst_spareparts.dealer_price,
    (((mst_spareparts.part_code)::text || '  |  '::text) || (mst_spareparts.name)::text) AS part_name,
    mst_spareparts.is_local
   FROM mst_spareparts;

-- ----------------------------
-- View structure for view_spareparts_actual_credit
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_actual_credit" AS 
 SELECT d.id AS dealer_id,
    d.deleted_at,
    d.name,
    d.prefix,
    d.spares_incharge_id,
    d.credit_policy,
    COALESCE(oc.opening_credit, (0)::numeric) AS opening_credit,
    ((COALESCE(cc.actual_credit, (0)::numeric) + COALESCE(oc.opening_credit, (0)::numeric)) - (COALESCE(d.credit_policy, 0))::numeric) AS remaining_credit,
    COALESCE(cc.actual_credit, (0)::numeric) AS actual_credit
   FROM ((dms_dealers d
     LEFT JOIN view_sparepart_dealer_credit cc ON ((d.id = cc.dealer_id)))
     RIGHT JOIN spareparts_dealer_opening_credit oc ON ((d.id = oc.dealer_id)))
  GROUP BY d.id, d.deleted_at, d.name, d.credit_policy, d.parent_id, d.prefix, d.spares_incharge_id, cc.gross, cc.net, cc.actual_credit, oc.opening_credit;

-- ----------------------------
-- View structure for view_spareparts_all_dealer_stock
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_all_dealer_stock" AS 
 SELECT spareparts_dealer_stock.id,
    spareparts_dealer_stock.created_by,
    spareparts_dealer_stock.updated_by,
    spareparts_dealer_stock.deleted_by,
    spareparts_dealer_stock.created_at,
    spareparts_dealer_stock.updated_at,
    spareparts_dealer_stock.deleted_at,
    spareparts_dealer_stock.sparepart_id,
    spareparts_dealer_stock.dealer_id,
    spareparts_dealer_stock.quantity,
    spareparts_dealer_stock.price,
    spareparts_dealer_stock.location,
    spareparts_dealer_stock.order_no,
    dms_dealers.name AS dealer_name,
    dms_dealers.parent_id,
    mst_spareparts.alternate_part_code,
    mst_spareparts.part_code,
    mst_spareparts.name,
    mst_spareparts.latest_part_code,
    mst_spareparts.dealer_price,
    dms_dealers.incharge_id,
    (((mst_spareparts.part_code)::text || '  |  '::text) || (mst_spareparts.name)::text) AS part_name,
    dms_dealers.phone_1,
    mst_spareparts.price AS mrp_price,
    dms_dealers.spares_incharge_id,
    dms_dealers.service_incharge_id,
    spareparts_dealer_stock.lube_qty,
        CASE
            WHEN (spareparts_dealer_stock.lube_qty IS NOT NULL) THEN spareparts_dealer_stock.lube_qty
            ELSE (spareparts_dealer_stock.quantity)::numeric
        END AS display_quantity
   FROM ((spareparts_dealer_stock
     LEFT JOIN dms_dealers ON ((spareparts_dealer_stock.dealer_id = dms_dealers.id)))
     LEFT JOIN mst_spareparts ON ((spareparts_dealer_stock.sparepart_id = mst_spareparts.id)))
  WHERE (mst_spareparts.deleted_at IS NULL);


CREATE OR REPLACE VIEW "public"."view_spareparts_dealer_claim" AS 
 SELECT sdc.id,
    sdc.created_by,
    sdc.updated_by,
    sdc.deleted_by,
    sdc.created_at,
    sdc.updated_at,
    sdc.deleted_at,
    sdc.dealer_id,
    sdc.sparepart_id,
    sdc.requested_by,
    sdc.requested_date,
    sdc.requested_date_np,
    sdc.defecit_quantity,
    ms.part_code,
    ms.name AS part_name,
    ms.latest_part_code,
    msd.name AS dealer_name,
    msd.incharge_id,
    sdc.status
   FROM ((spareparts_dealer_claim sdc
     JOIN mst_spareparts ms ON ((sdc.sparepart_id = ms.id)))
     JOIN dms_dealers msd ON ((sdc.dealer_id = msd.id)));

-- ----------------------------
-- View structure for view_spareparts_dealer_credit
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_dealer_credit" AS 
 SELECT view_sparepart_dealer_credit.deleted_at,
    sum(view_sparepart_dealer_credit.gross) AS gross,
    sum(view_sparepart_dealer_credit.net) AS net,
    (sum(view_sparepart_dealer_credit.gross) - sum(view_sparepart_dealer_credit.net)) AS actual_credit,
    dms_dealers.name,
    dms_dealers.credit_policy,
    dms_dealers.id AS dealer_id
   FROM (dms_dealers
     LEFT JOIN view_sparepart_dealer_credit ON ((view_sparepart_dealer_credit.dealer_id = dms_dealers.id)))
  GROUP BY dms_dealers.id, view_sparepart_dealer_credit.deleted_at, dms_dealers.name, dms_dealers.credit_policy;

-- ----------------------------
-- View structure for view_spareparts_dealer_opening_credit
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_dealer_opening_credit" AS 
 SELECT spareparts_dealer_opening_credit.id,
    spareparts_dealer_opening_credit.created_by,
    spareparts_dealer_opening_credit.updated_by,
    spareparts_dealer_opening_credit.deleted_by,
    spareparts_dealer_opening_credit.created_at,
    spareparts_dealer_opening_credit.updated_at,
    spareparts_dealer_opening_credit.deleted_at,
    spareparts_dealer_opening_credit.dealer_id,
    spareparts_dealer_opening_credit.opening_credit,
    spareparts_dealer_opening_credit.date,
    dms_dealers.name AS dealer_name
   FROM (spareparts_dealer_opening_credit
     JOIN dms_dealers ON ((spareparts_dealer_opening_credit.dealer_id = dms_dealers.id)));

-- ----------------------------
-- View structure for view_spareparts_dealer_order
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_dealer_order" AS 
 SELECT msd.name AS dealer_name,
    msd.incharge_id,
    msd.parent_id,
    msd.prefix,
    msd.credit_policy,
    ms.part_code,
    ms.alternate_part_code,
    ms.name,
    ms.moq,
    ms.latest_part_code,
    ms.price,
    ms.model,
    st.quantity,
    st.location,
    so.id,
    so.created_by,
    so.updated_by,
    so.deleted_by,
    so.created_at,
    so.updated_at,
    so.deleted_at,
    so.sparepart_id,
    so.dealer_id,
    so.proforma_invoice_id,
    so.order_quantity,
    so.pi_generated,
    so.pi_confirmed,
    so.order_no,
    so.order_cancel,
    so.picklist,
    sp.dispatched_date,
    sp.dispatched_date_nep,
    sp.dispatch_quantity AS picklist_quantity,
    so.pi_generated_date_time,
    so.dealer_confirmed,
    so.confirmed_type,
    st.stockyard_id,
    so.order_type,
    msd.address_1,
    mst_district_mvs.name AS district_name,
    ms.dealer_price,
    so.pi_number,
    so.dispatch_mode,
    so.received_quantity,
    sp.is_billed,
    so.cancle_quantity
   FROM ((((((spareparts_sparepart_order so
     JOIN mst_spareparts ms ON ((so.sparepart_id = ms.id)))
     JOIN dms_dealers msd ON ((so.dealer_id = msd.id)))
     LEFT JOIN spareparts_sparepart_stock st ON ((so.sparepart_id = st.sparepart_id)))
     LEFT JOIN spareparts_picklist sp ON (((((so.id = sp.order_id) AND (so.sparepart_id = sp.sparepart_id)) AND (so.order_no = sp.order_no)) AND (so.dealer_id = sp.dealer_id))))
     LEFT JOIN spareparts_dispatch_spareparts sd ON (((so.id = sd.order_id) AND (so.order_no = sd.order_no))))
     LEFT JOIN mst_district_mvs ON ((msd.district_id = mst_district_mvs.id)));

-- ----------------------------
-- View structure for view_spareparts_dealer_order_bkp
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_dealer_order_bkp" AS 
 SELECT s.id,
    s.created_by,
    s.updated_by,
    s.deleted_by,
    s.created_at,
    s.updated_at,
    s.deleted_at,
    s.sparepart_id,
    s.order_quantity,
    s.pi_generated,
    s.pi_confirmed,
    s.proforma_invoice_id,
    ms.name,
    ms.part_code,
    ms.price,
    st.location,
    st.id AS stock_id,
    d.name AS dealer_name,
    s.dealer_id,
    st.quantity,
    sd.dispatched_quantity,
    d.credit_policy,
    s.order_no,
    ms.moq,
    ms.latest_part_code,
    pick.dispatch_quantity AS picklist_quantity,
    s.order_cancel,
    sd.order_id,
    s.picklist,
    d.parent_id,
    d.prefix,
    st.stockyard_id,
    s.order_type
   FROM (((((spareparts_sparepart_order s
     LEFT JOIN mst_spareparts ms ON ((s.sparepart_id = ms.id)))
     LEFT JOIN spareparts_sparepart_stock st ON ((ms.id = st.sparepart_id)))
     LEFT JOIN dms_dealers d ON ((s.dealer_id = d.id)))
     LEFT JOIN spareparts_dispatch_spareparts sd ON ((sd.order_id = s.id)))
     LEFT JOIN spareparts_picklist pick ON (((s.id = pick.order_id) AND (s.order_no = pick.order_no))));

-- ----------------------------
-- View structure for view_spareparts_dealer_sales
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_dealer_sales" AS 
 SELECT sds.id,
    sds.created_by,
    sds.updated_by,
    sds.deleted_by,
    sds.created_at,
    sds.updated_at,
    sds.deleted_at,
    sds.total_amount,
    sds.date,
    sds.nep_date,
    sds.discount,
    sds.party_id,
    sds.bill_no,
    sds.taxable_total,
    sds.vat_amount,
    ms.full_name AS name,
    vdsq.total_quantity,
    sds.bill,
    sds.dealer_id,
    sds.vat_bill_no
   FROM ((spareparts_dealer_sales sds
     JOIN mst_user_ledger ms ON ((sds.party_id = ms.id)))
     LEFT JOIN ( SELECT sum(spareparts_dealersales_list.quantity) AS total_quantity,
            spareparts_dealersales_list.dealer_sales_id
           FROM spareparts_dealersales_list
          GROUP BY spareparts_dealersales_list.dealer_sales_id) vdsq ON ((vdsq.dealer_sales_id = sds.id)));

-- ----------------------------
-- View structure for view_spareparts_dealer_stock
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_dealer_stock" AS 
 SELECT sso.id,
    sso.created_by,
    sso.updated_by,
    sso.deleted_by,
    sso.deleted_at,
    sso.updated_at,
    sso.created_at,
    sso.dealer_id,
    sdd.dispatch_quantity,
    sdd.is_billed,
    sso.sparepart_id
   FROM (spareparts_sparepart_order sso
     JOIN spareparts_dispatch_list sdd ON ((((sso.order_no = sdd.order_no) AND (sso.dealer_id = sdd.dealer_id)) AND (sso.sparepart_id = sdd.sparepart_id))));

-- ----------------------------
-- View structure for view_spareparts_dealer_stock_adjustment
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_dealer_stock_adjustment" AS 
 SELECT sdsa.id,
    sdsa.created_by,
    sdsa.updated_by,
    sdsa.deleted_by,
    sdsa.created_at,
    sdsa.updated_at,
    sdsa.deleted_at,
    sdsa.dealer_id,
    sdsa.sparepart_id,
    sdsa.old_stock,
    sdsa.new_stock,
    sdsa.remarks,
    sdsa.requested_by,
    sdsa.requested_date,
    sdsa.approved_by,
    sdsa.approved_date,
    ms.name AS part_name,
    ms.latest_part_code,
    ms.part_code,
    sdsa.requested_date_np,
    sdsa.approved_date_np,
    msd.name,
    msd.incharge_id
   FROM (((spareparts_dealer_stock_adjustment sdsa
     JOIN mst_spareparts ms ON ((sdsa.sparepart_id = ms.id)))
     JOIN dms_employees de ON ((sdsa.requested_by = de.user_id)))
     JOIN dms_dealers msd ON ((de.dealer_id = msd.id)));

-- ----------------------------
-- View structure for view_spareparts_dealer_stock_order
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_dealer_stock_order" AS 
 SELECT ms.name,
    ms.part_code,
    ms.alternate_part_code,
    ms.latest_part_code,
    sds.sparepart_id,
    sso.pi_generated,
    sso.pi_confirmed,
    sso.order_quantity,
    sso.proforma_invoice_id,
    sso.order_no,
    sso.order_cancel,
    sso.picklist,
    msd.name AS dealer_name,
    msd.parent_id,
    msd.prefix,
    msd.credit_policy,
    sds.dealer_id AS stock_dealer_id,
    sds.price,
    sds.quantity,
    sds.location,
    sds.id AS stock_id,
    spareparts_dispatch_spareparts.dispatched_quantity,
    spareparts_picklist.dispatch_quantity AS picklist_quantity,
    sso.dealer_id,
    sds.deleted_at,
    sso.id
   FROM (((((spareparts_dealer_stock sds
     LEFT JOIN spareparts_sparepart_order sso ON ((sso.sparepart_id = sds.sparepart_id)))
     LEFT JOIN mst_spareparts ms ON ((sds.sparepart_id = ms.id)))
     LEFT JOIN dms_dealers msd ON ((sso.dealer_id = msd.id)))
     LEFT JOIN spareparts_picklist ON ((sso.id = spareparts_picklist.order_id)))
     LEFT JOIN spareparts_dispatch_spareparts ON ((sso.id = spareparts_dispatch_spareparts.order_id)))
  WHERE (msd.parent_id <> 0);

-- ----------------------------
-- View structure for view_spareparts_dealer_stock_quantity
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_dealer_stock_quantity" AS 
 SELECT spareparts_dealer_stock.id,
    spareparts_dealer_stock.created_by,
    spareparts_dealer_stock.updated_by,
    spareparts_dealer_stock.deleted_by,
    spareparts_dealer_stock.created_at,
    spareparts_dealer_stock.updated_at,
    spareparts_dealer_stock.deleted_at,
    spareparts_dealer_stock.sparepart_id,
    spareparts_dealer_stock.dealer_id,
    spareparts_dealer_stock.quantity AS stock_quantity,
    spareparts_dealer_stock.price,
    spareparts_dealer_stock.location,
    spareparts_dealer_stock.order_no,
    dms_dealers.name AS dealer_name,
    dms_dealers.parent_id,
    mst_spareparts.alternate_part_code,
    mst_spareparts.part_code,
    mst_spareparts.name,
    mst_spareparts.latest_part_code,
    mst_spareparts.dealer_price
   FROM ((spareparts_dealer_stock
     JOIN dms_dealers ON ((spareparts_dealer_stock.dealer_id = dms_dealers.id)))
     JOIN mst_spareparts ON ((spareparts_dealer_stock.sparepart_id = mst_spareparts.id)));

-- ----------------------------
-- View structure for view_spareparts_dealer_stock_with_order
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_dealer_stock_with_order" AS 
 SELECT sso.id,
    sso.created_by,
    sso.updated_by,
    sso.deleted_by,
    sso.created_at,
    sso.updated_at,
    sso.deleted_at,
    sso.sparepart_id,
    sso.dealer_id,
    sso.proforma_invoice_id,
    sso.order_quantity,
    sso.pi_generated,
    sso.pi_confirmed,
    sso.order_no,
    sso.order_cancel,
    sso.picklist,
    vsds.is_billed,
    vsds.dispatch_quantity AS quantity,
    vsds.dealer_id AS stock_owner_id,
    dms_dealers.parent_id,
    dms_dealers.prefix
   FROM ((spareparts_sparepart_order sso
     LEFT JOIN view_spareparts_dealer_stock vsds ON ((sso.sparepart_id = vsds.sparepart_id)))
     JOIN dms_dealers ON (((sso.dealer_id = dms_dealers.id) AND (dms_dealers.parent_id = vsds.dealer_id))))
  ORDER BY vsds.dealer_id;

-- ----------------------------
-- View structure for view_spareparts_dealer_target
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_dealer_target" AS 
 SELECT spareparts_dealer_yearly_target.id,
    spareparts_dealer_yearly_target.created_by,
    spareparts_dealer_yearly_target.updated_by,
    spareparts_dealer_yearly_target.deleted_by,
    spareparts_dealer_yearly_target.created_at,
    spareparts_dealer_yearly_target.updated_at,
    spareparts_dealer_yearly_target.deleted_at,
    spareparts_dealer_yearly_target.dealer_id,
    spareparts_dealer_yearly_target.year,
    spareparts_dealer_yearly_target.target,
    dms_dealers.name AS dealer_name,
    dms_dealers.incharge_id,
    dms_dealers.parent_id
   FROM (spareparts_dealer_yearly_target
     JOIN dms_dealers ON ((spareparts_dealer_yearly_target.dealer_id = dms_dealers.id)));

-- ----------------------------
-- View structure for view_spareparts_dealersales_list
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_dealersales_list" AS 
 SELECT spareparts_dealersales_list.id,
    spareparts_dealersales_list.created_by,
    spareparts_dealersales_list.updated_by,
    spareparts_dealersales_list.deleted_by,
    spareparts_dealersales_list.created_at,
    spareparts_dealersales_list.updated_at,
    spareparts_dealersales_list.deleted_at,
    spareparts_dealersales_list.sparepart_id,
    spareparts_dealersales_list.quantity,
    spareparts_dealersales_list.price,
    spareparts_dealersales_list.dealer_sales_id,
    mst_spareparts.name AS part_name,
    mst_spareparts.part_code,
    mst_spareparts.latest_part_code,
    mst_spareparts.alternate_part_code,
    view_spareparts_dealer_sales.bill
   FROM ((spareparts_dealersales_list
     JOIN mst_spareparts ON ((spareparts_dealersales_list.sparepart_id = mst_spareparts.id)))
     LEFT JOIN view_spareparts_dealer_sales ON ((view_spareparts_dealer_sales.id = spareparts_dealersales_list.dealer_sales_id)));

-- ----------------------------
-- View structure for view_spareparts_dispatch_grn
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_dispatch_grn" AS 
 SELECT sds.order_no,
    sds.bill_no,
    sds.proforma_invoice_id,
    sds.dispatched_date,
    sds.deleted_at,
    sds.grn_received_date,
    sds.grn_received_date_np,
    sso.pi_number,
    concat('SSB-', sds.bill_no) AS bill_concat,
    sum((mst_spareparts.dealer_price * (sds.dispatched_quantity)::numeric)) AS total_dispatched_amount,
    sum(sds.dispatched_quantity) AS total_dispatched_quantity,
        CASE
            WHEN (sds.ledger_id IS NULL) THEN dd.name
            ELSE ul.full_name
        END AS dealer_name,
    dd.spares_incharge_id,
    dd.service_incharge_id,
    concat(dd.prefix, '-', sds.order_no) AS order_concat,
    sds.dealer_id,
    sds.dispatched_date_nepali,
    sds.discount_percentage,
    sds.vor_percentage
   FROM (((((spareparts_dispatch_spareparts sds
     LEFT JOIN spareparts_sparepart_order sso ON ((sds.order_id = sso.id)))
     LEFT JOIN spareparts_sparepart_stock ON ((sds.stock_id = spareparts_sparepart_stock.id)))
     LEFT JOIN mst_spareparts ON ((spareparts_sparepart_stock.sparepart_id = mst_spareparts.id)))
     LEFT JOIN dms_dealers dd ON ((sds.dealer_id = dd.id)))
     LEFT JOIN mst_user_ledger ul ON ((sds.ledger_id = ul.id)))
  GROUP BY sds.order_no, sds.dispatched_date, sds.proforma_invoice_id, sds.bill_no, sds.dealer_id, sds.deleted_at, sds.grn_received_date, sds.grn_received_date_np, sso.pi_number, dd.name, dd.spares_incharge_id, dd.service_incharge_id, dd.prefix, sds.ledger_id, ul.full_name, sds.dispatched_date_nepali, sds.discount_percentage, sds.vor_percentage;

-- ----------------------------
-- View structure for view_spareparts_dispatch_list
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_dispatch_list" AS 
 SELECT sdl.id,
    sdl.deleted_at,
    sdl.sparepart_id,
    ms.name,
    ms.latest_part_code,
    sdl.part_code,
    sdl.order_no,
    sdl.dealer_id,
    sdl.is_billed,
    ms.price,
    sdl.dispatch_quantity,
    ms.dealer_price,
    sdl.picklist_no,
    sdl.order_id,
    sdl.picklist_id,
    sdl.ledger_id
   FROM (spareparts_dispatch_list sdl
     LEFT JOIN mst_spareparts ms ON ((sdl.sparepart_id = ms.id)));

-- ----------------------------
-- View structure for view_spareparts_local_purchase_list
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_local_purchase_list" AS 
 SELECT lpl.id,
    lpl.created_by,
    lpl.updated_by,
    lpl.deleted_by,
    lpl.created_at,
    lpl.updated_at,
    lpl.deleted_at,
    lpl.local_purchase_id,
    lpl.sparepart_id,
    lpl.quantity,
    lpl.price,
    ms.part_code,
    ms.name
   FROM (spareparts_local_purchase_list lpl
     JOIN mst_spareparts ms ON ((lpl.sparepart_id = ms.id)));

CREATE OR REPLACE VIEW "public"."view_spareparts_mechanic" AS 
 SELECT sbp.price AS part_price,
    sbp.part_id,
    ms.part_code,
    ser_billing_record.jobcard_group,
    ser_workshop_users.first_name,
    ser_workshop_users.middle_name,
    ser_workshop_users.last_name,
    ser_billing_record.vat_percent,
    ser_billing_record.total_parts,
    ser_billing_record.vat_parts,
    ser_billing_record.net_total,
    ser_billing_record.dealer_id,
    ser_billing_record.counter_sales_id,
    view_report_grouped_jobcard.vehicle_name,
    view_report_grouped_jobcard.variant_name,
    view_report_grouped_jobcard.service_type_name,
    view_report_grouped_jobcard.job_card_issue_date,
    view_report_grouped_jobcard.chassis_no,
    view_report_grouped_jobcard.engine_no,
    view_report_grouped_jobcard.kms,
    view_report_grouped_jobcard.dealer_name,
    ser_billing_record.issue_date,
    sbp.final_amount,
    ms.name AS part_name,
    view_report_grouped_jobcard.mechanics_id,
    sbp.deleted_by,
    sbp.deleted_at
   FROM ((((ser_billed_parts sbp
     LEFT JOIN mst_spareparts ms ON ((sbp.part_id = ms.id)))
     LEFT JOIN ser_billing_record ON ((sbp.billing_id = ser_billing_record.id)))
     LEFT JOIN view_report_grouped_jobcard ON ((ser_billing_record.jobcard_group = view_report_grouped_jobcard.jobcard_group)))
     LEFT JOIN ser_workshop_users ON ((view_report_grouped_jobcard.mechanics_id = ser_workshop_users.id)));

CREATE OR REPLACE VIEW "public"."view_spareparts_msil_aging" AS 
 SELECT smo.id,
    smo.part_code,
    smo.part_name,
    (smo.quantity - smo.dispatched_quantity) AS remaining_quantity,
    ((smo.quantity - smo.dispatched_quantity) * smo.unit_rate) AS total_amount,
    smo.reached_date_nepali,
    smo.reached_date,
    smo.msil_dispatch_date,
    smo.mst_part_id,
    (('now'::text)::date - smo.reached_date) AS age,
    smo.unit_rate AS price
   FROM spareparts_msil_order smo;

-- ----------------------------
-- View structure for view_spareparts_msil_dispatch_list
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_msil_dispatch_list" AS 
 SELECT spareparts_msil_order.invoice_no,
    spareparts_msil_order.reached_date,
    spareparts_msil_order.deleted_at,
    spareparts_msil_order.in_stock,
    spareparts_msil_order.msil_invoice_date_np,
    spareparts_msil_order.msil_invoice_date,
    spareparts_msil_order.binning_status
   FROM spareparts_msil_order
  GROUP BY spareparts_msil_order.reached_date, spareparts_msil_order.invoice_no, spareparts_msil_order.deleted_at, spareparts_msil_order.in_stock, spareparts_msil_order.msil_invoice_date, spareparts_msil_order.msil_invoice_date_np, spareparts_msil_order.binning_status;

-- ----------------------------
-- View structure for view_spareparts_msil_order
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_msil_order" AS 
 SELECT sog.id,
    sog.created_by,
    sog.updated_by,
    sog.deleted_by,
    sog.created_at,
    sog.updated_at,
    sog.deleted_at,
    sog.sparepart_id,
    sog.order_no,
    sog.quantity,
    sog.date,
    sog.nep_date,
    sog.order_type,
    sog.final_order_no,
    ms.name AS part_name,
    ms.part_code
   FROM (spareparts_order_generate sog
     JOIN mst_spareparts ms ON ((sog.sparepart_id = ms.id)));

-- ----------------------------
-- View structure for view_spareparts_order
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_order" AS 
 SELECT s.id,
    s.created_by,
    s.updated_by,
    s.deleted_by,
    s.created_at,
    s.updated_at,
    s.deleted_at,
    s.sparepart_id,
    s.dealer_id,
    s.proforma_invoice_id,
    s.order_quantity,
    s.pi_generated,
    s.pi_confirmed,
    ms.name,
    ms.part_code,
    ms.price,
    ms.category_id,
    ms.model,
    ms.moq,
    ms.alternate_part_code,
    sp.name AS dealer_name,
    s.order_no,
        CASE
            WHEN (s.pi_generated = 0) THEN 'Not Generated'::text
            ELSE (s.pi_number)::text
        END AS pi_status,
    s.order_cancel,
    sp.parent_id,
    sp.prefix,
    concat(sp.prefix, '-', s.order_no) AS order_concat,
    s.order_type,
    ((s.order_quantity)::numeric * ms.dealer_price) AS total_price,
    ms.dealer_price,
    s.dealer_confirmed,
    s.order_date,
    s.order_date_np,
    s.pi_number,
    sp.incharge_id,
    sp.spares_incharge_id,
    s.pi_generated_date_time,
    s.dispatch_mode,
    s.picklist,
    s.confirmed_type,
    mst_spareparts.dealer_price AS dispatch_dealer_price,
    mst_spareparts.name AS dispatch_part_name,
    mst_spareparts.part_code AS dispatch_part_code,
    COALESCE(sds.dispatched_quantity, 0) AS dispatched_quantity,
    sds.grn_no,
    sds.grn_received_date,
    sds.grn_received_date_np,
    sds.bill_no,
    concat('HEPL-', sds.bill_no) AS bill_concat,
    s.remarks,
    ((s.order_quantity)::numeric * ms.dealer_price) AS order_amount,
    s.received_quantity,
    spareparts_sparepart_stock.location,
    s.cancle_quantity,
    mst_district_mvs.name AS district_name,
    sp.address_1
   FROM ((((((spareparts_sparepart_order s
     LEFT JOIN mst_spareparts ms ON ((s.sparepart_id = ms.id)))
     JOIN dms_dealers sp ON ((s.dealer_id = sp.id)))
     LEFT JOIN spareparts_dispatch_spareparts sds ON ((s.id = sds.order_id)))
     LEFT JOIN spareparts_sparepart_stock ON ((sds.stock_id = spareparts_sparepart_stock.id)))
     LEFT JOIN mst_spareparts ON ((spareparts_sparepart_stock.sparepart_id = mst_spareparts.id)))
     LEFT JOIN mst_district_mvs ON ((sp.district_id = mst_district_mvs.id)));

-- ----------------------------
-- View structure for view_spareparts_order_generate
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_order_generate" AS 
 SELECT so.id,
    so.created_by,
    so.updated_by,
    so.deleted_by,
    so.created_at,
    so.updated_at,
    so.deleted_at,
    so.sparepart_id,
    so.order_no,
    so.quantity,
    so.date,
    so.nep_date,
    so.order_type,
    so.final_order_no,
    so.pi_number,
    so.pi_received_date,
    so.pi_received_date_np,
    so.pi_received_date_np_year,
    so.pi_received_date_np_month,
    so.pi_confirmed_date,
    so.pi_confirmed_date_np,
    so.pi_confirmed_date_np_year,
    so.pi_confirmed_date_np_month,
    so.nep_date_year,
    so.nep_date_month,
    ms.price,
    ms.moq
   FROM (spareparts_order_generate so
     JOIN mst_spareparts ms ON ((so.sparepart_id = ms.id)));

-- ----------------------------
-- View structure for view_spareparts_order_pickcount
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_order_pickcount" AS 
 SELECT s.id,
    s.created_by,
    s.updated_by,
    s.deleted_by,
    s.created_at,
    s.updated_at,
    s.deleted_at,
    s.sparepart_id,
    s.dealer_id,
    s.proforma_invoice_id,
    s.order_quantity,
    s.pi_generated,
    s.pi_confirmed,
    ms.name,
    ms.part_code,
    ms.price,
    ms.category_id,
    ms.model,
    ms.moq,
    ms.alternate_part_code,
    sp.name AS dealer_name,
    s.order_no,
        CASE
            WHEN (s.pi_generated = 0) THEN 'Not Generated'::text
            ELSE (s.pi_number)::text
        END AS pi_status,
    s.order_cancel,
    sp.parent_id,
    sp.prefix,
    concat(sp.prefix, '-', s.order_no) AS order_concat,
    s.order_type,
    ((s.order_quantity)::numeric * ms.dealer_price) AS total_price,
    ms.dealer_price,
    s.dealer_confirmed,
    s.order_date,
    s.order_date_np,
    s.pi_number,
    sp.incharge_id,
    sp.spares_incharge_id,
    s.pi_generated_date_time,
    s.dispatch_mode,
    s.picklist,
    s.confirmed_type,
    s.pi_cost AS dispatch_dealer_price,
    mst_spareparts.name AS dispatch_part_name,
    mst_spareparts.part_code AS dispatch_part_code,
    COALESCE(sds.dispatched_quantity, 0) AS dispatched_quantity,
    sds.grn_no,
    sds.grn_received_date,
    sds.grn_received_date_np,
    sds.bill_no,
    concat('HEPL-', sds.bill_no) AS bill_concat,
    s.remarks,
    ((s.order_quantity)::numeric * s.pi_cost) AS order_amount,
    max(spareparts_picklist.pick_count) AS pick_count,
    s.received_quantity,
    sds.dispatched_date,
    sds.dispatched_date_nepali
   FROM ((((((spareparts_sparepart_order s
     LEFT JOIN mst_spareparts ms ON ((s.sparepart_id = ms.id)))
     JOIN dms_dealers sp ON ((s.dealer_id = sp.id)))
     LEFT JOIN spareparts_dispatch_spareparts sds ON ((s.id = sds.order_id)))
     LEFT JOIN spareparts_sparepart_stock ON ((sds.stock_id = spareparts_sparepart_stock.id)))
     LEFT JOIN mst_spareparts ON ((spareparts_sparepart_stock.sparepart_id = mst_spareparts.id)))
     LEFT JOIN spareparts_picklist ON ((s.id = spareparts_picklist.order_id)))
  GROUP BY s.id, s.created_by, s.updated_by, s.deleted_by, s.created_at, s.updated_at, s.deleted_at, s.sparepart_id, s.dealer_id, s.proforma_invoice_id, s.order_quantity, s.pi_generated, s.pi_confirmed, ms.name, ms.part_code, ms.price, ms.category_id, ms.model, ms.moq, ms.alternate_part_code, sp.name, s.order_no,
        CASE
            WHEN (s.pi_generated = 0) THEN 'Not Generated'::text
            ELSE (s.pi_number)::text
        END, s.order_cancel, sp.parent_id, sp.prefix, concat(sp.prefix, '-', s.order_no), s.order_type, ((s.order_quantity)::numeric * ms.dealer_price), ms.dealer_price, s.dealer_confirmed, s.order_date, s.order_date_np, s.pi_number, sp.incharge_id, sp.spares_incharge_id, s.pi_generated_date_time, s.dispatch_mode, s.picklist, s.confirmed_type, s.pi_cost, mst_spareparts.name, mst_spareparts.part_code, COALESCE(sds.dispatched_quantity, 0), sds.grn_no, sds.grn_received_date, sds.grn_received_date_np, sds.bill_no, sds.dispatched_date, sds.dispatched_date_nepali;

-- ----------------------------
-- View structure for view_spareparts_pending_pi_confirm
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_pending_pi_confirm" AS 
 SELECT sso.dealer_id,
    sso.order_no,
    sso.dealer_confirmed,
    sso.pi_confirmed AS cg_confirmed,
    msd.name AS dealer_name,
    msd.incharge_id,
    msd.credit_policy,
    msd.prefix,
    concat(msd.prefix, '-', sso.order_no) AS "order",
    sso.order_cancel
   FROM (spareparts_sparepart_order sso
     JOIN dms_dealers msd ON ((sso.dealer_id = msd.id)))
  GROUP BY sso.dealer_id, sso.pi_confirmed, sso.order_no, sso.dealer_confirmed, msd.name, msd.incharge_id, msd.prefix, msd.credit_policy, sso.order_cancel;

-- ----------------------------
-- View structure for view_spareparts_recent_dispatch_list
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_recent_dispatch_list" AS 
 SELECT sss.sparepart_id,
    ms.part_code,
    ms.latest_part_code,
    ms.name,
    sum(sds.dispatched_quantity) AS total_dispatched,
    sds.bill_no,
    sds.dispatched_date,
    sds.dispatched_date_nepali,
    sds.order_no,
    sds.grn_received_date,
    sds.deleted_at,
    sds.proforma_invoice_id,
    sds.dealer_id
   FROM ((spareparts_dispatch_spareparts sds
     LEFT JOIN spareparts_sparepart_stock sss ON ((sds.stock_id = sss.id)))
     LEFT JOIN mst_spareparts ms ON ((sss.sparepart_id = ms.id)))
  GROUP BY ms.part_code, ms.name, ms.latest_part_code, sss.sparepart_id, sds.bill_no, sds.dispatched_date, sds.dispatched_date_nepali, sds.order_no, sds.grn_received_date, sds.deleted_at, sds.proforma_invoice_id, sds.dealer_id;


CREATE OR REPLACE VIEW "public"."view_spareparts_register" AS 
 SELECT concat(e.first_name, ' ', e.middle_name, ' ', e.last_name) AS mechanic_name,
    e.dealer_name,
    e.part_code,
    e.part_name,
    e.vehicle_name,
    e.chassis_no,
    sum(e.total_parts) AS taxable,
    sum(e.vat_parts) AS taxes,
    (COALESCE((sum(e.total_parts))::double precision, (0)::double precision) + COALESCE((sum(e.vat_parts))::double precision, (0)::double precision)) AS net_amount,
    e.issue_date,
    e.dealer_id,
    e.deleted_by,
    e.deleted_at,
    e.jobcard_group
   FROM view_spareparts_mechanic e
  GROUP BY concat(e.first_name, ' ', e.middle_name, ' ', e.last_name), e.dealer_name, e.part_code, e.part_name, e.vehicle_name, e.chassis_no, e.issue_date, e.dealer_id, e.deleted_by, e.deleted_at, e.jobcard_group;


CREATE OR REPLACE VIEW "public"."view_spareparts_shipment_monitor" AS 
 SELECT smd.invoice_no,
    smd.order_no,
    sum(smd.quantity) AS dispatched_quantity,
    (smd.msil_invoice_date - vgso.date) AS inv_ord,
    (smd.msil_dispatch_date - smd.msil_invoice_date) AS dis_inv,
    (smd.reached_date - smd.msil_dispatch_date) AS rea_dis,
    (((sum(smd.quantity))::double precision * (100)::double precision) / (vgso.total_quantity)::double precision) AS msil_dis_ser,
    sum((smd.quantity * smd.unit_rate)) AS dis_val,
    smd.reached_date,
    smd.msil_dispatch_date,
    smd.msil_invoice_date,
    rank() OVER (PARTITION BY smd.order_no ORDER BY smd.invoice_no) AS rnk,
    vgso.total_quantity AS order_quantity,
    vdso.total_dispatched_quantity,
    vgso.order_no AS order_number,
    concat(rank() OVER (PARTITION BY smd.order_no ORDER BY smd.invoice_no), '-', 'Pick') AS pick_level
   FROM ((spareparts_msil_order smd
     LEFT JOIN view_report_spareparts_grouped_order_generate vgso ON (((smd.order_no)::text = (vgso.final_order_no)::text)))
     LEFT JOIN ( SELECT smo.order_no,
            sum(smo.quantity) AS total_dispatched_quantity
           FROM spareparts_msil_order smo
          GROUP BY smo.order_no) vdso ON (((vdso.order_no)::text = (smd.order_no)::text)))
  GROUP BY smd.invoice_no, smd.order_no, smd.reached_date, smd.msil_dispatch_date, smd.msil_invoice_date, vgso.date, vgso.total_quantity, vdso.total_dispatched_quantity, vgso.order_no;

-- ----------------------------
-- View structure for view_spareparts_stock_adjustment
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_spareparts_stock_adjustment" AS 
 SELECT ms.part_code,
    ms.name AS part_name,
    ms.alternate_part_code,
    ms.latest_part_code,
    ssa.id,
    ssa.created_by,
    ssa.updated_by,
    ssa.deleted_by,
    ssa.created_at,
    ssa.updated_at,
    ssa.deleted_at,
    ssa.sparepart_id,
    ssa.old_stock,
    ssa.new_stock,
    ssa.remarks,
    ssa.approved_by,
    ssa.approved_date,
    ssa.requested_by,
    ssa.requested_date,
    ssa.requested_date_np,
    ssa.approved_date_np,
    ssa.status
   FROM (spareparts_stock_adjustment ssa
     JOIN mst_spareparts ms ON ((ssa.sparepart_id = ms.id)));

CREATE OR REPLACE VIEW "public"."view_stock_all" AS 
 SELECT lsr.deleted_at,
    lsr.stock_yard_id,
    mdr.vehicle_id AS mst_vehicle_id,
    mdr.color_id AS mst_color_id,
    mdr.variant_id AS mst_variant_id,
    count(mdr.id) AS stock_count,
    mst_colors.name AS color_name,
    mst_variants.name AS variant_name,
    mst_vehicles.name AS vehicle_name
   FROM ((((log_stock_records lsr
     JOIN msil_dispatch_records mdr ON ((lsr.vehicle_id = mdr.id)))
     JOIN mst_colors ON ((mst_colors.id = mdr.color_id)))
     JOIN mst_variants ON ((mst_variants.id = mdr.variant_id)))
     JOIN mst_vehicles ON ((mst_vehicles.id = mdr.vehicle_id)))
  WHERE ((mdr.current_location)::text = 'KATHMANDU'::text)
  GROUP BY lsr.deleted_at, lsr.stock_yard_id, mdr.vehicle_id, mdr.color_id, mdr.variant_id, mst_colors.name, mst_variants.name, mst_vehicles.name;

-- ----------------------------
-- View structure for view_stock_details
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_stock_details" AS 
 SELECT s.id AS stock_id,
    s.created_by,
    s.updated_by,
    s.deleted_by,
    s.created_at,
    s.updated_at,
    s.deleted_at,
    s.vehicle_id AS stock_vehicle_id,
    ms.id AS msil_dispatch_id,
    ms.vehicle_id,
    ms.variant_id,
    ms.color_id,
    ms.dispatch_date,
    ms.barcode,
    ms.engine_no,
    ms.chass_no,
    ms.order_no,
    d.id AS dispatch_dealer_id,
    d.vehicle_id AS dispatch_dealer_vehicle_id,
    d.stock_yard_id,
    d.dealer_id,
    s.stock_yard_id AS main_stockyard_id,
    s.dispatched_date AS dispatch_to_customers,
    d.dispatched_date AS dispatch_to_dealers,
    s.is_damage,
    ms.current_status,
    d.received_date,
    ms.year
   FROM ((log_stock_records s
     JOIN msil_dispatch_records ms ON ((s.vehicle_id = ms.id)))
     LEFT JOIN log_dispatch_dealer d ON ((d.vehicle_id = ms.id)));

-- ----------------------------
-- View structure for view_stock_yard_stocks
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_stock_yard_stocks" AS 
 SELECT m.id,
    m.created_by,
    m.updated_by,
    m.deleted_by,
    m.created_at,
    m.updated_at,
    m.deleted_at,
    m.vehicle_id,
    m.variant_id,
    m.color_id,
    m.engine_no,
    m.chass_no,
    m.dispatch_date,
    m.month,
    m.year,
    m.order_no,
    m.ait_reference_no,
    m.invoice_no,
    m.invoice_date,
    m.transit,
        CASE
            WHEN (m.transit = 1) THEN 'Transit Complete'::text
            ELSE 'In Transit'::text
        END AS transit_status,
    m.indian_stock_yard,
    m.indian_custom,
    m.nepal_custom,
    m.border,
    m.barcode,
    v.name AS vehicle_name,
    v1.name AS variant_name,
    c.name AS color_name,
    c.code AS color_code,
    l.reached_date AS stock_yard_reached_date,
    l.dispatched_date AS stock_yard_dispatched_date,
    ms.name AS stockyard_name
   FROM (((((msil_dispatch_records m
     LEFT JOIN mst_vehicles v ON ((m.vehicle_id = v.id)))
     LEFT JOIN mst_variants v1 ON ((m.variant_id = v1.id)))
     LEFT JOIN mst_colors c ON ((m.color_id = c.id)))
     LEFT JOIN log_stock_records l ON ((m.id = l.vehicle_id)))
     LEFT JOIN mst_stock_yards ms ON ((l.stock_yard_id = ms.id)))
  WHERE (l.dispatched_date IS NULL);

-- ----------------------------
-- View structure for view_stockyard_stock_transfer
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_stockyard_stock_transfer" AS 
 SELECT s.id,
    s.created_by,
    s.updated_by,
    s.deleted_by,
    s.created_at,
    s.updated_at,
    s.deleted_at,
    s.stock_from,
    s.stock_to,
    s.dispatch_date_en,
    s.dispatch_date_np,
    s.accepted_date_en,
    s.accepted_date_np,
    s.status,
    fsy.name AS from_stockyard,
    tsy.name AS to_stockyard
   FROM ((spareparts_stock_transfers s
     JOIN spareparts_stockyards fsy ON ((s.stock_from = fsy.id)))
     JOIN spareparts_stockyards tsy ON ((s.stock_to = tsy.id)));

-- ----------------------------
-- View structure for view_tar_billing_region_wise
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_tar_billing_region_wise" AS 
 SELECT tr.target_year,
    tr.month,
    tr.quantity AS billing_target,
    mst_district_mvs.id AS region_id,
    mst_district_mvs.name AS region_name
   FROM ((((sales_target_records tr
     JOIN dms_dealers ON ((tr.dealer_id = dms_dealers.id)))
     JOIN mst_district_mvs dis ON ((dms_dealers.district_id = dis.id)))
     JOIN mst_district_mvs zone ON ((dis.parent_id = zone.id)))
     JOIN mst_district_mvs ON ((zone.parent_id = mst_district_mvs.id)));

-- ----------------------------
-- View structure for view_tar_retail_region_wise
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_tar_retail_region_wise" AS 
 SELECT tr.target_year,
    tr.month,
    mst_district_mvs.id AS region_id,
    mst_district_mvs.name AS region_name,
    tr.retail_quantity AS retail_target
   FROM ((((sales_target_records tr
     JOIN dms_dealers ON ((tr.dealer_id = dms_dealers.id)))
     JOIN mst_district_mvs dis ON ((dms_dealers.district_id = dis.id)))
     JOIN mst_district_mvs zone ON ((dis.parent_id = zone.id)))
     JOIN mst_district_mvs ON ((zone.parent_id = mst_district_mvs.id)));

-- ----------------------------
-- View structure for view_temp_msil
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_temp_msil" AS 
 SELECT msil_orders.id,
    msil_orders.created_by,
    msil_orders.updated_by,
    msil_orders.deleted_by,
    msil_orders.created_at,
    msil_orders.updated_at,
    msil_orders.deleted_at,
    msil_orders.vehicle_id,
    msil_orders.variant_id,
    msil_orders.color_id,
    msil_orders.month,
    msil_orders.year,
    msil_orders.order_id,
    msil_orders.quantity,
    msil_orders.firm_id,
    msil_orders.received_quantity,
    msil_orders.vehicle_received_status,
    msil_orders.cancel_quantity,
    msil_orders.reason,
    msil_orders.unplanned_order,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name
   FROM (((msil_orders
     LEFT JOIN mst_vehicles ON ((msil_orders.vehicle_id = mst_vehicles.id)))
     LEFT JOIN mst_variants ON ((msil_orders.variant_id = mst_variants.id)))
     LEFT JOIN mst_colors ON ((msil_orders.color_id = mst_colors.id)));


CREATE OR REPLACE VIEW "public"."view_test_drive_latest_niroj" AS 
 SELECT DISTINCT ON (td.customer_id) td.customer_id,
    td.id,
    td.created_at
   FROM dms_customer_test_drives td
  ORDER BY td.customer_id, td.created_at DESC;

-- ----------------------------
-- View structure for view_test_drive_report
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_test_drive_report" AS 
 SELECT td.id,
    td.created_by,
    td.updated_by,
    td.deleted_by,
    td.created_at,
    td.updated_at,
    td.deleted_at,
    td.customer_id,
    td.td_date_en,
    td.td_date_np,
    td.td_time,
    td.executive_id,
    td.vehicle_id,
    td.variant_id,
    td.mileage_start,
    td.mileage_end,
    td.duration,
    td.td_location,
    va.name AS variant_name,
    ve.name AS vehicle_name,
        CASE
            WHEN ((e.middle_name)::text <> ''::text) THEN (((((e.first_name)::text || ' '::text) || (e.middle_name)::text) || ' '::text) || (e.last_name)::text)
            ELSE (((e.first_name)::text || ' '::text) || (e.last_name)::text)
        END AS executive_name,
    dms_customers.inquiry_kind,
    dms_dealers.name AS dealer_name,
    mst_sources.name AS sorce_name,
    view_customer_status_latest.name AS status_name,
    split_part((td.td_date_np)::text, '-'::text, 1) AS year_np,
    split_part((td.td_date_np)::text, '-'::text, 2) AS month_np,
    td.fuel,
    td.kms,
    td.month,
    td.fuel_location,
    td.reported_by,
    td.closing_kms,
    td.opening_kms,
    td.document,
        CASE
            WHEN ((dms_customers.middle_name)::text <> ''::text) THEN (((((dms_customers.first_name)::text || ' '::text) || (dms_customers.middle_name)::text) || ' '::text) || (dms_customers.last_name)::text)
            ELSE (((dms_customers.first_name)::text || ' '::text) || (dms_customers.last_name)::text)
        END AS customer_name,
    dms_customers.contact_1_mobile,
    td.chassis_no_test,
    dms_customers.mobile_1,
    t.name AS source_type
   FROM ((((((((dms_customer_test_drives td
     LEFT JOIN mst_vehicles ve ON ((td.vehicle_id = ve.id)))
     LEFT JOIN mst_variants va ON ((td.variant_id = va.id)))
     LEFT JOIN dms_employees e ON ((td.executive_id = e.id)))
     JOIN dms_customers ON ((td.customer_id = dms_customers.id)))
     JOIN dms_dealers ON ((dms_customers.dealer_id = dms_dealers.id)))
     JOIN mst_sources ON ((dms_customers.source_id = mst_sources.id)))
     JOIN view_customer_status_latest ON ((td.customer_id = view_customer_status_latest.customer_id)))
     LEFT JOIN mst_source_type t ON ((dms_customers.source_type_id = t.id)));


CREATE OR REPLACE VIEW "public"."view_user_groups" AS 
 SELECT ug.user_id,
    ug.group_id,
    g.name AS "group",
    u.username,
    u.email,
    u.fullname
   FROM ((aauth_user_groups ug
     JOIN aauth_users u ON ((u.id = ug.user_id)))
     JOIN aauth_groups g ON ((g.id = ug.group_id)));

-- ----------------------------
-- View structure for view_user_ledger
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_user_ledger" AS 
 SELECT mst_user_ledger.id,
    mst_user_ledger.created_by,
    mst_user_ledger.updated_by,
    mst_user_ledger.deleted_by,
    mst_user_ledger.created_at,
    mst_user_ledger.updated_at,
    mst_user_ledger.deleted_at,
    mst_user_ledger.title,
    mst_user_ledger.short_name,
    mst_user_ledger.full_name,
    mst_user_ledger.address1,
    mst_user_ledger.address2,
    mst_user_ledger.address3,
    mst_user_ledger.city,
    mst_user_ledger.area,
    mst_user_ledger.district_id,
    mst_user_ledger.zone_id,
    mst_user_ledger.pin_code,
    mst_user_ledger.std_code,
    mst_user_ledger.mobile,
    mst_user_ledger.phone_no,
    mst_user_ledger.email,
    mst_district_mvs.name AS district_name,
    mst_user_ledger.dob,
    (((mst_user_ledger.full_name)::text || ' - '::text) || (mst_user_ledger.address1)::text) AS party_name,
    mst_user_ledger.dealer_id,
    mst_user_ledger.pan_no
   FROM (mst_user_ledger
     LEFT JOIN mst_district_mvs ON ((mst_user_ledger.district_id = mst_district_mvs.id)))
  GROUP BY mst_user_ledger.id, mst_user_ledger.created_by, mst_user_ledger.updated_by, mst_user_ledger.deleted_by, mst_user_ledger.created_at, mst_user_ledger.updated_at, mst_user_ledger.deleted_at, mst_user_ledger.title, mst_user_ledger.short_name, mst_user_ledger.full_name, mst_user_ledger.address1, mst_user_ledger.address2, mst_user_ledger.address3, mst_user_ledger.city, mst_user_ledger.area, mst_user_ledger.district_id, mst_user_ledger.zone_id, mst_user_ledger.pin_code, mst_user_ledger.std_code, mst_user_ledger.mobile, mst_user_ledger.phone_no, mst_user_ledger.email, mst_district_mvs.name;


CREATE OR REPLACE VIEW "public"."view_user_permissions" AS 
 SELECT up.user_id,
    up.perm_id,
    perm.name AS permission,
    u.username,
    u.email,
    u.fullname
   FROM ((aauth_user_permissions up
     JOIN aauth_users u ON ((u.id = up.user_id)))
     JOIN aauth_permissions perm ON ((perm.id = up.perm_id)));

-- ----------------------------
-- View structure for view_users
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_users" AS 
 SELECT u.id,
    u.email,
    u.pass,
    u.username,
    u.fullname,
    u.banned,
    u.last_login,
    u.last_activity,
    u.date_created,
    u.forgot_exp,
    u.remember_time,
    u.remember_exp,
    u.verification_code,
    u.totp_secret,
    u.ip_address,
    de.dealer_id,
    dd.name AS dealer_name,
    aug.group_id
   FROM (((aauth_users u
     LEFT JOIN dms_employees de ON ((u.id = de.user_id)))
     LEFT JOIN dms_dealers dd ON ((de.dealer_id = dd.id)))
     JOIN aauth_user_groups aug ON (((u.id = aug.user_id) AND (aug.group_id <> 1))));

-- ----------------------------
-- View structure for view_vehicle_detail_foc
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_vehicle_detail_foc" AS 
 SELECT mdr.engine_no,
    mdr.chass_no,
    mdr.vehicle_id,
    mdr.variant_id,
    mdr.color_id,
    svp.customer_id,
    svp.deleted_at,
    mst_colors.name AS color_name,
    mst_variants.name AS variant_name,
    mst_vehicles.name AS vehicle_name
   FROM ((((sales_vehicle_process svp
     JOIN msil_dispatch_records mdr ON ((svp.msil_dispatch_id = mdr.id)))
     JOIN mst_colors ON ((mdr.color_id = mst_colors.id)))
     JOIN mst_variants ON ((mdr.variant_id = mst_variants.id)))
     JOIN mst_vehicles ON ((mdr.vehicle_id = mst_vehicles.id)));

-- ----------------------------
-- View structure for view_vehicle_edit
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_vehicle_edit" AS 
 SELECT crm_vehicle_edit.id,
    crm_vehicle_edit.created_by,
    crm_vehicle_edit.updated_by,
    crm_vehicle_edit.deleted_by,
    crm_vehicle_edit.created_at,
    crm_vehicle_edit.updated_at,
    crm_vehicle_edit.deleted_at,
    crm_vehicle_edit.customer_id,
    crm_vehicle_edit.prev_vehicle,
    crm_vehicle_edit.prev_variant,
    crm_vehicle_edit.prev_color,
    crm_vehicle_edit.new_vehicle,
    crm_vehicle_edit.new_variant,
    crm_vehicle_edit.new_color,
    crm_vehicle_edit.date,
    crm_vehicle_edit.date_np,
    c.inquiry_no,
    v1.name AS prev_vehicle_name,
    v2.name AS prev_variant_name,
    v3.name AS prev_color_name,
    v3.code AS prev_color_code,
    v4.name AS new_vehicle_name,
    v5.name AS new_variant_name,
    v6.name AS new_color_name,
    v6.code AS new_color_code,
    dms_dealers.name AS dealer_name,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
    csl.name,
    csl.sub_status_name,
    c.inquiry_date_en
   FROM (((((((((crm_vehicle_edit
     JOIN dms_customers c ON ((crm_vehicle_edit.customer_id = c.id)))
     JOIN mst_vehicles v1 ON ((crm_vehicle_edit.prev_vehicle = v1.id)))
     JOIN mst_variants v2 ON ((crm_vehicle_edit.prev_variant = v2.id)))
     JOIN mst_colors v3 ON ((crm_vehicle_edit.prev_color = v3.id)))
     JOIN mst_vehicles v4 ON ((crm_vehicle_edit.new_vehicle = v4.id)))
     JOIN mst_variants v5 ON ((crm_vehicle_edit.new_variant = v5.id)))
     JOIN mst_colors v6 ON ((crm_vehicle_edit.new_color = v6.id)))
     JOIN dms_dealers ON ((c.dealer_id = dms_dealers.id)))
     JOIN view_customer_status_latest csl ON ((crm_vehicle_edit.customer_id = csl.customer_id)));

-- ----------------------------
-- View structure for view_vehicle_edited
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_vehicle_edited" AS 
 SELECT t1.id,
    t1.created_by,
    t1.updated_by,
    t1.deleted_by,
    t1.created_at,
    t1.updated_at,
    t1.deleted_at,
    t1.customer_id,
    t1.prev_vehicle,
    t1.prev_variant,
    t1.prev_color,
    t1.new_vehicle,
    t1.new_variant,
    t1.new_color,
    t1.date,
    t1.date_np,
    t1.status_id
   FROM (crm_vehicle_edit t1
     JOIN ( SELECT min(crm_vehicle_edit.id) AS id
           FROM crm_vehicle_edit
          GROUP BY crm_vehicle_edit.customer_id) t ON ((t1.id = t.id)));

CREATE OR REPLACE VIEW "public"."view_walkin_source_dashboard" AS 
 SELECT dms_customers.id,
    mst_walkin_sources.name AS walkin_source_name,
    dms_customers.walkin_source_id,
    dms_customers.fiscal_year_id
   FROM (dms_customers
     JOIN mst_walkin_sources ON ((dms_customers.walkin_source_id = mst_walkin_sources.id)));



CREATE OR REPLACE VIEW "public"."pending_dhobighat_body_till_now" AS 
 SELECT ms.part_code,
    ms.jobcard_group,
    ms.dealer_id,
    dd.vehicle_no,
    dd.job_card_issue_date,
    dd.chassis_no,
    dd.engine_no,
    dd.color_name,
    dd.vehicle_name,
    dd.variant_name,
    ms.quantity,
    dd.closed_date,
    dd.jobcard_serial,
    ms.id
   FROM (ser_material_scan ms
     LEFT JOIN view_report_grouped_jobcard dd ON ((ms.jobcard_group = dd.jobcard_group)))
  WHERE (((ms.jobcard_group IS NOT NULL) AND (ms.dealer_id = 121)) AND (dd.invoice_no IS NULL));


CREATE OR REPLACE VIEW "public"."vew_dashboard_retail_modelwise_new" AS 
 SELECT mnm.name AS month_name,
    lsr.retail_fiscal_year,
        CASE
            WHEN (nn.id IS NOT NULL) THEN lsr.retail_edit_month
            ELSE (lsr.dispatched_date_np_month)::integer
        END AS dispatched_date_np_month,
    count(lsr.id) AS total_retail,
    mnm.rank AS month_rank,
    mst_vehicles.name AS vehicle_name,
    mst_vehicles.rank AS vehicle_rank,
    mst_vehicles.service_policy_id
   FROM ((((log_stock_records lsr
     JOIN mst_nepali_month mnm ON (((lsr.dispatched_date_np_month)::integer = mnm.id)))
     LEFT JOIN mst_nepali_month nn ON ((lsr.retail_edit_month = nn.id)))
     LEFT JOIN msil_dispatch_records ON ((lsr.vehicle_id = msil_dispatch_records.id)))
     LEFT JOIN mst_vehicles ON ((msil_dispatch_records.vehicle_id = mst_vehicles.id)))
  WHERE ((lsr.dispatched_date_np_month IS NOT NULL) AND ((lsr.retail_fiscal_year)::text = '2076-77'::text))
  GROUP BY mnm.name, lsr.retail_fiscal_year, lsr.dispatched_date_np_month, mnm.rank, mst_vehicles.name, mst_vehicles.rank, mst_vehicles.service_policy_id, nn.id, lsr.retail_edit_month
  ORDER BY mnm.rank;


  CREATE OR REPLACE VIEW "public"."view_abc_total_calculation" AS 
 SELECT s.deleted_at,
    s.sparepart_id,
    s.part_name,
    s.part_code,
    s.price,
    s.category_id,
    s.alternate_part_code,
    s.moq,
    s.model,
    s.total,
    s.quantity,
    ((s.total)::numeric * s.price) AS total_cost,
    s.stock_id,
    s.stockyard_id,
    s.latest_part_code
   FROM view_fms_calculation s
  GROUP BY s.part_name, s.sparepart_id, s.part_code, s.price, s.category_id, s.alternate_part_code, s.moq, s.model, s.deleted_at, s.total, s.stock_id, s.quantity, s.stockyard_id, s.latest_part_code;


CREATE OR REPLACE VIEW "public"."view_abc" AS 
 SELECT abc.deleted_at,
    abc.sparepart_id,
    abc.part_name,
    abc.part_code,
    abc.price,
    abc.category_id,
    abc.alternate_part_code,
    abc.moq,
    abc.model,
    abc.total,
    abc.quantity,
    abc.total_cost,
    abc.stock_id,
    sum(abc.total_cost) OVER (ORDER BY abc.total_cost DESC) AS cum_total_cost,
    ( SELECT sum(ab.total_cost) AS sum
           FROM view_abc_total_calculation ab) AS total_cost_abc,
    ((sum(abc.total_cost) OVER (ORDER BY abc.total_cost DESC) * (100)::numeric) / ( SELECT sum(ab.total_cost) AS sum
           FROM view_abc_total_calculation ab)) AS percentage,
        CASE
            WHEN (((sum(abc.total_cost) OVER (ORDER BY abc.total_cost DESC) * (100)::numeric) / ( SELECT sum(ab.total_cost) AS sum
               FROM view_abc_total_calculation ab)) <= (75)::numeric) THEN 'A'::text
            WHEN ((((sum(abc.total_cost) OVER (ORDER BY abc.total_cost DESC) * (100)::numeric) / ( SELECT sum(ab.total_cost) AS sum
               FROM view_abc_total_calculation ab)) > (75)::numeric) AND (((sum(abc.total_cost) OVER (ORDER BY abc.total_cost DESC) * (100)::numeric) / ( SELECT sum(ab.total_cost) AS sum
               FROM view_abc_total_calculation ab)) <= (90)::numeric)) THEN 'B'::text
            ELSE 'C'::text
        END AS abc,
    abc.stockyard_id,
    abc.latest_part_code
   FROM view_abc_total_calculation abc;

CREATE OR REPLACE VIEW "public"."view_all_grouped_jobcard" AS 
 SELECT gc.jobcard_group,
    gc.vehicle_id,
    gc.variant_id,
    gc.service_type,
    gc.vehicle_no,
    gc.closed_status,
    gc.issue_date,
    gc.deleted_at,
    gc.vehicle_name,
    gc.variant_name,
    gc.service_type_name,
    gc.job_card_issue_date,
    gc.customer_name,
    gc.firm_id,
    gc.firm_name,
    gc.service_count,
    gc.chassis_no,
    gc.engine_no,
    gc.kms,
    gc.mechanics_id,
    gc.year,
    gc.reciever_name,
    gc.remarks,
    gc.dealer_id,
    gc.jobcard_serial,
    gc.color_id,
    gc.color_name,
    gc.floor_supervisor_id,
    gc.vehicle_rank,
    gc.variant_rank,
    gc.pdi_kms,
    gc.service_policy_id,
    gc.vehicle_sold_on,
    gc.address1,
    gc.address2,
    gc.dealer_name,
    gc.service_adviser_id,
    gc.service_advisor_name,
    gc.fiscal_year_id,
    gc.floor_supervisor_name,
    gc.material_issued_status,
    gc.coupon,
    gc.mobile,
    gc.pan_no,
    gc.inquiry_date_en,
    gc.invoice_no,
    gc.tire_make,
    gc.battery_no,
    gc.material_issued_date,
    concat(wu.first_name, ' ', wu.middle_name, ' ', wu.last_name) AS mechanic_name,
    jd.job_desc
   FROM ((view_report_grouped_jobcard gc
     LEFT JOIN ser_workshop_users wu ON ((gc.mechanics_id = wu.id)))
     LEFT JOIN view_jobcard_desc jd ON ((gc.jobcard_group = jd.jobcard_group)));


CREATE OR REPLACE VIEW "public"."view_all_jobcards" AS 
 SELECT ser_job_cards.jobcard_group,
    ser_job_cards.vehicle_id,
    ser_job_cards.variant_id,
    ser_job_cards.service_type,
    ser_job_cards.vehicle_no,
    ser_job_cards.closed_status,
    ser_billing_record.issue_date,
    ser_job_cards.deleted_at,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_service_types.name AS service_type_name,
    ser_job_cards.issue_date AS job_card_issue_date,
    mst_user_ledger.full_name AS customer_name,
    mst_vehicles.firm_id,
    mst_firms.name AS firm_name,
    ser_job_cards.service_count,
    ser_job_cards.chassis_no,
    ser_job_cards.engine_no,
    ser_job_cards.kms,
    ser_job_cards.mechanics_id,
    ser_job_cards.year,
    ser_job_cards.reciever_name,
    ser_job_cards.remarks,
    ser_job_cards.dealer_id,
    ser_job_cards.jobcard_serial,
    ser_job_cards.color_id,
    mst_colors.name AS color_name,
    ser_job_cards.floor_supervisor_id,
    mst_vehicles.rank AS vehicle_rank,
    mst_variants.rank AS variant_rank,
    ser_job_cards.pdi_kms,
    mst_vehicles.service_policy_id,
    ser_job_cards.vehicle_sold_on,
    mst_user_ledger.address1,
    mst_user_ledger.address2,
    dms_dealers.name AS dealer_name,
    ser_job_cards.service_adviser_id,
    (((dms_employees.first_name)::text || ' '::text) || (dms_employees.last_name)::text) AS service_advisor_name,
    ser_job_cards.fiscal_year_id,
    (((flr.first_name)::text || ' '::text) || (flr.last_name)::text) AS floor_supervisor_name,
        CASE
            WHEN (sfs.jobcard_group IS NOT NULL) THEN 1
            ELSE 0
        END AS material_issued_status,
    ser_job_cards.coupon,
    mst_user_ledger.mobile,
    mst_user_ledger.pan_no,
    split_part((ser_job_cards.issue_date)::text, ' '::text, 1) AS inquiry_date_en,
    ser_billing_record.invoice_no,
    ser_job_cards.tire_make,
    ser_job_cards.battery_no,
    view_jobcard_material_scan_group.issue_date AS material_issued_date,
    view_jobcard_desc.job_desc,
    concat(ser_workshop_users.first_name, ' ', ser_workshop_users.middle_name, ' ', ser_workshop_users.last_name) AS mechanic_name
   FROM ((((((((((((((ser_job_cards
     JOIN mst_service_types ON ((ser_job_cards.service_type = mst_service_types.id)))
     LEFT JOIN ser_billing_record ON ((ser_job_cards.jobcard_group = ser_billing_record.jobcard_group)))
     LEFT JOIN mst_variants ON ((ser_job_cards.variant_id = mst_variants.id)))
     JOIN mst_vehicles ON ((ser_job_cards.vehicle_id = mst_vehicles.id)))
     LEFT JOIN mst_user_ledger ON ((ser_job_cards.party_id = mst_user_ledger.id)))
     LEFT JOIN mst_firms ON ((mst_vehicles.firm_id = mst_firms.id)))
     LEFT JOIN mst_colors ON ((ser_job_cards.color_id = mst_colors.id)))
     LEFT JOIN dms_dealers ON ((ser_job_cards.dealer_id = dms_dealers.id)))
     LEFT JOIN dms_employees ON ((dms_employees.user_id = ser_job_cards.service_adviser_id)))
     LEFT JOIN dms_employees flr ON ((ser_job_cards.floor_supervisor_id = flr.user_id)))
     LEFT JOIN view_floor_supervisor_adviced sfs ON (((sfs.jobcard_group = ser_job_cards.jobcard_group) AND (ser_job_cards.dealer_id = sfs.dealer_id))))
     LEFT JOIN view_jobcard_material_scan_group ON ((ser_job_cards.jobcard_group = view_jobcard_material_scan_group.jobcard_group)))
     JOIN view_jobcard_desc ON ((ser_job_cards.jobcard_group = view_jobcard_desc.jobcard_group)))
     JOIN ser_workshop_users ON ((ser_job_cards.mechanics_id = ser_workshop_users.id)))
  WHERE ((ser_job_cards.deleted_at > now()) OR (ser_job_cards.deleted_at IS NULL))
  GROUP BY ser_job_cards.vehicle_no, ser_job_cards.variant_id, ser_job_cards.service_type, ser_job_cards.vehicle_id, mst_service_types.name, ser_job_cards.jobcard_group, ser_job_cards.closed_status, ser_billing_record.issue_date, ser_job_cards.deleted_at, mst_variants.name, mst_vehicles.name, ser_job_cards.issue_date, mst_user_ledger.full_name, mst_vehicles.firm_id, mst_firms.name, ser_job_cards.service_count, ser_job_cards.chassis_no, ser_job_cards.engine_no, ser_job_cards.kms, ser_job_cards.mechanics_id, ser_job_cards.year, ser_job_cards.reciever_name, ser_job_cards.remarks, ser_job_cards.dealer_id, ser_job_cards.jobcard_serial, ser_job_cards.color_id, mst_colors.name, ser_job_cards.floor_supervisor_id, mst_vehicles.rank, mst_variants.rank, ser_job_cards.pdi_kms, mst_vehicles.service_policy_id, ser_job_cards.vehicle_sold_on, mst_user_ledger.address1, mst_user_ledger.address2, dms_dealers.name, ser_job_cards.service_adviser_id, dms_employees.first_name, dms_employees.last_name, ser_job_cards.fiscal_year_id, flr.first_name, flr.last_name, sfs.jobcard_group, ser_job_cards.coupon, mst_user_ledger.mobile, mst_user_ledger.pan_no, ser_billing_record.invoice_no, ser_job_cards.tire_make, ser_job_cards.battery_no, view_jobcard_material_scan_group.issue_date, view_jobcard_desc.job_desc, ser_workshop_users.first_name, ser_workshop_users.middle_name, ser_workshop_users.last_name;


CREATE OR REPLACE VIEW "public"."view_app_customer" AS 
 SELECT c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    c.inquiry_no,
    c.inquiry_kind,
    c.fiscal_year_id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.customer_type_id,
    c.first_name,
    c.middle_name,
    c.last_name,
    c.gender,
    c.marital_status,
    c.family_size,
    c.dob_en,
    c.dob_np,
    c.anniversary_en,
    c.anniversary_np,
    c.district_id,
    c.mun_vdc_id,
    c.address_1,
    c.address_2,
    c.email,
    c.home_1,
    c.home_2,
    c.work_1,
    c.work_2,
    c.mobile_1,
    c.mobile_2,
    c.pref_communication,
    c.occupation_id,
    c.education_id,
    c.dealer_id,
    c.executive_id,
    c.payment_mode_id,
    c.source_id,
    c.status_id,
    c.contact_1_name,
    c.contact_1_mobile,
    c.contact_1_relation_id,
    c.contact_2_name,
    c.contact_2_mobile,
    c.contact_2_relation_id,
    c.remarks,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    c.walkin_source_id,
    c.event_id,
    c.institution_id,
    c.exchange_car_make,
    c.exchange_car_model,
    c.exchange_car_year,
    c.exchange_car_kms,
    c.exchange_car_value,
    c.exchange_car_bonus,
    c.exchange_total_offer,
    c.bank_id,
    c.bank_branch,
    c.bank_staff,
    c.bank_contact,
    c.booking_canceled,
    c.discount_amount,
    c.rank,
    c.is_edited,
    c.vehicle_make_year,
    c.exchange_car_variant,
    c.document,
    col.name AS color_name,
    col.code,
    v.name AS vehicle_name,
    va.name AS variant_name,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
        CASE
            WHEN ((e.middle_name)::text <> ''::text) THEN (((((e.first_name)::text || ' '::text) || (e.middle_name)::text) || ' '::text) || (e.last_name)::text)
            ELSE (((e.first_name)::text || ' '::text) || (e.last_name)::text)
        END AS executive_name,
    c.customer_image,
    c.latitude,
    c.longitude,
    sl.rank AS actual_status_rank,
    sl.name AS actual_status_name,
    sl.status_id AS actual_status_id
   FROM (((((dms_customers c
     LEFT JOIN dms_employees e ON ((c.executive_id = e.id)))
     LEFT JOIN mst_colors col ON ((c.color_id = col.id)))
     LEFT JOIN mst_variants va ON ((c.variant_id = va.id)))
     LEFT JOIN mst_vehicles v ON ((c.vehicle_id = v.id)))
     LEFT JOIN view_customer_status_latest sl ON ((c.id = sl.customer_id)));


CREATE OR REPLACE VIEW "public"."view_back_log_spareparts" AS 
 SELECT so.order_no,
    so.order_quantity,
    so.sparepart_id,
    so.dealer_id,
    so.proforma_invoice_id,
    so.pi_generated,
    so.pi_confirmed,
    so.order_cancel,
    vdls.dispatch_quantity,
        CASE
            WHEN (((so.order_quantity - COALESCE(so.received_quantity)) - so.cancle_quantity) > 0) THEN ((so.order_quantity - COALESCE(so.received_quantity)) - so.cancle_quantity)
            WHEN (((so.order_quantity - COALESCE(so.received_quantity)) - so.cancle_quantity) = 0) THEN ((so.order_quantity - COALESCE(so.received_quantity)) - so.cancle_quantity)
            ELSE 0
        END AS required_quantity,
    so.deleted_at,
    mst_spareparts.name,
    mst_spareparts.part_code,
    mst_spareparts.price,
    dms_dealers.parent_id,
    so.dealer_confirmed,
    so.pi_number,
    so.pi_generated_date_time
   FROM (((spareparts_sparepart_order so
     LEFT JOIN view_dispatch_list_spareparts vdls ON (((so.order_no = vdls.order_no) AND (so.sparepart_id = vdls.sparepart_id))))
     JOIN mst_spareparts ON ((so.sparepart_id = mst_spareparts.id)))
     JOIN dms_dealers ON ((so.dealer_id = dms_dealers.id)));


CREATE OR REPLACE VIEW "public"."view_ccd_lost_case_report" AS 
 SELECT lc.id,
    lc.created_by,
    lc.updated_by,
    lc.deleted_by,
    lc.created_at,
    lc.updated_at,
    lc.deleted_at,
    lc.customer_id,
    lc.call_status,
    lc.date_of_call,
    lc.date_of_call_np,
    lc.voc,
    lc.sales_experience,
    lc.dse_attitude,
    lc.dse_knowledge,
    lc.scheme_information,
    lc.retail_finanace,
    lc.offered_test_drive,
    lc.warrenty_policy,
    lc.service_policy,
    lc.remarks,
    lc.call_count,
    lc.false_enquiry,
    lc.cold_enquiry,
    lc.personal_problem,
    lc.financial_problem,
    lc.still_under_consideration,
    lc.already_purchased_vehicle,
    lc.already_puchased_co_dealer,
    lc.pre_owner_vehicle,
    lc.competitors_model,
    lc.call_connect_inquiry_type,
    lc.competitor_m_product,
    lc.competitor_m_discount,
    lc.competitor_m_service,
    lc.competitor_m_stock,
    lc.closed_date,
    lc.brand,
    lc.model,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.mobile_1,
    c.walkin_source_id,
    c.source_id,
    v.name AS vehicle_name,
    va.name AS variant_name,
    ct.name AS customer_type_name,
    d.name AS dealer_name,
    pm.name AS payment_mode_name,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
        CASE
            WHEN ((e.middle_name)::text <> ''::text) THEN (((((e.first_name)::text || ' '::text) || (e.middle_name)::text) || ' '::text) || (e.last_name)::text)
            ELSE (((e.first_name)::text || ' '::text) || (e.last_name)::text)
        END AS executive_name,
    (('now'::text)::date - c.inquiry_date_en) AS inquiry_age,
    (
        CASE
            WHEN (m11.status_id = 4) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 5) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 6) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 7) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 8) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 9) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 10) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 11) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 12) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 13) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 14) THEN 'Retail Finance'::character varying
            ELSE m11.name
        END)::text AS status_name,
    m11.sub_status_name,
    c.source_type_id,
    split_part((lc.closed_date)::text, ' '::text, 1) AS close_date,
    (('now'::text)::date - (split_part((lc.closed_date)::text, ' '::text, 1))::date) AS closing_age,
    m11.status_date AS closs_date,
        CASE
            WHEN ((('now'::text)::date - (split_part((lc.closed_date)::text, ' '::text, 1))::date) > 3) THEN 'Late'::text
            ELSE 'Normal'::text
        END AS inquiry_date_status,
    concat(v.name, ' ', va.name) AS model_name,
    st.name AS source_name
   FROM (((((((((ccd_lostcase lc
     LEFT JOIN dms_customers c ON ((lc.customer_id = c.id)))
     LEFT JOIN mst_vehicles v ON ((c.vehicle_id = v.id)))
     LEFT JOIN mst_variants va ON ((c.variant_id = va.id)))
     LEFT JOIN mst_customer_types ct ON ((c.customer_type_id = ct.id)))
     LEFT JOIN dms_dealers d ON ((c.dealer_id = d.id)))
     LEFT JOIN dms_employees e ON ((c.executive_id = e.id)))
     LEFT JOIN mst_payment_modes pm ON ((c.payment_mode_id = pm.id)))
     LEFT JOIN view_customer_status_latest m11 ON ((c.id = m11.customer_id)))
     LEFT JOIN mst_sources st ON ((c.source_id = st.id)));


CREATE OR REPLACE VIEW "public"."view_customer_dealer_report" AS 
 SELECT c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.inquiry_no,
    c.deleted_at,
    c.fiscal_year_id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.dealer_id,
    d.name AS dealer_name,
    c.vehicle_id,
    v.name AS vehicle_name,
    c.variant_id,
    ss.status_name AS actual_status_name,
    c.inquiry_kind,
    ss.sub_status_name,
    ct.name AS customer_type_name,
    d.assistant_incharge_id,
    d.incharge_id
   FROM ((((dms_customers c
     LEFT JOIN dms_dealers d ON ((c.dealer_id = d.id)))
     LEFT JOIN mst_vehicles v ON ((c.vehicle_id = v.id)))
     LEFT JOIN view_customer_status_latest_niroj ss ON ((c.id = ss.customer_id)))
     JOIN mst_customer_types ct ON ((c.customer_type_id = ct.id)));


CREATE OR REPLACE VIEW "public"."view_customer_info_jobcard" AS 
 SELECT s.jobcard_group,
    s.party_id,
    mst_user_ledger.full_name,
    mst_user_ledger.mobile,
    s.dealer_id,
    br.issue_date AS billed_date,
    s.deleted_at,
    jd.job_desc
   FROM (((ser_job_cards s
     LEFT JOIN mst_user_ledger ON ((s.party_id = mst_user_ledger.id)))
     LEFT JOIN ser_billing_record br ON ((s.jobcard_group = br.jobcard_group)))
     LEFT JOIN view_job_description jd ON ((jd.billing_id = br.id)))
  WHERE ((s.deleted_at IS NULL) AND (br.deleted_at IS NULL))
  GROUP BY s.party_id, s.jobcard_group, mst_user_ledger.full_name, mst_user_ledger.mobile, s.dealer_id, br.issue_date, s.deleted_by, s.deleted_at, jd.job_desc;

-- ----------------------------
-- View structure for view_customer_latest_followups
-- ----------------------------

-- ----------------------------
-- View structure for view_customer_list
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_customer_list" AS 
 SELECT c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    c.inquiry_no,
    c.fiscal_year_id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.inquiry_kind,
    c.customer_type_id,
    c.first_name,
    c.middle_name,
    c.last_name,
    c.gender,
    c.marital_status,
    c.family_size,
    (date_part('year'::text, (now())::date) - date_part('year'::text, c.dob_en)) AS age,
    c.dob_en,
    c.dob_np,
    c.anniversary_en,
    c.anniversary_np,
    c.district_id,
    c.mun_vdc_id,
    c.address_1,
    c.address_2,
    c.email,
    c.home_1,
    c.home_2,
    c.work_1,
    c.work_2,
    c.mobile_1,
    c.mobile_2,
    c.pref_communication,
    c.occupation_id,
    c.education_id,
    c.dealer_id,
    c.executive_id,
    c.payment_mode_id,
    c.source_id,
    c.contact_1_name,
    c.contact_1_mobile,
    c.contact_1_relation_id,
    c.contact_2_name,
    c.contact_2_mobile,
    c.contact_2_relation_id,
    c.remarks,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    c.walkin_source_id,
    c.event_id,
    c.institution_id,
    c.exchange_car_make,
    c.exchange_car_model,
    c.exchange_car_year,
    c.exchange_car_kms,
    c.exchange_car_value,
    c.exchange_car_bonus,
    c.exchange_total_offer,
    c.bank_id,
    c.bank_branch,
    c.bank_staff,
    c.bank_contact,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
    ((substr((m1.nepali_start_date)::text, 0, 5) || '-'::text) || substr((m1.nepali_end_date)::text, 3, 2)) AS fiscal_year,
    m2.name AS customer_type_name,
    m2.rank AS customer_type_rank,
    replace((m3.parent_name)::text, ' Zone'::text, ''::text) AS zone_name,
    m3.name AS district_name,
    m4.name AS mun_vdc_name,
    m5.name AS occupation_name,
    m6.name AS education_name,
    m7.name AS dealer_name,
        CASE
            WHEN ((m8.middle_name)::text <> ''::text) THEN (((((m8.first_name)::text || ' '::text) || (m8.middle_name)::text) || ' '::text) || (m8.last_name)::text)
            ELSE (((m8.first_name)::text || ' '::text) || (m8.last_name)::text)
        END AS executive_name,
    m9.name AS payment_mode_name,
    m10.name AS source_name,
    m10.rank AS source_rank,
    m12.name AS contact_1_relation_name,
    m13.name AS contact_2_relation_name,
    m14.name AS vehicle_name,
    m14.rank AS vehicle_rank,
    m15.name AS variant_name,
    ((((m16.name)::text || ' ('::text) || (m16.code)::text) || ')'::text) AS color_name,
        CASE
            WHEN (c.walkin_source_id IS NOT NULL) THEN m17.name
            ELSE 'N/A'::character varying
        END AS walkin_source_name,
        CASE
            WHEN (c.event_id IS NOT NULL) THEN m18.name
            ELSE 'N/A'::character varying
        END AS event_name,
        CASE
            WHEN (c.institution_id IS NOT NULL) THEN m19.name
            ELSE 'N/A'::character varying
        END AS institution_name,
        CASE
            WHEN (c.bank_id IS NOT NULL) THEN m20.name
            ELSE 'Others'::character varying
        END AS bank_name,
        CASE
            WHEN (m21.id IS NULL) THEN 'NOT TAKEN'::text
            ELSE 'TAKEN'::text
        END AS test_drive,
    (
        CASE
            WHEN (c.source_id = 1) THEN m17.name
            WHEN (c.source_id = 2) THEN m18.name
            ELSE 'Referral'::character varying
        END)::text AS inquiry_type,
    c.booking_canceled,
    sales_vehicle_process.discount_amount,
    c.discount_amount AS customer_discount_amount,
    sales_vehicle_process.id AS vehicle_process_id,
    m3.parent_id,
    vdv.price,
    sales_booking_cancel.cancel_amount,
    sales_booking_cancel.notes,
    sales_vehicle_process.booking_receipt_no,
    sales_vehicle_process.vehicle_delivery_date,
    msil_dispatch_records.engine_no,
    msil_dispatch_records.chass_no,
    sales_vehicle_process.booked_date,
        CASE
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) IS NULL) THEN 'Not Booked'::text
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) <= 30) THEN 'Below 30 Days'::text
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) <= 60) THEN 'Below 30-60 Days'::text
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) <= 90) THEN 'Below 60-90 Days'::text
            ELSE 'Above 90 Days'::text
        END AS booking_ageing,
        CASE
            WHEN (sales_vehicle_process.booked_date IS NOT NULL) THEN (sales_vehicle_process.booked_date - c.inquiry_date_en)
            ELSE (('now'::text)::date - c.inquiry_date_en)
        END AS inquiry_age,
    log_stock_records.dispatched_date_np_year AS retail_year,
    mst_nepali_month.name AS nepali_month,
        CASE
            WHEN (m21.id IS NULL) THEN 'NO'::text
            ELSE 'YES'::text
        END AS test_drive_status,
    mst_nepali_month.rank AS nepali_month_rank,
    msil_dispatch_records.year,
    mf.name AS firm_name,
    m16.code AS color_code,
    c.is_edited,
    sales_booking_cancel.cancel_reason AS booking_cancel_reason,
    c.vehicle_make_year,
        CASE
            WHEN ((('now'::text)::date - c.inquiry_date_en) IS NULL) THEN 'Not Booked'::text
            WHEN ((('now'::text)::date - c.inquiry_date_en) <= 30) THEN 'Below 30 Days'::text
            WHEN ((('now'::text)::date - c.inquiry_date_en) <= 60) THEN 'Below 30-60 Days'::text
            WHEN ((('now'::text)::date - c.inquiry_date_en) <= 90) THEN 'Below 60-90 Days'::text
            ELSE 'Above 90 Days'::text
        END AS inquiry_ageing,
    sales_vehicle_process.booked_date_np AS sale_booked_date_np,
    sales_vehicle_process.booked_date_np_month AS sale_booked_date_np_month,
    sales_vehicle_process.booked_date_np_year AS sale_booked_date_year,
    log_stock_records.dispatched_date_np,
    sales_vehicle_process.vehicle_delivery_date_np
   FROM (((((((((((((((((((((((((((dms_customers c
     LEFT JOIN mst_fiscal_years m1 ON ((c.fiscal_year_id = m1.id)))
     LEFT JOIN mst_customer_types m2 ON ((c.customer_type_id = m2.id)))
     LEFT JOIN view_district_mvs m3 ON ((c.district_id = m3.id)))
     LEFT JOIN mst_district_mvs m4 ON ((c.mun_vdc_id = m4.id)))
     LEFT JOIN mst_occupations m5 ON ((c.occupation_id = m5.id)))
     LEFT JOIN mst_educations m6 ON ((c.education_id = m6.id)))
     LEFT JOIN dms_dealers m7 ON ((c.dealer_id = m7.id)))
     LEFT JOIN dms_employees m8 ON ((c.executive_id = m8.id)))
     LEFT JOIN mst_payment_modes m9 ON ((c.payment_mode_id = m9.id)))
     LEFT JOIN mst_sources m10 ON ((c.source_id = m10.id)))
     LEFT JOIN mst_relations m12 ON ((c.contact_1_relation_id = m12.id)))
     LEFT JOIN mst_relations m13 ON ((c.contact_2_relation_id = m13.id)))
     LEFT JOIN mst_vehicles m14 ON ((c.vehicle_id = m14.id)))
     LEFT JOIN mst_variants m15 ON ((c.variant_id = m15.id)))
     LEFT JOIN mst_colors m16 ON ((c.color_id = m16.id)))
     LEFT JOIN mst_walkin_sources m17 ON ((c.walkin_source_id = m17.id)))
     LEFT JOIN dms_events m18 ON ((c.event_id = m18.id)))
     LEFT JOIN mst_institutions m19 ON ((c.institution_id = m19.id)))
     LEFT JOIN mst_banks m20 ON ((c.bank_id = m20.id)))
     LEFT JOIN view_customer_test_drives_latest m21 ON ((c.id = m21.customer_id)))
     LEFT JOIN sales_vehicle_process ON ((sales_vehicle_process.customer_id = c.id)))
     LEFT JOIN view_dms_vehicles vdv ON ((((c.vehicle_id = vdv.vehicle_id) AND (c.variant_id = vdv.variant_id)) AND (vdv.color_id = c.color_id))))
     LEFT JOIN sales_booking_cancel ON ((c.id = sales_booking_cancel.customer_id)))
     LEFT JOIN msil_dispatch_records ON ((sales_vehicle_process.msil_dispatch_id = msil_dispatch_records.id)))
     LEFT JOIN log_stock_records ON ((msil_dispatch_records.id = log_stock_records.vehicle_id)))
     LEFT JOIN mst_nepali_month ON (((log_stock_records.dispatched_date_np_month)::integer = mst_nepali_month.id)))
     LEFT JOIN mst_firms mf ON ((mf.id = m14.firm_id)));


CREATE OR REPLACE VIEW "public"."view_customer_refined" AS 
 SELECT c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    c.inquiry_no,
    c.inquiry_kind,
    c.fiscal_year_id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.customer_type_id,
    c.first_name,
    c.middle_name,
    c.last_name,
    c.gender,
    c.marital_status,
    c.family_size,
    c.dob_en,
    c.dob_np,
    c.anniversary_en,
    c.anniversary_np,
    c.district_id,
    c.mun_vdc_id,
    c.address_1,
    c.address_2,
    c.email,
    c.home_1,
    c.home_2,
    c.work_1,
    c.work_2,
    c.mobile_1,
    c.mobile_2,
    c.pref_communication,
    c.occupation_id,
    c.education_id,
    c.dealer_id,
    c.executive_id,
    c.payment_mode_id,
    c.source_id,
    c.contact_1_name,
    c.contact_1_mobile,
    c.contact_1_relation_id,
    c.contact_2_name,
    c.contact_2_mobile,
    c.contact_2_relation_id,
    c.remarks,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    c.walkin_source_id,
    c.event_id,
    c.institution_id,
    c.exchange_car_make,
    c.exchange_car_model,
    c.exchange_car_year,
    c.exchange_car_kms,
    c.exchange_car_value,
    c.exchange_car_bonus,
    c.exchange_total_offer,
    c.bank_id,
    c.bank_branch,
    c.bank_staff,
    c.bank_contact,
    c.booking_canceled,
    c.discount_amount,
    c.is_edited,
    c.vehicle_make_year,
    (date_part('year'::text, (now())::date) - date_part('year'::text, c.dob_en)) AS age,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
        CASE
            WHEN (sales_vehicle_process.booked_date IS NOT NULL) THEN (sales_vehicle_process.booked_date - c.inquiry_date_en)
            ELSE (('now'::text)::date - c.inquiry_date_en)
        END AS inquiry_age,
        CASE
            WHEN (m11.status_id = 15) THEN (sales_vehicle_process.vehicle_delivery_date - sales_vehicle_process.booked_date)
            WHEN (m11.status_id = 18) THEN (m11.status_date - sales_vehicle_process.booked_date)
            ELSE (('now'::text)::date - sales_vehicle_process.booked_date)
        END AS booking_age,
    sales_vehicle_process.booked_date,
    m11.name AS actual_status_name,
    m11.rank AS actual_status_rank,
    (
        CASE
            WHEN (m11.status_id = 4) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 5) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 6) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 7) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 8) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 9) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 10) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 11) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 12) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 13) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 14) THEN 'Retail Finance'::character varying
            ELSE m11.name
        END)::text AS status_name,
    (
        CASE
            WHEN (m11.status_id = 4) THEN 99
            WHEN (m11.status_id = 5) THEN 99
            WHEN (m11.status_id = 6) THEN 99
            WHEN (m11.status_id = 7) THEN 99
            WHEN (m11.status_id = 8) THEN 99
            WHEN (m11.status_id = 9) THEN 99
            WHEN (m11.status_id = 10) THEN 99
            WHEN (m11.status_id = 11) THEN 99
            WHEN (m11.status_id = 12) THEN 99
            WHEN (m11.status_id = 13) THEN 99
            WHEN (m11.status_id = 14) THEN 99
            ELSE m11.rank
        END)::text AS status_rank,
    m11.sub_status_name,
    m11.status_date,
    m10.name AS source_name,
    sales_vehicle_process.booking_receipt_no,
    m7.name AS dealer_name,
        CASE
            WHEN ((m8.middle_name)::text <> ''::text) THEN (((((m8.first_name)::text || ' '::text) || (m8.middle_name)::text) || ' '::text) || (m8.last_name)::text)
            ELSE (((m8.first_name)::text || ' '::text) || (m8.last_name)::text)
        END AS executive_name,
    m14.name AS vehicle_name,
    m14.rank AS vehicle_rank,
    m15.name AS variant_name,
    ((((m16.name)::text || ' ('::text) || (m16.code)::text) || ')'::text) AS color_name,
    m2.name AS customer_type_name,
        CASE
            WHEN (m21.customer_id IS NULL) THEN 'NO'::text
            ELSE 'YES'::text
        END AS test_drive_status,
    m11.notes AS status_remarks,
    sales_booking_cancel.cancel_reason AS booking_cancel_reason,
    c.document,
    c.exchange_car_variant,
    c.is_nada,
    sales_vehicle_process.vehicle_delivery_date,
    c.image,
    c.sub_source_id,
    c.source_type_id,
    sales_booking_cancel.notes AS cancel_note,
    st.name AS source_type,
    source.source_type_name,
    mst_payment_modes.name AS payment_mode_name,
    c.exchange_bike_value
   FROM ((((((((((((((dms_customers c
     LEFT JOIN sales_vehicle_process ON ((c.id = sales_vehicle_process.customer_id)))
     LEFT JOIN view_customer_status_latest m11 ON ((c.id = m11.customer_id)))
     LEFT JOIN mst_sources m10 ON ((c.source_id = m10.id)))
     LEFT JOIN dms_dealers m7 ON ((c.dealer_id = m7.id)))
     LEFT JOIN dms_employees m8 ON ((c.executive_id = m8.id)))
     LEFT JOIN mst_vehicles m14 ON ((c.vehicle_id = m14.id)))
     LEFT JOIN mst_variants m15 ON ((c.variant_id = m15.id)))
     LEFT JOIN mst_colors m16 ON ((c.color_id = m16.id)))
     LEFT JOIN mst_customer_types m2 ON ((c.customer_type_id = m2.id)))
     LEFT JOIN view_customer_testdrive_refined m21 ON ((c.id = m21.customer_id)))
     LEFT JOIN view_sales_booking_cancel_refined sales_booking_cancel ON ((c.id = sales_booking_cancel.customer_id)))
     LEFT JOIN mst_source_type st ON ((c.source_type_id = st.id)))
     LEFT JOIN view_mst_sources source ON ((c.source_id = source.id)))
     LEFT JOIN mst_payment_modes ON ((c.payment_mode_id = mst_payment_modes.id)));


CREATE OR REPLACE VIEW "public"."view_customer_test_drive_conversion_ratio" AS 
 SELECT c.inquiry_date_en,
    c.inquiry_date_np,
    svp.booked_date,
        CASE
            WHEN (m11.status_id = 15) THEN (svp.vehicle_delivery_date - svp.booked_date)
            WHEN (m11.status_id = 18) THEN (m11.status_date - svp.booked_date)
            ELSE (('now'::text)::date - svp.booked_date)
        END AS booking_age,
        CASE
            WHEN ((('now'::text)::date - svp.booked_date) IS NULL) THEN 'Not Booked'::text
            WHEN ((('now'::text)::date - svp.booked_date) <= 30) THEN 'Below 30 Days'::text
            WHEN ((('now'::text)::date - svp.booked_date) <= 60) THEN 'Below 30-60 Days'::text
            WHEN ((('now'::text)::date - svp.booked_date) <= 90) THEN 'Below 60-90 Days'::text
            ELSE 'Above 90 Days'::text
        END AS booking_ageing,
    svp.vehicle_delivery_date,
    (
        CASE
            WHEN (m11.status_id = 4) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 5) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 6) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 7) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 8) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 9) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 10) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 11) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 12) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 13) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 14) THEN 'Retail Finance'::character varying
            ELSE m11.status_name
        END)::text AS status_name,
    m11.status_date,
    m11.sub_status_name,
        CASE
            WHEN ((m8.middle_name)::text <> ''::text) THEN (((((m8.first_name)::text || ' '::text) || (m8.middle_name)::text) || ' '::text) || (m8.last_name)::text)
            ELSE (((m8.first_name)::text || ' '::text) || (m8.last_name)::text)
        END AS executive_name,
    m7.name AS dealer_name,
    m14.name AS vehicle_name,
    m14.rank AS vehicle_rank,
    m15.name AS variant_name,
    m16.name AS color_name,
    m10.name AS source_name,
    m10.rank AS source_rank,
    c.inquiry_kind,
    (
        CASE
            WHEN (c.source_id = 1) THEN m17.name
            WHEN (c.source_id = 2) THEN m18.name
            ELSE 'Referral'::character varying
        END)::text AS inquiry_type,
    m9.name AS payment_mode_name,
    m2.name AS customer_type_name,
        CASE
            WHEN (c.bank_id IS NOT NULL) THEN m20.name
            ELSE 'Others'::character varying
        END AS bank_name,
    c.bank_id,
    c.bank_branch,
    c.bank_staff,
    c.bank_contact,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
    c.mobile_1,
    c.address_1,
        CASE
            WHEN (c.event_id IS NOT NULL) THEN m18.name
            ELSE 'N/A'::character varying
        END AS event_name,
        CASE
            WHEN (m21.id IS NULL) THEN 'NOT TAKEN'::text
            ELSE 'TAKEN'::text
        END AS test_drive,
    m11.status_id
   FROM ((((((((((((((dms_customers c
     LEFT JOIN sales_vehicle_process svp ON ((c.id = svp.customer_id)))
     LEFT JOIN view_customer_status_latest_niroj m11 ON ((c.id = m11.customer_id)))
     LEFT JOIN dms_employees m8 ON ((c.executive_id = m8.id)))
     LEFT JOIN dms_dealers m7 ON ((c.dealer_id = m7.id)))
     LEFT JOIN mst_colors m16 ON ((c.color_id = m16.id)))
     LEFT JOIN mst_variants m15 ON ((c.variant_id = m15.id)))
     LEFT JOIN mst_vehicles m14 ON ((c.vehicle_id = m14.id)))
     LEFT JOIN mst_sources m10 ON ((c.source_id = m10.id)))
     LEFT JOIN mst_walkin_sources m17 ON ((c.walkin_source_id = m17.id)))
     LEFT JOIN dms_events m18 ON ((c.event_id = m18.id)))
     LEFT JOIN mst_payment_modes m9 ON ((c.payment_mode_id = m9.id)))
     LEFT JOIN mst_customer_types m2 ON ((c.customer_type_id = m2.id)))
     LEFT JOIN mst_banks m20 ON ((c.bank_id = m20.id)))
     LEFT JOIN view_test_drive_latest_niroj m21 ON ((c.id = m21.customer_id)));


CREATE OR REPLACE VIEW "public"."view_customer_vehicle_change" AS 
 SELECT dms_customers.id,
    dms_customers.created_by,
    dms_customers.updated_by,
    dms_customers.deleted_by,
    dms_customers.created_at,
    dms_customers.updated_at,
    dms_customers.deleted_at,
    dms_customers.inquiry_no,
    dms_customers.inquiry_date_en,
    dms_customers.inquiry_date_np,
    dms_customers.first_name,
    dms_customers.middle_name,
    dms_customers.last_name,
    dms_customers.mobile_1,
    dms_customers.mobile_2,
    dms_customers.dealer_id,
    dms_customers.executive_id,
    dms_customers.source_id,
    dms_customers.status_id,
    dms_customers.vehicle_id,
    dms_customers.variant_id,
    dms_customers.color_id,
    dms_customers.source_type_id,
    view_vehicle_edited.prev_vehicle,
    view_vehicle_edited.prev_variant,
    view_vehicle_edited.prev_color,
    sales_vehicle_process.vehicle_delivery_date_np,
    mst_vehicles.name AS inquired_vehicle_name,
    sales_vehicle_process.vehicle_delivery_date,
    current_vehicle.name AS vehicle_name,
        CASE
            WHEN ((m8.middle_name)::text <> ''::text) THEN (((((m8.first_name)::text || ' '::text) || (m8.middle_name)::text) || ' '::text) || (m8.last_name)::text)
            ELSE (((m8.first_name)::text || ' '::text) || (m8.last_name)::text)
        END AS executive_name,
        CASE
            WHEN ((dms_customers.middle_name)::text <> ''::text) THEN (((((dms_customers.first_name)::text || ' '::text) || (dms_customers.middle_name)::text) || ' '::text) || (dms_customers.last_name)::text)
            ELSE (((dms_customers.first_name)::text || ' '::text) || (dms_customers.last_name)::text)
        END AS full_name,
    dms_dealers.name AS dealer_name,
    mst_sources.name AS source_name,
    view_mst_sources.source_type_name,
    view_customer_status_latest.name AS current_status_name,
        CASE
            WHEN ((mst_vehicles.name)::text <> ''::text) THEN mst_vehicles.name
            ELSE current_vehicle.name
        END AS inquired_vehicle
   FROM (((((((((dms_customers
     LEFT JOIN view_vehicle_edited ON ((dms_customers.id = view_vehicle_edited.customer_id)))
     JOIN sales_vehicle_process ON ((dms_customers.id = sales_vehicle_process.customer_id)))
     LEFT JOIN mst_vehicles ON ((view_vehicle_edited.prev_vehicle = mst_vehicles.id)))
     LEFT JOIN mst_vehicles current_vehicle ON ((dms_customers.vehicle_id = current_vehicle.id)))
     LEFT JOIN dms_dealers ON ((dms_customers.dealer_id = dms_dealers.id)))
     LEFT JOIN mst_sources ON ((dms_customers.source_id = mst_sources.id)))
     LEFT JOIN view_mst_sources ON ((dms_customers.source_id = view_mst_sources.id)))
     LEFT JOIN dms_employees m8 ON ((dms_customers.executive_id = m8.id)))
     LEFT JOIN view_customer_status_latest ON ((dms_customers.id = view_customer_status_latest.customer_id)));

-- ----------------------------
-- View structure for view_customers
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_customers" AS 
 SELECT c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    c.inquiry_no,
    c.fiscal_year_id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.inquiry_kind,
    c.customer_type_id,
    c.first_name,
    c.middle_name,
    c.last_name,
    c.gender,
    c.marital_status,
    c.family_size,
    (date_part('year'::text, (now())::date) - date_part('year'::text, c.dob_en)) AS age,
    c.dob_en,
    c.dob_np,
    c.anniversary_en,
    c.anniversary_np,
    c.district_id,
    c.mun_vdc_id,
    c.address_1,
    c.address_2,
    c.email,
    c.home_1,
    c.home_2,
    c.work_1,
    c.work_2,
    c.mobile_1,
    c.mobile_2,
    c.pref_communication,
    c.occupation_id,
    c.education_id,
    c.dealer_id,
    c.executive_id,
    c.payment_mode_id,
    c.source_id,
    m11.status_id,
    c.contact_1_name,
    c.contact_1_mobile,
    c.contact_1_relation_id,
    c.contact_2_name,
    c.contact_2_mobile,
    c.contact_2_relation_id,
    c.remarks,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    c.walkin_source_id,
    c.event_id,
    c.institution_id,
    c.exchange_car_make,
    c.exchange_car_model,
    c.exchange_car_year,
    c.exchange_car_kms,
    c.exchange_car_value,
    c.exchange_car_bonus,
    c.exchange_total_offer,
    c.bank_id,
    c.bank_branch,
    c.bank_staff,
    c.bank_contact,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
    ((substr((m1.nepali_start_date)::text, 0, 5) || '-'::text) || substr((m1.nepali_end_date)::text, 3, 2)) AS fiscal_year,
    m2.name AS customer_type_name,
    m2.rank AS customer_type_rank,
    replace((m3.parent_name)::text, ' Zone'::text, ''::text) AS zone_name,
    m3.name AS district_name,
    m4.name AS mun_vdc_name,
    m5.name AS occupation_name,
    m6.name AS education_name,
    m7.name AS dealer_name,
        CASE
            WHEN ((m8.middle_name)::text <> ''::text) THEN (((((m8.first_name)::text || ' '::text) || (m8.middle_name)::text) || ' '::text) || (m8.last_name)::text)
            ELSE (((m8.first_name)::text || ' '::text) || (m8.last_name)::text)
        END AS executive_name,
    m9.name AS payment_mode_name,
    m10.name AS source_name,
    m10.rank AS source_rank,
    m11.name AS actual_status_name,
    m11.rank AS actual_status_rank,
    (
        CASE
            WHEN (m11.status_id = 4) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 5) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 6) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 7) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 8) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 9) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 10) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 11) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 12) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 13) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 14) THEN 'Retail Finance'::character varying
            ELSE m11.name
        END)::text AS status_name,
    (
        CASE
            WHEN (m11.status_id = 4) THEN 99
            WHEN (m11.status_id = 5) THEN 99
            WHEN (m11.status_id = 6) THEN 99
            WHEN (m11.status_id = 7) THEN 99
            WHEN (m11.status_id = 8) THEN 99
            WHEN (m11.status_id = 9) THEN 99
            WHEN (m11.status_id = 10) THEN 99
            WHEN (m11.status_id = 11) THEN 99
            WHEN (m11.status_id = 12) THEN 99
            WHEN (m11.status_id = 13) THEN 99
            WHEN (m11.status_id = 14) THEN 99
            ELSE m11.rank
        END)::text AS status_rank,
    m11.status_date,
    m11.reason_name,
    m12.name AS contact_1_relation_name,
    m13.name AS contact_2_relation_name,
    m14.name AS vehicle_name,
    m14.rank AS vehicle_rank,
    m15.name AS variant_name,
    ((((m16.name)::text || ' ('::text) || (m16.code)::text) || ')'::text) AS color_name,
        CASE
            WHEN (c.walkin_source_id IS NOT NULL) THEN m17.name
            ELSE 'N/A'::character varying
        END AS walkin_source_name,
        CASE
            WHEN (c.event_id IS NOT NULL) THEN m18.name
            ELSE 'N/A'::character varying
        END AS event_name,
        CASE
            WHEN (c.institution_id IS NOT NULL) THEN m19.name
            ELSE 'N/A'::character varying
        END AS institution_name,
        CASE
            WHEN (c.bank_id IS NOT NULL) THEN m20.name
            ELSE 'Others'::character varying
        END AS bank_name,
        CASE
            WHEN (m21.id IS NULL) THEN 'NOT TAKEN'::text
            ELSE 'TAKEN'::text
        END AS test_drive,
    (
        CASE
            WHEN (c.source_id = 1) THEN m17.name
            WHEN (c.source_id = 2) THEN m18.name
            ELSE 'Referral'::character varying
        END)::text AS inquiry_type,
    c.booking_canceled,
    sales_vehicle_process.discount_amount,
    c.discount_amount AS customer_discount_amount,
    sales_vehicle_process.id AS vehicle_process_id,
    m3.parent_id,
    vdv.price,
    sales_booking_cancel.cancel_amount,
    sales_booking_cancel.notes,
    m11.sub_status_group,
    m11.sub_status_name,
    sales_vehicle_process.booking_receipt_no,
    sales_vehicle_process.vehicle_delivery_date,
    msil_dispatch_records.engine_no,
    msil_dispatch_records.chass_no,
    sales_vehicle_process.booked_date,
        CASE
            WHEN (m11.status_id = 15) THEN (sales_vehicle_process.vehicle_delivery_date - sales_vehicle_process.booked_date)
            WHEN (m11.status_id = 18) THEN (m11.status_date - sales_vehicle_process.booked_date)
            ELSE (('now'::text)::date - sales_vehicle_process.booked_date)
        END AS booking_age,
        CASE
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) IS NULL) THEN 'Not Booked'::text
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) <= 30) THEN 'Below 30 Days'::text
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) <= 60) THEN 'Below 30-60 Days'::text
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) <= 90) THEN 'Below 60-90 Days'::text
            ELSE 'Above 90 Days'::text
        END AS booking_ageing,
    m11.notes AS status_remarks,
        CASE
            WHEN (sales_vehicle_process.booked_date IS NOT NULL) THEN (sales_vehicle_process.booked_date - c.inquiry_date_en)
            ELSE (('now'::text)::date - c.inquiry_date_en)
        END AS inquiry_age,
    log_stock_records.dispatched_date_np_year AS retail_year,
    mst_nepali_month.name AS nepali_month,
        CASE
            WHEN (m21.id IS NULL) THEN 'NO'::text
            ELSE 'YES'::text
        END AS test_drive_status,
    mst_nepali_month.rank AS nepali_month_rank,
    msil_dispatch_records.year,
    mf.name AS firm_name,
    m16.code AS color_code,
    c.is_edited,
    sales_booking_cancel.cancel_reason AS booking_cancel_reason,
    c.vehicle_make_year,
    m11.status_date AS status_change_date,
        CASE
            WHEN ((('now'::text)::date - c.inquiry_date_en) IS NULL) THEN 'Not Booked'::text
            WHEN ((('now'::text)::date - c.inquiry_date_en) <= 30) THEN 'Below 30 Days'::text
            WHEN ((('now'::text)::date - c.inquiry_date_en) <= 60) THEN 'Below 30-60 Days'::text
            WHEN ((('now'::text)::date - c.inquiry_date_en) <= 90) THEN 'Below 60-90 Days'::text
            ELSE 'Above 90 Days'::text
        END AS inquiry_ageing,
    sales_vehicle_process.booked_date_np AS sale_booked_date_np,
    sales_vehicle_process.booked_date_np_month AS sale_booked_date_np_month,
    sales_vehicle_process.booked_date_np_year AS sale_booked_date_year,
    log_stock_records.dispatched_date_np,
    sales_vehicle_process.vehicle_delivery_date_np,
    c.exchange_car_variant,
    c.document,
    c.special_discount_amount,
    log_stock_records.dispatched_date_np_month AS retail_month,
    msil_dispatch_records.vehicle_register_no,
        CASE
            WHEN (c.online_source IS NOT NULL) THEN c.online_source
            ELSE 'N/A'::character varying
        END AS online_source_name,
    c.sub_source_id,
    mst_sub_source.name AS sub_source_name,
    c.source_type_id,
    mst_source_type.name AS main_source_name,
    sales_vehicle_process.booking_amount,
    m11.status_time,
    m11.tentative_retail_date
   FROM ((((((((((((((((((((((((((((((dms_customers c
     LEFT JOIN mst_fiscal_years m1 ON ((c.fiscal_year_id = m1.id)))
     LEFT JOIN mst_customer_types m2 ON ((c.customer_type_id = m2.id)))
     LEFT JOIN view_district_mvs m3 ON ((c.district_id = m3.id)))
     LEFT JOIN mst_district_mvs m4 ON ((c.mun_vdc_id = m4.id)))
     LEFT JOIN mst_occupations m5 ON ((c.occupation_id = m5.id)))
     LEFT JOIN mst_educations m6 ON ((c.education_id = m6.id)))
     LEFT JOIN dms_dealers m7 ON ((c.dealer_id = m7.id)))
     LEFT JOIN dms_employees m8 ON ((c.executive_id = m8.id)))
     LEFT JOIN mst_payment_modes m9 ON ((c.payment_mode_id = m9.id)))
     LEFT JOIN mst_sources m10 ON ((c.source_id = m10.id)))
     LEFT JOIN view_customer_status_latest m11 ON ((c.id = m11.customer_id)))
     LEFT JOIN mst_relations m12 ON ((c.contact_1_relation_id = m12.id)))
     LEFT JOIN mst_relations m13 ON ((c.contact_2_relation_id = m13.id)))
     LEFT JOIN mst_vehicles m14 ON ((c.vehicle_id = m14.id)))
     LEFT JOIN mst_variants m15 ON ((c.variant_id = m15.id)))
     LEFT JOIN mst_colors m16 ON ((c.color_id = m16.id)))
     LEFT JOIN mst_walkin_sources m17 ON ((c.walkin_source_id = m17.id)))
     LEFT JOIN dms_events m18 ON ((c.event_id = m18.id)))
     LEFT JOIN mst_institutions m19 ON ((c.institution_id = m19.id)))
     LEFT JOIN mst_banks m20 ON ((c.bank_id = m20.id)))
     LEFT JOIN view_customer_test_drives_latest m21 ON ((c.id = m21.customer_id)))
     LEFT JOIN sales_vehicle_process ON ((sales_vehicle_process.customer_id = c.id)))
     LEFT JOIN view_dms_vehicles vdv ON ((((c.vehicle_id = vdv.vehicle_id) AND (c.variant_id = vdv.variant_id)) AND (vdv.color_id = c.color_id))))
     LEFT JOIN sales_booking_cancel ON ((c.id = sales_booking_cancel.customer_id)))
     LEFT JOIN msil_dispatch_records ON ((sales_vehicle_process.msil_dispatch_id = msil_dispatch_records.id)))
     LEFT JOIN log_stock_records ON ((msil_dispatch_records.id = log_stock_records.vehicle_id)))
     LEFT JOIN mst_nepali_month ON (((log_stock_records.dispatched_date_np_month)::integer = mst_nepali_month.id)))
     LEFT JOIN mst_firms mf ON ((mf.id = m14.firm_id)))
     LEFT JOIN mst_sub_source ON ((c.sub_source_id = mst_sub_source.id)))
     LEFT JOIN mst_source_type ON ((c.source_type_id = mst_source_type.id)));


CREATE OR REPLACE VIEW "public"."view_customers_all_status" AS 
 SELECT ir.id,
    ir.created_by,
    ir.updated_by,
    ir.deleted_by,
    ir.created_at,
    ir.updated_at,
    ir.deleted_at,
    ir.inquiry_no,
    ir.fiscal_year_id,
    ir.inquiry_date_en,
    ir.inquiry_date_np,
    ir.inquiry_kind,
    ir.customer_type_id,
    ir.first_name,
    ir.middle_name,
    ir.last_name,
    ir.gender,
    ir.marital_status,
    ir.family_size,
    ir.age,
    ir.dob_en,
    ir.dob_np,
    ir.anniversary_en,
    ir.anniversary_np,
    ir.district_id,
    ir.mun_vdc_id,
    ir.address_1,
    ir.address_2,
    ir.email,
    ir.home_1,
    ir.home_2,
    ir.work_1,
    ir.work_2,
    ir.mobile_1,
    ir.mobile_2,
    ir.pref_communication,
    ir.occupation_id,
    ir.education_id,
    ir.dealer_id,
    ir.executive_id,
    ir.payment_mode_id,
    ir.source_id,
    ir.status_id,
    ir.contact_1_name,
    ir.contact_1_mobile,
    ir.contact_1_relation_id,
    ir.contact_2_name,
    ir.contact_2_mobile,
    ir.contact_2_relation_id,
    ir.remarks,
    ir.vehicle_id,
    ir.variant_id,
    ir.color_id,
    ir.walkin_source_id,
    ir.event_id,
    ir.institution_id,
    ir.exchange_car_make,
    ir.exchange_car_model,
    ir.exchange_car_year,
    ir.exchange_car_kms,
    ir.exchange_car_value,
    ir.exchange_car_bonus,
    ir.exchange_total_offer,
    ir.bank_id,
    ir.bank_branch,
    ir.bank_staff,
    ir.bank_contact,
    ir.full_name,
    ir.fiscal_year,
    ir.customer_type_name,
    ir.customer_type_rank,
    ir.zone_name,
    ir.district_name,
    ir.mun_vdc_name,
    ir.occupation_name,
    ir.education_name,
    ir.dealer_name,
    ir.executive_name,
    ir.payment_mode_name,
    ir.source_name,
    ir.source_rank,
    ir.actual_status_name,
    ir.actual_status_rank,
    ir.status_name,
    ir.status_rank,
    ir.status_date,
    ir.reason_name,
    ir.contact_1_relation_name,
    ir.contact_2_relation_name,
    ir.vehicle_name,
    ir.vehicle_rank,
    ir.variant_name,
    ir.color_name,
    ir.walkin_source_name,
    ir.event_name,
    ir.institution_name,
    ir.bank_name,
    ir.test_drive,
    ir.inquiry_type,
    csd.customer_id,
    csd.status_1,
    csd.status_2,
    csd.status_3,
    csd.status_4,
    csd.status_5,
    csd.status_6,
    csd.status_7,
    csd.status_8,
    csd.status_9,
    csd.status_10,
    csd.status_11,
    csd.status_12,
    csd.status_13,
    csd.status_14,
    csd.status_15,
    csd.status_16,
    csd.status_17,
    csd.status_18
   FROM (view_customers ir
     JOIN view_customer_status_dates csd ON ((ir.id = csd.customer_id)));

-- ----------------------------
-- View structure for view_customers_backup_december
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_customers_backup_december" AS 
 SELECT c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    c.inquiry_no,
    c.fiscal_year_id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.inquiry_kind,
    c.customer_type_id,
    c.first_name,
    c.middle_name,
    c.last_name,
    c.gender,
    c.marital_status,
    c.family_size,
    (date_part('year'::text, (now())::date) - date_part('year'::text, c.dob_en)) AS age,
    c.dob_en,
    c.dob_np,
    c.anniversary_en,
    c.anniversary_np,
    c.district_id,
    c.mun_vdc_id,
    c.address_1,
    c.address_2,
    c.email,
    c.home_1,
    c.home_2,
    c.work_1,
    c.work_2,
    c.mobile_1,
    c.mobile_2,
    c.pref_communication,
    c.occupation_id,
    c.education_id,
    c.dealer_id,
    c.executive_id,
    c.payment_mode_id,
    c.source_id,
    m11.status_id,
    c.contact_1_name,
    c.contact_1_mobile,
    c.contact_1_relation_id,
    c.contact_2_name,
    c.contact_2_mobile,
    c.contact_2_relation_id,
    c.remarks,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    c.walkin_source_id,
    c.event_id,
    c.institution_id,
    c.exchange_car_make,
    c.exchange_car_model,
    c.exchange_car_year,
    c.exchange_car_kms,
    c.exchange_car_value,
    c.exchange_car_bonus,
    c.exchange_total_offer,
    c.bank_id,
    c.bank_branch,
    c.bank_staff,
    c.bank_contact,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
    ((substr((m1.nepali_start_date)::text, 0, 5) || '-'::text) || substr((m1.nepali_end_date)::text, 3, 2)) AS fiscal_year,
    m2.name AS customer_type_name,
    m2.rank AS customer_type_rank,
    replace((m3.parent_name)::text, ' Zone'::text, ''::text) AS zone_name,
    m3.name AS district_name,
    m4.name AS mun_vdc_name,
    m5.name AS occupation_name,
    m6.name AS education_name,
    m7.name AS dealer_name,
        CASE
            WHEN ((m8.middle_name)::text <> ''::text) THEN (((((m8.first_name)::text || ' '::text) || (m8.middle_name)::text) || ' '::text) || (m8.last_name)::text)
            ELSE (((m8.first_name)::text || ' '::text) || (m8.last_name)::text)
        END AS executive_name,
    m9.name AS payment_mode_name,
    m10.name AS source_name,
    m10.rank AS source_rank,
    m11.name AS actual_status_name,
    m11.rank AS actual_status_rank,
    (
        CASE
            WHEN (m11.status_id = 4) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 5) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 6) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 7) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 8) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 9) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 10) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 11) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 12) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 13) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 14) THEN 'Retail Finance'::character varying
            ELSE m11.name
        END)::text AS status_name,
    (
        CASE
            WHEN (m11.status_id = 4) THEN 99
            WHEN (m11.status_id = 5) THEN 99
            WHEN (m11.status_id = 6) THEN 99
            WHEN (m11.status_id = 7) THEN 99
            WHEN (m11.status_id = 8) THEN 99
            WHEN (m11.status_id = 9) THEN 99
            WHEN (m11.status_id = 10) THEN 99
            WHEN (m11.status_id = 11) THEN 99
            WHEN (m11.status_id = 12) THEN 99
            WHEN (m11.status_id = 13) THEN 99
            WHEN (m11.status_id = 14) THEN 99
            ELSE m11.rank
        END)::text AS status_rank,
    m11.status_date,
    m11.reason_name,
    m12.name AS contact_1_relation_name,
    m13.name AS contact_2_relation_name,
    m14.name AS vehicle_name,
    m14.rank AS vehicle_rank,
    m15.name AS variant_name,
    ((((m16.name)::text || ' ('::text) || (m16.code)::text) || ')'::text) AS color_name,
        CASE
            WHEN (c.walkin_source_id IS NOT NULL) THEN m17.name
            ELSE 'N/A'::character varying
        END AS walkin_source_name,
        CASE
            WHEN (c.event_id IS NOT NULL) THEN m18.name
            ELSE 'N/A'::character varying
        END AS event_name,
        CASE
            WHEN (c.institution_id IS NOT NULL) THEN m19.name
            ELSE 'N/A'::character varying
        END AS institution_name,
        CASE
            WHEN (c.bank_id IS NOT NULL) THEN m20.name
            ELSE 'Others'::character varying
        END AS bank_name,
        CASE
            WHEN (m21.id IS NULL) THEN 'NOT TAKEN'::text
            ELSE 'TAKEN'::text
        END AS test_drive,
    (
        CASE
            WHEN (c.source_id = 1) THEN m17.name
            WHEN (c.source_id = 2) THEN m18.name
            ELSE 'Referral'::character varying
        END)::text AS inquiry_type,
    c.booking_canceled,
    sales_vehicle_process.discount_amount,
    c.discount_amount AS customer_discount_amount,
    sales_vehicle_process.id AS vehicle_process_id,
    m3.parent_id,
    vdv.price,
    sales_booking_cancel.cancel_amount,
    sales_booking_cancel.notes,
    m11.sub_status_group,
    m11.sub_status_name,
    sales_vehicle_process.booking_receipt_no,
    sales_vehicle_process.vehicle_delivery_date,
    msil_dispatch_records.engine_no,
    msil_dispatch_records.chass_no,
    sales_vehicle_process.booked_date,
        CASE
            WHEN (m11.status_id = 15) THEN (sales_vehicle_process.vehicle_delivery_date - sales_vehicle_process.booked_date)
            WHEN (m11.status_id = 18) THEN (m11.status_date - sales_vehicle_process.booked_date)
            ELSE (('now'::text)::date - sales_vehicle_process.booked_date)
        END AS booking_age,
        CASE
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) IS NULL) THEN 'Not Booked'::text
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) <= 30) THEN 'Below 30 Days'::text
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) <= 60) THEN 'Below 30-60 Days'::text
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) <= 90) THEN 'Below 60-90 Days'::text
            ELSE 'Above 90 Days'::text
        END AS booking_ageing,
    m11.notes AS status_remarks,
        CASE
            WHEN (sales_vehicle_process.booked_date IS NOT NULL) THEN (sales_vehicle_process.booked_date - c.inquiry_date_en)
            ELSE (('now'::text)::date - c.inquiry_date_en)
        END AS inquiry_age,
    log_stock_records.dispatched_date_np_year AS retail_year,
    mst_nepali_month.name AS nepali_month,
        CASE
            WHEN (m21.id IS NULL) THEN 'NO'::text
            ELSE 'YES'::text
        END AS test_drive_status,
    mst_nepali_month.rank AS nepali_month_rank,
    msil_dispatch_records.year,
    mf.name AS firm_name,
    m16.code AS color_code,
    c.is_edited,
    sales_booking_cancel.cancel_reason AS booking_cancel_reason,
    c.vehicle_make_year,
    m11.status_date AS status_change_date,
        CASE
            WHEN ((('now'::text)::date - c.inquiry_date_en) IS NULL) THEN 'Not Booked'::text
            WHEN ((('now'::text)::date - c.inquiry_date_en) <= 30) THEN 'Below 30 Days'::text
            WHEN ((('now'::text)::date - c.inquiry_date_en) <= 60) THEN 'Below 30-60 Days'::text
            WHEN ((('now'::text)::date - c.inquiry_date_en) <= 90) THEN 'Below 60-90 Days'::text
            ELSE 'Above 90 Days'::text
        END AS inquiry_ageing,
    sales_vehicle_process.booked_date_np AS sale_booked_date_np,
    sales_vehicle_process.booked_date_np_month AS sale_booked_date_np_month,
    sales_vehicle_process.booked_date_np_year AS sale_booked_date_year,
    log_stock_records.dispatched_date_np,
    sales_vehicle_process.vehicle_delivery_date_np,
    c.exchange_car_variant,
    c.document,
    c.special_discount_amount,
    log_stock_records.dispatched_date_np_month AS retail_month
   FROM ((((((((((((((((((((((((((((dms_customers c
     LEFT JOIN mst_fiscal_years m1 ON ((c.fiscal_year_id = m1.id)))
     LEFT JOIN mst_customer_types m2 ON ((c.customer_type_id = m2.id)))
     LEFT JOIN view_district_mvs m3 ON ((c.district_id = m3.id)))
     LEFT JOIN mst_district_mvs m4 ON ((c.mun_vdc_id = m4.id)))
     LEFT JOIN mst_occupations m5 ON ((c.occupation_id = m5.id)))
     LEFT JOIN mst_educations m6 ON ((c.education_id = m6.id)))
     LEFT JOIN dms_dealers m7 ON ((c.dealer_id = m7.id)))
     LEFT JOIN dms_employees m8 ON ((c.executive_id = m8.id)))
     LEFT JOIN mst_payment_modes m9 ON ((c.payment_mode_id = m9.id)))
     LEFT JOIN mst_sources m10 ON ((c.source_id = m10.id)))
     LEFT JOIN view_customer_status_latest m11 ON ((c.id = m11.customer_id)))
     LEFT JOIN mst_relations m12 ON ((c.contact_1_relation_id = m12.id)))
     LEFT JOIN mst_relations m13 ON ((c.contact_2_relation_id = m13.id)))
     LEFT JOIN mst_vehicles m14 ON ((c.vehicle_id = m14.id)))
     LEFT JOIN mst_variants m15 ON ((c.variant_id = m15.id)))
     LEFT JOIN mst_colors m16 ON ((c.color_id = m16.id)))
     LEFT JOIN mst_walkin_sources m17 ON ((c.walkin_source_id = m17.id)))
     LEFT JOIN dms_events m18 ON ((c.event_id = m18.id)))
     LEFT JOIN mst_institutions m19 ON ((c.institution_id = m19.id)))
     LEFT JOIN mst_banks m20 ON ((c.bank_id = m20.id)))
     LEFT JOIN view_customer_test_drives_latest m21 ON ((c.id = m21.customer_id)))
     LEFT JOIN sales_vehicle_process ON ((sales_vehicle_process.customer_id = c.id)))
     LEFT JOIN view_dms_vehicles vdv ON ((((c.vehicle_id = vdv.vehicle_id) AND (c.variant_id = vdv.variant_id)) AND (vdv.color_id = c.color_id))))
     LEFT JOIN sales_booking_cancel ON ((c.id = sales_booking_cancel.customer_id)))
     LEFT JOIN msil_dispatch_records ON ((sales_vehicle_process.msil_dispatch_id = msil_dispatch_records.id)))
     LEFT JOIN log_stock_records ON ((msil_dispatch_records.id = log_stock_records.vehicle_id)))
     LEFT JOIN mst_nepali_month ON (((log_stock_records.dispatched_date_np_month)::integer = mst_nepali_month.id)))
     LEFT JOIN mst_firms mf ON ((mf.id = m14.firm_id)));

-- ----------------------------
-- View structure for view_customers_new
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_customers_new" AS 
 SELECT c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    c.inquiry_no,
    c.fiscal_year_id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.inquiry_kind,
    c.customer_type_id,
    c.first_name,
    c.middle_name,
    c.last_name,
    c.gender,
    c.marital_status,
    c.family_size,
    (date_part('year'::text, (now())::date) - date_part('year'::text, c.dob_en)) AS age,
    c.dob_en,
    c.dob_np,
    c.anniversary_en,
    c.anniversary_np,
    c.district_id,
    c.mun_vdc_id,
    c.address_1,
    c.address_2,
    c.email,
    c.home_1,
    c.home_2,
    c.work_1,
    c.work_2,
    c.mobile_1,
    c.mobile_2,
    c.pref_communication,
    c.occupation_id,
    c.education_id,
    c.dealer_id,
    c.executive_id,
    c.payment_mode_id,
    c.source_id,
    m11.status_id,
    c.contact_1_name,
    c.contact_1_mobile,
    c.contact_1_relation_id,
    c.contact_2_name,
    c.contact_2_mobile,
    c.contact_2_relation_id,
    c.remarks,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    c.walkin_source_id,
    c.event_id,
    c.institution_id,
    c.exchange_car_make,
    c.exchange_car_model,
    c.exchange_car_year,
    c.exchange_car_kms,
    c.exchange_car_value,
    c.exchange_car_bonus,
    c.exchange_total_offer,
    c.bank_id,
    c.bank_branch,
    c.bank_staff,
    c.bank_contact,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
    ((substr((m1.nepali_start_date)::text, 0, 5) || '-'::text) || substr((m1.nepali_end_date)::text, 3, 2)) AS fiscal_year,
    m2.name AS customer_type_name,
    m2.rank AS customer_type_rank,
    replace((m3.parent_name)::text, ' Zone'::text, ''::text) AS zone_name,
    m3.name AS district_name,
    m4.name AS mun_vdc_name,
    m5.name AS occupation_name,
    m6.name AS education_name,
    m7.name AS dealer_name,
        CASE
            WHEN ((m8.middle_name)::text <> ''::text) THEN (((((m8.first_name)::text || ' '::text) || (m8.middle_name)::text) || ' '::text) || (m8.last_name)::text)
            ELSE (((m8.first_name)::text || ' '::text) || (m8.last_name)::text)
        END AS executive_name,
    m9.name AS payment_mode_name,
    m10.name AS source_name,
    m10.rank AS source_rank,
    m11.name AS actual_status_name,
    m11.rank AS actual_status_rank,
    (
        CASE
            WHEN (m11.status_id = 4) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 5) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 6) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 7) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 8) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 9) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 10) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 11) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 12) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 13) THEN 'Retail Finance'::character varying
            WHEN (m11.status_id = 14) THEN 'Retail Finance'::character varying
            ELSE m11.name
        END)::text AS status_name,
    (
        CASE
            WHEN (m11.status_id = 4) THEN 99
            WHEN (m11.status_id = 5) THEN 99
            WHEN (m11.status_id = 6) THEN 99
            WHEN (m11.status_id = 7) THEN 99
            WHEN (m11.status_id = 8) THEN 99
            WHEN (m11.status_id = 9) THEN 99
            WHEN (m11.status_id = 10) THEN 99
            WHEN (m11.status_id = 11) THEN 99
            WHEN (m11.status_id = 12) THEN 99
            WHEN (m11.status_id = 13) THEN 99
            WHEN (m11.status_id = 14) THEN 99
            ELSE m11.rank
        END)::text AS status_rank,
    m11.status_date,
    m11.reason_name,
    m12.name AS contact_1_relation_name,
    m13.name AS contact_2_relation_name,
    m14.name AS vehicle_name,
    m14.rank AS vehicle_rank,
    m15.name AS variant_name,
    ((((m16.name)::text || ' ('::text) || (m16.code)::text) || ')'::text) AS color_name,
        CASE
            WHEN (c.walkin_source_id IS NOT NULL) THEN m17.name
            ELSE 'N/A'::character varying
        END AS walkin_source_name,
        CASE
            WHEN (c.event_id IS NOT NULL) THEN m18.name
            ELSE 'N/A'::character varying
        END AS event_name,
        CASE
            WHEN (c.institution_id IS NOT NULL) THEN m19.name
            ELSE 'N/A'::character varying
        END AS institution_name,
        CASE
            WHEN (c.bank_id IS NOT NULL) THEN m20.name
            ELSE 'Others'::character varying
        END AS bank_name,
        CASE
            WHEN (m21.id IS NULL) THEN 'NOT TAKEN'::text
            ELSE 'TAKEN'::text
        END AS test_drive,
    (
        CASE
            WHEN (c.source_id = 1) THEN m17.name
            WHEN (c.source_id = 2) THEN m18.name
            ELSE 'Referral'::character varying
        END)::text AS inquiry_type,
    c.booking_canceled,
    sales_vehicle_process.discount_amount,
    c.discount_amount AS customer_discount_amount,
    sales_vehicle_process.id AS vehicle_process_id,
    m3.parent_id,
    vdv.price,
    sales_booking_cancel.cancel_amount,
    sales_booking_cancel.notes,
    m11.sub_status_group,
    m11.sub_status_name,
    sales_vehicle_process.booking_receipt_no,
    sales_vehicle_process.vehicle_delivery_date,
    msil_dispatch_records.engine_no,
    msil_dispatch_records.chass_no,
    sales_vehicle_process.booked_date,
        CASE
            WHEN (m11.status_id = 15) THEN (sales_vehicle_process.vehicle_delivery_date - sales_vehicle_process.booked_date)
            WHEN (m11.status_id = 18) THEN (m11.status_date - sales_vehicle_process.booked_date)
            ELSE (('now'::text)::date - sales_vehicle_process.booked_date)
        END AS booking_age,
        CASE
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) IS NULL) THEN 'Not Booked'::text
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) <= 30) THEN 'Below 30 Days'::text
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) <= 60) THEN 'Below 30-60 Days'::text
            WHEN ((('now'::text)::date - sales_vehicle_process.booked_date) <= 90) THEN 'Below 60-90 Days'::text
            ELSE 'Above 90 Days'::text
        END AS booking_ageing,
    m11.notes AS status_remarks,
        CASE
            WHEN (sales_vehicle_process.booked_date IS NOT NULL) THEN (sales_vehicle_process.booked_date - c.inquiry_date_en)
            ELSE (('now'::text)::date - c.inquiry_date_en)
        END AS inquiry_age,
    log_stock_records.dispatched_date_np_year AS retail_year,
    mst_nepali_month.name AS nepali_month,
        CASE
            WHEN (m21.id IS NULL) THEN 'NO'::text
            ELSE 'YES'::text
        END AS test_drive_status,
    mst_nepali_month.rank AS nepali_month_rank,
    msil_dispatch_records.year,
    mf.name AS firm_name,
    m16.code AS color_code,
    c.is_edited,
    sales_booking_cancel.cancel_reason AS booking_cancel_reason,
    c.vehicle_make_year,
    m11.status_date AS status_change_date,
        CASE
            WHEN ((('now'::text)::date - c.inquiry_date_en) IS NULL) THEN 'Not Booked'::text
            WHEN ((('now'::text)::date - c.inquiry_date_en) <= 30) THEN 'Below 30 Days'::text
            WHEN ((('now'::text)::date - c.inquiry_date_en) <= 60) THEN 'Below 30-60 Days'::text
            WHEN ((('now'::text)::date - c.inquiry_date_en) <= 90) THEN 'Below 60-90 Days'::text
            ELSE 'Above 90 Days'::text
        END AS inquiry_ageing,
    sales_vehicle_process.booked_date_np AS sale_booked_date_np,
    sales_vehicle_process.booked_date_np_month AS sale_booked_date_np_month,
    sales_vehicle_process.booked_date_np_year AS sale_booked_date_year,
    log_stock_records.dispatched_date_np,
    sales_vehicle_process.vehicle_delivery_date_np,
    c.exchange_car_variant,
    c.document,
    c.special_discount_amount,
    log_stock_records.dispatched_date_np_month AS retail_month,
    msil_dispatch_records.vehicle_register_no,
        CASE
            WHEN (c.online_source IS NOT NULL) THEN c.online_source
            ELSE 'N/A'::character varying
        END AS online_source_name,
    c.sub_source_id,
    mst_sub_source.name AS sub_source_name,
    c.source_type_id,
        CASE
            WHEN ((c.source_type_id IS NULL) AND (c.source_id = 2)) THEN ('Generated Enquiry'::text)::character varying
            WHEN ((c.source_type_id IS NULL) AND (c.source_id = 1)) THEN ('Natural Enquiry'::text)::character varying
            WHEN ((c.source_type_id IS NULL) AND (c.source_id = 3)) THEN ('Natural Enquiry'::text)::character varying
            WHEN ((c.source_type_id IS NULL) AND (c.source_id = 4)) THEN ('Natural Enquiry'::text)::character varying
            ELSE mst_source_type.name
        END AS main_source_name
   FROM ((((((((((((((((((((((((((((((dms_customers c
     LEFT JOIN mst_fiscal_years m1 ON ((c.fiscal_year_id = m1.id)))
     LEFT JOIN mst_customer_types m2 ON ((c.customer_type_id = m2.id)))
     LEFT JOIN view_district_mvs m3 ON ((c.district_id = m3.id)))
     LEFT JOIN mst_district_mvs m4 ON ((c.mun_vdc_id = m4.id)))
     LEFT JOIN mst_occupations m5 ON ((c.occupation_id = m5.id)))
     LEFT JOIN mst_educations m6 ON ((c.education_id = m6.id)))
     LEFT JOIN dms_dealers m7 ON ((c.dealer_id = m7.id)))
     LEFT JOIN dms_employees m8 ON ((c.executive_id = m8.id)))
     LEFT JOIN mst_payment_modes m9 ON ((c.payment_mode_id = m9.id)))
     LEFT JOIN mst_sources m10 ON ((c.source_id = m10.id)))
     LEFT JOIN view_customer_status_latest m11 ON ((c.id = m11.customer_id)))
     LEFT JOIN mst_relations m12 ON ((c.contact_1_relation_id = m12.id)))
     LEFT JOIN mst_relations m13 ON ((c.contact_2_relation_id = m13.id)))
     LEFT JOIN mst_vehicles m14 ON ((c.vehicle_id = m14.id)))
     LEFT JOIN mst_variants m15 ON ((c.variant_id = m15.id)))
     LEFT JOIN mst_colors m16 ON ((c.color_id = m16.id)))
     LEFT JOIN mst_walkin_sources m17 ON ((c.walkin_source_id = m17.id)))
     LEFT JOIN dms_events m18 ON ((c.event_id = m18.id)))
     LEFT JOIN mst_institutions m19 ON ((c.institution_id = m19.id)))
     LEFT JOIN mst_banks m20 ON ((c.bank_id = m20.id)))
     LEFT JOIN view_customer_test_drives_latest m21 ON ((c.id = m21.customer_id)))
     LEFT JOIN sales_vehicle_process ON ((sales_vehicle_process.customer_id = c.id)))
     LEFT JOIN view_dms_vehicles vdv ON ((((c.vehicle_id = vdv.vehicle_id) AND (c.variant_id = vdv.variant_id)) AND (vdv.color_id = c.color_id))))
     LEFT JOIN sales_booking_cancel ON ((c.id = sales_booking_cancel.customer_id)))
     LEFT JOIN msil_dispatch_records ON ((sales_vehicle_process.msil_dispatch_id = msil_dispatch_records.id)))
     LEFT JOIN log_stock_records ON ((msil_dispatch_records.id = log_stock_records.vehicle_id)))
     LEFT JOIN mst_nepali_month ON (((log_stock_records.dispatched_date_np_month)::integer = mst_nepali_month.id)))
     LEFT JOIN mst_firms mf ON ((mf.id = m14.firm_id)))
     LEFT JOIN mst_sub_source ON ((c.sub_source_id = mst_sub_source.id)))
     LEFT JOIN mst_source_type ON ((c.source_type_id = mst_source_type.id)));


CREATE OR REPLACE VIEW "public"."view_dashboard_actual_retail" AS 
 SELECT b.name AS month_name,
    a.retail_fiscal_year,
    a.dispatched_date_np_month,
    a.vehicle_name,
    a.vehicle_rank,
    a.service_policy_id,
    b.rank AS month_rank,
    sum(a.total_retail) AS total_retail
   FROM (view_dashboard_retail_actual a
     JOIN mst_nepali_month b ON ((a.dispatched_date_np_month = b.id)))
  GROUP BY b.name, a.retail_fiscal_year, a.dispatched_date_np_month, a.vehicle_name, a.vehicle_rank, a.service_policy_id, b.rank
  ORDER BY b.rank;


CREATE OR REPLACE VIEW "public"."view_dashboard_customer" AS 
 SELECT so.name AS source_name,
    c.dealer_id,
    c.executive_id,
    dd.name AS dealer_name,
    dd.incharge_id,
    c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    c.inquiry_no,
    c.inquiry_kind,
    c.fiscal_year_id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.customer_type_id,
    c.education_id,
    c.source_id,
    c.remarks,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    c.walkin_source_id,
    c.booking_canceled,
    c.discount_amount,
    c.rank,
    c.is_edited,
        CASE
            WHEN (m21.id IS NULL) THEN 'NOT TAKEN'::text
            ELSE 'TAKEN'::text
        END AS test_drive,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name,
    mst_customer_types.name AS customer_type_name,
    view_dashboard_latest_customer_status.status_id
   FROM ((((((((dms_customers c
     JOIN mst_sources so ON ((c.source_id = so.id)))
     JOIN dms_dealers dd ON ((c.dealer_id = dd.id)))
     LEFT JOIN view_customer_test_drives_latest m21 ON ((c.id = m21.customer_id)))
     JOIN mst_vehicles ON ((c.vehicle_id = mst_vehicles.id)))
     JOIN mst_variants ON ((c.variant_id = mst_variants.id)))
     JOIN mst_colors ON ((c.color_id = mst_colors.id)))
     LEFT JOIN mst_customer_types ON ((c.customer_type_id = mst_customer_types.id)))
     JOIN view_dashboard_latest_customer_status ON ((c.id = view_dashboard_latest_customer_status.customer_id)));


CREATE OR REPLACE VIEW "public"."view_dashboard_inquiry_kind_count" AS 
 SELECT c.id,
    c.inquiry_no,
    c.inquiry_kind,
    c.fiscal_year_id,
    dd.status_id,
    c.dealer_id,
    c.executive_id,
    c.inquiry_date_en,
    c.inquiry_date_np
   FROM (dms_customers c
     JOIN view_dashboard_latest_customer_status dd ON ((c.id = dd.customer_id)));


CREATE OR REPLACE VIEW "public"."view_dashboard_inquiry_trend" AS 
 SELECT s.name AS source_name,
    substr((c.inquiry_date_np)::text, 1, 7) AS inquiry_month,
    count(s.name) AS total_inquiry,
    sum(
        CASE
            WHEN (d.status_id = 15) THEN 1
            ELSE 0
        END) AS converted,
    c.fiscal_year_id,
    c.deleted_at
   FROM ((dms_customers c
     JOIN mst_sources s ON ((c.source_id = s.id)))
     JOIN view_dashboard_latest_customer_status d ON ((c.id = d.customer_id)))
  GROUP BY s.name, substr((c.inquiry_date_np)::text, 1, 7), c.fiscal_year_id, c.deleted_at
  ORDER BY substr((c.inquiry_date_np)::text, 1, 7);


CREATE OR REPLACE VIEW "public"."view_dealer_dispatch_request" AS 
 SELECT ldo.id,
    ldo.date_of_order,
    ldo.created_by,
    ldo.updated_by,
    ldo.created_at,
    ldo.updated_at,
    ldo.payment_status,
    ldo.vehicle_id,
    ldo.variant_id,
    ldo.color_id,
    ldo.challan_return_image,
    ldo.vehicle_main_id,
    ldo.payment_method,
    ldo.associated_value_payment,
    ldo.quantity,
    ldo.order_id,
    ldo.dealer_id,
    de.name AS dealer_name,
    de.incharge_id,
    ldo.year,
    ldo.cancel_quantity,
    ldo.cancel_date,
    ldo.cancel_date_np,
    ldo.credit_control_approval,
    ldo.credit_approve_date,
    ldo.credit_approve_date_np,
    ldo.remarks,
    ldo.grn_received_date,
    ldo.grn_received_date_np,
    ldo.order_month_id,
    ldo.received_date,
    ve.name AS vehicle_name,
    va.name AS variant_name,
    co.name AS color_name,
    co.code AS color_code,
    mdr.engine_no,
    mdr.chass_no,
    ldd.dispatched_date AS dealer_dispatch_date,
    ldd.dispatched_date_np AS dealer_dispatch_date_np,
    ldd.received_date AS dealer_received_date,
    ldd.received_date_nep AS dealer_received_date_np,
    lsr.dispatched_date AS customer_retail_date,
    lsr.dispatched_date_nep AS customer_retail_date_np,
    lsr.id AS stock_id,
    ldd.id AS dispatch_id,
    (('now'::text)::date - lsr.reached_date) AS vehicle_ageing,
    (('now'::text)::date - ldo.date_of_order) AS order_ageing,
    (ldo.credit_approve_date - ldo.date_of_order) AS credit_control_ageing,
    (ldd.dispatched_date - ldo.credit_approve_date) AS logistic_ageing,
    (('now'::text)::date - ldd.dispatched_date) AS dispatch_ageing,
    mst_nepali_month.name AS nepali_month,
    concat(ldo.payment_method, '-', ldo.associated_value_payment) AS payment_value,
    ldd.driver_name,
    ldd.driver_address,
    ldd.driver_contact,
    ldd.driver_liscense_no,
    ldd.image_name AS driver_image,
    de.address_1 AS dealer_address,
    de.phone_1 AS dealer_phone,
    ldo.payment_edit,
    ldo.payment_edit_date,
        CASE
            WHEN ((ldd.dispatched_date IS NOT NULL) AND (ldo.credit_control_approval <> 4)) THEN 'Dispatched'::text
            WHEN (ldo.credit_control_approval = 1) THEN 'Accepted'::text
            WHEN (ldo.credit_control_approval = 2) THEN 'Rejected'::text
            WHEN (ldo.credit_control_approval = 3) THEN 'On Hold'::text
            WHEN (ldo.credit_control_approval = 0) THEN 'Pending'::text
            WHEN (ldo.credit_control_approval = 4) THEN 'Display'::text
            ELSE NULL::text
        END AS order_status,
    mst_stock_yards.name AS stockyard_name,
    lsr.stock_yard_id,
    ldo.deleted_at,
    ldo.deleted_by,
    mdr.company_name AS firm_name,
    ve.firm_id,
    log_damage.id AS damage_id,
    (('now'::text)::date - ldo.credit_approve_date) AS daily_dispatch_ageing,
        CASE
            WHEN (lsr.dispatched_date IS NOT NULL) THEN 'Retail'::text
            WHEN (ldd.received_date IS NOT NULL) THEN 'Received'::text
            ELSE 'Pending'::text
        END AS dealer_stock_status,
    mnm.name AS retail_nepali_month,
    mn.name AS bill_nepali_month,
    ldo.in_stock_remarks,
        CASE
            WHEN (ldo.in_stock_remarks = 1) THEN 'In Stock'::text
            WHEN (ldo.in_stock_remarks = 0) THEN 'No Stock'::text
            WHEN (ldo.in_stock_remarks = 2) THEN 'In Transit'::text
            WHEN (ldo.in_stock_remarks = 3) THEN 'Outside Ktm'::text
            ELSE NULL::text
        END AS stock_status,
    ldo.delivery_date,
    (ldo.delivery_date - ('now'::text)::date) AS delivery_date_days,
    ldo.stock_in_ktm,
    ldo.stock_arrived_date,
    ldo.stock_arrived_date_np,
        CASE
            WHEN (ldo.stock_in_ktm = 1) THEN 'Stock in KTM'::text
            WHEN (ldo.stock_in_ktm = 0) THEN 'No Stock KTM'::text
            ELSE NULL::text
        END AS stock_in_ktm_status,
    ldo.delivery_day,
    pdi.vehicle_status AS pdi_status,
        CASE
            WHEN (pdi.vehicle_status = 0) THEN 'PDI not done'::text
            WHEN (pdi.vehicle_status = 1) THEN 'PDI Complete'::text
            ELSE NULL::text
        END AS pdi_status_check,
    ldd.dispatched_date_np_month AS dispatch_month_nepali,
    ldo.grn_file,
    ldo.cancel_order_status,
    ldo.grn_allow_status,
    ldo.is_ktm_dealer,
    ldd.dispatched_date_np_year,
        CASE
            WHEN (ldo.grn_received_date IS NULL) THEN 'Pending'::text
            ELSE 'Received'::text
        END AS grn_status,
    ldo.logistic_confirmation_date,
    ldo.logistic_confirmation_date_np,
    ldo.on_hold_remarks,
    lsr.retail_edit_month,
    enm.name AS nepali_edit_retail_month,
    ldo.challan_status,
    ldo.location,
    ldd.challan_return_image AS challan_image,
    mdr.vehicle_register_no,
    ldo.order_type,
    ldo.credit_hold_date,
    ldo.credit_hold_date_np,
    mdr.current_location,
    mdr.current_status,
    (lfk.fuel)::double precision AS fuel,
    au.fullname,
    de.assistant_incharge_id
   FROM (((((((((((((((((log_dealer_order ldo
     LEFT JOIN aauth_users au ON ((ldo.dispatch_user_id = au.id)))
     JOIN mst_vehicles ve ON ((ldo.vehicle_id = ve.id)))
     JOIN mst_variants va ON ((ldo.variant_id = va.id)))
     JOIN mst_colors co ON ((ldo.color_id = co.id)))
     LEFT JOIN msil_dispatch_records mdr ON ((ldo.vehicle_main_id = mdr.id)))
     LEFT JOIN log_dispatch_dealer ldd ON ((ldd.dealer_order_id = ldo.id)))
     LEFT JOIN log_stock_records lsr ON ((lsr.dispatch_id = ldd.id)))
     LEFT JOIN dms_dealers de ON ((ldo.dealer_id = de.id)))
     LEFT JOIN mst_nepali_month ON ((ldo.order_month_id = mst_nepali_month.id)))
     LEFT JOIN mst_stock_yards ON ((lsr.stock_yard_id = mst_stock_yards.id)))
     LEFT JOIN mst_firms ON ((ve.firm_id = mst_firms.id)))
     LEFT JOIN view_log_damage_latest log_damage ON ((ldd.id = log_damage.dispatch_id)))
     LEFT JOIN mst_nepali_month mnm ON (((lsr.dispatched_date_np_month)::integer = mnm.id)))
     LEFT JOIN mst_nepali_month mn ON ((ldd.edit_month_np = mn.id)))
     LEFT JOIN sales_pdi pdi ON ((ldd.id = pdi.dispatch_id)))
     LEFT JOIN mst_nepali_month enm ON ((lsr.retail_edit_month = enm.id)))
     LEFT JOIN log_fuel_kms lfk ON ((ldo.vehicle_id = lfk.vehicle_id)));


CREATE OR REPLACE VIEW "public"."view_dealer_order" AS 
 SELECT DISTINCT ON (c.order_id) c.id,
    c.date_of_order,
    c.date_of_delivery,
    c.delivery_lead_time,
    c.pdi_status,
    c.date_of_retail,
    c.retail_lead_time,
    c.created_by,
    c.updated_by,
    c.created_at,
    c.updated_at,
    c.payment_status,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    v1.name AS vehicle_name,
    v2.name AS variant_name,
    v3.name AS color_name,
    c.received_date,
    c.challan_return_image,
    d.name AS dealer_name,
    d.district_name,
    d.mun_vdc_name,
    d.city_name,
    c.payment_method,
    c.associated_value_payment,
    c.quantity,
    c.order_id,
    s.id AS stock_id,
    s.stock_yard_id AS stock_stockyard_id,
    s.created_by AS stock_created_by,
    s.vehicle_id AS stock_vehicle_id,
    s.reached_date,
    s.dispatched_date AS stock_dispatch_date,
    c.dealer_id,
    dmsd.name,
    c.year
   FROM ((((((log_dealer_order c
     JOIN mst_vehicles v1 ON ((c.vehicle_id = v1.id)))
     JOIN mst_variants v2 ON ((c.variant_id = v2.id)))
     JOIN mst_colors v3 ON ((c.color_id = v3.id)))
     LEFT JOIN view_dealers d ON ((c.dealer_id = d.id)))
     LEFT JOIN log_stock_records s ON ((c.vehicle_main_id = s.id)))
     LEFT JOIN dms_dealers dmsd ON ((c.dealer_id = dmsd.id)));


CREATE OR REPLACE VIEW "public"."view_dealer_retail" AS 
 SELECT log_stock_records.id,
    log_stock_records.created_by,
    log_stock_records.updated_by,
    log_stock_records.deleted_by,
    log_stock_records.deleted_at,
    log_stock_records.dispatched_date AS retail_date,
    log_stock_records.created_at,
    log_stock_records.updated_at,
    view_customers.executive_id,
    dms_dealers.id AS dealer_id,
    view_customers.full_name,
    view_customers.zone_name,
    view_customers.district_name,
    view_customers.mun_vdc_name,
    view_customers.executive_name,
    log_stock_records.vehicle_id AS msil_vehicle_id,
    view_customers.vehicle_id,
    view_customers.variant_id,
    view_customers.color_id,
    mst_colors.name AS color_name,
    mst_variants.name AS variant_name,
    mst_vehicles.name AS vehicle_name,
    mst_colors.code AS color_code,
    msil_dispatch_records.engine_no,
    msil_dispatch_records.chass_no,
    dms_dealers.incharge_id,
    sales_vehicle_process.booking_receipt_no,
    view_customers.inquiry_no,
    dms_dealers.name AS dealer_name,
    sales_vehicle_process.id AS sales_vehicle_id,
    sales_vehicle_process.booked_date,
    log_stock_records.dispatched_date_np AS retail_date_np,
    log_stock_records.dispatched_date_np_month AS retail_date_np_month,
    log_stock_records.dispatched_date_np_year AS retail_date_np_year,
    view_customers.customer_type_name,
    msil_dispatch_records.year,
    mf.name AS firm_name,
    view_customers.source_name,
    view_customers.actual_status_name,
    mst_nepali_month.name AS edit_month,
    view_customers.mobile_1,
    log_stock_records.log_retail_date,
    mnm.name AS log_retail_month,
    view_customers.dealer_id AS d_ids
   FROM ((((((((((log_stock_records
     JOIN sales_vehicle_process ON ((log_stock_records.vehicle_id = sales_vehicle_process.msil_dispatch_id)))
     JOIN view_customers ON ((sales_vehicle_process.customer_id = view_customers.id)))
     JOIN mst_colors ON ((view_customers.color_id = mst_colors.id)))
     JOIN mst_variants ON ((view_customers.variant_id = mst_variants.id)))
     JOIN mst_vehicles ON ((view_customers.vehicle_id = mst_vehicles.id)))
     JOIN msil_dispatch_records ON ((sales_vehicle_process.msil_dispatch_id = msil_dispatch_records.id)))
     JOIN dms_dealers ON ((view_customers.dealer_id = dms_dealers.id)))
     JOIN mst_firms mf ON ((mst_vehicles.firm_id = mf.id)))
     LEFT JOIN mst_nepali_month ON ((log_stock_records.retail_edit_month = mst_nepali_month.id)))
     LEFT JOIN mst_nepali_month mnm ON (((log_stock_records.dispatched_date_np_month)::integer = mnm.id)));

-- ----------------------------
-- View structure for view_dealer_retail_refined
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dealer_retail_refined" AS 
 SELECT log_stock_records.id,
    log_stock_records.created_by,
    log_stock_records.updated_by,
    log_stock_records.deleted_by,
    log_stock_records.created_at,
    log_stock_records.updated_at,
    log_stock_records.deleted_at,
    log_stock_records.vehicle_id AS msil_vehicle_id,
    log_stock_records.dispatched_date AS retail_date,
    log_stock_records.dispatched_date_np AS retail_date_np,
    log_stock_records.dispatched_date_np_month AS retail_date_np_month,
    log_stock_records.dispatched_date_np_year AS retail_date_np_year,
    mst_nepali_month.name AS edit_month,
    sales_vehicle_process.id AS sales_vehicle_id,
    sales_vehicle_process.booked_date,
    sales_vehicle_process.booking_receipt_no,
    msil_dispatch_records.engine_no,
    msil_dispatch_records.chass_no,
    msil_dispatch_records.year,
    c.inquiry_no,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    c.dealer_id,
    mst_variants.name AS variant_name,
    mst_vehicles.name AS vehicle_name,
    mst_colors.name AS color_name,
    mst_colors.code AS color_code,
    msil_dispatch_records.company_name AS firm_name,
    dms_dealers.name AS dealer_name,
    dms_dealers.incharge_id,
    c.mobile_1,
    c.executive_id,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
    mst_customer_types.name AS customer_type_name,
    replace((m3.parent_name)::text, ' Zone'::text, ''::text) AS zone_name,
    m3.name AS district_name,
    m4.name AS mun_vdc_name,
        CASE
            WHEN ((m8.middle_name)::text <> ''::text) THEN (((((m8.first_name)::text || ' '::text) || (m8.middle_name)::text) || ' '::text) || (m8.last_name)::text)
            ELSE (((m8.first_name)::text || ' '::text) || (m8.last_name)::text)
        END AS executive_name,
    mst_sources.name AS source_name,
    view_customer_status_latest.name AS actual_status_name,
    log_stock_records.log_retail_date_np,
    log_stock_records.log_retail_date,
    sales_vehicle_process.vehicle_delivery_date,
    dms_dealers.assistant_incharge_id
   FROM (((((((((((((((log_stock_records
     LEFT JOIN mst_nepali_month ON ((log_stock_records.retail_edit_month = mst_nepali_month.id)))
     JOIN sales_vehicle_process ON ((log_stock_records.vehicle_id = sales_vehicle_process.msil_dispatch_id)))
     JOIN msil_dispatch_records ON ((sales_vehicle_process.msil_dispatch_id = msil_dispatch_records.id)))
     JOIN dms_customers c ON ((sales_vehicle_process.customer_id = c.id)))
     JOIN mst_variants ON ((c.variant_id = mst_variants.id)))
     JOIN mst_vehicles ON ((c.vehicle_id = mst_vehicles.id)))
     JOIN mst_colors ON ((c.color_id = mst_colors.id)))
     JOIN mst_firms ON ((mst_vehicles.firm_id = mst_firms.id)))
     JOIN dms_dealers ON ((c.dealer_id = dms_dealers.id)))
     LEFT JOIN mst_customer_types ON ((c.customer_type_id = mst_customer_types.id)))
     LEFT JOIN view_district_mvs m3 ON ((c.district_id = m3.id)))
     LEFT JOIN mst_district_mvs m4 ON ((c.mun_vdc_id = m4.id)))
     JOIN dms_employees m8 ON ((c.executive_id = m8.id)))
     JOIN mst_sources ON ((c.source_id = mst_sources.id)))
     JOIN view_customer_status_latest ON ((c.id = view_customer_status_latest.customer_id)));

-- ----------------------------
-- View structure for view_dealer_sales
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dealer_sales" AS 
 SELECT ldd.id,
    ldd.created_by,
    ldd.vehicle_id AS msil_vehicle_id,
    ldd.stock_yard_id,
    ldd.dealer_id,
    mdr.vehicle_id,
    mdr.variant_id,
    mdr.color_id,
    mdr.dispatch_date AS dealer_dispatch_id,
    ldd.received_status,
    mv.name,
    mstv.name AS vehicle_name,
    mc.name AS color_name,
    mc.code AS color_code,
    vds.name AS dealer_name,
    vds.incharge_id,
    vds.incharge_name,
    vdm.parent_name,
    vdm.parent_id,
    vds.district_id,
    vds.district_name
   FROM ((((((log_dispatch_dealer ldd
     JOIN msil_dispatch_records mdr ON ((ldd.vehicle_id = mdr.id)))
     JOIN mst_variants mv ON ((mdr.variant_id = mv.id)))
     JOIN mst_vehicles mstv ON ((mdr.vehicle_id = mstv.id)))
     JOIN mst_colors mc ON ((mdr.color_id = mc.id)))
     JOIN view_dealers vds ON ((ldd.dealer_id = vds.id)))
     LEFT JOIN view_district_mvs vdm ON ((vds.district_id = vdm.id)));

-- ----------------------------
-- View structure for view_dealer_sales_records
-- ----------------------------


-- ----------------------------
-- View structure for view_dealer_spareparts
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dealer_spareparts" AS 
 SELECT vsd.id,
    vsd.created_by,
    vsd.updated_by,
    vsd.deleted_by,
    vsd.created_at,
    vsd.updated_at,
    vsd.deleted_at,
    vsd.name,
    vsd.incharge_id,
    vsd.district_id,
    vsd.mun_vdc_id,
    vsd.city_place_id,
    vsd.address_1,
    vsd.address_2,
    vsd.phone_1,
    vsd.phone_2,
    vsd.email,
    vsd.fax,
    vsd.latitude,
    vsd.longitude,
    vsd.remarks,
    vsd.credit_policy,
    vsd.district_name,
    vsd.mun_vdc_name,
    vsd.city_name,
    vsd.incharge_name,
    vsd.parent_id,
    msd.name AS dealer_name,
    msd.id AS dealer_id,
    msd.incharge_id AS dealer_incharge_id,
    vu.fullname,
    vu.username
   FROM ((view_sparepart_dealers vsd
     LEFT JOIN mst_spareparts_dealer msd ON ((vsd.parent_id = msd.id)))
     LEFT JOIN view_users vu ON ((msd.incharge_id = vu.id)));


CREATE OR REPLACE VIEW "public"."view_dealer_stock" AS 
 SELECT d.id,
    d.created_by,
    d.updated_by,
    d.deleted_by,
    d.created_at,
    d.updated_at,
    d.deleted_at,
    d.vehicle_id,
    d.stock_yard_id,
    d.driver_name,
    d.driver_address,
    d.driver_contact,
    d.driver_liscense_no,
    d.dealer_id,
    d.received_status,
    d.image_name,
    d.dispatched_date,
    d.dealer_order_id,
    a.name AS dealer_name,
    a.incharge_id,
    a.district_id,
    a.mun_vdc_id,
    a.city_place_id,
    a.address_1,
    a.address_2,
    a.phone_1,
    a.phone_2,
    a.email,
    a.fax,
    a.latitude,
    a.longitude,
    a.remarks,
    a.district_name,
    a.mun_vdc_name,
    a.city_name,
    a.incharge_name,
    s.name AS stock_yard,
    m.vehicle_name,
    m.color_name,
    m.variant_name,
    m.color_code,
    m.engine_no,
    m.chass_no,
    d1.date_of_delivery,
    d.received_date,
    d.received_date_nep,
    m.dispatch_date_to_customer AS retail_date,
    m.current_status,
    m.current_location,
    m.is_damage,
    m.damage_date,
    m.repair_date,
    m.damage_status,
    m.repair_commitment_date,
    m.id AS stock_id,
    m.year,
    m.firm_name,
    mdr.vehicle_register_no,
    a.assistant_incharge_id
   FROM (((((log_dispatch_dealer d
     LEFT JOIN view_dealers a ON ((d.dealer_id = a.id)))
     LEFT JOIN mst_stock_yards s ON ((d.stock_yard_id = s.id)))
     LEFT JOIN view_log_stock_records m ON ((d.vehicle_id = m.vehicle_id)))
     LEFT JOIN msil_dispatch_records mdr ON ((d.vehicle_id = mdr.id)))
     LEFT JOIN log_dealer_order d1 ON (((d.vehicle_id = d1.vehicle_main_id) AND (d1.cancel_date IS NULL))));


CREATE OR REPLACE VIEW "public"."view_dent_paint" AS 
 SELECT jc.jobcard_group,
    jc.vehicle_id,
    jc.variant_id,
    jc.service_type,
    jc.vehicle_no,
    jc.closed_status,
    jc.issue_date,
    jc.deleted_at,
    jc.vehicle_name,
    jc.variant_name,
    jc.service_type_name,
    jc.job_card_issue_date,
    jc.customer_name,
    jc.firm_id,
    jc.firm_name,
    jc.service_count,
    jc.chassis_no,
    jc.engine_no,
    jc.kms,
    jc.mechanics_id,
    jc.year,
    jc.reciever_name,
    jc.remarks,
    jc.dealer_id,
    jc.jobcard_serial,
    jc.color_id,
    jc.color_name,
    jc.floor_supervisor_id,
    jc.vehicle_rank,
    jc.variant_rank,
    jc.pdi_kms,
    jc.service_policy_id,
    jc.vehicle_sold_on,
    jc.address1,
    jc.address2,
    jc.dealer_name,
    jc.service_adviser_id,
    jc.service_advisor_name,
    jc.fiscal_year_id,
    b.total_parts,
    b.total_jobs,
    b.vat_percent,
    b.vat_parts,
    b.net_total,
    b.vat_job,
    op.total_amount AS ow_payment,
    ow.ow_margin,
    u.first_name,
    u.middle_name,
    u.last_name
   FROM ((((view_report_grouped_jobcard jc
     LEFT JOIN ser_billing_record b ON ((jc.jobcard_group = b.jobcard_group)))
     LEFT JOIN view_outside_work_grouped op ON ((b.jobcard_group = op.jobcard_group)))
     LEFT JOIN view_grouped_ow_margin ow ON ((b.id = ow.billing_id)))
     LEFT JOIN ser_workshop_users u ON ((jc.mechanics_id = u.id)));

-- ----------------------------
-- View structure for view_dentpaint_mechanic_earning
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dentpaint_mechanic_earning" AS 
 SELECT gc.mechanics_id,
    gc.dealer_id,
    gc.dealer_name,
    concat(wu.first_name, ' ', wu.middle_name, ' ', wu.last_name) AS mechanic_name,
    bo.billied_outside_work AS ow_payment,
    go.final_outside_work,
    (COALESCE(bo.billied_outside_work, (0)::double precision) - COALESCE(go.final_outside_work, (0)::real)) AS ow_margin,
    pb.partprice AS part_price,
    pb.accessprice AS accessories,
    pb.oilprice AS lube,
    pb.other,
    pb.localprice AS local,
    (COALESCE(br.total_jobs, (0)::real) - COALESCE(bo.billied_outside_work, (0)::double precision)) AS labour_amount,
    br.vat_job AS taxes,
    (COALESCE(br.vat_job, (0)::real) + COALESCE(br.total_jobs, (0)::real)) AS final_amount,
    COALESCE(br.total_jobs, ((0)::real + COALESCE(br.vat_job, (0)::real))) AS net_labour,
    br.total_parts,
    br.vat_parts,
    br.net_total,
    (COALESCE(br.total_jobs, (0)::real) + COALESCE(br.total_parts, (0)::real)) AS net_final_amount,
    br.issue_date
   FROM (((((view_report_grouped_jobcard gc
     LEFT JOIN ser_billing_record br ON ((gc.jobcard_group = br.jobcard_group)))
     LEFT JOIN view_billing_part_breakdown pb ON ((br.id = pb.id)))
     LEFT JOIN ser_workshop_users wu ON ((gc.mechanics_id = wu.id)))
     LEFT JOIN view_billed_grouped_outsidework bo ON ((br.id = bo.billing_id)))
     LEFT JOIN view_grouped_outside_works go ON ((gc.jobcard_group = go.jobcard_group)))
  WHERE (gc.service_type = 1);

-- ----------------------------
-- View structure for view_detail_credit_debit
-- ----------------------------

-- ----------------------------
-- View structure for view_discount_approved
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_discount_approved" AS 
 SELECT sd.id,
    sd.created_by,
    sd.updated_by,
    sd.deleted_by,
    sd.created_at,
    sd.updated_at,
    sd.deleted_at,
    sd.actual_price,
    sd.discount_request,
    sd.vehicle_id,
    sd.variant_id,
    sd.color_id,
    sd.approval,
    sd.approved_by,
    sd.approved_date,
    sd.customer_id,
    sd.remarks,
    sd.designation,
    sd.showroom_incharge_id,
    sd.dealer_incharge_id,
    sd.management_incharge_id,
    sd.admin,
    sd.reduced_discount,
    au.fullname AS request_name,
    aau.fullname AS approved_name,
    view_customers.full_name,
    mst_vehicles.name AS vehicle_name,
    mst_variants.name AS variant_name,
    mst_colors.name AS color_name,
    view_customers.inquiry_no,
    view_customers.customer_discount_amount
   FROM ((((((sales_discount_schemes sd
     JOIN aauth_users au ON ((sd.created_by = au.id)))
     JOIN aauth_users aau ON (((sd.approved_by)::integer = aau.id)))
     LEFT JOIN view_customers ON ((sd.customer_id = view_customers.id)))
     JOIN mst_vehicles ON ((sd.vehicle_id = mst_vehicles.id)))
     JOIN mst_variants ON ((sd.variant_id = mst_variants.id)))
     JOIN mst_colors ON ((sd.color_id = mst_colors.id)));


CREATE OR REPLACE VIEW "public"."view_employee_group" AS 
 SELECT dms_employees.id,
    dms_employees.created_by,
    dms_employees.updated_by,
    dms_employees.deleted_by,
    dms_employees.created_at,
    dms_employees.updated_at,
    dms_employees.deleted_at,
    dms_employees.dealer_id,
    dms_employees.has_login,
    dms_employees.user_id,
    dms_employees.first_name,
    dms_employees.middle_name,
    dms_employees.last_name,
    dms_employees.dob_en,
    dms_employees.dob_np,
    dms_employees.gender,
    dms_employees.marital_status,
    dms_employees.permanent_district_id,
    dms_employees.permanent_mun_vdc_id,
    dms_employees.permanent_ward,
    dms_employees.permanent_address_1,
    dms_employees.permanent_address_2,
    dms_employees.temporary_district_id,
    dms_employees.temporary_mun_vdc_id,
    dms_employees.temporary_ward,
    dms_employees.temporary_address_1,
    dms_employees.temporary_address_2,
    dms_employees.home,
    dms_employees.work,
    dms_employees.mobile,
    dms_employees.work_email,
    dms_employees.personal_email,
    dms_employees.photo,
    dms_employees.nationality,
    dms_employees.citizenship_no,
    dms_employees.citizenship_issued_on,
    dms_employees.citizenship_issued_by,
    dms_employees.license,
    dms_employees.license_type,
    dms_employees.license_no,
    dms_employees.license_issued_on,
    dms_employees.license_issued_by,
    dms_employees.license_expiry,
    dms_employees.passport,
    dms_employees.passport_type,
    dms_employees.passport_no,
    dms_employees.passport_issued_on,
    dms_employees.passport_issued_by,
    dms_employees.passport_expiry,
    dms_employees.education_id,
    dms_employees.designation_id,
    dms_employees.interview_date_en,
    dms_employees.interview_date_np,
    dms_employees.probation_period,
    dms_employees.joining_date_en,
    dms_employees.joining_date_np,
    dms_employees.confirmation_date_en,
    dms_employees.confirmation_date_np,
    dms_employees.leaving_date_en,
    dms_employees.leaving_date_np,
    dms_employees.leaving_reason,
    dms_employees.employee_type,
    dms_employees.mechanic_leader,
    view_users.group_id
   FROM (dms_employees
     JOIN view_users ON ((dms_employees.user_id = view_users.id)));


CREATE OR REPLACE VIEW "public"."view_employees" AS 
 SELECT e.id,
    e.created_by,
    e.updated_by,
    e.deleted_by,
    e.created_at,
    e.updated_at,
    e.deleted_at,
    e.dealer_id,
    e.has_login,
    e.user_id,
    e.first_name,
    e.middle_name,
    e.last_name,
    e.dob_en,
    e.dob_np,
    e.gender,
    e.marital_status,
    e.permanent_district_id,
    e.permanent_mun_vdc_id,
    e.permanent_ward,
    e.permanent_address_1,
    e.permanent_address_2,
    e.temporary_district_id,
    e.temporary_mun_vdc_id,
    e.temporary_ward,
    e.temporary_address_1,
    e.temporary_address_2,
    e.home,
    e.work,
    e.mobile,
    e.work_email,
    e.personal_email,
    e.photo,
    e.nationality,
    e.citizenship_no,
    e.citizenship_issued_on,
    e.citizenship_issued_by,
    e.license,
    e.license_type,
    e.license_no,
    e.license_issued_on,
    e.license_issued_by,
    e.license_expiry,
    e.passport,
    e.passport_type,
    e.passport_no,
    e.passport_issued_on,
    e.passport_issued_by,
    e.passport_expiry,
    e.education_id,
    e.designation_id,
    e.interview_date_en,
    e.interview_date_np,
    e.probation_period,
    e.joining_date_en,
    e.joining_date_np,
    e.confirmation_date_en,
    e.confirmation_date_np,
    e.leaving_date_en,
    e.leaving_date_np,
    e.leaving_reason,
        CASE
            WHEN ((e.middle_name)::text <> ''::text) THEN (((((e.first_name)::text || ' '::text) || (e.middle_name)::text) || ' '::text) || (e.last_name)::text)
            ELSE (((e.first_name)::text || ' '::text) || (e.last_name)::text)
        END AS employee_name,
    v.username,
    v.group_id,
    v."group" AS group_name,
    d1.name AS permanent_district_name,
    mv1.name AS permanent_mun_vdc_name,
    d2.name AS temporary_district_name,
    mv2.name AS temporary_mun_vdc_name,
    d.name AS designation_name,
    ed.name AS education_name,
    dl.name AS dealer_name,
    e.employee_type,
    e.mechanic_leader
   FROM ((((((((dms_employees e
     LEFT JOIN view_user_groups v ON (((e.user_id = v.user_id) AND (v.group_id <> 1))))
     LEFT JOIN mst_district_mvs d1 ON ((e.permanent_district_id = d1.id)))
     LEFT JOIN mst_district_mvs mv1 ON ((e.permanent_mun_vdc_id = mv1.id)))
     LEFT JOIN mst_district_mvs d2 ON ((e.temporary_district_id = d2.id)))
     LEFT JOIN mst_district_mvs mv2 ON ((e.temporary_mun_vdc_id = mv2.id)))
     LEFT JOIN mst_designations d ON ((e.designation_id = d.id)))
     LEFT JOIN mst_educations ed ON ((e.education_id = ed.id)))
     LEFT JOIN dms_dealers dl ON ((e.dealer_id = dl.id)));


CREATE OR REPLACE VIEW "public"."view_floor_supervisor_advice" AS 
 SELECT ser_floor_supervisor_advice.id,
    ser_floor_supervisor_advice.created_by,
    ser_floor_supervisor_advice.updated_by,
    ser_floor_supervisor_advice.deleted_by,
    ser_floor_supervisor_advice.created_at,
    ser_floor_supervisor_advice.updated_at,
    ser_floor_supervisor_advice.deleted_at,
    ser_floor_supervisor_advice.dealer_id,
    ser_floor_supervisor_advice.jobcard_group,
    ser_floor_supervisor_advice.part_name,
    ser_floor_supervisor_advice.quantity,
    ser_floor_supervisor_advice.received_quantity,
    ser_floor_supervisor_advice.received_status,
    ser_floor_supervisor_advice.return_quantity,
    ser_floor_supervisor_advice.dispatched_quantity,
    ser_floor_supervisor_advice.return_remarks,
    view_report_grouped_jobcard.closed_status,
    ser_floor_supervisor_advice.part_code,
    ser_floor_supervisor_advice.issue_date,
    ser_floor_supervisor_advice.warranty,
    ser_floor_supervisor_advice.material_scan_id,
    ser_floor_supervisor_advice.returned_status,
    ser_floor_supervisor_advice.total_dispatched,
    aauth_users.username AS material_issued_by,
    ser_floor_supervisor_advice.lube_dispatched_qty,
    ser_material_scan.lube_quantity
   FROM (((ser_floor_supervisor_advice
     JOIN view_report_grouped_jobcard ON ((ser_floor_supervisor_advice.jobcard_group = view_report_grouped_jobcard.jobcard_group)))
     LEFT JOIN ser_material_scan ON (((ser_floor_supervisor_advice.material_scan_id = ser_material_scan.id) AND ((ser_material_scan.deleted_at > now()) OR (ser_material_scan.deleted_at IS NULL)))))
     LEFT JOIN aauth_users ON ((ser_material_scan.updated_by = aauth_users.id)));

-- ----------------------------
-- View structure for view_floor_supervisor_adviced
-- ----------------------------

-- ----------------------------
-- View structure for view_fms
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_fms" AS 
 SELECT fm.stock_id,
    fm.deleted_at,
    fm.total,
    fm.part_code,
    fm.alternate_part_code,
    fm.part_name,
    fm.moq,
    fm.category_id,
    fm.model,
    fm.price,
    sum(fm.total) OVER (ORDER BY fm.total DESC, fm.sparepart_id) AS cum_quantity,
    ( SELECT sum(ss.dispatched_quantity) AS sum
           FROM spareparts_dispatch_spareparts ss) AS total_quantity,
    ((sum(fm.total) OVER (ORDER BY fm.total DESC, fm.sparepart_id) * (100)::numeric) / (( SELECT sum(ss.dispatched_quantity) AS sum
           FROM spareparts_dispatch_spareparts ss))::numeric) AS percentage,
        CASE
            WHEN (((sum(fm.total) OVER (ORDER BY fm.total DESC, fm.sparepart_id) * (100)::numeric) / (( SELECT sum(ss.dispatched_quantity) AS sum
               FROM spareparts_dispatch_spareparts ss))::numeric) <= (75)::numeric) THEN 'F'::text
            WHEN ((((sum(fm.total) OVER (ORDER BY fm.total DESC, fm.sparepart_id) * (100)::numeric) / (( SELECT sum(ss.dispatched_quantity) AS sum
               FROM spareparts_dispatch_spareparts ss))::numeric) > (75)::numeric) AND (((sum(fm.total) OVER (ORDER BY fm.total DESC, fm.sparepart_id) * (100)::numeric) / (( SELECT sum(ss.dispatched_quantity) AS sum
               FROM spareparts_dispatch_spareparts ss))::numeric) <= (90)::numeric)) THEN 'M'::text
            WHEN ((((sum(fm.total) OVER (ORDER BY fm.total DESC, fm.sparepart_id) * (100)::numeric) / (( SELECT sum(ss.dispatched_quantity) AS sum
               FROM spareparts_dispatch_spareparts ss))::numeric) > (90)::numeric) AND (((sum(fm.total) OVER (ORDER BY fm.total DESC, fm.sparepart_id) * (100)::numeric) / (( SELECT sum(ss.dispatched_quantity) AS sum
               FROM spareparts_dispatch_spareparts ss))::numeric) <= (95)::numeric)) THEN 'S'::text
            ELSE 'N'::text
        END AS fms,
    fm.quantity AS stock_quantity,
    fm.sparepart_id,
    fm.stockyard_id,
    fm.latest_part_code
   FROM view_fms_calculation fm;


CREATE OR REPLACE VIEW "public"."view_followup_schedule" AS 
 SELECT cf.id,
    cf.created_by,
    cf.updated_by,
    cf.deleted_by,
    cf.created_at,
    cf.updated_at,
    cf.deleted_at,
    cf.customer_id,
    cf.executive_id,
    cf.followup_date_en,
    cf.followup_date_np,
    cf.followup_mode,
    cf.followup_status,
    cf.followup_notes,
    cf.next_followup,
    cf.next_followup_date_en,
    cf.next_followup_date_np,
    c.inquiry_no,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.dealer_id,
    c.vehicle_name,
    c.variant_name,
    c.color_name,
    c.status_name,
    c.dealer_name,
        CASE
            WHEN ((e.middle_name)::text <> ''::text) THEN (((((e.first_name)::text || ' '::text) || (e.middle_name)::text) || ' '::text) || (e.last_name)::text)
            ELSE (((e.first_name)::text || ' '::text) || (e.last_name)::text)
        END AS executive_name,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS customer_name
   FROM ((dms_customer_followups cf
     LEFT JOIN view_customers c ON ((c.id = cf.customer_id)))
     LEFT JOIN dms_employees e ON ((cf.executive_id = e.id)))
  WHERE ((cf.followup_status)::text = 'Open'::text);

-- ----------------------------
-- View structure for view_followup_schedule_app
-- ----------------------------

-- ----------------------------
-- View structure for view_gatepass
-- ----------------------------

-- ----------------------------
-- View structure for view_inquiry_lost
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_inquiry_lost" AS 
 SELECT c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    c.inquiry_no,
    c.fiscal_year_id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.inquiry_kind,
    c.customer_type_id,
    c.first_name,
    c.middle_name,
    c.last_name,
    c.gender,
    c.marital_status,
    c.family_size,
    c.age,
    c.dob_en,
    c.dob_np,
    c.anniversary_en,
    c.anniversary_np,
    c.district_id,
    c.mun_vdc_id,
    c.address_1,
    c.address_2,
    c.email,
    c.home_1,
    c.home_2,
    c.work_1,
    c.work_2,
    c.mobile_1,
    c.mobile_2,
    c.pref_communication,
    c.occupation_id,
    c.education_id,
    c.dealer_id,
    c.executive_id,
    c.payment_mode_id,
    c.source_id,
    c.status_id,
    c.contact_1_name,
    c.contact_1_mobile,
    c.contact_1_relation_id,
    c.contact_2_name,
    c.contact_2_mobile,
    c.contact_2_relation_id,
    c.remarks,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    c.walkin_source_id,
    c.event_id,
    c.institution_id,
    c.exchange_car_make,
    c.exchange_car_model,
    c.exchange_car_year,
    c.exchange_car_kms,
    c.exchange_car_value,
    c.exchange_car_bonus,
    c.exchange_total_offer,
    c.bank_id,
    c.bank_branch,
    c.bank_staff,
    c.bank_contact,
    c.full_name,
    c.fiscal_year,
    c.customer_type_name,
    c.customer_type_rank,
    c.zone_name,
    c.district_name,
    c.mun_vdc_name,
    c.occupation_name,
    c.education_name,
    c.dealer_name,
    c.executive_name,
    c.payment_mode_name,
    c.source_name,
    c.source_rank,
    c.actual_status_name,
    c.actual_status_rank,
    c.status_name,
    c.status_rank,
    c.status_date,
    c.reason_name,
    c.contact_1_relation_name,
    c.contact_2_relation_name,
    c.vehicle_name,
    c.vehicle_rank,
    c.variant_name,
    c.color_name,
    c.walkin_source_name,
    c.event_name,
    c.institution_name,
    c.bank_name,
    c.test_drive,
    c.inquiry_type,
    c.sub_status_name,
    c.booking_canceled,
    c.discount_amount,
    c.customer_discount_amount,
    c.vehicle_process_id,
    c.parent_id,
    c.price,
    c.cancel_amount,
    c.notes,
    c.sub_status_group,
    c.booking_receipt_no,
    c.vehicle_delivery_date,
    c.engine_no,
    c.chass_no,
    c.booked_date,
    c.booking_age,
    c.booking_ageing,
    c.status_remarks,
    c.inquiry_age,
    c.retail_year,
    c.nepali_month,
    c.test_drive_status,
    c.nepali_month_rank,
    c.year,
    c.firm_name,
    c.color_code,
    c.is_edited,
    c.booking_cancel_reason
   FROM view_customers c
  WHERE (c.status_id = 16);

-- ----------------------------
-- View structure for view_inquiry_non_purchase
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_inquiry_non_purchase" AS 
 SELECT c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    c.inquiry_no,
    c.fiscal_year_id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.inquiry_kind,
    c.customer_type_id,
    c.first_name,
    c.middle_name,
    c.last_name,
    c.gender,
    c.marital_status,
    c.family_size,
    c.age,
    c.dob_en,
    c.dob_np,
    c.anniversary_en,
    c.anniversary_np,
    c.district_id,
    c.mun_vdc_id,
    c.address_1,
    c.address_2,
    c.email,
    c.home_1,
    c.home_2,
    c.work_1,
    c.work_2,
    c.mobile_1,
    c.mobile_2,
    c.pref_communication,
    c.occupation_id,
    c.education_id,
    c.dealer_id,
    c.executive_id,
    c.payment_mode_id,
    c.source_id,
    c.status_id,
    c.contact_1_name,
    c.contact_1_mobile,
    c.contact_1_relation_id,
    c.contact_2_name,
    c.contact_2_mobile,
    c.contact_2_relation_id,
    c.remarks,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    c.walkin_source_id,
    c.event_id,
    c.institution_id,
    c.exchange_car_make,
    c.exchange_car_model,
    c.exchange_car_year,
    c.exchange_car_kms,
    c.exchange_car_value,
    c.exchange_car_bonus,
    c.exchange_total_offer,
    c.bank_id,
    c.bank_branch,
    c.bank_staff,
    c.bank_contact,
    c.full_name,
    c.fiscal_year,
    c.customer_type_name,
    c.customer_type_rank,
    c.zone_name,
    c.district_name,
    c.mun_vdc_name,
    c.occupation_name,
    c.education_name,
    c.dealer_name,
    c.executive_name,
    c.payment_mode_name,
    c.source_name,
    c.source_rank,
    c.actual_status_name,
    c.actual_status_rank,
    c.status_name,
    c.status_rank,
    c.status_date,
    c.reason_name,
    c.contact_1_relation_name,
    c.contact_2_relation_name,
    c.vehicle_name,
    c.vehicle_rank,
    c.variant_name,
    c.color_name,
    c.walkin_source_name,
    c.event_name,
    c.institution_name,
    c.bank_name,
    c.test_drive,
    c.inquiry_type,
    c.sub_status_name,
    c.booking_canceled,
    c.discount_amount,
    c.customer_discount_amount,
    c.vehicle_process_id,
    c.parent_id,
    c.price,
    c.cancel_amount,
    c.notes,
    c.sub_status_group,
    c.booking_receipt_no,
    c.vehicle_delivery_date,
    c.engine_no,
    c.chass_no,
    c.booked_date,
    c.booking_age,
    c.booking_ageing,
    c.status_remarks,
    c.inquiry_age,
    c.retail_year,
    c.nepali_month,
    c.test_drive_status,
    c.nepali_month_rank,
    c.year,
    c.firm_name,
    c.color_code,
    c.is_edited,
    c.booking_cancel_reason
   FROM view_customers c
  WHERE (c.status_id = ANY (ARRAY[17, 18]));

-- ----------------------------
-- View structure for view_inquiry_pending
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_inquiry_pending" AS 
 SELECT c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    c.inquiry_no,
    c.fiscal_year_id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.inquiry_kind,
    c.customer_type_id,
    c.first_name,
    c.middle_name,
    c.last_name,
    c.gender,
    c.marital_status,
    c.family_size,
    c.age,
    c.dob_en,
    c.dob_np,
    c.anniversary_en,
    c.anniversary_np,
    c.district_id,
    c.mun_vdc_id,
    c.address_1,
    c.address_2,
    c.email,
    c.home_1,
    c.home_2,
    c.work_1,
    c.work_2,
    c.mobile_1,
    c.mobile_2,
    c.pref_communication,
    c.occupation_id,
    c.education_id,
    c.dealer_id,
    c.executive_id,
    c.payment_mode_id,
    c.source_id,
    c.status_id,
    c.contact_1_name,
    c.contact_1_mobile,
    c.contact_1_relation_id,
    c.contact_2_name,
    c.contact_2_mobile,
    c.contact_2_relation_id,
    c.remarks,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    c.walkin_source_id,
    c.event_id,
    c.institution_id,
    c.exchange_car_make,
    c.exchange_car_model,
    c.exchange_car_year,
    c.exchange_car_kms,
    c.exchange_car_value,
    c.exchange_car_bonus,
    c.exchange_total_offer,
    c.bank_id,
    c.bank_branch,
    c.bank_staff,
    c.bank_contact,
    c.full_name,
    c.fiscal_year,
    c.customer_type_name,
    c.customer_type_rank,
    c.zone_name,
    c.district_name,
    c.mun_vdc_name,
    c.occupation_name,
    c.education_name,
    c.dealer_name,
    c.executive_name,
    c.payment_mode_name,
    c.source_name,
    c.source_rank,
    c.actual_status_name,
    c.actual_status_rank,
    c.status_name,
    c.status_rank,
    c.status_date,
    c.reason_name,
    c.contact_1_relation_name,
    c.contact_2_relation_name,
    c.vehicle_name,
    c.vehicle_rank,
    c.variant_name,
    c.color_name,
    c.walkin_source_name,
    c.event_name,
    c.institution_name,
    c.bank_name,
    c.test_drive,
    c.inquiry_type,
    c.sub_status_name
   FROM view_customers c
  WHERE (c.status_id = 1);

-- ----------------------------
-- View structure for view_inquiry_retail
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_inquiry_retail" AS 
 SELECT c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    c.inquiry_no,
    c.fiscal_year_id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.inquiry_kind,
    c.customer_type_id,
    c.first_name,
    c.middle_name,
    c.last_name,
    c.gender,
    c.marital_status,
    c.family_size,
    c.age,
    c.dob_en,
    c.dob_np,
    c.anniversary_en,
    c.anniversary_np,
    c.district_id,
    c.mun_vdc_id,
    c.address_1,
    c.address_2,
    c.email,
    c.home_1,
    c.home_2,
    c.work_1,
    c.work_2,
    c.mobile_1,
    c.mobile_2,
    c.pref_communication,
    c.occupation_id,
    c.education_id,
    c.dealer_id,
    c.executive_id,
    c.payment_mode_id,
    c.source_id,
    c.status_id,
    c.contact_1_name,
    c.contact_1_mobile,
    c.contact_1_relation_id,
    c.contact_2_name,
    c.contact_2_mobile,
    c.contact_2_relation_id,
    c.remarks,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    c.walkin_source_id,
    c.event_id,
    c.institution_id,
    c.exchange_car_make,
    c.exchange_car_model,
    c.exchange_car_year,
    c.exchange_car_kms,
    c.exchange_car_value,
    c.exchange_car_bonus,
    c.exchange_total_offer,
    c.bank_id,
    c.bank_branch,
    c.bank_staff,
    c.bank_contact,
    c.full_name,
    c.fiscal_year,
    c.customer_type_name,
    c.customer_type_rank,
    c.zone_name,
    c.district_name,
    c.mun_vdc_name,
    c.occupation_name,
    c.education_name,
    c.dealer_name,
    c.executive_name,
    c.payment_mode_name,
    c.source_name,
    c.source_rank,
    c.actual_status_name,
    c.actual_status_rank,
    c.status_name,
    c.status_rank,
    c.status_date,
    c.reason_name,
    c.contact_1_relation_name,
    c.contact_2_relation_name,
    c.vehicle_name,
    c.vehicle_rank,
    c.variant_name,
    c.color_name,
    c.walkin_source_name,
    c.event_name,
    c.institution_name,
    c.bank_name,
    c.test_drive,
    c.inquiry_type,
        CASE
            WHEN (c.age IS NULL) THEN 'N/A'::text
            WHEN (c.age < (30)::double precision) THEN 'Age 00-30'::text
            WHEN ((c.age >= (30)::double precision) AND (c.age <= (40)::double precision)) THEN 'Age 30-40'::text
            WHEN ((c.age >= (40)::double precision) AND (c.age <= (50)::double precision)) THEN 'Age 40-50'::text
            WHEN ((c.age >= (50)::double precision) AND (c.age <= (60)::double precision)) THEN 'Age 50-60'::text
            ELSE 'Age 60+'::text
        END AS age_group,
    c.sub_status_name,
    c.booking_canceled,
    c.discount_amount,
    c.customer_discount_amount,
    c.vehicle_process_id,
    c.parent_id,
    c.price,
    c.cancel_amount,
    c.notes,
    c.sub_status_group,
    c.booking_receipt_no,
    c.vehicle_delivery_date,
    c.engine_no,
    c.chass_no,
    c.booked_date,
    c.booking_age,
    c.booking_ageing,
    c.status_remarks,
    c.inquiry_age,
    c.retail_year,
    c.nepali_month,
    c.test_drive_status,
    c.nepali_month_rank,
    c.year,
    c.firm_name,
    c.color_code,
    c.is_edited,
    c.booking_cancel_reason
   FROM view_customers c
  WHERE (c.status_id = 15);


CREATE OR REPLACE VIEW "public"."view_job_register" AS 
 SELECT view_service_job_card.chassis_no,
    view_service_job_card.vehicle_name,
    view_service_job_card.service_type_name,
    view_service_job_card.mechanic_name,
    view_service_job_card.city,
    view_service_job_card.mobile,
    string_agg((view_service_job_card.job_description)::text, ', '::text) AS job_desc,
    view_service_job_card.customer_voice,
    view_service_job_card.kms,
    view_service_job_card.vehicle_no,
    view_service_job_card.service_count,
    view_service_job_card.full_name,
    string_agg((view_service_billing_parts.part_name)::text, ', '::text) AS spareparts,
    view_service_job_card.jobcard_issue_date,
    view_service_job_card.dealer_id,
    view_service_job_card.deleted_at,
    view_service_billing_jobs.issue_date,
    view_service_job_card.jobcard_group
   FROM ((view_service_job_card
     LEFT JOIN view_service_billing_jobs ON ((view_service_job_card.jobcard_group = view_service_billing_jobs.jobcard_group)))
     LEFT JOIN view_service_billing_parts ON ((view_service_billing_jobs.id = view_service_billing_parts.billing_id)))
  GROUP BY view_service_billing_jobs.issue_date, view_service_job_card.customer_voice, view_service_job_card.kms, view_service_job_card.service_type_name, view_service_job_card.chassis_no, view_service_job_card.city, view_service_job_card.mobile, view_service_job_card.vehicle_name, view_service_job_card.mechanic_name, view_service_job_card.vehicle_no, view_service_job_card.service_count, view_service_job_card.full_name, view_service_job_card.jobcard_issue_date, view_service_job_card.dealer_id, view_service_job_card.deleted_at, view_service_job_card.jobcard_group;

-- ----------------------------
-- View structure for view_job_summary
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_job_summary" AS 
 SELECT rg.jobcard_group,
    rg.vehicle_id,
    rg.variant_id,
    rg.service_type,
    rg.vehicle_no,
    rg.closed_status,
    rg.issue_date,
    rg.deleted_at,
    rg.vehicle_name,
    rg.variant_name,
    rg.service_type_name,
    rg.job_card_issue_date,
    rg.customer_name,
    rg.firm_id,
    rg.firm_name,
    rg.service_count,
    rg.chassis_no,
    rg.engine_no,
    rg.kms,
    rg.mechanics_id,
    rg.year,
    rg.reciever_name,
    rg.remarks,
    rg.dealer_id,
    rg.jobcard_serial,
    rg.color_id,
    rg.color_name,
    rg.floor_supervisor_id,
    rg.vehicle_rank,
    rg.variant_rank,
    rg.pdi_kms,
    rg.service_policy_id,
    rg.vehicle_sold_on,
    rg.address1,
    rg.address2,
    rg.dealer_name,
    rg.service_adviser_id,
    rg.service_advisor_name,
    rg.fiscal_year_id,
    concat(wu.first_name, ' ', wu.middle_name, ' ', wu.last_name) AS mechanic_name,
    rg.floor_supervisor_name,
    bp.price,
    spc.name,
    ser_billed_jobs.price AS labourprice,
    br.issue_date AS billing_issue_date
   FROM ((((((view_report_grouped_jobcard rg
     LEFT JOIN ser_workshop_users wu ON ((rg.mechanics_id = wu.id)))
     LEFT JOIN ser_billing_record br ON ((rg.jobcard_group = br.jobcard_group)))
     LEFT JOIN ser_billed_parts bp ON ((br.id = bp.billing_id)))
     LEFT JOIN mst_spareparts sp ON ((bp.part_id = sp.id)))
     LEFT JOIN mst_spareparts_category spc ON ((sp.category_id = spc.id)))
     JOIN ser_billed_jobs ON ((br.id = ser_billed_jobs.billing_id)));


CREATE OR REPLACE VIEW "public"."view_job_summary_refined" AS 
 SELECT gc.jobcard_group,
    gc.vehicle_id,
    gc.variant_id,
    gc.service_type,
    gc.vehicle_no,
    gc.closed_status,
    gc.issue_date,
    gc.deleted_at,
    gc.vehicle_name,
    gc.variant_name,
    gc.service_type_name,
    gc.job_card_issue_date,
    gc.customer_name,
    gc.firm_id,
    gc.firm_name,
    gc.service_count,
    gc.chassis_no,
    gc.engine_no,
    gc.kms,
    gc.mechanics_id,
    gc.year,
    gc.reciever_name,
    gc.remarks,
    gc.dealer_id,
    gc.jobcard_serial,
    gc.color_id,
    gc.color_name,
    gc.floor_supervisor_id,
    gc.vehicle_rank,
    gc.variant_rank,
    gc.pdi_kms,
    gc.service_policy_id,
    gc.vehicle_sold_on,
    gc.address1,
    gc.address2,
    gc.dealer_name,
    gc.service_adviser_id,
    gc.service_advisor_name,
    gc.fiscal_year_id,
    gc.floor_supervisor_name,
    gc.material_issued_status,
    gc.coupon,
    gc.mobile,
    gc.pan_no,
    gc.inquiry_date_en,
    gc.invoice_no,
    br.issue_date AS billing_issue_date,
    br.total_jobs AS labourprice,
    pb.partprice,
    pb.accessprice,
    pb.oilprice,
    pb.other,
    wu.first_name,
    wu.middle_name,
    wu.last_name,
    concat(wu.first_name, ' ', wu.middle_name, ' ', wu.last_name) AS mechanic_name,
    view_job_description.job_desc,
    view_parts_details.part_name,
    br.cash_discount_amt,
    br.net_total,
    br.vat_job,
    br.vat_parts,
    (br.vat_job + br.vat_parts) AS vat_total,
    pb.localprice,
    gc.tire_make,
    gc.battery_no,
    gc.closed_date
   FROM (((((view_report_grouped_jobcard gc
     LEFT JOIN ser_billing_record br ON ((gc.jobcard_group = br.jobcard_group)))
     LEFT JOIN view_billing_part_breakdown pb ON ((br.id = pb.id)))
     LEFT JOIN ser_workshop_users wu ON ((gc.mechanics_id = wu.id)))
     LEFT JOIN view_job_description ON ((view_job_description.billing_id = br.id)))
     LEFT JOIN view_parts_details ON ((view_parts_details.billing_id = br.id)));

-- ----------------------------
-- View structure for view_job_wise_billing
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_job_wise_billing" AS 
 SELECT bj.id,
    bj.created_by,
    bj.updated_by,
    bj.deleted_by,
    bj.created_at,
    bj.updated_at,
    bj.deleted_at,
    bj.billing_id,
    bj.job_id,
    bj.price,
    bj.discount_amount,
    bj.discount_percentage,
    bj.final_amount,
    bj.status,
    br.issue_date,
    br.invoice_no,
    br.dealer_id,
    j.job_code,
    j.description,
    d.name AS dealer_name,
    gc.coupon,
    gc.service_type_name,
    gc.vehicle_name
   FROM ((((ser_billed_jobs bj
     LEFT JOIN ser_billing_record br ON ((bj.billing_id = br.id)))
     LEFT JOIN mst_service_jobs j ON ((bj.job_id = j.id)))
     LEFT JOIN dms_dealers d ON ((br.dealer_id = d.id)))
     LEFT JOIN view_report_grouped_jobcard gc ON ((br.jobcard_group = gc.jobcard_group)));

-- ----------------------------
-- View structure for view_jobcard_billed_details
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_jobcard_billed_details" AS 
 SELECT ser_billing_record.created_by,
    ser_billing_record.updated_by,
    ser_billing_record.deleted_by,
    ser_billing_record.created_at,
    ser_billing_record.updated_at,
    ser_billing_record.deleted_at,
    ser_billing_record.jobcard_group,
    ser_billing_record.bill_type,
    ser_billing_record.payment_type,
    ser_billing_record.issue_date,
    ser_billing_record.cash_account,
    ser_billing_record.credit_account,
    ser_billing_record.card_account,
    ser_billing_record.invoice_prefix,
    ser_billing_record.invoice_no,
    ser_billing_record.total_parts,
    ser_billing_record.total_jobs,
    ser_billing_record.cash_discount_percent,
    ser_billing_record.cash_discount_amt,
    ser_billing_record.vat_percent,
    ser_billing_record.vat_parts,
    ser_billing_record.vat_job,
    ser_billing_record.net_total,
    ser_billing_record.dealer_id,
    ser_billing_record.counter_sales_id,
    view_billed_job_all.job_id,
    view_billed_job_all.price,
    view_billed_job_all.final_amount,
    view_billed_job_all.status,
    mst_service_jobs.job_code AS job,
    mst_service_jobs.description AS job_description,
    view_billed_job_all.billing_id,
    ser_billing_record.id,
    view_billed_job_all.discount_amount,
    view_billed_job_all.outsidework
   FROM ((ser_billing_record
     JOIN view_billed_job_all ON ((ser_billing_record.id = view_billed_job_all.billing_id)))
     JOIN mst_service_jobs ON ((view_billed_job_all.job_id = mst_service_jobs.id)));

-- ----------------------------
-- View structure for view_jobcard_desc
-- ----------------------------

-- ----------------------------
-- View structure for view_jobcard_excel
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_jobcard_excel" AS 
 SELECT view_service_job_card.jobcard_group,
    view_service_job_card.service_type_name,
    view_service_job_card.vehicle_no,
    view_service_job_card.chassis_no,
    view_service_job_card.address1,
    view_service_job_card.mobile,
    view_service_job_card.vehicle_name,
    view_service_job_card.variant_name,
    view_service_job_card.jobcard_issue_date,
    view_service_job_card.service_count,
    view_service_job_card.floor_supervisor_name,
    view_service_job_card.service_advisor_name,
    string_agg((view_service_job_card.job_description)::text, ', '::text) AS customer_voice,
    view_service_job_card.full_name,
    ser_billing_record.issue_date,
    view_service_job_card.deleted_at,
    view_service_job_card.deleted_by,
    view_service_job_card.kms,
        CASE
            WHEN ((wu.middle_name)::text <> ''::text) THEN (((((wu.first_name)::text || ' '::text) || (wu.middle_name)::text) || ' '::text) || (wu.last_name)::text)
            ELSE (((wu.first_name)::text || ' '::text) || (wu.last_name)::text)
        END AS mechanic_name,
    view_service_job_card.dealer_name,
    view_service_job_card.dealer_id
   FROM ((view_service_job_card
     LEFT JOIN ser_billing_record ON ((view_service_job_card.jobcard_group = ser_billing_record.jobcard_group)))
     LEFT JOIN ser_workshop_users wu ON ((view_service_job_card.mechanics_id = wu.id)))
  GROUP BY view_service_job_card.jobcard_group, view_service_job_card.service_type_name, view_service_job_card.vehicle_no, view_service_job_card.chassis_no, view_service_job_card.address1, view_service_job_card.mobile, view_service_job_card.vehicle_name, view_service_job_card.variant_name, view_service_job_card.jobcard_issue_date, view_service_job_card.service_count, view_service_job_card.floor_supervisor_voice, view_service_job_card.floor_supervisor_name, view_service_job_card.service_advisor_name, view_service_job_card.full_name, ser_billing_record.issue_date, view_service_job_card.deleted_at, view_service_job_card.deleted_by, view_service_job_card.kms, wu.first_name, wu.middle_name, wu.last_name, view_service_job_card.dealer_id, view_service_job_card.dealer_name;

-- ----------------------------
-- View structure for view_jobcard_material_scan_group
-- ----------------------------

-- ----------------------------
-- View structure for view_jobrefined_counter
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_jobrefined_counter" AS 
 SELECT ser.bill_type,
    ser.dealer_id,
    b.partprice,
    b.accessprice,
    b.oilprice,
    b.other,
    ser.issue_date,
    d.name AS dealer_name,
    b.localprice,
    ser.vat_parts,
    ser.vat_percent,
    ser.cash_discount_amt
   FROM ((ser_billing_record ser
     LEFT JOIN view_billing_part_breakdown b ON ((ser.id = b.id)))
     JOIN dms_dealers d ON ((ser.dealer_id = d.id)))
  WHERE ((ser.bill_type)::text = 'counter'::text);

-- ----------------------------
-- View structure for view_labours_register
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_labours_register" AS 
 SELECT wu.first_name,
    wu.middle_name,
    wu.last_name,
    ow.total_amount AS ow_paid,
    gm.ow_margin,
    bj.price AS gross_amount,
    sjc.job_description,
    sjc.job,
    br.invoice_no,
    br.issue_date AS invoice_date,
    (((COALESCE(bj.price, (0)::double precision) + (COALESCE(ow.total_amount, 0))::double precision) + COALESCE(gm.ow_margin, (0)::real)) * (0.13)::double precision) AS taxes,
    (((COALESCE(bj.price, (0)::double precision) + (COALESCE(ow.total_amount, 0))::double precision) + COALESCE(gm.ow_margin, (0)::real)) + (((COALESCE(bj.price, (0)::double precision) + (COALESCE(ow.total_amount, 0))::double precision) + COALESCE(gm.ow_margin, (0)::real)) * (0.13)::double precision)) AS net,
    rg.job_card_issue_date,
    rg.dealer_id,
    rg.deleted_at,
    sjc.mechanic_name
   FROM ((((((view_report_grouped_jobcard rg
     LEFT JOIN ser_billing_record br ON ((rg.jobcard_group = br.jobcard_group)))
     LEFT JOIN view_outside_work_grouped ow ON ((br.jobcard_group = ow.jobcard_group)))
     LEFT JOIN view_grouped_ow_margin gm ON ((br.id = gm.billing_id)))
     LEFT JOIN ser_billed_jobs bj ON ((br.id = bj.billing_id)))
     LEFT JOIN view_service_job_card sjc ON ((rg.jobcard_group = sjc.jobcard_group)))
     LEFT JOIN ser_workshop_users wu ON ((rg.mechanics_id = wu.id)));

-- ----------------------------
-- View structure for view_left_spareparts
-- ----------------------------

-- ----------------------------
-- View structure for view_log_damage_latest
-- ----------------------------

-- ----------------------------
-- View structure for view_log_stock_record
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_log_stock_record" AS 
 SELECT l.id,
    l.created_by,
    l.updated_by,
    l.deleted_by,
    l.created_at,
    l.updated_at,
    l.deleted_at,
    l.vehicle_id,
    l.stock_yard_id,
    l.reached_date,
    l.dispatched_date,
    l.vehicle_id AS stock_vehicle_id,
    v.name AS vehicle_name,
    v1.name AS variant_name,
    c.name AS color_name,
    c.code AS color_code,
    m.engine_no,
    m.chass_no,
    s.name AS stock_yard,
    m.barcode,
    s.longitude,
    s.latitude,
    s.id AS stock_id,
    m.vehicle_id AS mst_vehicle_id,
    m.variant_id AS mst_variant_id,
    m.color_id AS mst_color_id,
    d.dealer_name,
    d.district_name,
    d.mun_vdc_name,
    d.city_name,
    COALESCE(d.dealer_name, s.name, 'Transit'::character varying) AS stockyaard_dealer,
    m.current_status,
    m.current_location,
    l.is_damage,
    l.dealer_reject,
    l.driver_id,
    dr.id AS driver_details_id,
    dr.driver_name,
    dr.driver_number,
    dr.driver_address,
    dr.source,
    dr.destination,
    dr.photo,
    dr.license_no,
    m.company_name
   FROM ((((((((log_stock_records l
     LEFT JOIN msil_dispatch_records m ON ((l.vehicle_id = m.id)))
     LEFT JOIN mst_vehicles v ON ((m.vehicle_id = v.id)))
     LEFT JOIN mst_variants v1 ON ((m.variant_id = v1.id)))
     LEFT JOIN mst_colors c ON ((m.color_id = c.id)))
     LEFT JOIN mst_stock_yards s ON ((l.stock_yard_id = s.id)))
     LEFT JOIN log_dispatch_dealer dd ON ((l.vehicle_id = dd.vehicle_id)))
     LEFT JOIN view_dealer_order d ON ((dd.dealer_order_id = d.id)))
     LEFT JOIN driver_details dr ON ((l.driver_id = dr.id)));

-- ----------------------------
-- View structure for view_log_stock_record_working
-- ----------------------------

-- ----------------------------
-- View structure for view_lost_cases
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_lost_cases" AS 
 SELECT lc.id,
    lc.created_by,
    lc.updated_by,
    lc.deleted_by,
    lc.created_at,
    lc.updated_at,
    lc.deleted_at,
    lc.customer_id,
    lc.call_status,
    lc.date_of_call,
    lc.date_of_call_np,
    lc.voc,
    lc.sales_experience,
    lc.dse_attitude,
    lc.dse_knowledge,
    lc.scheme_information,
    lc.retail_finanace,
    lc.offered_test_drive,
    lc.warrenty_policy,
    lc.service_policy,
    lc.remarks,
    lc.call_count,
    lc.false_enquiry,
    lc.cold_enquiry,
    lc.personal_problem,
    lc.financial_problem,
    lc.still_under_consideration,
    lc.already_purchased_vehicle,
    lc.already_puchased_co_dealer,
    lc.pre_owner_vehicle,
    lc.competitors_model,
    lc.call_connect_inquiry_type,
    lc.competitor_m_product,
    lc.competitor_m_discount,
    lc.competitor_m_service,
    lc.competitor_m_stock,
    lc.closed_date,
    vc.full_name,
    vc.mobile_1,
    vc.inquiry_date_en,
    vc.vehicle_name,
    vc.variant_name,
    vc.payment_mode_name,
    vc.customer_type_name,
    vc.source_name,
    vc.walkin_source_id,
    vc.dealer_name,
    vc.executive_name,
    concat(vc.vehicle_name, ' ', vc.variant_name) AS model,
    (('now'::text)::date - vc.inquiry_date_en) AS inquiry_age,
        CASE
            WHEN ((('now'::text)::date - vc.inquiry_date_en) > 3) THEN 'Late'::text
            ELSE 'Normal'::text
        END AS inquiry_date_status,
    vc.source_id,
    vc.status_date AS close_date
   FROM (ccd_lostcase lc
     JOIN view_customers vc ON ((lc.customer_id = vc.id)));


CREATE OR REPLACE VIEW "public"."view_material_scan" AS 
 SELECT ser_material_scan.id,
    ser_material_scan.created_by,
    ser_material_scan.updated_by,
    ser_material_scan.deleted_by,
    ser_material_scan.created_at,
    ser_material_scan.updated_at,
    ser_material_scan.deleted_at,
    ser_material_scan.part_code,
    ser_material_scan.warranty,
    ser_material_scan.issue_date,
    ser_material_scan.jobcard_group,
    ser_material_scan.dealer_id,
    ser_material_scan.floorparts_advice_id,
    view_report_grouped_jobcard.closed_status,
        CASE
            WHEN (ser_floor_supervisor_advice.return_quantity = 0) THEN ser_floor_supervisor_advice.dispatched_quantity
            ELSE ser_floor_supervisor_advice.dispatched_quantity
        END AS quantity,
    ser_material_scan.is_consumable,
    ser_material_scan.material_issue_no,
    ser_material_scan.countersales_id,
    ser_material_scan.part_id,
    mst_spareparts.name AS part_name,
    view_report_grouped_jobcard.jobcard_serial,
    view_report_grouped_jobcard.vehicle_no,
    view_report_grouped_jobcard.customer_name,
    view_report_grouped_jobcard.mechanics_id,
        CASE
            WHEN (ser_material_scan.is_consumable = 1) THEN ser_material_scan.consumable_price
            ELSE mst_spareparts.price
        END AS price,
    ser_floor_supervisor_advice.return_quantity,
    ser_floor_supervisor_advice.dispatched_quantity,
    ser_floor_supervisor_advice.return_remarks,
    aauth_users.username AS issue_by,
    ser_material_scan.quantity AS other_quantity,
    view_report_grouped_jobcard.invoice_no,
    view_report_grouped_jobcard.vehicle_name,
    view_report_grouped_jobcard.variant_name,
    view_report_grouped_jobcard.engine_no,
    view_report_grouped_jobcard.chassis_no,
    view_report_grouped_jobcard.job_card_issue_date,
    view_report_grouped_jobcard.service_advisor_name,
    view_report_grouped_jobcard.dealer_name,
    ser_material_scan.lube_quantity,
        CASE
            WHEN (ser_material_scan.lube_quantity IS NOT NULL) THEN ser_material_scan.lube_quantity
            ELSE (ser_floor_supervisor_advice.dispatched_quantity)::numeric
        END AS display_quantity,
    ser_material_scan.consumable_price
   FROM ((((ser_material_scan
     LEFT JOIN view_report_grouped_jobcard ON (((ser_material_scan.jobcard_group = view_report_grouped_jobcard.jobcard_group) AND ((view_report_grouped_jobcard.deleted_at > now()) OR (view_report_grouped_jobcard.deleted_at IS NULL)))))
     JOIN mst_spareparts ON ((ser_material_scan.part_id = mst_spareparts.id)))
     LEFT JOIN ser_floor_supervisor_advice ON ((ser_material_scan.id = ser_floor_supervisor_advice.material_scan_id)))
     LEFT JOIN aauth_users ON ((ser_material_scan.updated_by = aauth_users.id)))
  WHERE (ser_floor_supervisor_advice.deleted_at IS NULL);

-- ----------------------------
-- View structure for view_mechanic_earning_final
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_mechanic_earning_final" AS 
 SELECT gj.jobcard_group,
    gj.vehicle_id,
    gj.variant_id,
    gj.service_type,
    gj.vehicle_no,
    gj.closed_status,
    gj.issue_date,
    gj.deleted_at,
    gj.vehicle_name,
    gj.variant_name,
    gj.service_type_name,
    gj.job_card_issue_date,
    gj.customer_name,
    gj.firm_id,
    gj.firm_name,
    gj.service_count,
    gj.chassis_no,
    gj.engine_no,
    gj.kms,
    gj.mechanics_id,
    gj.year,
    gj.reciever_name,
    gj.remarks,
    gj.dealer_id,
    gj.jobcard_serial,
    gj.color_id,
    gj.color_name,
    gj.floor_supervisor_id,
    gj.vehicle_rank,
    gj.variant_rank,
    gj.pdi_kms,
    gj.service_policy_id,
    gj.vehicle_sold_on,
    gj.address1,
    gj.address2,
    gj.dealer_name,
    gj.service_adviser_id,
    gj.service_advisor_name,
    gj.fiscal_year_id,
    gj.floor_supervisor_name,
    gj.material_issued_status,
    gj.coupon,
    gj.mobile,
    gj.pan_no,
    gj.inquiry_date_en,
    gj.invoice_no,
        CASE
            WHEN (bj.outsidework = 0) THEN bj.final_amount
            ELSE (0)::double precision
        END AS job_final_amount,
        CASE
            WHEN (bj.outsidework = 1) THEN bj.final_amount
            ELSE (0)::double precision
        END AS ow_final_amount,
    bj.outsidework,
    msj.job_code,
    msj.description,
    ((COALESCE(bj.final_amount, (0)::double precision) + COALESCE(msj.outsidework_margin, (0)::real)) * (0.13)::double precision) AS taxes,
    (((COALESCE(bj.final_amount, (0)::double precision) + COALESCE(msj.outsidework_margin, (0)::real)) * (0.13)::double precision) + (COALESCE(bj.final_amount, (0)::double precision) + COALESCE(msj.outsidework_margin, (0)::real))) AS net_total,
    concat(wu.first_name, ' ', wu.middle_name, ' ', wu.last_name) AS mechanic_name,
    msj.outsidework_margin,
    bj.status AS job_status,
    br.issue_date AS billing_issue_date,
        CASE
            WHEN (bj.outsidework = 1) THEN (bj.final_amount - (ows.total_amount)::double precision)
            ELSE (0)::double precision
        END AS ow_margin
   FROM (((((view_report_grouped_jobcard gj
     LEFT JOIN ser_workshop_users wu ON ((gj.mechanics_id = wu.id)))
     LEFT JOIN ser_billing_record br ON ((gj.jobcard_group = br.jobcard_group)))
     LEFT JOIN view_billed_job_all bj ON ((br.id = bj.billing_id)))
     LEFT JOIN mst_service_jobs msj ON ((bj.job_id = msj.id)))
     LEFT JOIN view_grouped_ow_work ows ON ((gj.jobcard_group = ows.jobcard_group)));

-- ----------------------------
-- View structure for view_mechanic_earning_report
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_mechanic_earning_report" AS 
 SELECT gc.mechanics_id,
    gc.dealer_id,
    gc.dealer_name,
    concat(wu.first_name, ' ', wu.middle_name, ' ', wu.last_name) AS mechanic_name,
    bo.billied_outside_work AS ow_payment,
    go.final_outside_work,
    (COALESCE(bo.billied_outside_work, (0)::double precision) - COALESCE(go.final_outside_work, (0)::real)) AS ow_margin,
    pb.partprice AS part_price,
    pb.accessprice AS accessories,
    pb.oilprice AS lube,
    pb.other,
    pb.localprice AS local,
    (COALESCE(br.total_jobs, (0)::real) - COALESCE(bo.billied_outside_work, (0)::double precision)) AS labour_amount,
    br.vat_job AS taxes,
    (COALESCE(br.vat_job, (0)::real) + COALESCE(br.total_jobs, (0)::real)) AS final_amount,
    COALESCE(br.total_jobs, ((0)::real + COALESCE(br.vat_job, (0)::real))) AS net_labour,
    br.total_parts,
    br.vat_parts,
    br.net_total,
    (COALESCE(br.total_jobs, (0)::real) + COALESCE(br.total_parts, (0)::real)) AS net_final_amount,
    br.issue_date
   FROM (((((view_report_grouped_jobcard gc
     LEFT JOIN ser_billing_record br ON ((gc.jobcard_group = br.jobcard_group)))
     LEFT JOIN view_billing_part_breakdown pb ON ((br.id = pb.id)))
     LEFT JOIN ser_workshop_users wu ON ((gc.mechanics_id = wu.id)))
     LEFT JOIN view_billed_grouped_outsidework bo ON ((br.id = bo.billing_id)))
     LEFT JOIN view_grouped_outside_works go ON ((gc.jobcard_group = go.jobcard_group)));

-- ----------------------------
-- View structure for view_mechanic_wise_part_consume_final
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_mechanic_wise_part_consume_final" AS 
 SELECT spb.id,
    spb.created_by,
    spb.updated_by,
    spb.deleted_by,
    spb.created_at,
    spb.updated_at,
    spb.deleted_at,
    spb.billing_id,
    spb.part_id,
    spb.price,
    spb.quantity,
    spb.discount_percentage,
    spb.final_amount,
    spb.warranty,
    spb.lube_quantity,
    br.issue_date,
    s.part_code,
    gc.vehicle_name,
    gc.service_type_name,
    gc.variant_name,
    gc.job_card_issue_date,
    gc.customer_name,
    gc.chassis_no,
    gc.engine_no,
    gc.kms,
    gc.dealer_name,
    gc.dealer_id,
    u.first_name,
    u.middle_name,
    u.last_name,
    s.name AS part_name,
        CASE
            WHEN ((spb.lube_quantity IS NULL) OR (spb.lube_quantity = (0)::numeric)) THEN (spb.quantity)::numeric
            ELSE spb.lube_quantity
        END AS final_quantity,
    (COALESCE(spb.final_amount, (0)::double precision) * (0.13)::double precision) AS vat,
    ((COALESCE(spb.final_amount, (0)::double precision) * (0.13)::double precision) + COALESCE(spb.final_amount, (0)::double precision)) AS net_total,
    concat(u.first_name, ' ', u.middle_name, ' ', u.last_name) AS mechanic_name,
    gc.vehicle_no,
    gc.jobcard_serial,
    gc.mechanics_id
   FROM ((((ser_billed_parts spb
     LEFT JOIN ser_billing_record br ON ((spb.billing_id = br.id)))
     LEFT JOIN mst_spareparts s ON ((spb.part_id = s.id)))
     LEFT JOIN view_report_grouped_jobcard gc ON ((br.jobcard_group = gc.jobcard_group)))
     LEFT JOIN ser_workshop_users u ON ((gc.mechanics_id = u.id)));

-- ----------------------------
-- View structure for view_mechanics_earning_detail
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_mechanics_earning_detail" AS 
 SELECT concat(wu.first_name, ' ', wu.middle_name, ' ', wu.last_name) AS mechanic_name,
    sj.job_code,
    sj.description,
    rg.vehicle_no,
    bj.price AS gross_amount,
    ow.total_amount AS osw_paid,
    gm.ow_margin,
    (((COALESCE(bj.price, (0)::double precision) + COALESCE(gm.ow_margin, (0)::real)) + (COALESCE(ow.total_amount, 0))::double precision) * (0.13)::double precision) AS taxes,
    (((COALESCE(bj.price, (0)::double precision) + COALESCE(gm.ow_margin, (0)::real)) + (COALESCE(ow.total_amount, 0))::double precision) + (((COALESCE(bj.price, (0)::double precision) + COALESCE(gm.ow_margin, (0)::real)) + (COALESCE(ow.total_amount, 0))::double precision) * (0.13)::double precision)) AS net,
    rg.mechanics_id,
    rg.job_card_issue_date,
    wu.dealer_id
   FROM ((((((view_report_grouped_jobcard rg
     LEFT JOIN ser_workshop_users wu ON ((rg.mechanics_id = wu.id)))
     LEFT JOIN ser_billing_record br ON ((rg.jobcard_group = br.jobcard_group)))
     LEFT JOIN ser_billed_jobs bj ON ((br.id = bj.billing_id)))
     LEFT JOIN mst_service_jobs sj ON ((bj.job_id = sj.id)))
     LEFT JOIN view_outside_work_grouped ow ON ((br.jobcard_group = ow.jobcard_group)))
     LEFT JOIN view_grouped_ow_margin gm ON ((br.id = gm.billing_id)))
  GROUP BY wu.first_name, wu.middle_name, rg.mechanics_id, rg.job_card_issue_date, wu.last_name, sj.job_code, sj.description, rg.vehicle_no, bj.price, ow.total_amount, gm.ow_margin, wu.dealer_id;

-- ----------------------------
-- View structure for view_minimum_ktm_stock
-- ----------------------------

-- ----------------------------
-- View structure for view_minimum_quantity_show
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_minimum_quantity_show" AS 
 SELECT mm.deleted_at,
    mm.vehicle_id,
    mm.variant_id,
    mm.color_id,
    mm.quantity,
    ve.name AS vehicle_name,
    va.name AS variant_name,
    co.name AS color_name,
        CASE
            WHEN ((COALESCE(vsa.stock_count, (0)::bigint) - mm.quantity) < 0) THEN ((COALESCE(vsa.stock_count, (0)::bigint) - mm.quantity) * (-1))
            ELSE (COALESCE(vsa.stock_count, (0)::bigint) - mm.quantity)
        END AS required_stock_positive,
    COALESCE(vsa.stock_count, (0)::bigint) AS stock_count,
    co.code AS color_code
   FROM ((((mst_minimum_quantity mm
     LEFT JOIN view_stock_all vsa ON ((((mm.vehicle_id = vsa.mst_vehicle_id) AND (mm.variant_id = vsa.mst_variant_id)) AND (mm.color_id = vsa.mst_color_id))))
     JOIN mst_vehicles ve ON ((mm.vehicle_id = ve.id)))
     JOIN mst_variants va ON ((mm.variant_id = va.id)))
     JOIN mst_colors co ON ((mm.color_id = co.id)))
  WHERE (COALESCE(vsa.stock_count, (0)::bigint) < mm.quantity);

-- ----------------------------
-- View structure for view_msil_cg_stock
-- ----------------------------

-- ----------------------------
-- View structure for view_outside_works
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_outside_works" AS 
 SELECT ow.id,
    ow.created_by,
    ow.updated_by,
    ow.deleted_by,
    ow.created_at,
    ow.updated_at,
    ow.deleted_at,
    ow.jobcard_group,
    ow.workshop_id,
    ow.amount,
    ow.taxes,
    ow.discount,
    ow.remarks,
    ow.splr_invoice_no,
    ow.send_date,
    ow.arrived_date,
    ow.mechanics_id,
    ow.splr_invoice_date,
    ow.prefix,
    ow.workshop_job_id,
    ow.gross_total,
    ow.round_off,
    ow.net_amount,
    ow.total_amount,
    em.first_name,
    em.middle_name,
    em.last_name,
    (((em.first_name)::text || ' '::text) || (em.last_name)::text) AS mechanic_name,
    ser_jobs.job_code,
    ser_jobs.description,
    job.vehicle_no,
    ow.billing_amount,
    ow.billing_discount_percent,
    ow.billing_final_amount,
    ow.margin_percentage
   FROM (((ser_outside_work ow
     LEFT JOIN dms_employees em ON ((em.id = ow.mechanics_id)))
     JOIN mst_service_jobs ser_jobs ON ((ow.workshop_job_id = ser_jobs.id)))
     LEFT JOIN ( SELECT j.jobcard_group,
            j.vehicle_no,
            j.chassis_no,
            j.engine_no,
            j.vehicle_id,
            j.variant_id,
            j.color_id,
            j.vehicle_name,
            j.variant_name,
            j.color_name
           FROM view_service_job_card j
          GROUP BY j.jobcard_group, j.vehicle_no, j.chassis_no, j.engine_no, j.vehicle_id, j.variant_id, j.color_id, j.vehicle_name, j.variant_name, j.color_name) job ON ((ow.jobcard_group = job.jobcard_group)));


CREATE OR REPLACE VIEW "public"."view_ccd_general_smr" AS 
 SELECT ccd.id,
    ccd.created_by,
    ccd.updated_by,
    ccd.deleted_by,
    ccd.customer_id,
    ccd.call_status,
    ccd.date_of_call,
    ccd.date_of_call_np,
    ccd.appointment_taken,
    ccd.appointment_date,
    ccd.remark,
    ccd.created_at,
    ccd.updated_at,
    ccd.deleted_at,
    ccd.schedule_date,
    ccd.call_type,
    ccd.false_reason,
    ccd.call_count,
    ccd.first_name,
    ccd.middle_name,
    ccd.last_name,
    ccd.vehicle_no,
    ccd.chassis_no,
    ccd.engine_no,
    ccd.vehicle_id,
    ccd.variant_id,
    ccd.color_id,
    ccd.closed_date,
    ccd.jobcard_group,
        CASE
            WHEN (c.id IS NOT NULL) THEN ((((c.first_name)::text || ' '::text) || (c.last_name)::text))::character varying
            ELSE j.full_name
        END AS customer,
    (('now'::text)::date - ccd.schedule_date) AS age,
        CASE
            WHEN (c.mobile_1 IS NOT NULL) THEN c.mobile_1
            ELSE j.mobile
        END AS mobile,
    v.name AS vehicle_name,
    va.name AS variant_name,
    d.name AS dealer_name,
    co.name AS color_name,
    d.id AS dealer_id,
    (ccd.schedule_date + '7 days'::interval day) AS shdule_date,
    j.job_desc
   FROM ((((((ccd_general_smr ccd
     LEFT JOIN dms_customers c ON ((ccd.customer_id = c.id)))
     LEFT JOIN view_customer_info_jobcard j ON ((ccd.jobcard_group = j.jobcard_group)))
     LEFT JOIN mst_vehicles v ON ((ccd.vehicle_id = v.id)))
     LEFT JOIN mst_variants va ON ((ccd.variant_id = va.id)))
     JOIN dms_dealers d ON ((j.dealer_id = d.id)))
     JOIN mst_colors co ON ((ccd.color_id = co.id)));

-- ----------------------------
-- View structure for view_ccd_inquiry
-- ----------------------------

-- ----------------------------
-- View structure for view_ccd_lost_case_report
-- ----------------------------

-- ----------------------------
-- View structure for view_ccd_lostcase
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_ccd_lostcase" AS 
 SELECT ccd_lostcase.id,
    ccd_lostcase.created_by,
    ccd_lostcase.updated_by,
    ccd_lostcase.deleted_by,
    ccd_lostcase.created_at,
    ccd_lostcase.updated_at,
    ccd_lostcase.deleted_at,
    ccd_lostcase.call_status,
    ccd_lostcase.date_of_call,
    ccd_lostcase.date_of_call_np,
    ccd_lostcase.voc,
    ccd_lostcase.sales_experience,
    ccd_lostcase.dse_attitude,
    ccd_lostcase.dse_knowledge,
    ccd_lostcase.scheme_information,
    ccd_lostcase.retail_finanace,
    ccd_lostcase.offered_test_drive,
    ccd_lostcase.warrenty_policy,
    ccd_lostcase.service_policy,
    ccd_lostcase.remarks,
    ccd_lostcase.call_count,
    view_customers.status_name,
    view_customers.sub_status_name,
    view_customers.inquiry_date_en,
    view_customers.mobile_1,
    view_customers.source_id,
    view_customers.walkin_source_id,
    view_customers.full_name,
    view_customers.customer_type_name,
    view_customers.dealer_name,
    view_customers.executive_name,
    view_customers.payment_mode_name,
    concat(view_customers.vehicle_name, ' ', view_customers.variant_name) AS model_name,
    view_customers.source_name,
    (('now'::text)::date - view_customers.inquiry_date_en) AS inquiry_age,
        CASE
            WHEN ((('now'::text)::date - (split_part((ccd_lostcase.closed_date)::text, ' '::text, 1))::date) > 3) THEN 'Late'::text
            ELSE 'Normal'::text
        END AS inquiry_date_status,
    ccd_lostcase.closed_date,
    ccd_lostcase.false_enquiry,
    ccd_lostcase.cold_enquiry,
    ccd_lostcase.personal_problem,
    ccd_lostcase.financial_problem,
    ccd_lostcase.still_under_consideration,
    ccd_lostcase.already_purchased_vehicle,
    ccd_lostcase.already_puchased_co_dealer,
    ccd_lostcase.pre_owner_vehicle,
    ccd_lostcase.competitors_model,
    ccd_lostcase.call_connect_inquiry_type,
    ccd_lostcase.competitor_m_product,
    ccd_lostcase.competitor_m_discount,
    ccd_lostcase.competitor_m_service,
    ccd_lostcase.competitor_m_stock,
    split_part((ccd_lostcase.closed_date)::text, ' '::text, 1) AS close_date,
    (('now'::text)::date - (split_part((ccd_lostcase.closed_date)::text, ' '::text, 1))::date) AS closing_age,
    view_customers.source_type_id,
    view_customers.status_date AS closs_date,
    view_customers.source_type_name
   FROM (ccd_lostcase
     JOIN view_customer_refined view_customers ON ((ccd_lostcase.customer_id = view_customers.id)));

-- ----------------------------
-- View structure for view_ccd_sixtydays
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_ccd_sixtydays" AS 
 SELECT ccd_sixty.id,
    ccd_sixty.created_by,
    ccd_sixty.updated_by,
    ccd_sixty.deleted_by,
    ccd_sixty.created_at,
    ccd_sixty.updated_at,
    ccd_sixty.deleted_at,
    ccd_sixty.customer_id,
    ccd_sixty.call_status,
    ccd_sixty.date_of_call,
    ccd_sixty.date_of_call_np,
    ccd_sixty.ownership_transfer,
    ccd_sixty.performance,
    ccd_sixty.smr_effectiveness,
    ccd_sixty.voc,
    vc.mobile_1,
    vc.exchange_car_make,
    vc.customer_type_name,
    vc.full_name,
    vc.dealer_name,
    vc.executive_name,
    vc.payment_mode_name,
    concat(vc.vehicle_name, ' ', vc.variant_name) AS model,
    vc.color_name,
    vc.vehicle_delivery_date AS retail_date,
    vc.engine_no,
    vc.chass_no,
    ccd_sixty.call_count
   FROM (ccd_sixtyday ccd_sixty
     JOIN view_customers vc ON ((ccd_sixty.customer_id = vc.id)));

-- ----------------------------
-- View structure for view_ccd_smr_twentyone_days
-- ----------------------------

-- ----------------------------
-- View structure for view_ccd_thirtydays
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_ccd_thirtydays" AS 
 SELECT ccdthirty.id,
    ccdthirty.created_by,
    ccdthirty.updated_by,
    ccdthirty.deleted_by,
    ccdthirty.created_at,
    ccdthirty.updated_at,
    ccdthirty.deleted_at,
    ccdthirty.customer_id,
    ccdthirty.call_status,
    ccdthirty.date_of_call,
    ccdthirty.date_of_call_np,
    ccdthirty.product_feedback,
    ccdthirty.bluebook_copy,
    ccdthirty.green_sticker,
    ccdthirty.payment_receipts,
    ccdthirty.recommend_name1,
    ccdthirty.recommend_contact1,
    ccdthirty.recommend_name2,
    ccdthirty.recommend_contact2,
    ccdthirty.recommend_name3,
    ccdthirty.recommend_contact3,
    ccdthirty.remarks,
    ccdthirty.voc,
    vc.vehicle_delivery_date AS retail_date,
    vc.engine_no,
    vc.chass_no,
    vc.inquiry_type,
    concat(vc.vehicle_name, ' ', vc.variant_name) AS model,
    vc.color_name,
    vc.payment_mode_name,
    vc.dealer_name,
    vc.executive_name,
    vc.customer_type_name,
    vc.full_name,
    vc.exchange_car_make,
    vc.mobile_1,
    ccdthirty.call_count,
    ccdthirty.registration_number,
    ccdthirty.call_for_service,
    ccdthirty.total_score
   FROM (ccd_thirtyday ccdthirty
     JOIN view_customers vc ON ((ccdthirty.customer_id = vc.id)));

-- ----------------------------
-- View structure for view_ccd_threedays
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_ccd_threedays" AS 
 SELECT ccdth.id,
    ccdth.created_by,
    ccdth.updated_by,
    ccdth.deleted_by,
    ccdth.created_at,
    ccdth.updated_at,
    ccdth.deleted_at,
    ccdth.customer_id,
    ccdth.call_status,
    ccdth.date_of_call,
    ccdth.date_of_call_np,
    ccdth.delivered_on_time,
    ccdth.cleanliness_of_car,
    ccdth.basic_features,
    ccdth.owner_manual,
    ccdth.service_coupon,
    ccdth.warrenty_card,
    ccdth.delivery_sheet,
    ccdth.ccd_details,
    ccdth.remarks,
    ccdth.voc,
    vc.mobile_1,
    vc.engine_no,
    vc.chass_no,
    vc.full_name,
    vc.dealer_name,
    vc.executive_name,
    vc.vehicle_delivery_date AS retail_date,
    vc.customer_type_name,
    vc.exchange_car_make,
    vc.payment_mode_name,
    concat(vc.vehicle_name, ' ', vc.variant_name) AS model,
    vc.color_name,
    ccdth.call_count,
    (('now'::text)::date - vc.vehicle_delivery_date) AS age,
    ccdth.total_score,
    ccdth.sss_score,
    ccdth.pss_score,
    ccdth.recommend_contact2,
    ccdth.recommend_name2,
    ccdth.recommend_contact1,
    ccdth.recommend_name1,
    ccdth.tool_set,
    ccdth.payment_receipt,
    ccdth.fit_and_finish,
    ccdth.unsatisfied,
    ccdth.un_prority,
    ccdth.false_retail,
    ccdth.call_connect_retail_type,
    ccdth.buying_experience,
    ccdth.same_dse,
    ccdth.un_priority
   FROM (ccd_threeday ccdth
     JOIN view_customers vc ON ((ccdth.customer_id = vc.id)));

-- ----------------------------
-- View structure for view_city_places
-- ----------------------------

-- ----------------------------
-- View structure for view_customer_dealer_report
-- ----------------------------

-- ----------------------------
-- View structure for view_customer_dublicate_file_log
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_customer_dublicate_file_log" AS 
 SELECT tbl_inquiry_uploaded_document.id,
    tbl_inquiry_uploaded_document.uploadeddocument,
    tbl_inquiry_uploaded_document.customer_id,
    view_customers.created_by,
    view_customers.updated_by,
    view_customers.deleted_by,
    view_customers.created_at,
    view_customers.updated_at,
    view_customers.deleted_at,
    view_customers.inquiry_no,
    view_customers.fiscal_year_id,
    view_customers.inquiry_date_en,
    view_customers.inquiry_date_np,
    view_customers.inquiry_kind,
    view_customers.customer_type_id,
    view_customers.first_name,
    view_customers.middle_name,
    view_customers.last_name,
    view_customers.gender,
    view_customers.marital_status,
    view_customers.family_size,
    view_customers.age,
    view_customers.dob_en,
    view_customers.dob_np,
    view_customers.anniversary_en,
    view_customers.anniversary_np,
    view_customers.district_id,
    view_customers.mun_vdc_id,
    view_customers.address_1,
    view_customers.address_2,
    view_customers.email,
    view_customers.home_1,
    view_customers.home_2,
    view_customers.work_1,
    view_customers.work_2,
    view_customers.mobile_1,
    view_customers.mobile_2,
    view_customers.pref_communication,
    view_customers.occupation_id,
    view_customers.education_id,
    view_customers.dealer_id,
    view_customers.executive_id,
    view_customers.payment_mode_id,
    view_customers.source_id,
    view_customers.status_id,
    view_customers.contact_1_name,
    view_customers.contact_1_mobile,
    view_customers.contact_1_relation_id,
    view_customers.contact_2_name,
    view_customers.contact_2_mobile,
    view_customers.contact_2_relation_id,
    view_customers.remarks,
    view_customers.vehicle_id,
    view_customers.variant_id,
    view_customers.color_id,
    view_customers.walkin_source_id,
    view_customers.event_id,
    view_customers.institution_id,
    view_customers.exchange_car_make,
    view_customers.exchange_car_model,
    view_customers.exchange_car_year,
    view_customers.exchange_car_kms,
    view_customers.exchange_car_value,
    view_customers.exchange_car_bonus,
    view_customers.exchange_total_offer,
    view_customers.bank_id,
    view_customers.bank_branch,
    view_customers.bank_staff,
    view_customers.bank_contact,
    view_customers.full_name,
    view_customers.fiscal_year,
    view_customers.customer_type_name,
    view_customers.customer_type_rank,
    view_customers.zone_name,
    view_customers.district_name,
    view_customers.mun_vdc_name,
    view_customers.occupation_name,
    view_customers.education_name,
    view_customers.dealer_name,
    view_customers.executive_name,
    view_customers.payment_mode_name,
    view_customers.source_name,
    view_customers.source_rank,
    view_customers.actual_status_name,
    view_customers.actual_status_rank,
    view_customers.status_name,
    view_customers.status_rank,
    view_customers.status_date,
    view_customers.reason_name,
    view_customers.contact_1_relation_name,
    view_customers.contact_2_relation_name,
    view_customers.vehicle_name,
    view_customers.vehicle_rank,
    view_customers.variant_name,
    view_customers.color_name,
    view_customers.walkin_source_name,
    view_customers.event_name,
    view_customers.institution_name,
    view_customers.bank_name,
    view_customers.test_drive,
    view_customers.inquiry_type,
    view_customers.booking_canceled,
    view_customers.discount_amount,
    view_customers.customer_discount_amount,
    view_customers.vehicle_process_id,
    view_customers.parent_id,
    view_customers.price,
    view_customers.cancel_amount,
    view_customers.notes,
    view_customers.sub_status_group,
    view_customers.sub_status_name,
    view_customers.booking_receipt_no,
    view_customers.vehicle_delivery_date,
    view_customers.engine_no,
    view_customers.chass_no,
    view_customers.booked_date,
    view_customers.booking_age,
    view_customers.booking_ageing,
    view_customers.status_remarks,
    view_customers.inquiry_age,
    view_customers.retail_year,
    view_customers.nepali_month,
    view_customers.test_drive_status,
    view_customers.nepali_month_rank,
    view_customers.year,
    view_customers.firm_name,
    view_customers.color_code,
    view_customers.is_edited,
    view_customers.booking_cancel_reason,
    view_customers.vehicle_make_year,
    view_customers.status_change_date
   FROM (tbl_inquiry_uploaded_document
     JOIN view_customers ON ((tbl_inquiry_uploaded_document.customer_id = view_customers.id)));


CREATE OR REPLACE VIEW "public"."view_report_target" AS 
 SELECT str.quantity,
    str.id,
    str.created_by,
    str.updated_by,
    str.deleted_by,
    str.created_at,
    str.updated_at,
    str.deleted_at,
    str.vehicle_id,
    str.vehicle_classification,
    str.dealer_id,
    str.target_year,
    str.month,
    str.revision,
    mst_city_places.name AS city_name,
    mst_city_places.rank AS city_rank,
    dms_dealers.city_place_id,
    str.retail_quantity,
    str.inquiry_target
   FROM (((view_report_target_revision_group vrt
     JOIN sales_target_records str ON ((((((vrt.vehicle_id = str.vehicle_id) AND (vrt.dealer_id = str.dealer_id)) AND (vrt.month = str.month)) AND (vrt.revision = str.revision)) AND ((vrt.target_year)::text = (str.target_year)::text))))
     JOIN dms_dealers ON ((str.dealer_id = dms_dealers.id)))
     JOIN mst_city_places ON ((dms_dealers.city_place_id = mst_city_places.id)));


CREATE OR REPLACE VIEW "public"."view_dashboard_modelwise_target" AS 
 SELECT vrt.target_year,
    vrt.month,
    vrt.vehicle_id,
    vrt.deleted_at,
    sum(vrt.quantity) AS total_target,
    mst_vehicles.name AS vehicle_name,
    mst_vehicles.rank AS vehicle_rank,
    sum(vrt.retail_quantity) AS total_retail_target,
        CASE
            WHEN (mst_vehicles.service_policy_id = 1) THEN 'Passenger'::text
            WHEN (mst_vehicles.service_policy_id = 3) THEN 'Utility'::text
            WHEN (mst_vehicles.service_policy_id = 4) THEN 'Commercial'::text
            WHEN (mst_vehicles.service_policy_id = 5) THEN 'Hybrid'::text
            ELSE 'Van'::text
        END AS segment_name,
    sum(vrt.inquiry_target) AS total_inquiry_target
   FROM (view_report_target vrt
     JOIN mst_vehicles ON ((vrt.vehicle_id = mst_vehicles.id)))
  GROUP BY vrt.deleted_at, vrt.vehicle_id, vrt.target_year, vrt.month, mst_vehicles.name, mst_vehicles.rank, mst_vehicles.service_policy_id
  ORDER BY mst_vehicles.rank;


  CREATE OR REPLACE VIEW "public"."view_dashboard_tar_act_retail_modelwise" AS 
 SELECT vrt.target_year,
    vrt.month,
    vrt.vehicle_id,
    vrt.deleted_at,
    vrt.vehicle_name,
    vrt.vehicle_rank,
    vrt.total_target,
    COALESCE((vdr.total_retail)::bigint) AS total_retail,
    vdr.month_rank,
    vdr.month_name,
    vrt.total_retail_target,
    mst_nepali_month.name AS nepali_month,
    mst_nepali_month.rank AS nepali_month_rank,
    vrt.segment_name
   FROM ((view_dashboard_modelwise_target vrt
     LEFT JOIN view_dashboard_actual_retail vdr ON (((((vrt.target_year)::text = (vdr.retail_fiscal_year)::text) AND (vrt.month = vdr.dispatched_date_np_month)) AND ((vrt.vehicle_name)::text = (vdr.vehicle_name)::text))))
     JOIN mst_nepali_month ON ((vrt.month = mst_nepali_month.id)));


CREATE OR REPLACE VIEW "public"."view_pending_job_summary" AS 
 SELECT view_report_grouped_jobcard.jobcard_group,
    view_report_grouped_jobcard.vehicle_id,
    view_report_grouped_jobcard.variant_id,
    view_report_grouped_jobcard.service_type,
    view_report_grouped_jobcard.vehicle_no,
    view_report_grouped_jobcard.closed_status,
    view_report_grouped_jobcard.issue_date,
    view_report_grouped_jobcard.deleted_at,
    view_report_grouped_jobcard.vehicle_name,
    view_report_grouped_jobcard.variant_name,
    view_report_grouped_jobcard.service_type_name,
    view_report_grouped_jobcard.job_card_issue_date,
    view_report_grouped_jobcard.customer_name,
    view_report_grouped_jobcard.firm_id,
    view_report_grouped_jobcard.firm_name,
    view_report_grouped_jobcard.service_count,
    view_report_grouped_jobcard.chassis_no,
    view_report_grouped_jobcard.engine_no,
    view_report_grouped_jobcard.kms,
    view_report_grouped_jobcard.mechanics_id,
    view_report_grouped_jobcard.year,
    view_report_grouped_jobcard.reciever_name,
    view_report_grouped_jobcard.remarks,
    view_report_grouped_jobcard.dealer_id,
    view_report_grouped_jobcard.jobcard_serial,
    view_report_grouped_jobcard.color_id,
    view_report_grouped_jobcard.color_name,
    view_report_grouped_jobcard.floor_supervisor_id,
    view_report_grouped_jobcard.vehicle_rank,
    view_report_grouped_jobcard.variant_rank,
    view_report_grouped_jobcard.pdi_kms,
    view_report_grouped_jobcard.service_policy_id,
    view_report_grouped_jobcard.vehicle_sold_on,
    view_report_grouped_jobcard.address1,
    view_report_grouped_jobcard.address2,
    view_report_grouped_jobcard.dealer_name,
    view_report_grouped_jobcard.service_adviser_id,
    view_report_grouped_jobcard.service_advisor_name,
    view_report_grouped_jobcard.fiscal_year_id,
    view_report_grouped_jobcard.floor_supervisor_name,
    view_report_grouped_jobcard.material_issued_status,
    view_report_grouped_jobcard.coupon,
    view_report_grouped_jobcard.mobile,
    view_report_grouped_jobcard.pan_no,
    view_report_grouped_jobcard.inquiry_date_en,
    view_report_grouped_jobcard.invoice_no,
    wu.first_name,
    wu.middle_name,
    wu.last_name,
    concat(wu.first_name, ' ', wu.middle_name, ' ', wu.last_name) AS mechanic_name,
    view_pending_jobs.job_desc,
    view_part_pending.part_consume
   FROM (((view_report_grouped_jobcard
     LEFT JOIN ser_workshop_users wu ON ((view_report_grouped_jobcard.mechanics_id = wu.id)))
     LEFT JOIN view_pending_jobs ON ((view_report_grouped_jobcard.jobcard_group = view_pending_jobs.jobcard_group)))
     LEFT JOIN view_part_pending ON ((view_report_grouped_jobcard.jobcard_group = view_part_pending.jobcard_group)));


CREATE OR REPLACE VIEW "public"."view_primary_sales_report" AS 
 SELECT vds.id,
    vds.created_by,
    vds.msil_vehicle_id,
    vds.stock_yard_id,
    vds.dealer_id,
    vds.vehicle_id,
    vds.variant_id,
    vds.color_id,
    vds.received_status,
    vds.name,
    vds.vehicle_name,
    vds.color_name,
    vds.color_code,
    vds.dealer_name,
    vds.incharge_id,
    vds.incharge_name,
    vds.parent_name,
    vds.parent_id,
    vds.district_id,
    vds.district_name,
    vds.dealer_dispatch_date,
    vds.updated_by,
    date_part('month'::text, vds.dealer_dispatch_date) AS month,
    date_part('year'::text, vds.dealer_dispatch_date) AS year,
        CASE
            WHEN (date_part('month'::text, vds.dealer_dispatch_date) = (1)::double precision) THEN 'JAN'::text
            WHEN (date_part('month'::text, vds.dealer_dispatch_date) = (2)::double precision) THEN 'FEB'::text
            WHEN (date_part('month'::text, vds.dealer_dispatch_date) = (3)::double precision) THEN 'MAR'::text
            WHEN (date_part('month'::text, vds.dealer_dispatch_date) = (4)::double precision) THEN 'APR'::text
            WHEN (date_part('month'::text, vds.dealer_dispatch_date) = (5)::double precision) THEN 'MAY'::text
            WHEN (date_part('month'::text, vds.dealer_dispatch_date) = (6)::double precision) THEN 'JUN'::text
            WHEN (date_part('month'::text, vds.dealer_dispatch_date) = (7)::double precision) THEN 'JUL'::text
            WHEN (date_part('month'::text, vds.dealer_dispatch_date) = (8)::double precision) THEN 'AUG'::text
            WHEN (date_part('month'::text, vds.dealer_dispatch_date) = (9)::double precision) THEN 'SEP'::text
            WHEN (date_part('month'::text, vds.dealer_dispatch_date) = (10)::double precision) THEN 'OCT'::text
            WHEN (date_part('month'::text, vds.dealer_dispatch_date) = (11)::double precision) THEN 'NOV'::text
            WHEN (date_part('month'::text, vds.dealer_dispatch_date) = (12)::double precision) THEN 'DEC'::text
            ELSE NULL::text
        END AS month_name,
    vdm.parent_name AS region_name
   FROM (view_report_dealer_sales vds
     LEFT JOIN view_district_mvs vdm ON ((vds.parent_id = vdm.id)));


CREATE OR REPLACE VIEW "public"."view_quotations" AS 
 SELECT q.id,
    q.created_by,
    q.updated_by,
    q.deleted_by,
    q.created_at,
    q.updated_at,
    q.deleted_at,
    q.customer_id,
    q.quotation_date_en,
    q.quotation_date_np,
    q.quote_price,
    q.quote_unit,
    c.first_name,
    c.middle_name,
    c.last_name,
    c.bank_name,
    c.address_1,
    c.address_2,
    c.home_1,
    c.mobile_1,
    c.work_1,
    c.vehicle_id,
    c.vehicle_name,
    c.variant_name,
    c.color_name,
    v.firm_name,
    c.customer_discount_amount,
    sales_discount_limit.staff_limit,
    q.quote_discount,
    q.quote_mrp,
    c.inquiry_no,
    c.remarks
   FROM ((((dms_quotations q
     JOIN ( SELECT qu.customer_id,
            max(qu.created_at) AS latest_date
           FROM dms_quotations qu
          GROUP BY qu.customer_id) dms_qu ON (((dms_qu.customer_id = q.customer_id) AND (dms_qu.latest_date = q.created_at))))
     LEFT JOIN view_customers c ON ((q.customer_id = c.id)))
     LEFT JOIN view_mst_vehicles v ON ((c.vehicle_id = v.id)))
     LEFT JOIN sales_discount_limit ON (((c.vehicle_id = sales_discount_limit.vehicle_id) AND (c.variant_id = sales_discount_limit.variant_id))));


CREATE OR REPLACE VIEW "public"."view_report_all" AS 
 SELECT rgj.jobcard_group,
    rgj.vehicle_id,
    rgj.variant_id,
    rgj.service_type,
    rgj.vehicle_no,
    rgj.closed_status,
    rgj.issue_date,
    rgj.deleted_at,
    rgj.vehicle_name,
    rgj.variant_name,
    rgj.service_type_name,
    rgj.job_card_issue_date,
    rgj.customer_name,
    rgj.firm_id,
    rgj.firm_name,
    rgj.service_count,
    rgj.chassis_no,
    rgj.engine_no,
    rgj.kms,
    rgj.mechanics_id,
    rgj.year,
    rgj.reciever_name,
    rgj.remarks,
    rgj.dealer_id,
    rgj.jobcard_serial,
    rgj.color_id,
    rgj.color_name,
    rgj.floor_supervisor_id,
    rgj.vehicle_rank,
    rgj.variant_rank,
    rgj.pdi_kms,
    rgj.service_policy_id,
    rgj.vehicle_sold_on,
    rgj.address1,
    rgj.address2,
    rgj.dealer_name,
    rgj.service_adviser_id,
    rgj.service_advisor_name,
    rgj.fiscal_year_id,
    concat(wu.first_name, ' ', wu.middle_name, ' ', wu.last_name) AS mechanic_name,
    view_parts_details.part_name,
    view_job_description.job_desc,
    (ser_billing_record.vat_job + ser_billing_record.vat_parts) AS vat,
    ser_billing_record.net_total AS total
   FROM ((((view_report_grouped_jobcard rgj
     LEFT JOIN ser_workshop_users wu ON ((rgj.mechanics_id = wu.id)))
     LEFT JOIN ser_billing_record ON ((rgj.jobcard_group = ser_billing_record.jobcard_group)))
     LEFT JOIN view_parts_details ON ((view_parts_details.billing_id = ser_billing_record.id)))
     LEFT JOIN view_job_description ON ((view_job_description.billing_id = ser_billing_record.id)));

-- ----------------------------
-- View structure for view_report_avg_sales
-- ----------------------------

-- ----------------------------
-- View structure for view_report_billing_stock_ec_list
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_billing_stock_ec_list" AS 
 SELECT mv.name AS vehicle_name,
    mva.name AS variant_name,
    mc.name AS color_name,
    mdr.vehicle_id,
    mdr.variant_id,
    mdr.color_id,
    mdr.engine_no,
    mdr.chass_no,
    mdr.dispatch_date,
    mdr.year,
    mdr.month,
    mdr.invoice_no,
    mdr.invoice_date,
    mdr.transit,
    mdr.id AS msil_vehicle_id,
    lsr.stock_yard_id,
    lsr.reached_date,
    lsr.dispatched_date AS retail_date,
    msy.name AS stockyard_name,
    ldd.dealer_id,
    vd.name AS dealer_name,
    vd.incharge_id,
    vd.incharge_name,
    vd.city_name,
    vd.mun_vdc_name,
    vd.district_name,
        CASE
            WHEN ((dms_customers.middle_name)::text <> ''::text) THEN (((((dms_customers.first_name)::text || ' '::text) || (dms_customers.middle_name)::text) || ' '::text) || (dms_customers.last_name)::text)
            ELSE (((dms_customers.first_name)::text || ' '::text) || (dms_customers.last_name)::text)
        END AS customer_name,
    log_damage.repaired_at AS repaired_date,
    log_damage.description AS damage_desc,
    log_damage.service_center,
    dms_customers.executive_id,
    view_users.fullname,
    (date_part('epoch'::text, age((('now'::text)::date)::timestamp with time zone, (mdr.dispatch_date)::timestamp with time zone)) / (86400)::double precision) AS ageing,
        CASE
            WHEN (lsr.dispatched_date IS NOT NULL) THEN 'retail'::text
            WHEN ((log_damage.description IS NOT NULL) AND (log_damage.repaired_at IS NULL)) THEN 'damage'::text
            WHEN (ldd.dispatched_date IS NOT NULL) THEN 'bill'::text
            WHEN (msy.name IS NOT NULL) THEN 'stock'::text
            WHEN (mdr.custom_name IS NOT NULL) THEN 'custom'::text
            ELSE 'transit'::text
        END AS vehicle_status,
        CASE
            WHEN (ldd.dealer_id IS NOT NULL) THEN vd.name
            WHEN (msy.name IS NOT NULL) THEN msy.name
            ELSE mdr.current_location
        END AS location,
    mdr.custom_name,
    ldd.dispatched_date AS billing_date,
    mdr.deleted_at,
    mv.rank AS vehicle_rank,
    date_part('year'::text, ldo.date_of_retail) AS retail_year,
    date_part('month'::text, ldo.date_of_retail) AS retail_month,
    date_part('year'::text, ldd.dispatched_date) AS bill_year,
    date_part('month'::text, ldd.dispatched_date) AS bill_month,
    ldd.dispatched_date_np AS billing_date_np,
    ldd.dispatched_date_np_month AS billing_date_np_month,
    ldd.dispatched_date_np_year AS billing_date_np_year,
    lsr.dispatched_date_np AS date_of_retail_np,
    lsr.dispatched_date_np_month AS date_of_retail_np_month,
    lsr.dispatched_date_np_year AS date_of_retail_np_year,
    vd.city_place_id,
    mdr.current_location,
    mdr.current_status,
    lsr.damage_date,
    lsr.repair_date,
    lsr.repair_date_nep,
    lsr.damage_date_nep,
    ldd.received_date AS dealer_received_date,
    ldd.received_date_nep AS dealer_received_date_nep,
    mdr.year AS manufacture_year,
    mdr.month AS manufacture_month,
    mnm.name AS manufacture_month_name,
    billing_month.name AS billing_month_name,
    retail_month.name AS retail_month_name,
    mc.code AS color_code,
    mf.name AS firm_name,
    mdr.key_no,
    mdr.pragyapan_no,
    mdr.nepal_custom,
    vd.assistant_incharge_id
   FROM ((((((((((((((((msil_dispatch_records mdr
     LEFT JOIN mst_vehicles mv ON ((mdr.vehicle_id = mv.id)))
     LEFT JOIN mst_variants mva ON ((mdr.variant_id = mva.id)))
     LEFT JOIN mst_colors mc ON ((mdr.color_id = mc.id)))
     LEFT JOIN log_stock_records lsr ON ((mdr.id = lsr.vehicle_id)))
     LEFT JOIN mst_stock_yards msy ON ((lsr.stock_yard_id = msy.id)))
     LEFT JOIN log_dispatch_dealer ldd ON ((mdr.id = ldd.vehicle_id)))
     LEFT JOIN log_dealer_order ldo ON ((ldd.dealer_order_id = ldo.id)))
     LEFT JOIN view_dealers vd ON ((ldd.dealer_id = vd.id)))
     LEFT JOIN sales_vehicle_process ON ((mdr.id = sales_vehicle_process.msil_dispatch_id)))
     LEFT JOIN dms_customers ON ((sales_vehicle_process.customer_id = dms_customers.id)))
     LEFT JOIN log_damage ON (((log_damage.vehicle_id = mdr.id) AND (log_damage.deleted_at IS NULL))))
     LEFT JOIN view_users ON ((dms_customers.executive_id = view_users.id)))
     LEFT JOIN mst_nepali_month mnm ON ((mdr.month = mnm.id)))
     LEFT JOIN mst_nepali_month billing_month ON (((ldd.dispatched_date_np_month)::integer = billing_month.id)))
     LEFT JOIN mst_nepali_month retail_month ON (((lsr.dispatched_date_np_month)::integer = retail_month.id)))
     LEFT JOIN mst_firms mf ON ((mv.firm_id = mf.id)))
  WHERE (mdr.deleted_at IS NULL);

-- ----------------------------
-- View structure for view_report_billing_stock_ec_list_bkp
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_billing_stock_ec_list_bkp" AS 
 SELECT mv.name AS vehicle_name,
    mva.name AS variant_name,
    mc.name AS color_name,
    mdr.vehicle_id,
    mdr.variant_id,
    mdr.color_id,
    mdr.engine_no,
    mdr.chass_no,
    mdr.dispatch_date,
    mdr.year,
    mdr.month,
    mdr.invoice_no,
    mdr.invoice_date,
    mdr.transit,
    mdr.id AS msil_vehicle_id,
    lsr.stock_yard_id,
    lsr.reached_date,
    lsr.dispatched_date,
    msy.name AS stockyard_name,
    ldd.dealer_id,
    ldo.date_of_retail,
    vd.name AS dealer_name,
    vd.incharge_id,
    vd.incharge_name,
    vd.city_name,
    vd.mun_vdc_name,
    vd.district_name,
    view_customers.full_name AS customer_name,
    log_damage.repaired_at AS repaired_date,
    log_damage.description AS damage_desc,
    log_damage.service_center,
    view_customers.executive_id,
    view_users.fullname
   FROM ((((((((((((msil_dispatch_records mdr
     LEFT JOIN mst_vehicles mv ON ((mdr.vehicle_id = mv.id)))
     LEFT JOIN mst_variants mva ON ((mdr.variant_id = mva.id)))
     LEFT JOIN mst_colors mc ON ((mdr.color_id = mc.id)))
     LEFT JOIN log_stock_records lsr ON ((mdr.id = lsr.vehicle_id)))
     LEFT JOIN mst_stock_yards msy ON ((lsr.stock_yard_id = msy.id)))
     LEFT JOIN log_dispatch_dealer ldd ON ((mdr.id = ldd.vehicle_id)))
     LEFT JOIN log_dealer_order ldo ON ((ldd.dealer_order_id = ldo.id)))
     LEFT JOIN view_dealers vd ON ((ldd.dealer_id = vd.id)))
     LEFT JOIN sales_vehicle_process ON ((mdr.id = sales_vehicle_process.msil_dispatch_id)))
     LEFT JOIN view_customers ON ((sales_vehicle_process.customer_id = view_customers.id)))
     LEFT JOIN log_damage ON ((log_damage.vehicle_id = mdr.id)))
     LEFT JOIN view_users ON ((view_customers.executive_id = view_users.id)));

-- ----------------------------
-- View structure for view_report_booking_history
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_booking_history" AS 
 SELECT view_customers.id,
    view_customers.inquiry_no,
    view_customers.fiscal_year_id,
    view_customers.inquiry_date_en,
    view_customers.inquiry_date_np,
    view_customers.inquiry_kind,
    view_customers.customer_type_id,
    view_customers.first_name,
    view_customers.middle_name,
    view_customers.last_name,
    view_customers.exchange_car_make,
    view_customers.exchange_car_model,
    view_customers.exchange_car_year,
    view_customers.exchange_car_kms,
    view_customers.exchange_car_value,
    view_customers.exchange_car_bonus,
    view_customers.exchange_total_offer,
    view_customers.full_name,
    view_customers.customer_type_name,
    view_customers.executive_name,
    view_customers.dealer_name,
    view_customers.source_name,
    view_customers.status_name,
    view_customers.status_date,
    view_customers.booked_date,
    view_customers.sale_booked_date_np,
    view_customers.sale_booked_date_np_month,
    view_customers.vehicle_delivery_date_np,
    crm_vehicle_edit.prev_vehicle,
    crm_vehicle_edit.prev_variant,
    crm_vehicle_edit.prev_color,
    crm_vehicle_edit.new_vehicle,
    crm_vehicle_edit.new_variant,
    crm_vehicle_edit.new_color,
    crm_vehicle_edit.date,
    v1.name AS prev_vehicle_name,
    v2.name AS prev_variant_name,
    v3.name AS prev_color_name,
    v4.name AS new_vehicle_name,
    v5.name AS new_variant_name,
    v6.name AS new_color_name,
    view_customers.booking_canceled,
    view_customers.vehicle_make_year,
    view_customers.vehicle_delivery_date,
    view_customers.sale_booked_date_year,
    view_customers.color_name,
    view_customers.variant_name,
    view_customers.vehicle_name
   FROM (((((((view_customers
     LEFT JOIN crm_vehicle_edit ON ((view_customers.id = crm_vehicle_edit.customer_id)))
     LEFT JOIN mst_vehicles v1 ON ((crm_vehicle_edit.prev_vehicle = v1.id)))
     LEFT JOIN mst_variants v2 ON ((crm_vehicle_edit.prev_variant = v2.id)))
     LEFT JOIN mst_colors v3 ON ((crm_vehicle_edit.prev_color = v3.id)))
     LEFT JOIN mst_vehicles v4 ON ((crm_vehicle_edit.new_vehicle = v4.id)))
     LEFT JOIN mst_variants v5 ON ((crm_vehicle_edit.new_variant = v5.id)))
     LEFT JOIN mst_colors v6 ON ((crm_vehicle_edit.new_color = v6.id)));

-- ----------------------------
-- View structure for view_report_cs_general
-- ----------------------------

-- ----------------------------
-- View structure for view_report_customer_inquiry
-- ----------------------------

-- ----------------------------
-- View structure for view_report_dealer_achievement
-- ----------------------------

-- ----------------------------
-- View structure for view_report_dealer_retail
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_dealer_retail" AS 
 SELECT vrbt.vehicle_id,
    vrbt.city_place_id,
    vrbt.vehicle_rank,
    vrbt.date_of_retail_np,
    count(vrbt.vehicle_id) AS total_retail,
    vrbt.dealer_id,
    date_part('month'::text, to_date((vrbt.date_of_retail_np)::text, 'YYYYMMDD'::text)) AS nepali_month,
    date_part('year'::text, to_date((vrbt.date_of_retail_np)::text, 'YYYYMMDD'::text)) AS nepali_year,
    mst_city_places.rank AS city_rank,
    mst_city_places.deleted_at
   FROM (view_report_billing_stock_ec_list vrbt
     JOIN mst_city_places ON ((vrbt.city_place_id = mst_city_places.id)))
  WHERE (vrbt.vehicle_status = 'retail'::text)
  GROUP BY vrbt.vehicle_id, vrbt.vehicle_rank, vrbt.city_place_id, vrbt.date_of_retail_np, vrbt.dealer_id, mst_city_places.rank, mst_city_places.deleted_at
 HAVING (vrbt.vehicle_id >= 1);


CREATE OR REPLACE VIEW "public"."view_report_dealer_retail_cum" AS 
 SELECT mnm.rank,
    mnm.name AS month_name,
    vrd.city_rank,
    vrd.nepali_month,
    vrd.city_place_id,
    sum(vrd.total_retail) OVER (PARTITION BY vrd.city_place_id ORDER BY vrd.city_rank, mnm.rank, vrd.city_place_id) AS cum_total_retail
   FROM (view_report_dealer_retail vrd
     JOIN mst_nepali_month mnm ON ((vrd.nepali_month = (mnm.id)::double precision)));

-- ----------------------------
-- View structure for view_report_dealer_retail_quaterly
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_dealer_retail_quaterly" AS 
 SELECT mnm.quater,
    vdt.city_place_id,
    vdt.city_rank,
    vdt.nepali_year,
    sum(vdt.total_retail) AS quaterly_dealer_retail
   FROM (view_report_dealer_retail vdt
     JOIN mst_nepali_month mnm ON ((vdt.nepali_month = (mnm.id)::double precision)))
  GROUP BY vdt.city_place_id, vdt.nepali_year, vdt.city_rank, mnm.quater;

-- ----------------------------
-- View structure for view_report_dealer_retail_yearly
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_dealer_retail_yearly" AS 
 SELECT vrd.city_place_id,
    vrd.city_rank,
    vrd.nepali_year,
    sum(vrd.total_retail) AS yearly_retail
   FROM view_report_dealer_retail vrd
  GROUP BY vrd.city_place_id, vrd.nepali_year, vrd.city_rank;

-- ----------------------------
-- View structure for view_report_dealer_sales
-- ----------------------------

-- ----------------------------
-- View structure for view_report_dealer_sales_total
-- ----------------------------


-- ----------------------------
-- View structure for view_report_dealer_target
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_dealer_target" AS 
 SELECT st.target_year,
    st.month,
    dd.city_place_id,
    mcp.name AS city_name,
    sum(st.quantity) AS total_target,
    mst_nepali_month.name AS month_name,
    mst_nepali_month.rank,
    mcp.rank AS city_rank,
    mst_nepali_month.quater,
    st.deleted_at,
    st.dealer_id,
    dms_dealers.name AS dealer_name,
    sum(st.retail_quantity) AS total_retail_target,
    sum(st.inquiry_target) AS total_inquiry_target
   FROM (((((sales_target_records st
     JOIN dms_dealers dd ON ((st.dealer_id = dd.id)))
     JOIN mst_city_places mcp ON ((dd.city_place_id = mcp.id)))
     LEFT JOIN view_report_target_revision_group vrt ON ((((((st.vehicle_id = vrt.vehicle_id) AND (st.dealer_id = vrt.dealer_id)) AND ((st.target_year)::text = (vrt.target_year)::text)) AND (st.month = vrt.month)) AND (st.revision = vrt.revision))))
     JOIN mst_nepali_month ON ((st.month = mst_nepali_month.id)))
     JOIN dms_dealers ON ((st.dealer_id = dms_dealers.id)))
  GROUP BY st.target_year, st.month, dd.city_place_id, mcp.name, mst_nepali_month.name, mst_nepali_month.rank, mcp.rank, mst_nepali_month.quater, st.deleted_at, st.dealer_id, dms_dealers.name;

-- ----------------------------
-- View structure for view_report_dealer_target_cumm_month
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_dealer_target_cumm_month" AS 
 SELECT vrdt.target_year,
    vrdt.city_place_id,
    vrdt.city_name,
    vrdt.quater,
    vrdt.rank,
    vrdt.month,
    vrdt.month_name,
    sum(vrdt.total_target) OVER (PARTITION BY vrdt.city_place_id ORDER BY vrdt.city_rank, vrdt.rank, vrdt.city_place_id) AS cum_total,
    vrdt.city_rank
   FROM view_report_dealer_target vrdt
  GROUP BY vrdt.target_year, vrdt.city_place_id, vrdt.city_name, vrdt.quater, vrdt.rank, vrdt.month, vrdt.month_name, vrdt.city_rank, vrdt.total_target
  ORDER BY vrdt.city_rank, vrdt.rank;

-- ----------------------------
-- View structure for view_report_dealer_target_monthly
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_dealer_target_monthly" AS 
 SELECT vrt.dealer_id,
    vrt.month,
    vrt.target_year,
    sum(vrt.quantity) AS total
   FROM view_report_target vrt
  GROUP BY vrt.dealer_id, vrt.target_year, vrt.month
  ORDER BY vrt.dealer_id, vrt.month;

-- ----------------------------
-- View structure for view_report_dealer_target_quaterly
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_dealer_target_quaterly" AS 
 SELECT vrdt.target_year,
    vrdt.city_place_id,
    vrdt.city_name,
    vrdt.city_rank,
    vrdt.quater,
    sum(vrdt.total_target) AS quaterly_target
   FROM view_report_dealer_target vrdt
  GROUP BY vrdt.target_year, vrdt.city_place_id, vrdt.city_name, vrdt.city_rank, vrdt.quater
  ORDER BY vrdt.city_rank, vrdt.quater;

-- ----------------------------
-- View structure for view_report_dealer_target_yearly
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_dealer_target_yearly" AS 
 SELECT vrt.target_year,
    vrt.city_place_id,
    vrt.city_name,
    vrt.city_rank,
    sum(vrt.quantity) AS total
   FROM view_report_target vrt
  GROUP BY vrt.city_place_id, vrt.target_year, vrt.city_name, vrt.city_rank
  ORDER BY vrt.city_place_id;

-- ----------------------------
-- View structure for view_report_final_dealer_retail
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_final_dealer_retail" AS 
 SELECT vdr.vehicle_id,
    vdr.city_place_id,
    vdr.vehicle_rank,
    vdr.date_of_retail_np,
    vdr.dealer_id,
    vdr.nepali_month,
    vdr.nepali_year,
    vdr.city_rank,
    vdr.total_retail,
    vdc.cum_total_retail,
    vdq.quaterly_dealer_retail,
    vdy.yearly_retail,
    vdr.deleted_at
   FROM (((view_report_dealer_retail vdr
     JOIN view_report_dealer_retail_cum vdc ON (((vdr.city_place_id = vdc.city_place_id) AND (vdr.nepali_month = vdc.nepali_month))))
     JOIN view_report_dealer_retail_quaterly vdq ON (((vdr.city_place_id = vdq.city_place_id) AND (vdr.nepali_year = vdq.nepali_year))))
     JOIN view_report_dealer_retail_yearly vdy ON (((vdr.city_place_id = vdy.city_place_id) AND (vdr.nepali_year = vdy.nepali_year))));


CREATE OR REPLACE VIEW "public"."view_report_final_dealer_target" AS 
 SELECT vrdt.target_year,
    vrdt.month,
    vrdt.city_place_id,
    vrdt.city_name,
    vrdt.month_name,
    vrdt.rank,
    vrdt.city_rank,
    vrdt.quater,
    vrdt.total_target,
    vrdm.cum_total,
    view_report_dealer_target_quaterly.quaterly_target,
    view_report_dealer_target_yearly.total AS yearly_target
   FROM (((view_report_dealer_target_cumm_month vrdm
     JOIN view_report_dealer_target vrdt ON ((((((((((vrdt.target_year)::text = (vrdm.target_year)::text) AND (vrdt.city_place_id = vrdm.city_place_id)) AND (vrdt.quater = vrdm.quater)) AND (vrdt.city_rank = vrdm.city_rank)) AND (vrdt.rank = vrdm.rank)) AND ((vrdt.month_name)::text = (vrdm.month_name)::text)) AND ((vrdt.city_name)::text = (vrdm.city_name)::text)) AND (vrdt.month = vrdm.month))))
     JOIN view_report_dealer_target_quaterly ON (((((((vrdt.target_year)::text = (view_report_dealer_target_quaterly.target_year)::text) AND (vrdt.quater = view_report_dealer_target_quaterly.quater)) AND (vrdt.city_place_id = view_report_dealer_target_quaterly.city_place_id)) AND ((vrdt.city_name)::text = (view_report_dealer_target_quaterly.city_name)::text)) AND (vrdt.city_rank = view_report_dealer_target_quaterly.city_rank))))
     JOIN view_report_dealer_target_yearly ON ((((((vrdt.target_year)::text = (view_report_dealer_target_yearly.target_year)::text) AND (vrdt.city_place_id = view_report_dealer_target_yearly.city_place_id)) AND ((vrdt.city_name)::text = (view_report_dealer_target_yearly.city_name)::text)) AND (vrdt.city_rank = view_report_dealer_target_yearly.city_rank))));


CREATE OR REPLACE VIEW "public"."view_report_fmsabc" AS 
 SELECT abc.part_name,
    fms.fms,
    abc.abc,
    concat(fms.fms, abc.abc) AS fmsabc,
    abc.part_code,
    abc.price,
    abc.total AS total_dispatched,
    abc.total_cost,
    abc.percentage AS percentage_abc,
    fms.percentage AS percentage_fms,
    abc.deleted_at,
    abc.stockyard_id,
    abc.latest_part_code,
    abc.quantity
   FROM (view_abc abc
     JOIN view_fms fms ON ((((abc.stock_id = fms.stock_id) AND ((abc.part_name)::text = (fms.part_name)::text)) AND (abc.sparepart_id = fms.sparepart_id))));

-- ----------------------------
-- View structure for view_report_grouped_jobcard
-- ----------------------------

-- ----------------------------
-- View structure for view_report_grouped_outsidework
-- ----------------------------

-- ----------------------------
-- View structure for view_report_inquiry_history_
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_inquiry_history_" AS 
 SELECT view_customers.id,
    view_customers.inquiry_no,
    view_customers.fiscal_year_id,
    view_customers.inquiry_date_en,
    view_customers.inquiry_date_np,
    view_customers.inquiry_kind,
    view_customers.customer_type_id,
    view_customers.first_name,
    view_customers.middle_name,
    view_customers.last_name,
    view_customers.exchange_car_make,
    view_customers.exchange_car_model,
    view_customers.exchange_car_year,
    view_customers.exchange_car_kms,
    view_customers.exchange_car_value,
    view_customers.exchange_car_bonus,
    view_customers.exchange_total_offer,
    view_customers.full_name,
    view_customers.customer_type_name,
    view_customers.executive_name,
    view_customers.dealer_name,
    view_customers.source_name,
    view_customers.status_date,
    view_customers.booked_date,
    view_customers.sale_booked_date_np,
    view_customers.sale_booked_date_np_month,
    view_customers.vehicle_delivery_date_np,
    view_customers.booking_canceled,
    view_customers.vehicle_make_year,
    view_customers.vehicle_delivery_date,
    view_customers.sale_booked_date_year,
    view_customers.variant_name,
    view_customers.vehicle_name,
    view_customers.color_name,
    view_customers.source_id,
    view_customers.deleted_by,
    view_customers.deleted_at,
    crm_vehicle_edit.prev_vehicle,
    crm_vehicle_edit.prev_variant,
    crm_vehicle_edit.prev_color,
    crm_vehicle_edit.new_vehicle,
    crm_vehicle_edit.new_variant,
    crm_vehicle_edit.new_color,
    crm_vehicle_edit.status_id,
    mst_inquiry_statuses.name AS status_name_new,
    v1.name AS prev_color_name,
    v2.name AS new_color_name,
    v3.name AS prev_variant_name,
    v4.name AS new_variant_name,
    v5.name AS prev_vehicle_name,
    v6.name AS new_vehicle_name
   FROM ((((((((view_customers
     LEFT JOIN crm_vehicle_edit ON ((view_customers.id = crm_vehicle_edit.customer_id)))
     LEFT JOIN mst_inquiry_statuses ON ((crm_vehicle_edit.status_id = mst_inquiry_statuses.id)))
     LEFT JOIN mst_colors v1 ON ((crm_vehicle_edit.prev_color = v1.id)))
     LEFT JOIN mst_colors v2 ON ((crm_vehicle_edit.new_color = v2.id)))
     LEFT JOIN mst_variants v3 ON ((crm_vehicle_edit.prev_variant = v3.id)))
     LEFT JOIN mst_variants v4 ON ((crm_vehicle_edit.new_variant = v4.id)))
     LEFT JOIN mst_vehicles v5 ON ((crm_vehicle_edit.prev_vehicle = v5.id)))
     LEFT JOIN mst_vehicles v6 ON ((crm_vehicle_edit.new_vehicle = v6.id)));

-- ----------------------------
-- View structure for view_report_inquiry_status
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_inquiry_status" AS 
 SELECT mst_inquiry_statuses.name AS status_name_new,
    view_customer_refined.id,
    view_customer_refined.deleted_by,
    view_customer_refined.deleted_at,
    view_customer_refined.inquiry_no,
    view_customer_refined.inquiry_date_en,
    view_customer_refined.inquiry_date_np,
    view_customer_refined.customer_type_id,
    view_customer_refined.source_id,
    view_customer_refined.exchange_car_make,
    view_customer_refined.exchange_car_model,
    view_customer_refined.exchange_car_year,
    view_customer_refined.exchange_car_kms,
    view_customer_refined.exchange_car_value,
    view_customer_refined.exchange_car_bonus,
    view_customer_refined.exchange_total_offer,
    view_customer_refined.full_name,
    view_customer_refined.dealer_name,
    view_customer_refined.executive_name,
    view_customer_refined.source_name,
    view_customer_refined.status_name,
    view_customer_refined.status_date,
    view_customer_refined.vehicle_name,
    view_customer_refined.variant_name,
    view_customer_refined.color_name,
    view_customer_refined.booking_canceled,
    view_customer_refined.vehicle_delivery_date,
    view_customer_refined.booked_date,
    view_customer_refined.vehicle_make_year
   FROM ((dms_customer_statuses
     LEFT JOIN mst_inquiry_statuses ON ((dms_customer_statuses.status_id = mst_inquiry_statuses.id)))
     LEFT JOIN view_customer_refined ON ((view_customer_refined.id = dms_customer_statuses.customer_id)));

-- ----------------------------
-- View structure for view_report_log_credit_control_delay
-- ----------------------------

-- ----------------------------
-- View structure for view_report_logistic_stock_status
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_logistic_stock_status" AS 
 SELECT vrs.vehicle_id,
    vrs.variant_id,
    vrs.vehicle_name,
    vrs.variant_name,
    concat(vrs.vehicle_name, ' ', vrs.variant_name) AS vehicle,
    vrs.rank,
    vrs.stock_count,
    COALESCE(vras.avg_sales, (0)::numeric) AS avg_sales,
        CASE
            WHEN ((vrs.stock_count)::numeric > COALESCE(vras.avg_sales, (0)::numeric)) THEN 'Excess'::text
            ELSE 'Shortfall'::text
        END AS stock_status,
    vras.deleted_at
   FROM (view_report_stock_records vrs
     LEFT JOIN view_report_avg_sales vras ON ((((vrs.vehicle_name)::text = (vras.vehicle_name)::text) AND ((vrs.variant_name)::text = (vras.variant_name)::text))))
  ORDER BY vrs.rank;



CREATE OR REPLACE VIEW "public"."view_report_spareparts_req_vs_result_Summary" AS 
 SELECT spd.name,
    spd.address_1,
    spd.address_2,
    rvr.req_price,
    rvr.dispatch_price,
    (rvr.req_price - rvr.dispatch_price) AS pending_amount,
    rvr.req_quantity,
    rvr.dispatch_qty,
    ((rvr.req_quantity)::numeric - rvr.dispatch_qty) AS pending_qty,
    round(((rvr.dispatch_qty / (rvr.req_quantity)::numeric) * (100)::numeric), 2) AS service,
    rvr.request_date_np_year,
    rvr.request_date_np_month,
    rvr.count_request,
    rvr.count_dispatched,
    rvr.count_service_level,
    rvr.request_date,
    spd.id AS dealer_id,
    round(((rvr.dispatch_price / rvr.req_price) * (100)::numeric), 2) AS amount
   FROM (dms_dealers spd
     LEFT JOIN ( SELECT view_report_spareparts_requirements_vs_results.dealer_id,
            COALESCE(sum(view_report_spareparts_requirements_vs_results.req_quantity), (0)::bigint) AS req_quantity,
            COALESCE(sum(view_report_spareparts_requirements_vs_results.unit_price), (0)::numeric) AS unit_price,
            COALESCE(sum(view_report_spareparts_requirements_vs_results.req_price), (0)::numeric) AS req_price,
            COALESCE(sum(view_report_spareparts_requirements_vs_results.pending_qty), (0)::numeric) AS pending_qty,
            COALESCE(sum(view_report_spareparts_requirements_vs_results.dispatch_qty), (0)::numeric) AS dispatch_qty,
            COALESCE(sum(view_report_spareparts_requirements_vs_results.dispatch_price), (0)::numeric) AS dispatch_price,
            COALESCE(sum(view_report_spareparts_requirements_vs_results.vat), (0)::numeric) AS vat,
            COALESCE(sum(view_report_spareparts_requirements_vs_results.net_amount), (0)::numeric) AS net_amount,
            view_report_spareparts_requirements_vs_results.request_date_np_year,
            view_report_spareparts_requirements_vs_results.request_date_np_month,
            count(view_report_spareparts_requirements_vs_results.part_number) AS count_request,
            count(view_report_spareparts_requirements_vs_results.dispatch_qty) AS count_dispatched,
            (((count(view_report_spareparts_requirements_vs_results.dispatch_qty))::double precision / (count(view_report_spareparts_requirements_vs_results.part_number))::double precision) * (100)::double precision) AS count_service_level,
            view_report_spareparts_requirements_vs_results.request_date
           FROM view_report_spareparts_requirements_vs_results
          GROUP BY view_report_spareparts_requirements_vs_results.dealer_id, view_report_spareparts_requirements_vs_results.request_date_np_year, view_report_spareparts_requirements_vs_results.request_date_np_month, view_report_spareparts_requirements_vs_results.request_date) rvr ON ((rvr.dealer_id = spd.id)))
  WHERE (spd.parent_id = 0);

-- ----------------------------
-- View structure for view_report_spareparts_requirements_vs_results
-- ----------------------------

-- ----------------------------
-- View structure for view_report_spareparts_sales
-- ----------------------------

-- ----------------------------
-- View structure for view_report_stock_count_yearly
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_report_stock_count_yearly" AS 
 SELECT view_stock_details.year,
    count(*) AS stock_count,
    view_stock_details.deleted_at
   FROM view_stock_details
  WHERE (((((view_stock_details.current_status)::text = 'Stock'::text) OR ((view_stock_details.current_status)::text = 'repaired stock'::text)) OR ((view_stock_details.current_status)::text = 'Display'::text)) OR ((view_stock_details.current_status)::text = 'damage'::text))
  GROUP BY view_stock_details.year, view_stock_details.deleted_at;

-- ----------------------------
-- View structure for view_report_stock_record
-- ----------------------------

-- ----------------------------
-- View structure for view_report_target
-- ----------------------------

-- ----------------------------
-- View structure for view_report_target_revision_group
-- ----------------------------

-- ----------------------------
-- View structure for view_report_vehicle_inquiry_status
-- ----------------------------

-- ----------------------------
-- View structure for view_retail_finance
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_retail_finance" AS 
 SELECT ir.id,
    ir.created_by,
    ir.updated_by,
    ir.deleted_by,
    ir.created_at,
    ir.updated_at,
    ir.deleted_at,
    ir.inquiry_no,
    ir.fiscal_year_id,
    ir.inquiry_date_en,
    ir.inquiry_date_np,
    ir.inquiry_kind,
    ir.customer_type_id,
    ir.first_name,
    ir.middle_name,
    ir.last_name,
    ir.gender,
    ir.marital_status,
    ir.family_size,
    ir.age,
    ir.dob_en,
    ir.dob_np,
    ir.anniversary_en,
    ir.anniversary_np,
    ir.district_id,
    ir.mun_vdc_id,
    ir.address_1,
    ir.address_2,
    ir.email,
    ir.home_1,
    ir.home_2,
    ir.work_1,
    ir.work_2,
    ir.mobile_1,
    ir.mobile_2,
    ir.pref_communication,
    ir.occupation_id,
    ir.education_id,
    ir.dealer_id,
    ir.executive_id,
    ir.payment_mode_id,
    ir.source_id,
    ir.status_id,
    ir.contact_1_name,
    ir.contact_1_mobile,
    ir.contact_1_relation_id,
    ir.contact_2_name,
    ir.contact_2_mobile,
    ir.contact_2_relation_id,
    ir.remarks,
    ir.vehicle_id,
    ir.variant_id,
    ir.color_id,
    ir.walkin_source_id,
    ir.event_id,
    ir.institution_id,
    ir.exchange_car_make,
    ir.exchange_car_model,
    ir.exchange_car_year,
    ir.exchange_car_kms,
    ir.exchange_car_value,
    ir.exchange_car_bonus,
    ir.exchange_total_offer,
    ir.bank_id,
    ir.bank_branch,
    ir.bank_staff,
    ir.bank_contact,
    ir.full_name,
    ir.fiscal_year,
    ir.customer_type_name,
    ir.customer_type_rank,
    ir.zone_name,
    ir.district_name,
    ir.mun_vdc_name,
    ir.occupation_name,
    ir.education_name,
    ir.dealer_name,
    ir.executive_name,
    ir.payment_mode_name,
    ir.source_name,
    ir.source_rank,
    ir.actual_status_name,
    ir.actual_status_rank,
    ir.status_name,
    ir.status_rank,
    ir.status_date,
    ir.reason_name,
    ir.contact_1_relation_name,
    ir.contact_2_relation_name,
    ir.vehicle_name,
    ir.vehicle_rank,
    ir.variant_name,
    ir.color_name,
    ir.walkin_source_name,
    ir.event_name,
    ir.institution_name,
    ir.bank_name,
    ir.test_drive,
    ir.inquiry_type,
    ir.age_group,
    csd.customer_id,
    csd.status_1,
    csd.status_2,
    csd.status_3,
    csd.status_4,
    csd.status_5,
    csd.status_6,
    csd.status_7,
    csd.status_8,
    csd.status_9,
    csd.status_10,
    csd.status_11,
    csd.status_12,
    csd.status_13,
    csd.status_14,
    csd.status_15,
    csd.status_16,
    csd.status_17,
    csd.status_18
   FROM (view_inquiry_retail ir
     JOIN view_customer_status_dates csd ON (((ir.id = csd.customer_id) AND (ir.payment_mode_id = 2))));

-- ----------------------------
-- View structure for view_retail_report
-- ----------------------------


-- ----------------------------
-- View structure for view_sales_booking_cancel_refined
-- ----------------------------

-- ----------------------------
-- View structure for view_sales_discount_schemes
-- ----------------------------

-- ----------------------------
-- View structure for view_sales_report
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sales_report" AS 
 SELECT svp.created_by,
    svp.customer_id,
    svp.msil_dispatch_id,
    vc.mun_vdc_id,
    vc.district_id,
    vc.dealer_id,
    vc.executive_id,
    vc.vehicle_id,
    vc.color_id,
    vc.variant_id,
    vc.zone_name,
    vc.district_name,
    vc.mun_vdc_name,
    vc.dealer_name,
    vc.executive_name,
    vc.status_name,
    vc.vehicle_name,
    vc.variant_name,
    vc.color_name,
    vc.event_name,
    vc.walkin_source_name,
    vc.actual_status_rank,
    vc.actual_status_name,
    vc.source_name,
    vc.source_rank,
    vc.full_name,
    vc.walkin_source_id,
    vc.event_id,
    svp.created_at,
    to_date(to_char(svp.created_at, 'yyyy/mm/dd'::text), 'yyyy/mm/dd'::text) AS created_date,
    date_part('month'::text, svp.created_at) AS month,
    vc.parent_id,
    vdm.id,
    vdm.parent_name,
    date_part('year'::text, svp.created_at) AS year,
        CASE
            WHEN (date_part('month'::text, svp.created_at) = (1)::double precision) THEN 'JAN'::text
            WHEN (date_part('month'::text, svp.created_at) = (2)::double precision) THEN 'FEB'::text
            WHEN (date_part('month'::text, svp.created_at) = (3)::double precision) THEN 'MAR'::text
            WHEN (date_part('month'::text, svp.created_at) = (4)::double precision) THEN 'APR'::text
            WHEN (date_part('month'::text, svp.created_at) = (5)::double precision) THEN 'MAY'::text
            WHEN (date_part('month'::text, svp.created_at) = (6)::double precision) THEN 'JUN'::text
            WHEN (date_part('month'::text, svp.created_at) = (7)::double precision) THEN 'JUL'::text
            WHEN (date_part('month'::text, svp.created_at) = (8)::double precision) THEN 'AUG'::text
            WHEN (date_part('month'::text, svp.created_at) = (9)::double precision) THEN 'SEP'::text
            WHEN (date_part('month'::text, svp.created_at) = (10)::double precision) THEN 'OCT'::text
            WHEN (date_part('month'::text, svp.created_at) = (11)::double precision) THEN 'NOV'::text
            WHEN (date_part('month'::text, svp.created_at) = (12)::double precision) THEN 'DEC'::text
            ELSE NULL::text
        END AS month_name,
    lsr.dispatched_date AS retail_date,
    lsr.dispatched_date_np_month AS date_of_retail_np_month,
    lsr.dispatched_date_np_year,
    lsr.dispatched_date_np AS date_of_retail_np,
    svp.deleted_at
   FROM (((sales_vehicle_process svp
     LEFT JOIN view_customers vc ON ((svp.customer_id = vc.id)))
     LEFT JOIN view_district_mvs vdm ON ((vc.parent_id = vdm.id)))
     LEFT JOIN log_stock_records lsr ON ((svp.msil_dispatch_id = lsr.vehicle_id)));

-- ----------------------------
-- View structure for view_sales_summary
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sales_summary" AS 
 SELECT jobcard.deleted_at,
    sum(billing_parts.quantity) AS quantity,
    sum((((billing_parts.price * (billing_parts.quantity)::double precision) * billing_parts.discount_percentage) / (100)::double precision)) AS discount_amount,
    sum((billing_parts.price * (billing_parts.quantity)::double precision)) AS taxable,
    sum((billing_parts.final_amount * (0.13)::double precision)) AS vat_amount,
    sum(COALESCE(unwar.uw_amount, (0)::real)) AS uw_amount,
    ((sum((billing_parts.price * (billing_parts.quantity)::double precision)) + COALESCE(sum((billing_parts.final_amount * (0.13)::double precision)), (0)::double precision)) - COALESCE(sum(unwar.uw_amount), (0)::real)) AS net_amount,
    billing_parts.dealer_id,
    s_category.name AS category_name,
    sum(billing_parts.cash_discount_amt) AS cash_discount,
    jobcard.job_card_issue_date
   FROM ((((view_report_grouped_jobcard jobcard
     JOIN view_service_billing_parts billing_parts ON ((jobcard.jobcard_group = billing_parts.jobcard_group)))
     JOIN mst_spareparts sparepart ON ((billing_parts.part_id = sparepart.id)))
     JOIN mst_spareparts_category s_category ON ((sparepart.category_id = s_category.id)))
     LEFT JOIN ( SELECT sp.category_id,
            pa.warranty,
            sum(pa.final_amount) AS uw_amount
           FROM ((ser_parts pa
             JOIN mst_spareparts sp ON ((pa.part_id = sp.id)))
             JOIN mst_spareparts_category cat ON ((sp.category_id = cat.id)))
          WHERE (pa.warranty IS NOT NULL)
          GROUP BY pa.warranty, sp.category_id) unwar ON ((unwar.category_id = sparepart.category_id)))
  GROUP BY jobcard.job_card_issue_date, jobcard.deleted_at, billing_parts.category_id, billing_parts.dealer_id, s_category.name;

-- ----------------------------
-- View structure for view_sales_target_records
-- ----------------------------

-- ----------------------------
-- View structure for view_service_history_job_card
-- ----------------------------

-- ----------------------------
-- View structure for view_service_job_card
-- ----------------------------

-- ----------------------------
-- View structure for view_service_parts
-- ----------------------------

-- ----------------------------
-- View structure for view_service_user_group
-- ----------------------------

-- ----------------------------
-- View structure for view_smr_2nd_days
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_smr_2nd_days" AS 
 SELECT ccd.id,
    ccd.created_by,
    ccd.updated_by,
    ccd.deleted_by,
    ccd.customer_id,
    ccd.call_status,
    ccd.date_of_call,
    ccd.date_of_call_np,
    ccd.appointment_taken,
    ccd.appointment_date,
    ccd.remark,
    ccd.created_at,
    ccd.updated_at,
    ccd.deleted_at,
    ccd.schedule_date,
    ccd.call_type,
    ccd.false_reason,
    ccd.call_count,
    c.inquiry_no,
    c.full_name,
    c.mobile_1,
    c.customer_type_name,
    c.dealer_name,
    c.executive_name,
    c.payment_mode_name,
    c.vehicle_name,
    c.variant_name,
    c.color_name,
    c.vehicle_delivery_date,
    c.engine_no,
    c.chass_no,
    (('now'::text)::date - ccd.schedule_date) AS age
   FROM (ccd_2nd_smr_days ccd
     LEFT JOIN view_customers c ON ((ccd.customer_id = c.id)));

-- ----------------------------
-- View structure for view_sp_msil_remaining_quantity
-- ----------------------------

-- ----------------------------
-- View structure for view_sparepart_grouped_msil_order
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_sparepart_grouped_msil_order" AS 
 SELECT view_spareparts_msil_order.final_order_no,
    view_spareparts_msil_order.date,
    view_spareparts_msil_order.order_no,
    view_spareparts_msil_order.order_type,
    view_spareparts_msil_order.deleted_at
   FROM view_spareparts_msil_order
  GROUP BY view_spareparts_msil_order.date, view_spareparts_msil_order.final_order_no, view_spareparts_msil_order.order_type, view_spareparts_msil_order.order_no, view_spareparts_msil_order.deleted_at;

-- ----------------------------
-- View structure for view_sparepart_picklist
-- ----------------------------

-- ----------------------------
-- View structure for view_spareparts_dealer_claim
-- ----------------------------

-- ----------------------------
-- View structure for view_spareparts_mechanic
-- ----------------------------

-- ----------------------------
-- View structure for view_spareparts_msil_aging
-- ----------------------------

-- ----------------------------
-- View structure for view_spareparts_register
-- ----------------------------

-- ----------------------------
-- View structure for view_spareparts_shipment_monitor
-- ----------------------------

-- ----------------------------
-- View structure for view_stock_all
-- ----------------------------

-- ----------------------------
-- View structure for view_test_drive_conversion_ratio
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_test_drive_conversion_ratio" AS 
 SELECT c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    c.inquiry_no,
    c.fiscal_year_id,
    c.inquiry_date_en,
    c.inquiry_date_np,
    c.inquiry_kind,
    c.customer_type_id,
    c.first_name,
    c.middle_name,
    c.last_name,
    c.gender,
    c.marital_status,
    c.family_size,
    c.age,
    c.dob_en,
    c.dob_np,
    c.anniversary_en,
    c.anniversary_np,
    c.district_id,
    c.mun_vdc_id,
    c.address_1,
    c.address_2,
    c.email,
    c.home_1,
    c.home_2,
    c.work_1,
    c.work_2,
    c.mobile_1,
    c.mobile_2,
    c.pref_communication,
    c.occupation_id,
    c.education_id,
    c.dealer_id,
    c.executive_id,
    c.payment_mode_id,
    c.source_id,
    c.status_id,
    c.contact_1_name,
    c.contact_1_mobile,
    c.contact_1_relation_id,
    c.contact_2_name,
    c.contact_2_mobile,
    c.contact_2_relation_id,
    c.remarks,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    c.walkin_source_id,
    c.event_id,
    c.institution_id,
    c.exchange_car_make,
    c.exchange_car_model,
    c.exchange_car_year,
    c.exchange_car_kms,
    c.exchange_car_value,
    c.exchange_car_bonus,
    c.exchange_total_offer,
    c.bank_id,
    c.bank_branch,
    c.bank_staff,
    c.bank_contact,
    c.full_name,
    c.fiscal_year,
    c.customer_type_name,
    c.customer_type_rank,
    c.zone_name,
    c.district_name,
    c.mun_vdc_name,
    c.occupation_name,
    c.education_name,
    c.dealer_name,
    c.executive_name,
    c.payment_mode_name,
    c.source_name,
    c.source_rank,
    c.actual_status_name,
    c.actual_status_rank,
    c.status_name,
    c.status_rank,
    c.status_date,
    c.reason_name,
    c.contact_1_relation_name,
    c.contact_2_relation_name,
    c.vehicle_name,
    c.vehicle_rank,
    c.variant_name,
    c.color_name,
    c.walkin_source_name,
    c.event_name,
    c.institution_name,
    c.bank_name,
    c.test_drive,
    c.inquiry_type
   FROM view_customers c
  WHERE ((c.status_id = 15) AND (c.test_drive = 'TAKEN'::text));

-- ----------------------------
-- View structure for view_test_drive_latest_niroj
-- ----------------------------

-- ----------------------------
-- View structure for view_user_groups
-- ----------------------------

-- ----------------------------
-- View structure for view_user_permissions
-- ----------------------------

-- ----------------------------
-- View structure for view_vehicle_process
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_vehicle_process" AS 
 SELECT c.id,
    c.created_by,
    c.updated_by,
    c.deleted_by,
    c.created_at,
    c.updated_at,
    c.deleted_at,
    c.first_name,
    c.middle_name,
    c.last_name,
    c.payment_mode_id,
    c.vehicle_id,
    c.variant_id,
    c.color_id,
    sv.customer_id,
    sv.booked_date,
    sv.booking_receipt_no,
    sv.booking_amount,
    sv.booking_receipt_image,
    sv.quotation_image,
    sv.quotation_issue_date,
    sv.vehicle_details_image,
    sv.do_image,
    sv.do_received_date,
    sv.downpayment_receipt_image,
    sv.downpayment_receipt_no,
    sv.downpayment_amount,
    sv.downpayment_date,
    sv.deliverysheet_image,
    sv.vehicle_delivery_date,
    sv.creditnote_image,
    sv.bluebook_image,
    sv.bluebook_received_date,
    sv.insurance_no,
    sv.insurance_date,
    sv.vat_bill_no,
    sv.vat_bill_created_date,
    sv.vat_bill_image,
    v1.name AS vehicle_name,
    v2.name AS variant_name,
    ((((v3.name)::text || ' ('::text) || (v3.code)::text) || ')'::text) AS color_name,
    v4.name AS payment_mode_name,
    sv.fullpayment_receipt_image,
    sv.fullpayment_receipt_no,
    sv.fullpayment_amount,
    sv.fullpayment_date,
    sv.msil_dispatch_id,
    sv.id AS vehicle_process_id,
    ms.engine_no,
    ms.chass_no,
    ms.year,
    c.mobile_1,
    c.address_1,
    c.mun_vdc_id AS vdc_name,
    c.booking_canceled,
    q.quote_price,
    q.quote_mrp,
    q.quote_discount,
    q.quote_unit,
    c.bank_id,
    c.bank_branch,
    c.bank_staff,
    c.bank_contact,
        CASE
            WHEN ((c.middle_name)::text <> ''::text) THEN (((((c.first_name)::text || ' '::text) || (c.middle_name)::text) || ' '::text) || (c.last_name)::text)
            ELSE (((c.first_name)::text || ' '::text) || (c.last_name)::text)
        END AS full_name,
    mb.name AS bank_name,
    sv.insurance_received_date,
    sv.insurance_image,
    sv.discount_amount,
    c.dealer_id,
    dms_dealers.name,
    c.discount_amount AS customer_discount_amount,
    view_dms_vehicles.price,
    v1.firm_id,
    ms.company_name AS firm,
    view_district_mvs.name AS city_name,
    sales_discount_limit.staff_limit AS normal_discount,
        CASE
            WHEN (sv.vehicle_delivery_date IS NULL) THEN 'Not Delivered'::text
            ELSE 'Delivered'::text
        END AS delivery_sheet_status,
    c.contact_1_name,
    c.contact_1_mobile,
    dms_dealers.address_1 AS dealer_address1,
    dms_dealers.email AS dealer_email,
    dms_dealers.phone_1 AS dealer_phone_1,
    dms_dealers.phone_2 AS dealer_phone_2,
    dms_dealers.fax AS dealer_fax,
    dms_dealers.address_2 AS dealer_address_2,
    vd.name AS dealer_district_name,
    vcp.name AS dealer_city_name,
    c.inquiry_no,
    c.special_discount_amount
   FROM (((((((((((((((dms_customers c
     JOIN mst_vehicles v1 ON ((c.vehicle_id = v1.id)))
     JOIN mst_variants v2 ON ((c.variant_id = v2.id)))
     JOIN mst_colors v3 ON ((c.color_id = v3.id)))
     LEFT JOIN mst_payment_modes v4 ON ((c.payment_mode_id = v4.id)))
     LEFT JOIN sales_vehicle_process sv ON ((c.id = sv.customer_id)))
     LEFT JOIN msil_dispatch_records ms ON ((sv.msil_dispatch_id = ms.id)))
     LEFT JOIN view_quotations q ON ((c.id = q.customer_id)))
     LEFT JOIN mst_banks mb ON ((c.bank_id = mb.id)))
     LEFT JOIN dms_dealers ON ((c.dealer_id = dms_dealers.id)))
     LEFT JOIN view_dms_vehicles ON ((((c.vehicle_id = view_dms_vehicles.vehicle_id) AND (c.variant_id = view_dms_vehicles.variant_id)) AND (c.color_id = view_dms_vehicles.color_id))))
     JOIN mst_firms ON ((v1.firm_id = mst_firms.id)))
     LEFT JOIN view_district_mvs ON ((c.mun_vdc_id = view_district_mvs.id)))
     LEFT JOIN sales_discount_limit ON (((c.vehicle_id = sales_discount_limit.vehicle_id) AND (c.variant_id = sales_discount_limit.variant_id))))
     LEFT JOIN view_district_mvs vd ON ((dms_dealers.district_id = vd.id)))
     LEFT JOIN view_city_places vcp ON ((dms_dealers.city_place_id = vcp.id)));


CREATE OR REPLACE VIEW "public"."view_dashboard_act_tar_inquiry_dealerwise" AS 
 SELECT vrdt.target_year,
    vrdt.month,
    vrdt.city_place_id,
    vrdt.month_name,
    vrdt.rank,
    vrdt.dealer_name,
    vrdt.total_inquiry_target,
    vrdt.deleted_at,
    vrdt.dealer_id,
    vrdt.city_name,
    COALESCE(vdi.total_inquiry, (0)::bigint) AS total_inquiry
   FROM (view_report_dealer_target vrdt
     LEFT JOIN view_dashboard_dealerwise_inquiry vdi ON (((((vrdt.target_year)::text = vdi.fiscal_year) AND (vrdt.month = (vdi.nepali_month)::integer)) AND (vrdt.dealer_id = vdi.dealer_id))));

-- ----------------------------
-- View structure for view_dashboard_act_tar_inquiry_modelwise
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dashboard_act_tar_inquiry_modelwise" AS 
 SELECT vdmt.target_year,
    vdmt.month,
    vdmt.vehicle_id,
    vdmt.deleted_at,
    vdmt.vehicle_name,
    vdmt.vehicle_rank,
    vdmt.total_inquiry_target,
    vd.total_inquiry,
    mst_nepali_month.name AS nepali_month,
    mst_nepali_month.rank AS month_rank
   FROM ((view_dashboard_modelwise_target vdmt
     LEFT JOIN view_dashboard_modelwise_inquiry vd ON (((((vdmt.target_year)::text = vd.fiscal_year) AND (vdmt.month = (vd.nepali_month)::integer)) AND (vdmt.vehicle_id = vd.vehicle_id))))
     LEFT JOIN mst_nepali_month ON ((vdmt.month = mst_nepali_month.id)));


CREATE OR REPLACE VIEW "public"."view_dashboard_tar_act_retail_dealerwise" AS 
 SELECT vt.target_year,
    vt.month,
    vt.month_name,
    vt.rank,
    vt.deleted_at,
    vt.dealer_name,
    vt.dealer_id,
    vt.total_target,
    COALESCE(vr.total_retail, (0)::bigint) AS total_retail,
    vt.total_retail_target
   FROM (view_report_dealer_target vt
     LEFT JOIN view_dashboard_monthly_retail_dealerwise vr ON ((((vt.dealer_id = vr.dealer_id) AND (vt.month = (vr.dispatched_date_np_month)::integer)) AND ((vt.target_year)::text = (vr.retail_fiscal_year)::text))))
  ORDER BY vt.rank;

-- ----------------------------
-- View structure for view_dashboard_tar_act_retail_modelwise
-- ----------------------------

-- ----------------------------
-- View structure for view_dashboard_target_actual_dealerwise
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dashboard_target_actual_dealerwise" AS 
 SELECT vrdt.target_year,
    vrdt.month,
    vrdt.city_place_id,
    vrdt.city_name,
    vrdt.total_target,
    vrdt.month_name,
    vrdt.rank,
    vrdt.city_rank,
    vrdt.quater,
    vrdt.deleted_at,
    vrdt.dealer_id,
    vrdt.dealer_name,
    COALESCE(vds.total_bill, (0)::bigint) AS total_bill
   FROM (view_report_dealer_target vrdt
     LEFT JOIN view_dashboard_monthly_sales vds ON (((((vrdt.target_year)::text = (vds.fiscal_year)::text) AND (vrdt.month = vds.edit_month_np)) AND (vrdt.dealer_id = vds.dealer_id))));

-- ----------------------------
-- View structure for view_dashboard_target_actual_modelwise
-- ----------------------------
CREATE OR REPLACE VIEW "public"."view_dashboard_target_actual_modelwise" AS 
 SELECT view_dashboard_modelwise_target.target_year,
    view_dashboard_modelwise_target.month,
    view_dashboard_modelwise_target.vehicle_id,
    view_dashboard_modelwise_target.deleted_at,
    view_dashboard_modelwise_target.vehicle_name,
    view_dashboard_modelwise_target.vehicle_rank,
    view_dashboard_modelwise_target.total_target,
    COALESCE(view_dashboard_monthlysales_modelwise.total_bill, (0)::bigint) AS total_bill,
    mst_nepali_month.name AS month_name,
    mst_nepali_month.rank AS month_rank,
    view_dashboard_modelwise_target.segment_name
   FROM ((view_dashboard_modelwise_target
     LEFT JOIN view_dashboard_monthlysales_modelwise ON (((((view_dashboard_modelwise_target.target_year)::text = (view_dashboard_monthlysales_modelwise.fiscal_year)::text) AND (view_dashboard_modelwise_target.month = view_dashboard_monthlysales_modelwise.edit_month_np)) AND (view_dashboard_modelwise_target.vehicle_id = view_dashboard_monthlysales_modelwise.vehicle_id))))
     LEFT JOIN mst_nepali_month ON ((view_dashboard_modelwise_target.month = mst_nepali_month.id)))
  ORDER BY mst_nepali_month.rank;


CREATE OR REPLACE VIEW "public"."view_driver_detail" AS 
 SELECT d.id,
    v.vehicle_name,
    v.variant_name,
    v.color_name,
    v.color_code,
    v.engine_no,
    v.chass_no,
    v.stock_yard,
    v.barcode,
    v.longitude,
    v.latitude,
    v.stock_id,
    v.city_name,
    v.mun_vdc_name,
    v.district_name,
    v.dealer_name,
    v.mst_color_id,
    v.mst_variant_id,
    v.mst_vehicle_id,
    v.stockyaard_dealer,
    v.current_status,
    v.current_location,
    v.is_damage,
    v.dealer_reject,
    d.driver_name,
    d.driver_number,
    d.driver_address,
    d.source,
    d.destination,
    d.photo,
    d.license_no,
    v.dispatched_date,
    v.reached_date,
    v.vehicle_id,
    v.stock_yard_id,
    v.stock_vehicle_id,
    d.challan_date,
    v.company_name
   FROM (driver_details d
     JOIN view_log_stock_record v ON ((d.id = v.driver_id)));


CREATE OR REPLACE VIEW "public"."view_final_target_vs_achievement" AS 
 SELECT vrft.target_year,
    vrft.month,
    vrft.city_place_id,
    vrft.city_name,
    vrft.month_name,
    vrft.rank,
    vrft.city_rank,
    vrft.quater,
    vrft.total_target,
    vrft.cum_total,
    vrft.quaterly_target,
    vrft.yearly_target,
    vrfr.cum_total_retail,
    vrfr.total_retail,
    vrfr.quaterly_dealer_retail,
    vrfr.yearly_retail,
    vrfr.date_of_retail_np,
    vrfr.nepali_year,
    vrfr.deleted_at
   FROM (view_report_final_dealer_target vrft
     LEFT JOIN view_report_final_dealer_retail vrfr ON (((vrft.city_place_id = vrfr.city_place_id) AND ((vrft.month)::double precision = vrfr.nepali_month))))
  ORDER BY vrft.city_rank, vrft.rank;