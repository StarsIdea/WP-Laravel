<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EventController extends Controller
{
    private $header_footer;

    public function __construct(){
        parent::__construct();
        $this->header_footer = parent::getHeaderFooter();
    }
    
    public function recent(){
        $data = DB::table('rides')->orderBy('date','desc')->limit(5)->paginate(5);
        $header_footer = parent::getHeaderFooter();
        $title = 'Recent Events';
        return view('rides', compact('header_footer', 'data', 'title'));
    }
    
    public function events(Request $request){
        $search_value = ($request->input('search_value') != null)?$request->input('search_value'):'';
        $page = ($request->input('page') != null)?$request->input('page'):1;
        
        $data = DB::table('rides');
        if($search_value != ''){
		    $data = $data->where('rides.name', 'like', DB::raw("'%".$search_value."%'"));
		    $data = $data->orwhere('rides.city', 'like', DB::raw("'%".$search_value."%'"));
		    $data = $data->orwhere('rides.province', 'like', DB::raw("'%".$search_value."%'"));
		    
		}
        $data = $data->orderBy('date','desc')->limit(10)->paginate(10);
        $header_footer = $this->header_footer;
        $title = 'Events';
        return view('events', compact('header_footer', 'data', 'title', 'page', 'search_value'));
    }
    
    public function view($id){
        $ride = DB::table('rides')
            ->select('name', 'date', 'city')
            ->where('id', '=', $id)
            ->get();
        $title = '';
        $date = '';
        $city = '';
        foreach($ride as $object){
            $title = $object->name;
            $date = $object->date;
            $city = $object->city;
        }
        
        $details = array(
            'date' => $date,
            'city' => $city
        );
        
        $event_result = DB::table('event_results')
            ->select(
                DB::raw('event_types.name as event_type'),
                DB::raw('members.id as "member #"'),
                DB::raw('event_results.rider_name as member'),
                DB::raw('equines.id as "equine #"'),
                DB::raw('event_results.equine_name as equine'),
    	        'event_results.placing',
    	        DB::raw("IF(event_results.time IS NOT NULL, event_results.time, '') as time"),
    	        DB::raw("event_results.weight as weight"),
                'event_results.miles',
                'event_results.points',
                'event_results.vet_score',
                DB::raw('IF(event_results.bc, "Yes", NULL) as bc'),
                DB::raw('IF(event_results.bc_score > 0, event_results.bc_score, NULL) as "bc score"'),
                DB::raw('IF(event_results.bc_points > 0, event_results.bc_points, NULL) as "bc points"'),
                DB::raw("IF(event_results.pull, CONCAT('Yes / ', IF(event_results.pull_reason IS NOT NULL, event_results.pull_reason, 'None')), '') as 'pull / reason'"),
                'event_results.comments'
                )
            ->leftJoin('event_types', 'event_types.id','=','event_results.event_type_id')
			->leftJoin('rides', 'rides.id','=','event_results.ride_id')
			->leftJoin('members', 'members.id','=','event_results.member_id')
			->leftJoin('equines', 'equines.id','=','event_results.equine_id')
			->where('event_results.ride_id', '=', $id)
			->orderBy('event_type_id','ASC')
			->orderBy(DB::raw('-placing'), 'DESC')
			->get();
		
		foreach($event_result as $event_object){
		    $event = (array)$event_object;
		    $event_object->member = '<a href="/rides/riders/view/'.$event['member #'].'">'.$event_object->member."</a>";
		    $event_object->equine = '<a href="/rides/horses/view/'.$event['equine #'].'">'.$event_object->equine."</a>";
		}
		
		return view('event_view', [
		    'header_footer' => $this->header_footer,
		    'title' => $title, 
		    'ride' => $details,
		    'results_by_type' => $event_result
		]);
    }
}
