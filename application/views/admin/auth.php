<div class="uk-vertical-align uk-text-center uk-height-1-1">
    <div class="uk-vertical-align-middle" style="width: 300px;">

        <img class="uk-margin-bottom" width="238" height="239" src="/assets/img/logo.png" alt="Eidos CMF" style="margin-top: 50px">

        <div style="color: red; font-weight: bold;"><?php echo $this->session->flashdata('auth_error'); ?></div>

        <form class="uk-panel uk-panel-box uk-form" action="/admin/auth/login" method="post" style="background-color: #535C69">
            <div class="uk-form-row">
                <input name="login" class="uk-width-1-1 uk-form-large" type="text" placeholder="Логин">
            </div>
            <div class="uk-form-row">
                <input name="password" class="uk-width-1-1 uk-form-large" type="password" placeholder="Пароль">
            </div>
            <div class="uk-form-row">
                <input style="color: #ffffff;" type="submit" value="Авторизоваться" class="uk-width-1-1 uk-button uk-button-primary uk-button-large"/>
            </div>
<!--            <div class="uk-form-row uk-text-small">-->
<!--                <label class="uk-float-left"><input type="checkbox"> Remember Me</label>-->
<!--                <a class="uk-float-right uk-link uk-link-muted" href="#">Forgot Password?</a>-->
<!--            </div>-->
        </form>

    </div>
</div>