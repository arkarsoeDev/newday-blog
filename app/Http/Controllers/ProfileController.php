<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateEmailRequest;
use App\Http\Requests\Profile\UpdateInfoRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = request()->user();
        return view('dashboard.profile.index', compact(['user']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Profile\UpdateInfoRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInfoRequest $request, User $user)
    {
        $user->name = $request->username;

        if ($request->hasFile('profile_image')) {

            if(isset($user->profile_image)) {
                $photos = [
                    'public/uploads/' . $user->profile_image,
                    'public/thumbnails/small_' . $user->profile_image,
                ];
                // delete photo from storage
                Storage::delete($photos);
            }

            $newName = uniqid() . "_profile_image." . $request->file('profile_image')->extension();

            $thumbName = 'small_' . $newName;
            $img = $request->file('profile_image');
            $imgFile = Image::make($img->getRealPath());
            $destinationPath = public_path('storage/thumbnails/' . $thumbName);
            $imgFile->resize(150, 150)->save($destinationPath);

            $request->file('profile_image')->storeAs('public/uploads', $newName);
            $user->profile_image = $newName;
        }

        $user->update();

        return redirect()->route('dashboard.profile.index')->with([
            'message' => "Profile info is updated successfully",
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    /**
     * Update the user password.
     * @param  \App\Http\Requests\Profile\UpdatePasswordRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdatePasswordRequest $request, User $user)
    {
        $user->password = Hash::make($request->new_password);

        $user->update();

        return redirect()->route('dashboard.profile.index')->with([
            'message' => "Password is updated successfully",
            'status' => 'success'
        ]);
    }

    /**
     * Update the user email.
     *
     * @param  \App\Http\Requests\Profile\UpdateEmailRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateEmail(UpdateEmailRequest $request, User $user)
    {
        $user->email = $request->email;
        $user->update();

        return redirect()->route('dashboard.profile.index')->with([
            'message' => "Email is updated successfully",
            'status' => 'success'
        ]);
    }
}
