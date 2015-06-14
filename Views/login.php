<div class="col-md-6 col-md-offset-3">
    <?php if (isset($error) ): ?>
        <div class="form-group">
            <label class="error_message"><?=$error?></label>
        </div>
    <?php endif; ?>
    <form  method="post" action="login">
        <div class="form-group">
            <label for="username">Identifier:
                <!-- TODO: Change this -->
                <button type="button" class="btn no-border" data-toggle="tooltip" data-placement="bottom" title="Username or Email Address">
                <span class="glyphicon glyphicon-question-sign"></span>
                </button>
            </label>
            <input type="text" class="form-control" name="username" id="username" required value="test">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" required value="A1234567">
        </div>
        <button type="submit" class="btn btn-default">Login</button>
    </form>
</div>