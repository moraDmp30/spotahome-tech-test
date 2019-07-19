# Spotahome Technical Exercise

## Application
 
This application is built with [Laravel](https://laravel.com/docs/5.8) 5.8, requiring:

- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension

## Installation

For local development purposes, the simplest setup is to use [Laravel Homestead](https://laravel.com/docs/homestead). The recommended vagrant box version is `>= 7.2.1`, and Homestead version `>= 8.3.2`.

Add this block to your `sites` section on your `Homestead.yaml` file:

```
- map: www.spotahome-tech-test.test
  to: <your_project_folder>/public
  php: "7.3"
```

Run `vagrant provision` once you've completed all these steps.

Next, update the `/etc/hosts` (on macOS/Linux systems, `C:\Windows\System32\Drivers\etc\hosts` on Windows systems) on your host machine to point `www.spotahome-tech-test.test` to your Homestead box IP (`192.168.10.10` by default).

Once all these steps have been completed, you can install every required package running from the root project folder:

- `cp .env.example .env`. Update all required data in the new `.env` file with your local data.
- `npm install` (version `6.9.0` at the moment this documentation was written).
- `composer install`.

To compile assets, you must run:

- `npm run dev` Compiles assets without minimizing and versioning them.
- `npm run watch` Same as above, but it keeps listening for changes and will compile them automatically.
- `npm run prod` Compiles assets minimizing and versioning them. These will be the version uploaded to production.

## Maintainers

- Daniel Mora Pastor - mora@square1.io