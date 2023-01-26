<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

    class Post extends Model
    {
        use HasSoftDelete;

        protected $table = 'posts';


        protected $fillable = [ 'title', 'body',
                                'image', 'user_id', 'cat_id',
                                'published_at', 'status', 'created_at',
                                 'updated_at', 'deleted_at'
                                ];

        protected $deletedAt = 'deleted_at';                        
    }