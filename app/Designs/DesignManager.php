<?php

namespace App\Designs;

use App\Models\SiteSetting;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Decides which design the public site uses.
 *
 * The live design is stored in the site_settings table and chosen in the
 * admin panel (Appearance page). Admins can also preview another design for
 * their own session, without changing what visitors see.
 */
final class DesignManager
{
    public const string SETTING_KEY = 'site_design';

    public const string PREVIEW_SESSION_KEY = 'design_preview';

    private const string CACHE_KEY = 'site_settings.site_design';

    /**
     * The design visitors see.
     */
    public function live(): SiteDesign
    {
        $stored = Cache::rememberForever(self::CACHE_KEY, fn (): string => SiteSetting::valueOf(self::SETTING_KEY) ?? '');

        return SiteDesign::tryFrom($stored) ?? SiteDesign::default();
    }

    public function setLive(SiteDesign $design): void
    {
        SiteSetting::put(self::SETTING_KEY, $design->value);
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * The design for the current request: the admin's preview, if any, otherwise the live one.
     */
    public function current(): SiteDesign
    {
        return $this->preview() ?? $this->live();
    }

    /**
     * The design the signed-in admin is previewing, if any.
     */
    public function preview(): ?SiteDesign
    {
        if (! $this->canPreview()) {
            return null;
        }

        $value = session(self::PREVIEW_SESSION_KEY);

        return is_string($value) ? SiteDesign::tryFrom($value) : null;
    }

    public function startPreview(SiteDesign $design): void
    {
        session()->put(self::PREVIEW_SESSION_KEY, $design->value);
    }

    public function stopPreview(): void
    {
        session()->forget(self::PREVIEW_SESSION_KEY);
    }

    /**
     * Only users who can open the admin panel may preview designs.
     */
    public function canPreview(): bool
    {
        if (! request()->hasSession()) {
            return false;
        }

        $user = Auth::user();

        return $user instanceof FilamentUser && $user->canAccessPanel(Filament::getPanel('admin'));
    }
}
