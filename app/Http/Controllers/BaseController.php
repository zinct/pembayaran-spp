<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    // protected $startDate;
    // protected $endDate;
    // protected $identitas;

    public function __construct()
    {   
        // if(!request()->has('startDate') || !request()->has('endDate')) :
        //     $this->startDate = date('Y-m-d', strtotime('first day of january this year'));            
        //     $this->endDate = date('Y-m-d', strtotime('first day of january + 1 year')); 
        //     $periode = \Carbon\Carbon::parse($this->startDate)->translatedFormat('d F Y') . ' - ' . \Carbon\Carbon::parse($this->endDate)->translatedFormat('d F Y');            
        // else :
        //     $this->startDate = request()->get('startDate');
        //     $this->endDate = request()->get('endDate');
        //     $periode = \Carbon\Carbon::parse(request()->get('startDate'))->translatedFormat('d F Y') . ' - ' . \Carbon\Carbon::parse(request()->get('endDate'))->translatedFormat('d F Y');           
        // endif;

        // $this->identitas = \App\Identitas::get();
        // view()->share(['periode' => $periode, 'startDate' => $this->startDate, 'endDate' => $this->endDate, 'identitas' => $this->identitas]);
    }
}
