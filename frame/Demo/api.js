const api = axios.create({
    baseURL: '{{base}}api.v1',
    headers:{}
})
api.interceptors.request.use(function (config) {
    if(sessionStorage.token){
        config.headers.Authorization = `baerer ${sessionStorage.token}`;
    }
    return config;
});

