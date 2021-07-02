--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: dms_customer_test_drives; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE dms_customer_test_drives (
    id integer NOT NULL,
    created_by integer,
    updated_by integer,
    deleted_by integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone,
    customer_id integer,
    td_date_en date,
    td_date_np character varying(255),
    td_time time without time zone,
    executive_id integer,
    vehicle_id integer,
    variant_id integer,
    mileage_start character varying(255),
    mileage_end character varying(255),
    duration character varying(255),
    td_location character varying(255)
);


ALTER TABLE dms_customer_test_drives OWNER TO postgres;

--
-- Name: dms_customer_test_drives_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE dms_customer_test_drives_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE dms_customer_test_drives_id_seq OWNER TO postgres;

--
-- Name: dms_customer_test_drives_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE dms_customer_test_drives_id_seq OWNED BY dms_customer_test_drives.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY dms_customer_test_drives ALTER COLUMN id SET DEFAULT nextval('dms_customer_test_drives_id_seq'::regclass);


--
-- Data for Name: dms_customer_test_drives; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY dms_customer_test_drives (id, created_by, updated_by, deleted_by, created_at, updated_at, deleted_at, customer_id, td_date_en, td_date_np, td_time, executive_id, vehicle_id, variant_id, mileage_start, mileage_end, duration, td_location) FROM stdin;
1	109	109	\N	2016-12-19 15:41:22	2016-12-19 15:41:22	\N	2763	2016-12-19	2073-09-04	\N	9	16	20	\N	\N	30	Customer Choice
2	105	105	\N	2017-01-15 13:30:58	2017-01-15 13:30:58	\N	3649	2017-01-13	2073-09-29	\N	5	3	4	\N	\N	15	Dealer Place
3	105	105	\N	2017-01-15 13:31:55	2017-01-15 13:31:55	\N	3134	2017-01-04	2073-09-20	\N	5	16	20	\N	\N	10	Dealer Place
4	101	101	\N	2017-02-02 14:44:20	2017-02-02 14:44:30	\N	4047	2017-02-02	2073-10-20	\N	10	17	16	\N	\N	30	Customer Choice
5	111	111	\N	2017-02-05 17:35:14	2017-02-05 17:35:14	\N	4058	2017-02-05	01-02-2017	\N	11	3	19	\N	\N	30	Customer Choice
\.


--
-- Name: dms_customer_test_drives_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('dms_customer_test_drives_id_seq', 5, true);


--
-- Name: pk_dms_customer_test_drives; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY dms_customer_test_drives
    ADD CONSTRAINT pk_dms_customer_test_drives PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

