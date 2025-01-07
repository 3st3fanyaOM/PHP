CREATE TABLE cervezas (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- Identificador único
    tipo VARCHAR(50) NOT NULL,                 -- Tipo de cerveza
    denominacion VARCHAR(50) NOT NULL,         -- Denominación del alimento
    envase VARCHAR(50) NOT NULL,               -- Tipo de envase
    cantidad VARCHAR(50) NOT NULL,             -- Cantidad (tamaño del envase)
    marca VARCHAR(100) NOT NULL,               -- Marca
    advertencia TEXT,                          -- Advertencia sobre consumo
    fechacaducidad DATE,                       -- Fecha de consumo preferente
    alergenos TEXT,                            -- Lista de alérgenos (almacenados como texto)
    observaciones TEXT,                        -- Observaciones adicionales
    foto VARCHAR(255)                          -- Ruta de la foto subida
);