<!-- //список ссылок на изменение статических страниц -->

<div class="uk-container" style="background-color: #ffffff;margin-top: 20px;">
    <div class="uk-grid">
        <div class="uk-width-1-1" style="text-align: center; margin-top: 10px">
            <h3>Редактирование страниц</h3>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-1">
            <form action=""  method="post" class="uk-form">
                <h4>Выберете страницу</h4>
                <div class="uk-form-row">
                    <select name="staticpage_select" id=""  class="uk-width-4-10">
                        <?php foreach($pages as $item): ?>
                            <option value="<?php echo $item['staticpage_id'] ?>"><?php echo $item['staticpage_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="uk-form-row">
                    <input name="staticpage_select_but" type="submit" value="выбрать" class="uk-button uk-width-4-10"/>
                </div>
            </form>
        </div>
    </div>

    <div class="uk-grid">
        <div class="uk-width-1-1">
                <h4>Выбранная страница: <?php echo $this->dbmodel->get_table_field($staticpage_id, 'staticpage_name') ?></h4>
                <div class="uk-form-row">
                        <?php $num=1; foreach($staticpage_content as $id): ?>
                            <h4>Запись: <?php  echo $num++ ?></h4>
                            <p>
                                <h4>Заголовок записи:</h4>
                                <?php echo $id['staticpage_title'] ?>
                            </p>
                            <p>
                                <h4>Текст записи:</h4>
                                <?php echo $id['staticpage_text'] ?>
                            </p>
                            <p>
                                <!-- <a class="btn btn-default" href="/admin/components/staticpage/delete_staticpage_zapis/<?=$id['staticpage_id'];?>/<?=$id['staticpage_content_id'];?>" role="button">Удалить запись &raquo;</a> -->
                                <a class="btn btn-default" href="/admin/components/staticpage/add_staticpage_zapis/<?=$id['staticpage_id'];?>/<?=$id['staticpage_content_id'];?>" role="button">Редактировать запись &raquo;</a>
                                <hr>
                            </p>
                        <?php endforeach ?>
                        <!-- если выбрали страницу -->
                        <?php if ($staticpage_id!='') { ?>
                            <a class="btn btn-default" href="/admin/components/staticpage/add_staticpage_zapis/<?=$id['staticpage_id'];?>" role="button">Добавть запись &raquo;</a>
                        <?php } ?>
                </div>
                <h4>Файлы страницы:</h4>
                <?php foreach($staticpage_file as $id): ?>
                    <div>
                        <a href="<?=$id['staticpage_file_adres'];?>" target="_blank"><img alt="" src="<?=$id['staticpage_file_adres'];?>" style="border-style:solid; border-width:10px;  height:130px; width:100px" /></a>
                        <a class="btn btn-default" href="/admin/components/staticpage/delete_staticpage_file/<?=$id['staticpage_file_id'];?>" role="button">Удалить &raquo;</a>
                    </div>
                <?php endforeach ?>
                <!-- если выбрали страницу -->
                <?php if ($staticpage_id!='') { ?>
                    <a class="btn btn-default" href="/admin/components/staticpage/add_staticpage_file/<?=$staticpage_id;?>" role="button">Добавить файлы &raquo;</a>
                <?php } ?>
        </div>
    </div>

    <div class="uk-grid" style="height: 60px; background-color: #535C69; color: #ffffff; margin-right: -35px">
        <div class="uk-width-1-1">
            <div style="margin-top: 14px; margin-left: -15px; color: #fff">
                <a href="/admin/components/staticpage/add_page" class="" style="color: #fff !important">
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-square-o fa-stack-2x"></i>
                      <i class="fa fa-plus fa-stack-1x"></i>
                    </span>Добавить страницу
                </a>
            </div>
        </div>
    </div>
        <a href="/admin/components/staticpage/">назад</a>
    <div class="uk-grid">
        <div class="uk-width-1-1"></div>
    </div>
</div>