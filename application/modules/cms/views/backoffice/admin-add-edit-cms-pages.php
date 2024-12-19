<?php
$pageID      = "";
$pageName    = "";
$pageTitle   = "";
$pageSlug    = "";
$pageContent = "";
$pageStatus  = "";
// $showInMenu  = "";
$metaTitle   = "";
$metaKeyword = "";
//$showInSection  = "";
$metaDescription = "";
$action      = "add";
$headingText = 'Add CMS Page';
$formID = 'addCMS';
$sponsored_title = '';
$sponsored_subtitle = '';
$most_viewed_title = '';
$most_viewed_subtitle = '';
if(isset($getPageDetails) && !empty($getPageDetails)){
  //echo "<pre>"; print_r($project_details); echo "</pre>";die;
  $pageID      = $getPageDetails['pageID'];
  $pageName    = $getPageDetails['pageName'];
  $pageTitle   = $getPageDetails['pageTitle'];
  $pageSlug    = $getPageDetails['pageSlug'];
  $bannerTitle    = $getPageDetails['banner_title'];
  $bannerSubTitle    = $getPageDetails['banner_sub_title'];
  $bannerImage    = $getPageDetails['banner_image'];
  $bannerImage    = $getPageDetails['banner_image'];
  $pageContent = stripslashes($getPageDetails['pageContent']);
  $pageImage   = $getPageDetails['pageFeatureImage'];
  $pageStatus  = $getPageDetails['pageStatus'];
//   $showInMenu  = $getPageDetails['showInMenu'];
//   $showInSection  = $getPageDetails['showInSection'];
  $metaTitle   = $getPageDetails['metaTitle'];
  $metaKeyword = $getPageDetails['metaKeyword'];
  $metaDescription = $getPageDetails['metaDescription'];
  $action      = "edit";
  $headingText = 'Edit CMS Page';
  $formID = 'editCMS';
  
  $sponsored_title = $getPageDetails['sponsored_title'];
  $sponsored_subtitle = $getPageDetails['sponsored_subtitle'];
  $most_viewed_title = $getPageDetails['most_viewed_title'];
  $most_viewed_subtitle = $getPageDetails['most_viewed_subtitle'];
}
?>



