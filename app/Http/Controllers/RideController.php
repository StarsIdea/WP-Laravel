<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RideController extends Controller
{

    public function __construct(){
        parent::__construct();
    }
    
    public function recent(){
        $data = DB::table('rides')->orderBy('date','desc')->limit(5)->paginate(5);
        $header_footer = parent::getHeaderFooter();
        $title = 'Recent Events';
        return view('rides', compact('header_footer', 'data', 'title'));
    }
    
    public function riders(){
        $data = DB::table('event_results')
            ->select(
                array(
                    'event_results.id',
                    'event_results.ride_id',
                    'event_results.event_type_id',
                    'event_results.rider_name',
                    'event_results.member_id',
                    'event_results.equine_name',
                    'event_results.equine_id',
                    'event_results.placing',
                    'event_results.time',
                    'event_results.weight',
                    'event_results.miles',
                    'event_results.points',
                    'event_results.vet_score',
                    'event_results.bc',
                    'event_results.bc_points',
                    'event_results.bc_score',
                    'event_results.pull',
                    'event_results.pull_reason',
                    'event_results.comments',
                    'event_results.import_id'
                )
            )
            ->leftJoin('rides', 'rides.id','=','event_results.ride_id')
            ->orderBy('rides.name','DESC')
            ->orderBy('event_type_id','ASC')
            ->orderBy(DB::raw('-placing'),'DESC')
            ->paginate(10);
        $header_footer = parent::getHeaderFooter();
        $title = 'Events';
        return view('riders', compact('header_footer', 'data', 'title'));
    }
    
}
