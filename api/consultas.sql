
INSERT INTO automovil (id, id_comercios, id_chofer, placas, descripcion, foto1, foto2, foto3, id_registro, fecha_registro,
        id_ubicacion, latitud, longitud, comentarios, fecha_ubicacion, fecha_pedir, id_entrega, fecha_entregado,
        comentarios_entregado, fecha_notificado, comentarios_cliente, token, condiciones, estatus) 
    VALUES ('1', '2', '2', 'BMW234', 'carro color rojo', 'none', 'none', 'none', '1', '2022-03-22 10:06:00',
        NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1');


SELECT chofer_lugares.id, chofer_lugares.id_chofer, comercios.id, comercios.nombre 
    FROM chofer_lugares 
    INNER JOIN comercios 
    ON chofer_lugares.id_comercios = comercios.id

SELECT chofer_lugares.id, chofer_lugares.id_chofer, comercios.id, comercios.nombre 
    FROM chofer_lugares 
    INNER JOIN comercios 
    ON chofer_lugares.id_comercios = comercios.id 
    AND chofer_lugares.id_chofer = 2

SELECT comercios.id, comercios.nombre, valet.id, valet.nombre 
    FROM comercios 
    INNER JOIN valet 
    ON comercios.id_valet = valet.id

SELECT comercios.id, comercios.nombre, valet.id, valet.nombre 
    FROM comercios 
    INNER JOIN valet 
    ON comercios.id_valet = valet.id 
    AND valet.id = 2


SELECT comercios.nombre 
    FROM chofer_lugares 
    INNER JOIN comercios 
    ON chofer_lugares.id_comercios = comercios.id 
    AND chofer_lugares.id_chofer = 2