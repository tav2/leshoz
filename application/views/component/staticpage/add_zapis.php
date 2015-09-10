
<div class="uk-container" style="background-color: #ffffff;margin-top: 20px;">
    <div class="uk-grid">
        <div class="uk-width-1-1" style="text-align: center; margin-top: 10px">
            <h3>Добавление записи</h3>
            <?php //echo $this->session->flashdata('success'); ?>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-1">
            <form method="post" class="uk-form">
                <h4>Введите заголовок записи</h4>
                <div class="uk-form-row">
					<input required name="staticpage_title" type="text" size="40" value="<?=$staticpage_title;?>">
                </div>
                <h4>Введите текст записи</h4>
                <textarea required name="staticpage_text" id="editor3" rows="10" cols="80"><?=$staticpage_text;?></textarea>
                    <script>
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'editor3' );
                    </script>

                <input type="hidden" name="staticpage_content_id" value="<?=$staticpage_content_id;?>">

                <div class="uk-form-row">
                    <input type="submit" value="Добавить" class="uk-button uk-width-4-10"/>
                </div>
            </form>
        </div>
        
    </div>
    <a href="/admin/components/staticpage/page_edit">назад</a>
    <div class="uk-grid">
        <div class="uk-width-1-1"></div>
    </div>
</div>