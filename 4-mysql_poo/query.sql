INSERT INTO movies SET
id = 'tt4158110', 
title = 'Mr. Robot', 
plot = 'Elliot is a brilliant introverted young programmer who works as a cyber-security',
genres = 'Crime, Drama, Thriller',
author = 'Sam Esmail',
actors = 'Rami Malek, Christian Slater, Carly Chaikin',
country = 'USA', 
premiere = '2015',
poster = 'https://m.media-amazon.com/images/M/MV5BM2QyNDIzOGMtNThhNS00NmUwLWI0ZjUtZjdkN2I1OTRjZWQ3XkEyXkFqcGdeQXVyNzQ1ODk3MTQ@._V1_SX300.jpg',
trailer = '', 
rating = 8.5, 
status = 4, 
category = 'serie';

-- Query
SELECT * FROM movies AS movie INNER jOIN status AS statu ON movie.status = statu.id;

SELECT movie.title, movie.country, movie.rating, statu.status
FROM movies AS movie INNER jOIN status AS statu 
ON movie.status = statu.id
ORDER BY movie.title ASC;

SELECT movie.title, movie.country, movie.rating, statu.status
FROM movies AS movie INNER jOIN status AS statu 
ON movie.status = statu.id
WHERE statu.status = 'Release'
ORDER BY movie.title ASC;

-- FULL TEXT
SELECT title, category, genres from movies
WHERE MATCH(title, author, actors, genres)
AGAINST('robot' IN BOOLEAN MODE);

SELECT movie.title, movie.category, statu.status
FROM movies AS movie INNER JOIN status AS statu
ON movie.status = statu.id
WHERE MATCH(movie.title, movie.author, movie.actors, movie.genres)
AGAINST('Release' IN BOOLEAN MODE)
ORDER BY movie.premiere;