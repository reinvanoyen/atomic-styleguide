<?php

namespace ReinVanOyen\AtomicStyleguide\Controllers;

use App\Http\Controllers\Controller;
use ReinVanOyen\AtomicStyleguide\Styleguide;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StyleguideController extends Controller
{
    public function index()
    {
        $types = array_map(function($type) {
            $type['components'] = Styleguide::getAllForType($type['directory']);
            return $type;
        }, config('styleguide.types'));

        return view('styleguide::index', [
            'types' => $types,
        ]);
    }

    public function type(string $typeSlug)
    {
        $type = Styleguide::getTypeBySlug($typeSlug);

        if (! $type) {
            throw new NotFoundHttpException();
        }

        return view('styleguide::type', [
            'type' => $type,
            'components' => Styleguide::getAllForType($type['directory']),
        ]);
    }

    public function component(string $typeSlug, string $component)
    {
        if (! Styleguide::isValidComponent($typeSlug, $component)) {
            throw new NotFoundHttpException();
        }

        $type = Styleguide::getTypeBySlug($typeSlug);

        return view('styleguide::component', [
            'type' => $type,
            'component' => Styleguide::getComponentForType($type['directory'], $component),
        ]);
    }
}