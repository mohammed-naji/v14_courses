<?php
// declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestNotificationController extends Controller
{
    public function send()
    {
        $admin = User::where('type', 'admin')->first();

        // dd($admin);

        $admin->notify( new Test() );
    }

    public function read()
    {
        return view('read');
    }

    public function read_notify($id)
    {
        $notify = Auth::user()->notifications->find($id);

        $notify->markAsRead();

        return redirect( $notify->data['url'] );

    }

    public function read_all()
    {
        Auth::user()->unreadNotifications->markasRead();

        return redirect()->back();
    }
}
