<?php snippet('header') ?>
    <main class="main">
        <?php if($success): ?>
        <div class="mx-10 alert success">
            <p><?= $success ?></p>
        </div>
        <?php else: ?>
        <?php if (isset($alert['error'])): ?>
            <div><?= $alert['error'] ?></div>
        <?php endif ?>
        <form class="mx-10" method="post" action="<?= $page->url() ?>">
            <div class="honeypot absolute -left-96">
                <label for="website">Website <abbr title="required">*</abbr></label>
                <input type="url" id="website" name="website" tabindex="-1">
            </div>
            <div class="field">
                <label for="name">
                    Name <abbr title="required">*</abbr>
                </label>
                <input class="w-full px-4 py-2 mt-4 mb-8 border rounded-sm focus:ring-0" type="text" id="name" name="name" value="<?= $data['name'] ?? '' ?>" required>
                <?= isset($alert['name']) ? '<span class="alert error">' . html($alert['name']) . '</span>' : '' ?>
            </div>
            <div class="field">
                <label for="email">
                    E-Mail <abbr title="required">*</abbr>
                </label>
                <input class="w-full px-4 py-2 my-4 border rounded-sm focus:ring-0" type="email" id="email" name="email" value="<?= $data['email'] ?? '' ?>" required>
                <?= isset($alert['email']) ? '<span class="alert error">' . html($alert['email']) . '</span>' : '' ?>
            </div>
            <div class="field">
                <label for="text">
                    Message <abbr title="required">*</abbr>
                </label>
                <textarea class="w-full h-48 px-4 py-2 my-4 border rounded-sm focus:ring-0" id="text" name="text" required><?= $data['text']?? '' ?></textarea>
                <?= isset($alert['text']) ? '<span class="alert error">' . html($alert['text']) . '</span>' : '' ?>
            </div>
            <input class="bg-black text-white p-2" type="submit" name="submit" value="Submit">
        </form>
        <?php endif ?>
    </main>

<?php snippet('footer') ?>