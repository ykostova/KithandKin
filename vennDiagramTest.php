<html>
	<head>
		<link rel="stylesheet" href="style.css">
        <script src="raphael-min.js"></script>
		
		<script type="text/javascript">
			window.onload = function () {
				var circle1x = 380;
				var circle1y = 240;
				var circle1r = 200;
				
				var circle2x = 640;
				var circle2y = 280;
				var circle2r = 100;
				
				var overlap = calculateOverlap(circle1x, circle1y, circle1r, circle2x, circle2y, circle2r);
			
				var R = Raphael("holder", 1280, 720);
				R.circle(circle1x, circle1y, circle1r).attr({fill: "#000", "fill-opacity": 0, "stroke-width": 5, stroke: "#FFF"});
				R.circle(circle2x, circle2y, circle2r).attr({fill: "#000", "fill-opacity": 0, "stroke-width": 5, stroke: "#FFF"});
				
				
				R.circle(overlap[0], overlap[1], 7).attr({fill: "#C00", "fill-opacity": 1, "stroke-width": 2, stroke: "#FFF"});
				R.circle(overlap[2], overlap[3], 7).attr({fill: "#0C0", "fill-opacity": 1, "stroke-width": 2, stroke: "#FFF"});
				R.circle(overlap[4], overlap[5], 7).attr({fill: "#00C", "fill-opacity": 1, "stroke-width": 2, stroke: "#FFF"});
				R.circle(overlap[6], overlap[7], 7).attr({fill: "#CC0", "fill-opacity": 1, "stroke-width": 2, stroke: "#FFF"});
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