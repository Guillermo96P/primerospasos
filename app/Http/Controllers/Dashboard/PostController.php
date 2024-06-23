<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(2);
        echo view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('id', 'title');
        $post = new Post();

        echo view('dashboard.post.create', compact('categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // echo request("title");
        // dd($request);
        // dd(request("title"));
        // echo $request->input('slug');

        // $validated = $request->validate(StoreRequest::myRules());

        // $validated = Validator::make($request->all(), StoreRequest::myRules());
        
        // dd($validated->errors());
        // dd($validated->fails());

        // $data = array_merge($request->all(), ['image' => '']);

        // dd($data);

        // $data = $request->validated();
        // $data['slug'] = Str::slug($data['title']);
        
        // dd($data);

        Post::create($request->validated());
        
        // return route("post.create");
        // return redirect(("/post/create"));
        // return redirect()->route("post.create");
        // return redirect()->route("post.create");
        return to_route("post.index")->with('status', "Registro creado.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view("dashboard.post.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('id', 'title');

        echo view('dashboard.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        $data = $request->validated()["image"];
        if (isset($data["image"])) {
            $data["image"] = $filename = time().".".$data["image"]->extension();
            $request->image->move(public_path("image"), $filename);
        }
        $post->update($data);
        // $request->session()->flash('status', "Registro actualizado.");
        return to_route("post.index")->with('status', "Registro actualizado.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return to_route("post.index")->with('status', "Registro eliminado.");
    }
}
