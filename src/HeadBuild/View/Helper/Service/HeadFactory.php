<?php

namespace HeadBuild\View\Helper\Service;

use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;

class HeadFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new $requestedName($container);
    }

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        die(__METHOD__);
    }
}
