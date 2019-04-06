<?php
// global CDN link helper function
if(! function_exists('cdn'))
{
    function cdn( $asset ){

        // Verify if KeyCDN URLs are present in the config file
        if( !Config::get('app.cdn') )
            return asset( $asset );

        // Get file name incl extension and CDN URLs
        $cdns = Config::get('app.cdn');
        $assetName = basename( $asset );

        // Remove query string
        $assetName = explode("?", $assetName);
        $assetName = $assetName[0];

        // Select the CDN URL based on the extension
        foreach( $cdns as $cdn => $types ) {
            if( preg_match('/^.*\.(' . $types . ')$/i', $assetName) )
                return cdnPath($cdn, $asset);
        }

        // In case of no match use the last in the array
        end($cdns);
        return cdnPath( key( $cdns ) , $asset);

    }

}
if(! function_exists('cdnPath'))
{
    function cdnPath($cdn, $asset)
    {
        return "//" . rtrim($cdn, "/") . "/" . ltrim($asset, "/");
    }
}
if(! function_exists('img'))
{
    function img($url = null)
    {
        try {
            return cdn($url);
        } catch (Exception $exception) {
            var_dump($exception);
        }
    }
}

if(! function_exists('buildCss'))
{
    function buildCss($url)
    {
        switch ($url) {
            case 'home':
                [
                    'app.css'
                ];
                break;
            default:
                return 'styles1.css';
        }
    }
}

if (! function_exists('asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool    $secure
     * @return string
     */
    function asset($path, $secure = null)
    {
        return remove_http(app('url')->asset($path, $secure));
    }
}


if (! function_exists('remove_http')) {
    function remove_http($url) {
        $disallowed = array('http:', 'https:');
        foreach($disallowed as $d) {
            if(strpos($url, $d) === 0) {
                return str_replace($d, '', $url);
            }
        }
        return $url;
    }
}

