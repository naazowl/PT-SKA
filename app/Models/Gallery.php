<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Gallery extends Model
{
    protected $fillable = ['title','description','image','event_date'];
    protected $casts = ['event_date'=>'date'];
}
