CREATE TABLE calificacionesPendientes (
	id int AUTO_INCREMENT,
    idUsuarioAutor int,
    idUsuarioCalificado int,
	PRIMARY KEY (id)
);
INSERT INTO calificacionesPendientes (idUsuarioAutor, idUsuarioCalificado) VALUES (1, 2);
INSERT INTO calificacionesPendientes (idUsuarioAutor, idUsuarioCalificado) VALUES (1, 3);
INSERT INTO calificacionesPendientes (idUsuarioAutor, idUsuarioCalificado) VALUES (2, 1);
INSERT INTO calificacionesPendientes (idUsuarioAutor, idUsuarioCalificado) VALUES (3, 1);
