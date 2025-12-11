<?php
?>
<p class="mt-14 mx-8"> Related works</p>
<div id="slideshow" class="-mt-14">
    <hooper class="pl-2" :settings="hooperSettings">
        <?php foreach ($page->siblings(false) as $projects) : ?>
            <slide>
                <div class="grid-cols-1">
                <img class="" src="<?= $projects->image()->crop(300, 225)->url() ?>" alt="">
                <a class="hover:text-gray-500" href="<?= $projects->url() ?>">
                    <figcaption class="mt-3 text-sm"><?= $projects->title() ?></figcaption>
                </a>
                </div>
            </slide>
        <?php endforeach ?>
        <hooper-navigation slot="hooper-addons"></hooper-navigation>
    </hooper>
</div>
<?= js('assets/js/carousel.js') ?>