<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import { ref } from "vue";
import DangerButton from "@/Components/DangerButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";

router.reload({ only: ['cursos'] })
const props = defineProps({
    cursos: Array,
});
const DeleteModal = ref(false);
var cursoIdR = ref(0);

const OpenDeleteModal = (cursoId) => {
    cursoIdR = cursoId;
    DeleteModal.value = true;
};

const CloseDeleteModal = () => {
    DeleteModal.value = false;
};

</script>

<template>
    <Head title="Cursos" />
    <Modal :show="DeleteModal" @close="CloseDeleteModal">
            <div class="inset-0 z-40 flex items-center justify-center w-full h-full overflow-auto">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white">
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Estas seguro de que quieres eliminar este curso?</h3>
                            <Link method="delete" :href="route('cursos.destroy',cursoIdR)" @click="CloseDeleteModal" as="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                Si, eliminar
                            </Link>
                            <button @click="CloseDeleteModal" type="button" class="text-gray-500 bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white">No, cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>
    <AuthenticatedLayout>
        <div>
            <div class="overflow-x-auto">
                <table class="table">
                    <thead class="text-black">
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Etapa</th>
                            <th>Descripció </th>
                            <th>Visibilitat </th>
                            <th><Link :href="route('cursos.create')"><PrimaryButton class="btn btn-success">Crear</PrimaryButton></Link></th>
                            <th></th>
                            <th><Link :href="route('cursos.json')"><button class="btn btn-info">JSON</button></Link></th>
                        </tr>
                    </thead>
                    <tbody class="text-black">
                        <tr v-if="props.cursos.length == 0">
                            <th></th>
                            <td>No hay cursos</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr v-if="props.cursos.length !== 0" v-for="curso in props.cursos" :key="curso.id">
                            <th>{{ curso.id }}</th>
                            <td>{{ curso.name }}</td>
                            <td>{{ curso.stage }}</td>
                            <td>{{ curso.description }}</td>
                            <td v-if="curso.visible === 1">Visible</td>
                            <td v-else>No visible</td>
                            <td><Link :href="route('cursos.edit', curso.id)"><button class="btn btn-info">Editar</button></Link></td>
                            <td><DangerButton @click="() => OpenDeleteModal(curso.id)" class="btn btn-error">Eliminar</DangerButton></td>
                            <td><Link :href="route('recursos.indexId',curso.id)"><button class="btn btn-info">Recursos</button></Link></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
