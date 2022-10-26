<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;

class ContactController extends Controller
{


  public function index()
  {
    $contacts = Contact::all();
    return view('contacts.index',compact('contacts'));
  }


  public function create()
  {

  }


  public function store(Request $request)
  {

  }


  public function show($id)
  {

  }


  public function edit($id)
  {

  }

  public function update($id)
  {

  }


  public function destroy($id)
  {
    $contact = Contact::findOrFail($id);
    $contact->delete();
    return redirect(route('contact.index'))->with('danger', 'contact Deleted Successfully');
  }

}

?>
