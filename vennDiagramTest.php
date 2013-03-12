<html>
	<head>
		<link rel="stylesheet" href="style.css">
        <script src="raphael-min.js"></script>
		<script src="jquery-1.9.1.min.js"></script>
		
		<script type="text/javascript">
			window.onload = function () {
				var circle1x = 380;
				var circle1y = 240;
				var circle1r = 300;
				
				var circle2x = 640;
				var circle2y = 280;
				var circle2r = 300;
				
				var overlap = calculateOverlap(circle1x, circle1y, circle1r, circle2x, circle2y, circle2r);
				
				var overlapPoints = new Array();
			
				var R = Raphael("holder", $(document).width()-20, $(document).height()-20);
				circle1 = R.circle(circle1x, circle1y, circle1r).attr({fill: "#000", "fill-opacity": 0, "stroke-width": 5, stroke: "#FFF"});
				circle2 = R.circle(circle2x, circle2y, circle2r).attr({fill: "#000", "fill-opacity": 0, "stroke-width": 5, stroke: "#FFF"});
				
				int0 = R.circle(overlap[0], overlap[1], 7).attr({fill: "#C00", "fill-opacity": 1, "stroke-width": 2, stroke: "#FFF"});
				int1 = R.circle(overlap[2], overlap[3], 7).attr({fill: "#0C0", "fill-opacity": 1, "stroke-width": 2, stroke: "#FFF"});
				side0 = R.circle(overlap[4], overlap[5], 7).attr({fill: "#00C", "fill-opacity": 1, "stroke-width": 2, stroke: "#FFF"});
				side1 = R.circle(overlap[6], overlap[7], 7).attr({fill: "#CC0", "fill-opacity": 1, "stroke-width": 2, stroke: "#FFF"});
				
				overlapPath = R.path('M' + overlap[0] + " " + overlap[1] + ' L' + overlap[4] + " " + overlap[5] + ' L' + overlap[2] + " " + overlap[3] + ' L' + overlap[6] + " " + overlap[7] + ' Z').attr({fill: "#000", "fill-opacity": 0, "stroke-width": 2, stroke: "#FFF"});
			
                var start = function () {
                    this.ox = this.attr("cx");
                    this.oy = this.attr("cy");
                },
                move = function (dx, dy) {
                    this.attr({cx: this.ox + dx, cy: this.oy + dy});
					
					var overlap = calculateOverlap(circle1.attr('cx'), circle1.attr('cy'), circle1r, circle2.attr('cx'), circle2.attr('cy'), circle2r);
					
					int0.attr({cx: overlap[0], cy: overlap[1]});
					int1.attr({cx: overlap[2], cy: overlap[3]});
					side0.attr({cx: overlap[4], cy: overlap[5]});
					side1.attr({cx: overlap[6], cy: overlap[7]});
					
					overlapPath.remove();
					overlapPath = R.path('M' + overlap[0] + " " + overlap[1] + ' L' + overlap[4] + " " + overlap[5] + ' L' + overlap[2] + " " + overlap[3] + ' L' + overlap[6] + " " + overlap[7] + ' Z').attr({fill: "#000", "fill-opacity": 0, "stroke-width": 2, stroke: "#FFF"});
			
                },
                up = function () {
                };
				
				doubleclick = function (click) {
					
					newpointX = click.clientX;
					newpointY = click.clientY;
					
					
					
				}
				
				drawPoints = function() {
					//for(var i; i<overlapPoints.length; i++)
					//{
						new R.circle(click.clientX, click.clientY, 7).attr({fill: "#C00", "fill-opacity": 1, "stroke-width": 2, stroke: "#FFF"});
					//}
				}
				
                R.set(circle1, circle2).drag(move, start, up);
				
				circle1.drag(move, start, up);
				circle2.drag(move, start, up);
				overlapPath.dblclick(doubleclick);
			}

			function differenceTwoPoints(x0, y0, x1, y1)
			{
				return Math.sqrt(Math.pow(x1-x0, 2) + Math.pow(y1-y0, 2));
			}
			
			function getRatio(x0, y0, x1, y1, xP, yP)
			{
				diffAB = differenceTwoPoints(x0, y0, x1, y1);
				diffAP = differenceTwoPoints(x0, y0, xP, yP);
				
				
				return diffAP/diffAB;
			}
			
			function lineIntersection(x1, y1, x2, y2, x3, y3, x4, y4)
			{
				bx = x2 - x1;
				by = y2 - y1;
				dx = x4 - x3;
				dy = y4 - y3; 
				b_dot_d_perp = bx*dy - by*dx;
				if(b_dot_d_perp == 0) {
					return false;
				}
				cx = x3-x1; 
				cy = y3-y1;
				t = (cx*dy - cy*dx) / b_dot_d_perp; 
			 
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