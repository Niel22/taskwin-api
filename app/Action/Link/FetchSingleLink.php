<?php

namespace App\Action\Link;

use App\Models\Link;

class FetchSingleLink{

    public function execute(string $slug){
        $link = Link::where('slug', $slug)->first();

        if(!empty($link)){
            return $link;
        }

        return false;
    }
}