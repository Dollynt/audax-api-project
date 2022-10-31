<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected static function booted()
    {
        static::creating(fn(User $user) => $user->uuid = (string) Uuid::uuid4());
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
    ];
    
    const CREATED_AT = 'registeredAt';
    public $timestamps = ["registeredAt"]; 
    const UPDATED_AT = null;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function get_users()
    {
        $users = DB::table('users')
        ->select('users.id as id', 'users.username as username',  'users.uuid as uuid', 'users.registeredAt as registeredAt')
        ->get();

        return $users;
    }

    
    
}
