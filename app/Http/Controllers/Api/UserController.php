<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateUserFormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class UserController extends Controller
{

    public function teste()
    {
        return ['status' => 'ok'];
    }

    public function store(StoreUpdateUserFormRequest $request)
    {   
    
        $user = new User;
        $user->username = $request->username;
        $user->uuid = Str::uuid();
        $user->password = Hash::make($request->password);
        $user->registeredAt = now();
        $user->save();

        return response()->json([
            'uuid'         => $user->uuid,
            'username'     => $user->username,
            'registeredAt' => $user->registeredAt
        ], 201);
        
    }

    public function list()
    {
        $user = User::all('uuid', 'username', 'registeredAt');

        return $user;
    }

    public function get_user($uuid)
    {   
    
            $user = User::all('uuid', 'username', 'registeredAt')->firstwhere('uuid',$uuid);
            if(is_null($user)){
                return response()->json([
                    'error' => [
                        'message' => 'User not found'
                    ]
                ], 404);
            }

            return $user;

        
    }

    public function update(StoreUpdateUserFormRequest $request, $uuid)
    {   
        $user = User::firstWhere('uuid', $uuid);
        
        if(is_null($user)){
            return response()->json([
                'error' => [
                    'message' => 'User not found'
                ]
            ], 404);
        }

        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'uuid'         => $user->uuid,
            'username'     => $user->username,
            'registeredAt' => $user->registeredAt
        ], 200);
    }

    public function delete($uuid)
    {
        $user = User::firstWhere('uuid', $uuid);
        
        if(is_null($user)){
            return response()->json([
                'error' => [
                    'message' => 'User not found'
                ]
            ], 404);
        }

        $user->delete();

        return response()->json('User deleted with success', 204);
    }
}
