<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateUserFormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function login()
    {
        return view('users.login');
    } 

   

    public function create()
    {
       return view('users.register');
    }

    public function list()
    {   
        $user = new User;
        $users = $user->get_users();
        return view('users.list', compact('users'));
    }

    public function edit($uuid)
    {   
        
        if (!$user = User::firstWhere('uuid', $uuid)) {
            dd($user);
        };
        

        return view('users.edit', compact('user'));
    }

    public function index()
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = User::firstWhere('id', '=', Session::get('loginId'));
        }
        
        return view('users.index', compact('data'));
    }

    public function auth(Request $request) 
    {
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->put('loginId', $request->user()->id);
           return redirect('user');
        } else {
            dd('nao logou');
        }
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        return redirect('/');
    }
}
