<!-- AGREGAMOS EL HEADER Y EL MENU A LA PAGINA -->
<?php 

session_start();
    
    if(!isset($_SESSION['usuario'])){
        header('Location: ../login/login.php');
    }

    require_once ($_SERVER['DOCUMENT_ROOT'].'/dirs.php');
    require_once (VIEW_PATH.'components/header.php');
    require_once (VIEW_PATH.'components/menu.php');
    require_once (CONTROLLER_PATH.'SolicitudController.php');

    $listadoCitasMedico = getAgendaMedica($_SESSION['id_usuario']);
    //print_r($listadoCitasMedico);
?>

<section class="home-section p-2">   

    <header>
        <nav class="navbar navbar-dark bg-info shadow rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="../dashboard.php">Agenda Medica</a>
            </div>
        </nav>
    </header>

    <div class="mt-3">
        <div class="btn-group shadow" role="group" aria-label="Basic example">
            <button type="button" id="btnActualizarAgendaMedica" class="btn btn-info text-white btn-sm">Actualizar</button>
        </div>
    </div>
    
    <div class="mt-3 p-4 bg-white shadow rounded">
        <table id="tablas" class="table table-hover"  style="width: 100%">
                <thead class="table-dark">
                    <tr>
                        <th>NO</th>
                        <th>PACIENTE</th>
                        <th>FECHA SOLICITUD</th>
                        <th>ESTADO</th>
                        <th>FECHA DE VISITA</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listadoCitasMedico as $citas){ ?>
                    <tr>
                        <td><?php echo $citas['id_cita_medica'] ?></td>
                        <td><?php echo $citas['nombres'] . ' ' . $citas['apellidos'] ?></td>
                        <td><?php echo date("d-m-Y", strtotime($citas['fecha_solicitud'])) ?></td>
                        <td><?php echo $citas['estado'] ?></td>
                        <td><?php echo $citas['fecha_visita'] == "" ? "Sin Asignar" : date("d-m-Y", strtotime($citas['fecha_visita'])) ?></td>
                        <td>
                            <a href="../solicitud/detalle-solicitud.php?id=<?php echo $citas['id_cita_medica'] ?>">
                                <button class="btn btn-info text-white btn-sm">Detalles</button>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
        </table>
    </div>
</section>


<!-- AGREGAMOS EL MODAL PARA REGISTRAR NUEVO INTERNO -->
<?php require_once (VIEW_PATH.'components/form-solicitud.php'); ?>

<!-- AGREGAMOS EL FOOTER DE LA PAGINA -->
<?php require_once (VIEW_PATH.'components/footer.php'); ?>