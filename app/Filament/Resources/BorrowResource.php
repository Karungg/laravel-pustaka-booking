<?php

namespace App\Filament\Resources;

use App\Enums\BorrowStatus;
use App\Filament\Resources\BorrowResource\Pages;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BorrowResource extends Resource
{
    protected static ?string $model = Borrow::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';

    protected static ?string $navigationGroup = 'Transaction';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\Select::make('booking_id')
                            ->relationship('booking', 'id')
                            ->disabled(),
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->disabled(),
                        Forms\Components\DatePicker::make('return_date')
                            ->readOnly(),
                        Forms\Components\DatePicker::make('return_of_date'),
                        Forms\Components\ToggleButtons::make('status')
                            ->inline()
                            ->options(BorrowStatus::class)
                            ->required(),
                    ]),
                Section::make()
                    ->schema([
                        static::getItemsRepeater()
                    ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking.id')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('return_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('return_of_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_fine')
                    ->sortable()
                    ->getStateUsing(function (Borrow $record) {
                        $return_of_date = $record->return_of_date ? $record->return_of_date : null;

                        if ($record->return_date > $return_of_date) {
                            return 0;
                        }

                        $setting = Setting::first();

                        $diff = $return_of_date ? $record->return_date->diffInDays($return_of_date) : 0;
                        $total_fine = $diff * ($setting->fine ?? 0);

                        $record->update([
                            'total_fine' => $total_fine
                        ]);

                        return $total_fine;
                    }),
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
            'index' => Pages\ListBorrows::route('/'),
            'create' => Pages\CreateBorrow::route('/create'),
            'edit' => Pages\EditBorrow::route('/{record}/edit'),
        ];
    }

    public static function getItemsRepeater(): Repeater
    {
        return Repeater::make('borrowItems')
            ->label('Books')
            ->relationship()
            ->schema([
                Forms\Components\Select::make('book_id')
                    ->label('Title')
                    ->columnSpanFull()
                    ->options(Book::query()->pluck('title', 'id'))
                    ->disabled(),
            ])->deletable(false)
            ->addable(false);
    }
}
