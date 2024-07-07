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

    public function edit($id)
    {
        $data =[
            'title' => "Modifier une réservation | ",
            'reservation' => Reservation::findOrFail($id),
            'equipements' => Equipement::all()
        ];

        return view('dashboard.reservations.edit', $data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => "integer|required|exists:reservations,id",
//            'equipement' => "required|exists:equipements,id",
//            'date' => "required",
//            'heure_debut' => ["required", new HeureDebutInferieurAHeureFin()],
//            'heure_fin' => "required",
//            'commentaire' => "required",
            'status' => "required|in:accepted,rejected,ended"
        ]);

        $reservation = Reservation::find($request->id);

        $reservation->update([
//            'equipement_id' => $request->equipement,
//            'manager_id' => auth()->user()->id,
//            'date' => $request->date,
//            'debut' => $request->heure_debut,
//            'fin' => $request->heure_fin,
            'status' => $request->status,
        ]);

        // Si c'est 'ended', la réservation devient un emprunt qu'on lance
        if($request->status == "ended"){
            Emprunt::create([
                'equipement_id' => $reservation->equipement_id,
                'manager_id' => $reservation->manager_id,
                'delegue_id' => $reservation->delegue_id,
                'date' => $reservation->date,
                'heure_debut' => $reservation->debut,
                'heure_fin' => $reservation->fin,
                'status' => 'en_cours',
            ]);

            Equipement::find($reservation->equipement_id)->update(['status' => 'busy']);
        }

        return redirect()->route('reservations')->with('success', 'Réservation ajoutée avec succès');
    }
}
