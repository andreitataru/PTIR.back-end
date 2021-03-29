<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use  App\Models\User;

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
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function allUsers()
    {
         return response()->json(['users' =>  User::all()], 200);
    }

    /**
     * Get one user.
     *
     * @return Response
     */
    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json(['user' => $user], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
        }

    }

    public function updateUser(Request $request)
    {
        $user = Auth::user();

        if (!($request->accountType == "Student" || $request->accountType == "Host" || $request->accountType == "ServiceProvider")) {
            return response()->json([
                'status' => 'Account type not allowed'
            ], 400);
        }
        
        if ($request->filled("accountType")){
            $user->accountType = $request->accountType;
        }
        if ($request->filled("name")){
            $user->name = $request->name;
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

        //if ($request->filled("avatar")){
        $avatarName = 'a'.$user->id.'.'.request()->avatar->getClientOriginalExtension();
        $file = $request->file('avatar');
        $destinationPath = 'uploads';
        $file->move($destinationPath, $avatarName);
        $user->avatar = $avatarName;
        //}

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
            'accountType' => $user->accountType
        ], 200);
    }

}

