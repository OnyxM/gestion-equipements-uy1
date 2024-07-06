<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Equipement;
use App\Models\Reservation;
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

    public function add()
    {
        $data = [
            'title' => "Ajouter equipement | ",
        ];

        return view('dashboard.equipements.add', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => "nullable",
            'name' => "required|min:4",
            'description' => "nullable"
        ]);

        Equipement::create([
            'code' => $request->code ?? Equipement::generateRandomEquipementCode(), // Si le code n'est pas envoyé, je génère un code aléatoire
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => auth()->user()->id
        ]);

        return redirect()->route('equipements');
    }

    public function edit($id)
    {
        $data = [
            'title' => "Modifier les infos d'un équipement | ",
            'equipement' => Equipement::findOrFail($id)
        ];

        return view('dashboard.equipements.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id' => "integer|required|exists:equipements,id",
            'code' => "nullable",
            'name' => "required|min:4",
            'description' => "nullable"
        ]);

        $equipement = Equipement::find($request->id);

        $equipement->update([
            'code' => $request->code ?? $equipement->code,
            'name' => $request->name ?? $equipement->name,
            'description' => $request->description ?? $equipement->description
        ]);

        return redirect()->route('equipements');
    }

    public function delete($id)
    {
        // Avant de supprimer, on vérifie qu'il n'a jamais été utilisé

        $equipement = Equipement::findOrFail($id);

        $reservations = Reservation::where('equipement_id', $id)->count();
        $emprunts = Emprunt::where('equipement_id', $id)->count();

        if($reservations != 0 || $emprunts != 0){
            abort(500, "Impossible de supprimer cet équipement car il a déjà été utilisé pour une réservation ou un emprunt!");
        }

        $equipement->delete();

        return redirect()->route('equipements');
    }
}
