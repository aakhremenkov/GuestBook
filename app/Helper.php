<?php
/**
 * Created by PhpStorm.
 * User: anahal
 * Date: 07.03.2018
 * Time: 13:22
 */

namespace App;

use \Illuminate\Support\Facades\Auth;

class Helper
{
    public static   function GenerateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public static function ShowResponses($message, $level = 1)
    {
        if(!$message->hasResponse) {
            return "";
        }
        $response = '';
        foreach ($message->Responses() as $res)
        {
            $response .= '<div class="row">';
            $response .= '<div class="offset-md-'. $level. ' col-md-3">';
            $response .= 'User : '. $res->User->username;
            $response .= '<a href="'. $res->ImageUrl(). '" target="_blank"><img src="'. $res->ImageUrl() .'" class="rounded preview" /></a><br>';
            if(Auth::user()) {
                if (!$res->hasResponse && Auth::user()->id == $res->user_id) {
                    $response .= '<a href = "' . route('edit', $res->id) . '" class="btn btn-sm btn-primary" > Edit</a>&nbsp;';
                }
                $response .= '<a href="' . route('response', $res->id) . '"  class="btn btn-sm btn-primary">Add response</a>';
            }
            $response .= '</div><div class="col-md-'. (9 - $level). '">'. $res->message. '</div></div>';
            if($res->hasResponse) {
                $response .= Helper::ShowResponses($res, $level+1);
            }
        }

        return $response;
    }
}