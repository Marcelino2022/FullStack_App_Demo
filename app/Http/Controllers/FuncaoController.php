<?php

namespace App\Http\Controllers;

use App\Models\Funcao;
use App\Http\Requests\StoreFuncaoRequest;
use App\Http\Requests\UpdateFuncaoRequest;

class FuncaoController extends Controller
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
     * @param  \App\Http\Requests\StoreFuncaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFuncaoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funcao  $funcao
     * @return \Illuminate\Http\Response
     */
    public function show(Funcao $funcao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funcao  $funcao
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcao $funcao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFuncaoRequest  $request
     * @param  \App\Models\Funcao  $funcao
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFuncaoRequest $request, Funcao $funcao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funcao  $funcao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcao $funcao)
    {
        //
    }
}
