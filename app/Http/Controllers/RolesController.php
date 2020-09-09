<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Session;
class RolesController extends Controller
{
    public function IndexRoles()
    {

    	$role = Role::all();
    	return view('',[''=>$role]);
    }
    public function storeRoles(Request $request)
    {
    	$this->validate($request,[
    		'role_name' => 'required'

    	]);

    	Role::create([
    		'role_name' =>$request->role_name

    	]);

    	return redirect('/');
    }

    public function editRoles($id)
    {
    	$role = Role::find($id);
    	return view('',[''=> $role]);
    }

    public function updateRoles($id, Request $request)
    {
    	$this->validate($request,[
    		'role_name'
    	]);

    	$role = Role::find($id);
    	$role->role_name=$request->role_name;
    	$role->save();
    	return redirect('/');
    }

    public function deleteRoles($id)
    {
    	$role = Role::find($id);
    	$role->delete();
    	return redirect('/');
    }



}
