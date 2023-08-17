window.onload = () => {
    $('html').addClass('on');

    const nav = new Navigation();

    const footer = new Footer();

    activateFCHeroCarousels();

    activateFCPastEventsCarousels();

    activateFCAdditionalCoverageCarousels();

    activatePopups();

    activateStateDropdown();

    activatePastEvents();

    activateEventPage();

    activateArticlesPagination();
}

function markDropDownSelectorToState(state, dd){
    for(var i = 0; i < dd.length; i++){
        var option = dd[i];

        if($(option).attr('value') === state){

            $(option).attr('selected', true);
        }
    }
}

function activateArticlesPagination(){

    if( $('.fc_press_article_list') ){
        var showMaxItems = 9;
        
        var state = window.location.href.split('/');
        state = state[state.length - 2];

        // Change first option to "ALL"
        $($('.fc_press_article_list .dropdown form option')[0]).html('All');

        markDropDownSelectorToState(state, $('.fc_press_article_list .dropdown form option'));

        var items = $('.fc_press_article_list .article-item');

        // Remove Pagination if not enough articles
        if(items.length < showMaxItems){
            $('.fc_press_article_list .pagination').remove();
        }

        // Generate Markup for pagination
        var paginationContainer = $('.fc_press_article_list .pagination');


        var prevArrowStr = '<a href="#" class="prev"><span>&lt;</span></a>';
        paginationContainer.append(prevArrowStr);

        paginationContainer.append('<div class="ellipses">...</div><div class="numbers"></div>');
        var numbersContainer = $('.fc_press_article_list .pagination .numbers');

        generateArticlesPagination(numbersContainer, items, showMaxItems);

        var nextArrowStr = '<a href="#" class="next"><span>&gt;</span></a>';
        paginationContainer.append(nextArrowStr);


        // Activate ALL Pagination Buttons
        var currentIndex = 0;
        var totalPages = Math.ceil(items.length / showMaxItems);
    

        var pageItems = $('.fc_press_article_list .pagination .page-number');

        var articleIndex = 0;
        var allArticles = $('.fc_press_article_list .article-item');
        var articleContainer = $('.fc_press_article_list .article-items');

        $('.fc_press_article_list .pagination .prev').on('click', function(evt){
            evt.preventDefault();

            currentIndex--;
            articleIndex -= showMaxItems;

            if(currentIndex < 0){
                currentIndex = 0;
                articleIndex = 0;
            }
            
            arrangePagination(currentIndex, totalPages, pageItems);
            displayArticles(articleIndex, showMaxItems);
        })

        $('.fc_press_article_list .pagination .next').on('click', function(evt){
            evt.preventDefault();
            currentIndex++;
            articleIndex += showMaxItems;
            
            if(currentIndex >= totalPages){
                currentIndex = totalPages;
                articleIndex = (totalPages - 1) * showMaxItems;
            }
            
            arrangePagination(currentIndex, totalPages, pageItems);
            displayArticles(articleIndex, showMaxItems);
        })

        arrangePagination(currentIndex, totalPages, pageItems);
        displayArticles(articleIndex, showMaxItems);

        function displayArticles(index, max){
            allArticles.remove();

            for(var i = 0; i < max; i++){
                var item = allArticles[index + i];
                articleContainer.append(item);
            }
            
        }

        function arrangePagination(index, totalPages, pageItems){
                
        
            // First, remove all buttons
            $('.fc_press_article_list .pagination .current').removeClass('current');
            $('.fc_press_article_list .pagination .page-number').remove();

        
            var numbersContainer = $('.fc_press_article_list .pagination .numbers');
        
            // Add 'active' class to first 3 items
            numbersContainer.append( $(pageItems[0 + index]) );
            numbersContainer.append( $(pageItems[1 + index]) );
            numbersContainer.append( $(pageItems[2 + index]) );
        
            // Append ellipses
            // Remove Ellipses if less pages than 6
            if(totalPages < 6 || index > totalPages - 6){
                $('.fc_press_article_list .pagination .ellipses').addClass('hide');
            }else{
                numbersContainer.append($('.fc_press_article_list .pagination .ellipses'));
                $('.fc_press_article_list .pagination .ellipses').removeClass('hide');
            }
            
            if(index > totalPages - 6){
                numbersContainer.append( $(pageItems[pageItems.length - 6]) );
                numbersContainer.append( $(pageItems[pageItems.length - 5]) );
                numbersContainer.append( $(pageItems[pageItems.length - 4]) );
            }
        
            // Add 'active' class to last 3 items
            numbersContainer.append( $(pageItems[pageItems.length - 3]) );
            numbersContainer.append( $(pageItems[pageItems.length - 2]) );
            numbersContainer.append( $(pageItems[pageItems.length - 1]) );
            
            $( pageItems[index]).addClass("current");
        
            $('.fc_press_article_list .pagination .page-number').on('click', function(evt){
                evt.preventDefault();
        
                currentIndex = $(this).data('page');

                articleIndex = currentIndex * showMaxItems;
        
                arrangePagination(currentIndex, totalPages, pageItems);
                displayArticles(articleIndex, showMaxItems);
        
            })
        }

    }
}

