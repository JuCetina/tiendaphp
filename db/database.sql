CREATE DATABASE tienda;
USE tienda;

CREATE TABLE usuarios(
    id          int(20) auto_increment not null,
    nombres     varchar(100) not null,
    apellidos   varchar(100) not null,
    email       varchar(50) not null,
    password    varchar(50) not null,
    rol         varchar(15) not null,
    imagen      varchar(255) null,
    CONSTRAINT pk_usuarios PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDB;

CREATE TABLE categorias(
    id      int(20) auto_increment not null,
    nombre  varchar(50) not null,
    CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE pedidos(
    id              int(20) auto_increment not null,
    usuario_id      int(20) not null,
    departamento    varchar(30) not null,
    ciudad          varchar(30) not null,
    direccion       varchar(80) not null,
    costo           float(200,2) not null,
    estado          varchar(20) not null,
    fecha           date not null,
    hora            time not null,
    CONSTRAINT pk_pedidos PRIMARY KEY(id),
    CONSTRAINT fk_pedidos_usuarios FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDB;

CREATE TABLE productos(
    id              int(20) auto_increment not null,
    categoria_id    int(20) not null,
    nombre          varchar(100) not null,
    descripcion     varchar(200) not null,
    precio          float(100,2) not null,
    stock           int(30) not null,
    oferta          varchar(2) not null,
    fecha           date not null,
    imagen          varchar(255) not null,
    CONSTRAINT pk_productos PRIMARY KEY(id),
    CONSTRAINT fk_productos_categorias FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDB;

CREATE TABLE pedidos_productos(
    id              int(20) not null,
    pedido_id       int(20) not null,
    producto_id     int(20) not null,
    unidades        int(100) not null,
    CONSTRAINT pk_pedidos_productos PRIMARY KEY(id),
    CONSTRAINT fk_pedidos_productos_pedidos FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
    CONSTRAINT fk_pedidos_productos_productos FOREIGN KEY(producto_id) REFERENCES productos(id)
)ENGINE=InnoDB;

