---
name: validate-with-lando
description: Validates code changes using Lando to run PHPUnit tests, Laravel Pint, and Larastan static analysis as defined in .lando.yml. Use when validating changes, before committing, after implementing or fixing code, or when the user asks to verify, lint, analyze, or test the project.
---

# Validate with Lando

Run all validation through Lando from the project root. Do not invoke `./vendor/bin/*` directly on the host.

## Commands

| Check | Command | Underlying tool |
|-------|---------|-----------------|
| Tests | `lando test` | `./vendor/bin/phpunit --testdox` |
| Linter | `lando pint` | `./vendor/bin/pint` |
| Static analysis | `lando larastan` | `./vendor/bin/phpstan analyze --memory-limit=2G` |

## When to run

Run this workflow after making code changes and before reporting the task complete, unless the user explicitly skips validation.

## Workflow

1. **Linter** — `lando pint`
   - If Pint modifies files, review the diff and continue.
2. **Static analysis** — `lando larastan`
   - Fix reported issues before running tests.
3. **Tests** — `lando test`
   - Fix failing tests and re-run from step 1 if code changed.

If any step fails, fix the issues and re-run the failed step (and downstream steps). Do not claim success until all three pass.

## Prerequisites

- Lando must be installed and the app must be running (`lando start` if needed).
- Run commands from the repository root where `.lando.yml` lives.

## Reporting results

Summarize validation in the response:

```markdown
## Validation

- Pint: pass / fail (brief note if fail)
- Larastan: pass / fail (brief note if fail)
- Tests: pass / fail (X passed, Y failed)
```

Include relevant error output when a step fails.

## Optional commands

Only when explicitly requested:

- `lando test-coverage-html` — HTML coverage report in `storage/app/coverage`
- `lando phpunit` — PHPUnit with Xdebug coverage mode enabled
