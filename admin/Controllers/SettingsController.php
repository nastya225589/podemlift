<?php

namespace Admin\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends \Illuminate\Routing\Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            foreach ($request->all() as $name => $value)
                if ($name != '_token')
                    Settings::where(['name' => $name])->first()->update(['value' => $value]);

            return redirect(route('settings.index'));
        } else {
            $groups = Settings::distinct()->pluck('group')->map(function($group) {
                return Settings::where(['group' => $group])->orderBy('sort', 'asc')->get();
            });

            return view('admin::settings.index', [
                'name' => 'settings',
                'route' => 'settings',
                'action' => 'index',
                'groups' => $groups
            ]);
        }
    }
}
