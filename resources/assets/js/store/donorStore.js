export default {
    actions: {
        saveInfo(context, donorProfile) {
            return axios.post('/api/donor/profile', donorProfile)
        }
    }
}