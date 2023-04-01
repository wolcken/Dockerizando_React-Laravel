<?php

namespace App\Http\Controllers;

use App\Models\Cursoparalelo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CursoparaleloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $curso = Cursoparalelo::all();
            return \response()->json(['resp' => true,'curso' => $curso],Response::HTTP_OK);
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
            'curso_id' => 'required|numeric|min:1|exists:cursos,id',
            'paralelo_id' => 'required|numeric|min:1|exists:paralelos,id',
            'nivele_id' => 'required|numeric|min:1|exists:niveles,id',
            'colegio_id' => 'required|numeric|min:1|exists:colegios,id',
        ]);
        try{
            $curso=new Cursoparalelo();
            $curso->name=$request->name;
            if ($curso->save()){
                return response(['resp' => true,'message' => 'curso creado correctamente','cursoparalelo_id'=>$curso->id],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'error al registrar el curso'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
            $curso=Cursoparalelo::find($id);
            if ($curso!=null){
                return response(['resp' => true,'curso' => $curso],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'curso no encontrado'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
        $input=$request->all();
        $curso= Cursoparalelo::find($id);
        $request->validate([
            'curso_id' => 'required|numeric|min:1|exists:cursos,id',
            'paralelo_id' => 'required|numeric|min:1|exists:paralelos,id',
            'nivele_id' => 'required|numeric|min:1|exists:niveles,id',
            'colegio_id' => 'required|numeric|min:1|exists:colegios,id',
        ]);
        if($curso){
            $curso->update($input);
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
            if (Cursoparalelo::find($id)!=null){
                Cursoparalelo::destroy($id);
                return \response()->json(['res' => true, 'message' => 'eliminado correctamente'],Response::HTTP_OK);
            }else{
                return \response()->json(['res' => true, 'message' => 'el curso elegido ya fue eliminado'],Response::HTTP_BAD_REQUEST);
            }
            }catch(\Exception $e){
                return \response()->json(['res' => false, 'message' => $e->getMessage()],200);
            }
    }
}
