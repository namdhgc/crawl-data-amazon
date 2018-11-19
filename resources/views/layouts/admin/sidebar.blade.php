<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            @foreach($data['data']['hor-menu'] as $key => $item)
                <?php
                    $list_slug = explode('|', $item['slug']);
                    $permission = false;
                ?>
                @foreach($list_slug as $_key => $value_slug)
                    @if( $item['use'] )
                        <?php
                            $li_active = ''; $span_Selected = ''; $span_arrow = '';
                            $permission = true;
                            $length_segment = COUNT($data['list_segment']);
                            if ($item['sub'] == '') {
                                for ( $i = 0 ; $i < $length_segment; $i++) {

                                    if(strtolower($item['url']) == $data['list_segment'][$i]){
                                        $li_active = 'active'; $span_Selected = 'nav-toggle'; $span_arrow = 'open';
                                    }
                                }
                            }
                            else {

                                foreach ($item['sub'] as $item_sub_key => $item_sub_value) {

                                    for ( $i = 0 ; $i < $length_segment; $i++) {

                                        if(strtolower($item_sub_value['url']) == $data['list_segment'][$i] || strtolower($item_sub_value['url']) == $data['list_segment'][$i]){
                                            $li_active = 'active'; $span_Selected = 'nav-toggle'; $span_arrow = 'open';
                                            break;
                                        }
                                    }
                                }
                            }
                        ?>
                    @endif
                @endforeach
                @if($permission)
                    <li class="nav-item {{ $li_active }} {{ $span_arrow }}">
                        @if ($item['sub'] == '')
                            <a href="{{ URL::route( $item['route']) }}" class="nav-link ">
                                <i class="{{ $item['icon'] }}"></i>
                                <span class="title">{{ $item['name'] }}</span>
                                <span class="{{ $span_Selected }}"></span>
                            </a>
                        @else
                            <a href="" class=" nav-link {{ $span_Selected }}">
                                <i class="{{ $item['icon'] }}"></i>
                                <span class="title">{{ $item['name'] }}</span>
                                @if($span_Selected != '')
                                <span class="selected"></span>
                                @endif
                                <span class="arrow  {{ $span_arrow }}"></span>
                            </a>
                            <ul class="sub-menu">
                            @foreach ($item['sub'] as $abc => $value)
                                <?php $permission_roles = \Spr\Base\Controllers\Helper::checkPermission(Auth::guard('web')->user()->roles, $value['slug'])?>
                                @if(@$permission_roles)
                                <li>
                                    <a href="{{ URL::route( $value['route']) }}">
                                        {{$value['name']}}
                                    </a>
                                </li>
                                @endif
                            @endforeach
                            </ul>
                            <span class="{{ $span_Selected }}"></span>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
        <script type="text/javascript">
            
            $(document).ready(function(){
                if($('ul.page-sidebar-menu li').length == 0) {
                    $('.page-sidebar-wrapper').remove();
                }
            });
        </script>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->









