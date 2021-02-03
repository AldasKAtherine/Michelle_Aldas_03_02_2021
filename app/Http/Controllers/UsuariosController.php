<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsuariosController extends Controller
{
   
    public function index()
    {
        
        $users = User::all();
        return view('usuarios.index',['users'=>$users]);
    }

 
    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create',['roles'=>$roles]);
    }
    public function store(UserFormRequest $request)
    {
        try{
            $usuario = new User();
            $usuario->name=request('name');
            $usuario->email=request('email');
            $usuario->password=Hash::make(request('password'));
            
            $usuario->save();

            $usuario->asignarRol($request->get('rol'));
            return redirect('/usuarios');
    
        }catch(\Exception $e){
            return back()->with('mensajeKMAM', "El correo utilizado se encuentra en uso!!");
        }
        
    }
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        return view('usuarios.edit',['user'=>User::findOrFail($id),'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->name=$request->get('name');
        //ya no se envia a actualizar el correro
        if(request('estado')=='on'){
            $usuario->baneado='0';
        }
        else{
            $usuario->baneado='1';
        }
        $role =$usuario->roles;
        if (count($role)>0) {
            $role_id=$role[0]->id;
        }
        User::find($id)->roles()->updateExistingPivot($role_id,['role_id'=>$request->get('rol')]);

       $usuario->update();
        return redirect('usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->baneado='1';
        $usuario->update();
        return redirect('usuarios');

    }
    public function autenticarAbogado(Request $request, $correo,$contrasena){
        $usuario1 = User::where('email', $correo)->firstOrFail();
        $usuario = User::where('email', $correo)->firstOrFail();
        if($usuario->tieneRol('ABOGADO') ){
            if(Hash::check($contrasena,$usuario->password)){
                return json_encode($usuario1);
            }
        }
        return json_encode (json_decode ("{}"));
    }
}
