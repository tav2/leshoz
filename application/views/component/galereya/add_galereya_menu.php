
<div class="uk-container" style="background-color: #ffffff;margin-top: 20px;">
    <div class="uk-grid">
        <div class="uk-width-1-1" style="text-align: center; margin-top: 10px">
            <h3>Добавление меню галереи</h3>
            <?php //echo $this->session->flashdata('success'); ?>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-1">
            <form action=""  method="post" class="uk-form">
                <h4>Введите название менюшки</h4>
                <div class="uk-form-row">
					<input required name="galereya_menu_name" type="text" size="40" value="<?=$galereya_red['galereya_menu_name'];?>">
                </div>
                <h4>Введите дату для галереи</h4>
                <div class="uk-form-row">
                    <input required name="galereya_menu_date" type="date" size="40" value="<?=$galereya_red['galereya_menu_date'];?>">
                </div>
                <h4>Введите текст для галереи</h4>
                <div class="uk-form-row">
                    <!-- <input name="galereya_menu_text" type="text" size="40"> -->
                    <textarea name="galereya_menu_text" rows="10" cols="80"><?=$galereya_red['galereya_menu_text'];?></textarea>
                </div>

                <div class="uk-form-row">
                    <input type="submit" value="Добавить" class="uk-button uk-width-4-10"/>
                </div>
            </form>
        </div>
        
    </div>
    <a href="/admin/components/galereya/edit_galereya">назад</a>
    <div class="uk-grid">
        <div class="uk-width-1-1"></div>
    </div>
</div>