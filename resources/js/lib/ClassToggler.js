class ClassToggler {
    constructor(options) {
        this.options = this.getDefaultOptions();

        this.setup();

        if (this.valid) {
            this.addListeners();
        }
    }

    setup() {
        this.handleClick = this.handleClick.bind(this);

        this.triggers = document.querySelectorAll(this.options.selectors.trigger);
    }

    valid() {
        return this.triggers.length;
    }

    addListeners() {
        this.triggers.forEach(trigger => trigger.addEventListener('click', this.handleClick));
    }

    handleClick(e) {
        let target = document.querySelector(`.${ e.target.getAttribute('data-class-toggler-target') }`);

        target = target ? target : e.target;

        if (target.classList.contains(this.options.classes.active)) {
            target.classList.remove(this.options.classes.active);
        } else {
            target.classList.add(this.options.classes.active);
        }
    }

    getDefaultOptions() {
        return {
            selectors: {
                trigger: '.js-class-toggler-trigger',
            },
            classes: {
                active: 'is-active',
            }
        }
    }
}

export default ClassToggler;
