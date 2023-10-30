<?php
/* -----------------------------------
 * CONVERT STATE NAMES!
 * Goes both ways. e.g.
 * $name = 'Oregon' -> returns "OR"
 * $name = 'OR' -> returns "Oregon"
 * ----------------------------------- */
function convertState($name) {

	$name = str_replace("-", " ", $name['value']);

	$states = array(
	   array('name'=>'Alabama', 'abbr'=>'AL'),
	   array('name'=>'Alaska', 'abbr'=>'AK'),
	   array('name'=>'Arizona', 'abbr'=>'AZ'),
	   array('name'=>'Arkansas', 'abbr'=>'AR'),
	   array('name'=>'California', 'abbr'=>'CA'),
	   array('name'=>'Colorado', 'abbr'=>'CO'),
	   array('name'=>'Connecticut', 'abbr'=>'CT'),
	   array('name'=>'District of Columbia', 'abbr' => 'DC'),
	   array('name'=>'Delaware', 'abbr'=>'DE'),
	   array('name'=>'Florida', 'abbr'=>'FL'),
	   array('name'=>'Georgia', 'abbr'=>'GA'),
	   array('name'=>'Hawaii', 'abbr'=>'HI'),
	   array('name'=>'Idaho', 'abbr'=>'ID'),
	   array('name'=>'Illinois', 'abbr'=>'IL'),
	   array('name'=>'Indiana', 'abbr'=>'IN'),
	   array('name'=>'Iowa', 'abbr'=>'IA'),
	   array('name'=>'Kansas', 'abbr'=>'KS'),
	   array('name'=>'Kentucky', 'abbr'=>'KY'),
	   array('name'=>'Louisiana', 'abbr'=>'LA'),
	   array('name'=>'Maine', 'abbr'=>'ME'),
	   array('name'=>'Maryland', 'abbr'=>'MD'),
	   array('name'=>'Massachusetts', 'abbr'=>'MA'),
	   array('name'=>'Michigan', 'abbr'=>'MI'),
	   array('name'=>'Minnesota', 'abbr'=>'MN'),
	   array('name'=>'Mississippi', 'abbr'=>'MS'),
	   array('name'=>'Missouri', 'abbr'=>'MO'),
	   array('name'=>'Montana', 'abbr'=>'MT'),
	   array('name'=>'Nebraska', 'abbr'=>'NE'),
	   array('name'=>'Nevada', 'abbr'=>'NV'),
	   array('name'=>'New Hampshire', 'abbr'=>'NH'),
	   array('name'=>'New Jersey', 'abbr'=>'NJ'),
	   array('name'=>'New Mexico', 'abbr'=>'NM'),
	   array('name'=>'New York', 'abbr'=>'NY'),
	   array('name'=>'North Carolina', 'abbr'=>'NC'),
	   array('name'=>'North Dakota', 'abbr'=>'ND'),
	   array('name'=>'Ohio', 'abbr'=>'OH'),
	   array('name'=>'Oklahoma', 'abbr'=>'OK'),
	   array('name'=>'Oregon', 'abbr'=>'OR'),
	   array('name'=>'Pennsylvania', 'abbr'=>'PA'),
	   array('name'=>'Rhode Island', 'abbr'=>'RI'),
	   array('name'=>'South Carolina', 'abbr'=>'SC'),
	   array('name'=>'South Dakota', 'abbr'=>'SD'),
	   array('name'=>'Tennessee', 'abbr'=>'TN'),
	   array('name'=>'Texas', 'abbr'=>'TX'),
	   array('name'=>'Utah', 'abbr'=>'UT'),
	   array('name'=>'Vermont', 'abbr'=>'VT'),
	   array('name'=>'Virginia', 'abbr'=>'VA'),
	   array('name'=>'Washington', 'abbr'=>'WA'),
	   array('name'=>'West Virginia', 'abbr'=>'WV'),
	   array('name'=>'Wisconsin', 'abbr'=>'WI'),
	   array('name'=>'Wyoming', 'abbr'=>'WY'),
	   array('name'=>'Virgin Islands', 'abbr'=>'V.I.'),
	   array('name'=>'Guam', 'abbr'=>'GU'),
	   array('name'=>'Puerto Rico', 'abbr'=>'PR')
	);
 
	$return = false;   
	$strlen = strlen($name);
 
	foreach ($states as $state) :
	   if ($strlen < 2) {
		  return false;
	   } else if ($strlen == 2) {
		  if (strtolower($state['abbr']) == strtolower($name)) {
			 $return = $state['name'];
			 break;
		  }   
	   } else {
		  if (strtolower($state['name']) == strtolower($name)) {
			 $return = strtoupper($state['abbr']);
			 break;
		  }         
	   }
	endforeach;
	
	return $return;
 } // end function convertState()

        // SET GEOGRAPHIC STATE
        $currentState = false;
        $selected = '';
        if(get_field('state')['value']){
            $currentState = get_field('state')['label'];
        }
        

		if(have_rows('flexible_content')){
			while( have_rows('flexible_content') ) : the_row();
		?>

		<?php 
		/*
		TEMPLATE
		*/
		if(get_row_layout() === 'template'){?>
			<section class="fc_template_name"></section>
		<?php } // template ?>


		<?php 
		/*
		HERO
		*/
		if(get_row_layout() === 'hero'){
            ?>
			<section class="fc_hero" style="background:url(<?php echo get_sub_field('background_image')['url'] ?>)no-repeat center; background-size:cover;">
				<div class="content-container">
					<div class="left">
                        <?php if(get_sub_field('back_button')){ ?>
                            <a href="<?php echo get_sub_field('back_url') ?>" class="back"><?php echo get_sub_field('back_button_text') ?></a>
                        <?php } ?>

                        <h4 class="eyebrows"><?php echo get_sub_field('decorative_text') ?></h4>
                        <h1 class="title large-text"><?php echo get_sub_field('title') ?></h1>
                        <div class="description large-text"><?php echo get_sub_field('description') ?></div>

                        <div class="cta-container">
                        <?php

                        $ctas = get_sub_field('ctas');

						if($ctas){
							

							foreach($ctas as $cta){

								$url = $cta['url'];
								$classes = '';

								if( $cta['link_type']['value'] == 'video' ){ 
									$url = $cta['video_code'];
									if( str_contains( $url, 'youtube') ){
										$classes = 'youtube-popup';
									}elseif( str_contains( $url, 'vimeo') ){
										$classes = 'vimeo-popup';
									}

									
								}

								$targetwindow = '_self';

								if( $cta['external_link'] === true ){
									$targetwindow = '_blank';
								}
                        ?>

							<?php if($cta['cta_type']['value'] == 'pill') { ?>
								<a class="cta pill red" href="<?php echo $url ?>" target="<?php echo $targetwindow ?>" data-type="<?php echo $cta['link_type']['value'] ?>"><span><?php echo $cta['display_text'] ?></span></a>
							<?php }else if($cta['cta_type']['value'] == 'script'){ ?>
								<a class="cta script <?php echo $classes ?>" href="<?php echo $url ?>" target="<?php echo $targetwindow ?>" data-type="<?php echo $cta['link_type']['value'] ?>"><span><?php echo $cta['display_text'] ?></span><div class="arrow"><div class="icon"><div class="loop"></div><div class="whole"></div></div></div></a>
							<?php }else if($cta['cta_type'] == 'clearpill'){ ?>
								<a class="cta clearpill" href="<?php echo $url ?>" target="<?php echo $targetwindow ?>" data-type="<?php echo $cta['link_type'] ?>"><?php echo $cta['display_text'] ?></a>
							<?php } ?>

                        <?php
							}
						}
                        ?>
                        </div>
					</div>
				</div>
			</section>
		<?php } // hero ?>



		<?php 
		/*
		BLOG HERO
		*/
		if(get_row_layout() === 'blog_hero'){?>
			<section class="fc_blog_hero" style="background: linear-gradient(to bottom,  #000000 0%,<?php echo get_sub_field('background_color'); ?> 100%);">
				<div class="content-container">
					<?php if(get_sub_field('back_button')){ ?>
                            <a href="<?php echo get_sub_field('back_url') ?>" class="back"><?php echo get_sub_field('back_button_text') ?></a>
                    <?php } ?>

					<div class="half left">
					<?php if(get_sub_field('back_button')){ ?>
                            <a href="<?php echo get_sub_field('back_url') ?>" class="back"><?php echo get_sub_field('back_button_text') ?></a>
                    <?php } ?>

					<div class="title"><h1><?php echo get_sub_field('title'); ?></h1></div>

					<div class="date"><?php echo get_the_date() ?></div>
					</div>
					<div class="half right">
						<div class="img-container" style="background:#003055;">
							<div class="img" style="background:url(<?php echo get_sub_field('image'); ?>)no-repeat center;background-size:cover;"></div>
						</div>
					</div>
				</div>
			</section>
		<?php } // template ?>



		<?php 
		/*
		HERO CAROUSEL
		*/
		if(get_row_layout() === 'hero_carousel'){
			?>
			<section class="fc_hero_carousel">
				<div class="carousel">
			<?php
			$panels = get_sub_field('panel');

			foreach($panels as $panel){
			?>
				<div class="panel">
					<div class="background" style="background:url(<?php echo $panel['background_image'] ?>)no-repeat center; background-size:cover;"></div>

					<div class="content-container">
						<div class="half left">
							<h1 class="header large-text"><?php echo $panel['headline'] ?></h1>
							<div class="description large-text"><?php echo $panel['description'] ?></div>

                            <div class="cta-container">
							<?php
							
							$ctas = $panel['ctas'];

                            if( $ctas ){

                                foreach($ctas as $cta){

                                    $url = $cta['url'];
                                    $classes = '';

                                    if( $cta['link_type']['value'] == 'video' ){ 
                                        $url = $cta['video_code'];

                                        if( str_contains( $url, 'youtube') ){
                                            $classes = 'youtube-popup';
                                        }elseif( str_contains( $url, 'vimeo') ){
                                            $classes = 'vimeo-popup';
                                        }
                                    }

									$targetwindow = '_self';
	
									if( $cta['external_link'] === true ){
										$targetwindow = '_blank';
									}
                                ?>

                                <?php if($cta['cta_type']['value'] == 'pill') { ?>
                                    <a class="cta pill red" href="<?php echo $url ?>" target="<?php echo $targetwindow ?>" data-type="<?php echo $cta['link_type']['value'] ?>"><span><?php echo $cta['display_text'] ?></span></a>
                                <?php }else if($cta['cta_type']['value'] == 'script'){ ?>
                                <a class="cta script <?php echo $classes ?>" href="<?php echo $url ?>" target="<?php echo $targetwindow ?>" data-type="<?php echo $cta['link_type']['value'] ?>"><span><?php echo $cta['display_text'] ?></span><div class="arrow"><div class="icon"><div class="loop"></div><div class="whole"></div></div></div></a>
                                <?php }else if($cta['cta_type'] == 'clearpill'){ ?>
                                    <a class="cta clearpill" href="<?php echo $url ?>" target="<?php echo $targetwindow ?>" data-type="<?php echo $cta['link_type'] ?>"><?php echo $cta['display_text'] ?></a>
                                <?php } ?>

                                <?php
                                }

                            }
                            ?>
							</div>

						</div>
						<div class="half right"></div>
					</div>
				</div>
			<?php
			}
			?>
				</div>

				<div class="subnav">
					<div class="arrow prev">
                        <div class="idle" style="background:url(/wp-content/uploads/2023/07/carousel-arrow.png)no-repeat center;background-size:cover;"></div>
                        <div class="over" style="background:url(/wp-content/uploads/2023/07/carousel-arrow-hover.png)no-repeat center;background-size:cover;"></div>
                    </div>
					<div class="dots"></div>
					<div class="arrow next">
                        <div class="idle" style="background:url(/wp-content/uploads/2023/07/carousel-arrow.png)no-repeat center;background-size:cover;"></div>
                        <div class="over" style="background:url(/wp-content/uploads/2023/07/carousel-arrow-hover.png)no-repeat center;background-size:cover;"></div>
                    </div>
				</div>
			</section>
		<?php } // hero carousel ?>

		<?php 
		/*
		GROUP BACKGROUND START
		*/
		if(get_row_layout() === 'group_background_start'){?>
			<div class="fc_group_background_start <?php echo get_sub_field('additional_style_classes') ?>" style="background:url(<?php echo get_sub_field('background_image'); ?>)no-repeat center; background-size:cover;">
		<?php } // group background start ?>

		<?php 
		/*
		GROUP BACKGROUND END
		*/
		if(get_row_layout() === 'group_background_end'){?>
			</div>
		<?php } // group background end ?>

		<?php
		/*
		HOME MAP
		*/
		if(get_row_layout() === 'home_map'){?>
			<section class="fc_home_map" <?php if(get_sub_field('background_image')){ ?>style="background:url(<?php echo get_sub_field('background_image') ?>)no-repeat center; background-size: cover;" <?php } ?>>
				<div class="content-container">
					<div class="header">
						<h1 class="title"><?php echo get_sub_field('title') ?></h1>

						<?php if(get_sub_field('description')){ ?>
						<p class='description'><?php echo get_sub_field('description') ?></p>
						<?php } ?>
					</div>

					<div class="map-container">
                        <div class="map-desktop" style="background:url(<?php echo get_sub_field('map_image') ?>)no-repeat center; background-size:contain;"></div>
                        <div class="map-mobile" style="background:url(<?php echo get_sub_field('map_image_mobile') ?>)no-repeat center; background-size:contain;"></div>
                    </div>
				</div>

			</section>
		<?php } // home map ?>

		<?php 
		/*
		CARDS TABLE
		*/
		if(get_row_layout() === 'cards_table'){?>
			<section class="fc_cards_table">
				<div class="content-container">
					<?php if(get_sub_field('decorative_text') || get_sub_field('title') || get_sub_field('description') ){ ?>
					<div class="header">
						<h4 class="eyebrows"><?php echo get_sub_field('decorative_text') ?></h4>
						<h1 class="title"><?php echo get_sub_field('title') ?></h1>
						<p class="description"><?php echo get_sub_field('description') ?></p>
					</div>
					<?php } ?>

					<div class="cards-collection">
						<?php 
						$deck = get_sub_field('card_deck');
						
						foreach($deck as $card){
							$urlClass = false;

							// If no url has been provided, add disabled class
							if( $card['cta_url'] ){
								$urlClass = '';
							}else{
								$urlClass = 'disabled';
							}

							$windowTarget = "_self";

							if( $card['external_link'] === true ){
								$windowTarget = "_blank";
							}
						?>
						<a class="card <?php echo $card['color_key'] ?> <?php echo $urlClass; ?>" href="<?php echo $card['cta_url'] ?>" target="<?php echo $windowTarget ?>">
							<div class="color-band"></div>
							<h2 class="title"><?php echo $card['title'] ?></h2>
							<div class="description"><?php echo $card['description'] ?></div>

                            <p class="cta-prop"><?php echo $card['cta_text'] ?></p>
						</a>
						<?php
						}
						?>
					</div>
				</div>
			</section>
		<?php } // cards table ?>

		<?php 
		/*
		4 STATS
		*/
		if(get_row_layout() === '4_stats'){
			$style = '';
			if( get_sub_field('background_image') ){
				$style = 'background:url(' . get_sub_field('background_image') . ')no-repeat center;background-size:cover;';
			}
		?>
			<section class="fc_4_stats" style="<?php echo $style; ?>">
				<div class="content-container">
					<div class="header">
						<h4 class="eyebrows"><?php echo get_sub_field('decorative_text') ?></h4>
						<?php
							$scribble = '';
							if( get_sub_field('title_scribble_decor') === true ){
								$scribble = 'scribble';
							}

						?>
						<h1 class="title <?php echo $scribble; ?>"><?php echo get_sub_field('title'); ?></h1>
						<p class="description"><?php echo get_sub_field('description') ?></p>
						
						<div class="ctas">

						<?php
							
							$ctas = get_sub_field('ctas');


							foreach($ctas as $cta){

								$url = $cta['url'];
                                $classes = '';
                            

								if( $cta['link_type']['value'] == 'video' ){ 
                                    $url = $cta['vimeo_video_id']; 
                                    
                                    if( str_contains( $url, 'youtube') ){
                                        $classes = 'youtube-popup';
                                    }elseif( str_contains( $url, 'vimeo') ){
                                        $classes = 'vimeo-popup';
                                    }
                                }

								$targetwindow = '_self';

								if( $cta['external_link'] === true ){
									$targetwindow = '_blank';
								}
							?>

							<?php if($cta['cta_type'] == 'pill') { ?>
								<a class="cta pill red <?php echo $cta['additional_classes'] ?>" href="<?php echo $url ?>" target="<?php echo $targetwindow ?>" data-type="<?php echo $cta['link_type']['value'] ?>"><span><?php echo $cta['display_text'] ?></span></a>
							<?php }else if($cta['cta_type'] == 'script'){ ?>
                            <a class="cta script <?php echo $classes ?>" href="<?php echo $url ?>" target="<?php echo $targetwindow ?>" data-type="<?php echo $cta['link_type']['value'] ?>"><span><?php echo $cta['display_text'] ?></span><div class="arrow"><div class="icon"><div class="loop"></div><div class="whole"></div></div></div></a>
							<?php }else if($cta['cta_type'] == 'clearpill'){  ?>
								<a class="cta clearpill <?php echo $cta['additional_classes'] ?>" href="<?php echo $url ?>" target="<?php echo $targetwindow ?>" data-type="<?php echo $cta['link_type']['value'] ?>"><?php echo $cta['display_text'] ?></a>
							<?php } ?>

							<?php
							}
							?>
						</div>
					</div>
					<div class="stat-container">
							<?php
								$stats = get_sub_field('stats');
								foreach($stats as $stat){
							?>
								<div class="stat">
									<p><?php echo $stat['action_text'] ?></p>
									<h1 class="stat-number"><?php echo $stat['number'] ?></h1>

                                    <div class="property-container">
                                        <?php
											if($stat['label']){
												for($p = 0; $p < count($stat['label']); $p++ ){
													$text = $stat['label'][$p]['text_line'];
										?>
													<h1 class="property"><?php echo $text ?></h1>
                                        <?php   
												}
											}
									    ?>
                                    </div>
								</div>
                                <div class="line"></div>
							<?php
								}
							?>
					</div>
				</div>
			</section>
		<?php } // 4 stats ?>












		<?php 
		/*
		ADDITIONAL ARTICLES NEW
		*/
		if(get_row_layout() === 'additional_articles'){?>
		<section class="fc_additional_articles">
			<div class="content-container">

				<div class="header">
					<div class="title"><?php echo get_sub_field('decorative_text'); ?></div>
				</div>

				<div class="article-items <?php if( count(get_sub_field('articles') ) == 1 ){ echo 'single'; }?>">
					<?php
					
					if(get_sub_field('articles')){  ?>

						<div class="half left">
						<?php
							$col_amt_1 = 3;
							$col_amt_2 = 3;
							$item_max = 6;

							if( count(get_sub_field('articles')) < 6){
								$item_max = count( get_sub_field('articles') );
								$col_amt_1 = ceil( $item_max / 2);

								$col_amt_2 = $item_max - $col_amt_1;
							}

							for($i = 0; $i < $col_amt_1; $i++){
								$item = get_sub_field('articles')[$i]['article'];
								$item_id = $item->ID;
	
								$raw_post = get_post($item_id);
	
								$rawdate = $raw_post->post_date;
	
	
								// DATE FORMATTING
								$date = DateTime::createFromFormat('Y-m-d H:i:s', $rawdate);
								$formattedDate = $date->format('m/d/Y');
	
								if($i < $col_amt_1 || get_sub_field('mode') === 'total_list'){
									
							?>
							<a href="<?php echo get_field('url', $item_id); ?>" target="_blank" class="article-item">
								<div class="info-container">
									<p class="date"><?php echo get_field('publisher', $item_id); ?> | <?php echo $formattedDate; ?></p>
									<h1 class="title"><?php echo $raw_post->post_title; ?></h1>
								</div>
							</a>
							<?php
								}
	
							} 
						?>
						</div>
	
	
	
						<div class="half right">
						<?php
							for($i = $col_amt_1; $i < $item_max; $i++){
								$item = get_sub_field('articles')[$i]['article'];
								$item_id = $item->ID;
	
								$raw_post = get_post($item_id);
	
								$rawdate = $raw_post->post_date;
	
	
								// DATE FORMATTING
								$date = DateTime::createFromFormat('Y-m-d H:i:s', $rawdate);
								$formattedDate = $date->format('m/d/Y');
	
								if($index < 5){
									
							?>
							<a href="<?php echo get_field('url', $item_id); ?>" target="_blank" class="article-item">
								<div class="info-container">
									<p class="date"><?php echo get_field('publisher', $item_id); ?> | <?php echo $formattedDate; ?></p>
									<h1 class="title"><?php echo $raw_post->post_title; ?></h1>
								</div>
							</a>
							<?php
								}
	
							} 
						?>
						</div>

					<?php }else{

						$query = new WP_Query(array(
							'post_type'			=> 'article',
							'post_status'		=> 'publish',
							'posts_per_page'	=> -1
						));

						if ( $query->have_posts() ) {
							$index = 0;	
							
							
							
							
							
							
							
							while ( $query->have_posts() ) { 
								$query->the_post();
								$item_id = get_the_id();

								$raw_post = get_post($item_id);


								// DATE FORMATTING
								$date = DateTime::createFromFormat('Y-m-d H:i:s', get_post($item_id)->post_date);
								$formattedDate = $date->format('m/d/Y');

								if($index < 6){

									if($index == 0){
									?>
									<div class="half left">
									<?php
									}
							?>

							<a href="<?php echo get_field('url', $item_id); ?>" target="_blank" class="article-item">
								<div class="info-container">
									<p class="date"><?php echo get_field('publisher', $item_id); ?> | <?php echo $formattedDate; ?></p>
									<h1 class="title"><?php echo $raw_post->post_title; ?></h1>
								</div>
							</a>
							<?php

									if($index == 2){
										?>
										</div>
										<div class="half right">
										<?php
									}elseif($index == 5){
										?>
										</div>
										<?php
									}
								}

								$index++;
							}
							
						}

						
					} ?>
					<?php
					wp_reset_postdata();

					?>
                
					
				</div>
			</div>
		</section>
		<?php } ?>


		<?php 
		/*
		NEWS LIST (Nearly Identical to additional_articles, except for "mode" option). 
		This was necessary to accomodate the legacy additional_articles component when it got revised.
		*/
		if(get_row_layout() === 'news_list'){?>
			<section class="fc_news_list">

				<div class="content-container">

					<div class="header">
						<div class="title"><?php echo get_sub_field('title'); ?></div>
						<a href="<?php echo get_sub_field('cta_url'); ?>" class="cta pill red"><span><?php echo get_sub_field('cta_text'); ?></span></a>
					</div>

					<div class="article-items">
					<?php

					if(get_sub_field('articles')){  ?>

					<div class="half left">
					<?php
						for($i = 0; $i < 3; $i++){
							$item = get_sub_field('articles')[$i]['article'];
							$item_id = $item->ID;

							$raw_post = get_post($item_id);

							$rawdate = $raw_post->post_date;


							// DATE FORMATTING
							$date = DateTime::createFromFormat('Y-m-d H:i:s', $rawdate);
							$formattedDate = $date->format('m/d/Y');

							if($i < 3 || get_sub_field('mode') === 'total_list'){
								
						?>
						<a href="<?php echo get_field('url', $item_id); ?>" target="_blank" class="article-item">
							<div class="info-container">
								<p class="date"><?php echo get_field('publisher', $item_id); ?> | <?php echo $formattedDate; ?></p>
								<h1 class="title"><?php echo $raw_post->post_title; ?></h1>
							</div>
						</a>
						<?php
							}

						} 
					?>
					</div>



					<div class="half right">
					<?php
						for($i = 2; $i < 5; $i++){
							$item = get_sub_field('articles')[$i]['article'];
							$item_id = $item->ID;

							$raw_post = get_post($item_id);

							$rawdate = $raw_post->post_date;


							// DATE FORMATTING
							$date = DateTime::createFromFormat('Y-m-d H:i:s', $rawdate);
							$formattedDate = $date->format('m/d/Y');

							if($index < 5 || get_sub_field('mode') === 'total_list'){
								
						?>
						<a href="<?php echo get_field('url', $item_id); ?>" target="_blank" class="article-item">
							<div class="info-container">
								<p class="date"><?php echo get_field('publisher', $item_id); ?> | <?php echo $formattedDate; ?></p>
								<h1 class="title"><?php echo $raw_post->post_title; ?></h1>
							</div>
						</a>
						<?php
							}

						} 
					?>
					</div>
					<?php	
					}else{


						$query = new WP_Query(array(
							'post_type'			=> 'article',
							'post_status'		=> 'publish',
							'posts_per_page'	=> -1
						));

						if ( $query->have_posts() ) {

							$index = 0;

							while ( $query->have_posts() ) { 
								$query->the_post();
								$item_id = get_the_id();

								$raw_post = get_post($item_id);


								// DATE FORMATTING
								$date = DateTime::createFromFormat('Y-m-d H:i:s', get_post($item_id)->post_date);
								$formattedDate = $date->format('m/d/Y');

								if($index < 6 || get_sub_field('mode') === 'total_list'){

									if($index == 0){
									?>
									<div class="half left">
									<?php
									}
							?>

							<a href="<?php echo get_field('url', $item_id); ?>" target="_blank" class="article-item">
								<div class="info-container">
									<p class="date"><?php echo get_field('publisher', $item_id); ?> | <?php echo $formattedDate; ?></p>
									<h1 class="title"><?php echo $raw_post->post_title; ?></h1>
								</div>
							</a>
							<?php
								}

								if($index == 2){
									?>
									</div>
									<div class="half right">
									<?php
								}elseif($index == 5){
									?>
									</div>
									<?php
								}

								$index++;
							}
							
						}
					}
					?>
					</div>
					<?php
					wp_reset_postdata();

					?>







				</div>
			</section>
		<?php } // news list ?>



		<?php 
		/*
		JOIN
		*/
		if(get_row_layout() === 'join'){?>
            <?php get_template_part( 'template-parts/fc-join' ); ?>
		<?php } // join ?>

		<?php 
		/*
		PAST EVENTS
		*/
		if(get_row_layout() === 'past_events'){?>
			<section class="fc_past_events">
				<div class="content-container">
					<div class="header">
						<h1 class="title"><?php echo get_sub_field('title'); ?></h1>

						<?php if(get_sub_field('description')){ ?>
						<p class="description"><?php echo get_sub_field('description'); ?></p>
						<?php } ?>
					</div>

                    <?php 
                        $carouselClass = '';
                        if(get_sub_field('carousel') === true){
                            $carouselClass = 'carousel';
                        }
                    ?>

					<div class="schedule <?php echo $carouselClass; ?>">
						
					<?php

						$all_events = array();

						if( get_sub_field('past_events') ){

							$evts = get_sub_field('past_events');

							for($i = 0; $i < count($evts); $i++){

								$id = $evts[$i]['event']->ID;

	
								$all_events[$i]['permalink'] = get_permalink($id);
								$all_events[$i]['date'] = get_field('start_date', $id);
								$all_events[$i]['date-string'] = strtotime($all_events[$i]['date']);
								$all_events[$i]['past'] = get_field('event_basics', $id)['past'];
								$all_events[$i]['title'] = get_field('event_basics', $id)['title'];
								$all_events[$i]['event_images'] = get_field('event_basics', $id)['event_images'];
								$all_events[$i]['event_type'] = get_field('event_type', $id);
								$all_events[$i]['description'] = get_field('short_description', $id);
								$all_events[$i]['city'] = get_field('city', $id);
								$all_events[$i]['state'] = get_field('state', $id);
							}

						}else{
							$query = new WP_Query(array(
								'post_type'			=> 'event',
								'post_status'		=> 'publish',
								'posts_per_page'	=> -1,
								'nopaging'			=> true
							));
	
							if ( $query->have_posts() ) {
								$counter = 0;
	
								while ( $query->have_posts() ) {
									$query->the_post();
									
									$all_events[$counter]['permalink'] = get_permalink();
									$all_events[$counter]['date'] = get_field('start_date');
									$all_events[$counter]['date-string'] = strtotime($all_events[$counter]['date']);
									$all_events[$counter]['past'] = get_field('event_basics')['past'];
									$all_events[$counter]['title'] = get_field('event_basics')['title'];
									$all_events[$counter]['event_images'] = get_field('event_basics')['event_images'];
									$all_events[$counter]['event_type'] = get_field('event_type');
									$all_events[$counter]['description'] = get_field('short_description');
									$all_events[$counter]['city'] = get_field('city');
									$all_events[$counter]['state'] = get_field('state');
	
									$counter++;
								}

								usort($all_events, function($a, $b) {
									return $a['date-string'] - $b['date-string'];
								});

								$all_events = array_reverse($all_events);
	
							}

						}


						if( count($all_events) > 0 ){

							for($i = 0; $i < count($all_events); $i++){
								$event = $all_events[$i];
								$date = date_create( $event[ 'date' ]);
								$date_formatted = date_format($date, 'm/d/Y');

								if( $event['past']){
									if(!$currentState || $currentState === $event["state"]["label"]){
						?>
							<a href="<?php echo $event['permalink'] ?>" class="item <?php echo strtolower($event['event_type']) ?>">
								<div class="background" style="background:url(<?php echo $event['event_images'][0]['image']['sizes']['large'] ?>)no-repeat center;background-size:cover;"></div>
								<div class="info">
									<h1 class="location"><?php echo $event['city'] . ', ' . convertState( $event[ 'state' ] ) ?></h1>
									<p class="description"><?php echo $event['description'] ?></p>
									<div class="detail">
										<p class="date"><small><?php echo $date_formatted ?></small></p>
									</div>
								</div>
							</a>
						<?php
									}
								}
							}
						}
						?>

						</div>
                    <?php 
                        if(get_sub_field('carousel') !== true){
                    ?>
					<div class="cta-container">
						<a href="#" class="cta pill red"><span>SEE MORE</span></a>
					</div>
                    <?php }else{ ?>
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
                    <?php } ?>
					</div>

				<?php wp_reset_postdata(); ?>
			</section>

		<?php } // past events ?>

		<?php 
		/*
		UPCOMING EVENTS
		*/
		if(get_row_layout() === 'upcoming_events'){?>
			<section class="fc_upcoming_events">
				<div class="content-container">
					<div class="header">
						<h1 class="title"><?php echo get_sub_field('title'); ?></h1>
						<p class="description"><?php echo get_sub_field('description'); ?></p>
					</div>

					<div class="schedule">
						
					<?php
						$all_events = array();

						$query = new WP_Query(array(
							'post_type'			=> 'event',
							'post_status'		=> 'publish',
							'posts_per_page'	=> -1,
							'nopaging'			=> true
						));

						if ( $query->have_posts() ) {
							$counter = 0;

							while ( $query->have_posts() ) {
								$query->the_post();

								$all_events[$counter]['date'] = get_field('start_date');
								$all_events[$counter]['date-string'] = strtotime($all_events[$counter]['date']);
								$all_events[$counter]['past'] = get_field('event_basics')['past'];
								$all_events[$counter]['event_type'] = get_field('event_type');
								$all_events[$counter]['city'] = get_field('city');
								$all_events[$counter]['state'] = get_field('state');

								$counter++;
							}


						}

						if( count($all_events) > 0 ){

							usort($all_events, function($a, $b) {
								return $a['date-string'] - $b['date-string'];
							});

							for($i = 0; $i < count($all_events); $i++){
								$event = $all_events[$i];
								$date = date_create( $event[ 'date' ]);
								$date_formatted = date_format($date, 'm/d/Y');

								if(! $event['past']){
						?>
							<div class="item">
								<p class="location"><?php echo $event['city'] . ',&nbsp;' . convertState( $event[ 'state' ] ) ?></p>
								<p class="date"><?php echo $date_formatted ?></p>
							</div>
						<?php
								}
							}
						}
						?>

						</div>
					</div>

				<?php wp_reset_postdata(); ?>
			</section>

		<?php } // upcoming events ?>

		<?php 
		/*
		IMPACT DROPDOWN
		*/
		if(get_row_layout() === 'impact_dropdown'){?>
			<section class="fc_impact_dropdown xxx">

			<div class="content-container">
				<div class="left">
                    <h1 class="title"><?php echo get_field('states_title', 84); ?></h1>
                    <p class="description"><?php echo get_field('states_description', 84); ?></p>
				</div>

				<div class="right">
					<div class="dropdown">

					<?php
						get_template_part( 'template-parts/states-dropdown', null, array('showall' => true) );
					?>
					</div>

                    <div class="ctas">
                        <a href="#" class="cta pill red go-btn" data-id='states_dd'><span>GO</span><div class="arrow"></div></a>
                    </div>
				</div>
			</div>
			</section>

		<?php } // impact dropdown ?>

		<?php 
		/*
		IMAGE WEIGHTED
		*/
		if(get_row_layout() === 'image_weighted'){
			$jumplink = '';

			if( get_sub_field('jump_link_id') ){
				$jumplink = get_sub_field('jump_link_id');
			}

			$effects = 'no-effects';
			if(get_sub_field('back_image')){
				$effects = '';
			}

			?>
			<section class="fc_image_weighted <?php echo $effects; ?>" <?php if( get_sub_field('jump_link_id') ){ echo 'id="' . $jumplink . '"';} ?>>
				<div class="content-container <?php echo get_sub_field('sided') ?>-weighted">
					<div class="left">
						<?php
							if( get_sub_field('sided') === 'left'){
						?>
						<div class="img-container">
							<div class="background_bleed"></div>
							<div class="img-back" style='background:url(<?php echo get_sub_field('back_image') ?>)no-repeat center;background-size:cover;'></div>
							<div class="img-front" style='background:url(<?php echo get_sub_field('featured_image') ?>)no-repeat center;background-size:cover;'></div>
						</div>
						<?php
							}else{
						?>
						<div class="text-container">
							<h2 class="title"><?php echo get_sub_field('title') ?></h2>
							<p class="description"><?php echo get_sub_field('description') ?></p>
						</div>
						<?php
							}
						?>
					</div>
					<div class="right">
						<?php
							if( get_sub_field('sided') === 'right'){
								?>
								<div class="img-container">
									<div class="img-back" style='background:url(<?php echo get_sub_field('back_image') ?>)no-repeat center;background-size:cover;'></div>
									<div class="img-front" style='background:url(<?php echo get_sub_field('featured_image') ?>)no-repeat center;background-size:cover;'></div>
								</div>
								<?php
							}else{
								?>
								<div class="text-container">
									<h2 class="title"><?php echo get_sub_field('title') ?></h2>
									<p class="description"><?php echo get_sub_field('description') ?></p>
								</div>
								<?php
							}
						?>
					</div>
				</div>
			</section>
		<?php } // image weighted ?>

		<?php 
		/*
		MEDIA GALLERY
		*/
		if(get_row_layout() === 'media_gallery'){
            get_template_part( 'template-parts/fc-media-gallery' );    
        } // media gallery ?>

        <?php 
        /*
        PARAGRAPH BLOCKS
        */
        if(get_row_layout() === 'paragraph_blocks'){?>
            <section class="fc_paragraph_blocks">
                <div class="content-container">

                    <?php if(get_sub_field('blocks')){
                        
                        for($b = 0; $b < count(get_sub_field('blocks')); $b++){
                            $block = get_sub_field('blocks')[$b];

                            if( $block['title'] ){ ?>
                            <h1 class="title"><?php echo $block['title'] ?></h1>
                            <?php } ?>
                            <div class="body-text"><?php echo $block['paragraph_text'] ?></div>
    
                            <?php if($block['ctas'] ){ ?>
								<div class="cta-container">
                                <?php for($i = 0; $i < count($block['ctas']); $i++){
                                    $cta = $block['ctas'][$i];

									$targetwindow = '_self';
	
									if( $cta['external_link'] === true ){
										$targetwindow = '_blank';
									}
                                ?>
                                <a href="<?php echo $cta['url'] ?>" target="<?php echo $targetwindow ?>" class="cta <?php echo $cta['cta_type']['value']; ?> <?php if( $cta['cta_type']['value'] == 'pill' ){ echo 'red'; } ?> <?php echo $cta['additional_classes'] ?>">
									<span><?php echo $cta['display_text'] ?></span>
									<?php if( $cta['cta_type']['value'] == 'script' ){ ?>
										<div class="arrow"><div class="icon"><div class="loop"></div><div class="whole"></div></div></div>
									<?php } ?>
								</a>
    
                                <?php } ?>
								</div>
							<?php
                            }
                        }
                    } ?>
                </div>
            </section>
        <?php } // paragraph blocks ?>

        <?php 
        /*
        PHOTO LIST
        */
        if(get_row_layout() === 'photo_list'){?>
            <section class="fc_photo_list">
                <div class="content-container">
                    <div class="header">
                        <h1 class="title"><?php echo get_sub_field('title') ?></h1>
                        <p class="description"><?php echo get_sub_field('description') ?></p>
                    </div>

                    <?php if(get_sub_field('list')){ ?>
                    <div class="list">
                        <?php
                            $list = get_sub_field('list');

                            for($i = 0; $i < count($list); $i++){
                                $item = $list[$i];
                        ?>
                            <div class="profile">
                                <div class="photo" style="background:url(<?php echo $item['photo']['sizes']['medium'] ?>)no-repeat center;background-size:cover;"></div>
                                <h4 class="name"><?php echo $item['name'] ?></h4>
                                <p class="role"><?php echo $item['role'] ?></p>
                            </div>
                        <?php
                            }

                        ?>
                    </div>
                    <?php } ?>
                </div>
            </section>
        <?php } // photo list ?>

        <?php 
        /*
        FULL WIDTH TEXT BLOCK
        */
        if(get_row_layout() === 'full_width_text_block'){
			
			$pad_top = '';

			if( get_sub_field('top_padding') === true){
				$pad_top = 'top-padding';
			}
			
			$pad_bottom = '';

			if( get_sub_field('bottom_padding') === true){
				$pad_bottom = 'bottom-padding';
			}

			$centered_width = '';

			if( get_sub_field('centered_width') === true){
				$centered_width = 'centered-width';
			}


		?>

            <section class="fc_full_width_text_block text-block-group <?php echo $pad_top; ?> <?php echo $pad_bottom; ?> <?php echo $centered_width; ?>">
				<div class="content-container">
					<?php
						$align = 'left';
						if( get_sub_field('header_align')['value'] === 'left'){
							$align = 'left';
						}else if( get_sub_field('header_align')['value'] === 'center'){
							$align = 'center';
						}else if( get_sub_field('header_align')['value'] === 'right'){
							$align = 'right';
						}

						
					?>
					<div class="header <?php echo $align; ?>">
					<?php if(get_sub_field('title')){ ?>
						<h1 class="title"><?php echo get_sub_field('title') ?></h1>
					<?php } ?>
					<?php if(get_sub_field('description')){ ?>
						<p class="description"><?php echo get_sub_field('description') ?></p>
					<?php } ?>
					</div>

					<div class="text-container">
						<div class="text-block">
							<?php echo get_sub_field('text_block') ?>
						</div>
					</div>

				</div>

            </section>
        <?php } // full-width text block ?>

		<?php 
		/*
		DOUBLE TEXT BLOCK
		*/
		if(get_row_layout() === 'double_text_block'){
			
			$pad_top = '';

			if( get_sub_field('top_padding') === true){
				$pad_top = 'top-padding';
			}
			
			$pad_bottom = '';

			if( get_sub_field('bottom_padding') === true){
				$pad_bottom = 'bottom-padding';
			}

			$centered_width = '';

			if( get_sub_field('centered_width') === true){
				$centered_width = 'centered-width';
			}


		?>
			<section class="fc_double_text_block text-block-group <?php echo $pad_top; ?> <?php echo $pad_bottom; ?> <?php echo $centered_width; ?>">
				<div class="content-container">
					<?php
						$align = 'left';
						if( get_sub_field('header_align')['value'] === 'left'){
							$align = 'left';
						}else if( get_sub_field('header_align')['value'] === 'center'){
							$align = 'center';
						}else if( get_sub_field('header_align')['value'] === 'right'){
							$align = 'right';
						}
						
					?>
					<div class="header <?php echo $align; ?>">
					<?php if(get_sub_field('title')){ ?>
						<h1 class="title"><?php echo get_sub_field('title') ?></h1>
					<?php } ?>
					<?php if(get_sub_field('description')){ ?>
						<p class="description"><?php echo get_sub_field('description') ?></p>
					<?php } ?>
					</div>

					<div class="text-container">
						<div class="text-block">
							<?php echo get_sub_field('text_block_1') ?>
						</div>
						<div class="text-block">
							<?php echo get_sub_field('text_block_2') ?>
						</div>
					</div>

				</div>

			</section>
		<?php } // double text block ?>

		<?php 
		/*
		TRIPLE TEXT BLOCK
		*/
		if(get_row_layout() === 'triple_text_block'){
			
			$pad_top = '';

			if( get_sub_field('top_padding') === true){
				$pad_top = 'bottom-padding';
			}
			
			$pad_bottom = '';

			if( get_sub_field('bottom_padding') === true){
				$pad_bottom = 'bottom-padding';
			}

			$centered_width = '';

			if( get_sub_field('centered_width') === true){
				$centered_width = 'centered-width';
			}


		?>
			<section class="fc_triple_text_block text-block-group <?php echo $pad_top; ?> <?php echo $pad_bottom; ?> <?php echo $centered_width; ?>">
				<div class="content-container">
					<?php
						$align = 'left';
						if( get_sub_field('header_align')['value'] === 'left'){
							$align = 'left';
						}else if( get_sub_field('header_align')['value'] === 'center'){
							$align = 'center';
						}else if( get_sub_field('header_align')['value'] === 'right'){
							$align = 'right';
						}
						
					?>
					<div class="header <?php echo $align; ?>">
					<?php if(get_sub_field('title')){ ?>
						<h1 class="title"><?php echo get_sub_field('title') ?></h1>
					<?php } ?>
					<?php if(get_sub_field('description')){ ?>
						<p class="description"><?php echo get_sub_field('description') ?></p>
					<?php } ?>
					</div>

					<div class="text-container">
						<div class="text-block">
							<?php echo get_sub_field('text_block_1') ?>
						</div>
						<div class="text-block">
							<?php echo get_sub_field('text_block_2') ?>
						</div>
						<div class="text-block">
							<?php echo get_sub_field('text_block_3') ?>
						</div>
					</div>

				</div>

			</section>
		<?php } // double text block ?>

        <?php 
        /*
        LOGO GARDEN
        */
        if(get_row_layout() === 'logo_garden'){?>
            <section class="fc_logo_garden">
                <div class="content-container">
                    <?php if(get_sub_field('title') || get_sub_field('description')){ ?>
                    <div class="header">
                        <?php if(get_sub_field('title')){ ?>
                            <h1 class="title"><?php echo get_sub_field('title') ?></h1>
                        <?php } ?>
                        <?php if(get_sub_field('description')){ ?>
                            <p class="description"><?php echo get_sub_field('description') ?></p>
                        <?php } ?>
                    </div>
                    
                    <?php if(get_sub_field('logos')){ ?>
                    <div class="logo-container">
                        <?php for($i = 0; $i < count(get_sub_field('logos')); $i++){ 
                            $logo = get_sub_field('logos')[$i];
                        ?>
                            <div class="logo" style="background:url(<?php echo $logo['logo_image'] ?>)no-repeat center; background-size:cover;"></div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <?php } ?>
                </div>
            </section>
        <?php } // logo garden ?>

        <?php 
        /*
        PRESS ARTICLE LIST
        */
        if(get_row_layout() === 'press_article_list'){?>
            <section class="fc_press_article_list">
                <div class="content-container">
					<div class="dropdown">
						<p class="label">Filter by:</p>
						<?php
							$press_dd = true;
							get_template_part( 'template-parts/states-dropdown', null, array('showall' => true) );
						?>
					</div>


					<div class="article-items">
                    <?php 
                    if(get_sub_field('articles')){  
                        for($i = 0; $i < count(get_sub_field('articles')); $i++){
                            $item = get_sub_field('articles')[$i]['item'];
                            $item_id = $item->ID;

                            $raw_post = get_post($item_id)->post_date;


							// DATE FORMATTING
							$date = DateTime::createFromFormat('Y-m-d H:i:s', get_post($item_id)->post_date);
							$formattedDate = $date->format('m/d/Y');
                    ?>
                    <a href="<?php echo get_field('url', $item_id); ?>" target="_blank" class="article-item">
                        <p class="publisher"><?php echo get_field('publisher', $item_id) . " | " . $formattedDate; ?></p>
                        <h1 class="title"><?php echo get_field('title', $item_id); ?></h1>
                    </a>
                    <?php
                        }    
                    }else{


						$query = new WP_Query(array(
							'post_type'			=> 'article',
							'post_status'		=> 'publish',
							'posts_per_page'	=> -1
						));

						if ( $query->have_posts() ) {

							while ( $query->have_posts() ) { 
								$query->the_post();
                                $item_id = get_the_id();
    
                                $raw_post = get_post($item_id)->post_date;
    
    
                                // DATE FORMATTING
                                $date = DateTime::createFromFormat('Y-m-d H:i:s', get_post($item_id)->post_date);
                                $formattedDate = $date->format('m/d/Y');

                            ?>
                            <a href="<?php echo get_field('url'); ?>" target="_blank" class="article-item all-article">
                                <p class="publisher"><?php echo get_field('publisher') . " | " . $formattedDate; ?></p>
                                <h1 class="title"><?php echo get_field('title'); ?></h1>
                            </a>
                            <?php
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
        <?php } // press article list ?>



        <?php 
        /*
        PRESS BLOG LIST
        */
        if(get_row_layout() === 'blog_list'){
			
			$pad_top = '';

			if( get_sub_field('top_padding') === true){
				$pad_top = 'top-padding';
			}
			
			$pad_bottom = '';

			if( get_sub_field('bottom_padding') === true){
				$pad_bottom = 'bottom-padding';
			}
			
			?>
            <section class="fc_blog_list <?php echo $pad_top ?> <?php echo $pad_bottom ?> <?php echo get_sub_field('mode') ?>">
                <div class="content-container">

					<div class="header">
						<div class="title"><?php echo get_sub_field('title'); ?></div>
						<a href="<?php echo get_sub_field('cta_url'); ?>" class="cta pill red"><span><?php echo get_sub_field('cta_display_text'); ?></span></a>
					</div>

					<div class="article-items">
                    <?php

					$max = 3;
					$index = 0;

                    if(get_sub_field('articles')){  
                        for($i = 0; $i < count(get_sub_field('articles')); $i++){
                            $item = get_sub_field('articles')[$i]['item'];
                            $item_id = $item->ID;

                            $raw_post = get_post($item_id);

							$rawdate = $raw_post->post_date;


							// DATE FORMATTING
							$date = DateTime::createFromFormat('Y-m-d H:i:s', $rawdate);
							$formattedDate = $date->format('m/d/Y');

							if($index < $max || get_sub_field('mode') === 'total_list'){
								
                    ?>
                    <a href="<?php echo get_permalink($item_id); ?>" target="_self" class="article-item">
						<div class="img-container">
							<div class="img" style="background:url(<?php echo get_the_post_thumbnail_url($item_id); ?>)no-repeat center;background-size:cover;"></div>
						</div>
						<div class="info-container">
							<h1 class="title"><?php echo $raw_post->post_title; ?></h1>
							<p class="date"><?php echo $formattedDate; ?></p>
						</div>
                    </a>
                    <?php
							}

							$index++;
                        }    
                    }else{


						$query = new WP_Query(array(
							'post_type'			=> 'blog',
							'post_status'		=> 'publish',
							'posts_per_page'	=> -1
						));

						if ( $query->have_posts() ) {

							while ( $query->have_posts() ) { 
								$query->the_post();
                                $item_id = get_the_id();
    
                                $raw_post = get_post($item_id);
    
    
                                // DATE FORMATTING
                                $date = DateTime::createFromFormat('Y-m-d H:i:s', get_post($item_id)->post_date);
                                $formattedDate = $date->format('m/d/Y');

								if($index < $max || get_sub_field('mode') === 'total_list'){
                            ?>

							<a href="<?php echo get_permalink($item_id); ?>" target="_self" class="article-item">
								<div class="img-container">
									<div class="img" style="background:url(<?php echo get_the_post_thumbnail_url($item_id); ?>)no-repeat center;background-size:cover;"></div>
								</div>
								<div class="info-container">
									<h1 class="title"><?php echo $raw_post->post_title; ?></h1>
									<p class="date"><?php echo $formattedDate; ?></p>
								</div>
							</a>
                            <?php
								}

								$index++;
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
        <?php } // blog list ?>




		<?php 
		/*
		MEDIA INQUIRY
		*/
		if(get_row_layout() === 'media_inquiry'){?> 
			<section class="fc_media_inquiry" style="background:url(<?php echo get_sub_field('background')['sizes']['large'] ?>)no-repeat center;background-size:cover;">
				<div class="content-container">
					<h2 class="title"><?php echo get_sub_field('header_text') ?></h2>
					<?php

					$targetwindow = '_self';

					if( get_sub_field('ctas')[0]['external_link'] === true ){
						$targetwindow = '_blank';
					}
					?>
					<a href="https://www.ustravel.org/contact-us?my_question_is_about=08#form-anchor" target="_blank" class="cta pill red"><span><?php echo get_sub_field('ctas')[0]['display_text'] ?></span></a>
				</div>
			</section>
		<?php } // media inquiry ?>

		<?php
			endwhile;
		}// If flexible_content
		?>