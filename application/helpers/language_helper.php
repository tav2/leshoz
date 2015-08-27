<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( ! function_exists('__'))
{
    function __($line)
    {
        $array_lang = explode('.', $line);

        if (is_array($array_lang) AND count($array_lang) > 1)
        {
            $line = array_pop($array_lang);
            get_instance()->lang->load(implode('/', $array_lang), get_instance()->config->item('language'));
            $line = get_instance()->lang->line($line);
        } else {
            $line = get_instance()->lang->line($line);
        }

        return $line;
    }
}

if ( ! function_exists('lang_id'))
{
    function lang_id()
    {
        $lang_id = array_search(get_instance()->config->item('language'), get_instance()->config->item('multi_language'));
        return ( ! empty($lang_id)) ? $lang_id : 'ru';
    }
}