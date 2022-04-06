<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {

            // Alert::success('Linkul a fost trimis!', 'A fost trimis un link la adresa ' . $notifiable->email . ' pentru validarea contului de utilizator')
            // ->persistent(true, false);

            return (new MailMessage)
                ->view('front.emails.verify-email', ['url' => $url])
                ->subject('Validare cont Starter Laravel');
        });

        Gate::define('supervisor', function () {
            return Auth::guard('staf')->user()->role == 'supervisor';
        });
    }
}
