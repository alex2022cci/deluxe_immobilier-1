<?php 

// Je vais définir mon chemin avec le psr-4 qui est le namespace
namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

// Je créer ma class slide en faisant une extention Model
class Slide extends Model
{
    // J'appelle ma classe HasSoftDelete (qui est en le fichier traits)
    use HasSoftDelete;

    // Je fais une protection de variables de mes données 
    protected $table = 'slides';
    protected $fillable = ['title', 'url', 'address', 'amount', 'body', 'image'];
    protected $deletedAt = 'deleted_at';
}