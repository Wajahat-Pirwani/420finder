<?php

use App\Models\SiteSetting;

function title() {
    $settings = SiteSetting::where('id', 1)->pluck('settings')->first();

    if(!empty($settings['title']) && array_key_exists('title', $settings)) {
        return $settings['title'];
    } else {
        return '420 Finder';
    }
}
?>
