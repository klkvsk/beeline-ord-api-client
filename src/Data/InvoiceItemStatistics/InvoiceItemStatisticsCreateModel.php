<?php
declare(strict_types=1);

namespace BeelineOrd\Data\InvoiceItemStatistics;

/**
 * This class is auto-generated with klkvsk/dto-generator
 * Do not modify it, any changes might be overwritten!
 *
 * @see project://src/Data/dto.schema.php
 *
 * @link https://github.com/klkvsk/dto-generator
 * @link https://packagist.org/klkvsk/dto-generator
 */
class InvoiceItemStatisticsCreateModel extends InvoiceItemStatisticsEditModel implements \JsonSerializable
{
    protected int $invoiceItemId;
    protected int $creativeId;
    protected int $platformId;

    public function __construct(
        int $actualImpressionsCount,
        int $plannedImpressionsCount,
        \DateTimeInterface $plannedStartDate,
        \DateTimeInterface $plannedEndDate,
        \DateTimeInterface $actualStartDate,
        \DateTimeInterface $actualEndDate,
        float $totalAmount,
        float $amountPerShow,
        int $invoiceItemId,
        int $creativeId,
        int $platformId,
        ?bool $isVat = null
    ) {
        parent::__construct(
            $actualImpressionsCount,
            $plannedImpressionsCount,
            $plannedStartDate,
            $plannedEndDate,
            $actualStartDate,
            $actualEndDate,
            $totalAmount,
            $amountPerShow,
            $isVat
        );
        $this->invoiceItemId = $invoiceItemId;
        $this->creativeId = $creativeId;
        $this->platformId = $platformId;
    }

    public function getInvoiceItemId(): int
    {
        return $this->invoiceItemId;
    }

    public function getCreativeId(): int
    {
        return $this->creativeId;
    }

    public function getPlatformId(): int
    {
        return $this->platformId;
    }

    protected static function defaults(): array
    {
        return array_merge(
            method_exists(parent::class, "defaults") ? parent::defaults() : [],
            []
        );
    }

    protected static function required(): array
    {
        return array_merge(
            method_exists(parent::class, "required") ? parent::required() : [],
            ['invoiceItemId', 'creativeId', 'platformId']
        );
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "invoiceItemId":
            case "creativeId":
            case "platformId":
                yield \Closure::fromCallable('intval');
                break;

            default:
                if (method_exists(parent::class, "importers")) {
                    yield from parent::importers($key);
                };
        };
    }

    /**
     * @return static
     */
    public static function create(array $data): self
    {
        // defaults
        $data += static::defaults();

        // check required
        if ($diff = array_diff(static::required(), array_keys($data))) {
            throw new \InvalidArgumentException("missing keys: " . implode(", ", $diff));
        }

        // import
        $constructorParams = [];
        foreach ($data as $key => $value) {
            foreach (static::importers($key) as $importer) if ($value !== null) {
                $value = call_user_func($importer, $value);
            }
            if (property_exists(static::class, $key)) {
                $constructorParams[$key] = $value;
            }
        }

        // create
        /** @psalm-suppress PossiblyNullArgument */
        return new static(
            $constructorParams["actualImpressionsCount"],
            $constructorParams["plannedImpressionsCount"],
            $constructorParams["plannedStartDate"],
            $constructorParams["plannedEndDate"],
            $constructorParams["actualStartDate"],
            $constructorParams["actualEndDate"],
            $constructorParams["totalAmount"],
            $constructorParams["amountPerShow"],
            $constructorParams["invoiceItemId"],
            $constructorParams["creativeId"],
            $constructorParams["platformId"],
            $constructorParams["isVat"] ?? null
        );
    }

    public function toArray(): array
    {
        $array = [];
        foreach (get_object_vars($this) as $var => $value) {
            if ($value instanceof \DateTimeInterface) {
                $value = $value->format('Y-m-d\TH:i:sP');
            }
            if (is_object($value) && method_exists($value, 'toArray')) {
                $value = $value->toArray();
            }
            if (class_exists(\UnitEnum::class) && $value instanceof \UnitEnum) {
                $value = $value->value;
            }
            if (is_object($value) && method_exists($value, "__toString")) {
                $value = (string)$value;
            }
            $array[$var] = $value;
        }
        return $array;
    }

    public function jsonSerialize(): array
    {
        $array = [];
        foreach (get_object_vars($this) as $var => $value) {
            if ($value instanceof \DateTimeInterface) {
                $value = $value->format('Y-m-d\TH:i:sP');
            }
            if ($value instanceof \JsonSerializable) {
                $value = $value->jsonSerialize();
            }
            if (class_exists(\UnitEnum::class) && $value instanceof \UnitEnum) {
                $value = $value->value;
            }
            if (is_object($value) && method_exists($value, "__toString")) {
                $value = (string)$value;
            }
            $array[$var] = $value;
        }
        return $array;
    }
}
