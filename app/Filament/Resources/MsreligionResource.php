<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MsreligionResource\Pages;
use App\Filament\Resources\MsreligionResource\RelationManagers;
use App\Models\Msreligion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MsreligionResource extends Resource
{
    protected static ?string $model = Msreligion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationParentItem = 'Employees';
        protected static ?string $navigationLabel = 'Religion';
    protected static ?string $modelLabel = 'Religion';
    protected static ?int $navigationSort =3;



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
                ->label('New Religion')->slideOver()
            ])
            ->emptyStateIcon('heroicon-o-circle-stack')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('New Religion'),
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
            'index' => Pages\ListMsreligions::route('/'),
            //'create' => Pages\CreateMsreligion::route('/create'),
            //'view' => Pages\ViewMsreligion::route('/{record}'),
            //'edit' => Pages\EditMsreligion::route('/{record}/edit'),
        ];
    }
}
