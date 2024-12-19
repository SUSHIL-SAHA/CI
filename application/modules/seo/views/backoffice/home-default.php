<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url();?>administrator">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Default & Home</li>
      </ol>
      <div class="box_general padding_bottom site-setting-area">
      <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Default & Home</h2>
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
            <?php
            if($userPermission['list']){ ?>      
            <form name="modifycontent" action="<?php echo base_url() ; ?>admin/seo/updatehomedefault" method="post" enctype="multipart/form-data">
                <div class="box_general padding_bottom adm-box">
                    <h4>Default</h4>
                    <br clear="all">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Default Page Title *</label>
                                <div class="textlimit">
                                    <textarea name="pageTitleText" class="form-control"><?php echo $seo_default_details->pageTitleText ; ?></textarea>
                                    <div class="charcount">(40 characters)</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Robots Index</label>
                                        <select name="metaRobotsIndex" class="form-control">
                                            <option value="index" <?php if($seo_default_details->metaRobotsIndex=='index') { echo "selected" ;} ?>>index</option>
                                            <option value="noindex" <?php if($seo_default_details->metaRobotsIndex=='noindex') { echo "selected" ;} ?>>noindex</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Robots Follow</label>
                                        <select name="metaRobotsFollow" class="form-control">
                                            <option value="follow" <?php if($seo_default_details->metaRobotsFollow=='follow') { echo "selected" ;} ?>>follow</option>
                                            <option value="nofollow" <?php if($seo_default_details->metaRobotsFollow=='nofollow') { echo "selected" ;} ?>>nofollow</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Default Meta Keyword</label>
                                <textarea name="metaTag" class="form-control" style="height:70px;"><?php echo $seo_default_details->metaTag ; ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Default Meta Description</label>
                                <textarea name="metaDescription" class="form-control" style="height:70px;"><?php echo $seo_default_details->metaDescription ; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box_general padding_bottom adm-box">
                    <h4>Home</h4>
                    <br clear="all">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Home Page Title *</label>
                                <div class="textlimit">
                                    <textarea name="homePageTitleText" class="form-control"><?php echo $seo_home_details->homePageTitleText ; ?></textarea>
                                    <div class="charcount">(74 characters)</div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Home Robots Index</label>
                                        <select name="homeMetaRobotsIndex" class="form-control">
                                            <option value="index" <?php if($seo_home_details->homeMetaRobotsIndex=='index') { echo "selected" ; }?>>index</option>
                                            <option value="noindex" <?php if($seo_home_details->homeMetaRobotsIndex=='index') { echo "selected" ; }?>>noindex</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Home Robots Follow</label>
                                        <select name="homeMetaRobotsFollow" class="form-control">
                                            <option value="follow" <?php if($seo_home_details->homeMetaRobotsFollow=='follow') { echo "selected" ; }?>>follow</option>
                                            <option value="nofollow" <?php if($seo_home_details->homeMetaRobotsFollow=='nofollow') { echo "selected" ; }?>>nofollow</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Home Meta Keyword</label>
                                <textarea name="homeMetaTag" class="form-control" style="height:70px;"><?php echo $seo_home_details->homeMetaTag ; ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Home Meta Description</label>
                                <textarea name="homeMetaDescription" class="form-control" style="height:70px;"><?php echo $seo_home_details->homeMetaDescription ; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="box_general padding_bottom adm-box">
                    <h4>Home</h4>
                    <br clear="all">
                    <div class="row">
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" name="homeIdToEdit" value="1" />
                        <input type="hidden" name="IdToEdit" value="2" />
                        <input type="hidden" name="SourceForm" value="defaultTitleMeta" />
                        <button type="submit" name="Save" value="Save" class="btn btn-info login_btn">Submit</button>
                        <!-- <button type="button" name="Cancel" value="Close" onclick="location.href='<?php //echo base_url() ; ?>admin/seo/default-home'" class="btn btn-default m-l-15">Close</button>  -->  
                    </div>
                </div>
            </form>
            <?php } ?>
        </div>
      </div>
    </div>    
    </div>
  </div>
</div>