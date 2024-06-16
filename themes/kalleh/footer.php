</main>
<?php if (!is_page_template('login.php')): ?>
    <footer class="bg-dark bg-opacity-10 text-center py-2 mt-3">
        <?php
        get_template_part('template-parts/global/site_logo');
        ?>
    </footer>
<?php
endif;
wp_footer(); ?>
</body>
</html>
