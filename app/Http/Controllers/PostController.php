<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;

use Illuminate\Support\Facades\File;


class PostController extends Controller
{


  public function index()
  {
    $posts = Post::paginate(20);
    return view('posts.index',compact('posts'));
  }


  public function create()
  {
    return view('posts.create')->with('categories',Category::get());
  }

  public function store(Request $request)
  {



    $rules = [
        'title' => 'required',
        'content' => 'required',
      ];
      $messages = [
        'title.required' => 'Title is Required',
        'content.required' => 'Content is Required',
      ];
      $this->validate($request,$rules,$messages);

    //   $city = Post::create($request->all());
        $post =  new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        if($request->hasfile('image'))
        {
            $file = $request->image;
            $file_extension = $file->getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $path = 'images/posts';
            $file->move($path,$file_name);
            $post->image = $file_name;
        }
        $post->save();

        return redirect(route('post.index'))->with('success', 'Post Added Successfully');
  }


  public function show($id)
  {

  }


  public function edit($id)
  {
    $categories = Category::all();
    $model = Post::findOrFail($id);
    return view('posts.edit',compact('model','categories'));
  }


  public function update(Request $request,$id)
  {
        $post =  Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        if($request->hasfile('image'))
        {
            $destination = 'images/posts/'.$post->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->image;
            $file_extension = $file->getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $path = 'images/posts/';
            $file->move($path,$file_name);
            $post->image = $file_name;
        }
        $post->update();
        return redirect(route("post.index"))->with('success', 'Post Updated Successfully');
  }

  public function destroy($id)
  {
    $post = Post::findOrFail($id);
    $destination = 'images/posts/'.$post->image;
    if(File::exists($destination))
    {
        File::delete($destination);
    }
    $post->delete();
    return redirect(route('post.index'))->with('danger', 'Post Deleted Successfully');
  }

}

?>
