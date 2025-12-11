<?php snippet('header') ?>
<main>
    <div class="mx-6 mb-6">
        <h1 class="mb-4 ml-4"><?= $page->title() ?></h1>
        <p class="text-sm ml-4"><?= $page->year() ?></p>
        <p class="text-sm ml-4"><?= $page->media() ?></p>
        <?php if ($page->dimension()->isTrue()) :?>
        <p class="text-sm ml-4">dimensions variable</p>
        <?php endif ?>
        <?php if ($page->series()->isNotEmpty()) :?>
        <p class="text-sm ml-4">series of <?= $page->series() ?></p>
        <?php endif ?>
        <?php if ($page->location()->isNotEmpty()) :?>
        <p class="text-sm ml-4">installation view, <?= $page->location() ?></p>
        <?php endif ?>
    </div>
        <?php if ($page->video()->exists()) : ?>
        <div class="m-6">
            <div class="relative embed-responsive aspect-ratio-16/9 bg-black">
		<p class="text-white absolute flex w-full h-full items-center justify-center">Loading...
		</p>
            <?= video(
                $page->video(),
                [
                    'vimeo' => [
                        'background' => 1,
                        'muted' => 1,
                        'loop' => 0
                    ],
                    ['class' => 'embed-responsive-item']
                ]
            ) ?>
    </div>
    </div>
<?php else : ?>
    <ul class="flex flex-wrap mx-4 justify-start">
        <?php foreach ($page->images() as $image) : ?>
            <li>
                <img class="m-2 w-full max-w-screen-md" src="<?= $image->url() ?>" alt="">
                <div class="text-sm ml-6 text-gray-500">
                    <figcaption class=""><?= $image->caption() ?></figcaption>
                    <?php
                    $height = $image->content()->height();
                    $width = $image->content()->width();
                    $depth = $image->content()->depth();
                    $inch = 0.03937007874;

                    if ($height->isNotEmpty() && $width->isNotEmpty() && $depth->isNotEmpty()) : ?>
                        <figcaption class=""><?= $height ?>×<?= $width ?>×<?= $depth ?> mm (<?= round($height->toInt() * $inch, 1) ?>×<?= round($width->toInt() * $inch, 1) ?>×<?= round($depth->toInt() * $inch, 1) ?> in) </figcaption>

                    <?php elseif ($height->isNotEmpty() && $width->isNotEmpty()) : ?>
                        <figcaption class=""><?= $height ?>×<?= $width ?> mm (<?= round($height->toInt() * $inch, 1) ?>×<?= round($width->toInt() * $inch, 1) ?> in)</figcaption>
                    <?php endif ?>

                </div>
            </li>
        <?php endforeach ?>
    </ul>
<?php endif ?>
<div class="mx-6 mt-12 mb-6">
    <div class="prose max-w-none mx-4 mt-6 leading-relaxed"><?= $page->text()->kirbytext() ?></div>
</div>
<div>
    <?php snippet('featured') ?>
</div>
</main>

<?php snippet('footer') ?>