-- =====================================
-- OPERATEUR MOBILE MONEY
-- =====================================
CREATE TABLE
    operateur (
        id_operateur INTEGER PRIMARY KEY AUTOINCREMENT,
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
        id_client INTEGER PRIMARY KEY AUTOINCREMENT,
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
        id_prefixe INTEGER PRIMARY KEY AUTOINCREMENT,
        prefixe TEXT UNIQUE NOT NULL,
        id_operateur INTEGER NOT NULL,
        FOREIGN KEY (id_operateur) REFERENCES operateur (id_operateur)
    );

-- =====================================
-- TYPE D'OPERATION
-- =====================================
CREATE TABLE
    type_operation (
        id_type_operation INTEGER PRIMARY KEY AUTOINCREMENT,
        libelle TEXT UNIQUE NOT NULL
    );

-- Exemple :
-- DEPOT
-- RETRAIT
-- TRANSFERT
-- PAIEMENT
-- =====================================
-- BAREME DES FRAIS
-- =====================================
CREATE TABLE
    bareme_frais (
        id_bareme INTEGER PRIMARY KEY AUTOINCREMENT,
        id_operateur INTEGER NOT NULL,
        id_type_operation INTEGER NOT NULL,
        montant_min DECIMAL(12, 2) NOT NULL,
        montant_max DECIMAL(12, 2) NOT NULL,
        frais DECIMAL(12, 2) NOT NULL DEFAULT 0,
        FOREIGN KEY (id_operateur) REFERENCES operateur (id_operateur),
        FOREIGN KEY (id_type_operation) REFERENCES type_operation (id_type_operation)
    );

-- =====================================
-- TRANSACTION
-- Représente l'action métier
-- =====================================
CREATE TABLE
    transaction_mm (
        id_transaction INTEGER PRIMARY KEY AUTOINCREMENT,
        id_type_operation INTEGER NOT NULL,
        -- Celui qui lance l'opération
        id_client_initiateur INTEGER NOT NULL,
        id_operateur INTEGER NOT NULL,
        montant DECIMAL(12, 2) NOT NULL,
        frais DECIMAL(12, 2) NOT NULL DEFAULT 0,
        statut TEXT NOT NULL DEFAULT 'VALIDE',
        date_transaction DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_type_operation) REFERENCES type_operation (id_type_operation),
        FOREIGN KEY (id_client_initiateur) REFERENCES client (id_client),
        FOREIGN KEY (id_operateur) REFERENCES operateur (id_operateur)
    );

-- =====================================
-- MOUVEMENT FINANCIER
-- Les impacts sur les comptes clients
-- =====================================
CREATE TABLE
    mouvement (
        id_mouvement INTEGER PRIMARY KEY AUTOINCREMENT,
        id_transaction INTEGER NOT NULL,
        id_client INTEGER NOT NULL,
        sens TEXT NOT NULL CHECK (sens IN ('DEBIT', 'CREDIT')),
        montant DECIMAL(12, 2) NOT NULL,
        FOREIGN KEY (id_transaction) REFERENCES transaction_mm (id_transaction),
        FOREIGN KEY (id_client) REFERENCES client (id_client)
    );

-- =====================================
-- GAIN OPERATEUR
-- Commission gagnée
-- =====================================
CREATE TABLE
    gain (
        id_gain INTEGER PRIMARY KEY AUTOINCREMENT,
        id_transaction INTEGER NOT NULL,
        montant DECIMAL(12, 2) NOT NULL,
        date_gain DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_transaction) REFERENCES transaction_mm (id_transaction)
    );