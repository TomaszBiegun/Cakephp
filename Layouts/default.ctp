<!doctype html>
<html lang="PL-pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Green Cook</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Style -->

    <?php echo $this->Html->css('bootstrap.min'); ?>


    <!-- Skrypty -->
    <?php echo $this->Html->script('jquery-2.2.1.min'); ?>
    <?php echo $this->Html->script('bootstrap.min'); ?>
    <?php echo $this->Html->script('jquery.mask'); ?>

    <!-- Responsive Grid -->
    <?php echo $this->Html->css('/responsivegrid/style'); ?>
    <?php echo $this->Html->script('/responsivegrid/jquery.responsivegrid.min'); ?>

    <!-- nicescroll -->
    <?php echo $this->Html->script('/nicescroll/jquery.nicescroll.min'); ?>
    <?php echo $this->Html->script('../Chart.js/Chart.min'); ?>
    <!--font awesome -->
    <?php echo $this->Html->css('font-awesome.min'); ?>
    <?php echo $this->Html->css('font-awesome-animation.min'); ?>

    <!-- Główne -->
    <?php echo $this->Html->css('style'); ?>
    <?php echo $this->Html->css('media'); ?>
    <?php echo $this->Html->css('style_new'); ?>

    <?php echo $this->Html->script('main'); ?>
    <?php echo $this->Html->script('custom-select'); ?>
    <?php
    if (($this->params['controller'] == 'users') && (($this->params['action'] == 'shoppinglist'))) {
        echo $this->Html->css('jquery-ui');
        echo $this->Html->script('jquery-ui');
    };?>

</head>

<?php
$class = '';
if (($this->params['controller'] == 'pages') && (($this->params['action'] == 'home') || ($this->params['action'] == 'how'))) {
    $class = 'homepage';
}
if (($this->params['controller'] == 'users') && ($this->params['action'] == 'register')) {
    $class = 'register';
}
if (($this->params['controller'] == 'pages') && ($this->params['action'] == 'faq')) {
    $class = 'faq';
}
if (($this->params['controller'] == 'users') && ($this->params['action'] == 'account')) {
    $class = 'my-account';
}
if (($this->params['controller'] == 'quizzes') && ($this->params['action'] == 'add')) {
    $class = 'quiz';
}
if (($this->params['controller'] == 'pages') && ($this->params['action'] == 'about')) {
    $class = 'about';
}
if (($this->params['controller'] == 'pages') && ($this->params['action'] == 'diet')) {
    $class = 'diet';
}
if (($this->params['controller'] == 'pages') && (($this->params['action'] == 'pack') || ($this->params['action'] == 'singlepack'))) {
    $class = 'package';
}
if (($this->params['controller'] == 'pages') && (($this->params['action'] == 'blog') || ($this->params['action'] == 'singleblog'))) {
    $class = 'blog';
}
if (($this->params['controller'] == 'pages') && ($this->params['action'] == 'calc')) {
    $class = 'calculator';
}
if (($this->params['controller'] == 'pages') && ($this->params['action'] == 'calc')) {
    $class = 'calculator';
}
if (($this->params['controller'] == 'pages') && ($this->params['action'] == 'terms')) {
    $class = 'terms';
}
if (($this->params['controller'] == 'pages') && ($this->params['action'] == 'policy')) {
    $class = 'privacy-policy';
}
if (($this->params['controller'] == 'users') && ($this->params['action'] == 'myscore')) {
    $class = 'personal-results';
}
if (($this->params['controller'] == 'users') && ($this->params['action'] == 'shoppinglist')) {
    $class = 'shopping-list';
}
if (($this->params['controller'] == 'pages') && ($this->params['action'] == 'search')) {
    $class = 'search';
}
if (($this->params['controller'] == 'pages') && ($this->params['action'] == 'contact')) {
    $class = 'contact';
}
if (($this->params['controller'] == 'items')) {
    $class = 'shop';
}

?>
<body class="<?php echo $class; ?>">

