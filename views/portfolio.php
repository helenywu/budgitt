<b><font color = "red"></b>Number of Days Remaining in Spending Period: </font></b> <?= $remaining ?>
<form action="index.php" method="post">
<fieldset>
<div class="boxed">
        <h3>Start a New Spending Period</h3>
        <div class="form-group">
            <input class="form-control" name="spending_period" placeholder="Period (Length in Days)" type="text"/>
        </div>
    <!--<?php-->
    <!--    $categories = CS50::query("SELECT category FROM categories WHERE user_id = ?", $_SESSION["id"]);-->
        
    <!--    foreach ($categories as $category)-->
    <!--    {-->
    <!--        print($category["category"]);-->
    <!--        print("<div class ='form-group'> <input class='form-control' name='value'</div>" . "</br>");-->
    <!--    }-->
    <!--?>-->
   
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Submit
            </button>
        </div>
        </fieldset>
    </form>
</div>

<hr>
<b>Current Spending Period: </b> <?= $start . " to " .  $end ?>


<table class="table table-hover">
    <thead>
        <tr>
            <th style="text-align: left;">Category</th>
            <th style="text-align: center;">Spending Target</th>
            <th style="text-align: center;">Actual Spending</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($positions)): ?>
            <?php foreach($positions as $position): ?>
                <tr>
                    <td style="text-align: left;"><?= $position["category"] ?></td>
                    <td style="text-align: center;"><?= $position["ideal_spending"] ?></td>
                    <td style="text-align: center;"><?= $position["actual_spending"] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif ?>
        
        
    </tbody>
    <tfoot>
        <tr>
            <td style="text-align: left;"><b>TOTAL BUDGET</b></td>
            <td style="text-align: center;"><b><?= $budget ?></b></td>
            <td style="text-align: center;"><b><?= $money ?></b></td>
        </tr>
    </tfoot>
        <!--<tr>-->
        <!--    <td colspan="4" style="text-align: left;">TOTAL BUDGET</td>-->
        <!--    <td style="text-align: right;"><?= $budget ?></td>-->
        <!--</tr>-->
</table><html>