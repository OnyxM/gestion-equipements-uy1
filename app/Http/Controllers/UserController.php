<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function add()
    {
        $data = [
            'title' => "Ajouter un utilisateur | ",
        ];

        return view('dashboard.users.add', $data);
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request, [
            'role' => "required|in:manager,delegue",
            'name' => "required|string|max:255",
            'email' => "required|string|email|max:255|unique:users",
            'password' => "required|string|min:8",
        ]);

        User::create([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('users');
    }

    public function delete($id)
    {
        if($id == auth()->user()->id){
            abort(500);
        }

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