function generateArticlesPagination(container, items, max){
    var totalPages = Math.ceil(items.length / max);


    var str = '';
    for(var i = 0; i < totalPages; i++){
        str += '<a href="#" data-page="' + i + '" class="page-number"><span>' + (i + 1) + '</span></a>';
    }

    container.append(str);
}

function activateEventPage(){
    if( $('.single-event')[0] ){

        // Carousel
        if( $('.event-carousel')[0] ){
            var carousel = $('.event-carousel .slide-collection');
            var slides = $('.event-carousel .slide-collection .slide');
            console.log('slides', slides.length);
                
            var subnav = $('.event-carousel .subnav');

            if(slides.length < 2){
                subnav.remove();
            }
    
            var props = {
                infinite: false,
                dots: true,
                prevArrow:subnav.find('.arrow.prev'),
                nextArrow:subnav.find('.arrow.next'),
                appendDots: subnav.find('.dots'),
                slidesToShow:1
            }
    
            carousel.slick(props);

            carousel.on('afterChange', (evt, slide)=>{
                var currentIndex = slide.currentSlide;
    
                markFCCarouselDots(subnav, currentIndex);
    
            })
    
            markFCCarouselDots(subnav, 0);
        }

        // Media Gallery
        if( $('.fc_media_gallery')[0] ){
            console.log('media gallery activated');

            var images = $('.fc_media_gallery .collection .gallery-item');

            console.log('images', images);

            if( images.length >= 6){
                var displayedIndex = 6; // Only used if there are more than 6 images
                
                for(var i = 0; i < displayedIndex; i++){
                    var image = $(images[i]);

                    image.addClass('show');
                }

                $('.fc_media_gallery .more-btn').addClass('show');

                // SEE MORE BUTTON
                $('.fc_media_gallery .more-btn').on('click', function(){
                    // increment index to display
                    displayedIndex += 9;
                    
                    // run through all images and desgnate show class up to index. End process and hide "See More" button if all images are shown.
                    for(var i2 = 0; i2 < displayedIndex; i2++){
                        if(i2 === images.length){
                            $('.fc_media_gallery .more-btn').removeClass('show');
                            break;
                        }

                        var image = $(images[i2]);
    
                        image.addClass('show');
                    }
                    
                })
            }else{
                var displayedIndex = 6; // Only used if there are more than 6 images
                
                for(var i = 0; i < images.length; i++){
                    var image = $(images[i]);

                    image.addClass('show');
                }
            }


        }
    }
}

function activatePastEvents(){

    const schedule = document.querySelector('.fc_past_events .schedule');

    if( schedule && !schedule.classList.contains('carousel')){
        // activate See More button
        const more = document.querySelector('.fc_past_events .cta-container .cta');

        more.addEventListener('click', (evt)=>{
            evt.preventDefault();

            showMore();
        });

        showMore();
    }

    function showMore(){
        const cards = document.querySelectorAll('.fc_past_events .schedule .item');
        let cardIndex = document.querySelectorAll('.fc_past_events .schedule .item.show').length - 1;
        const batchSize = 9;

        cardIndex += batchSize;

        if(cardIndex >= cards.length - 1){
            cardIndex = cards.length - 1;
        }

        for(let i = 0; i <= cardIndex; i++){
            const card = cards[i];

            card.classList.add('show');
        }

        if(cardIndex === cards.length - 1){
            const cta = document.querySelector('.fc_past_events .cta-container .cta');

            cta.classList.add('disabled');
        }
    }
}

function activateStateDropdown(){
    const hasBtn = document.querySelector('.fc_impact_dropdown .go-btn');

    if(hasBtn){

        hasBtn.addEventListener('click', (evt) => {
            evt.preventDefault();

            const selected = document.querySelector('.fc_impact_dropdown #' + evt.currentTarget.dataset.id);

            if(selected.options[selected.selectedIndex].value != 'none'){
                
                window.location.href = '/state/' + selected.options[selected.selectedIndex].value;
            }
            

        })
    }
}

