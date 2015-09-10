<div class="uk-container" style="background-color: #ffffff;margin-top: 20px;">
    <div class="uk-grid">
        <div class="uk-width-1-1" style="text-align: center; margin-top: 10px">
            <h3>Редактирование пользователей</h3>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    </div>
    <!-- выбираем пользователя -->
    <div class="uk-grid">
        <div class="uk-width-1-1">
            <form action=""  method="post" class="uk-form">
                <h4>Выберете меню пользователей</h4>
                <div class="uk-form-row">
                    <select name="edit_customer_menu_select" id=""  class="uk-width-4-10">
                        <?php foreach($all_customer_menu_select as $id): ?>
                            <option value="<?php echo $id['customer_id'] ?>"><?php echo $id['customer_name'].'-'.$id['customer_email'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="uk-form-row">
                    <input name="edit_customer_menu_but" type="submit" value="Выбрать" class="uk-button uk-width-4-10"/>
                </div>
            </form>
        </div>
    </div>

    <?php //echo $customer_menu_name ?>
    <!-- смотрим его данные -->
    <div class="uk-grid">
        <div class="uk-width-1-1">
                <h4>Пользователь:</h4>
                <div class="uk-form-row">
                        <?php foreach($customer as $id): ?>
                            <?php echo $id['customer_name'] ?>
                            <p>
                                <h4>Емайл пользователя:</h4>
                                <?php echo $id['customer_email'] ?>
                            </p>
                            <p>
                                <h4>Дата создания:</h4>
                                <?php echo $id['customer_date'] ?>
                            </p>
                            <p>
                                <h4>Емайл подтвержден:</h4>
                                <?php echo $id['customer_email_check'] ?>
                            </p>
                            <p>
                                <a class="btn btn-default" href="/admin/components/users/delete_customer/<?=$id['customer_id'];?>" role="button">удалить &raquo;</a>
                            </p>
                        <?php endforeach ?>
                </div>
        </div>
    </div>
    <!-- выбираем покупки пользователя -->
    <div class="uk-grid">
        <div class="uk-width-1-1">
            <form action=""  method="post" class="uk-form">
                <h4>Покупки пользователя:</h4>
                <div class="uk-form-row">
                    <select name="cart_customer_menu_select" id=""  class="uk-width-4-10">
                        <?php foreach($customer_cart_menu_select as $id): ?>
                            <option value="<?php echo $id['customer_cart_id'] ?>"><?php echo $id['customer_cart_date'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="uk-form-row">
                    <input name="cart_customer_but" type="submit" value="Выбрать" class="uk-button uk-width-4-10"/>
                </div>
            </form>
        </div>
    </div>
    <!-- смотрим какие товары в покупке -->
    <div class="uk-grid">
        <div class="uk-width-1-1">
                <h4>Купленные товары:</h4>
                <div class="uk-form-row">
                        <?php foreach($customer_cart_product as $id): ?>
                            <?php echo $id['tovar_name'].$id['tovar_rezmer'].$id['tovar_material'] ?>
                            <p>
                                <h4>Цена товара:</h4>
                                <?php echo $id['tovar_prise'] ?>
                            </p>
                            <p>
                                <a class="btn btn-default" href="/admin/components/users/delete_customer_cart_product/<?=$id['customer_product_id'];?>" role="button">удалить &raquo;</a>
                            </p>
                        <?php endforeach ?>
                </div>
        </div>
    </div>

    <a href="/admin/components/users">назад</a>
    <div class="uk-grid">
        <div class="uk-width-1-1"></div>
    </div>
</div>