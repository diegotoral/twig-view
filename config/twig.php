<?php

return array(
    'sufix'         => 'twig',
    'templates_dir' => 'views',
    'helpers'       => array(
        'url'       => new URL(),
        'html'      => new HTML(),
    ),
    'extensions'    => array(
        // Extension class name
    ),
    'options' => array(
        'debug'               => FALSE,
		'trim_blocks'         => FALSE,
		'charset'             => 'utf-8',
		'base_template_class' => 'Twig_Template',
		'cache'               => APPPATH.'cache/twig',
		'auto_reload'         => TRUE,
		'strict_variables'    => FALSE,
		'autoescape'          => FALSE,
		'optimizations'       => -1,
    ),
);
