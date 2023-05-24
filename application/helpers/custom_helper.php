<?php

if (!function_exists('get_countryname_by_id')) {
    function get_countryname_by_id($id = '')
    {
        $CI = &get_instance();
        $CI->load->database();
        $CI->db->where('id', $id);
        return $CI->db->get('countries')->row()->name;
    }
}

if (!function_exists('get_statename_by_id')) {
    function get_statename_by_id($id = '')
    {
        $CI = &get_instance();
        $CI->load->database();
        $CI->db->where('id', $id);
        return $CI->db->get('states')->row()->name;
    }
}

if (!function_exists('get_cityname_by_id')) {
    function get_cityname_by_id($id = '')
    {
        $CI = &get_instance();
        $CI->load->database();
        $CI->db->where('id', $id);
        return $CI->db->get('cities')->row()->name;
    }
}