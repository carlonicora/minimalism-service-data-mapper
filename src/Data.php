<?php
namespace CarloNicora\Minimalism\Services\DataMapper;

use CarloNicora\Minimalism\Abstracts\AbstractService;
use CarloNicora\Minimalism\Interfaces\Cache\Interfaces\CacheBuilderFactoryInterface;
use CarloNicora\Minimalism\Interfaces\Cache\Interfaces\CacheInterface;
use CarloNicora\Minimalism\Interfaces\Data\Interfaces\DataInterface;
use CarloNicora\Minimalism\Interfaces\ServiceInterface;
use CarloNicora\Minimalism\Services\DataMapper\Interfaces\BuilderInterface;

class Data extends AbstractService
{
    /** @var ServiceInterface|null  */
    private ?ServiceInterface $defaultService=null;

    /** @var CacheBuilderFactoryInterface|null  */
    private ?CacheBuilderFactoryInterface $cacheFactory=null;

    /** @var BuilderInterface|null  */
    private ?BuilderInterface $builder=null;

    /**
     * Pools constructor.
     * @param DataInterface $data
     * @param CacheInterface|null $cache
     */
    public function __construct(
        protected DataInterface $data,
        protected ?CacheInterface $cache=null,
    )
    {
        parent::__construct();
    }

    /**
     * @param BuilderInterface $builder
     */
    public function setBuilder(
        BuilderInterface $builder,
    ): void
    {
        $this->builder = $builder;
    }

    /**
     * @param ServiceInterface $defaultService
     */
    public function setDefaultService(
        ServiceInterface $defaultService,
    ): void
    {
        $this->defaultService = $defaultService;
    }

    /**
     * @param CacheBuilderFactoryInterface $cacheFactory
     */
    public function setCacheFactory(
        CacheBuilderFactoryInterface $cacheFactory,
    ): void
    {
        $this->cacheFactory = $cacheFactory;
    }

    /**
     * @return BuilderInterface|null
     */
    public function getBuilder(
    ): ?BuilderInterface
    {
        return $this->builder;
    }

    /**
     * @return CacheInterface|null
     */
    public function getCache(
    ): ?CacheInterface
    {
        return $this->cache;
    }

    /**
     * @return CacheBuilderFactoryInterface|null
     */
    public function getCacheFactory(
    ): ?CacheBuilderFactoryInterface
    {
        return $this->cacheFactory;
    }

    /**
     * @return DataInterface
     */
    public function getData(
    ): DataInterface
    {
        return $this->data;
    }

    /**
     * @return ServiceInterface|null
     */
    public function getDefaultService(
    ): ?ServiceInterface
    {
        return $this->defaultService;
    }
}