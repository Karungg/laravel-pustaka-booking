<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Enums\BookingStatus;
use App\Filament\Resources\BookingResource;
use App\Models\Borrow;
use App\Services\Borrow\BorrowService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditBooking extends EditRecord
{
    protected static string $resource = BookingResource::class;

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('Accept')
                ->action(function (BorrowService $borrowService): void {
                    $borrowService->borrowProcess($this->record->id);
                })->visible(function () {
                    return $this->record->status == BookingStatus::Pending;
                }),
        ];
    }
}
