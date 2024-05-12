<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?int $navigationSort = 8;

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Create a service for your patients')
                    ->description('Craft Personalized Care: Easy Service Creation for Patients')
                    ->schema([
                        Components\TextInput::make('service_name')
                            ->required()
                            ->maxLength(255),
                        Components\TextInput::make('service_amount')
                            ->required()
                            ->maxLength(255),
                        Components\Textarea::make('service_description')
                            ->required()
                            ->columnSpanFull(),
                    ])->columnSpan(2)->columns(2),
                Group::make()->schema([
                    Section::make("Image")
                        ->collapsible()
                        ->schema([
                            FileUpload::make('service_image')
                                ->image()
                                ->preserveFilenames()
                                ->imagePreviewHeight('175')
                                ->maxSize(512 * 512 * 2),
                        ])->columnSpan(1),
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
                Tables\Columns\TextColumn::make('service_name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('service_image')
                    ->circular()
                    ->defaultImageUrl(function ($record) {
                        $name = $record->name ?: 'Unknown';
                        // Use DiceBear Avatars API for generating avatars
                        return 'https://api.dicebear.com/8.x/bottts/svg?seed=' . urlencode($name);
                    }),
                Tables\Columns\TextColumn::make('service_amount')
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
