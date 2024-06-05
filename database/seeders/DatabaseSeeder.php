<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\CompletedTreatment;
use App\Models\Doctor;
use App\Models\LabReport;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Specialization;
use App\Models\Treatment;
use App\Models\User;
use App\Models\Visitor;
use Filament\Models\Contracts\FilamentUser;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Create a single FilamentUser
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        // Create a single FilamentUser


        // Create 50  records using the Factory
        Visitor::factory()->count(5)->create();
        Patient::factory()->count(5)->create();
        Doctor::factory()->count(5)->create();
        Appointment::factory()->count(5)->create();
        Payment::factory()->count(5)->create();
        LabReport::factory()->count(5)->create();
        Service::factory()->count(5)->create();
        CompletedTreatment::factory()->count(5)->create();
        Specialization::factory()->count(5)->create();
        Treatment::factory()->count(5)->create();
    }
}
