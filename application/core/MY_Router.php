<?php

class MY_Router extends CI_Router {

    public $method =	'action_index';

    public function __construct($routing = NULL)
    {
        $this->input =& load_class('Input', 'core');
        parent::__construct($routing);
    }

    protected function _parse_routes()
    {
        // Turn the segment array into a URI string
        $uri = implode('/', $this->uri->segments);

        // Get HTTP verb
        $http_verb = isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : 'cli';

        // Is there a literal match?  If so we're done
        if (isset($this->routes[$uri]))
        {

            // Check default routes format
            if (is_string($this->routes[$uri]))
            {
                $this->_set_request(explode('/', $this->routes[$uri]));
                return;
            }
            // Is there a matching http verb?
            elseif (is_array($this->routes[$uri]) && isset($this->routes[$uri][$http_verb]))
            {
                $this->_set_request(explode('/', $this->routes[$uri][$http_verb]));
                return;
            }
        }

        // Loop through the route array looking for wildcards
        foreach ($this->routes as $key => $val)
        {
            // Check if route format is using http verb
            if (is_array($val))
            {
                if (isset($val[$http_verb]))
                {
                    $val = $val[$http_verb];
                }
                else
                {
                    continue;
                }
            }

            // Convert wildcards to RegEx
            // Eidos::mod
            // Добавлена сущность :lang для двубуквенных значений языка
            $key = str_replace(array(':any', ':num', ':lang'), array('[^/]+', '[0-9]+', '[a-z]{2}'), $key);

            // Does the RegEx match?
            if (preg_match('#^'.$key.'$#', $uri, $matches))
            {
                // Eidos::mod
                // Устанавливаем значение языка в зависимости от uri
                if(preg_match('/\[a-z\]\{2\}/', $key))
                {
                    $lang = $this->config->item('multi_language');
                    if(array_key_exists($matches[0], $this->config->item('multi_language')))
                    {
                        if( ! is_null($this->input->cookie('lang')) AND $this->input->cookie('lang') == $lang[$matches[0]])
                        {
                            $this->config->set_item('language', $this->input->cookie('lang'));
                        } else {
                            $this->input->set_cookie('lang', $lang[$matches[0]], 31536000);
                            $this->config->set_item('language', $lang[$matches[0]]);
                        }
                    }
                    $array = explode('/', $matches[0]);
                    if (array_key_exists(current($array), $this->config->item('multi_language')))
                    {
                        if( ! is_null($this->input->cookie('lang')) AND $this->input->cookie('lang') == $lang[current($array)])
                        {
                            $this->config->set_item('language', $this->input->cookie('lang'));
                        } else {
                            $this->input->set_cookie('lang', $lang[current($array)], 31536000);
                            $this->config->set_item('language', $lang[current($array)]);
                        }
                    }
                }

                // Are we using callbacks to process back-references?
                if ( ! is_string($val) && is_callable($val))
                {
                    // Remove the original string from the matches array.
                    array_shift($matches);

                    // Execute the callback using the values in matches as its parameters.
                    $val = call_user_func_array($val, $matches);
                }
                // Are we using the default routing method for back-references?
                elseif (strpos($val, '$') !== FALSE && strpos($key, '(') !== FALSE)
                {
                    $val = preg_replace('#^'.$key.'$#', $val, $uri);
                }

                $this->_set_request(explode('/', $val));
                return;
            }
        }


        // If we got this far it means we didn't encounter a
        // matching route so we'll set the site default route
        $this->_set_request(array_values($this->uri->segments));
    }

    protected function _validate_request($segments)
    {
        $c = count($segments);
        // Loop through our segments and return as soon as a controller
        // is found or when such a directory doesn't exist
        while ($c-- > 0)
        {
            $test = $this->directory
                .ucfirst($this->translate_uri_dashes === TRUE ? str_replace('-', '_', $segments[0]) : $segments[0]);

            if ( ! file_exists(APPPATH.'controllers/'.$test.'.php') && is_dir(APPPATH.'controllers/'.$this->directory.$segments[0]))
            {
                $this->set_directory(array_shift($segments), TRUE);

                // Eidos::mod
                // возможность использовать вложенные директории в контроллере
                /* ----------- ADDED CODE ------------ */

                while(count($segments) > 0 && is_dir(APPPATH.'controllers/'.$this->directory.$segments[0]))
                {
                    $this->set_directory($this->directory . $segments[0]);
                    $segments = array_slice($segments, 1);
                }

                /* ----------- END ------------ */
                continue;
            }

            return $segments;
        }

        // This means that all segments were actually directories
        return $segments;
    }

    protected function _set_routing()
    {
        // Are query strings enabled in the config file? Normally CI doesn't utilize query strings
        // since URI segments are more search-engine friendly, but they can optionally be used.
        // If this feature is enabled, we will gather the directory/class/method a little differently
        if ($this->enable_query_strings)
        {
            $_d = $this->config->item('directory_trigger');
            $_d = isset($_GET[$_d]) ? trim($_GET[$_d], " \t\n\r\0\x0B/") : '';
            if ($_d !== '')
            {
                $this->uri->filter_uri($_d);
                $this->set_directory($_d);
            }

            $_c = trim($this->config->item('controller_trigger'));
            if ( ! empty($_GET[$_c]))
            {
                $this->uri->filter_uri($_GET[$_c]);
                $this->set_class($_GET[$_c]);

                $_f = trim($this->config->item('function_trigger'));
                if ( ! empty($_GET[$_f]))
                {
                    $this->uri->filter_uri($_GET[$_f]);
                    $this->set_method($_GET[$_f]);
                }

                $this->uri->rsegments = array(
                    1 => $this->class,
                    2 => $this->method
                );
            }
            else
            {
                $this->_set_default_controller();
            }

            // Routing rules don't apply to query strings and we don't need to detect
            // directories, so we're done here
            return;
        }

        // Load the routes.php file.
        if (file_exists(APPPATH.'config/routes.php'))
        {
            include(APPPATH.'config/routes.php');
        }

        if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/routes.php'))
        {
            include(APPPATH.'config/'.ENVIRONMENT.'/routes.php');
        }

        // Validate & get reserved routes
        if (isset($route) && is_array($route))
        {
            isset($route['default_controller']) && $this->default_controller = $route['default_controller'];
            isset($route['translate_uri_dashes']) && $this->translate_uri_dashes = $route['translate_uri_dashes'];
            unset($route['default_controller'], $route['translate_uri_dashes']);
            $this->routes = $route;
        }

        // Is there anything to parse?
        if ($this->uri->uri_string !== '')
        {
            $this->_parse_routes();
        }
        else
        {
            if( ! is_null($this->input->cookie('lang')))
            {
                $this->config->set_item('language', $this->input->cookie('lang'));
            }
            $this->_set_default_controller();
        }
    }

    public function set_method($method)
    {
        $this->method = 'action_'.$method;
    }
}