<?php

namespace Gym\Domain\Entity;

final class TreinoExercicioCollection
{
    /**
     * @var TreinoExercicioEntity[]
     */
    private array $items = [];

    public function __construct() {
        $this->items = [];
    }

    public function append (TreinoExercicioEntity $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return TreinoExercicioEntity[]
     */
    public function getList(): array
    {
        return $this->items;
    }

    public function size(): int
    {
        return count($this->items);
    }
    
    public function get(int $index): ?TreinoExercicioEntity
    {
        return $this->items[$index] ?? null;
    }
}