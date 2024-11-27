<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionsAnswersController extends Controller
{
    public function index(){
        return view('front.help.questions_answers');
    }
}
