sargilla/curl
================

Custom PHP cURL library for the Laravel 5 framework  

## Installation

Pull this package in through Composer.

```js

    {
        "require": {
            "sargilla/curl": "1.*"
        }
    }

```


### Laravel 5.* Integration

Add the service provider to your `config/app.php` file:

```php

    'providers'     => array(

        //...
        Sargilla\Curl\CurlServiceProvider::class,

    ),

```

Add the facade to your `config/app.php` file:

```php

    'facades'       => array(

        //...
        'Curl'          => Sargilla\Curl\Facades\Curl::class,

    ),

```


### Integration without Laravel

Create a new instance of the `CurlService` where you would like to use the package:

```php

    $curlService = new \Sargilla\Curl\CurlService();

```




## Usage

### Laravel usage

The package provides an easy interface for sending cURL requests from your application. The package provides a fluent interface similar the Laravel query builder to easily configure the request. There are several utility methods that allow
you to easily add certain options to the request.

### Sending GET requests

In order to send a `GET` request, you need to use the `get()` method that is provided by the package:

```php

    // Send a GET request to: http://www.foo.com/bar
    $response = Curl::to('http://www.foo.com/bar')
        ->get();

    // Send a GET request to: http://www.foo.com/bar?foz=baz
    $response = Curl::to('http://www.foo.com/bar')
        ->withData( array( 'foz' => 'baz' ) )
        ->get();

    // Send a GET request to: http://www.foo.com/bar?foz=baz using JSON
    $response = Curl::to('http://www.foo.com/bar')
        ->withData( array( 'foz' => 'baz' ) )
        ->asJson()
        ->get();

```


### Sending POST requests

Post requests work similar to `GET` requests, but use the `post()` method instead:

```php

    // Send a POST request to: http://www.foo.com/bar
    $response = Curl::to('http://www.foo.com/bar')
        ->post();

    // Send a POST request to: http://www.foo.com/bar
    $response = Curl::to('http://www.foo.com/bar')
        ->withData( array( 'foz' => 'baz' ) )
        ->post();

    // Send a POST request to: http://www.foo.com/bar with arguments 'foz' = 'baz' using JSON
    $response = Curl::to('http://www.foo.com/bar')
        ->withData( array( 'foz' => 'baz' ) )
        ->asJson()
        ->post();

    // Send a POST request to: http://www.foo.com/bar with arguments 'foz' = 'baz' using JSON and return as associative array
    $response = Curl::to('http://www.foo.com/bar')
        ->withData( array( 'foz' => 'baz' ) )
        ->asJson( true )
        ->post();

```

### Downloading files

For downloading a file, you can use the `download()` method:

```php

    // Download an image from: file http://www.foo.com/bar.png
    $response = Curl::to('http://foo.com/bar.png')
        ->withContentType('image/png')
        ->download('/path/to/dir/image.png');

```


### Usage without Laravel

Usage without Laravel is identical to usage described previously. The only difference is that you will not be able to 
use the facades to access the `CurlService`.

```php

    $curlService = new \Sargilla\Curl\CurlService();

    // Send a GET request to: http://www.foo.com/bar
    $response = $curlService->to('http://www.foo.com/bar')
        ->get();
        
    // Send a POST request to: http://www.foo.com/bar
    $response = $curlService->to('http://www.foo.com/bar')
        ->post();

```







## License

This template is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)




## Contact

Santiago Argilla (developer)

- Email: sargilla@gmail.com
