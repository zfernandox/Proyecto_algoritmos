<?php
namespace App\Controllers;

class LanguageController extends BaseController
{
    public function switch($lang)
    {
        $session = session();
        $supportedLangs = ['es', 'en'];
        
        if (in_array($lang, $supportedLangs)) {
            $session->set('lang', $lang);
        }
        
        return redirect()->back();
    }
}