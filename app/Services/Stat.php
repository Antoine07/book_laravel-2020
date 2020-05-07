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

    // todo cette méthode doit retourner la moyenne des notes d'un livre
    public function avg(int $bookId){

        $avg = Statistic::where('book_id', $bookId)->pluck('note', 'book_id');

        return $avg;
    }

    // Cette méthode retourne l'écart type des notes d'un livre
    public function std(int $bookId){

    }

    // méthode permettant de calculer la moyenne générale des notes de tous les livres
    public function avgGeneral(){ }
}
