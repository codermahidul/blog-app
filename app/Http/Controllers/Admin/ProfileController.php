<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPasswordUpdateSecondRequest;
use App\Http\Requests\AdminProfileUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.profile.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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
            return back()->with('success', __('Profile update successfull.'));
    }


    public function passwordUpdate(AdminPasswordUpdateSecondRequest $request, $id){
        $admin = Admin::findOrFail($id);
        $admin->password = Hash::make($request->password);
        $admin->save();

        return back()->with('success', __('Password update successfull'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
