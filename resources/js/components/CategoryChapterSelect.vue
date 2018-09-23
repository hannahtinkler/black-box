<template>
    <div class="row">
        <div class="col-12 col-md-6">
            <label for="category">Category</label>

            <v-select
                label="title"
                :onChange="selectedCategory"
                :onTab="selectedCategory"
                :value="category"
                :disabled="categories === null"
                :taggable="true"
                :options="categories">
            </v-select>

            <input id="category" type="hidden" name="category" v-model="selected.category">
        </div>

        <div class="col-12 col-md-6">
            <label for="chapter">Chapter</label>

            <v-select
                label="title"
                :onChange="selectedChapter"
                :onTab="selectedChapter"
                :value="chapter"
                :disabled="!selected.category"
                :taggable="true"
                :options="chapters">
            </v-select>

            <input id="chapter" type="hidden" name="chapter" v-model="selected.chapter">
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

        props: {
            category: String,
            chapter: String,
        },

        data: function () {
            return {
                categories: [],
                chapters: [],
                selected: {
                    category: null,
                    chapter: null,
                },
            }
        },

        mounted: function () {
            this.updateCategories();

            this.$nextTick(function () {
                this.selected.category = this.category;
                this.selected.chapter = this.chapter;
            });
        },

        methods: {
            updateCategories: function () {
                axios.get('/api/categories').then(
                    response => this.categories = response.data
                );
            },

            selectedCategory: function (category) {
                this.selected.category = category.title ? category.title : category;

                axios.get('/api/chapters', {
                    params: { category_id: category ? category.id : 0 },
                }).then(
                    response => this.chapters = response.data ? response.data : []
                );
            },

            selectedChapter: function (chapter) {
                this.selected.chapter = chapter.title ? chapter.title : chapter;
            }
         }
    }
</script>
