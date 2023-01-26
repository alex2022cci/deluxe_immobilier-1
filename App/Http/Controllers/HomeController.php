<?php

namespace App\Http\Controllers;

use App\Slide;

class HomeController
{
    public function index()
    {
        // On va aller chercher les slider dans la base de données
        $slides = Slide::all();

        // On valler faire un retour dans notre vue
        return view('app.index', compact('slides'));
    }
}