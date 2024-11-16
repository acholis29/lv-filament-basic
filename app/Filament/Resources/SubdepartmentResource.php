<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubdepartmentResource\Pages;
use App\Filament\Resources\SubdepartmentResource\RelationManagers;
use App\Models\Subdepartment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubdepartmentResource extends Resource
{
    protected static ?string $model = Subdepartment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationParentItem = 'Employees';
    protected static ?string $navigationLabel = 'Sub Department';
    protected static ?string $modelLabel = 'Sub Department';
    protected static ?int $navigationSort =1;
    protected static bool $shouldRegisterNavigation = false;
protected static ?string $slug = 'subdepart';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('department_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('department_id')
                    ->numeric()
                    ->sortable(),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListSubdepartments::route('/'),
            'create' => Pages\CreateSubdepartment::route('/create'),
            'view' => Pages\ViewSubdepartment::route('/{record}'),
            'edit' => Pages\EditSubdepartment::route('/{record}/edit'),
        ];
    }
}
