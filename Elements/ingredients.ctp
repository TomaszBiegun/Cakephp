<ul class="food-components-list">
    <?php foreach ($recipeProducts as $product): ?>
        <li>
            <span><?php echo $product['RecipeProduct']['product_name']; ?></span> -
            <span> <?php echo $product['RecipeProduct']['value'] . $product['RecipeProduct']['unit']; ?> </span>
        </li>
    <?php endforeach; ?>
</ul>