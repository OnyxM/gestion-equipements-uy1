<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
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
    ];
}
