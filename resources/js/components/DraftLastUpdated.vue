<template>
    <small class="markdown-editor__status">{{ lastUpdated ? `Last saved: ${ lastUpdated }` : 'Not yet saved' }}</small>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        name: 'draft-last-updated',

        computed: {
            ...mapGetters({
                lastUpdated: 'getDraftLastUpdated',
            })
        },

        methods: {
            setupAutoSave: function () {
                setTimeout(() => this.saveDraft(), 1000);
                setInterval(() => this.saveDraft(), 60000);
            },

            saveDraft: function () {
                this.saving = true;

                let data = new FormData(document.getElementsByClassName(this.form)[0]);

                axios.post('/api/drafts', data).then(response =>
                    this.$store.commit(
                        'setDraftLastUpdated',
                        response.data.updated_at_formatted
                    )
                )
            },
         }
    }
</script>
