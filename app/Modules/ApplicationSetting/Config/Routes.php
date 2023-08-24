<?php

$routes->group('admin', ['filter' => 'Useraccess'], function ($routes) {


    $routes->get('application_setting', '\Modules\ApplicationSetting\Controllers\ApplicationSettingController::ApplicationSetting', ['as' => 'application_setting']);
    $routes->post('setting_update/(:any)', '\Modules\ApplicationSetting\Controllers\ApplicationSettingController::SettingUpdate/$1', ['as' => 'setting_update']);

});