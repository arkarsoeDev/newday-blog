<x-front-layout>
    <x-slot name="head">
        <div class="row m-3 mb-4 m-lg-5">
            <div class="c-heading p-4 p-lg-5">
                <h1 class="text-center h2">
                    As a general rule, the most successful man in life is the
                    man who has the best information.
                </h1>
            </div>
        </div>
    </x-slot>

    <div class="row my-5">
        <div class="">
            <h2 class="c-title"><span>Latest blog</span></h2>
        </div>
    </div>

    <div class="row">
        @foreach ($latestPosts as $key => $post)
            <div class="col-12 col-sm-6 {{ $key == 0 ? 'col-lg-12' : 'col-lg-4' }}">
                <x-front.post-card :post="$post" class="{{ $key == 0 ? 'c-card--large' : '' }}">
                </x-front.post-card>
            </div>
            @if($key == 0)
                <div class="spacer d-none d-lg-block mb-3"></div>
            @endif
        @endforeach
    </div>
    <div class="spacer"></div>
    {{-- <div class="my-5">
            <h3 class="mb-5 c-title">Recent blogs</h3>
            <div class="row g-xl-3">
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="c-card">
                        <figure class="c-card__figure">
                            <img src="img/test-1_1280.jpg" class="c-card__img" alt="..." />
                        </figure>
                        <div class="c-card__body">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="cat"><span
                                        class="badge bg-primary rounded-4 c-card__category mb-1">News</span></a>
                                <a href="date">
                                    <span class="fw-bold c-card__date">19 / September / 22</span>
                                </a>
                            </div>
                            <a href="title">
                                <p class="c-card__title">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Labore, vero.
                                </p>
                            </a>
                            <p class="c-card__excerpt">
                                Lorem ipsum dolor sit, amet consectetur
                                adipisicing elit. Totam nesciunt Lorem ...
                            </p>
                            <div class="flex-fill"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="profile">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="bg-dark rounded-circle p-3 me-2 c-card__profile"></div>
                                        <span class="fw-bold c-card__author">Arkar Soe</span>
                                    </div>
                                </a>
                                <a href="readmore">
                                    <button class="btn btn-outline-primary rounded-5 c-card__btn">
                                        Read More
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="c-card">
                        <figure class="c-card__figure">
                            <img src="img/test-1_1280.jpg" class="c-card__img" alt="..." />
                        </figure>
                        <div class="c-card__body">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="cat"><span
                                        class="badge bg-primary rounded-4 c-card__category mb-1">News</span></a>
                                <a href="date">
                                    <span class="fw-bold c-card__date">19 / September / 22</span>
                                </a>
                            </div>
                            <a href="title">
                                <p class="c-card__title">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Labore, vero.
                                </p>
                            </a>
                            <p class="c-card__excerpt">
                                Lorem ipsum dolor sit, amet consectetur
                                adipisicing elit. Totam nesciunt Lorem ...
                            </p>
                            <div class="flex-fill"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="profile">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="bg-dark rounded-circle p-3 me-2 c-card__profile"></div>
                                        <span class="fw-bold c-card__author">Arkar Soe</span>
                                    </div>
                                </a>
                                <a href="readmore">
                                    <button class="btn btn-outline-primary rounded-5 c-card__btn">
                                        Read More
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="c-card">
                        <figure class="c-card__figure">
                            <img src="img/test-1_1280.jpg" class="c-card__img" alt="..." />
                        </figure>
                        <div class="c-card__body">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="cat"><span
                                        class="badge bg-primary rounded-4 c-card__category mb-1">News</span></a>
                                <a href="date">
                                    <span class="fw-bold c-card__date">19 / September / 22</span>
                                </a>
                            </div>
                            <a href="title">
                                <p class="c-card__title">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Labore, vero.
                                </p>
                            </a>
                            <p class="c-card__excerpt">
                                Lorem ipsum dolor sit, amet consectetur
                                adipisicing elit. Totam nesciunt Lorem ...
                            </p>
                            <div class="flex-fill"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="profile">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="bg-dark rounded-circle p-3 me-2 c-card__profile"></div>
                                        <span class="fw-bold c-card__author">Arkar Soe</span>
                                    </div>
                                </a>
                                <a href="readmore">
                                    <button class="btn btn-outline-primary rounded-5 c-card__btn">
                                        Read More
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="c-card">
                        <figure class="c-card__figure">
                            <img src="img/test-1_1280.jpg" class="c-card__img" alt="..." />
                        </figure>
                        <div class="c-card__body">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="cat"><span
                                        class="badge bg-primary rounded-4 c-card__category mb-1">News</span></a>
                                <a href="date">
                                    <span class="fw-bold c-card__date">19 / September / 22</span>
                                </a>
                            </div>
                            <a href="title">
                                <p class="c-card__title">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Labore, vero.
                                </p>
                            </a>
                            <p class="c-card__excerpt">
                                Lorem ipsum dolor sit, amet consectetur
                                adipisicing elit. Totam nesciunt Lorem ...
                            </p>
                            <div class="flex-fill"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="profile">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="bg-dark rounded-circle p-3 me-2 c-card__profile"></div>
                                        <span class="fw-bold c-card__author">Arkar Soe</span>
                                    </div>
                                </a>
                                <a href="readmore">
                                    <button class="btn btn-outline-primary rounded-5 c-card__btn">
                                        Read More
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="c-card">
                        <figure class="c-card__figure">
                            <img src="img/test-1_1280.jpg" class="c-card__img" alt="..." />
                        </figure>
                        <div class="c-card__body">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="cat"><span
                                        class="badge bg-primary rounded-4 c-card__category mb-1">News</span></a>
                                <a href="date">
                                    <span class="fw-bold c-card__date">19 / September / 22</span>
                                </a>
                            </div>
                            <a href="title">
                                <p class="c-card__title">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Labore, vero.
                                </p>
                            </a>
                            <p class="c-card__excerpt">
                                Lorem ipsum dolor sit, amet consectetur
                                adipisicing elit. Totam nesciunt Lorem ...
                            </p>
                            <div class="flex-fill"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="profile">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="bg-dark rounded-circle p-3 me-2 c-card__profile"></div>
                                        <span class="fw-bold c-card__author">Arkar Soe</span>
                                    </div>
                                </a>
                                <a href="readmore">
                                    <button class="btn btn-outline-primary rounded-5 c-card__btn">
                                        Read More
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="c-card">
                        <figure class="c-card__figure">
                            <img src="img/test-1_1280.jpg" class="c-card__img" alt="..." />
                        </figure>
                        <div class="c-card__body">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="cat"><span
                                        class="badge bg-primary rounded-4 c-card__category mb-1">News</span></a>
                                <a href="date">
                                    <span class="fw-bold c-card__date">19 / September / 22</span>
                                </a>
                            </div>
                            <a href="title">
                                <p class="c-card__title">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Labore, vero.
                                </p>
                            </a>
                            <p class="c-card__excerpt">
                                Lorem ipsum dolor sit, amet consectetur
                                adipisicing elit. Totam nesciunt Lorem ...
                            </p>
                            <div class="flex-fill"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="profile">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="bg-dark rounded-circle p-3 me-2 c-card__profile"></div>
                                        <span class="fw-bold c-card__author">Arkar Soe</span>
                                    </div>
                                </a>
                                <a href="readmore">
                                    <button class="btn btn-outline-primary rounded-5 c-card__btn">
                                        Read More
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 text-center mt-3 mt-lg-5">
                <a class="c-btn-link">view more</a>
            </div>
        </div> --}}
    {{-- <div class="spacer"></div> --}}

</x-front-layout>