<header id="header" class="navbar">
    <nav role="navigation" class="main-nav">
        <div class="navbar-header">
            <div class="header-nav-logo">
                <a class="header-nav-logo-link header-logo" href="/">
                    <?php echo $this->Html->image('gc-logo.jpg'); ?>
                </a>
            </div>
        </div>


        <div class="navbar-main navbar-right">
            <div class="user-menu-container">
                <div class="user-panel user-not-loged">
                    <div class="user">
                        <div class="my-shop">
                            <a data-dismiss="modal" data-toggle="modal"
                               data-target="#basket" class="basket-icon my-shop-icon">

                            </a>
                        </div>
                        <?php if (!$log): ?>


                            <?php echo $this->Html->link('', '#', array('label' => false, 'class' => 'glyphicon glyphicon-lock', 'data-toggle' => 'modal', 'data-target' => '#userLoginModal')); ?>
                            <!--                            --><?php //echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-lock')), '#', array('label' => false, 'data-toggle' => 'modal', 'data-target' => '#userLoginModal', 'escape' => false)); ?>
                            <!--                            --><?php //echo $this->Html->link('Zaloguj', '#', array('class' => 'btn-green btn-login', 'data-toggle' => 'modal', 'data-target' => '#userLoginModal')); ?>
                            <!--                            --><?php //echo $this->Html->link('Zarejestruj', array('controller' => 'users', 'action' => 'register'), array('class' => 'btn-green btn-register')) ?>

                        <?php else: ?>


                            <div class="user-welcome">
                                <span> Witaj <?php echo $user['name']; ?></span>
                            </div>

                            <div class="user-menu-button">
                                <button type="button" class="user-panel-toggle" style="display: block;">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>

                            </div>

                            <div class="user-menu-area">
                                <a href="#" class="close-menu faa-tada animated-hover"> </a>

                                <div class="overlay"></div>


                                <div class="user-menu-list-inner">
                                    <script>
                                        $(document).ready(function () {
                                            var randomTexture = Math.floor(Math.random() * 4);
                                            $('.user-menu-list-inner').addClass('texture-' + randomTexture);
                                        });
                                    </script>
                                    <div class="user-box">
                                        <div class="user-avatar">
                                            <?php if ($user['dirname'] != 'null'): ?>
                                                <?php echo $this->Media->embed('t' . DS . $user['dirname'] . DS . $user['basename'], array('width' => '', 'heigth' => '', 'class' => 'user-thumb')); ?>
                                            <?php else: ?>
                                                <?php echo $this->Html->image('user.png', array('class' => 'user-thumb')); ?>
                                            <?php endif; ?>
                                            <!--                                            --><?php //echo $this->Html->image('user-avatar.jpg', array('class' => 'user-thumb')); ?>
                                        </div>

                                        <div class="user-info">

                                            <span
                                                class="user-name"><?php echo $user['name'] . ' ' . $user['surname']; ?></span>
                                        </div>
                                    </div>
                                    <nav class="user-menu-list-container ">
                                        <ul class="panel-group user-menu-headings" id="accordion-user-panel"
                                            role="tablist"
                                            aria-multiselectable="true">
                                            <li class="panel user-menu-group" role="tab" id="user-menu-heading-1">
                                                <a href="#user-menu-1" role="button" data-parent="#accordion-user-panel"
                                                   data-toggle="collapse" aria-expanded="true"
                                                   aria-controls="user-menu-1">
                                                    <i class="fa fa-user faa-vertical animated faa-slow"></i> Moje konto
                                                </a>

                                                <div id="user-menu-1" class="panel-collapse collapse in" role="tabpanel"
                                                     aria-labelledby="user-menu-heading-1">
                                                    <div class="panel-body">

                                                        <ul class="user-menu-list">
                                                            <li class="user-menu-element">
                                                                <a href="/users/account">
                                                                    Zobacz profil
                                                                    <i class="fa fa-arrow-left faa-passing-reverse animated faa-fast"></i>
                                                                </a>
                                                            </li>
                                                            <li class="user-menu-element">
                                                                <a href="/users/account">Płatności
                                                                    <i class="fa fa-arrow-left faa-passing-reverse animated faa-fast"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--                                            <li class="panel user-menu-group" role="tab" id="user-menu-heading-2">-->
                                            <!--                                                <a href="#user-menu-2" role="button" data-parent="#accordion-user-panel"-->
                                            <!--                                                   data-toggle="collapse" aria-expanded="true"-->
                                            <!--                                                   aria-controls="user-menu-2">-->
                                            <!--                                                    <i class="glyphicon glyphicon-apple faa-pulse animated faa-slow"></i>-->
                                            <!--                                                    Moje jedzenie-->
                                            <!--                                                </a>-->
                                            <!---->
                                            <!--                                                <div id="user-menu-2" class="panel-collapse collapse" role="tabpanel"-->
                                            <!--                                                     aria-labelledby="user-menu-heading-2">-->
                                            <!--                                                    <div class="panel-body">-->
                                            <!--                                                        <ul class="user-menu-list">-->
                                            <!--                                                            <li class="user-menu-element">-->
                                            <!--                                                                <a href="#">-->
                                            <!--                                                                    Moje wybory-->
                                            <!--                                                                    <i class="fa fa-arrow-left faa-passing-reverse animated faa-fast"></i>-->
                                            <!--                                                                </a>-->
                                            <!---->
                                            <!--                                                            </li>-->
                                            <!--                                                        </ul>-->
                                            <!--                                                    </div>-->
                                            <!--                                                </div>-->
                                            <!--                                            </li>-->
                                            <li class="panel user-menu-group" role="tab" id="user-menu-heading-3">
                                                <a href="#user-menu-3" role="button" data-parent="#accordion-user-panel"
                                                   data-toggle="collapse" aria-expanded="true"
                                                   aria-controls="user-menu-3">
                                                    <i class="glyphicon glyphicon-grain faa-pulse animated faa-slow"></i>
                                                    Moja dieta
                                                </a>

                                                <div id="user-menu-3" class="panel-collapse collapse" role="tabpanel"
                                                     aria-labelledby="user-menu-heading-3">
                                                    <div class="panel-body">
                                                        <ul class="user-menu-list">
                                                            <li class="user-menu-element">
                                                                <a href="/users/mydiet">
                                                                    Zobacz plan diety
                                                                    <i class="fa fa-arrow-left faa-passing-reverse animated faa-fast"></i>
                                                                </a>
                                                            </li>
                                                            <li class="user-menu-element">
                                                                <?php echo $this->Html->link('Zobacz listę zakupów <i class="fa fa-arrow-left faa-passing-reverse animated faa-fast"></i>', array('controller' => 'users', 'action' => 'shoppinglist'), array('escape' => false)) ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--                                            <li class="panel user-menu-group" role="tab" id="user-menu-heading-4">-->
                                            <!--                                                <a class="collapsed" href="#user-menu-4"-->
                                            <!--                                                   data-parent="#accordion-user-panel"-->
                                            <!--                                                   role="button" data-toggle="collapse" aria-expanded="false"-->
                                            <!--                                                   aria-controls="user-menu-4">-->
                                            <!--                                                    <i class="fa fa-wrench faa-wrench animated faa-slow"></i> Ustawienia-->
                                            <!--                                                </a>-->
                                            <!---->
                                            <!--                                                <div id="user-menu-4" class="panel-collapse collapse" role="tabpanel"-->
                                            <!--                                                     aria-labelledby="user-menu-heading-4">-->
                                            <!--                                                    <div class="panel-body">-->
                                            <!---->
                                            <!--                                                        <ul class="user-menu-list">-->
                                            <!--                                                            <li class="user-menu-element">-->
                                            <!--                                                                <a href="/users/account">-->
                                            <!--                                                                    Zmień ustawienia konta-->
                                            <!--                                                                    <i class="fa fa-arrow-left faa-passing-reverse animated faa-fast"></i>-->
                                            <!--                                                                </a>-->
                                            <!--                                                            </li>-->
                                            <!--                                                        </ul>-->
                                            <!--                                                    </div>-->
                                            <!--                                                </div>-->
                                            <!--                                            </li>-->
                                            <li class="panel user-menu-group" id="user-menu-heading-4">
                                                <a class="collapsed" href="/users/logout" role="button">
                                                    <i class="fa fa-power-off faa-bounce animated faa-slow"></i> Wyloguj
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>


                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="search-bar-container">
                <div class="search-bar">
                    <?php echo $this->Form->create('Page', array('id' => 'searchform', 'class' => 'searchform', 'type' => 'get', 'url' => array("controller" => "pages", "action" => "search"))); ?>
                    <div class="my-slide">
                        <input class="search-on-site" name="search" type="text" placeholder="WPISZ SZUKANE HASŁO"/>
                    </div>


                    <?php echo $this->Form->submit('', array('id' => 'searchbutton', 'class' => 'btn-search')); ?>
                    <?php echo $this->Form->end(); ?>
                </div>


            </div>

            <div class="main-menu-container dropdown">
                <div class="main-menu-dropdown" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false">
                    Menu
                    <span class="caret"></span>
                </div>
                <ul class="nav navbar-nav dropdown-menu main-menu" aria-labelledby="dLabel">
                    <li class="<?php if ($this->params['action'] == 'intro') {
                        echo "header-nav-item active";
                    } else {
                        echo "header-nav-item";
                    } ?>">
                        <?php echo $this->Html->link('Wprowadzenie', array('controller' => 'pages', 'action' => 'intro'), array('class' => 'header-nav-navigation-link')); ?>
                    </li>
                    <li class="<?php if ($this->params['action'] == 'about') {
                        echo "header-nav-item active";
                    } else {
                        echo "header-nav-item";
                    } ?>">
                        <?php echo $this->Html->link('O nas', array('controller' => 'pages', 'action' => 'about'), array('class' => 'header-nav-navigation-link')); ?>
                    </li>
                    <li class="<?php if ($this->params['action'] == 'how') {
                        echo "header-nav-item active";
                    } else {
                        echo "header-nav-item";
                    } ?>">
                        <?php echo $this->Html->link('Jak to działa ?', array('controller' => 'pages', 'action' => 'how'), array('class' => 'header-nav-navigation-link')); ?>
                    </li>
                    <li class="<?php if ($this->params['action'] == 'calc' || $this->params['action'] == 'calc2') {
                        echo "header-nav-item calculatorDropdownContainer active";
                    } else {
                        echo "header-nav-item calculatorDropdownContainer";
                    } ?>">
                        <!---->
                        <!--                        <a class=" header-nav-navigation-link " type="button" id="topCalculatorDropdown"-->
                        <!--                           data-toggle="dropdown">-->
                        <!--                            Kalkulator-->
                        <!--                            <span class="caret"></span>-->
                        <!--                        </a>-->
                        <!--                        <ul class="dropdown-menu" role="menu" aria-labelledby="topCalculatorDropdown">-->
                        <!--                            <li role="presentation">-->
                        <!--                                --><?php //echo $this->Html->link('Kalkulator BMI', array('controller' => 'pages', 'action' => 'calc'), array('class' => '', 'tabindex' => '-1', 'role' => 'menuitem')); ?>
                        <!--                            </li>-->
                        <!--                            <li role="presentation">-->
                        <!--                                --><?php //echo $this->Html->link('Kalkulator TDEE', array('controller' => 'pages', 'action' => 'calc2'), array('class' => '', 'tabindex' => '-1', 'role' => 'menuitem')); ?>
                        <!--                            </li>-->
                        <!--                        </ul>-->

                    </li>
                    <!--                    <li class="--><?php //if ($this->params['action'] == 'calc') {
                    //                        echo "header-nav-item active";
                    //                    } else {
                    //                        echo "header-nav-item";
                    //                    } ?><!--">-->
                    <!--                        --><?php //echo $this->Html->link('Kalkulator BMI', array('controller' => 'pages', 'action' => 'calc'), array('class' => 'header-nav-navigation-link')); ?>
                    <!--                    </li>-->
                    <!--                    <li class="--><?php //if ($this->params['action'] == 'calc2') {
                    //                        echo "header-nav-item active";
                    //                    } else {
                    //                        echo "header-nav-item";
                    //                    } ?><!--">-->
                    <!--                        --><?php //echo $this->Html->link('Kalkulator TDEE', array('controller' => 'pages', 'action' => 'calc2'), array('class' => 'header-nav-navigation-link')); ?>
                    <!--                    </li>-->

                    <li class="<?php if ($this->params['action'] == 'diet') {
                        echo "header-nav-item active";
                    } else {
                        echo "header-nav-item";
                    } ?>">
                        <?php echo $this->Html->link('Diety', array('controller' => 'pages', 'action' => 'diet'), array('class' => 'header-nav-navigation-link')); ?>
                    </li>
                    <li class="<?php if ($this->params['action'] == 'blog') {
                        echo "header-nav-item active";
                    } else {
                        echo "header-nav-item";
                    } ?>">
                        <?php echo $this->Html->link('Blog', array('controller' => 'pages', 'action' => 'blog'), array('class' => 'header-nav-navigation-link')); ?>
                    </li>
                    <li class="<?php if ($this->params['action'] == 'faq') {
                        echo "header-nav-item active";
                    } else {
                        echo "header-nav-item";
                    } ?>">
                        <?php echo $this->Html->link('FAQ', array('controller' => 'pages', 'action' => 'faq'), array('class' => 'header-nav-navigation-link')); ?>
                    </li>
                    <li class="<?php if ($this->params['action'] == 'pack') {
                        echo "header-nav-item active";
                    } else {
                        echo "header-nav-item";
                    } ?>">
                        <?php echo $this->Html->link('Cennik', array('controller' => 'pages', 'action' => 'pack'), array('class' => 'header-nav-navigation-link')); ?>
                    </li>
                    <li class="<?php if ($this->params['action'] == 'index') {
                        echo "header-nav-item active";
                    } else {
                        echo "header-nav-item";
                    } ?>">
                        <?php echo $this->Html->link('Sklep', array('controller' => 'items', 'action' => 'index'), array('class' => 'header-nav-navigation-link')); ?>
                    </li>


                </ul>
            </div>


        </div>
    </nav>
