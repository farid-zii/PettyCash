<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Membuat Format rupiah
        Blade::directive('rp', function ($expression) {
            return "<?php echo number_format($expression,0,',','.'); ?>";
        });

        // Blade::directive('umur', function ($tanggalLahir) {
        //     $tanggalLahir = Carbon::createFromFormat('Y-m-d', $tanggalLahir);
        //     $umur = $tanggalLahir->diffInYears(Carbon::now());
        //     return;
        // });

        Paginator::useBootstrap();
    }
}
