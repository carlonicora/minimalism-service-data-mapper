<?php
namespace CarloNicora\Minimalism\Services\DataMapper\Interfaces;

use CarloNicora\Minimalism\Factories\MinimalismFactories;
use CarloNicora\Minimalism\Interfaces\Cache\Interfaces\CacheInterface;
use CarloNicora\Minimalism\Interfaces\Data\Interfaces\DataFunctionInterface;

interface BuilderInterface
{
    /**
     * @param string $resourceTransformerClass
     * @param DataFunctionInterface $function
     * @param int $relationshipLevel
     * @param array $additionalRelationshipData
     * @return array
     */
    public function build(
        string $resourceTransformerClass,
        DataFunctionInterface $function,
        int $relationshipLevel=1,
        array $additionalRelationshipData=[]
    ): array;

    /**
     * @param string $resourceTransformerClass
     * @param array $data
     * @param int $relationshipLevel
     * @param array $additionalRelationshipData
     * @return array
     */
    public function buildByData(
        string $resourceTransformerClass,
        array $data,
        int $relationshipLevel=1,
        array $additionalRelationshipData=[]
    ): array;
}