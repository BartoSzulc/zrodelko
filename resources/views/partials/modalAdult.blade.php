@if (!isset($_COOKIE['modalAdult'])) 
    <div class="modalAdult fixed h-full w-full overflow-hidden"
    x-data="{ open: false }" :class="{ 'z-[99]': open }"
    x-init="setTimeout(() => { open = true; }, 2500)">
	<div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
		x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
		x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
		x-description="Background backdrop, show/hide based on modal state."
		class="fixed inset-0 bg-black bg-opacity-80 transition-opacity overflow-hidden"></div>
	<div class="relative w-full h-full overflow-hidden">
		<div class="flex min-h-full w-full justify-center md:p-4 text-center items-center overflow-hidden">

			<div x-show="open" x-transition:enter="ease-out duration-300"
				x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
				x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
				x-transition:leave="ease-in duration-200"
				x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
				x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
				x-description="Modal panel, show/hide based on modal state."
				class="relative transform overflow-hidden bg-white text-left shadow-xl transition-all"
				>
				<div class="md:p-60 px-5 py-10 text-center pointer-events-auto overflow-hidden max-w-[350px] sm:max-w-full">
					<!-- Icon -->
					<span class="mb-4 inline-flex justify-center items-center w-[62px] h-[62px] rounded-full border-4 bg-primary relative animate-bounce">
                   
                    <svg class="xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                    </svg>
                    </span>
					<!-- End Icon -->

					<div class="md:text-6xl text-5xl font-bold lg:mb-60 mb-5 md:mb-30">
                        <p>{!! __('Potwierdź, że masz ukończone 18 lat') !!}</p>
                    </div>
					<div class="flex flex-col sm:flex-row items-center justify-center gap-4 md:mb-60 mb-5">
                        <div class="item flex-1 md:min-w-[290px]">
                            <button x-on:click="open = false; setCookie('modalAdult', 'true', 1)" class="btn-primary cursor-pointer w-full" title="Nie potwierdzam">
                                {!! __('Potwierdzam') !!}
                            </button>
                            
                        </div>
                        <div class="item flex-1 md:min-w-[290px]">
                            <a href="/" class="btn-secondary w-full" title="Potwierdzam">
                                {!! __('Nie potwierdzam') !!}
                            </a>
                        </div>
                    </div>

					<div class="modalFooter text-base">
						<p class="underline-custom__primary" >{!! __('Zgadzam się z') !!} <a target="_blank" class="" href="{{ esc_url(get_permalink($page)) }}">{!! __('Regulaminem serwisu') !!}</a> i  @if($policy_page_id)
                            <a href="{{ esc_url(get_permalink($policy_page_id)) }}" class="block max-w-fit mx-auto sm:m-auto sm:inline sm:max-w-full" target="_blank">{!! __('Polityką prywatności') !!}</a>
                        @endif</p>
					</div>
				</div>
			</div>
            
		</div>
	</div>
    <script>
        function setCookie(name, value, minutes) {
            var expires = "";
            var date = new Date();
            date.setTime(date.getTime() + (minutes * 60 * 1000));

            expires = "; expires=" + date.toUTCString();

            document.cookie = name + "=" + value + "; path=/"; 
        }
    </script>
</div>

@endif