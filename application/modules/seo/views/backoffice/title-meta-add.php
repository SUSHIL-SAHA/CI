<?php 
  $titleandMetaUrl = '';
  $pageTitleText = '';
  $metaTag = '';
  $metaDescription = '';
  $canonicalUrl = '';
  $ogImage = '';
  $metaRobotsIndex = '';
  $metaRobotsFollow = '';
  $status = '';
  $headingText = 'Add Mete Title';
  $formID = 'Addmetetitle';
  $action = 'add';
  $id = '';
  if(isset($title_mete_details)){
    $titleandMetaUrl = $title_mete_details[0]->titleandMetaUrl;
    $pageTitleText = $title_mete_details[0]->pageTitleText;
    $metaTag = $title_mete_details[0]->metaTag;
    $metaDescription = $title_mete_details[0]->metaDescription;
    $canonicalUrl = $title_mete_details[0]->canonicalUrl;
    $ogImage = $title_mete_details[0]->ogImage;
    $metaRobotsIndex = $title_mete_details[0]->metaRobotsIndex;
    $metaRobotsFollow = $title_mete_details[0]->metaRobotsFollow;
    $status = $title_mete_details[0]->status;
    // echo "<pre>"; print_r($blog_Politicians_details);die;
    $headingText = 'Mete Title';
    $formID = 'Editmetetitle';
    $action = 'edit';
    $id = $title_mete_details[0]->id;
  }
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url();?>administrator">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Title & Meta</li>
        </ol>
        <div class="box_general padding_bottom site-setting-area">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="header_box version_2">
                            <h2><i class="fa fa-file"></i>Title & Meta</h2>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <?php 
              $error = $this->session->flashdata('error');
              if($error) {
                ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                        <?php 
              } 
              $success = $this->session->flashdata('success');
              if($success) { 
                ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                        <?php 
              } 
              ?>
                        <br clear="all">
                        <?php $this->load->helper("form"); ?>
                        <div class="container-fluid" style="transform: none;">
                            <div style="transform: none;">
                                <form name="modifycontent" action="<?php echo base_url();?>admin/seo/title-meta-insert"
                                    method="post" enctype="multipart/form-data" id="form" style="transform: none;">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                        value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                    <div class="box_general padding_bottom adm-box">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Page URL * [ex. page-name]</label>
                                                    <input type="text" name="titleandMetaUrl"
                                                        value="<?php echo $titleandMetaUrl ; ?>" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Page Title*</label>
                                                    <div class="textlimit">
                                                        <textarea name="pageTitleText"
                                                            class="form-control"><?php echo $pageTitleText ; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Meta Keyword</label>
                                                    <textarea name="metaTag" class="form-control"
                                                        style="height:114px;"><?php echo $metaTag ; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Meta Description</label>
                                                    <textarea name="metaDescription" class="form-control"
                                                        style="height:114px;"><?php echo $metaDescription ; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Robots Index</label>
                                                    <select name="metaRobotsIndex" class="form-control">
                                                        <option value="default"
                                                            <?php if($metaRobotsIndex == 'default') { echo "selected" ; }?>>
                                                            Default</option>
                                                        <option value="index"
                                                            <?php if($metaRobotsIndex == 'index') { echo "selected" ; }?>>
                                                            index</option>
                                                        <option value="noindex"
                                                            <?php if($metaRobotsIndex == 'noindex') { echo "selected" ; }?>>
                                                            noindex</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Robots Follow</label>
                                                    <select name="metaRobotsFollow" class="form-control">
                                                        <option value="follow"
                                                            <?php if($metaRobotsFollow == 'follow') { echo "selected" ; }?>>
                                                            follow</option>
                                                        <option value="nofollow"
                                                            <?php if($metaRobotsFollow == 'nofollow') { echo "selected" ; }?>>
                                                            nofollow</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Canonical URL </label>
                                                    <div class="alert alert-info">
                                                        Leave blank if canonical URL is same as page URL else put full
                                                        URL.
                                                        <br>
                                                        <em>Ex. http://www.coanonicalurl.domain/lorem/ipsum/</em>
                                                    </div>
                                                    <input type="text" name="canonicalUrl"
                                                        value="<?php echo $canonicalUrl ; ?>" class="form-control">
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label>OG Image</label>
                                                    <input type="file" name="ogImage" class="form-control">
                                                    <input type="hidden" value="<?php echo $ogImage ; ?>"
                                                        name="hiddenogImage">
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="action" value="<?php echo $action;?>">
                                    <?php if($id != '') { ?>
                                    <input type="hidden" name="id" value="<?php echo $id;?>">
                                    <?php } ?>
                                    <button type="submit" name="Save" value="Save"
                                        class="btn btn-info login_btn">Submit</button>
                                    <!--  <button type="button" name="Cancel" value="Close" onclick="location.href='<?php echo base_url();?>admin/seo/title-meta'" class="btn btn-default m-l-15">Close</button>   -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>