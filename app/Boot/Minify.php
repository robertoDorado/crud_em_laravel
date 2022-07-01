<?php

use MatthiasMullie\Minify\CSS;
use MatthiasMullie\Minify\JS;

$dir_css = __DIR__ . '/../../public/css';
$dir_js = __DIR__ . '/../../public/js';
$public_dir = __DIR__ . '/../../public';

$_SERVER['HTTP_HOST'] = '127.0.0.1:8000';

if($_SERVER['HTTP_HOST'] === '127.0.0.1:8000') {
    
    if(is_dir($dir_css)) {
    
        $min_css = new CSS;
        $css_files = scandir($dir_css);
    
        $css_files = array_filter($css_files, function($file) {
            if(!preg_match("/^(..|.)$/", $file) && preg_match("/^[a-zA-Z\d\-]+\.css$/", $file)) {
                return $file;
            }
        });
    
        foreach($css_files as $files) {

            $css_file = $dir_css . '/' . $files;

            if(is_file($css_file) && is_readable($css_file)) {
                $min_css->add($css_file);
            }
        }
    
        $min_css->minify($public_dir . '/' . 'minify/style.css');
    }

    if(is_dir($dir_js)) {
    
        $min_js = new JS;
        $js_files = scandir($dir_js);
    
        $js_files = array_filter($js_files, function($file) {
            if(!preg_match("/^(..|.)$/", $file) && preg_match("/^[a-zA-Z\d\-]+\.js$/", $file)) {
                return $file;
            }
        });
    
        foreach($js_files as $files) {

            $js_file = $dir_js . '/' . $files;

            if(is_file($js_file) && is_readable($js_file)) {
                $min_js->add($js_file);
            }
        }
    
        $min_js->minify($public_dir . '/' . 'minify/scripts.js');
    }
}
