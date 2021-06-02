<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Language extends Component
{
    /**
     * The language to display
     * 
     * @var \App\Models\Language
     */
    public $language;

    /**
     * The name of the language to display
     * 
     * @var String
     */
    public $name;

    /**
     * Whether the language is a mothertongue
     * 
     * @var boolean
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
     * @var String
     */
    public $ratingMeaning;

    /**
     * The level of the certificate achieved
     * 
     * @var String
     */
    public $certificate_level;

    /**
     * The path to the image of the certificate achieved
     * 
     * @var String
     */
    public $certificate_img_path;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($language)
    {
        $this->language = $language;
        $this->name = $language->name;
        $this->isNative = $language->speaking === "Native";
        $roundedRating = round($language->rating, 2);
        if($roundedRating % 1.0 !== 0){
            $whole = floor($roundedRating);
            $decimal = $roundedRating - $whole;
            if($decimal >= 0.5){
                $this->rating = $whole + 0.5;
            } else {
                $this->rating = $whole;
            }
        } else {
            $this->rating = $language->rating;
        }
        switch($this->rating){
            case 5.0:
                $this->ratingMeaning = "Fluent";
                break;
            case 4.5:
            case 4.0:
                $this->ratingMeaning = "Proficient";
                break;  
            case 3.5:
            case 3.0:
                $this->ratingMeaning = "Intermediate";
                break;  
            case 2.5:
            case 2.0:
                $this->ratingMeaning = "Limited working proficiency";
                break;
            case 1.5:
            case 1.0:
                $this->ratingMeaning = "Beginner";
                break;  
        }
        $this->certificate_level = $language->certificate_level;
        $this->certificate_img_path = $language->certificate_img_path;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.language');
    }
}
