<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login as AuthLogin;

class Login extends AuthLogin
{
    public function form(Form $form): Form
    {
        return $form;
    }

    /**
     * @return array<int | string, string | Form>
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getCPFFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    public function getCPFFormComponent(): Component
    {
        return TextInput::make('cpf')
            ->label('Digite o Seu CPF')
            ->required()
            ->type('text')
            ->mask('999.999.999-99')
            ->placeholder('000.000.000-00');
    }

    protected function getCredentialsFromFormData(array $data): array
    {

        $data['cpf'] = $this->limpa_cpf_cnpj($data['cpf']);
        return [
            'cpf' => $data['cpf'],
            'password' => $data['password'],
        ];
    }

    function limpa_cpf_cnpj($valor)
    {
        $valor = trim($valor);
        $valor = str_replace(array('.', '-', '/'), "", $valor);
        return $valor;
    }
}
