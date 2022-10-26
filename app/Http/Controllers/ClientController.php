<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\BloodType;
use App\Models\City;

class ClientController extends Controller
{


  public function index()
  {
    $clients = Client::paginate(20);
    return view('clients.index',compact('clients'));
  }


  public function create()
  {
    return view('clients.create')->with('bloodtype',BloodType::get())->with('cities',City::get());
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

        $client = Client::create($request->all());
        return redirect(route('client.index'))->with('success', 'Client Added Successfully');
  }


  public function show($id)
  {

  }


  public function edit($id)
  {
    $bloodtype = BloodType::all();
    $cities = City::all();
    $model = Client::findOrFail($id);
    return view('clients.edit',compact('model','bloodtype','cities'));
  }


  public function update(Request $request,$id)
  {
    $record = Client::findOrFail($id);
    $record->update($request->all());
    return redirect(route("client.index"))->with('success', 'Client Updated Successfully');
  }


  public function destroy($id)
  {
    $client = Client::findOrFail($id);
    $client->delete();
    return redirect(route('client.index'))->with('danger', 'client Deleted Successfully');
  }

}

?>
