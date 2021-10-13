<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use App\User;
use function bcrypt;
use function compact;
use function dd;
use function redirect;
use function view;
use function use_soap_error_handler;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.panel', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.panel_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = \request()->validate([
            "user_realname" => 'required',
            "username" => 'required',
            "user_pw" => 'required',
            "user_confirm_pw" => 'required',
            "user_type" => 'required',
            "user_email" => 'required'
        ]);

        $user = new User();
        $user->name = $validated['user_realname'];
        $user->username = $validated['username'];
        if ( $validated['user_pw'] != $validated['user_confirm_pw'] )
        {
            toast('Passwords didn\'t match','error');
            return view('users.panel_create');
            //return back()->with('warning','Passwords didn\'t match');
        }
        $user->password = bcrypt($validated['user_pw']);
        $user->email = $validated['user_email'];
        if ( $validated['user_type'] == "Admin" )
        {
            $user->admin = 1;
        }
        {
            $user->admin = NULL;
        }

        $user->save();
        $this->saveLog(Auth::user()->username."'s created new user that it's username's: $user->username");
        $this->send_syslog("info-created new user succesfully");
        return redirect('users/panel')->with('success','User\'s created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.panel_show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = \request()->validate([
            "user_realname" => 'required',
            "username" => 'required',
            "user_type" => 'required',
            "user_email" => 'required'
        ]);


        $user->name = $validated['user_realname'];
        $user->username = $validated['username'];
        if ( $request->user_pw != null && $request->user_confirm_pw != null )
        {
            if ( $request->user_pw != $request->user_confirm_pw )
            {
                toast('Passwords didn\'t match','error');
                return view('users.panel_create');
                // return back()->with('warning','Passwords didn\'t match');
            }
            $user->password = bcrypt($request->user_pw);
        }
        $user->email = $validated['user_email'];
        if ( $validated['user_type'] == "Admin" )
        {
            $user->admin = 1;
        }
        else
        {
            $user->admin = NULL;
        }

        $user->save();
        $this->saveLog(Auth::user()->username. "'s changed user information that it's username's: $user->username");
        $this->send_syslog("info-changed user information");
        return redirect('users/panel')->with('success','User\'s edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $name = $user->username;
        $user->delete();
        $this->saveLog(Auth::user()->username."'s deleted a user, username's: $name");
        //Log::info("test syslog");
        $this->send_syslog("info-deleted user");
        toast('User\'s deleted successfully.','success');
        return redirect('users/panel');
        //  return redirect('users/panel')->with('toast_success','User\'s deleted successfully.');

    }
}
