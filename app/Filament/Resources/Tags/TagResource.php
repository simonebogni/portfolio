<?php

namespace App\Filament\Resources\Tags;

use App\Actions\Support\Color\VerifyColorContrastAccessibilityAction;
use App\Filament\ResourceGroup;
use App\Filament\Resources\Tags\Pages\CreateTag;
use App\Filament\Resources\Tags\Pages\EditTag;
use App\Filament\Resources\Tags\Pages\ListTags;
use App\Filament\Resources\Tags\Pages\ViewTag;
use App\Models\Tag;
use Closure;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    protected static string|\UnitEnum|null $navigationGroup = ResourceGroup::APP_MANAGEMENT->value;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('category')
                    ->required()
                    ->maxLength(255)
                    ->default('_Other'),
                ColorPicker::make('bg_color')
                    ->required()
                    ->regex('/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/')
                    ->helperText('Enter a valid hex color (e.g., #000 or #000000)')
                    ->default('#0d6efd')
                    ->rules([
                        fn (Get $get, VerifyColorContrastAccessibilityAction $verifyColorAction): Closure => function (string $attribute, string $value, Closure $fail) use ($get, $verifyColorAction) {
                            $backgroundColor = $value;
                            $textColor = $get('color');
                            $ratioIsAccessible = $verifyColorAction->execute($backgroundColor, $textColor);
                            if (! $ratioIsAccessible) {
                                $fail('Low contrast - The contrast ratio between background and text color is below WCAG AA standard (4.5:1).');
                            }
                        },
                    ]),
                ColorPicker::make('color')
                    ->required()
                    ->regex('/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/')
                    ->helperText('Enter a valid hex color (e.g., #FFF or #FFFFFF)')
                    ->default('#FFF'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('category')
                    ->searchable(),
                TextColumn::make('bg_color')
                    ->searchable(),
                TextColumn::make('color')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
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
            'index' => ListTags::route('/'),
            'create' => CreateTag::route('/create'),
            'view' => ViewTag::route('/{record}'),
            'edit' => EditTag::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
