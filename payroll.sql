--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.16
-- Dumped by pg_dump version 9.6.16

-- Started on 2020-06-13 18:41:28

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE admintest;
--
-- TOC entry 2143 (class 1262 OID 291463)
-- Name: admintest; Type: DATABASE; Schema: -; Owner: -
--

CREATE DATABASE admintest WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';


\connect admintest

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12387)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2146 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 188 (class 1259 OID 291492)
-- Name: admin; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.admin (
    id integer NOT NULL,
    username character varying(255),
    password character varying(255),
    email character varying(255),
    last_signin timestamp without time zone DEFAULT now() NOT NULL,
    created_date timestamp without time zone DEFAULT now() NOT NULL,
    ip character varying(255),
    verification_key character varying(255),
    admin_group integer,
    name character varying(255),
    address character varying,
    address2 character varying,
    city character varying,
    state character varying,
    zip numeric(6,0)
);


--
-- TOC entry 186 (class 1259 OID 291478)
-- Name: admin_groups; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.admin_groups (
    id integer NOT NULL,
    name character varying
);


--
-- TOC entry 185 (class 1259 OID 291476)
-- Name: admin_groups_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.admin_groups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2147 (class 0 OID 0)
-- Dependencies: 185
-- Name: admin_groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.admin_groups_id_seq OWNED BY public.admin_groups.id;


--
-- TOC entry 187 (class 1259 OID 291490)
-- Name: admin_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.admin_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2148 (class 0 OID 0)
-- Dependencies: 187
-- Name: admin_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.admin_id_seq OWNED BY public.admin.id;


--
-- TOC entry 2010 (class 2604 OID 291495)
-- Name: admin id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin ALTER COLUMN id SET DEFAULT nextval('public.admin_id_seq'::regclass);


--
-- TOC entry 2009 (class 2604 OID 291481)
-- Name: admin_groups id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin_groups ALTER COLUMN id SET DEFAULT nextval('public.admin_groups_id_seq'::regclass);


--
-- TOC entry 2137 (class 0 OID 291492)
-- Dependencies: 188
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.admin (id, username, password, email, last_signin, created_date, ip, verification_key, admin_group, name, address, address2, city, state, zip) VALUES (2, 'dilip9779', '70180e4a07879d2ab0e5dc975bf7ac3b', 'dilip@gmail.com', '2020-06-12 12:46:38.794812', '2020-06-12 12:46:25.418391', '::1', 'wfb1hpdwN2', 1, 'Dilip gauswami', 'tes', 'test', 'gandhinagar', 'Gujarat', 382421);
INSERT INTO public.admin (id, username, password, email, last_signin, created_date, ip, verification_key, admin_group, name, address, address2, city, state, zip) VALUES (1, 'admin', 'a1fa99a1724242d0931d4f9c62dd56a6', 'support@lenapo.com', '2020-06-13 05:31:01.770748', '2020-06-12 12:42:19.621596', '::1', 'dfasdfa3a33a', 1, 'Joseph Opanel', NULL, NULL, NULL, NULL, NULL);


--
-- TOC entry 2135 (class 0 OID 291478)
-- Dependencies: 186
-- Data for Name: admin_groups; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.admin_groups (id, name) VALUES (1, 'Administrator');
INSERT INTO public.admin_groups (id, name) VALUES (3, 'Supar Admin');


--
-- TOC entry 2149 (class 0 OID 0)
-- Dependencies: 185
-- Name: admin_groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.admin_groups_id_seq', 3, true);


--
-- TOC entry 2150 (class 0 OID 0)
-- Dependencies: 187
-- Name: admin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.admin_id_seq', 2, true);


--
-- TOC entry 2014 (class 2606 OID 291486)
-- Name: admin_groups admin_groups_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin_groups
    ADD CONSTRAINT admin_groups_pkey PRIMARY KEY (id);


--
-- TOC entry 2016 (class 2606 OID 291502)
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id);


--
-- TOC entry 2145 (class 0 OID 0)
-- Dependencies: 6
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: -
--

GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2020-06-13 18:41:30

--
-- PostgreSQL database dump complete
--

