--
-- PostgreSQL database dump
--

-- Dumped from database version 15.3
-- Dumped by pg_dump version 15.2
-- Started on 2023-07-24 13:22:20 CEST
SET session_replication_role = replica;
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
-- TOC entry 3806 (class 0 OID 18450)
-- Dependencies: 241
-- Data for Name: certificatomedico; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.certificatomedico
VALUES (
        '3984724166',
        'Gianfranco Verdi',
        '2022-07-22',
        '2023-07-29'
    );
INSERT INTO public.certificatomedico
VALUES (
        '3984724166',
        'Gianfranco Verdi',
        '2020-11-11',
        '2021-11-11'
    );
INSERT INTO public.certificatomedico
VALUES (
        '2957361596',
        'Gianfranco Verdi',
        '2020-11-11',
        '2021-11-11'
    );
INSERT INTO public.certificatomedico
VALUES (
        '3984724166',
        'Dr Orsenigo',
        '2021-02-09',
        '2022-02-09'
    );
INSERT INTO public.certificatomedico
VALUES (
        '1764394452',
        'Maria Rosa Poli',
        '2023-06-01',
        '2023-09-30'
    );
--
-- TOC entry 3796 (class 0 OID 18358)
-- Dependencies: 231
-- Data for Name: contratto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.contratto
VALUES (2, 1, 1, '2020-09-11', NULL, NULL);
INSERT INTO public.contratto
VALUES (3, 2, 1, '2023-08-15', NULL, NULL);
INSERT INTO public.contratto
VALUES (4, 2, 1, '2023-08-15', NULL, NULL);
INSERT INTO public.contratto
VALUES (5, 1, 2, '2010-11-01', NULL, 1200);
INSERT INTO public.contratto
VALUES (7, 3, 1, '2023-07-01', '2023-09-30', NULL);
INSERT INTO public.contratto
VALUES (9, 4, 87, '2018-01-24', NULL, 15);
INSERT INTO public.contratto
VALUES (10, 5, 87, '2023-06-01', '2023-09-30', NULL);
INSERT INTO public.contratto
VALUES (11, 6, 2, '2022-01-20', NULL, 18);
--
-- TOC entry 3802 (class 0 OID 18398)
-- Dependencies: 237
-- Data for Name: corso; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.corso
VALUES (
        7,
        false,
        2,
        2020,
        1,
        26,
        2,
        2,
        20.00,
        1,
        20,
        '00:00:00',
        '00:10:00'
    );
INSERT INTO public.corso
VALUES (
        8,
        true,
        2,
        2023,
        1,
        26,
        5,
        1,
        12.00,
        1,
        11,
        '00:00:00',
        '02:00:00'
    );
INSERT INTO public.corso
VALUES (
        6,
        false,
        1,
        2023,
        2,
        25,
        1,
        1,
        120.00,
        3,
        6,
        '00:00:00',
        '01:00:00'
    );
INSERT INTO public.corso
VALUES (
        9,
        true,
        3,
        2023,
        1,
        26,
        1,
        1,
        240.00,
        1,
        10,
        '10:30:00',
        '02:00:00'
    );
INSERT INTO public.corso
VALUES (
        10,
        false,
        4,
        2023,
        1,
        26,
        3,
        3,
        340.00,
        1,
        5,
        '13:15:00',
        '03:10:00'
    );
INSERT INTO public.corso
VALUES (
        12,
        false,
        5,
        2023,
        2,
        33,
        5,
        6,
        350.00,
        1,
        10,
        '17:00:00',
        '01:00:00'
    );
INSERT INTO public.corso
VALUES (
        13,
        true,
        6,
        2023,
        87,
        32,
        3,
        5,
        120.00,
        1,
        5,
        '13:45:00',
        '01:00:00'
    );
--
-- TOC entry 3805 (class 0 OID 18437)
-- Dependencies: 240
-- Data for Name: genitore; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.genitore
VALUES (
        1,
        'Francesco',
        'Spangaro',
        'WSRXGL50R30E053J    ',
        '3395630288',
        '3984724166'
    );
