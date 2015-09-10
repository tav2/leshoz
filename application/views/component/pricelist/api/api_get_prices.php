<?php foreach ($result as $price): ?>
  <div class="row">
  <div class="col-lg-12">
    <div align="center">
  <h3><?php echo $price['pricelist_title']; ?></h3>
    <!--<img src="assets/img/pdf.png" style="float:left; padding-right: 10px; padding-top:5px"> -->

   <a class="btn btn-primary btn-black " target="_blank" class="" href="/upload/prices/<?php echo $price['pricelist_file']; ?>">Посмотреть прайс лист в браузере.</a><br><br>
    <a class="btn btn-primary btn-black" target="_blank" class="" href="welcome/prices/<?php echo $price['pricelist_file']; ?>/download">Скачать прайс лист на &nbsp;компьютер.&nbsp;</a><br><br>
          
          <div class="row">
            
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-7" >
                    <form class="login-form" method="post" action="/prices">
                      <div class="form-group group" >
                        <label for="log-email2" >Ваш email адрес</label>
                        <input type="email" class="input-black" name="email" id="log-email2" placeholder="Введите email" required>
                        <input type="hidden" name="file" value="<?php echo $price['pricelist_file']; ?>">
                      </div>
                      <input type="submit" class="btn-black" name="apply-coupon" value="Вышлите мне!">
                    </form>
                  </div>
                </div>
              </div>
            
          </div>
        </div>
   </div>
  </div>
<?php endforeach ?>