<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Equipement;
use App\Rules\HeureDebutInferieurAHeureFin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpruntController extends Controller
{
    public function index()
    {
        $emprunts = Emprunt::orderBy('date', 'desc')->get();

        // Si l'utilisateur connecté est un délégué, on ne récupère que les emprunts du délégué connecté
        if(auth()->user()->role == "delegue"){
            $emprunts = Emprunt::where('delegue_id', auth()->user()->id)->orderBy('date', 'desc')->get();
        }

        $data =[
            'title' => "Gestion des emprunts | ",
            'emprunts' => $emprunts
        ];

        return view('dashboard.emprunts.index', $data);
    }

    /**
     * Action effectuée par un délégué qui demande un équipement disponible
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function add()
    {
        $data =[
            'title' => "Emprunter un équipement | ",
            'equipements' => Equipement::where('status', 'free')->get()
        ];

        return view('dashboard.emprunts.add', $data);
    }

    /**
     * Action effectuée par un délégué qui demande un équipement disponible
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'heure_debut' => ["required", "integer", new HeureDebutInferieurAHeureFin()],
            'heure_fin' => "nullable|integer",
            'commentaire' => "nullable",
            'equipement' => "required|exists:equipements,id"
        ]);

        Emprunt::updateOrCreate([
            'delegue_id' => auth()->user()->id,
            'date' => date('Y-m-d', time()),
            'equipement_id' => $request->equipement,
            'status' => "attente_de_validation"
        ],[
            'delegue_id' => auth()->user()->id,
            'date' => date('Y-m-d', time()),
            'equipement_id' => $request->equipement,
            'manager_id' => null,
            'commentaire' => $request->commentaire,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
        ]);

        return redirect()->route('emprunts');
    }

    /**
     * Seul le manager peut modifier un emprunt.
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        $data = [
            'title' => "Modifier un emprunt | ",
            'emprunt' => Emprunt::findOrFail($id),
            'equipements' => Equipement::where('status', 'free')->get()
        ];

        return view('dashboard.emprunts.edit', $data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'emprunt' => "required|integer|exists:emprunts,id",
            'status' => "required|in:en_cours,terminé,rejeté",
            'commentaire' => "nullable"
        ]);

        $emprunt = Emprunt::find($request->emprunt);

        DB::beginTransaction();

        $emprunt->update([
            'manager_id' => auth()->id(),
            'status' => $request->status,
            'heure_debut' => $request->heure_debut ?? $emprunt->heure_debut,
            'heure_fin' => date('H', time()),
        ]);

        if($request->status == "en_cours"){
            Equipement::find($emprunt->equipement_id)->update(['status' => 'busy']);
        }else if($request->status == "terminé"){
            Equipement::find($emprunt->equipement_id)->update(['status' => 'free']);
        }

        DB::commit();

        return redirect()->route('emprunts');
    }
//
//    public function validateCheckout(Emprunt $emprunt)
//    {
//        $emprunt->manager_id = auth()->id();
//        $emprunt->heure_validation_emprunt = now();
//        $emprunt->status = 'en_cours';
//        $emprunt->save();
//        return redirect()->route('emprunts.index');
//    }
//
//    public function validateReturn(Emprunt $emprunt)
//    {
//        $emprunt->manager_id = auth()->id();
//        $emprunt->heure_validation_retour = now();
//        $emprunt->status = 'rendu';
//        $emprunt->save();
//        return redirect()->route('emprunts.index');
//    }
}
