<?php

class OrderLineRepository
{

    public string $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function getOrderLines(): array {
        $lines = file($this->filePath);

        $result = [];
        foreach ($lines as $line) {
            [$name, $price, $inStock] = explode(';', trim($line));

            $inStock = $inStock === 'true';

            $orderLine = new OrderLine($name, $price, $inStock);
            $result[] = $orderLine;
        }
        return $result;
    }
}
