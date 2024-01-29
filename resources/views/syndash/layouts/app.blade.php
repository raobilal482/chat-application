@include('syndash.component.header')
@include('syndash.component.sidebar')
@include('syndash.component.navbar')
        <!--page-wrapper-->
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
                        @yield('dashboard')
                        @yield('chat')
                </div>
			</div>
			<!--end page-content-wrapper-->
		</div>
		<!--end page-wrapper-->
@include('syndash.component.footer')