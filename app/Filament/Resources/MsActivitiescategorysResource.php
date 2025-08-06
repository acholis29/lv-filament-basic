<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MsActivitiescategorysResource\Pages;
use App\Filament\Resources\MsActivitiescategorysResource\RelationManagers;
use App\Models\MsActivitiescategorys;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class MsActivitiescategorysResource extends Resource
{
    protected static ?string $model = MsActivitiescategorys::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Activities';
    protected static ?string $navigationParentItem = 'Activities';
    protected static ?string $modelLabel = 'Categorys';
    protected static ?string $slug = 'msactivitiescategorys';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique()
                    ->autocapitalize('words')
                    ->dehydrateStateUsing(fn(string $state): string => Str::upper($state))
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')
                    ->required()->default(true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->label('Category Name')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),

            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('is_active')
                    ->options([
                        true => 'Active',
                        false => 'Inactive',
                    ])->label('Status')->default(true),

            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make()
                ])->tooltip('Actions'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->headerActions([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMsActivitiescategorys::route('/'),
            // 'create' => Pages\CreateMsActivitiescategorys::route('/create'),
            // 'view' => Pages\ViewMsActivitiescategorys::route('/{record}'),
            // 'edit' => Pages\EditMsActivitiescategorys::route('/{record}/edit'),
        ];
    }
}
