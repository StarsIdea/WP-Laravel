<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MainController extends Controller
{

    public function __construct(){
        parent::__construct();
    }
    
    public function recent(){
        $data = DB::table('rides')->orderBy('date','desc')->limit(5)->paginate(5);
        $header_footer = parent::getHeaderFooter();
        $title = 'Recent Events';
		$page = 0;
		$search_value= '';
        return view('events', compact('header_footer', 'data', 'title', 'page', 'search_value'));
    }
    
    public function riders(){
        $data = DB::table('rides')->orderBy('date','desc')->limit(5)->get();
        $header_footer = parent::getHeaderFooter();
        $title = 'Riders';
        return view('rides', compact('header_footer', 'data', 'title'));
    }
    
    public function horses(){
        
        $select_reclaim_life = DB::table('reclaims')
            ->where('reclaims.equine_id','=','equines.id')
            ->sum('miles_completed');
            
        // Sub-query to sum reclaim miles for current year
        $select_reclaim_ytd = DB::table('reclaims')
            ->where('reclaims.equine_id','=','equines.id')
            // ->where('reclaims.date','>=',mktime(0, 0, 0, 1, 1, date('Y')))
            ->sum('miles_completed');
            
        $mileage_ytd = DB::table('event_results')
            ->leftJoin('rides', 'rides.id','=','event_results.ride_id')
            ->leftJoin('event_types', 'event_types.id','=','event_results.event_type_id')
            ->where(DB::raw('YEAR(rides.date)>='.date('Y')))
            // ->where('equines.id', '=', 'event_results.equine_id')
            ->sum('event_results.miles');
            
        $data = DB::table('equines')
                ->select(
                    DB::raw('equines.id'),
			        DB::raw('equines.name as name'),
			        DB::raw('equines.breed as breed'),
    				DB::raw('equine_sexes.name as sex'),
    				DB::raw('CONCAT(members.last_name, ", ",members.first_name) as owner'),
    				DB::raw('equines.color as color'),
    				DB::raw("SUM(event_results.miles) as lifetime_mileage")
			    )
			->leftJoin('equine_sexes', 'equine_sexes.id','=','equines.equine_sex_id')
			->leftJoin('members', 'members.id','=','equines.member_id')
			->leftJoin('event_results', 'event_results.equine_id','=','equines.id')
			->leftJoin('event_types', 'event_types.id','=', 'event_results.event_type_id')
			->leftJoin('rides', 'event_results.ride_id','=', 'rides.id')
			->groupBy('equines.id')
			->orderBy('name', 'asc')
			->paginate(10);
		
		foreach($data as $object){
		    foreach($object as $item_key => $item_value){
    		    $object->YTD_mileage = $select_reclaim_ytd + $mileage_ytd;
    		    $object->lifetime_mileage = $select_reclaim_life + $object->lifetime_mileage;
		    }
		}
		$page = 0;
		$search_value= '';
        $header_footer = parent::getHeaderFooter();
        $title = 'Horses';
        return view('equines', compact('header_footer', 'data', 'title', 'page', 'search_value'));
    }
    
    public function events(){
        $data = DB::table('rides')->orderBy('date','desc')->limit(5)->get();
        $header_footer = parent::getHeaderFooter();
        $title = 'Events';
        return view('events', compact('header_footer', 'data', 'title'));
    }
}
