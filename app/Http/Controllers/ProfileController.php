<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
            if (config('filesystems.default') === 'cloudinary') {
                if ($user->profile_picture && str_contains($user->profile_picture, 'cloudinary')) {
                    $publicId = basename($user->profile_picture, '.' . pathinfo($user->profile_picture, PATHINFO_EXTENSION));
                    try {
                        Cloudinary::destroy($publicId);
                    } catch (\Exception $e) {
                    }
                }
                
                $uploadedFile = Cloudinary::upload($request->file('profile_picture')->getRealPath(), [
                    'folder' => 'profiles',
                    'transformation' => [
                        'width' => 400,
                        'height' => 400,
                        'crop' => 'fill'
                    ]
                ]);
                $data['profile_picture'] = $uploadedFile->getSecurePath();
            } else {
                if ($user->profile_picture && !str_contains($user->profile_picture, 'cloudinary')) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
                $data['profile_picture'] = $request->file('profile_picture')->store('profiles', 'public');
            }
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}
