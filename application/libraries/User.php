<?php

/**
 * Class Auth
 */
class User {

    protected $CI;

    protected $login = 'login';
    protected $password = 'password';

    protected $db_table = 'users';
    protected $db_field_name = 'user_name';
    protected $db_field_pass = 'user_password';

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    /**
     * Проверка на авторизацию
     *
     * @return bool
     */
    public function check()
    {
        if($this->CI->session->userdata('is_auth') === true)
        {
            return true;
        }

        return false;
    }

    public function check_and_redirect($to = '/', $exclude = '')
    {
        if($this->CI->session->userdata('is_auth') === true)
        {
            return true;
        } else {
            if(uri_string() == $to OR uri_string() == $exclude)
            {
                return false;
            }
        }

        redirect($to);
    }

    public function login($name = '', $pass = '')
    {
        $name = ( ! is_null($this->CI->input->post($this->login))) ? $this->CI->input->post($this->login) : $name;
        $pass = ( ! is_null($this->CI->input->post($this->password))) ? $this->CI->input->post($this->password) : $pass;

        $query = $this->CI->db->get_where($this->db_table, array($this->db_field_name => $name));
        $result = ($query->num_rows() > 0) ? $query->row_array() : false;

        if(password_verify($pass, $result[$this->db_field_pass]))
        {
            $this->CI->session->set_userdata('is_auth', true);

            return true;
        }

        return false;
    }

    public function logout()
    {
        $this->CI->session->unset_userdata('is_auth');
        $this->CI->session->sess_destroy();

        return true;
    }
}