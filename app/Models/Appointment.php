<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'appointment_datetime',
        'status',
        'treatment_id',
        'service_id',
        'appointment_amount',
        'appointment_payment_status',
        'appointment_payment_mode',
        'appointment_description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'doctor_id' => 'integer',
        'patient_id' => 'integer',
        'appointment_datetime' => 'date',
        'treatment_id' => 'integer',
        'service_id' => 'integer',
    ];

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class);
    }

    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class);
    }

    public function payments(): BelongsToMany
    {
        return $this->belongsToMany(Payment::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function treatments(): BelongsToMany
    {
        return $this->belongsToMany(Treatment::class);
    }
}
