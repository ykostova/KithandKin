		var c=72; //Starting size
		var maxsize = 150; //Maximum Size
		var minsize = 72; //Minimum Size
		var speed=2; //1: Fastest
		var distace = 72;
		var obj,myzoom;

		function zoomMyImages()	{
			var e = document.getElementsByTagName("img")
			for (var i=0; i < e.length; i++)	{
				if (e[i].getAttribute('class')=="apples")	{
					e[i].setAttribute('onmouseover','zoom(this)');
					e[i].setAttribute('onmouseout','unzoom(this)');
					e[i].style.marginLeft=-minsize/2+'px';
					e[i].style.marginTop=-3*minsize/8+'px';
					e[i].style.width=minsize+'px';
					e[i].style.height=3*minsize/4+'px';
				}
			}
		}
		window.onload=zoomMyImages;

		function zoom(obj) {
			if(c>maxsize) return
			obj.style.marginLeft=-distace/2+'px';
			obj.style.marginTop=-3*distace/8+'px';
			obj.style.width=c+'px';
			obj.style.height=c/2+'px';
			c+=4;
			myzoom=setTimeout(function(){zoom(obj)},speed);
		}
		function unzoom(obj) {
			if(c<minsize) return
			
			clearTimeout(myzoom);
			obj.style.marginLeft=-distace/2+'px';
			obj.style.marginTop=-3*distace/8+'px';
			obj.style.width=c+'px';
			obj.style.height=3*c/4+'px';
			c=c-4;
			myzoom=setTimeout(function(){unzoom(obj)},speed);
		}
		