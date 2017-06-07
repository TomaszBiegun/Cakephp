<?php if ($params['role'] == 0): ?>
    <?php if ($params['status'] == 0): ?>
        <div class="alert alert-success fade in" style="text-align: center;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Zalogowanie</strong> - powiodło się
        </div>
    <?php else: ?>
        <div class="alert alert-danger fade in" style="text-align: center;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Zalogowanie</strong> - nie powiodło się
        </div>
    <?php endif; ?>
<?php else: ?>
    <?php if ($params['status'] == 0): ?>
        <div class="alert alert-success fade in" style="text-align: center;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Zalogowanie</strong> - powiodło się
        </div>
    <?php else: ?>
        <div class="alert alert-danger fade in" style="text-align: center;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Zalogowanie</strong> - nie powiodło się
        </div>
    <?php endif; ?>
<?php endif; ?>

<!--<script>-->
<!--    $(".alert").fadeTo(2000, 500).slideUp(700, function () {-->
<!--        $(".alert").alert('close');-->
<!--    });-->
<!--</script>-->
