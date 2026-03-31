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
class CreativeViewModel extends CreativeListModel implements \JsonSerializable
{
    protected CreativeType $type;
    protected CreativeForm $form;
    protected string $description;
    protected bool $isSocial;
    protected bool $isNative;

    /** @var array<CreativeUrl> $urls */
    protected array $urls;

    /** @var ?array<string> $okveds */
    protected ?array $okveds;

    /** @var ?array<string> $kktuCode */
    protected ?array $kktuCode;
    protected ?string $targetAudienceDescription;
    protected int $initialContractId;
    protected ?int $organizationId;

    public function __construct(
        int $id,
        string $description,
        CreativeType $type,
        CreativeForm $form,
        bool $isSocial,
        bool $isNative,
        int $initialContractId,
        ?string $erid = null,
        ?\DateTimeInterface $erirExportedOn = null,
        ?\DateTimeInterface $erirPlannedExportDate = null,
        ?int $erirExportedStatus = null,
        ?string $exportError = null,
        ?int $selfPromotionOrganizationId = null,
        ?bool $isTelegram = null,
        array $urls = [],
        ?array $okveds = [],
        ?array $kktuCode = [],
        ?string $targetAudienceDescription = null,
        ?int $organizationId = null
    ) {
        parent::__construct(
            $id,
            $description,
            $erid,
            $erirExportedOn,
            $erirPlannedExportDate,
            $erirExportedStatus,
            $exportError,
            $selfPromotionOrganizationId,
            $isTelegram
        );
        $this->type = $type;
        $this->form = $form;
        $this->description = $description;
        $this->isSocial = $isSocial;
        $this->isNative = $isNative;
        $urls && (function(CreativeUrl ...$_) {})( ...$urls);
        $this->urls = $urls;
        $okveds && (function(string ...$_) {})( ...$okveds);
        $this->okveds = $okveds;
        $kktuCode && (function(string ...$_) {})( ...$kktuCode);
        $this->kktuCode = $kktuCode;
        $this->targetAudienceDescription = $targetAudienceDescription;
        $this->initialContractId = $initialContractId;
        $this->organizationId = $organizationId;
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
     * @return ?array<string>
     */
    public function getOkveds(): ?array
    {
        return $this->okveds;
    }

    /**
     * @return ?array<string>
     */
    public function getKktuCode(): ?array
    {
        return $this->kktuCode;
    }

    public function getTargetAudienceDescription(): ?string
    {
        return $this->targetAudienceDescription;
    }

    public function getInitialContractId(): int
    {
        return $this->initialContractId;
    }

    public function getOrganizationId(): ?int
    {
        return $this->organizationId;
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
            ['type', 'form', 'description', 'isSocial', 'isNative', 'urls', 'initialContractId']
        );
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
                yield \Closure::fromCallable('boolval');
                break;

            case "urls":
                yield fn ($array) => array_map(
                    fn ($data) => call_user_func([ '\BeelineOrd\Data\Creative\CreativeUrl', 'create' ], $data),
                    (array)$array
                );
                break;

            case "okveds":
            case "kktuCode":
                yield fn ($array) => array_map(
                    \Closure::fromCallable('strval'),
                    (array)$array
                );
                break;

            case "initialContractId":
            case "organizationId":
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
            $constructorParams["id"],
            $constructorParams["description"],
            $constructorParams["type"],
            $constructorParams["form"],
            $constructorParams["isSocial"],
            $constructorParams["isNative"],
            $constructorParams["initialContractId"],
            $constructorParams["erid"] ?? null,
            $constructorParams["erirExportedOn"] ?? null,
            $constructorParams["erirPlannedExportDate"] ?? null,
            $constructorParams["erirExportedStatus"] ?? null,
            $constructorParams["exportError"] ?? null,
            $constructorParams["selfPromotionOrganizationId"] ?? null,
            $constructorParams["isTelegram"] ?? null,
            $constructorParams["urls"],
            $constructorParams["okveds"] ?? null,
            $constructorParams["kktuCode"] ?? null,
            $constructorParams["targetAudienceDescription"] ?? null,
            $constructorParams["organizationId"] ?? null
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