function stateSelect(evt){
    const selected = document.querySelector('#states_dd');
    const hasBtn = document.querySelector('.fc_impact_dropdown .go-btn');
    
    if(! hasBtn){

        var forArticles = false;
        if( $('.articlesbystate-template')[0] || $('.page_press')[0] ){
            forArticles = true;
        }

        if( forArticles ){
            // PRESS PAGE
            window.location.href = '/articlesbystate/' + selected.options[selected.selectedIndex].value;

            }else{
            // STATE IMPACT PAGE
            window.location.href = '/state/' + selected.options[selected.selectedIndex].value;
        }
    }

}

function activatePopups(){
	$('.youtube-popup, .vimeo-popup').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false
	});

	$('.image-popup').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile',
		image: {
			verticalFit: true
		}
		
	});
}

function activateFCAdditionalCoverageCarousels(){
    var carousels = $('.fc_additional_articles .slides');
    var subs = $('.fc_additional_articles .subnav');

    if(carousels.length === 0){ return; }

    if( carousels.length > 0){
        for(var i = 0; i < carousels.length; i++){
            var carousel = $(carousels[i]);

                
            var subnav = $(subs[i]);
    
            var props = {
                infinite: false,
                dots: true,
                prevArrow:subnav.find('.arrow.prev'),
                nextArrow:subnav.find('.arrow.next'),
                appendDots: subnav.find('.dots'),
                slidesToShow:3,
                responsive:[
                    {
                        breakpoint:768,
                        settings:{
                            slidesToShow:2
                        }
                    },
                    {
                        breakpoint:650,
                        settings:{
                            slidesToShow:1
                        }
                    }
                ]
            }
    
            carousel.slick(props);

            carousel.on('afterChange', (evt, slide)=>{
                var currentIndex = slide.currentSlide;
    
                markFCCarouselDots(subnav, currentIndex);
    
            })
    
            markFCCarouselDots(subnav, 0);
        }
    }

    $(window).on('resize', resizeFCAdditionalCoverageCarousels);

    resizeFCAdditionalCoverageCarousels();
}

function resizeFCAdditionalCoverageCarousels(){
    var windowW = $(window).width();
    var carousels = $('.fc_additional_articles .schedule.carousel');
    var subs = $('.fc_additional_articles .subnav');

    for(var i = 0; i < carousels.length; i++){
        var car = $(carousels[i]).find('.item');
        var linkedSubnav = $(subs[i]);

        linkedSubnav.removeClass('hide');
        if(windowW < 650){
            // Hide subnav if less than 1
            if(car.length <= 1){
                linkedSubnav.addClass('hide');
            }
        }else if(windowW < 768){
            // Hide subnav if less than 2
            if(car.length <= 2){
                linkedSubnav.addClass('hide');
            }
        }else{
            // Hide subnav if less than 3
            if(car.length <= 3){
                linkedSubnav.addClass('hide');
            }
        }

    }
}

function activateFCPastEventsCarousels(){
    // Capable of mulitple Past Event carousels
    var carousels = $('.fc_past_events .schedule.carousel');
    var subs = $('.fc_past_events .subnav');

    console.log('activateFCPastEventsCarousels');

    if(carousels.length === 0){ return; }

    if( carousels.length > 0){
        for(var i = 0; i < carousels.length; i++){
            var carousel = $(carousels[i]);
            var subnav = $(subs[i]);
    
            var props = {
                infinite: false,
                dots: true,
                prevArrow:subnav.find('.arrow.prev'),
                nextArrow:subnav.find('.arrow.next'),
                appendDots: subnav.find('.dots'),
                slidesToShow:3,
                responsive:[
                    {
                        breakpoint:768,
                        settings:{
                            slidesToShow:2
                        }
                    },
                    {
                        breakpoint:650,
                        settings:{
                            slidesToShow:1
                        }
                    }
                ]
            }

            console.log('Past event slides in carousel: ', $(carousel).find(".item"));

            // If less than 3 items in carousel, don't initialize carousel. INstead label carousel with ".single" or ".double" classes
            var items = $(carousel).find(".item");
            if(items.length < 4){
                if(items.length === 1){
                   $(carousel).addClass('single'); 
                }
                if(items.length === 2){
                   $(carousel).addClass('double'); 
                }
                if(items.length === 3){
                   $(carousel).addClass('triple'); 
                }

                $(subnav).addClass('hide');
                return;
            }
    
            carousel.slick(props);

            carousel.on('afterChange', (evt, slide)=>{
                var currentIndex = slide.currentSlide;
    
                markFCCarouselDots(subnav, currentIndex);
    
            })
    
            markFCCarouselDots(subnav, 0);
        }
    }

    $(window).on('resize', resizeFCPastEventsCarousels);

    resizeFCPastEventsCarousels();
}

