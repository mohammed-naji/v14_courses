<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('id')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required'
        ]);

        $img_name = time().rand().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads'), $img_name);

        Category::create([
            'title' => $request->title,
            'image' => $img_name
        ]);

        return redirect()
        ->route('admin.categories.index')
        ->with('msg', 'Category added successfully')
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
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $category = Category::find($id);

        $img_name = $category->image;
        if($request->hasFile('image')) {
            File::delete(public_path('uploads/'.$category->image));
            $img_name = time().rand().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $img_name);
        }


        $category->update([
            'title' => $request->title,
            'image' => $img_name
        ]);

        return redirect()
        ->route('admin.categories.index')
        ->with('msg', 'Category updated successfully')
        ->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Category::destroy($id);

        $category = Category::find($id);
        File::delete(public_path('uploads/'.$category->image));
        $category->delete();


        return redirect()
        ->route('admin.categories.index')
        ->with('msg', 'Category deleted successfully')
        ->with('type', 'danger');
    }
}
