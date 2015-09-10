<div class="uk-container" style="background-color: #ffffff;margin-top: 20px;">
    <div class="uk-grid">
        <div class="uk-width-1-1" style="text-align: center; margin-top: 10px">
            <h3>Редактирование галереи</h3>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-1">
            <form action=""  method="post" class="uk-form">
                <h4>Выберете меню галереи</h4>
                <div class="uk-form-row">
                    <select name="edit_galereya_menu_select" id=""  class="uk-width-4-10">
                        <?php foreach($all_galereya_menu_select as $id): ?>
                            <option value="<?php echo $id['galereya_menu_id'] ?>"><?php echo $id['galereya_menu_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="uk-form-row">
                    <input name="edit_galereya_menu_but" type="submit" value="Выбрать" class="uk-button uk-width-4-10"/>
                </div>
            </form>
        </div>
    </div>

    <?php //echo $galereya_menu_name ?>
    <div class="uk-grid">
        <div class="uk-width-1-1">
                <h4>Выбранная менюшка галереи:</h4>
                <div class="uk-form-row">
                        <?php foreach($galereya_menu as $id): ?>
                            <?php echo $id['galereya_menu_name'] ?>
                            <p>
                                <h4>Текст подкатегории:</h4>
                                <?php echo $id['galereya_menu_text'] ?>
                            </p>
                            <p>
                                <a class="btn btn-default" href="/admin/components/galereya/delete_galereya_menu/<?=$id['galereya_menu_id'];?>" role="button">удалить &raquo;</a>
                                <a class="btn btn-default" href="/admin/components/galereya/add_galereya_menu/<?=$id['galereya_menu_id'];?>" role="button">редактировать &raquo;</a>
                                <a class="btn btn-default" href="/admin/components/galereya/add_galereya_img/<?=$id['galereya_menu_id'];?>" role="button">добавить изображения &raquo;</a>
                            </p>
                        <?php endforeach ?>
                </div>
                <h4>Изображения подкатегории:</h4>
                <?php foreach($galereya_img as $id): ?>
                    <div class="row">
                        <a href="<?=$id['galereya_img_adres'];?>" target="_blank"><img alt="" src="<?=$id['galereya_img_adres'];?>" style="border-style:solid; border-width:10px;  height:130px; width:100px" /></a>
                        <a class="btn btn-default" href="/admin/components/galereya/delete_galereya_img/<?=$id['galereya_img_id'];?>" role="button">удалить &raquo;</a>
                    </div>
                <?php endforeach ?>
        </div>
    </div>

    <div class="uk-grid" style="height: 60px; background-color: #535C69; color: #ffffff; margin-right: -35px">
        <div class="uk-width-1-1">
            <div style="margin-top: 14px; margin-left: -15px; color: #fff">
                <a href="/admin/components/galereya/add_galereya_menu" class="" style="color: #fff !important">
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-square-o fa-stack-2x"></i>
                      <i class="fa fa-plus fa-stack-1x"></i>
                    </span>Добавить пункт меню галереи
                </a>
            </div>
        </div>
    </div>
    <!-- <a href="/admin/components/tovar">назад</a> -->
    <div class="uk-grid">
        <div class="uk-width-1-1"></div>
    </div>
</div>