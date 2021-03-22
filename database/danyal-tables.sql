CREATE TABLE scheduler (
    id INT PRIMARY KEY AUTO_INCREMENT,
    schedule_name VARCHAR(255) NOT NULL,
    schedule_created DATETIME DEFAULT NOW()	NOT NULL,
    start_date DATE NOT NULL,
    start_time TIME NOT NULL,
    movie_id INT,
    FOREIGN KEY (movie_id) REFERENCES movie_information(id),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES user_information(id)
);

CREATE TABLE polls (
    id INT PRIMARY KEY AUTO_INCREMENT,
    poll_title VARCHAR(255) NOT NULL,
    poll_created DATETIME DEFAULT NOW()	NOT NULL,
    poll_published DATETIME NOT NULL,
    poll_updated DATETIME NOT NULL,
    poll_starts DATETIME NOT NULL,
    poll_ends DATETIME NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES user_information(id)
);

CREATE TABLE poll_questions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    poll_question VARCHAR(255) NOT NULL,    
    poll_id INT,
    FOREIGN KEY (poll_id) REFERENCES polls(id)
);

CREATE TABLE poll_answers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    poll_answer VARCHAR(255) NOT NULL,    
    poll_id INT,
    FOREIGN KEY (poll_id) REFERENCES polls(id),
    question_id INT,
    FOREIGN KEY (question_id) REFERENCES poll_questions(id)
);

CREATE TABLE poll_votes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    poll_vote VARCHAR(50) NOT NULL,    
    poll_id INT,
    FOREIGN KEY (poll_id) REFERENCES polls(id),
    question_id INT,
    FOREIGN KEY (question_id) REFERENCES poll_questions(id),
    answer_id INT,
    FOREIGN KEY (answer_id) REFERENCES poll_answers(id),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES user_information(id)
);

DROP Table IF EXISTS xxx;