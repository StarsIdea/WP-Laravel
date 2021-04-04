<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    private $header_footer;

    public function __construct (){
        $this->header_footer = '';//file_get_contents('http://enduranceridersofalberta.ca');
    }
    
    public function getHeaderFooter (){
        return $this->header_footer;
    }
    
    public function get_data_width_field ( $object, $field, $default = NULL){
        foreach($object as $item){
            foreach($item as $key => $value){
                if($item->id == $field){
                    if($key != 'id'){
                        if($value != null)
                            return $value;
                    }   
                }
            }
        }
        return 0;
    }
}
