<div class="uk-container" style="background-color: #ffffff;margin-top: 20px;">
    <div class="uk-grid">
        <div class="uk-width-1-1" style="text-align: center">
            <h3>Данный компонент не установлен</h3>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-1">
            <p>
                <strong>Описание компонента</strong><br/>
                Краткое описание компонента
            </p>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-1" style="text-align: center; margin-bottom: 30px">
            <form action="/admin/components/<?php echo $component ?>/setup" method="post">
                <input type="hidden" name="component" value="<?php echo $component ?>"/>
                <input class="uk-button uk-button-success" type="submit" value="Установить модуль"/>
            </form>
        </div>
    </div>
</div>