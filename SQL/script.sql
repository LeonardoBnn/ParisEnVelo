DROP DATABASE IF EXISTS parisenvelo;
CREATE DATABASE IF NOT EXISTS parisenvelo;
USE parisenvelo;

-- 1. Table des Rôles
CREATE TABLE Roles (
    id_role INT PRIMARY KEY AUTO_INCREMENT,
    nom_role VARCHAR(50) NOT NULL -- 'admin', 'vendeur', 'client'
);

-- 2. Table des Utilisateurs
CREATE TABLE Utilisateurs (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mdp VARCHAR(25) NOT NULL,
    telephone VARCHAR(20),
    adresse TEXT,
    id_role INT,
    FOREIGN KEY (id_role) REFERENCES Roles(id_role)
);

-- 3. Table des Catégories de vélos
CREATE TABLE Categories (
    id_categorie INT PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(100) -- 'VTT', 'Tandem', 'Course'
);

-- 4. Table des Vélos
CREATE TABLE Velos (
    id_velo INT PRIMARY KEY AUTO_INCREMENT,
    modele VARCHAR(100),
    numero_serie VARCHAR(100) UNIQUE NOT NULL,
    est_electrique BOOLEAN DEFAULT FALSE, -- TRUE pour électrique, FALSE sinon
    prix_journalier DECIMAL(10, 2), -- Le prix spécifique au vélo
    statut ENUM('disponible', 'emprunté', 'en réparation', 'non disponible') DEFAULT 'disponible',
    id_categorie INT,
    FOREIGN KEY (id_categorie) REFERENCES Categories(id_categorie)
);

-- 5. Table des Locations
CREATE TABLE Locations (
    id_location INT PRIMARY KEY AUTO_INCREMENT,
    date_debut DATETIME,
    date_fin_prevue DATETIME,
    date_retour_reelle DATETIME NULL,
    id_client INT,
    id_vendeur INT, -- Qui a réalisé la vente
    id_velo INT,
    FOREIGN KEY (id_client) REFERENCES Utilisateurs(id_utilisateur),
    FOREIGN KEY (id_vendeur) REFERENCES Utilisateurs(id_utilisateur),
    FOREIGN KEY (id_velo) REFERENCES Velos(id_velo)
);

-- 6. Table des Locations
CREATE TABLE Accessoires (
    id_accessoire INT PRIMARY KEY AUTO_INCREMENT,
    nom_accessoire VARCHAR(100), -- 'Casque', 'Antivol', 'Sacoche'
    prix_journalier DECIMAL(10, 2),
    stock_total INT, -- Nombre total d'exemplaires en magasin
    statut ENUM('disponible', 'en maintenance', 'obsolète') DEFAULT 'disponible'
);

-- 7. Table de liaison pour associer des accessoires à une location précise
CREATE TABLE Location_Accessoires (
    id_location INT,
    id_accessoire INT,
    quantite INT DEFAULT 1,
    PRIMARY KEY (id_location, id_accessoire),
    FOREIGN KEY (id_location) REFERENCES Locations(id_location) ON DELETE CASCADE,
    FOREIGN KEY (id_accessoire) REFERENCES Accessoires(id_accessoire)
);

-- 1. Insertion des Rôles
INSERT INTO Roles (nom_role) VALUES ('admin'), ('vendeur'), ('client');

-- 2. Insertion des Utilisateurs (1 Admin, 5 Vendeurs, 5 Clients)
-- Note : id_role 1=admin, 2=vendeur, 3=client
INSERT INTO Utilisateurs (nom, prenom, email, mdp, telephone, adresse, id_role) VALUES
('Bonino', 'Leonardo', 'boninoleonardo@gmail.com', sha1('#8367'), '0102030405', '94 rue de Reuilly, Paris', 1),
('Vendeur', 'Lucas', 'lucas@gmail.com', sha1('123'), '0601020304', '12 rue du Commerce, Lyon', 2),
('Vendeur', 'Sophie', 'sophie@gmail.com', sha1('123'), '0602030405', '8 av des Fleurs, Lyon', 2),
('Vendeur', 'Marc', 'marc@gmail.com', sha1('123'), '0603040506', '3 bld Vert, Lyon', 2),
('Vendeur', 'Julie', 'julie@gmail.com', sha1('123'), '0604050607', '21 rue Haute, Lyon', 2),
('Vendeur', 'Emma', 'emma@gmail.com', sha1('123'), '0605060708', '5 place Bellecour, Lyon', 2),
('Dupont', 'Jean', 'jean.dupont@email.com', sha1('123'), '0701010101', '45 rue Gambetta, Lille', 3),
('Martin', 'Claire', 'claire.m@email.com', sha1('123'), '0702020202', '10 rue de la Gare, Nantes', 3),
('Petit', 'Thomas', 't.petit@email.com', sha1('123'), '0703030303', '2 rue du Port, Bordeaux', 3),
('Leroy', 'Alice', 'alice.l@email.com', sha1('123'), '0704040404', '9 av de la Mer, Marseille', 3),
('Moreau', 'Victor', 'v.moreau@email.com', sha1('123'), '0705050505', '14 bld Sud, Nice', 3);

