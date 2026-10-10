<?php

namespace App\Designs;

use App\Designs\Props\BentoProps;
use App\Designs\Props\BlueprintProps;
use App\Designs\Props\KineticProps;
use App\Designs\Props\SourceProps;
use App\Designs\Props\TerrainProps;

/**
 * The public site designs that can be switched from the admin panel.
 *
 * Each design lives in its own folders (resources/js/designs/<value>,
 * resources/css/designs/<value>, docs/designs/<value>.md) and may add props
 * and profile copy of its own (see props() and config/designs.php).
 */
enum SiteDesign: string
{
    case Source = 'source';
    case Bento = 'bento';
    case Terrain = 'terrain';
    case Kinetic = 'kinetic';
    case Blueprint = 'blueprint';

    public static function default(): self
    {
        $configured = config('designs.default');

        return self::tryFrom(is_string($configured) ? $configured : '') ?? self::Source;
    }

    public function label(): string
    {
        return match ($this) {
            self::Source => 'Source',
            self::Bento => 'Bento',
            self::Terrain => 'Terrain',
            self::Kinetic => 'Kinetic',
            self::Blueprint => 'Blueprint',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Source => 'Code-crafted: editor tabs, IBM Plex Sans and JetBrains Mono, blue accent.',
            self::Bento => 'Modular cards in a bento grid, Plus Jakarta Sans, violet accent.',
            self::Terrain => 'Earthy and human: Bricolage Grotesque and Figtree, olive and rust.',
            self::Kinetic => 'Oversized type: Unbounded and Public Sans, signal orange.',
            self::Blueprint => 'Engineering leader and product partner: Schibsted Grotesk and DM Mono, teal.',
        };
    }

    /**
     * The design's entry stylesheet, loaded by resources/views/app.blade.php.
     */
    public function stylesheet(): string
    {
        return "resources/css/designs/{$this->value}/app.css";
    }

    /**
     * Builds the props that only this design's pages use.
     */
    public function props(): DesignProps
    {
        return match ($this) {
            self::Source => new SourceProps,
            self::Bento => new BentoProps,
            self::Terrain => new TerrainProps,
            self::Kinetic => new KineticProps,
            self::Blueprint => new BlueprintProps,
        };
    }

    /**
     * The shared `profile` prop for this design: config/profile.php with the
     * design's own copy from config/designs.php merged on top.
     *
     * @return array<string, mixed>
     */
    public function profile(): array
    {
        $base = config('profile', []);
        $overrides = config("designs.designs.{$this->value}.profile", []);

        return array_replace_recursive(is_array($base) ? $base : [], is_array($overrides) ? $overrides : []);
    }
}
