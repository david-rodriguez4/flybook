CREATE
DATABASE flybook;
USE
flybook;
CREATE TABLE usuarios
(
    id             VARCHAR(255) NOT NULL UNIQUE,
    nombre         VARCHAR(255) NOT NULL,
    documento      VARCHAR(255) NOT NULL,
    telefono       VARCHAR(255) NOT NULL,
    email          VARCHAR(255) NOT NULL UNIQUE,
    password       VARCHAR(255) NOT NULL,
    direccion      VARCHAR(255) NOT NULL,
    fecha_registro DATETIME     NOT NULL,
    estado         TINYINT      NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE libros
(
    id               VARCHAR(255) NOT NULL UNIQUE,
    id_vendedor      VARCHAR(255) NOT NULL,
    titulo           VARCHAR(255) NOT NULL,
    autor            VARCHAR(255) NOT NULL,
    editorial        VARCHAR(255),
    edicion          VARCHAR(255),
    img1             VARCHAR(255) NOT NULL,
    img2             VARCHAR(255) NOT NULL,
    img3             VARCHAR(255) NOT NULL,
    year_publicacion VARCHAR(255) NOT NULL,
    isbn             VARCHAR(255),
    issn             VARCHAR(255),
    fecha_subida     DATETIME     NOT NULL,
    precio           VARCHAR(10)  NOT NULL,
    calidad          INT          NOT NULL,
    activo           TINYINT      NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_vendedor)
        REFERENCES usuarios (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);
CREATE TABLE compraventa
(
    id           VARCHAR(255) NOT NULL UNIQUE,
    id_vendedor  VARCHAR(255) NOT NULL,
    id_comprador VARCHAR(255) NOT NULL,
    id_libro     VARCHAR(255) NOT NULL,
    id_pago      VARCHAR(255),
    img_pago     VARCHAR(255),
    id_envio     VARCHAR(255),
    img_envio    VARCHAR(255),
    estado       TINYINT      NOT NULL,
    fecha_pago   DATETIME,
    fecha_envio  DATETIME,
    PRIMARY KEY (id),
    FOREIGN KEY (id_vendedor)
        REFERENCES usuarios (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY (id_comprador)
        REFERENCES usuarios (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY (id_libro)
        REFERENCES libros (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
)