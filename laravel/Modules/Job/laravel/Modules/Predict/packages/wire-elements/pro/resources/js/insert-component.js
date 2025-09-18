import textareacaret from 'textarea-caret';

document.addEventListener('alpine:init', () => {
    Alpine.data('SupportsWepInsert', (config) => ({
        id: null,
        types: config.types,
        scope: config.scope ?? [],
        active: false,
        getCaretCoordinates: textareacaret,
        insertInput: {
            ['x-ref']: 'insertInput',
            ['@keyup'](event) {
                Livewire.dispatch('handleInsertInput', {
                    id: this.id,
                    text: this.$el.value,
                    types: this.types,
                    scope: this.scope,
                    originCoordinates: this.$refs.insertInput.getBoundingClientRect(),
                    caretCoordinates: this.getCaretCoordinates(event.target, event.target.selectionEnd),
                    event: event
                });
            },
            ['@keydown.arrow-up'](event) {
                if (this.active === true) {
                    event.preventDefault();
                    Livewire.dispatch('insertSelectUp');
                }
            },
            ['@keydown.arrow-down'](event) {
                if (this.active === true) {
                    event.preventDefault();
                    Livewire.dispatch('insertSelectDown');
                }
            },
            ['@keydown.enter'](event) {
                if (this.active === true) {
                    event.preventDefault();
                    Livewire.dispatch('insertSelectCurrent');
                }
            },
            ['@keydown.escape'](event) {
                if (this.active === true) {
                    event.preventDefault();
                    Livewire.dispatch('closeInsert');
                }
            },
            ['@click.away'](event) {
                if (this.active === true) {
                    event.preventDefault();
                    Livewire.dispatch('closeInsert');
                }
            },
        },
        init() {
            this.id = Math.floor(Math.random() * Math.floor(Math.random() * Date.now()));

            Livewire.on(`insertComponentActive.${this.id}`, () => {
                this.active = true;
            });

            Livewire.on(`insertComponentSelected.${this.id}`, (replacement) => {
                this.$el.value = replacement;
                this.$dispatch('input', replacement);

                if (this.$focus.focusable(this.$el)) {
                    this.$focus.focus(this.$el);
                    return;
                }

                setTimeout(() => {
                    this.$focus.focus(this.$el);
                }, 350);
            });

            Livewire.on(`insertComponentClosed.${this.id}`, () => {
                this.active = false;
                this.results = [];
            });

            Livewire.on('overlayComponentActivated', () => {
                this.$el?.blur();
            });
        }
    }));


    Alpine.data('WepInsertComponent', (id, config) => ({
        show: false,
        types: [],
        container: {
            ['x-show']: 'show',
            [':style']: '`top: ${coordinates.top}px; left: ${coordinates.left}px;`',
        },
        results: {
            ['x-ref']: 'results',
            ['@keydown.arrow-up']() {
                this.selectUp();
            },
            ['@keydown.arrow-down']() {
                this.selectDown();
            },
            ['@keydown.enter']() {
                this.select();
            },
            ['@keydown.escape']() {
                this.close();
            },
        },
        text: '',
        scope: [],
        config: config,
        instance: null,
        selected: 0,
        coordinates: {
            top: 0,
            left: 0,
        },
        activeToken: false,
        recentlyClosed: false,
        debounceTimeout: null,
        debounceTimeoutCallback: null,
        init() {
            Livewire.on('handleInsertInput', (payload) => {
                this.handleInsertInput(payload);
            });

            Livewire.on('showInsert', (props) => {
                this.scope = props.scope;
                this.coordinates = props.coordinates;

                if (this.show === false) {
                    this.show = true;
                    this.recentlyOpened = true;

                    setTimeout(() => {
                        this.recentlyOpened = false;
                    }, 400);
                }

                this.debounce(() => {
                    this.$wire.$call('setSearchParams', this.types, props.query, props.scope);

                    Livewire.dispatch(`insertComponentActive.${this.instance}`);
                }, this.recentlyOpened ? 0 : config.behavior['debounce_milliseconds']);
            });

            Livewire.on('insertSelectUp', () => {
                this.selectUp();
            });

            Livewire.on('insertSelectDown', () => {
                this.selectDown();
            });

            Livewire.on('closeInsert', () => {
                this.close();
            });

            Livewire.on('insertSelectCurrent', () => {
                this.select();
            });

            Livewire.on('remoteInsert', (params) => {
                if (params.instance === this.instance) {
                    this.insert(params.value);
                }
            });

            Livewire.on(`overlayComponentActivated`, () => {
                this.close();
            });

            Livewire.on(`overlayComponentClosed`, () => {
                setTimeout(() => {
                    this.close();
                }, 200);
            });
        },
        debounce(callback, time) {
            clearTimeout(this.debounceTimeout)

            this.debounceTimeoutCallback = () => {
                callback()
            }
            this.debounceTimeout = setTimeout(() => {
                callback()
                this.debounceTimeout = null
                this.debounceTimeoutCallback = null
            }, time);
        },
        handleInsertInput(payload) {
            this.instance = payload.id;
            const cursorPosition = payload.event.target.selectionEnd || 0;
            const activeToken = this.getActiveToken(payload.text, cursorPosition);

            if (this.recentlyClosed) {
                return;
            }

            if (activeToken === undefined && this.show === true) {
                Livewire.dispatch('closeInsert');
                return;
            }

            if (activeToken?.word === this.activeToken?.word) {
                return;
            }

            this.types = this.determineTypesByExpression(payload.types, activeToken?.word);

            if (this.types.length > 0) {
                this.activeToken = activeToken;
                this.text = payload.text;

                Livewire.dispatch('showInsert', {
                    query: activeToken.word,
                    scope: payload.scope,
                    coordinates: {
                        top: payload.originCoordinates.y + window.scrollY + payload.caretCoordinates.top,
                        left: payload.originCoordinates.x + payload.caretCoordinates.left
                    }
                });
            } else {
                Livewire.dispatch('closeInsert');
            }
        },
        getActiveToken(input, cursorPosition) {
            const tokenizedQuery = input.split(/[\s\n]/).reduce((acc, word, index) => {
                const previous = acc[index - 1];
                const start = index === 0 ? index : previous.range[1] + 1;
                const end = start + word.length;

                return acc.concat([{word, range: [start, end]}]);
            }, []);

            if (cursorPosition === undefined) {
                return undefined;
            }

            return tokenizedQuery.find(
                ({range}) => range[0] < cursorPosition && range[1] >= cursorPosition
            );
        },
        determineTypesByExpression(types, word) {
            return types.filter((type) => new RegExp(this.getConfig(type, 'expression')).test(word));
        },
        matchesExpression(word) {
            return new RegExp(this.getConfig('expression')).test(word);
        },
        getConfig(type, key) {
            return this.config['types'][type][key] ?? null;
        },
        close() {
            this.show = false;
            this.recentlyClosed = true;

            setTimeout(() => {
                this.selected = 0;
                this.recentlyClosed = false;
            }, 400);

            Livewire.dispatch(`insertComponentClosed.${this.instance}`);
        },
        replaceAt(str, replacement, index, length = 0) {
            const prefix = str.substr(0, index);
            const suffix = str.substr(index + length);

            return prefix + replacement + suffix;
        },
        formatInsert(replacement) {
            const [index] = this.activeToken.range;

            return this.replaceAt(
                this.text,
                replacement + ' ',
                index,
                this.activeToken.word.length
            );
        },
        insert(replacement) {
            Livewire.dispatch(`insertComponentSelected.${this.instance}`, this.formatInsert(replacement));
        },
        select(id) {
            this.$wire.select(this.instance, id ?? this.$refs.results.children[this.selected].dataset.id);
            this.close();
        },
        selectUp() {
            this.selected = Math.max(0, this.selected - 1);
            this.$nextTick(() => {
                this.$refs.results.children[this.selected - 1]?.scrollIntoView({
                    block: 'nearest',
                })
            })
        },
        selectDown() {
            this.selected = Math.min(this.$refs.results.children.length - 1, this.selected + 1)
            this.$nextTick(() => {
                this.$refs.results.children[this.selected + 1]?.scrollIntoView({
                    block: 'nearest',
                })
            })
        },
    }));
});
