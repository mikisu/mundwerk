/* ========================================================================
 * Bootstrap: bootstrap-iconpicker.js v1.0.0 by @recktoner
 * https://victor-valencia.github.com/bootstrap-iconpicker
 * ========================================================================
 * Copyright 2013 Victor Valencia Rico.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ======================================================================== */


 +function ($) { "use strict";


	// ICONPICKER PUBLIC CLASS DEFINITION
	// ==============================
	var Iconpicker = function (element, options) {
		this.$element = $(element);
		this.options  = $.extend({}, Iconpicker.DEFAULTS, this.$element.data());      
		this.options  = $.extend({}, this.options, options);      
	};

	Iconpicker.ICONSET = {
		glyphicon : [
			'adjust','align-center','align-justify','align-left','align-right','arrow-down','arrow-left','arrow-right','arrow-up','asterisk','backward','ban-circle','barcode','bell','bold','book','bookmark','briefcase','bullhorn','calendar','camera','certificate','check','chevron-down','chevron-left','chevron-right','chevron-up','circle-arrow-down','circle-arrow-left','circle-arrow-right','circle-arrow-up','cloud','cloud-download','cloud-upload','cog','collapse-down','collapse-up','comment','compressed','copyright-mark','credit-card','cutlery','dashboard','download','download-alt','earphone','edit','eject','envelope','euro','exclamation-sign','expand','export','eye-close','eye-open','facetime-video','fast-backward','fast-forward','file','film','filter','fire','flag','flash','floppy-disk','floppy-open','floppy-remove','floppy-save','floppy-saved','folder-close','folder-open','font','forward','fullscreen','gbp','gift','glass','globe','hand-down','hand-left','hand-right','hand-up','hd-video','hdd','header','headphones','heart','heart-empty','home','import','inbox','indent-left','indent-right','info-sign','italic','leaf','link','list','list-alt','lock','log-in','log-out','magnet','map-marker','minus','minus-sign','move','music','new-window','off','ok','ok-circle','ok-sign','open','paperclip','pause','pencil','phone','phone-alt','picture','plane','play','play-circle','plus','plus-sign','print','pushpin','qrcode','question-sign','random','record','refresh','registration-mark','remove','remove-circle','remove-sign','repeat','resize-full','resize-horizontal','resize-small','resize-vertical','retweet','road','save','saved','screenshot','sd-video','search','send','share','share-alt','shopping-cart','signal','sort','sort-by-alphabet','sort-by-alphabet-alt','sort-by-attributes','sort-by-attributes-alt','sort-by-order','sort-by-order-alt','sound-5-1','sound-6-1','sound-7-1','sound-dolby','sound-stereo','star','star-empty','stats','step-backward','step-forward','stop','subtitles','tag','tags','tasks','text-height','text-width','th','th-large','th-list','thumbs-down','thumbs-up','time','tint','tower','transfer','trash','tree-conifer','tree-deciduous','unchecked','upload','usd','user','volume-down','volume-off','volume-up','warning-sign','wrench','zoom-in','zoom-out'
		],
		fa : [
			'adjust','adn','align-center','align-justify','align-left','align-right','ambulance','anchor','android','angellist','angle-double-down','angle-double-left','angle-double-right','angle-double-up','angle-down','angle-left','angle-right','angle-up','apple','archive','area-chart','arrow-circle-down','arrow-circle-left','arrow-circle-o-down','arrow-circle-o-left','arrow-circle-o-right','arrow-circle-o-up','arrow-circle-right','arrow-circle-up','arrow-down','arrow-left','arrow-right','arrow-up','arrows','arrows-alt','arrows-h','arrows-v','asterisk','at','backward','ban','bar-chart','barcode','bars','beer','behance','behance-square','bell','bell-o','bell-slash','bell-slash-o','bicycle','binoculars','birthday-cake','bitbucket','bitbucket-square','bold','bolt','bomb','book','bookmark','bookmark-o','briefcase','btc','bug','building','building-o','bullhorn','bullseye','bus','calculator','calendar','calendar-o','camera','camera-retro','car','caret-down','caret-left','caret-right','caret-square-o-down','caret-square-o-left','caret-square-o-right','caret-square-o-up','caret-up','cc','cc-amex','cc-discover','cc-mastercard','cc-paypal','cc-stripe','cc-visa','certificate','chain-broken','check','check-circle','check-circle-o','check-square','check-square-o','chevron-circle-down','chevron-circle-left','chevron-circle-right','chevron-circle-up','chevron-down','chevron-left','chevron-right','chevron-up','child','circle','circle-o','circle-o-notch','circle-thin','clipboard','clock-o','cloud','cloud-download','cloud-upload','code','code-fork','codepen','coffee','cog','cogs','columns','comment','comment-o','comments','comments-o','compass','compress','copyright','credit-card','crop','crosshairs','css3','cube','cubes','cutlery','database','delicious','desktop','deviantart','digg','dot-circle-o','download','dribbble','dropbox','drupal','eject','ellipsis-h','ellipsis-v','empire','envelope','envelope-o','envelope-square','eraser','eur','exchange','exclamation','exclamation-circle','exclamation-triangle','expand','external-link','external-link-square','eye','eye-slash','eyedropper','facebook','facebook-square','fast-backward','fast-forward','fax','female','fighter-jet','file','file-archive-o','file-audio-o','file-code-o','file-excel-o','file-image-o','file-o','file-pdf-o','file-powerpoint-o','file-text','file-text-o','file-video-o','file-word-o','files-o','film','filter','fire','fire-extinguisher','flag','flag-checkered','flag-o','flask','flickr','floppy-o','folder','folder-o','folder-open','folder-open-o','font','forward','foursquare','frown-o','futbol-o','gamepad','gavel','gbp','gift','git','git-square','github','github-alt','github-square','gittip','glass','globe','google','google-plus','google-plus-square','google-wallet','graduation-cap','h-square','hacker-news','hand-o-down','hand-o-left','hand-o-right','hand-o-up','hdd-o','header','headphones','heart','heart-o','history','home','hospital-o','html5','ils','inbox','indent','info','info-circle','inr','instagram','ioxhost','italic','joomla','jpy','jsfiddle','key','keyboard-o','krw','language','laptop','lastfm','lastfm-square','leaf','lemon-o','level-down','level-up','life-ring','lightbulb-o','line-chart','link','linkedin','linkedin-square','linux','list','list-alt','list-ol','list-ul','location-arrow','lock','long-arrow-down','long-arrow-left','long-arrow-right','long-arrow-up','magic','magnet','male','map-marker','maxcdn','meanpath','medkit','meh-o','microphone','microphone-slash','minus','minus-circle','minus-square','minus-square-o','mobile','money','moon-o','music','newspaper-o','openid','outdent','pagelines','paint-brush','paper-plane','paper-plane-o','paperclip','paragraph','pause','paw','paypal','pencil','pencil-square','pencil-square-o','phone','phone-square','picture-o','pie-chart','pied-piper','pied-piper-alt','pinterest','pinterest-square','plane','play','play-circle','play-circle-o','plug','plus','plus-circle','plus-square','plus-square-o','power-off','print','puzzle-piece','qq','qrcode','question','question-circle','quote-left','quote-right','random','rebel','recycle','reddit','reddit-square','refresh','renren','repeat','reply','reply-all','retweet','road','rocket','rss','rss-square','rub','scissors','search','search-minus','search-plus','share','share-alt','share-alt-square','share-square','share-square-o','shield','shopping-cart','sign-in','sign-out','signal','sitemap','skype','slack','sliders','slideshare','smile-o','sort','sort-alpha-asc','sort-alpha-desc','sort-amount-asc','sort-amount-desc','sort-asc','sort-desc','sort-numeric-asc','sort-numeric-desc','soundcloud','space-shuttle','spinner','spoon','spotify','square','square-o','stack-exchange','stack-overflow','star','star-half','star-half-o','star-o','steam','steam-square','step-backward','step-forward','stethoscope','stop','strikethrough','stumbleupon','stumbleupon-circle','subscript','suitcase','sun-o','superscript','table','tablet','tachometer','tag','tags','tasks','taxi','tencent-weibo','terminal','text-height','text-width','th','th-large','th-list','thumb-tack','thumbs-down','thumbs-o-down','thumbs-o-up','thumbs-up','ticket','times','times-circle','times-circle-o','tint','toggle-off','toggle-on','trash','trash-o','tree','trello','trophy','truck','try','tty','tumblr','tumblr-square','twitch','twitter','twitter-square','umbrella','underline','undo','university','unlock','unlock-alt','upload','usd','user','user-md','users','video-camera','vimeo-square','vine','vk','volume-down','volume-off','volume-up','weibo','weixin','wheelchair','wifi','windows','wordpress','wrench','xing','xing-square','yahoo','yelp','youtube','youtube-play'
		],
		ion : [
			'loading-a','loading-b','loading-c','loading-d','looping','refreshing','ios7-reloading','alert','alert-circled','android-add','android-add-contact','android-alarm','android-archive','android-arrow-back','android-arrow-down-left','android-arrow-down-right','android-arrow-up-left','android-arrow-up-right','android-battery','android-book','android-calendar','android-call','android-camera','android-chat','android-checkmark','android-clock','android-close','android-contact','android-contacts','android-data','android-developer','android-display','android-download','android-dropdown','android-earth','android-folder','android-forums','android-friends','android-hand','android-image','android-inbox','android-information','android-keypad','android-lightbulb','android-locate','android-location','android-mail','android-microphone','android-mixer','android-more','android-note','android-playstore','android-printer','android-promotion','android-reminder','android-remove','android-search','android-send','android-settings','android-share','android-social','android-social-user','android-sort','android-star','android-stopwatch','android-storage','android-system-back','android-system-home','android-system-windows','android-timer','android-trash','android-volume','android-wifi','archive','arrow-down-a','arrow-down-b','arrow-down-c','arrow-expand','arrow-graph-down-left','arrow-graph-down-right','arrow-graph-up-left','arrow-graph-up-right','arrow-left-a','arrow-left-b','arrow-left-c','arrow-move','arrow-resize','arrow-return-left','arrow-return-right','arrow-right-a','arrow-right-b','arrow-right-c','arrow-shrink','arrow-swap','arrow-up-a','arrow-up-b','arrow-up-c','at','bag','battery-charging','battery-empty','battery-full','battery-half','battery-low','beaker','beer','bluetooth','bookmark','briefcase','bug','calculator','calendar','camera','card','chatbox','chatbox-working','chatboxes','chatbubble','chatbubble-working','chatbubbles','checkmark','checkmark-circled','checkmark-round','chevron-down','chevron-left','chevron-right','chevron-up','clipboard','clock','close','close-circled','close-round','cloud','code','code-download','code-working','coffee','compass','compose','connection-bars','contrast','disc','document','document-text','drag','earth','edit','egg','eject','email','eye','eye-disabled','female','filing','film-marker','flag','flash','flash-off','flask','folder','fork','fork-repo','forward','game-controller-a','game-controller-b','gear-a','gear-b','grid','hammer','headphone','heart','help','help-buoy','help-circled','home','icecream','icon-social-google-plus','icon-social-google-plus-outline','image','images','information','information-circled','ionic','ios7-alarm','ios7-alarm-outline','ios7-albums','ios7-albums-outline','ios7-arrow-back','ios7-arrow-down','ios7-arrow-forward','ios7-arrow-left','ios7-arrow-right','ios7-arrow-thin-down','ios7-arrow-thin-left','ios7-arrow-thin-right','ios7-arrow-thin-up','ios7-arrow-up','ios7-at','ios7-at-outline','ios7-bell','ios7-bell-outline','ios7-bolt','ios7-bolt-outline','ios7-bookmarks','ios7-bookmarks-outline','ios7-box','ios7-box-outline','ios7-briefcase','ios7-briefcase-outline','ios7-browsers','ios7-browsers-outline','ios7-calculator','ios7-calculator-outline','ios7-calendar','ios7-calendar-outline','ios7-camera','ios7-camera-outline','ios7-cart','ios7-cart-outline','ios7-chatboxes','ios7-chatboxes-outline','ios7-chatbubble','ios7-chatbubble-outline','ios7-checkmark','ios7-checkmark-empty','ios7-checkmark-outline','ios7-circle-filled','ios7-circle-outline','ios7-clock','ios7-clock-outline','ios7-close','ios7-close-empty','ios7-close-outline','ios7-cloud','ios7-cloud-download','ios7-cloud-download-outline','ios7-cloud-outline','ios7-cloud-upload','ios7-cloud-upload-outline','ios7-cloudy','ios7-cloudy-night','ios7-cloudy-night-outline','ios7-cloudy-outline','ios7-cog','ios7-cog-outline','ios7-compose','ios7-compose-outline','ios7-contact','ios7-contact-outline','ios7-copy','ios7-copy-outline','ios7-download','ios7-download-outline','ios7-drag','ios7-email','ios7-email-outline','ios7-eye','ios7-eye-outline','ios7-fastforward','ios7-fastforward-outline','ios7-filing','ios7-filing-outline','ios7-film','ios7-film-outline','ios7-flag','ios7-flag-outline','ios7-folder','ios7-folder-outline','ios7-gear','ios7-gear-outline','ios7-glasses','ios7-glasses-outline','ios7-heart','ios7-heart-outline','ios7-help','ios7-help-empty','ios7-help-outline','ios7-infinite','ios7-infinite-outline','ios7-information','ios7-information-empty','ios7-information-outline','ios7-ionic-outline','ios7-keypad','ios7-keypad-outline','ios7-lightbulb','ios7-lightbulb-outline','ios7-location','ios7-location-outline','ios7-locked','ios7-locked-outline','ios7-medkit','ios7-medkit-outline','ios7-mic','ios7-mic-off','ios7-mic-outline','ios7-minus','ios7-minus-empty','ios7-minus-outline','ios7-monitor','ios7-monitor-outline','ios7-moon','ios7-moon-outline','ios7-more','ios7-more-outline','ios7-musical-note','ios7-musical-notes','ios7-navigate','ios7-navigate-outline','ios7-paperplane','ios7-paperplane-outline','ios7-partlysunny','ios7-partlysunny-outline','ios7-pause','ios7-pause-outline','ios7-people','ios7-people-outline','ios7-person','ios7-person-outline','ios7-personadd','ios7-personadd-outline','ios7-photos','ios7-photos-outline','ios7-pie','ios7-pie-outline','ios7-play','ios7-play-outline','ios7-plus','ios7-plus-empty','ios7-plus-outline','ios7-pricetag','ios7-pricetag-outline','ios7-printer','ios7-printer-outline','ios7-rainy','ios7-rainy-outline','ios7-recording','ios7-recording-outline','ios7-redo','ios7-redo-outline','ios7-refresh','ios7-refresh-empty','ios7-refresh-outline','ios7-reload','ios7-rewind','ios7-rewind-outline','ios7-search','ios7-search-strong','ios7-skipbackward','ios7-skipbackward-outline','ios7-skipforward','ios7-skipforward-outline','ios7-snowy','ios7-speedometer','ios7-speedometer-outline','ios7-star','ios7-star-outline','ios7-stopwatch','ios7-stopwatch-outline','ios7-sunny','ios7-sunny-outline','ios7-telephone','ios7-telephone-outline','ios7-thunderstorm','ios7-thunderstorm-outline','ios7-time','ios7-time-outline','ios7-timer','ios7-timer-outline','ios7-trash','ios7-trash-outline','ios7-undo','ios7-undo-outline','ios7-unlocked','ios7-unlocked-outline','ios7-upload','ios7-upload-outline','ios7-videocam','ios7-videocam-outline','ios7-volume-high','ios7-volume-low','ios7-wineglass','ios7-wineglass-outline','ios7-world','ios7-world-outline','ipad','iphone','ipod','jet','key','knife','laptop','leaf','levels','lightbulb','link','load-a','load-b','load-c','load-d','location','locked','log-in','log-out','loop','magnet','male','man','map','medkit','mic-a','mic-b','mic-c','minus','minus-circled','minus-round','model-s','monitor','more','music-note','navicon','navicon-round','navigate','no-smoking','nuclear','paper-airplane','paperclip','pause','person','person-add','person-stalker','pie-graph','pin','pinpoint','pizza','plane','play','playstation','plus','plus-circled','plus-round','pound','power','pricetag','pricetags','printer','radio-waves','record','refresh','reply','reply-all','search','settings','share','shuffle','skip-backward','skip-forward','social-android','social-android-outline','social-apple','social-apple-outline','social-bitcoin','social-bitcoin-outline','social-buffer','social-buffer-outline','social-designernews','social-designernews-outline','social-dribbble','social-dribbble-outline','social-dropbox','social-dropbox-outline','social-facebook','social-facebook-outline','social-freebsd-devil','social-github','social-github-outline','social-googleplus','social-googleplus-outline','social-hackernews','social-hackernews-outline','social-linkedin','social-linkedin-outline','social-pinterest','social-pinterest-outline','social-reddit','social-reddit-outline','social-rss','social-rss-outline','social-skype','social-skype-outline','social-tumblr','social-tumblr-outline','social-tux','social-twitter','social-twitter-outline','social-vimeo','social-vimeo-outline','social-windows','social-windows-outline','social-wordpress','social-wordpress-outline','social-yahoo','social-yahoo-outline','social-youtube','social-youtube-outline','speakerphone','speedometer','spoon','star','stats-bars','steam','stop','thermometer','thumbsdown','thumbsup','trash-a','trash-b','umbrella','unlocked','upload','usb','videocamera','volume-high','volume-low','volume-medium','volume-mute','waterdrop','wifi','wineglass','woman','wrench','xbo'
		],
		el : [
			'icon-zoom-out','icon-zoom-in','icon-youtube','icon-wrench-alt','icon-wrench','icon-wordpress','icon-wheelchair','icon-website-alt','icon-website','icon-warning-sign','icon-w3c','icon-volume-up','icon-volume-off','icon-volume-down','icon-vkontakte','icon-vimeo','icon-view-mode','icon-video-chat','icon-video-alt','icon-video','icon-viadeo','icon-user','icon-usd','icon-upload','icon-unlock-alt','icon-unlock','icon-universal-access','icon-twitter','icon-tumblr','icon-trash-alt','icon-trash','icon-torso','icon-tint','icon-time-alt','icon-time','icon-thumbs-up','icon-thumbs-down','icon-th-list','icon-th-large','icon-th','icon-text-width','icon-text-height','icon-tasks','icon-tags','icon-tag','icon-stumbleupon','icon-stop-alt','icon-stop','icon-step-forward','icon-step-backward','icon-star-empty','icon-star-alt','icon-star','icon-stackoverflow','icon-spotify','icon-speaker','icon-soundcloud','icon-smiley-alt','icon-smiley','icon-slideshare','icon-skype','icon-signal','icon-shopping-cart-sign','icon-shopping-cart','icon-share-alt','icon-share','icon-search-alt','icon-search','icon-screenshot','icon-screen-alt','icon-screen','icon-scissors','icon-rss','icon-road','icon-reverse-alt','icon-retweet','icon-return-key','icon-resize-vertical','icon-resize-small','icon-resize-horizontal','icon-resize-full','icon-repeat-alt','icon-repeat','icon-remove-sign','icon-remove-circle','icon-remove','icon-refresh','icon-reddit','icon-record','icon-random','icon-quotes-alt','icon-quotes','icon-question-sign','icon-question','icon-qrcode','icon-puzzle','icon-print','icon-podcast','icon-plus-sign','icon-plus','icon-play-circle','icon-play-alt','icon-play','icon-plane','icon-pinterest','icon-picture','icon-picasa','icon-photo-alt','icon-photo','icon-phone-alt','icon-phone','icon-person','icon-pencil-alt','icon-pencil','icon-pause-alt','icon-pause','icon-path','icon-paper-clip-alt','icon-paper-clip','icon-opensource','icon-ok-sign','icon-ok-circle','icon-ok','icon-off','icon-network','icon-myspace','icon-music','icon-move','icon-minus-sign','icon-minus','icon-mic-alt','icon-mic','icon-map-marker-alt','icon-map-marker','icon-male','icon-magnet','icon-magic','icon-lock-alt','icon-lock','icon-livejournal','icon-list-alt','icon-list','icon-linkedin','icon-link','icon-lines','icon-leaf','icon-lastfm','icon-laptop-alt','icon-laptop','icon-key','icon-italic','icon-iphone-home','icon-instagram','icon-info-sign','icon-indent-right','icon-indent-left','icon-inbox-box','icon-inbox-alt','icon-inbox','icon-idea-alt','icon-idea','icon-hourglass','icon-home-alt','icon-home','icon-heart-empty','icon-heart-alt','icon-heart','icon-hearing-impaired','icon-headphones','icon-hdd','icon-hand-up','icon-hand-right','icon-hand-left','icon-hand-down','icon-guidedog','icon-group-alt','icon-group','icon-graph-alt','icon-graph','icon-googleplus','icon-globe-alt','icon-globe','icon-glasses','icon-glass','icon-github-text','icon-github','icon-gift','icon-gbp','icon-fullscreen','icon-friendfeed-rect','icon-friendfeed','icon-foursquare','icon-forward-alt','icon-forward','icon-fork','icon-fontsize','icon-font','icon-folder-sign','icon-folder-open','icon-folder-close','icon-folder','icon-flickr','icon-flag-alt','icon-flag','icon-fire','icon-filter','icon-film','icon-file-new-alt','icon-file-new','icon-file-edit-alt','icon-file-edit','icon-file-alt','icon-file','icon-female','icon-fast-forward','icon-fast-backward','icon-facetime-video','icon-facebook','icon-eye-open','icon-eye-close','icon-exclamation-sign','icon-eur','icon-error-alt','icon-error','icon-envelope-alt','icon-envelope','icon-eject','icon-edit','icon-dribbble','icon-download-alt','icon-download','icon-digg','icon-deviantart','icon-delicious','icon-dashboard','icon-css','icon-credit-card','icon-compass-alt','icon-compass','icon-comment-alt','icon-comment','icon-cogs','icon-cog-alt','icon-cog','icon-cloud-alt','icon-cloud','icon-circle-arrow-up','icon-circle-arrow-right','icon-circle-arrow-left','icon-circle-arrow-down','icon-child','icon-chevron-up','icon-chevron-right','icon-chevron-left','icon-chevron-down','icon-check-empty','icon-check','icon-certificate','icon-cc','icon-caret-up','icon-caret-right','icon-caret-left','icon-caret-down','icon-car','icon-camera','icon-calendar-sign','icon-calendar','icon-bullhorn','icon-bulb','icon-brush','icon-broom','icon-briefcase','icon-braille','icon-bookmark-empty','icon-bookmark','icon-book','icon-bold','icon-blogger','icon-blind','icon-bell','icon-behance','icon-barcode','icon-ban-circle','icon-backward','icon-asl','icon-arrow-up','icon-arrow-right','icon-arrow-left','icon-arrow-down','icon-align-right','icon-align-left','icon-align-justify','icon-align-center','icon-adult','icon-adjust-alt','icon-adjust','icon-address-book-alt','icon-address-book','icon-asterisk'
		],
		mfglabs : [
			'cloud','at','plus','minus','arrow_up','arrow_down','arrow_right','arrow_left','chevron_down','chevron_up','chevron_right','chevron_left','reorder','list','reorder_square','reorder_square_line','coverflow','coverflow_line','pause','play','step_forward','step_backward','fast_forward','fast_backward','cloud_upload','cloud_download','data_science','data_science_black','globe','globe_black','math_ico','math','math_black','paperplane_ico','paperplane','paperplane_black','color_balance','star','star_half','star_empty','star_half_empty','reload','heart','heart_broken','hashtag','reply','retweet','signin','signout','download','upload','placepin','display_screen','tablet','smartphone','connected_object','lock','unlock','camera','isight','video_camera','random','message','discussion','calendar','ringbell','movie','mail','pen','settings','measure','vector','vector_pen','mute_on','mute_off','home','sheet','arrow_big_right','arrow_big_left','arrow_big_down','arrow_big_up','dribbble_circle','dribbble','facebook_circle','facebook','git_circle_alt','git_circle','git','octopus','twitter_circle','twitter','google_plus_circle','google_plus','linked_in_circle','linked_in','instagram','instagram_circle','mfg_icon','xing','xing_circle','mfg_icon_circle','user','user_male','user_female','users','file_open','file_close','file_alt','file_close_alt','attachment','check','cross_mark','cancel_circle','check_circle','magnifying','inbox','clock','stopwatch','hourglass','trophy','unlock_alt','lock_alt','arrow_doubled_right','arrow_doubled_left','arrow_doubled_down','arrow_doubled_up','link','warning','warning_alt','magnifying_plus','magnifying_minus','white_question','black_question','stop','share','eye','trash_can','hard_drive','information_black','information_white','printer','letter','soundcloud','soundcloud_circle','anchor','female_sign','male_sign','joystick','high_voltage','fire','newspaper','chart','spread','spinner_1','spinner_2','chart_alt','label'
		]
	};  

	Iconpicker.DEFAULTS = {
		iconset: 'glyphicon',
		icon: '',
		rows: 4,
		cols: 4,
		placement: 'right',
	};   
	
	Iconpicker.prototype.createButtonBar = function(){    
		var op = this.options;
		var tr = $('<tr></tr>');
		for(var i = 0; i < op.cols; i++){
			var btn = $('<button class="btn btn-primary"><span class="glyphicon"></span></button>');        
			var td = $('<td class="text-center"></td>');
			if(i == 0 || i == op.cols - 1){            
				btn.val((i==0) ? -1: 1);
				btn.addClass((i==0) ? 'btn-previous': 'btn-next');
				btn.find('span').addClass( (i == 0) ? 'glyphicon-arrow-left': 'glyphicon-arrow-right');            
				td.append(btn);
				tr.append(td);
			}
			else if(tr.find('.page-count').length == 0){
				td.attr('colspan', op.cols - 2).append('<span class="page-count"></span>');
				tr.append(td);            
			}            
		}
		op.table.find('thead').append(tr); 
	};
	
	Iconpicker.prototype.updateButtonBar = function(page){
		var op = this.options;
		var total_pages = Math.ceil( op.icons.length / (op.cols * op.rows) );
		op.table.find('.page-count').html(page + ' / ' + total_pages);
		var btn_prev = op.table.find('.btn-previous');
		var btn_next = op.table.find('.btn-next');
		(page == 1) ? btn_prev.addClass('disabled'): btn_prev.removeClass('disabled');
		(page == total_pages) ? btn_next.addClass('disabled'): btn_next.removeClass('disabled');
	};
	
	Iconpicker.prototype.bindEvents = function(){
		var op = this.options;
		var el = this;
		op.table.find('.btn-previous, .btn-next').off('click').on('click', function(){        
			var inc = parseInt($(this).val());
			el.changeList(op.page + inc);
		});
		op.table.find('.btn-icon').off('click').on('click', function(){          
			el.select($(this).val());
			el.$element.popover('destroy');
		});  
	};
	
	Iconpicker.prototype.select = function(icon){    
		var op = this.options;
		var el = this.$element;
		op.selected = $.inArray(icon.replace(op.iconClassFix, ''), op.icons);
		if(op.selected == -1){
			op.selected = 0;
			icon = op.iconClassFix + op.icons[op.selected];
		}
		if(icon != '' && op.selected >= 0){
			op.icon = icon;
			el.find('input').val(icon);
			el.find('i').attr('class', '').addClass(op.iconClass).addClass(icon);
			op.table.find('button.btn-warning').removeClass('btn-warning');
		}    
	};
	
	Iconpicker.prototype.switchPage = function(icon){
		var op = this.options;        
		op.selected = $.inArray(icon.replace(op.iconClassFix, ''), op.icons);
		if(icon != '' && op.selected >= 0){
			var page = Math.ceil( (op.selected + 1) / (op.cols * op.rows) );
			this.changeList(page);
		}    
		op.table.find('.'+icon).parent().addClass('btn-warning');
	};
	
	Iconpicker.prototype.changeList = function(page){
		var op = this.options;
		this.updateButtonBar(page);
		var tbody = op.table.find('tbody').empty();
		var offset = (page - 1) * op.rows * op.cols;
		for(var i = 0; i < op.rows; i++){
			var tr = $('<tr></tr>');            
			for(var j = 0; j < op.cols; j++){
				var pos = offset + (i * op.cols) + j;
				var btn = $('<button class="btn btn-default btn-icon"></button>').hide();
				if(pos < op.icons.length){
					var v = op.iconClassFix + op.icons[pos];
					btn = $('<button class="btn btn-default btn-icon" value="' + v + '" title="' + v + '"><i class="' + op.iconClass + ' ' + v + '"></i></button>');                            
				}                
				var td = $('<td></td>').append(btn);
				tr.append(td);
			}
			tbody.append(tr);
		}
		op.page = page;
		this.bindEvents();
	}  
	
	// ICONPICKER PLUGIN DEFINITION
	// ========================
	var old = $.fn.iconpicker;
	$.fn.iconpicker = function (option) {
		return this.each(function () {
			var $this   = $(this);
			var data    = $this.data('bs.iconpicker');
			var options = typeof option == 'object' && option;
			if (!data) $this.data('bs.iconpicker', (data = new Iconpicker(this, options)));
			var op = data.options;
			
			//var ic = (op.iconset == 'fontawesome') ? 'fa' : 'glyphicon';

			switch (op.iconset)
			{
				case 'fontawesome' :
					var ic = 'fa';
				break;
				case 'glyphicon' :
					var ic = 'glyphicon';
				break;
				case 'ionicon' :
					var ic = 'ion';
				break;
				case 'elusive' :
					var ic = 'el';
				break;
				case 'mfglabs' :
					var ic = 'mfglabs';
				break;				
				default:
					var ic = 'glyphicon';
			}

			op = $.extend(op, {
				icons: Iconpicker.ICONSET[ic],
				iconClass: ic,
				iconClassFix: ic + '-',
				page: 1,
				selected: -1,
				table: $('<table class="table-icons"><thead></thead><tbody></tbody></table>')
			});
			var name = ( typeof $this.attr('name') != 'undefined' ) ? 'name="' + $this.attr('name') + '"' : '';
			$this.empty()
			.append('<i></i>')
			.append('<input type="hidden" ' + name + '></input>')
			.append('<span class="caret"></span>');
			$this.addClass('iconpicker');
			data.createButtonBar();
			data.changeList(1);
			$this.on('click', function(){          
				$this.popover({
					animation: false,
					trigger: 'manual',
					html: true,
					content: data.options.table,
					container: 'body',
					placement: data.options.placement
				}).on('shown.bs.popover', function () {
					data.switchPage(op.icon);
					data.bindEvents();
				});  
				$this.popover('show');
			});
			data.select(op.icon);      
		});
};

$.fn.iconpicker.Constructor = Iconpicker;


	// ICONPICKER NO CONFLICT
	// ==================
	$.fn.iconpicker.noConflict = function () {
		$.fn.iconpicker = old;
		return this;
	};


	// ICONPICKER DATA-API
	// ===============
	$('body').on('click', function (e) {
		$('.iconpicker').each(function () {
			//the 'is' for buttons that trigger popups
			//the 'has' for icons within a button that triggers a popup
			if ( ! $(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
				$(this).popover('destroy');
			}
		});
	});
	
	$('button[role="iconpicker"]').iconpicker();
	
	
}(window.jQuery);