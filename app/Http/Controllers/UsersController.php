<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    public function index(){
		$users=User::paginate(5);
		return view('admin.users.users', ['users'=>$users]);
	}
	
	public function create() {
		return view('admin.users.create');
	}
	
		/**
	 * 
	 * store new user
	 * 
	 */
	public function store(Request $request){
		$this->validate($request, [
			'username' => '|required|unique:users|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required',
		]);
		$user_data=array();
		$user_data['name']=!empty($request->input('name')) ? $request->input('name') : $request->input('username');
		$user_data['lastname']=$request->input('lastname');
		$user_data['username']=$request->input('username');
		$user_data['email']=  $request->input('email');
		$user_data['role']=$request->input('role');
		$user_data['password']=  bcrypt($request->input('password'));
		$out=User::create($user_data);
		if(!$out){
			return redirect()->route('usercreate')->withErrors('message', 'Faild to create user. try again please!');
		}else{
			return redirect()->route('allusers')->with('message', 'User '.$user_data['name'].' susccessfully added');
		}
	}
	
	/**
	 * 
	 * edit user
	 * 
	 */
	
	public function edit($user_id){
		$user=User::findorFail($user_id);
		return view('admin.users.edit', ['user'=>$user]);
	}
	
	/**
	 * 
	 * edit post
	 * 
	 */
	
	public function update(Request $request, $user_id){
		$user=User::findorFail($user_id);
		$user->name=!empty($request->input('name')) ? $request->input('name') : $request->input('username');
		$user->lastname=$request->input('lastname');
		$user->role=$request->input('role');
		if(!empty($request->input('password'))){
			$user->password=bcrypt($request->input('password'));
		}
		$user->update();
		return redirect()->route('allusers')->with('message', 'User '.$user->name.' susccessfully updated');
		
		
	}
	
	/**
	 * 
	 * user delete
	 * 
	 */
	public function delete($user_id){
		$user=User::findorFail($user_id);
		$user->delete();
		return redirect()->route('allusers')->with('message', 'User '.$user->name.' susccessfully deleted');
		
	}
}
