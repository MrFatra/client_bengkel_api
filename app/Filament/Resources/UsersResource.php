<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsersResource\Pages;
use App\Filament\Resources\UsersResource\RelationManagers;
use App\Models\User;
use App\Models\Users;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Users';
    protected static ?string $slug = 'master-data/users';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $pluralModelLabel = 'Users';
    protected static ?string $modelLabel = 'User';
    protected static ?string $modelLabelPlural = 'Users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengguna')
                    ->icon('heroicon-o-user-circle')
                    ->description('Masukkan data pribadi pengguna seperti nama, email, username, nomor telepon, dan alamat.')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Pengguna')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email Pengguna')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('username')
                            ->label('Username')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone_number')
                            ->label('Nomor Telepon')
                            ->required()
                            ->maxLength(20),
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->rows(3)
                            ->columnSpanFull()
                            ->required()
                            ->maxLength(255),
                    ]),
                Forms\Components\Section::make('Pengaturan Akun')
                    ->icon('heroicon-o-cog')
                    ->description('Atur peran dan status pengguna, serta password jika membuat akun baru.')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('role')
                            ->label('Peran Pengguna')
                            ->options([
                                'admin' => 'Admin',
                                'user' => 'User',
                            ])
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required(fn($context) => $context === 'create')
                            ->maxLength(255),
                    ]),
                Forms\Components\Section::make('Foto Profil')
                    ->icon('heroicon-o-camera')
                    ->description('Unggah foto profil pengguna. Foto ini akan ditampilkan di halaman profil pengguna.')
                    ->collapsible()
                    ->schema([
                        Forms\Components\FileUpload::make('profile_picture')
                            ->label('Foto Profil')
                            ->image()
                            ->directory('profile-pictures'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pengguna')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email Pengguna')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('username')
                    ->label('Username')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Nomor Telepon')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Peran Pengguna')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        return ucfirst($state);
                    })
                    ->color(fn($state) => $state === 'active' ? 'success' : 'danger'),
                Tables\Columns\ImageColumn::make('profile_picture')
                    ->disk('public')
                    ->label('Foto Profil')
                    ->url(fn($record) => asset('storage/' . $record->profile_picture)),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ])
                    ->icon('heroicon-o-cog-6-tooth')
                    ->label('Aksi')
                    ->color('primary')
                    ->tooltip('Aksi')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUsers::route('/create'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    }
}
