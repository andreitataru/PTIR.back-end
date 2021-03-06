<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
     /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile(Request $request)
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function allUsers(Request $request)
    {   
        $user = Auth::user();
        if ($user->accountType == "Admin"){
            return response()->json(['users' =>  User::all()], 200);
        }
    }


    public function updateUser(Request $request)
    {
        $user = Auth::user();

        if ($user->created_at == $user->updated_at){
            $this->validate($request, [
                'accountType' => 'required',
                'name' => 'required',
                'birthDate' => 'required',
                'bankAccountNumber' => 'required',
                'cellphoneNumber' => 'required',
                'address' => 'required',
                //'gender' => 'required'
            ]);
        }

        if ($request->filled("accountType")){
            if (!($request->accountType == "Student" || $request->accountType == "Host" || $request->accountType == "ServiceProvider")) {
                return response()->json([
                    'status' => 'Account type not allowed'
                ], 400);
            }
            $user->accountType = $request->accountType;
        }
        if ($request->filled("name")){
            $user->name = $request->name;
        }
        if ($request->filled("gender")){
            $user->gender = $request->gender;
        }
        if ($request->filled("birthDate")){
            $user->birthDate = $request->birthDate;
        }
        if ($request->filled("bankAccountNumber")){
            $user->bankAccountNumber = $request->bankAccountNumber;
        }
        if ($request->filled("cellphoneNumber")){
            $user->cellphoneNumber = $request->cellphoneNumber;
        }
        if ($request->filled("address")){
            $user->address = $request->address;
        }

        if ($request->filled("password")){
            $user->password = app('hash')->make($request->password);
        }

        if ($request->filled("avatar")){
            
            $avatarName = 'a'.$user->id.'.'.'jpeg';
            $path = 'uploads/avatars/' . $avatarName;
            Image::make(file_get_contents($request->avatar))->save($path); 
            $user->avatar = url('/') . '/' . $path;
        }
        

        if(!$user->save()) {
            throw new HttpException(500);
        }
        else {
            return response()->json([
                'status' => 'User Updated'
            ], 200);
        }
    }

    public function checkToken(){
        $user = Auth::user();

        return response()->json([
            'status' => 'Token Valid',
            'accountType' => $user->accountType,
            'accountId' => $user->id,
            'name' => $user->name
        ], 200);
    }

}

