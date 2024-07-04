<?php
session_start();
require_once 'conexion.php';


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Samsung</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
              html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            display: flex;
            background-color: #f4f6f9;
        }
        #sidebar {
    width: 250px;
    background-color: #031634;
    color: white;
    padding: 20px;
    transition: width 0.3s;
    overflow: auto; /* O utiliza overflow-y: auto; para solo desplazamiento vertical */
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    z-index: 1000; /* Ajusta según sea necesario */
}


        #sidebar.collapsed {
            width: 60px;
        }

        #main-content {
            flex-grow: 1;
            padding: 20px;
            transition: all 0.3s;
            margin-left: 250px; /* Mueve el contenido principal a la derecha */
        }

        #sidebar.collapsed + #main-content {
            margin-left: 60px; /* Ajusta el contenido cuando el sidebar está colapsado */
        }
        #sidebar {
    z-index: 1000; /* Ajusta el z-index según sea necesario */
}


        .menu-item {
            padding: 10px;
            cursor: pointer;
            color: #c2c7d0;
            display: flex;
            align-items: center;
        }

        .menu-item:hover {
            background-color: #494e53;
        }

        .menu-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .menu-item span {
            white-space: nowrap;
        }

        .active {
            background-color: #031634;
        }

        #top-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .button {
            padding: 10px;
            background-color: #031634;
            color: white;
            border: none;
            cursor: pointer;
            margin-right: 10px;
        }

        .dashboard-section {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
            padding: 20px;
            margin-bottom: 20px;
        }

        .user-panel {
            border-bottom: 1px solid #4f5962;
            margin-bottom: 20px;
            padding-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .user-panel img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        #toggle-sidebar {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        #top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            border-radius: 0%;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
        }

        .top-bar-right {
            flex-grow: 1;
        }

        .button {
            padding: 10px 20px;
            background-color: #031634;
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
            margin-left: 10px;
        }

        .button:hover {
            background-color: #005f6b;
        }

        .buscar {
            display: flex;
            justify-content: center;
            margin-bottom: 2px;
        }

        #busqueda {
            width: 300px;
            padding: 10px;
            border: 2px solid #ced4da;
            border-radius: 2px 0 0 2px;
            outline: none;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        #busqueda:focus {
            border-color: #104389;
        }

        .dashboard-section {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
            padding: 20px;
            margin-bottom: 20px;
            align-items: center;
        }

        .report-content {
            display: flex;
            align-items: center;
        }

        .report-button {
            flex: 1;
            text-align: left;
        }

        .report-image {
            margin-left: auto;
        }

        h3 {
            font-size: 20px;
        }

        .menu-item a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>
    <div id="sidebar">
        <button class="menu-item active" id="toggle-sidebar"><i class="fas fa-bars"></i></button>
        <div class="user-panel">

            <div class="menu-item"> <i class="fas fa-user"></i><span></span></div>

            <span class="user-name"></span>
        </div>
        <div class="menu-item active"><a href="inicio.php"><i class="fas fa-home"></i><span>Inicio</span></a></div>
    <div class="menu-item"><a href="modelo.php"><i class="fas fa-chart-bar"></i><span>Model X</span></a></div>
    <div class="menu-item"><a href="reportes.php"><i class="fas fa-chart-pie"></i><span>Reporte</span></a></div>
    <div class="menu-item">
    <a href="cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i><span>Cerrar Sesión</span></a>
</div>
    </div>
    <div id="main-content">
        <div id="top-bar">
            <div class="top-bar-right" style="margin-left: 4%;">
                <h1 id="search-bar">Reporte General</h1>

            </div>
            <div class="top-bar-left">
                <div class="buscar">
                    <input id="busqueda" type="text" placeholder="Buscar" required>
                    <button id="buscar" class="button"><i class="fa fa-search"></i></button>


                </div>
                <!-- <button class="button" onclick="subirCSV()"><i class="fas fa-upload"></i> Subir CSV</button> -->
            </div>
        </div>
      
        

            <div class="dashboard-section" style="margin-left: 4%;">
                <h3>Reporte General</h3>
            </div>
 

           



        <!-- Bootstrap core JavaScript -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="js/jquery.nice-select.min.js"></script>
        <script src="js/jquery.counterup.min.js"></script>
        <script src="js/jquery.meanmenu.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/tilt.jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/waypoints.js"></script>
        <script src="js/inview.min.js"></script>
        <script src="js/wow.js"></script>
        <script src="js/custom.js"></script>
        <!-- Menu Toggle Script -->
        <script>
            function subirCSV() {
                alert('Función para subir CSV');
                // Aquí iría la lógica para subir el archivo CSV
            }

            document.getElementById('search-bar').addEventListener('input', function (e) {
                console.log('Buscando: ' + e.target.value);
                // Aquí iría la lógica de búsqueda
            });

            document.getElementById('toggle-sidebar').addEventListener('click', function () {
                document.getElementById('sidebar').classList.toggle('collapsed');
                document.querySelectorAll('.menu-item span').forEach(function (el) {
                    el.style.display = el.style.display === 'none' ? '' : 'none';
                });
                document.querySelector('.user-name').style.display =
                    document.querySelector('.user-name').style.display === 'none' ? '' : 'none';
            });
        </script>
        <script>
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
</body>

</html>