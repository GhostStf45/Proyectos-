CREATE DATABASE tienda_master;

USE tienda_master;

CREATE TABLE usuarios (
    id_usuario   INT(5) auto_increment NOT NULL,
    nombre       VARCHAR(100) NOT NULL,
    apellido     VARCHAR(100),
    email        VARCHAR(255) NOT NULL,
    password     VARCHAR(255) NOT NULL,
    rol          VARCHAR(100),
    image        VARCHAR(255),

    CONSTRAINT uq_email UNIQUE(email),
    CONSTRAINT usuarios_pk PRIMARY KEY ( id_usuario )
)ENGINE=InnoDB;

CREATE TABLE categorias (
    id_categoria       INT(5) NOT NULL,
    nombre_categoria   VARCHAR(255),

    CONSTRAINT categorias_pk PRIMARY KEY ( id_categoria ) 
)ENGINE=InnoDB;

CREATE TABLE productos (
    id_producto       INT(6) NOT NULL,
    id_categoria      INT(5) NOT NULL,
    nombre_producto   VARCHAR(255) NOT NULL,
    descripcion       MEDIUMTEXT,
    precio            FLOAT(10,2) NOT NULL,
    stock             INT(7) NOT NULL,
    oferta            VARCHAR(2),
    fecha_adicionar   DATE NOT NULL,
    imagen_prod       VARCHAR(255),
    
    CONSTRAINT productos_pk PRIMARY KEY ( id_producto ),
    CONSTRAINT productos_categorias_fk FOREIGN KEY ( id_categoria )
        REFERENCES categorias ( id_categoria )
);



CREATE TABLE pedidos (
    id_pedido      INT(7) NOT NULL,
    id_usuario     INT(5) NOT NULL,
    provincia      VARCHAR(255),
    localidad      VARCHAR(255),
    direccion      VARCHAR(255),
    coste_total    FLOAT(9,2),
    estado         VARCHAR(20),
    fecha_pedido   DATE,
    hora           TIME,
    
    CONSTRAINT pedidos_pk PRIMARY KEY ( id_pedido ),
    CONSTRAINT pedidos_usuarios_fk FOREIGN KEY ( id_usuario )
        REFERENCES usuarios ( id_usuario )
)ENGINE=InnoDB;

CREATE TABLE lineas_pedidos (
    id_linea_pedido   INT(9) NOT NULL,
    id_pedido         INT(7) NOT NULL,
    id_producto       INT(6) NOT NULL,
    unidades          INT(9) NOT NULL,
    
    CONSTRAINT lineas_pedidos_pk PRIMARY KEY ( id_linea_pedido ),
    CONSTRAINT lineas_pedidos_pedidos_fk FOREIGN KEY ( id_pedido )
        REFERENCES pedidos ( id_pedido ),
    CONSTRAINT lineas_pedidos_productos_fk FOREIGN KEY ( id_producto )
        REFERENCES productos ( id_producto )

    
)ENGINE=InnoDB;
