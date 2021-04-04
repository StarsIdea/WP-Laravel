<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use DB;

class AdminFederationController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function list(Request $request){
        $data = DB::table('federations')
            ->orderBy('id','asc')
            ->paginate(25);
        $count_total = DB::table('federations')->count();
        $title = 'federation';
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
            $object = DB::table('federations')->where('id', '=', $id)->get();
        $model = 'federation';
        $action = '/rides/admin/federation/add';
        return view('auth/create_form',compact('model', 'object', 'action'));
        
    }
    
    public function create(Request $request){
        
    }
    
    public function update(Request $request){
        
    }
    
    public function delete($id){
        
    }
}