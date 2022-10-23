<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Client;

use Illuminate\Support\Str;

use Hash;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Mail;

use App\Mail\ResetPassword;

use App\Models\BloodType;
use App\Models\Token;



class AuthController extends Controller
{

    // register
    public function register(Request $request)
    {
       $validator = Validator::make($request->all(),[
          'name' => 'required',
          'phone' => 'required',
          'email' => 'required|unique:clients',
          'blood_type_id' => 'required',
          'password' => 'required',
          'd_o_b' => 'required',
          'last_donation_date' => 'required',
          'city_id' => 'required',
       ]);

       if($validator->fails())
       {
        return responsejson(0,$validator->errors()->first(),$validator->errors());
       }

       $request->merge(['password' => bcrypt($request->password)]);
       $client = Client::create($request->all());
       $client->api_token = Str::random(60);
       $client->save();
       $client->governorate()->attach($client->city->governorate_id);
       $client->bloodType()->attach($request->blood_type_id);

       return responsejson(1,'client added successfuly',[
        'api_token' => $client->api_token,
        'client' => $client
       ]);

    }


    // login


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'phone' => 'required',
            'password' => 'required',
         ]);

         if($validator->fails())
         {
          return responsejson(0,$validator->errors()->first(),$validator->errors());
         }

         $client = Client::where('phone',$request->phone)->first();
         if($client)
         {
              $correctpassword = Hash::check($request->password,$client->password);
              if($correctpassword)
              {
                $newtoken = Str::random(60);
                $client->update([
                    'api_token' => $newtoken,
                ]);

                return responsejson(1,'loggedin successfully',[
                    'api_token' => $newtoken,
                    'client' => $client
                ]);
              }
              else
              {
                return responsejson(0,'password is wrong');
              }
         }
         else
         {
            return responsejson(0,'this number dose not exist');
         }

    }


    // new password


    public function newPassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'pin_code' => 'required',
            'password' => 'required',
        ]);

         if($validator->fails())
         {
          return responsejson(0,$validator->errors()->first(),$validator->errors());
         }

         $client = Client::where('pin_code',$request->pin_code)->where('pin_code','!=',0)->first();


         if($client){

        $client->password = bcrypt($request->password);
        $client->pin_code = null;

        if($client->save())
        {
            return responsejson(1,'password updated');
        }
        else
        {
           return responsejson(1,' error try again');
        }
    }
    else
    {
        return responsejson(0,'wrong pin code');
    }
  }



    // reset password


    public function resetPassword(Request $request)
    {
       $validator = Validator::make($request->all(),[
             'phone' => 'required'
       ]);

       if($validator->fails()){
           $data = $validator->errors();
           return responsejson(0,$validator->errors()->first(),$data);
       }

       $client = Client::where('phone',$request->phone)->first();

       if($client)
       {
           $pincode = rand(1111,9999);
           $update_client = $client->update([
                'pin_code' => $pincode,
           ]);

           if($update_client)
           {

            //sms
            // smsMisr($request->phone,"your reset code is :".$pin_code);




            //mail
               Mail::to($client->email)
               ->bcc('amrtarekaleraki@gmail.com')
               ->send(new ResetPassword($pincode));

               return responsejson(1,'please check your phone',['pin_code_for_test' => $pincode]);
           }
           else
           {
               return responsejson(0,'error');
           }
       }
       else
       {
           return responsejson(0,'no account related to this phone');
       }
   }



   public function logout(Request $request)
   {
    $api_token = $request->header('api_token');
    $client = Client::where('api_token',$api_token)->first();

    $client->update([
         'api_token' => null
    ]);
    return responsejson(1,"loggedout successfully");
   }


   public function registerDeviceToken(Request $request)
   {
    $validator = Validator::make($request->all(),[
        'token' => 'required',
        'type' => 'required|in:andorid,ios',
     ]);

     if($validator->fails()){
        $data = $validator->errors();
        return responsejson(0,$validator->errors()->first(),$data);
    }

    Token::where('token',$request->token)->delete();
    $request->user()->tokens()->create($request->all());

    return responsejson(1,"token created successfully");
}




public function removeDeviceToken(Request $request)
{
 $validator = Validator::make($request->all(),[
     'token' => 'required',
  ]);

  if($validator->fails()){
     $data = $validator->errors();
     return responsejson(0,$validator->errors()->first(),$data);
 }

 Token::where('token',$request->token)->delete();

 return responsejson(1,"deleted successfully");

}





}
