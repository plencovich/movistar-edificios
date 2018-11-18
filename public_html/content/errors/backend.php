<?php $this->load->view('template/header');?>
    <div class="middle-box text-center text-muted animated fadeInDown">
      <h1 class="text-success"><?php echo $type; ?></h1>
      <h3 class="font-bold">Ups!</h3>
      <div class="error-desc">
        <?php echo lang('error_'.$type); ?><br>
        <?php echo $is_404 = ($type == '404') ? '<strong>'.current_url().'</strong><br>' : NULL ; ?>
        <a href="<?php echo APP_FOLDER;?>" class="btn btn-primary m-t"><i class="fa fa-home"></i> Principal</a>
      </div>
    </div>
<?php $this->load->view('template/footer'); ?>
<?php exit(); ?>
