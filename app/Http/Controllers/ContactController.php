<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
class ContactController extends Controller
{
    public function index(){
        $contact = Contact::all();
        // $teste = "Hello Word Otavio";
        return view('contact',['contact' =>$contact ]);
    }
}



?>
