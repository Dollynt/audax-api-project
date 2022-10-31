<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateArticleFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    public function create()
    {   
        
        return view('articles.create');
    }

    public function store(StoreUpdateArticleFormRequest $request)
    {
        
        $data = $request->all();
        $data['slug'] = Str::of($request->title)->slug('-');
        $data['user_id'] = Session::get('loginId');
        $article = Article::create($data);
        if($article){
            return back()->with('success', 'Article created with success');
        } else {
            return back()->with('fail', 'Error creating article');
        }
        
    }
}
