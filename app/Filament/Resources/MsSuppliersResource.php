<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MsSupplierResource\RelationManagers\MsContactSupplierRelationManager;
use App\Filament\Resources\MsSuppliersResource\Pages;
use App\Filament\Resources\MsSuppliersResource\RelationManagers;
use App\Models\MsSuppliers;
use App\Models\MsState;
use App\Models\MsCity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Tables\Filters\TrashedFilter;

class MsSuppliersResource extends Resource
{
    protected static ?string $model = MsSuppliers::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Supplier';
    protected static ?string $navigationGroup = 'Master Database';
    protected static ?string $slug = 'mssuppliers';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('supplier_name')
                    ->required()
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn(string $state): string => Str::upper($state))
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone2')
                    ->label('Phone Alternative')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email2')
                    ->label('Email Alternative')
                    ->email()
                    ->maxLength(255),
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
                Forms\Components\TextInput::make('website')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->default(true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supplier_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone'),
                Tables\Columns\TextColumn::make('phone2')
                    ->label('Phone Alternative'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('email2')
                    ->label('Email Alternative'),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('New Supplier')
                    ->icon('heroicon-o-plus')
                    ->createAnother(false),

            ])
            ->emptyStateIcon('heroicon-o-circle-stack')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('New Supplier')
                    ->icon('heroicon-o-plus')
                    ->createAnother(false),
            ])
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(25)
            ->filters([
                //
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    //Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ])->tooltip('Bulk Actions'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            MsContactSupplierRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMsSuppliers::route('/'),
            // 'create' => Pages\CreateMsSuppliers::route('/create'),
            'view' => Pages\ViewMsSuppliers::route('/{record}'),
            'edit' => Pages\EditMsSuppliers::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
