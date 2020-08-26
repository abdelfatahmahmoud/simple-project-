<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use App\Traits;
class PostController extends Controller
{

 use Traits\GenralTraits;
    //middleware to created posts and show user id for created posts
   public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    //index page
    public function index(){
        $posts = Post::OrderBy('id','desc')->paginate(5);
        $count = Post::count();
        return view('posts.index',compact('posts','count'));
    }

    public function show($id){
        $post=Post::find($id);
        return view('posts.show',compact('post'));
    }
//create posts
    public function create(){

        return view('posts.create');
    }

    public function store(Request $request){


        $request->validate([
            'title' => 'required|max:100',
            'body' => 'required|max:300',
            'coverImage' => 'image|mimes:jpeg,bmp,png|max:1999'
        ]);
        /*
        if ($request->hasFile('coverImage')) {
            $file = $request->file('coverImage') ;
            $ext = $file->getClientOriginalExtension() ;
            $filename = 'cover_image' . '_' . time() . '.' . $ext ;
            $file->storeAs('public/coverImages', $filename);

        } else {

            $filename = 'noimage.PNG';
        }
 $file_extension = $photo -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = $folder;
        $photo -> move($path,$file_name);

        if($request->hasFile('coverImage')){
            $file = $request->file('coverImage');
            $ext = $file->getClientOriginalExtension();
            $filename = 'cover_image' . '_' . time() . '.' . $ext;
            $file->storeAs('public/coverImages' , $filename);

        } else  {

            $filename='noimage.png';
        }
*/



        $file_name = $this->saveImage($request->coverImage, 'images/coverImages');

        $post = new Post() ;
        $post -> title      = $request->title ;        $post -> body       =  $request->body ;
        $post -> image      = $file_name;
        $post -> user_id    = auth()->user()->id;

        $post->save();
        return redirect('/posts')->with(['success'=>'yas you do created new posts!']);
    }

    //edit posts
    public function edit($id){

        $posts = Post::find($id);

    if(auth()->user()->id !== $posts->user_id ){
        return  redirect('/posts')->with(['error'=>'you are not authorized']);
    }
        return view('posts.edit',compact('posts'));

    }
//update posts
    public function update(Request $request,$id){

        $request->validate([
            'title' => 'required|max:100',
            'body' => 'required|max:300',

        ]);
        //get all data in data base
        $posts = Post::find($id);

        $posts -> title= $request->title;
        $posts -> body= $request->body;


        $posts->save();
        return redirect('/posts')->with(['success'=>'success to updated posts!']);
    }

    //deleted posts

    public function delete($id){

        $post = Post::find($id);
        $post->delete();

        return redirect('/posts')->with(['success'=>'success to deleted posts!']);
    }
}