INSERT INTO public.genitore
VALUES (
        6,
        'Anna',
        'Chille',
        'CWMNZJ70L21D951M    ',
        '4493049304',
        '8465103433'
    );
INSERT INTO public.genitore
VALUES (
        2,
        'Gemma',
        'Mainit',
        'RPVFGB83P6          ',
        '3434343432',
        '2957361596'
    );
INSERT INTO public.genitore
VALUES (
        3,
        'Luan ',
        'Tafilaj',
        'PQDVQR48C13A811Q    ',
        '32213231',
        '7912103800'
    );
--
-- TOC entry 3787 (class 0 OID 18281)
-- Dependencies: 221
-- Data for Name: giornoreperibilita; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.giornoreperibilita
VALUES (30, 'Lunedi', '01:00:00', '02:00:00');
INSERT INTO public.giornoreperibilita
VALUES (30, 'Mercoledi', '02:00:00', '03:00:00');
INSERT INTO public.giornoreperibilita
VALUES (30, 'Venerdi', '03:00:00', '04:00:00');
INSERT INTO public.giornoreperibilita
VALUES (38, 'Mercoledi', '14:00:00', '15:30:00');
INSERT INTO public.giornoreperibilita
VALUES (1, 'Sabato', '08:30:00', '12:30:00');
--
-- TOC entry 3808 (class 0 OID 18461)
-- Dependencies: 243
-- Data for Name: iscrizione; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.iscrizione
VALUES (3, '3984724166', 7);
INSERT INTO public.iscrizione
VALUES (5, '3984724166', 8);
INSERT INTO public.iscrizione
VALUES (7, '4233780910', 9);
INSERT INTO public.iscrizione
VALUES (8, '4233780910', 10);
INSERT INTO public.iscrizione
VALUES (10, '3084391601', 10);
INSERT INTO public.iscrizione
VALUES (11, '1764394452', 6);
INSERT INTO public.iscrizione
VALUES (12, '8465103433', 12);
INSERT INTO public.iscrizione
VALUES (13, '9962805612', 10);
INSERT INTO public.iscrizione
VALUES (14, '9962805612', 9);
INSERT INTO public.iscrizione
VALUES (15, '5372412882', 13);
--
-- TOC entry 3794 (class 0 OID 18344)
-- Dependencies: 229
-- Data for Name: istruttore; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.istruttore
VALUES (1, 5);
INSERT INTO public.istruttore
VALUES (2, 6);
INSERT INTO public.istruttore
VALUES (3, 10);
INSERT INTO public.istruttore
VALUES (4, 11);
INSERT INTO public.istruttore
VALUES (5, 12);
INSERT INTO public.istruttore
VALUES (6, 13);
--
-- TOC entry 3803 (class 0 OID 18424)
-- Dependencies: 238
-- Data for Name: membro; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.membro
VALUES (
        '4233780910',
        'Luca',
        'Tosetti',
        'GZETLT59T16B679F    ',
        '2001-09-02',
        1
    );
INSERT INTO public.membro
VALUES (
        '2186405220',
        'Joyce Ann',
        'Padua',
        'RPVFGB83P6          ',
        '2019-02-02',
        2
    );
INSERT INTO public.membro
VALUES (
        '3084391601',
        'Andrea ',
        'Tafilaj',
        'PQDVQR48C13A811Q    ',
        '2019-05-22',
        1
    );
INSERT INTO public.membro
VALUES (
        '3984724166',
        'Franscesco',
        'Riccardi',
        'HJMVLZ36L59A182U    ',
        '2016-07-22',
        1
    );
INSERT INTO public.membro
VALUES (
        '8171730903',
        'Joyce Ann',
        'Padua',
        'RPVFGB83P6          ',
        '2019-02-02',
        2
    );
INSERT INTO public.membro
VALUES (
        '1764394452',
        'Andrea',
        'Chicchi',
        'FDPLBP88D41A026X    ',
        '1999-06-16',
        2
    );
