<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum BookingStatus: string implements HasLabel, HasIcon, HasColor
{
    case Accept = 'accept';
    case Canceled = 'canceled';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Accept => 'heroicon-m-check',
            self::Canceled => 'heroicon-m-x-mark'
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Accept => 'success',
            self::Canceled => 'danger'
        };
    }
}
