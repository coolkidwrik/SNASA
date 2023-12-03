drop table Star;
drop table Nebula;
drop table Moon;
drop table Meteor;
drop table Satellite;
drop table Planet;
drop table PlanetarySystem;
drop table Asteroid;
drop table BlackHole;
drop table Galaxy;
drop table AsteroidComposition;
drop table StarTemperature;
drop table BlackHoleMass;
drop table GalaxyType;

-- create schemas

CREATE TABLE GalaxyType (
    shape VARCHAR(255),
    "TYPE" VARCHAR(255),
    PRIMARY KEY("TYPE")
);

CREATE TABLE BlackHoleMass (
    massType VARCHAR(255),
    mass INTEGER,
    PRIMARY KEY(mass)
);

CREATE TABLE StarTemperature (
    temperature INTEGER,
    "TYPE" VARCHAR(255),
    PRIMARY KEY(temperature)
);

CREATE TABLE AsteroidComposition (
    composition VARCHAR(255),
    "TYPE" VARCHAR(255),
    PRIMARY KEY(composition)
);

CREATE TABLE Galaxy (
    id VARCHAR(255),
    "SIZE" INTEGER,
    "TYPE" VARCHAR(255),
    PRIMARY KEY(id),
    FOREIGN KEY(type) REFERENCES GalaxyType(type) ON DELETE CASCADE
);

CREATE TABLE BlackHole (
    id VARCHAR(255),
    radius INTEGER,
    mass INTEGER,
    galaxyID VARCHAR(255),
    PRIMARY KEY(id),
    FOREIGN KEY(mass) REFERENCES BlackHoleMass(mass) ON DELETE CASCADE,
    FOREIGN KEY(galaxyID) REFERENCES Galaxy(id) ON DELETE CASCADE
);

CREATE TABLE Asteroid (
    id VARCHAR(255),
    composition VARCHAR(255),
    galaxyID VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (composition) REFERENCES AsteroidComposition(composition) ON DELETE CASCADE,
    FOREIGN KEY (galaxyID) REFERENCES Galaxy(id) ON DELETE CASCADE
);

CREATE TABLE PlanetarySystem (
    id VARCHAR(255),
    "TYPE" VARCHAR(255),
    age INTEGER,
    galaxyID VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (galaxyID) REFERENCES Galaxy(id) ON DELETE CASCADE
);

CREATE TABLE Planet (
    id VARCHAR(255),
    declination INTEGER,
    rightAscension INTEGER,
    mass INTEGER,
    radius INTEGER,
    "TYPE" VARCHAR(255),
    planetarySystemId VARCHAR(255),
    PRIMARY KEY(id),
    FOREIGN KEY (planetarySystemId) REFERENCES PlanetarySystem(id) ON DELETE CASCADE
);

CREATE TABLE Satellite (
    id VARCHAR(255),
    planetId VARCHAR(255),
    mass INTEGER,
    PRIMARY KEY(id),
    FOREIGN KEY (planetId) REFERENCES Planet(id) ON DELETE CASCADE
);

CREATE TABLE Meteor (
    id VARCHAR(255),
    planetEnteredID VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES Asteroid(id) ON DELETE CASCADE,
    FOREIGN KEY (planetEnteredID) REFERENCES Planet(id) ON DELETE CASCADE
);

CREATE TABLE Moon (
    id VARCHAR(255),
    planetId VARCHAR(255),
    radius INTEGER,
    PRIMARY KEY(id),
    FOREIGN KEY (id) REFERENCES Satellite(id) ON DELETE CASCADE
);

CREATE TABLE Nebula (
    id VARCHAR(255),
    "TYPE" VARCHAR(255),
    magnitude INTEGER,
    galaxyID VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (galaxyID) REFERENCES Galaxy(id) ON DELETE CASCADE
);

CREATE TABLE Star (
    id VARCHAR(255),
    declination INTEGER,
    rightAscension INTEGER,
    mass INTEGER,
    radius INTEGER,
    temperature INTEGER,
    luminosity INTEGER,
    planetarySystemID VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (temperature) REFERENCES StarTemperature(temperature) ON DELETE CASCADE,
    FOREIGN KEY (planetarySystemID) REFERENCES PlanetarySystem(id) ON DELETE CASCADE
);



