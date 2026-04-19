<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Filament\Admin\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->components([
    Wizard::make([
        // Step::make('Product Details')
        Step::make('Product Info')
            ->description('Isi Informasi Produk')
            ->schema([
                Group::make([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('sku')
                        ->required(),
                ])->columns(2),
                MarkdownEditor::make('description')
            ]),

        // Step::make('Product prices')
        Step::make('Product Price and Stock')
            ->description('Isi Harga Produk')
            ->schema([
                Group::make([
                    TextInput::make('price')
                        ->required(),
                    TextInput::make('stock')
                        ->required(),
                ])->columns(2),
                MarkdownEditor::make('description')
            ]),
        // Step::make('Media Status')
        Step::make('Media & Status')
            ->description('Upload gambar dan atur status')
            ->schema([
                FileUpload::make('image')
                ->disk('public')
                ->directory('products'),
            Checkbox::make('is_active'),
            Checkbox::make('is_featured'),
            ]),
        ])
    ->columnSpanFull()
    ->submitAction(
Action::make('save')
->label('Save Product')
->color('primary')
->submit('save')
)
]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name'),
                TextColumn::make('sku'),
                TextColumn::make('price'),
                TextColumn::make('stock'),
                ImageColumn::make('image')
                ->disk('public'),
            ])
            ->filters([
                //
            ])
            ->actions([
            Tables\Actions\ViewAction::make(), // TAMBAHKAN INI
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
        'index' => Pages\ListProducts::route('/'),
        'create' => Pages\CreateProduct::route('/create'),
        'view' => Pages\ViewProduct::route('/{record}'), // TAMBAHKAN INI
        'edit' => Pages\EditProduct::route('/{record}/edit'),
    ];
}
    public static function infolist(Infolist $infolist): Infolist
    {
    return $infolist
        ->components([
            Section::make('Product Info')
            ->schema([
            TextEntry::make('name')
            ->label('Product Name')
            ->weight('bold')
            ->color('primary'),
            TextEntry::make('id')
            ->label('Product ID'),
            TextEntry::make('sku')
            ->label('Product SKU')
            ->badge()
            ->color('success'),
            TextEntry::make('description')
            ->label('Product Description'),
            TextEntry::make('created_at')
            ->label('Product Creation Date')
            ->date('d M Y')
            ->color('info'),
            ])
            ->columnSpanFull(),
            Section::make('Pricing & Stock')
            ->schema([
            TextEntry::make('price')
            ->label('Product Price')
            ->icon('heroicon-o-currency-dollar'),
            TextEntry::make('stock')
            ->label('Product Stock'),
            ])
            ,
            Section::make('Image and Status')
            ->description('')
            ->schema([
        ImageEntry::make('image')
            ->label('Product Image')
            ->disk('public'),
            
        TextEntry::make('price')
            ->label('Product Price')
            ->weight('bold')
            ->color('primary')
            ->icon('heroicon-s-currency-dollar'),
            
        TextEntry::make('stock')
            ->label('Product Stock')
            ->weight('bold')
            ->color('primary'),
            IconEntry::make('is_active')
            ->label('Is Active')
            ->boolean(),
            IconEntry::make('is_featured')
            ->label('Is Featured')
            ->boolean(),
    ])
        ]);
    }
}
