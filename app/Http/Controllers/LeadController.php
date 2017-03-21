<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index() {
        return view('leads.view');
    }

    public function export() {
        return view('leads.export');
    }
}
