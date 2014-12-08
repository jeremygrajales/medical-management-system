@extends('home.layouts.master')

@section('content')
<style>
	.billing_table{
			width:100%;		
	}
	td{
		padding-left: 5px;
		text-align:center;
		width:1%;
		white-space:nowrap;
	}	
</style>

<legend>My Account</legend>	

 <table class="billing_table">
     
      <thead>
         <tr>
            <th>Date</th>
            <th>Provider</th><!-- needs padding since its going to be lenghty-->
            <th>Description</th>
            <th>Charge</th>
            <th>Payment</th>
            <th>Balance</th>
         </tr>
      </thead>
	  @foreach($entries as $entry)
      <tbody><!--all date will be stored here in the table body -->
         <tr>
            <td>{{ $entry->date }}</td><!-- php date, for payment and charge -->
            <td>{{ $entry->provider }}</td><!-- provider -->
            <td>{{ $entry->description }}</td><!-- description -->
            <td>{{ $entry->charge }}</td><!-- charge -->
            <td>{{ $entry->payment }}</td><!-- any payment made after day of procedure -->
            <td>{{ $entry->balance }}</td><!-- (charge- any payment made)=balance -->  
         </tr>  
      </tbody>
	  @endforeach
	  <tfoot>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<th>Total due:</th><!--total account balance -->
			<td>$<label for="totalDue">{{ $balance }}</label></td>
		</tr>
	   </tfoot>
	</table>
	
	<a href="{{ URL::route('billing.make-payment') }}" class="pull-right btn btn-danger">Make Payment</a>

@stop