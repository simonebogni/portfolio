<?php

namespace App\Filament\Resources;

use App\Filament\ResourceGroup;
use App\Filament\Resources\LanguageResource\Pages;
use App\Models\Language;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LanguageResource extends Resource
{
    protected static ?string $model = Language::class;

    protected static ?string $navigationIcon = 'heroicon-o-language';

    protected static ?string $navigationGroup = ResourceGroup::SKILLS->value;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rating')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('speaking')
                    ->required()
                    ->maxLength(255)
                    ->default('Beginner'),
                Forms\Components\TextInput::make('reading')
                    ->required()
                    ->maxLength(255)
                    ->default('Beginner'),
                Forms\Components\TextInput::make('writing')
                    ->required()
                    ->maxLength(255)
                    ->default('Beginner'),
                Forms\Components\TextInput::make('listening')
                    ->required()
                    ->maxLength(255)
                    ->default('Beginner'),
                Forms\Components\TextInput::make('certificate_level')
                    ->maxLength(255),
                Forms\Components\TextInput::make('certificate_img_path')
                    ->maxLength(255)
                    ->url()
                    ->suffixIcon('heroicon-m-globe-alt'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('speaking')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reading')
                    ->searchable(),
                Tables\Columns\TextColumn::make('writing')
                    ->searchable(),
                Tables\Columns\TextColumn::make('listening')
                    ->searchable(),
                Tables\Columns\TextColumn::make('certificate_level')
                    ->searchable(),
                Tables\Columns\TextColumn::make('certificate_img_path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListLanguages::route('/'),
            'create' => Pages\CreateLanguage::route('/create'),
            'view' => Pages\ViewLanguage::route('/{record}'),
            'edit' => Pages\EditLanguage::route('/{record}/edit'),
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
