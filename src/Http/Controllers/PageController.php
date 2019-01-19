<?php

namespace Addgod\NovaCms\Http\Controllers;

use Addgod\NovaCms\Models\Page;

class PageController
{
    /**
     * Generate the CMS pages
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug = "home")
    {
        try {
            $page = Page::whereSlug($slug)->first();
        } catch (\Exception $e) {
            return Redirect::to('/');
        }

        return view('page', ['page' => $page]);
    }
}
