<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{

    public function __construct(){
        parent::__construct();
    }
    
    public function dashboard(){
        $count = array(
            'ride' => DB::table('rides')->count(),
            'event_result' => DB::table('event_results')->count(),
            'member' => DB::table('members')->count(),
            'reclaim' => DB::table('reclaims')->count(),
            'equine' => DB::table('equines')->count(),
            'event_type' => DB::table('event_types')->count(),
            'member_type' => DB::table('member_types')->count(),
            'equine_sex' => DB::table('equine_sexes')->count(),
            'federation' => DB::table('federations')->count()
        );
        return view('/auth/dashboard', compact('count'));
    }
}