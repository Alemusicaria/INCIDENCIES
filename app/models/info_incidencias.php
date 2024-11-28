<?php

class info_incidencias
{
    // Funció per obtenir una incidència per la seva ID
    public function get_incidencia_by_id($id)
    {
        global $conn; // Assegura que $conn és accessible a tot el codi

        require_once('app/models/connexio.php');

        // Consulta per obtenir les dades de la incidència segons la seva ID
        $query = "SELECT * FROM incidencies WHERE incidencies.id = '$id'";

        $result = $conn->query($query);

        // Comprovem si la incidència existeix
        if ($result->num_rows === 0) {
            return null; // Si no es troba la incidència, retornem null
        } else {
            // Obtenim les dades de la incidència
            $incidencia = $result->fetch_assoc();

            // Netegem i estandarditzem les claus de l'array
            $incidencia = array_change_key_case(array_map('trim', $incidencia), CASE_LOWER);

            // Si la incidència té imatges, les dividim en un array
            if (!empty($incidencia['imatges'])) {
                $incidencia['imatges'] = explode(',', $incidencia['imatges']);  // Convertim la cadena de rutes en un array
            } else {
                $incidencia['imatges'] = [];  // Si no té imatges, assignem un array buit
            }

            return $incidencia;  // Retornem les dades de la incidència
        }
    }

    // Funció per obtenir la ubicació (planta i sala) d'una incidència per la seva ID
    public function ubicacion($id)
    {
        require_once('app/models/connexio.php');

        global $conn; // Declarar la variable global per utilitzar-la aquí

        // Consulta per obtenir la planta i sala de la ubicació de la incidència
        $query = "SELECT sales.planta, sales.sala 
                  FROM incidencies 
                  INNER JOIN sales ON incidencies.id_ubicacio = sales.id 
                  WHERE incidencies.id = '$id'";

        $result = $conn->query($query);

        // Comprovem si es troba la ubicació
        if ($result->num_rows > 0) {
            // Obtenim les dades de la ubicació
            $ubicacion = $result->fetch_assoc();
            // Netegem i estandarditzem les claus de l'array
            $ubicacion = array_change_key_case(array_map('trim', $ubicacion), CASE_LOWER);
            return $ubicacion; // Retornem un array amb 'planta' i 'sala'
        } else {
            return null; // Si no es troben dades de la ubicació, retornem null
        }
    }

    public function tecnicos($id)
    {
        require_once('app/models/connexio.php');
        
        global $conn; // Declarar la variable global per utilitzar-la aquí

        $query = "SELECT tecnics.nom_cognoms
            FROM incidencies
            INNER JOIN tecnics ON incidencies.id_tecnico = tecnics.id
            WHERE incidencies.id = '$id'";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $tecnico = $result->fetch_assoc();
            $tecnico = array_change_key_case(array_map('trim', $tecnico), CASE_LOWER);
            return $tecnico;
        } else {
            return null;
        }
    }
}
