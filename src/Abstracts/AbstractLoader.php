<?php
namespace CarloNicora\Minimalism\Services\DataMapper\Abstracts;

use CarloNicora\Minimalism\Factories\ObjectFactory;
use CarloNicora\Minimalism\Interfaces\Cache\Interfaces\CacheInterface;
use CarloNicora\Minimalism\Interfaces\Data\Abstracts\AbstractIO;
use CarloNicora\Minimalism\Interfaces\Data\Interfaces\DataInterface;
use CarloNicora\Minimalism\Interfaces\ServiceInterface;
use CarloNicora\Minimalism\Services\DataMapper\DataMapper;
use CarloNicora\Minimalism\Services\DataMapper\Interfaces\BuilderInterface;

abstract class AbstractLoader extends AbstractIO
{
    /** @var BuilderInterface|null  */
    protected ?BuilderInterface $builder=null;

    /** @var ServiceInterface|null  */
    protected ?ServiceInterface $defaultService=null;

    /**
     * @param ObjectFactory $objectFactory
     * @param DataMapper $mapper
     * @param DataInterface $data
     * @param CacheInterface|null $cache
     */
    public function __construct(
        protected ObjectFactory $objectFactory,
        protected DataMapper $mapper,
        protected DataInterface $data,
        protected ?CacheInterface $cache,
    )
    {
        parent::__construct($this->objectFactory, $this->data);

        $this->builder = $mapper->getBuilder();

        $this->defaultService = $mapper->getDefaultService();
    }
}