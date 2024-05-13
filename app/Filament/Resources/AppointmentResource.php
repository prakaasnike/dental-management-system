<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Treatment;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
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
        $treatments = Treatment::all()->pluck('name', 'id');
        $services = Service::all()->pluck('service_name', 'id');

        return $form
            ->schema([
                Section::make('Make an Appointment')
                    ->description('Create an appointment for your patients')
                    ->schema([
                        Forms\Components\Select::make('patient_id')
                            ->relationship('patients', 'name')
                            ->label('Patients')
                            ->options($patients)
                            ->searchable(),
                        Forms\Components\Select::make('doctor_id')
                            ->relationship('doctors', 'name')
                            ->label('Doctors')
                            ->options($doctors)
                            ->searchable(),
                        Forms\Components\Select::make('treatments')
                            ->relationship('treatments', 'name')
                            ->label('Treatments')
                            ->multiple()
                            ->options($treatments),
                        Forms\Components\Select::make('services')
                            ->relationship('services', 'service_name')
                            ->label('Services')
                            ->multiple()
                            ->options($services),
                        Forms\Components\TextInput::make('appointment_amount')
                            ->prefix('Rs')
                            ->label('Amount')
                            ->numeric()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('appointment_description')
                            ->label('Appointment Description')
                            ->maxLength(255),
                    ])
                    ->columnSpan(2)
                    ->columns(2),
                Group::make()
                    ->schema([
                        Section::make("Choose")
                            ->collapsible()
                            ->schema([
                                Forms\Components\DatePicker::make('appointment_datetime')
                                    ->label('Appointment Date')
                                    ->native(false)
                                    ->required(),
                                Forms\Components\ToggleButtons::make('status')
                                    ->inline()
                                    ->required()
                                    ->options([
                                        'booked' => 'Booked',
                                        'reschedule' => 'Reschedule',
                                        'cancelled' => 'Cancelled',
                                        'completed' => 'Completed',
                                    ]),
                                Forms\Components\ToggleButtons::make('appointment_payment_status')
                                    ->label('Appointment Payment Status')
                                    ->inline()
                                    ->required()
                                    ->options([
                                        'paid' => 'Paid',
                                        'unpaid' => 'Unpaid',
                                    ])
                                    ->columnSpan(1),
                            ]),

                    ]),
            ])
            ->columns([
                'default' => 3,
                'md' => 3,
                'lg' => 3,
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
                    ->label('Appointment')
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
                    ->money('NPR')
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
