CREATE DATABASE flybook;
USE flybook;
CREATE TABLE usuarios
(
    id               VARCHAR(10) DEFAULT UUID(),
    nombre           VARCHAR(25)  NOT NULL,
    apellido         VARCHAR(25)  NOT NULL,
    docid            VARCHAR(25)  NOT NULL UNIQUE,
    fecha_nacimiento DATETIME     NOT NULL,
    email            VARCHAR(255) NOT NULL UNIQUE,
    password         VARCHAR(255) NOT NULL,
    fecha_registro   DATETIME     NOT NULL,
    estado           TINYINT      NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE libros
(
    id                VARCHAR(10) DEFAULT UUID(),
    id_vendedor       VARCHAR(10)  NOT NULL,
    titulo            VARCHAR(255) NOT NULL,
    autor             VARCHAR(255) NOT NULL,
    editor            VARCHAR(255),
    img1              VARCHAR(255) NOT NULL,
    img2              VARCHAR(255),
    img3              VARCHAR(255),
    fecha_publicacion DATE         NOT NULL,
    isbn              VARCHAR(255),
    issn              VARCHAR(255),
    fecha_subida      DATETIME     NOT NULL,
    precio            VARCHAR(10)  NOT NULL,
    calidad           INT          NOT NULL,
    activo            TINYINT      NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_vendedor)
        REFERENCES usuarios (id)
        ON
            UPDATE CASCADE
        ON
            DELETE RESTRICT
);
CREATE TABLE compras
(
    id           VARCHAR(10) DEFAULT UUID(),
    id_usuario   VARCHAR(10) NOT NULL,
    id_libro     VARCHAR(10) NOT NULL,
    fecha_compra DATETIME    NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_usuario)
        REFERENCES usuarios (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY (id_libro)
        REFERENCES usuarios (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
)