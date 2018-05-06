export default {
    state: {
        links: []
    },
    mutations: {
        setLinksFor(state, role) {
            switch (role) {
                case 'DONOR':
                    state.links = [
                        {path: '/donate', name: 'Register for a donation'},
                        {path: '/history', name: 'My history'}
                    ];
                    return;
                case 'DOCTOR':
                    state.links = [
                        {path: '/request', name: 'Request blood'},
                        {path: '/requests', name: 'See ongoing requests'},
                        {path: '/requests/past', name: 'Past requests'}
                    ];
                    return;
                case 'ASSISTANT':
                    state.links = [
                        //TODO
                    ];
                    return;
                case 'ADMIN':
                    state.links = [
                        //TODO
                    ];
                    return;
            }
        },
        resetLinks(state) {
            state.links = [];
        }
    },
    getters: {
        links: (state) => state.links,
    },
    actions: {}
}