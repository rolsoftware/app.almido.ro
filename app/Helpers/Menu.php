
<?php

if (!function_exists('isMenuActive')) {
    function isMenuActive($subitems) {
        foreach ($subitems as $subitem) {
            if (\Illuminate\Support\Facades\Request::is(trim($subitem['url'], '/'))) {
                return true;
            }
        }
        return false;
    }
}