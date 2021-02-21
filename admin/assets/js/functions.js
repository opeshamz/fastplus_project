jQuery(document).ready(function() {
$('#pleaseWaitDialog').modal({
    backdrop: 'static',
    keyboard: false
});
var selected_font = $("select[name='heading_font'] option:selected").val();
var selected_font_size = $("select[name='heading_font_size'] option:selected").val();
var selected_font_weight = $("select[name='heading_font_weight'] option:selected").val();
$.get("ajax.php?case=change_heading_font", { "selected_font": selected_font, "selected_font_size": selected_font_size, "selected_font_weight": selected_font_weight },
	function(data) {
		$("p.example-header").html(data);
});	
$("select[name='heading_font'],select[name='heading_font_size'],select[name='heading_font_weight']").change(function() {
var selected_font = $("select[name='heading_font'] option:selected").val();
var selected_font_size = $("select[name='heading_font_size'] option:selected").val();
var selected_font_weight = $("select[name='heading_font_weight'] option:selected").val();
$.get("ajax.php?case=change_heading_font", { "selected_font": selected_font, "selected_font_size": selected_font_size, "selected_font_weight": selected_font_weight },
	function(data) {
		$("p.example-header").html(data);
});
});
});

var myApp;
myApp = myApp || (function () {
    var pleaseWaitDiv = $('<div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4>Processing...</h4></div><div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div></div></div></div></div>');
    return {
        showPleaseWait: function() {
            pleaseWaitDiv.modal();
        },
        hidePleaseWait: function () {
            pleaseWaitDiv.modal('hide');
        },

    };
})();

jQuery(document).ready(function() {
var seo_title = $('input#title').val();	
var seo_content = $('textarea#details').val();
var seo_tags = $('input#tags').val();	
$.get("ajax.php?case=seo_meter", { "seo_title": seo_title, "seo_content": seo_content, "seo_tags": seo_tags },
	function(data) {
		var count = data.split(',');
		$("div#seo-meter-title").html(count[0]);
		$("div#seo-meter-content").html(count[1]);
		$("div#seo-meter-tags").html(count[2]);
});	
$("input#title,textarea#details,input#tags").change(function() {
var seo_title = $('input#title').val();	
var seo_content = $('textarea#details').val();
var seo_tags = $('input#tags').val();	
$.get("ajax.php?case=seo_meter", { "seo_title": seo_title, "seo_content": seo_content, "seo_tags": seo_tags },
	function(data) {
		var count = data.split(',');
		$("div#seo-meter-title").html(count[0]);
		$("div#seo-meter-content").html(count[1]);
		$("div#seo-meter-tags").html(count[2]);
});	
});
});	
jQuery(document).ready(function() {
var selected_font = $("select[name='paragraph_font'] option:selected").val();
var selected_font_size = $("select[name='paragraph_font_size'] option:selected").val();
var selected_font_weight = $("select[name='paragraph_font_weight'] option:selected").val();
$.get("ajax.php?case=change_paragraph_font", { "selected_font": selected_font, "selected_font_size": selected_font_size, "selected_font_weight": selected_font_weight },
	function(data) {
		$("p.example-paragraph").html(data);
});	
$("select[name='paragraph_font'],select[name='paragraph_font_size'],select[name='paragraph_font_weight']").change(function() {
var selected_font = $("select[name='paragraph_font'] option:selected").val();
var selected_font_size = $("select[name='paragraph_font_size'] option:selected").val();
var selected_font_weight = $("select[name='paragraph_font_weight'] option:selected").val();
$.get("ajax.php?case=change_paragraph_font", { "selected_font": selected_font, "selected_font_size": selected_font_size, "selected_font_weight": selected_font_weight },
	function(data) {
		$("p.example-paragraph").html(data);
});
});
});


$(document).ready(function(){
$('#smtp_div').hide();
$('#mail_div').hide();
$('#disqus_div').hide();
$('#facebook_div').hide();
$('#ad_link').hide();
$('#ad_code').hide();
$('#display_tab_categories_div').hide();
$('#display_sections_categories_div').hide();
});
$(function(){
$('.tags').tagsinput({
  confirmKeys: [13, 44]
});
$('.color').colorpicker();
});
$(document).ready(function(){ 
$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})	
});

