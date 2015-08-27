<div class="uk-grid uk-grid-collapse top-navigation">
    <div class="uk-width-2-10 top-navigation-brand">
        Панель управления
    </div>
    <div class="uk-width-5-10 top-navigation-right">
    </div>
    <div class="uk-width-2-10 top-navigation-right">
        <div id="digital_watch" style="font-size: 42px; margin-top: -8px"></div>
        <div id="date_time" style="font-size: 12px; margin-top: -35px"></div>
    </div>
    <div class="uk-width-1-10 top-navigation-right">
        <a href="/admin/auth/logout" title="<?php echo $this->lang->line('logout_title') ?>">
            <?php echo $this->lang->line('logout_button') ?>
        </a>
    </div>
</div>

<div class="uk-grid uk-grid-collapse">
    <div class="uk-width-2-10">
        <div class="uk-panel uk-panel-box side-navigation">

            <h3 class="uk-panel-title">Навигация</h3>

            <ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav>
                <li class="uk-active"><a href="/admin">Главная страница</a></li>

                <li class="uk-parent">
                    <a href="#"><i class="uk-icon-navicon"></i> Управление сайтом</a>
                    <ul class="uk-nav-sub">
                        <li><a href="/admin/dashboard/setting"><i class="uk-icon-cog"></i> Общие настройки</a></li>
<!--                        <li><a href="#"><i class="uk-icon-skyatlas"></i> Резервное копирование</a></li>-->
                    </ul>
                </li>

<!--                <li><a href="#"><i class="uk-icon-bar-chart"></i> Статистика</a></li>-->

                <li class="uk-nav-header">Компоненты</li>
                <?php

                foreach ($component_menu as $nav) {
                    if($nav['status'] == 2)
                    {
                        echo '<li><a>' . $nav['name'] . '</a></li>';
                    } else {
                        $color = ($nav['status']) ? '' : 'color:red';
                        echo '<li><a href="/admin/components/' . $nav['dir'] . '" style="'.$color.'">' . $nav['name'] . '</a></li>';
                    }
                }

                ?>
                <li class="uk-nav-divider"></li>
                <li><a href="#">Лицензионное соглашение</a></li>
                <li><a href="#">Завершить сеанс</a></li>
            </ul>

        </div>
    </div>
    <div class="uk-width-7-10">
        <?php echo $component; ?>
    </div>
    <div class="uk-width-1-10"></div>
</div>
