<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateArticleFormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class ArticleController extends Controller
{
    public function teste()
    {
        return ['status' => 'ok'];
    }

    public function store(StoreUpdateArticleFormRequest $request)
    {        
        $user = new User;
        $article = new Article;
        
        $user->uuid = $request->input('User')['uuid'];
        $user->id = $article->get_id($user->uuid)[0]->id;
        $user->username = $request->input('User')['username'];
        
        
        $article->user_id = $user->id;
        $article->uuid = Str::uuid();
        $article->title = $request->title;
        $article->resume = $request->resume;
        $article->text = $request->text;
        $article->slug = Str::of($request->title)->slug('-');
        $article->registeredAt = now();
        $article->save(); 
        
        return response()->json([ 
            'uuid'         => $article->uuid,
            'title'        => $article->title,
            'resume'       => $article->resume,
            'text'         => $article->text,
            'slug'         => $article->slug,
            'registeredAt' => $article->registeredAt,
            'User' => [
                'uuid' => $user->uuid,
                'username' => $user->username
            ]
        ], 201);
        
    }

    public function list()
    {
        $user = new User;
        $article = new Article;
        $articles = $article->get_articles();
        
        $stack = [];
        foreach ($articles as $artigo){
            $user->uuid = $article->get_uuid($artigo->user_id)[0]->uuid;
            $user->username = $article->get_username($artigo->user_id)[0]->username;
            array_push($stack, [
                'uuid'         => $artigo->uuid,
                'title'        => $artigo->title,
                'resume'       => $artigo->resume,
                'text'         => $artigo->text,
                'slug'         => $artigo->slug,
                'registeredAt' => $artigo->registeredAt,
                'User' => [
                    'uuid' => $user->uuid,
                    'username' => $user->username 
                ]]);
               
        };
        return response()->json($stack, 200);
    }

    public function get_article($uuid)
    {   
        $article_check = Article::firstWhere('uuid', $uuid);
        
        if(is_null($article_check)){
            return response()->json([
                'error' => [
                    'message' => 'Article not found'
                ]
            ], 404);
        }

        $user = new User;
        $articles = new Article;
        $article = $articles->getArticle($uuid)[0];
        
        $user->uuid = $articles->get_uuid($article->user_id)[0]->uuid;
        $user->username = $articles->get_username($article->user_id)[0]->username;
        
        return response()->json([ 
        'uuid'         => $article->uuid,
        'title'        => $article->title,
        'resume'       => $article->resume,
        'text'         => $article->text,
        'slug'         => $article->slug,
        'registeredAt' => $article->registeredAt,
        'User' => [
            'uuid' => $user->uuid,
            'username' => $user->username
        ]
    ], 200);

        
    }

    public function update(StoreUpdateArticleFormRequest $request, $uuid)
    {
        $article = Article::firstWhere('uuid', $uuid);
        
        if(is_null($article)){
            return response()->json([
                'error' => [
                    'message' => 'Article not found'
                ]
            ], 404);
        }

        $user = new User;

        $user->uuid = $article->get_uuid($article->user_id)[0]->uuid;
        $user->username = $article->get_username($article->user_id)[0]->username;

        $article->title = $request->title;
        $article->resume = $request->resume;
        $article->text = $request->text;
        $article->save(); 

        
        
        return response()->json([ 
            'uuid'         => $article->uuid,
            'title'        => $article->title,
            'resume'       => $article->resume,
            'text'         => $article->text,
            'slug'         => $article->slug,
            'registeredAt' => $article->registeredAt,
            'User' => [
                'uuid' => $user->uuid,
                'username' => $user->username
            ]
        ], 200);

    }

    public function delete($uuid)
    {
        $article = Article::firstWhere('uuid', $uuid);
        
        if(is_null($article)){
            return response()->json([
                'error' => [
                    'message' => 'Article not found'
                ]
            ], 404);
        }

        $article->delete();

        return response()->json('Article deleted with success', 204);
    }
}
