<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rawilk\Settings\Facades\Settings;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function settings_data(Request $request)
    {

        $site_logo = settings('logo');
        if($request->hasFile('logo')) {
            $site_logo = rand().time().$request->file('logo')->getClientOriginalName();

            $request->file('logo')->move(public_path('uploads'), $site_logo);
        }


        settings([
            'logo' => $site_logo,
            'fb' => $request->fb,
            'tw' => $request->tw,
            'li' => $request->li,
            'yt' => $request->yt,
        ]);

        return redirect()->back();
    }
}
