<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

    class Ads extends Model
    {
        // On va importer toute nos requetes SQL
        use HasSoftDelete;

        // On va avoir besoin du protected de Ads
        protected $table = 'ads';

        //Ensemble des champs de notre table
        protected $fillable = ['title', 'description', 'address', 'amount',
                                'image', 'floor', 'year', 'storeroom', 'balcony',
                                'area', 'room', 'toilet', 'parking', 'tag', 'status',
                                'user_id', 'cat_id', 'sell_status', 'type', 'view'];
        
         // On va dans notre champ ORDERBY
         protected $deletedAt = 'deleted_at';

         



    }