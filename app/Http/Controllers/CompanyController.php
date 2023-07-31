<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use App\Http\Middleware\HandleInertiaRequests;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Companies/Index', [
            'companies' => Company::orderBy('name')->get()
        ]);
    }

    public function search($searchKey) {
        return inertia('Companies/Index', [
            'companies' => Movie::where('name', 'like', "%$searchKey%")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Companies/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            "email" => "required",
            'address' => 'required'

        ]);

        $fileName = null;


        if($request->pic){
            $fileName = time().'.'.$request->pic->extension();
            $request->pic->move(public_path('images/product_pics'), $fileName);
            $fields['pic'] = $fileName;
        }

        $Company = Company::create([
            "user_id" => auth()->id(),
            "name" => $request->name,
            "description" => $request->description,
            "address" => $request->address,
            "email" => $request->email,
            "pic" => $fileName,
        ]);

        return redirect('/companies');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $user = auth()->user();
        return inertia('Companies/Show', [
            'company' => $company,
            'user' => $user
        ]);
    }

    public function toggle(Company $company) {
        $company->enabled = !$company->enabled;
        $company->save();
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return inertia('Companies/Edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {

        $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
            'email' => 'string|required',
            'address' => 'string|required'
        ]);

        $movie->update($request->all());

        return redirect('/companies');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $movie->delete();
        return redirect('/companies')->with('Info', 'Company has just been deleted!.');

    }
    public function pdf() {
        $companies = Company::all();
        $pdf = PDF::loadView('pdf.company', compact('companies'));

        return $pdf->stream();
    }

    public function email(Company $company) {
        $companies = Company::all();
        $pdf = PDF::loadView('pdf.company', compact('companies'));

        $filename = 'statements/' . $company->name . "_" . $company->id . ".pdf";
        $pdf->save($filename);

        Mail::send('email.soa', ['company'=>$company], function($message) use ($company, $filename){
            $message->to($company->email);
            $message->subject('Companies');
            $message->attach($filename);
        });

        return back();
      }
}