-- insert statements
INSERT INTO GalaxyType VALUES ('Peculiar', 'Peculiar');
INSERT INTO GalaxyType VALUES ('Spiral', 'Spiral');
INSERT INTO GalaxyType VALUES ('Elliptical', 'Elliptical');
INSERT INTO GalaxyType VALUES ('Lenticular', 'Lenticular');
INSERT INTO GalaxyType VALUES ('Seyfert', 'Seyfert');

INSERT INTO BlackHoleMass VALUES ('Supermassive', 4154000);
INSERT INTO BlackHoleMass VALUES ('Stellar', 21.2);
INSERT INTO BlackHoleMass VALUES ('Intermediate', 90000);
INSERT INTO BlackHoleMass VALUES ('Supermassive', 2400000000000);
INSERT INTO BlackHoleMass VALUES ('Stellar', 26.3);

INSERT INTO StarTemperature VALUES (2566, 'M-Type');
INSERT INTO StarTemperature VALUES (2992, 'M-Type');
INSERT INTO StarTemperature VALUES (3547, 'M-Type');
INSERT INTO StarTemperature VALUES (5596, 'G-Type');
INSERT INTO StarTemperature VALUES (5772, 'G-Type');

INSERT INTO AsteroidComposition VALUES ('Chondrite', 'H Chondrite');
INSERT INTO AsteroidComposition VALUES ('Pallasite', 'P pallasite grouplet');
INSERT INTO AsteroidComposition VALUES ('O Chondrite', 'Ordinary Chondrite');
INSERT INTO AsteroidComposition VALUES ('Achondrite', 'Martian Meteorite');
INSERT INTO AsteroidComposition VALUES ('Iron', 'Iron');

INSERT INTO Galaxy VALUES ('Andromeda', 220000, 'Spiral');
INSERT INTO Galaxy VALUES ('Milky Way', 87400, 'Spiral');
INSERT INTO Galaxy VALUES ('Sombrero', 60000, 'Peculiar');
INSERT INTO Galaxy VALUES ('Triangulum', 60000, 'Spiral');
INSERT INTO Galaxy VALUES ('Whirlpool', 50000, 'Spiral');
INSERT INTO Galaxy VALUES ('ESO 243-49', 50000, 'Spiral');
INSERT INTO Galaxy VALUES ('Virgo A', 60000, 'Elliptical');

INSERT INTO BlackHole VALUES ('Sagittarius A*', 31.6, 4154000, 'Milky Way');
INSERT INTO BlackHole VALUES ('Cygnus X-1', 21, 21.2, 'Milky Way');
INSERT INTO BlackHole VALUES ('HLX-1', 0.14374012, 90000, 'ESO 243-49');
INSERT INTO BlackHole VALUES ('M87*', 8.15932E11, 2400000000000, 'Virgo A');
INSERT INTO BlackHole VALUES ('SS 433', 19.4, 26.3, 'Milky Way');

INSERT INTO Asteroid VALUES ('Aarhus', 'Chondrite', 'Milky Way');
INSERT INTO Asteroid VALUES ('Vermillion', 'Pallasite', 'Milky Way');
INSERT INTO Asteroid VALUES ('Qidong', 'O Chondrite', 'Milky Way');
INSERT INTO Asteroid VALUES ('Yamato 000593', 'Achondrite', 'Milky Way');
INSERT INTO Asteroid VALUES ('Hoba', 'Iron', 'Milky Way');
INSERT INTO Asteroid VALUES ('Asteroid1', 'Chondrite', 'Triangulum');
INSERT INTO Asteroid VALUES ('Asteroid2', 'Pallasite', 'Triangulum');
INSERT INTO Asteroid VALUES ('Asteroid3', 'O Chondrite', 'Triangulum');
INSERT INTO Asteroid VALUES ('Asteroid4', 'Achondrite', 'Triangulum');
INSERT INTO Asteroid VALUES ('Asteroid5', 'Iron', 'Triangulum');
INSERT INTO Asteroid VALUES ('Asteroid6', 'Achondrite', 'Whirlpool');
INSERT INTO Asteroid VALUES ('Asteroid7', 'Iron', 'Whirlpool');

INSERT INTO PlanetarySystem VALUES ('Kepler 22', 'Ordered', 7, 'Milky Way');
INSERT INTO PlanetarySystem VALUES ('Lalande 21185', 'Ordered', 7.5, 'Milky Way');
INSERT INTO PlanetarySystem VALUES ('Proxima Centauri', 'Ordered', 4.85, 'Milky Way');
INSERT INTO PlanetarySystem VALUES ('Solar System', 'Ordered', 4.571, 'Milky Way');
INSERT INTO PlanetarySystem VALUES ('TRAPPIST-1', 'Similar', 7.6, 'Milky Way');
INSERT INTO PlanetarySystem VALUES ('C.K.Wrik-System', 'Similar', 10, 'Whirlpool');


