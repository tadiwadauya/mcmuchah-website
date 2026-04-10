<header class="header home-4-header sticky-nav">
    <div class="header-wrapper">
        <a href="{{ route('home') }}" class="logo">
            <img
                class="hide-sticky"
                src="{{ $setting->logo_url ?? asset('inc/assets/images/logo-dark.png') }}"
                alt="{{ $setting->site_name ?? 'Logo' }}"
            />
            <img
                class="show-sticky"
                src="{{ $setting->logo_url ?? asset('inc/assets/images/logo-white.png') }}"
                alt="{{ $setting->site_name ?? 'Logo' }}"
            />
        </a>

        <div class="header-inner-wrapper">
            <div class="navigation-menu-wrapper menu-b538310 desktop-wrapper">
                <ul id="menu-main-menu" class="navigation-menu desktop">
                    <li class="menu-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('about') }}">About</a>
                    </li>

                    <li class="menu-item menu-item-has-children">
                        <a href="{{ route('services') }}">
                            Services
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                    <path d="M310.6 246.6l-127.1 128C176.4 380.9 168.2 384 160 384s-16.38-3.125-22.63-9.375l-127.1-128C.2244 237.5-2.516 223.7 2.438 211.8S19.07 192 32 192h255.1c12.94 0 24.62 7.781 29.58 19.75S319.8 237.5 310.6 246.6z"></path>
                                </svg>
                            </div>
                        </a>

                        <ul class="sub-menu">
                            @foreach($navbarServices as $service)
                                <li class="menu-item">
                                    <a href="{{ route('services') }}#service-{{ $service->slug }}">{{ $service->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="hamburger direction-left">
                <div class="hamburger-wrapper">
                    <div class="hamburger-icon">
                        <div class="bars">
                            <div class="bar"></div>
                            <div class="bar"></div>
                            <div class="bar"></div>
                        </div>
                    </div>

                    <div class="hamburger-content">
                        <div class="hamburger-content-header">
                            <a href="{{ route('home') }}" class="logo">
                                <img
                                    src="{{ $setting->logo_url ?? asset('inc/assets/images/logo-white.png') }}"
                                    alt="{{ $setting->site_name ?? 'Logo' }}"
                                />
                            </a>

                            <div class="hamburger-close">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <title>window-close</title>
                                    <path d="M13.46,12L19,17.54V19H17.54L12,13.46L6.46,19H5V17.54L10.54,12L5,6.46V5H6.46L12,10.54L17.54,5H19V6.46L13.46,12Z"/>
                                </svg>
                            </div>
                        </div>

                        <div class="navigation-menu-wrapper">
                            <ul class="navigation-menu mobile">
                                <li class="menu-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>

                                <li class="menu-item">
                                    <a href="{{ route('about') }}">About</a>
                                </li>

                                <li class="menu-item menu-item-has-children">
                                    <a href="{{ route('services') }}">
                                        Services
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                                <path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"></path>
                                            </svg>
                                        </div>
                                    </a>

                                    <ul class="sub-menu">
                                        <li class="back-button">
                                            <a href="#">
                                                <div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                                        <path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"></path>
                                                    </svg>
                                                </div>
                                                Back
                                            </a>
                                        </li>

                                        @foreach($navbarServices as $service)
                                            <li class="menu-item">
                                                <a href="{{ route('services') }}#service-{{ $service->slug }}">{{ $service->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="menu-item">
                                    <a href="{{ route('contact') }}">Contact</a>
                                </li>
                            </ul>
                        </div>

                        <div class="social-links-block">
                            <ul class="social-links">
                                @if($setting->facebook_url)
                                    <li>
                                        <a href="{{ $setting->facebook_url }}" target="_blank">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                                    <path d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                @endif

                                @if($setting->twitter_url)
                                    <li>
                                        <a href="{{ $setting->twitter_url }}" target="_blank">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                @endif

                                @if($setting->linkedin_url)
                                    <li>
                                        <a href="{{ $setting->linkedin_url }}" target="_blank">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                @endif

                                @if($setting->instagram_url)
                                    <li>
                                        <a href="{{ $setting->instagram_url }}" target="_blank">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.3 0-74.8-33.5-74.8-74.8S182.8 181 224.1 181s74.8 33.5 74.8 74.8-33.5 74.8-74.8 74.8zm146.4-194.3c0 14.9-12 26.9-26.9 26.9-14.9 0-26.9-12-26.9-26.9 0-14.9 12-26.9 26.9-26.9 14.9 0 26.9 12 26.9 26.9zM398.8 80c-1.7-35.3-9.8-66.6-35.7-92.5C337.2-38.3 305.9-46.4 270.6-48.1 234.1-50 213.9-50 177.4-48.1 142.1-46.4 110.8-38.3 84.9-12.5 59.1 13.4 51 44.7 49.3 80c-1.9 36.5-1.9 56.7 0 93.2 1.7 35.3 9.8 66.6 35.6 92.5 25.9 25.8 57.2 33.9 92.5 35.6 36.5 1.9 56.7 1.9 93.2 0 35.3-1.7 66.6-9.8 92.5-35.6 25.8-25.9 33.9-57.2 35.7-92.5 1.9-36.5 1.9-56.7 0-93.2zM351 281.9c-7.7 19.3-22.7 34.3-42 42-29 11.5-97.8 8.8-130.9 8.8s-101.9 2.6-130.9-8.8c-19.3-7.7-34.3-22.7-42-42-11.5-29-8.8-97.8-8.8-130.9s-2.6-101.9 8.8-130.9c7.7-19.3 22.7-34.3 42-42 29-11.5 97.8-8.8 130.9-8.8s101.9-2.6 130.9 8.8c19.3 7.7 34.3 22.7 42 42 11.5 29 8.8 97.8 8.8 130.9s2.7 101.9-8.8 130.9z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                @endif
                            </ul>

                            <p class="copy-right">@ Copyright {{ date('Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>