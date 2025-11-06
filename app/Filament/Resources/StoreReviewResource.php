<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreReviewResource\Pages;
use App\Filament\Resources\StoreReviewResource\RelationManagers;
use App\Models\StoreReview;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StoreReviewResource extends Resource
{
    protected static ?string $model = StoreReview::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    
    protected static ?string $navigationLabel = 'Ulasan Toko';
    
    protected static ?string $modelLabel = 'Ulasan Toko';

    protected static ?string $pluralModelLabel = 'Ulasan Toko';
    
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Pelanggan')
                    ->required()
                    ->disabled(),
                    
                Forms\Components\TextInput::make('rating')
                    ->label('Rating')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->required()
                    ->disabled(),
                    
                Forms\Components\Textarea::make('review')
                    ->label('Ulasan')
                    ->required()
                    ->disabled()
                    ->rows(5),
                    
                Forms\Components\Toggle::make('is_published')
                    ->label('Publikasikan')
                    ->helperText('Nonaktifkan jika ulasan tidak pantas ditampilkan')
                    ->default(true),
                    
                Forms\Components\Textarea::make('admin_reply')
                    ->label('Balasan Admin')
                    ->rows(4)
                    ->placeholder('Tulis balasan untuk ulasan pelanggan ini...')
                    ->helperText('Balasan ini akan ditampilkan di halaman penilaian toko.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->badge()
                    ->color(fn ($state) => match(true) {
                        $state >= 4 => 'success',
                        $state >= 3 => 'warning',
                        default => 'danger',
                    })
                    ->formatStateUsing(fn ($state) => $state . ' ★')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('review')
                    ->label('Ulasan')
                    ->limit(60)
                    ->searchable(),
                    
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                    
                Tables\Columns\IconColumn::make('admin_reply')
                    ->label('Balasan')
                    ->boolean()
                    ->trueIcon('heroicon-o-chat-bubble-left-right')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->getStateUsing(fn ($record) => !is_null($record->admin_reply)),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('rating')
                    ->label('Rating')
                    ->options([
                        5 => '5 Bintang',
                        4 => '4 Bintang',
                        3 => '3 Bintang',
                        2 => '2 Bintang',
                        1 => '1 Bintang',
                    ]),
                    
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Status Publikasi')
                    ->placeholder('Semua ulasan')
                    ->trueLabel('Dipublikasikan')
                    ->falseLabel('Disembunyikan'),
                    
                Tables\Filters\Filter::make('has_reply')
                    ->label('Sudah Dibalas')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('admin_reply')),
                    
                Tables\Filters\Filter::make('awaiting_reply')
                    ->label('Belum Dibalas')
                    ->query(fn (Builder $query): Builder => $query->whereNull('admin_reply')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListStoreReviews::route('/'),
            'create' => Pages\CreateStoreReview::route('/create'),
            'edit' => Pages\EditStoreReview::route('/{record}/edit'),
        ];
    }
}
