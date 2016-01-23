var handwriting = {
	canvas : null,
	ctx : null,
	options : {
		flag : false,
		prevX : 0,
		currX : 0,
		prevY : 0,
		currY : 0,
		dot_flag : false,
		x : "black",
		y : 5,
		w: null,
		h: null
	},
	init : function($ele, options) {
		var self = this;

		self.renderCanvas($ele);

		self.canvas = $ele.find("canvas").get(0);
		self.options.w = self.canvas.width;
		self.options.h = self.canvas.height;
		self.ctx = self.canvas.getContext("2d");

		self.canvas.addEventListener("mousemove", function (e) {
			self.findxy('move', e)
		}, false);

		self.canvas.addEventListener("mousedown", function (e) {
			self.findxy('down', e)
		}, false);

		self.canvas.addEventListener("mouseup", function (e) {
			self.findxy('up', e)
		}, false);

		self.canvas.addEventListener("mouseout", function (e) {
			self.findxy('out', e)
		}, false);
	},

	renderCanvas : function($ele) {
		$("<canvas />").appendTo($ele);
		var html = '<div style="position:absolute;top:12%;left:43%;">Choose Color</div>';
			html+= '<div style="position:absolute;top:15%;left:45%;width:10px;height:10px;background:green;" id="green" onclick="handwriting.color(this)"></div>';
			html+= '<div style="position:absolute;top:15%;left:46%;width:10px;height:10px;background:blue;" id="blue" onclick="handwriting.color(this)"></div>';
			html+= '<div style="position:absolute;top:15%;left:47%;width:10px;height:10px;background:red;" id="red" onclick="handwriting.color(this)"></div>';
			html+= '<div style="position:absolute;top:17%;left:45%;width:10px;height:10px;background:yellow;" id="yellow" onclick="handwriting.color(this)"></div>';
			html+= '<div style="position:absolute;top:17%;left:46%;width:10px;height:10px;background:orange;" id="orange" onclick="handwriting.color(this)"></div>';
			html+= '<div style="position:absolute;top:17%;left:47%;width:10px;height:10px;background:black;" id="black" onclick="handwriting.color(this)"></div>';
			html+= '<div style="position:absolute;top:20%;left:43%;">Eraser</div>';
			html+= '<div style="position:absolute;top:22%;left:45%;width:15px;height:15px;background:white;border:2px solid;" id="white" onclick="color(this)"></div>';
			html+= '<img id="canvasimg" style="position:absolute;top:10%;left:52%;" style="display:none;">';
			html+= '<input type="button" value="save" id="btn" size="30" onclick="handwriting.save()" style="position:absolute;top:55%;left:10%;">';
			html+= '<input type="button" value="clear" id="clr" size="23" onclick="handwriting.erase()" style="position:absolute;top:55%;left:15%;">';
			$ele.append(html);
	},

	draw : function() {
		console.log(this.ctx);
		this.ctx.beginPath();
		this.ctx.moveTo(this.options.prevX, this.options.prevY);
		this.ctx.lineTo(this.options.currX, this.options.currY);
		this.ctx.strokeStyle = this.options.x;
		this.ctx.lineWidth = this.options.y;
		this.ctx.stroke();
		this.ctx.closePath();
	},

	erase : function() {
		var m = confirm("Want to clear");
		if (m) {
			this.ctx.clearRect(0, 0, this.options.w, this.options.h);
			document.getElementById("canvasimg").style.display = "none";
		}
	},

	color : function(obj) {
		switch (obj.id) {
			case "green":
				this.options.x = "green";
				break;
			case "blue":
				this.options.x = "blue";
				break;
			case "red":
				this.options.x = "red";
				break;
			case "yellow":
				this.options.x = "yellow";
				break;
			case "orange":
				this.options.x = "orange";
				break;
			case "black":
				this.options.x = "black";
				break;
			case "white":
				this.options.x = "white";
			break;
		}
		if (this.options.x == "white") this.options.y = 14;
		else this.options.y = 2;
	},

	save : function() {
		document.getElementById("canvasimg").style.border = "2px solid";
		var dataURL = this.canvas.toDataURL();
		document.getElementById("canvasimg").src = dataURL;
		document.getElementById("canvasimg").style.display = "inline";
	},

	findxy : function(res, e) {
		if (res == 'down') {
			this.options.prevX = this.options.currX;
			this.options.prevY = this.options.currY;
			this.options.currX = e.clientX - this.canvas.offsetLeft;
			this.options.currY = e.clientY - this.canvas.offsetTop;

			this.options.flag = true;
			this.options.dot_flag = true;
			if (this.options.dot_flag) {
				this.ctx.beginPath();
				this.ctx.fillStyle = this.options.x;
				this.ctx.fillRect(this.options.currX, this.options.currY, 2, 2);
				this.ctx.closePath();
				this.options.dot_flag = false;
			}
		}
		if (res == 'up' || res == "out") {
			this.options.flag = false;
		}
		if (res == 'move') {
			if (this.options.flag) {
				this.options.prevX = this.options.currX;
				this.options.prevY = this.options.currY;
				this.options.currX = e.clientX - this.canvas.offsetLeft;
				this.options.currY = e.clientY - this.canvas.offsetTop;
				this.draw();
			}
		}
	}

}