INSERT INTO public.membro
VALUES (
        '8465103433',
        'Chiara',
        'Stella',
        'SMUCMT76R05H219B    ',
        '2014-06-12',
        2
    );
INSERT INTO public.membro
VALUES (
        '2957361596',
        'Joyce Ann',
        'Padua',
        'RPVFGB83P6          ',
        '2019-02-02',
        2
    );
INSERT INTO public.membro
VALUES (
        '7912103800',
        'Andrea ',
        'Tafilaj',
        'PQDVQR48C13A811Q    ',
        '2019-05-22',
        1
    );
INSERT INTO public.membro
VALUES (
        '9962805612',
        'Marco',
        'Cancella',
        'HHBSTS73A66L327X    ',
        '2002-01-22',
        1
    );
INSERT INTO public.membro
VALUES (
        '5372412882',
        'Maria sole',
        'Nidasio',
        'LDTTRB34T52H678C    ',
        '2023-07-08',
        87
    );
--
-- TOC entry 3781 (class 0 OID 18219)
-- Dependencies: 215
-- Data for Name: personale; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.personale
VALUES (
        1,
        'Princess',
        'Padua',
        'PDAPNC84H55F205V    ',
        '2000-08-07'
    );
INSERT INTO public.personale
VALUES (
        4,
        'Persona',
        'Cognome',
        'LRFPLB46T60I282M    ',
        '1999-10-09'
    );
INSERT INTO public.personale
VALUES (
        8,
        'Spangone',
        'SPrangone',
        'SPNSRN82S11D416X    ',
        '2023-07-24'
    );
INSERT INTO public.personale
VALUES (
        9,
        'Spanghino',
        'Spranghino',
        'SPNSRN82S11D416D    ',
        '2023-07-24'
    );
INSERT INTO public.personale
VALUES (
        10,
        'Andrea ',
        'Rovelli',
        'FVATVI86T66A979Z    ',
        '2001-02-11'
    );
INSERT INTO public.personale
VALUES (
        5,
        'Francesco',
        'Ferlin',
        'SLTFFG95P57G317N    ',
        '2001-09-11'
    );
INSERT INTO public.personale
VALUES (
        6,
        'Francesco',
        'Sprangaro',
        'SPNSRN82S11D416S    ',
        '2023-07-20'
    );
INSERT INTO public.personale
VALUES (
        11,
        'Ivan ',
        'Lajara',
        'TSACSP74R48B762N    ',
        '1997-09-21'
    );
INSERT INTO public.personale
VALUES (
        12,
        'Mattia',
        'Casa',
        'VFYDDR53B06L762G    ',
        '1990-06-14'
    );
INSERT INTO public.personale
VALUES (
        13,
        'Alessandro',
        'Dili',
        'PRFKQN32S66A367E    ',
        '2001-01-15'
    );
INSERT INTO public.personale
VALUES (
        3,
        'Antonio',
        'Glinni',
        'VZGCGC39R44B058C    ',
        '1999-09-09'
    );
--
-- TOC entry 3789 (class 0 OID 18295)
-- Dependencies: 224
-- Data for Name: piscina; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.piscina
VALUES (
        1,
        'Piscina Comunale',
        '("Via Dosso Faiti ",12)',
        '2023-01-01',
        '2023-12-31',
        1
    );
INSERT INTO public.piscina
VALUES (
        2,
        'Piscina Merone',
        '("Via Roma",4)',
        '2023-03-01',
        '2023-12-31',
        38
    );
INSERT INTO public.piscina
VALUES (
        87,
        'Piscina Estiva',
        '("Via IV Novembre",356)',
        '2023-06-01',
        '2023-09-14',
        1
    );
