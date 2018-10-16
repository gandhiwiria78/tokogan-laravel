<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Home(){
        // $word ="aehrnmikht";
        // $word = strrev($word);
        // $word2= substr($word,5);

        // $secretword = $word[4].$word[9].$word[5].$word[0];
        // $secretword .= $word[9].$word2[0];
        // $secretword .= " ".$word[0].$word2[3].$word2[1].$word[3];
        // $secretword .= $word[5]."d".$word[9].$word2[2];

        // return $secretword;

    }
}
