<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;

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
        'title' => 'required'
      ];
      $messages = [
        'title.required' => 'Name is Required'
      ];
      $this->validate($request,$rules,$messages);

      $city = Post::create($request->all());

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
    $record = Post::findOrFail($id);
    $record->update($request->all());
    return redirect(route("psot.index"))->with('success', 'Post Updated Successfully');
  }

  public function destroy($id)
  {
    $post = Post::findOrFail($id);
    $post->delete();
    return redirect(route('post.index'))->with('danger', 'Post Deleted Successfully');
  }

}

?>
