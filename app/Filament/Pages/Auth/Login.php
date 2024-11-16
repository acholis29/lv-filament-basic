<?php
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;
use Filament\Pages\Auth\Login as BaseAuth;
 
class LoginPage extends BaseAuth
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(), 
               // $this->getLoginFormComponent(), 
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }
 
    protected function getLoginFormComponent(): Component 
    {
        return TextInput::make('login')
            ->label('Login')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    } 

//    protected function getCredentialsFromFormData(array $data): array
//     {
//  dump($data);

//         $login_type = filter_var($data['login'], FILTER_VALIDATE_EMAIL ) ? 'email' : 'name';
//  dump($login_type);
//         return [
//             $login_type => $data['login'],
//             'password'  => $data['password'],
//         ];
//     }
}