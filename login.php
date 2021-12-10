<?php
include_once __DIR__ . '/header.php';
?>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="checkLogin.php" method="post">
                        <h3 class="text-center login_header">Inloggen</h3>
                        <div class="form-group">
                            <label for="email" class="login_fields">E-mailadres:</label><br>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="login_fields">Wachtwoord:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                            <input type="submit" name="submit" class="btn btn-primary btn-md" value="Inloggen">
                        </div>
                        <?php
                        if (isset($_SESSION['error_msg'])) {
                            if ($_SESSION['error_msg'] != '') {
                                echo "<p class='text-danger mt-5'>" . $_SESSION['error_msg'] . "</p>";
                            }
                        } else {
                            echo '';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
