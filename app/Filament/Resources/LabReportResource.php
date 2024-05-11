<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LabReportResource\Pages;
use App\Filament\Resources\LabReportResource\RelationManagers;
use App\Models\LabReport;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LabReportResource extends Resource
{
    protected static ?string $model = LabReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $patients = Patient::all()->pluck('name', 'id');
        return $form
            ->schema([
                Section::make('Enter patient lab details')
                    ->description('Lab report of patients')
                    ->schema([
                        Forms\Components\Select::make('patient_id')
                            ->relationship('patients', 'name')
                            ->options($patients)
                            ->searchable(),
                        Forms\Components\TextInput::make('lab_report_name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                    ])->columnSpan(2)->columns(2),
                Group::make()->schema([
                    Section::make("Image")
                        ->collapsible()
                        ->schema([
                            Forms\Components\FileUpload::make('lab_image')
                                ->image()
                                ->preserveFilenames()
                                ->imagePreviewHeight('90')
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
                Tables\Columns\TextColumn::make('patients.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('lab_report_name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('lab_image')
                    ->circular(),
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
            ->defaultSort('created_at', 'des')
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
            'index' => Pages\ListLabReports::route('/'),
            'create' => Pages\CreateLabReport::route('/create'),
            'edit' => Pages\EditLabReport::route('/{record}/edit'),
        ];
    }
}
