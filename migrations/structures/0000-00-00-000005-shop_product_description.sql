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
-- Name: shop_product_description; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE shop_product_description (
    id integer NOT NULL,
    product_id integer NOT NULL,
    value integer NOT NULL
);


--
-- Name: shop_product_description_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE shop_product_description_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: shop_product_description_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE shop_product_description_id_seq OWNED BY shop_product_description.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY shop_product_description ALTER COLUMN id SET DEFAULT nextval('shop_product_description_id_seq'::regclass);


--
-- Name: shop_product_description_id; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY shop_product_description
    ADD CONSTRAINT shop_product_description_id PRIMARY KEY (id);


--
-- Name: shop_product_description_product_id; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY shop_product_description
    ADD CONSTRAINT shop_product_description_product_id UNIQUE (product_id);


--
-- Name: shop_product_description_value; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY shop_product_description
    ADD CONSTRAINT shop_product_description_value UNIQUE (value);


--
-- Name: shop_product_description_product_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY shop_product_description
    ADD CONSTRAINT shop_product_description_product_id_fkey FOREIGN KEY (product_id) REFERENCES shop_product(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: shop_product_description_value_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY shop_product_description
    ADD CONSTRAINT shop_product_description_value_fkey FOREIGN KEY (value) REFERENCES translation(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

