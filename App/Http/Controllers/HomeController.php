<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Post;
use App\Slide;

class HomeController
{
    public function index()
    {
        // On va aller chercher les slider dans la base de données
        $slides = Slide::all();
        $newestAds = Ads::orderBy('created_at', 'desc')->limit(0, 6)->get();

        // Pour les avoirs les meilleurs bien immobilier
        $bestAds = Ads::orderBy('view', 'desc')->orderBy('created_at', 'desc')->limit(0, 4)->get();

        // Pour afficher le blog dans la db
        $posts = Post::where('published_at', '<=', date('Y-m-d H:i:s'))->orderBy('created_at', 'desc')->limit(0, 4)->get();
        
        // Envoyer à la vue l'ensemble des données que j'ai dans ma variable $bestAds


        
        
        // On valler faire un retour dans notre vue
        return view('app.index', compact('slides','posts','bestAds', 'newestAds'));
    }
    
    
}