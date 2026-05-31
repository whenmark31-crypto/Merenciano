<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email,' . $user->id,
            'phone'           => 'nullable|string|max:20',
            'address'         => 'nullable|string|max:500',
            'gender'          => 'nullable|in:Male,Female,Other',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password'        => 'nullable|min:6|confirmed',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'address', 'gender']);

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageData = file_get_contents($image->getRealPath());
            $base64 = base64_encode($imageData);
            $mimeType = $image->getMimeType();
            $data['profile_picture_base64'] = 'data:' . $mimeType . ';base64,' . $base64;
            $data['profile_picture'] = 'base64';
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}
