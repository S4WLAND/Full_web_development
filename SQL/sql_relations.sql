INSERT INTO appsalon.clientes (
    nombre,
    apellido,
    telefono,
    email
)
VALUES (
    'Juan',
    'Pérez',
    '123456789',
    'juan.correo@correo.com'
);

-- query two
INSERT INTO appsalon.clientes (
    nombre,
    apellido,
    telefono,
    email
)
VALUES (
    'Ana',
    'Gómez',
    '987654321',
    'ana.correo@correo.com'
);

SELECT * FROM citas;
SELECT * FROM clientes;


SELECT * 
FROM citas 
INNER JOIN clientes 
ON clientes.id = citas.cliente_id;

CREATE TABLE citas_servicios (
    id INT(11) AUTO_INCREMENT,
    cita_id INT(11) NOT NULL,
    servicio_id INT(11) NOT NULL,
    PRIMARY KEY (id),
    KEY cita_id (cita_id),
    CONSTRAINT citas_FK
    FOREIGN KEY (cita_id)
    REFERENCES citas (id),
    KEY servicio_id (servicio_id),
    CONSTRAINT servicios_FK
    FOREIGN KEY (servicio_id)
    REFERENCES servicios (id)

);

INSERT INTO citas_servicios (
    cita_id,
    servicio_id
)
VALUES (
    1,
    8
);

SELECT * FROM citas_servicios
LEFT JOIN citas ON citas.id = citas_servicios.cita_id
LEFT JOIN clientes ON citas.cliente_id = clientes.id
LEFT JOIN servicios ON servicios.id = citas_servicios.servicio_id;

INSERT INTO citas_servicios (
    cita_id,
    servicio_id
)
VALUES (
    3,
    3

);