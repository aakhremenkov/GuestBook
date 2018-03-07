<?php

namespace App\Http\Controllers;

use App\Message;
use App\Helper;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class PagesController extends Controller
{
    public function getGuestBook()
    {
        $messages = Message::GetForPage();
        return view('public.guestbook')->with('messages', $messages);
    }
}
