--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: asistente_evento; Type: TABLE; Schema: public; Owner: nativoapps; Tablespace: 
--

CREATE TABLE asistente_evento (
    id bigint NOT NULL,
    id_evento integer,
    id_asistente integer,
    estado integer,
    codigo character varying(300)
);


ALTER TABLE public.asistente_evento OWNER TO nativoapps;

--
-- Name: asistente_evento_id_seq; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE asistente_evento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.asistente_evento_id_seq OWNER TO nativoapps;

--
-- Name: asistente_evento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: nativoapps
--

ALTER SEQUENCE asistente_evento_id_seq OWNED BY asistente_evento.id;


--
-- Name: asistente_evento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('asistente_evento_id_seq', 4332, true);


--
-- Name: asistentes; Type: TABLE; Schema: public; Owner: nativoapps; Tablespace: 
--

CREATE TABLE asistentes (
    id bigint NOT NULL,
    nombre character varying(200),
    apellido character varying(200),
    estado integer,
    documento character varying(200),
    email character varying(200),
    telefono character varying(200),
    id_identificacion integer,
    empresa_numero integer,
    id_acompaniante bigint,
    es_acompaniante boolean DEFAULT false
);


ALTER TABLE public.asistentes OWNER TO nativoapps;

--
-- Name: asistentes_id_seq; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE asistentes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.asistentes_id_seq OWNER TO nativoapps;

--
-- Name: asistentes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: nativoapps
--

ALTER SEQUENCE asistentes_id_seq OWNED BY asistentes.id;


--
-- Name: asistentes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('asistentes_id_seq', 877, true);


--
-- Name: empresa_id_seq; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE empresa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.empresa_id_seq OWNER TO nativoapps;

--
-- Name: empresa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('empresa_id_seq', 2, true);


--
-- Name: secuencia_empresa_numero; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE secuencia_empresa_numero
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secuencia_empresa_numero OWNER TO nativoapps;

--
-- Name: secuencia_empresa_numero; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('secuencia_empresa_numero', 2, true);


--
-- Name: empresa; Type: TABLE; Schema: public; Owner: nativoapps; Tablespace: 
--

CREATE TABLE empresa (
    id integer DEFAULT nextval('empresa_id_seq'::regclass) NOT NULL,
    empresa_numero integer DEFAULT nextval('secuencia_empresa_numero'::regclass) NOT NULL,
    tipo_documento character varying(255),
    documento character varying(255),
    nombre_empresa character varying(255),
    contacto character varying(255),
    telefono character varying(255),
    email character varying(255),
    fecha_inicio timestamp without time zone,
    fecha_corte timestamp without time zone,
    dias_corte bigint,
    cantidad_usuarios bigint,
    paquete character varying(255),
    estado_registro bigint,
    ciudad character varying(255),
    direccion character varying(255),
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    logo_empresa text,
    background_inicial character(255),
    footer_empresa character(300),
    background_movil character(255),
    etapa character varying(255),
    dias_prueba character varying(255)
);


ALTER TABLE public.empresa OWNER TO nativoapps;

--
-- Name: estados_id_seq; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE estados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.estados_id_seq OWNER TO nativoapps;

--
-- Name: estados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('estados_id_seq', 3, true);


--
-- Name: secuencia_estado_registro; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE secuencia_estado_registro
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secuencia_estado_registro OWNER TO nativoapps;

--
-- Name: secuencia_estado_registro; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('secuencia_estado_registro', 3, true);


--
-- Name: estados; Type: TABLE; Schema: public; Owner: nativoapps; Tablespace: 
--

