<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MsLanguageResource\Pages;
use App\Filament\Resources\MsLanguageResource\RelationManagers;
use App\Models\MsLanguage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class MsLanguageResource extends Resource
{
    protected static ?string $model = MsLanguage::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $modelLabel = 'Language';
    protected static ?string $navigationGroup = 'Master Database';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('International Code')
                    ->required()
                    ->disabledOn('edit')
                    ->maxLength(3)
                    ->unique(ignoreRecord: true)
                    ->autocapitalize('words')
                    ->dehydrateStateUsing(fn(string $state): string => Str::upper($state)),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->autocapitalize('words')
                    ->dehydrateStateUsing(fn(string $state): string => Str::upper($state))
                    ->maxLength(255),

                Forms\Components\Toggle::make('is_active')
                    ->required()->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->label('Code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Name')->sortable()->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ]),
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
            'index' => Pages\ListMsLanguages::route('/'),
            // 'create' => Pages\CreateMsLanguage::route('/create'),
            // 'view' => Pages\ViewMsLanguage::route('/{record}'),
            // 'edit' => Pages\EditMsLanguage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
