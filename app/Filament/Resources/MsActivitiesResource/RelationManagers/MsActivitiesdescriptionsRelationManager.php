<?php

namespace App\Filament\Resources\MsActivitiesResource\RelationManagers;

use App\Models\MsLanguage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MsActivitiesdescriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'ActivitiesDescriptions';
    protected static ?string $modelLabel = 'Descriptions';
    public function getTableHeading(): string
    {
        return 'Descriptions';
    }
    public function form(Form $form): Form
    {
        $activiteId = $this->getOwnerRecord()->id;

        return $form
            ->schema([
                Forms\Components\Select::make('ms_languages_id')
                    ->label('Language')
                    ->options(function () use ($activiteId) {
                        return MsLanguage::select('id', 'name')
                            ->where('is_active', true)
                            ->pluck('name', 'id');
                    })
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('activity_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('sortdescription')
                    ->label('Sort Description')
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('description')
                    ->label('Description')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->label('Is Active')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('language.name')
                    ->label('Language')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('activity_name')
                    ->label('Activity Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sortdescription')
                    ->label('Sort Description'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
