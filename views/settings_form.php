<head>
    <style>
        .boxed {
          border: 2px solid green ;
        }
    </style>
</head>

<form action="settings.php" method="post">
    <fieldset>
        <h3>What would you like to do?</h3>
        <div class="form-group">
            <select name="options">
              <option value="new_cat">Add a New Category</option>
              <option value="edit_category">Edit Category Ideal Spending</option>
              <option value="change_alerts">Change Alert Options</option>
            </select>
        </div>
        

        <div class="boxed">
            <h3>Add a New Category</h3>
            <div class="form-group">
                <input class="form-control" name="new_cat" placeholder="Category Name" type="text"/>
            </div>
            <div class="form-group">
                <input class="form-control" name="target" placeholder="Ideal Spending Target" type="text"/>
            </div>
        
        
            <div class="form-group">
                <button class="btn btn-default" type="submit">
                    <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                    Submit
                </button>
            </div>
        </div>
        
        <!-- <div class="boxed">-->
        <!--    <h3>Edit Total Budget</h3>-->
        <!--    <div class="form-group">-->
        <!--    <select name="budget_options">-->
        <!--      <option value="add_money">Add Money</option>-->
        <!--      <option value="sub_money">Subtract Money</option>-->
        <!--    </select>-->
        <!--</div>-->
        <!--    <div class="form-group">-->
        <!--        <input class="form-control" name="new_budget" placeholder="Amount Changed" type="text"/>-->
        <!--    </div>-->
        <!--    <div class="form-group">-->
        <!--        <button class="btn btn-default" type="submit">-->
        <!--            <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>-->
        <!--            Submit-->
        <!--        </button>-->
        <!--    </div>-->
        <!--</div>-->
        
         <div class="boxed">
            <h3>Edit Category Ideal Spending</h3>
            <b>Enter Category Name:</b>
            <div class="form-group">
                <input class="form-control" name="category_name" placeholder="Category Name" type="text"/>
            </div>
            <div class="form-group">
            <select name="cat_options">
              <option value="add_money">Add Money</option>
              <option value="sub_money">Subtract Money</option>
            </select>
        </div>
            <div class="form-group">
                <input class="form-control" name="cat_budget" placeholder="Amount Changed" type="text"/>
            </div>
            <div class="form-group">
                <button class="btn btn-default" type="submit">
                    <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                    Submit
                </button>
            </div>
        </div>
        
        <div class="boxed">
            <h3>Change Alert Options</h3>
            <div class="form-group">
                <b>Please send me... </b> <br>
                <input type="checkbox" name="email_alerts" value="Emails"> Emails
                <input type="checkbox" name="no_alerts" value="None"> No Alerts <br>
            </div>
            <div class="form-group">
                <button class="btn btn-default" type="submit">
                    <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                    Submit
                </button>
            </div>
        </div>
        
        
    </fieldset>
</form>
