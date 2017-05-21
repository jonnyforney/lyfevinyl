@extends('layouts.app')

@section('content')

<div id="app" v-cloak>

  <div id="steps" class="lvds-section lvds-section--white" v-cloak>

    <steps
      customer_id="{{ session('customer_id') }}"
      is_logged_in="{{ Auth::check() }}"
    ></steps>

  </div>
</div>
@endsection

