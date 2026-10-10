<?php

namespace App\Http\Middleware;

use App\Designs\DesignManager;
use App\Designs\SiteDesign;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Lets an admin preview a design with `?design=<name>` (and stop with `?design=live`).
 * The choice is kept in the admin's session only; visitors are not affected.
 */
class HandleDesignPreview
{
    public function __construct(private readonly DesignManager $designs) {}

    public function handle(Request $request, Closure $next): Response
    {
        $requested = $request->query('design');

        if (! $request->isMethod('GET') || ! is_string($requested) || ! $this->designs->canPreview()) {
            return $next($request);
        }

        $design = SiteDesign::tryFrom($requested);

        if ($design instanceof SiteDesign) {
            $this->designs->startPreview($design);
        } elseif ($requested === 'live') {
            $this->designs->stopPreview();
        }

        return redirect()->to($request->fullUrlWithoutQuery('design'));
    }
}
