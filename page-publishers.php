<?php
/**
*Template Name: basic container + right card
 */
 

// Custom Fields
$main_content = get_field('main_content');
$media_item = get_field('media_item');

get_header(); ?>
<?php if(has_post_thumbnail()) : ?>
<div class="container">
        <div class="jumbotron-smaller" style="background-image: url(<?php the_post_thumbnail_url(); ?>); background-position: center;">
        </div>        
</div>
      <?php endif; ?>
    
<div class="heading-div">
    <div class="container">
        <div class="row mb-0 py-3">
            <div class="col-7">
                <h1><b><?php wp_title(''); ?></b></h1>
            </div>
            <div class="col">
                <h3><b></b></h3> 
            </div>
        </div>
    </div>
</div>
<div class="container pb-5">
    <div class="row">
        <div class="col-md-7">   
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
            echo $main_content; 
            endwhile; else: ?>
            <p>Sorry, no posts matched your criteria.</p>
            <?php endif; ?>
        </div>
        <div class="col-md mx-0">
        <div class="card" id="speakers">
                <img class="card-img-top" src="<?php bloginfo('stylesheet_directory'); ?>/assets/cards/books.jpeg" alt="Guests">
                <div class="card-body flex-vert">
                    <p class="card-text">Are you a publisher and/or do you wish to contribute to the Book Fair? Please contact us.</p>
                    <a href="#" class="btn btn-dark btn-zoom mt-auto">Get in touch <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
get_footer();
?>
