<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);
        
        $credentials = $request->only("email", "password");
        
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route("home"));
        }
        
        return redirect(route("login"))->with('error', 'Login Fail');
    }

    function register()
    {
        return view('auth.register');
    }

    function registerPost(Request $request)
    {
        $request->validate([
            "fullname" => "required",
            "email" => "required",
            "password" => "required"
        ]);

        $user = new User();
        $user->name =  $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($user->save())
        {
            return redirect(route("login"))->with("success", "Registered Successful");
        }
        return redirect(route("register"))->with("error", "Fail to Register");
    }

    function insertProducts()
    {
        return view('welcome');
    }

    function insertProductsPost(Request $request)
    {
        $request->validate([
            "name" => "required",
            "slug" => "required",
            "price" => "required"
        ]);

        $product = new Products();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->price = $request->price;

        if($product->save())
        {
            return "Product Created Successful";
        }
        return "Fail to Create";
    }

    function updateProductsPost(Request $request)
    {
        $request->validate([
            "name" => "required",
            "slug" => "required",
            "price" => "required"
        ]);

        $product = Products::where('slug', $request->slug)->first();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->price = $request->price;

        if($product->save())
        {
            return "Product update Successful";
        }
        return "Fail to Create";
    }

    function deleteProduct($id)
    {
        $product = Products::where('id', $id)->first();
        $product->delete();
        return "Product delete Successful";
    }

}
