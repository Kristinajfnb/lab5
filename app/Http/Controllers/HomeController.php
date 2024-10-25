<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home'); // Главная страница
    }

    public function about()
    {
        return view('about'); // Страница "О нас"
    }
}