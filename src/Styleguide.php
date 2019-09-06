<?php

namespace ReinVanOyen\AtomicStyleguide;

use Illuminate\Support\Facades\File;

class Styleguide
{
    public static function getTypeBySlug(string $type)
    {
        $validTypes = config('styleguide.types');

        foreach ($validTypes as $validType) {
            if ($validType['slug'] === $type) {
                return $validType;
            }
        }

        return false;
    }

    public static function isValidComponent(string $typeSlug, string $componentId)
    {
        $type = self::getTypeBySlug($typeSlug);
        if (! $type) {
            return false;
        }

        return File::isDirectory(config('styleguide.directory').'/'.$type['directory'].'/'.$componentId.'/');
    }

    public static function getComponentForType(string $typeDirectory, string $componentId): array
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

        $modifiers = File::glob(config('styleguide.directory').'/'.$typeDirectory.'/'.$componentId.'/*.blade.php');

        if (File::isFile($metaFileName)) {

            $metaContents = json_decode(File::get($metaFileName), true);
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

    public static function getAllForType(string $type): array
    {
        $all = File::directories(config('styleguide.directory').'/'.$type.'/');
        $components = [];

        foreach ($all as $component) {

            $componentId = explode('/', $component);
            $componentId = $componentId[count($componentId)-1];

            $components[] = self::getComponentForType($type, $componentId);
        }

        return $components;
    }
}