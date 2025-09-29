<?php

namespace App\Action\ContactForm;

use App\Models\ContactForm;

class CreateContactForm{

    public function execute(array $request): bool
    {

        $contact = ContactForm::create($request);

        if($contact){
            return true;
        }

        return false;
    }
}