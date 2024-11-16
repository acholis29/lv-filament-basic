<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MsmaritalResource\Pages;
use App\Filament\Resources\MsmaritalResource\RelationManagers;
use App\Models\Msmarital;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MsmaritalResource extends Resource
{
    protected static ?string $model = Msmarital::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationParentItem = 'Employees';
    protected static ?string $navigationLabel = 'Marital';
    protected static ?string $modelLabel = 'Marital';
    protected static ?int $navigationSort =2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->columnSpanFull()
                    ->unique()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
                //
            ])
            ->actions([
              //  Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->headerActions([
                Tables\Actions\CreateAction::make()
                ->label('New Marital')->slideOver()
                ->createAnother(false),
            ])
            ->emptyStateIcon('heroicon-o-circle-stack')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('New Marital'),
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
            'index' => Pages\ListMsmaritals::route('/'),
            //'create' => Pages\CreateMsmarital::route('/create'),
            //'view' => Pages\ViewMsmarital::route('/{record}'),
            //'edit' => Pages\EditMsmarital::route('/{record}/edit'),
        ];
    }
}
