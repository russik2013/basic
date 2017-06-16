<?php
/**
 * Created by PhpStorm.
 * User: russik
 * Date: 15.06.2017
 * Time: 0:06
 */
?>
<style>

    .blok {
        position:relative;
        width:300px;
        padding:1em;
        margin:2em 10px 4em;
        background: #ff8f65;
        -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        -webkit-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        -moz-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;

    }
    .blok h3{
        text-align: center;
    }
    .blok img{
        display: block;
        margin: 0 auto;
    }


    .blok p {
        font-size:16px;
        font-weight:bold;
        text-align: center;
    }
    .container{overflow:hidden;}
    .box div{float: left;}
</style>
<h3>Фильмы</h3>
<div class="container">
<div class="box">
<?php foreach($films as $film){ ?>
    <div class="blok" onClick="window.location='/index.php?r=film%2Ffilm&id=<?=$film->id?>'">
        <h3><?=$film->title?></h3>

        <img src="/<?=$film->image?>" alt="" width="200" height="250">
        <p><?=$film->discription?></p>

    </div>

<?php } ?>
    </div>
    </div>
<div onClick="window.location='/index.php?r=film%2Fshow'">
<img src="/photo/add.png" alt="" width="100" height="100">
</div>