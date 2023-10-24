/*
-- Movies
    - Crear movie
    - Actualizar movie
    - Eliminar movie
    - Buscar todas las movies
    - Buscar una movie por titulo, persona (actores, autores), generos
    - Buscar una movie por categoria
    - Buscar una movie por status
*/
INSERT INTO movies SET
id = 'tt0054159',
title = 'Passenger',
author = '',
actors = '',
country = '',
premiere = '1963',
trailer = '',
poster = '',
rating= 7.4,
genres = 'Drama, War',
category = 'Movie',
status = 4;

UPDATE movies SET
plot = 'While being aboard a transatlantic ship, German woman Liza notices someone who looks like Marta',
author = 'Andrzej Munk, Witold Lesiewicz',
actors = 'Aleksandra Slaska, Anna Ciepielewska, Jan Kreczmar',
country = 'Poland',
premiere = 1963,
trailer = '',
poster = 'https://m.media-amazon.com/images/M/MV5BNzMwMmI4MzQtMjVjNi00MDg1LTllYTMtNzNkYWQyMzA5NmYxXkEyXkFqcGdeQXVyMTA0MTM5NjI2._V1_SX300.jpg'
WHERE id = 'tt0054159';

DELETE FROM movies WHERE id = 'tt0054159';

SELECT movie.id, movie.title, movie.plot, movie.author, movie.actors, movie.country,
movie.premiere, movie.trailer, movie.poster, movie.rating, movie.genres,
movie.category, statu.status
FROM movies AS movie
INNER JOIN status AS statu
ON movie.status = statu.id;

SELECT movie.id, movie.title, movie.plot, movie.author, movie.actors, movie.country,
movie.premiere, movie.trailer, movie.poster, movie.rating, movie.genres,
movie.category, statu.status
FROM movies AS movie
INNER JOIN status AS statu
ON movie.status = statu.id
WHERE MATCH(movie.title, movie.author, movie.actors, movie.genres)
AGAINST('drama' IN BOOLEAN MODE);

SELECT movie.id, movie.title, movie.plot, movie.author, movie.actors, movie.country,
movie.premiere, movie.trailer, movie.poster, movie.rating, movie.genres,
movie.category, statu.status
FROM movies AS movie
INNER JOIN status AS statu
ON movie.status = statu.id
WHERE MATCH(movie.title, movie.author, movie.actors, movie.genres)
AGAINST('drama' IN BOOLEAN MODE);

SELECT movie.id, movie.title, movie.plot, movie.author, movie.actors, movie.country
movie.premiere, movie.trailer, movie.poster, movie.rating, movie.genres,
movie.category, statu.status
FROM movies AS movie
INNER JOIN status AS statu
ON movie.status = statu.id
WHERE movie.category = 'Movie';

SELECT movie.id, movie.title, movie.plot, movie.author, movie.actors, movie.country
movie.premiere, movie.trailer, movie.poster, movie.rating, movie.genres,
movie.category, statu.status
FROM movies AS movie
INNER JOIN status AS statu
ON movie.status = statu.id
WHERE movie.status = 1;

/*
-- Status
    - Crear status
    - Actualizar status
    - Eliminar status
    - Buscar todos los status
    - Buscar un status por status_id
*/
INSERT INTO status SET
id = 0,
status = 'Otro Status';

UPDATE status SET status = 'Other Status' WHERE id = 6;

DELETE FROM status WHERE id = 6;

SELECT * FROM status;

SELECT * FROM status WHERE id = 3;

/*
-- Users
    - Crear user
    - Actualizar
        . Datos generales
        . Password
    - Eliminar user
    - Buscar todos los users
    - Buscar un user por:
        . user
        . email
*/
INSERT INTO users SET
user = '@tanase123',
email = 'tanase123@gmail.com',
name = 'Malina',
birthday = '2000-10-03',
password = MD5('tanase123'),
role = 'Admin';

UPDATE users SET
name = 'Malina Tanase',
birthday = '2000-11-23',
role = 'User'
WHERE user = '@tanase123' AND email = 'tanase123@gmail.com';

UPDATE users SET 
password = MD5('tanase12')
WHERE user = '@tanase123' AND email = 'tanase123@gmail.com';

DELETE FROM users WHERE user = '@tanase123' AND email = 'tanase123@gmail.com';

SELECT * FROM users;

SELECT * FROM users WHERE user = '@tanase123';

SELECT * FROM users WHERE email = 'tanase123@gmail.com';

SELECT * FROM users WHERE role = 'User';