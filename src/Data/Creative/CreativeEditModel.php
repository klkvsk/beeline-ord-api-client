<?php
declare(strict_types=1);

namespace BeelineOrd\Data\Creative;

/**
 * This class is auto-generated with klkvsk/dto-generator
 * Do not modify it, any changes might be overwritten!
 *
 * @see project://src/Data/dto.schema.php
 *
 * @link https://github.com/klkvsk/dto-generator
 * @link https://packagist.org/klkvsk/dto-generator
 */
class CreativeEditModel implements \JsonSerializable
{
    protected CreativeType $type;
    protected CreativeForm $form;
    protected string $description;
    protected bool $isSocial;
    protected bool $isNative;

    /** @var array<CreativeUrl> $urls */
    protected array $urls;

    /** @var ?array<KktuCode> $kktuCode */
    protected ?array $kktuCode;
    protected ?string $targetAudienceDescription;
    protected bool $isReadyForErir;
    protected int $initialContractId;

    public function __construct(
        CreativeType $type,
        CreativeForm $form,
        string $description,
        bool $isSocial,
        bool $isNative,
        bool $isReadyForErir,
        int $initialContractId,
        array $urls = [],
        ?array $kktuCode = [],
        ?string $targetAudienceDescription = null
    ) {
        $this->type = $type;
        $this->form = $form;
        $this->description = $description;
        $this->isSocial = $isSocial;
        $this->isNative = $isNative;
        $urls && (function(CreativeUrl ...$_) {})( ...$urls);
        $this->urls = $urls;
        $kktuCode && (function(KktuCode ...$_) {})( ...$kktuCode);
        $this->kktuCode = $kktuCode;
        $this->targetAudienceDescription = $targetAudienceDescription;
        $this->isReadyForErir = $isReadyForErir;
        $this->initialContractId = $initialContractId;
    }

    public function getType(): CreativeType
    {
        return $this->type;
    }

    public function getForm(): CreativeForm
    {
        return $this->form;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getIsSocial(): bool
    {
        return $this->isSocial;
    }

    public function getIsNative(): bool
    {
        return $this->isNative;
    }

    /**
     * @return array<CreativeUrl>
     */
    public function getUrls(): array
    {
        return $this->urls;
    }

    /**
     * @return ?array<KktuCode>
     */
    public function getKktuCode(): ?array
    {
        return $this->kktuCode;
    }

    public function getTargetAudienceDescription(): ?string
    {
        return $this->targetAudienceDescription;
    }

    public function getIsReadyForErir(): bool
    {
        return $this->isReadyForErir;
    }

    public function getInitialContractId(): int
    {
        return $this->initialContractId;
    }

    protected static function required(): array
    {
        return ['type', 'form', 'description', 'isSocial', 'isNative', 'urls', 'isReadyForErir', 'initialContractId'];
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "type":
                yield fn ($data) => call_user_func([ '\BeelineOrd\Data\Creative\CreativeType', 'from' ], $data);
                break;

            case "form":
                yield fn ($data) => call_user_func([ '\BeelineOrd\Data\Creative\CreativeForm', 'from' ], $data);
                break;

            case "description":
            case "targetAudienceDescription":
                yield \Closure::fromCallable('strval');
                break;

            case "isSocial":
            case "isNative":
            case "isReadyForErir":
                yield \Closure::fromCallable('boolval');
                break;

            case "urls":
                yield fn ($array) => array_map(
                    fn ($data) => call_user_func([ '\BeelineOrd\Data\Creative\CreativeUrl', 'create' ], $data),
                    (array)$array
                );
                break;

            case "kktuCode":
                yield fn ($array) => array_map(
                    fn ($data) => call_user_func([ '\BeelineOrd\Data\Creative\KktuCode', 'create' ], $data),
                    (array)$array
                );
                break;

            case "initialContractId":
                yield \Closure::fromCallable('intval');
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
            $constructorParams["type"],
            $constructorParams["form"],
            $constructorParams["description"],
            $constructorParams["isSocial"],
            $constructorParams["isNative"],
            $constructorParams["isReadyForErir"],
            $constructorParams["initialContractId"],
            $constructorParams["urls"],
            $constructorParams["kktuCode"] ?? null,
            $constructorParams["targetAudienceDescription"] ?? null
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
