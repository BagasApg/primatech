<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfiles;
use App\Models\Wilayah;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Termwind\Components\Raw;

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
    public function showRegistrationForm()
    {
        $provinces = Wilayah::whereRaw('LENGTH(kode) < 3')->get();
        return view('auth.register', compact('provinces'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function store(Request $request)
    {
        // validate input form
        // dd($request);
        $this->validate($request, [
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user_profiles'],
            'DOB' => ['required'],
            'gender' => ['required'],
            'address' => ['required', 'string', 'max:255'],
            'province_id' => ['required'],
            'city_id' => ['required'],
            'contact' => ['required', 'string'],
            'paypal' => ['required', 'string']
        ]);

        // create an new account 
        $user = new User();
        $user->name = $request->username;
        $user->password = $request->password;
        $user->save();

        // create the user profile for new account
        $user_profiles = new UserProfiles();
        $user_profiles->user_id = $user->id;
        $user_profiles->email = $request->email;
        $user_profiles->date_of_birth = $request->DOB;
        $user_profiles->gender = $request->gender;
        $user_profiles->address = $request->address;
        $user_profiles->province_id = $request->province_id;
        $user_profiles->city_id = $request->city_id;
        $user_profiles->contact = $request->contact;
        $user_profiles->paypal_id = $request->paypal;
        $user_profiles->save();


        return redirect()->route('login')->with('success', "Successfully created new account, please login correctly");
    }

    public function province(Request $request)
    {
        $province_id = $request->input('province_id');

        $cities = Wilayah::where('kode', 'like', $province_id . '.%')->whereRaw("LENGTH(kode) = LENGTH('$province_id.00')")->get();

        echo "<option selected>Choose City</option>";
        foreach ($cities as $data) {
            echo "<option value='$data[kode]'>$data[nama]</option>";
        }
    }
}
