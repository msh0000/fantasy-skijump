
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20) NOT NULL,
    password VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    budget DECIMAL(10, 1),
    transfers INT,
    boost_bench BOOLEAN DEFAULT FALSE,
    boost_unlimited_transfers BOOLEAN DEFAULT FALSE,
    boost_triple_capitan BOOLEAN DEFAULT FALSE
);


CREATE TABLE competition (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    location VARCHAR(50),
    date TIMESTAMP
);


CREATE TABLE jumper (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    country VARCHAR(20),
    value INT
);


CREATE TABLE result (
    id INT AUTO_INCREMENT PRIMARY KEY,
    competition_id INT NOT NULL,
    jumper_id INT NOT NULL,
    rank INT,
    points INT,
    FOREIGN KEY (competition_id) REFERENCES competition(id),
    FOREIGN KEY (jumper_id) REFERENCES jumper(id)
);


CREATE TABLE fantasy_points (
    id INT AUTO_INCREMENT PRIMARY KEY,
    competition_id INT NOT NULL,
    user_id INT NOT NULL,
    points INT,
    FOREIGN KEY (competition_id) REFERENCES competition(id),
    FOREIGN KEY (user_id) REFERENCES user(id)
);


CREATE TABLE league (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE league_team (
    id INT AUTO_INCREMENT PRIMARY KEY,
    league_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (league_id) REFERENCES league(id),
    FOREIGN KEY (user_id) REFERENCES user(id)
);


CREATE TABLE team (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id)
);


CREATE TABLE team_jumper (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team_id INT NOT NULL,
    jumper_id INT NOT NULL,
    FOREIGN KEY (team_id) REFERENCES team(id),
    FOREIGN KEY (jumper_id) REFERENCES jumper(id)
);
