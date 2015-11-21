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
-- Name: shop_product; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE shop_product (
    id integer NOT NULL,
    link_id integer NOT NULL,
    title integer NOT NULL
);


--
-- Name: shop_product_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE shop_product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: shop_product_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE shop_product_id_seq OWNED BY shop_product.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY shop_product ALTER COLUMN id SET DEFAULT nextval('shop_product_id_seq'::regclass);


--
-- Name: shop_product_id; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY shop_product
    ADD CONSTRAINT shop_product_id PRIMARY KEY (id);


--
-- Name: shop_product_link_id; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY shop_product
    ADD CONSTRAINT shop_product_link_id UNIQUE (link_id);


--
-- Name: shop_product_title; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY shop_product
    ADD CONSTRAINT shop_product_title UNIQUE (title);


--
-- Name: shop_product_link_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY shop_product
    ADD CONSTRAINT shop_product_link_id_fkey FOREIGN KEY (link_id) REFERENCES link(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: shop_product_title_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY shop_product
    ADD CONSTRAINT shop_product_title_fkey FOREIGN KEY (title) REFERENCES translation(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

