<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Category;
use App\Models\Instructor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('show_courses');

        $courses = Course::latest('id')->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $course = new Course();
        $categories = Category::select('id', 'title')->get();
        $instructors = Instructor::select('id', 'name')->get();

        return view('admin.courses.create', compact('course', 'categories', 'instructors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required',
            'title_ar' => 'required',
            'image' => 'required',
            'content' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'category_id' => 'required',
            'instructor_id' => 'required',
        ]);

        $img_name = time().rand().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads'), $img_name);

        // $slug = strtolower($request->title);
        // $slug = str_replace(' ', '-', $slug);

        $slug_count = Course::where('title_en', 'like', $request->title_en.'%')->count();

        // dd($slug_count);

        $slug = $slug_count == 0 ? Str::slug($request->title_en) : Str::slug($request->title_en) . '-'.$slug_count;

        $title = json_encode([
            'en' => $request->title_en,
            'ar' => $request->title_ar,
        ], JSON_UNESCAPED_UNICODE);

        // dd($slug);

        Course::create([
            // 'title_en' => $request->title_en,
            // 'title_ar' => $request->title_ar,
            'title' => $title,
            'slug' => $slug,
            'image' => $img_name,
            'content' => $request->content,
            'price' => $request->price,
            'duration' => $request->duration,
            'category_id' => $request->category_id,
            'instructor_id' => $request->instructor_id,
        ]);

        return redirect()
        ->route('admin.courses.index')
        ->with('msg', 'Course added successfully')
        ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::select('id', 'title')->get();
        $instructors = Instructor::select('id', 'name')->get();
        $course = Course::find($id);

        return view('admin.courses.edit', compact('course', 'categories', 'instructors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'category_id' => 'required',
            'instructor_id' => 'required',
        ]);

        $course = Course::find($id);

        $img_name = $course->image;

        if($request->hasFile('image')) {
            File::delete(public_path('uploads/'.$course->image));
            $img_name = time().rand().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $img_name);
        }

        $course->update([
            'title' => $request->title,
            'image' => $img_name,
            'content' => $request->content,
            'price' => $request->price,
            'duration' => $request->duration,
            'category_id' => $request->category_id,
            'instructor_id' => $request->instructor_id,
        ]);

        return redirect()
        ->route('admin.courses.index')
        ->with('msg', 'Course updated successfully')
        ->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Course::destroy($id);

        $course = Course::find($id);
        File::delete(public_path('uploads/'.$course->image));
        $course->delete();


        return redirect()
        ->route('admin.courses.index')
        ->with('msg', 'Course deleted successfully')
        ->with('type', 'danger');
    }
}
