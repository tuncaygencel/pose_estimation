<!DOCTYPE html>
<html>
  <head>
    <script src="p5/p5.js"></script>
    <script src="ml5/ml5.min.js"></script>    
	<style>
	
	html, body {
  margin: 0;
  padding: 0;
}
canvas {
  display: block;
}

	
	</style>
    <meta charset="utf-8" />

  </head>
  <body>
    
	
		<script>
		
			let video;
			let poseNet;
			let noseX = 0;
			let noseY = 0;
			let eyelX = 0;
			let eyelY = 0;
			 
			function setup() {
			  createCanvas(640, 480);
			  video = createCapture(VIDEO);
			  video.hide();
			  poseNet = ml5.poseNet(video, modelReady);
			  poseNet.on('pose', gotPoses);
			}

			function gotPoses(poses) {
			  // console.log(poses);
			  if (poses.length > 0) {
				let nX = poses[0].pose.keypoints[0].position.x;
				let nY = poses[0].pose.keypoints[0].position.y;
				let eX = poses[0].pose.keypoints[1].position.x;
				let eY = poses[0].pose.keypoints[1].position.y;
				noseX = lerp(noseX, nX, 0.5);
				noseY = lerp(noseY, nY, 0.5);
				eyelX = lerp(eyelX, eX, 0.5);
				eyelY = lerp(eyelY, eY, 0.5);
			  }
			}

			function modelReady() {
			  console.log('model ready');
			}

			function draw() {
			  image(video, 0, 0);
			  
			  let d = dist(noseX, noseY, eyelX, eyelY);

			  fill(255, 0, 0);
			  ellipse(noseX, noseY, d);
			  stroke(0, 153, 255);
			  line(noseX, noseY, eyelX, eyelY);
			  //fill(0,0,255);
			  //ellipse(eyelX, eyelY, 50);


			}
	
		</script>

  </body>
</html>