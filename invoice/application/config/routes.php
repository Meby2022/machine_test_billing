<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';

$route['insert_items'] = 'welcome/insert_items';

$route['view_items'] = 'welcome/view_items';

$route['purchased_pdts'] = 'welcome/purchased_pdts';




$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
