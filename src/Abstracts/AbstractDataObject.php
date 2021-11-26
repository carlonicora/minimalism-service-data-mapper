<?php
namespace CarloNicora\Minimalism\Services\DataMapper\Abstracts;

use CarloNicora\Minimalism\Interfaces\Data\Enums\DataType;
use CarloNicora\Minimalism\Services\DataMapper\Interfaces\DataObjectInterface;
use RuntimeException;

abstract class AbstractDataObject implements DataObjectInterface
{
    /** @var array  */
    private array $originalValues = [];

    /**
     * Context constructor.
     * @param array|null $data
     * @param int|null $levelOfChildrenToLoad
     */
    public function __construct(
        ?array $data=null,
        protected ?int $levelOfChildrenToLoad=0,
    )
    {
        if ($data !== null){
            if (array_key_exists('originalValues', $data)) {
                $this->originalValues = $data['originalValues'];
            }

            $this->import(
                data: $data
            );
        }
    }

    /**
     * @param array $data
     */
    abstract public function import(array $data): void;

    /**
     * @return array
     */
    public function export(
    ): array
    {
        if ($this->originalValues === []){
            return [];
        }

        return [
            'originalValues' => $this->originalValues
        ];
    }

    /**
     * @param array $data
     * @param string $fieldName
     * @param bool $isRequired
     * @param mixed|null $defaultValue
     * @param DataType $type
     * @return mixed
     */
    protected function importField(
        array $data,
        string $fieldName,
        bool $isRequired=false,
        mixed $defaultValue=null,
        DataType $type=DataType::String,
    ): mixed
    {
        if (!array_key_exists($fieldName, $data) || $data[$fieldName] === null){
            if ($isRequired) {
                throw new RuntimeException($fieldName . ' missing', 412);
            }
            return $defaultValue;
        }

        return match ($type){
            DataType::Date => strtotime($data[$fieldName]),
            default => $data[$fieldName],
        };
    }

    /**
     * @param string $fieldName
     * @param mixed $value
     * @param bool $isRequired
     * @return mixed
     */
    protected function setInitialFieldValue(
        string $fieldName,
        mixed $value,
        bool $isRequired=false,
    ): mixed
    {
        if ($isRequired && $value === null){
            throw new RuntimeException($fieldName . ' missing during initialisation', 412);
        }

        return $value;
    }
}