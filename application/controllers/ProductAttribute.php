<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class ProductAttribute extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->curd = $this->load->model('Curd_model');
        $session_user = $this->session->userdata('logged_in');
        if ($session_user) {
            $this->user_id = $session_user['login_id'];
        } else {
            $this->user_id = 0;
        }
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
    }

    public function index() {
        $this->all_query();
    }

    function attributeList(){
        $data = array();
        $data['title'] = "Product Attributes";
        $data['description'] = "";
        $data['form_title'] = "Create Attribute";
        $data['table_name'] = 'category_attribute';
        $form_attr = array(
            "attribute" => array("title" => "Attribute Name", "required" => true, "place_holder" => "Attribute Name", "type" => "text", "default" => ""),
            "widget" => array("title" => "Widget", "required" => false, "place_holder" => "widget", "type" => "text", "default" => ""),
            "category_id" => array("title" => "", "required" => false, "place_holder" => "", "type" => "hidden", "default" => ""),
            "display_index" => array("title" => "", "required" => false, "place_holder" => "", "type" => "hidden", "default" => ""),
        );

        if (isset($_POST['submitData'])) {
            $postarray = array();
            foreach ($form_attr as $key => $value) {
                $postarray[$key] = $this->input->post($key);
            }
            $this->Curd_model->insert('category_attribute', $postarray);
            redirect("ProductAttribute/attributeList");
        }

        if (isset($_POST['editData'])) {
            $id= $this->input->post('attrid');
            $editarray=array();
            $editarray= array(
              "attribute" => $this->input->post('attribute'),
              "widget" =>$this->input->post('widget'),
            );
            $this->db->where('id', $id);
            $this->db->update('category_attribute', $editarray);
            redirect("ProductAttribute/attributeList");
        }


        $attribute_data = $this->Curd_model->get('category_attribute');
        $data['list_data'] = $attribute_data;

        $attribute_value = $this->Curd_model->get('category_attribute_value');
        $data['attribute_value'] = $attribute_value;


        $fields = array(
            "id" => array("title" => "ID#", "width" => "100px"),
            "attribute" => array("title" => "Attribute Name", "width" => "15%"),
           
        );

        $data['fields'] = $fields;
        $data['form_attr'] = $form_attr;
        $this->load->view('productManager/productAttribute', $data);
    }

    function attributeValue($id){

            $this->db->where('attribute_id', $id);
            $attribute_value = $this->Curd_model->get('category_attribute_value');
            $data['attribute_value'] = $attribute_value;

            $this->db->where('id', $id);
            $attribute = $this->Curd_model->get('category_attribute');
            $data['attribute'] = $attribute;

            if(isset($_POST["submitData"])){
                $insertArray = array(
                    "attribute_id"=>$id,
                    "attribute_value"=>$this->input->post("avalue"),
                );
                $this->db->insert("category_attribute_value", $insertArray);
                redirect(site_url("ProductAttribute/attributeValue/$id"));
            }


        $this->load->view('productManager/productattributevalue', $data);
    }

}

    ?>