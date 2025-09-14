<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MsCountryResource\Pages;
use App\Filament\Resources\MsCountryResource\RelationManagers;
use App\Filament\Resources\MsCountryResource\RelationManagers\MsStateRelationManager;
use App\Filament\Resources\MsCountryResource\Widgets\CountyOverview;
use App\Models\MsCountry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use BezhanSalleh\FilamentShield\Traits\HasShieldFormComponents;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class MsCountryResource extends Resource
{
    use HasShieldFormComponents;

    protected static ?string $model = MsCountry::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationGroup = 'Master Database';
    protected static ?string $navigationLabel = 'Countries';
    protected static ?string $modelLabel = 'Countries';
    protected static ?string $slug = 'countries';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'name';

    //protected static bool $shouldSkipAuthorization = true;
    public static function form(Form $form): Form
    {

        return $form

            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)->columnSpanFull(),
                        Forms\Components\TextInput::make('code')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phonecode')
                            ->tel()
                            ->required()
                            ->maxLength(255),

                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->badge()
                    ->color('success')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('state_count')
                    ->badge()->counts('state')
                    ->width(100)
                    ->sortable()
                    ->alignCenter()
                    ->label('Count of State')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('code')
                    ->width(100)
                    ->alignCenter()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phonecode')
                    ->label('Phone Code')
                    ->width(100)
                    ->sortable()
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
                //
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
                    ->label('Add Countries')
                    ->createAnother(false),
            ])
            ->emptyStateIcon('heroicon-o-circle-stack')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Add Countries'),
            ])
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(25);
    }
    // public static function infolist(Infolist $infolist): Infolist
    // {
    //     return $infolist
    //         ->schema([
    //             Section::make('Country Information')->schema([
    //                 TextEntry::make('name')->label('Country'),
    //                 TextEntry::make('code')->label('Code country'),
    //                 TextEntry::make('phonecode')->label('Phone Code'),
    //             ])->columns(3)
    //         ]);
    // }
    public static function getRelations(): array
    {
        return [
            MsStateRelationManager::class
        ];
    }

    public static function getWidgets(): array
    {
        return [
            CountyOverview::class,
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMsCountries::route('/'),
            // 'create' => Pages\CreateMsCountry::route('/create'),
            //'view' => Pages\ViewMsCountry::route('/{record}'),
            'edit' => Pages\EditMsCountry::route('/{record}/edit'),
        ];
    }
}
