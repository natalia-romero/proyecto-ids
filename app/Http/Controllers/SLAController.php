<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSLARequest;
use App\Http\Requests\UpdateSLARequest;
use App\Models\SLA;

class SLAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSLARequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSLARequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SLA  $sLA
     * @return \Illuminate\Http\Response
     */
    public function show(SLA $sLA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SLA  $sLA
     * @return \Illuminate\Http\Response
     */
    public function edit(SLA $sLA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSLARequest  $request
     * @param  \App\Models\SLA  $sLA
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSLARequest $request, SLA $sLA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SLA  $sLA
     * @return \Illuminate\Http\Response
     */
    public function destroy(SLA $sLA)
    {
        //
    }
}
