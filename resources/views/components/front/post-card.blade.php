@props(['post'])

<div {{ $attributes->merge(['class' => 'c-card']) }}>
    <figure class="c-card__figure">
        <img src="{{ asset('storage/thumbnails/small_' . $post->featured_image) }}" class="c-card__img" alt="..." />
    </figure>
    <div class="c-card__body">
        <div class="d-flex justify-content-between align-items-center mb-lg-2">
            <a href="{{ route('page.posts', ['category' => $post->category->slug]) }}"><span
                    class="badge bg-primary rounded-4 c-card__category mb-1">{{ $post->category->title }}</span></a>

            <span class="fw-bold c-card__date">{{ $post->created_at->format('d M Y') }}</span>

        </div>

        <a href="{{ route('page.post', $post->slug) }}">
            <p class="c-card__title">
                {{ $post->title }}
            </p>
        </a>
        <p class="c-card__excerpt">
            {{ $post->excerpt }}
        </p>

        <div class="flex-fill"></div>
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('page.posts', ['user' => $post->user->name]) }}">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="bg-dark rounded-circle p-3 me-2 c-card__profile"></div>
                    <span class="fw-bold c-card__author">{{ $post->user->name }}</span>
                </div>
            </a>
            <a href="{{ route('page.post', $post->slug) }}"
                class="text-decoration-none btn btn-outline-primary rounded-5 py-1 c-card__btn">
                Read More
            </a>
        </div>
    </div>
</div>
