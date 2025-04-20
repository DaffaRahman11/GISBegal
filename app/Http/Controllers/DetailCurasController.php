<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail_Curas;

class DetailCurasController extends Controller
{
    public function index()
{
    $detail_curas = Detail_Curas::orderBy('created_at')->get();

    return view('admin.dashboardDetailCuras', compact('detail_curas'));
}
}
