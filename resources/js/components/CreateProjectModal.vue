<template>
    <modal classes="bg-white p-10 rounded" height="auto" name="create-project-modal">
        <form action="/projects" method="post">
            <h3 class="text-2xl text-center mb-12">Let's Start Something New</h3>
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="block mb-2">Title</label>
                        <input
                                v-model="form.title"
                                type="text"
                                name="title"
                                id="title"
                                class="w-full block border rounded p-2"
                                :class="errors.title ? 'border-red-400' : 'border-gray-400'">
                        <span class="text-xs text-red-400" v-if="errors.title">{{errors.title[0]}}</span>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block mb-2">Description</label>
                        <textarea
                                v-model="form.description"
                                rows="5"
                                name="description"
                                id="description"
                                class="w-full block border border-gray-400 rounded p-2">
                        </textarea>
                        <span class="text-xs text-red-400" v-if="errors.description">{{errors.description[0]}}</span>
                    </div>

                </div>

                <div class="flex-1 ml-4">
                    <div class="mb-4">
                        <label for="task" class="block mb-2">Need Some Tasks?</label>
                        <input
                                type="text"
                                name="task"
                                id="task"
                                class="w-full block border border-gray-400 rounded p-2 mb-2"
                                v-for="(task, index) in form.tasks"
                                :placeholder="'Task '+(index+1)"
                                v-model="task.text"
                        >
                    </div>

                    <button type="button" class="inline-flex items-center" @click="addTask">
                        <svg class="mr-2" viewbox="0 0 18 18" height="18" width="18">
                            <g fill="#000" fill-rule="evenodd" opacity=".307">
                                <path fill="#000"
                                      d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                            </g>
                        </svg>
                        <span class="text-sm">Add New Task Field</span>
                    </button>
                </div>
            </div>

            <footer class="flex justify-end">
                <button type="button" class="button is-outlined mr-4" @click="$modal.hide('create-project-modal')">Cancel</button>
                <button class="button" @click.prevent="submit">Create Project</button>
            </footer>
        </form>
    </modal>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    tasks: [
                        {'text': ''}
                    ],
                    title: '',
                    description: ''
                },
                errors: {},
            }
        },

        methods: {
            addTask() {
                this.form.tasks.push({'text': ''})
            },

            submit() {
                axios.post('/projects', this.form)
                    .then(response => {
                        location = response.data.path;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            }
        }
    }
</script>
