<?php

namespace App\Http\Controllers;

class SeriesController 
{
    public function listarSeries()
    {
        $series = [
            'Punisher',
            'Lost',
            'Grey\'s Anatomy'
        ];

        $html = '<ul>';

        foreach ($series as $series) {
            $html .= "<li>$series</li>";
        }

        $html .= '</ul>';

        echo $html;
    }
}