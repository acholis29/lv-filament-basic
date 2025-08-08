<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MsHotelsResource\Pages;
use App\Filament\Resources\MsHotelsResource\RelationManagers;
use App\Models\MsHotels;
use App\Models\MsCity;
use App\Models\MsState;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class MsHotelsResource extends Resource
{
    protected static ?string $model = MsHotels::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $modelLabel = 'Hotel';
    protected static ?string $navigationGroup = 'Master Database';
    protected static ?string $slug = 'mshotels';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('hotel_name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->autocapitalize('words')
                    ->dehydrateStateUsing(fn(string $state): string => Str::upper($state))
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),

                Forms\Components\Select::make('ms_country_id')
                    ->relationship('MsCountry', 'name')
                    ->label('Country')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('ms_state_id', null);
                        $set('ms_city_id', null);
                    }),
                Forms\Components\Select::make('ms_state_id')
                    ->label('State')
                    ->options(fn(Get $get): Collection => MsState::query()->where('ms_country_id', $get('ms_country_id'))->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('ms_city_id', null);
                    })
                    ->preload(),
                Forms\Components\Select::make('ms_city_id')
                    ->options(fn(Get $get): Collection => MsCity::query()->where('ms_state_id', $get('ms_state_id'))->pluck('name', 'id'))
                    ->label('City')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone2')
                    ->label('Phone Alternative')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email2')
                    ->label('Email Alternative')
                    ->email()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hotel_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mscountry.name')
                    ->label('Country')
                    ->sortable(),
                Tables\Columns\TextColumn::make('msstate.name')
                    ->label('State')
                    ->sortable(),
                Tables\Columns\TextColumn::make('mscity.name')
                    ->label('City'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    //Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('New Hotel')
                    ->icon('heroicon-o-plus')
                    ->createAnother(false),

            ])
            ->emptyStateIcon('heroicon-o-circle-stack')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Add Hotel')
                    ->icon('heroicon-o-plus')
                    ->createAnother(false),
            ])
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(25);
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
            'index' => Pages\ListMsHotels::route('/'),
            // 'create' => Pages\CreateMsHotels::route('/create'),
            // 'view' => Pages\ViewMsHotels::route('/{record}'),
            // 'edit' => Pages\EditMsHotels::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
