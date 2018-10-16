<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;


class MailController extends Controller {


   public $request,$to,$from;

   public function sendemail(Request $request){
       //dd($request['to']);
       //return $request['mode'];
        
        $to = $request['to'];
        $from =array(
            'name'=>$request['from'],
            'to'=>$request['to'],
            'message'=>$request['message']
        );
        if ($request['mode']=='html'){
            Mail::send('mail',$from, function($message)  use ($to,$from,$request){
                $message->to($to)->subject($request['message']);
               $message->from($from[0]);
             });
        }else{
             Mail::send('mail', $from, function($message) use ($to,$from,$request){
                $message->to($to)->subject('thanks');
                $message->from($from['name']);
            });
        }
        //dd($send);
       return Redirect()->refresh();
   }
//    public function attachment_email(){

//       Mail::send('mail', $data, function($message) {
//          $message->to('abc@gmail.com', 'Tutorials Point')->subject
//             ('Laravel Testing Mail with Attachment');
//          $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
//          $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
//          $message->from('xyz@gmail.com','Virat Gandhi');
//       });
//       echo "Email Sent with attachment. Check your inbox.";
//    }
}