$(document).ready(function(){ 
	$(function() {
		$("#sort_category ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=sort_category'; 
			$.post("ajax.php", order, function(theResponse){}); 															 
		}								  
		});
	});
});
$(document).ready(function(){ 
	$(function() {
		$("#sort_links ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=sort_links'; 
			$.post("ajax.php", order, function(theResponse){}); 															 
		}								  
		});
	});
});
$(document).ready(function(){ 
	$(function() {
		$("#sort_city ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=sort_cities'; 
			$.post("ajax.php", order, function(theResponse){
				
			}); 															 
		}								  
		});
	});
});

$(document).ready(function(){ 
	$(function() {
		$("#sort_pages ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=sort_pages'; 
			$.post("ajax.php", order, function(theResponse){
				
			}); 															 
		}								  
		});
	});
});


function changePage(newLoc)
{
   nextPage = newLoc.options[newLoc.selectedIndex].value
		
   if (nextPage != "")
   {
      document.location.href = nextPage
   }
}

$(function(){
$('[data-toggle="tooltip"]').tooltip({html:true});
$('[data-toggle="popover"]').popover({html:true});
});

$(document).ready(function () {
	var DisplayMegaMenu = $('#display_megamenu:checked').length;
	if (DisplayMegaMenu > 0) 
           $('#display_megamenu_div').show();
        else 
           $('#display_megamenu_div').hide();
    $('#display_megamenu').change(function () {
        if (this.checked) 
           $('#display_megamenu_div').show();
        else 
           $('#display_megamenu_div').hide();
    });
	
	var DisplayFeatured = $('#display_featured_news:checked').length;
	if (DisplayFeatured > 0) 
           $('#display_featured_news_div').show();
        else 
           $('#display_featured_news_div').hide();
    $('#display_featured_news').change(function () {
        if (this.checked) 
           $('#display_featured_news_div').show();
        else 
           $('#display_featured_news_div').hide();
    });
	
	var DisplayTopNews = $('#display_top_news_widget:checked').length;
	if (DisplayTopNews > 0) 
           $('#display_top_news_div').show();
        else 
           $('#display_top_news_div').hide();
    $('#display_top_news_widget').change(function () {
        if (this.checked) 
           $('#display_top_news_div').show();
        else 
           $('#display_top_news_div').hide();
    });
	
	var IsChecked = $('#is_referal:checked').length;
	if (IsChecked > 0) 
           $('#referal_suffix_div').show();
        else 
           $('#referal_suffix_div').hide();
    $('#is_referal').change(function () {
        if (this.checked) 
           $('#referal_suffix_div').show();
        else 
           $('#referal_suffix_div').hide();
    });

	var IsTagsChecked = $('#strip_tags:checked').length;
	if (IsTagsChecked > 0) 
           $('#strip_tags_div').show();
        else 
           $('#strip_tags_div').hide();
    
	$('#strip_tags').change(function () {
        if (this.checked) 
           $('#strip_tags_div').show();
        else 
           $('#strip_tags_div').hide();
    });
	
	var IsSourceType = $('input[name=source_type]:checked').val();
	if (IsSourceType == 'video') 
           $('#video_sites').show();
        else 
           $('#video_sites').hide();
    $('input[name=source_type]').change(function () {
        if ($('input[name=source_type]:checked').val() == 'video') 
           $('#video_sites').show();
        else 
           $('#video_sites').hide();
    });
	
	var IsAutoUpdate = $('#auto_update:checked').length;
	if (IsAutoUpdate > 0) 
           $('#auto_update_period_div').show();
        else 
           $('#auto_update_period_div').hide();
    
	$('#auto_update').change(function () {
        if (this.checked) 
           $('#auto_update_period_div').show();
        else 
           $('#auto_update_period_div').hide();
    });
	
	var IsSMTP = $('input[value="smtp"]:checked').length;
	if (IsSMTP > 0) 
           $('#smtp_div').show();
        else 
           $('#smtp_div').hide();
    
	var IsDisqus = $('input[value="disqus"]:checked').length;
	if (IsDisqus > 0) 
           $('#disqus_div').show();
        else 
           $('#disqus_div').hide();
	var IsFacebook = $('input[value="facebook"]:checked').length;
	if (IsFacebook > 0) 
           $('#facebook_div').show();
        else 
           $('#facebook_div').hide();
    
	var IsMail = $('input[value="mail"]:checked').length;
	if (IsMail > 0) 
           $('#mail_div').show();
        else 
           $('#mail_div').hide();
	      
	var IsTabs = $('input[value="tabs"]:checked').length;
	if (IsTabs > 0) 
           $('#display_tab_categories_div').show();
        else 
           $('#display_tab_categories_div').hide();
	var IsSections = $('input[value="sections"]:checked').length;
	if (IsTabs > 0) 
           $('#display_sections_categories_div').show();
        else 
           $('#display_sections_categories_div').hide();
	         
	var AllowFacebook = $('#allow_facebook_login:checked').length;
	if (AllowFacebook > 0) 
           $('#facebook-login-div').show();
        else 
           $('#facebook-login-div').hide();
    
	$('#allow_facebook_login').change(function () {
        if (this.checked) 
           $('#facebook-login-div').show();
        else 
           $('#facebook-login-div').hide();
    });
	
	var AllowTwitter = $('#allow_twitter_app:checked').length;
	if (AllowTwitter > 0) 
           $('#twitter-app-div').show();
        else 
           $('#twitter-app-div').hide();
    
	$('#allow_twitter_app').change(function () {
        if (this.checked) 
           $('#twitter-app-div').show();
        else 
           $('#twitter-app-div').hide();
    });
	
	
	var DisplayCategoriesTabs = $('#display_tab_categories:checked').length;
	if (DisplayCategoriesTabs > 0) 
           $('#display_tab_categories_div').show();
        else 
           $('#display_tab_categories_div').hide();
    
	$('#display_tab_categories').change(function () {
        if (this.checked) 
           $('#display_tab_categories_div').show();
        else 
           $('#display_tab_categories_div').hide();
    });
	
	var DisplayCategoriesSections = $('#display_sections_categories:checked').length;
	if (DisplayCategoriesSections > 0) 
           $('#display_sections_categories_div').show();
        else 
           $('#display_sections_categories_div').hide();
    
	$('#display_sections_categories').change(function () {
        if (this.checked) 
           $('#display_sections_categories_div').show();
        else 
           $('#display_sections_categories_div').hide();
    });
	var DisplayPollWidget = $('#display_poll_widget:checked').length;
	if (DisplayPollWidget > 0) 
           $('#poll-widget-div').show();
        else 
           $('#poll-widget-div').hide();
    
	$('#display_poll_widget').change(function () {
        if (this.checked) 
           $('#poll-widget-div').show();
        else 
           $('#poll-widget-div').hide();
    });
	var IsCode = $('input[value="code"]:checked').length;
	if (IsCode > 0) 
           $('#ad_code').show();
        else 
           $('#ad_code').hide();
    
	var IsLink = $('input[value="banner"]:checked').length;
	if (IsLink > 0) 
           $('#ad_link').show();
        else 
           $('#ad_link').hide();
	   
	
	
});

