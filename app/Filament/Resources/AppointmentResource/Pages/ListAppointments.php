<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListAppointments extends ListRecords
{
    protected static string $resource = AppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'booked' => Tab::make('booked')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status', 'booked');
                }),
            'reschedule' => Tab::make('reschedule')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status', 'reschedule');
                }),
            'cancelled' => Tab::make('cancelled')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status', 'cancelled');
                }),
            'completed' => Tab::make('completed')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status', 'completed');
                }),
            'All' => Tab::make('All Appointments'),
        ];
    }
}
