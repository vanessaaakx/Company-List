<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Admin/Email');
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
        //
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
        //
    }

    public function sendEmailToAllCompanies(Request $request) {
        // $email = company::pluck('email');

        $company = Company::all();

        if ($request->message != null && $request->subject != null) {
            $subject = $request->subject;
            $content = $request->message;

            foreach ($company as $co) {
                $name = $co->name;


                $email      = $co->email;

                Mail::send('email.bulk-mail', ['content' => $content, 'company' => $name], function($message) use ($subject, $email, $name) {
                    $message->to($email, $name);
                    $message->subject($subject);
                });
            }
        } else {
            return back()->with('error', 'Field Should Not be Empty.');
        }

        return back()->with('success', 'Emails are sent successfully.');
    }
}
