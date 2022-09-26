@extends('admin.client_show')
@section('content')
<div class="row">
  <div class="six columns">
    <div class="ios7-icon">
      <ul class="hashtag">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
      <ul class="others">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
      <ul class="circles">
        <li></li>
        <li><img src="{{ asset('images/smk.png') }}" alt="" class="mt-3 opacity-50"></li>
        <li></li>
      </ul>
    </div>

    <div class="profile-text">
        <div class="card text-center">
            <div class="card-header">
               <span style="color: rosybrown">> Edit Profile <</span>
            </div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            <div class="card-footer text-muted">
                2 days ago
            </div>
        </div>
    </div>

  </div>
</div>

@endsection