</header>
<?php echo $this->Flash->render(); ?>

<?php
//$welcome = '';
//if (($this->params['controller'] == 'pages') && ($this->params['action'] == 'home')) {
//    $welcome = 'home-welcome';
//} else {
//    $welcome = 'site-welcome';
//}
//?>
<?php
$welcome = '';
if (($this->params['controller'] == 'pages') && ($this->params['action'] == 'home')):
    $welcome = 'home-welcome';
    ?>

    <section class="<?php echo $welcome; ?>">
        <div class="socials-container">
            <a class="social-link" href="http://www.facebook.com" target="_blank">
                <div class="social-box facebook faa-parent animated-hover">
                    <i class="fa fa-facebook social-icon faa-slow faa-ring"></i>
                </div>
            </a>


            <a class="social-link" href="http://www.facebook.com" target="_blank">
                <div class="social-box instagram faa-parent animated-hover">
                    <i class="fa fa-instagram social-icon faa-slow faa-ring"></i>
                </div>
            </a>

        </div>

        <div class="welcome-text">

            <div class="col-sm-6 content">
                <h2 class="tx-hand tx-welcome">
                    Stwórz swój
                </h2>

                <h2 class="tx-hand tx-welcome tx-highlight">
                    Indywidualny plan diety
                </h2>

                <h2 class="tx-hand tx-welcome">
                    i ciesz się zdrową kuchnią
                </h2>

                <form novalidate>
                    <?php if ($this->params['action'] == 'home'): ?>


                        <div class="input-container user_email">
                            <p class="my-alert" id="alert-empty">* Pole wymagane</p>

                            <p class="my-alert" id="alert-wrong">* Niepoprawny adres e-mail</p>
                            <input id="mail" type="email" placeholder="Twój E-mail"/>


                        </div>
                    <?php endif; ?>
                    <!--                <input type="submit" class="btn-green btn-welcome" value="Rozpocznij"/>-->
                    <?php echo $this->Html->link('Rozpocznij', array('controller' => 'quizzes', 'action' => 'add'), array('class' => 'btn-green btn-welcome', 'id' => 'btn-enter')); ?>
                </form>


            </div>

        </div>

        <span class="home-welcome-bg-element"></span>

    </section>
