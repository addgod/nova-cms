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
    public function show(string $slug = "/")
    {
        $statuses = [
            Page::LIVE,
        ];

        if (auth()->check()) {
            $statuses = array_merge($statuses, [
                Page::DRAFT,
                Page::PUBLISHED,
            ]);
        }

        if ($page = Page::whereIn('status', $statuses)->whereSlug($slug)->first()) {
            return view('nova-cms::page', ['page' => $page]);
        }

        abort(404);
    }
}
