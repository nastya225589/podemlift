<?php

namespace Admin\Controllers;

class AdminController extends BaseAdminController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('page.index'));
    }
}
