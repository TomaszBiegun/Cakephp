<style type="text/css">

</style>
<section class="content">
    <div class="row">
        <div class="col-xs-3">
        </div>
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Dodaj przepis</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create('Recipe', array('novalidate' => 'novalidate', 'type' => 'file')); ?>
                <div class="box-body">
                    <div class="form-group">
                        <?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => 'Nazwa')); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $this->Form->input('type', array(
                            'class' => 'form-control',
                            'label' => 'Typ',
                            'options' => array(
                                '0' => 'Wybierz typu przepisu',
                                '1' => 'Śniadanie',
                                '2' => 'Śniadanie II',
                                '3' => 'Obiad',
                                '4' => 'Kolacja',
                                '5' => 'Podwieczorek'

                            ))); ?>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->input('products', array('class' => 'form-control', 'label' => 'Dodaj składnik', 'id' => 'list')); ?>
                        </div>
                        <div class="col-xs-6" style=" top:30px;">
                            <a href="#" id="ProductsAdd" class="glyphicon glyphicon-plus"></a>
                        </div>


                        <div class="col-xs-12 products">
                            <br>

                        </div>


                    </div>


                    <div class="form-group">
                        <br>
                        <?php echo $this->Form->input('preparation', array('class' => 'form-control', 'label' => 'Sposób przygotowania', 'type' => 'textarea')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('replacements', array('class' => 'form-control', 'label' => 'Zamienniki', 'type' => 'textarea')); ?>
                    </div>
                    <label for="DietPick">Dodaj przepis do diety</label>

                    <div class="form-group" style="padding-left: 20px">

                        <?php echo $this->Form->select('diets', $options, array(
                            'multiple' => 'checkbox',
                            'id' => 'DietPick'
                        )); ?>
                    </div>


                    <div class="form-group">
                        <?php echo $this->Form->input('file', array('class' => 'form-control', 'label' => 'Zdjęcie', 'type' => 'file')); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $this->Form->input('basename', array('class' => 'form-control hidden', 'label' => false)); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('dirname', array('class' => 'form-control hidden', 'label' => false)); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('checksum', array('class' => 'form-control hidden', 'label' => false)); ?>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <?php echo $this->Form->submit('Zapisz', array('class' => 'btn btn-success')); ?>
                    <!--                <button type="submit" class="btn btn-primary">Submit</button>-->
                </div>
                <?php echo $this->Form->end(); ?>
            </div><!-- /.box -->
        </div>
        <div class="col-xs-3">
        </div>
    </div>
</section>
<script>
    var container_id = 0;
    var iterator=0;
    $('#ProductsAdd').click(function () {


        var list = document.getElementById("list");
        var value = list.value;
        if (value != "") {
            list.remove(list.selectedIndex);

            var div = document.createElement("div");
            div.setAttribute('class', 'my-container' + container_id);
            div.setAttribute('style', 'width:100%');
            $('.products').append(div);

            var name = document.createElement("input");
            name.setAttribute('class', 'col-xs-3 productName');
            name.setAttribute('value', value);
            name.setAttribute('name', 'data[Product]['+iterator+'][name]');
//            name.setAttribute('disabled', 'disabled');


            var unit = document.createElement("select");
            unit.setAttribute('class', 'col-xs-3');
            unit.setAttribute('style', 'height:26px');
            unit.setAttribute('value', value);
            unit.setAttribute('name', 'data[Product]['+iterator+'][unit]');


            var options = ["g", "Dag", "Kg", "L", "ml", "łyżka", "łyżeczka"];
            for (var i = 0; i < options.length; i++) {
                var opt = options[i];
                var option = document.createElement("option");
                option.textContent = opt;
                option.value = opt;
                unit.appendChild(option);
            }

            var count = $('<input />').addClass('col-xs-3').attr('placeholder', 'Ilość').attr('name', 'data[Product]['+iterator+'][count]');


            var remove = $('<a></a>').addClass('col-xs-3 glyphicon glyphicon-minus remove').attr('href', '#').attr('data-name', value).css('height', 26);


            $('.my-container' + container_id).append(name);
            $('.my-container' + container_id).append(unit);
            $('.my-container' + container_id).append(count);
            $('.my-container' + container_id).append(remove);
            container_id++;
            iterator++;
        }

//        $('.productName').click(function (e) {
//            e.preventDefault();

//        });
    });

    $(document).on('click', '.remove', function (e) {
        e.preventDefault();
        e.stopPropagation();


        var value = $(this).data('name');
        var list = document.getElementById("list");
        var op = document.createElement("option");
        op.textContent = value;
        op.value = value;
        $('#list').append(op);
        $(this).parent().remove();

    });
</script>
