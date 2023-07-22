
<section class="fc_media_gallery <?php echo get_sub_field('additional_style_classes') ?>" style="<?php if( get_sub_field('background')){?>background:url(<?php echo get_sub_field('background')?>)no-repeat center;background-size:cover;<?php }  ?>">
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
        <?php } ?>
        
        <?php 
        if( get_sub_field('collection') ){
            $items = get_sub_field('collection');
            $populations_class = 'full';

            if(count($items) === 1){
                $populations_class = 'single';
            }else if(count($items) === 2){
                $populations_class = 'double';
            }else if(count($items) === 3){
                $populations_class = 'triple';
            }
        ?>
        <div class="collection <?php echo $populations_class ?>">
            <?php if(count($items) === 1){ ?>
                <?php
                $type = 'photo'; 
                $popupclasses = 'image-popup';

                if( strlen($items[0]['video_id']) > 0 ){
                    $type = 'video';
                    $url = $items[0]['video_id'];
                    

                    if( str_contains( $url, 'youtube') ){
                        $popupclasses = 'youtube-popup';
                    }elseif( str_contains( $url, 'vimeo') ){
                        $popupclasses = 'vimeo-popup';
                    }
                }
                ?>
                <a href="<?php if($type === 'video'){ echo $items[0]['video_id'];}else{echo $items[0]['gallery_image']['url'];} ?>" class="gallery-item <?php echo $type ?> <?php echo $popupclasses ?>" style="background:url(<?php echo $items[0]['gallery_image']['sizes']['large'] ?>)no-repeat center; background-size:cover;"></a>
            <?php }else if(count($items) === 2){ ?>
                <?php
                for($i = 0; $i < count($items); $i++ ){
                    $type = 'photo'; 
                    $popupclasses = 'image-popup';

                    if( strlen($items[$i]['video_id']) > 0 ){
                        $type = 'video';
                        $url = $items[$i]['video_id'];
                        

                        if( str_contains( $url, 'youtube') ){
                            $popupclasses = 'youtube-popup';
                        }elseif( str_contains( $url, 'vimeo') ){
                            $popupclasses = 'vimeo-popup';
                        }
                    }
                    $item = $items[$i];
                ?>
                <a href="<?php if($type === 'video'){ echo $item['video_id'];}else{echo $item['gallery_image']['url'];} ?>" class="gallery-item <?php echo $type ?> <?php echo $popupclasses ?>" style="background:url(<?php echo $item['gallery_image']['sizes']['large'] ?>)no-repeat center; background-size:cover;"></a>
                <?php } ?>
            <?php }else if(count($items) === 3){ ?>
                <?php
                for($i = 0; $i < count($items); $i++ ){

                    $firstClass = '';
                ?>
                <?php if($i === 0){ 
                    $firstClass = 'first';    
                ?>
                <div class="top-container">
                <?php } ?>
                
                    <?php if($i === 1){ ?>
                    <div class="side-container">
                    <?php } ?>
                <?php
                    $type = 'photo'; 
                    $popupclasses = 'image-popup';

                    if( strlen($items[$i]['video_id']) > 0 ){
                        $type = 'video';
                        $url = $items[$i]['video_id'];
                        

                        if( str_contains( $url, 'youtube') ){
                            $popupclasses = 'youtube-popup';
                        }elseif( str_contains( $url, 'vimeo') ){
                            $popupclasses = 'vimeo-popup';
                        }
                    }
                    $item = $items[$i];
                ?>
                <a href="<?php if($type === 'video'){ echo $item['video_id'];}else{echo $item['gallery_image']['url'];} ?>" class="gallery-item <?php echo $type ?> <?php echo $firstClass ?> <?php echo $popupclasses ?>" style="background:url(<?php echo $item['gallery_image']['sizes']['large'] ?>)no-repeat center; background-size:cover;"></a>
                
                <?php if($i === 2){ ?>
                    </div><!-- close side-container -->
                </div><!-- close top-container -->
                <?php } ?>
                
                <?php } //end for ?>
            <?php }else{ ?>
                <?php
                for($i = 0; $i < count($items); $i++ ){
                    $firstClass = '';
                ?>
                <?php if($i === 0){  
                    $firstClass = 'first';    
                ?>
                <div class="top-container">
                <?php } ?>
                
                    <?php if($i === 1){ ?>
                    <div class="side-container">
                    <?php } ?>
                <?php
                    $type = 'photo'; 
                    $popupclasses = 'image-popup';

                    if( strlen($items[$i]['video_id']) > 0 ){
                        $type = 'video';
                        $url = $items[$i]['video_id'];
                        

                        if( str_contains( $url, 'youtube') ){
                            $popupclasses = 'youtube-popup';
                        }elseif( str_contains( $url, 'vimeo') ){
                            $popupclasses = 'vimeo-popup';
                        }
                    }


                    
                    $item = $items[$i];
                ?>
                <a href="<?php if($type === 'video'){ echo $item['video_id'];}else{echo $item['gallery_image']['url'];} ?>" class="gallery-item <?php echo $type ?> <?php echo $firstClass ?> <?php echo $popupclasses ?>" style="background:url(<?php echo $item['gallery_image']['sizes']['large'] ?>)no-repeat center; background-size:cover;">
                    <?php if($type === 'video'){ ?>
                        <div class="arrow"><div class="icon"><div class="loop"></div><div class="whole"></div></div></div>
                    <?php } ?>
                </a>
                
                <?php if($i === 2){ ?>
                    </div><!-- close side-container -->
                </div><!-- close top-container -->
                <div class="remainder-container">
                <?php } ?>
                
                <?php } //end for ?>
                </div>
            <?php } ?>
            

        </div>
        <?php } ?>

        <div class="cta red pill more-btn"><span>SEE MORE</span></div>
    </div>
</section>