<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MsbranchResource\Pages;
use App\Models\Msbranch;
use App\Models\MsCity;
use App\Models\MsState;
use Filament\Forms;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;

use Illuminate\Support\Collection;

class MsbranchResource extends Resource
{
    protected static ?string $model = Msbranch::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationLabel = 'Branch';
    protected static ?string $modelLabel = 'Branch';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->label('Code')
                    ->disabledOn('edit')
                    ->maxLength(3),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Branch Name')
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->label('Address')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Section::make()->schema([
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
                        ->live()
                        ->afterStateUpdated(function (Set $set) {
                            $set('ms_city_id', null);
                        })
                        ->preload(),
                    Forms\Components\Select::make('ms_city_id')
                        ->options(fn(Get $get): Collection => MsCity::query()->where('ms_state_id', $get('ms_state_id'))->pluck('name', 'id'))
                        ->label('City')
                        ->searchable()
                        ->preload(),
                ])->columns(3),



                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Branch Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('MsCountry.name')
                    ->label('Country')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('MsState.name')
                    ->label('State')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('MsCity.name')
                    ->label('City')
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
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
                    ->label('Add Branch')
                    ->createAnother(false),
            ])
            ->emptyStateIcon('heroicon-o-circle-stack')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Add Branch'),
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
            'index' => Pages\ListMsbranches::route('/'),
            // 'create' => Pages\CreateMsbranch::route('/create'),
            //'view' => Pages\ViewMsbranch::route('/{record}'),
            // 'edit' => Pages\EditMsbranch::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
