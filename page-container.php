<?php
/*
    Template Name: Page container
    
*/

get_header(); ?>
 
<main> 

    <div class="heading-div">
        <div class="container">
            <h1 class="mb-0 py-3"><b><?php wp_title(''); ?></b></h1>
        </div>
    </div>

    <div class="container pb-3">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
        the_content();
        endwhile; else: ?>
        <p>Sorry, no posts matched your criteria.</p>
        <?php endif; ?>
    </div>

</main>

    <?php
get_footer();
