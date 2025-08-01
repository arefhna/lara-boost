# lara-boost
# Elanı İrəli Çək Funksiyası (LaraClassifier üçün)

Bu paket LaraClassifier skriptinə "Elanı irəli çək" funksiyasını əlavə edir.

## Xüsusiyyətlər
- 24 saatlıq boost aktivliyi
- Hər 8 saatdan bir avtomatik `updated_at` yenilənməsi
- Cron ilə avtomatik idarə olunur

## Quraşdırma Addımları

1. `database/migrations` qovluğuna `2025_08_01_add_boost_fields_to_posts_table.php` faylını əlavə et və terminalda:

## php artisan migrate işlə.

2. `app/Http/Controllers` qovluğuna `PostBoostController.php` faylını əlavə et.

3. `app/Console/Commands` qovluğuna `BoostPosts.php` faylını əlavə et.

4. `app/Console/Kernel.php` faylında `schedule` funksiyasına əlavə et:

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('boost:posts')->everyTenMinutes();
}

## routes/web.php faylında aşağıdakı route-u əlavə et:



Route::post('/boost-post', [App\Http\Controllers\PostBoostController::class, 'boost'])->name('boost.post');

## İstədiyin Blade faylında (məsələn, account/posts.blade.php) aşağıdakı düymə və modal kodlarını yerləşdir:



@include('account.posts-boost-snippet')
Serverdə cron-un işlədiyindən əmin ol. Məsələn:



* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1

Uğurlar!



