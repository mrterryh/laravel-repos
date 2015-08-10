# Laravel Repos

Small Laravel 5 repositories package to abstract the database layer of your web application.

## Installation

Install the package by running, either by running the following command in your project root:

    $ composer require mrterryh/laravel-repos

Or by adding the following line to the `require` object in your `composer.json` file:

    "mrterryh/laravel-repos": "1.*"

Then run `$ composer update` in your command line to install the dependency.

## Usage

Anywhere within your application, create a new file. The file name convention for this package is `[Model]Repository.php`. Let's use the standard Laravel `User` model for this example.

Create a new file `UserRepository.php` in `app/Repositories`, and create a class within the file that extends ` Mrterryh\Repositories\Base\EloquentRepository`:

    use Mrterryh\Repositories\Base\EloquentRepository;

    class UserRepository extends EloquentRepository
    {
        
    }
    
Then, provide the full, namespaced path of the model in the `$model` property.

    use Mrterryh\Repositories\Base\EloquentRepository;

    class UserRepository extends EloquentRepository
    {
        protected $model = 'App\User';
    }
