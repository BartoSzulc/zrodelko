@php
    $header = get_field('header', 'option');
    $logotype = $header['header_logo'];
    $policy_page_title  = '';
    $policy_page_url    = '';
    $policy_page_id     = (int) get_option( 'wp_page_for_privacy_policy' );

    if ( $policy_page_id && get_post_status( $policy_page_id ) === 'publish' ) {
        $policy_page_title  = get_the_title( $policy_page_id );
        $policy_page_url    = get_permalink( $policy_page_id );
    }
    $page_id = wc_terms_and_conditions_page_id();
    $page    = $page_id ? get_post( $page_id ) : false;
    $links_header = $header['links_header'] ?? null;
@endphp
@include('partials.modalAdult')
@include('partials.topbar')
<header class="header relative bg-black text-white ">
    <div class="container">
        <div class="grid grid-cols-12 gap-4 py-30">
            <div class="col-span-full lg:col-span-4 items-center">
                @if ($logotype)
                    <a class="link-hover block max-w-max mx-auto lg:mx-0" href="{{ home_url('/') }}">
                        {!! wp_get_attachment_image($logotype, 'full', false, array('class' => '', 'loading' => 'lazy')); !!}
                    </a>
                @endif
            </div>
            <div class="col-span-full lg:col-span-4 justify-center">
                @php aws_get_search_form( true ); @endphp
            </div>
            <div class="col-span-full lg:col-span-4 flex items-center lg:justify-end justify-between mt-4 lg:mt-0">
              <div class="header__woocommerce-buttons flex items-center sm:space-x-8 space-x-4 ml-auto lg:ml-0">
                @if (is_user_logged_in())
                <a class="link-hover" href="{{ get_permalink(get_option('woocommerce_myaccount_page_id')) }}" title="{{ __('Moje konto','woothemes') }}">
                    <svg width="28" height="30" viewBox="0 0 28 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 16.8975C4.97202 16.8975 0 21.1617 0 28.9048C0 29.5095 0.490905 29.9997 1.0966 29.9997H26.9034C27.5091 29.9997 28 29.5095 28 28.9048C28.0001 21.1621 23.028 16.8975 14 16.8975ZM2.2331 27.8099C2.66444 22.0205 6.61768 19.0873 14 19.0873C21.3824 19.0873 25.3357 22.0205 25.7674 27.8099H2.2331Z" fill="white"/>
                        <path d="M13.9851 0C9.83806 0 6.71094 3.18504 6.71094 7.40842C6.71094 11.7555 9.97409 15.2916 13.9851 15.2916C17.9961 15.2916 21.2592 11.7555 21.2592 7.40877C21.2592 3.18504 18.1321 0 13.9851 0ZM13.9851 13.1022C11.1832 13.1022 8.90413 10.5482 8.90413 7.40877C8.90413 4.38469 11.0411 2.18977 13.9851 2.18977C16.882 2.18977 19.066 4.4332 19.066 7.40877C19.066 10.5482 16.7869 13.1022 13.9851 13.1022Z" fill="white"/>
                    </svg>  
                </a>
                @else
                <a class="link-hover" href="{{ get_permalink(get_option('woocommerce_myaccount_page_id')) }}" title="{{ __('Login / Register','woothemes') }}">
                    <svg width="28" height="30" viewBox="0 0 28 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 16.8975C4.97202 16.8975 0 21.1617 0 28.9048C0 29.5095 0.490905 29.9997 1.0966 29.9997H26.9034C27.5091 29.9997 28 29.5095 28 28.9048C28.0001 21.1621 23.028 16.8975 14 16.8975ZM2.2331 27.8099C2.66444 22.0205 6.61768 19.0873 14 19.0873C21.3824 19.0873 25.3357 22.0205 25.7674 27.8099H2.2331Z" fill="white"/>
                        <path d="M13.9851 0C9.83806 0 6.71094 3.18504 6.71094 7.40842C6.71094 11.7555 9.97409 15.2916 13.9851 15.2916C17.9961 15.2916 21.2592 11.7555 21.2592 7.40877C21.2592 3.18504 18.1321 0 13.9851 0ZM13.9851 13.1022C11.1832 13.1022 8.90413 10.5482 8.90413 7.40877C8.90413 4.38469 11.0411 2.18977 13.9851 2.18977C16.882 2.18977 19.066 4.4332 19.066 7.40877C19.066 10.5482 16.7869 13.1022 13.9851 13.1022Z" fill="white"/>
                    </svg> 
                </a>
                @endif
                {!! do_shortcode('[xoo_wsc_cart]') !!}
                
              </div>
              @if (!empty($links_header))
              <div class="header__social-media flex items-center sm:space-x-8 lg:ml-8 space-x-4 ml-0 order-first lg:order-none">
                @foreach ($links_header as $link)
               
                @php
                    $icon = $link['social_icon'];
                    $url = $link['social_link'];
                @endphp
                   

                <div class="item">
                    <a class="link-hover" href="{{ $url['url'] }}" target="_blank">
                        @if ($icon == 'facebook') <img src="@asset('images/facebook.svg')" alt=""> @else <img src="@asset('images/instagram.svg')"> @endif  
                    </a>
                </div>
                @endforeach
              </div>
              @endif
              <div class="menu-mobile lg:hidden sm:ml-8 ml-4">
                @if (has_nav_menu('primary_navigation'))
                    {{ wp_nav_menu([
                    'menu_class' => 'list-none flex items-center justify-between text-menu font-bold underline-custom__primary', 
                    'container' => '', 
                    'link_before'    => '<span>',
                    'link_after'     => '</span>',
                    'link_class'  => 'hover:text-primary',
                    'theme_location' => 'primary_navigation']) }}
                @endif
            </div>
            </div>
        </div>
        <div class="site-header-nav-wrapper py-7 hidden lg:block">
            @if (has_nav_menu('primary_navigation'))
              {{ wp_nav_menu([
              'menu_class' => 'list-none flex items-center justify-between text-menu font-bold underline-custom__primary', 
              'container' => '', 
              'link_before'    => '<span>',
              'link_after'     => '</span>',
              'link_class'  => 'hover:text-primary',
              'theme_location' => 'primary_navigation']) }}
            @endif
        </div>
    </div>
</header>


