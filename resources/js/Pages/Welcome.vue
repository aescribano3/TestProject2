<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import Cookies from "@/Components/Cookies.vue";

var CookiesText = ref("Utilitzem cookies per millorar la teva experiència a la nostra web. Si continues navegant, considerem que acceptes la seva utilització.");
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    cursos: {
        type: Array,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}

</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img
            id="background"
            class="absolute -left-20 top-0 max-w-[877px]"
            src="https://laravel.com/assets/img/welcome/background.svg"
        />
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">

                        <img src="Logo/TestLogo.png" class="h-12" alt="Logo">

                    </div>
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('cursos.index')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Cursos
                        </Link>

                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>
                <main class="mt-6">
                    <div class="carousel rounded-box" style="height: 200px;">
                        <div class="carousel-item">
                            <img src="https://habilis.ro-botica.com/wp-content/uploads/2022/09/GettyImages-1365200314.jpg" alt="Burger" />
                        </div> 
                        <div class="carousel-item">
                            <img src="https://eurecat.org/wp-content/uploads/2024/02/shutterstock_GuestXR_800px.jpg" alt="Burger" />
                        </div> 
                        <div class="carousel-item">
                            <img src="https://immaculadahorta.com/wp-content/uploads/2021/02/tac.jpg" alt="Burger" />
                        </div> 
                        <div class="carousel-item">
                            <img src="https://diarieducacio.cat/wp-content/uploads/sites/37/2021/04/iStock-1224302784.jpg" alt="Burger" />
                        </div> 
                        <div class="carousel-item">
                            <img src="https://llengua.bromera.com/img/posts/28/previ.jpg" alt="Burger" />
                        </div> 
                    </div>
                    <div class="hero">
                        <div class="hero-content text-center">
                            <div class="max-w-md">
                            <h1 class="text-5xl font-bold">Ha arribat la revolució a les aules!</h1>
                            <p class="py-6">Estàs cansat d’estar tot el dia a classe i no aprendre res? T’avorreixes davant la pantalla i només fas que mirar “Tik-Tok” o “Instagram”? Bé, potser necessites una motivació extra, i què millor si tens un EVA (Entorn Virtual d’Aprenentatge) que sigui “guai” i al teu gust! </p>
                            </div>
                        </div>
                    </div>
                    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                        <div v-for="curso in cursos" :key="curso.id">
                            <div v-if="curso.visible != 0" class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">{{curso.name}}</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        {{ curso.description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <Cookies :text="CookiesText"/>
                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    Test Project 2 - aescribano
                </footer>
            </div>
        </div>
    </div>
</template>
