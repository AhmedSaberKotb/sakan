<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('owner')->get();
        return response()->json([
            'posts'=>$posts,
            ],
            201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'price'=>'required|Numeric',
            'address'=>'required|max:500',
            'governorate'=>'required|max:255|Alpha',
            'number_room'=>'required|Numeric',
            'description'=>'required'
        ]);
        $post=post::create($request->all());
        return response()->json($post,200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post=post::find($id);
        return response($post,201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,post $post)
    {
        $request->validate([
            'price'=>'sometimes|Numeric',
            'address'=>'sometimes|max:500',
            'governorate'=>'sometimes|max:255',
            'number_room'=>'sometimes',
            'description'=>'sometimes|'
        ]);
        $post->update($request->all());
        return response()->json($post,200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        post::destroy($id);
        return response(null,200,);
    }
    public function save(Request $request,$owner_id)
    {
        $request->validate([
            'price'=>'required|Numeric',
            'address'=>'required|max:500',
            'governorate'=>'required|max:255|Alpha',
            'number_room'=>'required|Numeric',
            'description'=>'required'
        ]);
        $requestData = $request->all();
        $requestData['owner_id'] = $owner_id;
        //dd($requestData);
        $post=post::create($requestData);
        return response()->json($post,200);
    }
}
