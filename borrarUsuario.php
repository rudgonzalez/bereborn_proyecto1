<?php
	
    require_once ("template/cabecera.php");
	require_once ("conexion.php");
    require_once ("template/pie.php");

	$idborrar = $_GET['id'];

    if($_SESSION['id'] == $idborrar)
    {
        $messageERR = "No se puede borrar este usuario. Debe ser eliminado por otro Usuario Administrador";
        header("Location: registroUsuarios.php", $messageERR);
    }
    else
    {
        $sqlBorrar = "DELETE FROM usuario WHERE id='$idborrar'";
        $result_borrar = $mysqli->query($sqlBorrar);

        if ($result_borrar)
        {
            $message = "El usuario fue eliminado correctamente.";
            header('Location: registroUsuarios.php', $message);
        }
        else
        {
            $messageERR = "Hubo un error. El usuario no fue eliminado.";
            header('Location: registroUsuarios.php', $messageERR);
        }
    }
?>
