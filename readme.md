# Abonews

Un module laravel pour ajouter / supprimer des subscribeurs à une newsletter.
(Dev sur mesure)

## Installation automatically (not working)

Via Composer

``` bash
$ composer require yoan1005/abonews
```

## Installation manually (use it)

In your composer.json
``` bash
"autoload": {
    "classmap": [
        "database/seeds",
        "database/factories",
      ==>  "packages"
    ],
    "psr-4": {
        "App\\": "app/",
      ==>  "Yoan1005\\Abonews\\": "packages/Yoan1005/Abonews/src"
    }
},
```
``` bash
composer dump-autoload
```
## Usage

Download via composer the package

Si Laravel > 5.5, le package sera automatiquement chargé par l'auto-discover
Sinon ajouter le serviceProvider dans le config/app.php

``` bash
  Yoan1005\Abonews\AbonewsServiceProvider::class
```


Pour transférer les configs/assets/etc… du package, utiliser la commande publish:
``` bash
php artisan vendor:publish --provider="Yoan1005\Abonews\AbonewsServiceProvider"
```

## Todo


## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.


## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email yo instead of using the issue tracker.

## Credits

- [Yoan Fournier][link-author]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/yoan1005/abonews.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/yoan1005/abonews.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/yoan1005/abonews/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/yoan1005/abonews
[link-downloads]: https://packagist.org/packages/yoan1005/abonews
[link-travis]: https://travis-ci.org/yoan1005/abonews
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/yoan1005
[link-contributors]: ../../contributors
