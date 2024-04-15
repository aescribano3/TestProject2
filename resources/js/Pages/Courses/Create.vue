<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
    name: "",
    stage: "",
    description: "",
    visible: true,
});

const submit = () => {
    form.post(route("cursos.store"));
};

</script>

<template>
    <Head title="Crear Curso" />
    <AuthenticatedLayout>
        <ApplicationLogo class="w-20 block mx-auto mt-5" />
        <div class="pop border-2 shadow-2xl rounded-3xl md:max-w-[40%]">
            <div class="popch">
                <h5 class="popcolor font-extrabold text-center text-4xl mt-3">
                    Crear Curso
                </h5>
                <form @submit.prevent="submit" class="p-5">
                    <div class="p-3">
                        <InputLabel for="name" value="Nombre" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="p-3">
                        <InputLabel for="stage" value="Etapa" />

                        <TextInput
                            id="stage"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.stage"
                            required
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.stage" />
                    </div>
                    <div class="p-3">
                        <InputLabel for="description" value="Descripcion" />

                        <TextInput
                            id="description"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.description"
                            required
                            autocomplete="description"
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.description"
                        />
                    </div>
                    <div class="p-3">
                        <InputLabel for="visible" value="Visibilitat" />

                        <div class="flex items-center mt-1">
                            <input
                                id="visible"
                                type="checkbox"
                                class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                v-model="form.visible"
                            />
                            <label for="visible" class="ml-2 block text-sm leading-5 text-gray-900">
                                Mostrar Curso
                            </label>
                        </div>

                        <InputError class="mt-2" :message="form.errors.visible" />
                    </div>

                    <div class="text-center mt-3">
                        <PrimaryButton type="submit">Crear Curso</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
        <FooterLayout />
    </AuthenticatedLayout>
</template>