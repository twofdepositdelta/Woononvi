<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    //
    use HasFactory;


    protected $fillable = [
        'question',
        'slug',
        'answer',
        'faq_type_id', // ID du type de FAQ
    ];



    // Relation avec le modèle FaqType
    public function faqType()
    {
        return $this->belongsTo(FaqType::class, 'faq_type_id');
    }
}
