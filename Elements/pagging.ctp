<div class="row paginator">
    <div class="col-sm-5"></div>
    <div class="col-sm-7">
        <div class="dataTables_paginate paging_simple_numbers" id="paginate_paginate">
            <ul class="pagination">
                <li class="paginate_button previous disabled" id="paginate_previous">
                    <?php echo $this->Paginator->prev('Poprzednia', array(), null, array('class' => 'prev disabled')); ?>
                </li>
<!--                <li class="paginate_button active">-->

                    <?php echo $this->Paginator->numbers(array('tag' => 'li','class'=>'paginate_button','separator'=>'','currentClass'=>'active','currentTag'=>'a')); ?>

                <li class="paginate_button next disabled" id="paginate_next">
                    <?php echo $this->Paginator->next(__('Następna'), array(), null, array('class' => 'next disabled')); ?>
                </li>
            </ul>
        </div>
    </div>
</div>
