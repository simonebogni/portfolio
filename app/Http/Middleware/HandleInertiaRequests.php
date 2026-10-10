<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Designs\DesignManager;
use App\Designs\SiteDesign;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @var string
     */
    #[\Override]
    protected $rootView = 'app';

    public function __construct(private readonly DesignManager $designs) {}

    /**
     * The asset version includes the design, so switching design makes the
     * browser reload the page (and the design's stylesheet) on its next visit.
     */
    #[\Override]
    public function version(Request $request): ?string
    {
        return parent::version($request).':'.$this->designs->current()->value;
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    #[\Override]
    public function share(Request $request): array
    {
        $design = $this->designs->current();
        $preview = $this->designs->preview();

        return [
            ...parent::share($request),
            'design' => $design->value,
            'designPreview' => $preview instanceof SiteDesign ? ['label' => $preview->label(), 'live' => $this->designs->live()->label()] : null,
            'profile' => $design->profile(),
        ];
    }
}
