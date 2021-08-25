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

                    <div class="p-10">
                        <select name="slide_number" class="p-5" style ="width:100px;" id="">
                            <option value="slide_1">Select Slide</option>
                            <option value="slide_1">Slide 1</option>
                            <option value="slide_2">Slide 2</option>
                            <option value="slide_3">Slide 3</option>
                        </select>
                    </div>

                    <form action="#" method="post" enctype="multipart/form-data">
                
                        <!-- begin email to -->
                       <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <label class="control-label">First Line Detail:</label>
                                <div class="m-b-15">
                               
                                    <textarea  class="textarea form-control"  id="wysihtml5" placeholder="Enter text ..." rows="8"  value= "" name="line1" required=""></textarea>
                                </div>
                                <!-- end email subject -->
                                <!-- begin email content -->
                                <label class="control-label">Button Title</label>
                                <div class="m-b-15">
                                   <input type="text" value= "" class="form-control" name="btn_title" required="" />
                                </div>
                                <label class="control-label">Active Date:</label>
                                <div class="m-b-15">
                                   <input type="date" class="form-control" name="date" required="" />
                                </div>
                                <label class="control-label">Add Slide Image:</label>
                                <div class="m-b-15">
                                  <div class="btn-group" role="group" aria-label="..." style="    width: 100%;">
                                    <span class="btn btn-success col fileinput-button" >
                                        <i class="fa fa-plus"></i>
                                        <span>Add files...</span>
                                        <input type="file" name="picture" required="">
                                    </span>

                                   </div>
                                </div>
                                 

                            </div>
                            <div class="col-lg-6 col-sm-12">
                            <label class="control-label">Second Line Detail:</label>
                                <div class="m-b-15">
                                    <textarea  class="textarea form-control" id="wysihtml5" placeholder="Enter text ..." rows="8" name="line2" required=""></textarea>
                                 </div>
                            <label class="control-label">Button Link</label>
                                <div class="m-b-15">
                                   <input type="link" class="form-control" name="btn_link" required="" />
                                </div> 
                            <label class="control-label">Active Time:</label>
                                <div class="m-b-15">
                                   <input type="time" class="form-control" name="time" required="" />
                                </div>          
    
                            <label class="control-label">Status:</label>
                                <div class="m-b-15">
                                   <input type="radio"  name="status" value="Active" required="" />  Active <br>
                                   <input type="radio"  name="status" value="Block" required="" />  Block
                                </div>  
                            
                           </div>
                           
                       </div>
                    

                        <!-- end email content -->
                        <div class="colspan-2">
                        <button type="submit" name="submit_data" class="btn btn-primary p-l-40 p-r-40 " >Submit</button>

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