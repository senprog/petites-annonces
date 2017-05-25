<?php
/**
 * Copyright © 2016 Elbek Azimov. Contacts: <atom.azimov@gmail.com>
 */

namespace Atom\UploaderBundle\DependencyInjection\Compiler;

use Atom\Uploader\Metadata\FileMetadata;
use Atom\UploaderBundle\DependencyInjection\Configuration;
use Atom\UploaderBundle\Mapping\DefaultMappingHelper;
use Atom\UploaderBundle\Mapping\IMappingHelper;
use Atom\UploaderBundle\Mapping\MappingHelperRepo;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class RegisterMappingsCompiler implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $helperRepo = $container->get('atom_uploader.mapping.helper_repo');
        /** @var DefaultMappingHelper $defaultHelper */
        $defaultHelper = $helperRepo->getHelper('default');

        $config = $this->getConfig($container);
        $availableMappings = $this->getAvailableMappingsNames(
            $container,
            $helperRepo,
            $defaultHelper,
            $config['mappings'],
            $config['drivers']
        );

        $mappings = $this->prepareMappings($config['mappings'], $availableMappings, $defaultHelper);

        if (empty($mappings)) {
            return;
        }

        $this->registerMetadata($mappings, $container);
        $usedFsAdapters = array_unique(array_column($mappings, 'fs_adapter'));
        $this->registerFsAdapters($usedFsAdapters, $container);
        $usedNamingStrategies = array_unique(array_column($mappings, 'naming_strategy'));
        $this->registerNamers($usedNamingStrategies, $container);
    }

    private function getConfig(ContainerBuilder $container)
    {
        $processor = new Processor();
        $configs = $container->getExtensionConfig('atom_uploader');
        $configs[] = [
            'mappings' => [
                'Atom\Uploader\Model\Uploadable' => [],
            ],
        ];

        return $processor->processConfiguration(new Configuration(), $configs);
    }

    private function getAvailableMappingsNames(
        ContainerBuilder $container,
        MappingHelperRepo $helperRepo,
        IMappingHelper $defaultHelper,
        array $mappings,
        array $drivers
    )
    {
        $availableMappings = [];

        foreach ($drivers as $driver) {
            $helper = $helperRepo->getHelper($driver) ?: $defaultHelper;
            $availableMappings = array_merge($availableMappings, $helper->getAvailableMappingsNames($mappings, $container));
        }

        return $availableMappings;
    }

    private function prepareMappings(array $mappings, array $availableMappings, DefaultMappingHelper $helper)
    {
        $availableMappings = array_combine($availableMappings, $availableMappings);

        return array_map(function ($className) use ($mappings, $helper) {
            return $helper->findMappingByClassName($mappings, $className) ?: Configuration::getMappingDefaults();
        }, $availableMappings);
    }

    private function registerMetadata(array $mappings, ContainerBuilder $container)
    {
        $definition = $container->findDefinition('atom_uploader.metadata_repo');
        $metadataMap = [];
        $mappingsNames = [];

        foreach ($mappings as $name => $mapping) {
            $metadataIndex = array_search($mapping, $metadataMap);

            if (false === $metadataIndex) {
                $metadataIndex = array_push($metadataMap, $mapping) - 1;
            }

            $mappingsNames[$name] = $metadataIndex;
        }

        foreach ($metadataMap as $id => &$metadata) {
            $metadataDefinition = new Definition(FileMetadata::class, [
                $metadata['file_setter'],
                $metadata['file_getter'],
                $metadata['uri_setter'],
                $metadata['file_info_setter'],
                $metadata['fs_prefix'],
                $metadata['uri_prefix'],
                $metadata['fs_adapter'],
                $metadata['naming_strategy'],
                $metadata['delete_old_file'],
                $metadata['delete_on_remove'],
                $metadata['inject_uri_on_load'],
                $metadata['inject_file_info_on_load'],
            ]);

            $metadataDefinition->setPublic(false);
            $serviceId = sprintf('atom_uploader.metadata.%s', $id);

            $container->setDefinition($serviceId, $metadataDefinition);
            $metadata = new Reference($serviceId);
        }

        $definition->replaceArgument(0, $mappingsNames);
        $definition->replaceArgument(1, $metadataMap);
    }

    private function registerFsAdapters(array $usedAdapters, ContainerBuilder $container)
    {
        $definition = $container->findDefinition('atom_uploader.filesystem_adapter_repo');
        $taggedServices = $container->findTaggedServiceIds('atom_uploader.filesystem_adapter_repo');
        $adapters = [];

        foreach ($taggedServices as $serviceId => $tags) {
            $adapter = new Reference($serviceId);
            // unused adapters will be removed after DI optimization
            $container->findDefinition($serviceId)->setPublic(false);

            foreach ($tags as $tag) {
                $adapterName = $tag['adapter'];
                if (!in_array($adapterName, $usedAdapters)) {
                    continue;
                }

                $adapters[$adapterName] = $adapter;
            }
        }

        $definition->replaceArgument(0, $adapters);
    }

    private function registerNamers(array $usedStrategies, ContainerBuilder $container)
    {
        $definition = $container->findDefinition('atom_uploader.namer_repo');
        $taggedServices = $container->findTaggedServiceIds('atom_uploader.namer_repo');
        $namers = [];

        foreach ($taggedServices as $serviceId => $tags) {
            $namer = new Reference($serviceId);
            // unused namers will be removed after DI optimization
            $container->findDefinition($serviceId)->setPublic(false);

            foreach ($tags as $tag) {
                $strategy = $tag['strategy'];
                if (!in_array($strategy, $usedStrategies)) {
                    continue;
                }

                $namers[$strategy] = $namer;
            }
        }

        $definition->replaceArgument(0, $namers);
    }
}
