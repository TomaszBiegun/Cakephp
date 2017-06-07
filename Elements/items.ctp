<?php if (($items != null) && !empty($items)): ?>


    <table class="table">
        <thead>
        <tr>
            <th>Zdjęcie</th>
            <th>Nazwa</th>
            <th>Cena</th>
            <th>Ilość</th>
            <th>Usuń</th>
        </tr>
        </thead>
        <tbody class="items-body">
        <?php foreach ($items as $item): ?>
            <tr>
                <td class="photo-container"><?php echo $this->Media->embed('t' . DS . $item['dirname'] . DS . $item['basename'], array('height' => '', 'width' => '', 'class' => 'img-responsive')); ?></td>
                <td class="item-info" data-id="<?php echo $item['id']; ?>"><?php echo $item['title']; ?></td>
                <td>
                    <span class="item-price"><?php echo $item['amount']; ?></span> zł
                </td>
                <td>
                    <span class="chars sub">-</span>
                    <span class="count"><?php echo $item['count']; ?></span>
                    <span class="chars add">+</span>
                </td>
                <td class="td-delete">
                    <button type="button" class="close btn-delete"
                            data-item="<?php echo $item['id']; ?>">&times;</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="delivery">
        <hr>
        <div class="delivery-title">
            <h4>Sposób dostawy <span id="deliv" class="shop-error">- wybierz sposób dostawy *</span></h4>
        </div>
        <hr>
        <div class="delivery-methods">
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-8">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Firma</th>
                            <th>Cena</th>
                            <th>Czas</th>
                            <th>Wybierz</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr class="first-tr">
                            <td class="delivery-name">DHL</td>
                            <td><span class="delivery-price">5,99</span> zł</td>
                            <td>2/3 dni</td>
                            <td><input type="radio" data-ammount="5.99" class="delivery-radio"
                                       name="delivery-method" <?php if ($delivery_name == 'DHL') echo 'checked="checked"'; ?>>
                            </td>
                        </tr>
                        <tr>
                            <td class="delivery-name">Pocztex</td>
                            <td><span class="delivery-price">7,99</span> zł</td>
                            <td>1/2 dni</td>
                            <td><input type="radio" data-ammount="7.99" class="delivery-radio"
                                       name="delivery-method" <?php if ($delivery_name == 'Pocztex') echo 'checked="checked"'; ?>>
                            </td>
                        </tr>
                        <tr>
                            <td class="delivery-name">Poczta Polska</td>
                            <td><span class="delivery-price">9,99</span> zł</td>
                            <td>1/2 dni</td>
                            <td><input type="radio" data-ammount="9.99" class="delivery-radio"
                                       name="delivery-method" <?php if ($delivery_name == 'Poczta Polska') echo 'checked="checked"'; ?>>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-2"></div>
            </div>

        </div>
    </div>

    <div class="summary">
        <hr>
        <div class="summary-title">
            <h4>Ogółem : <span class="summary-price"
                               data-basket="<?php echo $basket_id; ?>"><?php echo $total_price; ?></span> zł</h4>
        </div>

    </div>
<?php endif; ?>

