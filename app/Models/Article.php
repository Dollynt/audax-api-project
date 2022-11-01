<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;


class Article extends Model
{
    use HasFactory;
    use Sluggable;

    protected static function booted()
    {
        static::creating(fn(Article $article) => $article->uuid = (string) Uuid::uuid4());
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    
    protected $fillable = [
        'title',
        'resume',
        'text',
    ];
    
   
    const CREATED_AT = 'registeredAt';
    public $timestamps = ["registeredAt"]; 
    const UPDATED_AT = null;

    public function get_id($uuid)
    {
        $users = DB::table('users')
        ->select('users.id as id')->where('uuid', $uuid)
        ->get();

        return $users;
    }

    public function get_articles()
    {
        $articles = DB::table('articles')
        ->select('user_id', 'uuid', 'title', 'resume', 'text', 'slug', 'registeredAt')
        ->get();

        return $articles;
    }
    public function get_uuid($id)
    {
        $articles = DB::table('users')
        ->select('uuid')
        ->where('id', $id)->get();

        return $articles;
    }
    public function get_username($id)
    {
        $articles = DB::table('users')
        ->select('username')
        ->where('id', $id)->get();

        return $articles;
    }
    public function getArticle($uuid)
    { 
        $articles = DB::table('articles')
        ->select('user_id', 'uuid', 'title', 'resume', 'text', 'slug', 'registeredAt')
        ->where('uuid', $uuid)->get();
        
       
        return $articles;
    }
}
