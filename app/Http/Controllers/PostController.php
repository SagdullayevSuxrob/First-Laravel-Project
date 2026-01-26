<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Jobs\Change;
use App\Jobs\ChangePost;
use App\Mail\MailPostCreated;
use Cache;
use Http;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Notifications\PostCreated as NotificationsPostCreated;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Tag;
use Mail;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->authorizeResource(Post::class, 'post');
        // $this->middleware('password.confirm')->only('edit');
    }

    public function index()
    {
        /* $posts = Post::cursor()->filter(function ($post) {
            return $post->id > 50;
        });

        $text = ' ';
        foreach($posts as $post){
            $text .= $post->id;
        }

        return $text;
 */
        // Post::all()->push(5)->chunk(10)->dd();

        //         HTTP Client        \\
        // $response =Http::post('https://daryo.uz');
        // $response = Http::withoutVerifying()->get('https://daryo.uz/');
        // dd($response);

        //      LOG     \\
        /*  $message = "Bu log qilinmoqdaa..."; 
         Log::emergency($message);
         Log::alert($message);
         Log::critical($message);
         Log::error($message);
         Log::warning($message);
         Log::notice($message);
         Log::debug($message);
         Log::info("Showing the user profile for user:" . 4); */

        // Cache::pull('posts');
        // $posts = Post::latest()->paginate(12);
        // $posts = Post::latest()->get();

        $page = request('page', 1); 

        $posts = Cache::remember("posts_page_{$page}", 120, function () {
            return Post::latest()->paginate(9);
        });

        return view('posts.index', compact('posts'));


    }


    public function create()
    {
        return view('posts.create')->with([
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    public function store(StorePostRequest $request)
    {

        if ($request->hasFile('photo')) {
            $uploadFile = $request->file('photo');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->storeAs('public/src', $file_name);
        }

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path ?? null,
        ]);

        if (isset($request->tags)) {
            foreach ($request->tags as $tag) {
                $post->tags()->attach($tag);
            }
        }

        PostCreated::dispatch($post);

        ChangePost::dispatch($post);

        Mail::to($request->user())->later(now()->addMilliseconds(60), (new \App\Mail\PostCreated($post))->onQueue('sending-mails'));

        Notification::send(auth()->user(), new NotificationsPostCreated($post));

        return redirect()->route('posts.index')->with('success', 'Post muvoffaqiyatli yaratildi.');
    }

    public function show(Post $post)
    {
        return view('posts.show')->with([
            'post' => $post,
            'recent_posts' => Post::latest()->get()->except($post->id)->take(5),
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    public function edit(Post $post)
    {
        /* if (! Gate::allows('update-post', $post)) {
            abort(403);
        } */

        // Gate::authorize('update', $post);
        // $this->authorize('update', $post);
        // Gate::authorize('update-post', $post);

        return view('posts.edit')->with(['post' => $post]);
    }

    public function update(StorePostRequest $request, Post $post)
    {
        // Gate::authorize('update', $post);
        // Gate::authorize('update-post', $post);

        if ($request->hasFile('photo')) {
            if (isset($post->photo)) {
                Storage::delete($post->photo);
            }
            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('post-photos', $name);
        }


        $post->update([
            'title' => $request->title,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path ?? $post->photo,
        ]);

        return redirect()->route('posts.show', ['post' => $post->id]);
    }


    public function destroy(Post $post)
    {
        // Gate::authorize('delete', $post);

        if (isset($post->photo)) {
            Storage::delete($post->photo);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
