export default {
    state: {
        links: []
    },
    mutations: {
        setLinksFor(state, role) {
            switch (role) {
                case 'DONOR':
                    state.links = [
                        {path: '/donor/donate', name: 'Register for a donation'},
                        {path: '/donor/history', name: 'My history'},
                        {path: '/donor/editProfile', name: 'Edit profile'}
                    ];
                    return;
                case 'DOCTOR':
                    state.links = [
                        {path: '/doctor/request', name: 'Request blood'},
                        {path: '/doctor/requests', name: 'Ongoing requests'},
                        {path: '/doctor/history', name: 'Completed requests'}
                    ];
                    return;
                case 'ASSISTANT':
                    state.links = [
                        {path: '/assistant/requests', name: 'All blood requests'},
                        {path: '/assistant/donations', name: 'All donations'},
                        {path: '/assistant/containers', name: 'All blood containers'}
                    ];
                    return;
                case 'ADMIN':
                    state.links = [
                        {path: '/admin/invite', name: 'Invite'},
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