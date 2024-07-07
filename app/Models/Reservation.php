<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable=[
        'delegue_id',
        'manager_id',
        'equipement_id',
        'date',
        'debut',
        'fin',
        'commentaire',
        'status',
    ];

    public function delegue()
    {
        return $this->belongsTo(User::class, 'delegue_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function equipement()
    {
        return $this->belongsTo(Equipement::class, 'equipement_id');
    }
}
