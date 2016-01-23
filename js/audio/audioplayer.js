// Utility method that will give audio formatted time
getAudioTimeByDec = function(cTime,duration)
{
var duration = parseInt(duration),
currentTime = parseInt(cTime),
left = duration - currentTime, second, minute;
second = (left % 60);
minute = Math.floor(left / 60) % 60;
second = second < 10 ? "0"+second : second;
minute = minute < 10 ? "0"+minute : minute;
return minute+":"+second;
};

// Custom Audio Control using Jquery
$("body").on("click",".audioControl", function(e)
{
var ID=$(this).attr("id");
var progressArea = $("#audioProgress"+ID);
var audioTimer = $("#audioTime"+ID);
var audio = $("#audio"+ID);
var audioCtrl = $(this);
e.preventDefault();
var R=$(this).attr('rel');
if(R=='play')
{
$(this).removeClass('audioPlay').addClass('audioPause').attr("rel","pause");
audio.trigger('play');
}
else
{
$(this).removeClass('audioPause').addClass('audioPlay').attr("rel","play");
audio.trigger('pause');
}

// Audio Event listener, its listens audio time update events and updates Progress area and Timer area
audio.bind("timeupdate", function(e)
{
var audioDOM = audio.get(0);
audioTimer.text(getAudioTimeByDec(audioDOM.currentTime,audioDOM.duration));
var audioPos = (audioDOM.currentTime / audioDOM.duration) * 100;
progressArea.css('width',audioPos+"%");
if(audioPos=="100")
{
$("#"+ID).removeClass('audioPause').addClass('audioPlay').attr("rel","play");
audio.trigger('pause');
}
});
// Custom Audio Control End
});