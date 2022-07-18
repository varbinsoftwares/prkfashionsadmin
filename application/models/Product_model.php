<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function edit_table_information($tableName, $id) {
        $this->User_model->tracking_data_insert($tableName, $id, 'update');
        $this->db->update($tableName, $id);
    }

    public function query_exe($query) {
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data; //format the array into json data
        }
    }

    function delete_table_information($tableName, $columnName, $id) {
        $this->db->where($columnName, $id);
        $this->db->delete($tableName);
    }

    ///*******  Get data for deepth of the array  ********///

    function get_children($id, $container) {
        $this->db->where('id', $id);
        $query = $this->db->get('category');
        $category = $query->result_array()[0];
        $this->db->where('parent_id', $id);
        $query = $this->db->get('category');
        if ($query->num_rows() > 0) {
            $childrens = $query->result_array();

            $category['children'] = $query->result_array();

            foreach ($query->result_array() as $row) {
                $pid = $row['id'];
                $this->get_children($pid, $container);
            }
            return $category;
        } else {
            return $category;
        }
    }

    function getparent($id, $texts) {
        $this->db->where('id', $id);
        $query = $this->db->get('category');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                array_push($texts, $row);
                $texts = $this->getparent($row['parent_id'], $texts);
            }
            return $texts;
        } else {
            return $texts; //format the array into json data
        }
    }

    function parent_get($id) {
        $catarray = $this->getparent($id, []);
        array_reverse($catarray);
        $catarray = array_reverse($catarray, $preserve_keys = FALSE);
        $catcontain = array();
        foreach ($catarray as $key => $value) {
            array_push($catcontain, $value['category_name']);
        }
        $catstring = implode("->", $catcontain);
        return array('category_string' => $catstring, "category_array" => $catarray);
    }

    function child($id) {
        $this->db->where('parent_id', $id);
        $query = $this->db->get('category');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $cat[] = $row;
                $cat[$row['id']] = $this->child($row['id']);
                $cat[] = $row;
            }
            return $cat; //format the array into json data
        }
    }

    function singleProductAttrs($product_id) {
        $query = "SELECT pa.attribute, pa.product_id, pa.attribute_value_id, cav.attribute_value FROM product_attribute as pa 
join attribute_value as cav on cav.id = pa.attribute_value_id
where pa.product_id = $product_id group by attribute_value_id";
        $product_attr_value = $this->query_exe($query);
        $arrayattr = [];
        foreach ($product_attr_value as $key => $value) {
            $attrk = $value['attribute'];
            $attrv = $value['attribute_value'];
            array_push($arrayattr, $attrk . '-' . $attrv);
        }
        return implode(", ", $arrayattr);
    }

    function product_attribute_list($product_id) {
        $this->db->where('product_id', $product_id);
        $this->db->group_by('attribute_value_id');
        $query = $this->db->get('product_attribute');
        $atterarray = array();
        if ($query->num_rows() > 0) {
            $attrs = $query->result_array();
            foreach ($attrs as $key => $value) {
                $atterarray[$value['attribute_id']] = $value;
            }
            return $atterarray;
        } else {
            return array();
        }
    }

    function productAttributes2($product_id) {
        $pquery = "SELECT pa.attribute, cav.attribute_value, cav.additional_value FROM product_attribute as pa
      join attribute_value as cav on cav.id = pa.attribute_value_id
      where pa.product_id = $product_id";
        $attr_products = $this->query_exe($pquery);
        return $attr_products;
    }

    function variant_product_attr($product_id) {
        $queryr = "SELECT pa.attribute_id, pa.attribute, pa.product_id, pa.attribute_value_id, cav.attribute_value FROM product_attribute as pa 
join attribute_value as cav on cav.id = pa.attribute_value_id 
where pa.product_id=$product_id ";
        $query = $this->db->query($queryr);
        return $query->result_array();
    }

    function attributes() {
        $query = $this->db->get('attribute');
        $attrarray = array();
        if ($query) {
            $attrs = $query->result_array();
            foreach ($attrs as $key => $value) {
                $this->db->where('attribute_id', $value["id"]);
                $this->db->group_by('attribute_value');
                $query = $this->db->get('attribute_value');
                $attr_values = $query ? $query->result_array() : [];
                $value["values"] = $attr_values;
                $attrarray[$value["title"]] = $value;
            }

            return $attrarray;
        } else {
            return array();
        }
    }

    function productAttributes($product_id) {
        $query = $this->db->where("product_id", $product_id)->get('product_attribute');
        $attrarray = array();
        if ($query) {
            $attrs = $query->result_array();
            foreach ($attrs as $key => $value) {
                $atquery = $this->db->where("id", $value["attribute_id"])->get('attribute')->row_array();
                $atvquery = $this->db->where("id", $value["attribute_value_id"])->get('attribute_value')->row_array();
                $attrarray[$value["attribute_id"]] = array(
                    "cr_id" => $value["attribute_value_id"],
                    "attr_key" => $atquery["title"],
                    "attr_val" => $atvquery["attribute_value"]
                );
            }
        }
        return $attrarray;
    }

    function productVariants($base_product_id) {
        $query = $this->db->select("sku, id")->where("variant_product_of", $base_product_id)->get('products');
        $totalVariants = array();
        if ($query) {
            $vr_products = $query->result_array();
            foreach ($vr_products as $key => $value) {
                $pr_id = $value["id"];
                $variants = $this->productAttributes($pr_id);
                $totalVariants[$pr_id] = array("sku" => $value["sku"], "variant" => $variants);
            }
        }
        return $totalVariants;
    }

    function attribute_list($id) {
        $this->db->where('attribute_id', $id);
        $this->db->group_by('attribute_value');
        $query = $this->db->get('attribute_value');
        if ($query->num_rows() > 0) {
            $attrs = $query->result_array();
            return $attrs;
        } else {
            return array();
        }
    }

    function category_items_prices_id($category_items_id) {

        $queryr = "SELECT cip.price, ci.item_name, cip.id FROM custome_items_price as cip
                       join custome_items as ci on ci.id = cip.item_id
                       where cip.category_items_id = $category_items_id";
        $query = $this->db->query($queryr);
        $category_items_price_array = $query->result();
        return $category_items_price_array;
    }

    function category_items_prices() {
        $query = $this->db->get('category_items');
        $category_items = $query->result();
        $category_items_return = array();
        foreach ($category_items as $citkey => $citvalue) {
            $category_items_id = $citvalue->id;
            $category_items_price_array = $this->category_items_prices_id($category_items_id);
            $citvalue->prices = $category_items_price_array;
            array_push($category_items_return, $citvalue);
        }
        return $category_items_return;
    }

