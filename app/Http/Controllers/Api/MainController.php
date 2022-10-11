<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

use App\Models\Governorate;
use App\Models\City;
use App\Models\Post;
use App\Models\Category;
use App\Models\Setting;
use App\Models\BloodType;






class MainController extends Controller
{


    // governorates

    public function governorates()
    {
        $governorates = Governorate::all();
        return responsejson(1,'success',$governorates);
    }


    // cities

    public function cities(Request $request)
    {
        $cities = City::where(function($query) use($request){
            if($request->has('governorate_id'))
            {
                  $query->where('governorate_id',$request->governorate_id);
            }
        })->get();
        return responsejson(1,'success',$cities);
    }



    // posts

    public function posts()
    {
        $posts = Post::with('category')->paginate(10);
        return responsejson(1,'success',$posts);
    }


    //categories

    public function categories()
    {
        $categories = Category::all();
        return responsejson(1,'success',$categories);
    }

    //settings

    public function settings()
    {
        $settings = Setting::all();
        return responsejson(1,'success',$settings);
    }

    //contacts

    public function contacts()
    {
        $contacts = Contact::paginate(10);
        return responsejson(1,'success',$contacts);
    }

    //bloodTypes

    public function bloodTypes()
    {
        $bloodTypes = BloodType::paginate(10);
        return responsejson(1,'success',$bloodTypes);
    }


    // profile
    public function profile()
    {
        $validator = validator()->make($request->all(),[
            'phone' => 'required',
            'pasword' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails())
        {
            $data = $validator->errors();
            return responsejson(0,$validator->errors()->first(),$data);
        }

        $authuser = $request->user();
        $authuser->update($request->all());

        if($request->has('password'))
        {
            $request->merge(array('password'=>bcrypt($request->password)));
            $authuser->password = bcrypt($request->password);
        }

        return responsejson(1,'success');

    }


    // favourites

    public function favourites(Request $request)
    {
        $rules = ["post_id" => 'required|exists:posts'];
        $validator = validator()->make($request->all(),[$rules]);

        if($validator->fails())
        {
         return responsejson(0,$validator->errors()->first(),$validator->errors());
        }

        $fav = $equest->user()->posts->toggle($request->post_id);
        return responsejson(1,'success',$fav);
    }






}
