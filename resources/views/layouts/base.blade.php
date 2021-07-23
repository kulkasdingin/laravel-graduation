<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="{{ asset('/static/images/logosmall3.png') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta
      name="description"
      content="Web site created using create-react-app"
    />
    <link rel="apple-touch-icon" href="{{ asset('/static/images/logosmall3.png') }}" />
    {{-- <!--
      manifest.json provides metadata used when your web app is installed on a
      user's mobile device or desktop. See https://developers.google.com/web/fundamentals/web-app-manifest/
    -->
    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" /> --}}
    <!--
      Notice the use of %PUBLIC_URL% in the tags above.
      It will be replaced with the URL of the `public` folder during the build.
      Only files inside the `public` folder can be referenced from the HTML.

      Unlike "/favicon.ico" or "favicon.ico", "%PUBLIC_URL%/favicon.ico" will
      work correctly both with client-side routing and a non-root public URL.
      Learn how to configure a non-root public URL by running `npm run build`.
    -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" 
    integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/static/css/custom.css') }}">

    <title>#UnitedPacil - Graduation Time!</title>
  </head>
  <body style="background: #141414">
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <header class="navbar navbar-expand-md navbar-dark bd-navbar" style="background-image: linear-gradient(to bottom,rgba(0,0,0,.7) 10%,rgba(0,0,0,0)); z-index:1000">
        <nav class="container-xxl flex-wrap flex-md-nowrap">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('/static/images/logo.png') }}" alt="" style="width: auto; height:33px; padding: 0 50px; margin-top: 8px">
              </a>
        </nav>
    </header>
    <div class="index-container">
        <div class="centered-div">
            <div class="list-graduates">
                <h1 class="graduates-label" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif">
                    Who's Graduating?
                </h1>
                <ul class="profiles">
                    @foreach ($graduates as $graduate)
                    <li class="profile">
                        <div>
                            <a href="#" class="profile-link" data-toggle="modal" data-target="#{{ $graduate->id }}">
                                <div class="avatar-wrapper">
                                    <div class="avatar-icon" style="background-image:url({{ ($graduate->foto == "-") || ($graduate->is_lulus == 0)? "https://occ-0-2008-769.1.nflxso.net/dnm/api/v6/K6hjPJd6cR6FpVELC5Pd6ovHRSk/AAAABWu33TcylnaLZwSdtgKR6mr0O63afqQLxZbzHYQZLkCJ9bgMTtsf6tzs_ua2BuTpAVPbhxnroiEA-_bqJmKWiXblO9h-.png?r=f71" : '/storage/'.$graduate->foto }})"></div>
                                </div>
                                <span class="graduate-name">{{ $graduate->nama }} <span class="skom {{ $graduate->is_lulus == 1 ? "" : "skom-blocked" }}">{{ $graduate->gelar }}</span></span>
                            </a>
                            <div class="profile-children"></div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <span>
                <a class="graduates-button" href="/home">Manage Graduates</a>
            </span>
        </div>
    </div>

    @yield('content')

    @foreach ($graduates as $graduate)
    <div class="modal fade custom-modal" id="{{ $graduate->id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $graduate->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="background-color: #181818">
            <div class="modal-header custom-modal-header" style="background-image:url({{ ($graduate->foto == "-") || ($graduate->is_lulus == 0) ? "https://occ-0-2008-769.1.nflxso.net/dnm/api/v6/K6hjPJd6cR6FpVELC5Pd6ovHRSk/AAAABWu33TcylnaLZwSdtgKR6mr0O63afqQLxZbzHYQZLkCJ9bgMTtsf6tzs_ua2BuTpAVPbhxnroiEA-_bqJmKWiXblO9h-.png?r=f71" : '/storage/'.$graduate->foto }})">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="z-index: 10000000">
                  <span aria-hidden="true">&times;</span>
                </button>
                <div class="ngambang-bawah">
                    <h1 class="tarung-biasa text-mengbawah menggaya" style="font-size: 2em">{{ $graduate->nama_lengkap }}</h1>
                </div>
              </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-12" style="display: flex; flex-wrap:wrap; align-items:center;justify-content:flex-start">
                                <div style="max-width: 100%;margin: .25em .7em .25em 0;">
                                    <span class="match-score">100% Cocok</span>
                                </div>
                                <div class="tarung" style="display: flex; flex-wrap:wrap; align-items:center">
                                    2021 <span class="maturity-rating" style="">2017+</span> Class of Tarung
                                </div>
                            </div>
                            <div class="col-12 mt-3 pb-3">
                                <div class="tarung">
                                    {{ $graduate->deskripsi }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-12">
                                <span>
                                    <span class="tarung-depan mr-1">Pemeran: </span><span class="tarung-small">{{ $graduate->nama_lengkap }}</span>
                                </span>
                            </div>
                            <div class="col-12 pt-3 pb-3">
                                <span>
                                    <span class="tarung-depan mr-1">Jurusan: </span><span class="tarung-small">{{ $graduate->jurusan }}</span>
                                </span>
                            </div>
                            <div class="col-12">
                                <span>
                                    <span class="tarung-depan mr-1">Status lulus: </span><span class="tarung-small">{{ $graduate->is_lulus ? "Alhamdulillah udah" : "Doain bentar lagi" }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    @endforeach
    <!--
      This HTML file is a template.
      If you open it directly in the browser, you will see an empty page.

      You can add webfonts, meta tags, or analytics to this file.
      The build step will place the bundled scripts into the <body> tag.

      To begin the development, run `npm start` or `yarn start`.
      To create a production bundle, use `npm run build` or `yarn build`.
    -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" 
    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" 
    crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" 
    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" 
    crossorigin="anonymous"></script>
  </body>
</html>
