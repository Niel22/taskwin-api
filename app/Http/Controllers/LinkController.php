<?php

namespace App\Http\Controllers;

use App\Action\Link\FetchAllLink;
use App\Action\Link\FetchSingleLink;
use App\Action\Link\UpdateLink;
use App\Http\Requests\UpdateLinkRequest;
use App\Http\Resources\LinkResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    use ApiResponse;

    public function index(FetchAllLink $action){
        if($link = $action->execute()){
            return $this->success(LinkResource::collection($link), "All Links");
        }

        return $this->success([], "No Link Found");
    }

    public function show(string $slug, FetchSingleLink $action){

        if($link = $action->execute($slug)){
            return $this->success(new LinkResource($link), "Single Link");
        }

        return $this->success([], "Link Not Found");
    }

    public function update($slug, UpdateLinkRequest $request, UpdateLink $action){
        if($action->execute($slug, $request->all())){
            return $this->success([], 'Link updated');
        }

        return $this->error('Link Not Found');
    }
}
