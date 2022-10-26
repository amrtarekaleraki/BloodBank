<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(20);
        return view('users.index',compact('users'));
    }


    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
          ];
          $messages = [
            'email.required' => 'email is Required',
            'password.required' => 'password is Required',
          ];
          $this->validate($request,$rules,$messages);

            $user = User::create($request->all());
            return redirect(route('user.index'))->with('success', 'User Added Successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
      $model = User::findOrFail($id);
      return view('users.edit',compact('model'));
    }


    public function update(Request $request,$id)
    {
      $record = User::findOrFail($id);
      $record->update($request->all());
      return redirect(route("user.index"))->with('success', 'user Updated Successfully');
    }


    public function destroy($id)
    {
      $user = User::findOrFail($id);
      $user->delete();
      return redirect(route('user.index'))->with('danger', 'user Deleted Successfully');
    }
}
