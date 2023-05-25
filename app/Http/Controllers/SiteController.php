<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.index');
    }

    public function about()
    {
        return view('site.about');
    }

    public function courses()
    {
        $courses = Course::latest('id')->paginate(6);

        return view('site.courses', compact('courses'));
    }

    public function course($slug)
    {
        $course = Course::where('slug', '=', $slug)->firstOrFail();

        return view('site.course', compact('course'));
    }

    public function review(Request $request)
    {
        $request->validate(['rating' => 'required']);

        Review::create([
            'star' => $request->rating,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'course_id' => $request->course_id
        ]);

        return redirect()->back();
    }

    public function our_team()
    {
        return view('site.team');
    }

    public function contact()
    {
        return view('site.contact');
    }

}
