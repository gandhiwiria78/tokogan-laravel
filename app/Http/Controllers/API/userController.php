<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\User;

class userController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       return User::orderBy('id', 'asc')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> "required|string|max:191",
            'email'=> "required|string|email|max:191|unique:users",
            'password'=> "required|min:6|max:20",
        ]);

        //
        return User::create([
            'name'=> $request['name'],
            'email'=> $request['email'],
            'password'=> Hash::make($request['password']),
            'type'=> $request['type'],
            'bio'=> $request['bio'],
            'photo'=> $request['photo'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //
        $user = User::findOrFail($id);

        $this->validate($request,[
            'name'=> "required|string|max:191",
            'email'=> "required|string|email|max:191|unique:users,email,".$user->id,
            'password'=> "sometimes|min:6|max:20",
        ]);
        $user->update($request->all());
        return ['message'=>'succes update'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
       $user = User::find($id);
       $user->delete();
       return ['message'=>'success'];
    }
}
