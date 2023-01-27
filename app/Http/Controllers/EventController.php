<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $name = "Matheus";
        $age = 29;
        $job = "advogado";
        $arr = [10, 20, 30, 40, 50];
        $names = ["pedro","maria","ana","carlito"];
        return view('welcome',
        [
            'name' =>$name,
            'age' =>$age, 
            'job'=>$job,
            'arr'=>$arr,
            'names'=>$names
        ]);
    }
    public function create(){
        return view('events.create');
    }
}
