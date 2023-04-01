<?php

namespace App\Http\Controllers;

use App\Models\Paralelo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParaleloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $paralelo = Paralelo::all();
            return \response()->json(['resp' => true,'paralelos' => $paralelo],Response::HTTP_OK);
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
            'name' => 'required|unique:paralelos',
        ]);
        try{
            $paralelo=new Paralelo();
            $paralelo->name=$request->name;
            if ($paralelo->save()){
                return response(['resp' => true,'message' => 'paralelo creado correctamente','paralelo_id'=>$paralelo->id],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'error al registrar el paralelo'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
            $paralelo=Paralelo::find($id);
            if ($paralelo!=null){
                return response(['resp' => true,'paralelo' => $paralelo],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'paralelo no encontrado'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
        $paralelo = Paralelo::find($id);
        $request->validate([
            'name' => 'required|unique:paralelos',
        ]);
        if($paralelo){
            $paralelo->update($input);
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
            if (Paralelo::find($id)!=null){
                Paralelo::destroy($id);
                return \response()->json(['res' => true, 'message' => 'eliminado correctamente'],Response::HTTP_OK);
            }else{
                return \response()->json(['res' => true, 'message' => 'el paralelo elegido ya fue eliminado'],Response::HTTP_BAD_REQUEST);
            }
            }catch(\Exception $e){
                return \response()->json(['res' => false, 'message' => $e->getMessage()],200);
            }
    }
}
