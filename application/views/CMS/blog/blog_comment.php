<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<!-- ================== BEGIN PAGE CSS STYLE ================== -->

<link href="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>

<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />

<!-- begin #content -->
<!-- begin #content -->
<div id="content" class="content content-full-width">
    <!-- begin vertical-box -->
    <div class="vertical-box">
        <!-- begin vertical-box-column -->
        
        <!-- end vertical-box-column -->
        <!-- begin vertical-box-column -->
        <div class="vertical-box-column">

            <!-- begin wrapper -->
            <div class="wrapper">
                <div class="p-30 bg-white">
                    <!-- begin  form -->
                   
                    <h2>Comment List</h2>

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#Id</th>
                            <th scope="col">Post ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Wbsite</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                            
                             </tr>
                        </thead>
                        <tbody>
                            <?php foreach($blog_comment as $key => $values){?>
                            <tr>
                           <td><?php echo $values['id'];?></td>
                           <td><?php echo $values['post_id'];?></td>
                           <td><?php echo $values['name'];?></td>
                           <td><?php echo $values['email'];?></td>
                           <td><?php echo $values['comment'];?></td>
                           <td><?php echo $values['website'];?></td>
                           <td><?php echo $values['op_date_time'];?></td>
                            <td>
                                <form action="" method="post">
                                <input type="hidden" name ="del" value="<?php echo $values['id'];?>">
                                <button name="approve" class="btn btn-sm btn-success"> <i class="fa fa-check"></i> </button>
                                <button name="delete" type="submit" class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </button>
                                </form>
                            </td>
                            
                            </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                  
    
                </div>
            </div>
            <!-- end wrapper -->
        </div>
        <!-- end vertical-box-column -->
    </div>
    <!-- end vertical-box -->
</div>
<!-- end #content -->


<?php
$this->load->view('layout/footer');
?>
<script>
    function changeCategory(cat_name, cat_id){
          $("#category_name").text(cat_name);
          $("#category_id").val(cat_id);
}
    
    $(function () {






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