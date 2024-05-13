<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Doctor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'specialization_id',
        'doctor_image',
        'name',
        'email',
        'phone',
        'gender',
        'dob',
        'years_of_experience',
        'address',
        'doctor_registration_number',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'specialization_id' => 'integer',
        'dob' => 'date',
    ];

    public function appointments(): BelongsToMany
    {
        return $this->belongsToMany(Appointment::class);
    }

    public function specializations(): BelongsToMany
    {
        return $this->belongsToMany(Specialization::class);
    }

    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class);
    }
}
