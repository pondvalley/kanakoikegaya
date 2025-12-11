<?php snippet('header') ?>

<main>
    <div class="mx-8">
        <ul class="flex flex-wrap -mt-4 justify-start">
            <?php foreach ($site->grandchildren()->sortBy('year', 'desc') as $projects) : ?>
                <?php if ($projects->image()) : ?>
                    <li class="">
                        <a class="hover:text-gray-500" href="<?= $projects->url() ?>">
                            <img class="my-2 mr-4 hover:shadow-lg h-72 object-cover" src="<?= $projects->image()->url() ?>">
                            <figcaption class="text-xs ml-2"><?= $projects->title() ?></figcaption>
                            <div class="flex">
                                <figcaption class="text-xs ml-2 mb-2"><?= $projects->year() ?></figcaption>
                            </div>
                        </a>
                    </li>
                <?php endif ?>
            <?php endforeach ?>
        </ul>
    </div>
    </div>
    </div>
</main>

<?php snippet('footer') ?>