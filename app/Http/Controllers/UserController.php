<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Utilisateurs | ",
            'users' => User::orderBy('name')->get()
        ];

        return view('dashboard.users.index', $data);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        $reservations = Reservation::where('delegue_id', $id)
            ->orWhere('manager_id', $id)
            ->count();

        $emprunts = Emprunt::where('delegue_id', $id)
            ->orWhere('manager_id', $id)
            ->count();

        if($reservations != 0 || $emprunts != 0){
            abort(500);
        }

        $user->delete();

        return redirect()->route('users');
    }
}
