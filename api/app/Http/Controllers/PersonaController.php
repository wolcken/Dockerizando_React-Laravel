<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\EstudianteTutore;
use App\Models\Persona;
use App\Models\User;
use App\Models\Tutore;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Arr;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $usuario= auth()->user();
            $id=$usuario->colegio_id;
            $estudiantes = Estudiante::join('personas','personas.id','=','estudiantes.persona_id')
                                ->join('cursoparalelos','cursoparalelos.id','=','estudiantes.cursoparalelo_id')
                                ->join('colegios','colegios.id','=','cursoparalelos.colegio_id')
                                ->where('cursoparalelos.colegio_id','=',$id)
                                ->where('estudiantes.inscripcion','=',true)
                                ->select('estudiantes.id as estudiante_id','personas.name as nombre','personas.carnet as carnet',
                                'personas.nacimiento as nacimiento')->orderBy('personas.name')->get();
            $trabajadores = User::join('personas','personas.id','=','users.persona_id')
                                ->where('role_id','<>',1)
                                ->where('colegio_id','=',$id)
                                ->where('actividad','=',true)
                                ->select('personas.id as id','personas.name as nombre','personas.carnet as carnet',
                                'personas.nacimiento as nacimiento')->orderBy('personas.name')->get();
            $tutor=[];
            //encontramos los usuarios de las materias registradas en los horarios
            foreach($estudiantes as $estu){
                $tutor=Arr::add($tutor,$estu->estudiante_id,EstudianteTutore::where('estudiante_id','=',$estu->estudiante_id)->get());
            }
            $padre=[];
            foreach ($tutor as $busc) {
                foreach ($busc as $buscado) {
                    $padre=Arr::add($padre, $buscado->tutore_id, Tutore::join('personas', 'personas.id', '=', 'tutores.persona_id')
                                ->select('personas.id as id','personas.name as nombre','personas.carnet as carnet',
                                'personas.nacimiento as nacimiento')->find($buscado->tutore_id));
                }
            }
            return \response()->json(['resp' => true,'estudiantes'=>$estudiantes,'tutores' => $padre,'trabajadores'=>$trabajadores],Response::HTTP_OK);
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
            'name' => 'required',
            'carnet' => 'unique:personas',
            'nacimiento' => 'required|date',
        ]);
        try{
            $persona = new Persona();
            $persona->name=$request->name;
            $persona->carnet=$request->carnet;
            $persona->nacimiento=$request->nacimiento;
            if ($persona->save()){
                return response(['resp' => true,'message' => 'persona registrada correctamente','persona_id' => $persona->id],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'error al registrar la persona'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
            $persona = Persona::find($id);
            if ($persona!=null){
                return response(['resp' => true,'persona' => $persona],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'persona no encontrado'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
        $persona = Persona::find($id);
        $request->validate([
            'name' => 'required',
            'carnet' => 'unique:personas',
            'nacimiento' => 'required|date',
        ]);
        if($persona){
            $persona->update($input);
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
            if (Persona::find($id)!=null){
                Persona::destroy($id);
                return \response()->json(['res' => true, 'message' => 'eliminado correctamente'],Response::HTTP_OK);
            }else{
                return \response()->json(['res' => true, 'message' => 'la persona elegida ya fue eliminada'],Response::HTTP_BAD_REQUEST);
            }
            }catch(\Exception $e){
                return \response()->json(['res' => false, 'message' => $e->getMessage()],200);
            }
    }
}
