<?php
use Illuminate\Database\Capsule\Manager as DB;

require 'vendor/autoload.php';
require 'config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Subir Calificación</title>
        <link rel="stylesheet" href="node_modules/bulma/css/bulma.min.css">
        <link rel="stylesheet" href="colors.css">
        <script src="node_modules/axios/dist/axios.min.js"></script><!--link de axios-->
    </head>
    <body class='colorpagina'>
        <div data-role='header' id="encabezado">
            <div class="columns">
                <div class="column">
                    <div class="columns is-mobile">
                        <div class="column is-11 is-offset-6">
                            <figure class="image is-128x128"><img src="imagenes/flor-de-alcatraz-1.jpg" class="imagen"></figure>
                        </div>
                    </div>
                </div>
                <div class="column letra">
                    <p class="has-background-danger-dark title is-1 has-text-link is-italic has-text-centered">Bienvenido a la escuela "Alcatraz"</p>
                </div>
                <div class="column">
                    <div class="columns is-mobile">
                        <div class="column is-4 is-offset-1">
                            <figure class="image is-128x128">
                                <img src="imagenes/morados.jpg" class="imagen">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <br>
        <!--menu-->
        <div class="notification is-danger">
            <nav class="breadcrumb is-medium is-centered" aria-label="breadcrumbs">
                <ul>
                    <li><a class="has-text-success" ondblclick="salida()">Página Principal</a></li>
                    <li><a class="has-text-dark" href="ver_cali.php">Consultar Calificaciones</a></li>
                </ul>
            </nav>
        </div>
        <br>
