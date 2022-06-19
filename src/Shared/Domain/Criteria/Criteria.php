<?php
declare(strict_types=1);

namespace Src\Shared\Domain\Criteria;

final class Criteria
{
    private array $filters;
    private Order $order;
    private ?int  $offset;
    private ?int  $limit;

    public function __construct(array $filters, Order $order, ?int $offset, ?int $limit)
    {
        $this->filters = $filters;
        $this->order   = $order;
        $this->offset  = $offset;
        $this->limit   = $limit;
    }

    public function hasFilters(): bool
    {
        return count($this->filters) > 0;
    }

    public function hasOrder(): bool
    {
        return !$this->order->isNone();
    }

    public function filters(): array
    {
        return $this->filters;
    }

    public function order(): Order
    {
        return $this->order;
    }

    public function offset(): int
    {
        return $this->offset ?? 0;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }
}
