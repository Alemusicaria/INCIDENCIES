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
        $query = "SELECT *
                  FROM incidencies
                  WHERE incidencies.id = '$id'"; // Consulta modificada para evitar el uso de prepared statements
    
        $result = $mysql->query($query);
    
        // Verificar si se encontró la incidencia
        if ($result->num_rows === 0) {
            return null; // Si no se encuentra la incidencia, devolver null
        } else {
            $incidencia = $result->fetch_assoc();
        
            // Limpieza y estandarización de las claves
            $incidencia = array_change_key_case(array_map('trim', $incidencia), CASE_LOWER);
        
            var_dump($incidencia); // Para depuración
            return $incidencia;
        }
    }

    public function ubicacion($id)
{
    $mysql = new mysqli("localhost", "root", "", "incidencies");

    if ($mysql->connect_error) {
        die('Problemas con la conexión a la base de datos');
    }

    // Consulta preparada para obtener la planta y la sala
    $stmt = $mysql->prepare("
        SELECT sales.planta, sales.sala
        FROM incidencies
        INNER JOIN sales ON incidencies.id_ubicacio = sales.id
        WHERE incidencies.id = ?
    ");

    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysql->error);
    }

    // Vincular el parámetro
    $stmt->bind_param('i', $id);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $stmt->close();
        $mysql->close();
        return $data; // Devuelve un array con 'planta' y 'sala'
    } else {
        $stmt->close();
        $mysql->close();
        return null; // Si no se encuentran datos
    }
}

}

