<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFunctionaryRequest;
use App\Http\Requests\UpdateFunctionaryRequest;
use App\Models\Functionary;

class FunctionaryController extends Controller
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
     * @param  \App\Http\Requests\StoreFunctionaryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFunctionaryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Functionary  $functionary
     * @return \Illuminate\Http\Response
     */
    public function show(Functionary $functionary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Functionary  $functionary
     * @return \Illuminate\Http\Response
     */
    public function edit(Functionary $functionary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFunctionaryRequest  $request
     * @param  \App\Models\Functionary  $functionary
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFunctionaryRequest $request, Functionary $functionary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Functionary  $functionary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Functionary $functionary)
    {
        //
    }
}
