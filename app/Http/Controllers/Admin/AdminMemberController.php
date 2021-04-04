<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use DB;

class AdminMemberController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function list(Request $request){
        $earliest_ride_date_from_current_year = DB::table('rides')
            ->select(
                'rides.date',
                DB::raw("DATE_FORMAT(FROM_UNIXTIME(rides.date), '%Y') as ride_year")
            )
			->orderBy('ride_year', 'DESC')
			->orderBy('date', 'ASC')
			->limit(1)
			->get()[0]->date;
// 		print_r($earliest_ride_date_from_current_year);
// 		die;
//         $_select_age_at_first_ride_of_season = DB::table('rides')
//             ->select(
//                 DB::raw("
// 					CASE
// 						WHEN season_age >= 21 THEN 'Senior'
// 						WHEN season_age < 21 AND season_age >= 16 THEN 'Youth'
// 						WHEN season_age < 16  THEN 'Junior'
// 					END")
//             )
// 			->where('rides.date','>=', $earliest_ride_date_from_current_year)
// 			->order_by('rides.date', 'asc')
// 			->limit(1);
			
			
        $data = DB::table('members')
            ->select(
                'members.id',
                DB::raw('members.id as "ERA #"'),
                DB::raw('members.aef_number as "AEF #"'),
                'members.active',
                'members.id as member_type',
                DB::raw('members.first_name as "first name"'),
                DB::raw('members.last_name as "last name"'),
                'members.email',
                'members.address',
                'members.city',
                DB::raw('members.state_prov as "prov / state"'),
                DB::raw('members.postal_code as "postal code"'),
                DB::raw('members.phone_home as "phone"'),
                DB::raw('members.birth_date as "birth date"'),
                DB::raw("(DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(birth_date, '%Y') -
					(DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(birth_date, '00-%m-%d'))) as season_age")
            )
            ->distinct()
            ->leftJoin('event_results', 'event_results.member_id', '=', 'members.id')
            ->leftJoin('rides', 'rides.id', '=', 'event_results.ride_id')
            ->where('rides.date', '>=', $earliest_ride_date_from_current_year)
            ->where('members.id', '!=', '1')
            ->orderBy('id','asc')
            ->paginate(25);
            
        foreach($data as $member_object){
            
            if($member_object->season_age >= 21){
                $member_object->member_type = 'Senior';
            }
            else if($member_object->season_age >= 16){
                $member_object->member_type = 'Youth';
            }
            else{
                $member_object->member_type = 'Junior';
            }
            
            unset($member_object->season_age);
            
        }
        $count_total = DB::table('rides')->count();
        $title = 'Member';
        $page = ($request->input('page') != null)?$request->input('page'):1;
        $search_value = ($request->input('search_value') != null)?$request->input('search_value'):'';
        return view(
            'auth/list', 
            compact(
                'data', 
                'count_total',
                'title',
                'page',
                'search_value'
            )
        );
    }
    
    public function create_update_form($id = 0){
        
        $object = null;
        if($id != 0)
            $object = DB::table('members')
                ->where('id', '=', $id);
        $model = 'member';
        $action = '/rides/admin/member/add';
        return view('auth/create_form',compact('model', 'object', 'action'));
        
    }
    
    public function create(Request $request){
        
    }
    
    public function update(Request $request){
        
    }
    
    public function delete($id){
        
    }
}
