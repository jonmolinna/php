DROP DATABASE IF EXISTS mexflix;

CREATE DATABASE IF NOT EXISTS mexflix;

USE mexflix;

-- 'Comming Soon', 'Release', 'In Issue', 'Finished', 'Canceled'
CREATE TABLE status (
    id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    status VARCHAR(20) NOT NULL
);


CREATE TABLE movies(
    id CHAR(9) PRIMARY KEY,
    title VARCHAR(80),
    plot TEXT,
    author VARCHAR(100) DEFAULT 'Pending',
    actors VARCHAR(100) DEFAULT 'Pending',
    country VARCHAR(30) DEFAULT 'Unknown',
    premiere YEAR(4) NOT NULL,
    poster VARCHAR(150) DEFAULT 'no-poster',
    trailer VARCHAR(150) DEFAULT 'no-trailer',
    rating DECIMAL(2,1),
    genres VARCHAR(50) NOT NULL,
    status INTEGER UNSIGNED NOT NULL, -- UNSIGNED SIN SIGNO
    category ENUM('Movie', 'Serie') NOT NULL,
    FULLTEXT KEY search(title, author, actors, genres),
    FOREIGN KEY (status) REFERENCES status(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE users (
    user VARCHAR(15) PRIMARY KEY,
    email VARCHAR(80) UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    birthday DATE NOT NULL,
    password CHAR(32) NOT NULL,
    role ENUM('ADMIN', 'USER') NOT NULL
);


INSERT INTO status (id, status) VALUES
(1, 'Comming Soon'),
(2, 'Release'),
(3, 'In Issue'),
(4, 'Finished'),
(5, 'Canceled');

-- MDS es para ecriptar las contraseñas
INSERT INTO users (user, email, name, birthday, password, role) VALUES
('@kendra', 'kendra123@gmail.com', 'Kendra Contreras', '1996-09-19', MD5('kendra'), 'Admin'),
('@meryem', 'meryem.espinoza@gmail.com', 'Meryem Espinoza', '1999-10-12', MD5('meryem'), 'user');

-- https://www.omdbapi.com/
INSERT INTO movies (id, title, plot, genres, author, actors, country, premiere, poster, trailer, rating, status, category) VALUES
	('tt0903747', 'Breaking Bad', 'A chemistry teacher diagnosed with terminal lung cancer teams up with his former student to cook and sell crystal meth.', 'Crime, Drama, Thriller', 'Vince Gilligan', 'Bryan Cranston, Anna Gunn, Aaron Paul, Dean Norris', 'USA', '2008', 'http://ia.media-imdb.com/images/M/MV5BMTQ0ODYzODc0OV5BMl5BanBnXkFtZTgwMDk3OTcyMDE@._V1_SX300.jpg', 'https://www.youtube.com/watch?v=--z4YzxlT8o', 9.5, 4, 'Serie'),
	('tt2820466', 'Justice League: The Flashpoint Paradox', 'The Flash finds himself in a war torn alternate timeline and teams up with alternate versions of his fellow heroes to return home and restore the timeline.', 'Animation, Action, Adventure', 'Jay Oliva', 'Justin Chambers, C. Thomas Howell, Michael B. Jordan, Kevin McKidd', 'USA', '2013', 'http://ia.media-imdb.com/images/M/MV5BOTM0MDI5NTUwM15BMl5BanBnXkFtZTgwMTEyNTEwMDE@._V1_SX300.jpg', 'https://www.youtube.com/watch?v=xe0JiobQ98o', 8.1, 2, 'Movie'),
	('tt0479143', 'Rocky Balboa', 'Thirty years after the ring of the first bell, Rocky Balboa comes out of retirement and dons his gloves for his final fight; against the reigning heavyweight champ Mason \'The Line\' Dixon.', 'Drama, Sport', 'Sylvester Stallone', 'Sylvester Stallone, Burt Young, Antonio Tarver, Geraldine Hughes', 'USA','2006', 'http://ia.media-imdb.com/images/M/MV5BMTM2OTUzNDE3NV5BMl5BanBnXkFtZTcwODczMzkzMQ@@._V1_SX300.jpg', 'https://www.youtube.com/watch?v=8tab8fK2_3w', 7.2, 2, 'Movie'),
	('tt0468569', 'The Dark Knight', 'Batman raises the stakes in his war on crime. With the help of Lieutenant Jim Gordon and District Attorney Harvey Dent, Batman sets out to dismantle the remaining criminal organizations that plague the city streets. The partnership proves to be effective, but they soon find themselves prey to a reign of chaos unleashed by a rising criminal mastermind known to the terrified citizens of Gotham as The Joker.', 'Action, Crime, Drama', 'Christopher Nolan', 'Christian Bale, Heath Ledger, Aaron Eckhart, Michael Caine', 'USA, UK', '2008', 'http://ia.media-imdb.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_SX300.jpg', 'https://www.youtube.com/watch?v=EXeTwQWrcwY', 9.0, 2, 'Movie');
