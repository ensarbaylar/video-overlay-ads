/**
 * Wp Video Overlay Ads
 * Main Javascript Library
 */
(function( $ ) {
	"use strict";

	// add array index of for old browsers (IE<9)
	if (!Array.prototype.indexOf) {

		Array.prototype.indexOf = function(obj, start) {
			var i, j;
			i = start || 0;
			j = this.length;

			while (i < j) {
				if (this[i] === obj) {
					return i;
				}
				i++;
			}
			return -1;
		};
	}

	// make a $ object to store stuff in
	if(!$.OpenDataCommunities) { $.OpenDataCommunities = {}; };
	var OpenDataCommunities = $.OpenDataCommunities;

	// To keep track of which embeds we have already processed
	if(!OpenDataCommunities.processedScripts) { OpenDataCommunities.processedScripts = []; };
	var processedScripts = OpenDataCommunities.processedScripts;

	var jQuery;
	
	if (window.jQuery === undefined) {
	    
	    // Holly Cow We cant use jQuery
		// For now Do nothing

	} else {
	    jQuery = window.jQuery;
	    jQueryLoaded();
	}

	// jQuery load callback
	function jQueryLoaded(){

		jQuery( document ).ready(function() {

			var scriptTags = document.getElementsByTagName('iframe');

			for(var i = 0; i < scriptTags.length; i++) {
				
				var scriptTag = scriptTags[i];
				
				// src matches the url of this request, and not processed it yet.
				if ( ytVidId( scriptTag.src ) && processedScripts.indexOf(scriptTag) < 0) {
					// This is a youtube embed, lets wrap it with a overlay
					jQuery(scriptTag).wrap( "<div class='video-overlay-wrapper'></div>" );

					var videoOverlayInnerContent = '<div class="video-overlay-front">';

					if( VideoOverlayAds.overlay_close_button == 1 || VideoOverlayAds.overlay_close_button == 'on' )
						videoOverlayInnerContent += '<a href="#" class="video-overlay-dismiss">&times;</a>';

					videoOverlayInnerContent += '<div class="video-overlay-content-holder">';

					videoOverlayInnerContent += VideoOverlayAds.overlay_inner_html + '</div></div>';					

					jQuery('.video-overlay-wrapper').append(videoOverlayInnerContent);

				}
			}



			$( ".video-overlay-dismiss" ).on( "click", function(e) {
				
				e.preventDefault();
				if( jQuery(this).parent().hasClass('video-overlay-front') ){
					jQuery(this).parent().remove();
				}else if( jQuery(this).parent().parent().hasClass('video-overlay-front') ){
					jQuery(this).parent().parent().remove();
				}
			});

		});
	}

	function ytVidId( url ) {
		var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
		return (url.match(p)) ? RegExp.$1 : false;
	}
})( jQuery );