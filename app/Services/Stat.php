<?php

namespace App\Services;

use App\Statistic;

class Stat
{

    private $precision;

    public function __construct(int $precision)
    {

        $this->precision = $precision;
    }

    // todo cette méthode doit retourner la moyenne des notes d'un livre
    public function avg(int $bookId): float
    {

        $notes = Statistic::where('book_id', $bookId)->pluck('note'); // Collection Laravel

        if ($notes)
            return round($notes->sum() / $notes->count(), $this->precision);
    }

    // méthode permettant de calculer la moyenne générale des notes de tous les livres
    public function avgGeneral(): float
    {
        $notes = Statistic::pluck('note');

        if ($notes)
            return round($notes->sum() / $notes->count(), $this->precision);
    }

    function std(): float
    {
        // nombre de notes par livre
        $notes = Statistic::pluck('note');
        $nb = $notes->count();

        // dans une application on gère les cas qui posent problèmes avec des exceptions
        if ($nb === 0) throw new \Exception("No note");

        // la moyenne générale
        $mean = $this->avgGeneral();

        // somme des carrés des écarts 
        // le use permet d'importer dans le scope de la fonction anonyme la moyenne $neam
        // le use regarde dans le contexte de la fonction si $neam est définie
        $sum = $notes->sum(function ($note) use($mean) {

            return ($note - $mean) ** 2;
        });

        // l'écart type mesure la valeur moyenne des écarts à la moyenne générale
        return round( sqrt( $sum / $nb ), $this->precision );
    }

    // todo max et min des notes de tous les livres
    public function maxGen(){
        $notes = Statistic::pluck('note');

        if ($notes)
            return $notes->max();
    }

    public function minGen(){
        $notes = Statistic::pluck('note');

        if ($notes)
            return $notes->min();
    }

    public function maxNoteBook(int $bookId){
        $notes = Statistic::where('book_id', $bookId)->pluck('note'); // Collection Laravel

        if ($notes)
            return $notes->max();
    }

    public function minNoteBook(int $bookId){
        $notes = Statistic::where('book_id', $bookId)->pluck('note'); // Collection Laravel

        if ($notes)
            return $notes->min();
    }

}
