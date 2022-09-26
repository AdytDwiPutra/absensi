<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMK BAKTI ILHAM</title>
    <link rel="icon" type="image/png" href="{{ asset('images/smk.png') }}"/>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/test.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script></head>
<body></body>

    <aside class="profile-card">

    <section class="container">
    <div class="page-header">
        {{-- <h1>SMK BAKTI ILHAM<br> --}}

    </div>
    <div class="row active-with-click">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <article class="material-card Indigo">
                <h2>
                    <strong>{{ Auth::user()->name }}</strong>
                    <span style="font-size: 0.8rem" class="">
                        @if (isset($jabatan))
                            <i class="fa fa-fw fa-address-card"></i>
                            {{ $jabatan->jabatan }}
                        @else
                            ---
                        @endif
                    </span>
                </h2>
                <div class="mc-content">
                    <div class="img-container">
                        @php
                            $img = rand(1,5);
                        @endphp
                    @if(isset($image))
                        <img class="img-responsive" src="{{ asset('images/profiles/'.$image) }}">
                    @else
                        <img class="img-responsive" src="{{ asset('images/enjoy'.$img.'.png') }}">
                    @endif
                    </div>
                    <div class="mc-description">
                        {{-- <a href="{{ route('absensi') }}" class="action-button shadow animate blue"><i class="fa fa-street-view" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Absen</a> --}}
                        <a href="#" class="action-button shadow animate blue"><i class="fa fa-id-badge" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Absen</b></a>
                        <a href="{{ url('pendidik/absen/'.Auth::user()->id) }}" class="action-button shadow animate blue"><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Informasi</a>
                        {{-- <a href="{{ url('profile/'.Auth::user()->id) }}" class="action-button shadow animate blue"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Setting Profile</a> --}}
                        <a href="#" class="action-button shadow animate blue"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Pengaturan</a>
                        <a href="{{ route('logout') }}" class="action-button shadow animate red" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
                <a class="mc-btn-action">
                    <img src="{{ asset('images/smk.png') }}" alt="" style="width: 170px;height:55px">
                </a>
                <div class="mc-footer">
                    <h4>
                        @if (isset($profesi))
                            {{ $profesi->profesi }}
                        @else
                            ---
                        @endif
                    </h4>
                </div>
            </article>
        </div>
    </div>
</section>

<a href="#" class="github-corner" aria-label="View source on Github" target="_blank">
</a>

</aside>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        toastr.info('Absen dan Pengaturan masih dalam pengembangan lakukan penggantian foto langsung ke admin SMK Bakti Ilham');
    });
</script>
<script src="{{ asset('js/test.js') }}"></script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    let navigation = document.querySelector('.navigation');
    navigation.onclick = function(){
        navigation.classList.toggle('active')
    }

</script>
</body>
</html>
