<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(5)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->readOnly(),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'title')
                            ->required(),
                        Forms\Components\TextInput::make('author')
                            ->required()
                            ->maxLength(64),
                        Forms\Components\TextInput::make('publisher')
                            ->required()
                            ->maxLength(64),
                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->required(),
                    ])->columnSpan(8),
                Section::make()
                    ->schema([
                        Forms\Components\DatePicker::make('publication_date')
                            ->required(),
                        Forms\Components\TextInput::make('number_of_pages')
                            ->required()
                            ->maxLength(4),
                        Forms\Components\TextInput::make('heavy')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('wide')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('long')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('languange')
                            ->required()
                            ->maxLength(128),
                        Forms\Components\TextInput::make('isbn')
                            ->required()
                            ->maxLength(64),
                        Forms\Components\TextInput::make('stocks')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('borrowed')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('booked')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ])->columnSpan(4)
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publisher')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publication_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_of_pages')
                    ->searchable(),
                Tables\Columns\TextColumn::make('heavy')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('wide')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('long')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('languange')
                    ->searchable(),
                Tables\Columns\TextColumn::make('isbn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stocks')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('borrowed')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('booked')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image'),
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