<?php endif; ?>

<?php echo $content_for_layout; ?>


<section class="homepage-footer">

    <div class="top-footer">
        <div class="tx-holder">
            <h1 class="tx-hand tx-main">
                Stwórz własny spersonalizowany plan diety
            </h1>
        </div>
        <form action="/pages/join_us" id="join-form" role="form" method="post" novalidate>
            <div class="container form-container">
                <div class="col-sm-3 input-container">
                    <input id="newsletter-name" type="email" name="name" placeholder="Twoje imię"/>
                </div>
                <div class="col-sm-6 input-container">
                    <input id="newsletter-mail" type="email" name="mail" placeholder="adres e-mail"/>
                </div>
                <div class="col-sm-3">
                    <input type="submit" value="Dołącz do nas"
                           class="btn-green btn-join"
                           data-loading-text="Ładuję..." id="newsletter_send">
                </div>
            </div>
        </form>
        <div class="newsletter-message">
            * Należy uzupełnić pola <strong>Imię</strong> oraz <strong>E-mail</strong>.
        </div>
    </div>


    <div class="bottom-footer">
        <div class="container">
            <div class="col-sm-12">
                <div class="center-title">
                    <h1 class="tx-hand contact-title">
                        Napisz do nas:
                    </h1>
                </div>
            </div>
            <div class="col-sm-6 ">
                <div class="contact-element">
                    <div class="contact-more">
                        <p>Biuro obsługi</p>
                    </div>
                    <div class="contact-heading">
                        <h1 class="tx-hand contact-title contact-mail">
                            kontakt@greencook.pl
                        </h1>
                    </div>

                </div>
            </div>
            <div class="col-sm-6 ">
                <div class="contact-element">
                    <div class="contact-more">
                        <p>Dietetyk</p>
                    </div>
                    <div class="contact-heading">
                        <h1 class="tx-hand contact-title contact-mail">
                            dietetyk@greencook.pl
                        </h1>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="footer-container">
        <div class="col-sm-4 col-md-3 copyright">
            realizacja <a href="http://180creative.pl/"> 180c</a>
        </div>

        <div class="col-sm-4 col-md-6 menu-footer">
            <ul>
                <li class="header-nav-item">
                    <a class="social-link-bot" href="http://www.facebook.com" target="_blank">
                        <i class="fa fa-facebook social-icon faa-slow faa-ring"></i>

                    </a>
                </li>
                <li class="header-nav-item">
                    <a class="social-link-bot" href="http://www.facebook.com" target="_blank">
                        <i class="fa fa-instagram social-icon faa-slow faa-ring"></i>

                    </a>
                </li>
                <li role="presentation">
                    <?php echo $this->Html->link('Kalkulator BMI', array('controller' => 'pages', 'action' => 'calc'), array('class' => 'header-nav-navigation-link')); ?>
                </li>
                <li role="presentation">
                    <?php echo $this->Html->link('Kalkulator TDEE', array('controller' => 'pages', 'action' => 'calc2'), array('class' => 'header-nav-navigation-link')); ?>
                </li>
                <li class="header-nav-item active">
                    <?php echo $this->Html->link('Regulamin', array('controller' => 'pages', 'action' => 'terms'), array('class' => 'header-nav-navigation-link')) ?>
                </li>
                <li class="header-nav-item">
                    <?php echo $this->Html->link('Polityka prywatności', array('controller' => 'pages', 'action' => 'policy'), array('class' => 'header-nav-navigation-link')) ?>
                </li>
                <li class="header-nav-item">
                    <?php echo $this->Html->link('Kontakt', array('controller' => 'pages', 'action' => 'contact'), array('class' => 'header-nav-navigation-link')) ?>
                </li>
            </ul>
        </div>

        <div class="col-sm-4 col-md-3 cookies-info">
            <p>
                Ta strona używa pliki cookies aby usprawnić Twoje przeglądanie.<br/>
                Przeglądając naszą stronę, akceptujesz politykę cookies.
            </p>
        </div>

    </div>


