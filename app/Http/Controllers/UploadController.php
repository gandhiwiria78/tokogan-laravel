<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galery;

class UploadController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){

        $img = $request->get('image');
        // remove extra parts
        $exploded = explode(",",$img);
       // extention
       if(str_contains($exploded[0], 'gif')){
         $ext = 'gif';
       }else if(str_contains($exploded[0], 'png')){
         $ext = 'png';
       }else{
         $ext = 'jpg';
       }
       // decode
       $decode = base64_decode($exploded[1]);
       $filename = str_random() . "." . $ext;
       //path of your local folder
       $path = public_path() . "/img/galery/" . $filename;
       //upload image to your path
       if(file_put_contents($path,$decode)){
            $content = $request->content;
            $createPost = Galery::create(['title' =>$filename, 'deskripsi' => 'testest','path' => "/img/galery/" . $filename]);
            if($createPost){
                // return someone
                //return redirect()->refresh();
                return Galery::all();

            }
       }
    }
}
