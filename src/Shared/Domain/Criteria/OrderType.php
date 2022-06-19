<?php
declare(strict_types=1);

namespace Src\Shared\Domain\Criteria;

use Src\Shared\Domain\ValueObjects\EnumVO;
use InvalidArgumentException;

/**
 * @method static desc()
 * @method static none()
 */
final class OrderType extends EnumVO
{
    public const ASC  = 'asc';
    public const DESC = 'desc';
    public const NONE = 'none';

    public function isNone(): bool
    {
        return $this->equals(self::none());
    }

    protected function throwExceptionForInvalidValue($value): void
    {
        throw new InvalidArgumentException($value);
    }
}
