<style type="text/Css">
    page{
        width:98%;
    }
    .recipe-box {
        position: relative;
        width: 100%;
        padding-bottom: 20px;
    }

    .background {
        position: absolute;
        top: 20px;
    }

    .background img {

        left: 0;
        width: 100%;
        height: 100%;
    }

    .content {

        padding-top: 150px;
        position: relative;
        display: block;
        /*text-align: center;*/
    }

    .note {
        right: 80px;
        top: 180px;
        position: absolute;
        color: #61c134;
        font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
        font-size: 35px;
        text-align: right;
    }

    .logo {
        padding-top: 200px;
        padding-left: 180px;
    }

    .logo img {
        width: 400px;
        height: auto;
    }

    hr {
        color: grey;
        height: 1px;

    }

    .leaf img {
        color: green;

    }

    .leaf {
        position: relative;
        text-align: center;
        padding-right: 250px;
        width: 100%;

    }

    .recipe-title {
        position: relative;
        text-align: center;
        padding-top: 10px;
        padding-bottom: 10px;
        width: 100%;
        font-size: 25px;

    }

    .my-content {
        padding-top: 50px;
        padding-bottom: 13px;

    }

    .recipe-photo img {
        width: 200px;
        height: auto;
    }

    .recipe-type {
        font-size: 20px;
        padding-bottom: 10px;
        text-decoration: underline;
    }

    .recipe-body {
        position: absolute;
        right: 80px;
        top: 80px;
        width: 60%;
    }

    .recipe-info {
        position: relative;
        width: 100%;
    }

    .recipe-ingredients {
        padding-top: 10px;
        padding-left: 10px;
    }

    .recipe-replacements {
        position: absolute;
        left: 230px;
    }


</style>

<page>
    <div class="page">
        <div class="background">
            <!--            <img src="img/main-bg.jpg" alt="Logo"/>-->
        </div>


        <div class="content">
            <div class="logo">
                <img src="img/gc-logo.jpg" alt="Logo"/><br><br>
            </div>
            <div class="note">
                <strong>Jedz zdrowo razem z Green Cook™</strong>

            </div>


        </div>
    </div>
</page>
<page>
    <div class="my-content">


        <?php foreach ($recipes as $key => $recipe): ?>
            <div class="recipe-box">
                <div class="recipe-title">
                    <?php echo $recipe['Recipe']['name']; ?>
                </div>
                <div class="recipe-type">

                    <?php
                    if ($recipe['Recipe']['type'] == 'śniadanie2') {
                        echo 'II ŚNIADANIE';
                    } elseif ($recipe['Recipe']['type'] == 'śniadanie') {
                        echo 'ŚNIADANIE';

                    } else {
                        echo strtoupper($recipe['Recipe']['type']);
                    } ?>

                </div>

                <div class="recipe-photo">
                    <img src="odczyt/<?php echo $recipe['Recipe']['basename']; ?>" alt="Logo"/>
                </div>

                <div class="recipe-body">
                    <strong>Sposób przyrządzenia</strong><br><br>
                    <?php echo $recipe['Recipe']['preparation']; ?>
                    <br><br>
                    <?php echo 'Kaloryczność posiłku: ' . round($recipe['Summary']['Kaloryczność posiłku'], 0) . ' kcal'; ?>
                    <br>
                    <?php echo 'Węglowodany: ' . round($recipe['Summary']['Węglowodany'], 0) . ' g'; ?>
                    <br>
                    <?php echo 'Białka: ' . round($recipe['Summary']['Białka'], 0) . ' g'; ?>
                    <br>
                    <?php echo 'Tłuszcze: ' . round($recipe['Summary']['Tłuszcze'], 0) . ' g'; ?>
                </div>
                <div class="recipe-info">
                    <div class="recipe-ingredients">
                        <?php foreach ($recipe['RecipeProduct'] as $recipe_product): ?>
                            <?php echo $recipe_product['RecipeProduct']['product_name'] . ' - ' . $recipe_product['RecipeProduct']['value'] . ' ' . $recipe_product['RecipeProduct']['unit']; ?>
                            <br>
                        <?php endforeach; ?>
                    </div>
                    <div class="recipe-replacements">
                        <?php if (isset($recipe['Replacements']) && ($recipe['Replacements'] != null)):
                            foreach ($recipe['Replacements'] as $name => $replacement):
                                echo '<br>';
                                echo $name . ' możesz zamienić na -> ';

                                foreach ($replacement as $one):
                                    echo $one . ', ';
                                endforeach;
                            endforeach;
                        endif; ?>
                    </div>
                </div>


            </div>
            <hr>
        <?php endforeach; ?>

    </div>


</page>