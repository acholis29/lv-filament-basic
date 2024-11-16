<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort =1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nik')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('full_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ms_country_id')
                    ->numeric(),
                Forms\Components\TextInput::make('ms_state_id')
                    ->numeric(),
                Forms\Components\TextInput::make('ms_city_id')
                    ->numeric(),
                Forms\Components\TextInput::make('department_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('subdepartment_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('msbranch_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('user_id')
                    ->numeric(),
                Forms\Components\TextInput::make('msreligion_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('msmarital_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('gender'),
                Forms\Components\DatePicker::make('date_of_birth'),
                Forms\Components\DatePicker::make('date_of_join'),
                Forms\Components\TextInput::make('salary')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('profile_photo_path')
                    ->maxLength(2048),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_visible')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('idx')
                    ->required()
                    ->maxLength(36),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ms_country_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ms_state_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ms_city_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subdepartment_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('msbranch_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('msreligion_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('msmarital_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_of_join')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('salary')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('profile_photo_path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_visible')
                    ->boolean(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('idx')
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
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->label('New Employee')
                ->createAnother(false),
            ])
            ->emptyStateIcon('heroicon-o-circle-stack')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('New Employee'),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
