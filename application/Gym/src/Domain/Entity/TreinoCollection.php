<?php

namespace Gym\Domain\Entity;

final class TreinoCollection
{
    /**
     * @var TreinoEntity[]
     */
    private array $items = [];

    public function __construct() {
        $this->items = [];
    }

    public function append (TreinoEntity $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return TreinoEntity[]
     */
    public function getList(): array
    {
        return $this->items;
    }

    public function size(): int
    {
        return count($this->items);
    }
    
    public function get(int $index): ?TreinoEntity
    {
        return $this->items[$index] ?? null;
    }
}