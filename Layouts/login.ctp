<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <?php echo $this->Html->css('bootstrap.min'); ?>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <?php echo $this->Html->css('../dashboard/css/AdminLTE.min'); ?>
    <!-- iCheck -->
    <?php echo $this->Html->css('../dashboard/css/blue'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


<!-- jQuery 2.1.4 -->
    <?php echo $this->Html->script('../dashboard/js/jQuery-2.1.4.min'); ?>
    <!-- Bootstrap 3.3.5 -->
    <?php echo $this->Html->script('bootstrap.min'); ?>
    <!-- iCheck -->
    <?php echo $this->Html->script('../dashboard/js/icheck.min'); ?>
    <![endif]-->
</head>
<?php echo $this->Flash->render(); ?>
<?php echo $content_for_layout; ?>
</html>


