<?php

namespace App\Http\Controllers;

use App\Models\SkillCategory;
use Illuminate\Http\Request;

class SkillCategoryController extends Controller
{
    /**
     * Return a collection of all the categories with the information about subcategories and their skills
     */
    public static function getCategoriesWithSkills()
    {
        return SkillCategory::with('subcategories.skills')->orderBy('order')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(SkillCategory $skillCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(SkillCategory $skillCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SkillCategory $skillCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(SkillCategory $skillCategory)
    {
        //
    }
}
