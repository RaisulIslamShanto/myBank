<?php

$routes->group('admin', ['filter' => 'Useraccess'], function ($routes) {

    $routes->get('calendar', '\Modules\Calender\Controllers\CalenderController::Calendar', ['as' => 'Calendar']);
    $routes->get('calendar_data', '\Modules\Calender\Controllers\CalenderController::CalendarData', ['as' => 'calendar_data']);

});