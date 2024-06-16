<?php $sliders = get_field(is_user_logged_in() ? 'slider_logged_in' : 'slider_not_logged_in'); ?>
<section class="swiper hero_slider <?= is_user_logged_in() ? 'slider_logged_in' : 'slider'; ?>" data-aos="zoom-in" data-aos-delay="200">
    <div class="swiper-wrapper hero">
        <?php
        if ($sliders) :
            $i = 1;
            foreach ($sliders as $slider) : ?>
                <div class="swiper-slide h-auto position-relative text-center">
                    <?php if ($slider['slide_type'] == 'image') : ?>
                        <img class="object-fit-cover w-100 h-100" src="<?= $slider['image']['url'] ?? ''; ?>"
                             alt="<?= $slider['image']['title'] ?? ''; ?>">
                    <?php elseif ($slider['slide_type'] == 'video') : ?>
                        <video autoplay controls='false' class="object-fit-cover w-100 h-100"
                               src="<?= $slider['video'] ?? ''; ?>"></video>
                    <?php elseif ($slider['slide_type'] == 'embed') : ?>
                        <div class="h-100"><?= $slider['embed'] ?? ''; ?></div>
                    <?php endif; ?>
                </div>
                <?php
                $i++;
            endforeach;
        endif; ?>
    </div>
</section>