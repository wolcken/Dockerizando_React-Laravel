<?php

namespace App\Http\Controllers;

use App\Models\Validacione;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $validacion = Validacione::all();
            return \response()->json(['resp' => true,'validaciones' => $validacion],Response::HTTP_OK);
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
            'name' => 'required|unique:validaciones',
        ]);
        try{
            $validacion = new Validacione();
            $validacion->name=$request->name;
            if ($validacion->save()){
                return response(['resp' => true,'message' => 'validacion creada correctamente','validacione_id'=>$validacion->id],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'error al registrar la validacion'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
            $validacion = Validacione::find($id);
            if ($validacion!=null){
                return response(['resp' => true,'validacion' => $validacion],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'validacion no encontrado'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
        $validacion = Validacione::find($id);
        $request->validate([
            'name' => 'required|unique:validaciones',
        ]);
        if($validacion){
            $validacion->update($input);
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
            if (Validacione::find($id)!=null){
                Validacione::destroy($id);
                return \response()->json(['res' => true, 'message' => 'eliminado correctamente'],Response::HTTP_OK);
            }else{
                return \response()->json(['res' => true, 'message' => 'la validacion elegida ya fue eliminado'],Response::HTTP_BAD_REQUEST);
            }
            }catch(\Exception $e){
                return \response()->json(['res' => false, 'message' => $e->getMessage()],200);
            }
    }
}
