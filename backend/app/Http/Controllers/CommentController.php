<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $comments = Blog::find($id)->comments;

        return response()->json([
            'status' => 200,
            'comments' => $comments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = Comment::create([
            'comment' => $request->input('comment'),
            'author' => $request->input('author'),
            'blog_id' => $request->input('blog_id')
        ]);

        $blog = Blog::find($request->input('blog_id'));
        $blog->comments()->save($comment);

        return response()->json([
            'status' => 201,
            'comment' => $comment
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }
}
