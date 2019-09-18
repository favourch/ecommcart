<?php
define('THEME_PATH', 'themes');
define('SELLING_THEME_PATH', 'themes/_selling');

if ( ! function_exists('active_theme') )
{
    /**
     * Return active theme name
     * @return str
     */
    function active_theme()
    {
        return config('system_settings.active_theme', Null) ?: 'default';
    }
}

if ( ! function_exists('theme_path') )
{
    /**
     * Return given/active theme path
     *
     * @param  str $theme name the theme
     * @return str
     */
    function theme_path($theme = Null)
    {
    	if($theme == Null)
	        $theme = active_theme();

	    return public_path(THEME_PATH . DIRECTORY_SEPARATOR . strtolower($theme));
    }
}

if ( ! function_exists('theme_views_path') )
{
    /**
     * Return given/active theme views path
     *
     * @param  str $theme name the theme
     * @return str
     */
    function theme_views_path($theme = Null)
    {
	    return theme_path($theme) . '/views';
    }
}

if ( ! function_exists('theme_asset_url') )
{
    /**
     * Return given/active theme assets path
     *
     * @param  str $asset name the theme
     * @param  str $theme name the theme
     * @return str
     */
    function theme_asset_url($asset = Null, $theme = Null)
    {
        if($theme == Null)
            $theme = active_theme();

        $path = asset(THEME_PATH . '/' . $theme . '/assets');

        return  $asset == Null ? $path : "{$path}/{$asset}";
    }
}

if ( ! function_exists('theme_assets_path') )
{
    /**
     * Return given/active theme assets path
     *
     * @param  str $theme name the theme
     * @return str
     */
    function theme_assets_path($theme = Null)
    {
        return theme_path($theme) . '/assets';
    }
}

if ( ! function_exists('active_selling_theme') )
{
    /**
     * Return active selling theme name
     * @return str
     */
    function active_selling_theme()
    {
        return config('system_settings.selling_theme', Null) ?: 'default';
    }
}

if ( ! function_exists('selling_theme_path') )
{
    /**
     * Return given/active selling theme views path
     *
     * @param  str $theme name the theme
     * @return str
     */
    function selling_theme_path($theme = Null)
    {
    	if($theme == Null)
	        $theme = active_selling_theme();

        return public_path(SELLING_THEME_PATH . DIRECTORY_SEPARATOR . strtolower($theme));
    }
}

if ( ! function_exists('selling_theme_views_path') )
{
    /**
     * Return given/active selling theme views path
     *
     * @param  str $theme name the theme
     * @return str
     */
    function selling_theme_views_path($theme = Null)
    {
	    return selling_theme_path($theme) . '/views';
    }
}

if ( ! function_exists('selling_theme_asset_url') )
{
    /**
     * Return given/active selling theme assets url
     *
     * @param  str $asset name the theme
     * @param  str $theme name the theme
     * @return str
     */
    function selling_theme_asset_url($asset = Null, $theme = Null)
    {
        if($theme == Null)
            $theme = active_selling_theme();

        $path = asset(SELLING_THEME_PATH . '/' . $theme . '/assets');

        return  $asset == Null ? $path : "{$path}/{$asset}";
    }
}

if ( ! function_exists('selling_theme_assets_path') )
{
    /**
     * Return given/active selling theme assets path
     *
     * @param  str $theme name the theme
     * @return str
     */
    function selling_theme_assets_path($theme = Null)
    {
        return selling_theme_path($theme) . '/assets';
    }
}
