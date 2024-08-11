<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        $data = ['companies' => $companies];
        return view('companies.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = new Company();
        $data = ['company' => $company];
        return view('companies.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);
        $company = new Company();
        $company->user_id = \Auth::id();
        $company->name = $request->name;
        $company->status = $request->status;
        $company->tag = $request->tag;
        $company->place = $request->place;
        $company->url = $request->url;
        $company->comment = $request->comment;
        $company->save();

        return redirect(route('companies.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $data = ['company' => $company];
        return view('companies.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $this->authorize($company);
        $data = ['company' => $company];
        return view('companies.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $this->authorize($company);
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);
        $company->name = $request->name;
        $company->status = $request->status;
        $company->tag = $request->tag;
        $company->place = $request->place;
        $company->url = $request->url;
        $company->comment = $request->comment;
        $company->save();
        return redirect(route('companies.show', $company));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $this->authorize($company);
        $company->delete();
        return redirect(route('companies.index'));
    }
}
