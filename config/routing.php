<?php

$routing = array(
	'/admin\/(.*?)\/(.*?)\/(.*)/' => 'admin/\1_\2/\3',
	'/students\/(.*?)\/(.*?)\/(.*)/' => 'students/\1_\2/\3'
);

$default['controller'] = 'students';
$default['action'] = 'index';