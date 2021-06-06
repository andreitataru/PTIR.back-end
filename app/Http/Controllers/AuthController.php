<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use google\apiclient;

//import auth facades
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'username' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        try {
            
            $user = new User;
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);
            $user->avatar = 'https://storage.cloud.google.com/ptr-pti-cdn/avatars/user.jpeg';

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }


    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
          //validate incoming request 
          
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        $user = Auth::user();
        if ($user->created_at == $user->updated_at){
            return $this->respondWithToken($token, true);
        }
        else{
            return $this->respondWithToken($token, false);
        }

    }

    public function googleSignIn(Request $request)
    {
        if (!User::where('googleId' , '=' , $request->googleId)->exists()){
            try {
                $user = new User;
                $user->googleId = $request->googleId;
                $user->username = $request->username;
                $user->email = $request->email;
                $plainPassword = uniqid();
                $user->password = app('hash')->make($plainPassword);
                $user->avatar = 'https://storage.cloud.google.com/ptr-pti-cdn/avatars/user.jpeg';
                $user->save();

                //return successful response
                return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

            } catch (\Exception $e) {
                //return error message
                return response()->json(['message' => 'User Registration Failed!'], 409);
            }
        }
        else{
            $user = User::where('googleId' , '=' , $request->googleId)->first();
            try {

                $token = Auth::login($user, true);
                $user = Auth::user();
                if ($user->created_at == $user->updated_at){
                    return $this->respondWithToken($token, true);
                }
                else{
                    return $this->respondWithToken($token, false);
                }
    
            } 
            catch (JWTException $e) {
                throw new HttpException(500);
            }
        }

    }


}