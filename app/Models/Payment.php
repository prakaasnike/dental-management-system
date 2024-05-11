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
        'patient_total_amount_to_be_paid',
        'patient_initial_deposit',
        'appointment_payment_amount',
        'appointment_payment_status',
        'appointment_payment_mode',
        'total_service_charge_amount',
        'patients_total_appointment_amount_deposits',
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
