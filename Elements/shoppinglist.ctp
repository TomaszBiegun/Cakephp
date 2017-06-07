<style type="text/css">
    .one_group:nth-of-type(3n+1) {
        display: block;
        clear: both;
    }
</style>
<?php foreach ($output as $key => $item): ?>
    <div class="col-md-4 col-sm-6 col-xs-12 one_group" style="margin-top:10px">
        <strong><p class="category"><?php echo $key; ?></p></strong>
        <?php foreach ($item as $name => $one): ?>
            <li>
                <span class="item-name"><?php echo $name; ?></span> -
                                                <span class="product_value"
                                                      data-start="<?php echo $one['value']; ?>"> <?php echo $one['value']; ?></span>
                <span><?php echo $one['unit']; ?> </span>
            </li>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>