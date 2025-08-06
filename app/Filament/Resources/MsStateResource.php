<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MsStateResource\Pages;
use App\Filament\Resources\MsStateResource\RelationManagers;
use App\Filament\Resources\MsStateResource\RelationManagers\MsCityRelationManager;
use App\Models\MsState;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MsStateResource extends Resource
{
    protected static ?string $model = MsState::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Master Database';
    protected static ?string $navigationLabel = 'State';
    protected static ?string $navigationParentItem = 'Countries';

    protected static ?string $modelLabel = 'State';
    protected static ?string $slug = 'state';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'name';
    //protected static bool $shouldSkipAuthorization = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ms_country_id')
                    ->relationship('MsCountry', 'name')
                    ->label('Country ID')
                    ->unique()
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                Group::make('MsCountry.name')
                    ->label('Country'),
            ])
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->badge()
                    ->color('success')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('city_count')
                    ->badge()->counts('city')
                    ->width(100)
                    ->sortable()
                    ->alignCenter()
                    ->label('Count of City')
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
                SelectFilter::make('Countries')
                    ->multiple()
                    ->relationship('MsCountry', 'name')
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
                    ->label('Add State')
                    ->createAnother(false),
            ])
            ->emptyStateIcon('heroicon-o-circle-stack')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Add State'),
            ])
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(25);
    }

    public static function getRelations(): array
    {
        return [
            MsCityRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMsStates::route('/'),
            // 'create' => Pages\CreateMsState::route('/create'),
            // 'view' => Pages\ViewMsState::route('/{record}'),
            'edit' => Pages\EditMsState::route('/{record}/edit'),
        ];
    }
}
