<?php snippet('header') ?>
	<main>
        <div class="prose max-w-none mx-10 mb-10"> <?= $page->text()->kirbytext() ?>
        </div>
        <div class="prose max-w-none mx-10"> <?= $page->exhibitions()->kirbytext() ?>
        </div>
	</main>


<?php snippet('footer') ?>

