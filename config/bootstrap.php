<?php

CroogoNav::add("extensions.children.password_protect", array(
	'title' => __("Password Protect"),
	'url' => array(
		'plugin' => 'password_protect',
		'controller' => 'password_protect',
		'action' => 'index'
		)));
?>