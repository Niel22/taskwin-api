<?php

namespace App\Action\ContactForm;

use App\Models\ContactForm;

class DeleteContactForm{

    public function execute(int $id) : bool
    {

        $contact = ContactForm::find($id);

        if($contact){
            return $contact->delete();
        }

        return false;
    }
}