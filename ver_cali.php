<?php
use Illuminate\Database\Capsule\Manager as DB;

require 'vendor/autoload.php';
require 'config/database.php';

    echo <<<_UNO
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="node_modules/bulma/css/bulma.min.css">
                <title>Ver calificacion</title>
                <link rel="stylesheet" href="colors.css">
                <script src="node_modules/axios/dist/axios.min.js"></script><!--link de axios-->
            </head>
            <body class="colorpagina">
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
                                    <figure class="image is-128x128"><img src="imagenes/morados.jpg" class="imagen"></figure>
                                </div>
                           </div>
                        </div>
                    </div>
                </div> 
                <br>
                <br>
                <div class='centrado'>
                    <button  type='button' class='button is-danger is-rounded' ondblclick="salida()">REGRESAR a la página inicial</button>
                    <button type="button" class="button is-link is-inverted is-outlined"><a href="subircali.php">Ingresar Calificación</a></button>
                </div>
                <br>
                <br>
_UNO;
$ver_cali = DB::table('subir_cali')
->leftJoin('alumnos', 'subir_cali.idalumno', '=', 'alumnos.idalumno')
->leftJoin('materias', 'subir_cali.idmaterias', '=', 'materias.idmaterias')
->get();

foreach ($ver_cali as $colum) {
    echo <<<_Consultarcali
    <div class="table-container">
        <table class="table has-background-success tabla3 centrarform">
            <thead class="has-background-info">
                <tr class="tabla4">
                    <th>#num</th>
                    <th>Número de lista</th>
                    <th>Nombre completo del alumno</th>
                    <th>Materia</th>
                    <th>Calificación</th>
                    <th>Eliminar</th>
                    <th>Actualizar</th>
                </tr>
            </thead>
            <tr> 
                <td>$colum->idsubir_cali</td>
                <td>$colum->idalumno</td>
                <td>$colum->nombre_alumno</td>
                <td>$colum->nombre_materia</td>
                <td>$colum->calificacion</td>
                <td><button class='button is-primary' type='button' onclick="deletecali($colum->idsubir_cali)">Eliminar</button><br></td>
                <td>
                <form id='$colum->idsubir_cali' method='POST'>
                    <input id='id_subir_cali' type='text' name='id_subir_cali' value='{$colum->idsubir_cali}' hidden>
                    <label  size="5">Inserta una calificación:</label>
                    <input id="calificacion" type="text" name="calificacion" size="5"><br>
                    <button class='button is-primary' type='button' onclick="actualizar($colum->idsubir_cali)">Actualizar</button><br>
                </form>
                </td>
            </tr>
        </table>
    </div>
_Consultarcali;
}
echo <<<_Uno
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
                function salida(){
                    alert(`Gracias por entrar al sistema escolar`)
                    setTimeout(`location. href='index.html'`, 500)//cambiar de pagina y 500 es lo que tarda en cambiar
                }

                function deletecali(idsubir_cali) {
                    var form = document.getElementById(idsubir_cali)
                    axios.post('api/index.php/delete/'+ idsubir_cali)
                    .then(resp => {
                        alert(`Se elimino la calificacion`)
                        setTimeout(`location. href='ver_cali.php'`, 500)//cambiar de pagina y 500 es lo que tarda en cambiar
                        console.log(resp)
                    }).catch(error => {
                        alert(`Los datos no se han podido eliminar`)
                    });
                }

                function actualizar(idsubir_cali) {
                    var form = document.getElementById(idsubir_cali)
                    axios.post('api/index.php/update/'+ idsubir_cali, {
                        calificacion: form.calificacion.value
                    }).then(resp => {
                        alert(`Se actualizo la calificación`)
                        setTimeout(`location. href='ver_cali.php'`, 500)//cambiar de pagina y 500 es lo que tarda en cambiar
                        console.log(resp)
                    }).catch(error => {
                        alert(`Los datos no se han podido actualizar`)
                    });
                }
            </script>

        </body>
      </html>
_Uno;
?>