<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wilayah;
use App\Models\UserProfiles;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
// use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    public function admin(){
        $users = UserProfiles::get();

        return view('admin.users.index', compact('users'));
    }

    public function create(){
        $provinces = Wilayah::whereRaw('LENGTH(kode) < 3')->get();
        return view('admin.users.create', compact('provinces'));
    }

    public function store(Request $request){
        $request->validate([
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


        return redirect()->route('admin.user.index')->with('success', "Successfully created new account, please login correctly");
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

    public function show(UserProfiles $user){
        
        $province = Wilayah::where('kode', '=', $user->province_id)->get();
        $city = Wilayah::where('kode', '=', $user->city_id)->get();
        
        // dd($city);
        return view('admin.users.show', compact('user','province', 'city'));
    }

    public function delete($id){
        $user = UserProfiles::find($id);
        $acc = User::find($user->user_id);
        // dd($acc);with('success', "Successfully deleted a product")

        $user->delete();
        $acc->delete();
        return redirect()->route('admin.user.index')->with('success', "Successfully deleted a user");
    }
}
