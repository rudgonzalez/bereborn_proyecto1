<?php
	
    require_once ("template/cabecera.php");
	require_once ("conexion.php");
    require_once ("template/pie.php");

	$idborrar = $_GET['id'];

    $sqlBorrar = "DELETE FROM ciudadanos WHERE id='$idborrar'";
    $result_borrar = $mysqli->query($sqlBorrar);

    if ($result_borrar)
    {
        $message = "El registro fue eliminado correctamente.";
        header('Location: registroUsuarios.php', $message);
    }
    else
    {
        $messageERR = "Hubo un error. El registro no fue eliminado.";
        header('Location: registroUsuarios.php', $messageERR);
    }
?>