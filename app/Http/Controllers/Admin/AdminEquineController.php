<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use DB;

class AdminEquineController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function list(Request $request){
        $data = DB::table('equines')
            ->select(
                DB::raw('equines.id as "equine id"'),
                'equines.name',
                'equines.member_id',
                'equines.owner_name',
                'equines.active',
                DB::raw('equines.registration_date as "registration date"'),
                DB::raw('equine_sexes.name as "equine sex id"'),
                'equines.breed',
                'equines.breed_registry_# as "breed registry #"',
                'equines.foal_date as "foal date"',
                'equines.color'
            )
            ->leftJoin('equine_sexes', 'equine_sexes.id', '=', 'equines.equine_sex_id')
            ->orderBy('equine id','asc')
            ->paginate(25);
        foreach($data as $equine_object){
            $equine_object->member_id = '<a href="/rides/admin/member/edit/'.$equine_object->member_id.'">'.$equine_object->member_id.'-'.$equine_object->name.'</a>';
        }
        $count_total = DB::table('equines')->count();
        $title = 'Equine';
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
            $object = DB::table('equines')
                ->where('id', '=', $id);
        $model = 'equine';
        $members = DB::table('members')->select('id', 'first_name', 'last_name')->get();
        $equine_sexes = DB::table('equine_sexes')->select('id', 'name')->get();
        $action = '/rides/admin/equine/add';
        return view('auth/create_form',compact('model', 'object', 'action', 'members', 'equine_sexes'));
        
    }
    
    public function create(Request $request){
        
    }
    
    public function update(Request $request){
        
    }
    
    public function delete($id){
        
    }
}