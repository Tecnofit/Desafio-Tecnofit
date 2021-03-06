<?php

namespace Gym\Domain\Entity;

final class AlunoTreinoExercicioCollection
{
    /**
     * @var AlunoTreinoExercicioEntity[]
     */
    private array $items = [];

    public function __construct() {
        $this->items = [];
    }

    public function append (AlunoTreinoExercicioEntity $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return AlunoTreinoExercicioEntity[]
     */
    public function getList(): array
    {
        return $this->items;
    }

    public function size(): int
    {
        return count($this->items);
    }
    
    public function get(int $index): ?AlunoTreinoExercicioEntity
    {
        return $this->items[$index] ?? null;
    }
    
    public function map(callable $callback): array
    {
        return array_map($callback, $this->items);
    }
}