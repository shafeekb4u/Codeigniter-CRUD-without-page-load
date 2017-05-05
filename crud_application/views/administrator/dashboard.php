<?=doctype('html5').PHP_EOL?>
<html>
<head>
  <meta charset="utf-8">
  <?= meta('X-UA-Compatible','IE=edge','equiv')?>

  <title>Kuwait University | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?=meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no','name')?>
  <!-- Bootstrap 3.3.5 -->
  <?=link_tag(ASSET.'/theme/bootstrap/css/bootstrap.min.css')?>
  <!-- Font Awesome -->
  <?=link_tag(ASSET.'/theme/dist/css/font-awesome.min.css')?>
  <!-- Ionicons -->
  <?=link_tag(ASSET.'/theme/dist/css/ionicons.min.css')?>
  <!-- Theme style -->
  <?=link_tag(ASSET.'/theme/dist/css/theme.min.css')?>
  <!-- Custom CSS -->
  <?=link_tag(ASSET.'/theme/dist/css/custom.css')?>
    
</head>

<body class="hold-transition login-page">

  <select onchange="javascript:window.location.href='<?php echo base_url(); ?>LanguageSwitcher/switchLang/'+this.value;">
    <option value="en" <?php if($this->session->userdata('site_lang') == 'en') echo 'selected="selected"'; ?>>English</option>
    <option value="ar" <?php if($this->session->userdata('site_lang') == 'ar') echo 'selected="selected"'; ?>>Arabic</option>   
</select>
<p><?php echo $this->lang->line('welcome_message'); ?></p>

<!-- jQuery 2.1.4 -->
<script type='text/javascript' src="<?=base_url().ASSET?>/theme/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script type='text/javascript' src="<?=base_url().ASSET?>/theme/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
