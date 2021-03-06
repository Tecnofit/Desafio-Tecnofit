<?php

namespace Gym\Domain\Entity;

final class AlunoTreinoCollection
{
    /**
     * @var AlunoTreinoEntity[]
     */
    private array $items = [];

    public function __construct() {
        $this->items = [];
    }

    public function append (AlunoTreinoEntity $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return AlunoTreinoEntity[]
     */
    public function getList(): array
    {
        return $this->items;
    }

    public function size(): int
    {
        return count($this->items);
    }
    
    public function get(int $index): ?AlunoTreinoEntity
    {
        return $this->items[$index] ?? null;
    }
}