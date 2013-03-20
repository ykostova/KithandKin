<html>
	<head>
		<link rel="stylesheet" href="style.css">
        <script src="raphael-min.js"></script>
		<script src="jquery-1.9.1.min.js"></script>
		
		<script type="text/javascript">
				var circle1x = 400;
				var circle1y = 200;
				var circle1r = 200;
				
				var circle2x = 700;
				var circle2y = 200;
				var circle2r = 200;
				
				var overlap = calculateOverlap(circle1x, circle1y, circle1r, circle2x, circle2y, circle2r);
				
				var overlapOrigin;
				var overlapPoints = new Array();
				
				var disableDrag=false;
			window.onload = function () {

				setOrigin();
				
				var R = Raphael("holder", $(document).width()-20, $(document).height()-20);
				circle1 = R.circle(circle1x, circle1y, circle1r).attr({fill: "#000", "fill-opacity": 0, "stroke-width": 5, stroke: "#FFF"});
				circle2 = R.circle(circle2x, circle2y, circle2r).attr({fill: "#000", "fill-opacity": 0, "stroke-width": 5, stroke: "#FFF"});
				
				int0 = R.circle(overlap[0], overlap[1], 7).attr({fill: "#C00", "fill-opacity": 0, "stroke-width": 0, stroke: "#FFF"});
				int1 = R.circle(overlap[2], overlap[3], 7).attr({fill: "#0C0", "fill-opacity": 0, "stroke-width": 0, stroke: "#FFF"});
				side0 = R.circle(overlap[4], overlap[5], 7).attr({fill: "#00C", "fill-opacity": 0, "stroke-width": 0, stroke: "#FFF"});
				side1 = R.circle(overlap[6], overlap[7], 7).attr({fill: "#CC0", "fill-opacity": 0, "stroke-width": 0, stroke: "#FFF"});
				
				overlapPath = R.path('M' + overlap[0] + " " + overlap[1] + ' L' + overlap[4] + " " + overlap[5] + ' L' + overlap[2] + " " + overlap[3] + ' L' + overlap[6] + " " + overlap[7] + ' Z').attr({fill: "#000", "fill-opacity": 0, "stroke-width": 0, stroke: "#FFF"});
			
				originCircle = R.circle(overlapOrigin[0], overlapOrigin[1], 7).attr({fill: "#C0C", "fill-opacity": 0, "stroke-width": 0, stroke: "#FFF"});
				
				friendsText = R.text(circle1x, circle1y+(circle1r + 30), "Friends").attr({fill: "#FFF", "fill-opacity": 1, "font-size": 16});
				familyText= R.text(circle2x, circle2y+(circle2r + 30), "Family").attr({fill: "#FFF", "fill-opacity": 1, "font-size": 16});

				overlapCircles = new Array();
				
				overlapPoints.push([0.2, 0.7]);
				overlapCircles.push(R.circle(0,0,7).attr({fill: "#C00", "fill-opacity": 1, "stroke-width": 2, stroke: "#FFF"}));
				overlapPoints.push([-0.13, 0.49]);
				overlapCircles.push(R.circle(0,0,7).attr({fill: "#00C", "fill-opacity": 1, "stroke-width": 2, stroke: "#FFF"}));
				overlapPoints.push([0.3, -0.7]);
				overlapCircles.push(R.circle(0,0,7).attr({fill: "#0C0", "fill-opacity": 1, "stroke-width": 2, stroke: "#FFF"}));
				overlapPoints.push([-0.2, -0.47]);
				overlapCircles.push(R.circle(0,0,7).attr({fill: "#C0C", "fill-opacity": 1, "stroke-width": 2, stroke: "#FFF"}));
				
												
				doubleclick = function (click) {
					
		
				}
				
                var start = function (x,y) {
					this.ox = this.attr("cx");
					this.oy = this.attr("cy");

					// if(Raphael.isPointInsidePath(overlapPath.attrs.path,x,y))
					// {
						// disableDrag=true;
						
						// newpointX = x;
						// newpointY = y;
						

						// var pointUcoord = findPointOnLinePerpendicularY(overlapOrigin[0], overlapOrigin[1],overlap[0],overlap[1],x,y);
						// var pointVcoord = findPointOnLinePerpendicularX(overlapOrigin[0], overlapOrigin[1],overlap[4],overlap[5],x,y);
						// var ratioU = getRatio(overlapOrigin[0], overlapOrigin[1],overlap[0],overlap[1],pointUcoord[0],pointUcoord[1]);
						// var ratioV = getRatio(overlapOrigin[0], overlapOrigin[1],overlap[4],overlap[5],pointVcoord[0],pointVcoord[1]);
						
						// if(x<overlapOrigin[0])
						// {
							// ratioU = -ratioU;
						// }
						
						// if(y<overlapOrigin[1])
						// {
							// ratioV = -ratioV;
						// }
						
						// overlapPoints.push([ratioU, ratioV]);
						// overlapCircles.push(R.circle(0,0,7));
					// }
                },
                move = function (dx, dy) {
					if(disableDrag==false)
					{
						this.attr({cx: this.ox + dx, cy: this.oy + dy});
						
						setOrigin();
						
						overlap = calculateOverlap(circle1.attr('cx'), circle1.attr('cy'), circle1r, circle2.attr('cx'), circle2.attr('cy'), circle2r);
						
						int0.attr({cx: overlap[0], cy: overlap[1]});
						int1.attr({cx: overlap[2], cy: overlap[3]});
						side0.attr({cx: overlap[4], cy: overlap[5]});
						side1.attr({cx: overlap[6], cy: overlap[7]});
						
						originCircle.attr({cx: overlapOrigin[0], cy: overlapOrigin[1]});
						
						
						friendsText.attr({x: circle1.attr('cx'), y: circle1.attr('cy')+(circle1r + 30)});
						familyText.attr({x: circle2.attr('cx'), y: circle2.attr('cy')+(circle2r + 30)});
						
						overlapPath.remove();
						overlapPath = R.path('M' + overlap[0] + " " + overlap[1] + ' L' + overlap[4] + " " + overlap[5] + ' L' + overlap[2] + " " + overlap[3] + ' L' + overlap[6] + " " + overlap[7] + ' Z').attr({fill: "#000", "fill-opacity": 0, "stroke-width": 0, stroke: "#FFF"});
						this.toFront();
						overlapPath.toBack();
						drawPoints();
					}
                },
                up = function () {
					disableDrag=false;
                };

				drawPoints = function() {
					for(i=0; i<overlapPoints.length; i++)
					{
						intu = section(overlapPoints[i][0], overlapOrigin[0], overlapOrigin[1],overlap[0],overlap[1]);
						intv = section(overlapPoints[i][1], overlapOrigin[0], overlapOrigin[1],overlap[4],overlap[5]);
						
						diffIntU = differenceTwoPoints(overlapOrigin[0], overlapOrigin[1], intu[0], intu[1]);
						diffIntV = differenceTwoPoints(overlapOrigin[0], overlapOrigin[1], intv[0], intv[1]);
						
						var angleU = getAngleTwoPoints (overlapOrigin[0], overlapOrigin[1], overlap[0], overlap[1]);
						var angleV = getAngleTwoPoints (overlapOrigin[0], overlapOrigin[1], overlap[4], overlap[5]);
						
						var angleOP = Math.tan(diffIntV/diffIntU) + angleU;
						
						
						var diffOP = Math.sqrt(Math.pow(intu,2)+Math.pow(intv,2));
						
						
						
						overlapCircles[i].attr({cx: (overlapOrigin[0] + (intu[0]-overlapOrigin[0]) + (intv[0]-overlapOrigin[0])) , cy: (overlapOrigin[1] + (intu[1]-overlapOrigin[1]) + (intv[1]-overlapOrigin[1])) });
						//overlapCircles[i].attr({cx: intu[0], cy: intv[1]});
					
					}
				}
				
                R.set(circle1, circle2).drag(move, start, up);
				
				overlapPath.click(doubleclick);
				circle1.drag(move, start, up);
				circle2.drag(move, start, up);

				
			}
			
			function setOrigin()
			{
				overlapOrigin = lineIntersection(overlap[0],overlap[1],overlap[2],overlap[3],overlap[4],overlap[5],overlap[6],overlap[7]);
			}
			
			function section(m, x0, y0, x1, y1)
			{
				var n = 1-m;
				return[((m*x1)+(n*x0)/(m+n)) , ((m*y1)+(n*y0)/(m+n))]
			}

			function differenceTwoPoints(x0, y0, x1, y1)
			{
				return Math.sqrt(Math.pow(x1-x0, 2) + Math.pow(y1-y0, 2));
			}
			
			function getRatio(x0, y0, x1, y1, xP, yP)
			{
				var diffAB = differenceTwoPoints(x0, y0, x1, y1);
				var diffAP = differenceTwoPoints(x0, y0, xP, yP);
				
				if(diffAP>diffAB)
				{
				return 1;
				}
				
				return diffAP/diffAB;
			}
			
			function findPointOnLinePerpendicularY(Ax,Ay,Bx,By,Cx,Cy)
			{
				var angleAB = getAngleTwoPoints (Ax, Ay, Bx, By);
				var angleCD = oppositeAngle(angleAB);
				YintersectCD = getPointYOnLineSlope(Cx,Cy,0,angleCD);
				
				var D = lineIntersection(Ax,Ay,Bx,By,Cx,Cy,0,YintersectCD);
				
				return D;
			}
			
			function findPointOnLinePerpendicularX(Ax,Ay,Bx,By,Cx,Cy)
			{
				var angleAB = getAngleTwoPoints (Ax, Ay, Bx, By);
				var angleCD = oppositeAngle(angleAB);
				XintersectCD = getPointXOnLineSlope(Cx,Cy,0,angleCD);
				
				var D = lineIntersection(Ax,Ay,Bx,By,Cx,Cy,0,XintersectCD);
				
				return D;
			}
			
			function getPointYOnLineSlope(Px,Py,x,a)
			{
				var m = Math.tan((Math.PI*a)/180);
				return m*(x-Px)+Py;
			}
			
			function getPointXOnLineSlope(Px,Py,y,a)
			{
				var m = Math.tan((Math.PI*a)/180);
				return ((m*Px)-Py+y)/m;
			}
			
			function lineIntersection(x1, y1, x2, y2, x3, y3, x4, y4)
			{
				var bx = x2 - x1;
				var by = y2 - y1;
				var dx = x4 - x3;
				var dy = y4 - y3; 
				var b_dot_d_perp = bx*dy - by*dx;
				if(b_dot_d_perp == 0) {
					return false;
				}
				var cx = x3-x1; 
				var cy = y3-y1;
				var t = (cx*dy - cy*dx) / b_dot_d_perp; 
			 
			  return [x1+t*bx, y1+t*by]; 
			}
			
			function lineIntersection(x1, y1, x2, y2, x3, y3, x4, y4)
			{
				var bx = x2 - x1;
				var by = y2 - y1;
				var dx = x4 - x3;
				var dy = y4 - y3; 
				var b_dot_d_perp = bx*dy - by*dx;
				if(b_dot_d_perp == 0) {
					return false;
				}
				var cx = x3-x1; 
				var cy = y3-y1;
				var t = (cx*dy - cy*dx) / b_dot_d_perp; 
			 
			  return [x1+t*bx, y1+t*by]; 
			}
			
			function getAngleTwoPoints (x0, y0, x1, y1)
			{
				return (Math.atan(((y1-y0)/(x1-x0))) * (180/Math.PI));
			}
			
			function oppositeAngle (a)
			{
				if (a<270)
				{
					return a+90;
				}
				else
				{
					return a-270;
				}
			}
			
			function getPointOnLineY(x0, y0, x1, y1, x)
			{
				var m = getSlope(x0, y0, x1, y1)
				var c = getYIntersect(x0, y0, m)
				return (m*x)+c;
			}
			
			function getPointOnLineX(x0, y0, x1, y1, y)
			{
				var m = getSlope(x0, y0, x1, y1)
				var c = getYIntersect(x0, y0, m)
				return (y-c)/m;
			}
			
			function getYIntersect(x, y, m)
			{
				return -((m*x)-y);
			}
			
			function getSlope(x0, y0, x1, y1)
			{
				return ((y1-y0)/(x1-x0));
			}
			
			function calculateOverlap(x0, y0, r0, x1, y1, r1)
			{
				var intx0, inty0, intx1, inty1, sidex0, sidey0, sidex1, sidey1;
				var intersect = new Array();
				
				var intersect = intersection(x0, y0, r0, x1, y1, r1)
				
				intx0 = intersect[0];
				intx1 = intersect[1];
				inty0 = intersect[2];
				inty1 = intersect[3];
				
				deltaY0 = y1 - y0;
				deltaX0 = x1 - x0;
				
				deltaY1 = y0 - y1;
				deltaX1 = x0 - x1;
				
				theta0 = Math.atan2(deltaY0, deltaX0);
				theta1 = Math.atan2(deltaY1, deltaX1);
				
				sidex0 = x0 + r0 * Math.cos(theta0)
				sidey0 = y0 + r0 * Math.sin(theta0)
	
				sidex1 = x1 + r1 * Math.cos(theta1)
				sidey1 = y1 + r1 * Math.sin(theta1)
				
				var overlap = new Array();
				overlap[0] = intx0;
				overlap[1] = inty0;
				overlap[2] = intx1;
				overlap[3] = inty1;
				overlap[4] = sidex0;
				overlap[5] = sidey0;
				overlap[6] = sidex1;
				overlap[7] = sidey1;
				
				return overlap;
			}
			
			function intersection(x0, y0, r0, x1, y1, r1) 
			{
				var a, dx, dy, d, h, rx, ry;
				var x2, y2;

				/* dx and dy are the vertical and horizontal distances between
				 * the circle centers.
				 */
				dx = x1 - x0;
				dy = y1 - y0;

				/* Determine the straight-line distance between the centers. */
				d = Math.sqrt((dy*dy) + (dx*dx));

				/* Check for solvability. */
				if (d > (r0 + r1)) {
					/* no solution. circles do not intersect. */
					return false;
				}
				if (d < Math.abs(r0 - r1)) {
					/* no solution. one circle is contained in the other */
					return false;
				}

				/* 'point 2' is the point where the line through the circle
				 * intersection points crosses the line between the circle
				 * centers.  
				 */

				/* Determine the distance from point 0 to point 2. */
				a = ((r0*r0) - (r1*r1) + (d*d)) / (2.0 * d) ;

				/* Determine the coordinates of point 2. */
				x2 = x0 + (dx * a/d);
				y2 = y0 + (dy * a/d);

				/* Determine the distance from point 2 to either of the
				 * intersection points.
				 */
				h = Math.sqrt((r0*r0) - (a*a));

				/* Now determine the offsets of the intersection points from
				 * point 2.
				 */
				rx = -dy * (h/d);
				ry = dx * (h/d);

				/* Determine the absolute intersection points. */
				var xi = x2 + rx;
				var xi_prime = x2 - rx;
				var yi = y2 + ry;
				var yi_prime = y2 - ry;

				return [xi, xi_prime, yi, yi_prime];
			}
		
		
		</script>
	</head>
	
	<body>
		<div id="holder">
		
		</div>
	</body>
</html>