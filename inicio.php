<?php
session_start();
require_once 'conexion.php';
$correo = mysqli_real_escape_string($conn, $_SESSION['correo']);

// Verifica si el correo está presente en la base de datos
$sql = "SELECT usua_nombre FROM usuario WHERE usua_correo='$correo'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $usua_nombre = $row['usua_nombre'];
} else {
    $usua_nombre = "Usuario no encontrado";
}
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
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f4f6f9;
        }

        #sidebar {
            width: 250px;
            background-color: #031634;
            color: white;
            padding: 20px;
            transition: width 0.3s; /* Transición de ancho */
            overflow-x: hidden;
        }


        #sidebar.collapsed {
            width: 60px;
        }

        #main-content {
            flex-grow: 1;
            padding: 20px;
            transition: all 0.3s;
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
            /* Ajusta el padding según sea necesario */
            border-radius: 0%;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
        }

        .top-bar-right {
            flex-grow: 1;
            /* Hace que ocupe todo el espacio disponible */
        }

        .button {
            padding: 10px 20px;
            background-color: #031634;
            /* Azul marino bonito */
            color: white;

            /* Borde del mismo color que el fondo */
            border-radius: 10px;
            /* Borde curvado */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Sombra */
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
            margin-left: 10px;
            /* Espacio entre botones */
        }

        .button:hover {
            background-color: #005f6b;
            /* Cambio de color al pasar el mouse */
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
        h3{
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
            <div class="top-bar-right">
                <h1 id="search-bar">Bienvenido <?php echo $usua_nombre;?></h1>

            </div>
            <div class="top-bar-left">
                <div class="buscar">
                    <input id="busqueda" type="text" placeholder="Buscar" required>
                    <button id="buscar" class="button"><i class="fa fa-search"></i></button>


                </div>
                <!-- <button class="button" onclick="subirCSV()"><i class="fas fa-upload"></i> Subir CSV</button> -->
              </div>
 
        </div>
        <div class="dashboard-grid">
            <div class="dashboard-section">
                <h3>Mira los reportes del último año</h3>
                <div class="report-content">
                    <div class="report-button">
                        <button class="button" style="height: 80px; font-size: 18px;"><i class="fas fa-file"></i>
                            Reportes 2023</button>
                    </div>
                    <div class="report-image">
                        <img src="img/reporte.jpg" alt="Imagen de reporte" width="400">
                    </div>
                </div>
            </div>

            <div class="dashboard-section">
                <h3>Áreas de Mejora</h3>
            </div>

            <div class="dashboard-section">
                <h3>Áreas de Mayor aceptación</h3>
            </div>

            <div class="dashboard-section">
                <h3>Áreas de Menor aceptación</h3>
            </div>
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
            function subirCSV() {
                var form_data = new FormData();
                var file_input = document.getElementById('csv_file').files[0];
                form_data.append('csv_file', file_input);

                $.ajax({
                    url: 'http://localhost:8000/procesar-csv/',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log('Archivo CSV enviado correctamente.');
                        console.log(response); // Aquí puedes manejar la respuesta JSON devuelta por Django
                        alert('Archivo CSV enviado correctamente. Puedes revisar la consola para ver la respuesta.');
                    },
                    error: function (error) {
                        console.error('Error al enviar el archivo CSV.');
                        console.error(error);
                        alert('Error al enviar el archivo CSV. Revisa la consola para más detalles.');
                    }
                });
            }
        </script>
</body>

</html>