CREATE TABLE usuaris (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_cognoms VARCHAR(100) NOT NULL,
    correu VARCHAR(100) NOT NULL UNIQUE,
    contrasenya VARCHAR(255) NOT NULL,
    telefon VARCHAR(20),
    rol ENUM('Professor', 'Tecnic', 'Admin') NOT NULL,
    habilitat BOOLEAN DEFAULT TRUE,
    data_registre TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE incidencies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    creador_nom_cognoms VARCHAR(100) NOT NULL,
    reporter_nom_cognoms VARCHAR(100),
    reporter_email VARCHAR(100),
    titol_fallo VARCHAR(150),
    descripcio TEXT NOT NULL,
    tipus_incidencia ENUM('Calefacció', 'Electricitat/Fontaner', 'Informàtica', 'Fusteria', 'Ferrer', 'Obres', 'Audiovisual', 'Equips de seguretat', 'Neteja de clavegueram') NOT NULL,
    id_ubicacio INT,
    data_incidencia TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estat ENUM('Pendent', 'En Progrés', 'Resolta') DEFAULT 'Pendent',
    prioritat ENUM('Baixa', 'Mitjana', 'Alta') DEFAULT 'Baixa',
    imatges TEXT,
    FOREIGN KEY (id_ubicacio) REFERENCES sales(id) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE sales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    planta ENUM('Planta -1', 'Planta 0', 'Planta 1', 'Planta 2', 'Planta 3', 'Planta 4', 'Altres') NOT NULL,
    sala VARCHAR(100) NOT NULL
);
