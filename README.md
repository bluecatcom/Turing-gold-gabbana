# Turing-gold-gabbana

## Requirements

- PHP 8.1 or higher
- Modern web browser

## How to run

In the project's root directory:

```bash
php -S localhost:8000 -t public

```

Open `http://localhost:8000` in your browser. Do not open `index.php` directly as a local file, as PHP needs to be executed by the server.

## How it works

Each rule follows the format `"read symbol" => ["write", "move", "next state"]` and is grouped by the current state. Movements: `L` (left), `R` (right), and `S` (stay). `_` represents blank.

The `executarPasso()` method applies a single transition, `executar()` runs up to a defined number of steps, the tape is represented by an integer-indexed array supporting negative indices, and uninitialized positions are read as `_`.

The engine distinguishes final states (`aceita` or `rejeita`), missing transitions (`erro`), and step limits (`limite`).

## Structure:

```
.
├── algorithms
│   └── Machines.php
├── public
│   └── index.php
├── src
│   └── TuringMachine.php
├── README.md

```