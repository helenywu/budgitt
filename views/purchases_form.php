<table class="table table-hover">
    <thead>
        <tr>
            <th style="text-align: left;">Date of Transaction</th>
            <th style="text-align: center;">Category</th>
            <th style="text-align: left;">Item Name</th>
            <th style="text-align: center;">Money Spent</th>
        </tr>
    </thead>
    <tbody>
        
        <?php foreach ($purchases as $transaction): ?>
            <tr>
                <?php 
                    $name = CS50::query("SELECT category FROM categories WHERE id = ?", $transaction["category_id"]);
                ?>
                <td style="text-align: left;"><?= $transaction["spending_date"] ?></td>
                <td style="text-align: center;"><?= $name[0]["category"] ?></td>
                <td style="text-align: left;"><?= $transaction["item"] ?></td>
                <td style="text-align: center;"><?= $transaction["money_spent"] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>