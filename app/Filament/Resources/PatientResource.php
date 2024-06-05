<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Treatment;
//use Filament\Actions\Action;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class PatientResource extends Resource
{
    protected static ?int $navigationSort = 3;



    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        //  $treatments = Treatment::all()->pluck('name', 'id');
        $services = Service::all();

        return $form
            ->schema([
                Section::make('Patient Details')
                    ->description('Fill in patient information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->required()
                            ->prefix('+977')
                            ->unique(ignoreRecord: true)
                            ->tel()
                            ->numeric()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->maxLength(10),
                        Forms\Components\TextInput::make('email')
                            ->unique(ignoreRecord: true)
                            ->email()
                            ->maxLength(255),
                        Forms\Components\Select::make('gender')
                            ->placeholder('Select gender')
                            ->native(false)
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                                'other' => 'Other',
                            ])
                            ->required(),
                        Forms\Components\DatePicker::make('dob')
                            ->native(false)
                            ->required(),
                        Forms\Components\Select::make('blood_type')
                            ->placeholder('Select blood type')
                            ->native(false)
                            ->options([
                                'A+' => 'A+',
                                'A-' => 'A-',
                                'B+' => 'B+',
                                'B-' => 'B-',
                                'AB+' => 'AB+',
                                'AB-' => 'AB-',
                                'O+' => 'O+',
                                'O-' => 'O-',
                                'None' => 'None',
                            ]),
                        Forms\Components\TextInput::make('address')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('initial_amount')
                            ->prefix('Rs')
                            ->maxLength(255),

                        Forms\Components\Select::make('services')
                            ->relationship('services', 'service_name')
                            ->multiple()
                            ->reactive()
                            ->columnSpanFull()
                            ->options(
                                $services->mapWithKeys(function (Service $service) {
                                    return [$service->id => sprintf('%s ($%s)', $service->service_name, $service->service_amount)];
                                })
                            )
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                // Retrieve the selected service IDs from the form data
                                $selectedServices = $get('services');

                                // Initialize total amount to 0
                                $totalAmount = Service::whereIn('id', $selectedServices)->sum('service_amount');

                                // Format the total amount to display as currency (with 2 decimal places and a decimal point)
                                $formattedAmount = number_format($totalAmount, 2, '.', '');

                                // Update the service amount field in the form with the calculated total amount
                                $set('service_amount', $formattedAmount);
                            }),
                        // Forms\Components\TextInput::make('service_amount')
                        //     ->disabled()
                        //     ->live(true)
                        //     ->dehydrated()
                        //     ->prefix('Rs')
                        //     ->numeric(),

                        Forms\Components\TextInput::make('medical_issues')
                            ->label('If any medical issue describe below ?')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])
                    ->columnSpan(2)
                    ->columns(2),
                Group::make()->schema([
                    Section::make("Registration Date")
                        ->schema([
                            Forms\Components\DatePicker::make('registered_date')
                                ->native(false)
                                ->label('Date')
                                ->required(),
                        ])->columnSpan(1),
                    Section::make("Patient Profile")
                        ->collapsible()
                        ->schema([
                            Forms\Components\FileUpload::make('patient_image')
                                ->label('Image')
                                ->image()
                                ->preserveFilenames()
                                ->imagePreviewHeight('90')
                                ->maxSize(512 * 512 * 2),
                        ]),
                    Section::make("Before Treatment")
                        ->collapsible()
                        ->schema([
                            Forms\Components\FileUpload::make('patient_before_image')
                                ->label('Image')
                                ->image()
                                ->preserveFilenames()
                                ->imagePreviewHeight('90')
                                ->maxSize(512 * 512 * 2),
                        ]),
                ]),
                Group::make()
                    ->schema([
                        Forms\Components\Section::make('Treatment items')
                            ->schema([
                                static::getItemsRepeater(),
                            ]),
                    ])->columnSpan(['lg' => fn (?Patient $record) => $record === null ? 3 : 2]),
            ])
            ->columns([
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('patient_image')
                    ->label('Image')
                    ->circular()
                    ->defaultImageUrl(function ($record) {
                        $name = $record->name ?: 'Unknown';
                        return 'https://api.dicebear.com/8.x/initials/svg?seed=' . urlencode($name);
                    }),
                Tables\Columns\ImageColumn::make('patient_before_image')
                    ->label('Before Image')
                    ->circular()
                    ->defaultImageUrl(function ($record) {
                        $name = $record->name ?: 'Unknown';
                        return 'https://api.dicebear.com/8.x/bottts/svg?seed=' . urlencode($name);
                    }),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('blood_type'),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('registered_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getItemsRepeater(): Repeater
    {
        // $treatments = Treatment::all()->pluck('name', 'id');
        $treatments = Treatment::all();
        return Repeater::make('treatment_id.treatment_id')

            ->schema([
                Forms\Components\Select::make('treatment_id')
                    ->label('Treatment')
                    ->relationship('treatments', 'name')
                    ->multiple()
                    ->options(
                        $treatments->mapWithKeys(function (Treatment $treatment) {
                            return [$treatment->id => sprintf('%s ($%s)', $treatment->name, $treatment->treatment_price)];
                        })
                    )
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        self::updateTreatmentPrices($get, $set);
                    })
                    ->required()
                    ->reactive()
                    ->distinct()
                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                    ->columnSpan([
                        'md' => 7,
                    ])
                    ->searchable(),
                Forms\Components\TextInput::make('treatment_price')
                    ->label('Treatment Price')
                    ->disabled()
                    ->live(true)
                    ->dehydrated()
                    ->prefix('Rs')
                    ->numeric()
                    ->required()
                    ->columnSpan([
                        'md' => 3,
                    ]),
            ])
            ->defaultItems(1)
            ->hiddenLabel()
            ->columns([
                'md' => 10,
            ]);
    }


    public static function updateTreatmentPrices(Get $get, Set $set): void
    {
        $selectedTreatments = $get('treatment_id');

        $subtotal = $selectedTreatments
            ? Treatment::whereIn('id', $selectedTreatments)->sum('treatment_price')
            : 0;

        $set('treatment_price', number_format($subtotal, 2, '.', ''));
    }


    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
