@extends('layouts.frontsite')

{{-- Content --}}
@section('content')
    <!-- Hero Section -->
    <div class="position-relative bg-primary overflow-hidden">
        <div class="container position-relative z-index-2 space-top-3 space-top-md-4 space-bottom-3 space-bottom-md-4">
            <div class="w-md-80 w-xl-70 text-center mx-md-auto">
            <div class="mb-7">
                <h1 class="display-4 text-white mb-4">The electric bill won’t give you a fright if you remember to turn off the light.</h1>
                <p class="lead text-white mb-4">Save Power, Save Nation</p>
            </div>
            <a class="btn btn-light btn-wide transition-3d-hover" href="{{ route('login') }}">Login</a>
            <a class="btn text-white" href="{{ route('register') }}">Register Now <i class="fas fa-angle-right fa-sm ml-1"></i></a>
            </div>
        </div>

        <!-- SVG Shapes -->
        <figure class="position-absolute top-0 left-0 w-60">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1246 1078">
            <g opacity=".4">
                <linearGradient id="doubleEllipseTopLeftID1" gradientUnits="userSpaceOnUse" x1="2073.5078" y1="1.7251" x2="2273.4375" y2="1135.5818" gradientTransform="matrix(-1 0 0 1 2600 0)">
                <stop offset="0.4976" style="stop-color:#559bff"/>
                <stop offset="1" style="stop-color:#377DFF"/>
                </linearGradient>
                <polygon fill="url(#doubleEllipseTopLeftID1)" points="519.8,0.6 0,0.6 0,1078 863.4,1078   "/>
                <linearGradient id="doubleEllipseTopLeftID2" gradientUnits="userSpaceOnUse" x1="1717.1648" y1="3.779560e-05" x2="1717.1648" y2="644.0417" gradientTransform="matrix(-1 0 0 1 2600 0)">
                <stop offset="1.577052e-06" style="stop-color:#559bff"/>
                <stop offset="1" style="stop-color:#377DFF"/>
                </linearGradient>
                <polygon fill="url(#doubleEllipseTopLeftID2)" points="519.7,0 1039.4,0.6 1246,639.1 725.2,644   "/>
            </g>
            </svg>
        </figure>
        <figure class="position-absolute right-0 bottom-0 left-0 mb-n1">
            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1920 100.1">
            <path fill="#fff" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"/>
            </svg>
        </figure>
        <!-- End SVG Shapes -->
    </div>
    <!-- End Hero Section -->
@endsection