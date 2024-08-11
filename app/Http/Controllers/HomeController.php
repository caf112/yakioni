<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Company;

class HomeController extends Controller
{
    public function index()
    {
        $articles = \Auth::user()->articles()->orderBy('created_at', 'desc')->get();
        $companies = \Auth::user()->companies()->orderBy('created_at', 'desc')->get();
        $data = [
            'articles' => $articles,
            'companies' => $companies,
        ];
        return view('home', $data);
    }
}
