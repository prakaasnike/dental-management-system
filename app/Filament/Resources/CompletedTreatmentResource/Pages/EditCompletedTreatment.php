<?php

namespace App\Filament\Resources\CompletedTreatmentResource\Pages;

use App\Filament\Resources\CompletedTreatmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompletedTreatment extends EditRecord
{
    protected static string $resource = CompletedTreatmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
