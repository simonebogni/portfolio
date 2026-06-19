<?php

namespace App\Filament\Resources\OnlinePlatforms;

use App\Filament\ResourceGroup;
use App\Filament\Resources\OnlinePlatforms\Pages\CreateOnlinePlatform;
use App\Filament\Resources\OnlinePlatforms\Pages\EditOnlinePlatform;
use App\Filament\Resources\OnlinePlatforms\Pages\ListOnlinePlatforms;
use App\Filament\Resources\OnlinePlatforms\Pages\ViewOnlinePlatform;
use App\Models\OnlinePlatform;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OnlinePlatformResource extends Resource
{
    protected static ?string $model = OnlinePlatform::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-globe-alt';

    protected static string|\UnitEnum|null $navigationGroup = ResourceGroup::EDUCATION->value;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('website')
                    ->required()
                    ->maxLength(255)
                    ->url()
                    ->suffixIcon('heroicon-m-globe-alt'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('website')
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
            'index' => ListOnlinePlatforms::route('/'),
            'create' => CreateOnlinePlatform::route('/create'),
            'view' => ViewOnlinePlatform::route('/{record}'),
            'edit' => EditOnlinePlatform::route('/{record}/edit'),
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
