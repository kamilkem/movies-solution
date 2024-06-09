# movies-solution

[![CI](https://github.com/kamilkem/movies-solution/actions/workflows/ci.yml/badge.svg)](https://github.com/kamilkem/movies-solution/actions/workflows/ci.yml)

## Setup

1. Run compose `docker compose up --wait`
2. Open php container `docker exec -it movies-solution-php-1 bash`

## Static tests

Run in php container `composer ci:check`
