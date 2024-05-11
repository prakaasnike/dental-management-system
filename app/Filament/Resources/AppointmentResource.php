<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('doctor_id')
                    ->numeric(),
                Forms\Components\TextInput::make('patient_id')
                    ->numeric(),
                Forms\Components\TextInput::make('appointment_payment_amount')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('appointment_payment_status')
                    ->required(),
                Forms\Components\TextInput::make('appointment_payment_mode')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\DatePicker::make('appointment_datetime')
                    ->required(),
                Forms\Components\TextInput::make('appointment_description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('service_id')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('doctor_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('appointment_payment_amount')
                    ->searchable(),
                Tables\Columns\TextColumn::make('appointment_payment_status'),
                Tables\Columns\TextColumn::make('appointment_payment_mode'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('appointment_datetime')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('appointment_description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service_id')
                    ->numeric()
                    ->sortable(),
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
