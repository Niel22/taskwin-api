<?php

namespace App\Action\Link;

use App\Models\Link;

class UpdateLink{

    public function execute(string $slug, array $request): bool
    {
        $link = Link::where('slug', $slug)->first();

        if(!empty($link)){
            return $link->update([
                "url" => $request['url']
            ]);
        }

        return false;
    }
}