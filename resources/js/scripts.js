window.cartAdd = function(product_id) {
    axios.post('/checkout/add', {
        product_id: product_id,
    }).then(response => {
        if (response.data) {
            document.getElementById('message').innerText = response.data;
            document.getElementById('alert-danger').classList.remove('hidden');
        } else {
            location.reload();
        }
    }).catch(err => {
        console.log(err.response.data);
    })
}

window.reduceQuantity = function(id) {
    axios.post('/checkout/change-quantity', {
        id: id,
    }).then(response => {
        location.reload();
    }).catch(err => {
        console.log(err.response.data);
    })
}

const form = document.getElementById('reg-form');
window.onload = function() {
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        let elements = form.querySelectorAll('p');
        let inputs = form.getElementsByClassName('border-red-500');
        for (let elem of elements) {
            elem.innerHTML = '';
        }
        for (let input of inputs) {
            input.classList.remove('border-red-500');
        }
        if (!form.elements.rules.checked) {
            document.getElementById('rules-checkbox-text').classList.remove('hidden');
            return false;
        }
        axios.post(form.action, {
            name: form.elements.name.value,
            surname: form.elements.surname.value,
            patronymic: form.elements.patronymic.value,
            login: form.elements.login.value,
            email: form.elements.email.value,
            password: form.elements.password.value,
            password_confirmation: form.elements.password_confirmation.value,
            rules: form.elements.rules.value,
        }).then(response => {
            window.location.replace("/");
        }).catch(err => {
            if ('errors' in err.response.data) {
                let errorsArr = err.response.data.errors;
                for (let [key, value] of Object.entries(errorsArr)) {
                    document.getElementById(key).classList.add('border-red-500');
                    document.getElementById(key + '-message').innerText = value;
                }
                console.log(err.response.data);
            }
        })

        return false;
    })
};
