# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
### Changed
### Deprecated
### Removed
### Fixed
### Security

## [1.0.0] - 2024-02-05

### Added

- Twig extension `RouterExtension` from `fhooe/twig-extensions` that makes the `urlFor()` and `getBasePath()` methods
  from the router available in Twig templates as `url_for()` and `get_base_path()`.
- Twig extension `SessionExtension` from `fhooe/twig-extensions` that provides a `session(key)` function to access
  entries from the session superglobal in Twig templates.
- Introduced an icon for `fhooe/router` and `fhooe/router-skeleton`.

### Changed

- Switched to PHP 8.3 as a minimum requirement.
- Updated all dependencies.
- Updated all views/templates to match fhooe-web-dock with dark mode support.

### Removed

- `twbs/bootstrap` and `twbs/bootstrap-icons` as dependencies. They are now loaded from included files and SVGs to
  reduce installation time.
- `composer.lock` is now excluded from version control for more flexibility.

## [0.3.1] - 2022-02-17

### Changed

- Make `.gitignore` exclude PhpStorm and Visual Studio Code project directories.
- Bumped phpstan/phpstan to v1.4.6
- Bumped twbs/bootstrap-icons to v1.8.1
- Bumped twig/twig to v3.3.8

### Fixed

- Fixed that `.gitignore` would only ignore `router.log` files. All files are now excluded.

## [0.3.0] - 2022-01-24

### Added

- Added hierarchical Twig templates. `base.html.twig` acts as the parent template for all other Twig templates and gets
  selectively overwritten.
- Added a static HTML view for demonstration purposes.
- Added Twig debug extension for easier template debugging.
- Added hint where to start a session and included the session superglobal into the Twig templates if present.

### Changed

- Updated to fhooe/router v0.3.0.
- Bumped phpstan/phpstan to 1.4.
- The result for "GET /form" (PHP form example) is now shown in the same view as "POST /form"
- The Twig form example is now split up in "GET /twigform" and "POST /twigformresult".
- Main page is now displayed using Twig.
- 404 page is now displayed using Twig.
- Base path is not set automatically. The respective line is commented out so it can easily be included.
- The 404 handler is now set with an arrow function to demonstrate their usage as well as the automatic inclusion of
  variables from the parent scope.

### Removed

- Removed the debugging block that enabled PHP errors. This should be done the webserver configuration.

## [0.2.0] - 2021-12-22

### Added

- Added the Twig template engine for creating views and configured it to load automatically. See
  also [1: Add twig templates as views](https://github.com/Digital-Media/fhooe-router-skeleton/issues/1).
- Added an example form example view using Twig under "GET /twigview". See
  also [1: Add twig templates as views](https://github.com/Digital-Media/fhooe-router-skeleton/issues/1).
- Added Monolog as a logger instance and configured it to output application logs into a file. See
  also [2: Add monolog as logger instance](https://github.com/Digital-Media/fhooe-router-skeleton/issues/2).
- Added a view for "POST /formresult" using Bootstrap. See
  also: [3: Use Bootstrap for enhanced views](https://github.com/Digital-Media/fhooe-router-skeleton/issues/3).

### Changed

- Updated to fhooe/router v0.2.0.
- Updated the view for "GET /" using Bootstrap. See
  also: [3: Use Bootstrap for enhanced views](https://github.com/Digital-Media/fhooe-router-skeleton/issues/3).
- Updated the view for "GET /form" using Bootstrap. See
  also: [3: Use Bootstrap for enhanced views](https://github.com/Digital-Media/fhooe-router-skeleton/issues/3).
- Updated the 404 view using Bootstrap. See
  also [3: Use Bootstrap for enhanced views](https://github.com/Digital-Media/fhooe-router-skeleton/issues/3).

## [0.1.0] - 2021-12-16

### Added

- Added an example invocation of the router in `index.php`.
- Added three example views for the main page, a form submission and a 404 page.
- Added a `.htaccess` file which redirects all requests back to `index.php`.
- Set up `composer.json` for the use with [Composer](https://getcomposer.org/) and [Packagist](https://packagist.org/).
- Added [phpstan](https://packagist.org/packages/phpstan/phpstan) for code analysis.
- Added extensive `README.md`.
- Added notes on Contributing.
- Added this changelog.

[Unreleased]: https://github.com/Digital-Media/fhooe-router-skeleton/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/Digital-Media/fhooe-router-skeleton/compare/v0.3.1...v1.0.0
[0.3.1]: https://github.com/Digital-Media/fhooe-router-skeleton/compare/v0.3.0...v0.3.1
[0.3.0]: https://github.com/Digital-Media/fhooe-router-skeleton/compare/v0.2.0...v0.3.0
[0.2.0]: https://github.com/Digital-Media/fhooe-router-skeleton/compare/v0.1.0...v0.2.0
[0.1.0]: https://github.com/Digital-Media/fhooe-router-skeleton/releases/tag/v0.1.0
