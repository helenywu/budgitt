<form action="register.php" method="post">
    <fieldset>
         <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="name" placeholder="Name" type="text"/>
        </div>
        <div class="form-group">
            <input autocomplete="off" class="form-control" name="username" placeholder="Username" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="password" placeholder="Password" type="password"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="confirmation" placeholder="Confirmation" type="password"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="period_length" placeholder="Spending Period (in Days)" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="email" placeholder="Email" type="text"/>
        </div>
        <div class="form-group">
            <b>Any alert options? </b> <br>
            <input type="checkbox" name="email_alerts" value="Emails"> Email
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Register
            </button>
        </div>
    </fieldset>
</form>
<div>
    or <a href="login.php">log in</a>
</div>
