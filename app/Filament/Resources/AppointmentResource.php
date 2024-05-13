<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppointmentResource extends Resource
{

    protected static ?int $navigationSort = 5;

    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    public static function form(Form $form): Form
    {
        $doctors = Doctor::all()->pluck('name', 'id');
        $patients = Patient::all()->pluck('name', 'id');
        $services = Service::all()->pluck('service_name', 'id');

        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->label('Patients')
                    ->relationship('patients', 'name')
                    ->options($patients)
                    ->searchable(),
                Forms\Components\Select::make('doctor_id')
                    ->label('Doctors')
                    ->relationship('doctors', 'name')
                    ->options($doctors)
                    ->searchable(),
                Forms\Components\DatePicker::make('appointment_datetime')
                    ->label('Appointment Date')
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\Select::make('service_id')
                    ->label('Services')
                    ->relationship('services', 'service_name')
                    ->multiple()
                    ->options($services),
                Forms\Components\TextInput::make('appointment_amount')
                    ->label('Amount')
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('appointment_payment_status')
                    ->label('Appointment Payement Status')
                    ->required(),
                // Forms\Components\TextInput::make('appointment_payment_mode')
                //     ->required(),
                Forms\Components\TextInput::make('appointment_description')
                    ->label('Appointment Description')
                    ->maxLength(255),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patients.name')
                    ->label('Patients')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('doctors.name')
                    ->label('Doctors')
                    ->sortable(),
                Tables\Columns\TextColumn::make('appointment_datetime')
                    ->label('Appointment Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('services.service_name')
                    ->label('Services')
                    ->badge()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('appointment_description')
                //     ->label('Description'),
                Tables\Columns\TextColumn::make('appointment_amount')
                    ->label('Amount')
                    ->searchable(),
                Tables\Columns\TextColumn::make('appointment_payment_status')
                    ->label('Payment Status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
