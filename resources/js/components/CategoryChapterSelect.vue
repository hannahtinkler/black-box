<template>
    <div class="row">
        <div class="col-12 col-md-6">
            <label for="category">Category</label>
            <v-select name="category" @input="updateChapters" id="category" label="title" :options="categories"></v-select>
        </div>

        <div class="col-12 col-md-6">
            <label for="chapter">Chapter</label>
            <v-select name="chapter" id="chapter" :disabled="chapters.length == 0" label="title" :options="chapters"></v-select>
        </div>
    </div>
</template>

<script>
    import vSelect from 'vue-select';

    export default {
        name: 'category-chapter-select',

        components: {
            'v-select': vSelect,
        },

        data: function () {
            return {
                categories: [],
                chapters: [],
            }
        },

        mounted: function () {
            this.updateCategories();
        },

        methods: {
            updateCategories: function () {
                axios.get('/api/categories').then(
                    response => this.categories = response.data
                );
            },

            updateChapters: function (category) {
                axios.get('/api/chapters', {
                    params: { category_id: category ? category.id : 0 },
                }).then(
                    response => this.chapters = response.data
                );
            },
         }
    }
</script>
