<?php
$logo = get_field('siteLogo', 'option');
?>
<a href="<?= home_url() ?>" aria-label="back to home page">
    <img class="img-fluid object-fit-contain" width="100" height="100" src="<?= $logo['url'] ?? ''; ?>"
         alt="<?= $logo['title'] ?? ''; ?>">
</a>