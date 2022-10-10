<?php

namespace App\Http\Controllers;

use App\Models\Responsavel;
use App\Http\Requests\StoreResponsavelRequest;
use App\Http\Requests\UpdateResponsavelRequest;

class ResponsavelController extends Controller
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
     * @param  \App\Http\Requests\StoreResponsavelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResponsavelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Responsavel  $responsavel
     * @return \Illuminate\Http\Response
     */
    public function show(Responsavel $responsavel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Responsavel  $responsavel
     * @return \Illuminate\Http\Response
     */
    public function edit(Responsavel $responsavel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResponsavelRequest  $request
     * @param  \App\Models\Responsavel  $responsavel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResponsavelRequest $request, Responsavel $responsavel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Responsavel  $responsavel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Responsavel $responsavel)
    {
        //
    }
}
