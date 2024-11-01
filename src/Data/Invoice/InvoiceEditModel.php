<?php
declare(strict_types=1);

namespace BeelineOrd\Data\Invoice;

/**
 * This class is auto-generated with klkvsk/dto-generator
 * Do not modify it, any changes might be overwritten!
 *
 * @see project://src/Data/dto.schema.php
 *
 * @link https://github.com/klkvsk/dto-generator
 * @link https://packagist.org/klkvsk/dto-generator
 */
class InvoiceEditModel implements \JsonSerializable
{
    protected ?string $number;
    protected \DateTimeInterface $date;
    protected \DateTimeInterface $startDate;
    protected \DateTimeInterface $endDate;
    protected float $amount;
    protected ?bool $isVat;
    protected InvoiceOrganizationRole $customerRole;
    protected InvoiceOrganizationRole $executorRole;
    protected bool $isReadyForErir;

    public function __construct(
        \DateTimeInterface $date,
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
        float $amount,
        InvoiceOrganizationRole $customerRole,
        InvoiceOrganizationRole $executorRole,
        bool $isReadyForErir,
        ?string $number = null,
        ?bool $isVat = null
    ) {
        $this->number = $number;
        $this->date = $date;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->amount = $amount;
        $this->isVat = $isVat;
        $this->customerRole = $customerRole;
        $this->executorRole = $executorRole;
        $this->isReadyForErir = $isReadyForErir;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function getStartDate(): \DateTimeInterface
    {
        return $this->startDate;
    }

    public function getEndDate(): \DateTimeInterface
    {
        return $this->endDate;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getIsVat(): ?bool
    {
        return $this->isVat;
    }

    public function getCustomerRole(): InvoiceOrganizationRole
    {
        return $this->customerRole;
    }

    public function getExecutorRole(): InvoiceOrganizationRole
    {
        return $this->executorRole;
    }

    public function getIsReadyForErir(): bool
    {
        return $this->isReadyForErir;
    }

    protected static function required(): array
    {
        return ['date', 'startDate', 'endDate', 'amount', 'customerRole', 'executorRole', 'isReadyForErir'];
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "number":
                yield \Closure::fromCallable('strval');
                break;

            case "date":
            case "startDate":
            case "endDate":
                yield static fn ($d) => new \DateTimeImmutable($d);
                break;

            case "amount":
                yield \Closure::fromCallable('floatval');
                break;

            case "isVat":
            case "isReadyForErir":
                yield \Closure::fromCallable('boolval');
                break;

            case "customerRole":
            case "executorRole":
                yield fn ($data) => call_user_func([ '\BeelineOrd\Data\Invoice\InvoiceOrganizationRole', 'from' ], $data);
                break;
        };
    }

    /**
     * @return static
     */
    public static function create(array $data): self
    {
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
            $constructorParams["date"],
            $constructorParams["startDate"],
            $constructorParams["endDate"],
            $constructorParams["amount"],
            $constructorParams["customerRole"],
            $constructorParams["executorRole"],
            $constructorParams["isReadyForErir"],
            $constructorParams["number"] ?? null,
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
