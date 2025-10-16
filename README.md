[![Latest Version on Packagist](https://img.shields.io/packagist/v/cjmellor/boost-ide-bundle?color=rgb%2856%20189%20248%29&label=release&style=for-the-badge)](https://packagist.org/packages/cjmellor/boost-ide-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/cjmellor/boost-ide-bundle.svg?color=rgb%28249%20115%2022%29&style=for-the-badge)](https://packagist.org/packages/cjmellor/boost-ide-bundle)
![Packagist PHP Version](https://img.shields.io/packagist/dependency-v/cjmellor/boost-ide-bundle/php?color=rgb%28165%20180%20252%29&logo=php&logoColor=rgb%28165%20180%20252%29&style=for-the-badge)
![Laravel Version](https://img.shields.io/badge/laravel-10%20%E2%80%93%2012-rgb(235%2068%2050)?style=for-the-badge&logo=laravel)

# Boost IDE Bundle

Extended IDE support bundle for [Laravel Boost](https://github.com/laravel/boost). It provides a simple, convention-based way to register multiple IDE-aware code environments in your Laravel application.

## Features

- Automatic discovery of environment classes
- Zero configuration — uses Laravel package auto-discovery
- Compatible with Laravel 10, 11, and 12; PHP 8.1+

Included environments:

- `Cline`
- `KiloCode`
- `Kiro`
- `RooCode`
- `Trae`
- `Warp`

> [!WARNING]
> I (the maintainer) don't use all these IDE/Agents, so I cannot guarentee the config locations are correct. If they are wrong, please submit a PR to fix it.

## Requirements

- PHP `^8.1`
- Laravel `^10 | ^11 | ^12`
- Laravel Boost `1.4`

## Installation

Install via Composer:

```bash
composer require cjmellor/boost-ide-bundle --dev

# Ensure Laravel Boost is present in your app (if not already installed)
composer require laravel/boost:^1.4 --dev
```

This package uses Laravel’s auto-discovery. No manual provider registration is needed.

## How It Works

- The service provider scans `src/CodeEnvironments` for `*.php` classes.
- Each class must extend `Laravel\Boost\Install\CodeEnvironment\CodeEnvironment` and implement `name(): string`.
- On boot, the bundle registers each environment with `Laravel\Boost\Boost::registerCodeEnvironment($name, $class)`.

## Usage

Out of the box, the environment classes in `src/CodeEnvironments` are registered automatically.

### Adding Your Own Environment

Create a class in `src/CodeEnvironments` that extends Boost’s `\Laravel\Boost\Install\CodeEnvironment\CodeEnvironment` and implement the required methods.

Drop the file in `src/CodeEnvironments` and it will be discovered automatically on the next boot.

## Conventions

No dedicated configuration file is required; the bundle follows these conventions:

- Files are read from `src/CodeEnvironments`
- Class names must be ucfirst (first letter uppercase)
- `name()` must return a lowercase string

## Contributing

Contributions are welcome! Please:

- Fork the repository and create a feature branch
- Keep changes focused and follow the existing style
- Run `composer lint` before submitting
- Open a pull request and follow the guideline template

## Security Vulnerabilities

Please report any security issues directly to the maintainer via GitHub issues or email.

## License

The MIT License (MIT). See [LICENSE](LICENSE) for details.
