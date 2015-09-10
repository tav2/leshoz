<div class="uk-container" style="background-color: #ffffff;margin-top: 20px;">
    <div class="uk-grid">
        <div class="uk-width-1-1" style="text-align: center; margin-top: 10px">
            <h3>Управление товаром</h3>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-1">
            <form action=""  method="post" class="uk-form">
                <h4>Выберете категорию</h4>
                <div class="uk-form-row">
                    <select name="category_select" id=""  class="uk-width-4-10">
                        <option selected disabled>Выберите категорию</option>
                        <?php foreach($category_menu as $id): ?>
                            <option value="<?php echo $id['tovar_category_id'] ?>"><?php echo $id['tovar_category_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <input type="submit" value="Применить" class="uk-button uk-width-4-10"/>
                </div>
            </form>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-1">
            <form action=""  method="post" class="uk-form">
                <h4>Выберете подкатегорию</h4>
                <div class="uk-form-row">
                    <select  name="sub_category_select" id=""  class="uk-width-4-10">
                        <option selected disabled>Выберите подкатегорию</option>
                        <?php foreach($sub_category_menu as $id): ?>
                            <option value="<?php echo $id['tovar_sub_category_id'] ?>"><?php echo $id['tovar_sub_category_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <input type="submit" value="Применить" class="uk-button uk-width-4-10"/>
                </div>
            </form>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-1">
            <form action=""  method="post" class="uk-form">
                <h4>Выберете товар</h4>
                <div class="uk-form-row">
                    <select name="tovar_select" id="" onchange="show_tovar(this);" class="uk-width-4-10">
                        <option selected disabled>Выберите товар</option>
                        <?php foreach($tovar_menu as $id): ?>
                            <option value="<?php echo $id['tovar_id'] ?>"><?php echo $id['tovar_name'].$id['tovar_razmer']."(".$this->dbmodel->get_material($id['tovar_material_id']).")" ?></option>
                        <?php endforeach ?>
                    </select>
                    <input type="submit" value="Применить" class="uk-button uk-width-4-10"/>
                </div>
            </form>
        </div>
    </div>

    <div class="uk-grid">
        <div class="uk-width-1-1">
                <h4>Выбранный товар:</h4>
                <div class="uk-form-row">
                        <?php foreach($tovar as $id): ?>
                            <?php echo $id['tovar_name'] ?>
                            <?php echo "Цена:".$id['tovar_prise'] ?>
                            <?php echo "Цена АБ:".$id['tovar_prise_ab'] ?>
                            <?php echo "Цена В:".$id['tovar_prise_b'] ?>
                            <?php echo "Цена С:".$id['tovar_prise_c'] ?>
                            <?php echo "Скидка:".$id['tovar_skidka'] ?><br>
                            <?php echo "Текст:".$this->dbmodel->cutStr($id['tovar_text']) ?>
                            <?php echo "Рейтинг:".$id['tovar_reit'] ?>
                            <?php echo "Размеры:".$id['tovar_razmer'] ?>
                            <?php echo "Другое:".$id['tovar_uther'] ?>
                            <?php echo "Доступность:".$id['tovar_dostupnost'] ?>
                            <?php echo "Материал:".$this->dbmodel->get_material($id['tovar_material_id']) ?>
                            <?php echo "Цвет:".$this->dbmodel->get_color($id['tovar_color_id']) ?>
                            <?php echo "Подкатегория:".$this->dbmodel->get_sub_category($id['tovar_sub_category_id']) ?><br>
                            <p>
                                <a class="btn btn-default" href="/admin/components/tovar/add_tovar/<?=$id['tovar_id'];?>" role="button">редактировать &raquo;</a>
                                <a class="btn btn-default" href="/admin/components/tovar/dell_tovar/<?=$id['tovar_id'];?>" role="button">удалить &raquo;</a>
                                <a class="btn btn-default" href="/admin/components/tovar/add_img/<?=$id['tovar_id'];?>" role="button">добавить изображения &raquo;</a>
                            </p>
                        <?php endforeach ?>
                </div>
                <h4>Изображения товара:</h4>
                <?php foreach($tovar_img as $id): ?>
                    <div>
                        <a href="<?=$id['tovar_img_adres'];?>" target="_blank"><img alt="" src="<?=$id['tovar_img_adres'];?>" style="border-style:solid; border-width:10px;  height:130px; width:100px" /></a>
                        <a class="btn btn-default" href="/admin/components/tovar/dell_img/<?=$id['tovar_img_id'];?>" role="button">удалить &raquo;</a>
                    </div>
                <?php endforeach ?>
        </div>
    </div>

    <div class="uk-grid" style="height: 60px; background-color: #535C69; color: #ffffff; margin-right: -35px">
        <div class="uk-width-1-1">
            <div style="margin-top: 14px; margin-left: -15px; color: #fff">
                <a href="/admin/components/tovar/add_tovar" class="" style="color: #fff !important">
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-square-o fa-stack-2x"></i>
                      <i class="fa fa-plus fa-stack-1x"></i>
                    </span>Добавить товар
                </a>
            </div>
        </div>
    </div>
    <div class="uk-grid" style="height: 60px; background-color: #535C69; color: #ffffff; margin-right: -35px">
        <div class="uk-width-1-1">
            <div style="margin-top: 14px; margin-left: -15px; color: #fff">
                <a href="/admin/components/tovar/edit_sub_category" class="" style="color: #fff !important">
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-square-o fa-stack-2x"></i>
                      <i class="fa fa-plus fa-stack-1x"></i>
                    </span>Управление подкатегориями
                </a>
            </div>
        </div>
    </div>
    <div class="uk-grid" style="height: 60px; background-color: #535C69; color: #ffffff; margin-right: -35px">
        <div class="uk-width-1-1">
            <div style="margin-top: 14px; margin-left: -15px; color: #fff">
                <a href="/admin/components/tovar/edit_category" class="" style="color: #fff !important">
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-square-o fa-stack-2x"></i>
                      <i class="fa fa-plus fa-stack-1x"></i>
                    </span>Управление категориями
                </a>
            </div>
        </div>
    </div>
    <br>
    <a href="/admin/components/tovar">назад</a>
    <div class="uk-grid">
        <div class="uk-width-1-1"></div>
    </div>
</div>