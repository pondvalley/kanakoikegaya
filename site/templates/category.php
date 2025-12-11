<?php snippet('header') ?>
<main>
    <div id="slideshow" class="my-4">
        <?php foreach ($page->children() as $projects) : ?>
            <hooper class="pl-2" :settings="hooperSettings">
                <?php foreach ($projects->images() as $image) : ?>
                    <slide>
                        <img class="" src="<?= $image->resize(null, 400)->url() ?>" alt="">
                    </slide>
                <?php endforeach ?>
                <hooper-navigation slot="hooper-addons"></hooper-navigation>
            </hooper>
            <a class="hover:text-gray-500" href="<?= $projects->url() ?>">
                <div class="flex">
                    <figcaption class="ml-10 mt-6 text-sm"><?= $projects->title() ?></figcaption>
                    <figcaption class="ml-2 mt-6 text-sm"><?= $projects->year() ?></figcaption>
                </div>
                <figcaption class="ml-10 mt-2 mb-4 text-xs"><?= $projects->media() ?></figcaption>
                <p class="ml-10 mt-2 mb-8 text-xs">> See all</p>
            </a>
        <?php endforeach ?>
    </div>
</main>

<?= js('assets/js/carousel.js') ?>
<?php snippet('footer') ?>