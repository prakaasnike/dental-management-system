<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum VisitorStatus: string implements HasColor, HasIcon, HasLabel
{
    case Checked = 'checked_in';
    case Completed = 'completed';


    public function getLabel(): string
    {
        return match ($this) {
            self::Checked => 'Checked In',
            self::Completed => 'Completed',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Checked => 'info',
            self::Completed => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Checked => 'heroicon-m-sparkles',
            self::Completed => 'heroicon-m-check-badge',
        };
    }
}
