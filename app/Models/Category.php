<?php

namespace App\Models;
use App\Models\Books;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories" ;
    protected $fillable = [
        'name_category',
    ];

}
