<?php

namespace App\Http\Controllers\Admin;

use App\Models\WebInfo;
use Illuminate\View\View;
use App\Models\Socialinfo;
use App\Models\Contactinfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
            'description' => 'Required|string',
            'weblogo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'footerlogo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'webfavicon' => 'nullable|mimes:jpeg,png,jpg,ico|max:2048', // Max 2MB
            'marquee' => 'nullable|string|max:255',
            'copyright' => 'required',
            'entitle' => 'nullable|string|max:255'
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

        if ($request->hasFile('footerlogo')) {

            $Flogo = $request->file('footerlogo');

            $manager = new ImageManager(new Driver());
            $FlogoName =  'footer_' . time() .  '.' . $Flogo->getClientOriginalExtension();

            $img = $manager->read($Flogo);

            $logoPath = 'logos/' . $FlogoName;

            Storage::disk('public')->put($logoPath , (string)$img->encode());

            $validatedData['footerlogo'] = $FlogoName;
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
        WebInfo::updateOrCreate(['id' => $request->user_id], $validatedData);
        Session::flash('success','Your App info updated.');

        return redirect()->back();
    }

    public function socialInfo(): View
    {
        return view('admin.profile.social');
    }

    public function SocialInfoUpdate(Request $request)
    {
        $rules = [
            'title_value' => 'required|array',
            'title_value.*' => 'required|string',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules);

        // Extract data from the request
        $socialTitles = $request->input('social_title');
        $titleValues = $request->input('title_value');

        // Loop through the social titles and update or create records in the database
        foreach ($socialTitles as $index => $socialTitle) {
            Socialinfo::updateOrCreate(
                ['social_title' => $socialTitle],
                ['title_value' => $titleValues[$index]]
            );
        }

        // Flash a success message
        Session::flash('success', 'Your Social info has been updated.');

        // Redirect back
        return redirect()->back();
    }

    public function socialInfoStatusUpdate(Request $request)
    {
        $social = Socialinfo::find($request->id);

        if ($social) {
            $social->status = $social->status == 1 ? 0 : 1;
            $social->save();

            Session::flash('success', 'Status Updated.');
        }
        else {
            Session::flash('error', 'Item not found.');
        }

        return response()->json(200);

        // dd($social);
    }

    public function contactindex()
    {
        $data = Contactinfo::all();
        return view('admin.profile.contactinfo',compact('data'));
    }

    public function contactInfoEdit(Request $request)
    {
        $data = Contactinfo::find($request->id);

        return response()->json(['status'=> 200, 'data' => $data]);
    }

    public function contactInfoUpdate(Request $request)
    {
        $data = Contactinfo::find($request->id);

        $rules = [
            'phone' => 'required|string',
            'whatsapp' => 'required|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'officehour' => 'nullable|string',
        ];
        $validator = Validator::make($request->all(),$rules);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            // WebInfo::updateOrCreate(['id' => $request->user_id], $validatedData);
            $data->update([
                'phone' => $request->phone,
                'whatsapp' => $request->whatsapp,
                'email' => $request->email,
                'address' => $request->address,
                'officehour' => $request->officehour,
            ]);
            // dd($data);

            Session::flash('success','Contact Info data has been updated .');
            return response()->json(['status'=>200]);
        }

    }
}
