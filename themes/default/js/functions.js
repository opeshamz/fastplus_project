var spinner_html = '<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
$(function(){
$('[data-toggle="tooltip"]').tooltip({html:true});
$('[data-toggle="popover"]').popover({html:true});
});
$(document).ready(function(){
			callCalendar('ajax.php?case=calendar');
			$('body').delegate('.ajax-navigation', 'click', function(e){
				e.preventDefault();
				callCalendar($(this).attr('href'));
			});
});

function callCalendar(url) {
	$.get(url,function(data){
		$('.calendar').html(data);
	});
}
$(document).ready(function(){
$(".yamm-fw a").click(function(event) {
	loadContent($(this).attr('id'));
});
$("#sticky").stick_in_parent({
        parent: ".container"
});
if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}
var yahoo_weather_id = $(".weather-menu option:selected").val();
$("#weather").html(spinner_html);
$.post("ajax.php?case=weather", { "yahoo_weather_id": yahoo_weather_id },
	function(data) {
		$("#weather").html(data);
});	
$(".weather-menu").change(function() {
$("#weather").html(spinner_html);
var yahoo_weather_id = $(".weather-menu option:selected").val();
$.post("ajax.php?case=weather", { "yahoo_weather_id": yahoo_weather_id },
	function(data) {
		$("#weather").html(data);
});	
});
});


$(function() {
  $("#vote").click(function() {
	var answer_id = $("input[name=answer]:checked").val();
	var poll_id = $("input#poll_id").val();
	var dataString = 'answer_id='+ answer_id +'&poll_id='+ poll_id;
	$("#vote").append(' <span class="fa fa-spinner fa-spin"></span>');
	$.ajax({
      type: "POST",
      url: 'ajax.php?case=vote',
      data: dataString,
	  cache: false,
      success: function(result) {
	  if (result == 2) {
		$("div#vote-result").hide(); 
		setTimeout(
		    function() 
		    {
			$.post("ajax.php?case=poll_result", { "poll_id": poll_id },
			function(data) {
				$("#poll").hide();
				$("#poll-result").html(data);
			});	  
			}, 2000);
	  } else if (result == 1) {
		$("#vote span").remove();
		$("div#vote-result").html('<div class="alert alert-warning">'+voted_before+'</div>'); 
	  } else {
	    $("#vote span").remove();
		$("div#vote-result").html('<div class="alert alert-danger">'+error_happened+'</div>');
	  }
      }
     });
    return false;
	});
});

function PollShowResults(poll_id)
{
   $("div#vote-result").hide(); 
   $("#poll").hide();
   $("#poll-result").show();
   $("#poll-result").html(spinner_html);
   $.post("ajax.php?case=poll_result", { "poll_id": poll_id },
			function(data) {
			setTimeout(
		    function() 
		    {
				$("#poll-result").html(data);
			}, 2000);
		});	
}

function HideResults()
{
   $("#poll-result").hide();
   $("#poll").show();
}
function loadContent(id) {
	var dataString = 'id='+ id;
		$('.ajax-menu').html(spinner_html);
		$.ajax({
		  type: "GET",
		  url: 'ajax.php?case=megamenu_category',
		  data: dataString,
		  cache: false,
		  success: function(result) {
		  if (result == 0) {
			
		  } else {
			$('.ajax-menu').html(result);
		  }
		  }
		});
}

$(function() {
  $(".article-vote-up").click(function() {
	var id = $(this).attr('rel');
	var dataString = 'id='+ id;
	$(".article-vote-up i").removeClass('fa-thumbs-up');
	$(".article-vote-up i").addClass('fa-spinner fa-spin');
	$.ajax({
      type: "POST",
      url: 'ajax.php?case=article_vote_up',
      data: dataString,
	  cache: false,
      success: function(result) {
			setTimeout(
		    function() 
		    {
			if (result == 1) {
				var votes_up = parseInt($('.article-vote-up small').text());
				$('.article-vote-up small').text(votes_up+1);
				$(".article-vote-up i").removeClass('fa-spinner fa-spin');
				$(".article-vote-up i").addClass('fa-thumbs-up');
				$(".article-vote-up").addClass('voted-up');
			} 
			if (result == 2) {
				var votes_up = parseInt($('.article-vote-up small').text());
				$('.article-vote-up small').text(votes_up-1);
				$(".article-vote-up i").removeClass('fa-spinner fa-spin');
				$(".article-vote-up i").addClass('fa-thumbs-up');
				$(".article-vote-up").removeClass('voted-up');
			} 
			if (result == 3) {
				var votes_up = parseInt($('.article-vote-up small').text());
				var votes_down = parseInt($('.article-vote-down small').text());
				$('.article-vote-up small').text(votes_up+1);
				$('.article-vote-down small').text(votes_down-1);
				$(".article-vote-up i").removeClass('fa-spinner fa-spin');
				$(".article-vote-up i").addClass('fa-thumbs-up');
				$(".article-vote-up").addClass('voted-up');
				$(".article-vote-down").removeClass('voted-down');
			} 
			}, 2000);
      }
     });
    return false;
	});
});

$(function() {
  $(".article-vote-down").click(function() {
	var id = $(this).attr('rel');
	var dataString = 'id='+ id;
	$(".article-vote-down i").removeClass('fa-thumbs-down');
	$(".article-vote-down i").addClass('fa-spinner fa-spin');
	$.ajax({
      type: "POST",
      url: 'ajax.php?case=article_vote_down',
      data: dataString,
	  cache: false,
      success: function(result) {
			setTimeout(
		    function() 
		    {
			if (result == 1) {
				var votes_down = parseInt($('.article-vote-down small').text());
				$('.article-vote-down small').text(votes_down+1);
				$(".article-vote-down i").removeClass('fa-spinner fa-spin');
				$(".article-vote-down i").addClass('fa-thumbs-down');
				$(".article-vote-down").addClass('voted-down');
			} 
			if (result == 2) {
				var votes_down = parseInt($('.article-vote-down small').text());
				$('.article-vote-down small').text(votes_down-1);
				$(".article-vote-down i").removeClass('fa-spinner fa-spin');
				$(".article-vote-down i").addClass('fa-thumbs-down');
				$(".article-vote-down").removeClass('voted-down');
			} 
			if (result == 3) {
				var votes_up = parseInt($('.article-vote-up small').text());
				var votes_down = parseInt($('.article-vote-down small').text());
				$('.article-vote-up small').text(votes_up-1);
				$('.article-vote-down small').text(votes_down+1);
				$(".article-vote-down i").removeClass('fa-spinner fa-spin');
				$(".article-vote-down i").addClass('fa-thumbs-down');
				$(".article-vote-down").addClass('voted-down');
				$(".article-vote-up").removeClass('voted-up');
			} 
			}, 2000);
      }
     });
    return false;
	});
});