<?php 
    require_once ("template/cabecera.php");
    require_once ("conexion.php");

    $sql= "SELECT DISTINCT id, nombre FROM actividades WHERE status = 'Activo'";
    $result = $mysqli->query($sql);

    if(isset($_POST['buscar']))
    {       
        $cedula_b = $_POST['cedula'];
        
        if(empty($_POST['cedula']))
        {
            $messageERR = "Por favor ingrese un no. de cedula";
        }
        else
        {
            $sqlBuscar = "SELECT * FROM ciudadanos WHERE cedula = '$cedula_b'";
            $result_buscar = $mysqli->query($sqlBuscar);
        
            if ($result_buscar->num_rows == 0)
            {
                $messageERR ="El no. de cedula que esta buscando no existe.";
            }
            else
            {
                while($row_b = $result_buscar->fetch_assoc())
                {
                    $id_b = $row_b['id'];
                    $cedula_b = $row_b['cedula'];
                    $nombre_b = $row_b['nombre'];
                    $app_b = $row_b['apellido_paterno'];
                    $apm_b = $row_b['apellido_materno'];
                    $fnac_b = $row_b['fecha_nacimiento'];
                }
            }   
        }       
    }

    //ingresar nuevo
    if(isset($_POST['nuevo']))
    {
        $message = "";
        $messageERR = "";
 
        $idCiudadano = $_POST['idciu'];
        $idActividad = $_POST['act'];
        $comentario = $_POST['com'];
        $id_usuario = $_POST['usuario'];
        $fecha = $_POST['fecha'];
 
        if(empty($_POST['id']) && empty($_POST['act']) && empty($_POST['usuario']) && empty($_POST['fecha']))
        {
            $messageERR = "Algunos de los campos obligatorios esta vacio.";
        }
        else 
        {
            $sqlRepetido = "SELECT * FROM registro_actividad WHERE idCiudadano = '$idCiudadano' AND idActividad ='$idActividad'";
            $result_repetido = $mysqli->query($sqlRepetido);

            if($result_repetido->num_rows >0)
            {
                $messageERR = "El ciudadano ya esta registrado en este evento.";
            }
            else
            {
                $sqlRegistrar = "INSERT INTO registro_actividad (idCiudadano, idActividad, comentario, id_usuario, fecha) 
                VALUES ('$idCiudadano', '$idActividad', '$comentario', '$id_usuario', '$fecha')";
                $result_registrar = $mysqli->query($sqlRegistrar);

                $message = "El ciudadano fue registrado al evento correctamente.";
            }         
        }
    }
?>
    <div class="card bg-secondary mb-3">
    <div class="card-header">Registro de Actividades y Eventos</div>
    <div class="card-body">
        <h4 class="card-title">Registro de Ciudadanos a los Eventos y Actividades de la Junta Comunal de Don Bosco</h4>
        <?php 
            if(!empty($message))
            {
        ?>
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong><?= $message ?></strong>
                </div>
        <?php
            }
            if(!empty($messageERR))
            {
        ?>
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong><?= $messageERR ?></strong>
                </div>
        <?php
            }
        ?>
        <div style="width: 600px; padding: 30px; background:navajowhite; display: flex; flex-wrap:wrap;" >
            <form method="POST" action="registroActividades.php" style="margin: auto;">
                <input name="cedula" type="text" placeholder="Ingrese no. de cédula" required>
                <button name="buscar" type="submit">Buscar</button>
            </form>
            <form method="POST" action="registroActividades.php">
                <div style="width: 540px; <?php if(!isset($_POST['buscar'])){ ?> display: none;<?php } ?> margin-top: 20px;">
                    <input type="hidden" id="idciu" name="idciu" value="<?php if(isset($_POST['buscar'])){ echo $id_b;}?>">
                    <label style="width: 540px;"><?php if(isset($_POST['buscar'])){ echo $cedula_b; }?></label>
                    <label style="width: 540px;"><?php if(isset($_POST['buscar'])){ echo $nombre_b.' '.$app_b.' '.$apm_b; }?></label >
                    <label style="width: 540px;"><?php if(isset($_POST['buscar'])){ echo $fnac_b; }?></label>
                </div>
                <div style="width: 540px; display: block; margin-top: 20px;">
                    <label for="" style="width: 540px;">Actividad</label>
                    <select id="act" name="act" style="width: 400px;" required>
                    <?php
                    while($row = $result->fetch_assoc())
                    {
                    ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php
                    }
                    ?>
                    </select>
                    <label for="" style="width: 540px; margin-top: 15px;">Comentario</label>
                    <textarea style="width: 400px;" class="" id="com" name="com" rows="3"></textarea>
                </div>
                <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['id'];?>" required>
                <input type="hidden" id="fecha" name="fecha" value="<?php date_default_timezone_set("America/Panama"); echo date("Y-m-d h:i:sa"); ?>" required>
                <button style="margin-top: 20px;" class="btn-info" name="nuevo" type="submit">Registrar</button>
            </form>
        </div>
    </div>
<?php
    require_once ("template/pie.php");
?>