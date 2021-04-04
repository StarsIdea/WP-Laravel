<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EquineController extends Controller
{

    private $header_footer;
    public function __construct(){
        parent::__construct();
        $this->header_footer = parent::getHeaderFooter();
    }
    
    public function recent(){
        $data = DB::table('rides')->orderBy('date','desc')->limit(5)->paginate(5);
        $header_footer = $this->header_footer;
        $title = 'Recent Events';
        return view('rides', compact('header_footer', 'data', 'title'));
    }
    
    public function horses(Request $request){
        $search_value = ($request->input('search_value') != null)?$request->input('search_value'):'';
        $page = ($request->input('page') != null)?$request->input('page'):1;
        
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
			->leftJoin('rides', 'event_results.ride_id','=', 'rides.id');
		if($search_value != ''){
		    $data = $data->where('equines.name', 'like', DB::raw("'%".$search_value."%'"));
		    $data = $data->orwhere('equines.breed', 'like', DB::raw("'%".$search_value."%'"));
		    $data = $data->orwhere('equine_sexes.name', 'like', DB::raw("'%".$search_value."%'"));
		    $data = $data->orwhere('equines.color', 'like', DB::raw("'%".$search_value."%'"));
		    
		}
		$data = $data
			->groupBy('equines.id')
			->orderBy('name', 'asc')
			->paginate(10);
		
		foreach($data as $object){
		    foreach($object as $item_key => $item_value){
    		    $object->YTD_mileage = $select_reclaim_ytd + $mileage_ytd;
    		    $object->lifetime_mileage = $select_reclaim_life + $object->lifetime_mileage;
		    }
		}
        $header_footer = $this->header_footer;
        $title = 'Horses';
        return view('equines', compact('header_footer', 'data', 'title', 'page', 'search_value'));
    }
    
    public function view($id){
        $equine = DB::table('equines')
            ->where('id', $id)
            ->get()[0];
            
        $ridden_by = DB::table('members')
            ->select(
                'members.id',
				DB::raw("CONCAT(last_name, ', ', first_name) as name")
            )
            ->distinct()
            ->join('event_results', 'event_results.member_id','=','members.id')
			->where('event_results.equine_id','=',$id)
			->get();
		
		foreach($ridden_by as $item){
		    $item->name = '<a href="/rides/riders/view/'.$item->id.'">'.$item->name.'</a>';
		}
		
		////////////////////////////////////////////////////////////////////
		$mileage_ytd = DB::table('event_results')
		    ->select(
		        DB::raw('ifnull(SUM(event_results.miles), 0) as mileage_ytd'))
			->join('rides', 'rides.id','=','event_results.ride_id')
			->where(DB::raw('YEAR(rides.date)'),'>=', date('Y'))
			->where('event_results.equine_id', '=', $id)
			->get()[0];

		$mileage = DB::table('event_results')
		    ->select(DB::raw('ifnull(SUM(event_results.miles), 0) as lifetime_mileage'))
			->from('event_results')
			->join('rides', 'rides.id','=','event_results.ride_id')
			->where('event_results.equine_id', '=', $id)
			->get()[0];

		$details = DB::table('equines')
		    ->select(
				DB::raw("CONCAT(members.last_name,', ',members.first_name) as member_name"),
				'equines.owner_name',
				DB::raw('equine_sexes.name as sex'),
				'equines.foal_date',
				'equines.breed',
				'equines.color'
				// array($mileage_ytd, 'YTD_mileage'),
				// array($mileage, 'lifetime_mileage')
			)
			->leftJoin('equine_sexes', 'equines.equine_sex_id','=','equine_sexes.id')
			->leftJoin('members', 'members.id','=','equines.member_id')
			->where('equines.id','=',$id)
			->get()[0];
		$details->YTD_mileage = $mileage_ytd->mileage_ytd;
		$details->lifetime_mileage = $mileage->lifetime_mileage;
		
		$details->owner = !empty($details->member_name)? $details->member_name: $details->owner_name;
		$rides_by_type = array();
		$rides = DB::table('event_results')
		    ->select(
		        DB::raw('rides.id as "ride id"'),	
    			DB::raw('rides.name as "ride name"'),
    			DB::raw('rides.date as "ride date"'),
    			DB::raw('event_types.name as "event type"'),
    			DB::raw('members.id as "member #"'),
    			DB::raw('event_results.rider_name as member'),
    			'event_results.placing',
				DB::raw("IF(event_results.time IS NOT NULL, event_results.time, '') as time"),
				'event_results.miles',
                'event_results.points',
                DB::raw('event_results.vet_score as "vet score"'),
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
		    ->where('event_results.equine_id','=',$id)
		    ->orderBy('rides.date', 'desc')
			->orderBy('rides.name', 'desc')
		    ->get();
		$prev_year = 0;
		foreach($rides as $ride_object){
		    $item = (array)$ride_object;
		    $year = date('Y', strtotime($item['ride date']));
		    $item['ride name'] = '<a href="/rides/events/view/'.$item['ride id'].'">'.$item['ride name'].'</a>';
		    unset($item['ride id']);
		    $item['member'] = '<a href="/rides/riders/view'.$item['member #'].'">'.'</a>';
		    if($prev_year != $year){
		        $rides_by_type[$year] = array();
		        $prev_year = $year;
		    }
		    array_push($rides_by_type[$year], $item);
		}
        $header_footer = $this->header_footer;
        return view('equine_view', [
		    'header_footer' => $this->header_footer,
		    'equine' => $equine,
			'ridden_by' => $ridden_by,
			'details' => $details,
			'rides_by_type' => $rides_by_type,
		]);
    }
    
}
