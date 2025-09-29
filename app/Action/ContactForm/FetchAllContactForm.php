<?php

namespace App\Action\ContactForm;

use App\Models\ContactForm;

class FetchAllContactForm{

    public function execute(): bool|object
    {
        $contact = ContactForm::paginate(10);
        
        if($contact->isNotEmpty()){
            return $contact;
        }

        return false;
    }
}