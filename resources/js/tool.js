Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'nova-cms',
            path: '/nova-cms',
            component: require('./components/Tool'),
        },
    ])
})
