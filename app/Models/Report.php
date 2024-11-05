<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    //
    use HasFactory;

    protected $fillable = ['booking_id', 'user_id', 'report_type_id', 'description'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reportType()
    {
        return $this->belongsTo(ReportType::class);
    }
}
