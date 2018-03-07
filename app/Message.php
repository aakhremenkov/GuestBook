<?php
/**
 * Created by PhpStorm.
 * User: anahal
 * Date: 14.12.2017
 * Time: 23:06
 */

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;


class Message extends Model
{

    protected $fillable = ['parent_id', 'user_id', 'message', 'image', 'hasResponse'];

    protected $table = 'message';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function ImageUrl(){return url('image/upload', $this->image);}

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Responses()
    {
        return $this->hasMany('App\Message', 'parent_id', 'id')->orderBy('id', 'desc')->get();
    }

    public static function GetById($id)
    {
        return Message::where('id', $id)->first();
    }

    public static function GetUseMessgae($user_id, $id)
    {
        return Message::where('id', $id)->where('user_id', $user_id)->first();
    }

    public static function GetForPage()
    {
        return Message::where('parent_id', 0)
            ->orderBy('id', 'desc')
            ->paginate(25);
    }

    public static function GetAll($pages = 1)
    {
        return Message::where('parent_id', 0)
            ->orderBy('id', 'desc')
            ->offset(25 * ($pages - 1))
            ->limit(25)
            ->get();
    }

    public static function AddMessage($message, $image, $user_id, $parent_id = 0)
    {
        if($parent_id > 0) {
            $parent = Message::GetById($parent_id);
            $parent->update(['hasResponse' => 1]);
        }

        return Message::create([
            'message' => $message,
            'image' => !empty($image) ? $image : 'noimages.jpg',
            'user_id' => $user_id,
            'parent_id' => $parent_id,
            'hasResponse' => false
        ]);
    }

    public static function UpdateMessage($message, $image, $user_id, $messageId)
    {
        $original = Message::GetById($messageId);
        if(!$original || $user_id != $original->user_id){
            return false;
        }
        if(!empty($image)){
            $original->update(['message' => $message, 'image' => $image]);
        }
        else{
            $original->update(['message' => $message]);
        }

        return true;

    }
}