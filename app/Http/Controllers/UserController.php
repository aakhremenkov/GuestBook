<?php

namespace App\Http\Controllers;

use App\Message;
use App\Helper;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getResponse($id)
    {
        $message = Message::GetById($id);
        if(!isset($message)){
            return redirect(url(''));
        }
        return view('public.response')->with('message', $message);

    }

    public function getEdit($id)
    {
        $message = Message::GetUseMessgae(Auth::user()->id, $id);
        if(!isset($message)){
            return redirect(url(''));
        }
        return view('public.edit')->with('message', $message);
    }

    public function postMessageValidate(Request $request)
    {
        $this->messageValidator($request->all())->validate();
        return new JsonResponse( ['success' => ['success']]);
    }

    protected function messageValidator(array $data)
    {
        return Validator::make($data, [
            'message' => 'required|string|max:1000'
        ]);
    }

    protected function postAddMessage(Request $request)
    {
        $avatar_path = env('UPLOAD_PATH');
        $imgName = '';
        if($request->file) {
            $ext = $request->file->getClientOriginalExtension();
            $imgName = Helper::GenerateRandomString(8) . '.' . $ext;
            $request->file->move($avatar_path, $imgName);
        }

        switch ($request->action)
        {
            case 'add' : Message::AddMessage($request->message, $imgName, Auth::user()->id, 0);
                session()->flash("info_msg", "Message added.");break;
            case 'response' : Message::AddMessage($request->message, $imgName, Auth::user()->id, $request->parentId);
                session()->flash("info_msg", "Response added.");break;
            case 'update' : Message::UpdateMessage($request->message, $imgName, Auth::user()->id, $request->messageId) ?
                session()->flash("info_msg", "Message updated."):
                session()->flash("error_msg", "Can't update the message.");
                break;
        }

        return redirect('');
    }
}
