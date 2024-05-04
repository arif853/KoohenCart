<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\SeoSetting;
use App\Models\Socialinfo;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // return view('admin.profile.index',[
        //     'user' => $request->user(),
        // ]);
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function SEOUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'seoTitle' => 'required|string|max:255',
            'seoLogo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'seoDescription' => 'required|string|max:255',
        ]);

        if ($request->hasFile('seoLogo')) {

            $logo = $request->file('seoLogo');

            $manager = new ImageManager(new Driver());
            $logoName =  time() .  '.' . $logo->getClientOriginalExtension();

            $img = $manager->read($logo);

            $logoPath = 'Seologos/' . $logoName;

            Storage::disk('public')->put($logoPath , (string)$img->encode());

            $validatedData['seoLogo'] = $logoName;
        }

        SeoSetting::updateOrCreate(
            [
                'id' => $request->socialInfo_id,
            ],
            $validatedData
        );
        Session::flash('success','Your SEO info updated.');
        return redirect()->back();
    }
}
