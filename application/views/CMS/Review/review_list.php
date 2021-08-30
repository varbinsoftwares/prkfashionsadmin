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
                   
                    <h2>All User Reviews </h2>

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Sr. no.</th>
                            <th scope="col">Product_Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Rating Date</th>
                            <th scope="col ">Rating Time</th>
                            <th scope="col ">Status</th>
                            <th scope="col">Status Action</th>
                        
                            
                             </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach( $review_data as $key => $value)  {?>
                            <tr>
                            <th scope="row"><?php echo $i++; ?></th>
                            <td><?php echo $value['product_id'];?></td>
                            <td><?php echo $value['name'];?></td>
                            <td><?php echo $value['email'];?></td>
                            <td><?php echo $value['comment'];?></td>
                            <td><?php echo $value['rating'];?></td>
                            <td><?php echo $value['review_date'];?></td>
                            <td><?php echo $value['review_time'];?></td>
                            <td><?php if ($value['status']=='Approved'){?>
                                <b class="text-success"><?php echo $value['status']; } 

                                else {?><b class="text-danger"><?php echo $value['status']; }?></b>
                            </td>
                            <form action="<?php echo site_url('CMS/reviewAction/') .$value['id'];?>" method="post">
                            
                            <input type="hidden" name="appr" value="Approved">
                            <input type="hidden" name="rjt" value="Rejected">
                            
                            <td> <button type="submit" name="approve" class="btn btn-sm btn-success">Approve </button>
                            <button  type="submit" name="reject" class="btn btn-sm btn-danger">Reject </button> 
                            </td>
                            </form>
                            
                            </tr>
                            <?php  }  ?>
                           
                            
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