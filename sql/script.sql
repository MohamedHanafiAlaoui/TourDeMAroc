-- Création de la base de données
CREATE DATABASE tour-de-maroc;

-- Se connecter à la base de données
\c tour-de-maroc;

-- ===============================
-- 1️⃣ Table des rôles
-- ===============================
CREATE TYPE role_user AS ENUM ('admin', 'cyclist', 'fan');

CREATE TABLE roles (
    id SERIAL PRIMARY KEY,
    name_user role_user NOT NULL UNIQUE
);

-- ===============================
-- 2️⃣ Table des équipes
-- ===============================
CREATE TABLE teams (
    id SERIAL PRIMARY KEY,
    name VARCHAR(250) UNIQUE NOT NULL,
    country VARCHAR(250) NOT NULL
);

-- ===============================
-- 2️⃣ Table principale des utilisateurs
-- ===============================
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    first_name VARCHAR(250) NOT NULL,
    last_name VARCHAR(250) NOT NULL,
    email VARCHAR(250) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    photo TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    role_id INT REFERENCES roles(id) ON DELETE SET NULL,
    password_token_hash VARCHAR(64),
    password_token_expires_at TIMESTAMP
);

-- ===============================
-- 3️⃣ Tables héritées (Cyclists, Admins, Fans)
-- ===============================

-- Table des fans (hérite de `users`) avec `notify` en BOOLEAN sans valeur par défaut
CREATE TABLE fans (
    notify BOOLEAN
) INHERITS (users);

ALTER TABLE fans ADD CONSTRAINT unique_fan_id UNIQUE (id);

-- Table des administrateurs (hérite de `users`)
CREATE TABLE admins (
) INHERITS (users);

ALTER TABLE admins ADD CONSTRAINT unique_admin_id UNIQUE (id);

-- Table des cyclistes (hérite de `users`)
CREATE TABLE cyclists (
    team VARCHAR(250) NULL,
    nationality VARCHAR(250),
    birthdate DATE,
    approved BOOLEAN DEFAULT FALSE
) INHERITS (users);

ALTER TABLE cyclists ADD CONSTRAINT unique_cyclist_id UNIQUE (id);

-- ===============================
-- 4️⃣ Tables des catégories et des régions
-- ===============================
CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(250) UNIQUE NOT NULL
);

CREATE TABLE regions (
    id SERIAL PRIMARY KEY,
    name VARCHAR(250) UNIQUE NOT NULL
);

-- ===============================
-- 5️⃣ Table des étapes (stages)
-- ===============================
CREATE TYPE difficulty AS ENUM('facile', 'medium', 'difficile');

CREATE TABLE stages (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    start_location VARCHAR(255) NOT NULL,
    end_location VARCHAR(255) NOT NULL,
    distance_km DECIMAL(6,2) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    category_id INT REFERENCES categories(id) ON DELETE SET NULL, 
    region_id INT REFERENCES regions(id) ON DELETE CASCADE,
    difficulty_level difficulty NOT NULL,
    photo TEXT,
    description TEXT NOT NULL
);

-- ===============================
-- 6️⃣ Résultats des étapes (points)
-- ===============================
CREATE TABLE ranking (
    id SERIAL PRIMARY KEY,
    cyclist_id INT NOT NULL REFERENCES cyclists(id) ON DELETE CASCADE,
    stage_id INT NOT NULL REFERENCES stages(id) ON DELETE CASCADE,
    total_time INTERVAL NOT NULL,
    points_awarded INT DEFAULT 0,
    UNIQUE (cyclist_id, stage_id)
);

-- ===============================
-- 7️⃣ Gestion des favoris et interactions des fans
-- ===============================

-- Table des favoris des fans (référence maintenant `fans(id)`)
CREATE TABLE fan_favorites (
    id_fan INT NOT NULL REFERENCES fans(id) ON DELETE CASCADE,
    id_cyclist INT NOT NULL REFERENCES cyclists(id) ON DELETE CASCADE,
    PRIMARY KEY (id_fan, id_cyclist)
);


-- ===============================
-- 8️⃣ Gestion des commentaires des fans
-- ===============================

-- Table des commentaires
CREATE TABLE comments (
    id SERIAL PRIMARY KEY,
    id_fan INT NOT NULL REFERENCES fans(id) ON DELETE CASCADE,
    stage_id INT REFERENCES stages(id) ON DELETE CASCADE,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    validated BOOLEAN DEFAULT FALSE
);

-- Table des "likes" sur les étapes
CREATE TABLE stage_likes (
    id SERIAL PRIMARY KEY,
    id_fan INT NOT NULL REFERENCES fans(id) ON DELETE CASCADE,
    stage_id INT NOT NULL REFERENCES stages(id) ON DELETE CASCADE,
    UNIQUE (id_fan, stage_id)
);

-- ===============================
-- 9️⃣ Signalements des fans
-- ===============================

CREATE TABLE reports (
    id SERIAL PRIMARY KEY,
    id_fan INT REFERENCES fans(id) ON DELETE SET NULL,
    stage_id INT REFERENCES stages(id) ON DELETE CASCADE,
    description TEXT NOT NULL,
    reported_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_archived BOOLEAN DEFAULT FALSE
);

-- ===============================
-- 🔟 Historique des performances des cyclistes
-- ===============================
CREATE TABLE experience(
    id SERIAL PRIMARY KEY,
    tour VARCHAR(250) NOT NULL,
    photo TEXT,
    start_date DATE,
    end_date DATE,
    rank INT,
    description TEXT,
    cyclist_id INT NOT NULL REFERENCES cyclists(id) ON DELETE CASCADE
);

-- ===============================
-- 🚀 Ajout des données initiales
-- ===============================

-- Ajout des rôles
INSERT INTO roles(name_user) VALUES ('admin'), ('cyclist'), ('fan');




-- SELECT id_cyclist, stage_id, 
--        EXTRACT(HOUR FROM total_time) || ' hours ' || 
--        EXTRACT(MINUTE FROM total_time) || ' minutes' AS formatted_time, 
--        points_awarded
-- FROM stage_points;
