<div class="container" style="background-image:url('../webroot/img/tires3.png')">

	<div class="col-md-12">
		<div class="page-header text-center" style="padding-top: 20px">
			<h1>How to get my own measure</h1>
			

				<div id="calculator" class="form-group"><h2>Calculator</h2>
					<form oninput="Result.value=parseFloat( (Litres.value)*100 ) / parseFloat(Kms.value)">
						<p>
							<label>Kms.</label>
							<input id="Kms" type="text" name="Kms">
						</p>
						<p>
							<label>Litres</label>
							<input id="Litres" type="text" name="Litres">
						</p>
						<p>
							<label>Result</label>
							<input id="Result" type="text" name="result">
						</p>
					</form>
				</div>
			
			<p class="lead">
				<div class="row">
					<h4 style="text-align: left;">So, your car doesn't have an on board computer to tell you the exact and precise number to fill the submit form in this website. Too bad... Well Let's pretend for a moment that technology is not our everyday life saver and dopamine segregator, and we have to do something such this strange operation entirely by ourselves. </h4>
				</div>
			</p>
			<div class="row" style="padding-bottom: 10px;text-align: center;">
				<a href="#calculator" >
								Go to calculator		
				</a>
			</div>
			 <?php echo $this->Html->image('surtidor.jpg', ['alt' => 'pump', 'style' => 'style="width:128px;height:128px;']); ?>
			<div class="row" style="text-align: left;padding-top: 20px;">We are really new to this, no one explained us how to calculate this in classroom neither in the high school, nor in the collegue, Dear lord this might be really hard to calculate... Nothing further from that, in fact, this is a very easy task to do.
			</div>
			<div class="row" style="text-align: left; padding-top: 20px;">
				<h4>- Easiest method:</h4>
				<ul style="text-align: left;padding-top: 10px;">
						
					<li> <b>Fill your tank entirely</b>, until you can see the gasoline, but be careful you don't want to spill the expensive product that makes your car move with explosions!</li>
					<li> <b>Drive exactly 100 Km</b></li>
					<li> <b>Fill your tank entirely again</b> and have a look at the petrol pump litres indicator </li>
					<li> The litres of fuel you fill in your car, is your car consumption along the way you spent them (Highway, city or combined).</li>
				</ul>
				Now you can contribute that measure as the % for that type of road!
			</div>
				<div class="row" style="margin-top: 20px;margin-bottom: 20px;">
					<p><b>Easy right?</b></p>
					<p>If you want to learn a more precise method, keep reading.</p>
				</div>
			<div class="row" style="text-align: left;">
				<h4>- Complete method:</h4>
				<p>Ready to make some simple numbers?</p>
				<p>This method is similar to the previous one, but this one is even more reliable.</p>
				<ul style="text-align: left;padding-top: 10px;">
					<li> As before, <b>Fill your tank entirely</b>, until you can see the gasoline.</li>
					<li> Restart your <b>mileage indicator</b> (or write in a paper the kms it marks).</li>
					<li> <b>Drive</b> the distance you want <b>without refilling</b> the tank, the further you go, the more reliable it gets. (reaching the gas reserve gives you the most reliable value).</li>
					<li> <b>Fill your tank entirely again</b> and have a look at the petrol pump litres indicator </li>
				</ul>
			</div>

			<div class="row" style="text-align: left; padding-top: 20px;">
					<p>Let's calculate<br>
					You have to retrieve the kms. you've done since the last time you filled your tank (that's why it was recommended to restart your mileage indicator).<br>
					Okay let's think, now you have the Km's you've done, and the litres of fuel you needed to do them. So you can know how much fuel your car need to do 100 Km.<br></p>

					<p>If, for example, you did <b>750 Kilometres with 50 Litres of fuel</b>, if you divide by 2 you would need 25 L to do 375 Km, 12.5 to do 187.5 Km, 6.25 L to do 93.75 Km, and so on...<br>
					The formula you need to calculate this in a flash is just a rule of three:</p>

					<span class="text-center" style="padding-top: 20px;padding-bottom: 20px;">
						<p><strong>( Litres x 100 ) / Km</strong></p>

						<p>And the result is the % of consumption your car did in the road(s) you driven.</p>
						<p>In case of doubt, type the measure as a combined one.</p>
						<span class="row"><p>Now you know how to do it, here you have an automatic calculator</p></span>

						
					</span>			


				<div id="calculator" class="form-group"><h2>Calculator</h2>
					<form oninput="Result.value=parseFloat( (Litres.value)*100 ) / parseFloat(Kms.value)">
						<p>
							<label>Kms.</label>
							<input id="Kms" type="text" name="Kms">
						</p>
						<p>
							<label>Litres</label>
							<input id="Litres" type="text" name="Litres">
						</p>
						<p>
							<label>Result</label>
							<input id="Result" type="text" name="result">
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>