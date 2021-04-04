<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use DB;

class AdminReclaimController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function list(Request $request){
        $data = DB::table('reclaims')
            ->orderBy('id','desc')
            ->paginate(25);
        $count_total = DB::table('reclaims')->count();
        $title = 'Reclaim';
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
            $object = DB::table('reclaims')
                ->where('id', '=', $id);
        $model = 'reclaim';
        $rides = DB::table('rides')->select('id', 'name')->orderBy('id', 'desc')->get();
        $members = DB::table('members')->select('id', 'first_name', 'last_name')->get();
        $equines = DB::table('equines')->select('id', 'name')->get();
        $action = '/rides/admin/reclaim/add';
        return view('auth/create_form',compact('model', 'object', 'action', 'rides', 'members', 'equines'));
        
    }
    
    public function create(Request $request){
        
    }
    
    public function update(Request $request){
        
    }
    
    public function delete($id){
        
    }
    
}