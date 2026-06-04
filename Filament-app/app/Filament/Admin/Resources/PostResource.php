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
use Filament\Forms\Components\DatePicker;
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
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\IconColumn;
use App\Models\Category;
use App\Models\Tag;
use App\Filament\Admin\Resources\PostResource\RelationManagers\TagsRelationManager;

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
                        ->options(Category::all()->pluck('name', 'id'))
                        ->required()
                        //->preload()
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
                    Select::make("tags")
                        ->relationship('tags','name')
                        ->multiple()
                        ->preload(),
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
                TextColumn::make('id')
                ->label('ID')
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('title')
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make('slug')
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make('category.name')
                ->sortable()
                ->searchable()
                ->toggleable(),
                ColorColumn::make('color')
                    ->sortable()
                    ->toggleable(),
                ImageColumn::make('image')
                    ->disk('public')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Created at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('tags')
                    ->label('Tags')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('published')
                ->boolean()
                ->label('Published')
                ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('created_at')             
                ->label('Creation Date')
                ->form([
                    DatePicker::make('created_at')
                    ->label('Select Date'),
                ])
                ->query(function ($query, $data) {
                    return $query->when(
                        $data['created_at'],
                        fn ($query, $date) => $query->whereDate('created_at', $date)
                    );
                }),
                SelectFilter::make('category_id')
                ->label('Select Category')
                ->relationship('category', 'name')
                ->preload(),
            ])
            ->actions([
    Tables\Actions\EditAction::make()
        ->icon('heroicon-o-pencil'),
    Tables\Actions\ReplicateAction::make()
        ->icon('heroicon-o-document-duplicate'),
    Tables\Actions\DeleteAction::make()
        ->icon('heroicon-o-trash'),
    Tables\Actions\Action::make('status')
        ->label('Status Change')
        ->icon('heroicon-o-check-circle')
        ->form([
            Checkbox::make('published')
                ->default(fn($record): bool => $record->published),
        ])
        ->action(function ($record, $data) {
            $record->update(['published' => $data['published']]);
        })
        ->requiresConfirmation()
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
 TagsRelationManager::class,
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
