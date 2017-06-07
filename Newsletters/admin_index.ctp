<style type="text/css">
    #message_section {
        display: none;
    }

    #title_input {
        display: none;
    }

    #select_all {
        position: absolute;
        margin-left: 5px;
    }
</style>
<?php echo $this->Form->create('Pattern', array('novalidate' => 'novalidate', 'type' => 'file', 'id' => 'pattern_form')); ?>
<section class="content">
    <div class="row">
        <div class="col-md-2 col-xs-0">
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Użytkownicy newslettera</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('id', 'LP'); ?></th>
                            <th><?php echo $this->Paginator->sort('user_mail', 'E-mail'); ?></th>
                            <th><?php echo $this->Paginator->sort('user_name', 'Imię'); ?></th>
                            <th><?php echo $this->Paginator->sort('created', 'Dołączył'); ?></th>
                            <th class="actions"><?php echo __('Zaznacz'); ?><input type="checkbox" name="checkbox"
                                                                                   id="select_all"
                                                                                   data-status="disabled"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($newsletters as $key => $newsletter): ?>
                            <tr>
                                <td><?php echo $key + 1; ?>&nbsp;</td>
                                <td><?php echo $newsletter['Newsletter']['user_mail']; ?>&nbsp;</td>
                                <td><?php echo $newsletter['Newsletter']['user_name']; ?>&nbsp;</td>
                                <td><?php echo $newsletter['Newsletter']['created']; ?>&nbsp;</td>

                                <td class="actions">
                                    <?php echo $this->Form->checkbox('check_single', array('id' => $key, 'class' => 'check_single', 'name' => 'data[Newsletter]' . '[' . $newsletter['Newsletter']['id'] . ']')); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>

                    </table>
                    <!--                    --><?php //echo $this->Element('pagging'); ?>
                    <button id="create_message" type="button" class="btn btn-block btn-primary btn-lg">Utwórz
                        wiadomość
                    </button>
                </div>

            </div>

        </div>
        <div class="col-md-2 col-xs-0">
        </div>
    </div>


    <div id="message_section" class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Wiadomość</h3>
        </div><!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">
            <div class="form-group body-message">
                <?php echo $this->Form->input('body', array('class' => 'form-control', 'label' => false, 'id' => 'parretn_body')); ?>
            </div>
            <div class="input-group">
                <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">Użyj szablonu
                        <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu">
                        <?php foreach ($patterns as $pattern): ?>
                            <li><a class="pattern_title" href="#"
                                   data-message="<?php echo $pattern['Pattern']['body']; ?>"><?php echo $pattern['Pattern']['title']; ?></a>
                            </li>
                        <?php endforeach; ?>


                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">Usuń szablon
                        <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu">
                        <?php foreach ($patterns as $pattern): ?>
                            <li><a class="pattern_title"
                                   href="newsletters/delete/<?php echo $pattern['Pattern']['id']; ?>"><?php echo $pattern['Pattern']['title']; ?></a>
                            </li>
                        <?php endforeach; ?>


                    </ul>
                </div>

                <!-- /btn-group -->

            </div>

            <div class="form-group">
                Zapisz jako szablon
                <?php echo $this->Form->checkbox('check', array('id' => 'pattern_check')); ?>
            </div>
            <div id="title_input" class="form-group">
                <?php echo $this->Form->input('title', array('class' => 'form-control', 'label' => 'Tytuł szablonu', 'style' => 'width:300px')); ?>
            </div>
        </div>


        <div class="box-footer">
            <?php echo $this->Form->submit('Wyślij', array('class' => 'btn btn-success', 'id' => 'save')); ?>
            <!--                <button type="submit" class="btn btn-primary">Submit</button>-->
        </div>

    </div><!-- /.box -->


</section>
<?php echo $this->Form->end(); ?>
<script>
    var status = 0;
    var iterator = 0;
    $(document).ready(function () {
        $('#create_message').on('click', function () {
            $('#message_section').toggle('slow');
        });
        $('#pattern_check').on('click', function () {
            $('#title_input').toggle('slow');
        });
        $('#select_all').on('click', function () {
            if (status == 0) {
                $('.check_single').attr('checked', false);
                $('.check_single').click();
                status = 1;
            } else {
                $('.check_single').attr('checked', false);
                $('body-message')
                status = 0;
            }

        });


        $('.pattern_title').on('click', function () {
            tinyMCE.activeEditor.setContent('');
            tinymce.activeEditor.execCommand('mceInsertContent', false, $(this).data('message'));
        });

        $('#save').on('click', function (e) {
            $('.check_single').each(function (i, obj) {
                if (obj.checked) {
                    iterator++;
                } else {

                }
            });
            if (iterator == 0) {
                e.preventDefault();
            }

        });

    });
</script>