///udpate after 16-02-2019
    function stringCategories($category_id) {
        $this->db->where('parent_id', $category_id);
        $query = $this->db->get('category');
        $category = $query->result_array();
        $container = "";
        foreach ($category as $ckey => $cvalue) {
            $container .= $this->stringCategories($cvalue['id']);
            $container .= ", " . $cvalue['id'];
        }
        return $container;
    }

    function arrayFilterByElement($element, $meinarray) {

        $container = array();
        foreach ($meinarray as $key => $value) {
            if (in_array($element, $value["list"])) {
                $result = array_diff($value["list"], array($element));
                $container[array_values($result)[0]] = $key;
            }
        }
        return $container;
    }

    function productVariantsBaseProduct($base_product_id, $product_id) {
        $query = $this->db->select("sku, id")->where("variant_product_of", $base_product_id)->get('products');
        $totalVariants = array();
        $productattrs = [];
        $attrspearray = array();
        $majorfilter = array();
        if ($query) {
            $vr_products = $query->result_array();

            foreach ($vr_products as $key => $value) {
                $pr_id = $value["id"];
                $attrs = array();
                $attrvlist = [];
                $variantquery = $query = $this->db->where("product_id", $pr_id)->get('product_attribute');
                if ($variantquery) {
                    $variantresult = $variantquery->result_array();
                    foreach ($variantresult as $akey => $avalue) {
                        if (isset($totalVariants[$avalue["attribute_id"]])) {
                            array_push($totalVariants[$avalue["attribute_id"]]["attr"], $avalue["attribute_value_id"]);
                        } else {
                            $totalVariants[$avalue["attribute_id"]] = array("product" => $pr_id, "attr" => [$avalue["attribute_value_id"]]);
                        }
                        array_push($attrvlist, $avalue["attribute_value_id"]);
                        $attrs[$avalue["attribute_id"]] = $avalue["attribute_value_id"];
                    }
                }
                $productattrs[$pr_id] = array("attr" => $attrs, "list" => $attrvlist);
            }



            foreach ($totalVariants as $akey => $avalue) {
                $temp = array();
                foreach ($avalue['attr'] as $key => $value) {
                    $check = $this->arrayFilterByElement($value, $productattrs);
                    $atvquery = $this->db->where("id", $value)->get('attribute_value')->row_array();
                    $temp[$value] = array("meta" => $atvquery, "connect" => $check);
                    $temp[$value]["meta"]["selected"] = false;
                    $temp[$value]["meta"]["disabled"] = true;
                }
                $atquery = $this->db->where("id", $akey)->get('attribute')->row_array();
                $majorfilter[$akey] = array("meta" => $atquery, "values" => $temp);
            }
        }
        $selectedproduct = ($productattrs[$product_id]["attr"]);
      
        
         $selectedak  = "47";
         $selectedav = $selectedproduct[$selectedak];
         $connecedproducts = [];
        foreach ($selectedproduct as $key => $value) {
            $majorfilter[$key]["values"][$value]["meta"]["selected"] = true;
            
            $nextfilter = $majorfilter[$key]["values"][$value]["connect"];
           $connecedproducts += $nextfilter;
           
        }
        
        

        return array("core" => $productattrs, "filterd" => $majorfilter, "filterproduct" => $totalVariants, "next_filter"=>$connecedproducts);
    }

}
