<?php

namespace App\Http\Controllers;

use App\Action\ContactForm\CreateContactForm;
use App\Action\ContactForm\DeleteContactForm;
use App\Action\ContactForm\FetchAllContactForm;
use App\Http\Requests\StoreContactFormRequest;
use App\Http\Resources\ContactFormCollection;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    use ApiResponse;

    public function index(FetchAllContactForm $action){

        if($contact = $action->execute()){
            return $this->success(new ContactFormCollection($contact), 'All Contact Form');
        }

        return $this->success([], 'No Contact Form Found');
    }

    public function store(StoreContactFormRequest $request, CreateContactForm $action){
        if($action->execute($request->all())){
            return $this->success([], 'Contact Form Created');
        }

        return $this->error('Problem Creating Contact Form');
    }

    public function destroy($id, DeleteContactForm $action){
        if($action->execute($id)){
            return $this->success([], 'Contact Form Deleted');
        }

        return $this->error('Problem Deleting Contact Form');
    }
}
