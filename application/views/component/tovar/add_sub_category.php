
<div class="uk-container" style="background-color: #ffffff;margin-top: 20px;">
    <div class="uk-grid">
        <div class="uk-width-1-1" style="text-align: center; margin-top: 10px">
            <h3>Добавление подкатегории</h3>
            <?php //echo $this->session->flashdata('success'); ?>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-1">
            <form action=""  method="post" class="uk-form">
                <h4>Введите название подкатегории</h4>
                <div class="uk-form-row">
					<input required name="sub_category" type="text" size="40" value="<?=$sub_category_red['tovar_sub_category_name'];?>">
                </div>
                <h4>Выберете категорию</h4>
                <div class="uk-form-row">
                    <select name="category" id=""  class="uk-width-4-10">
                        <?php foreach($all_category_select as $id): ?>
                            <option value="<?php echo $id['tovar_category_id'] ?>"><?php echo $id['tovar_category_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <h4>Введите описание подкатегории</h4>
                <textarea required name="tovar_sub_category_text" id="editor3" rows="10" cols="80"><?=$sub_category_red['tovar_sub_category_text'];?></textarea>
                    <script>
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'editor3' );
                    </script>

                <div class="uk-form-row">
                    <input type="submit" value="Добавить" class="uk-button uk-width-4-10"/>
                </div>
            </form>
        </div>
        
    </div>
    <a href="/admin/components/tovar/edit_sub_category">назад</a>
    <div class="uk-grid">
        <div class="uk-width-1-1"></div>
    </div>
</div>