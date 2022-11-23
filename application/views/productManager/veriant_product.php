<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/treejs/themes/default/style.min.css">

<script src="<?php echo base_url(); ?>assets/treejs/jstree.min.js"></script>
<style>
    .product_image{
        height: 200px!important;
    }
    .product_image_back{
        background-size: contain!important;
        background-repeat: no-repeat!important;
        height: 200px!important;
        background-position-x: center!important;
        background-position-y: center!important;
    }
</style>
<!-- Main content -->
<section class="content" ng-controller="productController">
    <div class="well well-sm">
        <a class="btn btn-success btn-lg" href="<?php echo site_url('ProductManager/create_veriant_product/' . $product_id) ?>">Add New Variant Product</a>

    </div>
    <div class="">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Product</h3>
            </div>
            <div class="panel-body">

                <div class="col-md-4">
                    <div class="form-group">
                        <label >SKU (Uniq Product No.)</label><br/>
                        <?php echo $product_obj->sku; ?>
                    </div>
                    <div class="form-group">
                        <label >Title</label><br/>
                        <?php echo $product_obj->title; ?>
                    </div>
                    <div class="form-group">
                        <label >Short Description</label><br/>
                        <?php echo $product_obj->short_description; ?>
                    </div>
                    <div class="form-group">
                        <label >Category </label><br/>
                        <span class='categorystring'>{{selectedCategory.category_string}}</span>

                    </div>
                    <div class="form-group">
                        <label >Description</label><br/>
                        <?php echo $product_obj->description; ?>
                    </div>

                    <div class="">
                        <table class="table">
                            <?php foreach ($product_variants as $pvkey => $pvvalue) {
                                ?>
                                <tr>
                                    <th><?php echo $pvvalue["sku"];?></th>
                                    <?php
                                        foreach ($pvvalue["variant"] as $key => $value) {
                                           
                                            echo "<td>".$value["attr_val"]."</td>";
                                        }
                                    ?>
                                    <th><a href="<?php echo site_url("ProductManager/veriant_product/$pvkey")?>">Edit</th>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="col-md-8">
                    <?php echo $this->session->flashdata('success_msg'); ?>
                    <?php echo $this->session->flashdata('error_msg'); ?>
                    <form action="#" method="post" enctype="multipart/form-data">

                        <div class="col-md-12 row">
                            <?php
                    
                            foreach ($attributes as $akey => $avalue) {
                            
                                ?>
                                <div class="form-group">
                                    <label ><?php echo $avalue["title"] ?></label>
                                    <input type="hidden" name="attribute_id[]" value="<?php echo $avalue["id"]; ?>">
                                    <select class="form-control price_tag_text"  name="attribute_value_id[]"  >
                                        <option value="">Select <?php echo $avalue["title"] ?></option>                                       
                                        <?php
                                        foreach ($avalue["values"] as $key => $value) {
                                            $attr_val_id = $value["id"];
                                            $attr_val = $value["attribute_value"];
                                            $selected = isset($product_attributes["" . $avalue["id"]]) && $product_attributes["" . $avalue["id"]]["cr_id"] == $attr_val_id ? "selected" : "";
                                            echo "<option value='$attr_val_id' $selected>$attr_val</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                            }
                            ?>                            
                        </div>


                        <!--price-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Regular Price</label>
                                    <input type="number" class="form-control price_tag_text" id='regular_price' name="regular_price"  aria-describedby="emailHelp" placeholder="" value="<?php echo $product_obj->regular_price; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Sale Price</label>
                                    <input type="number" class="form-control price_tag_text" id='sale_price' name="sale_price"  aria-describedby="emailHelp" placeholder="" value="<?php echo $product_obj->sale_price; ?>"> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Final Price</label>
                                    <span class="final_price form-control" id='finalprice'><?php echo $product_obj->price; ?></span>
                                    <input type="hidden" class="form-control price_tag_text" id='finalprice1' name="price"  aria-describedby="emailHelp" placeholder="" value="<?php echo $product_obj->price; ?>"> 

                                </div>
                            </div>


                        </div>
                        <!--end of price-->



                        <!--pictures-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    <?php
                                    if ($product_obj->file_name) {
                                        ?>
                                        <div class="product_image product_image_back" style="background: url(<?php echo (base_url() . "assets/product_images/" . $product_obj->file_name); ?>)">
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="product_image product_image_back" style="background: url(<?php echo (base_url() . "assets/default/default.png"); ?>)">
                                        </div>
                                        <?php
                                    }
                                    ?>





                                    <div class="caption">
                                        <div class="form-group">
                                            <label for="image1">Upload Primary Image</label>
                                            <input type="file" name="picture" />           
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">                           
                                <div class="thumbnail" >
                                    <?php
                                    if ($product_obj->file_name1) {
                                        ?>
                                        <div class="product_image product_image_back" style="background: url(<?php echo (base_url() . "assets/product_images/" . $product_obj->file_name1); ?>)">
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="product_image product_image_back" style="background: url(<?php echo (base_url() . "assets/default/default.png"); ?>)">
                                        </div>
                                        <?php
                                    }
                                    ?>             
                                    <div class="caption">
                                        <div class="form-group">
                                            <label for="image1">Upload Image 1</label>
                                            <input type="file" name="picture1" />           
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">                           
                                <div class="thumbnail" >
                                    <?php
                                    if ($product_obj->file_name2) {
                                        ?>
                                        <div class="product_image product_image_back" style="background: url(<?php echo (base_url() . "assets/product_images/" . $product_obj->file_name2); ?>)">
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="product_image product_image_back" style="background: url(<?php echo (base_url() . "assets/default/default.png"); ?>)">
                                        </div>
                                        <?php
                                    }
                                    ?>               
                                    <div class="caption">
                                        <div class="form-group">
                                            <label for="image1">Upload Image 2</label>
                                            <input type="file" name="picture2" />           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--pictures-->

                        <!--product availabilities-->
                        <div class='row'>
                            <div class="col-md-3">    
                                <div class="form-group">
                                    <label >Show In Offers</label>
                                    <select  name='offer' class='form-control'>
                                        <option value='1' <?php echo $product_obj->offer == '1' ? 'selected' : ''; ?>>Yes</option>
                                        <option value='0' <?php echo $product_obj->offer == '0' ? 'selected' : ''; ?>>No</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">                           
                                <div class="form-group">
                                    <label >Product Availabilities</label>
                                    <select  name='stock_status' class='form-control'>
                                        <option value='In Stock' <?php echo $product_obj->stock_status == 'In Stock' ? 'selected' : ''; ?>>In Stock</option>
                                        <option value='Out Of Stock'  <?php echo $product_obj->stock_status == 'Out Of Stock' ? 'selected' : ''; ?>>Out Of Stock</option>
                                    </select>

                                </div>
                            </div>
                        </div>






                        <button type="submit" name="editdata" class="btn btn-primary">Submit</button>
                        <?php
                        if ($product_obj->status == 1) {
                            ?>
                            <button type="submit" name="removedata" class="btn btn-danger">Remove</button>
                            <?php
                        }
                        ?>
                        <?php
                        if ($product_obj->status == 0) {
                            ?>
                            <button type="submit" name="recoverdata" class="btn btn-warning">Recover</button>
                            <button type="submit" name="deletedata" class="btn btn-danger">Delete</button>
                            <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade categoryopen" id="category_model">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Select Category</h4>
                </div>
                <div class="modal-body">
                    <div id="using_json_2" class="demo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- end col-6 -->










<script src="<?php echo base_url(); ?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
<?php
$this->load->view('layout/footer');
?> 
<script>
                            $(function () {
                                $(".price_tag_text").keyup(function () {
                                    var rprice = Number($("#regular_price").val());
                                    var sprice = Number($("#sale_price").val());
                                    console.log(sprice, rprice)
                                    if (sprice) {
                                        if (rprice > sprice) {
                                            $("#finalprice").text(sprice);
                                            $("#finalprice1").val(sprice);
                                        } else {
                                            $("#finalprice").text(rprice);
                                            $("#finalprice1").val(rprice);
                                            $("#sale_price").val(0)
                                        }
                                    } else {
                                        $("#finalprice").text(rprice);
                                        $("#finalprice1").val(rprice);
                                        $("#sale_price").val(0)
                                    }
                                })
                            });

</script>

<script>
    Admin.controller('productController', function ($scope, $http, $filter, $timeout) {
        $scope.selectedCategory = {'category_string': '<?php echo $category_string; ?>', 'category_id': ""};

        var url = "<?php echo base_url(); ?>index.php/ProductManager/category_api";
        $http.get(url).then(function (rdata) {
            $scope.categorydata = rdata.data;
            $scope.categorydata = rdata.data;
            $('#using_json_2').jstree({'core': {
                    'data': $scope.categorydata.tree
                }});

            $('#using_json_2').bind('ready.jstree', function (e, data) {
                $timeout(function () {
                    $scope.getCategoryString(4);
                }, 100);
            })
        });



        $scope.getCategoryString = function (catid) {
            console.log(catid)
            var objdata = $('#using_json_2').jstree('get_node', catid);
            var catlist = objdata.parents;
            $timeout(function () {
                $scope.selectedCategory.selected = objdata;
                var catsst = [];
                for (i = catlist.length + 1; i >= 0; i--) {
                    var catid = catlist[i];
                    var catstr = $scope.categorydata.list[catid];
                    if (catstr) {
                        catsst.push(catstr.text);
                    }
                }
                catsst.push(objdata.text);
                $("#category_id").val(objdata.id);
                console.log(objdata.id)
                $scope.selectedCategory.category_string = catsst.join("->")
            }, 100)
        }

        $(document).on("click", "[selectcategory]", function (event) {
            var catid = $(this).attr("selectcategory");
            $("#category_model").modal("hide");
            $scope.getCategoryString(catid);
        })


    })




</script>