var Annotation = function(player, media) {

	this.player = player;
	this.media = media;

	this.data = null;

	this.time_data = null;

	this.vdo_id = null;

	this.render = function($ele, position) {
		var self = this;
		var comment_box = $("<div />")
			.addClass("comment_box")
			.css({
				position : 'absolute',
				top : position.y,
				left: position.x
			});
		var comment_form = $("<form />").attr("id", "frm_comment");

		$("<textarea />")
			.attr("name", "comment")
			.appendTo(comment_form);

		$("<button />").attr("type", "submit").text('submit').appendTo(comment_form);

		$("<i />").addClass("annotation")
			.appendTo(comment_box);

		comment_form.unbind("submit").submit(function(){
			self.save_bookmark($("#annotation").data("vdo_id"), $(this).find("[name=comment]").val(), self.media.currentTime);
			return false;
		});

		comment_form.appendTo(comment_box);
		comment_box.appendTo($ele);
	};

	this.destroy = function() {
		$("div.comment_box").remove();
	};

	this.save_bookmark = function(vdo_id, comment, time){
		var self = this;
		$.ajax({
			url : 'http://localhost/appac/api/save_comment.php',
			method: 'post',
			dataType : 'json',
			data : {
				vdo_id: vdo_id,
				comment : comment,
				time : time
			}
		}).done(function(response){
			self.bookmark($("#annotation").data("vdo_id"));
			self.destroy();
			self.show();
		});
	};

	this.get = function(vdo_id) {

		if(vdo_id == undefined) vdo_id = this.vdo_id;
		else this.vdo_id = vdo_id;

		var data = null;

		$.ajax({
			url : '/appac/api/get_annotation.php',
			dataType : 'json',
			data : {
				vdo_id : vdo_id
			},
			async : false
		}).done(function(response){
			data = response.annotation;
		});

		this.data = data;
		this.parse_time_data();
	};

	this.parse_time_data = function() {
		var time_data = {};
		var self = this;
		$.each(this.data, function(idx, data){
			if(time_data[self.time_to_sec(data.time)] === undefined) {
				time_data[self.time_to_sec(data.time)] = [];
			}

			time_data[self.time_to_sec(data.time)].push(data);
		});

		this.time_data = time_data;
		console.log(this.time_data)
	};

	this.bookmark = function(vdo_id) {
		this.get(vdo_id);
		var self = this;
		$.each(this.data, function(idx, data){
			var bookmark = $("<a />").attr("href", "#").addClass("bookmark");
			var percent = self.time_to_sec(data.time)/self.media.duration;
			var pos_left = $("div.bookmark").width()*percent - 4;
			bookmark.data("time", self.time_to_sec(data.time))
			bookmark.css({
				left: pos_left+"px",
				pointer: 'cursor'
			});
			bookmark.click(function(e){
				e.preventDefault();
				self.media.setCurrentTime($(this).data("time"));
				self.media.play();
				self.show($(this).data("time"));
			});
			bookmark.appendTo($("div.bookmark"));
		});
	};

	this.time_to_sec = function(time) {
		var _time = time.split(":");
		var sec = (+_time[0]) * 60 * 60 + (+_time[1]) * 60 + (+_time[2]);
		return sec;
	};

	this.bind = function() {

		this.bookmark($("#annotation").data("vdo_id"));
		var self = this;
		$("div#annotation").unbind("click").on("click", function(e){
			if($(e.target).is($(this))){
				self.player.pause();
				$(".video_control .play_pause").toggleClass("pause");
				$(".video_control .play_pause").toggleClass("play");
				$(".video_control .play_pause").text("Play");
				var position = {
					x : e.offsetX,
					y : e.offsetY
				}
				self.destroy();
				self.render($("div#annotation"), position);
			}
		});
	};

	this.show = function($ele, time) {
		if(this.data == null) this.get();
		time = parseInt(time);
		if(this.time_data[time] !== undefined) {
			$("div.comment_box:not(.comment)").remove();
			$.each(this.time_data[time], function(idx, data){
				var comment_box = $("<div />")
					.addClass("comment_box")
					.addClass("comment")
					.css({
						position : 'absolute',
						top : data.pos_y,
						left: data.pos_x,
						"background-color" : "white"
					}).text(data.comment);
				if(data.comment == null || data.comment == undefined ||data.comment.length == 0) comment_box.addClass("no-comment");
				$("<i />").addClass("annotation")
					.appendTo(comment_box);

				comment_box.appendTo($ele);
			});

		}
	};

	this.destroy_comment = function() {
		$("div.comment_box").remove();
	};
}

$(function(){
	$('#youtube1').mediaelementplayer({
		success : function(media, node, player) {
			player.controls.hide();
			var annotation = new Annotation(player, media);

			$("div#annotation").width(player.container.width());
			$("div#annotation").height(player.container.height());

			var is_bind = false;

			player.currenttime.bind('DOMSubtreeModified', function(){
				if(!is_bind) {
					is_bind = true;
					annotation.bind();
				}
				var percent = media.currentTime/media.duration * 100;
				$(".progress div.progress").css({"width" : percent+"%"});
				// annotation.destroy_comment();
				annotation.show($("div#annotation"), media.currentTime);
			});

			$(".video_control").on("click", ".pause", function(e){
				e.preventDefault();
				annotation.destroy();
				player.pause();
				$(this).toggleClass("pause");
				$(this).toggleClass("play");
				$(this).data("currenttime", media.currentTime);
				$(this).text("Play");
			});

			$("a.mark").click(function(e){
				e.preventDefault();
				annotation.save_bookmark($("#annotation").data("vdo_id"), null, media.currentTime);
				annotation.bookmark($("#annotation").data("vdo_id"));
			});

			$(".video_control").on("click", ".play", function(e){
				e.preventDefault();
				media.setCurrentTime($(this).data("currenttime"));
				player.play();
				$(this).toggleClass("pause");
				$(this).toggleClass("play");
				$(this).text("Pause");
			});
		}
	});
});
