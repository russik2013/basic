<?php
/**
 * Created by PhpStorm.
 * User: russik
 * Date: 15.06.2017
 * Time: 0:06
 */
?>

<h3>Фильм</h3>



    <div class="blok">

        <h3><?=$film[0]['title']?></h3>
        <h4>Постер</h4>
        <img src="/<?=$film[0]['image']?>" alt="" width="200" height="250">
        <h4>Описание</h4>
        <p><?=$film[0]['discription']?></p>
        <h4>Ссылка трейлера</h4>
        <p><a href=" <?=$film[0]['trailer_url']?>">Трейлер</a></p>
        <h4>Галерея</h4>
        <?php for($i = 0; $i < count($film); $i++) {?>
        <img src="/<?=$film[$i]['images_url']?>" alt="" width="200" height="250">

        <?php }?>
        <h4>Seo url</h4>
        <p><?=$film[0]['seo_url']?></p>
        <h4>Seo title</h4>
        <p><?=$film[0]['seo_title']?></p>
        <h4>Seo keywords</h4>
        <p><?=$film[0]['seo_keywords']?></p>
        <h4>Seo description</h4>
        <p><?=$film[0]['seo_description']?></p>
    </div>

<button onClick="window.location='/index.php?r=film%2Fdelete&id=<?=$film[0]['id']?>'">Удалить</button>
<button onClick="window.location='/index.php?r=film%2Fedit&id=<?=$film[0]['id']?>'">Редактировать</button>