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
        'user_id',
    ];
    
   
    const CREATED_AT = 'registeredAt';
    public $timestamps = ["registeredAt"]; 
    const UPDATED_AT = null;

    public function user_has_article_check($id)
    {
        $user_id = DB::table('articles')
        ->select('user_id')->where('user_id', $id)
        ->first();
        if($user_id != null){
            return true;
        }

        return false;
    }
}
