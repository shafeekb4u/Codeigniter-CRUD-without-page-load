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


<div class="login-box">
  <div class="login-logo login-box-body pad-bottom0">
    <a href="<?=base_url().ADMIN?>">
    <?=img(array('src' => ASSET.'/img/kuwait_university.png','alt' => 'Kuwait University','class' => '','title' => 'Kuwait University'))?>
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body pad-top0">

    <span class="logerror"></span>
    <?php
    if (count($this->session->flashdata('error')) > 0)
    {
    ?>
    <div class="alert alert-danger">
        <ul> 
        <?php
            foreach ($this->session->flashdata('error') as $error)
                echo '<li>'.$error.'</li>';            
        ?>
        </ul>
    </div>
    <?php
    }
    ?>
    
    <?=form_open_multipart(ADMIN.'/login-verify', array('class' => 'email', 'id' => 'login'))?>

        <div class="form-group has-feedback">
            <?=form_input(array('type'  => 'text','name'  => 'username','id' => 'username','value' => isset($this->session->flashdata('login_inputs')['username']) ? $this->session->flashdata('login_inputs')['username'] : ''/*set_value('username')*/,'class' => 'form-control',
              'required' => 'required','maxlength' => '50','placeholder' => 'Email / Username'))?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <?php /*echo form_error('username','<span class="help-block errorclass">','</span>')*/?>
            <?php /*isset($this->session->flashdata('error')['username']) ? '<span class="help-block errorclass">'.$this->session->flashdata('error')['username'].'</span>' : '';*/?>            
        </div>

        <div class="form-group has-feedback">
            <?=form_password(array('name' => 'password','id' => 'password','value' => isset($this->session->flashdata('login_inputs')['password']) ? $this->session->flashdata('login_inputs')['password'] : '' /*set_value('password')*/,'class' => 'form-control',
              'required' => 'required','placeholder' => 'Password'))?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <?php /*echo form_error('password','<span class="text-danger help-block errorclass">','</span>')*/?>
            <?php //isset($this->session->flashdata('error')['password']) ? '<span class="help-block errorclass">'.$this->session->flashdata('error')['password'].'</span>' : '';*/?>        
        </div>        

        <div class="row">
          <div class="col-xs-8">
            <!-- <div class="checkbox">
                {!! Form::checkbox('remember', '1', Cookie::get('admin_username') ? true : false, array('id'=>'remember')); !!}
                <label for="remember"><span></span>Remember Me</label>
            </div> -->
          </div>
          <!-- /.col -->        

          <div class="col-xs-4">
            <?=form_submit('signin', 'Sign In', array('class' => 'btn btn-success btn-block btn-flat'/*,'style' => 'color: default;'*/))?>
          </div>
          <!-- /.col -->
        </div>
        <?= form_hidden('redirect',$this->uri->uri_string()); ?>
    <?=form_close()?>
   <?php /*
    {{ Form::open(array('url'=>route('adminlogin'),'method' => 'post')) }}      

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox">
              {!! Form::checkbox('remember', '1', Cookie::get('admin_username') ? true : false, array('id'=>'remember')); !!}
              <label for="remember"><span></span>Remember Me</label>
          </div>
        </div>
        <!-- /.col -->        

        <div class="col-xs-4">
          {!! Form::submit('Sign In', ['class' => 'btn btn-success btn-block btn-flat']) !!}
        </div>
        <!-- /.col -->
      </div>

    {{ Form::close() }}
    */?>
    <!-- <a href="<?=base_url().ADMIN?>" class="text-center">Forgot password</a> -->
    <p class="footInfo"></p>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script type='text/javascript' src="<?=base_url().ASSET?>/theme/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script type='text/javascript' src="<?=base_url().ASSET?>/theme/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