--
-- TOC entry 3798 (class 0 OID 18375)
-- Dependencies: 233
-- Data for Name: qualifiche; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.qualifiche
VALUES (1, 'Istruttore di fitness', 1);
INSERT INTO public.qualifiche
VALUES (2, 'Istruttore di pallanuoto', 1);
INSERT INTO public.qualifiche
VALUES (3, 'Istruttore di pallanuoto', 4);
--
-- TOC entry 3786 (class 0 OID 18270)
-- Dependencies: 220
-- Data for Name: reperibilita; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.reperibilita
VALUES (25, 1);
INSERT INTO public.reperibilita
VALUES (26, 2);
INSERT INTO public.reperibilita
VALUES (27, 3);
INSERT INTO public.reperibilita
VALUES (30, 4);
INSERT INTO public.reperibilita
VALUES (32, 1);
INSERT INTO public.reperibilita
VALUES (38, 2);
INSERT INTO public.reperibilita
VALUES (1, 1);
--
-- TOC entry 3784 (class 0 OID 18240)
-- Dependencies: 218
-- Data for Name: responsabile; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.responsabile
VALUES (1, 1);
INSERT INTO public.responsabile
VALUES (2, 3);
INSERT INTO public.responsabile
VALUES (3, 8);
INSERT INTO public.responsabile
VALUES (4, 9);
--
-- TOC entry 3810 (class 0 OID 18480)
-- Dependencies: 245
-- Data for Name: sostituzione; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.sostituzione
VALUES (1, 7, '2023-09-09', 1);
INSERT INTO public.sostituzione
VALUES (2, 7, '2023-08-23', 1);
INSERT INTO public.sostituzione
VALUES (4, 7, '2023-03-09', 1);
INSERT INTO public.sostituzione
VALUES (9, 10, '2023-09-07', 4);
INSERT INTO public.sostituzione
VALUES (10, 10, '2023-07-25', 2);
--
-- TOC entry 3790 (class 0 OID 18310)
-- Dependencies: 225
-- Data for Name: telefono; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.telefono
VALUES ('3396493564', 1);
INSERT INTO public.telefono
VALUES ('31843943', 1);
INSERT INTO public.telefono
VALUES ('3124362434', 2);
INSERT INTO public.telefono
VALUES ('21893829', 2);
INSERT INTO public.telefono
VALUES ('3893829332', 87);
--
-- TOC entry 3782 (class 0 OID 18229)
-- Dependencies: 216
-- Data for Name: telefonopersonale; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.telefonopersonale
VALUES ('3213123123', 10);
INSERT INTO public.telefonopersonale
VALUES ('5646565666', 5);
INSERT INTO public.telefonopersonale
VALUES ('5646565688', 5);
INSERT INTO public.telefonopersonale
VALUES ('5646565611', 5);
INSERT INTO public.telefonopersonale
VALUES ('3441048493', 6);
INSERT INTO public.telefonopersonale
VALUES ('3424234343', 11);
INSERT INTO public.telefonopersonale
VALUES ('2132132132', 12);
INSERT INTO public.telefonopersonale
VALUES ('1232132112', 13);
INSERT INTO public.telefonopersonale
VALUES ('1235684567', 3);
--
-- TOC entry 3800 (class 0 OID 18389)
-- Dependencies: 235
-- Data for Name: tipologiacorsonuoto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tipologiacorsonuoto
VALUES (1, 'Nuoto Baby', 3, 'BABY');
INSERT INTO public.tipologiacorsonuoto
VALUES (2, 'Nuoto Agonistico', 3, 'OLIMPIONICA');
INSERT INTO public.tipologiacorsonuoto
VALUES (3, 'Corso Estivo', 1, 'OLIMPIONICA');
INSERT INTO public.tipologiacorsonuoto
VALUES (4, 'ProNuotoEstivo', 3, 'OLIMPIONICA');
INSERT INTO public.tipologiacorsonuoto
VALUES (5, 'Corso Base', 1, 'OLIMPIONICA');
INSERT INTO public.tipologiacorsonuoto
VALUES (6, 'Esitivo', 2, 'APERTO');
--
-- TOC entry 3792 (class 0 OID 18332)
-- Dependencies: 227
-- Data for Name: vasca; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.vasca
VALUES (22, 5, NULL, NULL, 'APERTO', 87);
INSERT INTO public.vasca
VALUES (24, 2, '2023-07-10', '2023-08-31', 'BABY', 2);
INSERT INTO public.vasca
VALUES (25, 3, '2023-08-24', '2023-08-31', 'BABY', 2);
INSERT INTO public.vasca
VALUES (29, 5, '2023-01-01', '2023-12-31', 'BABY', 1);
INSERT INTO public.vasca
VALUES (27, 2, '2023-06-01', '2023-09-21', 'APERTO', 1);
INSERT INTO public.vasca
VALUES (
        26,
        5,
        '2023-01-01',
        '2023-12-31',
        'OLIMPIONICA',
        1
    );
