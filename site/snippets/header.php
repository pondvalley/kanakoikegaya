<?php
?>

<!doctype html>
<html lang='jp'>

<head>
  <meta charset="UTF-8">
  <meta name="description" content="<?= $site->description() ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?= $site->title() ?> | <?= $page->title() ?>
  </title>
  <?= css(['assets/css/style.css', '@auto']) ?>
  <?= css($page->files()->filterBy('extension', 'css')->pluck('url')) ?>
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/hooper@0.2.1/dist/hooper.css">
  <script src="https://cdn.jsdelivr.net/npm/hooper@0.2.1/dist/hooper.min.js"></script>
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-JLJHYX1TYG"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-JLJHYX1TYG');
</script>

</head>

<body class="font-sans relative tracking-wide font-light">
  <header id="navigation" class="fixed top-0 z-50 w-full">
    <div :class="{'transform -translate-y-20': !showNavbar}" class="p-4 transform translate-y-0 duration-150 bg-white">
      <div class="flex flex-wrap justify-between">
        <a class="text-xl tracking-widest ml-2 flex items-center" href="<?= $site->url() ?>"><?= $site->title() ?></a>
        <button class="mr-2 focus:outline-none" type="button" @click="toggleMenu()">
          <div :class="{'transform rotate-45 translate-y-1.25': showMenu}" class="bg-black h-0.5 w-8 m-2"></div>
          <div :class="{'transform -rotate-45 -translate-y-1.25': showMenu}" class="bg-black h-0.5 w-8 m-2"></div>
        </button>
      </div>
      <div :class="{'hidden': !showMenu, 'flex': showMenu}" class="items-center">
        <?php $menu = $site->mainMenu()->toPages(); ?>
        <?php if ($menu->isNotEmpty()) : ?>
          <nav class="flex flex-col list-none m-4">
            <ul>
              <?php foreach ($menu as $menuItem) : ?>
                <li class="my-4"><a href="<?= $menuItem->url() ?>"><?= $menuItem->title() ?></a></li>
              <?php endforeach ?>
            </ul>
          </nav>
        <?php endif ?>
      </div>
    </div>
  </header>
  <?= js('assets/js/navBar.js') ?>
  <div class="min-h-screen relative pb-20">
    <div class="w-full h-20"></div>