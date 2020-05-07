<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    // belongsTo == clé étrangère
    public function book()
    {

        return $this->belongsTo(Book::class);
    }
}
