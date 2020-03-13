<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Country;
use App\Mail\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $countries = Country::all();

        return view('auth.register', compact('countries'));
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            //'photo' => 'required|photo|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $userData = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'country_id' => $data['country_id'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'photo' => $this->saveImg($data),
        ]);

        Mail::to($userData['email'])->send(
            new UserRegistered('Success')
        );

        return $userData;
    }

    private function saveImg($data)
    {
        if(isset($data['photo'])) {
            $image = $data['photo'];
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/images/', $name);
            return $name;
        }
    }
}