function ShowDiv(DivID) {
	if (DivID == 'smtp_div') {
           $('#smtp_div').show();
	       $('#mail_div').hide();
	}  else  {
           $('#smtp_div').hide();
	       $('#mail_div').show();
	}
} 

function ShowComments(DivID) {
	if (DivID == 'disqus_div') {
           $('#disqus_div').show();
	       $('#facebook_div').hide();
	}  else  {
           $('#disqus_div').hide();
	       $('#facebook_div').show();
	}
} 

function ShowAdDiv(DivID) {
	if (DivID == 'ad_link') {
           $('#ad_link').show();
	       $('#ad_code').hide();
	}  else  {
           $('#ad_link').hide();
	       $('#ad_code').show();
	}
} 
function ShowCategoryContent(DivID) {
	if (DivID == 'tabs') {
           $('#display_tab_categories_div').show();
	       $('#display_sections_categories_div').hide();
	}  else  {
           $('#display_tab_categories_div').hide();
	       $('#display_sections_categories_div').show();
	}
} 
$(function() {
$(".news_grab").click(function() {
var id = $(this).attr("id");
var dataString = 'id='+ id +'&action=news_grab';
myApp.showPleaseWait();
$.ajax({
   type: "POST",
   url: "ajax.php",
   data: dataString,
   dataType: "html",
   cache: false,
   success: function(result)
   {
	myApp.hidePleaseWait();
    document.location.href = './sources.php';
  }
  });  
});
});

