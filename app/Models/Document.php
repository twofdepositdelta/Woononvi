<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'paper',
        'number',
        'expiry_date',
        'user_id', // Clé étrangère pour l'utilisateur
        'type_document_id', // Clé étrangère pour le type de document
        'is_validated',
        'slug',
        'reason',
        'is_rejected',
        'vehicle_id'
    ];

    protected $appends = ['paper_url', 'status', 'api_reason'];

    public function user()
    {
        return $this->belongsTo(User::class); // Assurez-vous d'importer le modèle User
    }

    // Relation avec le type de document
    public function typeDocument()
    {
        return $this->belongsTo(TypeDocument::class); // Assurez-vous d'importer le modèle TypeDocument
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class); // Assurez-vous d'importer le modèle Booking
    }

    public function getPaperUrlAttribute()
    {
        return $this->paper ? asset('storage/' . $this->paper) : null;
    }

    public function getStatusAttribute()
    {
        if($this->is_validated == false && $this->is_rejected == false) {
            return 'En cours';
        } elseif($this->is_validated == true) {
            return 'Validé';
        } else {
            return 'Rejeté';
        }
    }

    public function getApiReasonAttribute()
    {
        return $this->reason ?? '-';
    }
}
