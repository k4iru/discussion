DROP DATABASE IF EXISTS movie_db;
CREATE DATABASE movie_db;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    date_added DATETIME NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address  VARCHAR(255) NOT NULL,
    postal VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    credit_card VARCHAR(255) NOT NULL
);

CREATE TABLE threads (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    creation_date DATETIME NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
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
    creation_date DATETIME NOT NULL,
    user_id INT,
    movie_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (movie_id) REFERENCES moviews(id)
)

CREATE TABLE movies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    release_date DATETIME NOT NULL,
    movie_name VARCHAR NOT NULL,
)

CREATE TABLE listsxmovies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    list_id INT,
    movie_id INT,
    FOREIGN KEY (list_id) REFERENCES lists(id),
    FOREIGN KEY (movie_id) REFERENCES movies(id)
)

CREATE TABLE listsxgenres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    list_id INT,
    genre_id INT,
    FOREIGN KEY (list_id) REFERENCES lists(id),
    FOREIGN KEY (genre_id) REFERENCES genres(id)
)

CREATE TABLE usersxmovies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    movie_progress INT NOT NULL,
    user_id INT,
    movie_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (movie_id) REFERENCES movies(id)
)

CREATE TABLE search (
    id INT PRIMARY KEY AUTO_INCREMENT,
    search_input varchar(255) NOT NULL,
    search_result varchar(255),
    search_click BIT,
);

CREATE TABLE review (
    id INT PRIMARY KEY AUTO_INCREMENT,
    review_movie VARCHAR(255) NOT NULL,
    review_content VARCHAR(255) NOT NULL,
    review_rating INT(5) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (movie_id) REFERENCES movies (id)
);
