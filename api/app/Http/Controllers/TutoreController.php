<?php

namespace App\Http\Controllers;

use App\Models\Tutore;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TutoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $tutor = Tutore::all();
            return \response()->json(['resp' => true,'tutores' => $tutor],Response::HTTP_OK);
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
            'persona_id' => 'required|unique:tutores|numeric|min:1|exists:personas,id',
        ]);
        try{
            $tutor=new Tutore();
            $tutor->name=$request->name;
            if ($tutor->save()){
                return response(['resp' => true,'message' => 'tutor creado correctamente','tutore_id'=>$tutor->id],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'error al registrar el tutor'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
            $tutor=Tutore::find($id);
            if ($tutor!=null){
                return response(['resp' => true,'tutor' => $tutor],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'tutor no encontrado'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
        $tutor= Tutore::find($id);
        $request->validate([
            'persona_id' => 'required|unique:tutores|numeric|min:1|exists:personas,id',
        ]);
        if($tutor){
            $tutor->update($input);
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
            if (Tutore::find($id)!=null){
                Tutore::destroy($id);
                return \response()->json(['res' => true, 'message' => 'eliminado correctamente'],Response::HTTP_OK);
            }else{
                return \response()->json(['res' => true, 'message' => 'el tutor elegido ya fue eliminado'],Response::HTTP_BAD_REQUEST);
            }
            }catch(\Exception $e){
                return \response()->json(['res' => false, 'message' => $e->getMessage()],200);
            }
    }
}
