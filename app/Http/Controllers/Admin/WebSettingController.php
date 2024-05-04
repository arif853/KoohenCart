<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Models\Socialinfo;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class WebSettingController extends Controller
{

    public function webInfo()
    {
        return view('admin.profile.webinfo');
    }

    public function webInfoUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'appName' => 'required|string|max:255',
            'ownerName' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'startDate' => 'nullable|date',
            'weblogo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'webfavicon' => 'nullable|mimes:jpeg,png,jpg,ico|max:2048', // Max 2MB
        ]);

        // Handle file uploads
        if ($request->hasFile('weblogo')) {

            $logo = $request->file('weblogo');

            $manager = new ImageManager(new Driver());
            $logoName =  time() .  '.' . $logo->getClientOriginalExtension();

            $img = $manager->read($logo);

            $logoPath = 'logos/' . $logoName;

            Storage::disk('public')->put($logoPath , (string)$img->encode());

            $validatedData['weblogo'] = $logoName;
        }

        if ($request->hasFile('webfavicon')) {

            $favicon = $request->file('webfavicon');

            $manager = new ImageManager(new Driver());
            $faviconName =  time() .  '.' . $favicon->getClientOriginalExtension();

            $img = $manager->read($favicon);

            $faviconPath = 'favicons/' . $faviconName;

            Storage::disk('public')->put($faviconPath , (string)$img->encode());

            $validatedData['webfavicon'] = $faviconName;
        }

        // Create or update user profile
        // For example:
        UserProfile::updateOrCreate(['id' => $request->user_id], $validatedData);
        Session::flash('success','Your App info updated.');
        return redirect()->back();
    }

    public function socialInfo(): View
    {
        return view('admin.profile.social');
    }

    public function SocialInfoUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'appPhone' => 'required|string|max:255',
            'appEmail' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:255',
            'facebook' => 'nullable|url|max:255',
            'instragram' => 'nullable|url|max:255',
            'linkednIn' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'youtube' => 'nullable|url',
            'copyright' => 'nullable|string',
        ]);

        Socialinfo::updateOrCreate(
            [
                'id' => $request->socialInfo_id,
            ],
            $validatedData);
        Session::flash('success','Your Social info updated.');
        return redirect()->back();
    }
}
