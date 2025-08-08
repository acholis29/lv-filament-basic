<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MsCityResource\Pages;
use App\Filament\Resources\MsCityResource\RelationManagers;
use App\Models\MsCity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MsCityResource extends Resource
{
    protected static ?string $model = MsCity::class;
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Master Database';
    protected static ?string $navigationParentItem = 'Countries';
    protected static ?string $navigationLabel = 'Cities';
    protected static ?string $modelLabel = 'Cities';
    protected static ?string $slug = 'cities';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'name';
    //protected static bool $shouldSkipAuthorization = true;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ms_state_id')
                    ->relationship('MsState', 'name')
                    ->label('State ID')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->groups([
                Group::make('msstate.name')
                    ->label('State'),
            ])
            ->columns([

                // Tables\Columns\TextColumn::make('msstate.name')
                //     ->label('State')
                //     ->toggleable(isToggledHiddenByDefault: true)
                //     ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
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
                SelectFilter::make('State')
                    ->relationship('MsState', 'name')
                    ->searchable(),
            ])
            ->actions([
                ActionGroup::make([
                    //ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                ])->tooltip('Actions'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add Cities')
                    ->createAnother(false),
            ])
            ->emptyStateIcon('heroicon-o-circle-stack')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Add Cities'),
            ])
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(25);
    }

    public static function getRelations(): array
    {
        return [];
    }

    // public static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMsCities::route('/'),
            //'create' => Pages\CreateMsCity::route('/create'),
            // 'view' => Pages\ViewMsCity::route('/{record}'),
            'edit' => Pages\EditMsCity::route('/{record}/edit'),
        ];
    }
}
