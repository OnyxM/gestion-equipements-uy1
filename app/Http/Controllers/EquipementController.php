<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Equipements | ",
            'equipements'  => Equipement::orderBy('name')->get()
        ];

        return view('dashboard.equipements.index', $data);
    }
}
