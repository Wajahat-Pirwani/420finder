<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrainPost extends Model
{
    use HasFactory;

    public function strains() {

        return $this->belongsTo('App\Models\Strain');

    }

    public function genetics() {

        return $this->belongsTo('App\Models\Genetic');

    }

}