<?php
//Se obtienen los datos de las tablas
$alumno = DB::table('alumnos')->get();
$materia = DB::table('materias')->get();
?>
        <!--formulario para las materias-->
        <div class="tile is-ancestor">
            <div class="tile is-vertical is-8 centrarform">
                <div class="tile">
                    <div class="tile is-parent is-vertical">
                        <article class="tile is-child notification has-background-info-dark centrado">
                            <h3 class="title is-3 has-background-warning-dark has-text-white is-italic">Ingresar Materias:</h3>
                            <br>
                            <div class="has-background-link-dark">
                                <form action="insertarcali.php" method="post">
                                    <label class="has-text-black" for="nombre_materia">Ingrese nombre de la Materia:</label>
                                    <input class="input is-rounded is-danger" type="text" id="nombre_materia" name="nombre_materia">
                                    <br>
                                    <br>
                                    <div class="centrado">
                                        <button  type="button" class="button has-background-warning-dark is-outlined" onclick="materias()">Guardar datos</button>
                                        <button  type="button" class="button has-background-warning-dark is-outlined"><a href="subircali.php">Recargar formulario</a></button>
                                    </div>
                                </form>
                                <br>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div> 

        <!--formulario para las calificaciones-->
        <div class="tile is-ancestor">
            <div class="tile is-vertical is-8 centrarform">
                <div class="tile">
                    <div class="tile is-parent is-vertical">
                        <article class="tile is-child notification has-background-success centrado">
                            <h3 class="title is-3 has-background-warning-dark has-text-white is-italic">Ingresar Calificación:</h3>
                            <br>
                                <div class="has-background-primary">
                                    <form action="insertarcali.php" method="post">
                                        <label class="has-text-black" for="idalumno">Num. lista del alumno:</label>
                                        <div class="control">
                                            <div class="select is-danger">
                                                <select id="idalumno" name="idalumno">
                                                    <?php
                                                    //datos de la tabla de alumnos
                                                    foreach ($alumno as $fila){
                                                        echo "<option value='$fila->idalumno'>{$fila->idalumno}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <label class="has-text-black" for="nombre_alumno">Nombre del alumno:</label>
                                        <input class="input is-rounded is-danger" type="text" id="nombre_alumno" name="nombre_alumno">
                                        <br>
                                        <br>
                                        <label class="has-text-black" for="idmaterias">Nombre de la materia:</label>
                                        <div class="control">
                                            <div class="select is-danger">
                                                <select id="idmaterias" name="idmaterias">
                                                    <?php
                                                    //datos de la tabla de materias
                                                    foreach ($materia as $fila){
                                                        echo "<option value='$fila->idmaterias'>{$fila->nombre_materia}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <label class="has-text-black" for="calificacion">Calificación de la Materia:</label>
                                        <input class="input is-rounded is-danger" type="text" id="calificacion" name="calificacion">
                                        <br>
                                        <br>
                                        <div class="centrado">
                                            <button  type="button" class="button is-link is-outlined" onclick="subircalificacion()">Guardar datos</button>
                                        </div>
                                    </form>
                                    <br>
                                </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>

         <!--Pie de pagina-->
         <footer class="footer" id="piepag">
            <div class="content has-text-centered">
                <div class="columns is-gapless is-multiline is-mobile has-text-black">
                    <div class="column">Se brinda información de:</div>
                </div>
                <div class="columns is-mobile">
                    <div class="column is-1 is-offset-3 has-text-black">
                        <img src="imagenes/contacto.png" class="icon">
                        <p>Contacto:</p>
                    </div>
                    <div class="column is-4 is-offset-3 has-text-black">
                        <p>Azulema Portillo Laparra</p>
                    </div>
                </div>
                <div class="columns is-mobile">
                    <div class="column is-1 is-offset-3 has-text-black">
                        <img src="imagenes/telefono.jpg" class="icon">
                        <p>Telefono:</p>
                    </div>
                    <div class="column is-4 is-offset-3 has-text-black">
                        <p>983-211-1951</p>
                    </div>
                </div>
                <div class="columns is-mobile">
                    <div class="column is-1 is-offset-3 has-text-black">
                        <img src="imagenes/Gmail_icon-icons.com_75706.png" class="icon img-fluid" alt="Responsive image">
                        <p>Correo:</p>
                    </div>
                    <div class="column is-4 is-offset-3 has-text-black">
                        <p>portilloazulema@gmail.com</p>
                    </div>
                </div>
                <div class="columns is-gapless is-multiline is-mobile">
                    <div class="column has-text-black">Hecho en México.</div>
                </div>
                <div class="columns is-gapless is-multiline is-mobile">
                    <div class="column has-text-black">Carrera de Programación en la Preparatoria Centro de Bachillerato Tecnológico Industrial y de Servicios no.253 "Miguel Hidalgo y Costilla".</div>
                </div>
            </div>
        </footer>

        <!--Pie de pagina 2-->
        <footer class="footer" id="piepag2">
            <div class="columns is-gapless is-multiline is-mobile">
                <div class="column has-text-black">
                    <!--link de facebook-->
                    <a href="https://m.facebook.com/"><img src="imagenes/facebook.png" class="icon2"></a>
                </div>
                <div class="column has-text-black">
                    <!--link de Gmail-->
                    <a href="https://www.google.com/intl/es/gmail/about/"><img src="imagenes/Gmail_icon-icons.com_75706.png" class="icon2"></a>
                </div>
                <div class="column has-text-black">
                    <!--link de Instagram-->
                    <a href="https://www.instagram.com/"><img src="imagenes/logotipo-instagram_1045-436.jpg" class="icon2"></a>    
                </div>
                <div class="column has-text-black">
                    <!--link de Twitter-->
                    <a href="https://twitter.com/login?lang=es"><img src="imagenes/twitter.png" class="icon2"></a>
                </div>
                <div class="column has-text-black">
                    <!--link de spotify-->
                    <a href="https://www.spotify.com/pe/"><img src="imagenes/spot.png" class="icon2"></a>
                </div>
                <div class="column has-text-black">
                    <!--link de youtube-->
                    <a href="https://www.youtube.com/"><img src="imagenes/youtube.png" class="icon2"></a>
                </div>
            </div>
        </footer>

        <script>
            function materias(){
                axios.post(`api/index.php/materias`, {
                    nombre_materia: document.forms[0].nombre_materia.value,
                }).then(resp => {
                    alert(`Se han ingresado sus materias`)
                    console.log(resp);
                }).catch(error => {
                    alert('NO SE INSERTARON\n INTENTE DE NUEVO')
                });
            }

            function subircalificacion(){
                //variable que obtiene el id
                var alumnoSelect = document.getElementById("idalumno")
                //variable que obtiene los elementos seleccionados
                var selectalumnos = alumnoSelect.options[alumnoSelect.selectedIndex].value
                //variable que obtiene el id
                var materiaSelect = document.getElementById("idmaterias")
                //variable que obtiene los elementos seleccionados
                var selectmaterias = materiaSelect.options[materiaSelect.selectedIndex].value
                axios.post(`api/index.php/cali`, {
                    calificacion: document.forms[1].calificacion.value,
                    nombre_alumno: document.forms[1].nombre_alumno.value,
                    //variable de alumnos
                    idalumno: selectalumnos,
                    //variable de materias
                    idmaterias: selectmaterias
                }).then(resp => {
                    alert(`Se han ingresado sus calificaciones`)
                    console.log(resp);
                }).catch(error => {
                    alert('NO SE INSERTARON\n INTENTE DE NUEVO')
                });
            }

            function salida(){
                alert(`Gracias por entrar al sistema escolar`)
                setTimeout(`location. href='index.html'`, 500)//cambiar de pagina y 500 es lo que tarda en cambiar
            }
        </script>

    </body>
</html>