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
                   
                    <h2>Edit Slider</h2>

                   
                    <form action="<?php echo site_url("CMS/UpdateSlide/"). $slide['id'];?>" method="post" enctype="multipart/form-data">
                
                        <!-- begin email to -->
                       <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <label class="control-label">First Line Detail:</label>
                                <div class="m-b-15">
                               
                        <input  class ="textarea form-control"  id="wysihtml5" type="textarea" name="line1"  rows="8"  value= "<?php echo $slide['line_1'];?>" />
                                </div>
                                <!-- end email subject -->
                                <!-- begin email content -->
                                <label class="control-label">Button Title</label>
                                <div class="m-b-15">
                                   <input type="text" value= "<?php echo $slide['button_title'];?>" class="form-control" name="btn_title"  />
                                </div>
                                <label class="control-label">Active Date:</label>
                                <div class="m-b-15">
                                   <input type="date" value="<?php echo $slide['active_date'];?>" class="form-control" name="date"  />
                                </div>
                                <label class="control-label">Index:</label>
                                <div class="m-b-15">
                                   <input type="text" value="<?php echo $slide['index'];?>" class="form-control" name="index"  />
                                </div>
                                <label class="control-label">Add New Slide Image:</label>
                                
                                <div class="m-b-15">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <div class="btn-group" role="group" aria-label="..." style="    width: 100%;">
                                    <span class="btn btn-success col fileinput-button" >
                                        <i class="fa fa-plus"></i>
                                        <span>Add files...</span>
                                    
                                        <input type="file"value="<?php echo $slide['picture'];?>" name="picture" >
                                    </span>

                                   </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <?php  if ($slide['image'] != "" && file_exists('./assets/slider_images/'.$slide['image'])) {?>

                                         <img hieght="100px" width="100px" src="<?php echo base_url().'assets/slider_images/'.$slide['image']?>" alt="slider image">

                                         <?php }?>
                                         <?php echo $slide['image'];?>
                                        </div>

                                    </div>
                                  
                                  
                                </div>                                

                            </div>
                            <div class="col-lg-6 col-sm-12">
                            <label class="control-label">Second Line Detail:</label>
                                <div class="m-b-15">
                                    <input  class="textarea form-control" id="wysihtml5" placeholder="Enter text ..." rows="8" type="textarea" value="<?php echo $slide['line_2'];?>" name="line2" />
                                 </div>
                            <label class="control-label">Button Link</label>
                                <div class="m-b-15">
                                   <input type="link" value="<?php echo $slide['button_link'];?>"  class="form-control" name="btn_link"  />
                                </div> 
                            <label class="control-label">Active Time:</label>
                                <div class="m-b-15">
                                   <input type="time" value="<?php echo $slide['active_time'];?>" class="form-control" name="time" required="" />
                                </div>          
    
                            <label class="control-label">Status:</label>
                                <div class="m-b-15">
                                   <input type="radio"  value="<?php echo $slide['status'];?>"  name="status" value=""   required="" <?php echo ($slide['status']== 'Active')? 'checked': ''; ?> >  Active <br>
                                   <input type="radio"  value="<?php echo $slide['status'];?>" name="status" value="" required="" <?php echo ($slide['status']== 'Block')? 'checked': ''; ?> >  Block
                                </div>  
                            
                           </div>
                           
                       </div>
                    

                        <!-- end email content -->
                        <div class="colspan-2">
                        <button type="submit" name="update" class="btn btn-primary p-l-40 p-r-40 " >Update</button>

                        </div>
                    </form>
                  
    
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