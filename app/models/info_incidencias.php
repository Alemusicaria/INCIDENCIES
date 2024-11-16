<?php

class info_incidencias
{
    // Función para obtener la incidencia por su ID
    public function get_incidencia_by_id($id)
    {
        // Conexión a la base de datos
        $mysql = new mysqli("localhost", "root", "", "incidencies");
    
        if ($mysql->connect_error) {
            die('Problemas con la conexión a la base de datos');
        }
    
        // Consulta para obtener la incidencia con la ubicación (planta y sala)
        $query = "SELECT incidencies.id, incidencies.creador_nom_cognoms, incidencies.titol_fallo, incidencies.descripcio, 
                          incidencies.tipus_incidencia, incidencies.id_ubicacio, incidencies.data_incidencia, 
                          incidencies.estat, incidencies.prioritat, incidencies.imatges, 
                          sales.planta, sales.sala
                  FROM incidencies
                  INNER JOIN sales ON incidencies.id_ubicacio = sales.id
                  WHERE incidencies.id = '$id'"; // Consulta modificada para evitar el uso de prepared statements
    
        $result = $mysql->query($query);
    
        // Verificar si se encontró la incidencia
        if ($result->num_rows === 0) {
            return null; // Si no se encuentra la incidencia, devolver null
        } else {
            $incidencia = $result->fetch_assoc();
            var_dump($incidencia); 
            // Puedes agregar aquí un var_dump($incidencia) si deseas ver la información.
            return $incidencia; // Retornar la incidencia encontrada
            
        }
    }
}