-- 3. Insertion des Catégories
INSERT INTO Categories (libelle) VALUES ('VTT'), ('Course'), ('Tandem'), ('Ville'), ('Cargo');

-- 4. Insertion de 30 Vélos
INSERT INTO Velos (modele, numero_serie, est_electrique, prix_journalier, statut, id_categorie) VALUES
-- VTT (id_categorie 1)
('Specialized Stumpjumper', 'SN-STUMP-001', 0, 45.00, 'disponible', 1),
('Santa Cruz Nomad', 'SN-NOMAD-002', 0, 55.00, 'disponible', 1),
('Trek Fuel EX', 'SN-FUEL-003', 0, 40.00, 'emprunté', 1),
('Moustache Samedi 29 Game', 'SN-MOUST-004', 1, 75.00, 'disponible', 1),
('Specialized Turbo Levo', 'SN-LEVO-005', 1, 80.00, 'disponible', 1),
('Giant Trance E+', 'SN-GIANT-006', 1, 65.00, 'en réparation', 1),

-- Course / Route (id_categorie 2)
('Cannondale SuperSix EVO', 'SN-CANN-007', 0, 50.00, 'disponible', 2),
('Pinarello Dogma F12', 'SN-PINA-008', 0, 95.00, 'disponible', 2),
('Specialized Roubaix', 'SN-ROUB-009', 0, 48.00, 'disponible', 2),
('Orbea Gain M20', 'SN-ORBE-010', 1, 60.00, 'disponible', 2),
('Giant Road-E+', 'SN-GROAD-011', 1, 55.00, 'disponible', 2),
('Scott Addict eRide', 'SN-SCOTT-012', 1, 65.00, 'emprunté', 2),

-- Tandem (id_categorie 3)
('Moustache Samedi 27 X2', 'SN-TAN-013', 1, 90.00, 'disponible', 3),
('Lapierre Tandem Route', 'SN-LAP-014', 0, 45.00, 'disponible', 3),
('Gitane Tandem Loisir', 'SN-GIT-015', 0, 35.00, 'disponible', 3),

-- Ville / Loisir (id_categorie 4)
('VanMoof S3', 'SN-VANM-016', 1, 35.00, 'disponible', 4),
('Cowboy 4', 'SN-COW-017', 1, 35.00, 'disponible', 4),
('Gazelle Ultimate', 'SN-GAZ-018', 1, 40.00, 'disponible', 4),
('B''Twin Elops 520', 'SN-ELOPS-019', 0, 12.00, 'disponible', 4),
('Linus Roadster', 'SN-LIN-020', 0, 18.00, 'non disponible', 4),
('Brompton C Line', 'SN-BROM-021', 0, 25.00, 'disponible', 4),
('Veloretti Ace', 'SN-VELO-022', 1, 30.00, 'disponible', 4),

-- Cargo (id_categorie 5)
('Babboe Curve-E', 'SN-BAB-023', 1, 60.00, 'disponible', 5),
('Riese & Müller Load 75', 'SN-RM-024', 1, 95.00, 'disponible', 5),
('Urban Arrow Family', 'SN-URB-025', 1, 85.00, 'disponible', 5),
('Yuba Mundo', 'SN-YUBA-026', 0, 40.00, 'disponible', 5),
('Omnium Cargo', 'SN-OMN-027', 0, 38.00, 'disponible', 5),
('Tern GSD S10', 'SN-TERN-028', 1, 70.00, 'disponible', 5),
('RadPower RadWagon', 'SN-RAD-029', 1, 50.00, 'disponible', 5),
('Bullitt Larry vs Harry', 'SN-BULL-030', 0, 45.00, 'en réparation', 5);

INSERT INTO Accessoires (nom_accessoire, prix_journalier, stock_total) VALUES
('Casque ABUS Hyban', 2.00, 20),
('Antivol Chaîne Kryptonite', 3.00, 15),
('Sacoche Ortlieb 20L', 5.00, 10),
('Siège Bébé Thule', 8.00, 5),
('Kit de réparation Crevaison', 0.00, 10); -- Offert ou cautionné