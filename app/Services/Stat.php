<?php

namespace App\Services;

use App\Statistic;

class Stat
{

    private $precision;

    public function __construct(int $precision)
    {

        $this->precision = $precision;

        dump("hello service stat");
    }

    public function avg($bookId){

        $avg = Statistic::where('book_id', $bookId)->pluck('avg', 'book_id');

        return $avg;
    }
}
