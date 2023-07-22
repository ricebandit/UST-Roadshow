<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package roads
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();

			// Event Type class
			$evt_class = get_field('event_type');
			$evt_class = strtolower($evt_class);
			$evt_class = str_replace(' ', '', $evt_class);

			// Event Date
			$date = DateTime::createFromFormat('Y-m-d H:i:s', get_field('start_date'));
			$formattedDate = $date->format('m/d/Y');

		?>
		<section id="header" style="background:url(<?php echo get_field("background")['url'] ?>)no-repeat center; background-size:cover;">
			<div class="content-container">
				<div class="left">
					<a href="/state/<?php echo get_field('state')['value'] ?>" class="back">Back to <?php echo get_field('state')['label'] ?></a>
					<div class="event-type <?php echo $evt_class ?>">
						<div class="info">
							<p class="type"><?php echo get_field('event_type'); ?></p>
							<p class="date"><?php echo $formattedDate; ?></p>
						</div>
					</div>
					<h1 class="title"><?php echo get_field('event_basics')['title']; ?></h1>
					<p class="description"><?php echo get_field('short_description'); ?></p>
				</div>
				<div class="right">
					<div class="event-carousel">

						<div class="slide-collection">
							
						<?php
							$event_previews = get_field('event_basics')['event_images'];

							for($i = 0; $i < count($event_previews); $i++){
								$preview = $event_previews[$i];

								$img_class = 'image';
								if($preview['media_type'] === 'video'){
									$img_class = 'video';

									$url = $preview['video_id']; 

                                    if( str_contains( $url, 'youtube') ){
                                        $classes = 'youtube-popup';
                                    }elseif( str_contains( $url, 'vimeo') ){
                                        $classes = 'vimeo-popup';
                                    }
						?>
						<div class="slide <?php echo $img_class; ?>" style="background:url(<?php echo $preview['image']['sizes']['medium_large'] ?>)no-repeat center;background-size:cover;">
							<a href="<?php echo $url ?>" class="cta script <?php echo $classes ?>"><span>Watch Full Video</span><div class="arrow"><div class="icon"><div class="loop"></div><div class="whole"></div></div></div></a>
						</div>

						<?php
								}else{
						?>
						<div class="slide <?php echo $img_class; ?>" style="background:url(<?php echo $preview['image']['sizes']['medium_large'] ?>)no-repeat center;background-size:cover;"></div>

						<?php
								}
						?>
						<?php } ?>
						</div>
						
						<div class="subnav">
							<div class="arrow prev">
								<div class="idle" style="background:url(/wp-content/uploads/2023/07/carousel-arrow-blue.png)no-repeat center;background-size:cover;"></div>
								<div class="over" style="background:url(/wp-content/uploads/2023/07/carousel-arrow-hover-blue.png)no-repeat center;background-size:cover;"></div>
							</div>
							<div class="dots"></div>
							<div class="arrow next">
								<div class="idle" style="background:url(/wp-content/uploads/2023/07/carousel-arrow-blue.png)no-repeat center;background-size:cover;"></div>
								<div class="over" style="background:url(/wp-content/uploads/2023/07/carousel-arrow-hover-blue.png)no-repeat center;background-size:cover;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php
		endwhile; // End of the loop.
		?>

		<?php
		get_template_part( 'template-parts/flexible-content' );
		get_template_part( 'template-parts/fc-join' ); 
		?>
	</main><!-- #main -->

<?php
get_footer();
