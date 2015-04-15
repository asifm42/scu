<?php

class PagesController extends BaseController {

    public function showHomePage()
    {
        return View::make('pages.home');
    }
    public function showAboutPage()
    {
        return View::make('pages.about');
    }
    public function showNewsPage()
    {
        return View::make('pages.news');
    }

}
