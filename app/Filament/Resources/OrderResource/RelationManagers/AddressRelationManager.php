<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    protected static ?string $title = 'Alamat Pengiriman';

    protected static ?string $label = 'Alamat';

    protected static ?string $pluralLabel = 'Alamat';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('first_name')
                ->label('Nama Depan')
                ->required()
                ->maxLength(255),

                TextInput::make('last_name')
                ->label('Nama Belakang')
                ->required()
                ->maxLength(255),

                TextInput::make('phone')
                ->label('Nomor Telepon')
                ->required()
                ->tel()
                ->maxLength(20),

                TextInput::make('city')
                ->label('Kota')
                ->required()
                ->maxLength(255),

                TextInput::make('state')
                ->label('Provinsi')
                ->required()
                ->maxLength(255),

                TextInput::make('zip_code')
                ->label('Kode Pos')
                ->required()
                ->numeric()
                ->maxLength(10),

                Textarea::make('street_address')
                    ->label('Alamat Lengkap')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                TextColumn::make('fullname')
                ->label('Nama Lengkap'),

                TextColumn::make('phone')
                ->label('Telepon'),

                TextColumn::make('city')
                ->label('Kota'),
                
                TextColumn::make('state')
                ->label('Provinsi'),

                TextColumn::make('zip_code')
                ->label('Kode Pos'),

                TextColumn::make('street_address')
                ->label('Alamat')
                ->limit(50),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Alamat'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
