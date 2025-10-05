<?php

namespace App\Action\Link;

use App\Models\Link;

class FetchAllLink{

    public function execute(){
        $link = Link::all();

        if($link->isNotEmpty()){
            return $link;
        }

        return false;
    }
}