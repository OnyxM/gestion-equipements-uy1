<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable=[
        'code',
        'name',
        'description',
        'status',
        'created_by'
    ];

    static function generateRandomString($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generateRandomEquipementCode($length  = 4)
    {
        do {
            // Génération du nom d'utilisateur aléatoire
            $code = 'VP' . strtoupper(self::generateRandomString($length));
        } while (Equipement::where('code', $code)->count() != 0);

        return $code;
    }
}
