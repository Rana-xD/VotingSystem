<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MeetingUser;
class Users extends Controller
{
    

    public function login(Request $request)
    {
        if (User::where('username', '=', $request->username)->exists()) {
            if(MeetingUser::where([
                ['meeting_uuid',$request->meetingid],
                ['pin',$request->password]
            ])->exists())
            {
                session(['username' => $request->username ]);
                session(['meeting_uuid' =>$request->meetingid]);
                return redirect('meeting');
            }
            else {
                {
                    return "meeting ot trov";
                }
            }
        }
        else
        {
            return "ot mean";
        }
    }

    public function meeting()
    {
        $username = session('username','default');
        $meeting_uuid = session('meeting_uuid','default');

        return view('user.meeting',compact('username','meeting_uuid'));
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
