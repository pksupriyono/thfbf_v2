<?php
/**
*Template Name: basic container + right item
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
            <div class="col-md-7">
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
        <div class="col mx-0">
            <?php echo $media_item; ?>
            
        </div>
    </div>
</div>
</div>

<?php
get_footer();
?>
