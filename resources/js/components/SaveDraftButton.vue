<template>
    <button type="button" class="btn" @click="saveDraft">{{ this.saving ? 'Saving...' : 'Save as draft' }}</button>
</template>

<script>
    export default {
        name: 'save-draft-button',

        props: {
            form: String,
        },

        data: function () {
            return {
                saving: false,
                endpoint: '/api/drafts',
                draft: null,
            }
        },

        mounted: function () {
            this.setupAutoSave();
        },

        methods: {
            setupAutoSave: function () {
                setTimeout(() => this.saveDraft(), 1000);
                setInterval(() => this.saveDraft(), 60000);
            },

            saveDraft: function () {
                this.saving = true;

                let url = this.endpoint;
                let data = new FormData(document.getElementsByClassName(this.form)[0]);

                if (this.draft) {
                    data.append('_method', 'PUT');
                    url += `/${ this.draft.id }`;
                }

                axios.post(url, data).then(response => this.updateDraft(response.data));
            },

            updateDraft: function (draft) {
                this.draft = draft;
                this.saving = false;

                this.$store.commit(
                    'setDraftLastUpdated',
                    draft.updated_at_formatted
                );
            }
         }
    }
</script>
