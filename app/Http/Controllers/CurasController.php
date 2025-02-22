<?php

namespace App\Http\Controllers;

use App\Models\Curas;
use Illuminate\Http\Request;

class CurasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboardListCuras', ['Curases' => Curas::all()]);

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
    public function show(Curas $curas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curas $curas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curas $curas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curas $curas)
    {
        //
    }
}
