laravel-didww
======

**NOTE:** This package is no longer in active development. Feel free to fork and extend it as needed.

A simple Laravel interface for interacting with the Didww API.


# Installation
To install the package, simply add the following to your Laravel installation's `composer.json` file:

```json
"require": {
	"laravel/framework": "5.*",
	"blob/laravel-didww": "dev-master"
},
```

Run `composer update` to pull in the files.

Then, add the following **Service Provider** to your `providers` array in your `config/app.php` file:

```php
'providers' => array(
    ...
    Didww\Providers\DidwwServiceProvider::class
);
```

From the command-line run:
`php artisan vendor:publish`

# Configuration

Open `config/didww.php` and configure the api endpoint and credentials:

```php
return [
    // WSDL URL
    'url'       =>	'https://url.com/APIService.asmx?wsdl',

    // WSDL USERNAME
    'username'  =>	'username',

    // WSDL KEY
    'key'       =>	'user_key',

    //WSDL in Test Mode
    'test'      =>	true,
];
```

# Usage
```php
$vi = Didww::getDIDs($client_id);
```
