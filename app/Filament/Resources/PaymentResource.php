<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?int $navigationSort = 7;

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('patient_id')
                    ->numeric(),
                Forms\Components\TextInput::make('appointment_id')
                    ->numeric(),
                Forms\Components\TextInput::make('service_id')
                    ->numeric(),
                Forms\Components\TextInput::make('patient_initial_deposit')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_service_charge_amount')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('patient_total_amount_to_be_charged')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('patients_total_appointment_amount_deposits')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('patient_remaining_amount')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_payments')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('appointment_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient_initial_deposit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_service_charge_amount')
                    ->searchable(),
                Tables\Columns\TextColumn::make('patient_total_amount_to_be_charged')
                    ->searchable(),
                Tables\Columns\TextColumn::make('patients_total_appointment_amount_deposits')
                    ->searchable(),
                Tables\Columns\TextColumn::make('patient_remaining_amount')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_payments')
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
