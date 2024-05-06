<?php

namespace App\Http\Controllers\Admin;

use App\Models\Webmessage;
use App\Mail\Webmessagemail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class WebmessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Webmessage::all();
        return view('admin.websetting.webmessage',compact('messages'));
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
        $request->validate([
            'name' => 'required|string',
            'email' =>'required|email',
            'phone' => 'required',
            'subject' =>'required',
            'message' =>'required',
            'captcha' => 'required|captcha'
        ]);

        $data = Webmessage::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'subject'=> $request->subject,
            'message'=> $request->message,
        ]);
        // Mail::to('qbittech.dev@gmail.com')->send(new Webmessagemail($data));

        return redirect()->back()->with('success','Message sent successfully, We will contact with you soon.');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $message = Webmessage::findOrfail($id);

            $message->delete();
            Session::flash('success','Message has been deleted successfully!!');
            return redirect()->back();

        } catch (\Throwable $th) {
            throw $th;
            Session::flash('success', $th);
            return redirect()->back();
        }

    }
}
