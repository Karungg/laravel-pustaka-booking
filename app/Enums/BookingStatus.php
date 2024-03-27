<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum BookingStatus: string implements HasLabel, HasIcon, HasColor
{
    case Pending = 'pending';
    case Accepted = 'accepted';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Pending => 'heroicon-m-x-mark',
            self::Accepted => 'heroicon-m-check'
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Pending => 'danger',
            self::Accepted => 'success'
        };
    }
}
