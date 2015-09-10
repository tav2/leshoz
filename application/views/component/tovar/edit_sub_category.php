<div class="uk-container" style="background-color: #ffffff;margin-top: 20px;">
    <div class="uk-grid">
        <div class="uk-width-1-1" style="text-align: center; margin-top: 10px">
            <h3>Редактирование подкатегории</h3>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-1">
            <form action=""  method="post" class="uk-form">
                <h4>Выберете подкатегорию</h4>
                <div class="uk-form-row">
                    <select name="tovar_sub_category_select" id=""  class="uk-width-4-10">
                        <?php foreach($all_sub_category_select as $id): ?>
                            <option value="<?php echo $id['tovar_sub_category_id'] ?>"><?php echo $id['tovar_sub_category_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="uk-form-row">
                    <input name="tovar_sub_category_select_but" type="submit" value="выбрать" class="uk-button uk-width-4-10"/>
                </div>
            </form>
        </div>
    </div>

    <div class="uk-grid">
        <div class="uk-width-1-1">
                <h4>Выбранная подкатегория:</h4>
                <div class="uk-form-row">
                        <?php foreach($tovar_sub_category as $id): ?>
                            <?php echo $id['tovar_sub_category_name'] ?>
                            <p>
                                <h4>Текст подкатегории:</h4>
                                <?php echo $id['tovar_sub_category_text'] ?>
                            </p>
                            <p>
                                <a class="btn btn-default" href="/admin/components/tovar/delete_sub_category/<?=$id['tovar_sub_category_id'];?>" role="button">удалить &raquo;</a>
                                <a class="btn btn-default" href="/admin/components/tovar/add_sub_category/<?=$id['tovar_sub_category_id'];?>" role="button">редактировать &raquo;</a>
                                <a class="btn btn-default" href="/admin/components/tovar/add_sub_category_img/<?=$id['tovar_sub_category_id'];?>" role="button">добавить изображения &raquo;</a>
                            </p>
                        <?php endforeach ?>
                </div>
                <h4>Изображения подкатегории:</h4>
                <?php foreach($tovar_sub_category_img as $id): ?>
                    <div>
                        <a href="<?=$id['tovar_img_adres'];?>" target="_blank"><img alt="" src="<?=$id['tovar_img_adres'];?>" style="border-style:solid; border-width:10px;  height:130px; width:100px" /></a>
                        <a class="btn btn-default" href="/admin/components/tovar/delete_sub_category_img/<?=$id['tovar_sub_category_img_id'];?>" role="button">удалить &raquo;</a>
                    </div>
                <?php endforeach ?>
        </div>
    </div>

    <div class="uk-grid" style="height: 60px; background-color: #535C69; color: #ffffff; margin-right: -35px">
        <div class="uk-width-1-1">
            <div style="margin-top: 14px; margin-left: -15px; color: #fff">
                <a href="/admin/components/tovar/add_sub_category" class="" style="color: #fff !important">
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-square-o fa-stack-2x"></i>
                      <i class="fa fa-plus fa-stack-1x"></i>
                    </span>Добавить подкатегорию
                </a>
            </div>
        </div>
    </div>
    <a href="/admin/components/tovar/edit_tovar">назад</a>
    <div class="uk-grid">
        <div class="uk-width-1-1"></div>
    </div>
</div>