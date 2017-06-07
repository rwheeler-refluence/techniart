var ddimgtooltip={

	tiparray:function(){
		var tooltips=[]
		//define each tooltip below: tooltip[inc]=['path_to_image', 'optional desc', optional_CSS_object]
		//For desc parameter, backslash any special characters inside your text such as apotrophes ('). Example: "I\'m the king of the world"
		//For CSS object, follow the syntax: {property1:"cssvalue1", property2:"cssvalue2", etc}

		tooltips[0]=["gecko.jpg", "• This showerhead carries Environmental Protection Agency's WaterSense-labeled,<br> with 40% more water and energy savings.<br>• High performance pressure compensating flow regulation.<br>• Quickly removes soap from body and shampoo from hair.<br>• Navy shower feature for extra savings.<br>• Solid brass fittings & anti-clog spray nozzles.<br>• 1.5 gallons per minute.<br><b><center>Click to open a PDF</b>", {background:"#ffffff", color:"#000000", border:"3px ridge darkblue"}]
		tooltips[1]=["BR30.jpg", "• 65w equivalent flood<br>• Only using 10w of power<br>• 750 lumens<br>• 2700k - Warm White color<br>• 25,000 hour life<br>• Dimmable to 5%<br><b><center>Click to open a PDF</b>", {background:"#ffffff", color:"#000000", border:"3px ridge darkblue"}]
		tooltips[2]=["181SS-US-7XX-Legend.jpg", "• Provides premium quality, fireproof surge protection for PC and TV peripherals<br>• Eliminates standby power consumed by PC and TV peripherals<br>• Protects electronics with state of the art surge protection<br>• Simple automation reduces plug-load<br>• Easy to install<br><br><b><center>Click to open a PDF</b>", {background:"#ffffff", color:"#000000", border:"3px ridge darkblue"}]
		tooltips[3]=["tcp-a19.png", "• 60w equivalent LED A19<br>• Only using 10w of power<br>• 800 lumens<br>• 2700k - Warm White color<br>• 25,000 hour life<br>• Dimmable to 5%<br><b><center>Click to open a PDF</b>", {background:"#ffffff", color:"#000000", border:"3px ridge darkblue"}]
		tooltips[4]=["tcp-a19.png", "• 60w equivalent LED A19<br>• Only using 10w of power<br>• 800 lumens<br>• 2700k - Warm White color<br>• 25,000 hour life<br>• Dimmable to 5%<br><b><center>Click to open a PDF</b>", {background:"#ffffff", color:"#000000", border:"3px ridge darkblue"}]
		tooltips[5]=["N3104-15.jpg", "• Aerator body is constructed entirely of ABS poly,<br> completely lead-free for safe drinking water<br>• Non-stripping thread component (dual-thread<br>connection) includes install key.<br>Threaded inserts are removable to hide threads<br>when installing with female connections.<br>• Niagara’s patented pressure compensating<br>technology guarantees<br> a consistent flow rate across wide range of pressure<br>• Modern design fits most faucets<br>• No visible threads<br><b><center>Click to open a PDF</b>", {background:"#ffffff", color:"#000000", border:"3px ridge darkblue"}]

		return tooltips //do not remove/change this line
	}(),

	tooltipoffsets: [20, -20], //additional x and y offset from mouse cursor for tooltips



	tipprefix: 'imgtip', //tooltip ID prefixes

	createtip:function($, tipid, tipinfo){
		if ($('#'+tipid).length==0){ //if this tooltip doesn't exist yet
			return $('<div id="' + tipid + '" class="ddimgtooltip" />').html(
				'<div style="text-align:center"><img src="' + tipinfo[0] + '" /></div>'
				+ ((tipinfo[1])? '<div style="text-align:left; margin-top:5px">'+tipinfo[1]+'</div>' : '')
				)
			.css(tipinfo[2] || {})
			.appendTo(document.body)
		}
		return null
	},

	positiontooltip:function($, $tooltip, e){
		var x=e.pageX+this.tooltipoffsets[0], y=e.pageY+this.tooltipoffsets[1]
		var tipw=$tooltip.outerWidth(), tiph=$tooltip.outerHeight(), 
		x=(x+tipw>$(document).scrollLeft()+$(window).width())? x-tipw-(ddimgtooltip.tooltipoffsets[0]*2) : x
		y=(y+tiph>$(document).scrollTop()+$(window).height())? $(document).scrollTop()+$(window).height()-tiph-10 : y
		$tooltip.css({left:x, top:y})
	},
	
	showbox:function($, $tooltip, e){
		$tooltip.show()
		this.positiontooltip($, $tooltip, e)
	},

	hidebox:function($, $tooltip){
		$tooltip.hide()
	},


	init:function(targetselector){
		jQuery(document).ready(function($){
			var tiparray=ddimgtooltip.tiparray
			var $targets=$(targetselector)
			if ($targets.length==0)
				return
			var tipids=[]
			$targets.each(function(){
				var $target=$(this)
				$target.attr('rel').match(/\[(\d+)\]/) //match d of attribute rel="imgtip[d]"
				var tipsuffix=parseInt(RegExp.$1) //get d as integer
				var tipid=this._tipid=ddimgtooltip.tipprefix+tipsuffix //construct this tip's ID value and remember it
				var $tooltip=ddimgtooltip.createtip($, tipid, tiparray[tipsuffix])
				$target.mouseenter(function(e){
					var $tooltip=$("#"+this._tipid)
					ddimgtooltip.showbox($, $tooltip, e)
				})
				$target.mouseleave(function(e){
					var $tooltip=$("#"+this._tipid)
					ddimgtooltip.hidebox($, $tooltip)
				})
				$target.mousemove(function(e){
					var $tooltip=$("#"+this._tipid)
					ddimgtooltip.positiontooltip($, $tooltip, e)
				})
				if ($tooltip){ //add mouseenter to this tooltip (only if event hasn't already been added)
					$tooltip.mouseenter(function(){
						ddimgtooltip.hidebox($, $(this))
					})
				}
			})

		}) //end dom ready
	}
}

//ddimgtooltip.init("targetElementSelector")
ddimgtooltip.init("*[rel^=imgtip]")