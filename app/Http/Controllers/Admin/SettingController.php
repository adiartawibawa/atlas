<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use App\Traits\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SettingController extends Controller
{
    // use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentCategory = ($request->get('category') == '') ? 'general' : $request->get('category');
        $this->data['currentCategory'] = $currentCategory;
        $this->data['settings'] = Setting::getSettings()[$currentCategory];
        $this->data['categories'] = Setting::getCategories();

        return Inertia::render('Admin/Setting/Index', ['settings' => $this->data]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request)
    {
        $params = $request->except('_token');

        $updateSetting = true;
        $settingKeys = Setting::whereIn('setting_key', array_keys($params))->get()->pluck('setting_key')->toArray();

        if ($params) {
            foreach ($params as $settingKey => $settingValue) {
                if (in_array($settingKey, $settingKeys) && !$this->updateSetting($settingKey, $settingValue)) {
                    $updateSetting = false;
                    break;
                }
            }
        }

        if ($updateSetting) {
            return Redirect::route('admin.settings')->with('success', 'Setting has been updated.');
        }

        return Redirect::route('admin.settings')->with('error', 'Some setting has not updated.');
    }

    public function remove($id)
    {
        $setting = Setting::findOrFail($id);
        $setting[$setting->setting_type . '_value'] = null;
        if ($setting->save()) {
            return Redirect::route('admin.settings')->with('success', 'Setting has been updated.');
        }

        return Redirect::route('admin.settings')->with('error', 'Some setting has not updated.');
    }

    private function updateSetting($settingKey, $settingValue)
    {
        $setting = Setting::where('setting_key', $settingKey)->first();
        if (!$setting) {
            return;
        }

        if ($setting->setting_type == 'file' && $settingValue) {
            $settingValue = $this->uploadFile($setting, $settingValue);
        }

        $setting[$setting->setting_type . '_value'] = $settingValue;
        return $setting->save();
    }

    private function uploadFile($setting, $settingValue)
    {
        $setting->clearMediaCollection('images');
        $setting->addMediaFromRequest($setting->setting_key)->toMediaCollection('images');
        return $setting->getFirstMedia('images')->getUrl();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
