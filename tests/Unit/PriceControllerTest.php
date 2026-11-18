<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\PriceController;
use InvalidArgumentException;

class PriceControllerTest extends TestCase
{
    protected PriceController $priceController;

    protected function setUp(): void
    {
        parent::setUp();
        $this->priceController = new PriceController();
    }

    public function test_it_converts_euros_to_usd_correctly()
    {
        $euros = 100;
        $expectedUsd = 108.0; 
        $this->assertEquals($expectedUsd, $this->priceController->convertEurToUsd($euros));
    }

    public function test_it_converts_usd_to_euros_correctly()
    {
        $usd = 108;
        $expectedEuros = 100.0; 

        $this->assertEquals($expectedEuros, $this->priceController->convertUsdToEur($usd));
    }

    public function test_it_calculates_discount_correctly()
    {
        $price = 200.0;
        $discount = 15.0; 
        
        $expectedPrice = 170.0;

        $this->assertEquals($expectedPrice, $this->priceController->calculateDiscount($price, $discount));
    }

    public function test_it_handles_100_percent_discount()
    {
        $price = 50.0;
        $discount = 100.0; 
        
        $this->assertEquals(0.0, $this->priceController->calculateDiscount($price, $discount));
    }

    public function test_it_throws_an_exception_if_discount_is_invalid()
    {
        $this->expectException(InvalidArgumentException::class);
        
        $this->priceController->calculateDiscount(100.0, 150.0);
    }
}