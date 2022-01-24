<?php

try
{
    $mysqli = new mysqli("localhost", "root", "yazid10", "proyectodonbosco");
}
catch (Exception $ex)
{
    $ex->getMessage("Hubo un error en la conexión.");
}

?>