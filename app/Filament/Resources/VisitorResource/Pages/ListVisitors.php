<?php

namespace App\Filament\Resources\VisitorResource\Pages;

use App\Filament\Resources\VisitorResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Forms\Components\Tabs;
use Filament\Resources\Pages\ListRecords;

class ListVisitors extends ListRecords
{
    protected static string $resource = VisitorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'checked_in' => Tab::make('Checked In')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status', 'checked_in');
                }),
            'completed' => Tab::make('Completed')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status', 'completed');
                }),
            'All' => Tab::make('All Visitors'),
        ];
    }
}
