<?php

use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PivotController;
use App\Http\Controllers\DiaController;
use App\Http\Controllers\NiveleController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ParaleloController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\ValidacioneController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\CelulareController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ColegioController;
use App\Http\Controllers\DireccioneController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\TutoreController;
use App\Http\Controllers\CursoparaleloController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login',[UserController::class,'login']);
//Route::get('list',[UserController::class,'index']);


Route::group(['middleware' => 'auth:sanctum'],function(){
    //rutas del modelo Usuario
    Route::prefix('usuario')->controller(UserController::class)->group(function (){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{usuario}/datos','show');
        Route::put('/actualizar/{usuario}','update');
        Route::delete('/borrar/{usuario}','destroy');
        Route::get('/perfil','userProfile');
        Route::post('/logout','logout');
    });
    Route::prefix('horarios')->controller(HorarioController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/search/{nivel}/{curso}/{paralelo}','show');
        Route::put('/{horario}/actualizar','update');
        Route::delete('/{horario}/borrar','destroy');
        Route::delete('/{curso}/{paralelo}/{nivel}/borrar','eliminarHorario');
        Route::get('/comprobar/horario','ComprobarCurso');
    });
    Route::prefix('dias')->controller(DiaController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{dia}/mostrar','show');
        Route::put('/{dia}/actualizar','update');
        Route::delete('/{dia}/borrar','destroy');
    });
    Route::prefix('niveles')->controller(NiveleController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{nivel}/mostrar','show');
        Route::put('/{nivel}/actualizar','update');
        Route::delete('/{nivel}/borrar','destroy');
    });
    Route::prefix('cursos')->controller(CursoController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{curso}/mostrar','show');
        Route::put('/{curso}/actualizar','update');
        Route::delete('/{curso}/borrar','destroy');
    });
    Route::prefix('paralelos')->controller(ParaleloController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{paralelo}/mostrar','show');
        Route::put('/{paralelo}/actualizar','update');
        Route::delete('/{paralelo}/borrar','destroy');
    });
    Route::prefix('materias')->controller(MateriaController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{materia}/mostrar','show');
        Route::put('/{materia}/actualizar','update');
        Route::delete('/{materia}/borrar','destroy');
    });
    Route::prefix('periodos')->controller(PeriodoController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{periodo}/mostrar','show');
        Route::put('/{periodo}/actualizar','update');
        Route::delete('/{periodo}/borrar','destroy');
    });
    Route::prefix('validaciones')->controller(ValidacioneController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{validacion}/mostrar','show');
        Route::put('/{validacion}/actualizar','update');
        Route::delete('/{validacion}/borrar','destroy');
    });
    Route::prefix('mensajes')->controller(MensajeController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{mensaje}/mostrar','show');
        Route::put('/{mensaje}/actualizar','update');
        Route::delete('/{mensaje}/borrar','destroy');
    });
    Route::prefix('celulares')->controller(CelulareController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{celular}/mostrar','show');
        Route::put('/{celular}/actualizar','update');
        Route::delete('/{celular}/borrar','destroy');
    });
    Route::prefix('categorias')->controller(CategoriaController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{categoria}/mostrar','show');
        Route::put('/{categoria}/actualizar','update');
        Route::delete('/{categoria}/borrar','destroy');
    });
    Route::prefix('colegios')->controller(ColegioController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{colegio}/mostrar','show');
        Route::put('/{colegio}/actualizar','update');
        Route::delete('/{colegio}/borrar','destroy');
    });
    Route::prefix('direcciones')->controller(DireccioneController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{direccion}/mostrar','show');
        Route::put('/{direccion}/actualizar','update');
        Route::delete('/{direccion}/borrar','destroy');
    });
    Route::prefix('estudiantes')->controller(EstudianteController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{estudiante}/mostrar','show');
        Route::put('/{estudiante}/actualizar','update');
        Route::delete('/{estudiante}/borrar','destroy');
        Route::get('/search/{nivel}/{curso}/{paralelo}','estudianteCurso');
    });
    Route::prefix('roles')->controller(RoleController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{rol}/mostrar','show');
        Route::put('/{rol}/actualizar','update');
        Route::delete('/{rol}/borrar','destroy');
    });
    Route::prefix('turnos')->controller(TurnoController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{turno}/mostrar','show');
        Route::put('/{turno}/actualizar','update');
        Route::delete('/{turno}/borrar','destroy');
    });
    Route::prefix('tutores')->controller(TutoreController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{tutor}/mostrar','show');
        Route::put('/{tutor}/actualizar','update');
        Route::delete('/{tutor}/borrar','destroy');
    });
    Route::prefix('personas')->controller(PersonaController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{persona}/mostrar','show');
        Route::put('/{persona}/actualizar','update');
        Route::delete('/{persona}/borrar','destroy');
    });
    Route::prefix('cursoparalelo')->controller(CursoparaleloController::class)->group(function(){
        Route::get('/list','index');
        Route::post('/guardar','store');
        Route::get('/{curso}/mostrar','show');
        Route::put('/{curso}/actualizar','update');
        Route::delete('/{curso}/borrar','destroy');
    });
    Route::prefix('pivotes')->controller(PivotController::class)->group(function(){
        Route::post('/direccion/persona/{direccion}/{persona}/guardar','guardarDireccionPersona');
        Route::post('/colegio/direccion/{colegio}/{direccion}/guardar','guardarColegioDireccion');
        Route::post('/celular/persona/{celular}/{persona}/guardar','guardarCelularPersona');
        Route::post('/celular/colegio/{celular}/{colegio}/guardar','guardarCelularColegio');
        Route::post('/tutor/estudiante/{tutor}/{estudiante}/guardar','guardarEstudianteTutore');
        Route::post('/materia/docente/{usuario}/{materia}/{nivel}/guardar','guardarMateriauser');
    });
    //Route::get('dias',[DiaController::class,'index']);
});

