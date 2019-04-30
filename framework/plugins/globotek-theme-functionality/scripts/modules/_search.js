/**
 * Created by matthew on 25/4/19.
 */
(function ($) {
	
	$.fn.gtekSearch = function () {
		
		var elem = $(this),
			target = $(elem.data('target'));
		console.log(target);
		var init           = function () {
						
			    elem.on('click', '.filter__buttons__item', function (event) {
				
				    event.preventDefault();
				
				    var trigger      = $(this),
				        postType     = trigger.data('post_type'),
				        taxonomyName = trigger.data('taxonomy'),
				        termID       = trigger.data('term'),
				        postLimit    = trigger.data('post_limit'),
				        action       = trigger.data('action');
				
				
				    processQuery(postType, taxonomyName, termID, postLimit, action);
				
			    });
			
			
		    },
		    processQuery   = function (postType, taxonomy, termID, postLimit, action) {
			
			    
			    $.ajax({
				    url: gtek_vars.ajax_url,
				    method: 'POST',
				    data: {
					    'action': 'gtek_search',
					    'post_type': postType,
					    'taxonomy': taxonomy,
					    'term': termID,
					    'post_limit': postLimit
				    },
				    success: function(data){
					   
					    //$('.archive-page__posts').html(data);
					     if (action == 'search') {
						
						    replaceContent(data);
						
					    }
					
					    if (action == 'paginate') {
						
						    appendContent(data);
						
					    }
					    
				    }
				    
			    });
			    
			
			    
			
		    },
		    replaceContent = function (content) {
			    console.log(content);
			    target.html(content);
			    
		    },
		    appendContent  = function (content) {
			
		    };
		
		
		init();
		
		return this;
		
	}
	
}(jQuery));