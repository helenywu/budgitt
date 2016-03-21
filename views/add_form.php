<form action="add.php" method="post">   
    <fieldset>
        <div class="form-group">
            <input class="form-control" name="object" placeholder="Item Description" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="category" placeholder="Category" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="spent" placeholder="Amount Spent (00.00)" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="date" placeholder="Date of Purchase (YYYY-MM-DD)" type="text style=" maxlength="10" style="width: 250px;"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-symbol"></span>
                Add Item
            </button>
        </div>
    </fieldset>
</form>
