<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sitesettings_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }

    function getSiteSettings(){
        $this->db->select("*");
        $this->db->from('site_settings');
        //$this->db->where('site_id', $siteID);
        $Query = $this->db->get();
        $Array = $Query->row_array();
        return $Array;
    }

    function getCurrencies($currencyId = 0){
        $this->db->select("id, country, currency, code, symbol", FALSE);
        $this->db->from('currencies');
        if($currencyId>0)
        {
            $this->db->where('id', $currencyId);
        }
        $Query = $this->db->get();
        $Array = $Query->result_array();
        return $Array;
    }
}
