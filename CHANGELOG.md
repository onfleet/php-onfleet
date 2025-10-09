# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
## [1.1.0] - 2025-10-09
### Added
- New CRUD operations for Route Plans
- New `create` endpoint
- New `get` endpoint(s) that support both id and query
- New `update` endpoint
- New `deleteOne` endpoint
- New `addTasksToRoutePlan` endpoint

## [1.0.6] - 2024-11-04
### Added
- New `getTasks` endpoints for Teams and Workers
- Added Custom field support for node API wrapper

## [1.0.5] - 2024-05-17
### Added
- Added support for Worker's Route Delivery Manifest

## [1.0.4] - 2023-10-05
### Fixed
- Removed library that causes conflicts with Laravel framework

## [1.0.3] - 2023-06-22
### Fixed
- Fixed issue when getting data from workers and tasks

## [1.0.2] - 2022-04-28
### Fixed
- The wrapper complies with PSR-4 standard
- The second parameter for Onfleet class is optional

## [1.0.1] - 2022-03-02
### Fixed
- Fixed HTTP method to create a worker

## [1.0.0] - 2021-12-17
### Added
- Initial release on packagist

[Unreleased]: https://github.com/onfleet/php-onfleet/compare/v1.0.4...HEAD
[1.0.0]: https://github.com/onfleet/php-onfleet/releases/tag/v1.0.0
[1.0.1]: https://github.com/onfleet/php-onfleet/compare/v1.0.0...v1.0.1
[1.0.2]: https://github.com/onfleet/php-onfleet/compare/v1.0.1...v1.0.2
[1.0.3]: https://github.com/onfleet/php-onfleet/compare/v1.0.2...v1.0.3
[1.0.4]: https://github.com/onfleet/php-onfleet/compare/v1.0.3...v1.0.4
[1.1.0]: https://github.com/onfleet/php-onfleet/compare/v1.0.6...v1.1.0