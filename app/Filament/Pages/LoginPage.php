<?php

namespace App\Filament\Pages;

use Filament\Auth\Pages\Login;

class LoginPage extends Login
{
    public function mount(): void
    {
        parent::mount();

        app()->isLocal() && $this->form->fill([
            'email' => 'admin@user.com',
            'password' => 'secret',
            'remember' => true,
        ]);
    }
}
