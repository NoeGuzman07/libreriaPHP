<?php
session_start();
$template = new TemplateController();
$url = $template->obtenerUrlController();
$v = "1";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Proyecto Prueba - Libreria</title>
    <meta name="theme-color" content="#000000">
    <meta name="msapplication-navbutton-color" content="#000000">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="icon" sizes="192x192" href="<?php echo $url; ?>views/assets/css/img/favicon/favicon-192.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>views/assets/css/css/bootstrap/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>views/assets/plugins/DataTables/datatables.min.css" />
    <!-- DataTables -->
    <!-- Select2 stylesheet -->
    <link href="<?php echo $url; ?>views/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Select2 stylesheet -->
    <!-- Editable select -->
    <link href="<?php echo $url; ?>views/assets/plugins/editable-select/jquery-editable-select.min.css" rel="stylesheet">
    <!-- Editable select -->
    <!-- FullCalendar -->
    <link href='<?php echo $url; ?>views/assets/plugins/fullcalendar/dist/fullcalendar.min.css' rel='stylesheet' />
    <link href='<?php echo $url; ?>views/assets/plugins/fullcalendar/dist/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <!-- FullCalendar -->
    <!-- Iconos -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>views/assets/css/css/fontawesome/all.min.css">
    <!-- Iconos -->
    <!-- Estilos internos -->
    <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>views/assets/css/css/style.css">
    <!-- Estilos internos -->
    <!-- Moment -->
    <script src='<?php echo $url; ?>views/assets/plugins/moment/min/moment.min.js'></script>
    <!-- Moment -->
    <!-- Chart js -->
    <script src="<?php echo $url; ?>views/assets/plugins/chartjs/chart.js"></script>
    <!-- Chart js -->
    <!-- Jquery -->
    <script src="<?php echo $url; ?>views/assets/js/jquery-3.3.1.min.js"></script>
    <!-- Jquery -->
    <!-- Webcam -->
    <script type="text/javascript" src="<?php echo $url; ?>views/assets/plugins/webcam/webcam.min.js"></script>
    <!-- Webcam -->
    <!-- SweetAlert -->
    <script src="<?php echo $url; ?>views/assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
    <!-- SweetAlert -->
    <!-- Bootstrap JS  -->
    <script src="<?php echo $url; ?>views/assets/css/js/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo $url; ?>views/assets/css/js/popper/popper.min.js"></script>
    <script src="<?php echo $url; ?>views/assets/css/js/main.js"></script>

</head>

<body id="body">

    <input type="hidden" class="url" value="<?php echo $url; ?>">

    <?php
    if (isset($_GET['action'])) {
        $action = explode("/", $_GET['action']);
        $moduloActual = $action[0];
    } else {
        $moduloActual = "dashboard";
    }
    ?>

    <input type="hidden" class="moduloActual" value="<?php echo $moduloActual; ?>">

    <?php
    if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == 'ok') {

        echo '<div id="sistema">';

        include "modules/sections/navbar.php";
        include "modules/sections/sidebar.php";
        echo '<div class="contenido"><div class="modulos">';

        $_SESSION['nivel'] = 'Administrador';

        if (isset($action[0])) {

            if ($_SESSION['nivel'] == 'Administrador') {
                
                //Administrador

                if (
                    $action[0] == "dashboard"                       ||
                    $action[0] == "404"                             ||
                    $action[0] == "mantenimiento"                   ||
                    $action[0] == "usuarios"                        ||
                    $action[0] == "salir"
                ) {

                    echo '<div class="modulo-' . $action[0] . '">';
                    include "modules/" . $action[0] . ".php";
                    echo '</div>';
                } else {

                    echo '<div class="modulo-404">';
                    include "modules/404.php";
                    echo '</div>';
                }
            } elseif ($_SESSION['nivel'] == 'Supervisor') {
                //Supervisor

            } else {
                //Cliente

            }
        } else {

            echo '<div class="modulo-dashboard">';
            include "modules/dashboard.php";
            echo '</div>';
        }

        echo '</div></div></div>';
    } else {

        include "modules/login.php";
    }
    ?>

    <!-- FullCalendar -->
    <script src='<?php echo $url; ?>views/assets/plugins/fullcalendar/dist/fullcalendar.js'></script>
    <script src='<?php echo $url; ?>views/assets/plugins/fullcalendar/dist/locale/es.js'></script>
    <script src='<?php echo $url; ?>views/assets/plugins/fullcalendar/dist/locale-all.js'></script>
    <!-- DataTables -->
    <script type="text/javascript" src="<?php echo $url; ?>views/assets/plugins/DataTables/datatables.min.js"></script>
    <!--Select2 JQuery-->
    <script src="<?php echo $url; ?>views/assets/plugins/select2/dist/js/select2.full.min.js"></script>
    <!--Editable select-->
    <script src="<?php echo $url; ?>views/assets/plugins/editable-select/jquery-editable-select.min.js"></script>
    <!--Jquery loading-->
    <script src="<?php echo $url; ?>views/assets/plugins/jqueryLoading/loading.js"></script>
    <!-- Custom scripts -->
    <script src="<?php echo $url; ?>views/assets/js/scripts/general.js?v='<?php echo $v; ?>'"></script>
    <script src="<?php echo $url; ?>views/assets/js/scripts/login.js?v='<?php echo $v; ?>'"></script>
    <script src="<?php echo $url; ?>views/assets/js/scripts/usuarios.js?v='<?php echo $v; ?>'"></script>
</body>

</html>