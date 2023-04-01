<?php

namespace App\Http\Controllers;

use App\Models\CelulareColegio;
use App\Models\CelularePersona;
use App\Models\ColegioDireccione;
use App\Models\DireccionePersona;
use App\Models\EstudianteTutore;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Materiauser;
use App\Models\User;
use Illuminate\Http\Request;

class PivotController extends Controller
{
    //guardar los datos en la tabla pivote que relaciona Direccion con Persona
    public function guardarDireccionPersona($valor1,$valor2)
    {
        try{
            $direccion = new DireccionePersona();
            $direccion->direccione_id = $valor1;
            $direccion->persona_id = $valor2;
            $direccion->save();
            return response(['resp' => true,'message' => 'guardada la direccion de la persona'],Response::HTTP_OK);
        }catch( \Exception $e){
            return response(['resp' => false,'message' => $e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    //guardar en la tabla pivote que relaciona la tabla direccion con colegio
    public function guardarColegioDireccion($valor1,$valor2)
    {
        try{
            $direccion = new ColegioDireccione();
            $direccion->colegio_id = $valor1;
            $direccion->direccione_id = $valor2;
            $direccion->save();
            return response(['resp' => true,'message' => 'guardada la direccion del colegio'],Response::HTTP_OK);
        }catch( \Exception $e){
            return response(['resp' => false,'message' => $e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    //guardar en la tabla pivote que relaciona la tabla celular con persona
    public function guardarCelularPersona($valor1,$valor2)
    {
        try{
            $celular = new CelularePersona();
            $celular->celulare_id = $valor1;
            $celular->persona_id = $valor2;
            $celular->save();
            return response(['resp' => true,'message' => 'guardado el celular de la persona'],Response::HTTP_OK);
        }catch( \Exception $e){
            return response(['resp' => false,'message' => $e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    //guardar en la tabla pivote que relaciona la tabla celular con el colegio
    public function guardarCelularColegio($valor1,$valor2)
    {
        try{
            $celular = new CelulareColegio();
            $celular->celulare_id = $valor1;
            $celular->colegio_id = $valor2;
            $celular->save();
            return response(['resp' => true,'message' => 'guardado el celular del colegio'],Response::HTTP_OK);
        }catch( \Exception $e){
            return response(['resp' => false,'message' => $e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    //guardar en la tabla pivote que relaciona la tabla estudiante con el o los tutores
    public function guardarEstudianteTutore($valor1,$valor2)
    {
        try{
            $tutor = new EstudianteTutore();
            $tutor->tutore_id = $valor1;
            $tutor->estudiante_id = $valor2;
            $tutor->save();
            return response(['resp' => true,'message' => 'guardado el tutor con el estudiante'],Response::HTTP_OK);
        }catch( \Exception $e){
            return response(['resp' => false,'message' => $e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    //guardar en la tabla pivote que relaciona la tabla materia con el usuario
    public function guardarMateriauser($valor1,$valor2,$valor3)
    {
        try{
            $docente=User::where('role_id','=',3)
                        ->where('actividad','=',true)->find($valor1);
            if ($docente!=null){
                $materia = new Materiauser();
                $materia->user_id = $valor1;
                $materia->materia_id = $valor2;
                $materia->nivele_id = $valor3;
                $materia->save();
                return response(['resp' => true,'message' => 'guardado el docente con la materia'],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'solo los docentes pueden ser registrados con materias'],Response::HTTP_UNAUTHORIZED);
            }
        }catch( \Exception $e){
            return response(['resp' => false,'message' => $e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
