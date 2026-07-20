-- =====================================
-- OPERATEUR VolaAtHome
-- =====================================
CREATE TABLE
    operateur (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nom TEXT NOT NULL,
        email TEXT UNIQUE NOT NULL,
        password TEXT NOT NULL,
        date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
    );

-- =====================================
-- CLIENT
-- =====================================
CREATE TABLE
    client (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nom TEXT NOT NULL,
        numero TEXT UNIQUE NOT NULL,
        date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
    );

-- =====================================
-- PREFIXE TELEPHONE
-- Exemple : 033, 034, 037
-- =====================================
CREATE TABLE
    prefixe (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        prefixe TEXT UNIQUE NOT NULL
    );

-- =====================================
-- TYPE D'OPERATION
-- =====================================
CREATE TABLE
    type_operation (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        libelle TEXT UNIQUE NOT NULL
    );

-- =====================================
-- BAREME DES FRAIS
-- =====================================
CREATE TABLE
    bareme_frais (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        id_type_operation INTEGER NOT NULL,
        montant_min DECIMAL(12, 2) NOT NULL,
        montant_max DECIMAL(12, 2) NOT NULL,
        frais DECIMAL(12, 2) NOT NULL DEFAULT 0,
        FOREIGN KEY (id_type_operation) REFERENCES type_operation (id)
    );

-- =====================================
-- TRANSACTION
-- Représente l'action métier
-- =====================================
CREATE TABLE
    transaction_mm (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        id_type_operation INTEGER NOT NULL,
        montant DECIMAL(12, 2) NOT NULL,
        date_transaction DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_type_operation) REFERENCES type_operation(id)
    );

-- =====================================
-- MOUVEMENT FINANCIER
-- Les impacts sur les comptes clients
-- =====================================
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

-- =====================================
-- GAIN OPERATEUR
-- Commission gagnée
-- =====================================
CREATE TABLE
    gain (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        id_transaction INTEGER NOT NULL,
        montant DECIMAL(12, 2) NOT NULL,
        date_gain DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_transaction) REFERENCES transaction_mm (id)
    );

-- =====================================
-- SEEDS
-- =====================================

INSERT INTO operateur (nom, email, password) VALUES
('admin', 'admin@gmail.com', 'admin');

INSERT INTO client (nom, numero) VALUES
('Jean', '0341234567'),
('Alice', '0340000001'),
('Bob', '0330000002');

INSERT INTO type_operation (libelle) VALUES
('DEPOT'),
('RETRAIT'),
('TRANSFERT');

INSERT INTO bareme_frais (id_type_operation, montant_min, montant_max, frais) VALUES
(2, 100, 1000, 50),
(2, 1001, 5000, 50),
(2, 5001, 10000, 100),
(2, 10001, 25000, 200),
(2, 25001, 50000, 400),
(2, 50001, 100000, 800),
(2, 100001, 250000, 1500),
(2, 250001, 500000, 1500),
(2, 500001, 1000000, 2500),
(2, 1000001, 2000000, 3000);

INSERT INTO bareme_frais (id_type_operation, montant_min, montant_max, frais) VALUES
(3, 100, 1000, 10),
(3, 1001, 5000, 10),
(3, 5001, 10000, 110),
(3, 10001, 25000, 210),
(3, 25001, 50000, 410),
(3, 50001, 100000, 810),
(3, 100001, 250000, 1510),
(3, 250001, 500000, 1510),
(3, 500001, 1000000, 2510),
(3, 1000001, 2000000, 3010);
