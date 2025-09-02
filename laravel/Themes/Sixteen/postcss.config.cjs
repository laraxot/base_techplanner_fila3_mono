module.exports = {
    plugins: {
        'tailwindcss/nesting': 'postcss-nesting',
        'postcss-import': {
            resolve(id) {
                return require.resolve(id);
            },
        },
        tailwindcss: {},
        autoprefixer: {},
    },
}
