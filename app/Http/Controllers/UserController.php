<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateUserFormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('/')->with('success');
        } 
    }


    public function login()
    {
        return view('users.login');
    } 

    public function create()
    {
       return view('users.register');
    }

    public function delete($uuid)
    {
        if (!$user = User::firstWhere('uuid', $uuid)) {
            return redirect()->route('user.list');
        };

        if (Session::has('loginId') && Session::get('loginId') == $user->id) {
            $user->delete();
            return redirect()->route('user.logout');
        };
        $user->delete();

        return redirect()->route('user.list');
    }

    public function edit($uuid)
    {   
        
        if (!$user = User::firstWhere('uuid', $uuid)) {
            return redirect()->route('user.list');
        };
        $article = new Article;
        $user_article = $article->user_has_article_check($user->id);
        
        
        return view('users.edit', compact('user', 'user_article'));
    }


    public function update(StoreUpdateUserFormRequest $request, $uuid)
    {   
        
        if (!$user = User::firstWhere('uuid', $uuid)) {
            return redirect()->route('user.list');
        };
        
        $data = $request->only('username');
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        };
        $user->update($data);

        return back()->with('success', 'User updated with success');
    }

    public function list()
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = User::firstWhere('id', '=', Session::get('loginId'));
        }
        $user = new User;
        $users = $user->get_users();
        
        return view('users.list', compact('data', 'users'));
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
            return back()->with('fail', 'Error logging in');
        }
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if($user){
            dd($user);
            return back()->with('success', 'User created with success');
        } else {
            return back()->with('fail', 'Error creating user');
        }
        
    }
}
