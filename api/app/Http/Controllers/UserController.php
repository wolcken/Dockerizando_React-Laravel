<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario= auth()->user();
        //$id=$usuario->colegio_id;
        $id=1;
        $users = User::join('roles','roles.id','=','users.role_id')
                        ->join('personas','personas.id','=','users.persona_id')
                        ->join('colegios','colegios.id','=','users.colegio_id')
                        ->join('turnos', 'colegios.turno_id','=','turnos.id')
                        ->join('categorias', 'colegios.categoria_id','=','categorias.id')
                        ->select('users.id as id','users.email as email','users.actividad as actividad',
                        'personas.name as nombre','personas.carnet as carnet','personas.nacimiento as nacimiento',
                        'roles.role as role','colegios.name as colegio','turnos.name as turno',
                        'categorias.name as categoria')
                        ->where('colegio_id','=', $id)
                        ->get();
        return response()->json($users,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $usuario= auth()->user();
        $id=$usuario->colegio_id;
        $user = new User();
        $user->email = $request->email;
        $user->password=Hash::make($request->password);
        $user->role_id=$request->role_id;
        $user->persona_id=$request->persona_id;
        $user->colegio_id=$id;
        $user->actividad=$request->actividad;
        $user->remember_token = Str::random(10);
        if ($user->save()){
            return \response()->json(['res' => true, 'message' => 'usuario creado correctamente','user_id' => $user->id],Response::HTTP_OK);
        }else{
            return \response()->json(['res' => false, 'message' => 'algo salio mal no se pudo guardar'],Response::HTTP_INTERNAL_SERVER_ERROR);
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
            $user = User::find($id);
            if ($user!=null){
                return response(['resp' => true,'usuario' => $user],Response::HTTP_OK);
            }else{
                return response(['resp' => false,'message' => 'usuario no encontrado'],Response::HTTP_UNPROCESSABLE_ENTITY);
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
    public function update(UpdateUserRequest $request, $id)
    {
        $input=$request->all();
        $usuario= User::find($id);
        if($usuario){
            $usuario->update($input);
            return \response(['resp' => true,'message' => 'modificado correctamente'],Response::HTTP_OK);
        }else{
            return \response(['resp' => false,'message' => 'no se encontró el registro'],Response::HTTP_INTERNAL_SERVER_ERROR);
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
            User::destroy($id);
            return \response()->json(['resp' => true, 'message' => 'eliminado correctamente'],Response::HTTP_OK);
        }catch(\Exception $e){
            return \response()->json(['resp' => false, 'message' => $e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function buscar(Request $request){
        if(auth()->user()){
            try {
                $buscado =Persona::with('nacimiento','user')
                    ->where('name','like',"%{$request->buscado}%")
                    ->orwhere('carnet','like',"%{$request->buscado}%")
                    ->orwhere('nacimiento','like',"%{$request->buscado}%")
                    ->paginate(20);
                return \response()->json(['resp' => true,'Personas encontradas' =>$buscado],Response::HTTP_OK);
            }catch(\Exception $e){
                return \response()->json(['resp' => false, 'message' => $e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }else{
            return response(['resp' => false,'message' => 'no esta logeado'],Response::HTTP_UNAUTHORIZED);
        }

    }
    public function login(Request $request)
    {
        // $credentials = $request ->validate([
        //     'email' => ['required','email'],
        //     'password' => ['required']
        // ]);
        // if (Auth::attempt($credentials)){
        //     $user = Auth::user();
        //     $token = $user -> createToken('token')->plainTextToken;
        //     $cookie = cookie('cookie_token', $token, 60 * 24);
        //     return response(['resp' => true,'token' => $token],Response::HTTP_OK)->withoutCookie($cookie);
        // }else{
        //     return response(['message' => 'email o contraseña incorrectos'],Response::HTTP_UNAUTHORIZED);
        // }

        ///codigo wolcken
        //validar
        $credenciales = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        //verificar
        if(!Auth::attempt($credenciales)){
            return response()->json([
                "message" => "No Autorizado, No se encontro al Usuario"
            ], 401);
        }

        //token
        $user = $request->user();
        $resultadoToken = $user->createToken('Token Acceso');
        $token = $resultadoToken->plainTextToken;

        //responder
        return response()->json([
            "accessToken" => $token,
            "token_type" => "Bearer",
            "usuario" => $user
        ], 201);
    }
    public function logout(){
        // Auth::user()->tokens()->delete();
        // $cookie = Cookie::forget('cookie_token');
        // return response(['resp'=>true,'message'=>'Cierre de sesion'], Response::HTTP_OK)->withoutCookie($cookie);

        Auth::user()->tokens()->delete();
        return response()->json(["message" => "LogOut"], 200);
    }

    public function userProfile(Request $request){
        return response()->json([
            'message' => 'userProfile OK',
            'userData' => auth()->user()
        ],Response::HTTP_OK);
    }
}