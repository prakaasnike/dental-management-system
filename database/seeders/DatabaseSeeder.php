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
use App\Models\User;
use App\Models\Visitor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

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
    }
}
