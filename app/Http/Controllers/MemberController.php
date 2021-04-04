<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MemberController extends Controller
{
    
    private $header_footer;

    public function __construct(){
        parent::__construct();
        $this->header_footer = parent::getHeaderFooter();
    }
    
    public function index(Request $request){
        $search_value = ($request->input('search_value') != null)?$request->input('search_value'):'';
        $page = ($request->input('page') != null)?$request->input('page'):1;
        $year = date('Y');
        $reclaim_ytd = DB::table('reclaims')
            ->select(
                'members.id', 
                DB::raw('SUM(reclaims.miles_completed) as reclaim_ytd')
            )
			->leftJoin('members', 'reclaims.member_id','=','members.id')
			//->and_where('reclaims.date','>=',mktime(0, 0, 0, 1, 1, date('Y')))
			->where('reclaims.year','>=',$year)
			->groupBy('members.id')
			->get();

		$mileage_ytd = DB::table('event_results')
		    ->select(
		        DB::raw('event_results.member_id as id'),
				DB::raw('SUM(event_results.miles) as mileage_ytd')
			)
			->leftJoin('rides', 'rides.id','=','event_results.ride_id')
			->where(DB::raw('YEAR(rides.date)'),'>=', $year)
			->groupBy('id')
			->get();
		
		$lifetime_mileage = DB::table('event_results')
		    ->select(
		        'members.id',
		        DB::raw("SUM(event_results.miles) as lifetime_mileage"))
			->leftJoin('members', 'event_results.member_id','=','members.id') 
			->where('event_results.ride_id', '!=', NULL)
			->groupBy('members.id')
			->get();
		
		$lifetime_reclaim = DB::table('reclaims')
		    ->select(
		        'members.id', 
		        DB::raw("SUM(reclaims.miles_completed) as reclaim_mileage")
		    )
			->leftJoin('members', 'reclaims.member_id','=','members.id') 
			->groupBy('members.id')
			->get();
			
		$data = DB::table('members')
		        ->select(
		            'members.id',
				    DB::raw('CONCAT(members.last_name, ", ", members.first_name) as name'),
				    DB::raw('members.state_prov as province')
			    )
			->leftJoin('event_results', 'event_results.member_id','=','members.id')
			->leftJoin('event_types', 'event_types.id','=', 'event_results.event_type_id')
			->leftJoin('rides', 'event_results.ride_id','=', 'rides.id')
			->where('members.id', '!=', 1);
		if($search_value != ''){
		    $data = $data->where('members.first_name', 'like', DB::raw("'%".$search_value."%'"));
		    $data = $data->orwhere('members.last_name', 'like', DB::raw("'%".$search_value."%'"));
		    $data = $data->orwhere('province', 'like', DB::raw("'%".$search_value."%'"));
		    
		}
		$data = $data->groupBy('members.id')->paginate(10);
		foreach ( $data as $item){
		    $mileage = $this->get_data_width_field($mileage_ytd, $item->id, 0);
		    $reclaim = $this->get_data_width_field($reclaim_ytd, $item->id, 0);
		    $life_mileage = $this->get_data_width_field($lifetime_mileage, $item->id, 0);
		    $life_reclaim = $this->get_data_width_field($lifetime_reclaim, $item->id, 0);
		    $item->YTD_mileage = $mileage + $reclaim;
		    $item->lifetime_mileage = $life_mileage + $life_reclaim;
		}
        $header_footer = $this->header_footer;
        $title = 'Recent Events';
        return view('rides', compact('header_footer', 'data', 'title', 'page', 'search_value'));
    }
    
    public function view($id){
        $member = DB::table('members')
            ->where('id', '=', $id)
            ->get()[0];
            
        $equines = DB::table('event_results')
            ->select(
				DB::raw('equines.id as "Equine #"'),
				'equines.name',
				DB::raw('COUNT(equines.name) as "times ridden"')
			)
			->distinct()
			->where('event_results.member_id','=', $id)
			->whereNotNull('event_results.equine_id')
			->where('event_results.equine_id','!=', 1)
			->leftJoin('equines', 'event_results.equine_id','=','equines.id')
			->orderBy('times ridden', 'DESC')
			->orderBy('equines.id', 'ASC')
			->groupBy('equines.name')
			->get();
		
		foreach($equines as $object){
		    $result = (array)$object;
		    $object->name = '<a href="/rides/horses/view/'.$result['Equine #'].'">'.$object->name.'</a>';
		}
		///////////////////////////////////////////////////////////////////
			
		$select_lifetime_reclaim_mileage = DB::table('reclaims')
            ->select(
                DB::raw('SUM(reclaims.miles_completed)')
            )
			->where('reclaims.member_id','=','members.id');
		
		$earliest_ride_date_from_current_year = DB::table('rides')
		    ->select(
		        DB::raw('rides.date as date'),
		        DB::raw("DATE_FORMAT(FROM_UNIXTIME(rides.date), '%Y') as ride_year")
		    )
		    ->orderBy('ride_year', 'DESC')
			->orderBy('date', 'ASC')
			->limit(1)
			->get('date');
			
		$earliest_ride_date_from_current_year = $earliest_ride_date_from_current_year[0]->date;
		
		$mileage_ytd = DB::table('event_results')
		    ->select(
		        DB::raw('ifnull(SUM(event_results.miles), 0) as mileage_ytd'))
			->join('rides', 'rides.id','=','event_results.ride_id')
			->where(DB::raw('YEAR(rides.date)'),'>=', date('Y'))
			->where('event_results.member_id', '=', $id)
			->get();
		
		$lifetime_mileage = DB::table('reclaims')
		    ->select(DB::raw('ifnull(SUM(reclaims.miles_completed), 0)'))
			->where('reclaims.member_id','=',$id)
			->get();
		// Set up basic member details
		$details = DB::table('members')
		    ->select(
				'members.id',
				'members.active',
				'members.last_name',
				'members.first_name',
				'members.city',
				'members.state_prov',
				DB::raw("ifnull(SUM(event_results.miles), 0) as lifetime_mileage"),
                // DB::raw('SUM(event_results.miles) as YTD_mileage'),
                DB::raw('ifnull(SUM(reclaims.miles_completed), 0) as miles_completed'),
                DB::raw("(DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(birth_date, '%Y') -
					(DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(birth_date, '00-%m-%d'))) as season_age")
			)
			->leftJoin('event_results', 'event_results.member_id','=','members.id')
			->leftJoin('event_types', 'event_types.id','=','event_results.event_type_id')
			->leftJoin('rides', 'rides.id','=','event_results.ride_id')
			->leftJoin('reclaims', 'reclaims.member_id','=','members.id')
			->where('members.id','=', $id)
			->whereNotNull('event_results.ride_id')
			->get()[0]; // ensure completed event
		if($details->season_age >= 21)
		    $details->member_type = 'Senior';
		else if($details->season_age >= 16)
		    $details->member_type = 'Youth';
		else
		    $details->member_type = 'Junior';
		if(isset($details->city)){
		    $details->address = $details->city;
		    if($prov = $details->state_prov)
				$details->address .= ', '.$prov;
		}
		else
			$details->address = '';
// 		$details->YTD_mileage = ($mileage_ytd[0]->mileage_ytd != null)?$mileage_ytd[0]->mileage_ytd:0;
	    $details->YTD_mileage = $mileage_ytd[0]->mileage_ytd;
		$details->lifetime_mileage += $details->miles_completed;
		unset($details->miles_completed);
		
		$details->active = $details->active == '1' ? 'Active' : 'Inactive';
		$rides_by_type = array();
		$rides = DB::table('event_results')
            ->select(
                DB::raw('rides.id as "ride id"'),
                DB::raw('rides.name as ride_name'),
                DB::raw('rides.date as ride_date'),
                DB::raw('event_types.name as event_type'),
                DB::raw('equines.id as "equine #"'),
                DB::raw('event_results.equine_name as equine'),
    	        'event_results.placing',
    	        DB::raw("IF(event_results.time IS NOT NULL, event_results.time, '') as time"),
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
			->where('event_results.member_id','=',$id)
			->orderBy('rides.date', 'desc')
			->orderBy('rides.name', 'desc')
			->get();
		$prev_year = 0;
		foreach($rides as $ride_object){
		    $ride = (array)$ride_object;
		    
		    $year = date('Y', strtotime($ride['ride_date']));
		    if($prev_year != $year){
		        $rides_by_type[$year] = array();
		        $prev_year = $year;
		    }

			$ride['ride_name'] = '<a href="/rides/riders/view/'.$ride['ride id'].'">'.$ride['ride_name'].'</a>';

			$ride['equine'] = '<a href="/rides/horses/view/'.$ride['equine #'].'">'.$ride['equine'].'</a>';
			
			array_push($rides_by_type[$year], $ride);
		}
		return view('member_view', [
		    'header_footer' => $this->header_footer,
		    'title' => $member->first_name.' '.$member->last_name,
		    'member' => $details,
		    'equines' => $equines,
		    'rides_by_type' => $rides_by_type
		]);
    }
    
}
  