$(function() {
$(".delete-image").click(function() {
	if(confirm('Proceed To Delete Image ?'))
		{
var id = $(this).attr("id");
var dataString = 'id='+ id +'&action=remove_image';
$(".delete-image span").removeClass('fa fa-close');		
$(".delete-image span").addClass('fa fa-spinner fa-spin');
$.ajax({
   type: "POST",
   url: "ajax.php",
   data: dataString,
   dataType: "html",
   cache: false,
   success: function()
   {
	$(".delete-image span").removeClass('fa fa-spinner fa-spin');		
	$(".delete-image span").addClass('fa fa-close');
	document.location.href = 'news.php?case=edit&id='+id;
  }  
  });  
  } else {
	confirm.close();
	}
});
});

$(function() {
$(".tag_grab").click(function() {
var id = $(this).attr("id");
var dataString = 'id='+ id +'&action=tag_grab';
myApp.showPleaseWait();
$.ajax({
   type: "POST",
   url: "ajax.php",
   data: dataString,
   dataType: "html",
   cache: false,
   success: function(result)
   {
	myApp.hidePleaseWait();
	document.location.href = './tags.php';
  }  
  });  
});
});

function ConfirmLogOut() {
	if(confirm('Proceed To Logout ?'))
		{
		document.location.href = 'logout.php';
	} else {
		confirm.close();
	}
}

function AddMoreInputs() {
	var input = '<input type="text" class="form-control" name="answer[]" />';
	$('.another_answer').append(input);
}

$(document).ready(function(){ 
$("input#rss_link").change(function() {
  var rss_link = $("input#rss_link").val();
  if (rss_link != "") {
	 $("a#preview_btn").attr('data-url','ajax.php?case=preview_feed_result&rss_link='+rss_link); 
  } 
});
});

$(function() {
$(".media_grab").click(function() {
var id = $(this).attr("id");
var dataString = 'id='+ id +'&action=media_channel_import';
myApp.showPleaseWait();
$.ajax({
   type: "POST",
   url: "ajax.php",
   data: dataString,
   dataType: "html",
   cache: false,
   success: function(result)
   {
	
	myApp.hidePleaseWait();
	document.location.href = './channels.php';
  }  
  });  
});
});


$(function() {
$(".import-single-video").click(function() {
var id = $(this).attr("id");
var category = $('#category option:selected').val();
var dataString = 'id='+ id +'&category='+ category +'&action=import_single_youtube_video';
$("a#"+id+" i").removeClass('fa fa-refresh');		
$("a#"+id+" i").addClass('fa fa-spinner fa-spin');
$.ajax({
   type: "POST",
   url: "ajax.php",
   data: dataString,
   dataType: "html",
   cache: false,
   success: function(result)
   {
	if (result == 'success') {
	$("a#"+id).removeClass('text-danger');		
	$("a#"+id).addClass('text-success');
	$("div#d"+id+" a").remove();
	$("div#d"+id).html('<span class="text-success"><i class="fa fa-check"></i> Imported</span>');
	} else {
	$("a#"+id).html('<i class="fa fa-close"></i> Error');	
	}
  }  
  });  
});
});



$(function() {
$(".import-dm-single-video").click(function() {
var id = $(this).attr("id");
var category = $('#category option:selected').val();
var dataString = 'id='+ id +'&category='+ category +'&action=import_single_dailymotion_video';
$("a#"+id+" i").removeClass('fa fa-refresh');		
$("a#"+id+" i").addClass('fa fa-spinner fa-spin');
$.ajax({
   type: "POST",
   url: "ajax.php",
   data: dataString,
   dataType: "html",
   cache: false,
   success: function(result)
   {
	if (result == 'success') {
	$("a#"+id).removeClass('text-danger');		
	$("a#"+id).addClass('text-success');
	$("div#dm"+id+" a").remove();
	$("div#dm"+id).html('<span class="text-success"><i class="fa fa-check"></i> Imported</span>');
	} else {
	$("a#"+id).html('<i class="fa fa-close"></i> Error');	
	}
  }  
  });  
});
});

