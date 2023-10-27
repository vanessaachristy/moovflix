CREATE DATABASE IF NOT EXISTS moovlix;

CREATE TABLE IF NOT EXISTS movie (
    id INT PRIMARY KEY,
    movie_name VARCHAR(50) NOT NULL, 
    genre VARCHAR(50) NOT NULL, 
    banner VARCHAR(250), 
    synopsis VARCHAR(500) NOT NULL, 
    cast VARCHAR(500) NOT NULL, 
    director VARCHAR(50) NOT NULL, 
    languages VARCHAR(50) NOT NULL, 
    duration VARCHAR(50), 
    rating VARCHAR(50), 
    poster VARCHAR(250)
);

CREATE TABLE IF NOT EXISTS screen(
    id INT PRIMARY KEY, 
    cinema_name VARCHAR(50), 
    cinema_location VARCHAR(250), 
    images VARCHAR(250)
);

CREATE TABLE IF NOT EXISTS shows(
    id INT PRIMARY KEY, 
    dates TIMESTAMP, 
    movieID INT, 
    screenID INT,
    FOREIGN KEY (movieID) REFERENCES movie(id),
    FOREIGN KEY (screenID) REFERENCES screen(id)
);


INSERT INTO movie (id, movie_name, genre, banner, synopsis, cast, director, languages, duration, rating, poster)
VALUES 
    (1, 'Avatar: The Way of Water', 'ADVENTURE','img/avatar.png', 'Set more than a decade after the events of the first film, "Avatar: The Way of Water" begins to tell the story of the Sully family (Jake, Neytiri, and their kids), the trouble that follows them, the lengths they go to keep each other safe, the battles they fight to stay alive, and the tragedies they endure.', 'Zoe Saldana, Sam Worthington, Sigourney Weaver, Michelle Rodriguez', 'James Cameron', 'ENGLISH', '3H 12Min', 'PG13', 'img/avatar-poster.png' ),
    (2, 'Taylor Swift Eras Tour', 'CONCERT', 'img/taylorswift.png', 'The cultural phenomenon continues on the big screen! Immerse yourself in this once-in-a-lifetime concert film experience with a breathtaking, cinematic view of the history-making tour. Taylor Swift Eras Tour attire and friendship bracelets are strongly encouraged!', 'Taylor Swift', 'Sam Wrench', 'ENGLISH', '2H 48Min', 'TBA', 'img/taylorswift-poster.png'), 
    (3, 'A Haunting In Venice', 'MYSTERY', 'img/hauntingvenice.png', 'Belgian sleuth Hercule Poirot investigates a murder while attending a Halloween seance at a haunted palazzo in Venice, Italy.', 'Tina Fey, Jamie Dornan, Michelle Yeoh, Kenneth Branagh', 'Kenneth Branagh','ENGLISH', '1H 43Min', 'PG13', 'img/hauntingvenice-poster.png'),
    (4, 'John Wick 4', 'ACTION', 'img/johnwick4.png', 'John Wick uncovers a path to defeating The High Table. But before he can earn his freedom, Wick must face off against a new enemy with powerful alliances across the globe and forces that turn old friends into foes.', 'Keanu Reeves, Donnie Yen, Bill Skarsgard, Laurence Fishburne', 'Chad Stahelski', 'ENGLISH', '2H 30Min', 'PG1.9', 'img/johnwick-poster.png');

INSERT INTO screen(id, dates, cinema_name, cinema_location, images)
VALUES
    (1, 'MOOVLIX ION ORCHARD', '2 Orchard Turn, Singapore 238801', 'img/orchard.jpg'), 
    (2, 'MOOVLIX MARINA BAY SANDS', '10 Bayfront Ave, Singapore 018956', 'img/marina.png'), 
    (3, 'MOOVLIX NANYANG', '50 Nanyang Ave, Singapore 639798', 'img/ntu.png'), 
    (4, 'MOOVLIX JURONG EAST', '50 Jurong Gateway Rd, Singapore 608549', 'img/jem.png')

