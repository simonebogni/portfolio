---
name: validate-with-lando
description: Validates code changes using Lando to run Rector, Laravel Pint, Larastan static analysis, and Pest tests as defined in .lando.yml. Use when validating changes, before committing, after implementing or fixing code, or when the user asks to verify, lint, analyze, or test the project.
---

# Validate with Lando

Run all validation through Lando from the project root. Do not invoke `./vendor/bin/*` directly on the host.

## Commands

| Check | Command | Underlying tool |
|-------|---------|-----------------|
| Refactoring | `lando rector` | `./vendor/bin/rector process` |
| Linter | `lando pint` | `./vendor/bin/pint` |
| Static analysis | `lando larastan` | `./vendor/bin/phpstan analyze --memory-limit=2G` |
| Tests | `lando test` | `./vendor/bin/pest --parallel` |

## When to run

Run this workflow after making code changes and before reporting the task complete, unless the user explicitly skips validation.

## Workflow

1. **Refactoring** — `lando rector`
   - If Rector modifies files, review the diff and continue. Use `lando rector --dry-run` to preview.
2. **Linter** — `lando pint`
   - If Pint modifies files, review the diff and continue.
3. **Static analysis** — `lando larastan`
   - Fix reported issues before running tests.
4. **Tests** — `lando test`
   - Runs the Arch, Unit and Feature suites in parallel.
   - Fix failing tests and re-run from step 1 if code changed.

If any step fails, fix the issues and re-run the failed step (and downstream steps). Do not claim success until all four pass.

## Prerequisites

- Lando must be installed and the app must be running (`lando start` if needed).
- Run commands from the repository root where `.lando.yml` lives.

## Reporting results

Summarize validation in the response:

```markdown
## Validation

- Rector: pass / fail (brief note if fail)
- Pint: pass / fail (brief note if fail)
- Larastan: pass / fail (brief note if fail)
- Tests: pass / fail (X passed, Y failed)
```

Include relevant error output when a step fails.

## Optional commands

Only when explicitly requested:

- `lando test-coverage-html` — HTML coverage report in `storage/app/coverage`
- `lando pest` — Pest with Xdebug coverage mode enabled (e.g. `lando pest --coverage`)
- `lando test --testsuite=Arch` — run a single suite (Arch, Unit or Feature)

## Testing conventions

- Tests are written with [Pest](https://pestphp.com); shared setup lives in `tests/Pest.php`.
- `tests/Arch` holds architecture rules, `tests/Unit` framework-free unit tests, `tests/Feature` tests that boot Laravel and use `RefreshDatabase`.
- The testing environment is configured in `.env.testing` (SQLite in memory, array cache/session/mail).
