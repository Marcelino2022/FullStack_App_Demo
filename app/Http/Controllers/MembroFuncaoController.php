<?php

namespace App\Http\Controllers;

use App\Models\Membro_Funcao;
use App\Http\Requests\StoreMembro_FuncaoRequest;
use App\Http\Requests\UpdateMembro_FuncaoRequest;

class MembroFuncaoController extends Controller
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
     * @param  \App\Http\Requests\StoreMembro_FuncaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembro_FuncaoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membro_Funcao  $membro_Funcao
     * @return \Illuminate\Http\Response
     */
    public function show(Membro_Funcao $membro_Funcao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Membro_Funcao  $membro_Funcao
     * @return \Illuminate\Http\Response
     */
    public function edit(Membro_Funcao $membro_Funcao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMembro_FuncaoRequest  $request
     * @param  \App\Models\Membro_Funcao  $membro_Funcao
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembro_FuncaoRequest $request, Membro_Funcao $membro_Funcao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membro_Funcao  $membro_Funcao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membro_Funcao $membro_Funcao)
    {
        //
    }
}
