DROP DATABASE IF EXISTS movie_db;

CREATE DATABASE movie_db;

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    date_added DATETIME NOT NULL,
    user_group INT, NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

CREATE TABLE threads (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    creation_date DATETIME NOT NULL,
    last_post DATETIME NOT NULL,
    last_post_user_id INT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY(last_post_user_id) REFERENCES users(id)
);

CREATE TABLE movies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    release_date DATETIME NOT NULL,
    movie_name VARCHAR(255) NOT NULL
);

CREATE TABLE posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    creation_date DATETIME NOT NULL,
    comment TEXT NOT NULL,
    thread_id INT,
    user_id INT,
    FOREIGN KEY (thread_id) REFERENCES threads(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE lists (
    id INT PRIMARY KEY AUTO_INCREMENT,
    list_name VARCHAR(255) NOT NULL,
    creation_date DATETIME NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE listsxmovies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    list_id INT,
    movie_id INT,
    FOREIGN KEY (list_id) REFERENCES lists(id),
    FOREIGN KEY (movie_id) REFERENCES movie_info(id)
);

CREATE TABLE genres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    genre_name varchar(255)
);

CREATE TABLE listsxgenres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    list_id INT,
    genre_id INT,
    FOREIGN KEY (list_id) REFERENCES lists(id),
    FOREIGN KEY (genre_id) REFERENCES genres(id)
);

CREATE TABLE usersxmovies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    movie_progress INT NOT NULL,
    user_id INT,
    movie_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (movie_id) REFERENCES movie_info(id)
);

CREATE TABLE review (
    id INT PRIMARY KEY AUTO_INCREMENT,
    review_movie VARCHAR(255) NOT NULL,
    review_content VARCHAR(255) NOT NULL,
    review_rating INT(5) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id),
);

CREATE TABLE list_table (
    id INT NOT NULL AUTO_INCREMENT,
    date_generated DATE NOT NULL DEFAULT(NOW()),
    user_id INT NOT NULL,
    movie_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user_information(id),
    FOREIGN KEY (movie_id) REFERENCES movie_info(id)
);

CREATE TABLE movie_info (
    id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    movieLength DECIMAL(3, 2) NOT NULL,
    actor_id INT NOT NULL,
    trailer_id INT NOT NULL,
    poster_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (actor_id) REFERENCES actors(actor_id),
    FOREIGN KEY (trailer_id) REFERENCES trailers(trailer_id),
    FOREIGN KEY (poster_id) REFERENCES posters(poster_id)
);

CREATE TABLE actors (
    id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    birth_date DATE NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE posters (
    id INT NOT NULL AUTO_INCREMENT,
    movie_path VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE trailers (
    id INT NOT NULL AUTO_INCREMENT,
    trailer_length DECIMAL(3, 2) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS polls (
	id INT PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
) 

CREATE TABLE IF NOT EXISTS poll_answers (
	id INT PRIMARY KEY AUTO_INCREMENT,
	poll_id INT NOT NULL,
	options VARCHAR(255) NOT NULL,
	votes INT NOT NULL DEFAULT '0',
	FOREIGN KEY(poll_id) REFERENCES polls(id)
) 

// for database copy

DROP DATABASE IF EXISTS movie_db;

CREATE DATABASE movie_db;

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    date_added DATETIME NOT NULL,
    user_group INTEGER NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

CREATE TABLE threads (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    creation_date DATETIME NOT NULL,
    last_post DATETIME NOT NULL,
    last_post_user_id INT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY(last_post_user_id) REFERENCES users(id)
);

CREATE TABLE posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    creation_date DATETIME NOT NULL,
    comment TEXT NOT NULL,
    thread_id INT,
    user_id INT,
    FOREIGN KEY (thread_id) REFERENCES threads(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
