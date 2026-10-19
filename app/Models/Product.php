<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $fillable = ['name','slug','category','short_description','description','image','is_featured','is_published'];
    protected $casts = ['is_featured'=>'boolean','is_published'=>'boolean'];
}
