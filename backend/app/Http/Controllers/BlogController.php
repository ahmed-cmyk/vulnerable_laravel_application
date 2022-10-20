<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $blogs = Blog::all();
        return response()->json([
            'status' => 200,
            'blogs' => $blogs
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:255'
        ]);

        $blog = Blog::create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return response()->json([
            'status' => '200',
            'message' => 'Blog created successfully',
            'blog' => $blog,
        ]);
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        
        return response()->json([
            'status' => 200,
            'blog' => $blog
        ]);
    }

    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:255'
        ]);

        $blog = Blog::find($id);
        $blog->update($formFields);

        return response()->json([
            'status' => 201,
            'message' => 'Blog updated successfully',
            'blog' => $blog
        ]);
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();

        return response()->json([
            'status' => 204,
            'message' => 'Blog deleted successfully'
        ]);
    }
}
