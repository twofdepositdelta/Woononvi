<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    //
    protected $fillable = ['label'];

    public function getLabelFrAttribute()
    {
        switch ($this->label) {
            case 'Deposit':
                return 'Dépôt';
            case 'Withdraw':
                return 'Retrait';
            case 'Booking':
                return 'Réservation';
            default:
                return $this->label; // Si non trouvé, retourne le label original
        }
    }
}
