<?php

namespace App\Http\Controllers\Admin;

use App\SystemConfig;
use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;

class ThemeController extends Controller
{
    use Authorizable;

    /**
     * All themes installed
     *
     * @return [type] [description]
     */
	public function all()
	{
        $storeFrontThemes = collect($this->storeFrontThemes());

        $sellingThemes = collect($this->sellingThemes());

        return view('admin.theme.index', compact('storeFrontThemes', 'sellingThemes'));
	}

    /**
     * activate storefront theme
     *
     * @param  Request $request
     * @param  str  $theme   theme slug
     * @param  str  $storefront storefront/selling
     *
     * @return [type]           [description]
     */
    public function activate(Request $request, $theme, $type = 'storefront')
    {
        $system = SystemConfig::orderBy('id', 'asc')->first();

        $this->authorize('update', $system); // Check permission

        if($type == 'selling')
            $system->selling_theme = $theme;
        else if($type == 'storefront')
            $system->active_theme = $theme;

        $system->save();

        return back()->with('success', trans('messages.theme_activated', ['theme' => $theme]));
    }

    /**
     * StoreFront Themes
     * @return array
     */
    private function storeFrontThemes()
    {
        $storeFrontThemes = [];
        foreach (glob(theme_path('*'), GLOB_ONLYDIR) as $themeFolder) {
            $themeFolder = realpath($themeFolder);
            if (file_exists($jsonFilename = $themeFolder . '/' . 'theme.json')) {

                $folders = explode(DIRECTORY_SEPARATOR, $themeFolder);
                $themeName = end($folders);

                // If theme.json is not an empty file parse json values
                $json = file_get_contents($jsonFilename);
                if ($json !== "") {
                    $data = json_decode($json, true);
                    if ($data === null) {
                        throw new \Exception("Invalid theme.json file at [$themeFolder]");
                    }
                } else {
                    $data = [];
                }

                // We already know views-path since we have scaned folders.
                // we will overide this setting if exists
                $data['assets-path'] = theme_assets_path($data['slug']);
                $data['views-path'] = theme_views_path($data['slug']);

                $storeFrontThemes[] = $data;
            }
        }

        return $storeFrontThemes;
    }

    /**
     * Selling Themes
     * @return array
     */
    private function sellingThemes()
    {
        $sellingThemes = [];
        foreach (glob(selling_theme_path('*'), GLOB_ONLYDIR) as $themeFolder) {
            $themeFolder = realpath($themeFolder);
            if (file_exists($jsonFilename = $themeFolder . '/' . 'theme.json')) {

                $folders = explode(DIRECTORY_SEPARATOR, $themeFolder);
                $themeName = end($folders);

                // If theme.json is not an empty file parse json values
                $json = file_get_contents($jsonFilename);
                if ($json !== "") {
                    $data = json_decode($json, true);
                    if ($data === null) {
                        throw new \Exception("Invalid theme.json file at [$themeFolder]");
                    }
                } else {
                    $data = [];
                }

                // We already know views-path since we have scaned folders.
                // we will overide this setting if exists
                $data['assets-path'] = selling_theme_assets_path($data['slug']);
                $data['views-path'] = selling_theme_views_path($data['slug']);

                $sellingThemes[] = $data;
            }
        }

        return $sellingThemes;
    }
}
