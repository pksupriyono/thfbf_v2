<?php
/**
*Template Name: Speaker (bottom)
 * Template Post Type: post, page, product
 */
 

// Custom Fields
$bio = get_field('bio');
$latest_work_header = get_field('latest_work_header');
$latest_work = get_field('latest_work');

get_header(); ?>
<?php if(has_post_thumbnail()) : ?>
<div class="container">
        <div class="jumbotron" style="background-image: url(<?php the_post_thumbnail_url(); ?>); background-position: bottom;">
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
                <h3><b><?php echo $latest_work_header; ?></b></h3> 
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row pb-5">
        <div class="col-md-7">   
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
            echo $bio; 
            endwhile; else: ?>
            <p>Sorry, no posts matched your criteria.</p>
            <?php endif; ?>
        </div>
        <div class="col mx-0">
            <?php echo $latest_work; ?>
            
        </div>
    </div>
</div>
</div>

<?php
get_footer();
?>
