<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $modelLabel = 'Produk';

    protected static ?string $pluralModelLabel = 'Produk';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Toko';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Informasi Produk')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Produk')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                    ),
                                
                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->disabled()
                                    ->dehydrated()
                                    ->unique(Product::class, 'slug', ignoreRecord: true),
                                
                                Forms\Components\MarkdownEditor::make('description')
                                    ->label('Deskripsi Produk')
                                    ->columnSpanFull()
                                    ->fileAttachmentsDirectory('products'),
                            ])
                            ->columns(2),
                        
                        Forms\Components\Section::make('Gambar Produk')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Gambar')
                                    ->multiple()
                                    ->disk('public')
                                    ->directory('products')
                                    ->visibility('public')
                                    ->image()
                                    ->imageEditor()
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/webp'])
                                    ->maxFiles(5)
                                    ->reorderable()
                                    ->panelLayout('grid')
                                    ->helperText('Upload maksimal 5 gambar produk (Maks. 2MB per gambar)')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(2),
                
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Harga')
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->label('Harga Produk')
                                    ->numeric()
                                    ->required()
                                    ->prefix('IDR')
                                    ->placeholder('0'),
                            ]),
                        
                        Forms\Components\Section::make('Kategori & Merek')
                            ->schema([
                                Forms\Components\Select::make('category_id')
                                    ->label('Kategori')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->relationship('category', 'name', fn ($query) => $query->where('is_active', true))
                                    ->native(false),
                                
                                Forms\Components\Select::make('brand_id')
                                    ->label('Merek')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->relationship('brand', 'name', fn ($query) => $query->where('is_active', true))
                                    ->native(false),
                            ]),
                        
                        Forms\Components\Section::make('Status')
                            ->schema([
                                Forms\Components\Toggle::make('in_stock')
                                    ->label('Stok Tersedia')
                                    ->default(true)
                                    ->required(),
                                
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Status Aktif')
                                    ->default(true)
                                    ->required(),
                                
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Produk Unggulan')
                                    ->default(false)
                                    ->required(),
                                
                                Forms\Components\Toggle::make('on_sale')
                                    ->label('Sedang Diskon')
                                    ->default(false)
                                    ->required(),
                            ]),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public')
                    ->size(60)
                    ->circular()
                    ->defaultImageUrl(url('images/no-image.png'))
                    ->getStateUsing(fn ($record) => 
                        is_array($record->image) && !empty($record->image) ? $record->image[0] : null
                    ),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Merek')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),
                
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),
                
                Tables\Columns\IconColumn::make('on_sale')
                    ->label('Diskon')
                    ->boolean()
                    ->trueIcon('heroicon-o-tag')
                    ->falseIcon('heroicon-o-tag')
                    ->trueColor('success')
                    ->falseColor('gray'),
                
                Tables\Columns\IconColumn::make('in_stock')
                    ->label('Stok')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
                
                Tables\Filters\SelectFilter::make('brand')
                    ->label('Merek')
                    ->relationship('brand', 'name'),
                
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Unggulan')
                    ->placeholder('Semua Produk')
                    ->trueLabel('Unggulan')
                    ->falseLabel('Tidak Unggulan'),
                
                Tables\Filters\TernaryFilter::make('on_sale')
                    ->label('Diskon')
                    ->placeholder('Semua Produk')
                    ->trueLabel('Sedang Diskon')
                    ->falseLabel('Tidak Diskon'),
                
                Tables\Filters\TernaryFilter::make('in_stock')
                    ->label('Stok')
                    ->placeholder('Semua Stok')
                    ->trueLabel('Tersedia')
                    ->falseLabel('Habis'),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Semua Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Yang Dipilih'),
                ]),
            ])
            ->emptyStateHeading('Belum ada produk')
            ->emptyStateDescription('Silakan tambahkan produk pertama Anda')
            ->emptyStateIcon('heroicon-o-shopping-bag');
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
