<?php

namespace App\Http\Controllers;

use App\Models\Direccione;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DireccioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $direccion = Direccione::all();
            return \response()->json(['resp' => true,'direcciones' => $direccion],Response::HTTP_OK);
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
            'cuidad' => 'required',
            'zona' => 'required',
            'calle' => 'required',
        ]);
        try{
            $direccion = new Direccione();
            $direccion->cuidad=$request->cuidad;
            $direccion->zona=$request->zona;
            $direccion->calle=$request->calle;
            $direccion->nro=$request->nro;
            if ($direccion->save()){
                return response(['resp' => true,'message' => 'direccion creada correctamente','direccione_id'=>$direccion->id],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'error al registrar la direccion'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
            $direccion = Direccione::find($id);
            if ($direccion!=null){
                return response(['resp' => true,'direccion' => $direccion],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'direccion no encontrada'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
        $direccion = Direccione::find($id);
        $request->validate([
            'cuidad' => 'required',
            'zona' => 'required',
            'calle' => 'required',
        ]);
        if($direccion){
            $direccion->update($input);
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
            if (Direccione::find($id)!=null){
                Direccione::destroy($id);
                return \response()->json(['res' => true, 'message' => 'eliminado correctamente'],Response::HTTP_OK);
            }else{
                return \response()->json(['res' => true, 'message' => 'la direccion elegida ya fue eliminada'],Response::HTTP_BAD_REQUEST);
            }
            }catch(\Exception $e){
                return \response()->json(['res' => false, 'message' => $e->getMessage()],200);
            }
    }
}
