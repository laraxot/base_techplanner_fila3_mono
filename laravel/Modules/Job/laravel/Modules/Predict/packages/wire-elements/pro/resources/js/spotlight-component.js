document.addEventListener('alpine:init', () => {
    Alpine.data('WepSpotlightComponent', (componentId) => ({
        tokens: window.Livewire.find(componentId).$entangle('activeTokens', true),
        active: window.Livewire.find(componentId).$entangle('active', true),
        selectedGroup: 0,
        selectedItem: -1,
        query: window.Livewire.find(componentId).$entangle('query', true),
        input: {
            ['x-ref']: 'input',
            ['@keydown.backspace']() {
                if (this.$el.value === '' && this.tokens.length > 0) {
                    this.$wire.popScope();
                    this.selectedGroup = 0;
                    this.selectedItem = -1;

                    this.focus();
                }
            },
            ['@keydown.arrow-up'](event) {
                event.preventDefault();

                this.selectUp();
            },
            ['@keydown.arrow-down'](event) {
                event.preventDefault();

                this.selectDown();
            },
            ['@keydown.enter'](event) {
                event.preventDefault();

                this.select();
            },
            ['@keydown.tab'](event) {
                event.preventDefault();
                if (this.selectionHasTokens()) {
                    this.applyScope();
                    this.resetQuery();
                }
            },
            ['@keyup.tab'](event) {
                event.preventDefault();
            },
        },
        init() {
            this.$watch('query', () => {
                this.selectedItem = 0;
                this.selectedGroup = 0;
            });
            this.$watch('active', () => {
                if(this.active) {
                    this.focus();
                }
            });
            Livewire.on('spotlight.toggle', (options) => {
                this.toggle(options);
            });
        },
        focus() {
            setTimeout(() => {
                this.$focus.focus(this.$refs.input)
            }, 100);
        },
        close() {
            this.active = false;
        },
        toggle(options) {
            if (options?.query) {
                this.query = options.query;
            }

            this.active = !this.active;
        },
        resetQuery() {
            this.query = '';
            this.selectedItem = 0;
            this.selectedGroup = 0;

            this.focus();
        },
        resetScope() {
            this.$wire.clearScope();

            this.focus();
        },
        selection() {
            let groups = this.$refs.resultGroups?.children ?? [];
            let item = groups[this.selectedGroup]?.querySelectorAll('ul>li')[this.selectedItem];


            return item ? Alpine.$data(item) : null;
        },
        selectionHasTokens() {
            return this.selection()?.tokens?.length !== 0;
        },
        select() {
            this.$wire.runAction(this.selection().action);
        },
        applyScope() {
            this.$wire.applyTokens(this.selection().tokens);

            this.$nextTick(() => {
                this.$focus.focus(this.$refs.input)
            });
        },
        selectUp() {
            let groups = this.$refs.resultGroups.children;
            let nextItem = Math.max(0, this.selectedItem - 1);

            if (nextItem === this.selectedItem) {
                this.selectedGroup = (this.selectedGroup - 1 === -1) ? groups.length - 1 : Math.min(groups.length - 1, this.selectedGroup - 1);
                this.selectedItem = groups[this.selectedGroup].querySelectorAll('ul>li').length - 1;
            } else {
                this.selectedItem = Math.min(groups[this.selectedGroup].querySelectorAll('ul>li').length - 1, this.selectedItem - 1);
            }

            this.$nextTick(() => {
                groups[this.selectedGroup].querySelectorAll('ul>li')[this.selectedItem - 1]?.scrollIntoView({
                    block: 'nearest',
                })
            })
        },
        selectDown() {
            let groups = this.$refs.resultGroups.children;
            let nextItem = Math.min(groups[this.selectedGroup].querySelectorAll('ul>li').length - 1, this.selectedItem + 1);

            if (nextItem === this.selectedItem) {
                this.selectedGroup = (groups.length - 1 === this.selectedGroup) ? 0 : Math.min(groups.length - 1, this.selectedGroup + 1);
                this.selectedItem = 0;
            } else {
                this.selectedItem = Math.min(groups[this.selectedGroup].querySelectorAll('ul>li').length - 1, this.selectedItem + 1);
            }

            this.$nextTick(() => {
                groups[this.selectedGroup].querySelectorAll('ul>li')[this.selectedItem + 1]?.scrollIntoView({
                    block: 'nearest',
                })
            })
        },
    }));
});
