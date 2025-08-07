<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>Document</title>
    </head>
    <body class="min-h-screen bg-linear-to-b from-white to-primary-400">
        <!-- Countdown Banner -->
        <div
            x-data="countdownBanner"
            class="bg-alert p-2 text-white text-center text-sm/[24px]"
        >
            <div class="flex items-center justify-center gap-2.5">
                <span class="font-bold">The Offer Expires In:</span>
                <div class="flex">
                    <span x-text="formatTime(hours)"></span>
                    <span>:</span>
                    <span x-text="formatTime(minutes)"></span>
                    <span>:</span>
                    <span x-text="formatTime(seconds)"></span>
                </div>
            </div>
        </div>

        <!-- Header -->
        <header x-data class="py-4 px-3 mb-4">
            <div class="container mx-auto flex justify-between gap-4">
                <img
                    src="{{ Vite::asset('resources/images/logo.svg') }}"
                    alt="Happyo Logo"
                    class="max-w-[92px] h-auto"
                />

                <button
                    @click="window.location.href = '{{
                        $routes['default_order_route']
                    }}'"
                    class="py-1 px-3 bg-primary-500 rounded-full text-white text-sm font-bold cursor-pointer"
                >
                    Claim my plan
                </button>
            </div>
        </header>

        <div class="container mx-auto px-3">
            <h1
                class="text-[22px] leading-[1.1] font-bold text-center text-primary-600 mb-6"
            >
                Get your ADHD hypnotherapy plan and see results in first month
                <span class="text-primary-500">(without any effort)</span>
            </h1>
        </div>

        <!-- Plan Select -->
        <section
            x-data="planSelection"
            class="container mx-auto grid gap-5 px-3"
        >
            <h2 class="text-[22px] leading-[1.1] text-primary-600 text-center">
                Select your plan
            </h2>

            <script>
                window.plansData = @json($products ?? []);
            </script>

            <div class="grid grid-rows-3 gap-4 mb-4 text-primary-600">
                <template x-for="plan in plans" :key="plan.id">
                    <div
                        @click="selectedPlan = plan"
                        class="py-4 px-2 grid grid-cols-5 rounded-2xl bg-white border border-dark-400 outline-dark-400 cursor-pointer group hover:outline-1"
                        :class="isSelected(plan) && 'border-success-500 outline-1 outline-success-500'"
                    >
                        <div class="col-span-3 flex items-center gap-2">
                            <div
                                class="w-6 h-6 m-1 rounded-full border-2"
                                :class="isSelected(plan) ? 'bg-success-500 border-success-500' : 'border-dark-400 group-hover:bg-dark-400'"
                            >
                                <img
                                    x-show="isSelected(plan)"
                                    src="{{ Vite::asset('resources/images/icons/checkmark.svg') }}"
                                    class="w-full h-auto"
                                />
                            </div>

                            <div class="grid gap-2">
                                <h3
                                    x-text="plan.slug"
                                    class="text-primary-600 font-semibold"
                                ></h3>
                                <div class="text-xs font-medium">
                                    <span
                                        x-text="formatPrice(plan.pricing['original_price'])"
                                        class="text-alert line-through"
                                    ></span>
                                    <span
                                        x-text="formatPrice(plan.pricing['price'])"
                                    ></span>
                                    <p
                                        x-text="getBillingPeriod(plan.slug)"
                                        class="text-dark-300"
                                    ></p>
                                </div>
                                <span
                                    x-show="plan.default"
                                    class="px-2 py-1 w-fit bg-alert rounded-full text-xs font-semibold text-white"
                                    >Most popular</span
                                >
                            </div>
                        </div>
                        <div
                            class="col-span-2 border-l border-dark-200 flex flex-col justify-center text-center"
                        >
                            <span
                                x-text="getMonthlyPrice(plan)"
                                class="text-[32px] leading-[1.25] text-primary-600 font-semibold"
                            ></span>
                            <span class="text-xs/[1.5] text-dark-300"
                                >per month</span
                            >
                        </div>
                    </div>
                </template>

                <button
                    @click="handleOrder()"
                    class="py-4 px-2 bg-primary-500 rounded-2xl text-white text-lg font-bold cursor-pointer"
                >
                    Order now
                </button>
            </div>
        </section>

        <!-- Legal -->
        <section class="container mx-auto mb-12 px-3">
            <p class="mb-5 text-xs text-dark-300">
                By clicking Get my plan, I agree to pay €15,19 for my plan and
                that if I do not cancel before the end of the 4-week
                introductory plan, Happyo will automatically charge my payment
                method the regular price €38,95 every 4 weeks thereafter until I
                cancel. I can cancel by contacting
                <a
                    href="mailto:support@gethappyo.co"
                    class="text-primary-500 underline"
                >
                    support@gethappyo.co
                </a>
            </p>
            <div class="p-4 flex gap-6 rounded-2xl bg-white shadow-lg">
                <img src="{{ Vite::asset('resources/images/money-back.svg') }}" alt="">
                <p class="text-xs text-dark-600">We offer a 100% money-back guarantee to users who have listened to at least 6 hypnotherapy sessions within 30 days and do not experience any improvement in their ADHD.</p>
            </div>
        </section>

        <!-- How does it work -->
        <section x-data="howItWorks" class="container mx-auto mb-12 px-3">
            <h2 class="mb-5 text-[22px] leading-[1.1] text-primary-600 text-center">
                How does it work?
            </h2>
            <div class="grid gap-2.5">
                <template x-for="(step, index) in steps">
                    <div class="py-3 px-4 flex gap-4 items-center bg-success-400 rounded-xl shadow-md">
                        <div class="flex h-10 w-10 min-w-10 bg-success-500 rounded-full text-white items-center justify-center">
                            <span x-text="index + 1" class="text-[28px]"></span>
                        </div>
                        <p x-text="step" class="text-sm"></p>
                    </div>
                </template>
            </div>
        </section>

        <!-- Reviews -->
        <section x-data="userReviews" class="container mx-auto mb-12 px-3">
            <h2 class="mb-5 text-[22px] leading-[1.1] text-primary-600 text-center">
                Users love our plan
            </h2>

            <script>
                window.reviewsData = @json($processedReviews ?? []);
            </script>

            <div class="grid gap-4">
                <template x-for="(review, index) in reviews" :key="index">
                    <div class="p-4 grid gap-3 bg-white rounded-xl text-dark-500">
                        <div class="flex items-center gap-2">
                            <div class="h-[50px] w-[50px] flex items-center justify-center rounded-full overflow-hidden">
                                <img :src="review.photoUrl" :alt="review.name" class="w-full h-full object-cover">
                            </div>
                            <div class="grid gap-1.5"> 
                                <span x-text="getName(review.name, review.age)" class="text-sm font-semibold leading-[16px]"></span>
                                <span x-text="review.handle" class="text-[10px]"></span>
                            </div>
                        </div>
                        <p x-text="review.description" class="text-xs leading-[1.6]"></p>
                    </div>
                </template>
            </div>
        </section>

    </body>
</html>
