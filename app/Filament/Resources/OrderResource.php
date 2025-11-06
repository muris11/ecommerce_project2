<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Number;
use Filament\Resources\Resource;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;

use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'Pesanan';

    protected static ?string $modelLabel = 'Pesanan';

    protected static ?string $pluralModelLabel = 'Pesanan';

    protected static ?string $navigationGroup = 'Toko';

    /**
     * Helper method to update grand total
     * This is called from quantity field, so paths are relative to the repeater item
     */
    protected static function updateGrandTotal(Get $get, Set $set): void
    {
        $itemsTotal = 0;
        
        // Get all items from the repeater - path is relative to the item field
        if ($repeaters = $get('../../items')) {
            foreach($repeaters as $key => $repeater){
                $itemsTotal += $repeater['total_amount'] ?? 0;
            }
        }
        
        // Get shipping amount - it's at the root level
        $shipping = $get('../../shipping_amount') ?? 0;
        $grandTotal = $itemsTotal + $shipping;
        
        // Set grand total at the root level
        $set('../../grand_total', $grandTotal);
    }

    public static function form(Form $form): Form
    {
        return $form
    ->schema([
        Group::make()->schema([
            Section::make('Informasi Pesanan')->schema([
                Select::make('user_id')
                    ->label('Pelanggan')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(), 
                
                Select::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->options([
                        'midtrans' => 'Midtrans',
                        'cod' => 'Cash on Delivery (COD)',
                        'stripe' => 'Stripe',
                    ])
                    ->default('midtrans')
                    ->required(), 
                
                Select::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Menunggu',
                        'paid' => 'Lunas',
                        'failed' => 'Gagal',
                    ])
                    ->default('pending') 
                    ->required(), 

                ToggleButtons::make('status')
                    ->label('Status Pesanan')
                    ->inline()
                    ->default('new')
                    ->required()
                    ->options([
                        'new' => 'Baru',
                        'processing' => 'Diproses',
                        'shipped' => 'Dikirim',
                        'delivered' => 'Selesai',
                        'canceled' => 'Dibatalkan'
                    ])  
                    ->colors([
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped' => 'primary',
                        'delivered' => 'success',
                        'canceled' => 'danger'
                    ])
                    ->icons([
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'shipped' => 'heroicon-m-truck',
                        'delivered' => 'heroicon-m-check-badge',
                        'canceled' => 'heroicon-m-x-circle'
                    ]),

                    Select::make('currency')
                    ->label('Mata Uang')
                    ->options([
                        'idr' => 'IDR (Rupiah)',
                        'usd' => 'USD (Dollar)',
                ])
                ->default('idr')
                ->required(),

                Select::make('shipping_method')
                ->label('Metode Pengiriman')
                ->options([
                    'anteraja' => 'AnterAja',
                    'jne' => 'JNE',
                    'j&t express' => 'J&T Express',
                    'pos indonesia' => 'POS Indonesia',
                    'ninja xpress' => 'Ninja Xpress',
                    'tiki' => 'TIKI',
                    'sicepat' => 'SiCepat',
                    'gosend' => 'GoSend',
                    'grabexpress' => 'GrabExpress',
                ])
                ->placeholder('Pilih metode pengiriman'),

                TextInput::make('shipping_amount')
                ->label('Ongkos Kirim')
                ->numeric()
                ->prefix('IDR')
                ->default(0)
                ->required()
                ->reactive()
                ->live(onBlur: true)
                ->afterStateUpdated(function (Get $get, Set $set, $state) {
                    // Recalculate grand_total when shipping changes
                    $itemsTotal = 0;
                    if ($repeaters = $get('items')) {
                        foreach($repeaters as $key => $repeater){
                            $itemsTotal += $get("items.{$key}.total_amount") ?? 0;
                        }
                    }
                    $set('grand_total', $itemsTotal + ($state ?? 0));
                }),

                Textarea::make('notes')
                ->label('Catatan')
                ->placeholder('Masukkan catatan pesanan (opsional)')
                ->columnSpanFull()
            ])->columns(2),

            Section::make('Produk Pesanan')->schema([
                Repeater::make('items')
                ->relationship()
                ->label('Item Produk')
                ->schema([

                    Select::make('product_id')
                    ->label('Produk')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->distinct()
                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                    ->columnSpan(4)
                    ->reactive()
                    ->afterStateUpdated(fn ($state, Set $set) => $set('unit_amount', Product::find($state)?->price ?? 0))
                    ->afterStateUpdated(fn ($state, Set $set) => $set('total_amount', Product::find($state)?->price ?? 0)),

                    TextInput::make('quantity')
                    ->label('Jumlah')
                    ->numeric()
                    ->required()
                    ->default(1)
                    ->minValue(1)
                    ->columnSpan(2)
                    ->reactive()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                        $unitAmount = $get('unit_amount') ?? 0;
                        $total = $state * $unitAmount;
                        $set('total_amount', $total);
                        
                        // Recalculate grand total
                        self::updateGrandTotal($get, $set);
                    }),

                    TextInput::make('unit_amount')
                    ->label('Harga Satuan')
                    ->numeric()
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->columnSpan(3),

                    TextInput::make('total_amount')
                    ->label('Total')
                    ->numeric()
                    ->required()
                    ->dehydrated()
                    ->columnSpan(3)

                ])->columns(12)
                ->defaultItems(1)
                ->addActionLabel('Tambah Produk')
                ->deleteAction(
                    fn ($action) => $action->requiresConfirmation()
                ),

                Placeholder::make('items_subtotal_placeholder')
                ->label('Subtotal Produk')
                ->content(function (Get $get, Set $set){
                    $total = 0;
                    if(!$repeaters = $get('items')){
                        return Number::currency($total, 'IDR');
                    }

                    foreach($repeaters as $repeater){
                        $total += $repeater['total_amount'] ?? 0;
                    }
                    
                    return Number::currency($total, 'IDR');
                }),

                Placeholder::make('shipping_placeholder')
                ->label('Ongkos Kirim')
                ->content(function (Get $get){
                    $shipping = $get('shipping_amount') ?? 0;
                    return Number::currency($shipping, 'IDR');
                }),

                Placeholder::make('grand_total_placeholder')
                ->label('Total Pembayaran')
                ->content(function (Get $get, Set $set){
                    $itemsTotal = 0;
                    if($repeaters = $get('items')){
                        foreach($repeaters as $repeater){
                            $itemsTotal += $repeater['total_amount'] ?? 0;
                        }
                    }
                    
                    $shipping = $get('shipping_amount') ?? 0;
                    $grandTotal = $itemsTotal + $shipping;
                    
                    $set('grand_total', $grandTotal);
                    return Number::currency($grandTotal, 'IDR');
                }),

                Hidden::make('grand_total')
                ->default(0)
            ])

        ])->columnSpanFull()
    ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                ->label('Customer')
                ->sortable()
                ->searchable(),

                TextColumn::make('grand_total')
                ->label('Total Pembayaran')
                ->numeric()
                ->sortable()
                ->money('IDR'),

                TextColumn::make('shipping_amount')
                ->label('Ongkir')
                ->numeric()
                ->sortable()
                ->money('IDR')
                ->toggleable(),

                TextColumn::make('payment_method')
                ->label('Metode Pembayaran')
                ->searchable()
                ->sortable()
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'cod' => 'warning',
                    'stripe' => 'success',
                    'midtrans' => 'info',
                    default => 'gray',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'cod' => 'COD',
                    'stripe' => 'Stripe',
                    'midtrans' => 'Midtrans',
                    default => strtoupper($state),
                }),

                TextColumn::make('payment_status')
                ->label('Status Pembayaran')
                ->searchable()
                ->sortable()
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'paid' => 'success',
                    'failed' => 'danger',
                    default => 'gray',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'pending' => 'Menunggu',
                    'paid' => 'Lunas',
                    'failed' => 'Gagal',
                    default => $state,
                }),

                TextColumn::make('status')
                ->label('Status Pesanan')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'new' => 'info',
                    'processing' => 'warning',
                    'shipped' => 'primary',
                    'delivered' => 'success',
                    'canceled' => 'danger',
                    default => 'gray',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'new' => 'Baru',
                    'processing' => 'Diproses',
                    'shipped' => 'Dikirim',
                    'delivered' => 'Selesai',
                    'canceled' => 'Dibatalkan',
                    default => $state,
                })
                ->searchable()
                ->sortable(),

                TextColumn::make('shipping_method')
                ->label('Metode Pengiriman')
                ->sortable()
                ->searchable()
                ->toggleable(),

                TextColumn::make('created_at')
                ->label('Tanggal Pesanan')
                ->dateTime('d M Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('updated_at')
                ->label('Terakhir Diubah')
                ->dateTime('d M Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                    ]),
                
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status Pesanan')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'canceled' => 'Cancelled',
                    ]),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]) 
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            AddressRelationManager::class
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        // Hitung hanya order yang belum delivered
        return static::getModel()::whereNotIn('status', ['delivered', 'cancelled'])->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        $pendingCount = static::getModel()::whereNotIn('status', ['delivered', 'cancelled'])->count();
        return $pendingCount > 10 ? 'warning': 'danger';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
