<?php
/**
*Template Name: Speakers list
 */

// Custom Fields

get_header(); ?>

<div class="heading-div">
    <div class="container">
    <h1 class="mb-0 py-3"><b><?php wp_title(''); ?></b></h1>
    </div>
</div>
<div class="container">
    <?php
        $args=array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 50,
			'orderby'=> 'title', 
			'order' => 'ASC'
        );

        $my_query = null;
        $my_query = new WP_Query($args);

        if( $my_query->have_posts() ) {

        $i = 0;
        while ($my_query->have_posts()) : $my_query->the_post();
        // modified to work with 4 columns
        // output an open <div>
        if($i % 4 == 0) { 
    ?> 

    <div class="row">

    <?php
    }
    ?>

    <div class="col-sm-6 col-md mb-4">
    <a class="a-card" href="<?php the_permalink(); ?>">
        <div class="animated fadeIn card speaker-card">
            <img class="card-speaker-img-top img-speaker-card" src="<?php the_post_thumbnail_url(); ?>" alt="Card image cap">
        <div class="card-body py-3 ">
            <h5 class="card-title text-center mb-0"><b><?php the_title(); ?></b></h5>
        </div>
        </div>
        </a>
    </div>  
    <?php $i++; 
    if($i != 0 && $i % 4 == 0) { ?>
    </div><!--/.row-->
    <div class="clearfix"></div>

    <?php
    } ?>

    <?php  
    endwhile;
    }
    wp_reset_query();
    ?>
</div>
</div>
<?php
get_footer();
?>
