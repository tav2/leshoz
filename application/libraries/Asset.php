<?php

class Asset {

    protected $asset_path = 'assets';

    protected $css_path = 'css';

    protected $js_path = 'js';

    protected $font_path = 'font';

    protected $img_path = 'img';

    /*
     * Добавление произвольных путей
     */
    public function asset_path($path)
    {
        return $this->asset_path = $path;
    }

    /*
     * Подключение css файлов
     */
    public function css($name)
    {
        $css = null;
        if(is_array($name))
        {
            foreach ($name as $file) {
                if(file_exists(FCPATH.$this->asset_path.'/'.$this->css_path.'/'.$file.'.css'))
                {
                    $css .= '<link rel="stylesheet" href="'.$this->asset_path.'/'.$this->css_path.'/'.$file.'.css" />'."\n";
                }
            }

        } else {
            if(file_exists(FCPATH.$this->asset_path.'/'.$this->css_path.'/'.$name.'.css'))
            {
                $css .= '<link rel="stylesheet" href="'.$this->asset_path.'/'.$this->css_path.'/'.$name.'.css" />'."\n";
            }
        }

        return $css;
    }

    /*
     * Подключение js файлов
     */
    public function js($name)
    {
        $js = null;
        if(is_array($name))
        {
            foreach ($name as $file) {
                if(file_exists(FCPATH.$this->asset_path.'/'.$this->js_path.'/'.$file.'.js'))
                {
                    $js .= '<script src="'.$this->asset_path.'/'.$this->js_path.'/'.$file.'.js"></script>'."\n";
                }
            }

        } else {
            if(file_exists(FCPATH.$this->asset_path.'/'.$this->js_path.'/'.$name.'.js'))
            {
                $js .= '<script src="'.$this->asset_path.'/'.$this->js_path.'/'.$name.'.js"></script>'."\n";
            }
        }

        return $js;
    }
}