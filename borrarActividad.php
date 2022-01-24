<?php
	
    require_once ("template/cabecera.php");
	require_once ("conexion.php");
    require_once ("template/pie.php");

	$idborrar = $_GET['id'];

    $sqlBorrar = "DELETE FROM actividades WHERE id='$idborrar'";
    $result_borrar = $mysqli->query($sqlBorrar);

    if ($result_borrar)
    {
        $message = "La actividad fue eliminada correctamente.";
        header('Location: actividades.php', $message);
    }
    else
    {
        $messageERR = "Hubo un error. La actividad no se elimino.";
        header('Location: actividades.php', $messageERR);
    }
    
?>