INSERT INTO Planet VALUES ('Earth', 0, 0, 1, 6378.137, 'Terrestrial', 'Solar System');
INSERT INTO Planet VALUES ('Jupiter', 268.057, 17.870556, 317.83985, 69911, 'Gas Giant', 'Solar System');
INSERT INTO Planet VALUES ('Kepler 22B', -47.8845, 19.281167, 2.1, 6378.137, 'Terrestrial', 'Kepler 22');
INSERT INTO Planet VALUES ('Saturn', 40.589, 2.7058333, 95.16, 58232, 'Gas Giant', 'Solar System');
INSERT INTO Planet VALUES ('Uranus', 257.311, 17.154167, 14.535, 25362, 'Ice Giant', 'Solar System');
INSERT INTO Planet VALUES ('Planet-Ayush', 258.311, 20.154167, 15.535, 25362, 'Gas Giant', 'C.K.Wrik-System');
INSERT INTO Planet VALUES ('Planet-Max', 259.311, 30.154167, 16.535, 25362, 'Ice Giant', 'C.K.Wrik-System');


INSERT INTO Satellite VALUES ('Europa', 'Jupiter', 0.008);
INSERT INTO Satellite VALUES ('Ganymede', 'Jupiter', 0.025);
INSERT INTO Satellite VALUES ('Miranda', 'Uranus', 1.07163E-05);
INSERT INTO Satellite VALUES ('Moon', 'Earth', 0.012294);
INSERT INTO Satellite VALUES ('Titan', 'Saturn', 0.0225);

INSERT INTO Meteor VALUES ('Aarhus', 'Earth');
INSERT INTO Meteor VALUES ('Hoba', 'Earth');
INSERT INTO Meteor VALUES ('Qidong', 'Earth');
INSERT INTO Meteor VALUES ('Vermillion', 'Earth');
INSERT INTO Meteor VALUES ('Yamato 000593', 'Earth');

INSERT INTO Moon VALUES ('Moon', 'Earth', 1737.4);
INSERT INTO Moon VALUES ('Ganymede', 'Jupiter', 2634.1);
INSERT INTO Moon VALUES ('Miranda', 'Uranus', 235.8);
INSERT INTO Moon VALUES ('Titan', 'Saturn', 2574.73);
INSERT INTO Moon VALUES ('Europa', 'Jupiter', 1560.8);

INSERT INTO Nebula VALUES ('Cat''s Eye Nebula', 'Planetary', 9.8, 'Milky Way');
INSERT INTO Nebula VALUES ('Dumbbell Nebula', 'Planetary', 7.5, 'Milky Way');
INSERT INTO Nebula VALUES ('Helix Nebula', 'Bright Planetary', 7.6, 'Milky Way');
INSERT INTO Nebula VALUES ('M2-09', 'Planetary', 14.7, 'Milky Way');
INSERT INTO Nebula VALUES ('Ring Nebula', 'Planetary', 8.8, 'Milky Way');

INSERT INTO Star VALUES ('Kepler 22', 47.8844301, 19.281164, 0.857, 0.869, 5596, 0.79, 'Kepler 22');
INSERT INTO Star VALUES ('Lalande 21185', 35.96988, 11.055609, 0.389, 0.392, 3547, 0.0195, 'Lalande 21185');
INSERT INTO Star VALUES ('Proxima Centauri', -62.6794897, 14.495261, 0.1221, 0.1542, 2992, 0.001567, 'Proxima Centauri');
INSERT INTO Star VALUES ('Sun', 9.8394, 13.569444, 1, 1, 5772, 1, 'Solar System');
INSERT INTO Star VALUES ('TRAPPIST-1', -5.0414, 23.108158, 0.0898, 0.1192, 2566, 0.000553, 'TRAPPIST-1');
INSERT INTO Star VALUES ('Big-Chungus-ONE', -4.0414, 27.108158, 0.0898, 0.1192, 5772, 0.000553, 'C.K.Wrik-System');
INSERT INTO Star VALUES ('Big-Chungus-TWO', -6.0414, 30.108158, 1.0898, 0.1192, 2566, 0.000553, 'C.K.Wrik-System');

