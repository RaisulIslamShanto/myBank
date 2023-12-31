<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

/**
 * -------------------------------------------------------------------
 * AUTOLOADER CONFIGURATION
 * -------------------------------------------------------------------
 *
 * This file defines the namespaces and class maps so the Autoloader
 * can find the files as needed.
 *
 * NOTE: If you use an identical key in $psr4 or $classmap, then
 *       the values in this file will overwrite the framework's values.
 *
 * NOTE: This class is required prior to Autoloader instantiation,
 *       and does not extend BaseConfig.
 */
class Autoload extends AutoloadConfig
{
    /**
     * -------------------------------------------------------------------
     * Namespaces
     * -------------------------------------------------------------------
     * This maps the locations of any namespaces in your application to
     * their location on the file system. These are used by the autoloader
     * to locate files the first time they have been instantiated.
     *
     * The '/app' and '/system' directories are already mapped for you.
     * you may change the name of the 'App' namespace if you wish,
     * but this should be done prior to creating any namespaced classes,
     * else you will need to modify all of those classes for this to work.
     *
     * Prototype:
     *   $psr4 = [
     *       'CodeIgniter' => SYSTEMPATH,
     *       'App'         => APPPATH
     *   ];
     *
     * @var array<string, array<int, string>|string>
     * @phpstan-var array<string, string|list<string>>
     */
    public $psr4 = [
        APP_NAMESPACE => APPPATH, // For custom app namespace
        'Config'      => APPPATH . 'Config',
        'Modules\LoginAuth'           => APPPATH . 'Modules/LoginAuth',
        'Modules\Master'         => APPPATH . 'Modules/Master',
        'Modules\Bill_diposit'   => APPPATH . 'Modules/Bill_diposit',
        'Modules\Complain'       => APPPATH . 'Modules/Complain',
        'Modules\Meeting'        => APPPATH . 'Modules/Meeting',
        'Modules\Notice'         => APPPATH . 'Modules/Notice',
        'Modules\Apartment_fund' => APPPATH . 'Modules/Apartment_fund',
        'Modules\User'           => APPPATH . 'Modules/User',
        'Modules\Committee'      => APPPATH . 'Modules/Committee',
        'Modules\Employee'       => APPPATH . 'Modules/Employee',
        'Modules\Super_admin'    => APPPATH . 'Modules/Super_admin',
        'Modules\Setting'        => APPPATH . 'Modules/Setting',
        'Modules\Floor'          => APPPATH . 'Modules/Floor',
        'Modules\Rent'           => APPPATH . 'Modules/Rent',
        'Modules\Maintenance'    => APPPATH . 'Modules/Maintenance',
        'Modules\Visitor'        => APPPATH . 'Modules/Visitor',
        'Modules\Complain'       => APPPATH . 'Modules/Complain',
        'Modules\Mail'           => APPPATH . 'Modules/Mail',
        'Modules\Home'           => APPPATH . 'Modules/Home',
        'Modules\Unit'           => APPPATH . 'Modules/Unit',
        'Modules\Owner'          => APPPATH . 'Modules/Owner',
        'Modules\Tenant'         => APPPATH . 'Modules/Tenant',
        'Modules\Report'         => APPPATH . 'Modules/Report',
        
        
        'Modules\Bank'               => APPPATH . 'Modules/Bank',
        'Modules\BankAccount'        => APPPATH . 'Modules/BankAccount',
        'Modules\BalanceTransfer'    => APPPATH . 'Modules/BalanceTransfer',
        'Modules\DebitsLoans'        => APPPATH . 'Modules/DebitsLoans',
        'Modules\Budgets'            => APPPATH . 'Modules/Budgets',
        'Modules\Expenses'           => APPPATH . 'Modules/Expenses',
        'Modules\ExpensesReport'     => APPPATH . 'Modules/ExpensesReport',
        'Modules\Calender'           => APPPATH . 'Modules/Calender',
        'Modules\ApplicationSetting' => APPPATH . 'Modules/ApplicationSetting',
       
        
        'Modules\Manage_user'=> APPPATH . 'Modules\Manage_user',
        'Modules\CategoryModule'=> APPPATH . 'Modules\CategoryModule',
        'Modules\BankModule'=> APPPATH . 'Modules\BankModule',
        'Modules\IncomeModule'=> APPPATH . 'Modules\IncomeModule',
        'Modules\IncomeReportModule'=> APPPATH . 'Modules\IncomeReportModule',
        'Modules\DashboardModule'=> APPPATH . 'Modules\DashboardModule',
        
    ];

    /**
     * -------------------------------------------------------------------
     * Class Map
     * -------------------------------------------------------------------
     * The class map provides a map of class names and their exact
     * location on the drive. Classes loaded in this manner will have
     * slightly faster performance because they will not have to be
     * searched for within one or more directories as they would if they
     * were being autoloaded through a namespace.
     *
     * Prototype:
     *   $classmap = [
     *       'MyClass'   => '/path/to/class/file.php'
     *   ];
     *
     * @var array<string, string>
     */
    public $classmap = [];

    /**
     * -------------------------------------------------------------------
     * Files
     * -------------------------------------------------------------------
     * The files array provides a list of paths to __non-class__ files
     * that will be autoloaded. This can be useful for bootstrap operations
     * or for loading functions.
     *
     * Prototype:
     *   $files = [
     *       '/path/to/my/file.php',
     *   ];
     *
     * @var string[]
     * @phpstan-var list<string>
     */
    public $files = [];

    /**
     * -------------------------------------------------------------------
     * Helpers
     * -------------------------------------------------------------------
     * Prototype:
     *   $helpers = [
     *       'form',
     *   ];
     *
     * @var string[]
     * @phpstan-var list<string>
     */
    public $helpers = ['form', 'url', 'dateformat_helper', 'cookie', 'rs_email_helper','notification_helper', 'userDetails_helper','menuaccess_helper', 'symbolsetup_helper'];
}
