<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CompletedTreatment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'treatment_name',
        'payment_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'patient_id' => 'integer',
        'doctor_id' => 'integer',
        'payment_id' => 'integer',
    ];

    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class);
    }

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class);
    }
}
