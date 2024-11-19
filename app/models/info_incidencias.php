<?php

class info_incidencias
{
    // Función para obtener la incidencia por su ID
    public function get_incidencia_by_id($id)
    {
        require_once 'app\models\connexio.php';

    
        // Consulta para obtener la incidencia
        $query = "SELECT * FROM incidencies WHERE incidencies.id = '$id'"; 
    
        $result = $conn->query($query);
    
        // Verificar si se encontró la incidencia
        if ($result->num_rows === 0) {
            return null; // Si no se encuentra la incidencia, devolver null
        } else {
            $incidencia = $result->fetch_assoc();
    
            // Limpiar y estandarizar las claves
            $incidencia = array_change_key_case(array_map('trim', $incidencia), CASE_LOWER);
            
            if (!empty($incidencia['imatges'])) {
                $incidencia['imatges'] = explode(',', $incidencia['imatges']);  // Convertir la cadena en array
            } else {
                $incidencia['imatges'] = [];  // Si no hay imágenes, asignar un array vacío
            }

            return $incidencia;
        }
    }
    
    public function ubicacion($id)
    {
        require_once 'app\models\connexio.php';

    
        // Consulta para obtener la planta y la sala usando el id de la incidencia
        $query = "SELECT sales.planta, sales.sala 
                  FROM incidencies 
                  INNER JOIN sales ON incidencies.id_ubicacio = sales.id 
                  WHERE incidencies.id = '$id'";
    
        $result = $conn->query($query);
    
        // Verificar si se encontró la ubicación
        if ($result->num_rows > 0) {
            $ubicacion = $result->fetch_assoc();
    
            // Limpiar y estandarizar las claves
            $ubicacion = array_change_key_case(array_map('trim', $ubicacion), CASE_LOWER);
    
            return $ubicacion; // Devuelve un array con 'planta' y 'sala'
        } else {
            return null; // Si no se encuentran datos de la ubicación
        }
    }
}

