# Shared Drawing w/ WebSockets

The purpose of this project is to test the [Websockets for Laravel](https://github.com/beyondcode/laravel-websockets) package developed by Marcel Pociot & Freek Van der Herten as replacement for services like Pusher. 

## Usage

1. Clone the repository
2. composer install
3. npm install
4. cp .env.example .env
	1. Configure .env properly, you will need a working queue driver.
	2. A database. A sqlite may work fine for this little project.
5. php artisan key:generate
6. php artisan migrate
7. php artisan websockets:serve
8. php artisan queue:work —delay=3

## How does it work?

Create an account (localhost:8000/register) and go to the main page. Open the same page in multiple browser windows and whatever is draw in the whiteboard should be replicated on every other window. 

It is also possible to create a room, which consist of a random string combination to create a kind of private broadcasting scope that doesn't affect other rooms.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.