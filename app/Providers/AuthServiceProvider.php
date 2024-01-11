<?php

namespace App\Providers;

use App\Constants\UserRole;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * @var string[]
     */
    protected $allGates = [
        'manage-admins',
        'manage-users',
        'manage-stores',
        'manage-services',
        'manage-works',
        'manage-automobile',
        'manage-specialists',
        'manage-estate',
        'manage-business-catalog',
        'manage-school-catalog',
        'manage-activity-catalog',
        'manage-articles',
        'manage-article-relations',
        'change-article-type',
        'manage-packages',
        'manage-banners',
        'manage-quiz',
        'manage-snapshots',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $groupedAbilities = $this->getGroupedAbilities();
        Gate::before(function (User $user, $ability) use ($groupedAbilities) {
            if ($user->isAdmin()) {
                return true;
            }

            return in_array($ability, $groupedAbilities[$user->type]);
        });
    }

    /**
     * @return array
     */
    protected function getGroupedAbilities()
    {
        return [
            UserRole::SUPERADMIN => [

            ],
            UserRole::ADMIN => [

            ],
            UserRole::CONTENT => [

            ],
            UserRole::MODERATOR => [

            ],
            UserRole::ACCOUNTANT => [
                'manage-pages'
            ],
            UserRole::SYSTEMADMIN => [

            ],
            UserRole::SPONSOR => [

            ],
            UserRole::USER => [

            ],
        ];
    }
}
