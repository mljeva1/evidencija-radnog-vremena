<?php

namespace App\Http\Controllers;

use App\Models\Company_profile;
use App\Http\Requests\StoreCompany_profileRequest;
use App\Http\Requests\UpdateCompany_profileRequest;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company_profile::query();
        $companies = $companies->paginate();
        return view('company_profiles.index', ['companies' => $companies]);
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
    public function store(StoreCompany_profileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company_profile $company_profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company_profile $company_profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompany_profileRequest $request, Company_profile $company_profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company_profile $company_profile)
    {
        //
    }
}
