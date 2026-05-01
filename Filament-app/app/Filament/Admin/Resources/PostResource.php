<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PostResource\Pages;
use App\Filament\Admin\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Group;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
        Section::make("Post Details")
            ->description("Fill in the details of the post")
            // -> icon(Heroicon::RocketLaunch)
            ->icon('heroicon-o-document-text')
            ->schema([
                //grouping fields into 2 columns
                Group::make([
                    TextInput::make("title")
                        ->rules('required | min:3 | max:10'),
                    TextInput::make("slug")
                        ->rules('required')
                        ->unique()
                        ->validationMessages([
                            "unique" => "Slug must be unique"
                        ]),
                    Select::make("category_id")
                        ->relationship("category", "name")
                        ->required()
                        ->preload()
                        ->searchable(),
                    ColorPicker::make("color"),
                ])->columns(2),

                MarkdownEditor::make("content"),
            ])->columnSpan(2),

        //Grouping fields into 2 columns
        Group::make([

            //section 2 - image
            Section::make("Image Upload")
                ->schema([
                    FileUpload::make("image")
                        ->required()
                        ->disk("public")
                        ->directory("posts"),
                ]),

            //section 3 - meta
            Section::make("Meta Information")
                ->schema([
                    TagsInput::make("tags"),
                    Checkbox::make("published"),
                    DateTimePicker::make("published_at"),
                ]),
        ])->columnSpan(1)

    ])->columns(3);
        }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                ->sortable(),
                TextColumn::make('slug')
                ->sortable(),
                TextColumn::make('category.name')
                ->sortable(),
                ColorColumn::make('color')
                    ->sortable(),
                ImageColumn::make('image')
                    ->disk('public')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created at')
                    ->dateTime()
                    ->sortable(),
            ])->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
