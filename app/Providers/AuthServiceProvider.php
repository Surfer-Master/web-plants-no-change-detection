<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Node;
use App\Models\Plant;
use App\Policies\NodePolicy;
use App\Policies\PlantPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Node::class => NodePolicy::class,
        Plant::class => PlantPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
