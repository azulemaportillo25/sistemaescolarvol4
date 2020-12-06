<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as DB;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/database.php';//llama a la base de datos

// Instantiate app
$app = AppFactory::create();
$app->setBasePath("/sistema_ecolar_v4/api/index.php");//colocar el nombre de mi carpeta

// Add Error Handling Middleware
$app->addErrorMiddleware(true, false, false);

// Add route callbacks (es un ejemplo para ver si funciona el Hello World)
$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write('Hello World');
    return $response;
});
//para los usuarios
$app->post('/login/{usuario}', function (Request $request, Response $response, array $args) {

    $data = json_decode($request->getBody()->getContents(), false);

    //uso del laravel y Slim
    $user = DB::table('usuarios')
    ->leftJoin('perfiles', 'usuarios.idperfil', '=', 'perfiles.idperfil')
    ->where('usuarios.nombreusuario', $args['usuario'])
    ->first();
    //para crear un objeto
    $mens = new stdClass();
    //hace una comparacion con lo que se escribio en el formulario(index.html) y entre la base de datos
    if ($user->password == $data->password){
        $mens->aceptar = true;
        $mens->nombreperfil = $user->nombreperfil;
        $mens->idusuario = $user->idusuarios;
    }
    else{
        $mens->aceptar = false;
    }
    
    $response->getBody()->write(json_encode($mens));
    return $response;
});

//para los datos de los alumnos
$app->post('/insertarinfo', function (Request $request, Response $response, array $args) {

    $data = json_decode($request->getBody()->getContents(), false);

    //uso del laravel y Slim
    $id = DB::table('alumnos')->insertGetId([
        'nombre_completo' => $data->nombre_completo,
        'correo' => $data->correo,
    ]);
    $mensaje = 'Se han ingresado con exito';
    
    $response->getBody()->write(json_encode($mensaje));
    return $response;
});
//para las materias
$app->post('/materias', function (Request $request, Response $response, array $args) {

    $data = json_decode($request->getBody()->getContents(), false);

    //uso del laravel y Slim
    $id = DB::table('materias')->insertGetId([
        'nombre_materia' => $data->nombre_materia,
    ]);
    $mensj = 'Se han ingresado con exito';

    $response->getBody()->write(json_encode($mensj));
    return $response;
});
//para las calificaciones
$app->post('/cali', function (Request $request, Response $response, array $args) {

    $data = json_decode($request->getBody()->getContents(), false);

    //uso del laravel y Slim
    $id = DB::table('subir_cali')->insertGetId([
        'calificacion' => $data->calificacion,
        'idalumno' => $data->idalumno,
        'idmaterias' => $data->idmaterias,
        'nombre_alumno' => $data->nombre_alumno,
    ]);
    $msge = new stdClass();
    $msge->aceptarr = !empty($id);
    $response->getBody()->write(json_encode($msge));
    return $response;
});

//para eliminar las calificaciones
$app->post('/delete/{id_subir_cali}', function (Request $request, Response $response, array $args) {

    $data = json_decode($request->getBody()->getContents(), false);
    //uso del laravel y Slim
    DB::table('subir_cali')->where('idsubir_cali', $args['id_subir_cali'])->delete();
    $msg = 'Se elimino exitosamente';

    $response->getBody()->write(json_encode($msg));
    return $response;
});

//para actualizar las calificaciones
$app->post('/update/{id_subir_cali}', function (Request $request, Response $response, array $args) {

    $data = json_decode($request->getBody()->getContents(), false);
    //uso del laravel y Slim
    $id = DB::table('subir_cali')
    ->where('idsubir_cali', $args['id_subir_cali'])
    ->update([
        'calificacion' => $data->calificacion,
    ]);
    
    $msg = 'Se actualizo exitosamente';

    $response->getBody()->write(json_encode($msg));
    return $response;
});
// Run application
$app->run();