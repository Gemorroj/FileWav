# AGENTS.md

## Project
PHP library for parsing WAV files (`FileWav\`, PSR-4, `src/`).

## Environment
- PHP >= 8.2 required.
- Dependencies managed via Composer (`composer install`).
- Tests live in `tests/`, config in `phpunit.xml.dist`.

## Commands
- Install: `composer install`
- Run tests: `composer test` or `vendor/bin/phpunit`
- Fix code style: `vendor/bin/php-cs-fixer fix`

## Code Style
- Follow PSR-12 and existing code in `src/`.
- Use strict types (`declare(strict_types=1);`) in new files.
- Keep classes small and focused on WAV parsing; avoid new external dependencies.
- Run php-cs-fixer before committing.

## Workflow
- Keep changes minimal and focused.
- Add or update tests for behavior changes.
- Ensure tests pass before finishing.

## Conventions
- Commit messages follow [Conventional Commits](https://www.conventionalcommits.org/).