</footer>


<!--MOJ TEST LOGOWANIE REJESTRACJA W JEDNYM MODALU-->
<div id="userLoginModal" class="modal fade users-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close faa-tada animated-hover" data-dismiss="modal" aria-hidden="true">&times;
            </button>
            <div class="modal-header">
                <h3 id="myModalLabel">Login</h3>
            </div>
            <div class="modal-body">

<h3 class="process-info">Aby kontynuować proces należy się zalogować/zarejestrować</h3>
                <ul class="nav nav-pills">
                    <li class="active"><a data-toggle="pill" href="#login">Logowanie</a></li>
                    <li><a data-toggle="pill" href="#register">Rejestracja</a></li>
                </ul>

                <div class="tab-content">
                    <div id="login" class="tab-pane fade in active">
                        <fieldset>
                            <!--                    <form action="/" class="form-horizontal" id="LoginForm" method="post" accept-charset="utf-8">-->
                            <?php echo $this->Flash->render('auth'); ?>
                            <?php echo $this->Form->create('User', array('class' => 'form-horizontal', 'id' => 'LoginForm')); ?>
                            <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
                            <div class="emailField">
                                <div class="form-group"><label for="UserEmail"
                                                               class="control-label col-md-4">Email</label>

                                    <div class="col-md-8">
                                        <?php echo $this->Form->input('', array('label' => false, 'class' => 'modal-input-email form-control', 'max-length' => '255', 'id' => 'UserEmail', 'placeholder' => 'E-mail', 'type' => 'email')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="passwordField">
                                <div class="form-group">
                                    <label for="UserPassword" class="control-label col-md-4">Hasło</label>

                                    <div id="errorPlace" class="col-md-8">
                                        <?php echo $this->Form->input('', array('label' => false, 'class' => 'modal-input-password form-control', 'type' => 'password', 'id' => 'UserPassword', 'placeholder' => 'Hasło')); ?>

                                    </div>
                                </div>
                            </div>
                            <!--                        <div class="control-group checkbox modal-login-checkbox">-->
                            <!--                            <input type="hidden" name="data[User][remember_me]" id="UserRememberMe_" value="0"><input type="checkbox" name="data[User][remember_me]" class="modal-input-remember_me" value="1" id="UserRememberMe">-->
                            <!--                            <label for="UserRememberMe" class="control-label">Pamiętaj mnie</label>
                                                        </div>-->

                            <p>
                                <a href="#" data-dismiss="modal" data-toggle="modal"
                                   data-target="#userForgetPasswordModal">Zapomniałem
                                    hasła</a>
                            </p>
                            <input type="hidden" name="data[User][return_to]" id="UserReturnTo">
                            <?php echo $this->Form->submit('Zaloguj', array('class' => 'btn btn-primary', 'id' => 'ModalLoginButton')); ?>
                            <!--                    </form>-->
                            <?php echo $this->Form->end(); ?>
                            <a href="/facebook/login.php" class="social-btn wide"><i class="fa fa-facebook"></i><span>Zaloguj przez Facebook</span></a>
                        </fieldset>
                    </div>
                    <div id="register" class="tab-pane fade">
                        <fieldset>
                            <!--                    <form action="/" class="form-horizontal" id="LoginForm" method="post" accept-charset="utf-8">-->
                            <!--                            --><?php //echo $this->Flash->render('auth'); ?>
                            <?php echo $this->Form->create('User', array('class' => 'form-horizontal', 'id' => 'LoginForm', 'novalidate' => 'novalidate')); ?>
                            <!--                            <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>-->
                            <div class="nameField">
                                <div class="form-group"><label for="UserName"
                                                               class="control-label col-md-4">Name</label>

                                    <div class="col-md-8">
                                        <?php echo $this->Form->input('', array('label' => false, 'class' => 'modal-input-email form-control', 'max-length' => '255', 'id' => 'RegisterUserName', 'placeholder' => 'Imię', 'type' => 'text')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="emailField">
                                <div class="form-group"><label for="UserEmail"
                                                               class="control-label col-md-4">Email</label>

                                    <div class="col-md-8">
                                        <?php echo $this->Form->input('', array('label' => false, 'class' => 'modal-input-email form-control', 'max-length' => '255', 'id' => 'RegisterUserEmail', 'placeholder' => 'E-mail', 'type' => 'text')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="passwordField">
                                <div class="form-group">
                                    <label for="RegisterUserPassword" class="control-label col-md-4">Hasło</label>

                                    <div id="errorPlacePassword" class="col-md-8">
                                        <?php echo $this->Form->input('', array('label' => false, 'class' => 'modal-input-password form-control', 'type' => 'password', 'id' => 'RegisterUserPassword', 'placeholder' => 'Hasło')); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="passwordField">
                                <div class="form-group">
                                    <label for="RepeatRegisterUserPassword" class="control-label col-md-4">Hasło</label>

                                    <div id="errorPlaceRegister" class="col-md-8">
                                        <?php echo $this->Form->input('', array('label' => false, 'class' => 'modal-input-password form-control', 'type' => 'password', 'id' => 'RetypeRegisterUserPassword', 'placeholder' => 'Powtórz hasło')); ?>

                                    </div>
                                </div>
                            </div>

                            <!--                        <div class="control-group checkbox modal-login-checkbox">-->
                            <!--                            <input type="hidden" name="data[User][remember_me]" id="UserRememberMe_" value="0"><input type="checkbox" name="data[User][remember_me]" class="modal-input-remember_me" value="1" id="UserRememberMe">-->
                            <!--                            <label for="UserRememberMe" class="control-label">Pamiętaj mnie</label>
                                                        </div>-->

                            <!--                            <p>-->
                            <!--                                <a href="#" data-dismiss="modal" data-toggle="modal"-->
                            <!--                                   data-target="#userForgetPasswordModal">Zapomniałem-->
                            <!--                                    hasła</a>-->
                            <!--                            </p>-->
                            <input type="hidden" name="data[User][return_to]" id="UserReturnTo">
                            <?php echo $this->Form->submit('Zarejestruj się', array('class' => 'btn btn-primary', 'id' => 'ModalRegisterButton')); ?>
                            <!--                    </form>-->
                            <?php echo $this->Form->end(); ?>
                            <a href="/facebook/login.php" class="social-btn wide"><i class="fa fa-facebook"></i><span>Zarejestruj przez Facebook</span></a>
                        </fieldset>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>

<!--MOJ TEST LOGOWANIE REJESTRACJA W JEDNYM MODALU-->

<div id="userLoginModal2" class="modal fade users-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close faa-tada animated-hover" data-dismiss="modal" aria-hidden="true">&times;
            </button>
            <div class="modal-header">
                <h3 id="myModalLabel">Login</h3>
            </div>
            <div class="modal-body">
                <fieldset>
                    <!--                    <form action="/" class="form-horizontal" id="LoginForm" method="post" accept-charset="utf-8">-->
                    <?php echo $this->Flash->render('auth'); ?>
                    <?php echo $this->Form->create('User', array('class' => 'form-horizontal', 'id' => 'LoginForm')); ?>
                    <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
                    <div class="emailField">
                        <div class="form-group"><label for="UserEmail" class="control-label col-md-4">Email</label>

                            <div class="col-md-8">
                                <?php echo $this->Form->input('', array('label' => false, 'class' => 'modal-input-email form-control', 'max-length' => '255', 'id' => 'UserEmail', 'placeholder' => 'E-mail', 'type' => 'text')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="passwordField">
                        <div class="form-group">
                            <label for="UserPassword" class="control-label col-md-4">Hasło</label>

                            <div id="errorPlace" class="col-md-8">
                                <?php echo $this->Form->input('', array('label' => false, 'class' => 'modal-input-password form-control', 'type' => 'password', 'id' => 'UserPassword', 'placeholder' => 'Hasło')); ?>

                            </div>
                        </div>
                    </div>
                    <!--                        <div class="control-group checkbox modal-login-checkbox">-->
                    <!--                            <input type="hidden" name="data[User][remember_me]" id="UserRememberMe_" value="0"><input type="checkbox" name="data[User][remember_me]" class="modal-input-remember_me" value="1" id="UserRememberMe">-->
                    <!--                            <label for="UserRememberMe" class="control-label">Pamiętaj mnie</label>
                                                </div>-->

                    <p>
                        <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#userForgetPasswordModal">Zapomniałem
                            hasła</a>
                    </p>
                    <input type="hidden" name="data[User][return_to]" id="UserReturnTo">
                    <?php echo $this->Form->submit('Zaloguj', array('class' => 'btn btn-primary', 'id' => 'ModalLoginButton')); ?>
                    <!--                    </form>-->
                    <?php echo $this->Form->end(); ?>
                    <a href="/facebook/login.php" class="social-btn wide"><i class="fa fa-facebook"></i><span>Zaloguj przez Facebook</span></a>
                </fieldset>
            </div>
        </div>
    </div>
</div>

<div id="userForgetPasswordModal" class="modal fade users-modal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close faa-tada animated-hover" data-dismiss="modal" aria-hidden="true">&times;
            </button>
            <div class="modal-header">
                <h3 id="myModalLabel2">Zapomniałem hasła</h3>
            </div>
            <div class="modal-body">
                <fieldset>
                    <form action="/users/forgot" class="form-horizontal" id="ForgerForm" method="post"
                          accept-charset="utf-8">
                        <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
                        <div class="emailField">
                            <div class="form-group"><label for="UserEmail" class="control-label col-md-4">Email</label>

                                <div class="col-md-8">
                                    <input name="data[mail]" class="modal-input-email form-control"
                                           placeholder="Email" maxlength="255" type="email" id="UserForgetEmail">
                                </div>

                            </div>
                        </div>

                        <button type="submit" class="green-submit btn-green forget-button" id="ModalForgetButton">
                            Wyślij
                        </button>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="basket" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Twój koszyk</h4>
            </div>
            <div class="modal-body">
                <div class="all-info">

                </div>
                <div class="delivery-data">
                    <hr>
                    <h4 class="modal-title">Dane dostawy <span id="deliv-data" class="shop-error">- uzupełnij wszystkie dane dostawy *</span>
                    </h4>
                    <hr>

                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="user-name" class="col-sm-2 control-label">Imię:*</label>

                                <div class="col-xs-10">
                                    <input class="form-control" name="Delivery[user_name]" id="user_name"
                                           placeholder="Imię">
                                </div>
                            </div>
                            <div class="form-group">

                                <label for="user-surname" class=" col-sm-2 control-label">Nazwisko:*</label>

                                <div class=" col-xs-10">
                                    <input class="form-control" name="Delivery[user_surname]" id="user_surname"
                                           placeholder="Nazwisko">
                                </div>
                            </div>
                            <div class="form-group">

                                <label for="user-mail" class=" col-sm-2 control-label">E-mail:*</label>

                                <div class=" col-xs-10">
                                    <input class="form-control" name="Delivery[user_mail]" id="user_mail"
                                           placeholder="E-mail">
                                </div>
                            </div>
                            <div class="form-group">

                                <label for="user-country" class=" col-sm-2 control-label">Kraj:*</label>

                                <div class=" col-xs-10">
                                    <input class="form-control" name="Delivery[user-country]" id="user_country"
                                           placeholder="Kraj">
                                </div>
                            </div>
                            <div style="padding-bottom:5px;"></div>


                            <div class="form-group">
                                <label for="city" class="col-sm-2 control-label">Miasto:*</label>

                                <div class="col-xs-10">
                                    <input class="form-control" name="Delivery[city]" id="city"
                                           placeholder="Miasto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-2 control-label">Adres:*</label>

                                <div class="col-xs-10">
                                    <input class="form-control" id="address" name="Delivery[address]"
                                           placeholder="np. ul.Mikołowska 10/7">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="postal" class="col-sm-2 control-label">Kod pocztowy:*</label>

                                <div class="col-xs-10">
                                    <input class="form-control" id="postal" name="Delivery[postal]"
                                           placeholder="__-___">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="col-sm-2 control-label">Telefon kontaktowy:</label>

                                <div class="col-xs-10">
                                    <input class="form-control" id="phone" name="Delivery[phone]"
                                           placeholder="123-456-789">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form id="shop-form" action="https://ssl.dotpay.pl/test_payment/" method="POST">
                    <input type="hidden" name="api_version" value="legacy"/>
                    <input type="hidden" name="id" value="778724"/>
                    <input type="hidden" name="opis" value="SKLEP-GREENCOOK"/>
                    <input type="hidden" name="waluta" value="PLN"/>
                    <input type="hidden" name="amount" value="1"/>
                    <input type="hidden" name="jezyk" value="pl"/>
                    <input type="hidden" name="control" value="1"/>
                    <input type="hidden" name="typ" value="3"/>
                    <input type="hidden" name="URL" value="http://dev-greencook.180c.pl/payments/shop_check"/>
                    <input type="hidden" name="URLC" value="http://dev-greencook.180c.pl/payments/shop_add"/>
                    <input type="submit" value="Zapłać" class="basket-btn final-buy">
                </form>
                <input id="data-adress" type="submit" value="Dodaj dane przesyłki" class="basket-btn data-address">
                <input id="close-modal" type="submit" data-dismiss="modal" value="Zamknij"
                       class="basket-btn close-modalbtn">

            </div>
        </div>
    </div>
</div>


</body>
</html>
<script>

    //
    //    $(".alert").fadeTo(2000, 500).slideUp(700, function () {
    //        $(".alert").alert('close');
    //    });


    $(document).ready(function () {
        $('#newsletter_send').on('click', function (e) {
            e.preventDefault();
            var mail = $('#newsletter-mail').val();
            var name = $('#newsletter-name').val();
            if ((mail == '') || (name == '')) {
                $('.newsletter-message').show('slow');
            } else {
                $('#join-form').submit();
            }
        });
        $('#postal').mask('99-999');
        $('#phone').mask('999-999-999');

        $('.data-address').on('click', function () {
            var condition = false;
            $('.delivery-radio').each(function (i, obj) {
                if ($(this).is(":checked")) {
                    condition = true;
                    return;
                }
            });
            if (condition) {
                $('#deliv').hide();
                $('.delivery-data').show('slow');
                $('.data-address').hide('slow');
                $('.final-buy').show('slow');

            } else {
                $('#deliv').show();
            }


        });
        $('.final-buy').on('click', function (e) {
            e.preventDefault();
            $('input[name=amount]').val($('.summary-price').html());
            $('input[name=control]').val($('.summary-price').data('basket'));
            var name = $('#user_name').val();
            var surname = $('#user_surname').val();
            var mail = $('#user_mail').val();
            var country = $('#user_country').val();
            var city = $('#city').val();
            var address = $('#address').val();
            var postal = $('#postal').val();
            var phone = $('#phone').val();
            var basket_id = $('.summary-price').data('basket');
            if ((city != '') && (address != '') && (postal != '') && (name != '') && (surname != '') && (country != '') && (mail != '')) {
                $('#deliv-data').hide();
                $.ajax({
                    type: "POST",
                    url: "/baskets/save_before_pay",
                    data: {
                        Basket: {
                            city: city,
                            address: address,
                            postal: postal,
                            phone: phone,
                            id: basket_id,
                            name: name,
                            surname: surname,
                            country: country,
                            user_mail: mail
                        }
                    },
                    dataType: "json",
                    error: function (response) {

                    },
                    success: function (response) {
                        $('#shop-form').submit();

                    },
                    done: function (response) {

                    }
                });
            } else {
                $('#deliv-data').show();
            }


        });
        $('#btn-enter').on('click', function (e) {
            var value = $('#mail').val();
            if (value != "") {
                if ((value.indexOf("@") > -1) && (value.indexOf(".") > -1)) {
                    e.preventDefault();
                    window.location = window.location.origin + '/quizzes/pre_load_quiz_page/' + value;
                } else {
                    e.preventDefault();
                    $('#alert-wrong').toggle("slow");
                    setTimeout(function () {
                        $('#alert-wrong').toggle("slow");
                    }, 3000);
                }
            } else {
                e.preventDefault();
                $('#alert-empty').toggle("slow");
                setTimeout(function () {
                    $('#alert-empty').toggle("slow");
                }, 3000);

            }

        });


        $('.btn-search').on('click', function (e) {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                var input_value = $('.search-on-site').val();
                if (input_value == "") {
                    e.preventDefault();
                    $('.my-slide').toggle('slide');
                }

            } else {
                e.preventDefault();
                $('.my-slide').toggle('slide');
                $(this).addClass('active');
            }

        });


        $('#ModalRegisterButton').click(function (e) {
            if (($('#errorPlaceRegister span').length) != 0) {

                $('#errorPlaceRegister span').remove();
                $('#errorPlaceRegister br').remove();

            }
            e.preventDefault();
            var user_name = $('#RegisterUserName').val();
            var mail = $('#RegisterUserEmail').val();
            var password = $('#RegisterUserPassword').val();
            var re_password = $('#RetypeRegisterUserPassword').val();
            if (password != re_password) {
                $('#errorPlaceRegister').append("<span>Hasła nie są takie same</span>").show('slow');
            }
            else {
                $.ajax({
                    type: "POST",
                    url: "/users/register",
                    data: {
                        User: {
                            name: user_name,
                            mail: mail,
                            password: password
                        }
                    },
                    dataType: "json",
                    error: function (response) {
//                        console.log(response['mail']);
                    },
                    success: function (response) {
                        console.log(response);
                        if (response == true) {
                            location.reload();
                        } else {
                            var value = null;
                            var real = null;
                            for (value in response) {
                                if (value == 'name') {
                                    real = 'Imię';
                                }
                                if (value == 'mail') {
                                    real = 'E-mail';
                                }
                                if (value == 'password') {
                                    real = 'Hasło';
                                }
                                if (value == 'mail') {
                                    $('#errorPlaceRegister').append("<span>" + response[value] + "</span><br>").show('slow');
                                } else {
                                    $('#errorPlaceRegister').append("<span>" + real + " - " + response[value] + "</span><br>").show('slow');
                                }


                            }
                        }


                    },
                    done: function (response) {
                        console.log(response);
                    }
                });
            }


        });


        $('#ModalLoginButton').click(function (e) {
            if (($('#errorPlace span').length) != 0) {
                $('#errorPlace span').fadeOut(300, function () {
                    $(this).remove();
                });
            }
            e.preventDefault();

            var mail = $('#UserEmail').val();
            var password = $('#UserPassword').val();

            $.ajax({
                type: "POST",
                url: "/users/login",
                data: {
                    User: {
                        mail: mail,
                        password: password
                    }
                },
                dataType: "json",
                error: function (msg) {
                },
                success: function (msg) {
                    if (msg['logged'] != 'nonactive') {
                        if (msg['logged']) {
                            if (msg['logged'] == 'admin') {
                                $('#errorPlace').append("<span>Konto typu Administrator - załóż konto użytkownika</span>").show('slow');
                            } else {
                                if (msg['logged'] == 'afterQuiz') {
                                    $('#userLoginModal').modal('hide');
                                    window.location = window.location.origin + '/quizzes/create_diet_plan';
                                }
                                else {
                                    $('#userLoginModal').modal('hide');
                                    location.reload();
                                }

                            }

                        } else {
                            $('#errorPlace').append("<span>Wprowadź poprawne dane</span>");

                        }
                    } else {
                        $('#errorPlace').append("<span>Aktywuj swoje konto klikając na link przesłany w wiadomości e-mail</span>").show('slow');
                    }


                },
                done: function () {

                }
            });
        });


        update_summary();
        $(document).on('click', '.add', function () {
            var value = parseFloat($(this).prev().html());
            value++;
            $(this).prev().html(value);

            var product_id = $(this).parent().parent().find('.item-info').data('id');

            $.ajax({
                type: "POST",
                url: "/baskets/add",
                data: {
                    product_id: product_id,
                },
                dataType: "json",
                error: function (response) {

                },
                success: function (response) {

                },
                done: function (response) {

                }
            });
            update_summary();

        });
        $(document).on('click', '.sub', function () {
            var value = parseFloat($(this).next().html());
            if (value != 1) {
                value--;
                $(this).next().html(value);

                var product_id = $(this).parent().parent().find('.item-info').data('id');

                $.ajax({
                    type: "POST",
                    url: "/baskets/subtract",
                    data: {
                        product_id: product_id,
                    },
                    dataType: "json",
                    error: function (response) {

                    },
                    success: function (response) {

                    },
                    done: function (response) {

                    }
                });
                update_summary();

            }
        });
        $(document).on('click', '.btn-delete', function () {
            $(this).parent().parent().remove();
            var item_id = $(this).data('item');

            $.ajax({
                type: "POST",
                url: "/baskets/delete",
                data: {
                    product_id: item_id,
                },
                dataType: "json",
                error: function (response) {

                },
                success: function (response) {

                },
                done: function (response) {

                }
            });
            update_summary();


        });
        $(document).on('click', '.delivery-radio', function () {
            $('.delivery-radio').removeData('checked');
            $(this).data('checked', true);
            var delivery_name = $(this).parent().parent().find('.delivery-name').html();
            var delivery_price = $(this).data('ammount');


            $.ajax({
                type: "POST",
                url: "/baskets/delivery",
                data: {
                    delivery_name: delivery_name,
                    delivery_price: delivery_price
                },
                dataType: "json",
                error: function (response) {

                },
                success: function (response) {

                },
                done: function (response) {

                }
            });

            update_summary();
        });

        $('.basket-icon').on('click', function () {
            $('.all-info').html(" ");
            $.ajax({
                type: "POST",
                url: "/baskets/get",
                dataType: "HTML",
                error: function (response) {
                    console.log(response);
                },
                success: function (response) {
                    if (response == 'empty-basket') {
                        $('#data-adress').hide();
                        $('#close-modal').show();
                        $('.all-info').append('<h1>Twój koszyk jest pusty.</h1>');
                    } else {
                        $('.all-info').append(response);
                    }

                },
                done: function (response) {
                    console.log(response);
                }
            });
        });


    });
    function update_summary() {
        var summary = 0;
        var ammount = 0;
        $('.count').each(function (i, obj) {
            var count = parseFloat($(this).html());
            ammount = parseFloat($(this).parent().prev().find('span').html());
            summary += (count * ammount);
        });
        $('.delivery-radio').each(function (i, obj) {
            if ($(this).is(":checked")) {
                summary += $(this).data('ammount');
            }
        });
        $('.summary-price').html(Math.round(summary * 100) / 100);
    }
</script>
