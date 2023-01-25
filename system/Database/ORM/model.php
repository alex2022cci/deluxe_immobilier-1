<?php 

    namespace System\Database\ORM;

    abstract class model
    {
        use HasCRUD, HasAttributes, HasMethodCaller, HasQueryBuilder, HasRelation;

        protected $table;
        protected $fillable = [];
        protected $hidden = [];
        protected $casts = [];
        protected $primaryKey = 'id';
        protected $createdAt = 'created_at';
        protected $updatedAt = 'updated_at';
        protected $deletedAt = null;
        protected $collection = [];
    }