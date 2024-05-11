<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_image',
        'patient_before_image',
        'name',
        'phone',
        'email',
        'gender',
        'dob',
        'blood_type',
        'address',
        'registered_date',
        'lab_report_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'dob' => 'date',
        'registered_date' => 'date',
        'lab_report_id' => 'integer',
    ];

    public function payments(): BelongsToMany
    {
        return $this->belongsToMany(Payment::class);
    }

    public function appointments(): BelongsToMany
    {
        return $this->belongsToMany(Appointment::class);
    }

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class);
    }

    public function labReport(): BelongsTo
    {
        return $this->belongsTo(LabReport::class);
    }
}
