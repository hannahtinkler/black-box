import SimpleMDE from 'simplemde';

class MarkdownEditor {
    constructor(options) {
        this.setup();

        if (this.texareas) {
            this.initialiseEditors();
            this.initialiseAutoSave();
        }
    }

    setup() {
        this.editors = [];
        this.texareas = document.querySelectorAll('.markdown-editor');

        this.save = this.save.bind(this);
    }

    initialiseEditors() {
        this.texareas.forEach(editor => {
            this.editors.push(new SimpleMDE({ element: editor }));
        });
    }

    initialiseAutoSave() {
        setTimeout(this.save, 1000);
    }

    save() {
        this.editors.forEach(editor => {
            console.log(editor.value())
        });
    }
}

export default MarkdownEditor;
