<?php

namespace ReinVanOyen\AtomicStyleguide\Controllers;

use App\Http\Controllers\Controller;
use ReinVanOyen\AtomicStyleguide\Styleguide;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StyleguideController extends Controller
{
    /**
     * @var Styleguide $styleguide
     */
    private $styleguide;

    /**
     * StyleguideController constructor.
     * @param Styleguide $styleguide
     */
    public function __construct(Styleguide $styleguide)
    {
        $this->styleguide = $styleguide;
    }

    public function index()
    {
        $types = array_map(function($type) {
            $type['components'] = $this->styleguide->getAllForType($type['directory']);
            return $type;
        }, config('styleguide.types'));

        return view('styleguide::index', [
            'types' => $types,
        ]);
    }

    public function type(string $typeSlug)
    {
        $type = $this->styleguide->getTypeBySlug($typeSlug);

        if (! $type) {
            throw new NotFoundHttpException();
        }

        return view('styleguide::type', [
            'type' => $type,
            'components' => $this->styleguide->getAllForType($type['directory']),
        ]);
    }

    public function component(string $typeSlug, string $component)
    {
        if (! $this->styleguide->isValidComponent($typeSlug, $component)) {
            throw new NotFoundHttpException();
        }

        $type = $this->styleguide->getTypeBySlug($typeSlug);

        return view('styleguide::component', [
            'type' => $type,
            'component' => $this->styleguide->getComponentForType($type['directory'], $component),
        ]);
    }
}
