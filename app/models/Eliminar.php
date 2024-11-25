<?php 
class eliminar
{
    public function eliminar_incidencia($id_incidencia)
    {
        require_once 'app\models\connexio.php';
        
        // Validar el ID
        if ($id_incidencia) {
            // Marcar la incidencia como eliminada (habilitado = 0)
            $query_eliminar_incidencia = "UPDATE incidencies SET habilitado = 0 WHERE id = ?";
            $stmt = $conn->prepare($query_eliminar_incidencia);

            // Ejecutar la consulta y devolver el resultado
            if ($stmt->execute([$id_incidencia])) {
                return true;
            } else {
                return false;
            }
        } else {
            echo "ID de incidencia no válido.";
            return false;
        }
    }
}