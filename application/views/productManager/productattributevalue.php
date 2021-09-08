<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<!-- ================== BEGIN PAGE CSS STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<link href="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>

<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->

    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Attribute Values</small></h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-inverse">

        <div class="panel-body">

            <div class="m-b-15">
                <button type="button" class="btn btn-primary p-l-40 p-r-40" data-toggle="modal" data-target="#add_item"><i class="fa fa-plus"></i> Add New</button>
            </div>
            <div class="table-responsive">
                
                <table id="user" class="table table-bordered table-striped">
                    <tr>
                        <th>#ID</th>
                        <?php foreach($attribute as $key =>$adata) {?>
                        <th style="font-size:20px;"> "<?php echo $adata['attribute']; ?>"</th>
                        <?php } ?>
                        <th>Action</th>
                    </tr>
                   <?php foreach($attribute_value as $key =>$vdata) {?>
                    
                    <tr> 
                        <td><?php echo $vdata['id']; ?></td>
                        <td><?php echo $vdata['attribute_value']; ?> </td>
                        <td> <button type="button" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> </button>
                            <button type="button" class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </button>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
    </div>
    <!-- end panel -->
</div>
<!-- end #content -->

<!-- Modal -->
<div class="modal fade" id="edit_item" tabindex="-1" role="dialog" aria-labelledby="changePassword">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="#" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Attribute</h4>
                </div>
                <div class="modal-body">
                   
                        <div class="form-group">
                                 
                                     <input type="hidden" name="update_id" id="update_id" value="">
                                    <label for="attribute name">Attribute Name</label>
                                    <input type="text" name="attribute" id ="attr" class="form-control" value="" required="" placeholder="">

                                    <label for="attribute name">Widget</label>
                                    <input type="text" name="widget" id="widg" class="form-control" value="" required="" placeholder="">
                       </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" name="editData" class="btn btn-primary editbtn">Update</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="changePassword">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="#" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Attribute Value</h4>
                </div>
                <div class="modal-body">
                    
                        <div class="form-group">
                       

                                    <label for="">Attribute Value</label>
                                    <input type="text" name="avalue" class="form-control"  required="" placeholder="Attribute Value">
                       </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submitData" class="btn btn-primary">Submit</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
$this->load->view('layout/footer');
?>
<script>

$(document).ready (function(){
    $('.editbtn').on('click', function(){

    
  $('#edit_item').modal('show');

  $tr =$(this).closest('tr');
  var data =$tr.childern("td").map(function(){
      return $(this).text();
  }).get();
  console.log(data);

  $('#update_id').val(data[0]);
  $('#attr').val(data[1]);
  $('#widg').val(data[2]);

 });
});

    $(function () {


        $('#tags').tagit({
            availableTags: ["c++", "java", "php", "javascript", "ruby", "python", "c"]
        });


        $('.edit_detail').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $($(this).prev()).editable('toggle');
        });

        $(".editable").editable();



<?php
$checklogin = $this->session->flashdata('checklogin');
if ($checklogin['show']) {
    ?>
            $.gritter.add({
                title: "<?php echo $checklogin['title']; ?>",
                text: "<?php echo $checklogin['text']; ?>",
                image: '<?php echo base_url(); ?>assets/emoji/<?php echo $checklogin['icon']; ?>',
                            sticky: true,
                            time: '',
                            class_name: 'my-sticky-class '
                        });
    <?php
}
?>
                })
</script>