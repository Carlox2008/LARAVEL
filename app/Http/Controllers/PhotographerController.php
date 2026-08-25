<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
class PhotographerController extends Controller
{
    public function index(){
        $photos = Photo::with('user')->latest()->paginate(9);
        return view('dashboard', compact('photos'));
    }

    public function store(Request $request){
         $request->validate([
            'title' => 'nullable|string|max:255',
            'photo' => 'required|image|max:10240',
         ]);

         if($request->hasFile('photo')){
            $path = $request->file('photo')->store('photos', "public");
         }

         auth()->user()->photos()->create([
            'title' => $request->title,
            'image_path' => $path,
         ]);

         return redirect()->back()->with('sucess', 'foto publicada com sucesso!');
    }

    

}
