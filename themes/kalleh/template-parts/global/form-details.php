<?php
$formDetails = get_field('form_details');
if ($formDetails):
    ?>
    <section class="container py-4">
        <article>
            <?= $formDetails; ?>
        </article>
    </section>
<?php endif; ?>