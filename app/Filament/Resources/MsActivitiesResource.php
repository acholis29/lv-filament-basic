<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MsActivitiesResource\Pages;
use App\Filament\Resources\MsActivitiesResource\RelationManagers;
use App\Filament\Resources\MsActivitiesResource\RelationManagers\MsActivitiesdescriptionsRelationManager;
use App\Filament\Resources\MsActivitiesResource\RelationManagers\MsActivitiessubRelationManager;
use App\Models\MsActivities;
use App\Models\MsActivitiessub;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\RichEditor;



use Filament\Tables\Filters\TrashedFilter;


use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MsActivitiesResource extends Resource
{
    protected static ?string $model = MsActivities::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Activities';
    protected static ?string $modelLabel = 'Activities';
    protected static ?string $slug = 'msactivities';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('activity_name')
                    ->columnSpanFull()
                    ->unique(ignoreRecord: true)
                    ->required()->autocapitalize('words')
                    ->dehydrateStateUsing(fn(string $state): string => Str::upper($state))
                    ->maxLength(255),

                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('msbranch_id')
                        ->relationship('Msbranch', 'name')
                        ->label('Branch')
                        ->required()
                        ->searchable()
                        ->preload(),
                    Forms\Components\Select::make('ms_suppliers_id')
                        ->relationship('MsSuppliers', 'supplier_name',  fn($query) => $query->where('is_active', true))
                        ->label('Supplier')
                        ->required()
                        ->searchable()
                        ->preload(),
                    Forms\Components\Select::make('ms_activitiescategorys_id')
                        ->relationship('MsActivitiescategorys', 'name', fn($query) => $query->where('is_active', true))
                        ->label('Categorys')
                        ->required()
                        ->searchable()
                        ->preload(),
                ])->columns(3),

                Forms\Components\Section::make()->schema([
                    Forms\Components\TimePicker::make('pickup_time')
                        ->default(now())
                        ->seconds(false),
                    Forms\Components\TimePicker::make('drop_time')
                        ->default(now())
                        ->seconds(false),
                    Forms\Components\Toggle::make('is_active')
                        ->default(true)
                        ->label('Is Active')
                        ->required(),
                ])->columns(3),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('activity_name')
                    ->label('Activity')
                    ->searchable(),
                Tables\Columns\TextColumn::make('MsSuppliers.supplier_name')
                    ->label('Supplier')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Msbranch.name')
                    ->label('Branch')
                    ->sortable(),
                Tables\Columns\TextColumn::make('MsActivitiescategorys.name')
                    ->label('Categorys')
                    ->sortable(),
                Tables\Columns\TextColumn::make('pickup_time')
                    ->dateTime('H:i')
                    ->label('Pickup Time'),
                Tables\Columns\TextColumn::make('drop_time')
                    ->dateTime('H:i')
                    ->label('Drop Time'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()->label('is Active'),

            ])
            ->filters([
                //
                TrashedFilter::make(),
            ])
            ->actions([
                ActionGroup::make([
                    // Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),

                ])->tooltip('Actions'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ])->tooltip('Bulk Actions'),

            ])

            // ->recordActions([
            //     // You may add these actions to your table if you're using a simple
            //     // resource, or you just want to be able to delete records without
            //     // leaving the table.
            //     DeleteAction::make(),
            //     ForceDeleteAction::make(),
            //     RestoreAction::make(),
            //     // ...
            // ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->createAnother(false),
            ])
            ->emptyStateIcon('heroicon-o-circle-stack')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(25);
    }

    public static function getRelations(): array
    {
        return [
            // MsActivitiessub::class
            MsActivitiessubRelationManager::class,
            MsActivitiesdescriptionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMsActivities::route('/'),
            'create' => Pages\CreateMsActivities::route('/create'),
            // 'view' => Pages\ViewMsActivities::route('/{record}'),
            'edit' => Pages\EditMsActivities::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
