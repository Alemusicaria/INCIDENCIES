<?php
require "app/models/incidencias.php"; // Inclou el model 'incidencias' per gestionar les operacions relacionades amb les incidències.

class IncidenciasController
{
    /**
     * Processa l'ingrés d'una nova incidència i redirigeix segons el resultat.
     */
    public function Ingresar_Incidencias()
    {
        $ingresar_incidencia = new incidencias(); // Crea una instància del model 'incidencias'.

        // Verifica si la incidència s'ha ingressat correctament.
        if ($ingresar_incidencia->ingresar_incidencias()) {
            // Redirigeix a la pàgina de benvinguda si l'ingrés és satisfactori.
            header("Location: index.php?controller=Login&method=bienvenido");
        } else {
            // Redirigeix a la vista d'ingrés d'incidències si hi ha un error.
            header("Location: index.php?controller=Incidencias&method=vista_ingreso_incidencias");
        }
    }

    /**
     * Carrega la vista per ingressar una nova incidència.
     */
    public function vista_ingreso_incidencias()
    {
        require "app/views/layouts/Forms/V_IngresoIncidencias.php"; // Carrega la vista d'ingrés d'incidències.
    }

    /**
     * Obté les sales disponibles per a una planta específica via AJAX.
     * Respon amb un JSON que conté les sales.
     */
    public function obtenerSalas()
    {
        if (isset($_POST['planta'])) { // Verifica si s'ha enviat el paràmetre 'planta' via POST.
            $planta = $_POST['planta']; // Assigna el valor de la planta seleccionada.
            $incidenciasModel = new incidencias(); // Crea una instància del model 'incidencias'.

            // Obté les sales corresponents a la planta seleccionada.
            $salas = $incidenciasModel->obtenerSalasPorPlanta($planta);

            // Envia la resposta en format JSON.
            echo json_encode($salas);
        }
    }

    public function obtenerTecnicosPorCategoria()
    {
        if (isset($_POST['categoria'])) {
            $categoria = $_POST['categoria'];
            $incidenciasModel = new incidencias();
            $tecnicos = $incidenciasModel->obtenerTecnicosPorCategoria($categoria);
            echo json_encode($tecnicos);
        }
    }

    public function obtenerNumeroTecnico()
    {
        if (isset($_POST['tecnico_id'])) {
            $tecnico_id = $_POST['tecnico_id'];
            $incidenciasModel = new incidencias();
            $numero = $incidenciasModel->obtenerNumeroTecnico($tecnico_id);

            if ($numero) {
                echo json_encode(['numero' => $numero]);
            } else {
                echo json_encode(['error' => 'Número no encontrado.']);
            }
        } else {
            echo json_encode(['error' => 'ID de técnico no proporcionado.']);
        }
    }

    
}
