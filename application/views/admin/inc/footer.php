  <input type="hidden" id="sitepath" value="<?php echo base_url();?>">
  <footer class="sticky-footer">
    <div class="text-center footer-text">
      © <?php echo date('Y');?> Admin Panel All Rights Reserved. Designed &amp; Developed by <a href="http://www.eclicksoftwares.com/" rel="noopener noreferrer nofollow" target="_blank" title="Eclick Softwares &amp; Solutions Pvt. Ltd.">Eclick Softwares &amp; Solutions Pvt. Ltd.</a>
    </div>
  </footer>
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url() ?>admin/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/bootstrap-4.0.0.min.js"></script> 
  <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/admin-datatables.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/dropzone.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/additional-methods.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/form_validation.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/tablednd.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/admin.js"></script>
	<script> 
    if(document.getElementById("content")){
      CKEDITOR.replace( 'content', {
        height: 300,
        filebrowserUploadMethod:"form",
        filebrowserUploadUrl: "<?php echo base_url();?>administrator/uploadcmspageimage"
      });
    }
  </script>
  <script> 
    if(document.getElementById("content1")){
      CKEDITOR.replace( 'content1', {
        height: 300,
        filebrowserUploadMethod:"form",
        filebrowserUploadUrl: "<?php echo base_url();?>administrator/uploadcmspageimage"
      });
    }
  </script>
  <script> 
    if(document.getElementById("content2")){
      CKEDITOR.replace( 'content2', {
        height: 300,
        filebrowserUploadMethod:"form",
        filebrowserUploadUrl: "<?php echo base_url();?>administrator/uploadcmspageimage"
      });
    }
  </script>
  <script> 
    if(document.getElementById("content3")){
      CKEDITOR.replace( 'content3', {
        height: 300,
        filebrowserUploadMethod:"form",
        filebrowserUploadUrl: "<?php echo base_url();?>administrator/uploadcmspageimage"
      });
    }
  </script>
  <script>
      if(document.getElementById("other_content")){
      CKEDITOR.replace( 'other_content', {
        height: 300,
        filebrowserUploadMethod:"form",
        filebrowserUploadUrl: "<?php echo base_url();?>administrator/uploadcmspageimage"
      });
    }
  </script>
  <script> 
    if(document.getElementById("content_description")){
      CKEDITOR.replace( 'content_description', {
        height: 300,
        filebrowserUploadMethod:"form",
        filebrowserUploadUrl: "<?php echo base_url();?>administrator/uploadcmspageimage"
      });
    }
  </script>
  <script>
      $(document).ready(function(){
          
          // Initialize select2
          if($("#selUser").length){
            $("#selUser").select2();
          }

          // Read selected option
          $('#but_read').click(function(){
              var username = $('#selUser option:selected').text();
              var userid = $('#selUser').val();
          
              $('#result').html("id : " + userid + ", name : " + username);
          });
      });
  </script>
</body>
</html>



