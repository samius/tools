<?php
declare(strict_types=1);

namespace Samius\Math;

use DivisionByZeroError;

/**
 * Class for calculating percents
 */
class PercentHolder
{
    private $amount;


    private $total;


    public function __construct(float $amount = 0, float $total = 0)
    {
        $this->amount = $amount;
        $this->total = $total;
    }

    public static function create(float $amount = 0, float $total = 0)
    {
        return new self($amount, $total);
    }

    public function increaseAmount(): PercentHolder
    {
        return $this->addAmount(1);
    }

    public function increaseTotal(): PercentHolder
    {
        return $this->addTotal(1);
    }

    public function addAmount(float $amount): PercentHolder
    {
        $this->amount += $amount;
        return $this;
    }

    public function addTotal(float $total): PercentHolder
    {
        $this->total += $total;
        return $this;
    }

    public function addPercentHolder(PercentHolder $percentHolder): PercentHolder
    {
        $this->total += $percentHolder->getTotal();
        $this->amount += $percentHolder->getAmount();
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @return float
     */
    public function getPercent(): float
    {
        return self::percent($this->amount, $this->total);
    }

    /**
     * @param float $amount
     * @param float $total
     * @return float
     */
    public static function percent(float $amount, float $total):float
    {
        if ((string)$total === (string)0.0) { //can not compare floats with ===
            if ((string)$amount !== (string)0.0) {
                throw new DivisionByZeroError("Can not divide by zero ({$amount} / 0)");
            }
            return 0; // 0/0 = 0
        }
        return 100 * $amount / $total;
    }

    /**
     * @return int
     */
    public function getRoundPercent(): int
    {
        return (int)round($this->getPercent());
    }
}
