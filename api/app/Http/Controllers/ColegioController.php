<?php

namespace App\Http\Controllers;

use App\Models\Colegio;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ColegioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $colegio = Colegio::all();
            return \response()->json(['resp' => true,'colegios' => $colegio],Response::HTTP_OK);
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
            'turno_id' => 'required|numeric|min:1|exists:turnos,id',
            'categoria_id' => 'required|numeric|min:1|exists:categorias,id',
        ]);
        try{
            $colegio = new Colegio();
            $colegio->name=$request->name;
            $colegio->turno_id=$request->turno_id;
            $colegio->categoria_id=$request->categoria_id;
            if ($colegio->save()){
                return response(['resp' => true,'message' => 'colegio creado correctamente','colegio_id'=>$colegio->id],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'error al registrar el colegio'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
            $colegio=Colegio::find($id);
            if ($colegio!=null){
                return response(['resp' => true,'colegio' => $colegio],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'colegio no encontrado'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
        $colegio= Colegio::find($id);
        $request->validate([
            'name' => 'required',
            'turno_id' => 'required|numeric|min:1|exists:turnos,id',
            'categoria_id' => 'required|numeric|min:1|exists:categorias,id',
        ]);
        if($colegio){
            $colegio->update($input);
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
            if (Colegio::find($id)!=null){
                Colegio::destroy($id);
                return \response()->json(['res' => true, 'message' => 'eliminado correctamente'],Response::HTTP_OK);
            }else{
                return \response()->json(['res' => true, 'message' => 'el colegio elegido ya fue eliminado'],Response::HTTP_BAD_REQUEST);
            }
            }catch(\Exception $e){
                return \response()->json(['res' => false, 'message' => $e->getMessage()],200);
            }
    }
}
