<div class="grid gap-6 lg:grid-cols-[280px_1fr]">
    @include('partials.filters')

    <section class="w-full space-y-4">
        @include('partials.header')
        @include('partials.skeleton')
        @include('partials.products')
        @include('partials.pagination')
    </section>
</div>
