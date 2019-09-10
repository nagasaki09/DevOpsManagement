<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Atf\Observers\AtfObserver;

use App\Models\Users;

use App\Models\Home;
use App\Models\Image;
use App\Models\Repository;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // ベースデータオブザーバー
        Users::observe( AtfObserver::class );
        
        
        // ベースデータオブザーバー
        Home::observe( AtfObserver::class );

        // ベースデータオブザーバー
        //Image::observe( AtfObserver::class );

        // ベースデータオブザーバー
        //Repository::observe( AtfObserver::class );
        
    }

}