INSERT INTO public.vasca
VALUES (
        30,
        3,
        '2023-09-13',
        '2023-10-31',
        'NEO NATALE',
        1
    );
INSERT INTO public.vasca
VALUES (32, 7, '2023-07-01', '2023-09-10', 'APERTO', 87);
INSERT INTO public.vasca
VALUES (
        33,
        5,
        '2022-12-01',
        '2024-03-21',
        'OLIMPIONICA',
        2
    );
INSERT INTO public.vasca
VALUES (34, 4, '2023-07-01', '2023-08-31', 'APERTO', 87);
INSERT INTO public.vasca
VALUES (35, 4, '2023-01-01', '2023-09-30', 'CHIUSO', 2);
--
-- TOC entry 3829 (class 0 OID 0)
-- Dependencies: 230
-- Name: contratto_idcontratto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.contratto_idcontratto_seq', 11, true);
--
-- TOC entry 3830 (class 0 OID 0)
-- Dependencies: 236
-- Name: corso_idcorso_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.corso_idcorso_seq', 13, true);
--
-- TOC entry 3831 (class 0 OID 0)
-- Dependencies: 239
-- Name: genitore_idgenitore_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.genitore_idgenitore_seq', 6, true);
--
-- TOC entry 3832 (class 0 OID 0)
-- Dependencies: 242
-- Name: iscrizione_idiscrizione_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.iscrizione_idiscrizione_seq', 15, true);
--
-- TOC entry 3833 (class 0 OID 0)
-- Dependencies: 228
-- Name: istruttore_idistruttore_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.istruttore_idistruttore_seq', 6, true);
--
-- TOC entry 3834 (class 0 OID 0)
-- Dependencies: 214
-- Name: personale_idpersona_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personale_idpersona_seq', 13, true);
--
-- TOC entry 3835 (class 0 OID 0)
-- Dependencies: 223
-- Name: piscina_idpiscina_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.piscina_idpiscina_seq', 134, true);
--
-- TOC entry 3836 (class 0 OID 0)
-- Dependencies: 232
-- Name: qualifiche_idqualifiche_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.qualifiche_idqualifiche_seq', 3, true);
--
-- TOC entry 3837 (class 0 OID 0)
-- Dependencies: 219
-- Name: reperibilita_idreperibilita_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval(
        'public.reperibilita_idreperibilita_seq',
        38,
        true
    );
--
-- TOC entry 3838 (class 0 OID 0)
-- Dependencies: 217
-- Name: responsabile_idresponsabile_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval(
        'public.responsabile_idresponsabile_seq',
        4,
        true
    );
--
-- TOC entry 3839 (class 0 OID 0)
-- Dependencies: 244
-- Name: sostituzione_idsostituzione_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval(
        'public.sostituzione_idsostituzione_seq',
        10,
        true
    );
--
-- TOC entry 3840 (class 0 OID 0)
-- Dependencies: 234
-- Name: tipologiacorsonuoto_tipocorsoid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval(
        'public.tipologiacorsonuoto_tipocorsoid_seq',
        6,
        true
    );
--
-- TOC entry 3841 (class 0 OID 0)
-- Dependencies: 226
-- Name: vasca_idvasca_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vasca_idvasca_seq', 35, true);
-- Completed on 2023-07-24 13:22:20 CEST
--
-- PostgreSQL database dump complete
- -