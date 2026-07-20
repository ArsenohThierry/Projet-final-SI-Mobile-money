


CREATE TABLE
    operateur (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nom TEXT NOT NULL,
        email TEXT UNIQUE NOT NULL,
        password TEXT NOT NULL,
        date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
    );




CREATE TABLE
    client (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nom TEXT NOT NULL,
        numero TEXT UNIQUE NOT NULL,
        date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
    );





CREATE TABLE
    prefixe (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        prefixe TEXT UNIQUE NOT NULL
    );




CREATE TABLE
    type_operation (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        libelle TEXT UNIQUE NOT NULL
    );










CREATE TABLE
    bareme_frais (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        id_type_operation INTEGER NOT NULL,
        montant_min DECIMAL(12, 2) NOT NULL,
        montant_max DECIMAL(12, 2) NOT NULL,
        frais DECIMAL(12, 2) NOT NULL DEFAULT 0,
        FOREIGN KEY (id_type_operation) REFERENCES type_operation (id)
    );





CREATE TABLE
    transaction_mm (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        id_type_operation INTEGER NOT NULL,
        montant DECIMAL(12, 2) NOT NULL,
        date_transaction DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_type_operation) REFERENCES type_operation(id)
    );





CREATE TABLE
    mouvement (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        id_transaction INTEGER NOT NULL,
        id_client INTEGER NOT NULL,
        sens TEXT NOT NULL CHECK (sens IN ('DEBIT', 'CREDIT')),
        montant DECIMAL(12, 2) NOT NULL,
        frais DECIMAL(12, 2) NOT NULL DEFAULT 0,
        FOREIGN KEY (id_transaction) REFERENCES transaction_mm (id),
        FOREIGN KEY (id_client) REFERENCES client (id)
    );





CREATE TABLE
    gain (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        id_transaction INTEGER NOT NULL,
        montant DECIMAL(12, 2) NOT NULL,
        date_gain DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_transaction) REFERENCES transaction_mm (id)
    );


INSERT INTO operateur (nom, email, password) VALUES
('admin', 'admin@gmail.com', 'admin');

INSERT INTO client (nom, numero) VALUES
('Jean', '0341234567');



INSERT INTO client(nom,numero)
VALUES
('Alice','0340000001'),
('Bob','0330000002');

INSERT INTO type_operation(libelle)
VALUES
('DEPOT'),
('RETRAIT'),
('TRANSFERT');


INSERT INTO bareme_frais(
id_type_operation,
montant_min,
montant_max,
frais
)
VALUES
(2,0,100000,500),
(3,0,100000,300);