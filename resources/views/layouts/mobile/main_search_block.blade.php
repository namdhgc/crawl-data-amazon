<style type="text/css">
    .btn-search-mobile {
        background-repeat: no-repeat  !important;
        background-position: center  !important;
        background-image: url('{{ URL::asset('assets/uploads/images/icon-search.png') }}') !important;
        
    }
</style>
<section class="main-search-block js-main-search-block">
    <div class="block-main">
        <div class="search-form">
            <div class="input-wrap">
                <input class="keyword-input" value="" placeholder="Gõ tiếng Việt hoặc Anh để tìm sản phẩm trên Amazon">
                <button data-url="{{ URL::Route('web-get-search-product-by-key') }}" class="submit-btn btn-search-mobile">&nbsp;</button>
            </div>
        </div><!-- .search-form -->
    </div><!--  .block-main -->
</section>