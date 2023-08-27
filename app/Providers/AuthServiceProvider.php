<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Http\Resources\Lesson;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Tag;
use App\Policies\UserPolicy;
use App\Policies\LessonPolicy;
use App\Policies\TagPolicy;



class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
       
        User::class => UserPolicy::class,
        Lesson::class => LessonPolicy::class,
        Tag::class => TagPolicy::class,


    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


    
    }
}
