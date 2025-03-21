<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Admin;
use App\Models\Staff;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        $minutes = 1; // 1 hour
        $sections = Cache::remember('sections', $minutes, function () {
            return Section::all();
        });
        foreach ($sections as $section) {
            Gate::define($section->name, function ($user )use($section) { 
                $guard = Auth::getDefaultDriver();

                if ($guard === 'web' && $user instanceof User) {
                    return $user->hasPermission($section->name);
                } elseif ($guard === 'staffs' && $user instanceof Staff) {
                    return $user->hasPermission($section->name);
                } elseif ($guard === 'admins' && $user instanceof Admin) {
                    return $user->hasPermission($section->name);
                }

                return false;
            });
        }
        // $scopes = [];

        // foreach ($sections as $section) {
        //     Gate::define($section->name, function ($user) use ($section) {
        //         // $user = auth('staffs')->check() ? auth('staffs')->user() : auth('web')->user(); 
        //         if ($user instanceof User || $user instanceof Staff) {
        //             return $user->hasPermission($section->name);
        //         }
        //         return false;
        //     });
        // }
    }
}
 // foreach ($sections as $section) {
        //     $scopes[$section->name] = $section->caption;
        //     Gate::define($section->name, function ($user) use ($section) {
        //         return $user->hasPermission($section->name);
        //     });
        // }