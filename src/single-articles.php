<?php
/**
 * The template for displaying all state posts
 *
 *Template Name:ArticlesByState Template
 *Template Post Type: articlesbystate
 *
 * @package roads
 */

get_header();


?>

	<main id="primary" class="site-main">
        <?php 
        $state = explode( '/',$_SERVER['REQUEST_URI'])[2];

        ?>
        <section class="fc_hero" style="background:url(<?php echo get_field( 'flexible_content', 150)[0]['background_image']['sizes']['large'] ?>)no-repeat center; background-size:cover;">
            <div class="content-container">
                <div class="left">
                    
                    <h4 class="eyebrows"><?php echo get_field( 'flexible_content', 150)[0]['decorative_text'] ?></h4>
                    <h1 class="title large-text"><?php echo get_field( 'flexible_content', 150)[0]['title'] ?></h1>
                    <p class="description large-text"><?php echo get_field( 'flexible_content', 150)[0]['description'] ?></p>

                    <div class="cta-container"></div>
                </div>
            </div>
        </section>
        <section class="fc_media_inquiry" style="background:url(<?php echo get_field( 'flexible_content', 150)[1]['background']['sizes']['large'] ?>)no-repeat center;background-size:cover;">
            <div class="content-container">
                <h2 class="title"><?php echo get_field( 'flexible_content', 150)[1]['header_text'] ?></h2>
                <a href="<?php echo get_field( 'flexible_content', 150)[1]['ctas'][0]['url'] ?>" class="cta pill red"><span><?php echo get_field( 'flexible_content', 150)[1]['ctas'][0]['display_text'] ?></span></a>
            </div>
        </section>
        <section class="fc_press_article_list">
            <div class="content-container">
                <div class="dropdown">
                    <p class="label">Filter by:</p>
                    <?php
                        get_template_part( 'template-parts/states-dropdown' );
                    ?>
                </div>

                <div class="article-items">
                <?php 
                $query = new WP_Query(array(
                    'post_type'			=> 'article',
                    'post_status'		=> 'publish',
                    'posts_per_page'	=> -1
                ));

                if ( $query->have_posts() ) {

                    while ( $query->have_posts() ) { 
                        $query->the_post();

                        // Check if applied to this state
                        $statesCheck = get_field('applied_states');

                        for($s = 0; $s < count($statesCheck); $s++){
                            if( $statesCheck[$s] === $state || $state === false ){

                                $item_id = get_the_id();

                                $raw_post = get_post($item_id)->post_date;


                                // DATE FORMATTING
                                $date = DateTime::createFromFormat('Y-m-d H:i:s', get_post($item_id)->post_date);
                                $formattedDate = $date->format('m/d/Y');

                    ?>
                    <a href="<?php echo get_field('url'); ?>" target="_blank" class="article-item">
                        <p class="publisher"><?php echo get_field('publisher'); ?></p>
                        <h1 class="title"><?php echo get_field('title'); ?></h1>
                        <p class="date"><?php echo $formattedDate; ?></p>
                        <p class="cta"><span>Read More on USTravel.com</span></p>
                    </a>
                    <?php
                            }
                        }
                    }
                }
                ?>
                </div>
                <?php
                wp_reset_postdata();

                ?>
            </div>

			<div class="pagination"></div>
        </section>

	</main><!-- #main -->

<?php
get_footer();
