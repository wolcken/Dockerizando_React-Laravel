<?php

namespace App\Http\Controllers;

use App\Models\Colegio;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario= auth()->user();
        $id=$usuario->colegio_id;
        try{
            $estudiante = Estudiante::where('colegios.id','=',$id)->get();

            $colegio = Colegio::join('turnos','turnos.id','=','colegios.turno_id')
                                ->join('categorias','categorias.id','=','colegios.categoria_id')
                                ->select('colegios.id as id','colegios.name as nombre','turnos.name as turno','categorias.name as categoria')
                                ->where('colegios.id','=',$id)->get();
            return \response()->json(['resp' => true,'estudiantes' => $estudiante,'Colegio' => $colegio],Response::HTTP_OK);
        }catch(\Exception $e){
            return \response()->json(['resp' => false,'message ' => $e -> getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'inscripcion' => 'required|boolean',
            'persona_id' => 'required|unique:estudiantes|numeric|min:1|exists:personas,id',
            'cursoparalelo_id' => 'required|numeric|min:1|exists:cursoparalelos,id',
        ]);
        try{
            $estudiante = new Estudiante();
            $estudiante->inscripcion=$request->inscripcion;
            $estudiante->persona_id=$request->persona_id;
            $estudiante->cursoparalelo_id=$request->cursoparalelo_id;
            if ($estudiante->save()){
                return response(['resp' => true,'message' => 'estudiante registrado correctamente','persona_id' => $estudiante->id],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'error al registrar al estudiante'],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        }catch( \Exception $e){
            return response(['resp' => false,'message' => $e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $estudiante = Estudiante::find($id);
            if ($estudiante!=null){
                return response(['resp' => true,'estudiante' => $estudiante],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'estudiante no encontrado'],Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }catch( \Exception $e){
            return response(['resp' => false,'message' => $e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $estudiante = Estudiante::find($id);
        $request->validate([
            'inscripcion' => 'required|boolean',
            'persona_id' => 'required|unique:estudiantes|numeric|min:1|exists:personas,id',
            'cursoparalelo_id' => 'required|numeric|min:1|exists:cursoparalelos,id',
        ]);
        if($estudiante){
            $estudiante->update($input);
            return \response(['resp' => true,'message' => 'modificado correctamente'],Response::HTTP_OK);
        }else{
            return \response(['resp' => false,'message' => 'no se encontro el registro'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            if (Estudiante::find($id)!=null){
                Estudiante::destroy($id);
                return \response()->json(['res' => true, 'message' => 'eliminado correctamente'],Response::HTTP_OK);
            }else{
                return \response()->json(['res' => true, 'message' => 'el estudiante elegido ya fue eliminado'],Response::HTTP_BAD_REQUEST);
            }
            }catch(\Exception $e){
                return \response()->json(['res' => false, 'message' => $e->getMessage()],200);
            }
    }
    public function estudianteCurso($paralelo,$curso,$nivel){
        try{
            $usuario= auth()->user();
            $id=$usuario->colegio_id;
            //$ib=2;
            $buscado = Estudiante::join('personas','personas.id','=','estudiantes.persona_id')
                                ->join('cursoparalelos','cursoparalelos.id','=','estudiantes.cursoparalelo_id')
                                ->where('estudiantes.inscripcion','=',true)
                                ->where('cursoparalelos.curso_id','=',$curso)
                                ->where('cursoparalelos.paralelo_id','=',$paralelo)
                                ->where('cursoparalelos.nivele_id','=',$nivel)
                                ->where('cursoparalelos.colegio_id','=', $id)
                                ->select('estudiantes.id as estudiante_id','estudiantes.persona_id as persona_id',
                                'personas.name as nombre','personas.carnet as carnet','personas.nacimiento as nacimiento')
                                ->orderBy('personas.name')->get();
            if ($buscado->count()!=0 && $buscado!=null){
                return \response()->json(['res' => true,'estudiantes encontrados'=>$buscado->count(),'estudiantes' => $buscado],Response::HTTP_OK);
            }else{
                return \response()->json(['res' => false, 'message' => 'no existen alumnos en ese curso'],Response::HTTP_BAD_REQUEST);
            }
            }catch(\Exception $e){
                return \response()->json(['res' => false, 'message' => $e->getMessage()],200);
            }
    }
}
