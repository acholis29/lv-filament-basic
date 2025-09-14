<?php

namespace App\Filament\Resources\MsSupplierResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MsContactSupplierRelationManager extends RelationManager
{
    protected static string $relationship = 'ContactSuppliers';

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $modelLabel = 'Contact Supplier';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public function getTableHeading(): string
    {
        return 'Supplier Contacts';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->tel()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('jobtitle')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone2')
                    ->label('Phone Alternative')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email2')
                    ->label('Email Alternative')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Contact Name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')->label('Phone'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('jobtitle'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Add Contact'),
            ])

            ->emptyStateIcon('heroicon-o-circle-stack')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Add Contact')
                    ->icon('heroicon-o-plus')
                    ->createAnother(false),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    //Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                // Tables\Actions\BulkActionGroup::make([
                // ]),
            ]);
    }
}
