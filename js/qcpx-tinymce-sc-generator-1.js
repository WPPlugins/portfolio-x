;(function( $ ) {
    tinymce.PluginManager.add('qcpx_shortcode_cmn', function( editor,url )
    {
        var shortcodeValues = [];

        editor.addButton('qcpx_shortcode_cmn', {
			title : 'Portfolio-X Shortcode',
            text: 'Portfolio-X',
            icon: false,
            onclick : function(e){
                $.post(
                    ajaxurl,
                    {
                        action : 'show_qcpx_shortcode_cmn'
                        
                    },
                    function(data){
                        $('#wpwrap').append(data);
                    }
                )
            },
            values: shortcodeValues
        });
    });

    var selector = '';

    $(document).on( 'click', '.modal-content .close', function(){
        $(this).parent().parent().remove();
    }).on( 'click', '#qcpx_add_shortcode_cmn',function(){
	
      var mode = $('#qcpx_mode').val();
      var orderby = $('#qcpx_orderby').val();
      var order = $('#qcpx_order').val();
      var portfolioId = $('#qcpx_portfolio_id').val();
      var portfolioTpl = $('#qcpx_portfolio_tpl').val();
      var showcaseStyle = $('#qcpx_showcase_style').val();
	  var limit = $('#qcpx_limit').val();

	  if( mode !== '' && mode == 'portfolio' ){
	  
	  	  var shortcodedata = '[portfolio-x';
		  		  
		  if( mode !== '' ){
			  shortcodedata +=' mode="'+mode+'"';
		  }
		  
		  if( portfolioId != "" ){
			  shortcodedata +=' portfolio="'+portfolioId+'"';
		  }
		  
		  if( portfolioTpl !== '' ){
			  shortcodedata +=' theme_style="'+portfolioTpl+'"';
		  }
		  
		  if( orderby !== '' ){
			  shortcodedata +=' orderby="'+orderby+'"';
		  }
		  
		  if( order !== '' ){
			  shortcodedata +=' order="'+order+'"';
		  }
		  
		  if( limit !== '' ){
			  shortcodedata +=' limit="'+limit+'"';
		  }
		  
		  shortcodedata += ']';
		  
		  tinyMCE.activeEditor.selection.setContent(shortcodedata);
		  
		  $('#sm-modal').remove();
		
	  }
	  else if( mode !== '' && mode == 'showcase' )
	  {
		var shortcodedata = '[portfolio-x-showcase';
		  		  
		  if( mode !== '' ){
			  shortcodedata +=' mode="'+mode+'"';
		  }
		  
		  if( showcaseStyle !== '' ){
			  shortcodedata +=' template="'+showcaseStyle+'"';
		  }
		  
		  if( orderby !== '' ){
			  shortcodedata +=' orderby="'+orderby+'"';
		  }
		  
		  if( order !== '' ){
			  shortcodedata +=' order="'+order+'"';
		  }
		  
		  if( limit !== '' ){
			  shortcodedata +=' limit="'+limit+'"';
		  }
		  
		  shortcodedata += ']';
		  
		  tinyMCE.activeEditor.selection.setContent(shortcodedata);
		  
		  $('#sm-modal').remove();
	  }
	  else
	  {
	  	alert("Please select a valid mode.");
	  }


    }).on( 'change', '#qcpx_mode',function(){
	
		var mode = $('#qcpx_mode').val();
		
		if( mode == 'portfolio' )
		{
			$('#field_showcase_tpls').hide();
			$('#field_portfolio').show();
			$('#field_portfolio_tpls').show();
		}
		else if( mode == 'showcase' )
		{
			$('#field_portfolio').hide();
			$('#field_portfolio_tpls').hide();
			$('#field_showcase_tpls').show();
		}
		else{
			$('#field_portfolio').hide();
			$('#field_portfolio_tpls').hide();
			$('#field_showcase_tpls').hide();
		}
		
	});

}(jQuery));
