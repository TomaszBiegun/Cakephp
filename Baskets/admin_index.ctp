<style type="text/css">
    .foto {
        height: auto;
        width: 50px;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista transakcji</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('id', 'Id transakcji'); ?></th>
                            <th><?php echo $this->Paginator->sort('user_mail', 'Mail użytkownika'); ?></th>
                            <th><?php echo $this->Paginator->sort('products', 'Produkty'); ?></th>
                            <th><?php echo $this->Paginator->sort('total_price', 'Cena zakupu'); ?></th>
                            <th><?php echo $this->Paginator->sort('payment_status', 'Status'); ?></th>
                            <th><?php echo $this->Paginator->sort('dotpay_id', 'ID DotPay'); ?></th>
                            <th><?php echo $this->Paginator->sort('delivery_name', 'Dostawca'); ?></th>
                            <th><?php echo $this->Paginator->sort('delivery_price', 'Koszt dostawcy'); ?></th>
                            <th>Dane dostawy:</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($baskets as $basket): ?>
                            <tr>
                                <td><?php echo h($basket['Basket']['id']); ?>&nbsp;</td>
                                <td><?php echo h($basket['Basket']['user_mail']); ?>&nbsp;</td>
                                <td>

                                    <?php foreach ($basket['Basket']['products'] as $product): ?>
                                        <ul>
                                            <li>ID produktu: <?php echo $product['id']; ?></li>
                                            <li>Nazwa: <?php echo $product['title']; ?></li>
                                            <li>Liczba: <?php echo $product['count']; ?></li>
                                            <li>Cena: <?php echo $product['amount']; ?></li>
                                            <li>
                                                Zdjęcie: <?php echo $this->Media->embed('s' . DS . $product['dirname'] . DS . $product['basename'], array('height' => '', 'width' => '', 'class' => 'foto')); ?>
                                            </li>
                                        </ul>
                                        <hr>
                                    <?php endforeach; ?>

                                </td>
                                <td><?php echo h($basket['Basket']['total_price']); ?>&nbsp;</td>
                                <td><?php echo h($basket['Basket']['payment_status']); ?>&nbsp;</td>
                                <td><?php echo h($basket['Basket']['dotpay_id']); ?>&nbsp;</td>
                                <td><?php echo h($basket['Basket']['delivery_name']); ?>&nbsp;</td>
                                <td><?php echo h($basket['Basket']['delivery_price']); ?>&nbsp;</td>
                                <td>
                                    Imię: <strong><?php echo $basket['Basket']['name']; ?></strong>&nbsp;<br>
                                    Nazwisko: <strong><?php echo $basket['Basket']['surname']; ?></strong>&nbsp;<br>
                                    Kraj: <strong><?php echo $basket['Basket']['country']; ?></strong>&nbsp;<br>
                                    Miasto: <strong><?php echo $basket['Basket']['city']; ?></strong>&nbsp;<br>
                                    Adres: <strong><?php echo $basket['Basket']['address']; ?></strong>&nbsp;<br>
                                    Kod pocztowy: <strong><?php echo $basket['Basket']['postal']; ?></strong>&nbsp;<br>
                                    Telefon: <strong><?php echo $basket['Basket']['phone']; ?></strong>&nbsp;<br>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>

                    </table>
                    <?php echo $this->Element('pagging'); ?>

                </div>
            </div>
        </div>
    </div>
</section>