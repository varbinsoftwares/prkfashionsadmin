<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class Migration extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->user_id = $this->session->userdata('logged_in')['login_id'];
        $this->user_type = $this->session->logged_in['user_type'];
    }

    public function index() {
        if ($this->db->table_exists('coupon_setting')) {
            // table exists
        } else {
            $this->db->query('CREATE TABLE IF NOT EXISTS `coupon_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(100) DEFAULT NULL,
  `discount_type` varchar(100) DEFAULT NULL,
  `discount_amount` varchar(100) DEFAULT NULL,
  `coupon_type` varchar(250) DEFAULT NULL,
  `valid_till` varchar(100) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `display_index` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;');
        }


        if ($this->db->table_exists('coupon_used')) {
            // table exists
        } else {
            $this->db->query('CREATE TABLE IF NOT EXISTS `coupon_used` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(200) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `c_date` varchar(50) NOT NULL,
  `c_time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;');
        }

        if ($this->db->field_exists('coupon_discount', 'user_order')) {
            // table exists
        } else {
            $this->db->query('ALTER TABLE `user_order` ADD `coupon_discount` VARCHAR(100) NOT NULL AFTER `credit_price`;');
        }
        if ($this->db->field_exists('coupon_id', 'user_order')) {
            // table exists
        } else {
            $this->db->query('ALTER TABLE `user_order` ADD `coupon_id` VARCHAR(100) NOT NULL AFTER `coupon_discount`;');
        }
        
         if ($this->db->field_exists('coupon_code', 'user_order')) {
            // table exists
        } else {
            $this->db->query('ALTER TABLE `user_order` ADD `coupon_code` VARCHAR(10) NOT NULL AFTER `coupon_id`;');
        }
        
        
    }

}
