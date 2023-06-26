<!DOCTYPE html>
<html lang="vi">

<!-- === START:: Head === -->
<head>
    @include('main.snippets.head')
</head>
<!-- === END:: Head === -->

<!-- === START:: Body === -->
<body>
    <!-- === START:: Header === -->
    @include('main.snippets.headerTop')
    <!-- Cache header main -->

    @include('main.snippets.headerMain')

    <!-- === START:: Content === -->
    <div class="app-content content">
        <div class="content-overlay"></div>
        @yield('content')
    </div>

    <!-- === START:: Footer === -->
    @include('main.snippets.footer')
    <!-- === END:: Footer === -->

    <div class="bottom">
        <div id="gotoTop" class="gotoTop" onclick="javascript:gotoTop();" style="display: block;">
            <i class="fas fa-chevron-up"></i>
        </div>
        @stack('bottom')
    </div>

    <!-- Modal -->
    @stack('modal')
    @include('main.modal.messageModal')
    <!-- login form modal -->
    <div id="js_checkLoginAndSetShow_modal">
        <!-- tải ajaax checkLoginAndSetShow() -->
    </div>
    
    <!-- === START:: Scripts Default === -->
    @include('main.snippets.scripts-default')
    <!-- === END:: Scripts Default === -->

    <!-- === START:: Scripts Custom === -->
    @stack('scripts-custom')
    <!-- === END:: Scripts Custom === -->
</body>
<!-- === END:: Body === -->

</html>