CREATE TABLE estados (
    id integer DEFAULT nextval('estados_id_seq'::regclass) NOT NULL,
    estado_registro integer DEFAULT nextval('secuencia_estado_registro'::regclass) NOT NULL,
    descripcion character varying(255),
    empresa_numero bigint,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.estados OWNER TO nativoapps;

--
-- Name: evento; Type: TABLE; Schema: public; Owner: nativoapps; Tablespace: 
--

CREATE TABLE evento (
    id bigint NOT NULL,
    nombre character varying(200),
    descripcion character varying(200),
    estado integer,
    empresa_numero integer
);


ALTER TABLE public.evento OWNER TO nativoapps;

--
-- Name: evento_id_seq; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE evento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.evento_id_seq OWNER TO nativoapps;

--
-- Name: evento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: nativoapps
--

ALTER SEQUENCE evento_id_seq OWNED BY evento.id;


--
-- Name: evento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('evento_id_seq', 2, true);


--
-- Name: identificacion; Type: TABLE; Schema: public; Owner: nativoapps; Tablespace: 
--

CREATE TABLE identificacion (
    id bigint NOT NULL,
    id_tipo integer,
    color character varying,
    id_zona integer,
    nombre character varying(200),
    empresa_numero integer,
    estado integer
);


ALTER TABLE public.identificacion OWNER TO nativoapps;

--
-- Name: identificacion_id_seq; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE identificacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.identificacion_id_seq OWNER TO nativoapps;

--
-- Name: identificacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: nativoapps
--

ALTER SEQUENCE identificacion_id_seq OWNED BY identificacion.id;


--
-- Name: identificacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('identificacion_id_seq', 7, true);


--
-- Name: menus_id_seq; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE menus_id_seq
    START WITH 45
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.menus_id_seq OWNER TO nativoapps;

--
-- Name: menus_id_seq; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('menus_id_seq', 53, true);


--
-- Name: menus; Type: TABLE; Schema: public; Owner: nativoapps; Tablespace: 
--

CREATE TABLE menus (
    id integer DEFAULT nextval('menus_id_seq'::regclass) NOT NULL,
    nombre character varying(255) NOT NULL,
    icono text,
    idpadre integer NOT NULL,
    estado_registro bigint,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    destino text
);


ALTER TABLE public.menus OWNER TO nativoapps;

--
-- Name: perm_rol_menu; Type: TABLE; Schema: public; Owner: nativoapps; Tablespace: 
--

CREATE TABLE perm_rol_menu (
    rol_numero integer NOT NULL,
    idmenu integer NOT NULL,
    ver integer NOT NULL,
    agregar integer NOT NULL,
    modificar integer NOT NULL,
    eliminar integer NOT NULL
);


ALTER TABLE public.perm_rol_menu OWNER TO nativoapps;

--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE roles_id_seq
    START WITH 4
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.roles_id_seq OWNER TO nativoapps;

--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('roles_id_seq', 4, true);


--
-- Name: roles_rol_numero_seq; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE roles_rol_numero_seq
    START WITH 4
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.roles_rol_numero_seq OWNER TO nativoapps;

--
-- Name: roles_rol_numero_seq; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('roles_rol_numero_seq', 4, true);


--
-- Name: roles; Type: TABLE; Schema: public; Owner: nativoapps; Tablespace: 
--

CREATE TABLE roles (
    id integer DEFAULT nextval('roles_id_seq'::regclass) NOT NULL,
    rol_numero integer DEFAULT nextval('roles_rol_numero_seq'::regclass) NOT NULL,
    rol character varying(255),
    estado_registro bigint,
    descripcion character varying(255),
    usuario_numero bigint NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    nivel bigint
);


ALTER TABLE public.roles OWNER TO nativoapps;

--
-- Name: secuencia_usuario_numero; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE secuencia_usuario_numero
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secuencia_usuario_numero OWNER TO nativoapps;

--
-- Name: secuencia_usuario_numero; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('secuencia_usuario_numero', 7, true);


--
-- Name: tipo_asistentes; Type: TABLE; Schema: public; Owner: nativoapps; Tablespace: 
--

CREATE TABLE tipo_asistentes (
    id bigint NOT NULL,
    descripcion character varying,
    estado integer,
    empresa_numero integer
);


ALTER TABLE public.tipo_asistentes OWNER TO nativoapps;

--
-- Name: tipo_asistentes_id_seq; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE tipo_asistentes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tipo_asistentes_id_seq OWNER TO nativoapps;

--
-- Name: tipo_asistentes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: nativoapps
--

ALTER SEQUENCE tipo_asistentes_id_seq OWNED BY tipo_asistentes.id;


--
-- Name: tipo_asistentes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('tipo_asistentes_id_seq', 4, true);


--
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.usuarios_id_seq OWNER TO nativoapps;

--
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('usuarios_id_seq', 7, true);


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: nativoapps; Tablespace: 
--

CREATE TABLE usuarios (
    id integer DEFAULT nextval('usuarios_id_seq'::regclass) NOT NULL,
    empresa_numero bigint,
    usuario_numero integer DEFAULT nextval('secuencia_usuario_numero'::regclass) NOT NULL,
    nombre character varying(255),
    codigo character varying(255),
    telefono character varying(255),
    email character varying(255),
    imagen text,
    login character varying(255),
    password character varying(255),
    password_movil character varying(255),
    director_usuario bigint,
    rol_numero bigint,
    estado_registro bigint,
    remember_token character varying(255),
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    imei character varying(255),
    gcm_token character varying(255)
);


ALTER TABLE public.usuarios OWNER TO nativoapps;

--
-- Name: zonas; Type: TABLE; Schema: public; Owner: nativoapps; Tablespace: 
--

CREATE TABLE zonas (
    id bigint NOT NULL,
    descripcion character varying(200),
    estado integer,
    empresa_numero integer
);


ALTER TABLE public.zonas OWNER TO nativoapps;

--
-- Name: zonas_id_seq; Type: SEQUENCE; Schema: public; Owner: nativoapps
--

CREATE SEQUENCE zonas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.zonas_id_seq OWNER TO nativoapps;

--
-- Name: zonas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: nativoapps
--

ALTER SEQUENCE zonas_id_seq OWNED BY zonas.id;


--
-- Name: zonas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: nativoapps
--

SELECT pg_catalog.setval('zonas_id_seq', 6, true);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: nativoapps
--

ALTER TABLE ONLY asistente_evento ALTER COLUMN id SET DEFAULT nextval('asistente_evento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: nativoapps
--

ALTER TABLE ONLY asistentes ALTER COLUMN id SET DEFAULT nextval('asistentes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: nativoapps
--

ALTER TABLE ONLY evento ALTER COLUMN id SET DEFAULT nextval('evento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: nativoapps
--

ALTER TABLE ONLY identificacion ALTER COLUMN id SET DEFAULT nextval('identificacion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: nativoapps
--

ALTER TABLE ONLY tipo_asistentes ALTER COLUMN id SET DEFAULT nextval('tipo_asistentes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: nativoapps
--

ALTER TABLE ONLY zonas ALTER COLUMN id SET DEFAULT nextval('zonas_id_seq'::regclass);


--
-- Data for Name: asistente_evento; Type: TABLE DATA; Schema: public; Owner: nativoapps
--

INSERT INTO asistente_evento VALUES (16, 2, 12, 1, 'Bytracking Tracker');
INSERT INTO asistente_evento VALUES (17, 2, 2, 1, '7702014640090');
INSERT INTO asistente_evento VALUES (3470, 2, 14, 1, '');
INSERT INTO asistente_evento VALUES (3471, 2, 16, 1, '');
INSERT INTO asistente_evento VALUES (3472, 2, 17, 1, '');
INSERT INTO asistente_evento VALUES (3473, 2, 18, 1, '');
INSERT INTO asistente_evento VALUES (3474, 2, 19, 1, '');
INSERT INTO asistente_evento VALUES (3475, 2, 20, 1, '');
INSERT INTO asistente_evento VALUES (3476, 2, 21, 1, '');
INSERT INTO asistente_evento VALUES (3477, 2, 22, 1, '');
INSERT INTO asistente_evento VALUES (3478, 2, 23, 1, '');
INSERT INTO asistente_evento VALUES (3479, 2, 24, 1, '');
INSERT INTO asistente_evento VALUES (3480, 2, 25, 1, '');
INSERT INTO asistente_evento VALUES (3481, 2, 26, 1, '');
INSERT INTO asistente_evento VALUES (3482, 2, 27, 1, '');
INSERT INTO asistente_evento VALUES (3483, 2, 28, 1, '');
INSERT INTO asistente_evento VALUES (3484, 2, 29, 1, '');
INSERT INTO asistente_evento VALUES (3485, 2, 30, 1, '');
INSERT INTO asistente_evento VALUES (3486, 2, 31, 1, '');
INSERT INTO asistente_evento VALUES (3487, 2, 32, 1, '');
INSERT INTO asistente_evento VALUES (3488, 2, 33, 1, '');
INSERT INTO asistente_evento VALUES (3489, 2, 34, 1, '');
INSERT INTO asistente_evento VALUES (3490, 2, 35, 1, '');
INSERT INTO asistente_evento VALUES (3491, 2, 36, 1, '');
INSERT INTO asistente_evento VALUES (3492, 2, 37, 1, '');
INSERT INTO asistente_evento VALUES (3493, 2, 38, 1, '');
INSERT INTO asistente_evento VALUES (3494, 2, 39, 1, '');
INSERT INTO asistente_evento VALUES (3495, 2, 40, 1, '');
INSERT INTO asistente_evento VALUES (3496, 2, 41, 1, '');
INSERT INTO asistente_evento VALUES (3497, 2, 42, 1, '');
INSERT INTO asistente_evento VALUES (3498, 2, 43, 1, '');
INSERT INTO asistente_evento VALUES (3499, 2, 44, 1, '');
INSERT INTO asistente_evento VALUES (3500, 2, 45, 1, '');
INSERT INTO asistente_evento VALUES (3501, 2, 46, 1, '');
INSERT INTO asistente_evento VALUES (3502, 2, 47, 1, '');
INSERT INTO asistente_evento VALUES (3503, 2, 48, 1, '');
INSERT INTO asistente_evento VALUES (3504, 2, 49, 1, '');
INSERT INTO asistente_evento VALUES (3505, 2, 50, 1, '');
INSERT INTO asistente_evento VALUES (3506, 2, 51, 1, '');
INSERT INTO asistente_evento VALUES (3507, 2, 52, 1, '');
INSERT INTO asistente_evento VALUES (3508, 2, 53, 1, '');
INSERT INTO asistente_evento VALUES (3509, 2, 54, 1, '');
INSERT INTO asistente_evento VALUES (3510, 2, 55, 1, '');
INSERT INTO asistente_evento VALUES (3511, 2, 56, 1, '');
INSERT INTO asistente_evento VALUES (3512, 2, 57, 1, '');
INSERT INTO asistente_evento VALUES (3513, 2, 58, 1, '');
INSERT INTO asistente_evento VALUES (3514, 2, 59, 1, '');
INSERT INTO asistente_evento VALUES (3515, 2, 60, 1, '');
INSERT INTO asistente_evento VALUES (3516, 2, 61, 1, '');
INSERT INTO asistente_evento VALUES (3517, 2, 62, 1, '');
INSERT INTO asistente_evento VALUES (3518, 2, 63, 1, '');
INSERT INTO asistente_evento VALUES (3519, 2, 64, 1, '');
INSERT INTO asistente_evento VALUES (3520, 2, 65, 1, '');
INSERT INTO asistente_evento VALUES (3521, 2, 66, 1, '');
INSERT INTO asistente_evento VALUES (3522, 2, 67, 1, '');
INSERT INTO asistente_evento VALUES (3523, 2, 68, 1, '');
INSERT INTO asistente_evento VALUES (3524, 2, 69, 1, '');
INSERT INTO asistente_evento VALUES (3525, 2, 70, 1, '');
INSERT INTO asistente_evento VALUES (3526, 2, 71, 1, '');
INSERT INTO asistente_evento VALUES (3527, 2, 72, 1, '');
INSERT INTO asistente_evento VALUES (3528, 2, 73, 1, '');
INSERT INTO asistente_evento VALUES (3529, 2, 74, 1, '');
INSERT INTO asistente_evento VALUES (3530, 2, 75, 1, '');
INSERT INTO asistente_evento VALUES (3531, 2, 76, 1, '');
INSERT INTO asistente_evento VALUES (3532, 2, 77, 1, '');
INSERT INTO asistente_evento VALUES (3533, 2, 78, 1, '');
INSERT INTO asistente_evento VALUES (3534, 2, 79, 1, '');
INSERT INTO asistente_evento VALUES (3535, 2, 80, 1, '');
INSERT INTO asistente_evento VALUES (3536, 2, 81, 1, '');
INSERT INTO asistente_evento VALUES (3537, 2, 82, 1, '');
INSERT INTO asistente_evento VALUES (3538, 2, 83, 1, '');
INSERT INTO asistente_evento VALUES (3539, 2, 84, 1, '');
INSERT INTO asistente_evento VALUES (3540, 2, 85, 1, '');
INSERT INTO asistente_evento VALUES (3541, 2, 86, 1, '');
INSERT INTO asistente_evento VALUES (3542, 2, 87, 1, '');
INSERT INTO asistente_evento VALUES (3543, 2, 88, 1, '');
INSERT INTO asistente_evento VALUES (3544, 2, 89, 1, '');
INSERT INTO asistente_evento VALUES (3545, 2, 90, 1, '');
INSERT INTO asistente_evento VALUES (3546, 2, 91, 1, '');
INSERT INTO asistente_evento VALUES (3547, 2, 92, 1, '');
INSERT INTO asistente_evento VALUES (3548, 2, 93, 1, '');
INSERT INTO asistente_evento VALUES (3549, 2, 94, 1, '');
INSERT INTO asistente_evento VALUES (3550, 2, 95, 1, '');
INSERT INTO asistente_evento VALUES (3551, 2, 96, 1, '');
INSERT INTO asistente_evento VALUES (3552, 2, 97, 1, '');
INSERT INTO asistente_evento VALUES (3553, 2, 98, 1, '');
INSERT INTO asistente_evento VALUES (3554, 2, 99, 1, '');
INSERT INTO asistente_evento VALUES (3555, 2, 100, 1, '');
INSERT INTO asistente_evento VALUES (3556, 2, 101, 1, '');
INSERT INTO asistente_evento VALUES (3557, 2, 102, 1, '');
INSERT INTO asistente_evento VALUES (3558, 2, 103, 1, '');
INSERT INTO asistente_evento VALUES (3559, 2, 104, 1, '');
INSERT INTO asistente_evento VALUES (3560, 2, 105, 1, '');
INSERT INTO asistente_evento VALUES (3561, 2, 106, 1, '');
INSERT INTO asistente_evento VALUES (3562, 2, 107, 1, '');
INSERT INTO asistente_evento VALUES (3563, 2, 108, 1, '');
INSERT INTO asistente_evento VALUES (3564, 2, 109, 1, '');
INSERT INTO asistente_evento VALUES (3565, 2, 110, 1, '');
INSERT INTO asistente_evento VALUES (3566, 2, 111, 1, '');
INSERT INTO asistente_evento VALUES (3567, 2, 112, 1, '');
INSERT INTO asistente_evento VALUES (3568, 2, 113, 1, '');
INSERT INTO asistente_evento VALUES (3569, 2, 114, 1, '');
INSERT INTO asistente_evento VALUES (3570, 2, 115, 1, '');
INSERT INTO asistente_evento VALUES (3571, 2, 116, 1, '');
INSERT INTO asistente_evento VALUES (3572, 2, 117, 1, '');
INSERT INTO asistente_evento VALUES (3573, 2, 118, 1, '');
INSERT INTO asistente_evento VALUES (3574, 2, 119, 1, '');
INSERT INTO asistente_evento VALUES (3575, 2, 120, 1, '');
INSERT INTO asistente_evento VALUES (3576, 2, 121, 1, '');
INSERT INTO asistente_evento VALUES (3577, 2, 122, 1, '');
INSERT INTO asistente_evento VALUES (3578, 2, 123, 1, '');
INSERT INTO asistente_evento VALUES (3579, 2, 124, 1, '');
INSERT INTO asistente_evento VALUES (3580, 2, 125, 1, '');
INSERT INTO asistente_evento VALUES (3581, 2, 126, 1, '');
INSERT INTO asistente_evento VALUES (3582, 2, 127, 1, '');
INSERT INTO asistente_evento VALUES (3583, 2, 128, 1, '');
INSERT INTO asistente_evento VALUES (3584, 2, 129, 1, '');
INSERT INTO asistente_evento VALUES (3585, 2, 130, 1, '');
INSERT INTO asistente_evento VALUES (3586, 2, 131, 1, '');
INSERT INTO asistente_evento VALUES (3587, 2, 132, 1, '');
INSERT INTO asistente_evento VALUES (3588, 2, 133, 1, '');
INSERT INTO asistente_evento VALUES (3589, 2, 134, 1, '');
INSERT INTO asistente_evento VALUES (3590, 2, 135, 1, '');
INSERT INTO asistente_evento VALUES (3591, 2, 136, 1, '');
INSERT INTO asistente_evento VALUES (3592, 2, 137, 1, '');
INSERT INTO asistente_evento VALUES (3593, 2, 138, 1, '');
INSERT INTO asistente_evento VALUES (3594, 2, 139, 1, '');
INSERT INTO asistente_evento VALUES (3595, 2, 140, 1, '');
INSERT INTO asistente_evento VALUES (3596, 2, 141, 1, '');
INSERT INTO asistente_evento VALUES (3597, 2, 142, 1, '');
INSERT INTO asistente_evento VALUES (3598, 2, 143, 1, '');
INSERT INTO asistente_evento VALUES (3599, 2, 144, 1, '');
INSERT INTO asistente_evento VALUES (3600, 2, 145, 1, '');
INSERT INTO asistente_evento VALUES (3601, 2, 146, 1, '');
INSERT INTO asistente_evento VALUES (3602, 2, 147, 1, '');
INSERT INTO asistente_evento VALUES (3603, 2, 148, 1, '');
INSERT INTO asistente_evento VALUES (3604, 2, 149, 1, '');
INSERT INTO asistente_evento VALUES (3605, 2, 150, 1, '');
INSERT INTO asistente_evento VALUES (3606, 2, 151, 1, '');
INSERT INTO asistente_evento VALUES (3607, 2, 152, 1, '');
INSERT INTO asistente_evento VALUES (3608, 2, 153, 1, '');
INSERT INTO asistente_evento VALUES (3609, 2, 154, 1, '');
INSERT INTO asistente_evento VALUES (3610, 2, 155, 1, '');
INSERT INTO asistente_evento VALUES (3611, 2, 156, 1, '');
INSERT INTO asistente_evento VALUES (3612, 2, 157, 1, '');
INSERT INTO asistente_evento VALUES (3613, 2, 158, 1, '');
INSERT INTO asistente_evento VALUES (3614, 2, 159, 1, '');
INSERT INTO asistente_evento VALUES (3615, 2, 160, 1, '');
INSERT INTO asistente_evento VALUES (3616, 2, 161, 1, '');
INSERT INTO asistente_evento VALUES (3617, 2, 162, 1, '');
INSERT INTO asistente_evento VALUES (3618, 2, 163, 1, '');
INSERT INTO asistente_evento VALUES (3619, 2, 164, 1, '');
INSERT INTO asistente_evento VALUES (3620, 2, 165, 1, '');
INSERT INTO asistente_evento VALUES (3621, 2, 166, 1, '');
INSERT INTO asistente_evento VALUES (3622, 2, 167, 1, '');
INSERT INTO asistente_evento VALUES (3623, 2, 168, 1, '');
INSERT INTO asistente_evento VALUES (3624, 2, 169, 1, '');
INSERT INTO asistente_evento VALUES (3625, 2, 170, 1, '');
INSERT INTO asistente_evento VALUES (3626, 2, 171, 1, '');
INSERT INTO asistente_evento VALUES (3627, 2, 172, 1, '');
INSERT INTO asistente_evento VALUES (3628, 2, 173, 1, '');
INSERT INTO asistente_evento VALUES (3629, 2, 174, 1, '');
INSERT INTO asistente_evento VALUES (3630, 2, 175, 1, '');
INSERT INTO asistente_evento VALUES (3631, 2, 176, 1, '');
INSERT INTO asistente_evento VALUES (3632, 2, 177, 1, '');
INSERT INTO asistente_evento VALUES (3633, 2, 178, 1, '');
INSERT INTO asistente_evento VALUES (3634, 2, 179, 1, '');
INSERT INTO asistente_evento VALUES (3635, 2, 180, 1, '');
INSERT INTO asistente_evento VALUES (3636, 2, 181, 1, '');
INSERT INTO asistente_evento VALUES (3637, 2, 182, 1, '');
INSERT INTO asistente_evento VALUES (3638, 2, 183, 1, '');
INSERT INTO asistente_evento VALUES (3639, 2, 184, 1, '');
INSERT INTO asistente_evento VALUES (3640, 2, 185, 1, '');
INSERT INTO asistente_evento VALUES (3641, 2, 186, 1, '');
INSERT INTO asistente_evento VALUES (3642, 2, 187, 1, '');
INSERT INTO asistente_evento VALUES (3643, 2, 188, 1, '');
INSERT INTO asistente_evento VALUES (3644, 2, 189, 1, '');
INSERT INTO asistente_evento VALUES (3645, 2, 190, 1, '');
INSERT INTO asistente_evento VALUES (3646, 2, 191, 1, '');
INSERT INTO asistente_evento VALUES (3647, 2, 192, 1, '');
INSERT INTO asistente_evento VALUES (3648, 2, 193, 1, '');
INSERT INTO asistente_evento VALUES (3649, 2, 194, 1, '');
INSERT INTO asistente_evento VALUES (3650, 2, 195, 1, '');
INSERT INTO asistente_evento VALUES (3651, 2, 196, 1, '');
INSERT INTO asistente_evento VALUES (3652, 2, 197, 1, '');
INSERT INTO asistente_evento VALUES (3653, 2, 198, 1, '');
INSERT INTO asistente_evento VALUES (3654, 2, 199, 1, '');
INSERT INTO asistente_evento VALUES (3655, 2, 200, 1, '');
INSERT INTO asistente_evento VALUES (3656, 2, 201, 1, '');
INSERT INTO asistente_evento VALUES (3657, 2, 202, 1, '');
INSERT INTO asistente_evento VALUES (3658, 2, 203, 1, '');
INSERT INTO asistente_evento VALUES (3659, 2, 204, 1, '');
INSERT INTO asistente_evento VALUES (3660, 2, 205, 1, '');
INSERT INTO asistente_evento VALUES (3661, 2, 206, 1, '');
INSERT INTO asistente_evento VALUES (3662, 2, 207, 1, '');
INSERT INTO asistente_evento VALUES (3663, 2, 208, 1, '');
INSERT INTO asistente_evento VALUES (3664, 2, 209, 1, '');
INSERT INTO asistente_evento VALUES (3665, 2, 210, 1, '');
INSERT INTO asistente_evento VALUES (3666, 2, 211, 1, '');
INSERT INTO asistente_evento VALUES (3667, 2, 212, 1, '');
INSERT INTO asistente_evento VALUES (3668, 2, 213, 1, '');
INSERT INTO asistente_evento VALUES (3669, 2, 214, 1, '');
INSERT INTO asistente_evento VALUES (3670, 2, 215, 1, '');
INSERT INTO asistente_evento VALUES (3671, 2, 216, 1, '');
INSERT INTO asistente_evento VALUES (3672, 2, 217, 1, '');
INSERT INTO asistente_evento VALUES (3673, 2, 218, 1, '');
INSERT INTO asistente_evento VALUES (3674, 2, 219, 1, '');
INSERT INTO asistente_evento VALUES (3675, 2, 220, 1, '');
INSERT INTO asistente_evento VALUES (3676, 2, 221, 1, '');
INSERT INTO asistente_evento VALUES (3677, 2, 222, 1, '');
INSERT INTO asistente_evento VALUES (3678, 2, 223, 1, '');
INSERT INTO asistente_evento VALUES (3679, 2, 224, 1, '');
INSERT INTO asistente_evento VALUES (3680, 2, 225, 1, '');
INSERT INTO asistente_evento VALUES (3681, 2, 226, 1, '');
INSERT INTO asistente_evento VALUES (3682, 2, 227, 1, '');
INSERT INTO asistente_evento VALUES (3683, 2, 228, 1, '');
INSERT INTO asistente_evento VALUES (3684, 2, 229, 1, '');
INSERT INTO asistente_evento VALUES (3685, 2, 230, 1, '');
INSERT INTO asistente_evento VALUES (3686, 2, 231, 1, '');
INSERT INTO asistente_evento VALUES (3687, 2, 232, 1, '');
INSERT INTO asistente_evento VALUES (3688, 2, 233, 1, '');
INSERT INTO asistente_evento VALUES (3689, 2, 234, 1, '');
INSERT INTO asistente_evento VALUES (3690, 2, 235, 1, '');
INSERT INTO asistente_evento VALUES (3691, 2, 236, 1, '');
INSERT INTO asistente_evento VALUES (3692, 2, 237, 1, '');
INSERT INTO asistente_evento VALUES (3693, 2, 238, 1, '');
INSERT INTO asistente_evento VALUES (3694, 2, 239, 1, '');
INSERT INTO asistente_evento VALUES (3695, 2, 240, 1, '');
INSERT INTO asistente_evento VALUES (3696, 2, 241, 1, '');
INSERT INTO asistente_evento VALUES (3697, 2, 242, 1, '');
INSERT INTO asistente_evento VALUES (3698, 2, 243, 1, '');
INSERT INTO asistente_evento VALUES (3699, 2, 244, 1, '');
INSERT INTO asistente_evento VALUES (3700, 2, 245, 1, '');
INSERT INTO asistente_evento VALUES (3701, 2, 246, 1, '');
INSERT INTO asistente_evento VALUES (3702, 2, 247, 1, '');
INSERT INTO asistente_evento VALUES (3703, 2, 248, 1, '');
INSERT INTO asistente_evento VALUES (3704, 2, 249, 1, '');
INSERT INTO asistente_evento VALUES (3705, 2, 250, 1, '');
INSERT INTO asistente_evento VALUES (3706, 2, 251, 1, '');
INSERT INTO asistente_evento VALUES (3707, 2, 252, 1, '');
INSERT INTO asistente_evento VALUES (3708, 2, 253, 1, '');
INSERT INTO asistente_evento VALUES (3709, 2, 254, 1, '');
INSERT INTO asistente_evento VALUES (3710, 2, 255, 1, '');
INSERT INTO asistente_evento VALUES (3711, 2, 256, 1, '');
INSERT INTO asistente_evento VALUES (3712, 2, 257, 1, '');
INSERT INTO asistente_evento VALUES (3713, 2, 258, 1, '');
INSERT INTO asistente_evento VALUES (3714, 2, 259, 1, '');
INSERT INTO asistente_evento VALUES (3715, 2, 260, 1, '');
INSERT INTO asistente_evento VALUES (3716, 2, 261, 1, '');
INSERT INTO asistente_evento VALUES (3717, 2, 262, 1, '');
INSERT INTO asistente_evento VALUES (3718, 2, 263, 1, '');
INSERT INTO asistente_evento VALUES (3719, 2, 264, 1, '');
INSERT INTO asistente_evento VALUES (3720, 2, 265, 1, '');
INSERT INTO asistente_evento VALUES (3721, 2, 266, 1, '');
INSERT INTO asistente_evento VALUES (3722, 2, 267, 1, '');
INSERT INTO asistente_evento VALUES (3723, 2, 268, 1, '');
INSERT INTO asistente_evento VALUES (3724, 2, 269, 1, '');
INSERT INTO asistente_evento VALUES (3725, 2, 270, 1, '');
INSERT INTO asistente_evento VALUES (3726, 2, 271, 1, '');
INSERT INTO asistente_evento VALUES (3727, 2, 272, 1, '');
INSERT INTO asistente_evento VALUES (3728, 2, 273, 1, '');
INSERT INTO asistente_evento VALUES (3729, 2, 274, 1, '');
INSERT INTO asistente_evento VALUES (3730, 2, 275, 1, '');
INSERT INTO asistente_evento VALUES (3731, 2, 276, 1, '');
INSERT INTO asistente_evento VALUES (3732, 2, 277, 1, '');
INSERT INTO asistente_evento VALUES (3733, 2, 278, 1, '');
INSERT INTO asistente_evento VALUES (3734, 2, 279, 1, '');
INSERT INTO asistente_evento VALUES (3735, 2, 280, 1, '');
INSERT INTO asistente_evento VALUES (3736, 2, 281, 1, '');
INSERT INTO asistente_evento VALUES (3737, 2, 282, 1, '');
INSERT INTO asistente_evento VALUES (3738, 2, 283, 1, '');
INSERT INTO asistente_evento VALUES (3739, 2, 284, 1, '');
INSERT INTO asistente_evento VALUES (3740, 2, 285, 1, '');
INSERT INTO asistente_evento VALUES (3741, 2, 286, 1, '');
INSERT INTO asistente_evento VALUES (3742, 2, 287, 1, '');
INSERT INTO asistente_evento VALUES (3743, 2, 288, 1, '');
INSERT INTO asistente_evento VALUES (3744, 2, 289, 1, '');
INSERT INTO asistente_evento VALUES (3745, 2, 290, 1, '');
INSERT INTO asistente_evento VALUES (3746, 2, 291, 1, '');
INSERT INTO asistente_evento VALUES (3747, 2, 292, 1, '');
INSERT INTO asistente_evento VALUES (3748, 2, 293, 1, '');
INSERT INTO asistente_evento VALUES (3749, 2, 294, 1, '');
INSERT INTO asistente_evento VALUES (3750, 2, 295, 1, '');
INSERT INTO asistente_evento VALUES (3751, 2, 296, 1, '');
INSERT INTO asistente_evento VALUES (3752, 2, 297, 1, '');
INSERT INTO asistente_evento VALUES (3753, 2, 298, 1, '');
INSERT INTO asistente_evento VALUES (3754, 2, 299, 1, '');
INSERT INTO asistente_evento VALUES (3755, 2, 300, 1, '');
INSERT INTO asistente_evento VALUES (3756, 2, 301, 1, '');
INSERT INTO asistente_evento VALUES (3757, 2, 302, 1, '');
INSERT INTO asistente_evento VALUES (3758, 2, 303, 1, '');
INSERT INTO asistente_evento VALUES (3759, 2, 304, 1, '');
INSERT INTO asistente_evento VALUES (3760, 2, 305, 1, '');
INSERT INTO asistente_evento VALUES (3761, 2, 306, 1, '');
INSERT INTO asistente_evento VALUES (3762, 2, 307, 1, '');
INSERT INTO asistente_evento VALUES (3763, 2, 308, 1, '');
INSERT INTO asistente_evento VALUES (3764, 2, 309, 1, '');
INSERT INTO asistente_evento VALUES (3765, 2, 310, 1, '');
INSERT INTO asistente_evento VALUES (3766, 2, 311, 1, '');
INSERT INTO asistente_evento VALUES (3767, 2, 312, 1, '');
INSERT INTO asistente_evento VALUES (3768, 2, 313, 1, '');
INSERT INTO asistente_evento VALUES (3769, 2, 314, 1, '');
INSERT INTO asistente_evento VALUES (3770, 2, 315, 1, '');
INSERT INTO asistente_evento VALUES (3771, 2, 316, 1, '');
INSERT INTO asistente_evento VALUES (3772, 2, 317, 1, '');
INSERT INTO asistente_evento VALUES (3773, 2, 318, 1, '');
INSERT INTO asistente_evento VALUES (3774, 2, 319, 1, '');
INSERT INTO asistente_evento VALUES (3775, 2, 320, 1, '');
INSERT INTO asistente_evento VALUES (3776, 2, 321, 1, '');
INSERT INTO asistente_evento VALUES (3777, 2, 322, 1, '');
INSERT INTO asistente_evento VALUES (3778, 2, 323, 1, '');
INSERT INTO asistente_evento VALUES (3779, 2, 324, 1, '');
INSERT INTO asistente_evento VALUES (3780, 2, 325, 1, '');
INSERT INTO asistente_evento VALUES (3781, 2, 326, 1, '');
INSERT INTO asistente_evento VALUES (3782, 2, 327, 1, '');
INSERT INTO asistente_evento VALUES (3783, 2, 328, 1, '');
INSERT INTO asistente_evento VALUES (3784, 2, 329, 1, '');
INSERT INTO asistente_evento VALUES (3785, 2, 330, 1, '');
INSERT INTO asistente_evento VALUES (3786, 2, 331, 1, '');
INSERT INTO asistente_evento VALUES (3787, 2, 332, 1, '');
INSERT INTO asistente_evento VALUES (3788, 2, 333, 1, '');
INSERT INTO asistente_evento VALUES (3789, 2, 334, 1, '');
INSERT INTO asistente_evento VALUES (3790, 2, 335, 1, '');
INSERT INTO asistente_evento VALUES (3791, 2, 336, 1, '');
INSERT INTO asistente_evento VALUES (3792, 2, 337, 1, '');
INSERT INTO asistente_evento VALUES (3793, 2, 338, 1, '');
INSERT INTO asistente_evento VALUES (3794, 2, 339, 1, '');
INSERT INTO asistente_evento VALUES (3795, 2, 340, 1, '');
INSERT INTO asistente_evento VALUES (3796, 2, 341, 1, '');
INSERT INTO asistente_evento VALUES (3797, 2, 342, 1, '');
INSERT INTO asistente_evento VALUES (3798, 2, 343, 1, '');
INSERT INTO asistente_evento VALUES (3799, 2, 344, 1, '');
INSERT INTO asistente_evento VALUES (3800, 2, 345, 1, '');
INSERT INTO asistente_evento VALUES (3801, 2, 346, 1, '');
INSERT INTO asistente_evento VALUES (3802, 2, 347, 1, '');
INSERT INTO asistente_evento VALUES (3803, 2, 348, 1, '');
INSERT INTO asistente_evento VALUES (3804, 2, 349, 1, '');
INSERT INTO asistente_evento VALUES (3805, 2, 350, 1, '');
INSERT INTO asistente_evento VALUES (3806, 2, 351, 1, '');
INSERT INTO asistente_evento VALUES (3807, 2, 352, 1, '');
INSERT INTO asistente_evento VALUES (3808, 2, 353, 1, '');
INSERT INTO asistente_evento VALUES (3809, 2, 354, 1, '');
INSERT INTO asistente_evento VALUES (3810, 2, 355, 1, '');
INSERT INTO asistente_evento VALUES (3811, 2, 356, 1, '');
INSERT INTO asistente_evento VALUES (3812, 2, 357, 1, '');
INSERT INTO asistente_evento VALUES (3813, 2, 358, 1, '');
INSERT INTO asistente_evento VALUES (3814, 2, 359, 1, '');
INSERT INTO asistente_evento VALUES (3815, 2, 360, 1, '');
INSERT INTO asistente_evento VALUES (3816, 2, 361, 1, '');
INSERT INTO asistente_evento VALUES (3817, 2, 362, 1, '');
INSERT INTO asistente_evento VALUES (3818, 2, 363, 1, '');
INSERT INTO asistente_evento VALUES (3819, 2, 364, 1, '');
INSERT INTO asistente_evento VALUES (3820, 2, 365, 1, '');
INSERT INTO asistente_evento VALUES (3821, 2, 366, 1, '');
INSERT INTO asistente_evento VALUES (3822, 2, 367, 1, '');
INSERT INTO asistente_evento VALUES (3823, 2, 368, 1, '');
INSERT INTO asistente_evento VALUES (3824, 2, 369, 1, '');
INSERT INTO asistente_evento VALUES (3825, 2, 370, 1, '');
INSERT INTO asistente_evento VALUES (3826, 2, 371, 1, '');
INSERT INTO asistente_evento VALUES (3827, 2, 372, 1, '');
INSERT INTO asistente_evento VALUES (3828, 2, 373, 1, '');
INSERT INTO asistente_evento VALUES (3829, 2, 374, 1, '');
INSERT INTO asistente_evento VALUES (3830, 2, 375, 1, '');
INSERT INTO asistente_evento VALUES (3831, 2, 376, 1, '');
INSERT INTO asistente_evento VALUES (3832, 2, 377, 1, '');
INSERT INTO asistente_evento VALUES (3833, 2, 378, 1, '');
INSERT INTO asistente_evento VALUES (3834, 2, 379, 1, '');
INSERT INTO asistente_evento VALUES (3835, 2, 380, 1, '');
INSERT INTO asistente_evento VALUES (3836, 2, 381, 1, '');
INSERT INTO asistente_evento VALUES (3837, 2, 382, 1, '');
INSERT INTO asistente_evento VALUES (3838, 2, 383, 1, '');
INSERT INTO asistente_evento VALUES (3839, 2, 384, 1, '');
INSERT INTO asistente_evento VALUES (3840, 2, 385, 1, '');
INSERT INTO asistente_evento VALUES (3841, 2, 386, 1, '');
INSERT INTO asistente_evento VALUES (3842, 2, 387, 1, '');
INSERT INTO asistente_evento VALUES (3843, 2, 388, 1, '');
INSERT INTO asistente_evento VALUES (3844, 2, 389, 1, '');
INSERT INTO asistente_evento VALUES (3845, 2, 390, 1, '');
INSERT INTO asistente_evento VALUES (3846, 2, 391, 1, '');
INSERT INTO asistente_evento VALUES (3847, 2, 392, 1, '');
INSERT INTO asistente_evento VALUES (3848, 2, 393, 1, '');
INSERT INTO asistente_evento VALUES (3849, 2, 394, 1, '');
INSERT INTO asistente_evento VALUES (3850, 2, 395, 1, '');
INSERT INTO asistente_evento VALUES (3851, 2, 396, 1, '');
INSERT INTO asistente_evento VALUES (3852, 2, 397, 1, '');
INSERT INTO asistente_evento VALUES (3853, 2, 398, 1, '');
INSERT INTO asistente_evento VALUES (3854, 2, 399, 1, '');
INSERT INTO asistente_evento VALUES (3855, 2, 400, 1, '');
INSERT INTO asistente_evento VALUES (3856, 2, 401, 1, '');
INSERT INTO asistente_evento VALUES (3857, 2, 402, 1, '');
INSERT INTO asistente_evento VALUES (3858, 2, 403, 1, '');
INSERT INTO asistente_evento VALUES (3859, 2, 404, 1, '');
INSERT INTO asistente_evento VALUES (3860, 2, 405, 1, '');
INSERT INTO asistente_evento VALUES (3861, 2, 406, 1, '');
INSERT INTO asistente_evento VALUES (3862, 2, 407, 1, '');
INSERT INTO asistente_evento VALUES (3863, 2, 408, 1, '');
INSERT INTO asistente_evento VALUES (3864, 2, 409, 1, '');
INSERT INTO asistente_evento VALUES (3865, 2, 410, 1, '');
INSERT INTO asistente_evento VALUES (3866, 2, 411, 1, '');
INSERT INTO asistente_evento VALUES (3867, 2, 412, 1, '');
INSERT INTO asistente_evento VALUES (3868, 2, 413, 1, '');
INSERT INTO asistente_evento VALUES (3869, 2, 414, 1, '');
INSERT INTO asistente_evento VALUES (3870, 2, 415, 1, '');
INSERT INTO asistente_evento VALUES (3871, 2, 416, 1, '');
INSERT INTO asistente_evento VALUES (3872, 2, 417, 1, '');
INSERT INTO asistente_evento VALUES (3873, 2, 418, 1, '');
INSERT INTO asistente_evento VALUES (3874, 2, 419, 1, '');
INSERT INTO asistente_evento VALUES (3875, 2, 420, 1, '');
INSERT INTO asistente_evento VALUES (3876, 2, 421, 1, '');
INSERT INTO asistente_evento VALUES (3877, 2, 422, 1, '');
INSERT INTO asistente_evento VALUES (3878, 2, 423, 1, '');
INSERT INTO asistente_evento VALUES (3879, 2, 424, 1, '');
INSERT INTO asistente_evento VALUES (3880, 2, 425, 1, '');
INSERT INTO asistente_evento VALUES (3881, 2, 426, 1, '');
INSERT INTO asistente_evento VALUES (3882, 2, 427, 1, '');
INSERT INTO asistente_evento VALUES (3883, 2, 428, 1, '');
INSERT INTO asistente_evento VALUES (3884, 2, 429, 1, '');
INSERT INTO asistente_evento VALUES (3885, 2, 430, 1, '');
INSERT INTO asistente_evento VALUES (3886, 2, 431, 1, '');
INSERT INTO asistente_evento VALUES (3887, 2, 432, 1, '');
INSERT INTO asistente_evento VALUES (3888, 2, 433, 1, '');
INSERT INTO asistente_evento VALUES (3889, 2, 434, 1, '');
INSERT INTO asistente_evento VALUES (3890, 2, 435, 1, '');
INSERT INTO asistente_evento VALUES (3891, 2, 436, 1, '');
INSERT INTO asistente_evento VALUES (3893, 2, 438, 1, '');
INSERT INTO asistente_evento VALUES (3894, 2, 439, 1, '');
INSERT INTO asistente_evento VALUES (3895, 2, 440, 1, '');
INSERT INTO asistente_evento VALUES (3896, 2, 441, 1, '');
INSERT INTO asistente_evento VALUES (3897, 2, 442, 1, '');
INSERT INTO asistente_evento VALUES (3898, 2, 443, 1, '');
INSERT INTO asistente_evento VALUES (3899, 2, 444, 1, '');
INSERT INTO asistente_evento VALUES (3901, 2, 446, 1, '');
INSERT INTO asistente_evento VALUES (3906, 2, 451, 1, '');
INSERT INTO asistente_evento VALUES (3908, 2, 437, 1, '');
INSERT INTO asistente_evento VALUES (3909, 2, 454, 1, '');
INSERT INTO asistente_evento VALUES (3910, 2, 455, 1, '');
INSERT INTO asistente_evento VALUES (3911, 2, 456, 1, '');
INSERT INTO asistente_evento VALUES (3912, 2, 457, 1, '');
INSERT INTO asistente_evento VALUES (3913, 2, 458, 1, '');
INSERT INTO asistente_evento VALUES (3914, 2, 459, 1, '');
INSERT INTO asistente_evento VALUES (3915, 2, 460, 1, '');
INSERT INTO asistente_evento VALUES (3916, 2, 461, 1, '');
INSERT INTO asistente_evento VALUES (3917, 2, 462, 1, '');
INSERT INTO asistente_evento VALUES (3918, 2, 463, 1, '');
INSERT INTO asistente_evento VALUES (3919, 2, 464, 1, '');
INSERT INTO asistente_evento VALUES (3920, 2, 465, 1, '');
INSERT INTO asistente_evento VALUES (3921, 2, 466, 1, '');
INSERT INTO asistente_evento VALUES (3922, 2, 467, 1, '');
INSERT INTO asistente_evento VALUES (3923, 2, 468, 1, '');
INSERT INTO asistente_evento VALUES (3924, 2, 469, 1, '');
INSERT INTO asistente_evento VALUES (3925, 2, 470, 1, '');
INSERT INTO asistente_evento VALUES (3926, 2, 471, 1, '');
INSERT INTO asistente_evento VALUES (3927, 2, 472, 1, '');
INSERT INTO asistente_evento VALUES (3928, 2, 473, 1, '');
INSERT INTO asistente_evento VALUES (3929, 2, 474, 1, '');
INSERT INTO asistente_evento VALUES (3930, 2, 475, 1, '');
INSERT INTO asistente_evento VALUES (3931, 2, 476, 1, '');
INSERT INTO asistente_evento VALUES (3932, 2, 477, 1, '');
INSERT INTO asistente_evento VALUES (3933, 2, 478, 1, '');
INSERT INTO asistente_evento VALUES (3934, 2, 479, 1, '');
INSERT INTO asistente_evento VALUES (3935, 2, 480, 1, '');
INSERT INTO asistente_evento VALUES (3936, 2, 481, 1, '');
INSERT INTO asistente_evento VALUES (3937, 2, 482, 1, '');
INSERT INTO asistente_evento VALUES (3938, 2, 483, 1, '');
INSERT INTO asistente_evento VALUES (3939, 2, 484, 1, '');
INSERT INTO asistente_evento VALUES (3940, 2, 485, 1, '');
INSERT INTO asistente_evento VALUES (3941, 2, 486, 1, '');
INSERT INTO asistente_evento VALUES (3942, 2, 487, 1, '');
INSERT INTO asistente_evento VALUES (3943, 2, 488, 1, '');
INSERT INTO asistente_evento VALUES (3944, 2, 489, 1, '');
INSERT INTO asistente_evento VALUES (3945, 2, 490, 1, '');
INSERT INTO asistente_evento VALUES (3946, 2, 491, 1, '');
INSERT INTO asistente_evento VALUES (3947, 2, 492, 1, '');
INSERT INTO asistente_evento VALUES (3948, 2, 493, 1, '');
INSERT INTO asistente_evento VALUES (3949, 2, 494, 1, '');
INSERT INTO asistente_evento VALUES (3950, 2, 495, 1, '');
INSERT INTO asistente_evento VALUES (3951, 2, 496, 1, '');
INSERT INTO asistente_evento VALUES (3952, 2, 497, 1, '');
INSERT INTO asistente_evento VALUES (3953, 2, 498, 1, '');
INSERT INTO asistente_evento VALUES (3954, 2, 499, 1, '');
INSERT INTO asistente_evento VALUES (3955, 2, 500, 1, '');
INSERT INTO asistente_evento VALUES (3956, 2, 501, 1, '');
INSERT INTO asistente_evento VALUES (3957, 2, 502, 1, '');
INSERT INTO asistente_evento VALUES (3958, 2, 503, 1, '');
INSERT INTO asistente_evento VALUES (3959, 2, 504, 1, '');
INSERT INTO asistente_evento VALUES (3960, 2, 505, 1, '');
INSERT INTO asistente_evento VALUES (3961, 2, 506, 1, '');
INSERT INTO asistente_evento VALUES (3962, 2, 507, 1, '');
INSERT INTO asistente_evento VALUES (3963, 2, 508, 1, '');
INSERT INTO asistente_evento VALUES (3964, 2, 509, 1, '');
INSERT INTO asistente_evento VALUES (3965, 2, 510, 1, '');
INSERT INTO asistente_evento VALUES (3966, 2, 511, 1, '');
INSERT INTO asistente_evento VALUES (3967, 2, 512, 1, '');
INSERT INTO asistente_evento VALUES (3968, 2, 513, 1, '');
INSERT INTO asistente_evento VALUES (3969, 2, 514, 1, '');
INSERT INTO asistente_evento VALUES (3970, 2, 515, 1, '');
INSERT INTO asistente_evento VALUES (3971, 2, 516, 1, '');
INSERT INTO asistente_evento VALUES (3972, 2, 517, 1, '');
INSERT INTO asistente_evento VALUES (3973, 2, 518, 1, '');
INSERT INTO asistente_evento VALUES (3974, 2, 519, 1, '');
INSERT INTO asistente_evento VALUES (3975, 2, 520, 1, '');
INSERT INTO asistente_evento VALUES (3976, 2, 521, 1, '');
INSERT INTO asistente_evento VALUES (3977, 2, 522, 1, '');
INSERT INTO asistente_evento VALUES (3978, 2, 523, 1, '');
INSERT INTO asistente_evento VALUES (3979, 2, 524, 1, '');
INSERT INTO asistente_evento VALUES (3980, 2, 525, 1, '');
INSERT INTO asistente_evento VALUES (3981, 2, 526, 1, '');
INSERT INTO asistente_evento VALUES (3982, 2, 527, 1, '');
INSERT INTO asistente_evento VALUES (3983, 2, 528, 1, '');
INSERT INTO asistente_evento VALUES (3984, 2, 529, 1, '');
INSERT INTO asistente_evento VALUES (3985, 2, 530, 1, '');
INSERT INTO asistente_evento VALUES (3986, 2, 531, 1, '');
INSERT INTO asistente_evento VALUES (3987, 2, 532, 1, '');
INSERT INTO asistente_evento VALUES (3988, 2, 533, 1, '');
INSERT INTO asistente_evento VALUES (3989, 2, 534, 1, '');
INSERT INTO asistente_evento VALUES (3990, 2, 535, 1, '');
INSERT INTO asistente_evento VALUES (3991, 2, 536, 1, '');
INSERT INTO asistente_evento VALUES (3992, 2, 537, 1, '');
INSERT INTO asistente_evento VALUES (3993, 2, 538, 1, '');
INSERT INTO asistente_evento VALUES (3994, 2, 539, 1, '');
INSERT INTO asistente_evento VALUES (3995, 2, 540, 1, '');
INSERT INTO asistente_evento VALUES (3996, 2, 541, 1, '');
INSERT INTO asistente_evento VALUES (3997, 2, 542, 1, '');
INSERT INTO asistente_evento VALUES (3998, 2, 543, 1, '');
INSERT INTO asistente_evento VALUES (3999, 2, 544, 1, '');
INSERT INTO asistente_evento VALUES (4000, 2, 545, 1, '');
INSERT INTO asistente_evento VALUES (4001, 2, 546, 1, '');
INSERT INTO asistente_evento VALUES (4002, 2, 547, 1, '');
INSERT INTO asistente_evento VALUES (4003, 2, 548, 1, '');
INSERT INTO asistente_evento VALUES (4004, 2, 549, 1, '');
INSERT INTO asistente_evento VALUES (4005, 2, 550, 1, '');
INSERT INTO asistente_evento VALUES (4006, 2, 551, 1, '');
INSERT INTO asistente_evento VALUES (4007, 2, 552, 1, '');
INSERT INTO asistente_evento VALUES (4008, 2, 553, 1, '');
INSERT INTO asistente_evento VALUES (4009, 2, 554, 1, '');
INSERT INTO asistente_evento VALUES (4010, 2, 555, 1, '');
INSERT INTO asistente_evento VALUES (4011, 2, 556, 1, '');
INSERT INTO asistente_evento VALUES (4012, 2, 557, 1, '');
INSERT INTO asistente_evento VALUES (4013, 2, 558, 1, '');
INSERT INTO asistente_evento VALUES (4014, 2, 559, 1, '');
INSERT INTO asistente_evento VALUES (4015, 2, 560, 1, '');
INSERT INTO asistente_evento VALUES (4016, 2, 561, 1, '');
INSERT INTO asistente_evento VALUES (4017, 2, 562, 1, '');
INSERT INTO asistente_evento VALUES (4018, 2, 563, 1, '');
INSERT INTO asistente_evento VALUES (4019, 2, 564, 1, '');
INSERT INTO asistente_evento VALUES (4020, 2, 565, 1, '');
INSERT INTO asistente_evento VALUES (4021, 2, 566, 1, '');
INSERT INTO asistente_evento VALUES (4022, 2, 567, 1, '');
INSERT INTO asistente_evento VALUES (4023, 2, 568, 1, '');
INSERT INTO asistente_evento VALUES (4024, 2, 569, 1, '');
INSERT INTO asistente_evento VALUES (4025, 2, 570, 1, '');
INSERT INTO asistente_evento VALUES (4026, 2, 571, 1, '');
INSERT INTO asistente_evento VALUES (4027, 2, 572, 1, '');
INSERT INTO asistente_evento VALUES (4028, 2, 573, 1, '');
INSERT INTO asistente_evento VALUES (4029, 2, 574, 1, '');
INSERT INTO asistente_evento VALUES (4030, 2, 575, 1, '');
INSERT INTO asistente_evento VALUES (4031, 2, 576, 1, '');
INSERT INTO asistente_evento VALUES (4032, 2, 577, 1, '');
INSERT INTO asistente_evento VALUES (4033, 2, 578, 1, '');
INSERT INTO asistente_evento VALUES (4034, 2, 579, 1, '');
INSERT INTO asistente_evento VALUES (4035, 2, 580, 1, '');
INSERT INTO asistente_evento VALUES (4036, 2, 581, 1, '');
INSERT INTO asistente_evento VALUES (4037, 2, 582, 1, '');
INSERT INTO asistente_evento VALUES (4038, 2, 583, 1, '');
INSERT INTO asistente_evento VALUES (4039, 2, 584, 1, '');
INSERT INTO asistente_evento VALUES (4040, 2, 585, 1, '');
INSERT INTO asistente_evento VALUES (4041, 2, 586, 1, '');
INSERT INTO asistente_evento VALUES (4042, 2, 587, 1, '');
INSERT INTO asistente_evento VALUES (4043, 2, 588, 1, '');
INSERT INTO asistente_evento VALUES (4044, 2, 589, 1, '');
INSERT INTO asistente_evento VALUES (4045, 2, 590, 1, '');
INSERT INTO asistente_evento VALUES (4046, 2, 591, 1, '');
INSERT INTO asistente_evento VALUES (4047, 2, 592, 1, '');
INSERT INTO asistente_evento VALUES (4048, 2, 593, 1, '');
INSERT INTO asistente_evento VALUES (4049, 2, 594, 1, '');
INSERT INTO asistente_evento VALUES (4050, 2, 595, 1, '');
INSERT INTO asistente_evento VALUES (4051, 2, 596, 1, '');
INSERT INTO asistente_evento VALUES (4052, 2, 597, 1, '');
INSERT INTO asistente_evento VALUES (4053, 2, 598, 1, '');
INSERT INTO asistente_evento VALUES (4054, 2, 599, 1, '');
INSERT INTO asistente_evento VALUES (4055, 2, 600, 1, '');
INSERT INTO asistente_evento VALUES (4056, 2, 601, 1, '');
INSERT INTO asistente_evento VALUES (4057, 2, 602, 1, '');
INSERT INTO asistente_evento VALUES (4058, 2, 603, 1, '');
INSERT INTO asistente_evento VALUES (4059, 2, 604, 1, '');
INSERT INTO asistente_evento VALUES (4060, 2, 605, 1, '');
INSERT INTO asistente_evento VALUES (4061, 2, 606, 1, '');
INSERT INTO asistente_evento VALUES (4062, 2, 607, 1, '');
INSERT INTO asistente_evento VALUES (4063, 2, 608, 1, '');
INSERT INTO asistente_evento VALUES (4064, 2, 609, 1, '');
INSERT INTO asistente_evento VALUES (4065, 2, 610, 1, '');
INSERT INTO asistente_evento VALUES (4066, 2, 611, 1, '');
INSERT INTO asistente_evento VALUES (4067, 2, 612, 1, '');
INSERT INTO asistente_evento VALUES (4068, 2, 613, 1, '');
INSERT INTO asistente_evento VALUES (4069, 2, 614, 1, '');
INSERT INTO asistente_evento VALUES (4070, 2, 615, 1, '');
INSERT INTO asistente_evento VALUES (4071, 2, 616, 1, '');
INSERT INTO asistente_evento VALUES (4072, 2, 617, 1, '');
INSERT INTO asistente_evento VALUES (4073, 2, 618, 1, '');
INSERT INTO asistente_evento VALUES (4074, 2, 619, 1, '');
INSERT INTO asistente_evento VALUES (4075, 2, 620, 1, '');
INSERT INTO asistente_evento VALUES (4076, 2, 621, 1, '');
INSERT INTO asistente_evento VALUES (4077, 2, 622, 1, '');
INSERT INTO asistente_evento VALUES (4078, 2, 623, 1, '');
INSERT INTO asistente_evento VALUES (4079, 2, 624, 1, '');
INSERT INTO asistente_evento VALUES (4080, 2, 625, 1, '');
INSERT INTO asistente_evento VALUES (4081, 2, 626, 1, '');
INSERT INTO asistente_evento VALUES (4082, 2, 627, 1, '');
INSERT INTO asistente_evento VALUES (4083, 2, 628, 1, '');
INSERT INTO asistente_evento VALUES (4084, 2, 629, 1, '');
INSERT INTO asistente_evento VALUES (4085, 2, 630, 1, '');
INSERT INTO asistente_evento VALUES (4086, 2, 631, 1, '');
INSERT INTO asistente_evento VALUES (4087, 2, 632, 1, '');
INSERT INTO asistente_evento VALUES (4088, 2, 633, 1, '');
INSERT INTO asistente_evento VALUES (4089, 2, 634, 1, '');
INSERT INTO asistente_evento VALUES (4090, 2, 635, 1, '');
INSERT INTO asistente_evento VALUES (4091, 2, 636, 1, '');
INSERT INTO asistente_evento VALUES (4092, 2, 637, 1, '');
INSERT INTO asistente_evento VALUES (4093, 2, 638, 1, '');
INSERT INTO asistente_evento VALUES (4094, 2, 639, 1, '');
INSERT INTO asistente_evento VALUES (4095, 2, 640, 1, '');
INSERT INTO asistente_evento VALUES (4096, 2, 641, 1, '');
INSERT INTO asistente_evento VALUES (4097, 2, 642, 1, '');
INSERT INTO asistente_evento VALUES (4098, 2, 643, 1, '');
INSERT INTO asistente_evento VALUES (4099, 2, 644, 1, '');
INSERT INTO asistente_evento VALUES (4100, 2, 645, 1, '');
INSERT INTO asistente_evento VALUES (4101, 2, 646, 1, '');
INSERT INTO asistente_evento VALUES (4102, 2, 647, 1, '');
INSERT INTO asistente_evento VALUES (4103, 2, 648, 1, '');
INSERT INTO asistente_evento VALUES (4104, 2, 649, 1, '');
INSERT INTO asistente_evento VALUES (4105, 2, 650, 1, '');
INSERT INTO asistente_evento VALUES (4106, 2, 651, 1, '');
INSERT INTO asistente_evento VALUES (4107, 2, 652, 1, '');
INSERT INTO asistente_evento VALUES (4108, 2, 653, 1, '');
INSERT INTO asistente_evento VALUES (4109, 2, 654, 1, '');
INSERT INTO asistente_evento VALUES (4110, 2, 655, 1, '');
INSERT INTO asistente_evento VALUES (4111, 2, 656, 1, '');
INSERT INTO asistente_evento VALUES (4112, 2, 657, 1, '');
INSERT INTO asistente_evento VALUES (4113, 2, 658, 1, '');
INSERT INTO asistente_evento VALUES (4114, 2, 659, 1, '');
INSERT INTO asistente_evento VALUES (4115, 2, 660, 1, '');
INSERT INTO asistente_evento VALUES (4116, 2, 661, 1, '');
INSERT INTO asistente_evento VALUES (4117, 2, 662, 1, '');
INSERT INTO asistente_evento VALUES (4118, 2, 663, 1, '');
INSERT INTO asistente_evento VALUES (4119, 2, 664, 1, '');
INSERT INTO asistente_evento VALUES (4120, 2, 665, 1, '');
INSERT INTO asistente_evento VALUES (4121, 2, 666, 1, '');
INSERT INTO asistente_evento VALUES (4122, 2, 667, 1, '');
INSERT INTO asistente_evento VALUES (4123, 2, 668, 1, '');
INSERT INTO asistente_evento VALUES (4124, 2, 669, 1, '');
INSERT INTO asistente_evento VALUES (4125, 2, 670, 1, '');
INSERT INTO asistente_evento VALUES (4126, 2, 671, 1, '');
INSERT INTO asistente_evento VALUES (4127, 2, 672, 1, '');
INSERT INTO asistente_evento VALUES (4128, 2, 673, 1, '');
INSERT INTO asistente_evento VALUES (4129, 2, 674, 1, '');
INSERT INTO asistente_evento VALUES (4130, 2, 675, 1, '');
INSERT INTO asistente_evento VALUES (4131, 2, 676, 1, '');
INSERT INTO asistente_evento VALUES (4132, 2, 677, 1, '');
INSERT INTO asistente_evento VALUES (4133, 2, 678, 1, '');
INSERT INTO asistente_evento VALUES (4134, 2, 679, 1, '');
INSERT INTO asistente_evento VALUES (4135, 2, 680, 1, '');
INSERT INTO asistente_evento VALUES (4136, 2, 681, 1, '');
INSERT INTO asistente_evento VALUES (4137, 2, 682, 1, '');
INSERT INTO asistente_evento VALUES (4138, 2, 683, 1, '');
INSERT INTO asistente_evento VALUES (4139, 2, 684, 1, '');
INSERT INTO asistente_evento VALUES (4140, 2, 685, 1, '');
INSERT INTO asistente_evento VALUES (4141, 2, 686, 1, '');
INSERT INTO asistente_evento VALUES (4142, 2, 687, 1, '');
INSERT INTO asistente_evento VALUES (4143, 2, 688, 1, '');
INSERT INTO asistente_evento VALUES (4144, 2, 689, 1, '');
INSERT INTO asistente_evento VALUES (4145, 2, 690, 1, '');
INSERT INTO asistente_evento VALUES (4146, 2, 691, 1, '');
INSERT INTO asistente_evento VALUES (4147, 2, 692, 1, '');
INSERT INTO asistente_evento VALUES (4148, 2, 693, 1, '');
INSERT INTO asistente_evento VALUES (4149, 2, 694, 1, '');
INSERT INTO asistente_evento VALUES (4150, 2, 695, 1, '');
INSERT INTO asistente_evento VALUES (4151, 2, 696, 1, '');
INSERT INTO asistente_evento VALUES (4152, 2, 697, 1, '');
INSERT INTO asistente_evento VALUES (4153, 2, 698, 1, '');
INSERT INTO asistente_evento VALUES (4154, 2, 699, 1, '');
INSERT INTO asistente_evento VALUES (4155, 2, 700, 1, '');
INSERT INTO asistente_evento VALUES (4156, 2, 701, 1, '');
INSERT INTO asistente_evento VALUES (4157, 2, 702, 1, '');
INSERT INTO asistente_evento VALUES (4158, 2, 703, 1, '');
INSERT INTO asistente_evento VALUES (4159, 2, 704, 1, '');
INSERT INTO asistente_evento VALUES (4160, 2, 705, 1, '');
INSERT INTO asistente_evento VALUES (4161, 2, 706, 1, '');
INSERT INTO asistente_evento VALUES (4162, 2, 707, 1, '');
INSERT INTO asistente_evento VALUES (4163, 2, 708, 1, '');
INSERT INTO asistente_evento VALUES (4164, 2, 709, 1, '');
INSERT INTO asistente_evento VALUES (4165, 2, 710, 1, '');
INSERT INTO asistente_evento VALUES (4166, 2, 711, 1, '');
INSERT INTO asistente_evento VALUES (4167, 2, 712, 1, '');
INSERT INTO asistente_evento VALUES (4168, 2, 713, 1, '');
INSERT INTO asistente_evento VALUES (4169, 2, 714, 1, '');
INSERT INTO asistente_evento VALUES (4170, 2, 715, 1, '');
INSERT INTO asistente_evento VALUES (4171, 2, 716, 1, '');
INSERT INTO asistente_evento VALUES (4172, 2, 717, 1, '');
INSERT INTO asistente_evento VALUES (4173, 2, 718, 1, '');
INSERT INTO asistente_evento VALUES (4174, 2, 719, 1, '');
INSERT INTO asistente_evento VALUES (4175, 2, 720, 1, '');
INSERT INTO asistente_evento VALUES (4176, 2, 721, 1, '');
INSERT INTO asistente_evento VALUES (4177, 2, 722, 1, '');
INSERT INTO asistente_evento VALUES (4178, 2, 723, 1, '');
INSERT INTO asistente_evento VALUES (4179, 2, 724, 1, '');
INSERT INTO asistente_evento VALUES (4180, 2, 725, 1, '');
INSERT INTO asistente_evento VALUES (4181, 2, 726, 1, '');
INSERT INTO asistente_evento VALUES (4182, 2, 727, 1, '');
INSERT INTO asistente_evento VALUES (4183, 2, 728, 1, '');
INSERT INTO asistente_evento VALUES (4184, 2, 729, 1, '');
INSERT INTO asistente_evento VALUES (4185, 2, 730, 1, '');
INSERT INTO asistente_evento VALUES (4186, 2, 731, 1, '');
INSERT INTO asistente_evento VALUES (4187, 2, 732, 1, '');
INSERT INTO asistente_evento VALUES (4188, 2, 733, 1, '');
INSERT INTO asistente_evento VALUES (4189, 2, 734, 1, '');
INSERT INTO asistente_evento VALUES (4190, 2, 735, 1, '');
INSERT INTO asistente_evento VALUES (4191, 2, 736, 1, '');
INSERT INTO asistente_evento VALUES (4192, 2, 737, 1, '');
INSERT INTO asistente_evento VALUES (4193, 2, 738, 1, '');
INSERT INTO asistente_evento VALUES (4194, 2, 739, 1, '');
INSERT INTO asistente_evento VALUES (4195, 2, 740, 1, '');
INSERT INTO asistente_evento VALUES (4196, 2, 741, 1, '');
INSERT INTO asistente_evento VALUES (4197, 2, 742, 1, '');
INSERT INTO asistente_evento VALUES (4198, 2, 743, 1, '');
INSERT INTO asistente_evento VALUES (4199, 2, 744, 1, '');
INSERT INTO asistente_evento VALUES (4200, 2, 745, 1, '');
INSERT INTO asistente_evento VALUES (4201, 2, 746, 1, '');
INSERT INTO asistente_evento VALUES (4202, 2, 747, 1, '');
INSERT INTO asistente_evento VALUES (4203, 2, 748, 1, '');
INSERT INTO asistente_evento VALUES (4204, 2, 749, 1, '');
INSERT INTO asistente_evento VALUES (4205, 2, 750, 1, '');
INSERT INTO asistente_evento VALUES (4206, 2, 751, 1, '');
INSERT INTO asistente_evento VALUES (4207, 2, 752, 1, '');
INSERT INTO asistente_evento VALUES (4208, 2, 753, 1, '');
INSERT INTO asistente_evento VALUES (4209, 2, 754, 1, '');
INSERT INTO asistente_evento VALUES (4210, 2, 755, 1, '');
INSERT INTO asistente_evento VALUES (4211, 2, 756, 1, '');
INSERT INTO asistente_evento VALUES (4212, 2, 757, 1, '');
INSERT INTO asistente_evento VALUES (4213, 2, 758, 1, '');
INSERT INTO asistente_evento VALUES (4214, 2, 759, 1, '');
INSERT INTO asistente_evento VALUES (4215, 2, 760, 1, '');
INSERT INTO asistente_evento VALUES (4216, 2, 761, 1, '');
INSERT INTO asistente_evento VALUES (4217, 2, 762, 1, '');
INSERT INTO asistente_evento VALUES (4218, 2, 763, 1, '');
INSERT INTO asistente_evento VALUES (4219, 2, 764, 1, '');
INSERT INTO asistente_evento VALUES (4220, 2, 765, 1, '');
INSERT INTO asistente_evento VALUES (4221, 2, 766, 1, '');
INSERT INTO asistente_evento VALUES (4222, 2, 767, 1, '');
INSERT INTO asistente_evento VALUES (4223, 2, 768, 1, '');
INSERT INTO asistente_evento VALUES (4224, 2, 769, 1, '');
INSERT INTO asistente_evento VALUES (4225, 2, 770, 1, '');
INSERT INTO asistente_evento VALUES (4226, 2, 771, 1, '');
INSERT INTO asistente_evento VALUES (4227, 2, 772, 1, '');
INSERT INTO asistente_evento VALUES (4228, 2, 773, 1, '');
INSERT INTO asistente_evento VALUES (4229, 2, 774, 1, '');
INSERT INTO asistente_evento VALUES (4230, 2, 775, 1, '');
INSERT INTO asistente_evento VALUES (4231, 2, 776, 1, '');
INSERT INTO asistente_evento VALUES (4232, 2, 777, 1, '');
INSERT INTO asistente_evento VALUES (4233, 2, 778, 1, '');
INSERT INTO asistente_evento VALUES (4234, 2, 779, 1, '');
INSERT INTO asistente_evento VALUES (4235, 2, 780, 1, '');
INSERT INTO asistente_evento VALUES (4236, 2, 781, 1, '');
INSERT INTO asistente_evento VALUES (4237, 2, 782, 1, '');
INSERT INTO asistente_evento VALUES (4238, 2, 783, 1, '');
INSERT INTO asistente_evento VALUES (4239, 2, 784, 1, '');
INSERT INTO asistente_evento VALUES (4240, 2, 785, 1, '');
INSERT INTO asistente_evento VALUES (4241, 2, 786, 1, '');
INSERT INTO asistente_evento VALUES (4242, 2, 787, 1, '');
INSERT INTO asistente_evento VALUES (4243, 2, 788, 1, '');
INSERT INTO asistente_evento VALUES (4244, 2, 789, 1, '');
INSERT INTO asistente_evento VALUES (4245, 2, 790, 1, '');
INSERT INTO asistente_evento VALUES (4246, 2, 791, 1, '');
INSERT INTO asistente_evento VALUES (4247, 2, 792, 1, '');
INSERT INTO asistente_evento VALUES (4248, 2, 793, 1, '');
INSERT INTO asistente_evento VALUES (4249, 2, 794, 1, '');
INSERT INTO asistente_evento VALUES (4250, 2, 795, 1, '');
INSERT INTO asistente_evento VALUES (4251, 2, 796, 1, '');
INSERT INTO asistente_evento VALUES (4252, 2, 797, 1, '');
INSERT INTO asistente_evento VALUES (4253, 2, 798, 1, '');
INSERT INTO asistente_evento VALUES (4254, 2, 799, 1, '');
INSERT INTO asistente_evento VALUES (4255, 2, 800, 1, '');
INSERT INTO asistente_evento VALUES (4256, 2, 801, 1, '');
INSERT INTO asistente_evento VALUES (4257, 2, 802, 1, '');
INSERT INTO asistente_evento VALUES (4258, 2, 803, 1, '');
INSERT INTO asistente_evento VALUES (4259, 2, 804, 1, '');
INSERT INTO asistente_evento VALUES (4260, 2, 805, 1, '');
INSERT INTO asistente_evento VALUES (4261, 2, 806, 1, '');
INSERT INTO asistente_evento VALUES (4262, 2, 807, 1, '');
INSERT INTO asistente_evento VALUES (4263, 2, 808, 1, '');
INSERT INTO asistente_evento VALUES (4264, 2, 809, 1, '');
INSERT INTO asistente_evento VALUES (4265, 2, 810, 1, '');
INSERT INTO asistente_evento VALUES (4266, 2, 811, 1, '');
INSERT INTO asistente_evento VALUES (4267, 2, 812, 1, '');
INSERT INTO asistente_evento VALUES (4268, 2, 813, 1, '');
INSERT INTO asistente_evento VALUES (4269, 2, 814, 1, '');
INSERT INTO asistente_evento VALUES (4270, 2, 815, 1, '');
INSERT INTO asistente_evento VALUES (4271, 2, 816, 1, '');
INSERT INTO asistente_evento VALUES (4272, 2, 817, 1, '');
INSERT INTO asistente_evento VALUES (4273, 2, 818, 1, '');
INSERT INTO asistente_evento VALUES (4274, 2, 819, 1, '');
INSERT INTO asistente_evento VALUES (4275, 2, 820, 1, '');
INSERT INTO asistente_evento VALUES (4276, 2, 821, 1, '');
INSERT INTO asistente_evento VALUES (4277, 2, 822, 1, '');
INSERT INTO asistente_evento VALUES (4278, 2, 823, 1, '');
INSERT INTO asistente_evento VALUES (4279, 2, 824, 1, '');
INSERT INTO asistente_evento VALUES (4280, 2, 825, 1, '');
INSERT INTO asistente_evento VALUES (4281, 2, 826, 1, '');
INSERT INTO asistente_evento VALUES (4282, 2, 827, 1, '');
INSERT INTO asistente_evento VALUES (4283, 2, 828, 1, '');
INSERT INTO asistente_evento VALUES (4284, 2, 829, 1, '');
INSERT INTO asistente_evento VALUES (4285, 2, 830, 1, '');
INSERT INTO asistente_evento VALUES (4286, 2, 831, 1, '');
INSERT INTO asistente_evento VALUES (4287, 2, 832, 1, '');
INSERT INTO asistente_evento VALUES (4288, 2, 833, 1, '');
INSERT INTO asistente_evento VALUES (4289, 2, 834, 1, '');
INSERT INTO asistente_evento VALUES (4290, 2, 835, 1, '');
INSERT INTO asistente_evento VALUES (4291, 2, 836, 1, '');
INSERT INTO asistente_evento VALUES (4292, 2, 837, 1, '');
INSERT INTO asistente_evento VALUES (4293, 2, 838, 1, '');
INSERT INTO asistente_evento VALUES (4294, 2, 839, 1, '');
INSERT INTO asistente_evento VALUES (4295, 2, 840, 1, '');
INSERT INTO asistente_evento VALUES (4296, 2, 841, 1, '');
INSERT INTO asistente_evento VALUES (4297, 2, 842, 1, '');
INSERT INTO asistente_evento VALUES (4298, 2, 843, 1, '');
INSERT INTO asistente_evento VALUES (4299, 2, 844, 1, '');
INSERT INTO asistente_evento VALUES (4300, 2, 845, 1, '');
INSERT INTO asistente_evento VALUES (4301, 2, 846, 1, '');
INSERT INTO asistente_evento VALUES (4302, 2, 847, 1, '');
INSERT INTO asistente_evento VALUES (4303, 2, 848, 1, '');
INSERT INTO asistente_evento VALUES (4304, 2, 849, 1, '');
INSERT INTO asistente_evento VALUES (4305, 2, 850, 1, '');
INSERT INTO asistente_evento VALUES (4306, 2, 851, 1, '');
INSERT INTO asistente_evento VALUES (4307, 2, 852, 1, '');
INSERT INTO asistente_evento VALUES (4308, 2, 853, 1, '');
INSERT INTO asistente_evento VALUES (4309, 2, 854, 1, '');
INSERT INTO asistente_evento VALUES (4310, 2, 855, 1, '');
INSERT INTO asistente_evento VALUES (4311, 2, 856, 1, '');
INSERT INTO asistente_evento VALUES (4312, 2, 857, 1, '');
INSERT INTO asistente_evento VALUES (4313, 2, 858, 1, '');
INSERT INTO asistente_evento VALUES (4314, 2, 859, 1, '');
INSERT INTO asistente_evento VALUES (4315, 2, 860, 1, '');
INSERT INTO asistente_evento VALUES (4316, 2, 861, 1, '');
INSERT INTO asistente_evento VALUES (4317, 2, 862, 1, '');
INSERT INTO asistente_evento VALUES (4318, 2, 863, 1, '');
INSERT INTO asistente_evento VALUES (4319, 2, 864, 1, '');
INSERT INTO asistente_evento VALUES (4320, 2, 865, 1, '');
INSERT INTO asistente_evento VALUES (4321, 2, 866, 1, '');
INSERT INTO asistente_evento VALUES (4322, 2, 867, 1, '');
INSERT INTO asistente_evento VALUES (4323, 2, 868, 1, '');
INSERT INTO asistente_evento VALUES (4324, 2, 869, 1, '');
INSERT INTO asistente_evento VALUES (4325, 2, 870, 1, '');
INSERT INTO asistente_evento VALUES (4326, 2, 871, 1, '');
INSERT INTO asistente_evento VALUES (4327, 2, 872, 1, '');
INSERT INTO asistente_evento VALUES (4328, 2, 873, 1, '');
INSERT INTO asistente_evento VALUES (4329, 2, 874, 1, '');
INSERT INTO asistente_evento VALUES (4330, 2, 875, 1, '');
INSERT INTO asistente_evento VALUES (4331, 2, 876, 1, '');
INSERT INTO asistente_evento VALUES (4332, 2, 877, 1, '');


--
-- Data for Name: asistentes; Type: TABLE DATA; Schema: public; Owner: nativoapps
--

INSERT INTO asistentes VALUES (10, 'dddd', 'dddd', 1, '1112222', NULL, NULL, NULL, NULL, NULL, true);
INSERT INTO asistentes VALUES (1, 'jeremias', 'CHAPARRO', 1, '3541287474', 'jeremias_04@hotmail.com', '3564646135', 4, 2, NULL, false);
INSERT INTO asistentes VALUES (3, 'Fabio', 'Lesmes', 1, '94501666', 'computadores.y.portatiles@gmail.com', '3164817546', 5, 2, 9, false);
INSERT INTO asistentes VALUES (2, 'Karen', 'Moore', 1, '345684561', 'karenj-85@hotmail.com', '33254', 6, 2, 10, false);
INSERT INTO asistentes VALUES (9, 'aaaaaaaa', 'aaaaaaa', 1, '3333333', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (11, 'dddd', 'dddd', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (12, 'Bytracking', 'Tracker', 1, '3153313900', 'bytracking@gmail.com', '3153313900', 3, 2, NULL, false);
INSERT INTO asistentes VALUES (16, 'Eric Basset', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (21, 'Edwin Gonzales', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (22, 'Nelson Salazar Borja', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (23, 'Alejandro Pinto', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (24, 'Sergio Gómez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (25, 'Tito Daza', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (26, 'Rubi Castillo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (27, 'Luis Piñeres ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (28, 'Luis Piñeres Jr', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (29, 'Néstor Cruz ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (30, 'Nelbaris De Cruz ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (31, 'Alonso Orjuela ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (32, 'Sandra Novoa', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (34, 'Juan David Mery', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (35, 'Oscar Duque', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (36, 'Nora Beltrán ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (37, 'Amanda Castillo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (38, 'Carlos Márquez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (39, 'Gustavo Visbal Galofre', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (40, 'Nassin Cuello', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (41, 'Maryuri Solano', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (43, 'Javier Hoyos', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (44, 'Armando Curarán', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (45, 'Alfonso Gómez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (46, 'Gonzalo Vásquez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (47, 'Walter Zorrilla', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (48, 'Jaime Enrique Zuluaga ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (49, 'Marcos Herrera ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (50, 'Tulio Gómez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (51, 'Jorge Gómez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (53, 'Víctor Manuel Urbano Escobar', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (54, 'Weymar Andrés Montoya Guevara', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (55, 'William Rodríguez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (56, 'Adriana Aguirre', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (57, 'Milton Guerrero', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (58, 'Carlos Mario Giraldo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (59, 'Juan Diego Londoño', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (60, 'José Alberto Rolong', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (62, 'Alex Herrera', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (63, 'Luis Eduardo Jiménez ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (64, 'Harold Garnica ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (65, 'Julián Reyes ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (66, 'Carlos Quintero ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (67, 'Fernando Falla', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (68, 'Eliana Sandoval', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (70, 'Yackeline Ortíz ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (71, 'Carlos Arturo Alomìa', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (72, 'Jaime Ernesto Ríos y Sra', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (73, 'Gustavo Cardona', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (74, 'Jorge Henao', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (75, 'Noralba Villegas', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (76, 'Hernán Revelo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (77, 'Cesar Díaz', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (78, 'Mauricio Mesa', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (79, 'Sandra Medina', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (80, 'David Cardona', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (82, 'Santiago Tasama', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (83, 'Raúl Rodríguez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (84, 'Fabio Pava', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (85, 'Jorge Aristizabal ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (86, 'Luis Carlos Segura ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (87, 'Samir Potes', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (88, 'Rodolfo Guevara', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (89, 'Richard Potes', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (91, 'Silvio Andrés Vergara', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (92, 'Carlos Alberto García', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (93, 'Robinson Ruíz', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (94, 'Andrés Jaramillo ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (95, 'Elkin Rendón ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (96, 'Dora Luz Hernández', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (97, 'Ricardo Jaramillo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (98, 'Hernán Jaime Jaramillo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (99, 'Camilo Echeverry', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (100, 'Yolanda Rosero ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (101, 'Ayda Yackeline Mora', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (102, 'José Vidal', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (14, 'Alirio Jaramillo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (18, 'Carolina Medina', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (20, 'Luis Fernando Trujillo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (15, 'Alirio Jaramillo', '', 1, '', '', '', 1, 1, NULL, false);
INSERT INTO asistentes VALUES (108, 'Mauricio Arturo Parra ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (109, 'Jesús Perea', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (110, 'Matthew Ogg', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (111, 'Stefan Hamerich ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (113, 'Domien Decroos ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (114, 'Camilo Aguirre Machado ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (115, 'Gabriel Jacques ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (116, 'Paul Driscoll', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (117, 'Marcel Rojas', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (118, 'Rene Brito ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (119, 'Veronica Cabrera', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (120, 'Gabriel Mazu', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (121, 'Jose Cuevas', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (122, 'Rodrigo Barros ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (123, 'Nicolás Martínez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (124, 'Claudio Sarah Tornero', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (125, 'Aníbal Burgos', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (127, 'Carlos Enrique González ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (128, 'Oscar Obando', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (129, 'Lynda Guzmán', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (130, 'Fernando Molla', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (131, 'Juan Rivas', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (132, 'Chuck Ecord ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (134, 'David Jaramillo ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (135, 'Ralph Tejada', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (136, 'Jorge Alvarado', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (137, 'Carrie La Londe', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (138, 'Mark Palamountain', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (139, 'Hans C Schiwer', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (140, 'Manuel Iván Trejos', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (141, 'Leonardo Rozo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (142, 'Ton Feelders ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (143, 'Stef Van Der Linden ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (144, 'Wolter Van Der Kooij', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (145, 'Mark Brons ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (146, 'David Mc Cann', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (147, 'Coen Bos', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (149, 'Mathieu Leveque', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (150, 'Oliver Dent', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (152, 'Xavier Barnier ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (153, 'Kelly Den Herder', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (154, 'Jack Wilder', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (155, 'Andres Astorga', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (156, 'Annabella Reszczynski', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (157, 'Diego Hernández. ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (158, 'Jerome Bonduelle ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (159, 'José Quirino Cuadros ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (160, 'Rodrigo Moya', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (161, 'Samuel Salazar', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (162, 'Pedro Aguilar', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (163, 'Pepe Romo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (164, 'Rodrigo Bolamoya', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (165, 'Pablo Salgado ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (166, 'Jorge Herrera ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (168, 'Mauricio Millán', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (169, 'Wilder Rivera', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (170, 'Sonia Patiño', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (171, 'Martha Isabel Arana', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (173, 'Julián Rojas', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (174, 'Minor Rojas', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (175, 'Diógenes Arango', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (176, 'Jonathan Hidalgo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (177, 'Claudia Clavijo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (178, 'Martha Millán', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (179, 'María Leany Carreño', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (180, 'Robinson Fernando Castrillón', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (181, 'Gustavo Barona', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (182, 'Juan Carlos Botero', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (183, 'Orlando Gutiérrez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (184, 'Manuel Mejía', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (186, 'Elizabeth Torrente ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (187, 'Karla Brenes ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (188, 'Maria Ximena Walterios ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (189, 'Heydy Murillo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (190, 'Martha Lucia Velez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (191, 'Shirley Venegas', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (193, 'Maria del Carmen Aguirre', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (194, 'Diana Loaiza', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (195, 'Maria Isabella Delgado', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (196, 'Juliana Aguirre', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (197, 'Lina Artunduaga', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (198, 'Leidy Loaiza', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (199, 'Sandra Tabares', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (200, 'Lina Acosta', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (201, 'Valentina Lara', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (203, 'Francy Caicedo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (104, 'Oscar Arciniegas', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (105, 'Jose Guzmán ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (106, 'Henry A Palmett Plata', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (208, 'Natalia ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (209, 'Yaneth ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (210, 'Norma Peña ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (211, 'Angelica ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (212, 'Laura Gutierrez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (213, 'Adiela Campo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (214, 'Derly Casamachin', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (215, 'Juli Uribe ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (216, 'Jaime Rojas', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (217, 'Guillermo Orozco ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (218, 'Diego Suárez', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (221, 'Christian Castellanos', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (222, 'Juan Manuel Ramos', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (223, 'Miguel Ruiz Navarro', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (224, 'Víctor Julio Gonzales', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (225, 'Jorge Andres Gallego ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (226, 'Jorge Campuzano', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (227, 'Carlos Ignacio Campuzano', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (228, 'Ginna Gil', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (229, 'Johana Moreno', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (230, 'Oscar David Isaza', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (231, 'Oscar Isaza', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (232, 'David Ware', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (233, 'Willian Martinez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (234, 'Santiago Castro Gómez', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (235, 'Efraín Forero Fonseca ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (236, 'Diana Patricia Robledo Montenegro', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (237, 'Julián A Tique Villareal', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (238, 'Luis Fernando Donado', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (239, 'David Rojas Echeverry', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (240, 'Carlos Raúl Reyes ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (242, 'Valentina Gatti Lerma', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (243, 'Julián Eduardo Marín ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (244, 'Iván Mauricio Ricardo', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (245, 'Julián Botero', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (246, 'Illay Paz Lemos', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (248, 'Ana María Mateus Medina ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (249, 'Ariadna Robledo ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (250, 'Alejandro Figueroa Jaramillo', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (251, 'Ana María Gonzalez H', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (252, 'María Clemencia Buitrago Duque', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (253, 'Rafael Arango', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (254, 'Juan Carlos Palacios', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (255, 'Carlos Eduardo Upegui ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (256, 'Jose María Dominguez ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (257, 'María Fernanda Salamanca Ramírez', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (258, 'Lyda Cecilia Botero Serna', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (259, 'Francisco Solano Mendoza', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (260, 'Mirna Patricia Hernandez', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (261, 'José David Gutierrez Novoa ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (262, 'Andres Pardo ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (263, 'Rodrigo Arango ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (265, 'Roberto HolguÍn', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (266, 'Carlos Esparza ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (267, 'Jorge Castro Bucheli', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (268, 'Djalma Teixeira de Lima Filho', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (270, 'Jaime Sánchez Lozano', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (271, 'Luis Felipe Gaviria ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (272, 'Ramiro Mariño Fidalgo ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (273, 'Carlos Augusto Gómez', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (274, 'AlfAccionistaso Azuero Holguín ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (275, 'Guillermo Caicedo ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (276, 'Luis J Malaver B', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (277, 'Carlos Arturo Vargas Gómez', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (278, 'Víctor Urdaneta Toloza', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (279, 'Julián Domínguez Rivera ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (280, 'Orlando Cabrales Martínez ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (281, 'Oscar Marulanda Gómez', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (282, 'Adolfo Varela González ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (283, 'Guillermo Ponce de León Sarasti ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (284, 'Bernardo Guzmán Reyes ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (285, 'Luis Fernando Alarcón Mantilla ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (286, 'Harold Antonio Cerón Rodríguez  ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (287, 'Hernando Cardona Aguilera', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (288, 'Armando Orejuela Forero', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (289, 'Juan Fernando Gonzales Reyes', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (290, 'Carlos Alberto García D.', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (291, 'Luis Enrique Saavedra', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (292, 'Gustavo Torres Muñoz', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (295, 'Luisa Benedicta Barona', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (296, 'Olga Lucia Arias', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (297, 'Jairo Minota', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (205, 'Maria Liliana Flórez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (206, 'Nataly Medina', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (207, 'Luisa Rivera', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (302, 'Guillermo León Caicedo ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (303, 'Melanio Torres', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (304, 'Jose Oliver Camilo', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (305, 'Mauricio Castrillon ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (306, 'Miller Velez', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (307, 'Luz Marina Escarria ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (308, 'Paulo Andres Bedoya Vidal ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (309, 'AlfAccionistaso Cruz ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (310, 'Fernando Cruz Losada', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (311, 'Charles W. Eder', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (313, 'Rodrigo Lince Tenorio hijo', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (314, 'Alejandro Caicedo ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (315, 'Andres Bejarano', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (316, 'Santiago Ocampo', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (318, 'Andrés Felipe Durán', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (319, 'Carlos Pabón Sanabria ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (320, 'Florencia Peña', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (321, 'Hernán Alberto Garzón', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (322, 'Jaime Castillo', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (323, 'Miguel Mejía Tobòn', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (324, 'Carlos Ivan Caicedo ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (325, 'Guillermo Velasco ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (326, 'Giorgio Araujo', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (327, 'Hernan Dario Mejia ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (328, 'Pedro José Guerrero ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (329, 'Jose Fernando Ochoa ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (330, 'Juliana Arango ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (331, 'Luis Cudris', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (332, 'María Virginia Del Risco', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (333, 'Ricardo Rebolledo ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (335, 'Hilda Capurro de Caicedo', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (336, 'Belisario Caicedo Capurro', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (337, 'Juan Manuel Caicedo Capurro y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (338, 'Mauricio Caicedo Aristizábal', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (339, 'Jacobo Tovar Delgado y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (340, 'Jacobo Tovar Caicedo y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (341, 'Alejandro Tovar Caicedo y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (342, 'María Clara Caicedo Capurro', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (344, 'Paola Ospina Caicedo', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (345, 'Carlos Ospina Durán Ballen', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (346, 'Arturo Gómez Gómez y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (347, 'Eugenia Gómez Caicedo', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (348, 'Juliana Gómez Caicedo', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (349, 'Manuel Antonio Jiménez Bruna y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (350, 'César Augusto Caicedo Jaramillo y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (351, 'Marco Aurelio Caicedo Jaramillo e Hijos', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (352, 'Eduardo Salazar Vallecilla y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (353, 'Alvaro H. Caicedo González', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (355, 'Charles James Eder Domínguez y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (356, 'Raúl Martínez Guillén y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (357, 'Manuel Negret Córdoba y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (358, 'Santiago Castro Caicedo y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (359, 'Eduardo Caicedo Lourido y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (360, 'Andrea Caicedo González', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (361, 'Felipe Botero Caicedo y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (362, 'Antonio Francisco Soler Carifalis y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (363, 'Philippe De Bourbon Busset y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (364, 'Antonio Douglas Botero Piedrahita', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (365, 'Mauricio Botero Caicedo y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (366, 'Ignacio Vollmer Sossa y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (368, 'Oscar Alexander Pedraza Robayo y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (369, 'Mark Chason y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (370, 'Douglas Martín Chason Botero', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (371, 'Nicolás Chason Botero', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (372, 'William Alexander Chason Botero', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (373, 'Ciro Alfonso Arévalo Yepes y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (374, 'Mateo Arévalo Botero', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (375, 'Gabriel Arévalo Botero', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (376, 'Felipe Arévalo Botero', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (377, 'Victoria Eugenia Botero Caicedo', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (378, 'Señora Nelly Ulloa de González', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (379, 'Rafael González Ulloa y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (380, 'Luisa Fernanda González Cabal', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (381, 'Belisario González Cabal', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (382, 'Mateo González Garcés', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (383, 'Andrés Hernández Bohmer, Señora e Hijos', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (384, 'Andrés García Peláez y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (385, 'Francisco Aljure y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (299, 'Jorge Maldonado', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (300, 'Jose Luis Sevilla', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (301, 'Marino Montaño', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (390, 'Isabela González Peñaranda', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (391, 'Jorge Enrique González Peñaranda', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (392, 'Lucas Garcés Arango y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (393, 'Andrés González Tobón y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (394, 'Alain Logean y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (395, 'Belisario González Ulloa', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (396, 'Bertha González de Garrido', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (397, 'Alejandro Garrido González y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (398, 'José María Cabal Rivera y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (399, 'Santiago Cabal González y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (400, 'Andrés Arabia Wartemberg y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (401, 'María Nelly González de Saavedra', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (402, 'José Manuel Saavedra González', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (404, 'Federico José Holmann Sáenz', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (405, 'Sebastián Holmann González y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (406, 'Martín Holmann González', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (407, 'Nicolás Holmann González', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (408, 'Angela María Caicedo Toro', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (409, 'Sebastián Alvarez Caicedo', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (410, 'Hernando Caicedo Toro y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (411, 'Hernando Caicedo Rezic', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (412, 'Mateo Lleras Valencia y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (413, 'Cristina Caiced Rezic', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (414, 'María Eugenia Llano de Caicedo', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (415, 'Valentina Caicedo Llano', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (416, 'Andrés Caicedo Llano', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (417, 'Felipe Caicedo Llano', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (419, 'Federico Guillermo Pfeil Schneider Rodríguez', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (420, 'Ingrid Beatriz Olga Pfeil Schneider Rodríguez', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (421, 'Marianne Ismelda Pfeil Schneider Rodríguez', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (422, 'Mauricio Herrera Herrera', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (423, 'Inés Arana de Martínez', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (424, 'Helena Clemencia Lanao Ayarza', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (425, 'Arturo Borrero González', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (426, 'Gustavo Adolfo Morales Mejía', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (428, 'Margoth Díaz del Castillo M.', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (429, 'Felipe Ocampo Hernández', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (430, 'María Cristina Vallecilla de Gómez', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (431, 'Julián Gómez Vallecilla y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (433, 'Luciano Gómez Vallecilla y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (434, 'Gustavo Felipe Gómez Vallecilla y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (435, 'María Cristina Gómez Vallecilla', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (436, 'Roxana Gómez Vallecilla', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (446, 'Mario Baos', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (451, 'Liliana Soto', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (454, 'Humberto Botero ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (440, 'Aura Lucia Mera', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (441, 'Jorge Restrepo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (442, 'Medardo Arias', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (443, 'Gloria H', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (444, 'Maria Elvira Dominguez LloAccionistasa', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (437, 'Periodista Encargado ', '', 1, '', '', '', 7, 1, NULL, false);
INSERT INTO asistentes VALUES (438, 'Antonio de Roux', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (439, 'Mario Fernando Prado ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (455, 'AlfAccionistaso Carvajal ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (456, 'Andrés Espinosa Fenwarth', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (447, 'Periodista Encargado ', 'PE', 1, '', '', '', 7, 1, NULL, false);
INSERT INTO asistentes VALUES (457, 'Hernán Barona', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (448, 'Periodista Encargado ', 'PE', 1, '', '', '', 7, 1, NULL, false);
INSERT INTO asistentes VALUES (449, 'Periodista Encargado ', 'PE', 1, '', '', '', 7, 1, NULL, false);
INSERT INTO asistentes VALUES (450, 'Periodista Encargado ', 'PE', 1, '', '', '', 7, 1, NULL, false);
INSERT INTO asistentes VALUES (458, 'Alejandro Santos', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (452, 'Periodista Encargado ', '', 1, '', '', '', NULL, 1, NULL, false);
INSERT INTO asistentes VALUES (445, 'Periodista Encargado ', 'PE', 1, '', '', '', 7, 1, NULL, false);
INSERT INTO asistentes VALUES (460, 'Alexandra Delgado', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (461, 'Jorge A. Criales', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (462, 'Miki Calero ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (463, 'Juan José Saavedra', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (464, 'Coronel Rodrigo Soler ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (465, 'Brigadier General Juan Vicente Trujillo Muñoz', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (466, 'Mayor Jhon Israel Ortegón', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (467, 'Coronel Gionani Valencia ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (468, 'Gustavo Alberto Lenis Steffens ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (469, 'Javier Antonio Jaramillo Ramírez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (470, 'Coronel Jose Angel Mendoza Guzmán', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (471, 'Mayor José Montealegre  ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (472, 'Mayor Nelson Guerrero', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (453, 'Periodista Encargado ', 'PE', 1, '', '', '', 7, 1, NULL, false);
INSERT INTO asistentes VALUES (388, 'David Ghelman Cohen y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (389, 'Jorge Enrique González Ulloa y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (479, 'Luis Fernando Fuentes Ibarra', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (480, 'Mayor General Ricardo Alberto Restrepo Londoño', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (481, 'Brigadier Sergio Andres Garzón Velez.', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (482, 'Coronel  Rafael Ordóñez Merjech', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (483, 'Coronel Juan Carlos Rueda Cartagena', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (484, 'Yaneth Ortiz  ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (485, 'Carlos Armando Porras Concha ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (486, 'Margarita María Duque Rodríguez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (487, 'Zulaima Elizabeth Vargas Zúñiga ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (488, 'Carlos Alberto Soto', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (490, 'Hernán Darío Cruz Tamayo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (491, 'Gustavo Adolfo Prieto Saavedra', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (492, 'Jose Rafael San Miguel', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (493, 'Gregorio Mondragón', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (494, 'Juan Carlos Hernández', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (495, 'Rubén Darío Materon', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (496, 'Carlos Hernando Navia Parodi', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (497, 'Claudia Vélez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (498, 'SigifAccionistaso Salgado', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (499, 'Maria Luisa Holguin Camayo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (500, 'Esteban Piedrahita  ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (501, 'Luis Eduardo Bejarano', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (502, 'Presidente Juan Manuel  Santos', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (503, 'Enrique Riveira Bornacelly', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (505, 'Alcalde Diego Felipe Bustamante Arango', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (507, 'Alcalde Henry Devia Prado', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (508, 'Claudia Lucumi', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (509, 'Alcaldeza Luz Helena López', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (510, 'Alcalde Maurice Armitage', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (511, 'Cesar Augusto Lemos Poso', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (512, 'Fernando Perez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (513, 'Guillermo Barona Sossa', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (514, 'Gobernadora Dilian Francisca Toro  ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (515, 'Gobernador Oscar Rodrigo Campo Hurtado', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (516, 'Josue Alirio Barrera ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (517, 'Ministra Cecilia Álvarez-Correa Glen', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (518, 'Ministra Natalia Abello Vives', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (519, 'Giovanni Zambrano ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (520, 'Ministro Aurelio Iragorri Valencia', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (521, 'Juan Pablo Pineda', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (522, 'Ministro Rafael Pardo Rueda', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (523, 'Maritza Quiñonez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (524, 'Juan Lucas Restrepo Ibiza', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (525, 'Beatricce Eugenia López Cabrera', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (526, 'Johana Karina Fernández Mora ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (527, 'María Gabriela Victoria', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (528, 'Jose Ramírez Arbeláez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (529, 'María Claudia Lacouture', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (530, 'Paola Garcia Barreneche', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (531, 'Luis Felipe Devia Gallego', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (532, 'Luis Germán Restrepo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (533, 'Diputada Juana Eloísa Cataño', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (535, 'Maria Fernanda Cabal ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (536, 'Jean Marc Laforet', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (538, 'Carmen Sylvain', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (539, 'Gunter Kniess', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (540, 'Robert Van Embder', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (541, 'Michael Colon ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (542, 'Aline Bille', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (543, 'Eduardo José González', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (544, 'Oscar Ivan Zuluaga ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (545, 'ALFAccionistasO RANGEL SUAREZ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (546, 'ALVARO URIBE VELEZ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (547, 'CARLOS FELIPE MEJIA MEJIA', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (548, 'CARLOS FERNANDO MOTOA SOLARTE', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (549, 'EDINSON DELGADO RUIZ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (550, 'IVAN DUQUE MARQUEZ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (551, 'JOSE OBDULIO GAVIRIA VELEZ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (552, 'JUAN MANUEL CORZO ROMAN', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (553, 'LUIS EMILIO SIERRA GRAJALES', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (554, 'LUIS FERNANDO VELASCO CHAVES', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (555, 'PALOMA VALENCIA LASERNA', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (556, 'SUSANA CORREA BORRERO ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (558, 'NOHORA TOVAR', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (559, 'Oscar Flórez Caicedo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (560, 'Josefina Barona Nieto', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (561, 'Jaime Otoya Domínguez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (563, 'Humberto Tenorio Durán', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (475, 'Brigadier General Nelson Ramírez Suarez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (476, 'Coronel Edgar Orlando Rodríguez Castrillón ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (478, 'Coronel Jairo Garzón Rey', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (568, 'Luis Fernando Londoño Capurro', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (569, 'Natalia Jaramillo Ramírez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (570, 'Claudia Ximena Calero', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (571, 'Álvaro Amaya Estévez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (573, 'Camilo Isaac', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (574, 'Javier Carbonel', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (575, 'Jorge Victoria', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (576, 'Martha Elena Caballero R.', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (578, 'Juan Pablo Rebolledo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (579, 'Mauricio Iragorri', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (580, 'Álvaro Correa Holguín', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (581, 'Álvaro José Correa Borrero', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (582, 'María Isabel Holguín ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (583, 'Fernando Holguin', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (584, 'Gustavo Moreno ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (585, 'Julian Vicente Holguin Ramos ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (586, 'Andres Holguin Ramos ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (587, 'Rodrigo Holguin ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (588, 'Jorge Julio Erada', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (589, 'Jairo Novoa', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (590, 'Juan José Lulle', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (591, 'Alfonso Camargo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (592, 'Andres Felipe Lulle Cabal', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (593, 'Gonzalo Ortíz Aristizabal ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (594, 'Alvaro José López ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (595, 'Jaime Vargas López', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (596, 'Harold Garrido  ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (597, 'Santiago Salcedo Borrero', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (598, 'Camilo Arturo Jaramillo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (599, 'Fernando Paz ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (601, 'Gustavo Medina ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (603, 'Isaac Gilinski', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (604, 'Daniel Galvis ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (605, 'Harold Eder Garcés ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (606, 'Henry Eder ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (607, 'Rodrigo Belalcazar', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (608, 'Andrés Rebolledo Cobo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (609, 'Alejandro Durán Sanclemente', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (610, 'Ciro Cabal y Ana María Durán Cabal', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (611, 'Manuel Londoño Cabal y Señora ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (612, 'Manuel Jose Londoño Cabal ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (613, 'Juan Manuel Cabal Villegas', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (614, 'Guido Mauricio López Ochoa ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (615, 'Alejandra López Ochoa ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (616, 'Eduardo Cruz', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (618, 'Jose Manuel Quintero Dávila', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (619, 'Diego Sanint Peláez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (620, 'Andres Hernán Charria Sanín', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (621, 'Alex Tanaka Kuratomi', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (623, 'Juan Pablo Sierra Maso', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (624, 'Germán Villegas Victoria ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (625, 'Carlos Alfonso Escobar Roldán', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (626, 'Federico Rojas', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (627, 'Richard Syriani Prince', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (628, 'Roger Syriani Prince', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (629, 'Jhon Alexander Aguel Kafruni', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (630, 'Fernando Hoyos Blanco', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (631, 'Juan manuel hoyos', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (632, 'Rodrigo Bernal Molina', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (634, 'Ricardo Merheg Sabbagh', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (635, 'Eduardo Mejía', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (636, 'Carlos Ardila Lulle', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (637, 'Jose Manuel Suso Domínguez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (638, 'Rodrigo Velasco LloAccionistasa', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (639, 'Carlos Arcesio Paz Bautista', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (640, 'Rodrigo Otoya Domínguez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (641, 'Alejandro Eder', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (642, 'Jacqueline Clarkson', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (643, 'Henry Ledesma y Sra ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (644, 'Carlos Ledesma', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (645, 'Martha Lorena Andrade', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (646, 'Sebastián Vélez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (647, 'Camilo Bastidas', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (648, 'Genaro A. Caicedo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (649, 'Felipe Garcés', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (652, 'Luis Guillermo Cabal', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (653, 'Alfonso León Trujillo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (654, 'Carlos Aragón  ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (655, 'Carlos Jaramillo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (656, 'Manuel Antonio Casas Castaño', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (657, 'Jesús Correa Álvarez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (565, 'Martha Betancourt', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (566, 'Carlos Hernando Molina', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (567, 'Juan Manuel Jaramillo Vargas', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (662, 'Jose Abel Mejía López', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (663, 'Elibardo Zapata', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (664, 'Jesús Evelio Ortega', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (666, 'Mauricio Salas', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (667, 'Sandra I Marulanda', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (668, 'Jorge Vieira Ángel', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (669, 'Luis Aníbal Ospina', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (670, 'Nazario Belalcázar', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (671, 'Jimena Marulanda', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (672, 'Jaime Young', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (674, 'Enrique Villegas Tascòn', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (675, 'Rodrigo Villegas Tascón ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (676, 'Diego Duque', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (677, 'Andres Mejía Cadavid', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (678, 'Alberto Gomez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (679, 'Ricardo Solís', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (680, 'Juan Carlos Cabal Cabal', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (681, 'Jaime Eduardo Cabal Cabal ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (682, 'Sergio Torres Troncoso ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (683, 'Danilo Ríos Castaño', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (684, 'Isaac Rabinovich Manevich', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (685, 'Edgar Dorronsoro Tenorio', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (686, 'Álvaro Enrique Molinares', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (687, 'Juan José Ayerbe Muñoz', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (688, 'Gustavo Adolfo Caicedo M.', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (689, 'Isabella Victoria', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (692, 'Victor Hugo Jaramillo ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (693, 'Norberto Jaramillo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (694, 'José Osiel Ospina', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (695, 'Jorge Birmaher ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (696, 'Olivier Pradet', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (697, 'Diego Domínguez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (698, 'Diego Dorronsoro', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (699, 'Wadith Nader', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (700, 'Mariano Ramos', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (701, 'Gerardo Rivera', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (703, 'Gabriel Prado', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (704, 'Álvaro Lora Garcés', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (705, 'Michele Rugeri Md', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (706, 'Carlos Mejia Gomez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (707, 'Raul Barrios', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (708, 'Eduardo Gonzales', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (709, 'Harold blum Capurro', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (710, 'Alan Blum ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (711, 'Emilio Sardi Aparicio y SRA. ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (712, 'Francisco Barberi y SRA', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (715, 'Juan Carlos Londoño', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (716, 'Álvaro Molina', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (717, 'Álvaro  Jose Molina Guzmán', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (718, 'Carlos Nishi', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (719, 'Jorge Ogliastri', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (720, 'Jorge Domínguez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (721, 'Augusto Solano', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (722, 'Diego Bayer y SRA', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (723, 'Héctor Fabio Cuellar', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (724, 'Ernesto de lima  le Frank ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (725, 'Ernesto de lima Bohmer ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (726, 'Gerardo Villalobos', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (727, 'Carolina Miyata', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (728, 'Estella Nakamura ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (729, 'Kukaei Tanaka ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (730, 'Andres Kuratomi', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (731, 'Diego Kuratomi ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (732, 'Ximena Iragorri Casas ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (733, 'Jean Carlo Ricci Garcia ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (734, 'Juan Manuel Sinisterra Naranjo ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (735, 'Ramiro Tafur Reyes', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (736, 'Sandra Mejia ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (737, 'Jose Darío Salazar ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (738, 'Christian Munir Garcés Aljure', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (739, 'Juan Felipe Caicedo ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (740, 'Guillermo Eduardo Ulloa', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (741, 'José Leibobich', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (742, 'Jose Agustin Grajales Mejía', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (743, 'Alvaro Parrado ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (744, 'Rodolfo Mendez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (745, 'Mauricio Cabrera ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (747, 'Luis Guillermo Restrepo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (748, 'Iván Contreras', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (749, 'Martha lucía Arboleda', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (750, 'Paulo Andres Londoño', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (751, 'Harold Lopez ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (752, 'Angelica Cardona ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (659, 'Geovanni López Quintero', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (660, 'Saúl H. Saavedra', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (661, 'Jose Ignacio Calvache', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (757, 'Álvaro Vives', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (758, 'Álvaro Ernesto Palacio Peláez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (759, 'Bernardo Botero', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (760, 'Alejandro Salazar Yusti ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (761, 'Ana Lucia Jaramillo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (762, 'Camilo Acevedo Rojas', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (763, 'Juan Felipe Correa', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (764, 'Sergio Uribe Arboleda', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (766, 'Antonio Puerto ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (767, 'Ricardo Valenzuela ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (768, 'Eduardo Soto ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (769, 'David Yanovich ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (770, 'Mery Perce de Rosemberg', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (771, 'Maria Leonor Cabal', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (772, 'Luis Ernesto Mejia ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (773, 'Julio Manuel Ayerbe', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (774, 'Alejandro Zacour', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (775, 'Ricardo Avila ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (776, 'Felipe Arango ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (778, 'Juan Guillermo Salazar Vallecilla ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (779, 'Javier Cuellar Moreno', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (780, 'Francisco Tenorio', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (781, 'Julian Berón', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (782, 'Juan Miguel Trefogli ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (783, 'Alexander Perez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (784, 'Francisco Arbelaez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (785, 'Edward Nuñez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (786, 'Carolina Salamanca', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (787, 'Elizabeth Torrente', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (789, 'Luis Felipe Rívas', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (790, 'Jesus Gonzales', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (791, 'Mario Figueroa ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (792, 'Pedro Blanco ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (793, 'Alberto Jose Castro Zawadski', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (794, 'Carlos Roberto Ricaute', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (795, 'Jose Jasso ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (796, 'Ricardo Otoya', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (798, 'Alfonso Riascos ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (799, 'Juan Manuel Caicedo Rodas', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (800, 'Dario Gómez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (801, 'Guillermo López', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (802, 'Jaime Alberto Martinez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (803, 'Jorge Alberto Abondano ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (804, 'Luis Javier Gómez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (805, 'Hernan Martinez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (806, 'Giset Fernandez Salazar', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (807, 'Rafaél Mejia ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (808, 'Francisco Aguirre ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (809, 'German Silva ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (810, 'Sebastian Gil', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (812, 'Juan Felipe Caicedo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (813, 'Carlos Gustavo Cano', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (814, 'William Caceres ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (815, 'Carlos Vasquez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (816, 'Cesar Augusto Lemos Gil', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (817, 'Juan Carlos Maya', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (818, 'Maria Mercedez Lalinde', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (819, 'Santiago Holguin Salamanca', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (820, 'Alberto Hadad', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (822, 'Olga Lucia Quevedo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (823, 'Claudia Ocampo M', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (824, 'Angela Maria Saavedra ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (825, 'AlfAccionistaso Arana Velazco ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (826, 'Jimmy Jaramilllo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (827, 'Eduardo Hoguin', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (828, 'Alan Blum Vasquez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (829, 'Ricardo Morales', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (831, 'Luis Ferney López Concha ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (832, 'Eliana Agudelo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (833, 'Miguel Sanchez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (834, 'Luis Felipe López', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (835, 'Alvaro Tamayo ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (836, 'Liberio Cuellar', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (837, 'Yenia Abadia ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (838, 'Diana Lucia Prado', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (839, 'Miguel José Tejada', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (840, 'Hernando Tejada', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (841, 'Gustavo Adolfo Gómez Cardona', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (842, 'Bernardo Uribe', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (844, 'Allie Blum', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (845, 'AlfAccionistaso Dominguez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (846, 'Miguel Gómez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (847, 'Camilo Mutis y Lady Orozco ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (848, 'Jaime A Madriñan', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (849, 'Andres Martinez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (755, 'Cristian David López', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (756, 'Edgar Chalhoub', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (13, 'Alirio Jaramillo', '', 1, '', '', '', NULL, 1, NULL, false);
INSERT INTO asistentes VALUES (853, 'Mei Buenaventura', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (854, 'Gustavo Caicedo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (855, 'Rodrigo Sanint', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (856, 'Mauricio Cabrera', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (857, 'Juan Jose Saavedra', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (858, 'Alfonso Ocampo Gaviria ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (859, 'Bernardo Quintero ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (860, 'Luis Fernando Ramirez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (861, 'Gustavo Rangel ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (862, 'Mario Bedoya', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (863, 'Miguel Chinchilla ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (864, 'German Efromovich', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (865, 'Jose Felix Lafaurie Rivera', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (866, 'Juan M. Chaves C.', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (867, 'Clara Leticia Serrano', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (869, 'Napoleón Viveros', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (870, 'Jorge Dominguez Navia', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (871, 'Julian Mora Gómez', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (872, 'Luis Fernando Castro', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (873, 'Marcos Botta', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (874, 'Nicolás Guzmán Fajardo', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (875, 'Nuno Monteiro', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (876, 'Christopher Weisz', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (877, 'Jean-Werner de T’Serclaes', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (17, 'Israel Molina', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (19, 'Gonzalo Barreneche', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (33, 'Sergio Urdinola ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (42, 'Adalberto Arroyo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (61, 'Christian Sandoval', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (81, 'Héctor Fabio Marin Cardona', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (103, 'Mauro Urbano', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (112, 'Thomas Schierenbeck', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (126, 'Ernesto Pino Visinteiner', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (148, 'Ricardo Castro ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (172, 'Mauricio López', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (192, 'Diana Vanessa ColLazos ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (204, 'Maria Fernanda Muñoz', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (241, 'María Cristina Cadavid ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (247, 'Juan Pablo Cuellar Varona ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (269, 'Pedro Enrique Cardona López', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (294, 'Alexander Bohórquez', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (312, 'Rodrigo Lince Tenorio', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (343, 'Carlos Andrés Ospina Caicedo y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (386, 'Julio Victoria Bueno y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (403, 'Paula Saavedra González e Hijos', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (427, 'AlfAccionistaso Fernández de Soto Saavedra', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (459, 'Humberto Botero', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (474, 'Coronel Camilo Ernesto Álvarez Ochoa ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (477, 'Brigadier General Wilson Chawez Mahecha', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (504, 'Alcalde Edward Fernado García Sánchez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (537, 'Ramon Gandarias Alonso de Celis ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (562, 'Juan Ramón Guzmán S.', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (564, 'Rafael Uribe Toro', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (577, 'Guillermo Rebolledo Mejía', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (600, 'César Augusto Arango Isaza', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (622, 'Carlos Hernando Azcarate Tascón', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (650, 'Luis Miguel Cabal', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (658, 'Felipe Martínez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (665, 'Carlos Gilberto Herrera Gutiérrez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (713, 'Francisco José Cabal y SRA Olga Londoño de cabal', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (746, 'Diego Martinez LloAccionistasa', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (753, 'Juan Rodrigo Alvarado', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (765, 'Isaac Yanovich  Farbaiarz ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (788, 'Fernando Gómez', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (811, 'Juan Sebastian Correa', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (830, 'Maria Figueroa ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (850, 'Miguel López', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (851, 'Carlos E Pinzón', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (852, 'Mauricio Madriñan ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (52, 'Johnny Ambrosio', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (69, 'Nelson Darío Ramírez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (90, 'Luis Fernando Marín', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (107, 'Fernando Bernal Camejo', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (133, 'John Vollmer Jr ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (151, 'Juan Carlos Sarmiento', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (167, 'Abraham Victoria', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (185, 'Higinio Mina', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (202, 'Eblin Delgado', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (220, 'Eric Valencia Salom - Gustavo Rangel ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (264, 'Luis Fernando Castro Vergara ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (293, 'Carlos Alberto Marín', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (298, 'Hugo Hernán Guzmán', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (367, 'Héctor Manuel Sandoval Castillo y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (702, 'Gabriel Reyes', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (714, 'Gilberto Iragorri y SRA. Carmen Eugenia Londoño Capurro', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (754, 'Juan Esteban Ocampo ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (777, 'Martha Lucia Ramires ', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (797, 'Luis Fernando Cespedes ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (821, 'Andres Felipe Salazar', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (843, 'Harold Carvajal Andres Gutierrez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (868, 'Martha Joven Plazas', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (219, 'Anthony Halliday Berón', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (317, 'AlfAccionistaso Fernandéz De Soto Saavedra', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (334, 'Ana Milena Lemos PaAccionistases ', '', 1, '', '', '', 6, 1, NULL, false);
INSERT INTO asistentes VALUES (354, 'Rodrigo Caicedo Lourido y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (387, 'Felipe Victoria González y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (418, 'Daniel Caicedo Llano', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (432, 'Enrique Gustavo Gómez Vallecilla y Señora', '', 1, '', '', '', 3, 1, NULL, false);
INSERT INTO asistentes VALUES (473, 'Mayor César Alberto Rivera Aríza ', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (489, 'Luis Humberto Martínez Lacouture', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (506, 'Alcalde José Leonardo Valencia Narvaez', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (534, 'Sergio Alfonso Troncoso Rico', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (557, 'MARITZA MARTINEZ ARISTIZABAL', '', 1, '', '', '', 4, 1, NULL, false);
INSERT INTO asistentes VALUES (572, 'Nicolás Javier Gil Zapata', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (602, 'Juan Cristobal Romero', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (617, 'Fabiola María Montealegre Echeverry', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (633, 'Francisco Villegas Tascón', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (651, 'Gloria Stella Ramírez', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (673, 'Luis Fernando Giraldo', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (690, 'Francisco José Lourido Muñoz', '', 1, '', '', '', 5, 1, NULL, false);
INSERT INTO asistentes VALUES (691, 'Maria Eugenia Saavedra Hernandez', '', 1, '', '', '', 5, 1, NULL, false);


--
-- Data for Name: empresa; Type: TABLE DATA; Schema: public; Owner: nativoapps
--

INSERT INTO empresa VALUES (1, 1, 'nit', '34331385', 'Evento', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO empresa VALUES (2, 2, 'NIT', '89988774', 'BENGALA AGRICOLA', '', '', '', '2016-03-30 00:00:00', '2016-03-31 00:00:00', 10, 10, '', 1, '', '', NULL, '2016-03-08 14:46:26.172569', '', '#FFFFFF                                                                                                                                                                                                                                                        ', '                                                                                                                                                                                                                                                                                                            ', '                                                                                                                                                                                                                                                               ', '10', '10');


--
-- Data for Name: estados; Type: TABLE DATA; Schema: public; Owner: nativoapps
--

INSERT INTO estados VALUES (1, 1, 'Activo', 1, NULL, NULL);
INSERT INTO estados VALUES (2, 2, 'Inactivo', 1, NULL, NULL);
INSERT INTO estados VALUES (3, 3, 'Eliminado', 1, NULL, NULL);


--
-- Data for Name: evento; Type: TABLE DATA; Schema: public; Owner: nativoapps
--

INSERT INTO evento VALUES (1, 'Mi evento', 'Este es un evento de prueba', 1, 1);
INSERT INTO evento VALUES (2, 'BENGALA', 'BENGALA', 1, 2);


--
-- Data for Name: identificacion; Type: TABLE DATA; Schema: public; Owner: nativoapps
--

INSERT INTO identificacion VALUES (2, 1, '#dcaa1d', 1, '', 1, 3);
INSERT INTO identificacion VALUES (1, 1, '#c3c27c', 1, 'Nueva', 1, 3);
INSERT INTO identificacion VALUES (4, 2, '#faac58', 3, 'Naranja', 2, 1);
INSERT INTO identificacion VALUES (5, 2, '#74df00', 4, 'Verde', 2, 1);
INSERT INTO identificacion VALUES (6, 2, '#ffff00', 5, 'Amarillo', 2, 1);
INSERT INTO identificacion VALUES (3, 2, '#ff4000', 2, 'Rojo', 2, 1);
INSERT INTO identificacion VALUES (7, 4, '#f5a9d0', 6, 'Rosado Oscuro', 2, 1);


--
-- Data for Name: menus; Type: TABLE DATA; Schema: public; Owner: nativoapps
--

INSERT INTO menus VALUES (1, 'Configuración', '<i class="fa fa-cogs"></i>', 0, 1, '2015-06-09 00:00:00', '2015-07-08 16:58:41.27557', '');
INSERT INTO menus VALUES (4, 'Contenido', '', 1, 1, '2015-06-09 00:00:00', '2015-06-17 15:41:13.581747', 'menus/');
INSERT INTO menus VALUES (3, 'Roles', '', 1, 1, '2015-06-09 00:00:00', '2015-06-17 15:41:30.442541', 'roles/');
INSERT INTO menus VALUES (44, 'Usuarios', '<i class="fa fa-user"></i>', 0, 1, '2015-07-29 00:00:00', '2015-07-29 00:00:00', '');
INSERT INTO menus VALUES (2, 'Usuarios', '', 44, 1, '2015-06-09 00:00:00', '2015-06-17 15:08:12.399726', 'usuarios/');
INSERT INTO menus VALUES (6, 'Empresas', '', 1, 0, '2015-06-12 01:11:37.35929', '2015-06-12 22:19:07.077909', '');
INSERT INTO menus VALUES (16, 'Empresas', '', 1, 1, '2015-06-17 15:39:19.90374', '2015-06-17 15:39:19.90374', 'empresas/');
INSERT INTO menus VALUES (45, 'Zonas', '', 1, 1, '2016-02-26 19:16:55.10307', '2016-02-26 19:51:26.562564', 'zonas/');
INSERT INTO menus VALUES (46, 'Tipos Asistente', '', 1, 1, '2016-02-26 20:16:03.384114', '2016-02-26 20:16:03.384114', 'tipo_asistentes/');
INSERT INTO menus VALUES (47, 'Identificaciones', '', 1, 1, '2016-02-26 22:07:38.067278', '2016-02-26 22:07:38.067278', 'identificaciones/');
INSERT INTO menus VALUES (50, 'Asistentes', '<i class="fa fa-users"></i>', 0, 1, '2016-02-29 17:22:15.765045', '2016-02-29 17:22:58.972566', '');
INSERT INTO menus VALUES (49, 'Registro Asistentes', '', 50, 1, '2016-02-28 15:26:31.772966', '2016-02-29 17:23:31.339669', 'registro_asistentes/');
INSERT INTO menus VALUES (48, 'Asistentes', '', 50, 1, '2016-02-27 14:56:26.825961', '2016-02-29 17:23:46.152073', 'asistentes/');
INSERT INTO menus VALUES (51, 'Reportes', '<i class="fa fa-wrench"></i>', 0, 1, '2016-03-07 02:49:13.368125', '2016-03-07 02:49:13.368125', '');
INSERT INTO menus VALUES (52, 'Dashboard', '', 51, 1, '2016-03-07 02:50:01.875558', '2016-03-07 02:50:01.875558', 'dashboards/');
INSERT INTO menus VALUES (53, 'Importar', '', 1, 1, '2016-03-09 15:29:10.853481', '2016-03-09 15:29:10.853481', 'importar/');


--
-- Data for Name: perm_rol_menu; Type: TABLE DATA; Schema: public; Owner: nativoapps
--

INSERT INTO perm_rol_menu VALUES (3, 1, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (3, 4, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (3, 3, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (3, 44, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (3, 2, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (3, 16, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (3, 45, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (3, 46, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (3, 47, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (3, 50, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (3, 49, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (3, 48, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (3, 51, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (3, 52, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (4, 1, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (4, 4, 0, 0, 0, 0);
INSERT INTO perm_rol_menu VALUES (4, 3, 0, 0, 0, 0);
INSERT INTO perm_rol_menu VALUES (4, 44, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (4, 2, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (4, 16, 0, 0, 0, 0);
INSERT INTO perm_rol_menu VALUES (4, 45, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (4, 46, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (4, 47, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (4, 50, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (4, 49, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (4, 48, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (4, 51, 1, 1, 1, 1);
INSERT INTO perm_rol_menu VALUES (4, 52, 1, 1, 1, 1);


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: nativoapps
--

INSERT INTO roles VALUES (4, 4, 'Adm Evento', 1, 'Administrador', 1, '2016-02-29 13:16:49.141832', '2016-02-29 13:16:49.141832', 4);
INSERT INTO roles VALUES (1, 1, 'superadmin', 1, 'Usuario Super Administrador', 1, '2015-06-09 00:00:00', '2015-06-09 00:00:00', 1);


--
-- Data for Name: tipo_asistentes; Type: TABLE DATA; Schema: public; Owner: nativoapps
--

INSERT INTO tipo_asistentes VALUES (1, 'Nuevo Tipo', 1, 1);
INSERT INTO tipo_asistentes VALUES (2, 'Invitado', 1, 2);
INSERT INTO tipo_asistentes VALUES (3, 'Acompañante', 1, 2);
INSERT INTO tipo_asistentes VALUES (4, 'Periodista Encargado', 1, 2);


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: nativoapps
--

INSERT INTO usuarios VALUES (2, 2, 2, 'Administrador Eventos', 'admin@eventos.com', NULL, 'admin@eventos.com', NULL, 'admin@eventos.com', NULL, '827ccb0eea8a706c4c34a16891f84e7b', NULL, 4, 1, NULL, NULL, NULL, NULL, NULL);
INSERT INTO usuarios VALUES (6, 2, 6, 'epacheco', '', '', '', '', 'epacheco@eventos.com', 'd41d8cd98f00b204e9800998ecf8427e', '827ccb0eea8a706c4c34a16891f84e7b', 2, 4, 1, NULL, '2016-03-08 13:13:13.467454', '2016-03-08 13:13:13.467454', '', NULL);
INSERT INTO usuarios VALUES (4, 2, 4, 'Heyler Guaza', '', '', '', 'http://nativoapps.com/NFC/img/imagenes_usuarios/201603031603030404.jpg', 'Guaza', 'd41d8cd98f00b204e9800998ecf8427e', 'ca0717b92b56a46cfe6d90cd8fd48d5c', 2, 4, 1, NULL, '2016-03-03 16:52:04.684077', '2016-03-03 16:52:04.684077', '', NULL);
INSERT INTO usuarios VALUES (1, 1, 1, 'SUPER ADMIN', '', '', '', '', 'Enigmaeventos', NULL, '86342b3713112f11ba1de667c73e6eb7', 0, 1, 1, NULL, NULL, '2016-02-29 20:45:52.785523', '', NULL);
INSERT INTO usuarios VALUES (7, 2, 7, 'Juana Caicedo', '', '', '', '', 'Juana', 'd41d8cd98f00b204e9800998ecf8427e', '827ccb0eea8a706c4c34a16891f84e7b', 2, 4, 1, NULL, '2016-03-08 16:19:31.401061', '2016-03-08 16:19:31.401061', '', NULL);


--
-- Data for Name: zonas; Type: TABLE DATA; Schema: public; Owner: nativoapps
--

INSERT INTO zonas VALUES (1, 'Nueva Zona', 1, 1);
INSERT INTO zonas VALUES (2, 'Accionistas', 1, 2);
INSERT INTO zonas VALUES (4, 'Sector Bengala, Clientes', 1, 2);
INSERT INTO zonas VALUES (6, 'Periodistas', 1, 2);
INSERT INTO zonas VALUES (5, 'Sector Financiero, Medicina', 1, 2);
INSERT INTO zonas VALUES (3, 'Gobierno, Invitados Especiales', 1, 2);


--
-- Name: asistente_evento_id_key; Type: CONSTRAINT; Schema: public; Owner: nativoapps; Tablespace: 
--

ALTER TABLE ONLY asistente_evento
    ADD CONSTRAINT asistente_evento_id_key UNIQUE (id);


--
-- Name: asistentes_id_key; Type: CONSTRAINT; Schema: public; Owner: nativoapps; Tablespace: 
--

ALTER TABLE ONLY asistentes
    ADD CONSTRAINT asistentes_id_key UNIQUE (id);


--
-- Name: empresa_pkey; Type: CONSTRAINT; Schema: public; Owner: nativoapps; Tablespace: 
--

ALTER TABLE ONLY empresa
    ADD CONSTRAINT empresa_pkey PRIMARY KEY (empresa_numero);


--
-- Name: estados_pkey; Type: CONSTRAINT; Schema: public; Owner: nativoapps; Tablespace: 
--

ALTER TABLE ONLY estados
    ADD CONSTRAINT estados_pkey PRIMARY KEY (estado_registro);


--
-- Name: evento_id_key; Type: CONSTRAINT; Schema: public; Owner: nativoapps; Tablespace: 
--

ALTER TABLE ONLY evento
    ADD CONSTRAINT evento_id_key UNIQUE (id);


--
-- Name: menus_pkey; Type: CONSTRAINT; Schema: public; Owner: nativoapps; Tablespace: 
--

ALTER TABLE ONLY menus
    ADD CONSTRAINT menus_pkey PRIMARY KEY (id);


--
-- Name: roles_pkey; Type: CONSTRAINT; Schema: public; Owner: nativoapps; Tablespace: 
--

ALTER TABLE ONLY roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (rol_numero);


--
-- Name: tipo_asistentes_id_key; Type: CONSTRAINT; Schema: public; Owner: nativoapps; Tablespace: 
--

ALTER TABLE ONLY tipo_asistentes
    ADD CONSTRAINT tipo_asistentes_id_key UNIQUE (id);


--
-- Name: usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: nativoapps; Tablespace: 
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (usuario_numero);


--
-- Name: zonas_id_key; Type: CONSTRAINT; Schema: public; Owner: nativoapps; Tablespace: 
--

ALTER TABLE ONLY zonas
    ADD CONSTRAINT zonas_id_key UNIQUE (id);


--
-- Name: asistente_evento_id_asistente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: nativoapps
--

ALTER TABLE ONLY asistente_evento
    ADD CONSTRAINT asistente_evento_id_asistente_fkey FOREIGN KEY (id_asistente) REFERENCES asistentes(id);


--
-- Name: id_tipo; Type: FK CONSTRAINT; Schema: public; Owner: nativoapps
--

ALTER TABLE ONLY identificacion
    ADD CONSTRAINT id_tipo FOREIGN KEY (id_tipo) REFERENCES tipo_asistentes(id);


--
-- Name: identificacion_id_zona_fkey; Type: FK CONSTRAINT; Schema: public; Owner: nativoapps
--

ALTER TABLE ONLY identificacion
    ADD CONSTRAINT identificacion_id_zona_fkey FOREIGN KEY (id_zona) REFERENCES zonas(id);


--
-- Name: identificacion_id_zona_fkey1; Type: FK CONSTRAINT; Schema: public; Owner: nativoapps
--

ALTER TABLE ONLY identificacion
    ADD CONSTRAINT identificacion_id_zona_fkey1 FOREIGN KEY (id_zona) REFERENCES zonas(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

