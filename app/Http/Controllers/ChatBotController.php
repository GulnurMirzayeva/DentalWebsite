<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;

class ChatBotController extends Controller
{
    public function index()
    {
        return view('front.chatbot.index');
    }
}
