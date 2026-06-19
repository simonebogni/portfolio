<?php

namespace App\Filament\Resources\WorkPositions;

use App\Filament\ResourceGroup;
use App\Filament\Resources\WorkPositions\Pages\CreateWorkPosition;
use App\Filament\Resources\WorkPositions\Pages\EditWorkPosition;
use App\Filament\Resources\WorkPositions\Pages\ListWorkPositions;
use App\Filament\Resources\WorkPositions\Pages\ViewWorkPosition;
use App\Models\WorkPosition;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkPositionResource extends Resource
{
    protected static ?string $model = WorkPosition::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-briefcase';

    protected static string|\UnitEnum|null $navigationGroup = ResourceGroup::WORK_EXPERIENCE->value;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('company_id')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('period')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('start_date')
                    ->required()
                    ->displayFormat('Y-m-d')
                    ->maxDate(now()),
                DatePicker::make('end_date')
                    ->displayFormat('Y-m-d')
                    ->maxDate(now())
                    ->afterOrEqual('start_date')
                    ->hidden(fn (Get $get): bool => $get('current'))
                    ->required(fn (Get $get): bool => ! $get('current')),
                Toggle::make('current')
                    ->live()
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('period')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->searchable(),
                TextColumn::make('end_date')
                    ->searchable(),
                IconColumn::make('current')
                    ->boolean(),
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
            'index' => ListWorkPositions::route('/'),
            'create' => CreateWorkPosition::route('/create'),
            'view' => ViewWorkPosition::route('/{record}'),
            'edit' => EditWorkPosition::route('/{record}/edit'),
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
