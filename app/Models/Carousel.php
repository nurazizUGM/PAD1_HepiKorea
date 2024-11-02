<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;
    public static $type = ['image', 'video', 'youtube'];
    protected $fillable = ['title', 'description', 'media', 'media_type'];
}
