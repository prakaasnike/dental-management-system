<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompletedTreatmentResource\Pages;
use App\Filament\Resources\CompletedTreatmentResource\RelationManagers;
use App\Models\CompletedTreatment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompletedTreatmentResource extends Resource
{
    protected static ?string $model = CompletedTreatment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('patient_id')
                    ->numeric(),
                Forms\Components\TextInput::make('doctor_id')
                    ->numeric(),
                Forms\Components\TextInput::make('treatment_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('payment_id')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('doctor_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('treatment_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_id')
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
            'index' => Pages\ListCompletedTreatments::route('/'),
            'create' => Pages\CreateCompletedTreatment::route('/create'),
            'edit' => Pages\EditCompletedTreatment::route('/{record}/edit'),
        ];
    }
}
