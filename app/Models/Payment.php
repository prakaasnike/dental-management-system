<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'appointment_id',
        'total_treatment_charge_amount',
        'total_service_charge_amount',
        'total_appointment_amount_deposits',
        'total_patient_remaining_amount_to_be_paid',
        'patient_remaining_amount',
        'total_payments',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'patient_id' => 'integer',
        'appointment_id' => 'integer',
    ];

    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class);
    }

    public function appointments(): BelongsToMany
    {
        return $this->belongsToMany(Appointment::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }
}
