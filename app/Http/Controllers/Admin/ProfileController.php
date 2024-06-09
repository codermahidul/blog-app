<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPasswordUpdateSecondRequest;
use App\Http\Requests\AdminProfileUpdateRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;


class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.profile.index',compact('user'));
    }


    public function update(AdminProfileUpdateRequest $request, string $id)
    {
         $image = Auth::guard('admin')->user()->image;
            if ($request->file('image')) {
                unlink(base_path('public/'.$image));

                $manager = new ImageManager(new Driver);
                $image = $request->file('image');
                $name = 'avatar-'.Str::uuid().'.'.$image->getClientOriginalExtension();
                $img = $manager->read($image);
                $img= $img->resize(300,300);
                $img->save(base_path('public/uploads/'.$name));
                $image = 'uploads/'.$name;
            }

            $admin = Admin::findOrFail($id);
            $admin->image = $image;
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->save();
            toast(__('Profile update successfull.'),'success')->width(400);
            return back();
    }


    public function passwordUpdate(AdminPasswordUpdateSecondRequest $request, $id){
        $admin = Admin::findOrFail($id);
        $admin->password = Hash::make($request->password);
        $admin->save();
        toast(__('Password update successfull.'),'success')->width(400);
        return back();
    }

}