function resizeFCPastEventsCarousels(){
    var windowW = $(window).width();
    var carousels = $('.fc_past_events .schedule.carousel');
    var subs = $('.fc_past_events .subnav');

    for(var i = 0; i < carousels.length; i++){
        var car = $(carousels[i]).find('.item');
        var linkedSubnav = $(subs[i]);

        linkedSubnav.removeClass('hide');
        if(windowW < 650){
            // Hide subnav if less than 1
            if(car.length <= 1){
                linkedSubnav.addClass('hide');
            }
        }else if(windowW < 768){
            // Hide subnav if less than 2
            if(car.length <= 2){
                linkedSubnav.addClass('hide');
            }
        }else{
            // Hide subnav if less than 3
            if(car.length <= 3){
                linkedSubnav.addClass('hide');
            }
        }

    }
}

function activateFCHeroCarousels(){

    var heroCarouselSubs = $('.fc_hero_carousel .subnav');
    var carousels = $('.fc_hero_carousel .carousel');

    if(carousels.length === 0){ return; }

    for(var i = 0; i < carousels.length; i++){
        var heroCarouselSub = heroCarouselSubs[i];
        var carousel = $(carousels[i]);

        var props = {
            infinite:true,
            slidesToShow:1,
            dots:true,
            fade:true,
            prevArrow: $(heroCarouselSub).find('.arrow.prev'),
            nextArrow: $(heroCarouselSub).find('.arrow.next'),
            appendDots: $(heroCarouselSub).find('.dots')
        }
        carousel.slick(props);
        carousel.on('afterChange', (evt, slide)=>{
            var currentIndex = slide.currentSlide;

            markFCCarouselDots(heroCarouselSub, currentIndex);

        })

        markFCCarouselDots(heroCarouselSub, 0);
    }
}

function markFCCarouselDots(sub, currentIndex){
    var dots = $(sub).find('li');

    for(var j = 0; j < dots.length; j++){
        var dot = $(dots[j]);
        dot.removeClass('secondary');
        dot.removeClass('thirdly');
        dot.removeClass('current');
        dot.removeClass('show')
    }

    // Always show 5 dots. If less than 5, show all.
    var showIndexes = [];

    if(dots.length < 5){
        // show all
        for(var i = 0; i < dots.length;i++){
            showIndexes.push(i);
        }
    }else{
        // only show 5 at a time
        var max = 4;
        var activePosition = 0;

        switch(currentIndex){
            case 0:
                activePosition = 0;
                showIndexes = [0, 1, 2, 3, 4];
            break;
            case 1:
                activePosition = 1;
                showIndexes = [0, 1, 2, 3, 4];
            break;
            case 2:
                activePosition = 2;
                showIndexes = [currentIndex - 2, currentIndex - 1, currentIndex, currentIndex + 1, currentIndex + 2];
            break;
            case dots.length - 2:
                activePosition = 3;
                showIndexes = [currentIndex - 3, currentIndex - 2, currentIndex - 1, currentIndex, currentIndex + 1 ];
            break;
            case dots.length - 1:
                activePosition = 4;
                showIndexes = [currentIndex - 4, currentIndex - 3, currentIndex - 2, currentIndex - 1, currentIndex ];
            break;
            default:
                activePosition = 2;
                showIndexes = [currentIndex - 2, currentIndex - 1, currentIndex, currentIndex + 1, currentIndex + 2];
            break;
        }
    }
    
    for(var j = 0; j < showIndexes.length; j++){
        var index = showIndexes[j];
        var indexDiff = Math.abs(currentIndex - index);

        var markedDot = $(dots[index]);

        markedDot.addClass('show');

        // if index == currentIndex
        if(indexDiff === 0){
            markedDot.addClass('current');
        }

        if(indexDiff === 1 ){
            markedDot.addClass('secondary');
        }

        if(indexDiff >= 2 ){
            markedDot.addClass('thirdly');
        }
    }
}



