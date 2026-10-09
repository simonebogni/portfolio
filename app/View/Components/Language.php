<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Language extends Component
{
    /**
     * The name of the language to display
     *
     * @var string
     */
    public $name;

    /**
     * Whether the language is a mothertongue
     *
     * @var bool
     */
    public $isNative;

    /**
     * The rating, rounded down to *.5 or *.0
     *
     * @var float
     */
    public $rating;

    /**
     * The meaning of the rating value
     *
     * @var string
     */
    public $ratingMeaning;

    /**
     * The level of the certificate achieved
     *
     * @var string
     */
    public $certificate_level;

    /**
     * The path to the image of the certificate achieved
     *
     * @var string
     */
    public $certificate_img_path;

    /**
     * Create a new component instance.
     *
     * @param  \App\Models\Language  $language
     */
    public function __construct(/**
     * The language to display
     */
        public $language)
    {
        $this->name = $this->language->name;
        $this->isNative = $this->language->speaking === 'Native';
        $roundedRating = round($this->language->rating, 2);
        $whole = floor($roundedRating);
        if (($roundedRating - $whole) > 0.0) {
            $decimal = $roundedRating - $whole;
            if ($decimal >= 0.5) {
                $this->rating = $whole + 0.5;
            } else {
                $this->rating = $whole;
            }
        } else {
            $this->rating = $this->language->rating;
        }
        switch ($this->rating) {
            case 5.0:
                $this->ratingMeaning = 'Fluent';
                break;
            case 4.5:
            case 4.0:
                $this->ratingMeaning = 'Proficient';
                break;
            case 3.5:
            case 3.0:
                $this->ratingMeaning = 'Intermediate';
                break;
            case 2.5:
            case 2.0:
                $this->ratingMeaning = 'Limited working proficiency';
                break;
            case 1.5:
            case 1.0:
                $this->ratingMeaning = 'Beginner';
                break;
        }
        $this->certificate_level = $this->language->certificate_level;
        $this->certificate_img_path = $this->language->certificate_img_path;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.language');
    }
}
