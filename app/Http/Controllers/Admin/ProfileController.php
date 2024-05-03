<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        return view("admin.profile");
    }

    // public function store(Request $request){
        
    //     $validation = Validator::make($request->all(),[
    //         "name"=> "required",
    //         "email"=> 'string|max:255',
    //         "twitter_link"=> 'string|max:255',
    //         "fb_link"=> 'string|max:255',
    //         "insta_link"=> 'string|max:255',
    //         // "password"  => "required",
    //         "image" => "mimes:jpeg,png",
    //     ]);

    //     if($validation->fails()){
    //         return response()->json(['status'=>400,'message'=> $validation->errors()->first()]);
    //     }else{
    //         if ($request->hasFile('image')) {
    //             $image_name = $request->name.time().'.'. $request->image->extension();
    //             $request->image->move(public_path('images/'),$image_name);
    //             $data['image'] = $image_name;
    //         }
    //         $user = User::updateOrCreate(
    //             ['id'=>Auth::User()->id],
    //             ['name'=>$request->name,'email'=>$request->email,'image'=>$request->image,'address'=>$request->address],
    //             ['twitter_link'=>$request->twitter_link,'insta_link'=>$request->insta_link,'fb_link'=>$request->fb_link]
                
    //         );
    //     }
    // }

    public function store(Request $request) {
        
        $validation = Validator::make($request->all(), [
            "name" => "required",
            "email" => 'required|string|email|unique:users,email,' . Auth::user()->id,

            "twitter_link" => 'string|max:255',
            "fb_link" => 'string|max:255',
            "insta_link" => 'string|max:255',
            // "password"  => "required",
            "image" => "mimes:jpeg,png",
        ]);
    
        if ($validation->fails()) {
            return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
         
        } else {
            if ($request->hasFile('image')) {
                $image_name = 'images/' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/'), $image_name);
                $data['image'] = $image_name;
            }
            Log::info('no in if condition update function');
            $user = User::updateOrCreate(
                ['id' => Auth::user()->id],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'image' => $image_name,
                    'address' => $request->address,
                    'twitter_link' => $request->twitter_link,
                    'insta_link' => $request->insta_link,
                    'fb_link' => $request->fb_link
                ]
            );
            Log::info('no in the update function');
            // $user = User::updateOrCreate(
            //     ['id' => Auth::user()->id],
            //     ['name' =>$request->name, 'email' =>$request->email,'image'=> $request->image, 'address' =>$request->address],
            //     ['twitter_link' =>$request->twitter_link, 'insta_link' => $request->insta_link, 'fb_link' => $request->fb_link]
            // );
            return response()->json(['status'=>200,'message'=>'Successfully updated']);
        } 
    }
    
}
