<style type="text/css">
    .header-block .call-sidebar-btn {
        top: 35% !important;
    }
</style>
<section class="header-block js-header-block">
    <a class="logo" href="/">
        <span class="inner">
         <?php 
            $logo  = "";
            if(!empty(Cache::get('logo'))){
                $logo   = Cache::get('logo');  
            }
         ?>
        <img src="{{ URL::asset( $logo ) }}" >
        </span>
    </a>
    <a class="call-sidebar-btn visible-xs visible-sm" href="#">
        <img src="{{ URL::asset('assets/uploads/images/icon-call-sidebar.png') }}" alt="">
    </a>
    <a class="cart-btn" href="{{ URL::Route('web-get-my-shopping-cart') }}">
        <img src="{{ URL::asset('assets/uploads/images/icon-cart-min-dark.png') }}" alt="">

        <span class="number">
            @if( isset($_COOKIE['shopping_cart']) && Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null )
                {{ COUNT(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products']) }}
            @else 
                0
            @endif
        </span>
    </a>
</section>