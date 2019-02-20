<?php
declare(strict_types=1);

namespace Samius\Math;

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

    public function getPercent(): float
    {
        if ((string)$this->getTotal() === (string)0.0) { //can not compare floats with ===
            if ((string)$this->amount !== (string) 0.0) {
                throw new \OutOfBoundsException("Can not divide by zero ({$this->amount} / 0)");
            }
            return 0; // 0/0 = 0
        }
        return 100*$this->getAmount() / $this->getTotal();
    }


    public function getRoundPercent(): int
    {
        return (int)round($this->getPercent());
    }
}
