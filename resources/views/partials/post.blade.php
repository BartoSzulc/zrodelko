<div class="col-span-1 w-full mx-auto bg-white text-center transition-all ease-in-out duration-500 relative  bottom-0 hover:bottom-2.5 hover:shadow-2xl ">
    <div class="blog relative"  data-aos="fade-up">
      <a class="flex flex-col" href="@permalink">
        @if (has_post_thumbnail())
        <img class="mx-auto object-cover object-center w-full h-[200px]" src="@thumbnail('full', false)" alt="">
        @endif 
        <div class="content p-5 lg:p-5 flex flex-col gap-4 grow-0">
          <div class="text-5xl font-semibold my-2.5 lg:my-5">
            <h2>@title</h2>
          </div>
          <div class="inline-flex items-center justify-center mt-auto">
            <a href="@permalink" class="btn-primary mt-auto">
              {{ __('Dowiedz się więcej')}}
            </a>
          </div>
        </div>
      </a>
    </div>
</div>