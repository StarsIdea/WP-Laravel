<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use DB;

class AdminEventResultController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function list(Request $request){
        $data = DB::table('event_results')
            ->select(
                'event_results.id',
                DB::raw('rides.name as ride'),
                DB::raw('event_types.name as "event_type"'),
                'event_results.event_type_id',
                DB::raw('CONCAT(members.first_name, " ", members.last_name) as "rider name"'),
                'event_results.member_id',
                DB::raw('equines.name as "equine name"'),
                'event_results.equine_id',
                'event_results.placing',
                'event_results.time',
                'event_results.weight',
                'event_results.miles',
                'event_results.points',
                DB::raw('event_results.vet_score as "vet score"'),
                'event_results.bc',
                DB::raw('event_results.bc_points as "bc points"'),
                DB::raw('event_results.bc_score as "bc score"'),
                'event_results.pull',
                DB::raw('event_results.pull_reason as "pull reason"'),
                'event_results.comments',
                'event_results.import_id'
            )
            ->leftJoin('rides', 'rides.id', '=', 'event_results.ride_id')
            ->leftJoin('event_types', 'event_results.event_type_id', '=', 'event_types.id')
            ->leftJoin('members', 'members.id', '=', 'event_results.member_id')
            ->leftJoin('equines', 'equines.id', '=', 'event_results.equine_id')
            ->orderBy('id','desc')
            ->paginate(25);
        $count_total = DB::table('rides')->count();
        $event_result_datas = array();
        foreach($data as $event_result_object){
            $object = (array)$event_result_object;
            $event_result_object->ride = '<a href="/rides/admin/ride/edit/'.$object['id'].'">'.$object['ride'].'</a>';
            $event_result_object->event_type = '<a href="/rides/admin/event_type/edit/'.$object['event_type_id'].'">'.$object['event_type'].'</a>';
            $event_result_object->member_id = '<a href="/rides/admin/member/edit/'.$object['member_id'].'">'.$object['member_id'].'-'.$object['rider name'].'</a>';
            $event_result_object->equine_id = '<a href="/rides/admin/equine/edit/'.$object['equine_id'].'">'.$object['equine_id'].'-'.$object['equine name'].'</a>';
            unset($event_result_object->event_type_id);
        }
        $title = 'Event Result';
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
            $object = DB::table('rides')->where('id', '=', $id)->get();
        $model = 'event_result';
        $rides = DB::table('rides')->select('id', 'name')->orderBy('id', 'desc')->get();
        
        $event_types = DB::table('event_types')->select('id', 'name')->get();
        $members = DB::table('members')->select('id', 'first_name', 'last_name')->get();
        $equines = DB::table('equines')->select('id', 'name')->get();
        $action = '/rides/admin/event_result/add';
        return view('auth/create_form',compact('model', 'object', 'action', 'rides', 'event_types', 'members', 'equines'));
        
    }
    
    public function create(Request $request){
        
    }
    
    public function update(Request $request){
        
    }
    
    public function delete($id){
        
    }
    
}
