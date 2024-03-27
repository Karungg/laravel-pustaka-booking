<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum BorrowStatus: string implements HasLabel, HasIcon, HasColor
{
    case Borrowed = 'borrowed';
    case Returned = 'returned';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Borrowed => 'heroicon-m-x-mark',
            self::Returned => 'heroicon-m-check'
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Borrowed => 'danger',
            self::Returned => 'success'
        };
    }
}
