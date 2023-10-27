<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testing extends Model
{
    use HasFactory;

    public function getDataCollection(){
        return collect([1,2,3,4,5,6,7,8,9,10]);
    }
}
