<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Equipement;
use App\Models\Reservation;
use App\Rules\HeureDebutInferieurAHeureFin;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::orderBy('id', 'desc')->get();

        // Si l'utilisateur connecté est un délégué, on ne récupère que les emprunts du délégué connecté
        if(auth()->user()->role == "delegue"){
            $reservations = Reservation::where('delegue_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        }

        $data = [
            'title' => "Réservations | ",
            'reservations' => $reservations
        ];

        return view('dashboard.reservations.index', $data);
    }

    public function add()
    {
        $data = [
            'title' => "Ajouter une réservation | ",
            'equipements' => Equipement::all()
        ];

        return view('dashboard.reservations.add', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'equipement' => "required|exists:equipements,id",
            'date' => "required",
            'heure_debut' => ["required", new HeureDebutInferieurAHeureFin()],
            'heure_fin' => "required",
            'commentaire' => "required"
        ]);

        Reservation::create([
            'delegue_id' => auth()->user()->id,
            'equipement_id' => $request->equipement,
            'date' => $request->date,
            'debut' => $request->heure_debut,
            'fin' => $request->heure_fin,
            'commentaire' => $request->commentaire
        ]);

        return redirect()->route('reservations')->with('success', 'Réservation ajoutée avec succès');
    }
}
