<?php
// Basic configuration for the demo app.
define('APP_NAME', 'Arc Estate');
define('APP_CURRENCY', 'USD');

function currency_symbol(string $code): string {
    return match (strtoupper($code)) {
        'USD' => '$',
        'EUR' => '€',
        'GBP' => '£',
        'AED' => 'د.إ',
        default => '$',
    };
}

function format_price(float $price, string $currency = 'USD'): string {
    $symbol = currency_symbol($currency);
    if (in_array(strtoupper($currency), ['JPY'], true)) {
        return $symbol . number_format($price, 0);
    }
    return $symbol . number_format($price, 0, '.', ',');
}