<div class="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url();?>admin/cms">CMS Pages</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $headingText;?></li>
        </ol>
        <div class="box_general padding_bottom">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="header_box version_2">
                            <h2><i class="fa fa-file"></i><?php echo $headingText;?></h2>
                            <a class="btn btn-primary btn-md pull-right"
                                href="<?php echo base_url(); ?>admin/cms/pages"><i class="fa fa-level-up"></i> Back to
                                list</a>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <br clear="all">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="AddEditCMSPage" action="<?php echo base_url(); ?>admin/cms/alterCMSPages"
                            method="post" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pageName">Page Name <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" id="pageName" name="pageName"
                                                <?php if($action=='edit') { echo 'readonly'; } ?>
                                                value="<?php echo $pageName;?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pageTitle">Page Title <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" id="pageTitle" name="pageTitle"
                                                value="<?php echo $pageTitle;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pageStatus">Status <span style="color:red;">*</span></label>
                                            <select class="form-control" name="pageStatus" id="pageStatus">
                                                <option value="">Select Option</option>
                                                <option
                                                    <?php echo ($pageStatus != '' && $pageStatus == '1') ? ' selected="selected"' : '';?>
                                                    value="1">Active</option>
                                                <option
                                                    <?php echo ($pageStatus != '' && $pageStatus == '0') ? ' selected="selected"' : '';?>
                                                    value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="showInMenu">Show In Menu <span
                                                    style="color:red;">*</span></label>
                                            <select class="form-control" name="showInMenu" id="showInMenu"
                                                onchange="show_in_function(this.value)">
                                                <option value="">Select Option</option>
                                                <option
                                                    <?php echo ($showInMenu != '' && $showInMenu == 'Y') ? ' selected="selected"' : '';?>
                                                    value="Y">Yes</option>
                                                <option
                                                    <?php echo ($showInMenu != '' && $showInMenu == 'N') ? ' selected="selected"' : '';?>
                                                    value="N">No</option>
                                            </select>
                                        </div>
                                    </div> -->

                                    <!-- <div class="col-md-4" id="show_section_id" style='display:none;'>
                                        <div class="form-group">
                                            <label for="showInMenu">Show In Section<span
                                                    style="color:red;">*</span></label>
                                            <select class="form-control" name="showInSection" id="showInSection">
                                                <option value="">Select Option</option>
                                                <option
                                                    <?php echo ($showInSection != '' && $showInSection == 'QL') ? ' selected="selected"' : '';?>
                                                    value="QL">Quick Links</option>
                                                <option
                                                    <?php echo ($showInSection != '' && $showInSection == 'S') ? ' selected="selected"' : '';?>
                                                    value="S">Support</option>
                                                <option
                                                    <?php echo ($showInSection != '' && $showInSection == 'INFO') ? ' selected="selected"' : '';?>
                                                    value="INFO">Information</option>
                                            </select>
                                        </div>
                                    </div> -->


                                </div>


                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label for="page_content">Page Content <span style="color:red;">*</span></label>
                                        <textarea class="form-control" name="pageContent" id="content"
                                            rows="6"><?php echo $pageContent;?></textarea>
                                    </div>
                                </div>
                                <!--<div class="col-md-4">                                
                    <div class="form-group">
                      <label for="pageImage">Page Feature Image</label>
                      <?php
                      if($pageImage != ''){
                        ?>
                        <img class="img-fluid" src="<?php echo base_url() . '/uploads/cms_page_images/' . $pageImage; ?>" alt="" class="preview-sml"/>
                        <?php
                      }
                      ?>
                      <input type="file" name="pageImage" id="pageImage" class="form-control">
                      <span class="testimonialUpload"></span>
                    </div>
                  </div>-->



                            </div>
                            <span id="more_content"></span>
                    </div>

                    <?php 
                if(isset($getPageExtraFields)){
                  //echo "<pre>"; print_r($getPageExtraFields); die;
                  foreach($getPageExtraFields as $gFields){
                    ?>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label><?php echo $gFields['field_title'];?></label>
                            <?php 
                          switch($gFields['field_type']){
                              case 'image':
                                $pageExtraImage = '';
                                if($gFields['meta_value'] != ''){
                                  //$thumbfileName = str_ireplace('.', '_resized.', $gFields['meta_value']);
                                  $pageExtraImage =  base_url() . 'uploads/cms_page_images/' . $gFields['meta_value'];
                                  ?>
                            <img src="<?php echo $pageExtraImage; ?>" alt="" class="preview-sml cms_image" />
                            <a href="javascript:void(0);" title="Remove" data-page_id="<?php echo $pageID;?>"
                                data-page_image="<?php echo $gFields['meta_value'];?>"
                                data-field_key="<?php echo $gFields['meta_key'];?>" class="btn remove_image">Remove</a>
                            <?php
                                }
                                ?>
                            <input type="file" class="form-control" name="<?php echo $gFields['meta_key'];?>"
                                style="opacity: 1;" />
                            <input type="hidden" name="hidden_<?php echo $gFields['meta_key'];?>"
                                value="<?php echo $gFields['meta_value'];?>">
                            <?php
                                break;
                              case 'textarea':
                                  ?>
                            <textarea class="form-control ckeditor"
                                name="<?php echo $gFields['meta_key'];?>"><?php echo $gFields['meta_value'];?></textarea>
                            <?php
                                  break;
                              case 'textinput':
                                  ?>
                            <input type="text" class="form-control" name="<?php echo $gFields['meta_key'];?>"
                                value="<?php echo $gFields['meta_value'];?>">
                            <?php
                                  break;
                                  case 'file':
                                    $pageExtrafile = '';
                                    if($gFields['meta_value'] != ''){
                                      //$thumbfileName = str_ireplace('.', '_resized.', $gFields['meta_value']);
                                      $pageExtrafile =  base_url() . 'uploads/cms_page_images/' . $gFields['meta_value'];
                                      ?>
                            <video id="video" width="640px" height="350px" autoplay="autoplay" loop="loop"
                                controls="controls" muted="muted">
                                <source src="<?php echo $pageExtrafile;?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>

                            <a href="javascript:void(0);" title="Remove" data-page_id="<?php echo $pageID;?>"
                                data-page_image="<?php echo $gFields['meta_value'];?>"
                                data-field_key="<?php echo $gFields['meta_key'];?>" class="btn remove_image">Remove</a>
                            <?php
                                    }
                                    ?>
                            <input type="file" class="form-control" name="<?php echo $gFields['meta_key'];?>"
                                style="opacity: 1;" />
                            <input type="hidden" name="hiddenfile_<?php echo $gFields['meta_key'];?>"
                                value="<?php echo $gFields['meta_value'];?>">
                            <?php
                                break;
                            }
                            
                          ?>
                        </div>
                    </div>
                    <?php
                    }
                }
                ?>

                    <div class="row">
                  <div class="col-sm-12">
                    <h4>SEO Fields</h4>
                  </div>
                  <div class="col-md-12">                                
                    <div class="form-group">
                      <label for="page_name">Meta Title</label>
                      <input type="text" class="form-control" id="metaTitle" name="metaTitle" value="<?php echo $metaTitle;?>">
                    </div>
                  </div>
                  <div class="col-md-12">                                
                    <div class="form-group">
                      <label for="page_name">Meta Keyword</label>
                      <input type="text" class="form-control" id="metaKeyword" name="metaKeyword" value="<?php echo $metaKeyword;?>">
                    </div>
                  </div>
                  <div class="col-md-12">                                
                    <div class="form-group">
                      <label for="page_name">Meta Description</label>
                      <textarea class="form-control" id="metaDescription" name="metaDescription" rows="6"><?php echo $metaDescription;?></textarea>
                    </div>
                  </div>
                </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <input type="hidden" name="action" value="<?php echo $action;?>">
                    <?php if($pageID != '') { ?>
                    <input type="hidden" name="pageID" value="<?php echo $pageID;?>">
                    <?php } ?>
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                    <input type="button" onclick="location.href='<?php echo base_url();?>admin/cms/pages';"
                        class="btn btn-default" value="Cancel" />
                    <p><span style="color:red;">*</span> fields are mandatory.</p>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>











<script>
function remove_owner_content(id) {
    if (confirm("Are You Sure Want To Delete?")) {
        $.ajax({
            url: '<?php echo base_url();?>administrator/delete-owner-content',
            data: ({
                id: id
            }),
            dataType: 'json',
            type: 'post',
            success: function(data) {
                alert(data.message);
                location.reload();
            }
        });
    }
}
</script>

<script>
function show_in_function(val) {
    // alert(val);
    if (val == 'Y') {
        $('#show_section_id').show();
    } else {
        $('#show_section_id').hide();
    }
}
</script>