$(function() {
$(".import-channel-single-video").click(function() {
var id = $(this).attr("id");
var category = $(this).attr('rel');
var channel = $(this).attr('scope');
var site = $('.video_box_channel').attr('rel');
var dataString = 'id='+ id +'&category='+ category +'&channel='+ channel +'&site='+ site +'&action=import_channel_single_video';
$("a#"+id+" i").removeClass('fa fa-refresh');		
$("a#"+id+" i").addClass('fa fa-spinner fa-spin');
$.ajax({
   type: "POST",
   url: "ajax.php",
   data: dataString,
   dataType: "html",
   cache: false,
   success: function(result)
   {
	if (result == 'success') {
	$("a#"+id).removeClass('text-danger');		
	$("a#"+id).addClass('text-success');
	$("div#udm"+id+" a").remove();
	$("div#udm"+id).html('<span class="text-success"><i class="fa fa-check"></i> Imported</span>');
	} else {
	$("a#"+id).html('<i class="fa fa-close"></i> Error');	
	}
  }  
  });  
});
});



$(function() {
$(".empty-source-link").click(function() {
		if(confirm('Delete All News in this Source ?'))
		{
		var id = $(this).attr('rel');
		var dataString = 'id='+ id +'&action=clear_source_news';
		myApp.showPleaseWait();
		$.ajax({
		   type: "POST",
		   url: "ajax.php",
		   data: dataString,
		   dataType: "html",
		   cache: false,
		   success: function()
		   {
			setTimeout(
		    function() 
		    {
			myApp.hidePleaseWait();
			document.location.href = 'sources.php';
			}, 2000);
		  }  
		  }); 
		} else {
		confirm.close();
		}
	});
});

$(function() {
$(".empty-channel-link").click(function() {
	if(confirm('Delete All Videos in this Channel ?'))
		{
		var id = $(this).attr('rel');
		var dataString = 'id='+ id +'&action=clear_source_news';
		myApp.showPleaseWait();
		$.ajax({
		   type: "POST",
		   url: "ajax.php",
		   data: dataString,
		   dataType: "html",
		   cache: false,
		   success: function()
		   {
			setTimeout(
		    function() 
		    {
			myApp.hidePleaseWait();
			document.location.href = 'channels.php';
			}, 2000);
		  }  
		  }); 
		} else {
		confirm.close();
		}
	});
});

$(function() {
$(".delete-category-image").click(function() {
	if(confirm('Proceed To Delete Image ?'))
		{
var id = $(this).attr("id");
var dataString = 'id='+ id +'&action=remove_category_image';
$(".delete-image span").removeClass('fa fa-close');		
$(".delete-image span").addClass('fa fa-spinner fa-spin');
$.ajax({
   type: "POST",
   url: "ajax.php",
   data: dataString,
   dataType: "html",
   cache: false,
   success: function()
   {
	$(".delete-image span").removeClass('fa fa-spinner fa-spin');		
	$(".delete-image span").addClass('fa fa-close');
	document.location.href = 'categories.php?case=edit&id='+id;
  }  
  });  
  } else {
	confirm.close();
	}
});
});

$(function() {
$(".delete-source-image").click(function() {
	if(confirm('Proceed To Delete Image ?'))
		{
var id = $(this).attr("id");
var dataString = 'id='+ id +'&action=remove_source_image';
$(".delete-image span").removeClass('fa fa-close');		
$(".delete-image span").addClass('fa fa-spinner fa-spin');
$.ajax({
   type: "POST",
   url: "ajax.php",
   data: dataString,
   dataType: "html",
   cache: false,
   success: function()
   {
	$(".delete-image span").removeClass('fa fa-spinner fa-spin');		
	$(".delete-image span").addClass('fa fa-close');
	document.location.href = 'sources.php?case=edit&id='+id;
  }  
  });  
  } else {
	confirm.close();
	}
});
});

$(function() {
$(".delete-poll-image").click(function() {
	if(confirm('Proceed To Delete Image ?'))
		{
var id = $(this).attr("id");
var dataString = 'id='+ id +'&action=remove_poll_image';
$(".delete-image span").removeClass('fa fa-close');		
$(".delete-image span").addClass('fa fa-spinner fa-spin');
$.ajax({
   type: "POST",
   url: "ajax.php",
   data: dataString,
   dataType: "html",
   cache: false,
   success: function()
   {
	$(".delete-image span").removeClass('fa fa-spinner fa-spin');		
	$(".delete-image span").addClass('fa fa-close');
	document.location.href = 'polls.php?case=edit&id='+id;
  }  
  });  
  } else {
	confirm.close();
	}
});
});