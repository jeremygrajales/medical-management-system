@extends('home.layouts.master')

@section('content')
	{{ Form::open(array('class' => 'form-horizontal', 'route' => 'patient.create', 'method' => 'post')) }} 
	
		
		<fieldset>
			
			<div class="form-group">
				<div class="col-md-4 col-md-offset-4">
					<p>Please keep your account up-to-date with your most recent information.</p>
				</div>
			</div>
					
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="first_name">First Name:</label>  
			  <div class="col-md-4">
			  <input id="first_name" name="first_name" type="text" placeholder="" class="form-control input-md" required="" value="{{ $user->first_name }}">
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="last_name">Last Name:</label>  
			  <div class="col-md-4">
			  <input id="last_name" name="last_name" type="text" placeholder="" class="form-control input-md" required="" value="{{ $user->last_name }}">
				
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="ssn">Social Security #:</label>  
			  <div class="col-md-2">
				<input id="ssn" name="ssn" type="text" placeholder="000-00-0000" class="form-control input-md" required="" value="@if($patient){{ $patient->ssn }}@endif">
			  </div>
			</div>

			
			<div class="form-group">
				<label class="col-md-4 control-label" for="dob">Date of Birth:</label>  
				<div class="col-md-2">
					<input id="dob" name="dob" type="text" class="form-control input-md" placeholder="mm/dd/yyyy" required="" value="@if($patient){{ $patient->dob }}@endif">
				</div>
			</div>
				


			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="address">Address</label>  
			  <div class="col-md-4">
			  <input id="address" name="address" type="text" placeholder="" class="form-control input-md" required="" value="@if($patient){{ $patient->address }}@endif">
				
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="city">City:</label>  
			  <div class="col-md-3">
			  <input id="city" name="city" type="text" placeholder="" class="form-control input-md" required="" value="@if($patient){{ $patient->city }}@endif">
				
			  </div>
			</div>

			<!-- Select Basic -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="state">State</label>
			  <div class="col-md-2">
				<select id="state" name="state" class="form-control">
				  <option value="AL">-- Select State --</option>
				  <option value="AK">Alabama</option>
				  <option value="AZ">Alaska</option>
				  <option value="AR">Arizona</option>
				  <option value="CA">Arkansas</option>
				  <option value="CO">California</option>
				  <option value="CT">Colorado</option>
				  <option value="DE">Connecticut</option>
				  <option value="DC">Delaware</option>
				  <option value="FL">District Of Columbia</option>
				  <option value="GA">Florida</option>
				  <option value="HI">Georgia</option>
				  <option value="ID">Hawaii</option>
				  <option value="IL">Idaho</option>
				  <option value="IN">Illinois</option>
				  <option value="IA">Indiana</option>
				  <option value="KS">Iowa</option>
				  <option value="KY">Kansas</option>
				  <option value="LA">Kentucky</option>
				  <option value="ME">Louisiana</option>
				  <option value="MD">Maine</option>
				  <option value="MA">Maryland</option>
				  <option value="MI">Massachusetts</option>
				  <option value="MN">Michigan</option>
				  <option value="MS">Minnesota</option>
				  <option value="MO">Mississippi</option>
				  <option value="MT">Missouri</option>
				  <option value="NE">Montana</option>
				  <option value="NV">Nebraska</option>
				  <option value="NH">Nevada</option>
				  <option value="NJ">New Hampshire</option>
				  <option value="NM">New Jersey</option>
				  <option value="NY">New Mexico</option>
				  <option value="NC">New York</option>
				  <option value="ND">North Carolina</option>
				  <option value="OH">North Dakota</option>
				  <option value="OK">Ohio</option>
				  <option value="OR">Oklahoma</option>
				  <option value="PA">Oregon</option>
				  <option value="RI">Pennsylvania</option>
				  <option value="SC">Rhode Island</option>
				  <option value="SD">South Carolina</option>
				  <option value="TN">South Dakota</option>
				  <option value="TX">Tennessee</option>
				  <option value="UT">Texas</option>
				  <option value="VT">Utah</option>
				  <option value="VA">Vermont</option>
				  <option value="WA">Virginia</option>
				  <option value="WV">Washington</option>
				  <option value="WI">West Virginia</option>
				  <option value="WY">Wisconsin</option>
				  <option value="">Wyoming</option>
				</select>
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="zip">Zip/Postal Code:</label>  
			  <div class="col-md-2">
			  <input id="zip" name="zip" type="text" placeholder="" class="form-control input-md" required="" value="@if($patient){{ $patient->zip }}@endif">
				
			  </div>
			</div>
			
			<!-- Button -->
			 <div class="col-md-8 col-md-offset-4">
				<button id="submit" name="submit" class="btn btn-success btn-lg">Update</button>
			 </div>

		</fieldset>


	
	
	{{ Form::close() }}
@stop

