<?php
    session_start();

    
    //nombre del usuario en icono
    if(isset($_SESSION['id']))
    {
        $nombre = $_SESSION['nombre'];  
        $tipo_usuario = $_SESSION['tipo_usuario'];
    }  
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Junta Comunal Don Bosco</title>

    <link rel="stylesheet" href="./css/styles.css" />
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/cedula.js"></script>
    <script src="./js/bootstrap.min.js"></script>	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/df310aba3e.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php"><img src="./img/Sin título.png" alt="" class="logo" style="width: 200px; height:auto;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor03">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
            <a class="nav-link active" href="#">Misión & Visión</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Noticias</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Conocenos</a>
            </li>
            <?php 
            if(isset($_SESSION['id']) && $tipo_usuario == 2)
            {
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Usuario</a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="registroCiudadano.php">Registro de Ciudadanos</a></li>
                    <li><a class="dropdown-item" href="registroActividades.php">Registro de Actividades</a></li>
                    <li><a class="dropdown-item" href="#">Func 3</a></li>
                    <li><div class="dropdown-divider"></div></li>
                    <li><a class="dropdown-item" href="#">Func 4</a></li>
                </ul>
            </li>
            <?php
            }
            ?>
            <?php 
            if(isset($_SESSION['id']) && $tipo_usuario == 1)
            {
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Admin</a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="registroUsuarios.php">Usuarios</a></li>
                    <li><a class="dropdown-item" href="registroCiudadano.php">Registro de Ciudadanos</a></li>
                    <li><a class="dropdown-item" href="actividades.php">Eventos y Actividades</a></li>
                    <li><a class="dropdown-item" href="registroActividades.php">Registro de Actividades</a></li>
                </ul>
            </li>
            <?php
            }
            ?>
            <!--<form class="d-flex">
                <input class="form-control me-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>-->
            <?php 
            if(isset($_SESSION['id']))
            {
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php 
                    if(isset($_SESSION['nombre']))
                    {
                        echo $nombre;
                    }
                    else
                    {
                        echo "";
                    }
                    
                    ?>
                    <i class="fa fa-user-circle"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Configuración</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                </ul>
            </li>
            <?php
            }
            ?>
        </ul>
        </div>
    </div>
    </nav>

    <div class="container">
        <div class = "row">