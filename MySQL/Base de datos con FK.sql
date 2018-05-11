CREATE TABLE Usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  mail VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(30) NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  apellido VARCHAR(50) NOT NULL,
  nacimiento DATE NOT NULL,
  contenidoimagen LONGBLOB,
  tipoimagen VARCHAR(45),
  esAdministrador BIT NOT NULL DEFAULT 0,
  estaActivo BIT NOT NULL DEFAULT 1,
  PRIMARY KEY (id)
);

CREATE TABLE Vehiculos (
	id INT NOT NULL AUTO_INCREMENT,
	idUsuario INT,
	patente VARCHAR(20) NOT NULL,
	asientos INT NOT NULL,
	modelo VARCHAR(50) NOT NULL,
	color VARCHAR(30) NOT NULL,
	estaActivo BIT NOT NULL DEFAULT 1,
	PRIMARY KEY (id),
	FOREIGN KEY (idUsuario) REFERENCES Usuarios (id)
)

CREATE TABLE EstadosViaje (
	id INT NOT NULL AUTO_INCREMENT,
	estado VARCHAR(20) NOT NULL UNIQUE,
	PRIMARY KEY (id)
)

CREATE TABLE Ciudades (
	id INT NOT NULL AUTO_INCREMENT,
	ciudad VARCHAR(50) NOT NULL,
	provincia VARCHAR(50) NOT NULL,
	PRIMARY KEY (id)
)

CREATE TABLE Viajes (
	id INT NOT NULL AUTO_INCREMENT,
	fecha DATETIME NOT NULL,
	duracion TIME NOT NULL,
	precio REAL,
	texto VARCHAR (500),
	idEstado INT,
	idOrigen INT,
	idDestino INT,
	idVehiculo INT,
	idConductor INT,
	PRIMARY KEY (id),
	FOREIGN KEY (idEstado) REFERENCES EstadosViaje (id),
	FOREIGN KEY (idOrigen) REFERENCES Ciudades(id),
	FOREIGN KEY (idDestino) REFERENCES Ciudades(id),
	FOREIGN KEY (idVehiculo) REFERENCES Vehiculos (id),
	FOREIGN KEY (idConductor) REFERENCES Usuarios (id)
)

CREATE TABLE Preguntas (
	id INT NOT NULL AUTO_INCREMENT,
	pregunta VARCHAR(300) NOT NULL,
	fecha DATETIME NOT NULL,
	idViaje INT,
	idUsuario INT,
	PRIMARY KEY (id),
	FOREIGN KEY (idViaje) REFERENCES Viajes (id),
	FOREIGN KEY (idUsuario) REFERENCES Usuarios (id)
)

CREATE TABLE Respuestas (
	id INT NOT NULL AUTO_INCREMENT,
	respuesta VARCHAR(300) NOT NULL,
	fecha DATETIME NOT NULL,
	idPregunta INT,
	PRIMARY KEY (id),
	FOREIGN KEY (idPregunta) REFERENCES Preguntas (id)
)

CREATE TABLE EstadosPostulacion (
	id INT NOT NULL AUTO_INCREMENT,
	estado VARCHAR(20) NOT NULL UNIQUE,
	PRIMARY KEY (id)
)

CREATE TABLE Postulaciones (
	id INT NOT NULL AUTO_INCREMENT,
	fecha DATETIME NOT NULL,
	idViaje INT,
	idUsuario INT,
	idEstado INT,
	PRIMARY KEY (id),
	FOREIGN KEY (idViaje) REFERENCES Viajes (id),
	FOREIGN KEY (idUsuario) REFERENCES Usuarios (id),
	FOREIGN KEY (idEstado) REFERENCES EstadosPostulacion (id)
)

CREATE TABLE Calificacion (
	id INT NOT NULL AUTO_INCREMENT,
	fecha DATETIME NOT NULL DEFAULT --GET DATETIME()
	rol VARCHAR (20), 
	puntuacion INT NOT NULL,
	comentario VARCHAR (500), 
	idUsuarioAutor INT,
	idUsuarioCalificado INT,
	PRIMARY KEY (id),
	FOREIGN KEY (idUsuarioAutor) REFERENCES Usuarios (id),
	FOREIGN KEY (idUsuarioCalificado) REFERENCES Usuarios (id)
)