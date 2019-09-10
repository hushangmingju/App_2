<?php
require_once('top.inc');
?>  
    <?php
    $descript = array(
                    1 => array('title'=>'现代简约风格，简约却不失格调!', 'region'=>'上海普陀区', 'area'=>'85', 'style'=>'现代 时尚本真', 'descript'=>'本案设计简单明亮，很清爽很干净简简单单的感觉，没有过多的造型，处处可见生活的气息，回归本真的设计。'),
                    2 => array('title'=>'一辈子对家人的爱和牵挂足够长,沪尚茗居为爱保驾护航！', 'region'=>'上海嘉定区', 'area'=>'130', 'style'=>'欧式 怡然风尚', 'descript'=>'地中海风格的元素很有特点 无论是处处可见的拱形 还是穿插相间的色彩 都把这份生活的惬意体现的淋漓尽致。')  
                );
    if (!isset($_GET['aid']) || intval($_GET['aid']) < 0 || intval($_GET['aid']) > 3) {
    ?>
    <section style="text-align:center;">
      <div style="width:91%; display:inline-block;"> 
        <a href="anli.html?aid=1"><img src="img/anli/anli_pic01.jpg" alt="" style="width:100%;"></a>     
        <div style="color:#000000; font-size:18px; font-weight:bold; text-align:left; padding-top:5px; padding-bottom:5px;">
          现代简约风格，简约却不失格调！
        </div> 
        <div style="color:#000000; font-size:14px; font-weight:bold; text-align:left; padding-top:5px; padding-bottom:5px;">
          现代 时尚本真 85m<sup>2</sup>
        </div> 
      </div>
    </section>    
    <section style="text-align:center; margin-top:5px;">
      <div style="width:91%; display:inline-block;"> 
        <a href="anli.html?aid=2"><img src="img/anli/anli_pic02.jpg" alt="" style="width:100%;"></a>  
        <div style="color:#000000; font-size:18px; font-weight:bold; text-align:left; padding-top:5px; padding-bottom:5px;">
          一辈子对家人的爱和牵挂足够长沪尚茗居为爱保驾护航！
        </div> 
        <div style="color:#000000; font-size:14px; font-weight:bold; text-align:left; padding-top:5px; padding-bottom:5px;">
          欧式 怡然风尚 72m<sup>2</sup>
        </div> 
      </div>
    </section>   
    <section style="text-align:center; margin-top:5px;">
      <div style="width:91%; display:inline-block;"> 
        <a href="anli.html?aid=3"><img src="img/anli/anli_pic03.jpg" alt="" style="width:100%;"></a>      
        <div style="color:#000000; font-size:18px; font-weight:bold; text-align:left; padding-top:5px; padding-bottom:5px;">
          用感性与生活对话，70岁老人的文艺空间。
        </div> 
        <div style="color:#000000; font-size:14px; font-weight:bold; text-align:left; padding-top:5px; padding-bottom:5px;">
          美式 荣耀经典 80m<sup>2</sup>
        </div> 
      </div>
    </section>
    <?php
    }
    else{
    ?>
    <section style="text-align:center; margin-top:16px;">
      <div style="width:91%; display:inline-block;">
        <div style="text-align:left;">
          <h3><?php echo $descript[intval($_GET['aid'])]['title'];?></h3>
        </div>
      </div>
    </section> 
    <section style="text-align:center; margin-top:16px;">
      <div style="width:91%; display:inline-block;">
        <img src="img/anli/anli_splitbar.jpg" alt="" style="width:100%;">
      </div>
    </section>
    <?php
        if (isset($descript[intval($_GET['aid'])])) {
    ?>
    <section style="text-align:center; margin-top:16px;">
      <div style="width:91%; display:inline-block;">
        <div style="text-align:left; background-color:#F0F0F0; padding:14px;  font-weight:300;">
          <div style="display:block;">案例信息</div>
          <div style="display:block;">案例地址：<?php echo $descript[intval($_GET['aid'])]['region'];?></div>
          <div style="display:block;">建筑面积：<?php echo $descript[intval($_GET['aid'])]['area'];?><sup>2</sup></div>
          <div style="display:block;">装修风格：<?php echo $descript[intval($_GET['aid'])]['style'];?></div>
          <div style="display:block;">设计说明：<?php echo $descript[intval($_GET['aid'])]['descript'];?></div>
        </div>
      </div>
    </section>  
    <section style="text-align:center; margin-top:16px;">
      <div style="width:91%; display:inline-block;">
        <img src="img/anli/anli_splitbar2.jpg" alt="" style="width:100%;">
      </div>
    </section>    
    <?php
        }
        $pictures = glob('img/anli/' . intval($_GET['aid']) . '/*.jpg');
        for ($i = 0; $i < count($pictures); $i++) {
    ?>
    <section style="text-align:center; margin-top:12px;">
      <div style="width:91%; display:inline-block;">
        <img class="topImg"  src="<?php echo $pictures[$i];?>" alt="" style="width:100%;">
      </div>
    </section> 
    <?php
        }
    }
    ?>  
    <section style="text-align:center; margin-top:16px;">
      <div style="width:91%; display:inline-block;">
        <img src="img/anli/anli_bottombar.jpg" alt="" style="width:100%;">
      </div>
    </section>
<?php
require_once('bottom.inc');
?>