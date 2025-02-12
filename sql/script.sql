-- Création de la base de données
CREATE DATABASE tour-de-maroc;

\c tour-de-maroc;

--Table des rôles
CREATE TYPE user_role AS ENUM ('Admin', 'Fan', 'Cyclist');

CREATE TABLE roles (
    id_role SERIAL PRIMARY KEY,
    name_user user_role NOT NULL UNIQUE
);

-- Table des équipes
CREATE TABLE teams (
    id_team SERIAL PRIMARY KEY,
    name VARCHAR(250) UNIQUE NOT NULL,
    country VARCHAR(250) NOT NULL
);

-- Table principale des utilisateurs
CREATE TABLE users (
    id_user SERIAL PRIMARY KEY,
    first_name VARCHAR(250) NOT NULL,
    last_name VARCHAR(250) NOT NULL,
    email VARCHAR(250) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    photo TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_role INT REFERENCES roles(id_role) ON DELETE SET NULL
);

-- Table des cyclistes (hérite de users)
CREATE TABLE cyclists (
    id_user INT PRIMARY KEY DEFAULT nextval ('users_id_user_seq'),
    nationality VARCHAR(250),
    birthdate DATE,
    total_points INT DEFAULT 0,
    approved BOOLEAN DEFAULT FALSE,
    id_team INT REFERENCES teams(id_team) ON DELETE SET NULL
) INHERITS (users);

-- Table des administrateurs (hérite de users)
CREATE TABLE admins (
    id_user INT PRIMARY KEY DEFAULT nextval ('users_id_user_seq')
) INHERITS (users);

-- Table des fans (hérite de users)
CREATE TABLE fans (
    id_user INT PRIMARY KEY DEFAULT nextval ('users_id_user_seq')
) INHERITS (users);

-- Stage categories table
CREATE TABLE categories (
    id_category SERIAL PRIMARY KEY,
    name VARCHAR(250) UNIQUE NOT NULL
);

-- Regions table
CREATE TABLE regions (
    id_region SERIAL PRIMARY KEY,
    name VARCHAR(250) UNIQUE NOT NULL
);

-- Stages table
CREATE TYPE difficulty AS ENUM('facile', 'medium', 'difficile');

CREATE TABLE stages (
    id_stage SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    start_location VARCHAR(255) NOT NULL,
    end_location VARCHAR(255) NOT NULL,
    distance_km DECIMAL(5,2) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    id_category INT REFERENCES categories(id_category) ON DELETE SET NULL, 
    id_region INT REFERENCES regions(id_region) ON DELETE CASCADE,
    difficulty_level difficulty NOT NULL
);

-- Stage results table
CREATE TABLE stage_results (
    id_results SERIAL PRIMARY KEY,
    id_cyclist INT NOT NULL REFERENCES cyclists(id_user) ON DELETE CASCADE,
    id_stage INT NOT NULL REFERENCES stages(id_stage) ON DELETE CASCADE,
    total_time INTERVAL NOT NULL,
    distance_km DECIMAL(6,2) NOT NULL,
    average_speed DECIMAL(5,2),
    points_awarded INT DEFAULT 0,
    ranking INT NOT NULL,
    UNIQUE (id_cyclist, id_stage)
);

-- Fans and their favorite cyclists table
CREATE TABLE fan_favorites (
    id_fan INT NOT NULL REFERENCES users(id_user) ON DELETE CASCADE,
    id_cyclist INT NOT NULL REFERENCES cyclists(id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_fan, id_cyclist)
);

-- Comments table
CREATE TABLE comments (
    id_comment SERIAL PRIMARY KEY,
    id_fan INT NOT NULL REFERENCES users(id_user) ON DELETE CASCADE,
    id_stage INT REFERENCES stages(id_stage) ON DELETE CASCADE,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    validated BOOLEAN DEFAULT FALSE
);

-- Stage likes table
CREATE TABLE stage_likes (
    id_likes SERIAL PRIMARY KEY,
    id_fan INT NOT NULL REFERENCES users(id_user) ON DELETE CASCADE,
    id_stage INT NOT NULL REFERENCES stages(id_stage) ON DELETE CASCADE,
    UNIQUE (id_fan, id_stage)
);

-- Fans notifications table
CREATE TABLE fan_notifications (
    id_notify SERIAL PRIMARY KEY,
    id_fan INT NOT NULL REFERENCES users(id_user) ON DELETE CASCADE,
    id_stage INT NOT NULL REFERENCES stages(id_stage) ON DELETE CASCADE,
    message TEXT NOT NULL,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Incorrect data reports table
CREATE TABLE reports (
    id_report SERIAL PRIMARY KEY,
    id_fan INT REFERENCES users(id_user) ON DELETE SET NULL,
    id_stage INT REFERENCES stages(id_stage) ON DELETE CASCADE,
    description TEXT NOT NULL,
    reported_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_archived BOOLEAN DEFAULT FALSE
);

--Historique des performances des cyclistes
CREATE TABLE historys(
    id_history SERIAL PRIMARY KEY,
    version VARCHAR(250) NOT NULL,
    id_cyclist INT NOT NULL REFERENCES cyclists(id_user) ON DELETE CASCADE
);