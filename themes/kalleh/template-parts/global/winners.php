<?php
$winners = get_field('winner_list');
if ($winners): ?>
    <section class="bg-secondary text-white p-lg-5 p-3">
        <div class="container bg-white winners-row py-4 px-0 rounded-3">

            <ul class="nav nav-tabs gap-1 px-3 flex-column flex-md-row border-0 pb-1 justify-content-center" id="myTab"
                role="tablist">
                <?php
                $i = 1;
                foreach ($winners as $winner): ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link w-100 rounded-1 <?= $i == 1 ? 'active' : ''; ?>"
                                id="tab-<?= $i; ?>" data-bs-toggle="tab"
                                data-bs-target="#tab-pane-<?= $i; ?>"
                                type="button" role="tab" aria-controls="tab-pane-<?= $i; ?>"
                                aria-selected="<?= $i == 1 ? 'true' : 'false'; ?>"><?= esc_html($winner['tab-name']); ?></button>
                    </li>
                    <?php
                    $i++;
                endforeach; ?>
            </ul>
            <div class="tab-content px-lg-4" id="myTabContent">
                <?php
                $j = 1;
                foreach ($winners as $winner): ?>
                    <div class="tab-pane px-2 px-sm-4 px-lg-0 fade <?= $j == 1 ? 'show active' : ''; ?>"
                         id="tab-pane-<?= $j; ?>" role="tabpanel" aria-labelledby="tab-<?= $j; ?>"
                         tabindex="0">
                        <?= do_shortcode($winner['winner_list']); ?>
                    </div>
                    <?php
                    $j++;
                endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
