<?php

namespace App\Http\Controllers;

use App\Models\Nivele;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NiveleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $nivel = Nivele::all();
            return \response()->json(['resp' => true,'niveles' => $nivel],Response::HTTP_OK);
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
            'name' => 'required|unique:niveles',
        ]);
        try{
            $nivel=new Nivele();
            $nivel->name=$request->name;
            if ($nivel->save()){
                return response(['resp' => true,'message' => 'nivel creado correctamente','nivele_id'=>$nivel->id],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'error al registrar el nivel'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
            $nivel=Nivele::find($id);
            if ($nivel!=null){
                return response(['resp' => true,'nivel' => $nivel],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'nivel no encontrado'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
        $nivel= Nivele::find($id);
        $request->validate([
            'name' => 'required|unique:niveles',
        ]);
        if($nivel){
            $nivel->update($input);
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
            if (Nivele::find($id)!=null){
                Nivele::destroy($id);
                return \response()->json(['res' => true, 'message' => 'eliminado correctamente'],Response::HTTP_OK);
            }else{
                return \response()->json(['res' => true, 'message' => 'el nivel elegido ya fue eliminado'],Response::HTTP_BAD_REQUEST);
            }
            }catch(\Exception $e){
                return \response()->json(['res' => false, 'message' => $e->getMessage()],200);
            }
    }
}
