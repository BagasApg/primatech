<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Gender;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $request)
    // {
    //     dd("oit");
    //     return Validator::make($request, [
    //         'username' => ['required', 'string', 'max:255'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'date_of_birth' => ['required', 'date'],
    //         'gender' => ['required', Rule::enum(Gender::class)],
    //         'address' => ['required', 'string', 'max:255'],
    //         'city' => ['required'],
    //         'contact' => ['required', 'string'],
    //         'paypal' => ['required', 'string']
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function store(Request $request)
    {
        $this->validate($request, [
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'DOB' => ['required'],
            'gender' => ['required'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required'],
            'contact' => ['required', 'string'],
            'paypal' => ['required', 'string']
        ]);


        // dd($request);

        User::create([
            'name' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'date_of_birth' => $request['DOB'],
            'gender' => $request['gender'],
            'address' => $request['address'],
            'city' => $request['city'],
            'contact' => $request['contact'],
            'paypal_id' => $request['paypal'],
        ]);

        return redirect()->route('login')->with('success', "Successfully create new account, please login correctly");
    }

    public function province(Request $request)
    {
        $province_id = $request->input('province_id');

        $cities = Wilayah::whereRaw('kode = 37 AND LENGTH(kode) < 6')->get();
        dd($cities);

        foreach ($cities as $data) {
            echo "<option value='$data[kode]'>$data[nama]</option>";
        }
    }
}
