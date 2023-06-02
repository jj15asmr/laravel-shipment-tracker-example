# 📦 Laravel Shipment Tracker Example

![](https://github.com/jj15asmr/laravel-shipment-tracker-example/blob/1eba88a4a07b5e8d53db06775a2f362697639b80/github-banner.png)

This is a simple implementation of a shipment/item tracker, similar to the ones provided by USPS, FedEx, UPS, etc. I started creating it as a little "practice project" over this past Memorial Day weekend.

As the name suggests, it's built with Laravel (v10.12.0) as well as Livewire. Bootstrap 5 is used for the design.

It provides a single route *(there is no admin panel or the like)* to a full-page Livewire component where you are able to enter the tracking number of an item **and...**

* View it's current status (Picked Up, In Transit, Dispatched, or Delivered) on a nice-looking progress bar. An item can also have the status of "In System" (meaning that the item isn't yet in the possesion of the courier service) which will show an alert instead.

* View the details of the sender and receiver as well as the item's details (ship date, shipment type, weight).

* View the item's "tracking events", such as where/when the item was picked up, delivered, etc.

* The tab title also changes to reflect the item's status and it's tracking number.

This project is licensed under the MIT License - see the [LICENSE](LICENSE.txt) file for details.

## Installation

1. Download (and extract) or clone this project's repository to your local machine or server.

2. Enter the project's directory and via the terminal execute the following commands:
    ```bash
    composer install

    cp .env.example .env

    php artisan key:generate
    ```

3. In the ``.env`` file ensure that your database details are correct and then run the below command:
    ```bash
    php artisan migrate --seed
    ```

    Your database should now be filled with the required tables and 12 items/shipments with up to 12 tracking events (if their status is other than "In System").

4. Lastly, ensure that the ``APP_URL`` and ``ASSET_URL`` keys in the ``.env`` file are correct for your case and then run the below command to host the project locally on your machine:
    ```bash
    php artisan serve
    ```

    Go to the URL given in your browser and you should be all set! Pick a tracking number from the DB to lookup and have fun.

### Running Tests

This project, as any good one should 😉, includes automated tests powered by PHPUnit. You can run them by running the below command:

```bash
php artisan test --order-by random
```

If you'd like to view or edit the tests you can find them all within the ``tests/Feature`` directory, organized accordingly.

Any tests that involve the DB are configured to use an in-memory SQLite database, if you'd like to change this, you can do so in the ``phpunit.xml`` file in the project's root.

## Credits

I built this project using these awesome things made by awesome people, here's a big thanks to them:

* [Laravel](https://github.com/laravel/laravel)
* [Livewire](https://github.com/livewire/livewire)
* [PHPUnit](https://github.com/sebastianbergmann/phpunit)
* [Bootstrap](https://github.com/twbs/bootstrap)
* [Bootstrap Order Tracking Snippet](https://bbbootstrap.com/snippets/order-tracking-template-all-details-34023037)
* [Font Awesome](https://github.com/FortAwesome/Font-Awesome)
* [Animate.css](https://github.com/animate-css/animate.css)
* [Bunny Fonts](https://fonts.bunny.net/)

## Extra Notes

I've only been working with Laravel for about 6 months now so I'm still a beginner. 😁 If you spot anything wrong with my code or it's design then please feel free to submit an issue or PR.

Also, if you're curious about what "PoŝtaLoĝistiko" means, it's Esperanto for "Postal Logistics" (or it's supposed to be, I used Google Translate...) I just thought it sounded "cool".
