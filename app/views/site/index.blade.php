@extends('site.layouts.default')

@section('content')

	<br><br><br><br>
	<div class="jumbotron col-md-8 col-md-offset-2">
		<h2>Welcome to the <u>Medical Management System</u></h2>
		<p>The Medical Management System provides a means of managing patients’ billing and appointments and is a one-stop medical web interface
		that gives patients direct access to their medical information and to the doctors who care for them.</p>
		<br>
		<p class="text-center">
			<a href="{{ URL::route('users.login') }}" class="btn btn-lg btn-primary">Log-in</a>
			<span> OR </span>
			<a href="{{ URL::route('users.create') }}" class="btn btn-lg btn-primary">Register</a>
		</p>
	 </div>
	 
	<div class="footer col-md-8 col-md-offset-2 clear-fix text-center">
		<a href="{{ asset('readme.pdf') }}" class="btn btn-md btn-warning">ReadMe</a><br><br>
		<a href="{{ asset('presentation.ppt') }}" class="btn btn-md btn-warning">Download Presentation</a>
		<br><br>
		<p style="color:#eee">
		Copyright &copy; Medical Management System 2014.<br>
		Group I CS 319-1 Fall 2014 (NEIU)<br>
		This site was developed for educational purposes only.
		</p>
	</div>
 </div>
 
<style>

.container {
	width:100%; 
	height:100%;
	background:url('{{ asset('images/bg.jpg') }}');
}
</style>
@stop