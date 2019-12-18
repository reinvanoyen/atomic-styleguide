<?php

namespace ReinVanOyen\AtomicStyleguide;

use Illuminate\Filesystem\Filesystem;

class Styleguide
{
    /**
     * @var Filesystem $filesystem
     */
    private $filesystem;

    /**
     * Styleguide constructor.
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @param string $type
     * @return bool|mixed
     */
    public function getTypeBySlug(string $type)
    {
        $validTypes = config('styleguide.types');

        foreach ($validTypes as $validType) {
            if ($validType['slug'] === $type) {
                return $validType;
            }
        }

        return false;
    }

    /**
     * @param string $typeSlug
     * @param string $componentId
     * @return bool
     */
    public function isValidComponent(string $typeSlug, string $componentId)
    {
        $type = $this->getTypeBySlug($typeSlug);
        if (! $type) {
            return false;
        }

        return $this->filesystem->isDirectory(config('styleguide.directory').'/'.$type['directory'].'/'.$componentId.'/');
    }

    /**
     * @param string $typeDirectory
     * @param string $componentId
     * @return array
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getComponentForType(string $typeDirectory, string $componentId): array
    {
        $metaDefaults = [
            'columns' => config('styleguide.default_columns'),
            'description' => config('styleguide.default_description'),
        ];

        $metaFileName = config('styleguide.directory').'/'.$typeDirectory.'/'.$componentId.'/meta.json';

        $component = [
            'name' => $componentId,
            'type' => $typeDirectory,
            'modifiers' => [],
            'meta' => $metaDefaults,
        ];

        $modifiers = $this->filesystem->glob(config('styleguide.directory').'/'.$typeDirectory.'/'.$componentId.'/*.blade.php');

        if ($this->filesystem->isFile($metaFileName)) {

            $metaContents = json_decode($this->filesystem->get($metaFileName), true);
            $component['meta'] = array_merge($metaDefaults, $metaContents);
        }

        foreach ($modifiers as $modifier) {

            $modifierName = explode('/', $modifier);
            $modifierName = $modifierName[count($modifierName)-1];
            $modifierName = str_replace('.blade.php', '', $modifierName);

            $component['modifiers'][] = $modifierName;
        }

        return $component;
    }

    /**
     * @param string $type
     * @return array
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getAllForType(string $type): array
    {
        $all = $this->filesystem->directories(config('styleguide.directory').'/'.$type.'/');
        $components = [];

        foreach ($all as $component) {

            $componentId = explode('/', $component);
            $componentId = $componentId[count($componentId)-1];

            $components[] = $this->getComponentForType($type, $componentId);
        }

        return $components;
    }
}
