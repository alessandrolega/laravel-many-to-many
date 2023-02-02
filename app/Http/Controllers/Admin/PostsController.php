<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Tag;

use App\Http\Controllers\Controller;
use App\Mail\CreatePostMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'posts'=> Post::with('Category')->Paginate(10)
        ];
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::All();
        $tags = Tag::All();

        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);

        $request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);
        $new_post = new Post();
        if(array_key_exists('image', $data)){
            $cover_url = Storage::put('posts_covers', $data['image']);
            $data['cover'] = $cover_url;
        }
        $new_post->fill($data);
        $new_post->save();

        if(array_key_exists('tags', $data)){
            $new_post->Tags()->sync($data['tags']);

        }

        $mail = new CreatePostMail($new_post);
        $email_utente = Auth::user()->email;
        Mail::to($email_utente)->send($mail);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $singolo_post = Post::FindOrFail($id);
        return view('admin.posts.show', compact('singolo_post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $categories = Category::All();
        $tags = Tag::All();
        
        return view('admin.posts.edit', compact('post', 'categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $data = $request->all();
       $singolo_post = Post::FindOrFail($id);

       $singolo_post->update($data);

       if(array_key_exists('tags', $data)){
        $singolo_post->Tags()->sync($data['tags']);

       } else{
            $singolo_post->Tags()->sync([]);
       }
        return redirect()->route('admin.posts.show', $singolo_post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $singolo_post = Post::FindOrFail($id);
        if($singolo_post->cover){
            Storage::delete($singolo_post->cover);
        }
        $singolo_post->Tags()->sync([]);
        $singolo_post->delete();
        return redirect()->route('admin.posts.index');
    }
}
