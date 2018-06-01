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
                        {path: '/history', name: 'My history'},
                        {path: '/editP', name:'Edit profile'}
                        // {path: '/registerInfo',name: 'Register info'}
                    ];
                    return;
                case 'DOCTOR':
                    state.links = [
                        {path: '/request', name: 'Request blood'},
                        {path: '/requests', name: 'Ongoing requests'},
                        //{path: '/requests/past', name: 'Past requests'},
                        {path: '/requests/history', name: 'Requests History'}
                    ];
                    return;
                case 'ASSISTANT':
                    state.links = [
                        {path: '/requests/all', name: 'All blood requests'},
                        {path: '/donations/all', name: 'All donations'},
                        {path:'/containers/all', name: 'All blood containers'}
                    ];
                    return;
                case 'ADMIN':
                    state.links = [
                        {path: '/invite', name: 'Invite'},
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