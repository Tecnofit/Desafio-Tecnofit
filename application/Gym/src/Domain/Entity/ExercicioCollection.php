<?php

namespace Gym\Domain\Entity;

final class ExercicioCollection
{
    /**
     * @var ExercicioEntity[]
     */
    private array $items = [];

    public function __construct() {
        $this->items = [];
    }

    public function append (ExercicioEntity $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return ExercicioEntity[]
     */
    public function getList(): array
    {
        return $this->items;
    }

    public function size(): int
    {
        return count($this->items);
    }
    
    public function get(int $index): ?ExercicioEntity
    {
        return $this->items[$index] ?? null;
    }
}