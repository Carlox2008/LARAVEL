<?php

namespace App\Http\Controllers;
use App\Models\Like;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;



class Likecontroller extends Controller
{
    public function toggle(Photo $photo){
        $like = Like::where('user_id', Auth::id())
        ->where('photo_id', $photo->id)
        ->first();

        if($like){
            $like->delete();
        }else{

        Like::create([
            'user_id' => Auth::id(),
            'photo_id' => $photo->id,
        ]);
        }
        return back();

    }
}