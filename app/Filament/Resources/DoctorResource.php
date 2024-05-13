<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Filament\Resources\DoctorResource\RelationManagers;
use App\Models\Doctor;
use App\Models\Specialization;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DoctorResource extends Resource
{
    protected static ?int $navigationSort = 4;

    protected static ?string $model = Doctor::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    public static function form(Form $form): Form
    {
        $specializations = Specialization::all()->pluck('name', 'id');
        return $form
            ->schema([
                Section::make('Doctor details')
                    ->description('Comprehensive Doctor Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->unique()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->unique()
                            ->maxLength(255),
                        Forms\Components\ToggleButtons::make('gender')
                            ->required()
                            ->inline()
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                                'other' => 'Other',
                            ]),
                        Forms\Components\DatePicker::make('dob')
                            ->native(false),
                        Forms\Components\TextInput::make('years_of_experience')
                            ->numeric(),
                        Forms\Components\TextInput::make('address')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('doctor_registration_number')
                            ->label('Doctor Registration Number')
                            ->maxLength(50),
                    ])->columnSpan(2)->columns(2),
                Group::make()->schema([
                    Section::make("Doctor Avatar")
                        ->collapsible()
                        ->schema([
                            Forms\Components\FileUpload::make('doctor_image')
                                ->label('Image')
                                ->avatar()
                                ->image(),
                        ])->columnSpan(1),
                    Section::make("Specialization")
                        ->schema([
                            Forms\Components\Select::make('specializations')
                                ->relationship('specializations', 'name')
                                ->multiple()
                                ->options($specializations),
                        ]),
                ]),
            ])->columns([
                'default' => 3,
                'sm' => 3,
                'md' => 3,
                'lg' => 3,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('specializations.name')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('doctor_image')
                    ->label('Profile')
                    ->defaultImageUrl(function ($record) {
                        $name = $record->name ?: 'Unknown';
                        // Use DiceBear Avatars API for generating avatars
                        return 'https://api.dicebear.com/8.x/bottts/svg?seed=' . urlencode($name);
                    }),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('years_of_experience')
                    ->label('Experience')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('doctor_registration_number')
                    ->label('Registration'),
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
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}
