<?php /* Template Name: game box */
get_header(); ?>
<style>
    .flip-card {
        background-color: transparent;
        perspective: 1000px;
        cursor: pointer;
    }
    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.6s;
        transform-style: preserve-3d;
    }
    .flip-card.flipped .flip-card-inner {
        transform: rotateY(180deg);
    }
    .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    .flip-card-back {
        color: white;
        transform: rotateY(180deg);
    }
    .box-container {
        max-width: 700px;
    }
</style>
<section class="container">
    <div class="box-container mx-auto row row-cols-3 align-items-center justify-content-center">
        <?php
        $gifts = get_field('gifts');
        $i = 1;
        foreach ($gifts as $gift) { ?>
            <div class="flip-card ratio-1 bg-primary border border-white" onclick="this.classList.toggle('flipped');">
                <div class="flip-card-inner ">
                    <div class="flip-card-front d-flex align-items-center justify-content-center display-1 text-white">
                        <?= $i; ?>
                    </div>
                    <div class="flip-card-back d-flex align-items-center justify-content-center display-4 text-white">
                        <?= $gift['gift'] ?>
                    </div>
                </div>
            </div>
            <?php
            $i++;
        }
        ?>
    </div>
</section>

<?php
get_footer();
?>
