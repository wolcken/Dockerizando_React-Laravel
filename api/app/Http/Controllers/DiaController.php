<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Dia;

class DiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $dia = Dia::all();
            return \response()->json(['resp' => true,'dias' => $dia],Response::HTTP_OK);
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
            'name' => 'required|unique:dias',
        ]);
        try{
            $dia=new Dia();
            $dia->name=$request->name;
            if ($dia->save()){
                return response(['resp' => true,'message' => 'dia creado correctamente','dia_id'=>$dia->id],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'error al registrar el dia'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
            $dia=Dia::find($id);
            if ($dia!=null){
                return response(['resp' => true,'dia' => $dia],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'dia no encontrado'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
        $dia= Dia::find($id);
        $request->validate([
            'name' => 'required|unique:dias',
        ]);
        if($dia){
            $dia->update($input);
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
            if (Dia::find($id)!=null){
                Dia::destroy($id);
                return \response()->json(['res' => true, 'message' => 'eliminado correctamente'],Response::HTTP_OK);
            }else{
                return \response()->json(['res' => true, 'message' => 'el dia elegido ya fue eliminado'],Response::HTTP_BAD_REQUEST);
            }
            }catch(\Exception $e){
                return \response()->json(['res' => false, 'message' => $e->getMessage()],200);
            }
    }
}
