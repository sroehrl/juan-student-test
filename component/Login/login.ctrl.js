const form = document.getElementById('loginForm');
form.addEventListener('submit', ev => {
    ev.preventDefault();
    api.post('/login',{
        email:form.email.value,
        password: form.password.value
    }).then(res=>{
        sessionStorage.token = res.data.token;
        sessionStorage.user = JSON.stringify(res.data.user);
        setTimeout(()=>{
            window.location.href = '/dashboard'
        },500)

    }).catch(()=>{
        alert('Wrong credentials')
    })

})