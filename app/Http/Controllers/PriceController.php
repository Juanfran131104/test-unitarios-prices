<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use InvalidArgumentException;

class PriceController extends Controller
{
    private const EUR_TO_USD_RATE = 1.08;

    public function convertEurToUsd(float $amount): float
    {
        return $amount * self::EUR_TO_USD_RATE;
    }

    
    public function convertUsdToEur(float $amount): float
    {
        return $amount / self::EUR_TO_USD_RATE;
    }

    public function calculateDiscount(float $price, float $discountPercentage): float
    {
        if ($discountPercentage < 0 || $discountPercentage > 100) {
            throw new InvalidArgumentException("El porcentaje de descuento debe estar entre 0 y 100.");
        }
        
        $discountAmount = $price * ($discountPercentage / 100);
        
        return $price - $discountAmount;
    }
}