jQuery(document).ready(function($) {
			
	  $(".prev_div").jScroll({speed : "fast", top : 80});
		
		$('.info').css({'opacity':0});
		
		$('.question').hover(function() {
			$(this).next('.info').show();
			$(this).next('.info').stop().animate({'opacity':1},250);
		}, function() {
			$(this).next('.info').stop().animate({'opacity':0},250, function() {
				$(this).hide();
			});
		});
		
		$('.question').click(function() {
			return false;
		});
	
		// inline
		$('#inline').click(function() {
			
			if( !($(this).is(':checked')) ) {
				
				$('#preview').parent('div').css({'display' : 'block'});
				$('#preview_inline').parent().parent('div').css({'display' : 'none'});
				
			} else {
				
				$('#preview').parent('div').css({'display' : 'none'});
				$('#preview_inline').parent().parent('div').css({'display' : 'block'});
				
			}
		});
	
		$('input.color').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
				colorSelect(hex, el);
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
		
		$('input.color').change(function() {
			var property = $(this).attr('id');
			
			var propArgs = {};
			propArgs[property] = 'inherit'; 
			
			if($(this).val() == '') {
				$('#preview,#preview_inline').css(propArgs);
			}
		});
		
		$('input.color').keyup(function() {
			var property = $(this).attr('id');
			
			var propArgs = {};
			propArgs[property] = 'inherit'; 
			
			if($(this).val() == '') {
				$('#preview,#preview_inline').css(propArgs);
			}
		});
    
		// font-family
		$('#fontFamily').change(function() {
			var customCSS = $(this).val();
			$('#preview,#preview_inline').css({'font-family' : customCSS});
		});
		
		// font-size
		$('#fontSize').keyup(function() {
			
			if(!$(this).val()) {
				var customCSS = 'inherit';
			} else {
				var customCSS = $(this).val() + $('#fontSizeMeas').val();
			}
	
			$('#preview,#preview_inline').css({'font-size' : customCSS});
		});
		
		// font-size Measurement
		$('#fontSizeMeas').change(function() {
			var customCSS = $(this).val();
			var fontSize = $('#fontSize').val();
			$('#preview,#preview_inline').css({'font-size' : fontSize+customCSS});
		});
		
		// toggles
		$(".toggle").click(function () {
			
			var formEl = $(this).next();
			
			var radioName = formEl.attr('name');
			
			if(formEl.siblings("input[name='" + radioName + "']").prev().hasClass('on')) {
				formEl.siblings("input[name='" + radioName + "']").prev().removeClass('on');
			}
			
			if ( (formEl.is(':checked')) && (formEl.attr('type') == 'radio') ) {
				formEl.click();
				formEl.removeAttr("checked");
			} else {
				formEl.click();	
			}
			
			$(this).toggleClass('on');
			
			
			return false;
    });
		
		// font-weight
		$('#fontWeight').click(function() {
			
			if( !($(this).is(':checked')) ) {
			
				$('#preview,#preview_inline').css({'font-weight' : 'inherit'});
				
			} else {
				
				$('#preview,#preview_inline').css({'font-weight' : 'bold'});
				
			}
		});
		
		// font-style
		$('#fontStyle').click(function() {
		    
		    console.log($(this).is(':checked'));
			
			if( !($(this).is(':checked')) ) {
			
				$('#preview,#preview_inline').css({'font-style' : 'inherit'});
				
			} else {
				
				$('#preview,#preview_inline').css({'font-style' : 'italic'});
				
			}
		});
		
		
		// text-decoration
		$('input[name=jck_custom_styles\\[textDecoration\\]]').click(function() {
		    
		    console.log($(this).is(':checked'));
			
			if( !($(this).is(':checked')) ) {
				
				$('#preview,#preview_inline').css({'text-decoration' : $(this).val()});
				
			} else {
				
				$('#preview,#preview_inline').css({'text-decoration' : 'inherit'});
				
			}
			
		});
		
		// text-transform
		$('#textTransform').change(function() {
			var customCSS = $(this).val();
			$('#preview,#preview_inline').css({'text-transform' : customCSS});
		});
		
		// text-align
		$('input[name=jck_custom_styles\\[textAlign\\]]').click(function() {
			
			if( !($(this).is(':checked')) ) {
				
				$('#preview,#preview_inline').css({'text-align' : $(this).val()});
				
			} else {
				
				$('#preview,#preview_inline').css({'text-align' : 'inherit'});
				
			}
			
		});
		
		// letter-spacing
		$('#letterSpacing').keyup(function() {
			
			if(!$(this).val()) {
				var customCSS = 'inherit';
			} else {
				var customCSS = $(this).val()+'px';
			}
	
			$('#preview,#preview_inline').css({'letter-spacing' : customCSS});
		});
		
		// word-spacing
		$('#wordSpacing').keyup(function() {
			
			if(!$(this).val()) {
				var customCSS = 'inherit';
			} else {
				var customCSS = $(this).val()+'px';
			}
	
			$('#preview,#preview_inline').css({'word-spacing' : customCSS});
		});
		
		// line-height
		$('#lineHeight').keyup(function() {
		    
		    var lineHeightMeas = $('#lineHeightMeas').val();
			
			var customCSS = $(this).val()+lineHeightMeas;
	
			$('#preview,#preview_inline').css({'line-height' : customCSS});
		});
		
		// line-height Measurement
		$('#lineHeightMeas').change(function() {
			var customCSS = $(this).val();
			var lineHeight = $('#lineHeight').val();
			$('#preview,#preview_inline').css({'line-height' : lineHeight+customCSS});
		});
		
		// font-color Measurement
		function colorSelect(hex, el) {
			var property = $(el).attr('id');
			
			var propArgs = {};
			propArgs[property] = '#'+hex; 
			
			$('#preview,#preview_inline').css(propArgs);
		}
		
		$('.choose_individuals').click(function() {
			var ind = $(this).parents('tr').find('.individuals');
			var mainField = $(this).parents('tr').find('.mainField');
			if($(this).is(':checked')){
				ind.slideDown();
				mainField.attr("disabled", "disabled");
			} else {
				ind.slideUp();
				mainField.removeAttr("disabled");
			}
		});
		
		// Margins
		$('#margin_sides input').keyup(function() {
			var property = $(this).attr('id');
			var val = $(this).val();
			if(val == '') { var val = 0; } else { var val = $(this).val(); }
			var propArgs = {};
			propArgs[property] = val+'px'; 

			$('#preview,#preview_inline').css(propArgs);

		});
		
		$('#margin').keyup(function() {
			var val = $(this).val();
			if(val == '') { var val = 0; } else { var val = $(this).val(); }
			$('#preview,#preview_inline').css({'margin':val+'px'});
		});
		
		$('#margin_ind').click(function() {
			if($('#margin_ind').is(':checked')) {
				
				var margin_top = $('#margin-top').val();
				var margin_right = $('#margin-right').val();
				var margin_bottom = $('#margin-bottom').val();
				var margin_left = $('#margin-left').val();
				
				if(margin_top == '') { var margin_top = 0; }
				if(margin_right == '') { var margin_right = 0; }
				if(margin_bottom == '') { var margin_bottom = 0; }
				if(margin_left == '') { var margin_left = 0; }
				
				$('#preview,#preview_inline').css({'margin-top':margin_top+'px'});
				$('#preview,#preview_inline').css({'margin-right':margin_right+'px'});
				$('#preview,#preview_inline').css({'margin-bottom':margin_bottom+'px'});
				$('#preview,#preview_inline').css({'margin-left':margin_left+'px'});
				
			} else {
				var margin = $('#margin').val();
				if(margin == '') { var margin = 0; }
				$('#preview,#preview_inline').css({'margin':margin+'px'});
			}
		});
		
		// Padding
		$('#padding_sides input').keyup(function() {
			var property = $(this).attr('id');
			var val = $(this).val();
			if(val == '') { var val = 0; } else { var val = $(this).val(); }
			var propArgs = {};
			propArgs[property] = val+'px'; 

			$('#preview,#preview_inline').css(propArgs);

		});
		
		$('#padding').keyup(function() {
			var val = $(this).val();
			if(val == '') { var val = 0; } else { var val = $(this).val(); }
			$('#preview,#preview_inline').css({'padding':val+'px'});
		});
		
		$('#padding_ind').click(function() {
			if($('#padding_ind').is(':checked')) {
				
				var padding_top = $('#padding-top').val();
				var padding_right = $('#padding-right').val();
				var padding_bottom = $('#padding-bottom').val();
				var padding_left = $('#padding-left').val();
				
				if(padding_top == '') { var padding_top = 0; }
				if(padding_right == '') { var padding_right = 0; }
				if(padding_bottom == '') { var padding_bottom = 0; }
				if(padding_left == '') { var padding_left = 0; }
				
				$('#preview,#preview_inline').css({'padding-top':padding_top+'px'});
				$('#preview,#preview_inline').css({'padding-right':padding_right+'px'});
				$('#preview,#preview_inline').css({'padding-bottom':padding_bottom+'px'});
				$('#preview,#preview_inline').css({'padding-left':padding_left+'px'});
				
			} else {
				var padding = $('#padding').val();
				if(padding == '') { var padding = 0; }
				$('#preview,#preview_inline').css({'padding':padding+'px'});
			}
		});
		
		// Border Style
		$('#borderStyle').change(function() {
			var customCSS = $(this).val();
			$('#preview,#preview_inline').css({'border-style' : customCSS});
		});
		
		// Border Width
		$('#border_sides input').keyup(function() {
			var property = $(this).attr('id');
			var val = $(this).val();
			if(val == '') { var val = 0; } else { var val = $(this).val(); }
			var propArgs = {};
			propArgs[property] = val+'px'; 

			$('#preview,#preview_inline').css(propArgs);

		});
		
		$('#border-width').keyup(function() {
			var val = $(this).val();
			if(val == '') { var val = 0; } else { var val = $(this).val(); }
			$('#preview,#preview_inline').css({'border-width':val+'px'});
		});
		
		$('#border_ind').click(function() {
			if($('#border_ind').is(':checked')) {
				
				var border_top = $('#border-top-width').val();
				var border_right = $('#border-right-width').val();
				var border_bottom = $('#border-bottom-width').val();
				var border_left = $('#border-left-width').val();
				
				if(border_top == '') { var border_top = 0; }
				if(border_right == '') { var border_right = 0; }
				if(border_bottom == '') { var border_bottom = 0; }
				if(border_left == '') { var border_left = 0; }
				
				$('#preview,#preview_inline').css({'border-top-width':border_top+'px'});
				$('#preview,#preview_inline').css({'border-right-width':border_right+'px'});
				$('#preview,#preview_inline').css({'border-bottom-width':border_bottom+'px'});
				$('#preview,#preview_inline').css({'border-left-width':border_left+'px'});
				
			} else {
				var border = $('#border-width').val();
				if(border == '') { var border = 0; }
				$('#preview,#preview_inline').css({'border-width':border+'px'});
			}
		});
		
});