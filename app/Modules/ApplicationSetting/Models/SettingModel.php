<?php

namespace Modules\ApplicationSetting\Models;

use CodeIgniter\Model;


class SettingModel extends Model{
    protected $DBGroup              = 'default';
    protected $table                = 'application_setting';
    protected $primaryKey           = 'id';

    protected $allowedFields = ['company_name','site','company_phone','email','timezone','language','direction','company_address','Number_of_data_per_page','registration_type','default_currency','code','seperator','logo','logoLight','favicon','property_id'];
}