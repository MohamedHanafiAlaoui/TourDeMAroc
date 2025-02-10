-- Création de la base de données
CREATE DATABASE tour_de_maroc;

\c tour_de_maroc;

-- Table des équipes
CREATE TABLE teams (
    id_team SERIAL PRIMARY KEY,
    name VARCHAR(250) UNIQUE NOT NULL
);

-- Table principale des utilisateurs
CREATE TABLE users (
    id_user SERIAL PRIMARY KEY,
    name VARCHAR(250) NOT NULL, -- Pas UNIQUE
    email VARCHAR(250) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    photo TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des cyclistes (hérite de users) - Pas besoin de redéfinir id_user
CREATE TABLE cyclists (
    nationality VARCHAR(250),
    birthdate DATE,
    total_points INT DEFAULT 0,
    approved BOOLEAN DEFAULT FALSE,
    id_team INT REFERENCES teams(id_team) ON DELETE SET NULL
) INHERITS (users);

-- Table des administrateurs (hérite de users) - Pas besoin de redéfinir id_user
CREATE TABLE admins (
) INHERITS (users);

-- Table des fans (hérite de users) - Pas besoin de redéfinir id_user
CREATE TABLE fans (
) INHERITS (users);
