<?php
namespace CarloNicora\Minimalism\Services\DataMapper;

use CarloNicora\Minimalism\Abstracts\AbstractService;
use CarloNicora\Minimalism\Interfaces\ServiceInterface;
use CarloNicora\Minimalism\Services\DataMapper\Interfaces\BuilderInterface;

class DataMapper extends AbstractService
{
    /** @var ServiceInterface|null  */
    private ?ServiceInterface $defaultService=null;

    /** @var BuilderInterface|null  */
    private ?BuilderInterface $builder=null;

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
     * @return BuilderInterface|null
     */
    public function getBuilder(
    ): ?BuilderInterface
    {
        return $this->builder;
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