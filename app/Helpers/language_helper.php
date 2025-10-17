<?php
if (!function_exists('lang')) {
    function lang($key)
    {
        $session = session();
        $locale = $session->get('lang') ?? 'es';
        
        $language = \Config\Services::language();
        $language->setLocale($locale);
        
        return lang('App.'.$key);
    }
}

if (!function_exists('current_lang')) {
    function current_lang()
    {
        return session()->get('lang') ?? 'es';
    }
}