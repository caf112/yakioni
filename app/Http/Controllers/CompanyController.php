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
        $companys = Company::all();
        $data = ['companys' => $companys];
        return view('companys.index', $data);
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
        return view('companys.create', $data);
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
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
        $company = new Company();
        $company->user_id = \Auth::id();
        $company->title = $request->title;
        $company->body = $request->body;
        $company->save();

        return redirect(route('companys.index'));
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
        return view('companys.show', $data);
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
        return view('companys.edit', $data);
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
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
        $company->title = $request->title;
        $company->body = $request->body;
        $company->save();
        return redirect(route('companys.show', $company));
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
        return redirect(route('companys.index'));
    }
}
