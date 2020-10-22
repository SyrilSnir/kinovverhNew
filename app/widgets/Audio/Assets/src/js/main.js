console.log('Load jplayer');
$(document).ready(function(){
    var jp_template = '<div class="jp-progress kv-player-elements">'+
          '<div class="jp-seek-bar">'+
            '<div class="jp-play-bar"></div></div>'+
          '</div><div class="jp-current-time kv-player-elements"></div><div class="jp-duration kv-player-elements" role="timer" aria-label="duration">' +
        '</div><div class="jp-volume-bar kv-player-elements"></i><div class="jp-volume-bar-value"></div></div><i class="fa fa-volume-up kv-player-elements" aria-hidden="true">';
      $('.js-audio-play').click( function(){
          var $track = $(this).parent('.kv-track'); 
          var fName = $track.data('track');
          $('.js-audio-play').removeClass('hide');
          $('.js-audio-pause').addClass('hide');
          $(this).addClass('hide');
          $(this).siblings('.js-audio-pause').removeClass('hide');   
          if ($('.kv-player-elements',$track).length > 0) {
            $('.jp-play').trigger('click');
          } else {
            $('.kv-player-elements').remove();       
            $("#jquery_jplayer_1").jPlayer('destroy');
            $track.append(jp_template);
            $("#jquery_jplayer_1").jPlayer({            
              ready: function () {
                  $(this).jPlayer("setMedia", {
                      mp3: fName,
                      });
                      $('.jp-play').trigger('click'); 

                  },
                  swfPath: "/js",
                  supplied: "mp3,oga"
              });
            }
      });
      $('.js-audio-pause').click( function (){
          $('.jp-pause').trigger('click'); 
           $(this).addClass('hide');
           $(this).siblings('.js-audio-play').removeClass('hide');
      });
    });
