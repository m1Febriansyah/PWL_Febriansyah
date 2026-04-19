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
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
