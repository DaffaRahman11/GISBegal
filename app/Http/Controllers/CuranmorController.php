<?php

namespace App\Http\Controllers;

use App\Models\Curanmor;
use Illuminate\Http\Request;

class CuranmorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboardListCuranmor', ['curanmors' => Curanmor::all()]);
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
    public function show(Curanmor $curanmor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curanmor $curanmor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curanmor $curanmor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curanmor $curanmor)
    {
        //
    }
}
