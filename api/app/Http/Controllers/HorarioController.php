<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Colegio;
use App\Models\MateriaUser;
use App\Http\Controllers\PivotController;
use App\Models\Cursoparalelo;
use App\Models\User;
use Illuminate\Support\Arr;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //busca todos los horarios para un colegio
    public function index()
    {
        $usuario= auth()->user();
        $id=$usuario->colegio_id;
        //$id=2;
        try{
            // $horario = Horario::with('dia','nivele','curso','paralelo','materia','periodo')
            //     ->whereHas('user',function($q) use ($id){
            //     $q->where('colegio_id','=', $id);
            // })->get();
            $horario = Horario::join('dias','dias.id','=','horarios.dia_id')
                                ->join('niveles','niveles.id','=','horarios.nivele_id')
                                ->join('cursoparalelos','cursoparalelos.id','=','horarios.cursoparalelo_id')
                                ->join('cursos','cursoparalelos.curso_id','=','cursos.id')
                                ->join('paralelos','cursoparalelos.paralelo_id','=','paralelos.id')
                                ->join('colegios','cursoparalelos.colegio_id','=','colegios.id')
                                ->join('materiausers','materiausers.id','=','horarios.materiauser_id')
                                ->join('materias','materiausers.materia_id','=','materias.id')
                                ->join('periodos','periodos.id','=','horarios.periodo_id')
                                ->select('horarios.id as id','dias.name as dia','niveles.name as nivel',
                                'cursos.name as curso','paralelos.name as paralelo',
                                'materias.name as materia','periodos.name as periodo')
                                ->where('colegio_id','=', $id)
                                ->orderBy('horarios.nivele_id')
                                ->orderBy('horarios.dia_id' )
                                ->orderBy('horarios.periodo_id')
                                ->orderBy('cursoparalelo_id')
                                ->get();
            $colegio = Colegio::join('turnos','turnos.id','=','colegios.turno_id')
                                ->join('categorias','categorias.id','=','colegios.categoria_id')
                                ->select('colegios.id as id','colegios.name as nombre','turnos.name as turno','categorias.name as categoria')
                                ->where('colegios.id','=',$id)->get();
            return \response()->json(['resp' => true,'Horarios ' => $horario,'Colegio ' => $colegio],Response::HTTP_OK);
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
    //guarda horarios
    public function store(Request $request)
    {
        $request->validate([
            'dia_id' => 'numeric|min:1|exists:dias,id',
            'nivele_id' => 'numeric|min:1|exists:niveles,id',
            'cursoparalelo_id' => 'numeric|min:1|exists:cursoparalelos,id',
            'materiauser_id' => 'numeric|min:1|exists:materiausers,id',
            'periodo_id' => 'numeric|min:1|exists:periodos,id',
        ]);
        try{
            $horario = new Horario();
            $horario->dia_id = $request->dia_id;
            $horario->nivele_id = $request->nivele_id;
            $horario->cursoparalelo_id = $request->cursoparalelo_id;
            $horario->materiauser_id = $request->materiauser_id;
            $horario->periodo_id = $request->periodo_id;
            if ($horario->save()) {
                return response(['resp' => true,'message' => 'horario creado correctamente','horario_id' => $horario->id], Response::HTTP_OK);
            }else{
               return response(['resp' => false,'message' => 'error al registrar horario'],Response::HTTP_UNPROCESSABLE_ENTITY);
               }
            }catch( \Exception $e){
                return response(['resp' => false,'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //muestra horario solo para 1 curso
    public function show($i,$j,$k)
    {
        $nivel=$i;
        $curso=$j;
        $paralelo=$k;
        $usuario= auth()->user();
        $id=$usuario->colegio_id;
        //$id=2;
        try{
            $horario = Horario::join('dias','dias.id','=','horarios.dia_id')
                                ->join('niveles','niveles.id','=','horarios.nivele_id')
                                ->join('cursoparalelos','cursoparalelos.id','=','horarios.cursoparalelo_id')
                                ->join('cursos','cursoparalelos.curso_id','=','cursos.id')
                                ->join('paralelos','cursoparalelos.paralelo_id','=','paralelos.id')
                                ->join('colegios','cursoparalelos.colegio_id','=','colegios.id')
                                ->join('materiausers','materiausers.id','=','horarios.materiauser_id')
                                ->join('materias','materiausers.materia_id','=','materias.id')
                                ->join('periodos','periodos.id','=','horarios.periodo_id')
                                ->select('horarios.id as id','dias.name as dia',
                                'cursos.name as curso','paralelos.name as paralelo',
                                'materias.name as materia','periodos.name as periodo')
                                ->where('curso_id','=',$curso)
                                ->where('paralelo_id','=',$paralelo)
                                ->where('horarios.nivele_id','=',$nivel)
                                ->where('colegio_id','=', $id)->orderBy('dia_id' )
                                ->orderBy('periodo_id')
                                ->get();
            if($horario->count()!=0){
                return \response()->json(['resp' => true,'Horarios encontrados' => $horario->count(),'Horarios' => $horario],Response::HTTP_OK);
            }else{
                return \response()->json(['resp' => true,'message' => 'curso y paralalelo no registrados en la BBDD'],Response::HTTP_OK);
            }
        }catch(\Exception $e){
            return \response()->json(['resp' => false,'message' => $e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
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
        $input=$request->all();
        $horario= Horario::find($id);
        $request->validate([
            'dia_id' => 'numeric|min:1|exists:dias,id',
            'nivele_id' => 'numeric|min:1|exists:niveles,id',
            'cursoparalelo_id' => 'numeric|min:1|exists:cursoparalelos,id',
            'materiauser_id' => 'numeric|min:1|exists:materiausers,id',
            'periodo_id' => 'numeric|min:1|exists:periodos,id',
        ]);
        if($horario){
            $horario->update($input);
            return \response(['resp' => true,'message' => 'modificado correctamente','horario_id' => $horario->id],Response::HTTP_OK);
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
            $usuario= auth()->user();
            $ib=$usuario->colegio_id;
            //$ib=2;
            $horario = Horario::join('cursoparalelos','cursoparalelos.id','=','horarios.cursoparalelo_id')
                                ->join('colegios','cursoparalelos.colegio_id','=','colegios.id')
                                ->where('colegio_id','=', $ib)
                                ->find($id);
            if ($horario!=null){
                Horario::destroy($id);
                return \response()->json(['res' => true, 'message' => 'eliminado correctamente'],Response::HTTP_OK);
            }else{
                return \response()->json(['res' => true, 'message' => 'el horario elegido ya fue eliminado'],Response::HTTP_BAD_REQUEST);
            }
            }catch(\Exception $e){
                return \response()->json(['res' => false, 'message' => $e->getMessage()],200);
            }
    }
    //eliminar horarios por cursos
    public function eliminarHorario($curso, $paralelo, $nivel){
        try{
            $usuario= auth()->user();
            $id=$usuario->colegio_id;
            //$ib=2;
            $buscado = Cursoparalelo::where('curso_id','=',$curso)
                                ->where('paralelo_id','=',$paralelo)
                                ->where('nivele_id','=',$nivel)
                                ->where('colegio_id','=', $id)
                                ->get();
            if ($buscado->count()!=0 && $buscado!=null){
                $horario=Horario::where('cursoparalelo_id','=',$buscado[0]->id)->get();
                if ($horario->count()!=0 && $horario!=null){
                    foreach($horario as $hora){
                        Horario::destroy($hora->id);
                    }
                    return \response()->json(['res' => true, 'message' => 'se ha eliminado con exito todos los horarios de ese curso'],Response::HTTP_OK);
                }else{
                    return \response()->json(['res' => false, 'message' => 'no existen horarios para ese curso'],Response::HTTP_BAD_REQUEST);
                }
            }else{
                return \response()->json(['res' => false, 'message' => 'no existe el curso buscado'],Response::HTTP_BAD_REQUEST);
            }
            }catch(\Exception $e){
                return \response()->json(['res' => false, 'message' => $e->getMessage()],200);
            }
    }
    //funcion para comprobar que curso, materias estan disponibles para crear horario
    public function ComprobarCurso(Request $request){
        $usuario= auth()->user();
        $id=$usuario->colegio_id;
        //$id=3;
        $request->validate([
            'dia_id' => 'required|numeric|min:1|exists:dias,id',
            'nivele_id' => 'required|numeric|min:1|exists:niveles,id',
            'periodo_id' => 'required|numeric|min:1|exists:periodos,id',
        ]);
        $dia=$request->dia_id;
        $nivel=$request->nivele_id;
        $periodo=$request->periodo_id;
        try{
            //encontramos todos los horarios registrados en el dia, nivel y periodo buscados
            $horario = Horario::join('dias','dias.id','=','horarios.dia_id')
                            ->join('niveles','niveles.id','=','horarios.nivele_id')
                            ->join('cursoparalelos','cursoparalelos.id','=','horarios.cursoparalelo_id')
                            ->join('cursos','cursoparalelos.curso_id','=','cursos.id')
                            ->join('paralelos','cursoparalelos.paralelo_id','=','paralelos.id')
                            ->join('colegios','cursoparalelos.colegio_id','=','colegios.id')
                            ->join('materiausers','materiausers.id','=','horarios.materiauser_id')
                            ->join('periodos','periodos.id','=','horarios.periodo_id')
                            ->select('horarios.id as id','horarios.dia_id as dia','horarios.nivele_id as nivel',
                            'horarios.cursoparalelo_id as curso','horarios.materiauser_id as materia','horarios.periodo_id as periodo')
                            ->where('horarios.dia_id','=',$dia)
                            ->where('horarios.nivele_id','=',$nivel)
                            ->where('horarios.periodo_id','=',$periodo)
                            ->where('colegio_id','=', $id)->orderBy('cursoparalelo_id')->get();
            //todos los cursos
            $cursostot=Cursoparalelo::join('cursos','cursos.id','=','cursoparalelos.curso_id')
                            ->join('paralelos','paralelos.id','=','cursoparalelos.paralelo_id')
                            ->where('colegio_id','=',$id)
                            ->where('nivele_id','=',$nivel)
                            ->select('cursoparalelos.id as id','cursos.name as curso','paralelos.name as paralelo')->get();
            //todas las materias
            $materias1=Materiauser::join('users','users.id','=','materiausers.user_id')
                            ->join('materias','materias.id','=','materiausers.materia_id')
                            ->where('users.actividad','=',true)
                            ->where('users.colegio_id','=', $id)
                            ->where('nivele_id','=',$nivel)
                            ->select('materiausers.id as id','materias.name as materia')
                            ->orderBy('materiausers.id')->get();
            if($horario->count()!=0 && $horario!=null){
                //separando cursos de materias en 2 vectores
                for($i=0;$i<$horario->count();$i++){
                    //cursos ya registrados
                    $curso1 [$i]=$horario[$i]->curso;
                    //materias ya tomadas
                    $mat1 [$i] = $horario[$i]->materia;
                }
                //encontramos todos los cursos registrados para ese nivel en el colegio
                $cursos=Cursoparalelo::where('colegio_id','=',$id)
                            ->where('nivele_id',"=",$nivel)->get()
                            ->makeHidden(['curso_id','paralelo_id','nivele_id','colegio_id']);
                //guardar los cursos disponibles del colegio
                if (count($curso1)<$cursos->count()){
                    for($i=0;$i<$cursos->count();$i++){
                        $curso2 [$i]=$cursos[$i]->id;
                    }
                    //comparar cursos registrados con cursos totales y eliminar los que ya fueron tomados
                    for($i=0;$i<$horario->count();$i++){
                        $curso2 = HorarioController::remover($curso1[$i],$curso2);
                    }
                    $disponible = [];
                    foreach ($curso2 as $valor){
                        //buscar las id de los cursos que no son tomados
                        $buscado=Cursoparalelo::join('cursos','cursos.id','=','cursoparalelos.curso_id')
                                ->join('paralelos','paralelos.id','=','cursoparalelos.paralelo_id')
                                ->select('cursoparalelos.id as id','cursos.name as curso','paralelos.name as paralelo')
                                ->where('cursoparalelos.id','=',$valor)->get()
                                ->makeHidden(['nivele_id','colegio_id']);
                        if($buscado->count()!=0){
                            $disponible=Arr::add($disponible,$valor,$buscado);
                        }
                    }
                    //todas las materias dadas por los docentes del colegio
                    $materias=Materiauser::join('users','users.id','=','materiausers.user_id')
                                ->where('users.actividad','=',true)
                                ->where('users.colegio_id','=', $id)
                                ->select('materiausers.id as id','materiausers.user_id as user','materiausers.materia_id as materia'
                                ,'materiausers.nivele_id as nivel')->orderBy('users.id')->get();
                    //sacamos los usuarios de todas las materias disponibles
                    for($i=0;$i<$materias->count();$i++){
                        $user1 [$i]=$materias[$i]->user;
                    }
                    $user2=array_unique($user1);
                    $mat2=[];
                    //encontramos los usuarios de las materias registradas en los horarios
                    foreach($mat1 as $mat){
                        $mat2=Arr::add($mat2,$mat,Materiauser::find($mat));
                    }
                    $user3=[];
                    $i=0;
                    foreach($mat2 as $us){
                        $user3=Arr::add($user3,$i,$us->user_id);
                    $i=$i+1;
                    }
                    $user4=array_unique($user3);
                    //eliminamos todos los usuarios de los horarios en las materias disponibles
                    for($i=0;$i<count($user4);$i++){
                        $user2 = HorarioController::remover($user4[$i],$user2);
                    }
                    $disponible2 = [];
                    foreach ($user2 as $val){
                        //buscar las materias disponibles
                        $buscar=Materiauser::join('users','users.id','=','materiausers.user_id')
                                ->join('materias','materias.id','=','materiausers.materia_id')
                                ->where('materiausers.nivele_id','=',$nivel)
                                ->where('materiausers.user_id','=',$val)
                                ->select('materiausers.id as id','materias.name as materia')->get();
                        if($buscar->count()!=0){
                            $disponible2=Arr::add($disponible2,$val,$buscar);
                        }
                    }
                    return \response()->json(['res' => true,'cursos disponibles'=>$disponible,'materias disponibles' =>$disponible2],Response::HTTP_OK);
                }else{
                    return \response()->json(['resp' => false,'message'=>'no existen cursos disponibles'],Response::HTTP_OK);
                }

            }else{
                return \response()->json(['res' => false, 'message' => 'no existen horarios registrados',
                        'cursos disponibles' =>$cursostot,'materias disponibles'=>$materias1],Response::HTTP_BAD_REQUEST);
            }
        }catch(\Exception $e){
            return \response()->json(['res' => false, 'message' => $e->getMessage()],200);
        }

    }
    function remover ($valor,$arr)
    {
        foreach (array_keys($arr, $valor) as $key)
        {
            unset($arr[$key]);
        }
        return $arr;
    }
}
