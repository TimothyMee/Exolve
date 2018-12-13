<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request, User $user)
    {
        try
        {
            $validatedData = $request->validate([
                'name' => 'required|string| max:100',
                'email' => 'required|email',
                'phone' => 'required',
                'password' => 'required|confirmed|min:5'
            ]);
            $newUser = $user->createNew($validatedData);
            return redirect()->intended(route('home'));

        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error',  $e);
        }
    }

    public function postLogin(Request $request)
    {
        $data = $request->all();
        try{
            if (auth()->attempt(['email' => $data['email'], 'password' => $data['password'], 'is_active' => 1])) {
                if (auth()->user()->role == "user")
                {
                    return redirect()->intended(route('dashboard'));
                }
            }
            return redirect()->back()->with('error', 'Identification No and Password Combination Incorrect')->withInput();
        } catch (\Exception $e)
        {
            /*Send us a mail */
            return redirect()->back()->with('error', 'Could not sign you in at the moment. Please try again...');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }


    public function edit(Request $request, User $user)
    {
        try
        {
            $validatedData = $request->validate([
                'username' => 'max:100',
                'email' => 'email',
            ]);

            /**Processing profile image*/
            $fileName = Carbon::now()->timestamp .'-' .auth()->user()->name;
            $filepath = storage_path('app/public/images');

            $file = $request->file('image');
            $fileName = $fileName.$file->getClientOriginalName();
            $result = $file->move($filepath,$fileName);


            /** Save image*/
            if ($result){
                $request = $request->all();
                $request['image'] = asset('storage/images/'. $fileName);

                $user->edit($request);
                return redirect()->back()->with('
                ', 'Profile Edited Successfully');
            }
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error',  $e);
        }
    }

    public function getAll()
    {
        $user = new User();
        $result = $user->getAll();

        return apiSuccess($result, 'Fetched Data Successfully', 200);
    }
}
