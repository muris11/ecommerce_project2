<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Kategori';

    protected static ?string $modelLabel = 'Kategori';

    protected static ?string $pluralModelLabel = 'Kategori';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Toko';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->description('Informasi utama kategori produk')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Kategori')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan nama kategori')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                                $operation === 'create' ? $set('slug', Str::slug($state)) : null
                            )
                            ->columnSpan(1),
                        
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->unique(Category::class, 'slug', ignoreRecord: true)
                            ->helperText('URL-friendly name (auto-generated)')
                            ->columnSpan(1),
                        
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->maxLength(1000)
                            ->placeholder('Deskripsi kategori (opsional)')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->compact(),

                Forms\Components\Section::make('Media & Dokumentasi')
                    ->description('Upload gambar atau ikon kategori')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar Kategori')
                            ->disk('public')
                            ->directory('categories')
                            ->visibility('public')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/webp'])
                            ->helperText('Format: JPG, PNG, WebP. Maksimal 2MB')
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->compact()
                    ->collapsible(),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->helperText('Nonaktifkan untuk menyembunyikan kategori')
                            ->inline(false)
                            ->columnSpan(1),
                        
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampilan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Urutan tampilan (0 = default)')
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->compact(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Ikon')
                    ->disk('public')
                    ->size(50)
                    ->circular()
                    ->defaultImageUrl(url('images/default-category.svg')),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    })
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('products_count')
                    ->label('Produk')
                    ->counts('products')
                    ->badge()
                    ->color('success'),
                
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
            ->emptyStateHeading('Belum ada kategori')
            ->emptyStateDescription('Silakan tambahkan kategori pertama Anda')
            ->emptyStateIcon('heroicon-o-squares-2x2');
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
