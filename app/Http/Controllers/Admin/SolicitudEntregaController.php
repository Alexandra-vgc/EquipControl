<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SolicitudEntregaController extends Controller
{
    public function index()
    {
        return view('admin.solicitudes.index');
    }
}
