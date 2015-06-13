<!--
/**
 * Created by IntelliJ IDEA.
 * User: Lord Zsolt
 * Date: 13/06/2015
 * Time: 17:44
 */
-->

<div class="col-md-6 col-md-offset-3">
    <form  method="post" action="register">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="text" class="form-control" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <div class="form-group">
            <label for="rePassword">Confirm password:</label>
            <input type="password" class="form-control" name="rePassword" id="rePassword" required>
        </div>
<!--        <div class="form-group">-->
<!--            <div class="checkbox agree-checkbox">-->
<!--                <label>-->
<!--                    <input type="checkbox" name="agree"> I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>-->
<!--                </label>-->
<!--            </div>-->
<!--        </div>-->
        <button type="submit" class="btn btn-default">Register</button>
    </form>
</div>