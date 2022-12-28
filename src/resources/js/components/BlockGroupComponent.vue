<template>
    <div class="row">
        <button class="btn btn-success position-fixed fixed-bottom mx-auto mb-3"
                v-if="priorityChanged"
                @click="changeOrder"
                :class="priorityChanged ? 'animated bounceIn' : ''">
            Сохранить порядок
        </button>
        <div class="col-12 my-3">
            <h5>Добавить группу:</h5>
            <form>
                <div class="form-group">
                    <input :id="title" class="form-control" type="hidden" v-model="title">
                    <input :id="slug" class="form-control" type="hidden" v-model="slug">
                    <label :for="template">Выберите шаблон</label>
                    <select :id="template"  v-model="template" class="form-control" >
                        <option v-for="getTemplate in getTemplates" :value="getTemplate">{{ getTemplate }}</option>
                    </select>
                </div>
                <button class="btn btn-success"
                        type="button"
                        @click.prevent="send"
                        :disabled="loading">
                    <span v-if="loading">Идет обработка запроса</span>
                    <span v-else>Добавить</span>
                </button>
            </form>
        </div>

        <div class="col-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Шаблон</th>
                        <th>Имя</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <draggable :list="blockGroups" group="blockGroups" tag="tbody" handle=".handle" @change="checkMove">
                        <tr v-for="blockGroup in blockGroups" :key="blockGroup.id">
                            <th>
                                <i class="fa fa-align-justify handle cursor-move"></i>
                            </th>
                            <td width="30%">
                              {{ blockGroup.template }}
                            </td>
                            <td>
                                <div v-if="blockGroup.titleInput">
                                    <div class="input-group input-group">
                                        <input type="text"
                                               class="form-control"
                                               v-model="blockGroup.titleChanged">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger"
                                                    @click="blockGroup.titleInput = false">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                            <button class="btn btn-success"
                                                    @click="changeTitle(blockGroup)">
                                                <i class="far fa-check-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-outline-secondary" v-else @click="blockGroup.titleInput = true">
                                    {{ blockGroup.title }}
                                </button>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-dark" :href="blockGroup.showBlocksUrl">
                                      <i class="far fa-eye"></i>
                                    </a>
                                </div>
                              <div class="btn-group" role="group">
                                    <button class="btn btn-danger"
                                            :disabled="loading"
                                            @click="deleteBlockGroup(blockGroup)">
                                        Удалить
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </draggable>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'

    export default {
        components: {
            draggable,
        },
        props: [
          'getUrl',
          'putUrl',
          'orderUrl',
          'getTemplates',
        ],

        data: function() {
            return {
                loading: false,
                message: '',
                errors: [],
                error: false,
                blockGroups: [],
                iteration: 0,
                priorityChanged: false,
            }
        },

        computed: {
            orderData() {
                let ids = [];
                for (let item in this.blockGroups) {
                    if (this.blockGroups.hasOwnProperty(item)) {
                        ids.push(this.blockGroups[item].id);
                    }
                }
                return ids;
            }
        },

        methods: {
            // Восстановить переменные.
            reset() {
                this.loading = false;
                this.priorityChanged = false;
                this.error = false;
                this.errors = [];
                this.iteration = 0;
            },
            // Показать кнопку если порядок изменен.
            checkMove() {
                this.priorityChanged = true;
            },
            // Сохранить порядок.
            changeOrder() {
                this.loading = true;
                axios
                    .put(this.orderUrl, {
                        blockGroups: this.orderData,
                    })
                    .then(response => {
                        let result = response.data;
                        if (result.success) {
                            this.blockGroups = result.blockGroups;
                        }
                        else {
                            this.errors.push(result.message);
                        }
                    })
                    .catch(error => {
                        let data = error.response.data;
                        if (data.errors.blockGroup.length) {
                            this.errors.push(data.errors.blockGroup[0]);
                        }
                    })
                    .finally(() => {
                        this.reset();
                    })
            },
            // Меняем имя.
            changeTitle (blockGroup) {
                blockGroup.titleInput = false;
                this.loading = true;
                this.message = "";
                let formData = new FormData();
                formData.append('changed', blockGroup.titleChanged);
                axios
                    .post(blockGroup.titleUrl, formData)
                    .then(response => {
                        let result = response.data;
                        if (result.success) {
                            this.blockGroups = result.blockGroups;
                            this.message = 'Имя изменено';
                        }
                        else {
                            this.message = result.message;
                        }
                    })
                    .finally(() => {
                        this.reset();
                    });
            },
            // Удаление группы.
            deleteBlockGroup (blockGroup) {
                Swal.fire({
                    title: 'Вы уверены?',
                    text: "Группу будет невозможно восстановить!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Да, удалить!',
                    cancelButtonText: "Отмена"
                }).then((result) => {
                    if (result.value) {
                        this.loading = true;
                        this.message = "";
                        axios
                            .delete(blockGroup.delete)
                            .then(response => {
                                this.error = false;
                                let result = response.data;
                                if (result.success) {
                                    this.blockGroups = result.blockGroups;
                                    this.message = 'Удалено';
                                }
                                else {
                                    this.message = result.message;
                                }
                            })
                            .finally(() => {
                                this.reset();
                            });
                    }
                });
            },
            // Отправляем на сервер.
            send () {
                this.message = "";
                this.errors = [];
                this.sendSingle();
            },
            // Отправка.
            sendSingle() {
                this.loading = true;
                let formData = new FormData();
                let title = this.title;
                let slug = this.slug;
                let template = this.template;
                formData.append("title", title);
                formData.append("slug", slug);
                formData.append("template", template);
                axios
                    .post(this.putUrl, formData, {
                        responseType: 'json'
                    })
                    .then(response => {
                        let result = response.data;
                        this.reset();
                        if (result.success) {
                            this.blockGroups = result.blockGroups;
                        }
                        else {
                            this.errors.push(result.message);
                        }
                    })
                    .catch(error => {
                        let data = error.response.data;
                        this.reset();
                        if (data.errors.blockGroup.length) {
                            this.errors.push(data.errors.BlockGroup[0]);
                        }
                    })
            },

        },

        created() {
            axios.get(this.getUrl)
                .then(response => {
                    this.error = false;
                    let result = response.data;
                    if (result.success) {
                        this.blockGroups = result.blockGroups;
                    }
                    else {
                        this.message = result.message;
                    }
                })
        }
    }
</script>
