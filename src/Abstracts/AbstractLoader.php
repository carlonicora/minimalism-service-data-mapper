<?php
namespace CarloNicora\Minimalism\Services\DataMapper\Abstracts;

use CarloNicora\Minimalism\Interfaces\Cache\Interfaces\CacheBuilderFactoryInterface;
use CarloNicora\Minimalism\Interfaces\Cache\Interfaces\CacheInterface;
use CarloNicora\Minimalism\Interfaces\Data\Interfaces\DataInterface;
use CarloNicora\Minimalism\Interfaces\ServiceInterface;
use CarloNicora\Minimalism\Interfaces\SimpleObjectInterface;
use CarloNicora\Minimalism\Services\DataMapper\DataMapper;
use CarloNicora\Minimalism\Services\DataMapper\Exceptions\RecordNotFoundException;
use CarloNicora\Minimalism\Services\DataMapper\Interfaces\BuilderInterface;
use CarloNicora\Minimalism\Services\DataMapper\Interfaces\DataObjectInterface;
use Exception;

abstract class AbstractLoader implements SimpleObjectInterface
{
    /** @var BuilderInterface|null  */
    protected ?BuilderInterface $builder=null;

    /** @var CacheBuilderFactoryInterface|null  */
    protected ?CacheBuilderFactoryInterface $cacheFactory=null;

    /** @var ServiceInterface|null  */
    protected ?ServiceInterface $defaultService=null;

    /**
     * UsersLoader constructor.
     * @param DataMapper $mapper
     * @param DataInterface $data
     * @param CacheInterface|null $cache
     */
    public function __construct(
        protected DataMapper $mapper,
        protected DataInterface $data,
        protected ?CacheInterface $cache,
    )
    {
        $this->builder = $mapper->getBuilder();

        $this->cacheFactory = $mapper->getCacheFactory();
        $this->defaultService = $mapper->getDefaultService();
    }

    /**
     * @param array $response
     * @param string|null $recordType
     * @return array
     * @throws RecordNotFoundException
     */
    protected function returnSingleValue(
        array $recordset,
        ?string $recordType=null,
    ): array
    {
        if ($recordset === [] || $recordset === [[]]){
            throw new RecordNotFoundException(
                $recordType === null
                    ? 'Record Not found'
                    : $recordType . ' not found'
            );
        }

        return array_is_list($recordset) ? $recordset[0] : $recordset;
    }

    /**
     * @param array $recordset
     * @param string $objectType
     * @param int|null $levelOfChildrenToLoad
     * @return DataObjectInterface
     * @throws Exception
     */
    protected function returnSingleObject(
        array $recordset,
        string $objectType,
        ?int $levelOfChildrenToLoad=0,
    ): DataObjectInterface
    {
        if ($recordset === [] || $recordset === [[]]){
            throw new RecordNotFoundException('Record Not found');
        }

        return new $objectType(
            data: array_is_list($recordset) ? $recordset[0] : $recordset,
            levelOfChildrenToLoad: $levelOfChildrenToLoad,
        );
    }

    /**
     * @param array $recordset
     * @param string $objectType
     * @param int|null $levelOfChildrenToLoad
     * @return DataObjectInterface[]
     */
    protected function returnObjectArray(
        array $recordset,
        string $objectType,
        ?int $levelOfChildrenToLoad=0,
    ): array
    {
        $response = [];

        if (array_is_list($recordset)) {
            foreach ($recordset ?? [] as $record) {
                $response[] = new $objectType(
                    data: $record,
                    levelOfChildrenToLoad: $levelOfChildrenToLoad,
                );
            }
        } else {
            $response[] = new $objectType(
                data: $recordset,
                levelOfChildrenToLoad: $levelOfChildrenToLoad,
            );
        }

        return $response;
    }
}