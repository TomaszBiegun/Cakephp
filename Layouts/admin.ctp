<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin| GreenCook</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <?php echo $this->Html->css('bootstrap.min'); ?>
    <!-- Font Awesome -->
    <?php echo $this->Html->css('font-awesome.min'); ?>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <?php echo $this->Html->css('../dashboard/css/dataTables.bootstrap'); ?>
    <?php echo $this->Html->css('../dashboard/css/AdminLTE.min'); ?>
    <!-- iCheck -->
    <?php echo $this->Html->css('../dashboard/css/blue'); ?>
    <?php echo $this->Html->css('../dashboard/css/style'); ?>
    <?php echo $this->Html->css('../dashboard/css/_all-skins.min'); ?>
    <?php echo $this->Html->css('../dashboard/css/_all-skins.min'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery 2.1.4 -->
    <?php echo $this->Html->script('../dashboard/js/jQuery-2.1.4.min'); ?>
    <!-- Bootstrap 3.3.5 -->
    <?php echo $this->Html->script('/nicescroll/jquery.nicescroll.min'); ?>
    <?php echo $this->Html->script('bootstrap.min'); ?>
    <?php echo $this->Html->script('../dashboard/js/jquery.dataTables.min'); ?>
    <?php echo $this->Html->script('../dashboard/js/dataTables.bootstrap.min'); ?>
    <!-- iCheck -->
    <?php echo $this->Html->script('../dashboard/js/icheck.min'); ?>
    <?php echo $this->Html->script('../dashboard/js/jquery.slimscroll.min'); ?>
    <?php echo $this->Html->script('../dashboard/js/fastclick.min'); ?>
    <?php echo $this->Html->script('../dashboard/js/app.min'); ?>
    <?php echo $this->Html->script('../dashboard/js/demo'); ?>
    <?php echo $this->Html->script('../dashboard/js/tinymce.min'); ?>

    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>G</b>C</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Green</b>Cook</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <li>
                        <?php echo $this->Html->link('Wyloguj', array('admin' => true, 'controller' => 'users', 'action' => 'logout')) ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <?php echo $this->Html->image('admin-logo.png'); ?>
                </div>
                <div class="pull-left info">
                    <p>Administrator</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-user"></i> <span>Użytkownicy</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Lista użytkowników', array('admin' => true, 'controller' => 'users', 'action' => 'index'), array('escape' => false)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Dodaj użytkownika', array('admin' => true, 'controller' => 'users', 'action' => 'add'), array('escape' => false)); ?>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-briefcase"></i> <span>Sklep - online</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Lista przedmiotów', array('admin' => true, 'controller' => 'items', 'action' => 'index'), array('escape' => false)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Lista transakcji', array('admin' => true, 'controller' => 'baskets', 'action' => 'index'), array('escape' => false)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Dodaj przedmiot', array('admin' => true, 'controller' => 'items', 'action' => 'add'), array('escape' => false)); ?>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-grain"></i> <span>Produkty / Zamienniki</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Lista produktów', array('admin' => true, 'controller' => 'products', 'action' => 'index'), array('escape' => false)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Lista zamienników', array('admin' => true, 'controller' => 'excels', 'action' => 'replacements'), array('escape' => false)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Zaimportuj produkty', array('admin' => true, 'controller' => 'excels', 'action' => 'import'), array('escape' => false)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Zaimportuj zamienniki', array('admin' => true, 'controller' => 'excels', 'action' => 'replacement'), array('escape' => false)); ?>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-check"></i> <span>Quizy</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Lista quizów', array('admin' => true, 'controller' => 'quizzes', 'action' => 'index'), array('escape' => false)); ?>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-leaf"></i> <span>Diety</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Lista diet', array('admin' => true, 'controller' => 'diets', 'action' => 'index'), array('escape' => false)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Dodaj dietę', array('admin' => true, 'controller' => 'diets', 'action' => 'add'), array('escape' => false)); ?>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-cutlery"></i> <span>Przepisy</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php if ($import): ?>
                            <li>
                                <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Lista przepisów', array('admin' => true, 'controller' => 'recipes', 'action' => 'index'), array('escape' => false)); ?>
                            </li>
                            <li>
                                <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Zaimportuj przepisy', array('admin' => true, 'controller' => 'recipes', 'action' => 'import'), array('escape' => false)); ?>
                            </li>
                        <?php else: ?>
                            <li>
                                <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Zaimportuj produkty', array('admin' => true, 'controller' => 'excels', 'action' => 'import'), array('escape' => false)); ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-usd"></i> <span>Pakiety</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Zobacz pakiety', array('admin' => true, 'controller' => 'packs', 'action' => 'index'), array('escape' => false)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Lista transakcji', array('admin' => true, 'controller' => 'packs', 'action' => 'saldo'), array('escape' => false)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Dodaj pakiet', array('admin' => true, 'controller' => 'packs', 'action' => 'add'), array('escape' => false)); ?>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-header"></i> <span>Blog</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Lista wpisów', array('admin' => true, 'controller' => 'posts', 'action' => 'index'), array('escape' => false)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Dodaj wpis', array('admin' => true, 'controller' => 'posts', 'action' => 'add'), array('escape' => false)); ?>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-cog"></i> <span>Jak to działa ?</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Lista kroków', array('admin' => true, 'controller' => 'steps', 'action' => 'index'), array('escape' => false)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Dodaj krok', array('admin' => true, 'controller' => 'steps', 'action' => 'add'), array('escape' => false)); ?>
                        </li>
                    </ul>
                </li>


                <li class="treeview">
                    <a href="">
                        <i class="glyphicon glyphicon glyphicon-send"></i> <span>Newsletter</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i>Użytkownicy', array('admin' => true, 'controller' => 'newsletters', 'action' => 'index'), array('escape' => false)); ?>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-exclamation-sign"></i> <span>Regulamin</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i>Wyświetl regulamin', array('admin' => true, 'controller' => 'rules', 'action' => 'index'), array('escape' => false)); ?>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-sunglasses"></i> <span>Polityka prywatności</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i>Wyświetl politykę', array('admin' => true, 'controller' => 'policies', 'action' => 'index'), array('escape' => false)); ?>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-pushpin"></i> <span>O nas</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Lista wpisów', array('admin' => true, 'controller' => 'abouts', 'action' => 'index'), array('escape' => false)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Dodaj wpis', array('admin' => true, 'controller' => 'abouts', 'action' => 'add'), array('escape' => false)); ?>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-question-sign"></i> <span>FAQ</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Lista FAQ`s', array('admin' => true, 'controller' => 'faqs', 'action' => 'index'), array('escape' => false)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('<i class="fa fa-circle-o"></i> Dodaj FAQ', array('admin' => true, 'controller' => 'faqs', 'action' => 'add'), array('escape' => false)); ?>
                        </li>
                    </ul>
                </li>

                <!--                <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>ROBIE PRZEPISY</span></a></li>-->
                <!--                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>ROBIE PRZEPISY</span></a></li>-->
                <!--                <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>ROBIE PRZEPISY</span></a></li>-->
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <?php echo $this->Flash->render(); ?>
        <?php echo $content_for_layout; ?>
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2016 <a href="/"> Green Cook</a>. </strong> Wszystkie prawa zastrzeżone
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

            </div><!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">Ustawienia generalne</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Wyloguj się
                            <!--                            <input type="checkbox" class="pull-right" checked>-->
                            <a href="/admin/users/logout" class="glyphicon glyphicon-off pull-right"></a>
                            <!--                            --><?php //echo $this->Html->link('',array('class'=>'glyphicon glyphicon-off','div'=>false));?>
                        </label>

                        <p>
                            Po wylogowaniu się zostaniesz przeniesiony do strony głównej
                        </p>
                    </div><!-- /.form-group -->


                </form>
            </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

</body>
</html>
<script>
    tinymce.init({
        selector: 'textarea',
        theme: 'modern',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    $(function () {
        $('#table').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": true
        });
    });
    //    $(".box-body").niceScroll({
    //        cursorcolor: "#3c8dbc",
    //        cursorwidth: 7,
    //        horizrailenabled: true,
    //        smoothscroll: true,
    //        mousescrollstep: 55
    //    });
</script>
