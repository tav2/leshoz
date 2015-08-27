<div class="uk-container" style="background-color: #ffffff;margin-top: 20px;">
    <div class="uk-grid">
        <div class="uk-width-1-1" style="text-align: center; margin-top: 10px">
            <h3>Настройки</h3>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-1">
            <form action="/admin/dashboard/setting"  method="post" class="uk-form">
                <h4>смена пароля</h4>
                <div class="uk-form-row">
                    <input type="password" name="password" required="" class="uk-width-4-10" placeholder="Новый пароль"/>
                </div>
                <div class="uk-form-row">
                    <input type="password" name="password_again" required="" class="uk-width-4-10" placeholder="Повторите новый пароль"/>
                </div>
                <div class="uk-form-row">
                    <input name="setting" type="submit" value="Сохранить" class="uk-button uk-width-4-10"/>
                </div>
            </form>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-1"></div>
    </div>
</div>