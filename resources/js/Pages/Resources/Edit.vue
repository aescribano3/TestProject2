<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { CKEditor } from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';


const props = defineProps({
    cursos: Array,
    recurso: Object,
});

const form = useForm({
    title: props.recurso.title,
    content: props.recurso.content,
    courseId: props.recurso.courseId,
    visible: props.recurso.visible,
});

const submit = () => {
    form.put(route("recursos.update", props.recurso.id));
};

const editor = ClassicEditor;
const editorConfig = {
  extraPlugins: [customPlugin],
  ckfinder: {
  },
};

function customPlugin(editor) {
  editor.model.document.on('change:data', () => {
    editor.editing.view.change(writer => {
      writer.setStyle(
        'padding-left',
        '20px',
        editor.editing.view.document.getRoot()
      );
      writer.setStyle(
        'color',
        'black',
        editor.editing.view.document.getRoot()
      );
    });
  });
}

</script>

<template>
    <Head title="Editar Recurso" />
    <AuthenticatedLayout>
        <ApplicationLogo class="w-20 block mx-auto mt-5" />
        <div class="pop border-2 shadow-2xl rounded-3xl md:max-w-[40%]">
            <div class="popch">
                <h5 class="popcolor font-extrabold text-center text-4xl mt-3">
                    Editar Recurso
                </h5>
                <form @submit.prevent="submit" class="p-5">
                    <div class="p-3">
                        <InputLabel for="title" value="Titol" />

                        <TextInput
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.title"
                            required
                            autofocus
                            autocomplete="title"
                        />

                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>

                    <ckeditor :editor="editor" v-model="form.content" :config="editorConfig"></ckeditor>
                    
                    <div class="p-3">
                        <InputLabel for="courseId" value="Curso" />

                        <select
                            id="courseId"
                            v-model="form.courseId"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            required
                            v-for="curso in props.cursos"
                        >
                            <option :value="curso.id">{{ curso.name }}</option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.courseId" />
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
                                Mostrar Recurso
                            </label>
                        </div>

                        <InputError class="mt-2" :message="form.errors.visible" />
                    </div>

                    <div class="text-center mt-3">
                        <PrimaryButton type="submit">Editar Recurso</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
        <FooterLayout />
    </AuthenticatedLayout>
</template>